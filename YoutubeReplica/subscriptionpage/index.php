<?php
require 'config.php';
require_once '../loggedIn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/UPipe.png">
    <title>uPipe - Unhide yourself</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./recommended.css">
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
                    <a href='../accoverzichtpage/creator.php'>
                    <div id="div4" class="blackBG navbarIcon">
                    <i class="fa fa-user"></i>
                    <span class='navBarText'>Account</span>
                </div></a>
                <a href='../contactpage/index.php'>
                <div id="div5" class="blackBG navbarIcon">
                    <i class="fa fa-envelope"></i>
                    <span class='navBarText'>Contact us</span>
                </div></a>
            </div>
        

        <!--------Content-------------->
    <div id="content">
        <div class="parent"><?php
            require 'config.php';
            $user = $_SESSION['username'];
            $query = "SELECT * FROM follow INNER JOIN user ON follow.CreatorAccountID = user.AccountID WHERE follow.FanAccountID = $user ORDER BY user.username";
            $result = mysqli_query($mysqli, $query);
            if ($result) {
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $AccID = $row['CreatorAccountID'];
                        ?>
                        <a href='./Overviewpage/index.php?user=<?php echo $row['username']; ?>'>
                        <div class="div">
                            <div class="profile_picture" style="background-image: url('.././profilePic/<?php echo $row['ProfilePic'];?>'); background-size: cover; background-position: center;"></div>
                            <div class="kanaalnaam"><?php echo $row['username'] ?></div>
                            <div class="volgers"><?php 
                                $query2 = "SELECT COUNT(FanAccountID) FROM follow WHERE CreatorAccountID = $AccID";
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
                            <div id="unFollowButton">
                                <form method='POST' action='../followSystem/StopFollow.php'>
                                <input type='hidden' name='creatorID' value='<?php echo $AccID; ?>'>
                                    <input type='submit' name='verzend' class='stopFollowButton' value='Volgend'>
                                </form>
                            </div>
                    </div>
                </div></a><?php
                        }
                    } else {
                        if($_SESSION['type'] == 'fan') {
                        echo "<h1>Begin met het volgen van kanalen</h1>
                        <hr style='border-top: 1px solid #131313;'>";
                        }?>
                        <div id='recommendedBox'><h3>Meest geabboneerde kanalen:</h3></div>
                        <?php
                        $queryRandomAcc = "SELECT COUNT(FanAccountID), CreatorAccountID FROM follow GROUP BY CreatorAccountID ORDER BY COUNT(FanAccountID) DESC LIMIT 27";
                        $resulRanAcc2 = mysqli_query($mysqli, $queryRandomAcc);
                        if ($resulRanAcc2) {
                            if ($resulRanAcc2->num_rows > 0) {
                                while($rowRanAcc = $resulRanAcc2->fetch_assoc()) {
                                    $SelAccountID = $rowRanAcc['CreatorAccountID'];
                                    $queryFullAccSel = "SELECT * FROM user WHERE AccountID = $SelAccountID";
                                    $resFullAcc = mysqli_query($mysqli, $queryFullAccSel);
                                    if($resFullAcc) {
                                        if($resFullAcc->num_rows > 0) {
                                            while ($FullAccItem = $resFullAcc->fetch_assoc()) {
                                                $FullAccItem['username'];
                                                ?>
                                                <div class="div">
                                                    <div class="profile_picture" style="background-image: url('.././profilePic/<?php echo $FullAccItem['ProfilePic'];?>'); background-size: cover; background-position: center;"></div>
                                                    <div class="kanaalnaam"><?php echo $FullAccItem['username'] ?></div>
                                                    <div class="volgers"><?php 
                                                        $queryFullAccSel2 = "SELECT COUNT(FanAccountID) FROM follow WHERE CreatorAccountID = $SelAccountID";
                                                        $resFullAcc2 = mysqli_query($mysqli, $queryFullAccSel2);
                                                        if ($resFullAcc2) {
                                                            if ($resFullAcc2->num_rows > 0) {
                                                                while($FullAccItem2 = $resFullAcc2->fetch_assoc()) {
                                                                    echo $FullAccItem2['COUNT(FanAccountID)'];
                                                                }
                                                            }
                                                        } else {
                                                            echo 'geen volgers';
                                                        }
                                                    ?>
                                                    <div id="unFollowButton">
                                                        <form method='POST' action='../followSystem/startFollow.php'>
                                                        <input type='hidden' name='creatorID' value='<?php echo $SelAccountID; ?>'>
                                                            <input type='submit' name='verzend' class='stopFollowButton' value='Volgen'>
                                                        </form>
                                                    </div>
                                            </div>
                                        </div><?php
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } 
            ?>
        </div>
    </div>
    </div>
</body>
</html>