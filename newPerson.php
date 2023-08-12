<?php
require('db.php'); 

if(isset($_POST['ID']) )
{       echo "working";
        
        $id=$_REQUEST['ID'];
        
        $firstname =$_REQUEST['FirstName'];
        $lastname =$_REQUEST['LastName'];
        $email = $_REQUEST['Email'];

        $isStudent = false;
       
         
        if (isset($_POST['student'])) {
                $isStudent = true; 
        }

        
        $query = "
        INSERT INTO gdc353_1.Personnel (FirstName, lastName, Email, ID)
        VALUES ('".$firstname."','".$lastname."', '".$email."','".$id."');
        "; 
        $result = mysqli_query($conn, $query) or die ( mysqli_error($conn));

        if((isset($_POST['startDate']))) {
            $startDate = $_REQUEST['startDate'];
            $query = "
            INSERT INTO gdc353_1.Employee (PersonID, startDate)
            VALUES ('".$id."','".$startDate."');
            "; 
            $result = mysqli_query($conn, $query) or die ( mysqli_error($conn)); 
        }

        if((isset($_POST['enrollDate']))) {
                $isStudent = true; 
                $startDate = $_REQUEST['enrollDate'];
                $query = "
                INSERT INTO gdc353_1.Student (PersonID, startDate, Level)
                VALUES ('".$id."','".$startDate."', 'unknown');
                "; 
                $result = mysqli_query($conn, $query) or die ( mysqli_error($conn)); 
        }

        
        if ($isStudent) {
                header("Location: editStudent.php?id=".$id);     
        }
        else { 
                header("Location: editEmployee.php?id=".$id);
        }
        exit();

}
?> 