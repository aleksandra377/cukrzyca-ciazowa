<?php
session_start();
?>

<?php
$servername = "mysql.agh.edu.pl";
$username = "sarzyns2";
$dbpassword = "5cRboJMsRq7SxzR5";
$dbname = "sarzyns2";

$dbconn = mysqli_connect($servername, $username, $dbpassword, $dbname);

$current_user = $_SESSION["current_user"];
$current_gl_table = $_SESSION["current_gl_table"];


$sql = "SELECT `pomiar`, `data_pom`, `time_pom`, `meal` FROM $current_gl_table";
$result = mysqli_query($dbconn, $sql);


$query = $dbconn->query("SELECT * FROM $current_gl_table"); 

if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "dane-glikemii.csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('Pomiar', 'Data pomiaru', 'Godzina pomiaru', 'Stan'); 
    fputcsv($f, $fields, $delimiter); 
    
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        $lineData = array($row['pomiar'], $row['data_pom'], $row['time_pom'], $row['meal']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
    ?>


