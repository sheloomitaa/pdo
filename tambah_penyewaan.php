<?php
session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Koneksi ke database
include('config.php');

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $tanggal_peminjaman = mysqli_real_escape_string($conn, $_POST['tanggal_peminjaman']);
    $tanggal_pengembalian = mysqli_real_escape_string($conn, $_POST['tanggal_pengembalian']);

    // Query untuk menambahkan data
    $insert_sql = "INSERT INTO penyewaan (nama, telepon, tanggal_peminjaman, tanggal_pengembalian) 
                   VALUES ('$nama', '$telepon', '$tanggal_peminjaman', '$tanggal_pengembalian')";

    if (mysqli_query($conn, $insert_sql)) {
        header("Location: penyewaan.php");
        exit();
    } else {
        echo "Error: " . $insert_sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Penyewaan</title>
    <style>
        /* Same styles from previous, slightly refined for form */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
        }
        .form-container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .form-container h2 {
            text-align: center;
            color: #8e5a3b;
        }
        .form-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-container input[type="submit"] {
            background-color: #8e5a3b;
            color: white;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #6e3e2e;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Tambah Data Penyewaan</h2>
    <form method="POST" action="">
        <input type="text" name="nama" placeholder="Nama Penyewa" required>
        <input type="text" name="telepon" placeholder="Telepon" required>
        <input type="date" name="tanggal_peminjaman" required>
        <input type="date" name="tanggal_pengembalian" required>
        <input type="submit" value="Tambah Penyewaan">
    </form>
</div>

</body>
</html>