
--Trigger que se ejecutara cada que exista una actualización en la tabla Casillero y evaluara si existen casilleros
--disponibles, en caso de haber casilleros disponibles, los alumnos en lista de espera pasan al estado G

CREATE TRIGGER transicionCD
AFTER UPDATE ON Casillero                               --Debe ser Alumno pero esto crea Autorreferencia en SQL, alternativa, usar tablas temporales
FOR EACH ROW
BEGIN
    DECLARE casilleros_disponibles INT;
    SET casilleros_disponibles = (SELECT existirCasilleros());

    IF casilleros_disponibles > 0 THEN
        SET @alumnos_actualizados = (                  --Tabla temporal de los K-esimos alumnos en Lista de espera
            SELECT GROUP_CONCAT(idPersona)
            FROM (
                SELECT idPersona
                FROM ListaEspera
                ORDER BY fechaRegistro ASC
                LIMIT casilleros_disponibles
            ) AS temp
        );
        IF @alumnos_actualizados IS NOT NULL THEN          -- Si existen alumnos para actualizar entonces significa que hubo casilleros disponibles
            UPDATE Alumno
            SET estado = 'D'
            WHERE idPersona IN (@alumnos_actualizados);

            DELETE FROM ListaEspera                        -- Borrado de tabla Lista espera
            WHERE idPersona IN (@alumnos_actualizados);
        END IF;
    END IF;
END;

