<?php 
require '../config.php';
require_once '../loggedIn.php';
require_once './TypeCheck.php';
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
    <div id="outerDiv">
        <div id="content" class="whiteBG roundedCorner">
            <div id="topbar" class="greyBG roundedTopCorner textPosition"></div>
            <div id="uploadForm">
                <form method="POST" name="uploadVideo" action="./Toevoeg.php" enctype="multipart/form-data">
                    <input name="title" id="titleField" oninput="textChange()" class="smallRoundedCorner uploadFormInput" placeholder="Titel voor de video" type="text" maxlength="50" required><br>
                    <textarea name="bio" id="bioField" oninput="textChange()" class="smallRoundedCorner uploadFormInput" placeholder="Beschrijving" type="text"></textarea><br>
                    <span id="horizontal">
                    <button type="button" id="thumbnailField" class="smallRoundedCorner uploadFormInput" onclick="document.getElementById('thumbnailUpload').click()">kies een Thumbnail (MAX 15MB)</button><br>
                    <input name="thumbnail" id="thumbnailUpload" class="smallRoundedCorner uploadFormInput" style="display: none;" oninput="updateImage()" type="file" accept="image/*" size="16000000">
                    <button type="button" id="videoField" class="smallRoundedCorner uploadFormInput" onclick="document.getElementById('videoUpload').click()">kies een video (MAX 15MB)</button><br>
                    <input name="video" id="videoUpload" class="smallRoundedCorner uploadFormInput" style="display: none;" oninput="updateVideo()" type="file" accept="video/*" size="16000000"><br>
                    </span>
                    <span class="uploadFormInput">
                    <h4>Kies 1 tag voor je video,<br> zonder gekozen tag word de video niet aanbevolen</h4>
                    <input name="tag" id="tag1" class="smallRoundedCorner uploadFormInput" onclick="onlyOne(this)" value="Music" type="checkbox">
                    <label for='tag1' id="tag1Label">Muziek</label><br />
                    <input name="tag" id="tag2" class="smallRoundedCorner uploadFormInput" onclick="onlyOne(this)" value="Movies" type="checkbox">
                    <label for='tag2' id="tag2Label">Films</label><br />
                    <input name="tag" id="tag3" class="smallRoundedCorner uploadFormInput" onclick="onlyOne(this)" value="News" type="checkbox">
                    <label for='tag3' id="tag3Label">Nieuws</label><br />
                    <input name="tag" id="tag4" class="smallRoundedCorner uploadFormInput" onclick="onlyOne(this)" value="Sport" type="checkbox">
                    <label for='tag4' id="tag4Label">Sport</label><br />
                    <input name="tag" id="tag5" class="smallRoundedCorner uploadFormInput" onclick="onlyOne(this)" value="Games" type="checkbox">
                    <label for='tag5' id="tag5Label">Gaming</label><br />
                    <input type="submit" value="Upload video" name="verzend">
                    </span>
                </form>
            </div>
            <?php
                $user = $_SESSION['username'];
                 $CreatorAcc = "SELECT username FROM user WHERE AccountID = $user";
                 $AccRes = mysqli_query($mysqli, $CreatorAcc);
                 if ($AccRes) {
                     while ($item3 = mysqli_fetch_assoc($AccRes)) {
                            $username = $item3['username'];
                             }
                         }
            ?>
            <div id="previewTab">
                <h4>Hoe ziet deze video er uit op de Trending pagina,</h4>
                <div id="previewGrid" class="smallRoundedCorner">
                <div id="videoTab"></div>
                <div id="textTab">
                    <div id="titel">StandaardTitel</div>
                    <div id="kanaalNaam" class="vidInfoText"><?php echo $username; ?></div><div id="views" class="vidInfoText">1.000.000</div>
                    <div id="desc" class="opacityChange">Standaard Beschrijving</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./script.js"></script>
</body>
</html>