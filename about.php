<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About - ServiceFinder</title>
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
    <h2>About Us</h2>
    <img src="https://images.pexels.com/photos/3184418/pexels-photo-3184418.jpeg?cs=srgb&dl=pexels-fauxels-3184418.jpg&fm=jpg" alt="Our Team" style="width:100%; border-radius:10px; margin-bottom:20px;">
    <p>ServiceFinder is a modern platform connecting users with trusted service providers.</p>
    <p>Users can search, compare, and contact service providers easily. Admins can add their services, showcase their expertise, provide details, and highlight experience for users to discover and contact.</p>
    <p>Our mission is to make service discovery and offering fast, reliable, and transparent for everyone.</p>
    <img src="https://media.istockphoto.com/id/1199232638/vector/professional-office-cleaning-services-vector-concept-illustration.jpg?s=612x612&w=0&k=20&c=hSwHjPj5r4MdFcX3Dkns7Jabe6i_DqCrQa-K7dwMUaQ=" alt="Our Services" style="width:100%; border-radius:10px; margin-top:20px;">
</div>
</body>
</html>