<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_performance";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// User Management Module - Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['username'] = $username;
        echo "Login Successful!";
    } else {
        echo "Invalid Credentials!";
    }
}

// Data Collection Module - Insert Data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['student_name'])) {
    $name = $_POST['student_name'];
    $score = $_POST['score'];
    $attendance = $_POST['attendance'];

    $sql = "INSERT INTO student_data (name, score, attendance) VALUES ('$name', '$score', '$attendance')";
    if ($conn->query($sql) === TRUE) {
        echo "Student data inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Performance Analysis and Feedback - Backend
function analyzePerformance($score, $attendance) {
    if ($score >= 90) return "Excellent";
    elseif ($score >= 75) return "Good";
    elseif ($score >= 50) return "Average";
    else return "Needs Improvement";
}

function generateFeedback($analysis) {
    switch ($analysis) {
        case "Excellent": return "Outstanding performance! Keep it up!";
        case "Good": return "Great job! Aim for excellence.";
        case "Average": return "Keep practicing regularly.";
        case "Needs Improvement": return "Focus on weak areas and seek extra help.";
    }
}

// Report Generation Module - Fetch and Display Data
if (isset($_GET['generate_report'])) {
    $sql = "SELECT * FROM student_data";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $report = "Student Performance Report\n\n";
        while ($row = $result->fetch_assoc()) {
            $analysis = analyzePerformance($row['score'], $row['attendance']);
            $feedback = generateFeedback($analysis);
            $report .= "Name: " . $row['name'] . "\nScore: " . $row['score'] . "\nAttendance: " . $row['attendance'] . "%\nPerformance: " . $analysis . "\nFeedback: " . $feedback . "\n\n";
        }
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="Student_Performance_Report.txt"');
        echo $report;
        exit;
    } else {
        echo "No data available.";
    }
}

$conn->close();
?>
