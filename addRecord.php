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
$report_id = $_POST['report_id'];
$vehicle_id = $_POST['vehicle_id'];
$license_id = $_POST['license_id'];
$report_date = $_POST['report_date'];
$violation_type = $_POST['violation_type'];
$location = $_POST['location'];
$fine = (int) $_POST['fine']; 
$officer_name = $_POST['officer_name'];
$notes = $_POST['notes'];
$isPaymentDone = $_POST['isPaymentDone'];

// Prepare SQL statement with placeholders
$sql = "INSERT INTO traffic_reports (report_id, vehicle_id, license_id, report_date, violation_type, location, fine, officer_name, notes, isPaymentDone) VALUES ('$report_id', '$vehicle_id', '$license_id', '$report_date', '$violation_type', '$location', '$fine', '$officer_name', '$notes', '$isPaymentDone')";

// Prepare statement
$stmt = $conn->prepare($sql);

// Execute the prepared statement
if ($stmt->execute()) {
    // Redirect to violations.php
    header("Location: violations.php");
    exit; // Important to stop script execution after redirect
} else {
    exit();
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>