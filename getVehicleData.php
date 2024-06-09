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
    $vehicleId = $_POST['vehicleId'];
  
    // Prepare SQL query to fetch violation data
    $sql = "SELECT vehicle_id, license_plate, owner_name, registration_date, vehicle_type, color FROM vehicles WHERE vehicle_id = ?";
    // Create prepared statement
    $stmt = $conn->prepare($sql);
  
    // Bind parameters
    $stmt->bind_param('i', $vehicleId);
  
    // Execute prepared statement
    $stmt->execute();
  
    // Bind results to variables
    $stmt->bind_result($vehicleId, $licensePlate, $ownerName, $registrationDate, $vehicleType, $color);
  
    // Fetch the violation data
    $stmt->fetch();
  
    // Close prepared statement and connection
    $stmt->close();
    $conn->close();
  
    // Create an associative array to store data
    $vehicleData = array(
      "vehicle_id" => $vehicleId,
      "license_plate" => $licensePlate,
      "owner_name" => $ownerName,
      "registration_date" => $registrationDate,
      "vehicle_type" => $vehicleType,
      "color" => $color
    );
  
    // Convert array to JSON and echo the output
    echo json_encode($vehicleData);
  
  } catch (mysqli_sql_exception $e) {
    echo json_encode(array("error" => $e->getMessage()));
  }
  
  ?>
