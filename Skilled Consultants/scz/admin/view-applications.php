<?php
include('db.php');  // Include database connection

// Ensure job_id is provided in the GET request
if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
} else {
    echo "Job ID is missing.";
    exit;
}

// Prepare the query to fetch applications for the specific job_id, ordered by id descending
$stmt = $conn->prepare("SELECT * FROM applications WHERE job_id = ? ORDER BY id DESC");
$stmt->bind_param("i", $job_id);  // Bind the job_id as an integer
$stmt->execute();
$result = $stmt->get_result();

// Check if there are any applications
if ($result->num_rows > 0) {
    // Applications exist, proceed to display them
} else {
    echo "No applications found for this job.";
     // Redirect back to admin.php after a brief moment
     header("Location: admin.php");
    exit;
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Applications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Applications for Job ID: <?php echo htmlspecialchars($job_id); ?></h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Primary Skills</th>
                    <th>Secondary Skills</th>
                    <th>Work Experience</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>CV</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$i}</td>
                            <td>" . htmlspecialchars($row['first_name']) . "</td>
                            <td>" . htmlspecialchars($row['last_name']) . "</td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td>" . htmlspecialchars($row['primary_skills']) . "</td>
                            <td>" . htmlspecialchars($row['secondary_skills']) . "</td>
                            <td>" . htmlspecialchars($row['work_experience']) . "</td>
                            <td>" . htmlspecialchars($row['city']) . "</td>
                            <td>" . htmlspecialchars($row['country']) . "</td>
                            <td>
                                <a href='view_cv.php?filename=" . htmlspecialchars($row['cv_filename']) . "' target='_blank'>View CV</a> |
                                <a href='download_cv.php?filename=" . htmlspecialchars($row['cv_filename']) . "' target='_blank'>Download CV</a>
                            </td>
                             <td>
                                <a href='delete-application.php?application_id=" . htmlspecialchars($row['id']) . "&job_id=" . $job_id . "' 
                                   onclick='return confirm(\"Are you sure you want to delete this application?\")' 
                                   class='btn btn-danger btn-sm'>Delete</a>
                            </td>
                          </tr>";
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
