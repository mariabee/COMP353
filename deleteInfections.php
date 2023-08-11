<?php
require('db.php'); 

if(isset($_GET['id']) && isset($_GET['Date'])) {
    $id = $_GET['id']; 
    $date = $_GET['Date'];

    $formattedDate = mysqli_real_escape_string($conn, $date);

    $deletePerson = "
    DELETE FROM gdc353_1.Infection WHERE PatientID = '$id' AND Date = '$formattedDate'"; 
    $result = mysqli_query($conn, $deletePerson) or die(mysqli_error($conn));
    header("Location: Infections.php");
}
else {
    echo "Missing ID or Date";
}
?>