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
$vehicle_id = $_POST['vehicle_id'];
$license_plate = $_POST['license_plate'];
$owner_name = $_POST['owner_name'];
$registration_date = $_POST['registration_date'];
$vehicle_type = $_POST['vehicle_type'];
$color = $_POST['color'];

// Prepare SQL statement with placeholders
$sql = "INSERT INTO vehicles (vehicle_id, license_plate, owner_name, registration_date, vehicle_type, color) VALUES ('$vehicle_id', '$license_plate', '$owner_name', '$registration_date', '$vehicle_type', '$color')";

// Prepare statement
$stmt = $conn->prepare($sql);

// Execute the prepared statement
if ($stmt->execute()) {
    // Redirect to violations.php
    header("Location: vehicles.php");
    exit; // Important to stop script execution after redirect
} else {
    exit();
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>