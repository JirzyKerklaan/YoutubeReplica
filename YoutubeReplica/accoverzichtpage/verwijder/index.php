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
             
                <a href='../Loginpage/Login.html'>
                <div id="div4" class="blackBG navbarIcon">
                    <i class="fa fa-user"></i>
                    <span class='navBarText'>Log In</span>
                </div></a>
                    
                <a href='../contactpage/index.php'>
                <div id="div5" class="blackBG navbarIcon">
                    <i class="fa fa-envelope"></i>
                    <span class='navBarText'>Contact us</span>
                </div></a>
            </div>
        <!--------Content-------------->
        <div id="content">
            <div class="container3">
                <div class="contact-box2">
                    <div class="left">
                        <div class="righ">
                            <h2>Weet u het zeker?</h2>
                            <form action="./verwijderVerwerk.php" name='verwijder'>
                                <input type="submit" class="btn-groen" value="JA">
                            </form>
                            <form action="./return.php" name='verwijder'>
                                <input type="submit" class="btn-rood" value="NEE">
                            </form>
                        </div>
                    </div>
                </div>  
                </div>  
        </div>
    </body>
</html>





