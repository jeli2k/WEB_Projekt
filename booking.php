<!-- booking.php -> logic/booking.php -> confirmation.php -->
<?php
require_once("data/dbaccess.php");
?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <?php include 'includes/head.php'; ?>
        <?php
        // Check if the user is not logged in
        if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
            header("Location: login.php");
            exit();
        }
        ?>
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
                .price-text {
                    color: #999; /* Light gray color */
                    margin-left: 10px; /* Adjust the margin as needed */
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
                                // Check if a room is selected in the form submission
                                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedRoom'])) {
                                    $selectedRoom = $_POST['selectedRoom'];
                                    // Save the selected room in the session immediately after form submission
                                    $_SESSION['selectedRoom'] = $selectedRoom;
                                } elseif (isset($_GET['room']) && !isset($_POST['bookRoom'])) {
                                    // Set the selected room to the room from the URL only if the form is not submitted
                                    $_SESSION['selectedRoom'] = $_GET['room'];
                                }

                                // Retrieve the selected room from the session
                                $selectedRoom = isset($_SESSION['selectedRoom']) ? $_SESSION['selectedRoom'] : '';

                                // Fetch rooms from the database
                                $roomsFromDB = findAllRooms();

                                // Debugging output to trace the value of $selectedRoom
                                // echo "selectedRoom (before validation): $selectedRoom<br>";

                                // Date Validation + "Keep Variables" after Invalid Validation
                                $datevalidation = "";
                                if (isset($_COOKIE["datevalidation"]) && "invalid" === $_COOKIE["datevalidation"]) {
                                    $datevalidation = "is-invalid";
                                }
                                // Debugging output to trace the value of $_SESSION['selectedRoom'] during validation
                                // echo "selectedRoom (during validation): " . $_SESSION['selectedRoom'] . "<br>";

                                $departureDate = "";
                                if (isset($_SESSION["departureDate"])) {
                                    $departureDate = $_SESSION["departureDate"];
                                }
                                $arrivalDate = "";
                                if (isset($_SESSION["arrivalDate"])) {
                                    $arrivalDate = $_SESSION["arrivalDate"];
                                }
                                $withBreakfast = "";
                                if (isset($_SESSION["withBreakfast"])) {
                                    $withBreakfast = $_SESSION["withBreakfast"];
                                }
                                $withParking = "";
                                if (isset($_SESSION["withParking"])) {
                                    $withParking = $_SESSION["withParking"];
                                }
                                $withPets = "";
                                if (isset($_SESSION["withPets"])) {
                                    $withPets = $_SESSION["withPets"];
                                }
                                $selectedRoom = isset($_SESSION["selectedRoom"]) ? $_SESSION["selectedRoom"] : ''; // Ensure $selectedRoom is not empty
                                ?>
                                <form action="logic/booking.php" method="post">
                                    <div class="mb-3">
                                    <label for="selectedRoom">Select Room:</label>
                                    <select name="selectedRoom" class="form-select" required>
                                        <?php
                                        // fetch rooms
                                        $roomsFromDB = findAllRooms();

                                        // identify the selected room
                                        $selectedRoomId = null;
                                        foreach ($roomsFromDB as $room) {
                                            if ($room['title'] === $selectedRoom) {
                                                $selectedRoomId = $room['id'];
                                                break;
                                            }
                                        }

                                        // generate options for each room
                                        foreach ($roomsFromDB as $room) {
                                            $roomId = $room['id'];
                                            $roomTitle = $room['title'];
                                            $selected = ($roomId == $selectedRoomId) ? 'selected' : '';

                                            echo "<option value=\"$roomId\" $selected>$roomTitle</option>";
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
                                        <input type="checkbox" name="withBreakfast" data-price="40" <?php echo $withBreakfast ? 'checked' : ''; ?>>
                                        <span class="price-text">(+40€)</span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="withParking">With Parking:</label>
                                        <input type="checkbox" name="withParking" data-price="50" <?php echo $withParking ? 'checked' : ''; ?>>
                                        <span class="price-text">(+50€)</span>
                                    </div>    
                                    <div class="mb-3">
                                        <label for="withPets">With Pets:</label>
                                        <input type="checkbox" name="withPets" data-price="30"  <?php echo $withPets ? 'checked' : ''; ?>>
                                        <span class="price-text">(+30€)</span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="currentPrice">Current Price:</label>
                                        <?php
                                            // fetch the current room's price
                                            $currentRoomPrice = getCurrentRoomPrice($selectedRoomId);

                                            // calculate the total price based on selected options
                                            $totalPrice = calculateTotalPrice($currentRoomPrice, $withBreakfast, $withParking, $withPets);

                                            // display the total price
                                            echo '<input type="text" class="form-control" name="currentPrice" value="' . number_format($totalPrice, 2) . ' €" readonly>'; // display in euros
                                        ?>
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