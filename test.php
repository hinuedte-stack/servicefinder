<?php
// Test file to check if PHP and XAMPP are working
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>PHP Test - ServiceFinder</h1>";
echo "<p>✅ PHP is working!</p>";
echo "<p>PHP Version: " . phpversion() . "</p>";

// Test database connection
echo "<h2>Database Connection Test:</h2>";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "servicefinder";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    echo "<p style='color:red;'>❌ MySQL Connection Failed: " . $conn->connect_error . "</p>";
    echo "<p><strong>Solution:</strong> Make sure XAMPP MySQL is running!</p>";
} else {
    echo "<p style='color:green;'>✅ MySQL Connection Successful!</p>";
    
    // Check if database exists
    $db_check = mysqli_select_db($conn, $dbname);
    if ($db_check) {
        echo "<p style='color:green;'>✅ Database 'servicefinder' exists!</p>";
        
        // Check tables
        $tables = ['service_users', 'services'];
        foreach ($tables as $table) {
            $result = $conn->query("SHOW TABLES LIKE '$table'");
            if ($result && $result->num_rows > 0) {
                echo "<p style='color:green;'>✅ Table '$table' exists!</p>";
            } else {
                echo "<p style='color:orange;'>⚠️ Table '$table' NOT found!</p>";
                echo "<p>Run database_setup.sql in phpMyAdmin</p>";
            }
        }
    } else {
        echo "<p style='color:red;'>❌ Database 'servicefinder' NOT found!</p>";
        echo "<p><strong>Solution:</strong> Create database using database_setup.sql in phpMyAdmin</p>";
    }
}

$conn->close();

// Test session
echo "<h2>Session Test:</h2>";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
echo "<p style='color:green;'>✅ Session working!</p>";

// File permissions
echo "<h2>File Check:</h2>";
$files = ['index.php', 'db.php', 'login.php', 'signup.php', 'add_services.php'];
foreach ($files as $file) {
    if (file_exists($file)) {
        echo "<p style='color:green;'>✅ $file exists</p>";
    } else {
        echo "<p style='color:red;'>❌ $file NOT found!</p>";
    }
}

echo "<hr>";
echo "<p><a href='index.php'>Go to Homepage</a></p>";
echo "<p><a href='database_setup.sql'>View Database Setup File</a></p>";
?>

