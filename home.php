<!DOCTYPE html>
<html lang="de">
    <head>
        <?php include 'includes/head.php'; ?>
        <?php
        

        // Check if the user is logged in
        $loggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true;
        if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
            $username = "admin";
        } else {
            $username = $loggedIn ? $_SESSION['userData']['name'] : '';
        }
        ?>
        
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="override.css" rel="stylesheet">
        <title>Home</title>
        
        <style>
            .news-container {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                margin: 20px;
            }

            .news-article {
                flex: 1;
                padding: 10px;
                box-sizing: border-box;
            }

            @media (max-width: 768px) {
                .news-container {
                    flex-direction: column;
                }
            }
            .card-img-top {
            width: 100%; /* Adjust the width as needed */
            height: 240px; /* Adjust the height as needed */
            object-fit: cover; /* Maintain aspect ratio and cover the entire container */
            }
        </style>
    </head>

    <body>
        <header>
            
        </header>

        <?php
            include 'components/navbar.php';
        ?>
    
        <!-- Navbar nicht responsive für Handy, und echo muss noch mit html code -->
                <div class="row">
                    <div class="col-md-12 text-center mb-3">
                        <div class="alert alert-info" role="alert">
                            <?php
                            if ($loggedIn === true) {
                                echo "<a>Hello, " . htmlspecialchars($username) . "!</a>";
                            } else {
                                echo '<a>To book rooms please <a href="register.php" class="alert-link">register here </a>.';
                                echo ' <a> If you already are a user <a href="login.php" class="alert-link">you can login here</a>.';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            
            <main>
                <!-- If user is logged in: -->
                <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true): ?>
                <section>
                    <div class="container mt-5">
                        <div class="row">
                            <!-- Room 1 -->
                            <div class="col-md-4 mb-4">
                                <div class="card text-center">
                                    <img src="Content/room1.jpg" class="card-img-top" alt="Culinary">
                                    <div class="card-body">
                                        <h5 class="card-title">Serenity Skyline Suite</h5>
                                        <p class="card-text">Perched high above the city, the Serenity Skyline Suite offers breathtaking panoramic views. The suite features a spacious living area with floor-to-ceiling windows, a plush king-sized bed, and a state-of-the-art entertainment system. Elegantly designed with a blend of modern and classic decor.</p>
                                        <a href="booking.php?room=Serenity Skyline Suite" class="btn btn-primary">Book Now</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Room 2 -->
                            <div class="col-md-4 mb-4">
                                <div class="card text-center">
                                    <img src="Content/room2.jpg" class="card-img-top" alt="Room 2 Image">
                                    <div class="card-body">
                                        <h5 class="card-title">Ocean Whisper Bungalow</h5>
                                        <p class="card-text">Nestled on the edge of a pristine beach, the Ocean Whisper Bungalow provides a tranquil seaside escape. This bungalow boasts a private balcony overlooking the ocean, a cozy, canopy-style queen bed, and a luxurious bathroom with a rain shower. Enjoy the soothing sound of the waves and the gentle sea breeze. </p>
                                        <a href="booking.php?room=Ocean Whisper Bungalow" class="btn btn-primary">Book Now</a>

                                    </div>
                                </div>
                            </div>

                            <!-- Room 3 -->
                            <div class="col-md-4 mb-4">
                                <div class="card text-center">
                                    <img src="Content/room3.jpg" class="card-img-top" alt="Room 3 Image">
                                    <div class="card-body">
                                        <h5 class="card-title">Sunset Serenade Studio</h5>
                                        <p class="card-text">Overlooking the western horizon, the Sunset Serenade Studio is designed for those who love to watch the day end with a spectacular view. The studio is equipped with floor-to-ceiling windows, a cozy queen-size bed, and a modern, minimalistic decor that complements the natural beauty of the sunset.</p>
                                        <a href="booking.php?room=Sunset Serenade Studio" class="btn btn-primary">Book Now</a>
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
                <!-- News -->
                <div class="container my-4">
                    <div class="row">
                        <!-- News 1 -->
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <?php
                                $uploadKey = 'uploadPath_news' . 1; // TODO: loop, doesnt work yet so change numbers manually per news
                                    // Check if uploadPath is set in the session and if the file exists
                                    if (isset($_SESSION[$uploadKey])) {
                                        $uploadDir = substr($_SESSION[$uploadKey], 3); // entfernt ../ von Path
                                        //echo 'Session variable is set: ' . $_SESSION['uploadPath']; // Debug line
                                        if (file_exists($uploadDir)) {
                                            // Display the uploaded image
                                            echo '<img src="' . $uploadDir . '" class="card-img-top" alt="Room 1 Image">';
                                        } else {
                                            // Display a message if the file doesn't exist
                                            echo '<img src="Content/Culinary.jpg" class="card-img-top" alt="Room 1 Image">';
                                        }
                                    } else {
                                        // Display a message if $_SESSION['uploadPath'] is not set
                                        echo '<img src="Content/Culinary.jpg" class="card-img-top" alt="Room 1 Image">';
                                    }
                                ?>
                                <!-- If user is admin -->
                                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == true): ?> <!-- TODO: if user is admin -->
                                        <form enctype="multipart/form-data" method="post" action="logic/upload.php">
                                            <input type="file" name="news1" id="news1">
                                            <input type="submit" value="Upload" name="submit">
                                        </form> 
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title">Local Culinary Delights: Exploring the Best Eateries Near Our Hotel</h5>
                                <p class="card-text">Discover the gastronomic pleasures that await you just steps from our hotel. Our neighborhood is a treasure trove of culinary delights, featuring a diverse range of cuisines that cater to every palate. 
                                From the aromatic street food stalls offering local specialties to high-end restaurants serving international delicacies, there’s something for everyone. </p>
                                <p class="card-text">One can't-miss spot is Ristorante Tricolore renowned for its Classic Italian Pizza´s that perfectly encapsulates the local flavors. 
                                For those looking for a more global taste, Brasserie Julio offers an exquisite fusion menu that combines elements of Spanish and Mexican. 
                                Not only does our location offer a variety of dining options, but many of these eateries also offer exclusive discounts to our guests. 
                                So, whether you're craving a quick bite or a luxurious dining experience, our hotel is the perfect base for your culinary adventures. 
                                Don't forget to ask our front desk for personalized recommendations and the latest foodie tips!</p>
                                </div>
                            </div>
                        </div>
                        <!-- News 2 -->
                        <div class="col-md-4 mb-3">
                            <div class="card">
                            <?php
                                $uploadKey = 'uploadPath_news' . 2; // TODO: loop, doesnt work yet so change numbers manually per news
                                    // Check if uploadPath is set in the session and if the file exists
                                    if (isset($_SESSION[$uploadKey])) {
                                        $uploadDir = substr($_SESSION[$uploadKey], 3); // entfernt ../ von Path
                                        //echo 'Session variable is set: ' . $_SESSION['uploadPath']; // Debug line
                                        if (file_exists($uploadDir)) {
                                            // Display the uploaded image
                                            echo '<img src="' . $uploadDir . '" class="card-img-top" alt="Room 1 Image">';
                                        } else {
                                            // Display a message if the file doesn't exist
                                            echo '<img src="Content/Spa.jpg" class="card-img-top" alt="Room 1 Image">';
                                        }
                                    } else {
                                        // Display a message if $_SESSION['uploadPath'] is not set
                                        echo '<img src="Content/Spa.jpg" class="card-img-top" alt="Room 1 Image">';
                                    }
                            ?>
                                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == true): ?> <!-- TODO: if user is admin -->
                                        <form enctype="multipart/form-data" method="post" action="logic/upload.php">
                                            <input type="file" name="news2" id="news2">
                                            <input type="submit" value="Upload" name="submit">
                                        </form> 
                                <?php endif; ?>
                                <!--<img src="Content/Spa.jpg" class="card-img-top" alt="Spa">-->
                                <div class="card-body">
                                <h5 class="card-title">Unwind and Rejuvenate: Introducing Our New Spa and Wellness Center</h5>
                                <p class="card-text">We are thrilled to announce the opening of our new Spa and Wellness Center, a sanctuary designed for your ultimate relaxation and rejuvenation. 
                                Our state-of-the-art facility offers a wide range of services, from traditional massages and facials to innovative therapies that blend ancient techniques with modern wellness practices. </p>
                                <p class="card-text">  Our skilled therapists are trained in a variety of modalities, ensuring a personalized experience that caters to your specific needs. The highlight of our spa is the Thai Massage, an exclusive treatment that promises to transport you to a state of blissful tranquility.
                                In addition to spa services, our wellness center also features a fully equipped gym, a serene yoga studio, and a relaxing sauna. </p>
                                <p class="card-text">  Guests can also participate in our wellness programs, which include guided meditation sessions, fitness classes, and health workshops.
                                Whether you're seeking to de-stress, improve your fitness, or simply indulge in some pampering, our Spa and Wellness Center is your haven of tranquility. Book your appointment today and embark on a journey of wellness and relaxation.</p>
                                </div>
                            </div>
                        </div>
                        <!-- News 3 -->
                        <div class="col-md-4 mb-3">
                            <div class="card">
                            <?php
                                $uploadKey = 'uploadPath_news' . 3; // TODO: loop, doesnt work yet so change numbers manually per news
                                    // Check if uploadPath is set in the session and if the file exists
                                    if (isset($_SESSION[$uploadKey])) {
                                        $uploadDir = substr($_SESSION[$uploadKey], 3); // entfernt ../ von Path
                                        //echo 'Session variable is set: ' . $_SESSION['uploadPath']; // Debug line
                                        if (file_exists($uploadDir)) {
                                            // Display the uploaded image
                                            echo '<img src="' . $uploadDir . '" class="card-img-top" alt="Room 1 Image">';
                                        } else {
                                            // Display a message if the file doesn't exist
                                            echo '<img src="Content/Festival.jpg" class="card-img-top" alt="Room 1 Image">';
                                        }
                                    } else {
                                        // Display a message if $_SESSION['uploadPath'] is not set
                                        echo '<img src="Content/Festival.jpg" class="card-img-top" alt="Room 1 Image">';
                                    }
                            ?>
                                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == true): ?> <!-- TODO: if user is admin -->
                                        <form enctype="multipart/form-data" method="post" action="logic/upload.php">
                                            <input type="file" name="news3" id="news3">
                                            <input type="submit" value="Upload" name="submit">
                                        </form> 
                                <?php endif; ?>
                                <!--<img src="Content/Festival.jpg" class="card-img-top" alt="Festival">-->
                                <div class="card-body">
                                <h5 class="card-title">Experience Local Culture: Upcoming Events and Festivals Near Our Hotel</h5>
                                <p class="card-text">Immerse yourself in the vibrant local culture by participating in the exciting events and festivals happening near our hotel. Our city is a hub of cultural activities, offering a rich tapestry of experiences that showcase the local heritage, arts, and community spirit.
                                <p class="card-text">  This month, don't miss the Pumpkin Festival, a colorful celebration featuring parades, live music, and traditional dance performances. The festival is a fantastic opportunity to experience the local customs and enjoy the lively atmosphere.
                                Art enthusiasts will be delighted by the Modern Light Arts, showcasing the works of local artists and craftsmen. It's a perfect occasion to appreciate the creativity of our community and perhaps find a unique souvenir to take home.</p>
                                For those interested in more contemporary entertainment, the Phantom of the Opera Musical is a must-see. Featuring renowned performers and exciting new talents, it promises an evening of unforgettable entertainment.
                                Our hotel concierge is always ready to provide you with more information on these events, assist with tickets, and offer recommendations for other local attractions. Stay with us and be at the heart of all the cultural excitement!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>    


        <?php include 'components/footer.php'; ?>
        <?php include 'includes/scripts.php'; ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>


