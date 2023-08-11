<?php
require('db.php'); 

if(isset($_POST['ID']) && isset($_POST['startDate']))
{      
        $id = $_REQUEST['ID'];

if (isset($type) && $type = 'Management') {
            $query = "SELECT name FROM gdc353_1.ManagementFacility M;";
            $insert = "INSERT INTO gdc353_1.isManagementEmployee(PersonID, startDate)
            VALUES (".$id.",'".$startDate."');";
        }
        else if (isset($type) && $type = 'Educational') {
            $query = "SELECT name FROM gdc353_1.EducationalFacility E;";
            $insert = "INSERT INTO gdc353_1.isManagementEmployee(PersonID, startDate)
            VALUES (".$id.",'".$startDate."');";
        }

?> 