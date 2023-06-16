<?php
    require 'config.php';

    $query = "SELECT * FROM Videos";

    $result = mysqli_query($mysqli, $query);

    if ($result) {
        if ($result->num_rows > 0) {
            echo "<table style='text-align: center; width='100%'>";
            echo "<tr><th>ID</th><th>Titel</th><th>Video</th><th>Thumbnail</th><th>Beschrijving</th><th>Tag</th><th>KanaalNaam</th><th>Verwijder</th></tr>";
            while($row = $result->fetch_assoc()) {

            echo "<tr><td>" . $row["videoID"] . "</td><td>" . $row["Titel"] . "</td><td>" . $row["VideoLink"] . "</td><td>" . $row["ThumbnailLink"]. "</td><td>" . $row["Beschrijving"]. "</td><td>" . $row["Tags"] . "</td><td>" . $row["Kanaalnaam"] ."</td>";
            echo "<td><a href='Delete.php?id={$row['videoID']}&vidfile={$row['VideoLink']}&thumbfile={$row['ThumbnailLink']}&name=test'>Delete Item</a></tr>";
            }
          } else {
            echo "no video's";
          }
          echo "</table>";
        }

    else {
        echo "FOUT bij het ophalen! <br />";
        echo mysqli_error($mysqli);
    }
    echo "<br><br><br><br>";
    //--------------------------------------//
    $queryCOM = "SELECT * FROM comments";

    $resultCom = mysqli_query($mysqli, $queryCOM);

    if ($resultCom) {
        if ($resultCom->num_rows > 0) {
            echo "<table style='text-align: center; width='100%'>";
            echo "<tr><th>CommentID</th><th>VideoID</th><th>AccountID</th><th>Comment</th><th>Verwijder</th></tr>";
            while($row = $resultCom->fetch_assoc()) {

            echo "<tr><td>" . $row["CommentID"] . "</td><td>" . $row["VideoID"] . "</td><td>" . $row["AccountID"] . "</td><td>" . $row["comment"]. "</td>";
            echo "<td><a href='DeleteCom.php?id={$row['CommentID']}'>Delete Item</a></td></tr>";
            }
          } else {
            echo "no comments";
          }
          echo "</table>";
        }

    else {
        echo "FOUT bij het ophalen! <br />";
        echo mysqli_error($mysqli);
    }
?>