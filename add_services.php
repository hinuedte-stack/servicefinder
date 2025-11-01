<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['account_type'] != 'admin') {
    header("Location: index.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_name = mysqli_real_escape_string($conn, $_POST['service_name']);
    $service_details = mysqli_real_escape_string($conn, $_POST['service_details']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $contact_info = mysqli_real_escape_string($conn, $_POST['contact_info']);

    $username = $_SESSION['user'];
    $username_escaped = mysqli_real_escape_string($conn, $username);
    $provider_sql = "SELECT id FROM service_users WHERE username = '$username_escaped'";
    $provider_result = mysqli_query($conn, $provider_sql);
    
    if(!$provider_result || mysqli_num_rows($provider_result) == 0){
        $error = "Admin account not found!";
    } else {
        $provider = mysqli_fetch_assoc($provider_result);
        $provider_id = $provider['id'];

        $sql = "INSERT INTO services (provider_id, service_name, service_details, category, experience, contact_info) 
                VALUES ('$provider_id', '$service_name', '$service_details', '$category', '$experience', '$contact_info')";
        
        if (mysqli_query($conn, $sql)) {
            $success = "Service added successfully!";
            // Clear form fields after successful submission
            $_POST = array();
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Service - ServiceFinder</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <div class="nav-container">
            <h1>ServiceFinder</h1>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8'); ?>)</a></li>
            </ul>
        </div>
    </nav>
</header>
<div class="container">
    <h2>Add Your Service</h2>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>
    <?php if ($success) echo "<p class='success'>$success</p>"; ?>
    <form method="post" action="add_services.php">
        <input type="text" name="service_name" placeholder="Service Name" value="<?php echo isset($_POST['service_name']) ? htmlspecialchars($_POST['service_name']) : ''; ?>" required>
        <textarea name="service_details" placeholder="Service Details" required><?php echo isset($_POST['service_details']) ? htmlspecialchars($_POST['service_details']) : ''; ?></textarea>
        <select name="category" required>
            <option value="">Select Category</option>
            <option value="Plumber" <?php echo (isset($_POST['category']) && $_POST['category'] == 'Plumber') ? 'selected' : ''; ?>>Plumber</option>
            <option value="Doctor" <?php echo (isset($_POST['category']) && $_POST['category'] == 'Doctor') ? 'selected' : ''; ?>>Doctor</option>
            <option value="Tutor" <?php echo (isset($_POST['category']) && $_POST['category'] == 'Tutor') ? 'selected' : ''; ?>>Tutor</option>
            <option value="Electrician" <?php echo (isset($_POST['category']) && $_POST['category'] == 'Electrician') ? 'selected' : ''; ?>>Electrician</option>
            <option value="Cleaning" <?php echo (isset($_POST['category']) && $_POST['category'] == 'Cleaning') ? 'selected' : ''; ?>>Cleaning</option>
            <option value="Other" <?php echo (isset($_POST['category']) && $_POST['category'] == 'Other') ? 'selected' : ''; ?>>Other</option>
        </select>
        <input type="text" name="experience" placeholder="Experience (e.g., 5 years)" value="<?php echo isset($_POST['experience']) ? htmlspecialchars($_POST['experience']) : ''; ?>" required>
        <input type="text" name="contact_info" placeholder="Contact Info (e.g., +880123456789)" value="<?php echo isset($_POST['contact_info']) ? htmlspecialchars($_POST['contact_info']) : ''; ?>" required>
        <button type="submit">Add Service</button>
    </form>
</div>
</body>
</html>