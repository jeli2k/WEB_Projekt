<?php
require_once("data/dbaccess.php");
require_once("data/dbfunctions.php");

function findAllBookingsWithRoomNames() {
    global $db;

    $sql = "SELECT bookings.*, userdata.firstname, userdata.lastname, userdata.email, rooms.title AS room_title 
            FROM bookings 
            JOIN userdata ON bookings.user_id = userdata.id
            JOIN rooms ON bookings.room_id = rooms.id";
    $result = $db->query($sql);

    $bookings = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }
    }

    return $bookings;
}

$bookings = findAllBookingsWithRoomNames();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <?php include 'includes/head.php'; ?>
    <link href="override.css" rel="stylesheet">
    <title>Booking Management</title>
    <?php
        // Check if the user is not logged in
        if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
            header("Location: login.php");
            exit();
        }
    ?>
</head>
<body>

    <?php include 'components/navbar.php'; ?>

    <main>   
        <div class="container mt-5">
            <h1 class="mb-4">Booking Management</h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Room</th>
                            <th>Arrival Date</th>
                            <th>Departure Date</th>
                            <th>Breakfast</th>
                            <th>Parking</th>
                            <th>Pets</th>
                            <th>Status</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Status Change</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td><?php echo $booking['room_title']; ?></td>
                                <td><?php echo date("d.m.Y", strtotime($booking['arrival_date'])); ?></td>
                                <td><?php echo date("d.m.Y", strtotime($booking['departure_date'])); ?></td>
                                <td><?php echo $booking['with_breakfast'] ? 'Yes' : 'No'; ?></td>
                                <td><?php echo $booking['with_parking'] ? 'Yes' : 'No'; ?></td>
                                <td><?php echo $booking['with_pets'] ? 'Yes' : 'No'; ?></td>
                                <td><?php echo $booking['status']; ?></td>
                                <td><?php echo $booking['firstname']; ?></td>
                                <td><?php echo $booking['lastname']; ?></td>
                                <td><?php echo $booking['email']; ?></td>
                                <td>
                                    <form action="data/updateBookingStatus.php" method="post">
                                        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                        <select name="status" onchange="this.form.submit()">
                                            <option value="new" <?php echo $booking['status'] == 'new' ? 'selected' : ''; ?>>New</option>
                                            <option value="confirmed" <?php echo $booking['status'] == 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                                            <option value="cancelled" <?php echo $booking['status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <footer>
      <?php include 'components/footer.php'; ?>  
    </footer>
    <?php include 'includes/scripts.php'; ?>
</body>
</html>
