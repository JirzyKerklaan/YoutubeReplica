<?php
    session_start();
    if ($_SESSION['type'] == 'fan') {
        header("Location: ../homepage/index.php");
        exit;
    }
?>