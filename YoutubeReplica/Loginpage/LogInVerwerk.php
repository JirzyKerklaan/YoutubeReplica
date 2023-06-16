<?php
    require 'config.php';
    if (isset($_POST['login'])) {
        $uname = $_POST['userName'];
        $password = md5($_POST['password']);

        $query = "SELECT * FROM user WHERE username = '$uname' && Password = '$password'";
        $result = mysqli_query($mysqli, $query);
        if ($result) {
            if($ret['AccountID'] == null || $ret['AccountType'] == null) {
                echo "<script>alert('Ongeldige accountdata');</script>";
                echo "<script type='text/javascript'>document.location='Login.html';</script>";
            }
            session_start();
            while ($ret = $result->fetch_assoc()) {
                $_SESSION['username']=$ret['AccountID'];
                $_SESSION['type']=$ret['AccountType'];
                if ($ret['AccountType'] == 'creator') {
                    header("Location: ../accoverzichtpage/creator.php");
                } else {      
                    header("Location: ../accoverzichtpage/fan.php");           
                }
            }
        }
        else {
            echo "<script>alert('Ongeldige accountdata');</script>";
            echo "<script type='text/javascript'>document.location='Login.html';</script>";
        }
    }
?>