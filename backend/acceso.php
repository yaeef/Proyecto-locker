<?php
    require "../db/conection/conection.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if(!isset($_POST['usuario'])) {header("location:../frontend/solicitud.php?notif=-3");}
        if(!isset($_POST['password'])) {header("location:../frontend/solicitud.php?notif=-3");}

        $conexion = conectarBD();
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $existeUsuario = evaluarExistencia($conexion,$usuario,'usuario');

        if($existeUsuario)
        {
            $alumno = recuperarAlumnoConUsuario($conexion, $usuario);
            if(password_verify($password, $alumno['contrasena']))
            {
                session_start();
                $_SESSION['nombre'] = $alumno['nombre'];
                $_SESSION['paterno'] = $alumno['paterno'];
                $_SESSION['materno'] = $alumno['materno'];
                $_SESSION['estado'] = $alumno['estado'];
                $_SESSION['usuario'] = $alumno['usuario'];
                $_SESSION['casillero'] = $alumno['casillero'];
                $_SESSION['boleta'] = $alumno['boleta'];
                $_SESSION['session'] = 1;

                desconectarBD($conexion);
                header("location:../frontend/profiles/alumno/alumno.php");
                exit();
            }
            else
            {
                desconectarBD($conexion);
                header("location:../frontend/acceso.php?notif=21");
                exit();
            }
        }
        else
        {
            desconectarBD($conexion);
            header("location:../frontend/acceso.php?notif=20");
            exit();
        }
    }
    else
    {
        header("location:../frontend/acceso.php?notif=-2");
        exit();
    }
?>