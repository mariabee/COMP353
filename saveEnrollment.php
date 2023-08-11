<?php
require('db.php'); 


if(isset($_POST['ID']) && isset($_POST['Facility']) && isset($_POST['startDate']))
{      
        $id = $_REQUEST['ID'];
        $startDate =$_REQUEST['startDate'];
        $level=$_REQUEST['level'];
        $facility = $_REQUEST['Facility'];
        
        if (isset($_POST['current'])){
            $insertStudent = "INSERT INTO gdc353_1.Student (PersonID, startDate, Level, Facility)
            VALUES (".$id.", '".$startDate."','".$level."','".$facility."')";  
        }
        else {  
            $endDate = $_REQUEST['endDate'];
            $insertStudent = "INSERT INTO gdc353_1.Student (PersonID, startDate, Level, Facility, endDate)
            VALUES (".$id.", '".$startDate."','".$level."','".$facility."','".$endDate."')";  
        }
        $result = mysqli_query($conn, $insertStudent) or die ( mysqli_error($conn));
        header("Location: editStudent.php?id=".$id);
        exit("Success");
}
        
    
    else {
        exit("Missing information");
    }
?> 