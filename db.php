<?php
$servername = "fdb1023.awardspace.net";
$username = "2799963_livetv";
$password = "Sagarali@45206";
$dbname = "2799963_livetv";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
