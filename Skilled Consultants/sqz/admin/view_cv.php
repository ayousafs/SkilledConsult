<?php
// Check if the filename is provided via GET request
if (isset($_GET['filename'])) {
    $filename = $_GET['filename'];
    
    // Sanitize the filename to prevent directory traversal attacks
    $filepath = '../../assets/' . basename($filename);

    // Check if the file exists
    if (file_exists($filepath)) {
        // Get the file extension to determine the correct MIME type
        $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        // Set the appropriate content type based on file type
        switch ($file_extension) {
            case 'jpg':
            case 'jpeg':
                header('Content-Type: image/jpeg');
                break;
            case 'pdf':
                header('Content-Type: application/pdf');
                break;
            default:
                echo "Unsupported file type.";
                exit;
        }

        // Output the file content
        readfile($filepath);
        exit;
    } else {
        echo "File not found or invalid file.";
        exit;
    }
} else {
    echo "No filename provided.";
    exit;
}
?>
