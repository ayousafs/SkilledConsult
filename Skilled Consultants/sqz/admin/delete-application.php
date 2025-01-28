<?php
include('db.php');  // Include database connection

// Ensure application_id is provided in the GET request
if (isset($_GET['application_id']) && isset($_GET['job_id'])) {
    $application_id = $_GET['application_id'];
    $job_id = $_GET['job_id'];  // Retrieve job_id from the GET request

    // Prepare the query to delete the application for the specific application_id
    $stmt = $conn->prepare("DELETE FROM applications WHERE id = ?");
    $stmt->bind_param("i", $application_id);  // Bind the application_id as an integer

    // Execute the query
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
