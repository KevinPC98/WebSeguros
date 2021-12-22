DROP DATABASE IF EXISTS SEGURODEVIDA;
CREATE DATABASE SEGURODEVIDA;

USE SEGURODEVIDA;

CREATE TABLE USUARIO(
	nombreUsuario VARCHAR(20) PRIMARY KEY,
	direccion VARCHAR(60) NOT NULL,
    telefono INTEGER(10) NOT NULL,
    email VARCHAR(25) UNIQUE NOT NULL,
    contrasenia VARCHAR(20) NOT NULL
);

CREATE TABLE PERSONANATURAL(
	nombreUsuario VARCHAR(20) PRIMARY KEY,
    tipoDoc VARCHAR(4) NOT NULL,
	numDoc INTEGER(15) NOT NULL,
    nombre VARCHAR(20) NOT NULL,
    apellido VARCHAR(20) NOT NULL,
    FOREIGN KEY(nombreUsuario) REFERENCES USUARIO(nombreUsuario)
);

CREATE TABLE PERSONAJURIDICA(
	nombreUsuario VARCHAR(20) PRIMARY KEY,
	ruc INTEGER(11) NOT NULL,
    nombre VARCHAR(20) NOT NULL,
    FOREIGN KEY(nombreUsuario) REFERENCES USUARIO(nombreUsuario)
);

CREATE TABLE SEGURO(
	codigo BIGINT PRIMARY KEY,
    nombre VARCHAR(25) NOT NULL,
    descripcion VARCHAR(1000),
    dirImagen VARCHAR(100)
);

CREATE TABLE TIENE(
	codSeguro BIGINT,
    nombreUsuario VARCHAR(20),
    PRIMARY KEY(codSeguro, nombreUsuario),
    FOREIGN KEY(codSeguro) REFERENCES SEGURO(codigo),
    FOREIGN KEY(nombreUsuario) REFERENCES USUARIO(nombreUsuario)
);
INSERT INTO USUARIO VALUES('admin','*****','*****','*****','admin12345@');
INSERT INTO PERSONANATURAL VALUES('admin','dni',55643987,'Administrador','');
SELECT * FROM USUARIO;

INSERT INTO SEGURO VALUES(100,'Seguro familiar','El seguro familiar  le permite dejarle a sus seres queridos dinero para hacer frente a obligaciones que se generen en caso que usted o algun miembro de su familia (pareja e hijos) llegue a faltar.','imagenes/seguroFamiliar.png'),
						 (101,'Seguro vehicular','Este seguro no te va a librar del trafico, pero vamos a cuidar tu vehiculo y mucho mas. Te guiamos para que puedas tomar la mejor decision y hacer uso completo de todas las asistencias que ofrecemos.','imagenes/seguroVehicular.png'),
                         (102,'Seguro de vida','El seguro de vida es contratado para proteger economicamente a las personas que dependan de ti en caso de tu fallecimiento, pues estos contaran con una indemnizacion que permita cubrir temporalmente sus necesidades economicas.','imagenes/seguroVida.png'),
                         (103,'Seguro de salud','El seguro de salud es una poliza de pago mensual, contratado a una aseguradora con el fin de costear de forma total o parcial diversos gastos medicos en los que se incluyen consultas, medicamentos, emergencias, entre otros beneficios.','imagenes/seguroSalud.png'),
                         (104,'Seguro de viajes','El seguro de viajes es un servicio de asistencia que cubre cualquier circunstancia ocurrida durante el viaje. Tambien puedes contar con un seguro solo para un viaje en especifico o por un periodo de tiempo, cubriendo cualquier viaje que se realice en ese lapso.','imagenes/seguroViajes.png'),
                         (105,'Seguro de accidentes','El seguro de accidentes cubre toda lesion corporal producida por la accion imprevista fortuita y/o ocasional de una fuerza externa que obra subita y violentamente sobre la persona independientemente de su voluntad y que pueda ser determinada por los medicos de una manera cierta.','imagenes/seguroAccidentes.png');
