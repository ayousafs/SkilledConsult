<?php
// Include the database connection file
include('db.php'); // Adjust the path if needed

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Sanitize the 'id' to prevent SQL injection
    $id = $conn->real_escape_string($id);

    // Start a transaction to ensure both deletions are done atomically
    $conn->begin_transaction();

    try {
        // First, fetch all CV filenames associated with this job
        $selectCVs = "SELECT cv_filename FROM `applications` WHERE job_id = $id";
        $result = $conn->query($selectCVs);

        if ($result->num_rows > 0) {
            // Loop through each application and delete the corresponding CV file
            while ($row = $result->fetch_assoc()) {
                $cv_filename = $row['cv_filename'];
                $file_path = '../../assets/uploads' . $cv_filename; // Path to the file in the uploads folder

                // Delete the file from the server if it exists
                if (file_exists($file_path)) {
                    unlink($file_path); // Delete the file
                }
            }
        }

        // Then, delete all applications associated with this job
        $deleteApplications = "DELETE FROM `applications` WHERE job_id = $id";
        if ($conn->query($deleteApplications) !== TRUE) {
            throw new Exception("Error deleting applications: " . $conn->error);
        }

        // Then, delete the job listing
        $deleteJobListing = "DELETE FROM `job_listings` WHERE id = $id";
        if ($conn->query($deleteJobListing) !== TRUE) {
            throw new Exception("Error deleting job listing: " . $conn->error);
        }

        // Commit the transaction
        $conn->commit();

        // Success message
        echo "Job Listing and associated applications deleted successfully";

    } catch (Exception $e) {
        // Rollback the transaction if there was an error
        $conn->rollback();

        // Error message
        echo "Error: " . $e->getMessage();
    }

    // Redirect back to the job listings page
    header('Location: admin.php');
    exit;
} else {
    echo "Job ID is missing!";
    exit;
}

// Close the database connection
$conn->close();
?>
