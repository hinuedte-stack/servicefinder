<?php
session_start();
include 'db.php';

$q = "";
$category_filter = "";
$query = "";
$params = [];
$types = "";

if(isset($_GET['q'])){
    $q = $_GET['q'];
    $query .= "WHERE (service_name LIKE ? OR service_details LIKE ?)";
    $like = "%$q%";
    $params[] = $like;
    $params[] = $like;
    $types .= "ss";
}

if(isset($_GET['category']) && $_GET['category'] != ""){
    $category_filter = $_GET['category'];
    $query .= ($query ? " AND " : "WHERE ") . "category = ?";
    $params[] = $category_filter;
    $types .= "s";
}

$sql = "SELECT s.*, u.username FROM services s 
        JOIN service_users u ON s.provider_id = u.id $query";
$stmt = $conn->prepare($sql);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Search Services</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: url('https://www.shutterstock.com/image-photo/contact-us-telephone-envelope-letter-260nw-2369194627.jpg') center/cover no-repeat;">
<header>
    <nav>
        <div class="nav-container">
            <h1>ServiceFinder</h1>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="search.php">Search Services</a></li>
                <?php if(isset($_SESSION['user'])): ?>
                    <?php if($_SESSION['account_type'] == 'admin'): ?>
                        <li><a href="add_services.php">Add Service</a></li>
                    <?php endif; ?>
                    <li><a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8'); ?>)</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Signup</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>

<div class="container">
    <h2>Search for Services</h2>
    <form method="get" action="search.php">
        <input type="text" name="q" placeholder="Search services..." value="<?php echo htmlspecialchars($q, ENT_QUOTES, 'UTF-8'); ?>">
        <select name="category">
            <option value="">All Categories</option>
            <option value="Plumber" <?php if($category_filter == 'Plumber') echo 'selected'; ?>>Plumber</option>
            <option value="Doctor" <?php if($category_filter == 'Doctor') echo 'selected'; ?>>Doctor</option>
            <option value="Tutor" <?php if($category_filter == 'Tutor') echo 'selected'; ?>>Tutor</option>
            <option value="Electrician" <?php if($category_filter == 'Electrician') echo 'selected'; ?>>Electrician</option>
            <option value="Cleaning" <?php if($category_filter == 'Cleaning') echo 'selected'; ?>>Cleaning</option>
            <option value="Other" <?php if($category_filter == 'Other') echo 'selected'; ?>>Other</option>
        </select>
        <button type="submit">Search</button>
    </form>

    <div class="services-list">
        <?php if($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="service-card">
                    <?php if(isset($row['service_image']) && $row['service_image']): ?>
                        <img src="uploads/<?php echo htmlspecialchars($row['service_image'], ENT_QUOTES, 'UTF-8'); ?>" alt="service">
                    <?php endif; ?>
                    <h3><?php echo htmlspecialchars($row['service_name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p class="category-badge"><?php echo htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p><?php echo htmlspecialchars($row['service_details'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p><strong>Experience:</strong> <?php echo htmlspecialchars($row['experience'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p><strong>Provider:</strong> <?php echo htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <div class="contact-section">
                        <p><strong>Contact:</strong> 
                            <a href="tel:<?php echo htmlspecialchars($row['contact_info'], ENT_QUOTES, 'UTF-8'); ?>" class="contact-btn">
                                📞 <?php echo htmlspecialchars($row['contact_info'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align: center; padding: 40px; color: #666; font-size: 18px;">
                No services found. <?php if(!empty($q) || !empty($category_filter)): ?>Try a different search term or category.<?php else: ?>Be the first to add a service!<?php endif; ?>
            </p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>