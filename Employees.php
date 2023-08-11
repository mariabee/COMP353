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

<h2>Employees</h2>
<table width="100%" border="1" style="border-collapse:collapse;">
    <thead>
    <tr>
        <th><strong>Card No.</strong></th>
        <th><strong>First Name</strong></th>
        <th><strong>Last Name</strong></th>
        <th><strong>Email</strong></th>
    </tr>
    </thead>
    <tbody>
<?php
$count=1; 
$sel_query="Select * from gdc353_1.Employee E
    JOIN gdc353_1.Personnel P ON P.ID = E.PersonID
    GROUP BY PersonID
    ORDER BY lastName, firstName asc;";
$result = mysqli_query($conn,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td align="center"><?php echo $row["ID"]; ?></td>
                <td align="center"><?php echo $row["FirstName"]; ?></td>
                <td align="center"><?php echo $row["LastName"]; ?></td>
                <td align="center"><?php echo $row["Email"]; ?></td>
                <td align="center">
                    <a href="editEmployee.php?id=<?php echo $row["ID"]; ?>" class="green_bg">View/Edit</a>
                </td>
                </td>
                <td align="center">
                    <a href="DeletePerson.php?id=<?php echo $row["ID"]; ?>" class="dark_bg">Delete</a>
                </td>
            </tr>
            <?php } ?>
            <form action = "newPerson.php" name="form" method="post">
            <tr>
                <td align="center">Add new</td> 
                <td></td> 
                <td></td> 
                <td></td>
                <td align="center">Start Date</td> 
                <td></td>
            </tr>
            <tr> 
                <td align="center"><input type="text" name="ID" required /></td>
                <td align="center"><input type="text" name="FirstName" placeholder="First Name" required></input></td> 
                <td align="center"><input type="text" name="LastName" placeholder="Last Name" required></input></td>
                <td align="center"><input type="text" name="Email" placeholder="Email"></input></td>
                <td align="center"><input type="date" name="startDate" placeholder="Start date"></input></td>
                <td align="center"><input type="submit" class = "purple_bg button"></input></td>
            </tr>  
            </form>
        </tbody>
    </table>
    </div>
</body>

</html>
