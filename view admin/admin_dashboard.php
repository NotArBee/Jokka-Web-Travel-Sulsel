<?php
include '../process/koneksi.php';
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$sql = "SELECT COUNT(*) AS jumlah_user FROM user where role = 'user'";
$result = $conn->query($sql);
$jumlahUser = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $jumlahUser = $row['jumlah_user'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Jokka Deh - Admin</title>
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet" />
    <!-- Icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <div class="container-fluid">
        <!-- Main content -->
        <main class="px-md-4 content_admin">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
                <button id="logoutButton" class="btn btn-danger" type="button">Logout</button>
            </div>
            <!-- Dashboard content -->
            <div class="row d-flex justify-content-center">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Users</div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $jumlahUser ?></h5>
                            <p class="card-text">Registered Users</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Orders</div>
                        <div class="card-body">
                            <h5 class="card-title">120</h5>
                            <p class="card-text">Total Orders</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- dashboard end -->
            <!-- form tambah paket start -->
            <div class="row d-flex flex-row">
                <div class="col-md-8 offset-md-2">
                    <div class="card mb-4">
                        <div class="card-header">Tambah Paket Wisata</div>
                        <div class="card-body">
                            <form action="../process/tambah_paket_admin.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto Wisata</label>
                                    <input type="file" class="form-control" id="foto" name="foto" required>
                                </div>
                                <div class="mb-3">
                                    <label for="namaWisata" class="form-label">Nama Wisata</label>
                                    <input type="text" class="form-control" id="namaWisata" name="namaWisata" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="harga" name="harga" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- form tambah paket end -->
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        document.getElementById('logoutButton').addEventListener('click', function() {
            window.location.href = '../process/logoutButton.php';
        });
    </script>
</body>

</html>