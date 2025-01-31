<?php
session_start();
require 'db.php'; // Connects to database

header("Content-Type: application/json"); // Send JSON response

// Get JSON input from the fetch() request
$data = json_decode(file_get_contents("php://input"), true);

$email = $data['username']; // Get username from JSON
$password = $data['password']; // Get password from JSON

// Check if user exists in the database
$stmt = $conn->prepare("SELECT id, password_hash FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Verify password with database hash
    if (password_verify($password, $row['password_hash'])) {
        $_SESSION["user_id"] = $row["id"]; // Start session
        echo json_encode(["success" => true, "message" => "Login successful!"]);
        exit();
    }
}

// If login fails
echo json_encode(["success" => false, "message" => "Invalid credentials!"]);
?>
