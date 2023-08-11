<?php
require('db.php'); 
if(isset($_POST['ID']) && isset($_POST['startDate']) && isset($_POST['type']) && isset($_POST['facility']))
{      
        
        $id = $_REQUEST['ID'];
        $type = $_REQUEST['type'];
        $startDate = $_REQUEST['startDate'];
        $facility = $_REQUEST['facility'];

        if ($type = 'Management') {
            $insert = "INSERT INTO gdc353_1.isManagementEmployee(PersonID, startDate, facility)
            VALUES (".$id.",'".$startDate."','".$facility."');";
        }
        else if (isset($type) && $type = 'Educational') {
            $query = "SELECT name FROM gdc353_1.EducationalFacility E;";
            $insert = "INSERT INTO gdc353_1.isEducationalEmployee(PersonID, startDate, facility)
            VALUES (".$id.",'".$startDate."','".$facility."');";
        }

        $result = mysqli_query($conn, $insert) or die ( mysqli_error($conn));
        
        if (strcmp($position,'teacher') == 0) {

            if(isset($_POST['level'])) {
                echo $level; 
                $level = $_REQUEST['level']; 
                $insert = "INSERT INTO gdc353_1.isTeacher(PersonID, startDate, level)
                VALUES (".$id.",'".$startDate."','".$facility."');";
                $result = mysqli_query($conn, $insert) or die ( mysqli_error($conn));

                if(strcmp($level,'seceondary') == 0) {
                    if(isset($_POST['Specialization'])) {
                        $special = $_REQUEST['Specialization'];
                        $insert = "INSERT INTO gdc353_1.isSecondaryTeacher(PersonID, startDate, specialization)
                        VALUES (".$id.",'".$startDate."','".$special."');";
                        $result = mysqli_query($conn, $insert) or die ( mysqli_error($conn));
                    }
                    else {
                        exit("Please enter a specialization");
                    }
                }
            }

        }


        header("Location: editEmployee.php?id=".$id);
        exit("Succes");
    }
else {
    header("Location: editEmployee.php?id=".$id);
    exit("Missing information");
}

?> 