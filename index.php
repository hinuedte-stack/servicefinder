<?php 
session_start(); 

// Try to include database connection
@include 'db.php';

// Check if connection exists, if not show error
if (!isset($conn) || !$conn) {
    die("
    <div style='padding:20px; background:#fee; border:2px solid red; margin:20px; font-family:Arial;'>
        <h2 style='color:red;'>Database Error!</h2>
        <p>Database connection failed. Please check:</p>
        <ol>
            <li>XAMPP MySQL is running</li>
            <li>Database 'servicefinder' exists</li>
            <li>Run database_setup.sql in phpMyAdmin</li>
        </ol>
        <p><a href='test.php' style='color:blue; font-weight:bold;'>Test Your Setup Here</a></p>
    </div>
    ");
}

// Fetch all services for homepage
$services_sql = "SELECT s.*, u.username FROM services s 
                 JOIN service_users u ON s.provider_id = u.id 
                 ORDER BY s.id DESC";
$services_result = mysqli_query($conn, $services_sql);

// Handle query errors gracefully
if (!$services_result) {
    // If tables don't exist yet, show friendly message
    $services_result = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ServiceFinder</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <nav>
        <div class="nav-container">
            <h1>ServiceFinder</h1>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php if(isset($_SESSION['user'])): ?>
                    <?php if($_SESSION['account_type'] == 'admin'): ?>
                        <li><a href="add_services.php">Add Service</a></li>
                    <?php else: ?>
                        <li><a href="search.php">Search Services</a></li>
                    <?php endif; ?>
                    <li><a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8'); ?>)</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Signup</a></li>
                    <li><a href="search.php">Search Services</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>

<section class="hero" style="background: url('https://media.istockphoto.com/id/1333890718/vector/professional-electricians-at-work.jpg?s=612x612&w=0&k=20&c=-B-WUedY2rbsOOJsXAEwjWG3-TFR0XfCUeL6csgsQOQ=') center/cover no-repeat;">
    <div class="hero-text">
        <h2>Find & Offer Services Easily 🛠️</h2>
        <p>Users can search for trusted services (Plumber, Doctor, Tutor, etc.), and Admins can add their services for users to discover!</p>
        <?php if(!isset($_SESSION['user'])): ?>
            <a href="signup.php" class="btn">Get Started</a>
        <?php endif; ?>
    </div>
</section>

<!-- Available Services from Database -->
<section class="featured">
    <div class="container">
        <h3>Available Services</h3>
        <?php if($services_result && mysqli_num_rows($services_result) > 0): ?>
            <div class="services-list">
                <?php while($service = mysqli_fetch_assoc($services_result)): ?>
                    <div class="service-card">
                        <h3><?php echo htmlspecialchars($service['service_name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="category-badge"><?php echo htmlspecialchars($service['category'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p><?php echo htmlspecialchars(substr($service['service_details'], 0, 100), ENT_QUOTES, 'UTF-8'); ?>...</p>
                        <p><strong>Experience:</strong> <?php echo htmlspecialchars($service['experience'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p><strong>Provider:</strong> <?php echo htmlspecialchars($service['username'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <div class="contact-section">
                            <p><strong>Contact:</strong> 
                                <a href="tel:<?php echo htmlspecialchars($service['contact_info'], ENT_QUOTES, 'UTF-8'); ?>" class="contact-btn">
                                    📞 <?php echo htmlspecialchars($service['contact_info'], ENT_QUOTES, 'UTF-8'); ?>
                                </a>
                            </p>
                            <a href="search.php?q=<?php echo urlencode($service['service_name']); ?>" class="view-details-btn">View Details</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p style="text-align: center; padding: 40px; color: #666;">No services available yet. Be the first to add a service!</p>
        <?php endif; ?>
    </div>
</section>

<footer>
    <p>&copy; <?php echo date('Y'); ?> ServiceFinder. All rights reserved.</p>
</footer>

</body>
</html>