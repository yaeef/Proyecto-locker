<?php
    $errores = array(); //Manejo de errores en forma de alerta mediante get
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        echo '<h1>Driver de inicio de sesion ADMIN</h1>';
        var_dump($_POST);
        echo '<br><a href="../frontend/admin.php">logout</a>';
    }
    else
    {
        echo "Acceso denegado, Metodo POST No detectado";
        header("location:../frontend/solicitud.php");
    }
?>