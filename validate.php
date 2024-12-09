<?php
session_start();
include('db_connect.php'); // Menghubungkan ke database

// Menangkap data yang dikirimkan dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk mengecek username dan password
$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

// Jika ditemukan pengguna yang sesuai
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['user'] = $user['username'];  // Menyimpan username ke session
    header("Location: dashboard.php");  // Arahkan ke dashboard
    exit();
} else {
    echo "Username atau password salah!";
}

$conn->close();
?>