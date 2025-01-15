<?php
    require "../../../db/conection/conection.php";
    session_start();
    $conexion = conectarBD();
    $boleta = $_SESSION['boleta'];
    transicionEF($conexion,$boleta);
    desconectarBD($conexion);
    $_SESSION['estado'] = "F";
    header("location:../../../frontend/profiles/alumno/alumno.php");

?>