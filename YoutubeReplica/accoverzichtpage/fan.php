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
        <?php
            require 'config.php';
            require_once '../loggedIn.php';

            $selQuery = "SELECT * FROM user WHERE AccountID =". $_SESSION['username'];
            $selResult = mysqli_query($mysqli, $selQuery);
            if ($selResult) {
                while($row = $selResult->fetch_assoc()) {
                    $kanaalNaam = $row['username'];
                    $AccountType = $row['AccountType'];
                    $AccountID = $row['AccountID'];
                }
            }
            if ($AccountType == 'creator') {
                header("Location: ./creator.php");
            }
            else {
            $viewsQuery = "SELECT SUM(Views) FROM Videos WHERE Kanaalnaam = '$kanaalNaam'";
            $viewsResult = mysqli_query($mysqli, $viewsQuery);
            if ($viewsResult) {
                if ($viewsResult->num_rows > 0) {
                    while ($viewsRow = mysqli_fetch_assoc($viewsResult)) {
                        $totalViews = $viewsRow['SUM(Views)'];
                    }
                }
            } else {$totalViews = 0;}

            $ComQuery = "SELECT COUNT(AccountID) FROM comments WHERE AccountID =". $_SESSION['username'];
            $ComResult = mysqli_query($mysqli, $ComQuery);
            if ($ComResult) {
                if ($ComResult->num_rows > 0) {
                    while ($ComRow = mysqli_fetch_assoc($ComResult)) {
                        $totalComs = $ComRow['COUNT(AccountID)'];
                    }
                }
            } else {$totalComs = 0;}

            $query = "SELECT * FROM user WHERE AccountID =". $_SESSION['username'];
            $result = mysqli_query($mysqli, $query);
            if ($result) {
                if ($result->num_rows > 0) {
                    while ($item = mysqli_fetch_assoc($result)) {
        ?>
        <div id="MainGrid">
        <!--Navigation Bar-->
        <div class="navbarDiv navbar blackBG">
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
            <a href='../logout.php'>
            <div id="div4" class="blackBG navbarIcon">
                <i class="fa fa-user"></i>
                <span class='navBarText'>Log uit</span>
            </div></a>
                <a href='../contactpage/index.php'>
            <div id="div5" class="blackBG navbarIcon">
                <i class="fa fa-envelope"></i>
                <span class='navBarText'>Contact us</span>
            </div></a>
        </div>
        

        <!--------Content-------------->
        <div id="content">
            <div id="menu" class="whiteBG smallRoundedCorner">
                <div id="channelPic" style="background-image: url('../profilePic/<?php echo $item['ProfilePic'];?>'); background-size: cover; background-position: center;"></div>
                <div id="channelName"><?php echo $item['username'];?></div>
                <div id="comments"><b>reacties:</b> <?php echo $totalComs; ?></div>
                <div id="regDate"><b>Lid sinds: </b>
                <?php $regDate = explode(" ", $item['RegDate']);$regExpl = explode("-", $regDate[0]);
                print_r($regExpl[2]);echo "-";print_r($regExpl[1]);echo "-";print_r($regExpl[0]);?></div>

                <a href="./index.php">
                    <div id="reactieButton" class="active">reacties</div>
                </a>

                <a href="../logout.php">
                    <div id="logOutButton" class="">Uitloggen</div>
                </a>

                <a href="./index.php">
                    <div id="aanpasButton" class="">Account aanpassen</div>
                </a>
                
                <a href="./verwijder/index.php">
                    <div id="verwButton" class="">Kanaal verwijderen</div>
                </a>
            </div>

            <div id='overzicht' class='whiteBG smallRoundedCorner'>
                <?php include './includes/fan.php'; ?>
            </div>
        <?php           }
                    }
                }
            }
        ?>
</body>
</html>