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
// Get the report ID from the POST data
$vehicleId = (int) $_POST['vehicleId']; // Cast to integer

// Prepare and execute the SQL DELETE statement
$sql = "DELETE FROM vehicles WHERE vehicle_id = $vehicleId";
$stmt = $conn->prepare($sql);

// Prepare the response for AJAX
$response = [];

if ($stmt->execute()) {
  $response['status'] = "success";
  $response['message'] = "Record deleted successfully!";
} else {
  $response['status'] = "error";
  $response['message'] = "Error deleting record: " . $conn->error;
}

// Encode the response to JSON and send back
echo json_encode($response);

// Close the statement and connection
$stmt->close();
$conn->close();
?>