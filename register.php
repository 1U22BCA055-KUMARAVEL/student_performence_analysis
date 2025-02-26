<?php
session_start();
include 'database.php'; // Ensure database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password hashing

    // Check if the user already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username already taken!'); window.location.href='register.html';</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            echo "<script>alert('Registration Successful! You can now log in.'); window.location.href='index.html';</script>";
        } else {
            echo "<script>alert('Registration Failed!'); window.location.href='register.html';</script>";
        }
    }
}
?>
