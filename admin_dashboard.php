<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

include 'includes/db.php';

// Query untuk mendapatkan daftar pengguna
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Query untuk mendapatkan laporan dari pengguna
$sql_reports = "SELECT * FROM reports";
$reports_result = $conn->query($sql_reports);

// Query untuk mendapatkan daftar pengumuman
$sql_announcements = "SELECT * FROM announcements ORDER BY created_at DESC";
$announcements_result = $conn->query($sql_announcements);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa; /* Biru langit */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #007BFF;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #f9f9f9;
        }

        form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        form button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            width: 200px;
            margin: 0 auto;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>

        <!-- Tabel Daftar Pengguna -->
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Address</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
            <?php while ($user = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['address'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['role'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <!-- Tabel Laporan Pengguna -->
        <table class="reports-table">
            <tr>
                <th>Report ID</th>
                <th>Username</th>
                <th>Report Message</th>
                <th>Report Date</th>
            </tr>
            <?php while ($report = $reports_result->fetch_assoc()): ?>
                <tr>
                    <td><?= $report['id'] ?></td>
                    <td><?= $report['username'] ?></td>
                    <td><?= $report['report_message'] ?></td>
                    <td><?= $report['created_at'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <!-- Form untuk Membuat Pengumuman -->
        <h3>Buat Pengumuman</h3>
        <form action="create_announcement.php" method="post">
            <textarea name="announcement" rows="4" placeholder="Tulis pengumuman baru di sini..."></textarea>
            <button type="submit">Simpan Pengumuman</button>
        </form>

        <!-- Tabel Daftar Pengumuman -->
        <h3>Daftar Pengumuman</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Pengumuman</th>
                <th>Tanggal Dibuat</th>
            </tr>
            <?php while ($announcement = $announcements_result->fetch_assoc()): ?>
                <tr>
                    <td><?= $announcement['id'] ?></td>
                    <td><?= htmlspecialchars($announcement['announcement']) ?></td>
                    <td><?= $announcement['created_at'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
