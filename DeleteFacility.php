<?php
require('db.php'); 

if(isset($_GET['Name'])) {
    $Name = $_REQUEST['Name']; 
    $deleteFacility = "DELETE FROM gdc353_1.Facility WHERE Name = '$Name'";
    $result = mysqli_query($conn, $deleteFacility) or die(mysqli_error($conn));
    header("Location: Facilities.php"); // Corrected the filename here
} else {
    echo "Missing Name";
}
?>
