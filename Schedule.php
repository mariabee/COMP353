
<?php
require('db.php');

$id=$_REQUEST['id'];

$today = new DateTime('now', new DateTimeZone('US/Eastern'));
$today = $today->format('Y-m-d');


$query = "Select * from gdc353_1.Schedule WHERE PersonID =".$id."
        AND date >= '".$today."'
        ORDER BY date ASC, Facility ASC, startTime ASC;"; 

$future = mysqli_query($conn, $query) or die ( mysqli_error($conn));
$pastDay = null; 


$query = "Select * from gdc353_1.Schedule WHERE PersonID =".$id."
        AND date < '".$today."'
        ORDER BY date DESC, Facility ASC, startTime ASC;"; 
$past = mysqli_query($conn, $query) or die ( mysqli_error($conn));



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>View Schedule</title>
    <link rel="stylesheet" href="css/style.css" />

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
        <h1>Schedule for Employee #<?=$id?></h1>
        <a href = "Schedule.php?<?=$id?>" class = "green_bg, button">VIEW EMPLOYEE SCHEDULE</a> 
    </div>
        <div class = "centreContainer">
        
        <table style="border: 1px solid;" width="75%" border="1" style="border-collapse:collapse;"> 
            <thead>
                <tr>
                    <th><strong>Date</strong></th>
                    <th><strong>Facility</strong></th>
                    <th><strong>Start</strong></th>
                    <th><strong>End</strong></th>
                </tr>
            </thead>
            <tbody> 
            <tr>
                <td align = "centre"><h3>Upcoming shifts</h3></td> 
            </tr> 
            <form action = "addShift.php" name="form" method="post">
            <tr> 
                <input type = "hidden" name="ID" value="<?php echo $id ?>" />
                <td align="centre"><input type="date" name="date" placeholder="Day" /></input></td>
                <td align="centre"><input type="text" name="Facility" placeholder="Facility" /></input></td>
                <td align="centre"><input type="time" name="startTime" placeholder="startTime" /></input></td>
                <td align="centre"><input type="time" name="endTime" placeholder="endTime" /></input></td>
                <td align="centre">  
                    <input type = "submit" class="purple_bg button"></input>
                </td>
            <tr> 
            </form> 
        
        <?php 

        
        while ($schedule = mysqli_fetch_assoc($future)) {
            $date = $schedule['date'];
            $start = $schedule['startTime'];
            $end = $schedule['endTime'];
            $facility = $schedule['Facility']; 
            ?>  
            <tr>
                <td align='center'><?=$date?></td>
                <td align='center'><?=$facility?></td>
                <td align='center'><?=$start?></td>
                <td align='center'><?=$end?></td> 
                <?php $url = "date=".$date."&start=".$start."&id=".$id; ?> 
                <td align='center'><a href="deleteShift.php?<?=$url?>" class="dark_bg">Delete</a> 
                </td align='center'>
                </tr align='center'>
            <?php 
            $day = new DateTime($date, new DateTimeZone('US/Eastern'));
            if (date_format($day, 'N') == 7) {
                ?>
                <tr>
                    <td></td> 
                </tr> <?php  
                }?> 
        <?php } ?>         
        <tr>
            <td align = "centre"><h3>Past shifts</h3></td> 
        </tr> 
        <?php  
        while ($schedule = mysqli_fetch_assoc($past)) {
            $date = $schedule['date'];
            $start = $schedule['startTime'];
            $end = $schedule['endTime'];
            $facility = $schedule['Facility']; 
            ?>  
            <tr>
                <td align='center'><?=$date?></td>
                <td align='center'><?=$facility?></td>
                <td align='center'><?=$start?></td>
                <td align='center'><?=$end?></td> 
                <?php $url = "date=".$date."&start=".$start."&id=".$id; ?> 
                <td align='center'><a href="deleteShift.php?<?=$url?>" class="dark_bg">Delete</a> 
                </td align='center'>
                </tr align='center'>
            <?php 
            $day = new DateTime($date, new DateTimeZone('US/Eastern'));
            if (date_format($day, 'N') == 7) {
                ?>
                <tr>
                    <td></td> 
                </tr> <?php  
                }?> 
        <?php } ?>    
        </tbody> 
        </table> 
        

    </div>
    </div>
</body>

</html>