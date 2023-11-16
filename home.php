<!DOCTYPE html>
<html lang="de">
    <head>
        <?php include 'includes/head.php'; ?>
        <link href="override.css" rel="stylesheet">
        <title>Home</title>
        
    </head>

    <body>
        <header>
            
        </header>

        <?php
            include 'components/navbar.php';
        ?>
    <main>
        <!-- If user is logged in: -->
        <?php if (isset($_SESSION['email']) && $_SESSION['email'] === 'admin@admin.com' && $_SESSION['pw'] === 'admin'): ?>
        <section>
            <div class="container mt-5">
                <div class="row">
                    <!-- Room 1 -->
                    <div class="col-md-4 mb-4">
                        <div class="card text-center">
                            <img src="Content/room1.jpg" class="card-img-top" alt="Room 1 Image">
                            <div class="card-body">
                                <h5 class="card-title">Room 1</h5>
                                <p class="card-text">Description of Room 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <a href="booking.php?room=Room 1" class="btn btn-primary">Book Now</a>
        
                                        
                            </div>
                        </div>
                    </div>

                    <!-- Room 2 -->
                    <div class="col-md-4 mb-4">
                        <div class="card text-center">
                            <img src="Content/room2.jpg" class="card-img-top" alt="Room 2 Image">
                            <div class="card-body">
                                <h5 class="card-title">Room 2</h5>
                                <p class="card-text">Description of Room 2. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <a href="booking.php?room=Room 2" class="btn btn-primary">Book Now</a>

                            </div>
                        </div>
                    </div>

                    <!-- Room 3 -->
                    <div class="col-md-4 mb-4">
                        <div class="card text-center">
                            <img src="Content/room3.jpg" class="card-img-top" alt="Room 3 Image">
                            <div class="card-body">
                                <h5 class="card-title">Room 3</h5>
                                <p class="card-text">Description of Room 3. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <a href="booking.php?room=Room 3" class="btn btn-primary">Book Now</a>
                                <!-- form instead of <a>? Test for Checkout System -->
                                <!--
                                <form method="post" action="logic/checkout.php">
                                    <input type="hidden" name="reserveRoom" value="Room3">
                                    <button type="submit" class="btn btn-primary">Book 1 now</button>
                                </form>
                                -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
       
        
    </main>



    <?php include 'components/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
     </body>

</html>