<?php
// Include the database connection file
include 'koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to check if the user exists
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, check password
        $user = $result->fetch_assoc();
        // Directly compare passwords if user is admin
        if ($user['role'] == 'admin' && $user['password'] == $password) {
            // Redirect to dashboard
            $_SESSION['login'] = true;
            $_SESSION['role'] = 'admin';
            echo "<script>alert('Selamat Datang Arya, Bismillah banyak orderan!');</script>";
            echo "<script>window.location.href = '../view admin/admin_dashboard.php';</script>";
            exit();
        } elseif ($user['role'] == 'user' && password_verify($password, $user['password'])) {
            // Password correct, redirect to pemesanan
            $_SESSION['login'] = true;
            $_SESSION['role'] = 'user';
            echo "<script>alert('Berhasil Login');</script>";
            echo "<script>window.location.href = '../index.php';</script>";
            exit();
        } else {
            // Password incorrect
            echo "<script>alert('Password yang dimasukkan salah');</script>";
            echo "<script>window.location.href = '../index.php';</script>";
            exit();
        }
    } else {
        // User not found
        echo "<script>alert('Email tidak terdaftar');</script>";
        echo "<script>window.location.href = '../index.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
