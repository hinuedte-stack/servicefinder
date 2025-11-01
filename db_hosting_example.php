<?php
// Database configuration for HOSTING (Example)
// Copy this to db.php and update with your hosting credentials

// 000webhost Example:
$servername = "localhost"; // Usually "localhost" for most hosting
$username = "id12345678"; // Your database username from hosting dashboard
$password = "your_secure_password"; // Your database password from hosting dashboard
$dbname = "id12345678_servicefinder"; // Your database name from hosting dashboard

// InfinityFree Example (might be different):
// $servername = "localhost";
// $username = "epiz_12345678";
// $password = "your_password";
// $dbname = "epiz_12345678_servicefinder";

// Enable error reporting (ONLY for debugging, OFF for production)
error_reporting(0); // Change to E_ALL for debugging
ini_set('display_errors', 0); // Change to 1 for debugging

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Don't show detailed error in production - security risk
    die("
    <div style='padding:20px; background:#fee; border:2px solid red; margin:20px; font-family:Arial;'>
        <h2 style='color:red;'>Database Connection Error!</h2>
        <p>Please contact the website administrator.</p>
        <p>Error code: DB_CONNECTION_FAILED</p>
    </div>
    ");
}

// Set charset to utf8
mysqli_set_charset($conn, "utf8");
?>

