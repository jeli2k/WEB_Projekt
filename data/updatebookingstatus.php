<?php
require_once("dbaccess.php");
require_once("dbfunctions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // validate and sanitize input
    $booking_id = isset($_POST['booking_id']) ? intval($_POST['booking_id']) : null;
    $new_status = isset($_POST['status']) ? $_POST['status'] : null;

    // check if the inputs are valid
    if ($booking_id === null || $new_status === null) {
        die("Invalid input.");
    }

    // check if the new status is a valid option
    $valid_statuses = ['new', 'confirmed', 'cancelled'];
    if (!in_array($new_status, $valid_statuses)) {
        die("Invalid status.");
    }

    // prepare and execute the query
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

    // redirect back to the booking management page
    header('Location: ../reservationsmanagement.php');
    exit;
}

// redirect to the booking management page if the script is accessed without POST request
header('Location: ../reservationsmanagement.php');
exit;
?>
