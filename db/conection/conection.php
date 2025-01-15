<?php
    require "env.php";
    
    #Función que crea una conexión a la BD y retorna la conexion
    function conectarBD()
    {
        #recuperando variables de env.php
        global $server;
        global $user;
        global $password;
        global $database;
        $conexion = mysqli_connect($server,$user,$password,$database);
        if(!$conexion)
        {
            die("Conexión fallida a MySQL: ". mysqli_connect_error());
        }
        else
        {
            #echo "Conectado a MySQL :)";
            return $conexion;
        }
    }
    #Función para desconectar la BD
    function desconectarBD($conexion)
    {
        #echo "BD desconectada :)";
        mysqli_close($conexion);
    }

    #Función que evalua la existencia de algun tipo de parametro como boleta, correo y usuario. La verificación se hace mediante funciones creadas en mysql | Retorna 0 si no existe en la BD y 1 en caso que si exista
    function evaluarExistencia($conexion,$cadenaEvaluar, $tipoEvaluacion) //tipoEvaluacion recibe cadenas como : "boleta", "correo" o "usuario"
    {
        $param = mysqli_real_escape_string($conexion,$cadenaEvaluar);
        
        $queryType['boleta'] = "SELECT existirBoleta('$param') AS resultado;";
        $queryType['correo'] = "SELECT existirCorreo('$param') AS resultado;";
        $queryType['usuario'] = "SELECT existirUsuario('$param') AS resultado;";

        $query = $queryType[$tipoEvaluacion];
        $resultado = mysqli_query($conexion,$query);

        if($resultado)
        {
            $fila = mysqli_fetch_assoc($resultado);
            $valor = $fila["resultado"];
            return ($valor == 1) ? 1 : 0;
        }
        else
        {
            die("Consulta fallida de evaluación de existencias a MySQL: ". mysqli_error($conexion));
        }
    }

    #Función que evalua la existencia de un usuario Administrador
    function evaluarExistenciaAdmin($conexion,$usuarioVerificar) 
    {
        $param = mysqli_real_escape_string($conexion,$usuarioVerificar);
        $query = "SELECT existirAdmin('$usuarioVerificar') AS resultado;";
        $resultado = mysqli_query($conexion,$query);

        if($resultado)
        {
            $fila = mysqli_fetch_assoc($resultado);
            $valor = $fila["resultado"];
            return ($valor == 1) ? 1 : 0;
        }
        else
        {
            die("Consulta fallida de evaluación de existencia de administrador a MySQL: ". mysqli_error($conexion));
        }
    }

    #Función que evalua si hay casilleros disponibles
    function evaluarDisponibilidadCasilleros($conexion)
    {
        $query = "SELECT existirCasilleros() AS resultado;";
        $resultado = mysqli_query($conexion,$query);

        if($resultado)
        {
            $fila = mysqli_fetch_assoc($resultado);
            $valor = $fila['resultado'];
            return ($valor > 0) ? 1 : 0;
        }
    }

    #Función que consulta el idPersona de un Alumno
    function identificarAlumno($conexion, $boletaVerificar)
    {
        //Consulta que busca el id del Alumno
        $query = "SELECT idPersona FROM Alumno WHERE boleta = $boletaVerificar;";
        //Ejecución de consulta
        $resultado = mysqli_query($conexion,$query);

        if(!$resultado)
        {
            echo "Error al identificar Alumno con boleta" . mysqli_error($conexion);
            return -1;
        }
        else
        {
            //Si se encontro el estado entonces retornalo
            $fila = mysqli_fetch_assoc($resultado);
            $identificadorAlumno = $fila["idPersona"];
            return $identificadorAlumno;
        }
    }

    #Función que consulta el estado en el que se encuentra un Alumno
    function identificarEstado($conexion, $boletaVerificar)
    {
        //Consulta que busca el estado del Alumno
        $query = "SELECT estado FROM Alumno WHERE boleta = $boletaVerificar;";
        //Ejecución de consulta
        $resultado = mysqli_query($conexion,$query);

        if(!$resultado)
        {
            echo "Error al identificar en estado del Alumno" . mysqli_error($conexion);
            return -1;
        }
        else
        {
            //Si se encontro el estado entonces retornalo
            $fila = mysqli_fetch_assoc($resultado);
            $estado = $fila["estado"];
            return $estado;
        }
    }

    #Función que verifica si un casillero dado esta disponible
    function disponibleCasillero($conexion, $casilleroVerificar)
    {
        $query = "SELECT disponibleCasillero($casilleroVerificar) AS resultado;";
        $resultado = mysqli_query($conexion,$query);

        if($resultado)
        {
            $fila = mysqli_fetch_assoc($resultado);
            $valor = $fila["resultado"];
            return $valor;
        }
        else
        {
            die("Consulta disponibleCasillero() fallida a MySQL: ". mysqli_error($conexion));
        }
    }

    #Consulta que retorna el idCasillero de un Alumno en estado I, B, E
    function identificarCasillero($conexion, $idPersonaVerificar)
    {
        //Consulta que recupera el idCasillero del Alumno
        $query = "SELECT idCasillero FROM CasilleroAlumno WHERE idPersona = $idPersonaVerificar;";
        //Ejecución de consulta
        $resultado = mysqli_query($conexion,$query);

        if(!$resultado)
        {
            echo "Error al identificar el casillero de un Alumno en estado I" . mysqli_error($conexion);
            return -1;
        }
        else
        {
            //Si se encontro el identificador del casillero se recupera
            $fila = mysqli_fetch_assoc($resultado);
            $identificador = $fila["idCasillero"];
            return $identificador;
        }
    }

    #Función que recupera un alumno desde la BD dada una boleta
    function recuperarAlumno($conexion, $boletaVerificar)
    {
        $query = "SELECT * FROM Alumno WHERE boleta = '$boletaVerificar'";
        $resultado = mysqli_query($conexion,$query);

        if($resultado)
        {
            $fila = mysqli_fetch_assoc($resultado);

            if($fila == NULL)
            {
                return null;
            }
            return $fila;
        }
        else
        {
            echo "Error al recuperar Alumno de la BD: " . mysqli_error($conexion);
            return null;
        }
    }

    #Función que recupera un alumno desde la BD dado su usuario
    function recuperarAlumnoConUsuario($conexion, $usuarioVerificar)
    {
        $query = "SELECT * FROM Alumno WHERE usuario = '$usuarioVerificar'";
        $resultado = mysqli_query($conexion,$query);

        if($resultado)
        {
            $fila = mysqli_fetch_assoc($resultado);

            if($fila == NULL)
            {
                return null;
            }
            return $fila;
        }
        else
        {
            echo "Error al recuperar Alumno de la BD: " . mysqli_error($conexion);
            return null;
        }
    }

    #Función que recupera un Administrador desde la BD dado su usuario
    function recuperarAdminConUsuario($conexion, $usuarioVerificar)
    {
        $query = "SELECT * FROM Admin WHERE usuario = '$usuarioVerificar'";
        $resultado = mysqli_query($conexion,$query);

        if($resultado)
        {
            $fila = mysqli_fetch_assoc($resultado);

            if($fila == NULL)
            {
                return null;
            }
            return $fila;
        }
        else
        {
            echo "Error al recuperar Admin de la BD: " . mysqli_error($conexion);
            return null;
        }
    }

    #Función que inserta una solicitud en el estado A. USUARIO NUEVO
    function insertarEstadoInicialA($conexion)
    {
        //Almacenamiento de archivos en server
        if(isset($_FILES['credencial']) && isset($_FILES['horario']))//Sí se recibieron los archivos
        {
            if(!$_FILES['credencial']['error'] || !$_FILES['horario']['error'])//Sí no hay errores en los archivos
            {
                if($_FILES['credencial']['type'] == 'application/pdf' && $_FILES['horario']['type'] == 'application/pdf')//Guardando archivos en server
                {
                    $extencion = pathinfo($_FILES['horario']['name'], PATHINFO_EXTENSION);
                    $serverNameCredencial = uniqid('credencial_',true).'.'.$extencion;
                    $serverNameHorario = uniqid('horario_',true).'.'.$extencion;
                    $dirDestinoCredencial = 'files/'.trim($_POST['boleta']).'/'.$serverNameCredencial;
                    $dirDestinoHorario = 'files/'.trim($_POST['boleta']).'/'.$serverNameHorario;

                    if(!is_dir('files/'.trim($_POST['boleta']))){ mkdir('files/'.trim($_POST['boleta']), 0777, true);}

                    (move_uploaded_file($_FILES['credencial']['tmp_name'], $dirDestinoCredencial)) ? $credencial = $dirDestinoCredencial : null;
                    (move_uploaded_file($_FILES['horario']['tmp_name'], $dirDestinoHorario)) ? $horario = $dirDestinoHorario : null;
                }
                else
                {
                    echo "Alguno o ambos archivos no son de tipo pdf";
                    return 1;
                }
            }
            else
            {
                echo "Los archivos pdf estan corruptos o excedieron el tamaño límite aceptado";
                return 1;
            }
        }
        else
        {
            echo "Error al insertar debido a falta de archivos: " . mysqli_error($conexion);
            return 1;
        }

        //Preparación de datos para subir a la BD
        $nombreBD = mysqli_real_escape_string($conexion,trim(strtolower($_POST['nombre'])));
        $paternoBD = mysqli_real_escape_string($conexion,trim(strtolower($_POST['paterno'])));
        $maternoBD = mysqli_real_escape_string($conexion,trim(strtolower($_POST['materno'])));
        $telefonoBD = mysqli_real_escape_string($conexion,trim($_POST['telefono']));
        $correoBD = mysqli_real_escape_string($conexion,trim(strtolower($_POST['correo'])));
        $boletaBD = mysqli_real_escape_string($conexion,trim($_POST['boleta']));
        $estaturaBD = mysqli_real_escape_string($conexion,$_POST['estatura']);
        $credencialBD = mysqli_real_escape_string($conexion,$credencial);
        $horarioBD = mysqli_real_escape_string($conexion,$horario);
        $usuarioBD = mysqli_real_escape_string($conexion,$_POST['usuario']);
        $passwordBD = mysqli_real_escape_string($conexion,password_hash($_POST['password'], PASSWORD_DEFAULT));

        //Definición de consulta para insertar en tabla Alumno
        $query = "INSERT INTO Alumno(nombre,paterno,materno,telefono,correo,boleta,estatura,credencial,horario,casillero,estado,usuario,contrasena) VALUES('$nombreBD','$paternoBD','$maternoBD','$telefonoBD','$correoBD','$boletaBD',$estaturaBD,'$credencialBD','$horarioBD',0,'A','$usuarioBD','$passwordBD');";
        
        //Ejecución de consulta
        $resultado = mysqli_query($conexion,$query);

        if(!$resultado)
        {
            echo "Error al insertar el registro en Alumno: " . mysqli_error($conexion);
            return 1;
        }
        return 0;
    }

    #Función que inserta una solicitud en el estado E. POBLACIÓN DE BD
    function insertarEstadoInicialE($conexion)
    {
        //Almacenamiento de archivos en server
        if(isset($_FILES['credencial']) && isset($_FILES['horario']))//Sí se recibieron los archivos
        {
            if(!$_FILES['credencial']['error'] || !$_FILES['horario']['error'])//Sí no hay errores en los archivos
            {
                if($_FILES['credencial']['type'] == 'application/pdf' && $_FILES['horario']['type'] == 'application/pdf')//Guardando archivos en server
                {
                    $extencion = pathinfo($_FILES['horario']['name'], PATHINFO_EXTENSION);
                    $serverNameCredencial = uniqid('credencial_',true).'.'.$extencion;
                    $serverNameHorario = uniqid('horario_',true).'.'.$extencion;
                    $dirDestinoCredencial = 'files/'.trim($_POST['boleta']).'/'.$serverNameCredencial;
                    $dirDestinoHorario = 'files/'.trim($_POST['boleta']).'/'.$serverNameHorario;

                    if(!is_dir('files/'.trim($_POST['boleta']))){ mkdir('files/'.trim($_POST['boleta']), 0777, true);}

                    (move_uploaded_file($_FILES['credencial']['tmp_name'], $dirDestinoCredencial)) ? $credencial = $dirDestinoCredencial : null;
                    (move_uploaded_file($_FILES['horario']['tmp_name'], $dirDestinoHorario)) ? $horario = $dirDestinoHorario : null;
                }
                else
                {
                    echo "Alguno o ambos archivos no son de tipo pdf";
                    return 1;
                }
            }
            else
            {
                echo "Los archivos pdf estan corruptos o excedieron el tamaño límite aceptado";
                return 1;
            }
        }
        else
        {
            echo "Error al insertar debido a falta de archivos: " . mysqli_error($conexion);
            return 1;
        }

        //Preparación de datos para subir a la BD
        $nombreBD = mysqli_real_escape_string($conexion,trim(strtolower($_POST['nombre'])));
        $paternoBD = mysqli_real_escape_string($conexion,trim(strtolower($_POST['paterno'])));
        $maternoBD = mysqli_real_escape_string($conexion,trim(strtolower($_POST['materno'])));
        $telefonoBD = mysqli_real_escape_string($conexion,trim($_POST['telefono']));
        $correoBD = mysqli_real_escape_string($conexion,trim(strtolower($_POST['correo'])));
        $boletaBD = mysqli_real_escape_string($conexion,trim($_POST['boleta']));
        $estaturaBD = mysqli_real_escape_string($conexion,$_POST['estatura']);
        $credencialBD = mysqli_real_escape_string($conexion,$credencial);
        $horarioBD = mysqli_real_escape_string($conexion,$horario);
        $casilleroBD = mysqli_real_escape_string($conexion,trim($_POST['casillero']));
        $usuarioBD = mysqli_real_escape_string($conexion,$_POST['usuario']);
        $passwordBD = mysqli_real_escape_string($conexion,password_hash($_POST['password'], PASSWORD_DEFAULT));

        //Definición de consulta para insertar en tabla Alumno
        $query = "INSERT INTO Alumno(nombre,paterno,materno,telefono,correo,boleta,estatura,credencial,horario,casillero,estado,usuario,contrasena) VALUES('$nombreBD','$paternoBD','$maternoBD','$telefonoBD','$correoBD','$boletaBD',$estaturaBD,'$credencialBD','$horarioBD',1,'E','$usuarioBD','$passwordBD');";
        
        //Ejecución de consulta
        $resultado = mysqli_query($conexion,$query);

        if(!$resultado)
        {
            echo "Error al insertar el registro en Alumno: " . mysqli_error($conexion);
            return 1;
        }

        $identificadorAlumno = identificarAlumno($conexion, $boletaBD);

        //Consulta que inserta en la tabla CasilleroAlumno
        $query = "INSERT INTO CasilleroAlumno(idPersona, idCasillero, pagado) VALUES($identificadorAlumno,$casilleroBD, 0)";
        //Ejecución de consulta
        $resultado = mysqli_query($conexion,$query);

        if(!$resultado)
        {
            echo "Error al insertar el registro en CasilleroAlumno | Solicitud incompleta " . mysqli_error($conexion);
            return 1;
        }

        //Consulta que actualiza el estado del casillero seleccionado
        $query = "UPDATE Casillero SET asignado = 1 WHERE idCasillero = $casilleroBD";
        //Ejecución de consulta
        $resultado = mysqli_query($conexion,$query);

        if(!$resultado)
        {
            echo "Error al cambiar el estado del casillero solicitado" . mysqli_error($conexion);
            return 1;
        }

        //Consulta que da acceso al administrador para poder manipulas y observar el registro hecho
        $query = "INSERT INTO AdminCasillero(idPersona,idCasillero) VALUES(1,$casilleroBD)";
        //Ejecución de consulta
        $resultado = mysqli_query($conexion,$query);

        if(!$resultado)
        {
            echo "Error al insertar en la tabla AdminCasillero" . mysqli_error($conexion);
            return 1;
        }
        return 0;
    }

    #Funcion de transición A->D | Si hay casilleros, entonces registrar en D
    function transicionAD($conexion,$boletaAlumno)
    {
        $estadoAlumno = identificarEstado($conexion, $boletaAlumno);
        
        if($estadoAlumno == 'A') //Si se encuentra en estado A entonces se puede transicionar a D
        {
            //Definición de consulta para cambiar el estado del alumno
            $query = "UPDATE Alumno SET estado = 'D' WHERE boleta = $boletaAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al actualizar el estado del alumno: " . mysqli_error($conexion);
                return 1;
            }
            return 0;
        }
        return 1;
    }

    #Funcion de transición A->C | Si no hay casilleros, entonces registrar en C
    function transicionAC($conexion, $boletaAlumno)
    {
        $estadoAlumno = identificarEstado($conexion, $boletaAlumno);
        $identificadorAlumno = identificarAlumno($conexion, $boletaAlumno);
        
        if($estadoAlumno == 'A') //Si se encuentra en estado A entonces se puede transicionar a C
        {
            //Definición de consulta para cambiar el estado del alumno
            $query = "UPDATE Alumno SET estado = 'C' WHERE boleta = $boletaAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al actualizar el estado del alumno: " . mysqli_error($conexion);
                return 1;
            }

            //Definición de consulta para insertar en listaEspera
            $query = "INSERT INTO ListaEspera(idPersona) VALUES($identificadorAlumno);";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al insertar el registro en ListaEspera: " . mysqli_error($conexion);
                return 1;
            }
            return 0;
        }
        return 1;
    }

    #Funcion de transición I->E | Alumno con casillero solicita renovación 
    function transicionIE($conexion,$boletaAlumno)
    {
        $estadoAlumno = identificarEstado($conexion, $boletaAlumno);
        
        if($estadoAlumno == 'I') //Si se encuentra en estado I entonces se puede transicionar a E
        {
            //Definición de consulta para cambiar el estado del alumno
            $query = "UPDATE Alumno SET estado = 'E' WHERE boleta = $boletaAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al actualizar el estado del alumno: " . mysqli_error($conexion);
                return 1;
            }
            
            $idAlumno = identificarAlumno($conexion,$boletaAlumno);
            //Definición de consulta que actualiza la fecha de la relación CasilleroAlumno
            $query = "UPDATE CasilleroAlumno SET fechaSolicitud = CURRENT_TIMESTAMP WHERE idPersona = $idAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al actualizar la fecha de la relación CasilleroAlumno " . mysqli_error($conexion);
                return 1;
            }
            return 0;
        }
        return 1;
    }

    #Funcion de transición B->E | Alumno con casillero acepta términos y condiciones
    function transicionBE($conexion,$boletaAlumno)
    {
        $estadoAlumno = identificarEstado($conexion, $boletaAlumno);
        
        if($estadoAlumno == 'B') //Si se encuentra en estado B entonces se puede transicionar a E
        {
            //Definición de consulta para cambiar el estado del alumno
            $query = "UPDATE Alumno SET estado = 'E' WHERE boleta = $boletaAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al actualizar el estado del alumno: " . mysqli_error($conexion);
                return 1;
            }

            $idAlumno = identificarAlumno($conexion,$boletaAlumno);
            //Definición de consulta que actualiza la fecha de la relacioón CasilleroAlumno
            $query = "UPDATE CasilleroAlumno SET fechaSolicitud = CURRENT_TIMESTAMP WHERE idPersona = $idAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al actualizar la fecha de la relación CasilleroAlumno " . mysqli_error($conexion);
                return 1;
            }
            return 0;
        }
        return 1;
    }
    
    #Funcion de transición B->G | Alumno con casillero NO acepta términos y condiciones
    function transicionBG($conexion,$boletaAlumno, $casilleroAlumno)
    {
        $estadoAlumno = identificarEstado($conexion, $boletaAlumno);
        
        if($estadoAlumno == 'B') //Si se encuentra en estado B entonces se puede transicionar a G
        {
            //Definición de consulta para cambiar el estado del alumno
            $query = "UPDATE Alumno SET estado = 'G', casillero = 0 WHERE boleta = $boletaAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al actualizar el estado del alumno: " . mysqli_error($conexion);
                return 1;
            }

            //Definición de consulta que borra registro en CasilleroAlumno
            $query = "DELETE FROM CasilleroAlumno WHERE idCasillero = $casilleroAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al borrar registro de CasilleroAlumno: " . mysqli_error($conexion);
                return 1;
            }

            //Definición de consulta que libera casillero
            $query = "UPDATE Casillero SET asignado = 0 WHERE idCasillero = $casilleroAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al liberar casillero: " . mysqli_error($conexion);
                return 1;
            }

            //Definición de consulta que borra registro en AdminCasillero
            $query = "DELETE FROM AdminCasillero WHERE idCasillero = $casilleroAlumno";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al borrar registro de AdminCasillero: " . mysqli_error($conexion);
                return 1;
            }

            return 0;
        }
        return 1;
    }

    #Funcion de transición G->A | Alumno sin casillero solicita renovación 
    function transicionGA($conexion,$boletaAlumno)
    {
        $estadoAlumno = identificarEstado($conexion, $boletaAlumno);
        
        if($estadoAlumno == 'G') //Si se encuentra en estado G entonces se puede transicionar a A
        {
            //Definición de consulta para cambiar el estado del alumno
            $query = "UPDATE Alumno SET estado = 'A' WHERE boleta = $boletaAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al actualizar el estado del alumno: " . mysqli_error($conexion);
                return 1;
            }
            return 0;
        }
        return 1;
    }

    #Función de transición E->F | Alumno que sube comprobante
    function transicionEF($conexion,$boletaAlumno)
    {
        //Almacenamiento de archivos en server
        if(isset($_FILES['comprobante']))//Sí se recibio el archivo de comprobante
        {
            if(!$_FILES['comprobante']['error'])//Sí no hay error en el archivos
            {
                if($_FILES['comprobante']['type'] == 'application/pdf')//Guardando archivos en server
                {
                    $extencion = pathinfo($_FILES['comprobante']['name'], PATHINFO_EXTENSION);
                    $serverNameComprobante = uniqid('comprobante_',true).'.'.$extencion;
                    $dirDestinoComprobante = 'files/'.$boletaAlumno.'/'.$serverNameComprobante;

                    if(!is_dir('../../files/'.$boletaAlumno)){ mkdir('../../files/'.$boletaAlumno, 0777, true);}

                    $error = move_uploaded_file($_FILES['comprobante']['tmp_name'], "../../".$dirDestinoComprobante);
                }
                else
                {
                    echo "El archivo del comprobante no es de tipo PDF";
                    return 1;
                }
            }
            else
            {
                echo "El archivo pdf esta corrupto o excedió el tamaño límite aceptado";
                return 1;
            }
        }
        else
        {
            echo "Error al insertar debido a falta de archivo de comprobante: " . mysqli_error($conexion);
            return 1;
        }

        $estadoAlumno = identificarEstado($conexion, $boletaAlumno);
        
        if($estadoAlumno == 'E') //Si se encuentra en estado E entonces se puede transicionar a F
        {
            //Definición de consulta para cambiar el estado del alumno
            $query = "UPDATE Alumno SET estado = 'F' WHERE boleta = $boletaAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al actualizar el estado del alumno: " . mysqli_error($conexion);
                return 1;
            }
            
            $idAlumno = identificarAlumno($conexion,$boletaAlumno);

            //Definición de consulta para cambiar el estado del alumno
            $query = "UPDATE CasilleroAlumno SET comprobantePago = '$dirDestinoComprobante' WHERE idPersona = $idAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al actualizar el estado del alumno: " . mysqli_error($conexion);
                return 1;
            }
            return 0;
        }
        return 1;
    }

    #Función de transición F->H | Alumno con pago válido
    function transicionFH($conexion,$boletaAlumno, $casilleroAlumno)
    {
        $estadoAlumno = identificarEstado($conexion, $boletaAlumno);
        
        if($estadoAlumno == 'F') //Si se encuentra en estado F entonces se puede transicionar a H
        {
            //Definición de consulta para cambiar el estado del alumno
            $query = "UPDATE Alumno SET estado = 'H' WHERE boleta = $boletaAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al actualizar el estado del alumno: " . mysqli_error($conexion);
                return 1;
            }

            //Definición de consulta para cambiar el estado del alumno
            $query = "UPDATE CasilleroAlumno SET pagado = 1 WHERE idCasillero = $casilleroAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al actualizar el estado del pago: " . mysqli_error($conexion);
                return 1;
            }
            return 0;
        }
        return 1;
    }

    #Funcion de transición D-B | Admin asigna casillero a alumno
    function transicionDB($conexion,$boletaAlumno, $casilleroAlumno)
    {
        $estadoAlumno = identificarEstado($conexion, $boletaAlumno);
        
        if($estadoAlumno == 'D') //Si se encuentra en estado D entonces se puede transicionar a B
        {
            //Definición de consulta para cambiar el estado del alumno
            $query = "UPDATE Alumno SET estado = 'B', casillero = 1 WHERE boleta = $boletaAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al actualizar el estado del alumno: " . mysqli_error($conexion);
                return 1;
            }

            //Definición de consulta que que marca como asignado el casillero escoido por el Admin
            $query = "UPDATE Casillero SET asignado = 1 WHERE idCasillero = $casilleroAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al cambiar el estado del Casillero: " . mysqli_error($conexion);
                return 1;
            }
            
            $idAlumno = identificarAlumno($conexion, $boletaAlumno);

            //Definición de consulta que crea la relación CasilleroAlumno
            $query = "INSERT INTO CasilleroAlumno(idPersona, idCasillero, fechaSolicitud, pagado) VALUES($idAlumno, $casilleroAlumno, CURRENT_TIMESTAMP, 0);";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al registrar relacion CasilleroAlumno: " . mysqli_error($conexion);
                return 1;
            }

            //Definición de consulta que crea la relación en AdminCasillero
            $query = "INSERT INTO AdminCasillero(idPersona, idCasillero) VALUES(1,$casilleroAlumno);";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al crear relación de AdminCasillero: " . mysqli_error($conexion);
                return 1;
            }

            return 0;
        }
        return 1;
    }

    function transicionFG($conexion,$boletaAlumno, $casilleroAlumno)
    {
        $estadoAlumno = identificarEstado($conexion, $boletaAlumno);
        
        if($estadoAlumno == 'F') //Si se encuentra en estado F entonces se puede transicionar a G
        {
            //Definición de consulta para cambiar el estado del alumno
            $query = "UPDATE Alumno SET estado = 'G', casillero = 0 WHERE boleta = $boletaAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al actualizar el estado del alumno: " . mysqli_error($conexion);
                return 1;
            }

            //Definición de consulta que borra registro en CasilleroAlumno
            $query = "DELETE FROM CasilleroAlumno WHERE idCasillero = $casilleroAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al borrar registro de CasilleroAlumno: " . mysqli_error($conexion);
                return 1;
            }

            //Definición de consulta que libera casillero
            $query = "UPDATE Casillero SET asignado = 0 WHERE idCasillero = $casilleroAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al liberar casillero: " . mysqli_error($conexion);
                return 1;
            }

            //Definición de consulta que borra registro en AdminCasillero
            $query = "DELETE FROM AdminCasillero WHERE idCasillero = $casilleroAlumno";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al borrar registro de AdminCasillero: " . mysqli_error($conexion);
                return 1;
            }
            return 0;
        }
        return 1;
    }
    #Función que libera el casillero y transita al alumno a G
    function liberarCasillero($conexion,$boletaAlumno, $casilleroAlumno)
    {
        $estadoAlumno = identificarEstado($conexion, $boletaAlumno);
        
        if($estadoAlumno == 'B' || $estadoAlumno == 'E' || $estadoAlumno == 'F' || $estadoAlumno == 'H' || $estadoAlumno == 'I') //Si se encuentra en estado B,E,F,H,I entonces se puede transicionar a G
        {
            //Definición de consulta para cambiar el estado del alumno
            $query = "UPDATE Alumno SET estado = 'G', casillero = 0 WHERE boleta = $boletaAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al actualizar el estado del alumno: " . mysqli_error($conexion);
                return 1;
            }

            //Definición de consulta que borra registro en CasilleroAlumno
            $query = "DELETE FROM CasilleroAlumno WHERE idCasillero = $casilleroAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al borrar registro de CasilleroAlumno: " . mysqli_error($conexion);
                return 1;
            }

            //Definición de consulta que libera casillero
            $query = "UPDATE Casillero SET asignado = 0 WHERE idCasillero = $casilleroAlumno;";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al liberar casillero: " . mysqli_error($conexion);
                return 1;
            }

            //Definición de consulta que borra registro en AdminCasillero
            $query = "DELETE FROM AdminCasillero WHERE idCasillero = $casilleroAlumno";
            //Ejecución de consulta
            $resultado = mysqli_query($conexion,$query);

            if(!$resultado)
            {
                echo "Error al borrar registro de AdminCasillero: " . mysqli_error($conexion);
                return 1;
            }
            return 0;
        }
        return 1;
    }
?>
