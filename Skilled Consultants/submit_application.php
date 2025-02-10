<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Step 1: Get the job_id from the form (hidden input) and validate it
    if (isset($_POST['job_id']) && !empty($_POST['job_id'])) {
        $job_id = $_POST['job_id'];
    } else {
        echo "Invalid job ID.";
        exit();
    }

    // Capture the form data
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $primarySkills = $_POST['primary_skills'];
    $secondarySkills = $_POST['secondary_skills'];
    $workExperience = $_POST['work_experience'];
    $city = $_POST['city'];
    $country = $_POST['country'];

    // Handle the file upload (JPEG, PDF, DOCX only)
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] == 0) {
        $cvTmpName = $_FILES['cv']['tmp_name'];
        $cvFileName = basename($_FILES['cv']['name']);
        $fileExtension = pathinfo($cvFileName, PATHINFO_EXTENSION);

        // Validate file extension (allow jpg, jpeg, pdf)
        $allowedExtensions = ['jpg', 'jpeg', 'pdf'];
        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            echo "Invalid file type. Only JPEG, PDF files are allowed.";
            exit();
        }

        // Ensure it's a valid image if the file is JPEG
        if (in_array(strtolower($fileExtension), ['jpg', 'jpeg'])) {
            if (!getimagesize($cvTmpName)) {
                echo "The file is not a valid image.";
                exit();
            }
        }

        // Ensure it's a valid PDF file
        if (strtolower($fileExtension) == 'pdf') {
            $fileMimeType = mime_content_type($cvTmpName);
            if ($fileMimeType !== 'application/pdf') {
                echo "The file is not a valid PDF.";
                exit();
            }
        }

    
        // Define upload directory
        $uploadDir = 'assets/uploads';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);  // Create the directory if it doesn't exist
        }

        // Define the file path to move the uploaded file
        $cvFilePath = $uploadDir . $cvFileName;

        // Move the uploaded file to the 'uploads/' directory
        if (!move_uploaded_file($cvTmpName, $cvFilePath)) {
            echo "Error uploading CV.";
            exit();
        }

    } else {
        echo "No CV uploaded or there was an upload error.";
        exit();
    }

    // Get current timestamp for created_at
    $createdAt = date('Y-m-d H:i:s');

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'job_applications');  // Replace with your actual database credentials

    if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
        exit();
    } else {
        // Prepare and bind SQL statement to insert into the applications table
        $stmt = $conn->prepare("INSERT INTO applications (first_name, last_name, email, primary_skills, secondary_skills, work_experience, city, country, cv_filename, job_id, created_at) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            echo "Error preparing statement: " . $conn->error;
            exit();
        }

        // Bind the parameters
        $stmt->bind_param("sssssssssis", $firstName, $lastName, $email, $primarySkills, $secondarySkills, $workExperience, $city, $country, $cvFileName, $job_id, $createdAt);

        // Execute the query
        if ($stmt->execute()) {
            echo "Application successfully submitted!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>