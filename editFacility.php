<?php
require('db.php');


$Name=$_REQUEST['Name'];

$query = "Select * from gdc353_1.Facilicty F
            JOIN gdc353_1.EducationalFacility E ON  E.name= F.Name
            JOIN gdc353_1.ManagementFacility M ON M.name = F.Name
            WHERE F.Name = ".$Name.";"; 
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
    <h1>Edit Employee</h1>
    <?php
$status = "";
$row = mysqli_fetch_assoc($result); 

?>
    <div>
        <form action="SavePerson.php" name="form" method="post">
            <input name="ID" value="<?php echo $row['ID'] ?>" />
            <p><input type="text" name="FirstName" placeholder="Enter first name" required value="<?php echo $row['FirstName'];?>" /></p>
            <p><input type="text" name="LastName" placeholder="last name" required value="<?php echo $row['LastName'];?>" /></p>
            <p><input type="text" name="Email" placeholder="email" required value="<?php echo $row['Email'];?>" /></p>
            <p><input type="tel" name="Phone" placeholder="phone number" required value="<?php echo $row['Phone'];?>" /></p>
            <p><input type="text" name="Address" placeholder="address" required value="<?php echo $row['Address'];?>" /></p>
            <p><input type="text" name="PostalCode" placeholder="postal code" required value="<?php echo $row['PostalCode'];?>" /></p>
            <p><input type="text" name="City" placeholder="city" required value="<?php echo $row['City'];?>" /></p>
            <p><input type="text" name="Province" placeholder="province" required value="<?php echo $row['Province'];?>" /></p>
            <p><input type="date" name="CardExpiry" placeholder="card expiry" required value="<?php echo $row['CardExpiry'];?>" /></p>
            <p><input type="date" name="DateOfBirth" placeholder="date of birth" required value="<?php echo $row['DateOfBirth'];?>" /></p>
            <p><input type="text" name="citizenship" placeholder="citizenship" required value="<?php echo $row['citizenship'];?>" /></p>
            <p><input name="submit" type="submit" value="Save Changes" /></p>
        </form>
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
        </div>
        <br>
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