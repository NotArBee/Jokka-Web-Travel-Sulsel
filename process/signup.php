<?php
// Include the database connection file
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate passwords
    if ($password != $confirmPassword) {
        echo "<script>alert('Passwords dan confirm password berbeda!');</script>";
        echo "<script>window.location.href = '../index.php';</script>";
        exit();
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $sql = "INSERT INTO user (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $hashedPassword);

        if ($stmt->execute()) {
            echo "<script>alert('Anda berhasil mendaftar, silahkan login');</script>";
            echo "<script>window.location.href = '../index.php';</script>";
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}