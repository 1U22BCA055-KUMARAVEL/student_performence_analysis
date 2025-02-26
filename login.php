<?php
session_start();
include 'database.php'; // Ensure database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            echo "<script>window.location.href='home.html';</script>";
        } else {
            echo "<script>alert('Invalid Credentials!'); window.location.href='index.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials!'); window.location.href='index.html';</script>";
    }
}
?>
