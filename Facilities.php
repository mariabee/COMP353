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

    <nav><a href="Employees.php">Employees</a>
        <a href="Students.php">Students</a>
        <a href="Facilities.php">Facilities</a>
        <a href="Infections.php">Infections</a>
        <a href="Vaccines.php">Vaccines</a>
        <a href="Emails.php">Email Log</a>
    </nav>

    <h2>Facilities</h2>
    <table style="border: 1px solid;" width="100%" border="1" style="border-collapse:collapse;">
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
                    <a href="editEmployee.php?id=<?php echo $row["ID"]; ?>" class="green_bg">View/Edit</a>
                </td>
                </td>
                <td align="center">
                    <a href="DeletePerson.php?id=<?php echo $row["ID"]; ?>" class="dark_bg">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
</body>

</html>
