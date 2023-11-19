<!-- booking.php -> logic/booking.php -> confirmation.php -->

<!DOCTYPE html>
<html lang="de">
    <head>
        <?php include 'includes/head.php'; ?>
        <link href="override.css" rel="stylesheet">
        <title>Booking</title>
        
    </head>

    <body>
        <header>
            <style>
                .smaller-input {
                    width: 400px; /* Adjust the width percentage as needed */
                    display: flex;
                }
            </style>
        </header>

        <?php
            include 'components/navbar.php';
        ?>
    <main>
        <section>
            <div class="container mt-5 pt-5">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-9 col-md-7">
                        <div class="card border-0 shadow">
                            <div class="card-body d-flex flex-column align-items-center">
                            <?php
                                // Retrieve the selected room from the URL
                                $selectedRoom = isset($_GET['room']) ? $_GET['room'] : '';

                                // Create an array of rooms for the dropdown
                                $rooms = ['Room 1', 'Room 2', 'Room 3']; // Add more rooms if needed // Change Name of Room in home.php <a href=RoomName> too!!

                                // Date Validation + "Keep Variables" after Invalid Validation
                                $datevalidation = "";
                                if (isset($_COOKIE["datevalidation"]) && "invalid" === $_COOKIE["datevalidation"]) {
                                    $datevalidation = "is-invalid";
                                }
                                $departureDate = "";
                                if (isset($_SESSION["departureDate"])) {
                                    $departureDate = $_SESSION["departureDate"];
                                }
                                $arrivalDate = "";
                                if (isset($_SESSION["arrivalDate"])) {
                                    $arrivalDate = $_SESSION["arrivalDate"];
                                }
                                $choosenRoom = "";
                                if (isset($_SESSION["selectedRoom"])) {
                                    $choosenRoom = $_SESSION["selectedRoom"];
                                }
                                $withBreakfast = "";
                                if (isset($_SESSION["withBreakfast"])) {
                                    $choosenRoom = $_SESSION["withBreakfast"];
                                }
                                $withParking = "";
                                if (isset($_SESSION["withParking"])) {
                                    $choosenRoom = $_SESSION["withParking"];
                                }
                                $withPets = "";
                                if (isset($_SESSION["withPets"])) {
                                    $choosenRoom = $_SESSION["withPets"];
                                }
                            ?>
                                <form action="logic/booking.php" method="post">
                                <div class="mb-3">
                                        <label for="selectedRoom">Select Room:</label>
                                        <select name="selectedRoom" class="form-select" required>
                                            <?php
                                                // Generate options for each room
                                                // Check if a room is saved in the session and add it to the options 
                                                foreach ($rooms as $room) {
                                                $selected = ($room == $selectedRoom) ? 'selected' : '';          // change choosenRoom to selectedRoom, if "keep variables" feature is disabled
                                                echo "<option value=\"$room\" $selected>$room</option>";
                                                }
                                            ?>
                                        </select>
                                    </div> 
                                    <div class="mb-3">
                                        <label for="arrivalDate">Arrival Date:</label>
                                        <input type="date" class="form-control smaller-input" name="arrivalDate" min="1900-01-01" max="2150-12-31" <?php echo 'value="' .$arrivalDate. '"' ?> required>
                                    </div>
                                    <div classa="mb-6 text-center">
                                        <label for="departureDate"class="form-label">Departure Date:</label>
                                        <input type="date" class="form-control smaller-input <?php echo $datevalidation ?>" name="departureDate" pattern="\d{4}" <?php echo 'value="' .$departureDate. '"' ?> required>
                                        <div class="invalid-feedback"> Departure Date can't be before Arrival Date </div>
                                    </div>
                                    <div class="mb-3 mt-4">
                                        <label for="withBreakfast">With Breakfast:</label>
                                        <input type="checkbox" name="withBreakfast" <?php echo 'value="' .$withBreakfast. '"' ?>>
                                    </div>
                                    <div class="mb-3">
                                        <label for="withParking">With Parking:</label>
                                        <input type="checkbox" name="withParking" <?php echo 'value="' .$withParking. '"' ?>>
                                    </div>    
                                    <div class="mb-3">
                                        <label for="withPets">With Pets:</label>
                                        <input type="checkbox" name="withPets"  <?php echo 'value="' .$withPets. '"' ?>>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <button class="btn btn-primary" type="submit" name="bookRoom">Book Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    </main>



    <?php include 'components/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
     </body>

</html>