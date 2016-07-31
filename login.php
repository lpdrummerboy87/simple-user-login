<?php
// Connect to the database
require 'dbconnect.php';

// Process login form submission
if (!empty($_POST)) {
    // Make sure the username and password fields were not empty
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        // Save the posted login form fields into variables
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // Array to hold any errors that might occur
        $errors = array();

        // Try to find a matching username and password in the database
        $stmt = $db->prepare("SELECT id, username, password FROM users WHERE username = :username AND password = :password LIMIT 1");
        $stmt->execute(array(
            ':username' => $username,
            ':password' => $password,
        ));
        if ($stmt->rowCount() === 1) {
            // We found a match so log the user in
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit;
        } else {
            // There was no match so it was an invalid login
            $errors[] = 'Invalid login details.';
        }
    } else {
        // One of the login form fields were empty
        $errors[] = 'Please enter a username and password.';
    }
}

// Catch any variables passed in the URL
if (!empty($_GET)) {
    // Message for successfully creating a new account
    if (isset($_GET['account_created'])) {
        $messages[] = 'New account successfully created.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Log in to your account</h1>
    <form action="login.php" method="post">
        <label>Username:</label><input type="text" name="username"><br>
        <label>Password:</label><input type="password" name="password"><br>
        <input type="submit" value="Log in"> <a href="register.php">Register</a>
    </form>
    <p>
    <?php
    // Display any errors on the page
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }

    // Display any messages on the page
    if (!empty($messages)) {
        foreach ($messages as $message) {
            echo $message . '<br>';
        }
    }
    ?>
    </p>
</body>
</html>
