<?php
    $servername = "gdc353.encs.concordia.ca";
    $username = "gdc353_1";
    $password = "j5B7K4g6";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
    die("<br>Connection failed: " . $conn->connect_error."<br>");
    }
    echo "<br>Database Connected successfully<br>";
    
?>