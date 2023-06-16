<?php
require '../config.php';
    session_start();
    $selQuery = "SELECT * FROM user WHERE AccountID =". $_SESSION['username'];
    $selResult = mysqli_query($mysqli, $selQuery);
    if ($selResult) {
        while($row = $selResult->fetch_assoc()) {
            $AccountType = $row['AccountType'];
        }
    }
    if ($AccountType == 'creator') {
        header("Location: ../creator.php");
    }
    else if($AccountType == 'fan') {
        header("Location: ../fan.php");
    } else {
        echo "error";
    }
?>