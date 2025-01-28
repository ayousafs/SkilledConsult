<?php
session_start(); // Start the session to track login status

// Check if the user is logged in, if not, redirect to login.php
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../../login.php");
    exit(); // Ensure no further code is executed after the redirect
}

// Handle logout (destroy the session)
if (isset($_GET['logout'])) {
    session_destroy(); // Destroy the session
    header("Location: ../login.php"); // Redirect to login page
    exit(); // Ensure no further code is executed after the redirect
}

// Include database connection
include('db.php');

// Query to fetch job listings from the database ordered by id in descending order
$sql = "SELECT * FROM job_listings ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

// Handle form submission for deleting selected jobs
if (isset($_POST['delete_jobs'])) {
    // Collect the selected job ids from the form
    if (!empty($_POST['selected_jobs'])) {
        $selected_jobs = $_POST['selected_jobs'];
        
        // Start a transaction to ensure the deletions are done atomically
        $conn->begin_transaction();

        try {
            // Delete all applications associated with the selected jobs
            $ids = implode(",", array_map('intval', $selected_jobs)); // Sanitize the ids
            $deleteApplications = "DELETE FROM `applications` WHERE job_id IN ($ids)";
            if ($conn->query($deleteApplications) !== TRUE) {
                throw new Exception("Error deleting applications: " . $conn->error);
            }

            // Delete the selected job listings
            $deleteJobListing = "DELETE FROM `job_listings` WHERE id IN ($ids)";
            if ($conn->query($deleteJobListing) !== TRUE) {
                throw new Exception("Error deleting job listings: " . $conn->error);
            }

            // Commit the transaction
            $conn->commit();
            echo "Selected job listings and their associated applications were deleted successfully.";
        } catch (Exception $e) {
            // Rollback the transaction if there was an error
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "No jobs selected!";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <title>Admin - Job Listings</title>
    <style>
        p {
            max-width: 20ch;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Position the logout button in the top-right corner */
        .logout-btn {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>

    <!-- Logout Button -->
    <a href="?logout=true" class="logout-btn">Logout</a>

    <div class="container">
        <h3>Add New Job</h3>
        <form method="POST" action="create-job.php">
            <div class="mb-3">
                <label for="title" class="form-label">Job Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Job Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Job Location</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <div class="mb-3">
                <label for="requirements" class="form-label">Job Requirements</label>
                <textarea class="form-control" id="requirements" name="requirements" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Job</button>
        </form>
    </div>

    <div class="container mt-5">
        <h3>Job Listings</h3>

        <!-- Form to delete selected jobs -->
        <form method="POST" action="admin.php">
            <button type="submit" name="delete_jobs" class="btn btn-danger mb-3">Delete Selected Jobs</button>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Sr.</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Created at</th>
                        <th>Requirements</th>
                        <th>View Applications</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($result) > 0) {
                        $sn = 1;
                        while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><input type="checkbox" name="selected_jobs[]" value="<?php echo $data['id']; ?>"></td>
                        <td><?php echo $sn;?></td>
                        <td><?php echo $data['title']; ?></td>
                        <td>
                            <p><?php echo $data['description']; ?></p>
                            <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="popover" 
                             data-bs-content="<?php echo $data['description']; ?>">View More</button>
                        </td>
                        <td><?php echo $data['location']; ?></td>
                        <td><?php echo $data['created_at']; ?></td>
                        <td>
                            <p><?php echo $data['requirements']; ?></p>
                            <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="popover" 
                             data-bs-content="<?php echo $data['requirements']; ?>">View More</button>          
                        </td>
                        <td><a href="view-applications.php?job_id=<?php echo $data['id']; ?>" class="btn btn-info rounded-pill btn-sm">View</a></td> 
                        <td><a href="edit-job.php?id=<?php echo $data['id']; ?>" class="btn btn-warning rounded-pill btn-sm">Edit</a></td>
                        <td><a href="delete-job.php?id=<?php echo $data['id']; ?>" class="btn btn-danger rounded-pill btn-sm">Delete</a></td>
                    </tr>
                    <?php
                        $sn++;
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="10" class="text-center">No Job Listings Found...</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>
    </div>

    <script>
        // Select all checkboxes when clicking on the header checkbox
        document.getElementById('select-all').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('input[name="selected_jobs[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
    </script>

</body>
</html>
