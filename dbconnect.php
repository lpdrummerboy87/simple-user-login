<?php
// Start the session
session_start();

// Load the configuraion file
require 'configuration.php';

// Try to connect to the database
try {
    $db = new PDO('mysql:dbname=' . $dbname .';host=' . $dbhost, $dbuser, $dbpass);
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
