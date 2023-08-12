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

<h2>System Email Log</h2>

<a href = "sundayEmail.php">View the upcoming Sunday emails</a>
<table width="100%" border="1" style="border-collapse:collapse;">
    <thead>
    <tr>
        <th><strong>Send date</strong></th>
        <th><strong>Sender (Facility)</strong></th>
        <th><strong>Receiver</strong></th>
        <th><strong>Subject</strong></th>
        <th><strong>Body</strong></th>
    </tr>
    </thead>
    <tbody>
<?php
$count=1; 
$sel_query="Select * from gdc353_1.EmailLog E
    ORDER BY date, Facility, subject asc;";
$result = mysqli_query($conn,$sel_query) or die ( mysqli_error($conn));

while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td align="center"><?php echo $row["date"]; ?></td>
                <td align="center"><?php echo $row["facility"]; ?></td>
                <td align="center"><?php echo $row["receiver"]; ?></td>
                <td align="center"><?php echo $row["subject"]; ?></td>
                <td align="center"><?php echo $row["body"]; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
</body>

</html>