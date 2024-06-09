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

if (isset($_POST['updatePaymentStatus'])) {
  // Extract data from POST request
  $reportId = (int) $_POST['reportId'];
  $newPaymentStatus = (isset($_POST['isChecked']) && $_POST['isChecked'] === 'true') ? 1 : 0;

  // Prepare and execute SQL UPDATE statement
  $sql = "UPDATE traffic_reports SET isPaymentDone = $newPaymentStatus WHERE report_id = $reportId";
  $stmt = $conn->prepare($sql);
//   $stmt->bind_param("ii", $newPaymentStatus, $reportId);
  $stmt->execute();

  // Handle success or error (optional)
  if ($stmt->affected_rows === 1) {
    echo "Payment status updated successfully.";
  } else {
    echo "Error updating payment status.";
  }

  $stmt->close();
} else {
  // Handle invalid request
  echo "Invalid request.";
}

$conn->close();
?>