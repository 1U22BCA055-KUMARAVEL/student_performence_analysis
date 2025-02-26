<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "globalwarn1705";
$dbname = "student_performance";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>