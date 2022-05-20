<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Wykres glikemii</title>
</head>

<body>


<?php

$servername = "mysql.agh.edu.pl";
$username = "sarzyns2";
$dbpassword = "5cRboJMsRq7SxzR5";
$dbname = "sarzyns2";

$dbconn = mysqli_connect($servername, $username, $dbpassword, $dbname);

$current_user = $_SESSION["current_user"];
$current_gl_table = $_SESSION["current_gl_table"];


$sql = "SELECT `pomiar`, `data_pom` FROM $current_gl_table";
$result = mysqli_query($dbconn, $sql);


foreach ($result as $row) {
    $glikemia[] = $row['pomiar'];
    $data_pom[] = $row['data_pom'];
}

?>

<div class="chart-container" style="position: center; height:40vh; width:80vw">
  <canvas id="myChart"></canvas>
</div>


<script>

  const labels = <?php echo json_encode($data_pom)?>;
  var MyData = <?php echo json_encode($glikemia)?>;
  var myColors = [];

  for(i=0;i<MyData.length;i++){
      if(MyData[i]>=70&&MyData[i]<=90){
          myColors[i]='rgb(167,215,148)';
      }
      if(MyData[i]<70){
          myColors[i]='rgb(241,216,141)';
      }
      if(MyData[i]>90){
          myColors[i]='rgb(229,123,123)';
      }
  }

  const data = {
    labels: labels,
    datasets: [{
      label: 'Wykres glikemii użytkownika <?php echo $current_user ?>',
      backgroundColor: myColors,
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

<a href="./wykresglik_norma.php" >Wyświetl tylko wyniki w normie</a><br>
<a href="./wykresglik_wysoki.php">Wyświetl tylko wyniki powyżej normy</a><br>
<a href="./wykresglik_niski.php">Wyświetl tylko wyniki poniżej normy</a><br>

</body>
</html>