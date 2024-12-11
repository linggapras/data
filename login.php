<?php
include 'includes/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Celah: Query langsung tanpa sanitasi input (SQL Injection)
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if ($user) {
        // Set session dengan informasi pengguna
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Arahkan ke dashboard berdasarkan role
        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
        exit;
    } else {
        echo "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #87CEFA;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            max-width: 300px;
            margin: auto;
        }

        input, button {
            margin: 10px 0;
            padding: 10px;
            font-size: 16px;
        }

        button {
            background-color: #1E90FF;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #4682B4;
        }

        h2 {
            text-align: center;
            color: white; /* Menjadikan teks putih */
        }

        p {
            text-align: center;
            margin-top: 20px;
        }

        p a {
            color: #1E90FF;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Login</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <!-- Link ke halaman register -->
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>