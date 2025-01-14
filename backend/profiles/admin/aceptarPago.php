<?php
    require "../../../db/conection/conection.php";
    $conexion = conectarBD();    
    $idCasillero = $_POST['idCasilleroAceptar'];
    $boletaAlumno = $_POST['inputAlumnoAceptar'];
    transicionFH($conexion,$boletaAlumno,$idCasillero);
    desconectarBD($conexion);
    header("location:../../../frontend/profiles/admin/admin.php?notif=901");
    exit();
?>