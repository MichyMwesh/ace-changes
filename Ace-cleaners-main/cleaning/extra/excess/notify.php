<?php
// Database connection parameters
$servername = "localhost";
$username = "your_database_username";
$password = "your_database_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// User ID for which to fetch notifications
$userId = $_GET['userId'];

// SQL query to fetch notifications for the user
$sql = "SELECT * FROM notifications WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();

$result = $stmt->get_result();
$notifications = array();
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

// Close the connection
$stmt->close();
$conn->close();

// Output the notifications in JSON format
header('Content-Type: application/json');
echo json_encode($notifications);
?>
