<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'your_username', 'your_password', 'userdb');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE userId = ? AND password = ?");
    $stmt->bind_param("ss", $userId, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Login successful!'); window.location.href = 'dashboard.php';</script>";
    } else {
        $error = "User ID or Password is incorrect.";
        header("Location: login.php?error=" . urlencode($error));
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>