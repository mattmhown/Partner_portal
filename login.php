<?php
session_start();
require 'db.php';

header("Content-Type: application/json"); // Send JSON response

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['username'];
$password = $data['password'];

$stmt = $conn->prepare("SELECT id, password_hash FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password_hash'])) {
        $_SESSION["user_id"] = $row["id"];
        echo json_encode(["success" => true, "message" => "Login successful!"]);
        exit();
    }
}

echo json_encode(["success" => false, "message" => "Invalid credentials!"]);
?>

