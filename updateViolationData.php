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
$editedViolationData = $_POST;

// Extract data from editedViolationData
$reportId = $editedViolationData['report_id'];
$vehicleId = $editedViolationData['vehicle_id'];
$licenseId = $editedViolationData['license_id'];
$reportDate = $editedViolationData['report_date'];
$violationType = $editedViolationData['violation_type'];
$location = $editedViolationData['location'];
$fine = $editedViolationData['fine'];
$officerName = $editedViolationData['officer_name'];
$notes = $editedViolationData['notes'];
$isPaymentDone = $editedViolationData['isPaymentDone'];

// Prepare SQL query to update violation data
$sql = "UPDATE traffic_reports SET 
          vehicle_id = ?,
          license_id = ?,
          report_date = ?,
          violation_type = ?,
          location = ?,
          fine = ?,
          officer_name = ?,
          notes = ?,
          isPaymentDone = ?
        WHERE report_id = ?";

// Create prepared statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param('iisssssssi', $vehicleId, $licenseId, $reportDate, $violationType, $location, $fine, $officerName, $notes, $isPaymentDone, $reportId);

// Execute prepared statement
if ($stmt->execute()) {
  echo json_encode(array("success" => true, "message" => "Violation data updated successfully"));
} else {
  echo json_encode(array("success" => false, "error" => "Error updating violation data: " . $stmt->error));
}

// Close prepared statement and connection
$stmt->close();
$conn->close();

?>