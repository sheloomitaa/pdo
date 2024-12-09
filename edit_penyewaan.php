<?php
session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Koneksi ke database
include('config.php');

// Mengambil id dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data penyewaan berdasarkan ID
    $sql = "SELECT * FROM penyewaan WHERE id_penyewaan = '$id'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
}

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $tanggal_peminjaman = mysqli_real_escape_string($conn, $_POST['tanggal_peminjaman']);
    $tanggal_pengembalian = mysqli_real_escape_string($conn, $_POST['tanggal_pengembalian']);

    // Query untuk memperbarui data
    $update_sql = "UPDATE penyewaan SET 
                   nama = '$nama', 
                   telepon = '$telepon',
                   tanggal_peminjaman = '$tanggal_peminjaman', 
                   tanggal_pengembalian = '$tanggal_pengembalian'
                   WHERE id_penyewaan = '$id'";

    if (mysqli_query($conn, $update_sql)) {
        header("Location: penyewaan.php");
        exit();
    } else {
        echo "Error: " . $update_sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Penyewaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .form-container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            color: #5f4037;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-container input[type="submit"] {
            background-color: #8b5e3c;
            color: white;
            border: none;
        }
        .form-container input[type="submit"]:hover {
            background-color: #6f4028;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Edit Data Penyewaan</h2>
    <form method="POST" action="">
        <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required>
        <input type="text" name="telepon" value="<?php echo $data['telepon']; ?>" required>
        <input type="date" name="tanggal_peminjaman" value="<?php echo $data['tanggal_peminjaman']; ?>" required>
        <input type="date" name="tanggal_pengembalian" value="<?php echo $data['tanggal_pengembalian']; ?>" required>
        <input type="submit" value="Update Data">
    </form>
</div>

</body>
</html>