<?php
$hostname = "localhost";
$username = "root"; 
$password = ""; 
$database = 'traffic_violation_db';

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve username and password from the form (assuming form action points to login.php)
$email = $_POST["email"];
$password = $_POST["password"];

// Hash the submitted password (assuming BCrypt)
$hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash password before binding

// Prepare SQL query with placeholders (preventing SQL injection)
$stmt = $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $hashedPassword); // Bind email and hashed password

if ($stmt->execute()) {
    // Registration successful
    header("Location: index.php");
    exit;
} else {
    // Registration failed
    echo "<script>alert('Đăng ký thất bại! Vui lòng thử lại.');window.location.href='login.html';</script>";
    exit;
}

$stmt->close(); // Close the statement

// Close database connection
$conn->close();

?>
