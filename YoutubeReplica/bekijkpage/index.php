<?php 
require '../config.php';
$username = $_GET['user'];

$CreatorAcc = "SELECT AccountID FROM user WHERE username = '$username'";
$AccRes = mysqli_query($mysqli, $CreatorAcc);
if ($AccRes) {
    while ($item3 = mysqli_fetch_assoc($AccRes)) {
        $CreatorAccountID = $item3['AccountID'];
            }
        }
?>

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
                <?php } else { ?>
                    <a href='../accoverzichtpage/creator.php'>
                    <div id="div4" class="blackBG navbarIcon">
                    <i class="fa fa-user"></i>
                    <span class='navBarText'>Account</span>
                    </div></a>
                <?php } ?>
                <a href='../contactpage/index.php'>
                <div id="div5" class="blackBG navbarIcon">
                    <i class="fa fa-envelope"></i>
                    <span class='navBarText'>Contact us</span>
                </div></a>
            </div>
        <!--------Content-------------->
            <?php 
                require 'config.php';

                $queryUser = "SELECT ProfilePic, AccountID FROM user WHERE username = '$username'";
                $resultUser = mysqli_query($mysqli, $queryUser);
                if ($resultUser) {
                    while ($itemUser = mysqli_fetch_assoc($resultUser)) {
                        $profilePic = $itemUser['ProfilePic'];
                        $AccountID = $itemUser['AccountID'];
                    }
                }
                $id = $_GET['videoID'];
                $query = "SELECT * FROM Videos WHERE videoID = '$id'";
                $result = mysqli_query($mysqli, $query);
                if ($result) {
                    while ($item = mysqli_fetch_assoc($result)) {
            ?>
        <div id="content">
            <div id="container" class="smallRoundedCorner">
                <div id="videoBox" class="blackBG smallRoundedCorner">
                    <video width='100%' height='100%' controls class="smallRoundedCorner">
                        <source src='../videos/<?php echo $item['VideoLink']?>' type='video/*'>
                        <source src='../videos/<?php echo $item['VideoLink']?>' type='video/ogg'>
                </div>
                <div id="channelBox" class="smallRoundedCorner whiteBG">
                    <div id='pictureCenter'>
                        <div id="channelPicture" style="background-image: url('../profilePic/<?php echo $profilePic;?>'); background-size: cover; background-position: center;"></div>  
                    </div>
                    <div id="channelName"><h4><?php echo $item['Kanaalnaam'];?></h4></div>
                    <div class='smallRoundedCorner'><?php
                    if(isset($_SESSION['username'])){
                        $curUser = $_SESSION['username'];
                        $queryCheck = "SELECT * FROM follow WHERE FanAccountID = $curUser AND CreatorAccountID = $AccountID";
                        $resultCheck = mysqli_query($mysqli, $queryCheck);
                        if($resultCheck->num_rows == 0){?>
                            <form action="../followSystem/startFollow.php" method="POST" name='volgen'>
                            <input type='hidden' name='creatorID' value='<?php echo $CreatorAccountID; ?>'>
                                <input type="submit" name="verzend" value="<?php echo 'Volgen';?>" id="followButton" />
                            <?php } else { ?>
                                <form action="../followSystem/StopFollow.php" method="POST" name='volgen'>
                                <input type='hidden' name='creatorID' value='<?php echo $CreatorAccountID; ?>'>
                                <input type="submit" name="verzend" value="<?php echo 'Volgend';?>" id="followButton" />
                            <?php }
                            } else { ?>
                                <form action="" method="POST" name='volgen'>
                                <input type='hidden' name='creatorID' value='<?php echo $CreatorAccountID; ?>'>
                                <input type="submit" name="verzend" value="*Login om te beginnen met volgen" id="followButtonNI" />
                            <?php 
                            }
                            ?>
                    </form>
                </div>
                    <div id="videoInfo">
                        <h1><?php echo $item['Titel'];?></h1>
                        <p><?php echo $item['Beschrijving'];?></p>
                            <div id="extraInfo">
                                <a href="./comments/comments.php?kanaalNaam=<?php echo $item['Kanaalnaam']."&vidID=".$item['videoID'];?>"><button class='button smallRoundedCorner'>comments</button></a>
                                <div id="views"><b>Weergave: </b><?php echo $item['Views'];?></div>
                                <div id="followers"><b>Followers: </b>
                                <?php
                                    $query2 = "SELECT COUNT(FanAccountID) FROM follow WHERE CreatorAccountID = $AccountID";
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
                                ?>
                            </div>
                            </div>
                    </div>
                </div>
                <div id="descBox" class="smallRoundedCorner whiteBG">
                    <h3>Meer video's van <?php echo $item['Kanaalnaam'];?>,</h3>
                    <?php
                    $kanaalNaam = $item['Kanaalnaam'];
                            }
                        }
                    ?>
                    <!--PHP code voor aanbevolen van dit kanaal-->        
                    <div id='aanbVideoList'>       
                    <?php
                        require 'config.php';

                        $aanbevolenQuery = "SELECT * FROM Videos WHERE Kanaalnaam = '$kanaalNaam' ORDER BY Views DESC LIMIT 4";
                        $result2 = mysqli_query($mysqli, $aanbevolenQuery);
                        if ($result2) {
                            while ($item2 = mysqli_fetch_assoc($result2)) {
                                echo "<a href = './viewCounter.php?videoID=".$item2['videoID']."'>";
                                echo "<div class='aanbVideoBox' class='whiteBG'>";
                                ?>
                                    <img height='100%' width='100%' src='../thumbnails/<?php echo $item2['ThumbnailLink'];?>'>
                                <?php
                                echo $item2['Titel'];
                                echo "</div>";
                                echo "</a>";
                                    }
                                }
                                ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>