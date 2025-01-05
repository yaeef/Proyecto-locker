--Funciones

--Función que verifica si una boleta existe en la BD 
CREATE FUNCTION existirBoleta( boletaVerificar VARCHAR(10) ) 
RETURNS TINYINT
DETERMINISTIC
BEGIN
    DECLARE resultado TINYINT DEFAULT 0;
    IF EXISTS (SELECT 1 FROM Alumno WHERE boleta = boletaVerificar) THEN
        SET resultado = 1;
    END IF;
    RETURN resultado;
END;


--Función que verifica la existencia de un correo en la BD
CREATE FUNCTION existirCorreo( correoVerificar VARCHAR(100) ) 
RETURNS TINYINT
DETERMINISTIC
BEGIN
    DECLARE resultado TINYINT DEFAULT 0;
    IF EXISTS (SELECT 1 FROM Alumno WHERE correo = correoVerificar) THEN
        SET resultado = 1;
    END IF;
    RETURN resultado;
END


--Función que verifica la existencia de un usuario en la BD
CREATE FUNCTION existirUsuario( usuarioVerificar VARCHAR(50) ) 
RETURNS TINYINT
DETERMINISTIC
BEGIN
    DECLARE resultado TINYINT DEFAULT 0;
    IF EXISTS (SELECT 1 FROM Alumno WHERE usuario = usuarioVerificar) THEN
        SET resultado = 1;
    END IF;
    RETURN resultado;
END;


--Función que retorna la cantidad de casilleros disponibles
CREATE FUNCTION existirCasilleros() 
RETURNS TINYINT
DETERMINISTIC
BEGIN
    DECLARE resultado TINYINT;
    SELECT 100 - (SELECT COUNT(*) FROM Casillero WHERE asignado = 1) - (SELECT COUNT(*) FROM Alumno WHERE estado = 'D') INTO resultado;
    RETURN resultado;
END;

--Función que verifica si un casillero dadoesta disponible
CREATE FUNCTION disponibleCasillero( idCasilleroVerificar INT ) 
RETURNS TINYINT
DETERMINISTIC
BEGIN
    DECLARE respuesta TINYINT;
    SELECT asignado INTO respuesta FROM Casillero WHERE idCasillero = idCasilleroVerificar;
    RETURN !respuesta;
END;

