<?php
require('db.php');


$id=$_REQUEST['id'];

$query = "Select * from gdc353_1.Employee E
            JOIN gdc353_1.Personnel P ON P.ID = E.PersonID
            JOIN gdc353_1.isManagementEmployee M ON M.PersonID = E.PersonID AND M.startDate = E.startDate
            WHERE E.PersonID = ".$id."
            UNION 
            Select * from gdc353_1.Employee E
            JOIN gdc353_1.Personnel P ON P.ID = E.PersonID
            RIGHT OUTER JOIN gdc353_1.isEducationalEmployee Ed ON Ed.PersonID = E.PersonID AND Ed.startDate = E.startDate
            WHERE E.PersonID = ".$id."
            GROUP BY E.startDate; 
            "; 
$result = mysqli_query($conn, $query) or die ( mysqli_error($conn));

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>View Employee</title>
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
        <h1>Edit Employee</h1>
    </div>
            <?php
        $status = "";
        $row = mysqli_fetch_assoc($result); 

?>
    <div class = "centreContainer">
        <form action="SavePerson.php" name="form" method="post">
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
        <p><a href="DeletePerson.php?id=<?php echo $row["ID"]; ?>" class="dark_bg">Delete Employee</a></p>
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
            <a href="deleteVaccine.php?date=<?php echo $row["Date"]; ?>" class="dark_bg">Delete</a>
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
    <div class = "centreContainer">
        <h2> Contracts </h2>
        <?php  
while($row) { ?>
        <div>
            <p>Facility: <?php echo $row['facility'];?></p>
            <p>Position: <?php echo $row['position'];?></p>
            <p>Start date :<?php echo $row['startDate'];?></p>
            <p>End date :<?php echo $row['endDate'];?></p>
            <button> <a href="delete.php?id=
        <?php echo $row["PersonID"];?>
        &id=
        <?php echo $row["startDate"];?> 
    ">Delete</a> </button>
    <br> 
        </div>
        <?php
    $row = mysqli_fetch_assoc($result); 
    
}?>


        <form action="SaveContract.php" name="form" method="post">
            <input name="ID" value="<?php echo $id ?>" />
            <p><input type="text" name="position" placeholder="Position" /></p>
            <p><input type="date" name="startDate" placeholder="Start date" /></p>
            <p><input type="date" name="endDate" placeholder="End date" /></p>
            <input type="radio" name="type" <?php if (isset($type) && $type=="Management") echo "checked";?> value="Management">Management
            <input type="radio" name="type" <?php if (isset($level) && $level=="Educational") echo "checked";?> value="Educational">Educational

            <p><input name="submit" type="submit" value="Submit new contract" /></p>
        </form>


    </div>
    </div>
</body>

</html>
