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
            <a href='../homepage/index.php'>
                <div id="div1" class="blackBG navbarIcon">
                    <i class="fa fa-home"></i>
                    <span class='navBarText'>Home</span>
                </div></a>
                <a href='../trendingpage/index.php'>
                <div id="div2" class="blackBG navbarIcon">
                    <i class="fa fa-globe"></i>
                    <span class='navBarText'>Trending</span>
                </div></a>
                <a href='../subscriptionpage/index.php'>
                <div id="div3" class="blackBG navbarIcon">
                    <i class="fa fa-users"></i>
                    <span class='navBarText'>Subscriptions</span>
                </div></a>
                <?php
                session_start();
                if (!isset($_SESSION['username'])) {
                ?>
                <a href='../Loginpage/Login.html'>
                <div id="div4" class="blackBG navbarIcon">
                    <i class="fa fa-user"></i>
                    <span class='navBarText'>Log In</span>
                </div></a>
                <?php } else { 
                    if ($accType = 'creator') {
                        ?>
                    <a href='../accoverzichtpage/creator.php'>
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
            <div id="tagBar">
                <a href='./index.php'>
                <div id="trending" class="tagBarBox blackBG smallRoundedCorner">
                    <div id="icon" class="iconFont"><i class="fa fa-globe"></i></div>
                    <div id="subTitle" class="fontWhite">Trending</div>
                </div>
                </a>
                <a href='./index.php?tag=Music'>
                    <div id="music" class="tagBarBox blackBG smallRoundedCorner">
                        <div id="icon" class="iconFont"><i class="fa fa-music"></i></div>
                        <div id="subTitle" class="fontWhite">Muziek</div>
                    </div>
                </a>
                <a href='./index.php?tag=Movies'>
                <div id="movies" class="tagBarBox blackBG smallRoundedCorner">
                    <div id="icon" class="iconFont"><i class="fa fa-film"></i></div>
                    <div id="subTitle" class="fontWhite">Films</div>
                </div>
                </a>
                <a href='./index.php?tag=News'>
                <div id="news" class="tagBarBox blackBG smallRoundedCorner">
                    <div id="icon" class="iconFont"><i class="fa fa-newspaper-o"></i></i></div>
                    <div id="subTitle" class="fontWhite">Nieuws</div>
                </div>
                </a>
                <a href='./index.php?tag=Sport'>
                <div id="sport" class="tagBarBox blackBG smallRoundedCorner">
                    <div id="icon" class="iconFont"><i class="fa fa-futbol-o"></i></div>
                    <div id="subTitle" class="fontWhite">Sport</div>
                </div>
                </a>
                <a href='./index.php?tag=Games'>
                <div id="games" class="tagBarBox blackBG smallRoundedCorner">
                    <div id="icon" class="iconFont"><i class="fa fa-gamepad"></i></div>
                    <div id="subTitle" class="fontWhite">Games</div>
                </div>
                </a>
            </div>
            <?php
                require 'config.php';
                if ($_SERVER['REQUEST_URI'] == '/beroeps/YoutubeReplica/trendingpage/index.php') {
                    $query = "SELECT * FROM Videos ORDER BY Views DESC";
                    $result = mysqli_query($mysqli, $query);
                }
                else {
                    if ($_GET['tag']=='Music') {
                    $query = "SELECT * FROM Videos WHERE Tags = 'Music'";
                    $result = mysqli_query($mysqli, $query);
                    }
                    else if ($_GET['tag']=='Movies') {
                        $query = "SELECT * FROM Videos WHERE Tags = 'Movies'";
                        $result = mysqli_query($mysqli, $query);
                    }
                    else if ($_GET['tag']=='News') {
                        $query = "SELECT * FROM Videos WHERE Tags = 'News'";
                        $result = mysqli_query($mysqli, $query);
                    }
                    else if ($_GET['tag']=='Sport') {
                        $query = "SELECT * FROM Videos WHERE Tags = 'Sport'";
                        $result = mysqli_query($mysqli, $query);
                    }
                    else if ($_GET['tag']=='Games') {
                        $query = "SELECT * FROM Videos WHERE Tags = 'Games'";
                        $result = mysqli_query($mysqli, $query);
                    }
                }
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($item = mysqli_fetch_assoc($result)) {
            ?>
            <a href="../bekijkpage/viewCounter.php?videoID=<?php echo "".$item["videoID"];?>">
            <div class="videoBox whiteBG smallRoundedCorner">
                <div class="thumbnailPicture smallRoundedCornerLeft" style="background-size: cover; background-repeat: no-repeat; background-position: center; background-image: url(../thumbnails/<?php echo $item["ThumbnailLink"]?>);"><?php ?></div>
                <div class="textBox" class="smallRoundedCorner">
                    <div class="titleText"><h2><?php echo $item["Titel"];?></h2></div>
                    <div class="infoText"><?php echo $item["Kanaalnaam"]; echo ", "; $kanaal = $item["Kanaalnaam"];

                                $test = "SELECT * FROM user WHERE username = '$kanaal'";
                                $testresult = mysqli_query($mysqli, $test);
                                if ($testresult) {
                                    if ($testresult->num_rows > 0) {
                                        while ($testItem = mysqli_fetch_assoc($testresult)) {
                                            $accID = $testItem['AccountID'];
                                $query2 = "SELECT COUNT(FanAccountID) FROM follow WHERE follow.CreatorAccountID = $accID";
                                $result2 = mysqli_query($mysqli, $query2);
                                if ($result2) {
                                    if ($result2->num_rows > 0) {
                                        while($row2 = $result2->fetch_assoc()) {
                                            echo $row2['COUNT(FanAccountID)'];
                                        }
                                    }
                                } else {
                                    echo 'geen volgers';
                                }
                            ?></div>
                    <div class="infoText" id="tagsBox">Tags: <?php 
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
                        <div class="infoText" id="viewsBox">Weergave: <?php echo $item['Views'];?></div>
                </div>
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
                                                    }
                                    }
                                }
            ?>
        </div>
    </body>
</html>





