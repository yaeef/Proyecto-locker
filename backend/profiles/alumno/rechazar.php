<?php
    require "../../../db/conection/conection.php";
    session_start();
    $conexion = conectarBD();    
    $boletaAlumno = $_SESSION['boleta'];
    $identificadorAlumno = identificarAlumno($conexion,$boletaAlumno);
    $casilleroAlumno = identificarCasillero($conexion, $identificadorAlumno);
    transicionBG($conexion,$boletaAlumno,$casilleroAlumno);
    desconectarBD($conexion);
    $_SESSION['estado'] = "G";
    session_destroy();
    header("location:../../../frontend/acceso.php?notif=23");
    exit();
?>
