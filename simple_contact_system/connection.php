

<?php
// db_connect.php
// Database connection file

$host = "localhost";   // server name
$user = "Ahmed";        // database username
$pass = "123";            // database password
$db   = "simple_contact_db"; // database name

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());

    
}
?>
