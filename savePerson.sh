
<?php
if(isset($_POST['new']) && $_POST['new']==1)
{
        $id=$_REQUEST['PersonID'];
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
        $citizenship = $_REQUEST['Citizenship'];
        $facility = $_REQUEST['facility'];
        ?> 