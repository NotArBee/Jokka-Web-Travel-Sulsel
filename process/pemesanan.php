<?php
include 'koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_SESSION['id_user'];
    $nama_pemesanan = $_POST['nama_pemesanan'];
    $no_telp = $_POST['no_telp'];
    $id_paket_wisata = $_POST['id_paket_wisata'];
    $tanggal = $_POST['tanggal'];
    $total_harga = $_POST['total_harga'];

    $sql = "INSERT INTO pemesanan (id_user, nama_pemesanan, no_telp, id_paket_wisata, tanggal, total_harga) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issisi", $id_user, $nama_pemesanan, $no_telp, $id_paket_wisata, $tanggal, $total_harga);

    if ($stmt->execute()) {
        echo "<script>alert('Pemesanan berhasil!'); window.location.href='../index.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat memproses pemesanan.'); window.location.href='../index.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
