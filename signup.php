<?php
include 'db.php';

if(isset($_POST['username'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $account_type = mysqli_real_escape_string($conn, $_POST['account_type']); // user or admin
    
    // Validate account type
    if($account_type != 'user' && $account_type != 'admin'){
        $error = "Invalid account type!";
    } else {
        $sql = "INSERT INTO service_users (username, password, account_type) 
                VALUES ('$username', '$password', '$account_type')";
        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Signup successful as $account_type!'); window.location='login.php';</script>";
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signup - ServiceFinder</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <div class="nav-container">
            <h1>ServiceFinder</h1>
            <ul>
                <li><a href="login.php">Login</a></li>
            </ul>
        </div>
    </nav>
</header>

<div class="container">
    <h2>Signup</h2>
    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post" action="signup.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        
        <!-- Account Type Dropdown -->
        <select name="account_type" required>
            <option value="">Select Account Type</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit">Signup</button>
    </form>
    <a href="login.php">Already have an account? Login</a>
</div>
</body>
</html>
