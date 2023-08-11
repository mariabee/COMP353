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

<div class="form">
<h2>Students</h2>
<table width="100%" border="1" style="border-collapse:collapse;">
    <thead>
    <tr>
        <th><strong>First Name</strong></th>
        <th><strong>Last Name</strong></th>
        <th><strong>Card No.</strong></th>
        <th><strong>Email</strong></th>
    </tr>
    </thead>
    <tbody>
<?php
$count=1; 
$sel_query="Select * from gdc353_1.Student S
    JOIN gdc353_1.Personnel P ON P.ID = S.PersonID
    GROUP BY PersonID
    ORDER BY lastName, firstName asc;";
$result = mysqli_query($conn,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td align="center"><?php echo $row["FirstName"]; ?></td>
        <td align="center"><?php echo $row["LastName"]; ?></td>
        <td align="center"><?php echo $row["ID"]; ?></td>
        <td align="center"><?php echo $row["Email"]; ?></td>
        <td align="center">
        <a href="editStudent.php?id=<?php echo $row["ID"]; ?>" class = "green_bg">View/Edit</a>
        </td>
        </td>
        <td align="center">
        <a href="DeletePerson.php?id=<?php echo $row["ID"]; ?>" class= "dark_bg">Delete</a>
        </td>
    </tr>
    <?php } ?>
</tbody>
</table>
</div>
</body>
</html>