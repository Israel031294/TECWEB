drop database if exists curriculum;
create database curriculum;

use curriculum;

create table tipoUsuario(
	idTipo numeric(1) not null,
	tipo varchar(13) not null
);

alter table tipoUsuario add constraint idTA primary key(idTipo);


insert into tipoUsuario values (1,"Administrador");
insert into tipoUsuario values (2,"Profesor");

create table Usuario(
	idUsuario numeric(3) not null,
	correo varchar(50) not null,
	contrasenia varchar(50) not null,
	idTipo numeric(1) not null,
	activacion int(11) not null,
	token varchar(40),
	token_password varchar(100),
	password_request int(11)

);
alter table Usuario add constraint idUserPK primary key(idUsuario);
alter table Usuario add constraint idTP foreign key(idTipo) references tipoUsuario(idTipo) on delete cascade on update cascade;

create table profesores(
	idUsuario numeric(3) not null, #Valores permitidos del 0 al 999 
	idInstitucion varchar(30) not null,
	nombre varchar(50) not null,
	paterno varchar(50) not null,
	materno varchar(50) not null,
	correo varchar(50) not null,
	telefono numeric(13) not null
);
alter table profesores add constraint idUSFK foreign key(idUsuario) references Usuario(idUsuario) on delete cascade on update cascade;
create table adminListos(
	idUsuario numeric(3) not null,
    CP numeric(1) not null,#capacitacionDocente
    AD numeric(1) not null,#ActualizacionDisciplinaria
    CI numeric(1) not null,#cursos Impartidos
    GA numeric(1) not null,#Gestian academica
    PI numeric(1) not null,#Puestos institucionales
    PR numeric(1) not null,#Productos relevantes
    M numeric(1) not null,#Mebresías
    EDI numeric(1) not null,#ExperienciaDiseñoIngenieril
    EA numeric(1) not null,#Experiencia academica
    P numeric(1) not null,#Premios
    N numeric(1) not null,#nacimiento
    LP numeric(1) not null,#Logros Prof
    FA numeric(1) not null,#Formacion Academica
    IP numeric(1) not null,#Isntancias pertenecientes
    CA numeric(1) not null
);
alter table adminListos add constraint idUSFK foreign key(idUsuario) references Usuario(idUsuario) on delete cascade on update cascade;


create table nacimientos(
	idUsuario numeric(3) not null,
	dia numeric(2) not null,
    mes varchar(10),
    anio numeric(4)
);

alter table nacimientos add constraint idProf2 foreign key(idUsuario) references profesores(idUsuario) on delete cascade on update cascade;


create table puestosInstitucionales(
	idUsuario numeric(3) not null,
	puesto varchar(50) not null
);

alter table puestosInstitucionales add constraint idProf3 foreign key(idUsuario) references profesores(idUsuario) on delete cascade on update cascade;

create table formacionAcademica(
	idFormacion numeric(3) not null,
	idUsuario numeric(3) not null,
	nivel varchar(50) not null, #licenciatura|maestria|doctorado|(otro)(especificado)
    nombre varchar(50) not null,
    institucion varchar(50) not null,
    pais varchar(59)not null,
    anio numeric(4) not null,
    cedulaP varchar(30) not null	
);
alter table formacionAcademica add constraint idF primary key(idFormacion);
alter table formacionAcademica add constraint idProf4 foreign key(idUsuario) references profesores(idUsuario) on delete cascade on update cascade;


create table capacitacionDocente(
	idCapacitacion numeric(3) not null,
	idUsuario numeric(3) not null,
    tipoC varchar(50) not null,
    institucion varchar(50) not null,
    pais varchar(59)not null,
    anio numeric(4) not null,
    horas numeric(4) not null

);
alter table capacitacionDocente add constraint idC primary key(idCapacitacion);
alter table capacitacionDocente add constraint idProf5 foreign key(idUsuario) references profesores(idUsuario) on delete cascade on update cascade;



create table actualizacionD(
	idActualizacion numeric(3) not null,
	idUsuario numeric(3) not null,
    tipoAct varchar(50) not null,
    institucion varchar(50) not null,
    pais varchar(59)not null,
    anio numeric(4) not null,
    horas numeric(4) not null

);
alter table actualizacionD add constraint idProf6 foreign key(idUsuario) references profesores(idUsuario) on delete cascade on update cascade;
alter table actualizacionD add constraint idD primary key(idActualizacion);


create table gestionAcademica(
	idGestion numeric(3) not null,
	idUsuario numeric(3) not null,
    actividad varchar(50) not null,
    institucion varchar(50) not null,
    anioInicio numeric(4) not null,
    mesinicio varchar(10) not null,
    anioFinal numeric(4) not null,
    mesFinal varchar(10) not null

);
alter table gestionAcademica add constraint idG primary key(idGestion);
alter table gestionAcademica add constraint idProf7 foreign key(idUsuario) references profesores(idUsuario) on delete cascade on update cascade;

create table productosRelevantes(
	idProducto numeric(3) not null,
    idUsuario numeric(3) not null,
    anio numeric(4) not null,
    nombre varchar(100) not null,
    descripcion nvarchar(1000) not null
);
alter table productosRelevantes add constraint idF primary key(idProducto);

alter table productosRelevantes add constraint idProf8 foreign key(idUsuario) references profesores(idUsuario) on delete cascade on update cascade;



create table experienciaNoAcademica(
	idExperiencia numeric(3) not null,
	idUsuario numeric(3) not null,
	actividad varchar(50) not null,
    empresa nvarchar(50) not null,
    anioInicio numeric(4) not null,
    mesinicio varchar(10) not null,
    anioFinal numeric(4) not null,
    mesFinal varchar(10) not null

);

alter table experienciaNoAcademica add constraint idProf9 foreign key(idUsuario) references profesores(idUsuario) on delete cascade on update cascade;
alter table experienciaNoAcademica add constraint idEx primary key(idExperiencia);


create table experienciaDisenioIngenieril(
	idExperienciaIng numeric(3),
	idUsuario numeric(3) not null,
    tipoExperiencia varchar(50),
    lugar varchar(50) not null,
    numeroAnios numeric (3) not null,
    infAdicionar varchar (100) not null
);
alter table experienciaDisenioIngenieril add constraint idexpI primary key(idExperienciaIng);
alter table experienciaDisenioIngenieril add constraint idProf10 foreign key(idUsuario) references profesores(idUsuario) on delete cascade on update cascade;


create table logrosProfesionales(
	idLogro numeric(3) not null,
	idUsuario numeric(3) not null,
    anio numeric(4) not null,
	nombre varchar (50) not null,
	descripcion varchar (1000) not null

);
alter table logrosProfesionales add constraint idlp primary key(idLogro);
alter table logrosProfesionales add constraint idProf11 foreign key(idUsuario) references profesores(idUsuario) on delete cascade on update cascade;

create table membresias(
	idMembresia numeric(3) not null,
	idUsuario numeric(3) not null,
	organismo varchar(50) not null,
	anios numeric (4) not null,
	nivelParticipacion varchar(50) not null,
	informacionRelevante varchar(500) not null

);
alter table membresias add constraint idmem primary key(idMembresia);
alter table membresias add constraint idProf12 foreign key(idUsuario) references profesores(idUsuario) on delete cascade on update cascade;


create table premios(
	idPremio numeric(3) not null,
	idUsuario numeric(3) not null,
	anio numeric(4) not null,
	nombre varchar(100) not null,
    descripcion varchar (1000) not null
);
alter table premios add constraint iPrem primary key(idPremio);
alter table premios add constraint idProf13 foreign key(idUsuario) references profesores(idUsuario) on delete cascade on update cascade;



create table participacionPE(
	idParticipacion numeric (3) not null,
	idUsuario numeric(3) not null,
	nombre varchar(100) not null,
	descripcion varchar(1000) not null
);
alter table participacionPE add constraint iPart primary key(idParticipacion);
alter table participacionPE add constraint idProf14 foreign key(idUsuario) references profesores(idUsuario) on delete cascade on update cascade;


alter table participacionPE add constraint idProf14 foreign key(idUsuario) references profesores(idUsuario) on delete cascade on update cascade;


#*******************Apartado de DATOS LABORALES(Tabla 1.4)


create table contratacionActual(
	idUsuario numeric(4) not null,
	categoria varchar(50) not null,  #: Profesor de Tiempo Completo (PTC), Profesor de Medio Tiempo
									#(PMT), Profesor por Horas (PPH), Profesor de Asignatura (PDA), Otro (OTR) (especificar).
	diaIngreso numeric(2) not null,
    mesIngreso varchar(10) not null,
    anioIngreso numeric(4) not null

);

alter table contratacionActual add constraint idProf15 foreign key(idUsuario) references profesores(idUsuario) on delete cascade on update cascade;

create table instanciasPertenecientes(
	idInstancia numeric(3) not null,
	idUsuario numeric(4) not null,
    nombreInstancia varchar(100) not null,
    diaIngreso numeric(2) not null,
    mesIngreso varchar(10) not null,
    anioIngreso numeric(4) not null
	
);
alter table instanciasPertenecientes add constraint idInsP primary key(idInstancia);

alter table instanciasPertenecientes add constraint idProf16 foreign key(idUsuario) references profesores(idUsuario) on delete cascade on update cascade;


create table catalogoNivelCursos(
	idNivel numeric(1) not null,
    descripcion varchar(12) not null

);

alter table catalogoNivelCursos add constraint idN primary key(idNivel);

insert into catalogoNivelCursos values (1,'LICENCIATURA');
insert into catalogoNivelCursos values (2,'POSGRADO');

create table catalogoPeriodos(
	idPeriodo numeric(1) not null,
    descripcion varchar(9) not null

);

alter table catalogoPeriodos add constraint idP primary key(idPeriodo);

insert into catalogoPeriodos values (1,'2014-2015');
insert into catalogoPeriodos values (2,'2015-2016');


create table cursosImpartidos(
	idCurso numeric(3) not null,
	idUsuario numeric(4) not null,
	idPeriodo numeric(1) not null,
    idNivel numeric(1)  not null,
    nombreCurso varchar(100) not null,
	tipo varchar(50) not null, #EducaciónContinua (ECO), Otro (OTR) (especificar).
	horasTotales numeric(5) not null
);
alter table cursosImpartidos add constraint idCursoIm primary key(idCurso);
alter table cursosImpartidos add constraint idProf17 foreign key(idUsuario) references profesores(idUsuario) on delete cascade on update cascade;
alter table cursosImpartidos add constraint idPB foreign key(idPeriodo) references catalogoPeriodos(idPeriodo) on delete cascade on update cascade;
alter table cursosImpartidos add constraint idNB foreign key(idNivel) references catalogoNivelCursos(idNivel) on delete cascade on update cascade;



#*************PROCEDIMIENTO PARA REGISTRAR USUARIOS
drop procedure if exists registraUsuario;
delimiter **

create procedure registraUsuario(in idTipoU numeric(1), username varchar(500), pat varchar(500), mat varchar(500), mail varchar(500),tel numeric(13), pass varchar(500),diaN numeric(2), mesN varchar(10),anioN numeric(4),puestoP varchar(50),idInst varchar(30))
begin								
	declare mensaje varchar(1);
    declare identificador int;
    declare existencia int;
    
    set mensaje = "";
    set existencia=(select count(*) from Usuario where correo=mail); 
		
        case(existencia)
			when 1 then
				set mensaje="1"; #devolver uno cuando ya exista el registro
			when 0 then
				set identificador=(select ifnull(max(idUsuario),0)+1 from Usuario);
				insert into Usuario values(identificador,mail,md5(pass),idTipoU,1,null,null,0);
                insert into profesores values (identificador,idInst,username,pat,mat,mail,tel);
				insert into nacimientos values (identificador,diaN,mesN,anioN);
				insert into puestosInstitucionales values(identificador, puestoP);
                if(idTipoU = 2)	then
                insert into adminListos values(identificador,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);#NUEVO CRIXO
                end if;
				set mensaje="0"; #devolver cero si no existe y ya se registro
        end case;
        select mensaje as respuesta;
end;**

delimiter ;

drop procedure if exists registraContratacionActual;
delimiter **

create procedure registraContratacionActual(in idUser numeric(1),catego varchar(50), diaN numeric(2), mesN varchar(10),anioN numeric(4),op numeric(1))
begin								
	declare mensaje varchar(50);
    set mensaje = "";
	case(op)	
		when 1 then
			insert into contratacionActual values(idUser, catego,diaN,mesN,anioN);
			set mensaje="Registrado."; #devolver cero si no existe y ya se registro
		when 2 then
			 update contratacionActual set categoria=catego,diaIngreso=diaN,mesIngreso=mesN,anioIngreso=anioN where idUsuario=idUser;
			 set mensaje="Datos actualizados de forma correcta.";
	end case;
    select mensaje as respuesta;
end;**
delimiter ;

drop procedure if exists cantidadContrataciones;
delimiter **

create procedure cantidadContrataciones(in idUser numeric(1))
begin								
	declare mensaje varchar(50);
	declare cantidad int;
	
	set cantidad=(select count(*) from contratacionActual where idUsuario=idUser);
	select cantidad as respuesta;
	
end;**
delimiter ;

drop procedure if exists registraInstancia;
delimiter **

create procedure registraInstancia(in idUser numeric(1),nameInstancia varchar(50), diaN numeric(2), mesN varchar(10),anioN numeric(4),op numeric(1),idReg numeric(3))
begin								
	declare mensaje varchar(50);
	declare existencia int;
	declare identificador int;
    set mensaje = "";
	
	case(op)	
		when 1 then
			set existencia=(select count(*) from instanciasPertenecientes where idUsuario=idUser and nombreInstancia=nameInstancia and diaIngreso=diaN and mesIngreso=mesN and anioIngreso=anioN);
			if(existencia>0) then
				set mensaje="Ya est&aacute; registrado el curso";
			else
				set identificador=(select ifnull(max(idInstancia),0)+1 from instanciasPertenecientes);
				insert into instanciasPertenecientes values(identificador,idUser,nameInstancia,diaN,mesN,anioN);
				set mensaje="Registrado."; #devolver cero si no existe y ya se registro
			end if;
		when 2 then
			 update instanciasPertenecientes set nombreInstancia=nameInstancia,diaIngreso=diaN,mesIngreso=mesN,anioIngreso=anioN where idInstancia=idReg;
			 set mensaje="Datos actualizados de forma correcta.";
		when 3 then
			delete from instanciasPertenecientes where idUsuario=idUser and nombreInstancia=nameInstancia and diaIngreso=diaN and mesIngreso=mesN and anioIngreso=anioN;
			set mensaje="Eliminado";
	end case;
    select mensaje as respuesta;
end;**
delimiter ;


drop procedure if exists cantidadInstancias;
delimiter **
create procedure cantidadInstancias(in idUser numeric(1))
begin								
	declare mensaje varchar(50);
	declare cantidad int;
	
	set cantidad=(select count(*) from instanciasPertenecientes where idUsuario=idUser);
	select cantidad as respuesta;
	
end;**
delimiter ;


drop procedure if exists registraCursosImpartidos;
delimiter **

create procedure registraCursosImpartidos(in idUser numeric(3),idPer numeric(1),idNiv numeric(2),nombreC varchar(100),tipoC varchar(50),horasT numeric(5),op numeric(1),idReg numeric(3))
begin								
	declare mensaje varchar(50);
	declare existencia int;
	declare identificador int;
    set mensaje = "";
	
	case(op)	
		when 1 then
			set existencia=(select count(*) from cursosImpartidos where idUsuario=idUser and idNivel=idNiv and idPeriodo=idPer and nombreCurso=nombreC and tipo=tipoC and horasTotales=horasT);
			if(existencia>0) then
				set mensaje="Ya est&aacute; registrado el curso";
			else
				set identificador=(select ifnull(max(idCurso),0)+1 from cursosImpartidos);
				insert into cursosImpartidos values(identificador,idUser,idPer,idNiv,nombreC,tipoC,horasT);
				set mensaje="Registrado."; #devolver cero si no existe y ya se registro
			end if;
		when 2 then
			 update cursosImpartidos set idUsuario=idUser,idNivel=idNiv,idPeriodo=idPer,nombreCurso=nombreC,tipo=tipoC,horasTotales=horasT where idCurso=idReg;
			 set mensaje="Datos actualizados de forma correcta.";
		when 3 then
			delete from cursosImpartidos where idUsuario=idUser and idNivel=idNiv and idPeriodo=idPer and nombreCurso=nombreC and tipo=tipoC and horasTotales=horasT;
			set mensaje="Eliminado";
	end case;
    select mensaje as respuesta;
end;**
delimiter ;


drop procedure if exists cantidadCursos;
delimiter **
create procedure cantidadCursos(in idUser numeric(1))
begin								
	declare mensaje varchar(50);
	declare cantidad int;
	
	set cantidad=(select count(*) from cursosImpartidos where idUsuario=idUser);
	select cantidad as respuesta;
	
end;**
delimiter ;

drop procedure if exists ActualizaUsuario;
delimiter **

create procedure ActualizaUsuario(in idUser numeric(3), username varchar(500), pat varchar(500), mat varchar(500), mail varchar(500),tel numeric(13),diaN numeric(2), mesN varchar(10),anioN numeric(4),puestoP varchar(50),idInst varchar(30))
begin								
	declare mensaje varchar(12);    
    set mensaje = "";
		update profesores set idInstitucion=idInst,nombre=username,paterno=pat,materno=mat,correo=mail,telefono=tel where idUsuario=idUser;
		update nacimientos set dia=diaN,mes=mesN,anio=anioN where idUsuario=idUser;
		update puestosInstitucionales set puesto=puestoP where idUsuario=idUser;
		update usuario set correo=mail where  idUsuario=idUser;
		set mensaje="Actualizado";
    select mensaje as respuesta;
end;**

delimiter ;

drop procedure if exists cantidadFormacion;
delimiter **
create procedure cantidadFormacion(in idUser numeric(1))
begin								
	declare mensaje varchar(50);
	declare cantidad int;
	
	set cantidad=(select count(*) from formacionAcademica where idUsuario=idUser);
	select cantidad as respuesta;
	
end;**
delimiter ;


drop procedure if exists registraFormacion;
delimiter **
 
create procedure registraFormacion(idUser numeric(3),niv varchar(50),nombreC varchar(50),institucionA varchar(50),paisA varchar(50),anioA numeric(4),cedulaA varchar(50),op numeric(1),idReg numeric(3))
begin								
	declare mensaje varchar(50);
	declare existencia int;
	declare identificador int;
    set mensaje = "";
	
	case(op)	
		when 1 then
			set existencia=(select count(*) from formacionAcademica where idUsuario=idUser and nivel=niv and nombre=nombreC and institucion=institucionA and pais=paisA and anio=anioA and cedulaP=cedulaA);
			if(existencia>0) then
				set mensaje="Este registro ya existe";
			else
				set identificador=(select ifnull(max(idFormacion),0)+1 from formacionAcademica);
				insert into formacionAcademica values(identificador,idUser,niv,nombreC,institucionA,paisA,anioA,cedulaA);
				set mensaje="Registrado.";
			end if;
		when 2 then
			 update formacionAcademica set nivel=niv,nombre=nombreC,institucion=institucionA,pais=paisA,anio=anioA,cedulaP=cedulaA where idFormacion=idReg;
			 set mensaje="Datos actualizados de forma correcta.";
		when 3 then
			delete from formacionAcademica where idUsuario=idUser and nivel=niv and nombre=nombreC and institucion=institucionA and pais=paisA and anio=anioA and cedulaP=cedulaA;
			set mensaje="Eliminado";
	end case;
    select mensaje as respuesta;
end;**
delimiter ;


drop procedure if exists cantidadExpProfesionalNA;
delimiter **
create procedure cantidadExpProfesionalNA(in idUser numeric(1))
begin								
	declare mensaje varchar(50);
	declare cantidad int;
	
	set cantidad=(select count(*) from experiencianoacademica where idUsuario=idUser);
	select cantidad as respuesta;
	
end;**
delimiter ;



drop procedure if exists expProfesionalNA;
delimiter **

create procedure expProfesionalNA(idUser numeric(3),actividadP varchar(50),empresaP varchar(50),anioInicioP numeric(4),mesInicioP varchar(10),anioFinalP numeric(4),mesFinalP varchar(10),op numeric(1), idExp numeric(3))
begin								
	declare mensaje varchar(50);
	declare existencia int;
	declare identificador int;
    set mensaje = "";
	
	case(op)	
		when 1 then #REGISTRO DE FORMACION NA
			set existencia=(select count(*) from experiencianoacademica where idUsuario=idUser and actividad=actividadP and empresa=empresaP and anioInicio=anioInicioP and mesinicio=mesInicioP and anioFinal=anioFinalP and mesFinal=mesFinalP);
			if(existencia>0) then
				set mensaje="Este registro ya existe";
			else
				set identificador=(select ifnull(max(idExperiencia),0)+1 from experiencianoacademica);
				insert into experiencianoacademica values(identificador,idUser,actividadP ,empresaP ,anioInicioP ,mesInicioP ,anioFinalP ,mesFinalP);
				set mensaje="Registrado.";
			end if;
		when 2 then
			 update experiencianoacademica set actividad=actividadP,empresa=empresaP,anioInicio=anioInicioP,mesinicio=mesInicioP,anioFinal=anioFinalP,mesFinal=mesFinalP where idExperiencia=idExp and idUsuario=idUser;
			 set mensaje="Datos actualizados de forma correcta.";
		when 3 then
			delete from experiencianoacademica where idUsuario=idUser and actividad=actividadP and empresa=empresaP and anioInicio=anioInicioP and mesinicio=mesInicioP and anioFinal=anioFinalP and mesFinal=mesFinalP;
			set mensaje="Eliminado";
	end case;
    select mensaje as respuesta;
end;**
delimiter ;





drop procedure if exists cantidadGestion;
delimiter **
create procedure cantidadGestion(in idUser numeric(1))
begin								
	declare mensaje varchar(50);
	declare cantidad int;
	
	set cantidad=(select count(*) from gestionacademica where idUsuario=idUser);
	select cantidad as respuesta;
	
end;**
delimiter ;



drop procedure if exists registroGestionAcademica;
delimiter **

create procedure registroGestionAcademica(idUser numeric(3),actividadP varchar(50),institucionP varchar(50),anioInicioP numeric(4),mesInicioP varchar(10),anioFinalP numeric(4),mesFinalP varchar(10),op numeric(1), idGestionP numeric(3))
begin								
	declare mensaje varchar(50);
	declare existencia int;
	declare identificador int;
    set mensaje = "";
	
	case(op)	
		when 1 then #REGISTRO DE FORMACION NA
			set existencia=(select count(*) from gestionacademica where idUsuario=idUser and actividad=actividadP and institucion=institucionP and anioInicio=anioInicioP and mesinicio=mesInicioP and anioFinal=anioFinalP and mesFinal=mesFinalP);
			if(existencia>0) then
				set mensaje="Este registro ya existe";
			else
				set identificador=(select ifnull(max(idGestion),0)+1 from gestionacademica);
				insert into gestionacademica values(identificador,idUser,actividadP , institucionP,anioInicioP ,mesInicioP ,anioFinalP ,mesFinalP);
				set mensaje="Registrado.";
			end if;
		when 2 then
			 update gestionacademica set actividad=actividadP,institucion=institucionP,anioInicio=anioInicioP,mesinicio=mesInicioP,anioFinal=anioFinalP,mesFinal=mesFinalP where idGestion=idGestionP;
			 set mensaje="Datos actualizados de forma correcta.";
		when 3 then
			delete from gestionAcademica where idUsuario=idUser and actividad=actividadP and institucion=institucionP and anioInicio=anioInicioP and mesinicio=mesInicioP and anioFinal=anioFinalP and mesFinal=mesFinalP;
			set mensaje="Eliminado";
	end case;
    select mensaje as respuesta;
end;**
delimiter ;

drop procedure if exists cantidadGestion;
delimiter **
create procedure cantidadGestion(in idUser numeric(1))
begin								
	declare mensaje varchar(50);
	declare cantidad int;
	
	set cantidad=(select count(*) from gestionacademica where idUsuario=idUser);
	select cantidad as respuesta;
	
end;**
delimiter ;


drop procedure if exists registraMembresia;
delimiter **

create procedure registraMembresia(idUserP numeric(3),organismoP varchar(50),aniosP numeric(4), nivelParticipacionP numeric(4), informacionRelevanteP varchar(500),op numeric(1), idMembresiaP numeric(3))
begin								
	declare mensaje varchar(50);
	declare existencia int;
	declare identificador int;
    set mensaje = "";
	
	case(op)	
		when 1 then #REGISTRO 
			set existencia=(select count(*) from membresias where idUsuario=idUserP and organismo=organismoP and anios=aniosP and nivelParticipacion=nivelParticipacionP and informacionRelevante=informacionRelevanteP );
			if(existencia>0) then
				set mensaje="Este registro ya existe";
			else
				set identificador=(select ifnull(max(idMembresia),0)+1 from membresias);
				insert into membresias values(identificador,idUserP,organismoP , aniosP,nivelParticipacionP ,informacionRelevanteP);
				set mensaje="Registrado.";
			end if;
		when 2 then
			 update membresias set organismo=organismoP,anios=aniosP,nivelParticipacion=nivelParticipacionP,informacionRelevante=informacionRelevanteP where idMembresia=idMembresiaP;
			 set mensaje="Datos actualizados de forma correcta.";
		when 3 then
			delete from membresias where idUsuario=idUserP and organismo=organismoP and anios=aniosP and nivelParticipacion=nivelParticipacionP and informacionRelevante=informacionRelevanteP;
			set mensaje="Eliminado";
	end case;
    select mensaje as respuesta;
end;**
delimiter ;

drop procedure if exists cantidadMembresia;
delimiter **
create procedure cantidadMembresia(in idUser numeric(1))
begin								
	declare mensaje varchar(50);
	declare cantidad int;
	
	set cantidad=(select count(*) from membresias where idUsuario=idUser);
	select cantidad as respuesta;
	
end;**
delimiter ;



drop procedure if exists cambioClave;
delimiter **
create procedure cambioClave(in idUser numeric(1), claveActual varchar(50), clavenueva varchar(50))
begin			
	declare	   eval1 int;
	declare mensaje varchar(1);
	
	set eval1=(select  count(*) from Usuario where idUsuario=idUser and contrasenia=md5(claveActual));
	
	IF eval1 = 1 THEN 
		update Usuario set contrasenia=md5(clavenueva) where idUsuario=idUser;
		set mensaje="1";
    ELSE
		set mensaje="0"; 
    END IF;
	select mensaje as respuesta;
end;**
delimiter ;


######Procedures crixo
drop procedure if exists sp_capacitacionDocente;
delimiter **
create procedure sp_capacitacionDocente(idUsr numeric(3),tipoCap varchar(50),institucionC varchar(50),paisC varchar(50),anioC numeric(4),horaC numeric(4))
begin
declare msj nvarchar(50);
declare idCap int;
if(tipoCap = '' || institucionC = '' || paisC = '' || anioC = '' || horaC = '')	then
set msj = 'Faltan llenar campos, por favor verifique!';
else
set idCap = (select ifnull(max(idCapacitacion),0)+1 from capacitacionDocente);
insert into capacitacionDocente(idCapacitacion,idUsuario,tipoC,institucion,pais,anio,horas) 
values (idCap,idUsr,tipoCap,institucionC,paisC,anioC,horaC);
set msj = 'Capacitación agregada exitosamente!';
end if;

select msj as notificacion;
end;**
delimiter ;



DROP PROCEDURE IF EXISTS sp_actualizaActDis;
delimiter **
CREATE PROCEDURE sp_actualizaActDis (IN idAct INT(3), IN idUsr INT(3), IN tipoAc VARCHAR(50), IN institucionAct VARCHAR(50), IN paisAct VARCHAR(59), IN anioAct INT(4), IN horasAct INT(4))  begin 
    declare msg nvarchar(100);
    declare existe int;
    if(idAct = "" || idUsr = "" || tipoAc = "" || institucionAct = "" || paisAct = "" || anioAct = "" || horasAct = "")then
set msg = 'Faltan campos por llenar';
else
set existe = (select count(*) from actualizaciond where idAct = idActualizacion );
    
    if(existe = 1)	then
		update actualizaciond set tipoAct = tipoAc where idAct = idActualizacion;

            update actualizaciond set institucion = institucionAct where idAct = idActualizacion;
            update actualizaciond set pais = paisAct where idAct = idActualizacion;
            update actualizaciond set anio = anioAct where idAct = idActualizacion;
            update actualizaciond set horas = horasAct where idAct = idActualizacion;

    set msg = 'Actualizaci&oacute;n correcta';
    else
    set msg = 'El usuario no existe';
    end if;
end if;
    
    select msg as notificacion;
    end;**
    delimiter ;




DROP PROCEDURE IF EXISTS sp_actualizaCapacitacion;
delimiter **
CREATE PROCEDURE sp_actualizaCapacitacion (IN idCap INT(3), IN idUsr INT(3), IN tipoCap VARCHAR(50), IN instCap VARCHAR(50), IN paisCap VARCHAR(59), IN anioCap INT(4), IN horaCap INT(4)) 
begin 
    declare msg nvarchar(80);
    declare existe int;
    if(idCap = "" || idUsr = "" || tipoCap = "" || instCap = "" || paisCap = "" || anioCap = "" || horaCap = "")then
set msg = 'Faltan campos por llenar';
else
set existe = (select count(*) from capacitaciondocente where idCap = idCapacitacion );
    
    if(existe = 1)	then
		update capacitaciondocente set tipoC = tipoCap where idCap = idCapacitacion; 

            update capacitaciondocente set institucion = instCap where idCap = idCapacitacion;
            update capacitaciondocente set pais = paisCap where idCap = idCapacitacion;
            update capacitaciondocente set anio = anioCap where idCap = idCapacitacion;
            update capacitaciondocente set horas = horaCap where idCap = idCapacitacion;

    set msg = 'Actualizacion correcta';
    else
    set msg = 'El usuario no existe';
    end if;
end if;
    
    select msg as notificacion;
    end;**
    delimiter ;
    
    
DROP PROCEDURE IF EXISTS sp_agregaActualizacionDis;
delimiter **
CREATE PROCEDURE sp_agregaActualizacionDis (IN idUsr INT(3), IN tipoAc VARCHAR(50), IN institucionAc VARCHAR(50), IN paisAc VARCHAR(59), IN anioAc INT(4), IN horasAc INT(4))
begin
declare msj nvarchar(130);
declare idAct int;
if(tipoAc = '' || institucionAc = '' || paisAc = '' || anioAc = '' || horasAc = '')	then
set msj = 'Faltan llenar campos, por favor verifique!';
else
set idAct = (select ifnull(max(idActualizacion),0)+1 from actualizaciond);
insert into actualizaciond(idActualizacion,idUsuario,tipoAct,institucion,pais,anio,horas) 
values (idAct,idUsr,tipoAc,institucionAc,paisAc,anioAc,horasAc);
set msj = 'Actualizaci&oacute;n disciplinar agregada exitosamente!';
end if;

select msj as notificacion;
end;**
delimiter ;

DROP PROCEDURE IF EXISTS sp_borraCapacitacion;
delimiter **
CREATE PROCEDURE sp_borraCapacitacion (IN idCap INT(3))  begin
    declare msg nvarchar(60);
    declare existe int;
    set existe = (select count(*) from capacitaciondocente where idCap = idCapacitacion);
    if(existe = 1)	then
    delete from capacitaciondocente where idCap = idCapacitacion;
    set msg = 'capacitaci&oacute;n eliminada';
    else 
    set msg = 'no existe la capacitaci&oacute;n';
    end if;
    select msg as notificacion;
    end;**
    delimiter ;


DROP PROCEDURE IF EXISTS sp_eliminaActDis;
delimiter **
CREATE PROCEDURE sp_eliminaActDis (IN idAct INT(3))  begin
    declare msg nvarchar(100);
    declare existe int;
    set existe = (select count(*) from actualizaciond where idAct = idActualizacion);
    if(existe = 1)	then
    delete from actualizaciond where idAct = idActualizacion;
    set msg = 'Actualizaci&oacute;n eliminada';
    else 
    set msg = 'no existe la capacitaci&oacute;n';
    end if;
    select msg as notificacion;
    end;**

DELIMITER ;



##PROCEDURES ADMINISTRADOR##

drop procedure if exists sp_verificaFormularios;

delimiter **
create procedure sp_verificaFormularios(in idUsr numeric(3))
begin
	declare existe int;
    declare existAD int;
    declare existCI int;
    declare existGa int;
    declare existPI int;
    declare existPR int;
    declare existM int;
    declare existEDI int;
    declare existEA int;
    declare existP int;
    declare existN int;
    declare existLP int;
    declare existFA int;
    declare existIP int;
    declare existCA int;
    
    
    declare msj nvarchar(60);
    
    set existe = (select count(*) from capacitaciondocente where idUsuario=idUsr);
    set existAD = (select count(*) from actualizaciond where idUsuario = idUsr);
    set existCI = (select count(*) from cursosimpartidos where idUsuario = idUsr);
    set existGa = (select count(*) from gestionacademica where idUsuario = idUsr);
    set existPI = (select count(*) from puestosinstitucionales where idUsuario = idUsr);
    set existPR = (select count(*) from productosrelevantes where idUsuario = idUsr);
    set existM = (select count(*) from membresias where idUsuario = idUsr);
    set existEDI = (select count(*) from experienciadisenioingenieril where idUsuario = idUsr);
    set existEA = (select count(*) from experiencianoacademica where idUsuario = idUsr);
    set existP = (select count(*) from premios where idUsuario = idUsr);
    set existN = (select count(*) from nacimientos where idUsuario = idUsr);
    set existLP = (select count(*) from logrosprofesionales where idUsuario = idUsr);
    set existFA = (select count(*) from formacionacademica where idUsuario = idUsr);
    set existIP = (select count(*) from instanciaspertenecientes where idUsuario = idUsr);
    set existCA = (select count(*) from contratacionactual where idUsuario = idUsr);
    
    
	if(existe >= 1)	then
    update adminListos set CP = 1 where idUsuario = idUsr;
    set msj = 'Actualización realizada';
    else
    update adminListos set CP = 0 where idUsuario = idUsr;
    set msj = 'No existe';
    end if;
    
    if(existAD >= 1)	then
    update adminListos set AD = 1 where idUsuario = idUsr;
    set msj = 'Actualizacion AD';
    else
    update adminListos set AD = 0 where idUsuario = idUsr;
	set msj = 'no hay AD';
	end if;
    
    if(existCI >= 1)	then
    update adminListos set CI = 1 where idUsuario = idUsr;
    set msj = 'Actualizacion CI';
    else
    update adminListos set CI = 0 where idUsuario = idUsr;
    set msj = 'no hay CI';
    end if;
    
    if(existGA >= 1)	then
    update adminListos set GA = 1 where idUsuario = idUsr;
    set msj = 'Actualizacion GA';
    else
    update adminListos set GA = 0 where idUsuario = idUsr;
    set msj = 'no hay GA';
    end if;
    
    if(existPI >= 1)	then
    update adminListos set PI = 1 where idUsuario = idUsr;
    set msj = 'Actualizacion PI';
    else
    update adminListos set PI = 0 where idUsuario = idUsr;
    set msj = 'no hay PI';
    end if;
    
    if(existPR >= 1)	then
    update adminListos set PR = 1 where idUsuario = idUsr;
    set msj = 'Actualizacion PR';
    else
    update adminListos set PR = 0 where idUsuario = idUsr;
    set msj = 'no hay PR';
    end if;
    
    if(existM >= 1)	then
    update adminListos set M = 1 where idUsuario = idUsr;
    set msj = 'Actualizacion M';
    else
    update adminListos set M = 0 where idUsuario = idUsr;
    set msj = 'no hay M';
    end if;
    
    if(existEDI >= 1)	then
    update adminListos set EDI = 1 where idUsuario = idUsr;
    set msj = 'Actualizacion EDI';
    else
    update adminListos set EDI = 0 where idUsuario = idUsr;
    set msj = 'no hay EDI';
    end if;
    
    if(existEA >= 1)	then
    update adminListos set EA = 1 where idUsuario = idUsr;
    set msj = 'Actualizacion EA';
    else
    update adminListos set EA = 0 where idUsuario = idUsr;
    set msj = 'no hay EA';
    end if;
    
    if(existP >= 1)	then
    update adminListos set P = 1 where idUsuario = idUsr;
    set msj = 'Actualizacion P';
    else
    update adminListos set P = 0 where idUsuario = idUsr;
    set msj = 'no hay P';
    end if;
    
    if(existN >= 1)	then
    update adminListos set N = 1 where idUsuario = idUsr;
    set msj = 'Actualizacion N';
    else
    update adminListos set N = 0 where idUsuario = idUsr;
    set msj = 'no hay N';
    end if;
    
    if(existLP >= 1)	then
    update adminListos set LP = 1 where idUsuario = idUsr;
    set msj = 'Actualizacion LP';
    else
    update adminListos set LP = 0 where idUsuario = idUsr;
    set msj = 'no hay LP';
    end if;
    
    if(existFA >= 1)	then
    update adminListos set FA = 1 where idUsuario = idUsr;
    set msj = 'Actualizacion FA';
    else
    update adminListos set FA = 0 where idUsuario = idUsr;
    set msj = 'no hay FA';
    end if;
    
    if(existIP >= 1)	then
    update adminListos set IP = 1 where idUsuario = idUsr;
    set msj = 'Actualizacion IP';
    else
    update adminListos set IP = 0 where idUsuario = idUsr;
    set msj = 'no hay IP';
    end if;
    
    if(existCA >= 1)	then
    update adminListos set CA = 1 where idUsuario = idUsr;
    set msj = 'Actualizacion CA';
    else
    update adminListos set CA = 0 where idUsuario = idUsr;
    set msj = 'no hay CA';
    end if;
    
    
    select msj as notificacion;
end;**
delimiter ;

###PROCEDIMIENTO PARA REGISTRAR ADMINISTRADOR
drop procedure if exists sp_registraAdmin;
delimiter **
create procedure sp_registraAdmin(in corre varchar(50),psw varchar(50),token numeric(3))
begin
declare idUsr int;
declare msj nvarchar(80);
declare existe int;

set existe = (select count(*) from usuario where correo = corre); 
set idUsr = (select ifnull(max(idUsuario),0)+1 from usuario);
if(existe = 0)	then
if(corre = "" || psw = "" || token = "") then
	set msj = 'faltan campos por llenar';
    else
	if(token = 123)then
	#insert into usuario values (idUsr,corre,md5(psw),1);
    insert into Usuario values(idUsr,corre,md5(psw),1,1,null,null,0);
    set msj = 'Administrador agregado con exito';
		else
        set msj = 'token incorrecto';
	end if;
    end if;

else
	set msj = 'El administrador ya existe';
end if;
select msj as notificacion;
end;**
delimiter ;

drop procedure if exists registraPremio;
delimiter **
 
create procedure registraPremio(idUser numeric(3),ano varchar(50),nombreC varchar(50),descri varchar(50),idReg numeric(3),op int)
begin								
	declare mensaje varchar(50);
	declare existencia int;
	declare identificador int;
    set mensaje = "";
	
	case(op)	
		when 1 then
			set existencia=(select count(*) from premios where idUsuario=idUser and anio=ano and nombre=nombreC and descripcion=descri);
			if(existencia>0) then
				set mensaje="Este registro ya existe";
			else
				set identificador=(select ifnull(max(idPremio),0)+1 from premios);
				insert into premios values(identificador,idUser,ano,nombreC,descri);
				set mensaje="Registrado.";
			end if;
		when 2 then
			 update premios set anio=ano,nombre=nombreC,descripcion=descri where idPremio=idReg;
			 set mensaje="Datos actualizados de forma correcta.";
		when 3 then
			delete from premios where idUsuario=idUser and anio=ano and nombre=nombreC and descripcion=descri;
			set mensaje="Eliminado";
	end case;
    select mensaje as respuesta;
end;**
delimiter ;

drop procedure if exists registraLogro;
delimiter **
create procedure registraLogro(idUser numeric(3),ano varchar(50),nombreC varchar(50),descri varchar(50),idReg numeric(3),op int)
begin								
	declare mensaje varchar(50);
	declare existencia int;
	declare identificador int;
    set mensaje = "";
	
	case(op)	
		when 1 then
			set existencia=(select count(*) from logrosprofesionales where idUsuario=idUser and anio=ano and nombre=nombreC and descripcion=descri);
			if(existencia>0) then
				set mensaje="Este registro ya existe";
			else
				set identificador=(select ifnull(max(idLogro),0)+1 from logrosprofesionales);
				insert into logrosprofesionales values(identificador,idUser,ano,nombreC,descri);
				set mensaje="Registrado.";
			end if;
		when 2 then
			 update logrosprofesionales set anio=ano,nombre=nombreC,descripcion=descri where idLogro=idReg;
			 set mensaje="Datos actualizados de forma correcta.";
		when 3 then
			delete from logrosprofesionales where idUsuario=idUser and anio=ano and nombre=nombreC and descripcion=descri;
			set mensaje="Eliminado";
	end case;
    select mensaje as respuesta;
end;**
delimiter ;


drop procedure if exists registraEDI;
delimiter **
create procedure registraEDI(idUser numeric(3),orga varchar(50),luga varchar(50),periodo varchar(50),exp varchar(50),idReg numeric(3),op int)
                
begin								
	declare mensaje varchar(50);
	declare existencia int;
	declare identificador int;
    set mensaje = "";
	
	case(op)	
		when 1 then
			set existencia=(select count(*) from experienciadisenioingenieril where idUsuario=idUser and tipoExperiencia=orga and lugar=luga and numeroAnios=periodo and infAdicionar=exp);
			if(existencia>0) then
				set mensaje="Este registro ya existe";
			else
				set identificador=(select ifnull(max(idExperienciaIng),0)+1 from experienciadisenioingenieril);
				insert into experienciadisenioingenieril values(identificador,idUser,orga,luga,periodo,exp);
				set mensaje="Registrado.";
			end if;
		when 2 then
			 update experienciadisenioingenieril set tipoExperiencia=orga,lugar=luga,numeroAnios=periodo,infAdicionar=exp where idExperienciaIng=idReg;
			 set mensaje="Datos actualizados de forma correcta.";
		when 3 then
			delete from experienciadisenioingenieril where idUsuario=idUser and tipoExperiencia=orga and lugar=luga and numeroAnios=periodo and infAdicionar=exp;
			set mensaje="Eliminado";
	end case;
    select mensaje as respuesta;
end;**
delimiter ;


drop procedure if exists registraParticipacion;
delimiter **
 
create procedure registraParticipacion(idUser numeric(3),nombreC varchar(50),descri varchar(50),idReg numeric(3),op int)
begin								
	declare mensaje varchar(50);
	declare existencia int;
	declare identificador int;
    set mensaje = "";
	
	case(op)	
		when 1 then
			set existencia=(select count(*) from participacionpe where idUsuario=idUser and nombre=nombreC and descripcion=descri);
			if(existencia>0) then
				set mensaje="Este registro ya existe";
			else
				set identificador=(select ifnull(max(idParticipacion),0)+1 from participacionpe);
				insert into participacionpe values(identificador,idUser,nombreC,descri);
				set mensaje="Registrado.";
			end if;
		when 2 then
			 update participacionpe set nombre=nombreC,descripcion=descri where idParticipacion=idReg;
			 set mensaje="Datos actualizados de forma correcta.";
		when 3 then
			delete from participacionpe where idUsuario=idUser and nombre=nombreC and descripcion=descri;
			set mensaje="Eliminado";
	end case;
    select mensaje as respuesta;
end;**
delimiter ;

drop procedure if exists registraProducto;
delimiter **
 
create procedure registraProducto(idUser numeric(3),ano varchar(50),nombreC varchar(50),descri varchar(50),idReg numeric(3),op int)
begin								
	declare mensaje varchar(50);
	declare existencia int;
	declare identificador int;
    set mensaje = "";
	
	case(op)	
		when 1 then
			set existencia=(select count(*) from productosrelevantes where idUsuario=idUser and anio=ano and nombre=nombreC and descripcion=descri);
			if(existencia>0) then
				set mensaje="Este registro ya existe";
			else
				set identificador=(select ifnull(max(idProducto),0)+1 from productosrelevantes);
				insert into productosrelevantes values(identificador,idUser,ano,nombreC,descri);
				set mensaje="Registrado.";
			end if;
		when 2 then
			 update productosrelevantes set anio=ano,nombre=nombreC,descripcion=descri where idProducto=idReg;
			 set mensaje="Datos actualizados de forma correcta.";
		when 3 then
			delete from productosrelevantes where idUsuario=idUser and anio=ano and nombre=nombreC and descripcion=descri;
			set mensaje="Eliminado";
	end case;
    select mensaje as respuesta;
end;**
delimiter ;


drop procedure if exists cantidadEDI;
delimiter **
create procedure cantidadEDI(in idUser numeric(1))
begin								
	declare mensaje varchar(50);
	declare cantidad int;
	
	set cantidad=(select count(*) from experienciadisenioingenieril where idUsuario=idUser);
	select cantidad as respuesta;
	
end;**
delimiter ;


drop procedure if exists cantidadLogro;
delimiter **
create procedure cantidadLogro(in idUser numeric(1))
begin								
	declare mensaje varchar(50);
	declare cantidad int;
	
	set cantidad=(select count(*) from logrosProfesionales where idUsuario=idUser);
	select cantidad as respuesta;
	
end;**
delimiter ;


drop procedure if exists cantidadParticipacion;
delimiter **
create procedure cantidadParticipacion(in idUser numeric(1))
begin								
	declare mensaje varchar(50);
	declare cantidad int;
	
	set cantidad=(select count(*) from participacionpe where idUsuario=idUser);
	select cantidad as respuesta;
	
end;**
delimiter ;


drop procedure if exists cantidadProducto;
delimiter **
create procedure cantidadProducto(in idUser numeric(1))
begin								
	declare mensaje varchar(50);
	declare cantidad int;
	
	set cantidad=(select count(*) from productosrelevantes where idUsuario=idUser);
	select cantidad as respuesta;
	
end;**
delimiter ;
