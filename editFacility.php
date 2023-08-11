<?php
require('db.php');


$Name=$_REQUEST['Name'];

$query = "SELECT * FROM gdc353_1.Facility F WHERE F.Name = '$Name'";

$result = mysqli_query($conn, $query) or die ( mysqli_error($conn));
$facility = mysqli_fetch_assoc($result);

$name = $facility['Name'];
$address = $facility['Address'];
$postal = $facility['PostalCode'];
$city = $facility['City'];
$province = $facility['Province'];
$webaddress = $facility['WebAddress'];
$phonenumber = $facility['phoneNumber'];
$type = $facility['Type']; 
$capacity = $facility['Capacity']; 


$query = "Select * from gdc353_1.Facility F;"; 
$facility = mysqli_query($conn, $query) or die ( mysqli_error($conn));
$row = mysqli_fetch_assoc($facility);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>View Facility</title>
    <link rel="stylesheet" href="css/style.css" />

</head>

<body>
    <div class="form">
        <nav><a href="Employees.php">Employees</a>
            <a href="Students.php">Students</a>
            <a href="Facilities.php">Facilities</a>
            <a href="Infections.php">Infections</a>
            <a href="Vaccines.php">Vaccines</a>
            <a href="Emails.php">Email Log</a>
        </nav>
    </div>
    <div>
        <div class="centreContainer">
            <h1>Edit Facility</h1>
        </div>


        <div class="centreContainer">
            <form action="saveContract.php" name="form" method="post">

                <p>

                    <input name="Name" placeholder="Name" value="<?php echo $row['Name'];?>" />


                    <input type="text" name="Address" placeholder="Address" required value="<?php echo $row["Address"]; ?>" />


                    <input type="text" name="PostalCode" placeholder="PostalCode" required value="<?php echo $row["PostalCode"]; ?>" />

                </p>
                <p><input type="text" name="City" placeholder="City" required value="<?php echo $row["City"]; ?>" />


                    <input type="text" name="Province" placeholder="Province" required value="<?php echo $row["Province"]; ?>" />



                    <input type="text" name="WebAddress" placeholder="Web Address" required value="<?php echo $row["WebAddress"]; ?>" />


                </p>
                <p><input type="text" name="phoneNumber" placeholder="phoneNumber" required value="<?php echo $row["phoneNumber"]; ?>" />



                    <input type="text" name="Type" placeholder="Type" required value="<?php echo $row["Type"]; ?>" />



                    <input type="text" name="Capacity" placeholder="Capacity" required value="<?php echo $row["Capacity"]; ?>" />
                </p>

                <input class="button purple_bg" name="submit" type="submit" value="Save Changes" />
                <p><a href="DeleteFacility.php?id=<?php echo $row["ID"]; ?>" class="dark_bg">Delete Facility</a></p>
            </form>
        </div>



        </table>
    </div>
</body>

</html>
