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

<?php
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $masa_pomiar = $_POST['masa_pomiar'];
    $masa_data = $_POST['masa_data'];

}

$servername = "mysql.agh.edu.pl";
$username = "sarzyns2";
$dbpassword = "5cRboJMsRq7SxzR5";
$dbname = "sarzyns2";

$dbconn = mysqli_connect($servername, $username, $dbpassword, $dbname);

$current_user = $_SESSION["current_user"];
$current_m_table = $_SESSION["current_m_table"];


$q_dodajpomiar = "INSERT INTO $current_m_table (pomiar_masa, data_masa) VALUES ('$masa_pomiar','$masa_data')";
mysqli_query($dbconn,$q_dodajpomiar);

echo "Twój pomiar został zapisany";

?>

<br>
<a href = "./masadzienniczek.php"> Zobacz swoje pomiary</a> <br>

<br><br>
<a href = "./login.php"> Powrót do profilu</a> <br>

</body>
</html>