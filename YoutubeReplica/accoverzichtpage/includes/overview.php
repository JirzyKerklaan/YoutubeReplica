<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPipe - Unhide Yourself</title>
    <link rel="stylesheet" href="./includes/creator_overview.css">
</head>
<body>
    <h1>Uw video's</h1>
    <?php

?>
        <!--------Content-------------->
    <div id="content">
        <?php 
                require 'config.php';

                $selQuery = "SELECT * FROM user WHERE AccountID =". $_SESSION['username'];
                $selResult = mysqli_query($mysqli, $selQuery);
                if ($selResult) {
                    while($row = $selResult->fetch_assoc()) {
                        $kanaalNaam = $row['username'];
                    }
                }

                $query = "SELECT * FROM Videos WHERE Kanaalnaam = '$kanaalNaam'";
                $result = mysqli_query($mysqli, $query);
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($item = mysqli_fetch_assoc($result)) {
                            $image = "<img id='thumbnailIMG' class='smallRoundedCorner' draggable='false' src='../thumbnails/".$item["ThumbnailLink"]."'><br />";
        ?>
            <a href="../bekijkpage/viewCounter.php?videoID=<?php echo "".$item["videoID"];?>">
                <div id="videoBox" class="videoBox smallRoundedCorner">
                    <?php
                        if($item["Tags"] == "Music"){
                            ?><div id="thumnnailBox" class="thumnnailBox smallRoundedCorner greyBG yellowBorder"><?php echo $image?></div><?php
                        }
                        else if ($item["Tags"] == "Movies"){
                            ?><div id="thumnnailBox" class="thumnnailBox smallRoundedCorner greyBG purpleBorder"><?php echo $image?></div><?php
                        }
                        else if ($item["Tags"] == "News"){
                            ?><div id="thumnnailBox" class="thumnnailBox smallRoundedCorner greyBG blueBorder"><?php echo $image?></div><?php
                        }
                        else if ($item["Tags"] == "Sport"){
                            ?><div id="thumnnailBox" class="thumnnailBox smallRoundedCorner greyBG orangeBorder"><?php echo $image?></div><?php
                        }
                        else if ($item["Tags"] == "Games"){
                            ?><div id="thumnnailBox" class="thumnnailBox smallRoundedCorner greyBG redBorder"><?php echo $image?></div><?php
                        }?>
                    <div id="title" class="titleBox"><h4><b><?php echo $item["Titel"]?></b></h4></div>
                    <div id="channelname" class="channelnameBox"><?php echo $item["Kanaalnaam"]?>, <span class='viewsBox'><?php echo $item['Views']?></span></div>
                    <div id="tagsBox">Tags: <?php 
                        if($item["Tags"] == "Music"){
                            ?><span class='yellowText'><?php echo $item["Tags"]?></span><?php
                        }
                        else if ($item["Tags"] == "Movies"){
                            ?><span class='purpleText'><?php echo $item["Tags"]?></span><?php
                        }
                        else if ($item["Tags"] == "News"){
                            ?><span class='blueText'><?php echo $item["Tags"]?></span><?php
                        }
                        else if ($item["Tags"] == "Sport"){
                            ?><span class='orangeText'><?php echo $item["Tags"]?></span><?php
                        }
                        else if ($item["Tags"] == "Games"){
                            ?><span class='redText'><?php echo $item["Tags"]?></span><?php
                        }?></div>
                </div>
            </a>
        <?php
            }
                } else {
                    echo "Geen resultaten";
                    }
                echo "</table>";
            }
            else {
                echo "FOUT bij het ophalen! <br />";
                echo mysqli_error($mysqli);
            }
            ?>