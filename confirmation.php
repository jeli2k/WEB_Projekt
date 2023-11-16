<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php'; ?>
    <title>Booking Confirmation</title>
</head>
<body>
    <header>
        <!-- header -->
    </header>

    <?php include 'components/navbar.php'; ?>

    <main>
        <?php
            // get the current counter value
            $currentCounter = $_SESSION['counter'];
            // create the key for the current bookingDetails based on the counter
            $bookingDetailsKey = 'bookingDetails' . $currentCounter;


            // check if booking details are available in the session
            if (isset($_SESSION[$bookingDetailsKey])) {         // Maybe auf Profile page einfügen (Show Booking Details?)
                $bookingDetails = $_SESSION[$bookingDetailsKey];
                
                // clear the booking details from the session to avoid displaying them again on refresh
                // unset($_SESSION['bookingDetails']);
            } else {
                // redirect to the home page or other page if no booking details are found
            }
        ?>
        <section class="container mt-5">
            <h2>Booking Confirmation</h2>
            <p>Thank you for your reservation! Your booking details:</p>

            <ul>
                <li><strong>Room:</strong> <?php echo $bookingDetails['selectedRoom']; ?></li>
                <li><strong>Arrival Date:</strong> <?php echo $bookingDetails['arrivalDate']; ?></li>
                <li><strong>Departure Date:</strong> <?php echo $bookingDetails['departureDate']; ?></li>
                <li><strong>With Breakfast:</strong> <?php echo $bookingDetails['withBreakfast']; ?></li>
                <li><strong>With Parking:</strong> <?php echo $bookingDetails['withParking']; ?></li>
                <li><strong>With Pets:</strong> <?php echo $bookingDetails['withPets']; ?></li>
                <li><strong>Status:</strong> <?php echo $bookingDetails['status']; ?></li>
            </ul>
        </section>
    </main>

    <?php include 'components/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
</body>
</html>
