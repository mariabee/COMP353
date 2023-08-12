<?php
require('db.php'); 

if(isset($_GET['id'])) {
    $id = $_GET['id']; 
    $start = $_GET['start'];
    $date = $_GET['date'];

    echo $start; 
    
    $deleteShift = "
    DELETE FROM `gdc353_1`.`Schedule` WHERE (`date` = '2023-05-21') and (`PersonID` = '10009') and (`startTime` = '00:00:10')
    DELETE FROM gdc353_1.Schedule WHERE (PersonID = '".$id."')
    AND (date = '".$date."') AND (startTime = '".$start."');"; 
    $result = mysqli_query($conn, $deleteShift) or die ( mysqli_error($conn));

    header("Location: Schedule.php?id=".$id);
    exit ("success"); 
    
}

else {
    echo "Missing ID";
}
?> 