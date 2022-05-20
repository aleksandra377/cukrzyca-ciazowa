<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Cukrzyca w ciązy</title>
        <meta charset="UTF-8">
        <link rel="preconnect" href="https://fonts.googleapis.com"> 
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="style2.css">
       

    </head>
    <body>  



<div class="w3-sidebar w3-animate-left w3-bar-block w3-border-right" style="display:none" id="mySidebar">
  <button onclick="w3_close()" class="w3-bar-item w3-large"> Zwiń menu &times;</button>
  <a href="./dzienniczekglikemia.php" class="w3-bar-item w3-button w3-hover-pink">Pomiary glikemii</a>
  <a href="./dzienniczekmasa" class="w3-bar-item w3-button  w3-hover-pink">Pomiary masy ciała</a>
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
$user_password = mysqli_real_escape_string($dbconn, $_POST["password"]);
$user_email = mysqli_real_escape_string($dbconn, $_POST["email"]);
$query = mysqli_query($dbconn, "SELECT*FROM users WHERE user_email = '$user_email'");

$conn = mysqli_connect($servername, $username, $dbpassword, $dbname);
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}

if (mysqli_num_rows($query)>0) {
    $record = mysqli_fetch_assoc($query);
    $hash = $record["user_passwordhash"];

    if(password_verify($user_password, $hash))
    {
        $_SESSION["current_user"] = $record["user_fullname"];
        $_SESSION["current_gl_table"] = $record["gl_pomiary"];
    }
}


$current_user = $_SESSION["current_user"];
?>


<div id="second-elipse"></div> 
<div id="first-elipse"></div> 
<div id="circle-1"></div>
<div id = "preg"><img src="preg.png"></div>
<img src="petla.png" style="margin-left:0%" >



<div id="powitanie">
<?php echo "Witaj " .$current_user ."!"?>
</div>

<div id="ciaza-info"> 
    
<?php
  $sql_preg = "SELECT `user_preg_week` FROM users WHERE user_fullname = '$current_user' ";
  $result_preg = mysqli_query($conn, $sql_preg);
  if (mysqli_num_rows($result_preg) > 0){
    while($row = mysqli_fetch_assoc($result_preg)){
       
        $preg =$row['user_preg_week'];

          echo  "Jesteś w ".$preg. " tygodniu ciąży"
        }  
    }
    ?>
</div>


<div id = "third-elipse"></div>
<h2> Glikemia </h2>

<div id="linki">
<a href = "./dzienniczekglikemia.php"> Twojesss pomiary</a> <br>
<a href = "./nowypomiarglikemia.php"> Dodaj nowy pomiar</a> <br> 
</div>

<h2> Masa ciała </h2>
<div id="linki">
<a href = "./dzienniczekmasa.php"> Twoje pomiary</a> <br>
<a href = "./nowypomiarmasa.php"> Dodaj nowy pomiar</a> <br> 
</div>



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