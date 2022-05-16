<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Domowa Apteczka</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>
    <body>  

        <?php

$servername = "mysql.agh.edu.pl";
$username = "alstec1";
$dbpassword = "YtWY47MrHUsvfZ8g";
$dbname = "alstec1";


$dbconn = mysqli_connect($servername, $username, $dbpassword, $dbname);
$user_password = mysqli_real_escape_string($dbconn, $_POST["password"]);
$user_email = mysqli_real_escape_string($dbconn, $_POST["email"]);
$query = mysqli_query($dbconn, "SELECT*FROM users WHERE user_email = '$user_email'");


if (mysqli_num_rows($query)>0) {
    $record = mysqli_fetch_assoc($query);
    $hash = $record["user_passwordhash"];

    if(password_verify($user_password, $hash))
    {
        $_SESSION["current_user"] = $record["user_fullname"];
    }
}



?>