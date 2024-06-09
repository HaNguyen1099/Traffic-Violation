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

// Get form data (assuming the form uses POST method)
$license_id = $_POST['license_id'];
$license_number = $_POST['license_number'];
$driver_name = $_POST['driver_name'];
$date_of_issue = $_POST['date_of_issue'];
$date_of_expiry = $_POST['date_of_expiry'];
$issuing_authority = $_POST['issuing_authority'];

// Prepare SQL statement with placeholders
$sql = "INSERT INTO driving_licenses (license_id, license_number, driver_name, date_of_issue, date_of_expiry, issuing_authority) VALUES ('$license_id', '$license_number', '$driver_name', '$date_of_issue', '$date_of_expiry', '$issuing_authority')";

// Prepare statement
$stmt = $conn->prepare($sql);

// Execute the prepared statement
if ($stmt->execute()) {
    // Redirect to violations.php
    header("Location: licenses.php");
    exit; // Important to stop script execution after redirect
} else {
    exit();
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>