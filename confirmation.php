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
        // Set a flag indicating that the user has confirmed the booking
        $_SESSION['bookingConfirmed'] = true;
    ?>
    <title>Booking Confirmation</title>
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }
    </style>
</head>

<body>
    <header>
        <!-- header -->
    </header>

    <?php include 'components/navbar.php'; ?>
    <?php
    // check if user is logged in
    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
        header("Location: login.php");
        exit();
    }
    ?>

    <main>
        <?php
        // check if booking details are available in the session
        if (isset($_SESSION['bookingDetails'])) {
            $bookingId = $_SESSION['bookingDetails']['bookingId'];

            // Additional code to retrieve booking details from the database
            $bookingInfo = getBookingInfo($bookingId); // retrieve booking info by ID

            // Display booking information from the database
            if ($bookingInfo) {
                echo '<section class="container mt-5">';
                echo '<h2>Booking Confirmation</h2>';
                echo '<p>Thank you for your reservation! Your booking details:</p>';
                echo '<ul>';
                echo '<li><strong>Room:</strong> ' . $bookingInfo['room_title'] . '</li>';
                echo '<li><strong>Arrival Date:</strong> ' . $bookingInfo['arrival_date'] . '</li>';
                echo '<li><strong>Departure Date:</strong> ' . $bookingInfo['departure_date'] . '</li>';
                echo '<li><strong>With Breakfast:</strong> ' . ($bookingInfo['with_breakfast'] ? 'Yes' : 'No') . '</li>';
                echo '<li><strong>With Parking:</strong> ' . ($bookingInfo['with_parking'] ? 'Yes' : 'No') . '</li>';
                echo '<li><strong>With Pets:</strong> ' . ($bookingInfo['with_pets'] ? 'Yes' : 'No') . '</li>';
                echo '<li><strong>Status:</strong> ' . $bookingInfo['status'] . '</li>';
                echo '</ul>';
                echo '</section>';
            } else {
                // Handle the case where no booking information is found
                echo '<section class="container mt-5">';
                echo '<p>No booking information found.</ap>';
                echo '</section>';
            }

            // Clear the booking ID from the session to avoid displaying them again on refresh
            unset($_SESSION['bookingId']);
        } else {
            // redirect to the home page or other page if no booking details are found
            header("Location: home.php");
            exit();
        }
        ?>
    </main>

    <?php include 'components/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
</body>

</html>
