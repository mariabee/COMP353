<?php
require('db.php'); 

if(isset($_GET['id'])) {
    $id = $_REQUEST['id']; 
	$date = $_REQUEST['DATE'];
    $deletePerson = "
    DELETE FROM gdc353_1.Infection WHERE PatientID = ".$id." AND Date = DATE;"; 
    $result = mysqli_query($conn, $deletePerson) or die ( mysqli_error($conn));
    header("Location: Infections.php");
}
else {
    echo "Missing ID";
}
?> 