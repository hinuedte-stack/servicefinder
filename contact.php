<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact - ServiceFinder</title>
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

<div class="container">
    <h2>Contact Us</h2>
    <img src="https://www.shutterstock.com/image-photo/contact-us-telephone-envelope-letter-260nw-2369194627.jpg" alt="Contact Office" style="width:100%; border-radius:10px; margin-bottom:20px;">
    <p>Email: support@servicefinder.com</p>
    <p>Phone: +880 1234-567890</p>
    <p>Address: 123, ServiceFinder Street, Dhaka, Bangladesh</p>
    <p>For any queries, suggestions or support, feel free to contact us anytime.</p>
    <img src="https://images.pexels.com/photos/3184418/pexels-photo-3184418.jpeg?cs=srgb&dl=pexels-fauxels-3184418.jpg&fm=jpg" alt="Team Collaboration" style="width:100%; border-radius:10px; margin-top:20px;">
</div>
</body>
</html>