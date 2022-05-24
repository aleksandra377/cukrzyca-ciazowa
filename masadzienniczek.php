<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="style2.css" type="text/css" >

    <title>Twoje pomiary</title>
</head>
<body>


<div class="w3-sidebar w3-animate-left w3-bar-block w3-border-right" style="display:none" id="mySidebar">
  <button onclick="w3_close()" class="w3-bar-item w3-large"> Zwiń menu &times;</button>
  <a href="./nowypomiarglikemia.php" class="w3-bar-item w3-button w3-hover-pink">Dodaj nowy pomiar</a>
  <a href="./login.php" class="w3-bar-item w3-button w3-hover-pink">Strona główna</a>
  <a href="./dzienniczekmasa" class="w3-bar-item w3-button  w3-hover-pink">Pomiary masy ciała</a>
  <a href="./wyloguj.php" class="w3-bar-item w3-button  w3-hover-pink">Wyloguj się</a>
</div>



<div class="w3-teal w3-black">
  <button class="w3-button w3-teal w3-xlarge w3 w3-black" onclick="w3_open()">☰</button>
  <a href="./login.php" class="w3-bar-item w3-button w3-hover-pink">Strona główna</a>
  <a href="./wykresmasy.php" class="w3-bar-item w3-button w3-hover-pink">Wykres zmian wagi</a>
  <a href="./zapisdoplikumasa.php" class="w3-bar-item w3-button w3-hover-pink">Zapisz pomiary do pliku</a>
  <a href="#" id = "myBtn" class="w3-bar-item w3-button w3-hover-pink">Dodaj nowy pomiar</a>



  <div class="w3-container">

  </div>
</div>

<h1>Twoje pomiary</h1>
<div id="circle-1"></div>
<img src="petla.png" style="margin-left:0%" >
<?php


$servername = "mysql.agh.edu.pl";
$username = "sarzyns2";
$dbpassword = "5cRboJMsRq7SxzR5";
$dbname = "sarzyns2";

$dbconn = mysqli_connect($servername, $username, $dbpassword, $dbname);

$current_user = $_SESSION["current_user"];
$current_m_table = $_SESSION["current_m_table"];


?>
<div id="table-pomiary">
<table>
    <tr>
        <th>Waga</th>
        <th>Data</th>
    </tr>

    <?php

$sql = "SELECT `pomiar_masa`, `data_masa` FROM $current_m_table";
$result = mysqli_query($dbconn, $sql);

if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo"<tr><td>".$row["pomiar_masa"]."kg"."</td><td>".$row["data_masa"]."</td></tr>";
    }
} else {
        echo " brak wyników!";
    }
    
    ?>
</table> 
</div>




<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Dodaj nowy pomiar</p>
    <form method="POST" action ="dodawaniepomiarumasa.php">
    Waga: <input type = "number" name = "masa_pomiar" placeholder = "kg"><br>
    Data: <input type = "date" name = "masa_data"><br> 

    <br><br>
    <input type = "submit" name = "submit" value = "Dodaj pomiar">
    </form>
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>

<style>
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: whitesmoke;
  color: black;
  text-align: center;
}
</style>


</body>
</html>