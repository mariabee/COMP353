<?php
require('db.php');


$id=$_REQUEST['id'];

$query = "Select * from gdc353_1.Personnel P; 
            "; 
$result = mysqli_query($conn, $query) or die ( mysqli_error($conn));

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>View/Edit Vaccine</title>
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
    <?php
    $status = "";
    $row = mysqli_fetch_assoc($result);
    
    ?>
    <div>
        <div class="centreContainer">
            <h1>View Vaccine</h1>
        </div>
        <div class="centreContainer">
            <form action="SaveVaccine.php" name="form" method="post" class="row">
                <p>
                    Card Number <input name="ID" value="<?php echo $id ?>" />


                    Name<input name="FirstName" value="<?php echo $row['FirstName'];?>" />

                    Expiry <input type="date" name="CardExpiry" placeholder="card expiry" required value="<?php echo $row['CardExpiry'];?>" /></p>
                <p>
                    <input type="text" name="FirstName" placeholder="Enter first name" required value="<?php echo $row['FirstName'];?>" />
                    <input type="text" name="LastName" placeholder="last name" required value="<?php echo $row['LastName'];?>" />
                    <input type="text" name="Email" placeholder="email" required value="<?php echo $row['Email'];?>" />
                </p>

                <p><input type="text" name="Dose" placeholder="Dose" required value="<?php echo $row['Dose'];?>" />
                    <input type="text" name="Date" placeholder="Date" required value="<?php echo $row['Date'];?>" />

                </p>
                <input class="button purple_bg" name="submit" type="submit" value="Save Changes" />
                <p><a href="DeletePerson.php?id=<?php echo $row["ID"]; ?>" class="dark_bg">Delete Vaccine</a></p>


            </form>
        </div>
        <h3>Vaccine History</h3>
        <table style="border: 1px solid;" width="50%" border="1" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th><strong>Type</strong></th>
                    <th><strong>Dose</strong></th>
                    <th><strong>Date</strong></th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $sel_query="Select * from gdc353_1.Vaccine V
                    WHERE V.PatientID = ".$id.";";
                    $result = mysqli_query($conn,$sel_query);
                    while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td align="center"><?php echo $row["Type"]; ?></td>
                    <td align="center"><?php echo $row["Dose"]; ?></td>
                    <td align="center"><?php echo $row["Date"]; ?></td>
                    <td align="center">
                        <a href="deleteVaccine.php?dose=<?php echo $row["Dose"]; ?>" class="dark_bg">Delete</a>
                    </td>
                </tr>
                <?php } ?>
                <form action="saveVaccine.php" name="form" method="post">
                    <tr>
                        <input type="hidden" name="ID" value="<?php echo $id ?>" />
                        <td><input type="text" name="Type" placeholder="Type" /></td>
                        <td><input type="text" name="Dose" placeholder="Dose" /></td>
                        <td><input type="date" name="Date" placeholder="Date" /></td>
                    <tr>
                    <tr>
                        <td>
                            <input type="submit" class="purple_bg button"></input>
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>

        </table>

    </div>
</body>

</html>
