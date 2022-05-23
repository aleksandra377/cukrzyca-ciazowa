<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $pomiar_gl = $_POST['gl_pomiar'];
    $data_gl = $_POST['gl_data'];
    $time_gl = $_POST['gl_time'];
    $meal = $_POST['meal'];
}

$servername = "mysql.agh.edu.pl";
$username = "sarzyns2";
$dbpassword = "5cRboJMsRq7SxzR5";
$dbname = "sarzyns2";

$dbconn = mysqli_connect($servername, $username, $dbpassword, $dbname);

$current_user = $_SESSION["current_user"];
$current_gl_table = $_SESSION["current_gl_table"];


$q_dodajpomiar = "INSERT INTO $current_gl_table (pomiar, data_pom, time_pom, meal) VALUES ('$pomiar_gl','$data_gl','$time_gl','$meal')";
mysqli_query($dbconn,$q_dodajpomiar);

echo "Twój pomiar został zapisany";

?>

<br>
<a href = "./dzienniczekglikemia.php"> Zobacz swoje pomiary</a> <br>

<br><br>
<a href = "./login.php"> Powrót do profilu</a> <br>

</body>
</html>