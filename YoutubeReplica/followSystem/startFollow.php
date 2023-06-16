<?php
    require 'config.php';
    require_once 'loggedIn.php';
    if ($_SESSION['type'] == 'fan') {
    $CreatorAccountID = $_POST['creatorID'];
    $FanAccountID = $_SESSION['username'];
    $query=  "INSERT INTO follow (FanAccountID, CreatorAccountID) VALUES ('$FanAccountID', '$CreatorAccountID')";

        $return = mysqli_query($mysqli, $query);

        if($return) {
            header("location:../subscriptionpage/index.php");
        } else {
            echo 'failed!';
        }
    } else {
        header("location:javascript://history.go(-1)");
    }
?>