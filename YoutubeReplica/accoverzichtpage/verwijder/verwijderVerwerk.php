<?php
    require '../config.php';
    session_start();
    echo $_SESSION['username'];
    $selQuery = "SELECT * FROM user WHERE AccountID =". $_SESSION['username'];
    $selResult = mysqli_query($mysqli, $selQuery);
    if ($selResult) {
        while($row = $selResult->fetch_assoc()) {
            $AccountID = $row['AccountID'];
            $user = $row['username'];
            $AccountType = $row['AccountType'];
        }
    } else {
        echo 'geen account gevonden.';
    }
    echo $AccountID;
    echo $user;
    echo $AccountType;
    if ($AccountID == null || $user == null || $AccountType == null) {
        session_destroy();
        header("Location: ../../homepage/");
    }

    if($AccountType == 'creator') {
        $query1 = "DELETE FROM comments WHERE AccountID = $AccountID";
        $Result1 = mysqli_query($mysqli, $query1);
        if($Result1) {
            echo 'verwijderen comments gelukt';
        } else {
            echo 'error bij verwijderen comments!';
        }
        $query1 = "DELETE FROM follow WHERE CreatorAccountID = $AccountID";
        $Result1 = mysqli_query($mysqli, $query1);
        if($Result1) {
            echo 'verwijderen volgers gelukt';
        } else {
            echo 'error bij verwijderen volgers!';
        }
        $query1 = "DELETE FROM Videos WHERE Kanaalnaam = '$user'";
        $Result1 = mysqli_query($mysqli, $query1);
        if($Result1) {
            echo 'verwijderen videos gelukt';
        } else {
            echo 'error bij verwijderen videos!';
        }
        $query1 = "DELETE FROM user WHERE AccountID = $AccountID";
        $Result1 = mysqli_query($mysqli, $query1);
        if($Result1) {
            echo 'verwijderen account gelukt';
        } else {
            echo 'error bij verwijderen account!';
        }
        session_abort();
        header("Location: ../../homepage/");
    } else {
        session_abort();
    }
?>