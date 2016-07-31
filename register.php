<?php
// Connect to the database
require 'dbconnect.php';

// Process registration form submission
if (!empty($_POST)) {
    // Make sure the username and both password fields are not empty
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm-password'])) {
        // Save the posted login form fields into variables
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];

        // Array to hold any errors that might occur
        $errors = array();

        // Make sure the password field matches the confirm-password field
        if ($password === $confirm_password) {
            // Insert the new account into the database
            $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $params = array(
                ':username' => $username,
                ':password' => md5($password),
            );
            if ($stmt->execute($params)) {
                // New account was successfully created
                header('Location: login.php?account_created');
                exit;
            } else {
                // There was an error createing the account
                $errors[] = 'User registration failed.';
            }
        } else {
            // Password fields dont match
            $errors[] = 'Please make sure that your passwords match.';
        }
    } else {
        // One of the form fields were empty
        $errors[] = 'Please enter a username and password.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register a new account</h1>
    <form action="register.php" method="post">
        <label>Username:</label><input type="text" name="username"><br>
        <label>Password:</label><input type="password" name="password"><br>
        <label>Confirm Password:</label><input type="password" name="confirm-password"><br>
        <input type="submit" value="Register"> <a href="login.php">Back to login</a>
    </form>
    <p>
    <?php
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }
    ?>
    </p>
</body>
</html>
