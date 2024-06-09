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

// Get edited violation data from POST request
$editedLicenseData = $_POST;

// Extract data from editedViolationData
$licenseId = $editedLicenseData['license_id'];
$licenseNumber = $editedLicenseData['license_number'];
$driverName = $editedLicenseData['driver_name'];
$dateOfIssue = $editedLicenseData['date_of_issue'];
$dateOfExpiry = $editedLicenseData['date_of_expiry'];
$issuingAuthority = $editedLicenseData['issuing_authority'];

// Prepare SQL query to update violation data
$sql = "UPDATE driving_licenses SET 
          license_number = ?,
          driver_name = ?,
          date_of_issue = ?,
          date_of_expiry = ?,
          issuing_authority = ?
        WHERE license_id = ?";

// Create prepared statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param('sssssi', $licenseNumber, $driverName, $dateOfIssue, $dateOfExpiry, $issuingAuthority, $licenseId);

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