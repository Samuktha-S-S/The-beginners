<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm'];

    // Initialize error message
    $message = "";

    // Validate if all fields are filled out
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $message = "Please fill out all fields!";
    }
    // Validate if passwords match
    elseif ($password !== $confirm_password) {
        $message = "Passwords do not match!";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // MySQL connection info
        $host = "localhost";
        $dbname = "datas";
        $user = "root"; // Default MySQL user for XAMPP
        $password_db = "buvans2526"; // Your MySQL password

        // Create MySQL connection
        $conn = new mysqli($host, $user, $password_db, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert query (use prepared statements for security)
        // Exclude confirm_password from the insert query
        $query = "INSERT INTO signup (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        // Execute the query
        if ($stmt->execute()) {
            $message = "Signup successful! 🎉";
        } else {
            $message = "Error: " . $stmt->error;
        }

        // Close the connection
        $stmt->close();
        $conn->close();
    }
}
?>
