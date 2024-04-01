<?php
session_start(); // Start the session

// Unset the username session variable
unset($_SESSION['username']);

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: clogin.php");
exit();
?>
