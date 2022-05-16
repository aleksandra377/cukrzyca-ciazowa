<?php
session_start();
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Logowanie</title>
        <meta charset="UTF-8">
    </head>
    <body>  


    <form method="POST" action ="login.php">
            <input type = "email" name = "email" placeholder = "E-mail"><br>
            <input type = "password" name = "password" placeholder = "Hasło"><br>
            <br>
            <input type = "submit" name = "submit" value = "Zaloguj">
    </form>
    Nie masz konta? <a href = "./rejestracja.php"> Zarejestruj się </a><br>



    </body>
</html>