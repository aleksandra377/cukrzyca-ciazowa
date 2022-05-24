<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css" type="text/css">

    <title>Nowy pomiar</title>
</head>
<body>

<h1> Wprowadź aktualną wagę </h1>

<form method="POST" action ="dodawaniepomiarumasa.php">
Waga: <input type = "number" name = "masa_pomiar" placeholder = "kg"><br>
Data: <input type = "date" name = "masa_data"><br> 

<br><br>
<input type = "submit" name = "submit" value = "Dodaj pomiar">
</form>

<br>
<a href = "./login.php"> Twój profil</a> <br>

</body>
</html>