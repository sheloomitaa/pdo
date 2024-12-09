<?php
session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Koneksi ke database
include('config.php');

// Query untuk mengambil data penyewaan
$sql = "SELECT id_penyewaan, nama, telepon, tanggal_peminjaman, tanggal_pengembalian, 
               DATEDIFF(tanggal_pengembalian, tanggal_peminjaman) AS durasi
        FROM penyewaan";
$result = mysqli_query($conn, $sql);

// Menangani aksi edit dan hapus
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    // Hapus data
    $id = $_GET['id'];
    $delete_sql = "DELETE FROM penyewaan WHERE id_penyewaan = '$id'";
    mysqli_query($conn, $delete_sql);
    header("Location: penyewaan.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penyewaan</title>
    <style>
        /* Reset margin dan padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #8e5a3b;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #8e5a3b;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f7f7f7;
        }

        tr:hover {
            background-color: #f1e0d6;
        }

        .actions a {
            padding: 6px 12px;
            margin: 0 5px;
            background-color: #8e5a3b;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .actions a:hover {
            background-color: #6e3e2e;
        }

        .add-button {
            margin-bottom: 20px;
            text-align: center;
        }

        .add-button a {
            padding: 10px 20px;
            background-color: #8e5a3b;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .add-button a:hover {
            background-color: #6e3e2e;
        }

        .logout {
            margin-top: 20px;
            text-align: center;
        }

        .logout a {
            background-color: #8e5a3b;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .logout a:hover {
            background-color: #6e3e2e;
        }

        @media (max-width: 768px) {
            table, th, td {
                font-size: 14px;
                padding: 10px;
            }

            .container {
                width: 100%;
                margin: 20px;
            }

            .add-button a {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Selamat datang di PT. BendiCar, <?php echo $_SESSION['username']; ?></h2>

    <div class="add-button">
        <a href="tambah_penyewaan.php">Tambah Penyewaan</a>
    </div>

    <table>
        <tr>
            <th>ID Penyewaan</th>
            <th>Nama Penyewa</th>
            <th>Tanggal Sewa</th>
            <th>Durasi (Hari)</th>
            <th>Aksi</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id_penyewaan'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['tanggal_peminjaman'] . "</td>";
                echo "<td>" . $row['durasi'] . "</td>";
                echo "<td class='actions'>
                        <a href='edit_penyewaan.php?id=" . $row['id_penyewaan'] . "'>Edit</a>
                        <a href='penyewaan.php?action=delete&id=" . $row['id_penyewaan'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data penyewaan</td></tr>";
        }
        ?>
    </table>

    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>
</div>

</body>
</html>