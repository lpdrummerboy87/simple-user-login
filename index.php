<?php
// Redirect logged in users to the dashboard
if (isset($_SESSION['logged_in'])) {
    header('Location: dashboard.php');
    exit;
} else {
    // Redirect other users to the login page
    header('Location: login.php');
    exit;
}
