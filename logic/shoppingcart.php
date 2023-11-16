<?php
// Checkout System in Navbar (TODO), home.php Room3 already has functionality added for this
session_start();

// Handle the reservation logic
if (isset($_POST['reserveRoom'])) {
    $reservedRoom = $_POST['reserveRoom'];

    // Initialize the session variable if it doesn't exist
    if (!isset($_SESSION['selectedRooms'])) {
        $_SESSION['selectedRooms'] = [];
    }

    // Add the reserved room to the session
    $_SESSION['selectedRooms'][] = $reservedRoom;
}

header('Location: ../home.php');
?>