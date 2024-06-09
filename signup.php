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

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Validate data
$errors = [];
if (empty($name)) {
    $errors[] = "Họ và tên không được để trống.";
}
if (empty($email)) {
    $errors[] = "Email không được để trống.";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email không hợp lệ.";
}
if (empty($password)) {
    $errors[] = "Mật khẩu không được để trống.";
} else if (strlen($password) < 8) {
    $errors[] = "Mật khẩu phải có ít nhất 8 ký tự.";
}

// If there are errors, send them back to the signup page
if (!empty($errors)) {
    $error_message = implode("\n", $errors);
    echo "<script>alert('$error_message');window.location.href='signup.html';</script>";
    exit;
}

// Hash password before storing it in the database
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert user data into database
$sql = "INSERT INTO admin (name, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $hashedPassword);

if ($stmt->execute()) {
    // Registration successful
    echo "<script>alert('Đăng ký thành công! Vui lòng đăng nhập.');window.location.href='login.html';</script>";
    exit;
} else {
    // Registration failed
    echo "<script>alert('Đăng ký thất bại! Vui lòng thử lại.');window.location.href='signup.html';</script>";
    exit;
}

$conn->close();

?>