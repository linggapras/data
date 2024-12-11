<?php
session_start();

// Jika pengguna sudah login, langsung arahkan ke dashboard
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Welcome</title>
</head>
<body>
    <h2>Welcome to Our Web Application</h2>
    <p>Please select an option to proceed:</p>
    <div class="buttons">
        <a href="login.php" class="button">Login</a>
        <a href="register.php" class="button">Register</a>
    </div>
</body>
</html>