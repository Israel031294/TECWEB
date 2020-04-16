-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 29-05-2019 a las 16:28:25
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `curriculum`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `ActualizaUsuario`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizaUsuario` (IN `idUser` NUMERIC(3), `username` VARCHAR(500), `pat` VARCHAR(500), `mat` VARCHAR(500), `mail` VARCHAR(500), `tel` NUMERIC(13), `diaN` NUMERIC(2), `mesN` VARCHAR(10), `anioN` NUMERIC(4), `puestoP` VARCHAR(50), `idInst` VARCHAR(30))  begin								
	declare mensaje varchar(12);    
    set mensaje = "";
		update profesores set idInstitucion=idInst,nombre=username,paterno=pat,materno=mat,correo=mail,telefono=tel where idUsuario=idUser;
		update nacimientos set dia=diaN,mes=mesN,anio=anioN where idUsuario=idUser;
		update puestosInstitucionales set puesto=puestoP where idUsuario=idUser;
		set mensaje="Actualizado";
    select mensaje as respuesta;
end$$

DROP PROCEDURE IF EXISTS `cantidadContrataciones`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `cantidadContrataciones` (IN `idUser` NUMERIC(1))  begin								
	declare mensaje varchar(50);
	declare cantidad int;
	
	set cantidad=(select count(*) from contratacionActual where idUsuario=idUser);
	select cantidad as respuesta;
	
end$$

DROP PROCEDURE IF EXISTS `cantidadCursos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `cantidadCursos` (IN `idUser` NUMERIC(1))  begin								
	declare mensaje varchar(50);
	declare cantidad int;
	
	set cantidad=(select count(*) from cursosImpartidos where idUsuario=idUser);
	select cantidad as respuesta;
	
end$$

DROP PROCEDURE IF EXISTS `cantidadFormacion`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `cantidadFormacion` (IN `idUser` NUMERIC(1))  begin								
	declare mensaje varchar(50);
	declare cantidad int;
	
	set cantidad=(select count(*) from formacionAcademica where idUsuario=idUser);
	select cantidad as respuesta;
	
end$$

DROP PROCEDURE IF EXISTS `cantidadInstancias`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `cantidadInstancias` (IN `idUser` NUMERIC(1))  begin								
	declare mensaje varchar(50);
	declare cantidad int;
	
	set cantidad=(select count(*) from instanciasPertenecientes where idUsuario=idUser);
	select cantidad as respuesta;
	
end$$

DROP PROCEDURE IF EXISTS `registraContratacionActual`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registraContratacionActual` (IN `idUser` NUMERIC(1), `catego` VARCHAR(50), `diaN` NUMERIC(2), `mesN` VARCHAR(10), `anioN` NUMERIC(4), `op` NUMERIC(1))  begin								
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
end$$

DROP PROCEDURE IF EXISTS `registraCursosImpartidos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registraCursosImpartidos` (IN `idUser` NUMERIC(3), `idPer` NUMERIC(1), `idNiv` NUMERIC(2), `nombreC` VARCHAR(100), `tipoC` VARCHAR(50), `horasT` NUMERIC(5), `op` NUMERIC(1), `idReg` NUMERIC(3))  begin								
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
end$$

DROP PROCEDURE IF EXISTS `registraFormacion`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registraFormacion` (`idUser` NUMERIC(3), `niv` VARCHAR(50), `nombreC` VARCHAR(50), `institucionA` VARCHAR(50), `paisA` VARCHAR(50), `anioA` NUMERIC(4), `cedulaA` VARCHAR(50), `op` NUMERIC(1), `idReg` NUMERIC(3))  begin								
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
end$$

DROP PROCEDURE IF EXISTS `registraInstancia`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registraInstancia` (IN `idUser` NUMERIC(1), `nameInstancia` VARCHAR(50), `diaN` NUMERIC(2), `mesN` VARCHAR(10), `anioN` NUMERIC(4), `op` NUMERIC(1), `idReg` NUMERIC(3))  begin								
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
end$$

DROP PROCEDURE IF EXISTS `registraUsuario`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registraUsuario` (IN `idTipoU` NUMERIC(1), `username` VARCHAR(500), `pat` VARCHAR(500), `mat` VARCHAR(500), `mail` VARCHAR(500), `tel` NUMERIC(13), `pass` VARCHAR(500), `diaN` NUMERIC(2), `mesN` VARCHAR(10), `anioN` NUMERIC(4), `puestoP` VARCHAR(50), `idInst` VARCHAR(30))  begin								
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
end$$

DROP PROCEDURE IF EXISTS `sp_actualizaActDis`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizaActDis` (IN `idAct` INT(3), IN `idUsr` INT(3), IN `tipoAc` VARCHAR(50), IN `institucionAct` VARCHAR(50), IN `paisAct` VARCHAR(59), IN `anioAct` INT(4), IN `horasAct` INT(4))  begin 
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
    end$$

DROP PROCEDURE IF EXISTS `sp_actualizaCapacitacion`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizaCapacitacion` (IN `idCap` INT(3), IN `idUsr` INT(3), IN `tipoCap` VARCHAR(50), IN `instCap` VARCHAR(50), IN `paisCap` VARCHAR(59), IN `anioCap` INT(4), IN `horaCap` INT(4))  begin 
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
    end$$

DROP PROCEDURE IF EXISTS `sp_agregaActualizacionDis`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_agregaActualizacionDis` (IN `idUsr` INT(3), IN `tipoAc` VARCHAR(50), IN `institucionAc` VARCHAR(50), IN `paisAc` VARCHAR(59), IN `anioAc` INT(4), IN `horasAc` INT(4))  begin
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
end$$

DROP PROCEDURE IF EXISTS `sp_borraCapacitacion`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_borraCapacitacion` (IN `idCap` INT(3))  begin
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
    end$$

DROP PROCEDURE IF EXISTS `sp_capacitacionDocente`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_capacitacionDocente` (IN `idUsr` INT(3), IN `tipoCap` VARCHAR(50), IN `institucionC` VARCHAR(50), IN `paisC` VARCHAR(50), IN `anioC` INT(4), IN `horaC` INT(4))  begin
declare msj nvarchar(50);
declare idCap int;
if(tipoCap = '' || institucionC = '' || paisC = '' || anioC = '' || horaC = '')	then
set msj = 'Faltan llenar campos, por favor verifique!';
else
set idCap = (select ifnull(max(idCapacitacion),0)+1 from capacitacionDocente);
insert into capacitacionDocente(idCapacitacion,idUsuario,tipoC,institucion,pais,anio,horas) 
values (idCap,idUsr,tipoCap,institucionC,paisC,anioC,horaC);
set msj = 'Capacitaci&oacuten agregada exitosamente!';
end if;

select msj as notificacion;
end$$

DROP PROCEDURE IF EXISTS `sp_eliminaActDis`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eliminaActDis` (IN `idAct` INT(3))  begin
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
    end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actualizaciond`
--

DROP TABLE IF EXISTS `actualizaciond`;
CREATE TABLE IF NOT EXISTS `actualizaciond` (
  `idActualizacion` decimal(3,0) NOT NULL,
  `idUsuario` decimal(3,0) NOT NULL,
  `tipoAct` varchar(50) NOT NULL,
  `institucion` varchar(50) NOT NULL,
  `pais` varchar(59) NOT NULL,
  `anio` decimal(4,0) NOT NULL,
  `horas` decimal(4,0) NOT NULL,
  PRIMARY KEY (`idActualizacion`),
  KEY `idProf6` (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actualizaciond`
--

INSERT INTO `actualizaciond` (`idActualizacion`, `idUsuario`, `tipoAct`, `institucion`, `pais`, `anio`, `horas`) VALUES
('7', '1', 'Crecimiento Integral', 'La salle', 'Mexico', '2019', '50'),
('6', '1', 'Liderazgo', 'IPN', 'Mexico', '2019', '50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacitaciondocente`
--

DROP TABLE IF EXISTS `capacitaciondocente`;
CREATE TABLE IF NOT EXISTS `capacitaciondocente` (
  `idCapacitacion` decimal(3,0) NOT NULL,
  `idUsuario` decimal(3,0) NOT NULL,
  `tipoC` varchar(50) NOT NULL,
  `institucion` varchar(50) NOT NULL,
  `pais` varchar(59) NOT NULL,
  `anio` decimal(4,0) NOT NULL,
  `horas` decimal(4,0) NOT NULL,
  PRIMARY KEY (`idCapacitacion`),
  KEY `idProf5` (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `capacitaciondocente`
--

INSERT INTO `capacitaciondocente` (`idCapacitacion`, `idUsuario`, `tipoC`, `institucion`, `pais`, `anio`, `horas`) VALUES
('35', '1', 'Curso', 'IPN', 'Mexico', '2019', '50'),
('36', '1', 'Curso', 'Tec. Monterrey', 'Mexico', '2019', '60');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogonivelcursos`
--

DROP TABLE IF EXISTS `catalogonivelcursos`;
CREATE TABLE IF NOT EXISTS `catalogonivelcursos` (
  `idNivel` decimal(1,0) NOT NULL,
  `descripcion` varchar(12) NOT NULL,
  PRIMARY KEY (`idNivel`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `catalogonivelcursos`
--

INSERT INTO `catalogonivelcursos` (`idNivel`, `descripcion`) VALUES
('1', 'LICENCIATURA'),
('2', 'POSGRADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogoperiodos`
--

DROP TABLE IF EXISTS `catalogoperiodos`;
CREATE TABLE IF NOT EXISTS `catalogoperiodos` (
  `idPeriodo` decimal(1,0) NOT NULL,
  `descripcion` varchar(9) NOT NULL,
  PRIMARY KEY (`idPeriodo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `catalogoperiodos`
--

INSERT INTO `catalogoperiodos` (`idPeriodo`, `descripcion`) VALUES
('1', '2014-2015'),
('2', '2015-2016');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratacionactual`
--

DROP TABLE IF EXISTS `contratacionactual`;
CREATE TABLE IF NOT EXISTS `contratacionactual` (
  `idUsuario` decimal(4,0) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `diaIngreso` decimal(2,0) NOT NULL,
  `mesIngreso` varchar(10) NOT NULL,
  `anioIngreso` decimal(4,0) NOT NULL,
  KEY `idProf15` (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursosimpartidos`
--

DROP TABLE IF EXISTS `cursosimpartidos`;
CREATE TABLE IF NOT EXISTS `cursosimpartidos` (
  `idCurso` decimal(3,0) NOT NULL,
  `idUsuario` decimal(4,0) NOT NULL,
  `idPeriodo` decimal(1,0) NOT NULL,
  `idNivel` decimal(1,0) NOT NULL,
  `nombreCurso` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `horasTotales` decimal(5,0) NOT NULL,
  PRIMARY KEY (`idCurso`),
  KEY `idProf17` (`idUsuario`),
  KEY `idPB` (`idPeriodo`),
  KEY `idNB` (`idNivel`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cursosimpartidos`
--

INSERT INTO `cursosimpartidos` (`idCurso`, `idUsuario`, `idPeriodo`, `idNivel`, `nombreCurso`, `tipo`, `horasTotales`) VALUES
('1', '1', '1', '2', 'j', 'ECO', '90'),
('2', '1', '2', '1', 'ui', ',', '2'),
('3', '1', '1', '2', 'oooo', 'ECO', '10'),
('4', '1', '2', '2', '201', 'ECO', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experienciadisenioingenieril`
--

DROP TABLE IF EXISTS `experienciadisenioingenieril`;
CREATE TABLE IF NOT EXISTS `experienciadisenioingenieril` (
  `idExperienciaIng` decimal(3,0) NOT NULL,
  `idUsuario` decimal(3,0) NOT NULL,
  `tipoExperiencia` varchar(50) DEFAULT NULL,
  `lugar` varchar(50) NOT NULL,
  `numeroAnios` decimal(3,0) NOT NULL,
  `infAdicionar` varchar(100) NOT NULL,
  PRIMARY KEY (`idExperienciaIng`),
  KEY `idProf10` (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencianoacademica`
--

DROP TABLE IF EXISTS `experiencianoacademica`;
CREATE TABLE IF NOT EXISTS `experiencianoacademica` (
  `idExperiencia` decimal(3,0) NOT NULL,
  `idUsuario` decimal(3,0) NOT NULL,
  `actividad` varchar(50) NOT NULL,
  `empresa` varchar(50) CHARACTER SET utf8 NOT NULL,
  `anioInicio` decimal(4,0) NOT NULL,
  `mesinicio` varchar(10) NOT NULL,
  `anioFinal` decimal(4,0) NOT NULL,
  `mesFinal` varchar(10) NOT NULL,
  PRIMARY KEY (`idExperiencia`),
  KEY `idProf9` (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formacionacademica`
--

DROP TABLE IF EXISTS `formacionacademica`;
CREATE TABLE IF NOT EXISTS `formacionacademica` (
  `idFormacion` decimal(3,0) NOT NULL,
  `idUsuario` decimal(3,0) NOT NULL,
  `nivel` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `institucion` varchar(50) NOT NULL,
  `pais` varchar(59) NOT NULL,
  `anio` decimal(4,0) NOT NULL,
  `cedulaP` varchar(30) NOT NULL,
  PRIMARY KEY (`idFormacion`),
  KEY `idProf4` (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestionacademica`
--

DROP TABLE IF EXISTS `gestionacademica`;
CREATE TABLE IF NOT EXISTS `gestionacademica` (
  `idGestion` decimal(3,0) NOT NULL,
  `idUsuario` decimal(3,0) NOT NULL,
  `actividad` varchar(50) NOT NULL,
  `anioInicio` decimal(4,0) NOT NULL,
  `mesinicio` varchar(10) NOT NULL,
  `anioFinal` decimal(4,0) NOT NULL,
  `mesFinal` varchar(10) NOT NULL,
  PRIMARY KEY (`idGestion`),
  KEY `idProf7` (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instanciaspertenecientes`
--

DROP TABLE IF EXISTS `instanciaspertenecientes`;
CREATE TABLE IF NOT EXISTS `instanciaspertenecientes` (
  `idInstancia` decimal(3,0) NOT NULL,
  `idUsuario` decimal(4,0) NOT NULL,
  `nombreInstancia` varchar(100) NOT NULL,
  `diaIngreso` decimal(2,0) NOT NULL,
  `mesIngreso` varchar(10) NOT NULL,
  `anioIngreso` decimal(4,0) NOT NULL,
  PRIMARY KEY (`idInstancia`),
  KEY `idProf16` (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logrosprofesionales`
--

DROP TABLE IF EXISTS `logrosprofesionales`;
CREATE TABLE IF NOT EXISTS `logrosprofesionales` (
  `idLogro` decimal(3,0) NOT NULL,
  `idUsuario` decimal(3,0) NOT NULL,
  `anio` decimal(4,0) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  PRIMARY KEY (`idLogro`),
  KEY `idProf11` (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresias`
--

DROP TABLE IF EXISTS `membresias`;
CREATE TABLE IF NOT EXISTS `membresias` (
  `idMembresia` decimal(3,0) NOT NULL,
  `idUsuario` decimal(3,0) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `lugar` varchar(50) NOT NULL,
  `anios` decimal(4,0) NOT NULL,
  PRIMARY KEY (`idMembresia`),
  KEY `idProf12` (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacimientos`
--

DROP TABLE IF EXISTS `nacimientos`;
CREATE TABLE IF NOT EXISTS `nacimientos` (
  `idUsuario` decimal(3,0) NOT NULL,
  `dia` decimal(2,0) NOT NULL,
  `mes` varchar(10) DEFAULT NULL,
  `anio` decimal(4,0) DEFAULT NULL,
  KEY `idProf2` (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nacimientos`
--

INSERT INTO `nacimientos` (`idUsuario`, `dia`, `mes`, `anio`) VALUES
('1', '7', 'enero', '1999');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participacionpe`
--

DROP TABLE IF EXISTS `participacionpe`;
CREATE TABLE IF NOT EXISTS `participacionpe` (
  `idUsuario` decimal(3,0) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  KEY `idProf14` (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `premios`
--

DROP TABLE IF EXISTS `premios`;
CREATE TABLE IF NOT EXISTS `premios` (
  `idPremio` decimal(3,0) NOT NULL,
  `idUsuario` decimal(3,0) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `organismo` varchar(100) NOT NULL,
  `anio` decimal(4,0) NOT NULL,
  `motivo` varchar(1000) NOT NULL,
  PRIMARY KEY (`idPremio`),
  KEY `idProf13` (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productosrelevantes`
--

DROP TABLE IF EXISTS `productosrelevantes`;
CREATE TABLE IF NOT EXISTS `productosrelevantes` (
  `idUsuario` decimal(3,0) NOT NULL,
  `anio` decimal(4,0) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(1000) CHARACTER SET utf8 NOT NULL,
  KEY `idProf8` (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

DROP TABLE IF EXISTS `profesores`;
CREATE TABLE IF NOT EXISTS `profesores` (
  `idUsuario` decimal(3,0) NOT NULL,
  `idInstitucion` varchar(30) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `paterno` varchar(50) NOT NULL,
  `materno` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` decimal(13,0) NOT NULL,
  KEY `idUSFK` (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`idUsuario`, `idInstitucion`, `nombre`, `paterno`, `materno`, `correo`, `telefono`) VALUES
('1', '2015090463', 'Jose', 'Molina', 'Garcia', 'jamgbatiz@gmail.com', '44556079193');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestosinstitucionales`
--

DROP TABLE IF EXISTS `puestosinstitucionales`;
CREATE TABLE IF NOT EXISTS `puestosinstitucionales` (
  `idUsuario` decimal(3,0) NOT NULL,
  `puesto` varchar(50) NOT NULL,
  KEY `idProf3` (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `puestosinstitucionales`
--

INSERT INTO `puestosinstitucionales` (`idUsuario`, `puesto`) VALUES
('1', 'Dios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

DROP TABLE IF EXISTS `tipousuario`;
CREATE TABLE IF NOT EXISTS `tipousuario` (
  `idTipo` decimal(1,0) NOT NULL,
  `tipo` varchar(13) NOT NULL,
  PRIMARY KEY (`idTipo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`idTipo`, `tipo`) VALUES
('1', 'Administrador'),
('2', 'Profesor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` decimal(3,0) NOT NULL,
  `contrasenia` varchar(50) NOT NULL,
  `idTipo` decimal(1,0) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `idTP` (`idTipo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `contrasenia`, `idTipo`) VALUES
('1', '25d55ad283aa400af464c76d713c07ad', '2');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
