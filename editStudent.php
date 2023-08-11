<?php
require('db.php');


$id=$_REQUEST['id'];

$query = "Select * from gdc353_1.Student S
            JOIN gdc353_1.Personnel P ON P.ID = S.PersonID
            WHERE S.PersonID = ".$id."
            GROUP BY S.startDate; 
            "; 
$result = mysqli_query($conn, $query) or die ( mysqli_error($conn));

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View/Edit Student</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p><p><a href="Employees.php">Employees</a>
    <a href="Students.php">Students</a>
    <a href="Facilities.php">Facilities</a>
    <a href="Infections.php">Infections</a>
    <a href="Vaccines.php">Vaccines</a>
    <a href="Emails.php">Email Log</a>
</div></p>
<h1>View Student</h1>
<?php
$status = "";
$row = mysqli_fetch_assoc($result); 

?>
<div>
    <form action = "SavePerson.php" name="form" method="post"> 
        <input name="student" value="student" type=hidden />
        <input name="ID" value="<?php echo $id ?>" />

        <p><input type="text" name="FirstName" placeholder="Enter first name" 
        required value="<?php echo $row['FirstName'];?>" /></p>
        <p><input type="text" name="LastName" placeholder="last name" 
        required value="<?php echo $row['LastName'];?>" /></p>
        <p><input type="text" name="Email" placeholder="email" 
        required value="<?php echo $row['Email'];?>" /></p>
        <p><input type="tel" name="Phone" placeholder="phone number" 
        required value="<?php echo $row['Phone'];?>" /></p>
        <p><input type="text" name="Address" placeholder="address" 
        required value="<?php echo $row['Address'];?>" /></p>
        <p><input type="text" name="PostalCode" placeholder="postal code" 
        required value="<?php echo $row['PostalCode'];?>" /></p>
        <p><input type="text" name="City" placeholder="city" 
        required value="<?php echo $row['City'];?>" /></p>
        <p><input type="text" name="Province" placeholder="province" 
        required value="<?php echo $row['Province'];?>" /></p>
        <p><input type="date" name="CardExpiry" placeholder="card expiry" 
        required value="<?php echo $row['CardExpiry'];?>" /></p>
        <p><input type="date" name="DateOfBirth" placeholder="date of birth" 
        required value="<?php echo $row['DateOfBirth'];?>" /></p>
        <p><input type="text" name="citizenship" placeholder="citizenship" 
        required value="<?php echo $row['citizenship'];?>" /></p>
        <p><input name="submit" type="submit" value="Save Changes" /></p>
</form> 
<a href="DeletePerson.php?id=<?php echo $row["ID"]; ?>">Delete Student</a>
<h2> Enrollment History </h2> 
<?php  
while($row) { ?>
    <div> 
        <p>Facility: <?php echo $row['Facility'];?></p> 
        <p>Level: <?php echo $row['Level'];?></p> 
        <p>Start date :<?php echo $row['startDate'];?></p>
        <p>End date :<?php echo $row['endDate'];?></p>
    <a href="delete.php?id=
        <?php echo $row["PersonID"];?>
        &id=
        <?php echo $row["startDate"];?> 
    ">Delete</a>
    </div>  
    <br> 
    <?php
    $row = mysqli_fetch_assoc($result); 
    
}?> 

    <form action = "saveEnrollment.php" name="form" method="post">
        <input name="ID" value="<?php echo $id ?>" />
        <p><input type="text" name="startDate" placeholder="Start date" /></p>
        <p><input type="text" name="endDate" placeholder="End date" /></p>
        <p><input type="text" name="level" placeholder="level" /></p>
        <p><input type="text" name="Facility" placeholder="Facility" /></p>
        <p><input name="submit" type="submit" value="Submit enrollment details" /></p>
    </form> 
    <h3>Current Educational Facilities</h3> 

    <?php
    $query = "SELECT name FROM gdc353_1.EducationalFacility;";
    $facilities = mysqli_query($conn, $query) or die (mysqli_error($conn));
    while($row = mysqli_fetch_assoc($facilities)) { 
        echo "<p>".$row['name']."</p>"; 
    }  
    ?> 

</div>
</div>
</body>
</html>