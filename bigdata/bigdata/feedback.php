<?php
// Database connection details
$servername = "localhost";
$username = "root";  // your MySQL username
$password = "buvans2526";  // your MySQL password
$dbname = "datas";  // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get the reg_no from the form
    $regNo = $conn->real_escape_string($_POST['reg_no']);
    
    // SQL query to fetch student data by reg_no
    $sql = "SELECT * FROM students WHERE reg_no = '$regNo'";
    $result = $conn->query($sql);

    // Check if a student with this reg_no exists
    if ($result->num_rows > 0) {
        // Fetch the student data
        $student = $result->fetch_assoc();

        // Display the student data (you can redirect to a dashboard or another page)
        echo "<h3>Student Details:</h3>";
        echo "Name: " . $student['name'] . "<br>";
        echo "English: " . $student['english'] . "<br>";
        echo "Tamil: " . $student['tamil'] . "<br>";
        echo "Maths: " . $student['maths'] . "<br>";
        echo "Physics: " . $student['physics'] . "<br>";
        echo "Chemistry: " . $student['chemistry'] . "<br>";
        echo "C Programming: " . $student['c_programming'] . "<br>";
        echo "IT Essentials: " . $student['it_essential'] . "<br>";
    } else {
        // If no student found, display an error message
        echo "No student found with the provided Registration Number.";
    }
}

// Close the database connection
$conn->close();
?>
