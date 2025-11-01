<?php
session_start();
include 'db.php';

if (isset($_POST['username'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM service_users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['username'];
            $_SESSION['account_type'] = $user['account_type'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Username not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - ServiceFinder</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: url('https://www.shutterstock.com/image-vector/modern-technology-abstract-creative-dynamin-260nw-2488701235.jpg') center/cover no-repeat;">

<header>
    <nav>
        <div class="nav-container">
            <h1>ServiceFinder</h1>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="signup.php">Signup</a></li>
            </ul>
        </div>
    </nav>
</header>

<div class="container">
    <h2>Login</h2>
    <p>Note: Log in as User to search services or Admin to add services.</p>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post" action="login.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <a href="signup.php">Don't have an account? Signup</a>
</div>

</body>
</html>