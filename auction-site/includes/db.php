<?php
// In db.php
$servername = "localhost";
$username = "root";  // Adjust according to your setup
$password = "";  // Adjust according to your setup
$dbname = "auction_system_db";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Optional: Add a debug line to confirm connection
    echo "Connected successfully to the database!";
}
?>
