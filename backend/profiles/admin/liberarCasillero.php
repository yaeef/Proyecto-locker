<?php
    require "../../../db/conection/conection.php";
    $conexion = conectarBD();    
    $idCasillero = $_POST['idCasilleroLiberar'];
    $boletaAlumno = $_POST['inputAlumnoLiberar'];
    liberarCasillero($conexion,$boletaAlumno,$idCasillero);
    desconectarBD($conexion);
    header("location:../../../frontend/profiles/admin/admin.php?notif=904");
    exit();
?>