<?php
    // Database connection (replace with your credentials)
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

    // Get form data (assuming the form uses POST method)
    $name = $_POST['input-username'];
    $email = $_POST['input-email'];

    $sql = "UPDATE admin SET name = '$name', email = '$email'";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute()) {
        // Redirect to violations.php
        header("Location: info.php");
        exit; // Important to stop script execution after redirect
    } else {
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
?>
