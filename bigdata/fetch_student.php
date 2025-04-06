<?php
$servername = "localhost";
$username = "root"; // your MySQL username
$password = "bhuvans2526";     // your MySQL password (if any)
$dbname = "datas";  // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection error
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the register number from the form
$reg_no = $_POST['reg_no'];

// Prepare and execute query
$sql = "SELECT * FROM students WHERE reg_no = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $reg_no);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $student = $result->fetch_assoc();

  echo "<h2>Student Details</h2>";
  echo "<p><strong>Name:</strong> " . $student['name'] . "</p>";
  echo "<p><strong>English:</strong> " . $student['english'] . "</p>";
  echo "<p><strong>Tamil:</strong> " . $student['tamil'] . "</p>";
  echo "<p><strong>Maths:</strong> " . $student['maths'] . "</p>";
  echo "<p><strong>Physics:</strong> " . $student['physics'] . "</p>";
  echo "<p><strong>Chemistry:</strong> " . $student['chemistry'] . "</p>";
  echo "<p><strong>C Programming:</strong> " . $student['c_programming'] . "</p>";
  echo "<p><strong>IT Essentials:</strong> " . $student['it_essentials'] . "</p>";
} else {
  echo "<p>No student found with Register Number: $reg_no</p>";
}

// Close connection
$stmt->close();
$conn->close();
?>
