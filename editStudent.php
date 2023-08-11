<?php
require('db.php');

$id=$_REQUEST['id'];

$query = "Select * from gdc353_1.Personnel P WHERE P.ID =".$id.";"; 

$result = mysqli_query($conn, $query) or die ( mysqli_error($conn));
$person = mysqli_fetch_assoc($result);

$expiry = $person['CardExpiry'];
$phone = $person['Phone']; 
$address = $person['Address'];
$postal = $person['PostalCode'];
$city = $person['City'];
$province = $person['Province'];
$citizen = $person['citizenship'];
$bday = $person['DateOfBirth']; 

$query = "Select * from gdc353_1.Student S
            WHERE S.PersonID = ".$id."
            GROUP BY S.startDate; 
            "; 
$student = mysqli_query($conn, $query) or die ( mysqli_error($conn));
$contracts = mysqli_fetch_assoc($student); 

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>View/Edit Student</title>
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
    <div>
        <div class="centreContainer">
            <h1>View Student</h1>
        </div>
        <div class="centreContainer">
        <form action="SavePerson.php" name="form" method="post">
            <p>
                Card Number <input name="ID" value="<?php echo $id ?>" required/>
                Expiry <input type="date" name="CardExpiry" placeholder="card expiry" required value="<?php echo $expiry;?>" /></p>
            <p>
                <input type="text" name="FirstName" placeholder="Enter first name" required value="<?php echo $person['FirstName'];?>" />
                <input type="text" name="LastName" placeholder="last name" required value="<?php echo $person['LastName'];?>" />
                <input type="text" name="Email" placeholder="email" required value="<?php echo $person['Email'];?>" />
            </p>
            <p><input type="tel" name="Phone" placeholder="phone number" required value="<?php echo $phone;?>" />
                <input type="text" name="Address" placeholder="address" required value="<?php echo $address;?>" />
                <input type="text" name="PostalCode" placeholder="postal code" required value="<?php echo $postal;?>" />
            </p>
            <p><input type="text" name="City" placeholder="city" required value="<?php echo $city;?>" />
                <input type="text" name="Province" placeholder="province" required value="<?php echo $province;?>" />
                <input type="text" name="citizenship" placeholder="citizenship" required value="<?php echo $citizen;?>" />
            </p>
            <p>Birth date <input type="date" name="DateOfBirth" placeholder="date of birth" required value="<?php echo $bday;?>" /></p>
            <input class="button purple_bg" name="submit" type="submit" value="Save Changes" />
            <p><a href="DeletePerson.php?id=<?php echo $person["ID"]; ?>" class="dark_bg">Delete Student</a></p>
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
                <form action = "saveVaccine.php" name="form" method="post">
                <tr> 
                    <input type = "hidden" name="ID" value="<?php echo $id ?>" />
                    <input type = "hidden" name="student" value="<?php echo $id ?>" />
                    <td><input type="text" name="Type" placeholder="Type" /></td>
                    <td><input type="text" name="Dose" placeholder="Dose" /></td>
                    <td><input type="date" name="Date" placeholder="Date" /></td>
                <tr> 
                <tr>
                    <td>  
                        <input type = "submit" class="purple_bg button"></input>
                    </td> 
                </tr> 
                    </form> 
            </tbody> 
        </table> 
                
        <h3>Infection History</h3> 
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
                <a href="deleteVaccine.php?date=<?php echo $row["Date"]; ?>" class="dark_bg">Delete</a>
                </td>
            </tr>
            <?php } ?>  
            <form action = "saveInfection.php" name="form" method="post">
            <tr> 
                <input type = "hidden" name="ID" value="<?php echo $id ?>" />
                <input type = "hidden" name="student" value="<?php echo $id ?>" />
                <td><input type="text" name="Type" placeholder="Type" /></td>
                <td><input type="date" name="Date" placeholder="Date" /></td>
                <td>  
                    <input type = "submit" class="purple_bg button"></input>
                </td>
            </tr>  
            </form> 
        </tbody> 
        </table> 
        <div class="centreContainer">
            <h2> Enrollment History </h2>
            <?php if(!$contracts) {echo "<p style='color: red;'>*Student is missing enrollment details</p>";} ?>
            <?php  
        while($row) { ?>
            <div>
                <p>Facility: <?php echo $row['Facility'];?></p>
                <p>Level: <?php echo $row['Level'];?></p>
                <p>Start date :<?php echo $row['startDate'];?></p>
                <p>End date :<?php echo $row['endDate'];?></p>
                <?php
                $date = $contracts['startDate']; 
                $url = "id={$id}&startDate={$date}";
                ?>
                <a href="deleteEnrollment.php?<?=$url?>">Delete</a> 
                <br>
            </div>

            <?php
            $contracts = mysqli_fetch_assoc($student); 
            
        }?>

            <form action="saveEnrollment.php" name="form" method="post">
                <input name="ID" value="<?php echo $id ?>" />
                <p><input type="date" name="startDate" placeholder="Start date" /></p>
                <p><input type="checkbox" id="current" name="current">
                <label for="current">Currently enrolled</label></p> 
                <p><input type="text" name="endDate"  placeholder="End Date"/></input></p>
                <p><input type="text" name="level" placeholder="level" /></p>
                <p><input type="text" name="Facility" placeholder="Facility" /></p>
                <p><input class="button purple_bg" name="submit" type="submit" value="Submit enrollment details" /></p>
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
