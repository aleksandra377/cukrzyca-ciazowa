<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="style2.css" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Wykres glikemii</title>
</head>

<body>



<div class="w3-sidebar w3-animate-left w3-bar-block w3-border-right" style="display:none" id="mySidebar">
  <button onclick="w3_close()" class="w3-bar-item w3-large"> Zwiń menu &times;</button>
  <a href="./dzienniczekglikemia.php" class="w3-bar-item w3-button w3-hover-pink">Pomiary glikemii</a>
  <a href="./nowypomiarglikemia.php" class="w3-bar-item w3-button w3-hover-pink">Nowy pomiar glikemii</a>
  <a href="./dzienniczekmasa" class="w3-bar-item w3-button  w3-hover-pink">Pomiary masy ciała</a>
  <a href="./login.php" class="w3-bar-item w3-button  w3-hover-pink">Strona Główna</a>
  <a href="./wyloguj.php" class="w3-bar-item w3-button  w3-hover-pink">Wyloguj się</a>
</div>



<div class="w3-teal w3-black">
  <button class="w3-button w3-teal w3-xlarge w3 w3-black" onclick="w3_open()">☰</button>
  <div class="w3-container">

  </div>
</div>
<?php

$servername = "mysql.agh.edu.pl";
$username = "sarzyns2";
$dbpassword = "5cRboJMsRq7SxzR5";
$dbname = "sarzyns2";

$dbconn = mysqli_connect($servername, $username, $dbpassword, $dbname);

$current_user = $_SESSION["current_user"];
$current_gl_table = $_SESSION["current_gl_table"];


$sql = "SELECT `pomiar`, `data_pom` FROM $current_gl_table WHERE `meal`='Przed posilkiem' AND `pomiar`<70 ORDER BY `data_pom` ASC";
$result = mysqli_query($dbconn, $sql);


foreach ($result as $row) {
    $glikemia[] = $row['pomiar'];
    $data_pom[] = $row['data_pom'];
}

?>

<div class="chart-container">
  <canvas id="myChart"></canvas>
</div>


<script>

  const labels = <?php echo json_encode($data_pom)?>;
  var MyData = <?php echo json_encode($glikemia)?>;

  const data = {
    labels: labels,
    datasets: [{
      label: 'Wykres glikemii użytkownika <?php echo $current_user ?>',
      backgroundColor: 'rgb(241,216,141)',
      data: MyData,
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {}
  };


</script>

<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );


</script>


<button onclick="location.href = './wykresglik_norma_przed.php';" id="myButton2" class="float-left submit-button" >Wyświetl pomiary w normie</button>
<button onclick="location.href = './wykresglik_wysoki_przed.php';" id="myButton2" class="float-left submit-button" >Wyświetl pomiary ponad normę</button>
<button onclick="location.href = './wykresglik_niski_przed.php';" id="myButton2" class="float-left submit-button" >Wyświetl pomiary poniżej normy</button>
<button onclick="location.href = './wykresglikemii_przed.php';" id="myButton2" class="float-left submit-button" >Wyświetl pomiary przed posiłkiem</button>
<button onclick="location.href = './wykresglikemii_po.php';" id="myButton2" class="float-left submit-button" >Wyświetl pomiary po posiłku </button>



<script>
function w3_open() {
  document.getElementById("mySidebar").style.width = "100%";
  document.getElementById("mySidebar").style.display = "block";
}
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>

</body>
</html>