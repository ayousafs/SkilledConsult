<?php



// Include the database connection file
include('db.php'); // Adjust the path if needed

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Sanitize the 'id' to prevent SQL injection
    $id = $conn->real_escape_string($id);

    // Fetch the job listing details from the database
    $sql = "SELECT * FROM `job_listings` WHERE id = $id";
    $result = $conn->query($sql);

    // If the job listing exists, fetch the data
    if ($result->num_rows > 0) {
        $job = $result->fetch_assoc();
    } else {
        echo "Job Listing not found!";
        exit;
    }

    // Handle form submission to update the job listing
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get form data
        $title = $_POST['title'];
        $description = $_POST['description'];
        $location = $_POST['location'];
        $requirements = $_POST['requirements'];

        // Validate input (you can add further validation)
        if (!empty($title) && !empty($description) && !empty($location)) {
            // Start a transaction to ensure atomicity
            $conn->begin_transaction();

            try {
                // Prepare the update query
                $updateJob = "UPDATE `job_listings` SET title = '$title', description = '$description', location = '$location', requirements = '$requirements' WHERE id = $id";

                if ($conn->query($updateJob) === TRUE) {
                    // Commit the transaction
                    $conn->commit();
                    echo "<script>alert('Job listing updated successfully!');</script>";
                } else {
                    throw new Exception("Error updating job listing: " . $conn->error);
                }
            } catch (Exception $e) {
                // Rollback the transaction if there's an error
                $conn->rollback();
                echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
            }

            // Redirect back to the job listings page
            header('Location: admin.php');
            exit;
        } else {
            echo "<script>alert('Please fill in all required fields.');</script>";
        }
    }

} else {
    echo "Job ID is missing!";
    exit;
}

// Close the database connection
$conn->close();
?>

<!-- HTML Form for Editing Job Listing -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Edit Job Listing - Admin</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
    <link rel="icon" type="image/png" href="images/favicon.png" />
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="plugins/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div class="body-inner">
        <!-- Job Edit Form Section -->
        <section id="edit-job">
            <div class="container">
                <h2>Edit Job Listing</h2>
                <form method="POST">
                    <table class="table table-bordered">
                        <tr>
                            <td><label for="title" class="form-label">Job Title</label></td>
                            <td><input type="text" name="title" class="form-control" id="title" value="<?php echo $job['title']; ?>" required /></td>
                        </tr>
                        <tr>
                            <td><label for="description" class="form-label">Job Description</label></td>
                            <td><textarea class="form-control" name="description" id="description" rows="5" required><?php echo $job['description']; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="location" class="form-label">Job Location</label></td>
                            <td><input type="text" name="location" class="form-control" id="location" value="<?php echo $job['location']; ?>" required /></td>
                        </tr>
                        <tr>
                            <td><label for="requirements" class="form-label">Job Requirements</label></td>
                            <td><textarea class="form-control" name="requirements" id="requirements" rows="5"><?php echo $job['requirements']; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="btn btn-dark">Update Job Listing</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </section>
    </div>

    <!-- JavaScript Files -->
    <script src="plugins/jQuery/jquery.min.js"></script>
    <script src="plugins/bootstrap/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
