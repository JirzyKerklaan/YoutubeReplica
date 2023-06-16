<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $db_hostname = 'localhost';
    $db_username = 'YoutubeRepSite';
    $db_password = 'YoutubeReplica';
    $db_database = 'YoutubeRep';

    $mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

    if(!$mysqli) {
        echo "fout: geen connectie naar database. <br>";
        echo "Error: " . mysqli_connect_error() . "<br/>";
        exit;
    }
?>