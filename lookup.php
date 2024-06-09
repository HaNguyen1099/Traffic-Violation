<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'traffic_violation_db';

// Connect to the database
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the license plate number from the form
$license_plate = isset($_POST['vhno']) ? htmlspecialchars($_POST['vhno']) : '';

// Prepare the SQL query (replace with your specific query)
$sql = "SELECT * FROM traffic_reports WHERE vehicle_id = (
  SELECT vehicle_id FROM vehicles WHERE license_plate = ?
)";

// Prepare the statement
$stmt = mysqli_prepare($conn, $sql);

// Bind the license plate number to the query parameter
mysqli_stmt_bind_param($stmt, "s", $license_plate);

// Execute the statement
mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);

// Check if a violation is found
if (mysqli_num_rows($result) > 0) {
  // Store results in an array for passing to the results page
  $violations = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $violations[] = $row; // Add each row of violation details to the array
  }

  // Close the database connection (important to free resources)
  mysqli_close($conn);

  // Set a session variable to indicate successful search and store results
  session_start();
  $_SESSION['violation_results'] = $violations;

  // Redirect to the results page with a success flag (optional)
  header("Location: result.php"); // Redirect with optional flag
  exit(); // Exit the script after redirection
} else {
  // Close the database connection (important)
  mysqli_close($conn);

  // Redirect to the results page with a failure flag
  header("Location: result.php?success=false");
  exit(); // Exit the script after redirection
}