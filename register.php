<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Simpan password tanpa hash (tidak aman)

    // Query langsung tanpa validasi
    $sql = "INSERT INTO users (name, username, address, email, password) VALUES ('$name', '$username', '$address', '$email', '$password')";

    if ($conn->query($sql)) {
        header('Location: login.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Register</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="username" placeholder="Username" required>
        <textarea name="address" placeholder="Address" required></textarea>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
    <p><a href="login.php">Link to the login page</a></p>
</body>
</html>
