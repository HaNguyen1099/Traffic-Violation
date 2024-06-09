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
    $licenseId = $_POST['licenseId'];
  
    // Prepare SQL query to fetch violation data
    $sql = "SELECT license_id, license_number, driver_name, date_of_issue, date_of_expiry, issuing_authority FROM driving_licenses WHERE license_id = ?";
    // Create prepared statement
    $stmt = $conn->prepare($sql);
  
    // Bind parameters
    $stmt->bind_param('i', $licenseId);
  
    // Execute prepared statement
    $stmt->execute();
  
    // Bind results to variables
    $stmt->bind_result($licenseId, $licenseNumber, $driverName, $dateOfIssue, $dateOfExpiry, $issuingAuthority);
  
    // Fetch the violation data
    $stmt->fetch();
  
    // Close prepared statement and connection
    $stmt->close();
    $conn->close();
  
    // Create an associative array to store violation data
    $licenseData = array(
      "license_id" => $licenseId,
      "license_number" => $licenseNumber,
      "driver_name" => $driverName,
      "date_of_issue" => $dateOfIssue,
      "date_of_expiry" => $dateOfExpiry,
      "issuing_authority" => $issuingAuthority,

    );
  
    // Convert array to JSON and echo the output
    echo json_encode($licenseData);
  
  } catch (mysqli_sql_exception $e) {
    echo json_encode(array("error" => $e->getMessage()));
  }
  
  ?>
