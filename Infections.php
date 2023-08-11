<?php 
require('db.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>View Records</title>
    <link rel="stylesheet" href="css/style.css" />
    <style>
        body {
            background-color: powderblue;
            color: black;

        }

        h2 {
            color: darkblue;
            font-family: courier;
            font-size: 200%;
        }

        th {
            color: blue;
            font-family: courier;
            font-size: 100%;
        }

    </style>

</head>

<body>

    <nav style=" display: block; font-size: 30px; font-family: courier;
  padding: 11px;
  background-color: beige;">
        <a href="Employees.php">Employees</a>
        <a href="Students.php">Students</a>
        <a href="Facilities.php">Facilities</a>
        <a href="Infections.php">Infections</a>
        <a href="Vaccines.php">Vaccines</a>
        <a href="Emails.php">Email Log</a>
    </nav>

    <div class="form">
        <h2>Infections</h2>
        <table style="border: 1px solid;" width="100%" border="1" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th><strong>First Name</strong></th>
                    <th><strong>Last Name</strong></th>
                    <th><strong>Card No.</strong></th>
                    <th><strong>Type</strong></th>
                    <th><strong>Date</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
$count=1; 
$sel_query="Select * from gdc353_1.Infection I
    JOIN gdc353_1.Personnel P ON P.ID = I.PatientID
    GROUP BY PatientID
    ORDER BY lastName, firstName asc;";
$result = mysqli_query($conn,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td align="center"><?php echo $row["FirstName"]; ?></td>
                    <td align="center"><?php echo $row["LastName"]; ?></td>
                    <td align="center"><?php echo $row["ID"]; ?></td>
                    <td align="center"><?php echo $row["Type"]; ?></td>
                    <td align="center"><?php echo $row["Date"]; ?></td>
                    <td align="center">
                        <a href="editStudent.php?id=<?php echo $row["ID"]; ?>" class="green_bg">View/Edit</a>
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
