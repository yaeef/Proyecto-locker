SET GLOBAL event_scheduler = ON; --Activa el programador de eventos en mysql
ALTER EVENT nombre DISABLE;      --Desactiva un evento en especifico


--Evento que se ejecuta cada 10 minutos para verificar el tiempo transcurrido de un alumno que debe subir
--su comprobante, en caso de exceder las 24 horas entonces pasa al estado G
CREATE EVENT transicionEG
ON SCHEDULE EVERY 10 MINUTE 
DO 
BEGIN 

	CREATE TEMPORARY TABLE IF NOT EXISTS temp_casilleros AS  -- Crear una tabla temporal para almacenar los registros que deben ser procesados 
	SELECT ca.idPersona, ca.idCasillero FROM CasilleroAlumno ca INNER JOIN Alumno a ON ca.idPersona = a.idPersona WHERE a.estado = 'E' AND ca.fechaSolicitud < NOW() - INTERVAL 1 DAY;
	UPDATE Casillero c INNER JOIN temp_casilleros t ON c.idCasillero = t.idCasillero SET c.asignado = 0;  --Liberación de casilleros
	DELETE ac FROM AdminCasillero ac INNER JOIN temp_casilleros t ON ac.idCasillero = t.idCasillero;      --Borrado de AdminCasillero
	DELETE ca FROM CasilleroAlumno ca INNER JOIN temp_casilleros t ON ca.idCasillero = t.idCasillero;     --Borrado CasilleroAlumno
	UPDATE Alumno a INNER JOIN temp_casilleros t ON a.idPersona = t.idPersona SET a.estado = 'G', a.casillero = 0;         --Transicion
	DROP TEMPORARY TABLE IF EXISTS temp_casilleros;                                                       --Borrar tabla temporal
END;


--Evento que se ejecuta cada 10 minutos para verificar el tiempo transcurrido de un alumno que debe aceptar
--términos y condiciones, en caso de exceder las 24 horas entonces pasa al estado G
CREATE EVENT transicionBG
ON SCHEDULE EVERY 10 MINUTE 
DO 
BEGIN 

	CREATE TEMPORARY TABLE IF NOT EXISTS temp_casilleros AS  -- Crear una tabla temporal para almacenar los registros que deben ser procesados 
	SELECT ca.idPersona, ca.idCasillero FROM CasilleroAlumno ca INNER JOIN Alumno a ON ca.idPersona = a.idPersona WHERE a.estado = 'B' AND ca.fechaSolicitud < NOW() - INTERVAL 1 DAY;
	UPDATE Casillero c INNER JOIN temp_casilleros t ON c.idCasillero = t.idCasillero SET c.asignado = 0;  --Liberación de casilleros
	DELETE ac FROM AdminCasillero ac INNER JOIN temp_casilleros t ON ac.idCasillero = t.idCasillero;      --Borrado de AdminCasillero
	DELETE ca FROM CasilleroAlumno ca INNER JOIN temp_casilleros t ON ca.idCasillero = t.idCasillero;     --Borrado CasilleroAlumno
	UPDATE Alumno a INNER JOIN temp_casilleros t ON a.idPersona = t.idPersona SET a.estado = 'G', a.casillero = 0;         --Transicion
	DROP TEMPORARY TABLE IF EXISTS temp_casilleros;                                                       --Borrar tabla temporal
END;

