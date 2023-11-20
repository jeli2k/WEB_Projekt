<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php'; ?>
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
            
            <?php
            // convert "checked/notchecked" to "Yes/No" for better display
            if (isset($_SESSION['withBreakfast']) && $_SESSION['withBreakfast'] == "checked") {
                $breakfast = "Yes";
            } else {
                $breakfast = "No";
            }
            if (isset($_SESSION['withParking']) && $_SESSION['withParking'] == "checked") {
                $parking = "Yes";
            } else {
                $parking = "No";
            }
            if (isset($_SESSION['withPets']) && $_SESSION['withPets'] == "checked") {
                $pets = "Yes";
            } else {
                $pets = "No";
            }
            ?>
            <ul>
                <li><strong>Room:</strong> <?php echo $bookingDetails['selectedRoom']; ?></li>
                <li><strong>Arrival Date:</strong> <?php echo $bookingDetails['arrivalDate']; ?></li>
                <li><strong>Departure Date:</strong> <?php echo $bookingDetails['departureDate']; ?></li>
                <li><strong>With Breakfast:</strong> <?php echo $breakfast ?></li>
                <li><strong>With Parking:</strong> <?php echo $parking; ?></li>
                <li><strong>With Pets:</strong> <?php echo $pets; ?></li>
                <li><strong>Status:</strong> <?php echo $bookingDetails['status']; ?></li>
            </ul>
        </section>
            
    </main>

    <?php include 'components/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
</body>
</html>
