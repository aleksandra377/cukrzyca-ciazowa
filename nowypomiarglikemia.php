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

<h1> Dodaj nowy pomiar </h1>

<form method="POST" action ="dodawaniepomimaru.php">
Wprowadź pomiar: <input type = "number" name = "gl_pomiar" placeholder = "mg/dL"><br>
Podaj datę: <input type = "date" name = "gl_data"><br> 
Podaj godzinę pomiaru: <input type="time" name = "gl_time"><br>
Stan: 
<select name="meal">
  <option value="Przed posilkiem">Przed posiłkiem</option>
  <option value="Po posilku">Po posiłku</option>
</select>

<br><br>
<input type = "submit" name = "submit" value = "Dodaj pomiar">
</form>

<br>
<a href = "./login.php"> Twój profil</a> <br>

</body>
</html>