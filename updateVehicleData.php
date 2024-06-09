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

// Get edited data from POST request
$editedVehicleData = $_POST;

// Extract data 
$vehicleId = $editedVehicleData['vehicle_id'];
$licensePlate = $editedVehicleData['license_plate'];
$ownerName = $editedVehicleData['owner_name'];
$registrationDate = $editedVehicleData['registration_date'];
$vehicleType = $editedVehicleData['vehicle_type'];
$color = $editedVehicleData['color'];

// Prepare SQL query to update data
$sql = "UPDATE vehicles SET 
          license_plate = ?,
          owner_name = ?,
          registration_date = ?,
          vehicle_type = ?,
          color = ?
        WHERE vehicle_id = ?";

// Create prepared statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param('sssssi', $licensePlate, $ownerName, $registrationDate, $vehicleType, $color, $vehicleId);

// Execute prepared statement
if ($stmt->execute()) {
  echo json_encode(array("success" => true, "message" => "Data updated successfully"));
} else {
  echo json_encode(array("success" => false, "error" => "Error updating data: " . $stmt->error));
}

// Close prepared statement and connection
$stmt->close();
$conn->close();

?>