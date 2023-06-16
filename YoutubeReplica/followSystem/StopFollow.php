<?php
require 'config.php';
session_start();
$creatorUser = $_POST['creatorID'];
$curUser = $_SESSION['username'];
echo $curUser . ", " . $creatorUser;
$query = "DELETE FROM follow WHERE FanAccountID = $curUser AND CreatorAccountID = $creatorUser";

$result = mysqli_query($mysqli, $query);

if ($result) {
    echo "Het item is verwijderd! <br />";
    header("Location: ../subscriptionpage/index.php");
}

else {
    echo "FOUT bij het verwijderen! <br />";
    echo mysqli_error($mysqli);
}
?>