<?php
include 'koneksi.php';

session_start();

// Periksa apakah user adalah admin
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

// Memeriksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $namaWisata = $_POST['namaWisata'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    // Mengambil data file foto
    $foto = $_FILES['foto'];
    $fotoName = $foto['name'];
    $fotoTmpName = $foto['tmp_name'];
    $fotoSize = $foto['size'];
    $fotoError = $foto['error'];
    $fotoType = $foto['type'];

    // Mengambil ekstensi file foto
    $fotoExt = explode('.', $fotoName);
    $fotoActualExt = strtolower(end($fotoExt));

    // Membatasi jenis file yang diperbolehkan
    $allowed = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($fotoActualExt, $allowed)) {
        if ($fotoError === 0) {
            if ($fotoSize < 5000000) { // Batas ukuran file 5MB
                $fotoNewName = uniqid('', true) . "." . $fotoActualExt;
                $fotoDestination = '../img/' . $fotoNewName;

                // Memindahkan file foto ke folder uploads
                if (move_uploaded_file($fotoTmpName, $fotoDestination)) {
                    // Menyimpan data ke database
                    $sql = "INSERT INTO paket_wisata (nama_wisata, foto, deskripsi, harga) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssi", $namaWisata, $fotoNewName, $deskripsi, $harga);

                    if ($stmt->execute()) {
                        echo "<script>alert('Paket wisata berhasil ditambahkan!'); window.location.href='../view admin/admin_dashboard.php';</script>";
                    } else {
                        echo "<script>alert('Terjadi kesalahan saat menambahkan paket wisata.'); window.location.href='../view admin/admin_dashboard.php';</script>";
                    }
                    $stmt->close();
                } else {
                    echo "<script>alert('Terjadi kesalahan saat mengunggah foto.'); window.location.href='../view admin/admin_dashboard.php';</script>";
                }
            } else {
                echo "<script>alert('Ukuran file foto terlalu besar. Maksimal 5MB.'); window.location.href='../view admin/admin_dashboard.php';</script>";
            }
        } else {
            echo "<script>alert('Terjadi kesalahan saat mengunggah foto.'); window.location.href='../view admin/admin_dashboard.php';</script>";
        }
    } else {
        echo "<script>alert('Jenis file foto tidak diperbolehkan. Hanya jpg, jpeg, png, dan gif.'); window.location.href='../view admin/admin_dashboard.php';</script>";
    }
}

$conn->close();