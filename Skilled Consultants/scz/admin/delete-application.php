<?php
include('db.php');  // Include database connection

// Ensure application_id and job_id are provided in the GET request
if (isset($_GET['application_id']) && isset($_GET['job_id'])) {
    $application_id = $_GET['application_id'];
    $job_id = $_GET['job_id'];  // Retrieve job_id from the GET request

    // Step 1: Fetch the filename (cv_filename) from the database
    $stmt = $conn->prepare("SELECT cv_filename FROM applications WHERE id = ?");
    $stmt->bind_param("i", $application_id);  // Bind the application_id as an integer
    $stmt->execute();
    $stmt->bind_result($cv_filename);  // Store the filename in a variable
    $stmt->fetch();
    $stmt->close();  // Close the statement after fetching the data

    // Check if the filename exists
    if ($cv_filename) {
        // Step 2: Delete the file from the server (uploads folder)
        $file_path = '../../assets/uploads' . $cv_filename;  // Path to the file
        if (file_exists($file_path)) {
            unlink($file_path);  // Delete the file
        } else {
            echo "File not found on server.";
        }
    }

    // Step 3: Delete the application record from the database
    $stmt = $conn->prepare("DELETE FROM applications WHERE id = ?");
    $stmt->bind_param("i", $application_id);  // Bind the application_id as an integer

    // Execute the query to delete the application
    if ($stmt->execute()) {
        // Redirect back to view-applications.php with the same job_id
        header("Location: view-applications.php?job_id=" . $job_id);
        exit;
    } else {
        echo "Error deleting application: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Application ID or Job ID is missing.";
}

$conn->close();
?>
