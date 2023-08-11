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



<?php


$today = new DateTime('now', new DateTimeZone('US/Eastern')); 
$today = new DateTime('2023-08-13', new DateTimeZone('US/Eastern')); 
if (date_format($today, 'N') == 7) {
    SundayEmail($today, $conn); 
}

function SundayEmail($today, $conn) {

    
    $currentsunday = $today->format('Y-m-d');
    $nextmonday = $today->modify('+1 day')->format('Y-m-d');
    $nextsunday = $today->modify('+6 day')->format('Y-m-d');
    
    
    $sql = "SELECT E.PersonID, FirstName, LastName, Email
    FROM gdc353_1.Employee E 
    JOIN gdc353_1.Personnel P ON E.PersonID = P.ID
    WHERE E.endDate IS NULL
    GROUP BY PersonID";
    
    $body = "";
    $subject = NULL;
    $sender = NULL;
    $receiver = NULL;

    $employees = mysqli_query($conn, $sql) or die ( mysqli_error($conn));
    
     
    while($row = mysqli_fetch_assoc($employees)){
        
       
        $firstName = $row["FirstName"];
        $lastName = $row["LastName"];
        $email = $row["Email"];
        $receiver = $row["PersonID"];
     
        $subject = " Upcoming schedule from Monday, ".$nextmonday." to Sunday, ".$nextsunday;
        
        $sql = "SELECT date, startTime, endTime, F.name, F.address
                FROM gdc353_1.Schedule S
                JOIN gdc353_1.Facility F ON S.Facility = F.name
                WHERE PersonID = ".$receiver." AND date BETWEEN '".$nextmonday."' AND '".$nextsunday."' 
                ORDER BY F.name, date, startTime ASC;";
        $week = mysqli_query($conn, $sql) or die ( mysqli_error($conn)); 
        
        $monday = $tuesday = $wednesday = $thursday = $friday = $saturday = $sunday = "No assignment"; 
        $pastsender = null; 
        $count = 0; 
        while($day = mysqli_fetch_assoc($week)) {
            $count++; 

            $sender = $day["name"];

            if($pastsender != $sender ) {

                if($pastsender != null) {
                    $body.= "Monday: ".$monday."<br>
                    Tuesday: ".$tuesday."<br>
                    Wednesday: ".$wednesday."<br>
                    Thursday: ".$thursday."<br>
                    Friday: ".$friday."<br>
                    Saturday: ".$saturday."<br>
                    Sunday: ".$sunday."<br>Have a great week. ";

                    $sql = "INSERT INTO gdc353_1.EmailLog (facility, receiver, subject, body, date)
                    VALUES ('".$sender."', ".$receiver.", '".substr($subject,0,255)."', '".substr($body, 0, 80)."','".$currentsunday."')";
                    
                    if ($conn->query($sql) === TRUE) {
                        echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    echo "<br>Email sent to :".$firstName." ".$lastName."<br>
                        Subject : ".$subject."<br>
                        Body : ".$body."<br>"; 
                    
                }
                $subject =$sender." ".$subject; 
                $address = $day["address"];
                $body = "Sent from : ".$sender."<br>".$address."<br>To: ".$email."<br>Hello ".$firstName." ".$lastName."<br>
                Here is your upcoming schedule for the week of Monday,".$nextmonday." to Sunday, ".$nextsunday."<br>";
            }
            
            $workdate = $day['date'];
            $start = date_format(date_create_from_format("H:i:s", $day['startTime']), 'h:ia'); 
            $end = date_format(date_create_from_format("H:i:s", $day['endTime']), 'h:ia'); 
            
            switch (date_format(date_create($workdate), 'N')) {
                case 1:
                    if ($monday == "No assignment") {
                        $monday = $start. " to ".$end;
                    }
                    else {
                        $monday.= "<br>BREAK<br>".$start. " to ".$end;
                    }
                    break;
                case 2:
                    if ($tuesday == "No assignment") {
                        $tuesday = $start. " to ".$end;
                    }
                    else {
                        $tuesday.= "<br>BREAK<br>".$start. " to ".$end;
                    }
                    break;
                case 3:
                    if ($wednesday == "No assignment") {
                        $wednesday = $start. " to ".$end;
                    }
                    else {
                        $wednesday.= "<br>BREAK<br>".$start. " to ".$end;
                    }
                    break;
                case 4:
                    if ($thursday == "No assignment") {
                        $thursday = $start. " to ".$end;
                    }
                    else {
                        $thursday.= "<br>BREAK<br>".$start. " to ".$end;
                    }
                    break;
                case 5:
                    if ($friday == "No assignment") {
                        $friday = $start. " to ".$end;
                    }
                    else {
                        $friday.= "<br>BREAK<br>".$start. " to ".$end;
                    }
                    break;
                case 6:
                    if ($saturday == "No assignment") {
                            $saturday = $start. " to ".$end;
                    }
                    else {
                            $saturday.= "<br>BREAK<br>".$start. " to ".$end;
                        }
                    break;
                case 7:
                    if ($sunday == "No assignment") {
                            $sunday = $start. " to ".$end;
                    }
                    else {
                            $sunday.= "<br>BREAK<br>".$start. " to ".$end;
                        }
                    break;
                default:
                        echo("Date is null");
                }
            $pastsender = $sender; 
        }
        if ($pastsender) {
            $body.= "Monday: ".$monday."<br>
                    Tuesday: ".$tuesday."<br>
                    Wednesday: ".$wednesday."<br>
                    Thursday: ".$thursday."<br>
                    Friday: ".$friday."<br>
                    Saturday: ".$saturday."<br>
                    Sunday: ".$sunday."<br>Have a great week. "; 
            $sql = "INSERT INTO gdc353_1.EmailLog (facility, receiver, subject, body, date)
                    VALUES ('".$sender."', ".$receiver.", '".substr($subject,0,255)."', '".substr($body, 0, 80)."','".$currentsunday."')";
                    
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            echo "<br>Email sent to :".$firstName." ".$lastName."<br>
                Subject : ".$subject."<br>
                Body : ".$body."<br>"; 
        }
        if ($count == 0) {
            echo "<p> There are no employees scheduled for this upcoming week.";
        }
    }
    $conn->close(); 
}    
 
?>