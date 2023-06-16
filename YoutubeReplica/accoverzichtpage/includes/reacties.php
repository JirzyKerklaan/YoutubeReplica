<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPipe - Unhide Yourself</title>
    <link rel="stylesheet" href="./includes/style.css">
</head>
<body>
                <div id='allComments' class="">
                    <?php
                    $user = $_SESSION['username'];
                    $commSel = "SELECT comments.comment, user.username, user.ProfilePic, Videos.Kanaalnaam, Videos.Titel FROM comments INNER JOIN user ON comments.AccountID = user.AccountID INNER JOIN Videos ON user.username=Videos.Kanaalnaam WHERE user.AccountID AND Videos.Kanaalnaam = user.username";
                    $commRes = mysqli_query($mysqli, $commSel);
                    if ($commRes) {
                        while ($commentInfo = mysqli_fetch_assoc($commRes)) {
                    ?>
                        <div class="commentReadBox" id="topComment">
                            <div class="profilePicComment" style="background-image: url('../profilePic/<?php echo $commentInfo['ProfilePic'];?>'); background-size: cover; background-position: center;"></div>
                            <div class="kanaalNaamComment"><h3><?php echo $commentInfo['username']. "<h6>&nbsp - geplaatst op: <b>".$commentInfo['Titel']?></b></h6></h3></div>
                            <div class="commentContentBox"><p><?php echo $commentInfo['comment']?></p></div>
                        </div>
                        <?php }} ?>
                    </div>
            </div>
</body>
</html>