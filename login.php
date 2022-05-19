<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Cukrzyca w ciązy</title>
        <meta charset="UTF-8">
    </head>
    <body>  

   <h1> Twój profil </h1>

        <?php

$servername = "mysql.agh.edu.pl";
$username = "sarzyns2";
$dbpassword = "5cRboJMsRq7SxzR5";
$dbname = "sarzyns2";


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
        $_SESSION["current_gl_table"] = $record["gl_pomiary"];
    }
}

$current_user = $_SESSION["current_user"];

echo "Witaj $current_user !";


?>

<h2> Glikemia </h2>

<a href = "./dzienniczekglikemia.php"> Twoje pomiary</a> <br>
<a href = "./nowypomiarglikemia.php"> Dodaj nowy pomiar</a> <br>

<h2> Masa ciała </h2>

<a href = "./dzienniczekmasa.php"> Twoje pomiary</a> <br>
<a href = "./nowypomiarmasa.php"> Dodaj nowy pomiar</a> <br>

<a href="./wyloguj.php">Wyloguj</a><br>

</body>
</html>