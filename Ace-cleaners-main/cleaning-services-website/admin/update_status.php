<?php
session_start();
include "dconn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderId = $_POST["orderId"];
    $status = $_POST["status"];

    // Update the status of the order in the database
    $sql = "UPDATE cart SET status = ? WHERE id = ?";
    $stmt = $conne->prepare($sql);
    $stmt->bind_param("si", $status, $orderId);
    $stmt->execute();
    $stmt->close();

    // Respond with success message
    echo "success";
} else {
    // Respond with error message
    echo "error";
}
?>
