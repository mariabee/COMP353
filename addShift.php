<?php
require('db.php'); 

if(isset($_POST['ID']) )
{       
        
        $id=$_REQUEST['ID'];
        
        $date =$_REQUEST['date'];
        $startTime =$_REQUEST['startTime'];
        $endTime = $_REQUEST['endTime'];
        $Facility = $_REQUEST['Facility'];

        $query = "
        INSERT INTO gdc353_1.Schedule (PersonID, date, startTime, endTime, Facility)
        VALUES ('".$id."','".$date."', '".$startTime."','".$endTime."','".$Facility."');
        "; 
        $result = mysqli_query($conn, $query) or die ( mysqli_error($conn));

        header("Location: Schedule.php?id=".$id);
        exit ("success");
}
else {
    "Missing ID";
}


?> 