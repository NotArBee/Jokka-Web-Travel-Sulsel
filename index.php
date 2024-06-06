<?php
include 'process/koneksi.php';

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Jokka Deh - Home</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

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
  <div class="content">
    <!-- Navbar start -->
    <div class="container-fluid position-relative p-0 main">
      <nav class="navbar navbar-expand-lg navbar-light bg-white p-3 fixed-top border-bottom">
        <a href="index.html" class="navbar-brand p-0">
          <img class="img_logo" src="img/logoweb.png" alt="Logo Jokka Deh" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
          <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <div class="navbar-nav mx-auto py-0">
            <a href="index.php" class="nav-item nav-link">
              <h5>Home</h5>
            </a>
            <a href="about.php" class="nav-item nav-link">
              <h5>About</h5>
            </a>
          </div>
          <?php
          if (isset($_SESSION['login']) || $_SESSION['role'] === 'user') {
            echo '<a href="process/logoutButton.php" class="btn btn-danger rounded-pill text-white py-2 px-4 flex-wrap flex-sm-shrink-0">LOGOUT</a>';
          } else {
            echo '<a href="#" class="btn btn-primary rounded-pill text-white py-2 px-4 flex-wrap flex-sm-shrink-0" data-bs-toggle="modal" data-bs-target="#loginModal">LOGIN</a>';
          }
          ?>
        </div>
      </nav>

      <!-- Carousel Start -->
      <div id="carouselExampleSlidesOnly" class="carousel slide mt-5" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/apparalang.jpg" class="d-block w-50 mx-auto" alt="Apparalang" />
            <div class="carousel-caption d-none d-md-block bg-black w-50 mx-auto">
              <h5>Pantai Apparalang</h5>
              <p>
                Apparalang Cliff, Bulukumba, South Sulawesi
              </p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="img/fort rotterdam.jpg" class="d-block w-50 mx-auto" alt="Fort Rotterdam" />
            <div class="carousel-caption d-none d-md-block bg-black w-50 mx-auto">
              <h5>Fort Rotterdam</h5>
              <p>
                Makassar mungkin tidak seperti Bali maupun Lombok, tapi tetap saja ada banyak tempat wisata di Makassar
                yang dapat Anda nikmati bersama teman dan keluarga
              </p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="img/pantai losari.jpg" class="d-block w-50 mx-auto" alt="Pantai Losari" />
            <div class="carousel-caption d-none d-md-block bg-black w-50 mx-auto">
              <h5>Pantai Losari</h5>
              <p>
                Pantai Losari adalah atraksi wisata ikonik Kota Makassar. Pengalaman berkunjung ke Kota Makassar tidak
                akan lengkap sebelum datang ke tempat ini. Objek wisata yang terkenal akan pemandangan matahari tenggelam
                ini buka 24 jam tanpa mengenakan biaya masuk pada pengunjung.
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- Carousel End -->
    </div>
    <!-- Navbar & Hero End -->

    <!-- Paket Start -->
    <div class="container-fluid py-5 main">
      <div class="container py-5">
        <div class="section-title mb-5">
          <div class="sub-style">
            <h4 class="sub-title px-3 mb-0">Mau Kemana Hari Ini?</h4>
          </div>
          <h1 class="display-3 mb-4">
            Misi Kami Adalah Membuat Liburan Anda Di Sulsel Menjadi Menyenangkan
          </h1>
          <p class="mb-0">
            Kami menyediakan berbagai tempat wisata di Sulawesi Selatan dan paket-paket yang menarik
          </p>
        </div>
        <!-- Card Start -->
        <div class="row d-flex justify-content-center">
          <?php
          $sql = "SELECT * FROM paket_wisata";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '
      <div class="col-md-6 mb-4">
        <div class="card bg-danger" style="height: 650px;">
          <img src="img/' . $row["foto"] . '" class="card-img-top" style="height:400px;" alt="foto wisata""' . $row["nama_wisata"] . '">
          <div class="card-body overflow-auto">
            <h5 class="card-title">' . $row["nama_wisata"] . '</h5>
            <p class="card-text overflow-auto">' . $row["deskripsi"] . '</p>
            <div class="d-flex justify-content-between align-items-center">
              <p class="card-text"><strong>Harga:</strong> Rp ' . number_format($row["harga"], 0, ',', '.') . '</p>';
              if (isset($_SESSION['login']) || $_SESSION['role'] === 'user') {
                echo '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pesanModal" data-id="' . $row["id"] . '" data-nama="' . $row["nama_wisata"] . '" data-harga="' . $row["harga"] . '">Pesan</button>';
              } else {
                echo '<a href="#" class="btn btn-secondary" onclick="alert(\'Silakan login terlebih dahulu untuk memesan paket wisata.\')">Pesan</a>';
              }
              echo '
            </div>
          </div>
        </div>
      </div>';
            }
          } else {
            echo '<p class="text-center">No packages available.</p>';
          }
          $conn->close();
          ?>
        </div>
        <!-- Card End -->
      </div>
    </div>
    <!-- Paket End -->

    <!-- Footer start -->
    <footer class="bg-light text-center text-lg-start">
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2024 Jokka Deh - Muhammad Dani Arya Putra
      </div>
    </footer>
    <!-- footer end -->
  </div>

  <!-- Modal login -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="process/login.php">
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="container-fluid d-flex justify-content-between align-items-baseline">
              <button type="submit" class="btn btn-primary">Login</button>
              <p>Belum Punya Akun? <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#registerModal">Sign Up</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- modal login end -->

  <!-- Modal signup end -->
  <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registerModalLabel">Register</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="../process/signup.php">
            <div class="mb-3">
              <label for="registerEmail" class="form-label">Email address</label>
              <input type="email" class="form-control" id="registerEmail" placeholder="name@example.com" name="email">
            </div>
            <div class="mb-3">
              <label for="registerPassword" class="form-label">Password</label>
              <input type="password" class="form-control" id="registerPassword" name="password">
            </div>
            <div class="mb-3">
              <label for="confirmPassword" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- modal signup end -->

  <!-- modal pemesanan start -->
  <div class="modal fade" id="pesanModal" tabindex="-1" aria-labelledby="pesanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pesanModalLabel">Pemesanan Paket Wisata</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="process/pemesanan.php">
            <input type="hidden" id="id_paket_wisata" name="id_paket_wisata">
            <input type="hidden" id="harga_paket" name="harga_paket">
            <div class="mb-3">
              <label for="nama_pemesanan" class="form-label">Nama Pemesanan</label>
              <input type="text" class="form-control" id="nama_pemesanan" name="nama_pemesanan" required>
            </div>
            <div class="mb-3">
              <label for="no_telp" class="form-label">No. Telepon</label>
              <input type="tel" class="form-control" id="no_telp" name="no_telp" required>
            </div>
            <div class="mb-3">
              <label for="tanggal" class="form-label">Tanggal</label>
              <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="mb-3">
              <label for="paket_wisata" class="form-label">Paket Wisata</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="100000" id="paket1" name="paket[]">
                <label class="form-check-label" for="paket1">Paket A (+Rp 100,000)</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="200000" id="paket2" name="paket[]">
                <label class="form-check-label" for="paket2">Paket B (+Rp 200,000)</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1000000" id="paket3" name="paket[]">
                <label class="form-check-label" for="paket3">Paket C (+Rp 1,000,000)</label>
              </div>
            </div>
            <div class="mb-3">
              <label for="total_harga" class="form-label">Total Harga</label>
              <input type="number" class="form-control" id="total_harga" name="total_harga" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Pesan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- modal pemesanan end -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>

  <script>
    document.querySelector('[data-bs-target="#registerModal"]').addEventListener('click', function() {
      var loginModal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
      loginModal.hide();
    });

    document.querySelectorAll('[data-bs-target="#pesanModal"]').forEach(button => {
      button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const harga = this.getAttribute('data-harga');

        document.getElementById('id_paket_wisata').value = id;
        document.getElementById('harga_paket').value = harga;
        document.getElementById('total_harga').value = harga;

        // Reset checkbox and total harga
        document.querySelectorAll('#pesanModal input[type="checkbox"]').forEach(checkbox => {
          checkbox.checked = false;
        });

        document.querySelectorAll('#pesanModal input[type="checkbox"]').forEach(checkbox => {
          checkbox.addEventListener('change', function() {
            let totalHarga = parseInt(harga);

            document.querySelectorAll('#pesanModal input[type="checkbox"]:checked').forEach(checkedBox => {
              totalHarga += parseInt(checkedBox.value); // Additional price based on checkbox value
            });

            document.getElementById('total_harga').value = totalHarga;
          });
        });
      });
    });
  </script>
</body>

</html>