<?php
// Start the session and connect to the database
require 'dbconnect.php';

// Redirect users to the login page if not logged in
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Hello, <?php echo $_SESSION['username']; ?>! Welcome to the dashboard!</h1>
    <a href="logout.php">Log out</a>
</body>
</html>
