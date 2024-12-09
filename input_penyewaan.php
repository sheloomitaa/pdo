<?php
// Memulai session
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header('Location: login.php'); // Jika tidak ada session user, arahkan ke login
    exit();
}

// Menghubungkan ke database
include('db_connect.php');

// Query untuk mengambil data penyewaan dari database
$sql = "SELECT * FROM penyewaan";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Pastikan kolom-kolom ada dalam tabel database
        echo $row['nama']; // Nama penyewa
        echo $row['tanggal_peminjaman']; // Tanggal sewa
        // Pastikan kolom yang ada benar
    }
} else {
    echo "Query Error: " . mysqli_error($conn);
}

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penyewaan - PT Bendicar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5; /* Warna Cream */
            color: #5D4037; /* Coklat tua */
            padding: 20px;
        }

        h1 {
            color: #5D4037;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #3E2723; /* Coklat tua */
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

    <h1>Data Penyewaan</h1>

    <div class="table-container">
        <?php
        if ($result->num_rows > 0) {
            // Membuat tabel untuk menampilkan data
            echo "<table>";
            echo "<tr>
                    <th>ID Penyewaan</th>
                    <th>Nama Penyewa</th>
                    <th>Telepon</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Identitas</th>
                    <th>Mobil</th>
                  </tr>";

            // Menampilkan data baris per baris
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id_penyewaan"] . "</td>
                        <td>" . $row["nama"] . "</td>
                        <td>" . $row["telepon"] . "</td>
                        <td>" . $row["tanggal_peminjaman"] . "</td>
                        <td>" . $row["tanggal_pengembalian"] . "</td>
                        <td>" . $row["identitas"] . "</td>
                        <td>" . $row["mobil"] . "</td>
                      </tr>";
            }

            echo "</table>";
        } else {
            echo "Tidak ada data penyewaan.";
        }
        ?>
    </div>

</body>
</html>