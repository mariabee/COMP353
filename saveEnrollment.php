<?php
require('db.php'); 

if(isset($_POST['ID']) && isset($_POST['Facility']) && isset($_POST['startDate']))
{      
        $id = $_REQUEST['ID'];
        $startDate =$_REQUEST['startDate'];
        $endDate = $_REQUEST['endDate'];
        $level=$_REQUEST['level'];
        $facility = $_REQUEST['Facility'];

        $insertStudent = "INSERT INTO gdc353_1.Student (PersonID, startDate, endDate, Level, Facility)
                        VALUES (".$id.", '".$startDate."', '".$endDate."', '".$level."','".$facility."')"; 
        $result = mysqli_query($conn, $insertStudent) or die ( mysqli_error($conn));
        header("Location: editStudent.php?id=".$id);
        exit("Success");
}
        
    
    else {
        exit("Missing information");
    }
?> 