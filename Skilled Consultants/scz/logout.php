<?php
session_start(); // Start the session
session_unset();  // Remove all session variables
session_destroy(); // Destroy the session
echo "Logged out successfully.";  // Print the logout message

// Redirect to the login page after a short delay
header("Refresh: 2; url=login.php");  // Redirect after 2 seconds
exit();
?>
