<?php
// Database configuration for XAMPP
$servername = "localhost";
$username = "root";
$password = ""; // Empty for XAMPP default
$dbname = "servicefinder";

// Enable error reporting for debugging (comment out in production)
error_reporting(E_ALL);
ini_set('display_errors', 0); // Set to 1 for debugging, 0 for production

// Create connection with database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Try without database first to check if MySQL is running
    $test_conn = new mysqli($servername, $username, $password);
    
    if ($test_conn->connect_error) {
        // MySQL is not running
        die("
        <div style='padding:20px; background:#fee; border:2px solid red; margin:20px; font-family:Arial;'>
            <h2 style='color:red;'>MySQL Connection Error!</h2>
            <p><strong>Error:</strong> " . $test_conn->connect_error . "</p>
            <h3>Solution Steps:</h3>
            <ol>
                <li>Open XAMPP Control Panel</li>
                <li>Click 'Start' button for <strong>MySQL</strong></li>
                <li>Wait until it turns Green</li>
                <li>Refresh this page</li>
            </ol>
            <p><a href='test.php' style='color:blue; font-weight:bold;'>Click here to test your setup</a></p>
        </div>
        ");
    } else {
        // MySQL is running but database doesn't exist
        $test_conn->close();
        die("
        <div style='padding:20px; background:#ffe; border:2px solid orange; margin:20px; font-family:Arial;'>
            <h2 style='color:orange;'>Database Not Found!</h2>
            <p><strong>Database name:</strong> <code>$dbname</code></p>
            <h3>Solution Steps:</h3>
            <ol>
                <li>Open phpMyAdmin: <a href='http://localhost/phpmyadmin' target='_blank'>http://localhost/phpmyadmin</a></li>
                <li>Click on 'SQL' tab (at the top)</li>
                <li>Open <code>database_setup.sql</code> file from your project folder</li>
                <li>Copy ALL the content and paste in phpMyAdmin SQL box</li>
                <li>Click 'Go' button to execute</li>
                <li>Refresh this page</li>
            </ol>
            <p><a href='test.php' style='color:blue; font-weight:bold;'>Or test your setup here</a></p>
        </div>
        ");
    }
}

// Set charset to utf8
mysqli_set_charset($conn, "utf8");
?>