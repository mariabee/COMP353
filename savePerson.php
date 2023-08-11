<?php
require('db.php'); 

if(isset($_POST['ID']))
{       echo "working";
        
        $id=$_REQUEST['ID'];
        $firstname =$_REQUEST['FirstName'];
        $lastname =$_REQUEST['LastName'];
        $email = $_REQUEST['Email'];
        $phone = $_REQUEST['Phone'];
        $postalCode = $_REQUEST['PostalCode'];
        $city = $_REQUEST['City'];
        $province = $_REQUEST['Province'];
        $cardExpiry = $_REQUEST['CardExpiry'];
        $birthday = $_REQUEST['DateOfBirth'];
        $address = $_REQUEST['Address'];
        $citizenship = $_REQUEST['citizenship'];   
        
        $query = "
        UPDATE gdc353_1.Personnel
        SET FirstName = '".$firstname."', lastName = '".$lastname."', 
        Email = '".$email."', Phone = '".$phone."', PostalCode = '".$postalCode."', City = '".$city."',
        Province = '".$province."',CardExpiry = '".$cardExpiry."', DateOfBirth = '".$birthday."', 
        Address = '".$address."', Citizenship= '".$citizenship."'
        WHERE ID =".$id.";
        "; 
        $result = mysqli_query($conn, $query) or die ( mysqli_error($conn));
        
        
        header("Location: editEmployee.php?id=".$id);
        exit();

}
?> 