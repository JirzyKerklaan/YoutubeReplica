<?php
    require 'config.php';
    $id = $_GET['videoID'];
    $query = "SELECT Views, Kanaalnaam FROM Videos WHERE videoID = $id";
    $result = mysqli_query($mysqli, $query);
    if ($result) {
        $item = mysqli_fetch_assoc($result);
        $newViews = $item['Views'] + 1;
        $UpdateQuery = "UPDATE Videos SET Views = '$newViews' WHERE videoID = $id";
        mysqli_query($mysqli, $UpdateQuery);
        header('Location: https://87252.stu.sd-lab.nl/beroeps/YoutubeReplica/bekijkpage/index.php?videoID='.$id.'&user='.$item['Kanaalnaam']);
    } else {
        echo "No video found";
        header('Location: https://87252.stu.sd-lab.nl/beroeps/YoutubeReplica/homepage/index.php');
    }
?>