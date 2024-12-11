<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit;
}

include 'includes/db.php';
$username = $_SESSION['username'];

// Celah: Tidak melakukan validasi atau sanitasi input
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Menangani laporan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['report'])) {
    $report_message = $_POST['report_message'];  // Celah SQL Injection
    $sql_report = "INSERT INTO reports (username, report_message, created_at) VALUES ('$username', '$report_message', NOW())";
    $conn->query($sql_report);
    echo "<script>alert('Report submitted successfully!');</script>";
}

// Menangani pengiriman pesan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
    $receiver = mysqli_real_escape_string($conn, $_POST['receiver']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    // Menyimpan pesan ke dalam database
    $sql_insert_message = "INSERT INTO messages (sender, receiver, message, created_at) VALUES ('$username', '$receiver', '$message', NOW())";
    
    if ($conn->query($sql_insert_message) === TRUE) {
        echo "<script>alert('Message sent successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Menampilkan pesan
$sql_messages = "SELECT * FROM messages WHERE sender = '$username' OR receiver = '$username' ORDER BY created_at DESC";
$messages_result = $conn->query($sql_messages);
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            margin: 0;
            padding: 0;
        }

        .profile-card {
            width: 80%;
            max-width: 400px;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            margin: 20px auto;
        }

        .chat-container {
            width: 80%;
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            height: 400px;
            display: flex;
            flex-direction: column;
        }

        .messages {
            flex-grow: 1;
            overflow-y: auto;
            margin-bottom: 10px;
        }

        .message {
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f0f0f0;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .sender {
            font-weight: bold;
        }

        .report-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #ff3b3b;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .report-button:hover {
            background-color: #d32f2f;
        }

        .report-form {
            display: none;
            position: fixed;
            top: 30%;
            right: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .report-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .report-form button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .report-form button:hover {
            background-color: #0056b3;
        }

        /* Form Styling */
        .message-form input, .message-form textarea {
            width: 100%; /* Membuat lebar input dan textarea 100% */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .message-form button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .message-form button:hover {
            background-color: #0056b3;
        }

    </style>
    <script>
        function toggleReportForm() {
            const reportForm = document.querySelector('.report-form');
            reportForm.style.display = reportForm.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</head>
<body>
    <!-- Profil Pengguna -->
    <div class="profile-card">
        <h3>Welcome, <?= $user['name'] ?></h3>
        <p><strong>Name:</strong> <?= $user['name'] ?></p>
        <p><strong>Address:</strong> <?= $user['address'] ?></p>
        <p><strong>Email:</strong> <?= $user['email'] ?></p>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Fitur Chat -->
    <div class="chat-container">
        <h3>Chat</h3>
        <div class="messages">
            <?php while ($message = $messages_result->fetch_assoc()) : ?>
                <div class="message">
                    <p class="sender"><?= $message['sender'] ?>:</p>
                    <p><?= $message['message'] ?></p>
                </div>
            <?php endwhile; ?>
        </div>
        <form class="message-form" method="POST">
            <input type="text" name="receiver" placeholder="Recipient Username" required />
            <textarea name="message" placeholder="Write your message..." required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>

    <!-- Tombol Report -->
    <button class="report-button" onclick="toggleReportForm()">Report</button>

    <!-- Form Report -->
    <div class="report-form">
        <h3>Submit a Report</h3>
        <form method="POST">
            <textarea name="report_message" placeholder="Describe the issue..." required></textarea>
            <button type="submit" name="report">Submit</button>
        </form>
    </div>
</body>
</html>