<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twoje pomiary</title>
</head>
<body>

<h1>Twoje pomiary</h1>

<?php


$servername = "mysql.agh.edu.pl";
$username = "sarzyns2";
$dbpassword = "5cRboJMsRq7SxzR5";
$dbname = "sarzyns2";

$dbconn = mysqli_connect($servername, $username, $dbpassword, $dbname);

$current_user = $_SESSION["current_user"];
$current_gl_table = $_SESSION["current_gl_table"];


?>

<table>
    <tr>
        <th>Pomiar</th>
        <th>Data</th>
    </tr>

    <?php

$sql = "SELECT `pomiar`, `data_pom` FROM $current_gl_table";
$result = mysqli_query($dbconn, $sql);

if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo"<tr><td>".$row["pomiar"]."</td><td>".$row["data_pom"]."</td></tr>";
    }
} else {
        echo " brak wyników!";
    }
    
    ?>
</table> 




<a href = "./zapisdopliku.php"> Zapisz pomiary do pliku</a> <br>

<br><br>
<a href = "./login.php"> Powrót do profilu</a> <br>


<?php
# w normie wyswietlanie wynikow
$wyswietlanie_norma = "SELECT COUNT(`pomiar`) as `total` FROM $current_gl_table WHERE `pomiar` <= 90 && `pomiar` >= 70";
$result_wyswietlanie_norma = mysqli_query($dbconn, $wyswietlanie_norma);

if (mysqli_num_rows($result_wyswietlanie_norma) > 0){
    while($row = mysqli_fetch_assoc($result_wyswietlanie_norma)){
        echo"W normie ".$row["total"]." ";
    }
}
echo "<br>";
# wyswietlanie wynikow ponad norme 
$wyswietlanie_ponad_norma = "SELECT COUNT(`pomiar`) as `total` FROM $current_gl_table WHERE `pomiar` > 90";
$result_wyswietlanie_ponad_norma = mysqli_query($dbconn, $wyswietlanie_ponad_norma);

if (mysqli_num_rows($result_wyswietlanie_ponad_norma) > 0){
    while($row = mysqli_fetch_assoc($result_wyswietlanie_ponad_norma)){
        echo"Ponad normę ".$row["total"]." ";
    }
}

echo "<br>";
# wyswietlanie wynikow ponizej normy
$wyswietlanie_ponad_norma = "SELECT COUNT(`pomiar`) as `total` FROM $current_gl_table WHERE `pomiar` < 70";
$result_wyswietlanie_ponad_norma = mysqli_query($dbconn, $wyswietlanie_ponad_norma);

if (mysqli_num_rows($result_wyswietlanie_ponad_norma) > 0){
    while($row = mysqli_fetch_assoc($result_wyswietlanie_ponad_norma)){
        echo"Ponizej normy ".$row["total"]." ";
    }
}





mysqli_close($dbconn);
?>

</body>
</html>