DROP DATABASE locker;
CREATE DATABASE locker;
USE locker;

GRANT ALL PRIVILEGES ON locker.* TO 'root'@'localhost';  --Accede permisos de la base de datos locker al usuario root
FLUSH PRIVILEGES;

/*Tabla ADMIN*/

CREATE TABLE Admin
(
    idPersona INT AUTO_INCREMENT,
    nombre VARCHAR(50) CHARACTER SET utf8 NOT NULL,
    paterno VARCHAR(50) CHARACTER SET utf8 NOT NULL,
    materno VARCHAR(50) CHARACTER SET utf8 NOT NULL,
    telefono VARCHAR(10) NOT NULL,
    noEmpleado VARCHAR(10) NULL,
    usuario VARCHAR(50) NOT NULL,
    contrasena VARCHAR(120) NOT NULL,
    CONSTRAINT PK_Admin PRIMARY KEY (idPersona)
);

/*Tabla Casillero*/
CREATE TABLE Casillero
(
    idCasillero INT NOT NULL AUTO_INCREMENT,
    asignado TINYINT(1) NOT NULL,
    CONSTRAINT PK_Casillero PRIMARY KEY (idCasillero)
);

/*Tabla Alumno*/
CREATE TABLE Alumno
(
    idPersona INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) CHARACTER SET utf8 NOT NULL,
    paterno VARCHAR(50) CHARACTER SET utf8 NOT NULL,
    materno VARCHAR(50) CHARACTER SET utf8 NOT NULL,
    telefono VARCHAR(10) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    boleta VARCHAR(10) NOT NULL,
    estatura DECIMAL(3,2) NOT NULL,
    credencial VARCHAR(255) NOT NULL,  --Ruta a directorio del servidor
    horario VARCHAR(255) NOT NULL,     --Ruta a directorio del servidor
    casillero TINYINT(1) NOT NULL,
    estado CHAR(1) NOT NULL,
    usuario VARCHAR(50) NOT NULL,
    contrasena VARCHAR(120) NOT NULL,
    CONSTRAINT PK_Admin PRIMARY KEY (idPersona)
);

/*Tabla AdminCasillero*/
CREATE TABLE AdminCasillero
(
    idAdminCasillero INT NOT NULL AUTO_INCREMENT,
    idPersona INT NOT NULL,
    idCasillero INT NOT NULL,
    fechaAsignacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP, --Hora del servidor | pasar como valor CURRENT_TIMESTAMP para actualizar
    CONSTRAINT PK_AdminCasillero PRIMARY KEY (idAdminCasillero),
    CONSTRAINT FK_AdminCasillero_Admin FOREIGN KEY (idPersona) REFERENCES Admin(idPersona) ON UPDATE CASCADE,
    CONSTRAINT FK_AdminCasillero_Casillero FOREIGN KEY (idCasillero) REFERENCES Casillero(idCasillero) ON DELETE CASCADE ON UPDATE CASCADE
);

/*Tabla CasilleroAlumno*/
CREATE TABLE CasilleroAlumno
(
    idCasilleroAlumno INT NOT NULL AUTO_INCREMENT,
    idPersona INT NOT NULL,
    idCasillero INT DEFAULT NULL,
    fechaSolicitud TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    comprobantePago VARCHAR(255) NULL,   --Ruta a directorio del servidor
    periodo VARCHAR(50) NULL,
    pagado TINYINT(1) NOT NULL,
    CONSTRAINT PK_CasilleroAlumno PRIMARY KEY (idCasilleroAlumno),
    CONSTRAINT FK_CasilleroAlumno_Alumno FOREIGN KEY (idPersona) REFERENCES Alumno(idPersona) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK_CasilleroAlumno_Casillero FOREIGN KEY (idCasillero) REFERENCES Casillero(idCasillero) ON DELETE CASCADE ON UPDATE CASCADE
);

/*Tabla ListaEspera*/
CREATE TABLE ListaEspera
(
    idListaEspera INT NOT NULL AUTO_INCREMENT,
    idPersona INT NOT NULL,
    fechaRegistro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT PK_ListaEspera PRIMARY KEY (idListaEspera),
    CONSTRAINT FK_ListaEspera_Alumno FOREIGN KEY (idPersona) REFERENCES Alumno(idPersona) ON DELETE CASCADE ON UPDATE CASCADE
);

