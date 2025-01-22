<?php
// Database configuration
$servername = "localhost";
$username = "root"; // default username for XAMPP
$password = ""; // default password for XAMPP
$dbname = "feedback_db"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO feedback (department, semester, subject, rating, comments) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssis", $department, $semester, $subject, $rating, $comments);

// Get data from POST request
$department = $_POST['department'];
$semester = $_POST['Semester'];
$subject = $_POST['Subject'];
$rating = $_POST['rating'];
$comments = $_POST['comments'];

// Execute the statement
if ($stmt->execute()) {
    echo "Feedback submitted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
