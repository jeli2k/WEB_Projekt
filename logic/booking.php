<?php
session_start();

if (isset($_POST['bookRoom'])) {
    $selectedRoom = $_POST['selectedRoom'];
    $arrivalDate = $_POST['arrivalDate'];
    $departureDate = $_POST['departureDate'];
    $withBreakfast = isset($_POST['withBreakfast']) ? "Yes" : "No";
    $withParking = isset($_POST['withParking']) ? "Yes" : "No";
    $withPets = isset($_POST['withPets']) ? "Yes" : "No";

    // Check if dates are within 100 years
    //$maxDate = date('Y-m-d', strtotime('+100 years'));
    //$minDate = date('Y-m-d', strtotime('-100 years'));
    
    // Perform date validation
    /*
    if ($arrivalDate < $minDate || $arrivalDate > $maxDate || $departureDate < $minDate || $departureDate > $maxDate) {
        // Invalid date range. Please select dates within the next 100 years"
        $datevalidation = "invalid";
    } 
    */

    // bookingCounter
    // check if the counter is not set in the session
    if (!isset($_SESSION['counter'])) {
        // not set = initialize it to 0
        $_SESSION['counter'] = 0;
    }
    $_SESSION['counter']++;
    $currentCounter = $_SESSION['counter'];

    if (strtotime($departureDate) <= strtotime($arrivalDate)) {
        // Departure date must be later than arrival date
        $datevalidation = "invalid";
        setcookie("datevalidation", $datevalidation, time() + (86400 * 30), "/");
        // safe room + dates so they dont have to be entered again
        $_SESSION["selectedRoom"] = $selectedRoom;
        $_SESSION["arrivalDate"] = $arrivalDate;
        $_SESSION["departureDate"] = $departureDate;
        $_SESSION["withBreakfast"] = $withBreakfast;
        $_SESSION["withParking"] = $withParking;
        $_SESSION["withPets"] = $withPets;
        header("Location: ../booking.php");
        exit();
    } else {
        // Store booking details in session or database (TODO)
        // demo: Session
        $datevalidation = "valid";
        $_SESSION['bookingDetails' . $currentCounter] = [
            'selectedRoom' => $selectedRoom,
            'arrivalDate' => $arrivalDate,
            'departureDate' => $departureDate,
            'withBreakfast' => $withBreakfast,
            'withParking' => $withParking,
            'withPets' => $withPets,
            'status' => 'new', // Initial status is set to "new"
        ];

        echo "$selectedRoom booked successfully!"; // Maybe implement Message
        header("Location: ../confirmation.php");
    }
}
header("Location: ../confirmation.php");
?>
