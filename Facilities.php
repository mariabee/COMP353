<?php 
require('db.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>View Records</title>
    <link rel="stylesheet" href="css/style.css" />

</head>

<body>

    <nav>
        <a href="Employees.php">Employees</a>
        <a href="Students.php">Students</a>
        <a href="Facilities.php">Facilities</a>
        <a href="Infections.php">Infections</a>
        <a href="Vaccines.php">Vaccines</a>
        <a href="Emails.php">Email Log</a>
    </nav>

    <h2>Facility</h2>
    <table width="100%" border="1" style="border-collapse:collapse;">
        <thead>
            <tr>
                <th><strong>Name</strong></th>
                <th><strong>Address</strong></th>
                <th><strong>Postal Code</strong></th>
                <th><strong>City</strong></th>
                <th><strong>Province</strong></th>
                <th><strong>Web Address</strong></th>
                <th><strong>Phone Number</strong></th>
                <th><strong>Type</strong></th>
                <th><strong>Capacity</strong></th>
            </tr>
        </thead>
        <tbody>
            <?php
$count=1; 
$sel_query="Select * from gdc353_1.Facility F;";
$result = mysqli_query($conn,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td align="center"><?php echo $row["Name"]; ?></td>
                <td align="center"><?php echo $row["Address"]; ?></td>
                <td align="center"><?php echo $row["PostalCode"]; ?></td>
                <td align="center"><?php echo $row["City"]; ?></td>
                <td align="center"><?php echo $row["Province"]; ?></td>
                <td align="center"><?php echo $row["WebAddress"]; ?></td>
                <td align="center"><?php echo $row["phoneNumber"]; ?></td>
                <td align="center"><?php echo $row["Type"]; ?></td>
                <td align="center"><?php echo $row["Capacity"]; ?></td>
                <td align="center">
                    <a href="editFacility.php?id=<?php echo $row["Name"]; ?>" class="green_bg">View/Edit</a>
                </td>

                <td align="center">
                    <a href="DeleteFacility.php?Name=<?php echo $row["Name"]; ?>" class="dark_bg">Delete</a>
                </td>
            </tr>
            <?php } ?>
            <form action="newPerson.php" name="form" method="post">
                <tr>
                    <td align="center">Add new</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="center">Start Date</td>
                    <td></td>
                </tr>
                <tr>
                    <td align="center"><input type="text" name="Name" required /></td>

                    <td align="center"><input type="text" name="Address" placeholder="Address" required></input></td>

                    <td align="center"><input type="text" name="Postal Code" placeholder="Postal Code" required></input></td>

                    <td align="center"><input type="text" name="City" placeholder="City" required></input></td>

                    <td align="center"><input type="text" name="Province" placeholder="Province"></input></td>

                    <td align="center"><input type="text" name="WebAddress" placeholder="WebAddress"></input></td>

                    <td align="center"><input type="text" name="phoneNumber" placeholder="phoneNumber"></input></td>

                    <td align="center"><input type="text" name="Type" placeholder="Type"></input></td>

                    <td align="center"><input type="text" name="Capacity" placeholder="Capacity"></input></td>


                    <td align="center"><input type="submit" class="purple_bg button"></input></td>
                </tr>
            </form>
        </tbody>
    </table>
    </div>
</body>

</html>
