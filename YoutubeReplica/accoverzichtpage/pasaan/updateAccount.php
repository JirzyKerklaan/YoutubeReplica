<?php
    require '../config.php';
    require_once '../../loggedIn.php';

    $selQuery = "SELECT * FROM user WHERE AccountID =". $_SESSION['username'];
    $selResult = mysqli_query($mysqli, $selQuery);
    if ($selResult) {
        while($row = $selResult->fetch_assoc()) {
            $user = $row['username'];
            $profileFirst = $row['ProfilePic'];
        }
    }
if (isset($_POST['verzend'])) {
    $picSize = $_FILES["profilePic"]["size"];
    if ($picSize < 16000000) {
    $tempnamePic = $_FILES["profilePic"]["tmp_name"];
    $PicName = $_FILES["profilePic"]["name"];
    $image_info = explode(".", $PicName);
    $extPic = end($image_info);
    $username = $_POST['username'];
    $email = $_POST['email'];
    if($_FILES['profilePic']['name'] != $profileFirst) {
        if(!$extPic) {
            $filenamePic = $profileFirst;
        } else {
            $filenamePic = $username . "-ProfilePic." . $extPic;
        }
        $uplQuery = "UPDATE user SET Email = '$email', ProfilePic = '$filenamePic' WHERE AccountID = ".$_SESSION['username'];
        $uplResult = mysqli_query($mysqli, $uplQuery);
        if ($uplResult) {
            if (move_uploaded_file($tempnamePic, "../../profilePic/" . $filenamePic)){
                echo "$filenamePic is ge-upload! <br><br>";
                header("Location: ../creator.php");
            }
            else {
                echo "verplaatsen van foto mislukt!";
                header("Location: ../creator.php");
            }
            echo "toevoegen gelukt! <br />";
        }
    } else {
        $uplQuery2 = "UPDATE user SET Email = '$email' WHERE AccountID = ".$_SESSION['username'];
        $uplResult2 = mysqli_query($mysqli, $uplQuery2);
        if ($uplResult2) {
            echo "toevoegen gelukt! <br />";
            echo $extPic;
        }
    }
    }
    else {
        echo "Profiel foto bestand te groot!";
        echo "het bestand is: " . $videoSize;
        echo $extPic;
    }
}
?>













