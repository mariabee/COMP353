<?php
require('db.php'); 

if(isset($_GET['ID'])) {
    $id = $_GET['ID']; 
    $formattedId = mysqli_real_escape_string($conn, $id);
    $deleteVaccine = "DELETE FROM gdc353_1.Vaccine WHERE PatientID = '$formattedId'"; 
    $result = mysqli_query($conn, $deleteVaccine) or die(mysqli_error($conn));
    header("Location: Vaccines.php");
}
else {
    echo "Missing Vaccine";
}
?>

