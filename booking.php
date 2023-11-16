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
            
        </header>

        <?php
            include 'components/navbar.php';
        ?>
    <main>
        <section>
            <div class="container mt-5 pt-5">
                <div class="col-12 col-sm-9 col-md-7 m-auto">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                        <?php
                            // Retrieve the selected room from the URL
                            $selectedRoom = isset($_GET['room']) ? $_GET['room'] : '';

                            // Create an array of rooms for the dropdown
                            $rooms = ['Room 1', 'Room 2', 'Room 3']; // Add more rooms if needed // Change Name of Room in home.php <a href=RoomName> too!!
                        ?>
                            <form action="logic/booking.php" method="post">
                               <div class="mb-3">
                                    <label for="selectedRoom">Select Room:</label>
                                    <select name="selectedRoom" class="form-select" required>
                                        <?php
                                            // Generate options for each room
                                            foreach ($rooms as $room) {
                                                $selected = ($room == $selectedRoom) ? 'selected' : '';
                                                echo "<option value=\"$room\" $selected>$room</option>";
                                            }
                                        ?>
                                        <!--<option value="room1">Room 1</option>-->
                                        <!-- Add options for other rooms if needed -->
                                    </select>
                                </div> 
                                <div class="mb-3">
                                    <label for="arrivalDate">Arrival Date:</label>
                                    <input type="date" name="arrivalDate" min="1900-01-01" max="2150-12-31" required>
                                </div>
                                <div classa="mb-3">
                                    <label for="departureDate">Departure Date:</label>
                                    <input type="date" name="departureDate" pattern="\d{4}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="withBreakfast">With Breakfast:</label>
                                    <input type="checkbox" name="withBreakfast">
                                </div>
                                <div class="mb-3">
                                    <label for="withParking">With Parking:</label>
                                    <input type="checkbox" name="withParking">
                                </div>    
                                <div class="mb-3">
                                    <label for="withPets">With Pets:</label>
                                    <input type="checkbox" name="withPets">
                                </div>
                                <button type="submit" name="bookRoom">Book Now</button>
                            </form>
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