<?php
// register.php

$servername = "localhost";
$username = "root";  // default MySQL username
$password = "";      // default MySQL password (empty in local setup)
$dbname = "user_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted via POST method
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Server-side validation: Check if email already exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email already exists!";
    } else {
        // Encrypt password using bcrypt
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert new user into the database
        $insertSql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("ss", $email, $hashedPassword);
        
        if ($insertStmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $insertStmt->error;
        }
    }
}
?>
