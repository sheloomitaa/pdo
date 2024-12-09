<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php'); // Jika tidak ada session user, arahkan ke login
    exit();
}

include('db_connect.php'); // Menghubungkan ke database

// Ambil informasi pengguna dari database berdasarkan username
$username = $_SESSION['user']; // Ambil username dari session
$sql_user = "SELECT * FROM users WHERE username = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("s", $username);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();  // Ambil data pengguna

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PT Bendicar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5; /* Warna Cream */
            color: #5D4037; /* Coklat tua */
            padding: 20px;
        }

        .dashboard-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 20px auto;
        }

        h1 {
            font-size: 24px;
            color: #5D4037; /* Coklat tua */
        }

        .menu {
            background-color: #8D6E63; /* Coklat muda */
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .menu a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
        }

        .menu a:hover {
            text-decoration: underline;
        }

        .user-info {
            font-size: 18px;
            margin: 20px 0;
        }

        .btn-logout {
            background-color: #5D4037; /* Coklat tua */
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-logout:hover {
            background-color: #3E2723; /* Coklat lebih tua */
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Selamat Datang, <?php echo htmlspecialchars($user['username']); ?>!</h1>

        <!-- Menu Navigasi -->
        <div class="menu">
            <a href="penyewaan.php">Penyewaan</a>
            <a href="logout.php" class="btn-logout">Logout</a>
        </div>

        <div class="user-info">
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        </div>
    </div>
</body>
</html>