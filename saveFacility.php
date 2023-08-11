<?php
require('db.php'); 

if(isset($_POST['Name']) )
{       echo "working";
        
        $name=$_REQUEST['Name'];
        
 
                <td align="center"><?php echo $row["Capacity"]; ?></td>



if(isset($_POST['Address']) ) {
$address = $_REQUEST['Address'];
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
if(isset($_POST['WebAddress']) ) {
$webAddress = $_REQUEST['WebAddress'];
}
if(isset($_POST['phoneNumber']) ) {
$phoneNumber = $_REQUEST['phoneNumber'];
}
if(isset($_POST['Type']) ) {
$type = $_REQUEST['Type'];
}
if(isset($_POST['Capacity']) ) {
$capacity = $_REQUEST['Capacity'];
}

$query = "
UPDATE gdc353_1.Facility
SET Name = '".$Name."', Address = '".$address."',
PostalCode = '".$PostalCode."', City = '".$city."',
Province = '".$province."',WebAddress = '".$webAddress."', phoneNumber = '".$phoneNumber."',
Type = '".$type."', Capacity= '".$capacity."'
WHERE Name =".$name.";
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
