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
$reportId = (int) $_POST['reportId']; // Cast to integer

// Prepare and execute the SQL DELETE statement
$sql = "DELETE FROM traffic_reports WHERE report_id = $reportId";
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