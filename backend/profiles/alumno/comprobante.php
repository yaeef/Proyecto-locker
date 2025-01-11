<?php
    require "../../../db/conection/conection.php";
    session_start();
    $conexion = conectarBD();
    $boleta = $_SESSION['boleta'];
    transicionEF($conexion,$boleta);
    desconectarBD($conexion);
    $_SESSION['estado'] = "F";
    session_destroy();
    $_SESSION = array();
    header("location:../../../frontend/acceso.php?notif=101");

?>