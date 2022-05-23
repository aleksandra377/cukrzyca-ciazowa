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
  <a href="./wykresglikemii.php" class="w3-bar-item w3-button w3-hover-pink">Wizualizacja pomiarów</a>
  <a href="./zapisdopliku.php" class="w3-bar-item w3-button w3-hover-pink">Zapisz pomiary do pliku</a>
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
$current_gl_table = $_SESSION["current_gl_table"];


?>
<div id="table-pomiary">
<table>
    <tr>
        <th>Pomiar</th>
        <th>Data</th>
        <th>Godzina</th>
        <th>Stan</th>
    </tr>

    <?php

$sql = "SELECT `pomiar`, `data_pom`, `time_pom`, `meal` FROM $current_gl_table";
$result = mysqli_query($dbconn, $sql);

if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo"<tr><td>".$row["pomiar"]." mg/dL"."</td><td>".$row["data_pom"]."</td><td>".$row["time_pom"]."</td><td>".$row["meal"]."</td></tr>";
    }
} else {
        echo " brak wyników!";
    }
    
    ?>
</table> 
</div>



<div id="norma-dis">
<?php
# w normie wyswietlanie wynikow
$wyswietlanie_norma = "SELECT COUNT(`pomiar`) as `total` FROM $current_gl_table WHERE `pomiar` <= 90 && `pomiar` >= 70";
$result_wyswietlanie_norma = mysqli_query($dbconn, $wyswietlanie_norma);

if (mysqli_num_rows($result_wyswietlanie_norma) > 0){
    while($row = mysqli_fetch_assoc($result_wyswietlanie_norma)){ ?> 
        <p1 style="font-size:50px; font-color: black; margin-left:40%"> <?php echo $row["total"]."<br> "; ?> </p1>
 
        <p2 style="font-size:17px; font-color: black; margin-left:23%"> <?php echo " W normie "; ?></p2> <?php
    }
}
?>
</div>
<div id="high-dis">

<?php
# wyswietlanie wynikow ponad norme 
$wyswietlanie_ponad_norma = "SELECT COUNT(`pomiar`) as `total` FROM $current_gl_table WHERE `pomiar` > 90";
$result_wyswietlanie_ponad_norma = mysqli_query($dbconn, $wyswietlanie_ponad_norma);

if (mysqli_num_rows($result_wyswietlanie_ponad_norma) > 0){
    while($row = mysqli_fetch_assoc($result_wyswietlanie_ponad_norma)){    ?> 
    <p1 style="font-size:50px; font-color: black; margin-left:40%"> <?php echo $row["total"]."<br> "; ?> </p1>

    <p2 style="font-size:17px; font-color: black; margin-left:15%"> <?php echo "Ponad normę "; ?></p2> <?php
    }
}
?>

</div>
<div id = "low-dis">
<?php
# wyswietlanie wynikow ponizej normy
$wyswietlanie_ponad_norma = "SELECT COUNT(`pomiar`) as `total` FROM $current_gl_table WHERE `pomiar` < 70";
$result_wyswietlanie_ponad_norma = mysqli_query($dbconn, $wyswietlanie_ponad_norma);

if (mysqli_num_rows($result_wyswietlanie_ponad_norma) > 0){
    while($row = mysqli_fetch_assoc($result_wyswietlanie_ponad_norma)){  ?> 
       <p1 style="font-size:50px; font-color: black; margin-left:40%"> <?php echo $row["total"]."<br> "; ?> </p1>

       <p2 style="font-size:17px; font-color: black; margin-left:15%"> <?php echo "Poniżej normy "; ?></p2> <?php
        
    }
}
?>
</div>



<table>
    <tr>
        <th>Średnia z ostatniego tygodnia</th>
    </tr>

    <?php

    $sql = "SELECT AVG(`pomiar`) FROM $current_gl_table WHERE `data_pom` between adddate(now(),-7) and now()";
    $result = mysqli_query($dbconn, $sql);

    if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
        echo"<tr><td>".$row["AVG(`pomiar`)"]." mg/dL"."</td></tr>";}
    } else {
        echo "Brak rekordów";
    }
?>
</table> 

<?php
mysqli_close($dbconn);
?>



<script>
function w3_open() {
  document.getElementById("mySidebar").style.width = "100%";
  document.getElementById("mySidebar").style.display = "block";
}
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Dodaj nowy pomiar</p>
    <form method="POST" action ="dodawaniepomimaru.php">
    Wprowadź pomiar [mg/dL]: <input type = "number" name = "gl_pomiar"><br>
    Wprowadź datę: <input type = "date" name = "gl_data"><br>
            <br>
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



</body>
</html>