<?php
// Include the database connection file
include('db.php'); // Adjust the path if needed

// Database connection settings
$host = 'localhost'; // Database host
$username = 'root';  // Database username
$password = '';      // Database password
$dbname = 'job_applications'; // The name of the database

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data and sanitize input
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $location = trim($_POST['location']);
    $requirements = trim($_POST['requirements']);

    // Debug: Check if POST data is coming through
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    // Validate input (checking for empty fields)
    if (!empty($title) && !empty($description) && !empty($location)) {
        // Sanitize inputs to prevent SQL Injection
        $title = $conn->real_escape_string($title);
        $description = $conn->real_escape_string($description);
        $location = $conn->real_escape_string($location);
        $requirements = $conn->real_escape_string($requirements);

        // Prepare the SQL query with placeholders
        $sql = "INSERT INTO job_listings (title, description, location, requirements, created_at) 
                VALUES (?, ?, ?, ?, NOW())";

        // Debug: Check the SQL query
        echo "SQL Query: " . $sql . "<br>";

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameters
            if ($stmt->bind_param('ssss', $title, $description, $location, $requirements)) {
                // Execute the query
                if ($stmt->execute()) {
                    // Redirect back to admin.php after successful insertion
                    echo "<script>alert('Job listing created successfully!');</script>";
                    header("Location: admin.php"); // Redirect to admin.php
                    exit(); // Stop further script execution after redirection
                } else {
                    echo "<script>alert('Error executing query: " . $stmt->error . "');</script>";
                }
            } else {
                echo "<script>alert('Error binding parameters: " . $stmt->error . "');</script>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "<script>alert('Error preparing query: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all required fields.');</script>";
    }
}

// Close the database connection
$conn->close();
?>
