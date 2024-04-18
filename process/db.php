<?php
    $servername = "localhost";
    $username = "root";
    $password = "Omi@2005";
    $database = "finalprojecct";

    $conn = new mysqli($servername, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>