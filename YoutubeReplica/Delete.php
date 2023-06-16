<?php
    require 'config.php';

    $id = $_GET['id'];
    $videoFile = $_GET['vidfile'];
    $thumbFile = $_GET['thumbfile'];

    echo $id . "<br />";
    echo $videoFile . "<br />";
    echo $thumbFile . "<br />";

    $pathVid = "videos/".$videoFile;
    if(unlink($pathVid)) {
        echo "video deleted <br />";
    } else {
        echo "kan geen video met naam ". $videoFile. "vinden! <br />";
    }

    $pathThumb = "thumbnails/".$thumbFile;
    if(unlink($pathThumb)) {
        echo "thumbnail deleted <br />";
    } else {
        echo "kan geen thumbnail met naam ". $thumbFile. "vinden! <br />";
    }
    $query = "DELETE FROM Videos WHERE videoID = " . $id;

    $result = mysqli_query($mysqli, $query);

    if ($result) {
        echo "Het item is verwijderd! <br />";
        header("Location: ShowAll.php");
    }

    else {
        echo "FOUT bij het verwijderen! <br />";
        echo mysqli_error($mysqli);
    }
?>