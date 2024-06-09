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

try {
    if ($conn->connect_error) {
      throw new mysqli_sql_exception("Connection failed: " . $conn->connect_error);
    }
  
    // Get violation ID from POST request
    $violationId = $_POST['violationId'];
  
    // Prepare SQL query to fetch violation data
    $sql = "SELECT report_id, vehicle_id, license_id, report_date, violation_type, location, fine, officer_name, notes, isPaymentDone FROM traffic_reports WHERE report_id = ?";
    // Create prepared statement
    $stmt = $conn->prepare($sql);
  
    // Bind parameters
    $stmt->bind_param('i', $violationId);
  
    // Execute prepared statement
    $stmt->execute();
  
    // Bind results to variables
    $stmt->bind_result($reportId, $vehicleId, $licenseId, $reportDate, $violationType, $location, $fine, $officerName, $notes, $isPaymentDone);
  
    // Fetch the violation data
    $stmt->fetch();
  
    // Close prepared statement and connection
    $stmt->close();
    $conn->close();
  
    // Create an associative array to store violation data
    $violationData = array(
      "report_id" => $reportId,
      "vehicle_id" => $vehicleId,
      "license_id" => $licenseId,
      "report_date" => $reportDate,
      "violation_type" => $violationType,
      "location" => $location,
      "fine" => $fine,
      "officer_name" => $officerName,
      "notes" => $notes,
      "isPaymentDone" => $isPaymentDone
    );
  
    // Convert array to JSON and echo the output
    echo json_encode($violationData);
  
  } catch (mysqli_sql_exception $e) {
    echo json_encode(array("error" => $e->getMessage()));
  }
  
  ?>
