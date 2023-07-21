<?php
session_start();

include("database.php");

// Server-side authentication
if (!isset($_SESSION["id_customer"]) || empty($_SESSION["id_customer"])) {
    // Redirect to login page or return an error response
    header("Location: index.php");
    exit;
}

$id_customer = $_SESSION["id_customer"];

// Use prepared statements for database query to prevent SQL injection
$sql = "SELECT booking_id FROM booking WHERE id_customer = ? AND status = 'settled' ORDER BY id_booking DESC LIMIT 5";

// Prepare the statement
$stmt = $con->prepare($sql);

// Bind the parameter
$stmt->bind_param("i", $id_customer);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

$notifications = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Generate a notification message with a link to the booking details page
        $notification = array(
            'message' => "Your booking ". $row['booking_id'] ." is settled.",
            'link' => "booking.php?booking_id=" . $row['booking_id']
        );
        $notifications[] = $notification;
    }
}

// Close the statement
$stmt->close();

// Encode the notifications array to JSON data and echo it
echo json_encode($notifications);
?>
