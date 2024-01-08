<?php
require_once 'dbaccess.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $booking_id = isset($_POST['booking_id']) ? intval($_POST['booking_id']) : null;
    $new_status = isset($_POST['status']) ? $_POST['status'] : null;

    // Check if the inputs are valid
    if ($booking_id === null || $new_status === null) {
        die("Invalid input.");
    }

    // Check if the new status is a valid option
    $valid_statuses = ['new', 'confirmed', 'cancelled'];
    if (!in_array($new_status, $valid_statuses)) {
        die("Invalid status.");
    }

    // Prepare and execute the query
    $sql = "UPDATE bookings SET status = ? WHERE id = ?";
    $stmt = $db->prepare($sql);

    if ($stmt === false) {
        die("Error preparing the statement: " . $db->error);
    }

    if (!$stmt->bind_param("si", $new_status, $booking_id)) {
        die("Error binding parameters: " . $stmt->error);
    }

    if (!$stmt->execute()) {
        die("Error executing the statement: " . $stmt->error);
    }

    $stmt->close();

    // Redirect back to the booking management page
    header('Location: reservationsmanagement.php');
    exit;
}

// Redirect to the booking management page if the script is accessed without POST request
header('Location: reservationsmanagement.php');
exit;
?>
