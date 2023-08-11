<?php
require('db.php'); 

if(isset($_POST['ID']) )
{       echo "working";
        
        $id=$_REQUEST['ID'];
        
        $firstname =$_REQUEST['FirstName'];
        $lastname =$_REQUEST['LastName'];
        $email = $_REQUEST['Email'];
        
        
        if(isset($_POST['Phone']) ) {
                $phone = $_REQUEST['Phone'];
        }
        if(isset($_POST['PostalCode']) ) {
                $postalCode = $_REQUEST['PostalCode'];
        }
        if(isset($_POST['City']) ) {
                $city = $_REQUEST['City'];
        }
        if(isset($_POST['Province']) ) {
                $province = $_REQUEST['Province'];
        }
        if(isset($_POST['CardExpiry']) ) {
                $cardExpiry = $_REQUEST['CardExpiry'];
        }
        if(isset($_POST['DateOfBirth']) ) {
                $birthday = $_REQUEST['DateOfBirth'];
        }
        if(isset($_POST['Address']) ) {
                $address = $_REQUEST['Address'];
        }
        if(isset($_POST['citizenship']) ) {
                $citizenship = $_REQUEST['citizenship']; 
        }
        $isStudent = false; 
        if (isset($_POST['student'])) {
                $isStudent = true; 
        }
        
        $query = "
        UPDATE gdc353_1.Personnel
        SET FirstName = '".$firstname."', lastName = '".$lastname."', 
        Email = '".$email."', Phone = '".$phone."', PostalCode = '".$postalCode."', City = '".$city."',
        Province = '".$province."',CardExpiry = '".$cardExpiry."', DateOfBirth = '".$birthday."', 
        Address = '".$address."', Citizenship= '".$citizenship."'
        WHERE ID =".$id.";
        "; 
        $result = mysqli_query($conn, $query) or die ( mysqli_error($conn));
        
        if ($isStudent) {
                header("Location: editStudent.php?id=".$id);     
        }
        else { 
                header("Location: editEmployee.php?id=".$id);
        }
        exit();

}
?> 