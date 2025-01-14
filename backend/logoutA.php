<?php
    session_start();
    unset($_SESSION['session']);
    session_destroy();
    $_SESSION = array();
    header("location: ../frontend/admin.php?notif=100");
    exit();
?> 