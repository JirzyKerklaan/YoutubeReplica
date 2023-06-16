<?php
    require 'config.php';
    if (isset($_POST['signin'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lastname'];
    $uname = $_POST['userName'];

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $accType = $_POST['AccountType'];
    if (!$accType || $accType == null || $accType == "" || $accType == "accountType"){
        echo "Geen accounttype ingevoerd!";
        exit;
        die;
    }
    else {

    $ret=mysqli_query($mysqli, "SELECT Email FROM user WHERE Email = '$email' || username = '$uname'");
    $resultCheck = mysqli_fetch_array($ret);
    if ($resultCheck > 0) {
        echo "<script>alert('dit email adres of gebruikers naam is al in gebruik!')</script>";
    }
    else {
        $query=  "INSERT INTO user (AccountType, username, voornaam, achternaam, Email, Password)";
        $query .= "VALUES ('$accType', '$uname', '$fname', '$lname', '$email', '$password')";

        $return = mysqli_query($mysqli, $query);

        if($return) {
            echo "<script>alert('Je bent succesvol geregistreerd')</script>";
            echo "<script>window.location.href = './Login.html'</script>";
        }
        else {
            echo "<script>alert('Er is een fout opgetreden, probeer het nog eens!')</script>";
            echo "<script>window.location.href = 'Login.html'</script>";
        }
    }
}
}
?>