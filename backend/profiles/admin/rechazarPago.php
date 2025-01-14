<?php
    require "../../../db/conection/conection.php";
    $conexion = conectarBD();    
    $idCasillero = $_POST['idCasilleroRechazar'];
    $boletaAlumno = $_POST['inputAlumnoRechazar'];
    transicionFG($conexion,$boletaAlumno,$idCasillero);
    desconectarBD($conexion);
    header("location:../../../frontend/profiles/admin/admin.php?notif=903");
    exit();
?>