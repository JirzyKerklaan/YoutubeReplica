<?php
    require 'config.php';
    require_once 'loggedIn.php';
    $username = $_GET['kanaalNaam'];
    $vidID = $_GET['vidID'];
    if (isset($_POST['submit'])) {
        $VideoID = $_POST['VideoID'];
        $AccountID = $_POST['AccountID'];
        $comment = $_POST['comment'];

        $query = "INSERT INTO comments (VideoID, AccountID, comment)";
        $query .= " VALUES ('{$VideoID}', '{$AccountID}', '{$comment}')";

        $result = mysqli_query($mysqli, $query);
        if ($result) { 
            header("Location: ./comments.php?kanaalNaam=$username&vidID=$vidID");
        } else {
            echo "plaatsen van comment mislukt!";
        }
    } else {
        echo "geen comment gevonden";
    }
?>