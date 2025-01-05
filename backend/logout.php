<?php
    session_start();
    session_destroy();
    header("location: ../frontend/acceso.php?notif=100");
    exit();
?> 