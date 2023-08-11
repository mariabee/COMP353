<?php
require('db.php'); 

if(isset($_GET['id'])) {
    $id = $_REQUEST['id']; 
    $deletePerson = "
    DELETE FROM gdc353_1.Personnel WHERE ID = ".$id.";"; 
    $result = mysqli_query($conn, $deletePerson) or die ( mysqli_error($conn));
    header("Location: Employees.php");
}
else {
    echo "Missing ID";
}
?> 