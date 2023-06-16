<?php
require 'config.php';

$id = $_GET['id'];

echo $id . "<br />";


$query = "DELETE FROM comments WHERE CommentID = " . $id;

$result = mysqli_query($mysqli, $query);

if ($result) {
    echo "Het item is verwijderd! <br />";
    header("Location: ShowAll.php");
}

else {
    echo "FOUT bij het verwijderen! <br />";
    echo mysqli_error($mysqli);
}
?>