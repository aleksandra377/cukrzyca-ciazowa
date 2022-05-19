<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Wyloguj</title>
    </head>
<body>
<?php
session_unset();
session_destroy();
if(isset($_SESSION["current_user"])){
    echo "Użytkownik jest zalogowany: ".$_SESSION["current_user"];
} else {
    echo "Użytkownik nie jest zalogowany";
}
?>
<br>
<br>
<a href="./index.html">Strona główna</a><br>
</body>
</html> 