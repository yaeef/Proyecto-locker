<?php
    require "../../../db/conection/conection.php";
    $conexion = conectarBD();    
    $idCasillero = $_POST['idCasilleroAsignar'];
    $boletaAlumno = $_POST['inputAlumnoAsignar'];
    transicionDB($conexion,$boletaAlumno,$idCasillero);
    desconectarBD($conexion);
    header("location:../../../frontend/profiles/admin/admin.php?notif=902");
    exit();
?>


transicionDB($conexion,$boletaAlumno, $casilleroAlumno)