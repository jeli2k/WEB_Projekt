<!DOCTYPE html>
<html lang="de">
    <head>
        <?php include 'includes/head.php'; ?>
        <?php
        

        // Check if the user is logged in
        $loggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true;
        $username = $loggedIn ? $_SESSION['userData']['name'] : '';
        ?>
        
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
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
                                echo '<a>To book rooms please <a href="register.php" class="alert-link">register here</a>.';
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

                <div class="container my-4">
                    <div class="row">
                        
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="Content/Culinary.jpg" class="card-img-top" alt="Culinary">
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

                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="Content/Spa.jpg" class="card-img-top" alt="Spa">
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

                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="Content/Festival.jpg" class="card-img-top" alt="Festival">
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


