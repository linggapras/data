<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

include 'includes/db.php';

// Proses penyimpanan pengumuman
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $announcement = trim($_POST['announcement']);

    if (!empty($announcement)) {
        $stmt = $conn->prepare("INSERT INTO announcements (announcement) VALUES (?)");
        $stmt->bind_param("s", $announcement);

        if ($stmt->execute()) {
            $message = "Pengumuman berhasil disimpan.";
        } else {
            $message = "Gagal menyimpan pengumuman.";
        }
        $stmt->close();
    } else {
        $message = "Pengumuman tidak boleh kosong.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buat Pengumuman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            padding: 20px;
            text-align: center;
        }
        .container {
            margin: 0 auto;
            max-width: 500px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        p {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Buat Pengumuman</h1>
        <?php if (isset($message)) echo "<p>$message</p>"; ?>
        <form action="" method="post">
            <textarea name="announcement" placeholder="Tulis pengumuman di sini..."></textarea>
            <br>
            <button type="submit">Simpan Pengumuman</button>
        </form>
        <a href="admin_dashboard.php">Kembali ke Dashboard</a>
    </div>
</body>
</html>
