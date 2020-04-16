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
	contrasenia varchar(150) not null,
	activacion int(11) NOT NULL DEFAULT '1',
	token varchar(40) NOT NULL,
	token_password varchar(100) DEFAULT NULL,
    password_request int(11) DEFAULT '0',
	idTipo numeric(1) not null
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


create table nacimientos(
	idUsuario numeric(3) not null,
	dia numeric(2) not null,
    mes varchar(10),
    anio numeric(4)
);

alter table nacimientos add constraint idProf2 foreign key(idUsuario) references profesores(idUsuario) on delete cascade on update cascade;


INSERT INTO usuario values(2,'$2y$10$bbLJmO7MXHx3IAWlg821keXHLQ',1,'NULL','NULL',0,2);
INSERT INTO profesores values(2,2,'israel','jimenez','lopez','wy_darkmagician@hotmail.com',5570589708);


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
	nombre varchar(100) not null,
    lugar varchar(50) not null,
	anios numeric (4) not null #preguntar a que se refiere

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
    set existencia=(select count(*) from profesores where correo=mail); 
		
        case(existencia)
			when 1 then
				set mensaje="1"; #devolver uno cuando ya exista el registro
			when 0 then
				set identificador=(select ifnull(max(idUsuario),0)+1 from profesores);
				insert into Usuario values(identificador,md5(pass),idTipoU);
                insert into profesores values (identificador,idInst,username,pat,mat,mail,tel);
				insert into nacimientos values (identificador,diaN,mesN,anioN);
				insert into puestosInstitucionales values(identificador, puestoP);
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


drop procedure if exists cantidadPremio;
delimiter **
create procedure cantidadPremio(in idUser numeric(1))
begin								
	declare mensaje varchar(50);
	declare cantidad int;
	
	set cantidad=(select count(*) from premios where idUsuario=idUser);
	select cantidad as respuesta;
	
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

drop procedure if exists registraLogro;
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
