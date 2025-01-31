<?php
$servername = "cp-wc04";  // Change if your host is different
$username = "admin"; 
$password = "Bitemefear8"; 
$dbname = "howncoma_PartnerPortal"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "✅ Database connected successfully!";
}

// Close the connection
$conn->close();
?>
