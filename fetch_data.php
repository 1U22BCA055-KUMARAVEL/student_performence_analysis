<?php
header('Content-Type: application/json');
include 'database.php'; // Ensure database connection

$sql = "SELECT name, score, attendance FROM student_data";
$result = $conn->query($sql);

$students = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

echo json_encode($students);
$conn->close();
?>
