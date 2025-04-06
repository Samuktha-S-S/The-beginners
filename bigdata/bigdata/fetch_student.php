<?php
// Database connection
$host = "localhost";
$dbname = "datas";
$user = "root";  // Change as per your MySQL credentials
$password = "buvans2526"; // Change as per your MySQL password

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch student details based on reg_no
$student = null;
$error_message = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg_no = $_POST['reg_no'];

    // Query to get student details based on reg_no
    $query = "SELECT * FROM students WHERE reg_no = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $reg_no);  // bind parameter
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        $error_message = "No student found with this registration number.";
    }

    $stmt->close();
    $conn->close();
}
?>


