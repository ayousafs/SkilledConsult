
<?php
session_start();

require_once('../assets/config.php'); // Path to the secure config file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == USERNAME && $password == PASSWORD) {
        $_SESSION['logged_in'] = true;
        header("Location: admin/admin.php");
        exit();
    } else {
        $error_message = "Incorrect username or password.";
    }
}
?>


    <!-- Login Form -->
    <form method="POST" action="" >
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

</body>

</html>
