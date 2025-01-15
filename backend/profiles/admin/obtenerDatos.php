<?php
    require "../../../db/conection/conection.php";
    $conexion = conectarBD();


    #Función que recupera los datos de cada casillero
    function recuperarCasilleros($conexion)
    {   
        #Preparar query para recuperar información de casilleros
        $query = "  SELECT C.idCasillero, C.asignado, A.idPersona, A. boleta, A.nombre, A.paterno, A.materno, A.estado, A. credencial, A. horario, CA.pagado, CA.comprobantePago
                    FROM Casillero C
                    LEFT JOIN CasilleroAlumno CA ON C.idCasillero = CA.idCasillero
                    LEFT JOIN Alumno A ON CA.idPersona = A.idPersona;";

        $resultado = mysqli_query($conexion,$query);
        $casilleros = array();

        if(mysqli_num_rows($resultado) > 0)
        {
            while($fila = mysqli_fetch_assoc($resultado))
            {
                $casilleros[] = $fila;
            }
            return $casilleros;
        }
        else
        {
            echo "Error al recuperar Casilleros de la BD: " . mysqli_error($conexion);
            return null;
        }
    }

    #Función que recupera los alumnos en estado D
    function recuperaAlumnosSinCasillero($conexion)
    {   
        #Preparar query para recuperar información de alumnos en estado D
        $query = "  SELECT idPersona, boleta, nombre, paterno, materno, estatura, credencial, horario FROM Alumno WHERE estado ='D';";

        $resultado = mysqli_query($conexion,$query);
        $alumnosD = array();

        if(mysqli_num_rows($resultado) > 0)
        {
            while($fila = mysqli_fetch_assoc($resultado))
            {
                $alumnosD[] = $fila;
            }
            return $alumnosD;
        }
        else
        {
            #echo "Error al recuperar alumnos en estado D: " . mysqli_error($conexion);
            return null;
        }
    }

    /*#Función que recupera los alumnos con casillero | ESTADOS: B, E, F, H, I
    function recuperaAlumnosConCasillero($conexion)
    {   
        #Preparar query para recuperar información de alumnos con casillero
        $query = "SELECT idPersona, boleta, nombre, paterno, materno, estado FROM Alumno WHERE casillero = 1;";

        $resultado = mysqli_query($conexion,$query);
        $alumnosConCasillero = array();

        if(mysqli_num_rows($resultado) > 0)
        {
            while($fila = mysqli_fetch_assoc($resultado))
            {
                $alumnosConCasillero[] = $fila;
            }
            return $alumnosConCasillero;
        }
        else
        {
            echo "Error al recuperar alumnos con Casillero: " . mysqli_error($conexion);
            return null;
        }
    }*/

    

    $casilleros = recuperarCasilleros($conexion);
    $alumnosSinCasillero = recuperaAlumnosSinCasillero($conexion);
    //$alumnosConCasillero = recuperaAlumnosConCasillero($conexion);

    $response = array('casilleros' => $casilleros, 'alumnosSinCasillero' => $alumnosSinCasillero/*, 'alumnosConCasillero' => $alumnosConCasillero*/);
    
    
    desconectarBD($conexion);
    header('Content-Type: application/json');
    echo json_encode($response);
?>