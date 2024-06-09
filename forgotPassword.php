<?php
// Connect to your database (replace with your connection details)
$conn = new mysqli('localhost', 'username', 'password', 'database');

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get email from the form
$email = $_POST['email'];

// Check if email exists in the database
$sql = "SELECT id FROM admin WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Email exists, generate reset token and send email
    $token = generateRandomToken(); // Replace with your token generation function
    $sql = "UPDATE admini SET reset_token = '$token' WHERE email = '$email'";
    $conn->query($sql);

    sendPasswordResetEmail($email, $token); // Replace with your email sending function

    echo 'Email khôi phục mật khẩu đã được gửi đến ' . $email;
} else {
    echo 'Email không hợp lệ. Vui lòng thử lại.';
}

$conn->close();

// Function to generate a random reset token
function generateRandomToken() {
    // Implement your token generation logic here (e.g., using bin2hex(random_bytes(32)))
}

// Function to send password reset email (replace with your email sending logic)
function sendPasswordResetEmail($email, $token) {
    // Use your preferred method to send an email to $email with a link containing $token
    // The link should point to your password reset page (e.g., resetPassword.php?token=$token)
}
