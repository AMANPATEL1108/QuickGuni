<<<<<<< HEAD
<?php
session_start();

// Define the base URL of your application
$home_url = "http://localhost/QuickGuni";

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the home page or login page
header('Location: ' . $home_url);
exit;
?>
=======
<?php
session_start();

// Define the base URL of your application
$home_url = "http://localhost/QuickGuni";

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the home page or login page
header('Location: ' . $home_url);
exit;
?>
>>>>>>> e5dca82098161009b1522064f6fa03d9caaf3ef0
