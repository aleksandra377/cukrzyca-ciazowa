<!DOCTYPE html>
<html>
    <head>
        <title>Rejestracja</title>
        <meta charset="UTF-8">
    </head>
    <body>

<?php

$user_fullname = $user_email = $user_password = $currentname = $currentemail ="";

function chgw($dane)
{
    $dane = trim($dane);
    $dane = stripslashes($dane);
    $dane = htmlspecialchars($dane);
    return $dane;
}

$servername = "mysql.agh.edu.pl";
$username = "alstec1";
$dbpassword = "YtWY47MrHUsvfZ8g";
$dbname = "alstec1";

$dbconn = mysqli_connect($servername, $username, $dbpassword, $dbname);


    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
    
        $currentname = $_POST["name"];
        $q_freename = "SELECT user_fullname FROM users WHERE user_fullname='$currentname'";
        $r_freename = mysqli_query($dbconn,$q_freename)or die("Problemy z odczytem danych!");

        $currentemail = $_POST["email"];
        $q_freemail = "SELECT user_email FROM users WHERE user_email='$currentemail'";
        $r_freemail = mysqli_query($dbconn,$q_freemail)or die("Problemy z odczytem danych!");

        if (empty($_POST["name"]))
        {
            $imErr = "Musisz podać nazwę <br/>";
        }
        elseif (mysqli_num_rows($r_freename) > 0){
            $freeimErr = "Nazwa użytkownika jest już zajęta";
        }
        else{
            $name = chgw($_POST["name"]);
        }
        if (empty($_POST["email"]))
        {
            $mailErr = "Musisz podać email";
        }
        elseif (mysqli_num_rows($r_freemail) > 0){
            $freemailErr = "Konto o podanym adresie email już istnieje";
        }
        else{
            $email = chgw($_POST["email"]);
        }
        if (empty($_POST["password"]))
        {
            $passErr = "Podaj hasło!";
        }
        else{
            $password = chgw($_POST["password"]);
        }
    }

    $user_fullname = mysqli_real_escape_string($dbconn, $name);
    $user_email = mysqli_real_escape_string($dbconn, $email);
    $user_password = mysqli_real_escape_string($dbconn, $password);

    $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

    if((isset($name) and isset($password)) and isset($email)){
        mysqli_query($dbconn, "INSERT INTO users (user_fullname, user_email, user_passwordhash)
         VALUES ('$user_fullname', '$user_email', '$user_password_hash')");
        echo "Rejestracja przebiegła poprawnie <br/><br/>";
    } else {
        echo "<br>" .$imErr. " " .$mailErr. " " .$passErr. " " .$freeimErr. " ".$freemailErr. " ";
    }
?>

</body>
</html>