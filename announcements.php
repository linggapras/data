<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'includes/db.php';

// Ambil data pengumuman dari database
$sql = "SELECT * FROM announcements ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengumuman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            padding: 20px;
            text-align: center;
        }
        .container {
            margin: 0 auto;
            max-width: 600px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .announcement {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #007BFF;
        }
        .date {
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pengumuman</h1>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="announcement">
                    <p><?= htmlspecialchars($row['announcement']) ?></p>
                    <div class="date">Dibuat pada: <?= $row['created_at'] ?></div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Tidak ada pengumuman saat ini.</p>
        <?php endif; ?>
    </div>
</body>
</html>
