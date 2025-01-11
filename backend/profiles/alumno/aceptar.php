<?php
    require "../../../db/conection/conection.php";
    session_start();
    $conexion = conectarBD();    
    $boletaAlumno = $_SESSION['boleta'];
    transicionBE($conexion,$boletaAlumno);
    desconectarBD($conexion);
    $_SESSION['estado'] = "E";
    header("location:../../../frontend/profiles/alumno/alumno.php");
    exit();
?>