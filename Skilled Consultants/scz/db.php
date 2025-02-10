<?php
$servername = "localhost";
$username = "root"; // Default username for local MySQL installation
$password = ""; // Default password for local MySQL installation is empty
$dbname = "job_applications";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . " Error Code: " . $conn->connect_errno);
} else {
    echo "Connected successfully!";
}
?>
