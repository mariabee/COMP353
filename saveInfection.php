<?php
require('db.php'); 

if(isset($_POST['ID']) )
{       echo "working";
        
        $id=$_REQUEST['ID'];
        
        $type =$_REQUEST['Type'];
        $date =$_REQUEST['Date'];

        
        $query = "
        INSERT INTO gdc353_1.Infection (PatientID, type, date)
        VALUES ('".$id."','".$type."', '".$date."');
        "; 
        $result = mysqli_query($conn, $query) or die ( mysqli_error($conn));

        if (isset($_POST['student'])) {
                header("Location: editStudent.php?id=".$id);     
        }
        else if (isset($_POST['employee'])) { 
                header("Location: editEmployee.php?id=".$id);
        }

}
?> 