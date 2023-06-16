<?php
    session_start();
    if ($_SESSION['type'] == 'creator') {
        header("Location: ./Overviewpage/index.php");
        exit;
    }
?>