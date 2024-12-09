<?php
// Koneksi ke database (jika ingin memisahkan logika koneksi)
$conn = mysqli_connect("localhost", "root", "", "pt_bendicar");

// Mengecek apakah koneksi berhasil
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>