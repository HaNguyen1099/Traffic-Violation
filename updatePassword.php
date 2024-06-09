<?php
    // Connect to database (replace with your credentials)
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

    // Handle AJAX request for password update
    if (isset($_POST['currentPassword']) && isset($_POST['newPassword'])) {
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];

        // Check if the current password is correct
        $stmt = $conn->prepare("SELECT * FROM admin WHERE password = md5($currentPassword)");
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            echo json_encode(['error' => 'Mật khẩu hiện tại không chính xác.']);
            exit;
        }

        // Update the password
        $stmt = $conn->prepare("UPDATE admin SET password = md5($newPassword)");
        $stmt->execute();

        if ($stmt->affected_rows === 1) {
            echo json_encode(['success' => 'Mật khẩu đã được cập nhật.']);
        } else {
            $error = $stmt->error;
            echo json_encode(['error' => 'Cập nhật mật khẩu thất bại. Vui lòng thử lại.']);
        }

        $stmt->close();
    }

    $conn->close();
?>
