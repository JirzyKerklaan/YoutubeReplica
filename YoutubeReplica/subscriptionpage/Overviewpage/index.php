<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/UPipe.png">
    <title>uPipe - Unhide yourself</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

    <body>
        <div id="MainGrid">
        <!--Navigation Bar-->
        <div class="navbar blackBG">
            <a href='../../homepage/index.php'>
                <div id="div1" class="blackBG navbarIcon">
                    <i class="fa fa-home"></i>
                    <span class='navBarText'>Home</span>
                </div></a>
                <a href='../../trendingpage/index.php'>
                <div id="div2" class="blackBG navbarIcon">
                    <i class="fa fa-globe"></i>
                    <span class='navBarText'>Trending</span>
                </div></a>
                <a href='../index.php'>
                <div id="div3" class="blackBG navbarIcon">
                    <i class="fa fa-users"></i>
                    <span class='navBarText'>Subscriptions</span>
                </div></a>
                <?php
                session_start();
                if (!isset($_SESSION['username'])) {
                ?>
                <a href='../../Loginpage/Login.html'>
                <div id="div4" class="blackBG navbarIcon">
                    <i class="fa fa-user"></i>
                    <span class='navBarText'>Log In</span>
                </div></a>
                <?php } else { 
                    if ($accType = 'creator') {
                        ?>
                    <a href='../../accoverzichtpage/creator.php'>
                    <div id="div4" class="blackBG navbarIcon">
                    <i class="fa fa-user"></i>
                    <span class='navBarText'>Account</span>
                </div></a>
                        <?php
                    } else {
                        ?>
                    <a href='../../accoverzichtpage/fan.php'>
                    <div id="div4" class="blackBG navbarIcon">
                    <i class="fa fa-user"></i>
                    <span class='navBarText'>Account</span>
                </div></a>
                        <?php
                    }    
                }
                ?>
                <a href='../contactpage/index.php'>
                <div id="div5" class="blackBG navbarIcon">
                    <i class="fa fa-envelope"></i>
                    <span class='navBarText'>Contact us</span>
                </div></a>
            </div>
        <!--------Content-------------->
        <div id="content">
            <h2>Alle video's van <?= $_GET['user'];?></h2>
        <?php 
            $user = $_GET['user'];
                require 'config.php';
                $query = "SELECT * FROM Videos WHERE Kanaalnaam = '$user'";
                $result = mysqli_query($mysqli, $query);
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($item = mysqli_fetch_assoc($result)) {
                            $image = "<img id='thumbnailIMG' class='smallRoundedCorner' draggable='false' src='../../thumbnails/".$item["ThumbnailLink"]."'><br />";
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
        </div>
    </body>
</html>