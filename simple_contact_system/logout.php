<?php
// logout.php
session_start();

// Destroy all session variables
session_unset();
session_destroy();

// Destroy cookies if set
if (isset($_COOKIE['username'])) {
    setcookie("username", "", time() - 3600, "/"); // expire cookie
}

// Redirect to login page
header("Location: login.php");
exit();
?>