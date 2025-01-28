<?php
// Check if the filename is provided via GET request
if (isset($_GET['filename'])) {
    $filename = $_GET['filename'];
    
    // Sanitize the filename to prevent directory traversal attacks
    $filepath = '../../assets/' . basename($filename);

    // Check if the file exists
    if (file_exists($filepath)) {
        // Set headers to force download the file
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Content-Length: ' . filesize($filepath));

        // Output the file content
        readfile($filepath);
        exit;
    } else {
        echo "File not found.";
        exit;
    }
} else {
    echo "No filename provided.";
    exit;
}
?>
