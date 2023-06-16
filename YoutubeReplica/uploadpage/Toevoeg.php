<?php
    require 'config.php';
    require_once 'loggedIn.php';

    
if (isset($_POST['verzend'])) {
    $videoSize = $_FILES["video"]["size"];
    if ($videoSize < 16000000) {
    $title = $_POST['title'];
    $bio = $_POST['bio'];
    $timestamp = time();

    $tags = $_POST['tag'];

    $selQuery = "SELECT username FROM user WHERE AccountID =". $_SESSION['username'];
    $selResult = mysqli_query($mysqli, $selQuery);
    if ($selResult) {
        while($row = $selResult->fetch_assoc()) {
            $kanaalNaam = $row['username'];
        }
    }
    else {
        echo "geen account gevonden";
    }

    $tempnameThumbnail = $_FILES["thumbnail"]["tmp_name"];
    $ThumbnailName = $_FILES["thumbnail"]["name"];
    $image_info = explode(".", $ThumbnailName);
    $extThumbnail = end($image_info);
    $uploadedfilenameThumbnail = $kanaalNaam;
    $filenameThumbnail = $timestamp . '-' . $uploadedfilenameThumbnail . "." . $extThumbnail;
    
    $tempnameVideo = $_FILES["video"]["tmp_name"];
    $videoName = $_FILES["video"]["name"];
    $video_info = explode(".", $videoName);
    $extVideo = end($video_info);
    $uploadedfilenameVideo = $kanaalNaam;
    $filenameVideo = $timestamp . '-' . $uploadedfilenameVideo . "." . $extVideo;

        $query = "INSERT INTO Videos (Titel, VideoLink, ThumbnailLink, Beschrijving, Tags, Kanaalnaam)";
        $query .= "VALUES ('{$title}', '{$filenameVideo}', '{$filenameThumbnail}', '{$bio}', '{$tags}', '{$kanaalNaam}')";

        $result = mysqli_query($mysqli, $query);

        if ($result) {
            if (move_uploaded_file($tempnameThumbnail, "../thumbnails/" . $filenameThumbnail)){
                echo "$filenameThumbnail is ge-upload! <br><br>";
            }
            else {
                echo "Uploaden van Thumbnail mislukt <br />";
            }
            if (move_uploaded_file($tempnameVideo, "../videos/" . $filenameVideo)){
                echo "verplaatsen gelukt!";
            }
            else {
                echo "Uploaden van Video mislukt <br />";
            }
            echo "toevoegen gelukt! <br />";
            header('Location: ../homepage/index.php');
        }

        else {
            echo "FOUT bij het toevoegen! <br />";
            echo mysqli_error($mysqli);
        }
    }
    else {
        echo "video bestand te groot!";
        echo "het bestand is: " . $videoSize;
    }
}
?>













