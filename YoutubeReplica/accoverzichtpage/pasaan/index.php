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
        <div class="navbarDiv navbar blackBG">
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
                <a href='../fan.php'>
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
            <div id="content1">
                <div id="centerForm" class="smallRoundedCorner">
                    <div id='centerDiv'>
                    <h2>Account veranderen</h2>
                    <hr>
                    <?php
                        require '../config.php';
                        session_start();
                        $selQuery = "SELECT * FROM user WHERE AccountID =". $_SESSION['username'];
                        $selResult = mysqli_query($mysqli, $selQuery);
                        if ($selResult) {
                            while($row = $selResult->fetch_assoc()) {
                    ?>
                    <form name='update_account' action='./updateAccount.php' method="POST" enctype='multipart/form-data'>
                        <div id='imageInputForm'>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                            <div id="profile-container">
                                <image id="profileImage" src="../../profilePic/<?= $row['ProfilePic']; ?>"/>
                                <?php
                                    $user = $row['username'];
                                    $email = $row['Email'];
                                ?>
                            </div>
                            <h3><?= $user?></h3>
                        <input id="imageUpload" type="file" name="profilePic" placeholder="Photo" capture value='<?= $row['Profilepic'] ?>'/>
                        <label for='email'>Email adres</label><br>
                            <input type='email' class='uploadFormInput smallRoundedCorner' style='border: none; border-bottom: 1px solid #131313; text-align:center;' name='email' value="<?= $email;?>"><br>
                            <input type='submit' id='buttonSubmit' class='uploadFormInput smallRoundedCorner' style='border: none; text-align:center;' name='verzend' value='Verander account'>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <?php
                            }
                        }
        ?>
        <script src="./script.js"></script>
    </body>
</html>