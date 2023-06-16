<?php
    require 'config.php';
    require_once './loggedIn.php';
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
                    <a href='../../subscriptionpage/index.php'>
                    <div id="div3" class="blackBG navbarIcon">
                    <i class="fa fa-users"></i>
                    <span class='navBarText'>Subscriptions</span>
                </div></a>
                    <a href='../../accoverzichtpage/creator.php'>
                    <div id="div4" class="blackBG navbarIcon">
                    <i class="fa fa-user"></i>
                    <span class='navBarText'>Account</span>
                </div></a>
                <a href='../../contactpage/index.php'>
                    <div id="div5" class="blackBG navbarIcon">
                    <i class="fa fa-envelope"></i>
                    <span class='navBarText'>Contact us</span>
                </div></a>
            </div>
        <!--------Content-------------->
        <?php
                $videoID = $_GET['vidID'];
                $id = $_SESSION['username'];
                $query = "SELECT * FROM user WHERE AccountID = '$id'";
                $result = mysqli_query($mysqli, $query);
                if ($result) {
                    while ($item = mysqli_fetch_assoc($result)) {
        ?>
        <div id="content">
            <div id='container' class="smallRoundedCorner">
                <h1>Comments</h1>
                <!------------------------------PlaceComments---------------------------------------->
                <div id='placeCommentBox' class='smallRoundedCorner'>
                    <div id='profilePic' class='blackBG' style="background-image: url('../../profilePic/<?php echo $item['ProfilePic'];?>'); background-size: cover; background-position: center;"></div>
                    <div id="dataBox">
                        <div id="channelName"><h2><?php echo $item['username']?></h2></div>
                        <form id="commentForm" action="./placeComment.php?kanaalNaam=<?php echo $item['username']."&vidID=".$videoID?>" method="POST">
                        <textarea id='commentBox' name='comment' placeholder="Reactie toevoegen..."></textarea>
                        <input type="hidden" name="AccountID" value="<?php echo $item['AccountID'];?>">
                        <input type="hidden" name="VideoID" value="<?php echo $videoID;?>">
                        <input type="submit" name="submit" id="submitButton" class="fontWhite" value="comment plaatsen">
                        </form>
                        <?php
                        $AccountID = $item['AccountID'];
                                }
                            }
                        ?>
                    </div>
                </div>
                <!------------------------------ViewComments---------------------------------------->
                <div id='allComments' class="">
                <?php
                $commSel = "SELECT comments.comment, user.username, user.ProfilePic FROM comments INNER JOIN user ON comments.AccountID = user.AccountID AND VideoID = '$videoID'";
                $commRes = mysqli_query($mysqli, $commSel);
                if ($commRes) {
                    while ($commentInfo = mysqli_fetch_assoc($commRes)) {
                ?>
                    <div class="commentReadBox" id="topComment">
                        <div class="profilePicComment" style="background-image: url('../../profilePic/<?php echo $commentInfo['ProfilePic'];?>'); background-size: cover; background-position: center;"></div>
                        <div class="kanaalNaamComment"><h3><?php echo $commentInfo['username']?></h3></div>
                        <div class="commentContentBox"><p><?php echo $commentInfo['comment']?></p></div>
                    </div>
                    <?php }} ?>
                </div>
            </div>
        </div>
    </body>
</html>