<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nowy pomiar</title>
</head>
<body>

<h1> Dodaj nowy pomiar </h1>

<form method="POST" action ="dodawaniepomimaru.php">
WprowadĹş pomiar: <input type = "number" name = "gl_pomiar"><br>
WprowadĹş datÄ™: <input type = "date" name = "gl_data"><br>
            <br>
<input type = "submit" name = "submit" value = "Dodaj pomiar">
</form>

<br>
<a href = "./login.php"> TwĂłj profil</a> <br>

</body>
</html>