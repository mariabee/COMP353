<?php
require('db.php');


$id=$_REQUEST['id'];

$query = "Select * from gdc353_1.Infection I
            JOIN gdc353_1.Personnel P ON P.ID = I.PatientID
            WHERE I.PatientID = ".$id."
            GROUP BY P.LastName; 
            "; 
$result = mysqli_query($conn, $query) or die ( mysqli_error($conn));

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>View/Edit Infections</title>
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
            <h1>View Infections</h1>
        </div>
        <div class="centreContainer">
            <form action="SavePerson.php" name="form" method="post" class="row">
                <input name="student" value="student" type=hidden />
                <p>
                    Card Number <input name="ID" value="<?php echo $id ?>" />
                    Expiry <input type="date" name="CardExpiry" placeholder="card expiry" required value="<?php echo $row['CardExpiry'];?>" /></p>
                <p>
                    <input type="text" name="FirstName" placeholder="Enter first name" required value="<?php echo $row['FirstName'];?>" />
                    <input type="text" name="LastName" placeholder="last name" required value="<?php echo $row['LastName'];?>" />
                    <input type="text" name="Email" placeholder="email" required value="<?php echo $row['Email'];?>" />
                </p>
                <p><input type="tel" name="Phone" placeholder="phone number" required value="<?php echo $row['Phone'];?>" />
                    <input type="text" name="Address" placeholder="address" required value="<?php echo $row['Address'];?>" />
                    <input type="text" name="PostalCode" placeholder="postal code" required value="<?php echo $row['PostalCode'];?>" />
                </p>
                <p><input type="text" name="City" placeholder="city" required value="<?php echo $row['City'];?>" />
                    <input type="text" name="Province" placeholder="province" required value="<?php echo $row['Province'];?>" />
                    <input type="text" name="citizenship" placeholder="citizenship" required value="<?php echo $row['citizenship'];?>" />
                </p>
                <p>Birth date <input type="date" name="DateOfBirth" placeholder="date of birth" required value="<?php echo $row['DateOfBirth'];?>" /></p>
                <input class="button purple_bg" name="submit" type="submit" value="Save Changes" />

            </form>
        </div>
                
        <h3>Infection History</h3> 
        <input type = "hidden" name="ID" value="<?php echo $id ?>" />
        <table style="border: 1px solid;" width="50%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th><strong>Type</strong></th>
                        <th><strong>Date</strong></th>
                        <th></th> 
                    </tr>
                </thead>
        <tbody>
        <?php
                $sel_query="Select * from gdc353_1.Infection I
                WHERE I.PatientID = ".$id.";";
                $result = mysqli_query($conn,$sel_query);
                while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td align="center"><?php echo $row["Type"]; ?></td>
                <td align="center"><?php echo $row["Date"]; ?></td>
                <td align="center">
                <a href="deleteInfections.php?id=<?php echo $id; ?>&Date=<?php echo $row["Date"]; ?>" class="dark_bg">Delete</a>
                </td>
            </tr>
            <?php } ?>  
            <form action = "saveInfection.php" name="form" method="post">
            <tr> 
                <td><input type="text" name="Type" placeholder="Type" /></td>
                <td><input type="date" name="Date" placeholder="Date" /></td>
                <td>  
                    <input type = "submit" class="purple_bg button"></input>
                </td>
                    

            </tr>  
            </form> 
        </tbody> 
        </table> 
    </div>
</body>

</html>
