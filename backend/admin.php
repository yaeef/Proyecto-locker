<?php
    require "../db/conection/conection.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if(!isset($_POST['usuario'])) {header("location:../frontend/admin.php?notif=-3");}
        if(!isset($_POST['password'])) {header("location:../frontend/admin.php?notif=-3");}

        $conexion = conectarBD();
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $existeUsuarioAdmin = evaluarExistenciaAdmin($conexion,$usuario);

        if($existeUsuarioAdmin)
        {
            $admin = recuperarAdminConUsuario($conexion, $usuario);
            if($password == $admin['contrasena'])
            {
                session_start();
                $_SESSION['nombre'] = $admin['nombre'];
                $_SESSION['paterno'] = $admin['paterno'];
                $_SESSION['materno'] = $admin['materno'];
                $_SESSION['usuario'] = $admin['usuario'];
                $_SESSION['noEmpleado'] = $admin['noEmpleado'];
                $_SESSION['session'] = 'admin';

                desconectarBD($conexion);
                header("location:../frontend/profiles/admin/admin.php");
                exit();
            }
            else
            {
                desconectarBD($conexion);
                header("location:../frontend/admin.php?notif=21");
                exit();
            }
        }
        else
        {
            desconectarBD($conexion);
            header("location:../frontend/admin.php?notif=20");
            exit();
        }
    }
    else
    {
        header("location:../frontend/admin.php?notif=-2");
        exit();
    }
?>