<?php
require_once("data/dbaccess.php");
require_once("data/dbfunctions.php");
?>
<?php
                // check if userId is provided in the URL
                if (isset($_GET['userId'])) {
                    $userId = $_GET['userId'];

                    // additional code to retrieve bookings for the specified user ID
                    $bookings = findBookingsByUserId($userId);
                } else {
                    // handle the case where no user ID is provided
                    $bookings = [];
                }
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <?php include 'includes/head.php'; ?>
    <link href="override.css" rel="stylesheet">
    <title>Booking Details</title>
    <?php
    // Check if the user is not logged in
    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
        header("Location: login.php");
        exit();
    }
    ?>
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }
        .table-responsive {
            overflow-x: auto;
        }

        table {
            min-width: 1200px;
        }
    </style>
</head>

<body>

    <?php include 'components/navbar.php'; ?>

    <main>
        <div class="container mt-5">
            <?php if (!empty($bookings)): ?>
            <h1 class="mb-4">Bookings made by: <?php echo $bookings[0]['user_firstname'] . ' ' . $bookings[0]['user_lastname']; ?></h1>
            <?php else: ?>
                <h1 class="mb-4">No bookings found for the specified user</h1>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Booking ID</th>
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
                                <td>
                                    <a href="details.php?bookingId=<?php echo $booking['id']; ?>" class="btn btn-outline-dark" style="background-color: white; color: black;">
                                        <strong><?php echo $booking['id']; ?></strong>
                                    </a>
                                </td>
                                <td><?php echo $booking['room_title']; ?></td>
                                <td><?php echo date("d.m.Y", strtotime($booking['arrival_date'])); ?></td>
                                <td><?php echo date("d.m.Y", strtotime($booking['departure_date'])); ?></td>
                                <td><?php echo $booking['with_breakfast'] ? 'Yes' : 'No'; ?></td>
                                <td><?php echo $booking['with_parking'] ? 'Yes' : 'No'; ?></td>
                                <td><?php echo $booking['with_pets'] ? 'Yes' : 'No'; ?></td>
                                <td><?php echo $booking['status']; ?></td>
                                <td><?php echo $booking['user_firstname']; ?></td>
                                <td><?php echo $booking['user_lastname']; ?></td>
                                <td><?php echo $booking['user_email']; ?></td>
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