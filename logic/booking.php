<?php
session_start();

include_once(__DIR__ . "/../data/dbaccess.php");

// form submitted?
if (isset($_POST['bookRoom'])) {
    // retrieve the selected room ID
    $selectedRoomId = $_POST['selectedRoom'];

    // retrieve the room details
    $roomDetails = findRoom($selectedRoomId);

    // check if the room was found
    if ($roomDetails) {
        $room_id = $selectedRoomId;
        $arrivalDate = $_POST['arrivalDate'];
        $departureDate = $_POST['departureDate'];
        $withBreakfast = isset($_POST['withBreakfast']) ? 1 : 0; // Store as 1 for true, 0 for false
        $withParking = isset($_POST['withParking']) ? 1 : 0;
        $withPets = isset($_POST['withPets']) ? 1 : 0;

        // fetch user ID
        $userEmail = $_SESSION['email'];
        $userDetails = findUserByEmail($userEmail);

        if ($userDetails) {
            $user_id = $userDetails['id'];
            // date validation
                    if (strtotime($departureDate) <= strtotime($arrivalDate)) {
                        // departure date must be later than arrival date
                        $datevalidation = "invalid";
                        setcookie("datevalidation", $datevalidation, time() + (86400 * 30), "/");
                        // save room + dates so they don't have to be entered again
                        $_SESSION["selectedRoom"] = $selectedRoom;
                        $_SESSION["arrivalDate"] = $arrivalDate;
                        $_SESSION["departureDate"] = $departureDate;
                        $_SESSION["withBreakfast"] = $withBreakfast;
                        $_SESSION["withParking"] = $withParking;
                        $_SESSION["withPets"] = $withPets;

                        header("Location: ../booking.php");
                        exit();
                    } else {
                        // save booking details
                        $bookingId = saveBooking($room_id, $arrivalDate, $departureDate, $withBreakfast, $withParking, $withPets, $user_id);

                        // save booking details in the session for confirmation.php
                        $_SESSION['bookingDetails'] = [
                            'bookingId' => $bookingId,
                            'selectedRoom' => $selectedRoom,
                            'arrivalDate' => $arrivalDate,
                            'departureDate' => $departureDate,
                            'withBreakfast' => $withBreakfast,
                            'withParking' => $withParking,
                            'withPets' => $withPets,
                            'status' => 'new', // Initial status is set to "new"
                        ];

                        // demo: Session
                        $datevalidation = "valid";

                        header("Location: ../confirmation.php");
                        exit();
                    }
        } else {
            echo "Error: User details not found.";
            exit();
        }

        
    } else {
        echo "Error: Room details not found.";
        exit();
    }
} else {
    header("Location: ../booking.php");
    exit();
}
?>
