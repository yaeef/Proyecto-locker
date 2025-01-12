
--Trigger que se ejecutara cada que exista una actualización en la tabla Casillero y evaluara si existen casilleros
--disponibles, en caso de haber casilleros disponibles, los alumnos en lista de espera pasan al estado G

CREATE TRIGGER transicionCG
AFTER UPDATE ON Casillero
FOR EACH ROW
BEGIN
    DECLARE casilleros_disponibles INT;
    SET casilleros_disponibles = (SELECT existirCasilleros());

    IF casilleros_disponibles > 0 THEN
        SET @alumnos_actualizados = (                  -- Paso 4: Actualizar los primeros alumnos en la ListaEspera. Obtener los ID de los primeros alumnos
            SELECT GROUP_CONCAT(idPersona)
            FROM (
                SELECT idPersona
                FROM ListaEspera
                ORDER BY fechaRegistro ASC
                LIMIT casilleros_disponibles
            ) AS temp
        );
        IF @alumnos_actualizados IS NOT NULL THEN          -- Si existen alumnos para actualizar
            UPDATE Alumno
            SET estado = 'B'
            WHERE idPersona IN (@alumnos_actualizados);

            DELETE FROM ListaEspera                        -- Eliminar los registros de ListaEspera para los alumnos actualizados
            WHERE idPersona IN (@alumnos_actualizados);
        END IF;
    END IF;
END;

