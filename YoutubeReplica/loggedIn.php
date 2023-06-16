<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: ../Loginpage/Login.html");
        exit;
    }
?>