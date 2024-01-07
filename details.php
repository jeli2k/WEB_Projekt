<?php
require_once("data/dbaccess.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'includes/head.php'; ?>
    <?php
        // Check if the user is not logged in
        if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
            header("Location: login.php");
            exit();
        }
    ?>
    <title>Booking Details</title>
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;

        }

        main {
            flex: 1;
        }

        .booking-image {
            max-width: 100%;
            height: auto;
        }

        .booking-image-container {
            min-height: 300px; /* Set a minimum height for the container */
            background-size: cover; /* Cover the entire container */
            background-position: center; /* Center the image within the container */
            border-radius: 8px; /* Optional: Add border-radius for a rounded appearance */
        }

    </style>
</head>

<body>
    <nav>
    <?php include 'components/navbar.php'; ?> 
    </nav>
    <?php
    // check if user is logged in
    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
        header("Location: login.php");
        exit();
    }
    ?>

    <main class="container mt-5">
        <?php
        // check if booking ID is provided in the URL
        if (isset($_GET['bookingId'])) {
            $bookingId = $_GET['bookingId'];

            // Additional code to retrieve booking details from the database
            $bookingInfo = getBookingInfo($bookingId); // retrieve booking info by ID

            // Display booking information from the database
            if ($bookingInfo) {
                
                $roomDetails = findRoom($bookingInfo['room_id']);

                // Display Room Name as the title
                echo '<h2 class="mb-4">' . $roomDetails['title'] . '</h2>';

                // Display image as background
                echo '<div class="col-md-4 booking-image-container" style="background-image: url(\'' . $roomDetails['image_url'] . '\');">';
                echo '</div>';

                // Display booking information
                echo '<div class="col-md-8">';
                // small whitespace
                echo '<div style="margin-top: 20px;"></div>';
                
                echo '<p>Your booking details:</p>';
                echo '<ul>';
                echo '<li><strong>Room:</strong> ' . $bookingInfo['room_title'] . '</li>';
                // Format dates using DateTime
                $arrivalDate = new DateTime($bookingInfo['arrival_date']);
                $departureDate = new DateTime($bookingInfo['departure_date']);
                echo '<li><strong>Arrival Date:</strong> ' . $arrivalDate->format('j.n.Y') . '</li>';
                echo '<li><strong>Departure Date:</strong> ' . $departureDate->format('j.n.Y') . '</li>';
                echo '<li><strong>With Breakfast:</strong> ' . ($bookingInfo['with_breakfast'] ? 'Yes' : 'No') . '</li>';
                echo '<li><strong>With Parking:</strong> ' . ($bookingInfo['with_parking'] ? 'Yes' : 'No') . '</li>';
                echo '<li><strong>With Pets:</strong> ' . ($bookingInfo['with_pets'] ? 'Yes' : 'No') . '</li>';
                echo '<li><strong>Status:</strong> ' . $bookingInfo['status'] . '</li>';
                echo '<li><strong>Total Price:</strong> ' . $bookingInfo['total_price'] . ' €</li>';
                echo '</ul>';
                echo '</div>';
                echo '</div>';

            } else {
                // Handle the case where no booking information is found
                echo '<p class="mt-5">No booking information found.</p>';
            }
        } else {
            // Handle the case where no booking ID is provided
            echo '<p class="mt-5">No booking ID provided.</p>';
        }
        ?>
    </main>
    <footer>
       <?php include 'components/footer.php'; ?> 
    </footer>
    <?php include 'includes/scripts.php'; ?>
</body>

</html>
