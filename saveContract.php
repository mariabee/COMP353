<?php
require('db.php'); 

if(isset($_POST['ID']) && isset($_POST['type']) && isset($_POST['startDate']))
{      
        $id = $_REQUEST['ID'];
        $startDate =$_REQUEST['startDate'];
        $endDate = $_REQUEST['endDate'];
        $position=$_REQUEST['position'];
        $type = $_REQUEST['type'];

        $insertEmployee = "INSERT INTO gdc353_1.Employee (PersonID, startDate, endDate, position)
                        VALUES (".$id.", '".$startDate."', '".$endDate."', '".$position."')"; 
        $result = mysqli_query($conn, $insertEmployee) or die ( mysqli_error($conn));
        
        if ($type == 'Management') { 
            $query = "SELECT name FROM gdc353_1.ManagementFacility;";
        }
        else if ($type == 'Educational') {
            $query = "SELECT name FROM gdc353_1.EducationalFacility;";
            
        }
        else {
            exit("Educational or Management contract not selected.");
        }
        $facilities = mysqli_query($conn, $query) or die (mysqli_error($conn));
    
        ?> 
        <form action = "saveEmployeeFacility.php" name="saveEmployee" method="post">
        <?php
        if ($type == 'Educational') {
            if (strcmp($position,'teacher') == 0) { ?>
                
                <input name="ID" type="hidden" value="<?php echo $row['ID'] ?>" />
                <p>Type of teacher</p> 
                <input type="radio" name="level"
                        <?php if (isset($level) && $level=="Primary") echo "checked";?>
                        value="Primary">Primary
                <input type="radio" name="level"
                        <?php if (isset($level) && $level=="Secondary") echo "checked";?>
                        value="Secondary">Secondary
                <input type="text" name = "Specialization" 
                        <?php if (isset($level) && ($level=="Primary" || $level=="Tertiary")) echo "disabled";?>
                        value="Specialization">
                <input type="radio" name="level"
                        <?php if (isset($level) && $gender=="Tertiary") echo "checked";?>
                        value="Tertiary">Tertiary
                </div> 
            <?php }} ; 
        ?>

        
                <input name="ID" type="hidden" value="<?php echo $id ?>" />
                <input name="startDate" type="hidden" value="<?php echo $startDate ?>" />
                <input name="type" type="hidden" value="<?php echo $type ?>" />
                <input name="position" type="hidden" value="<?php echo $position ?>" />
                <p>Please enter the facility: </p>
                <p><input type="text" name="facility" placeholder="facility" /></p>
                <input name="submit" type="submit" value="Confirm" />
        </form> 
        
        
        <?php 
        echo "<h2>".$type." Facilities: </h2>";
        while($row = mysqli_fetch_assoc($facilities)) {
            echo "<p>".$row['name']."</p>"; 
        }         
    }
else {
    header("Location: editEmployee.php?id=".$id);
    exit("Missing information");
}
?> 