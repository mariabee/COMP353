<?php
require('db.php'); 

if(isset($_GET['id'])) {
    $id = $_GET['id']; 
    $startDate = $_GET['startDate'];
     
    $deleteContract = "
    DELETE FROM gdc353_1.Employee WHERE PersonID = '".$id."' AND startDate = '".$startDate."';"; 
    $result = mysqli_query($conn, $deleteContract) or die ( mysqli_error($conn));

    header("Location: editEmployee.php?id=".$id);
    exit("Missing information");
}

else {
    echo "Missing ID";
}
?> 