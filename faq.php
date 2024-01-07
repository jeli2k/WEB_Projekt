<?php
require_once("data/dbaccess.php");
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <?php include 'includes/head.php'; ?>
    <link href="override.css" rel="stylesheet">
    <title>FAQ</title>
</head>
<body>
    <nav>
       <?php include 'components/navbar.php'; ?> 
    </nav>

    <main class="container my-4">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="mb-4">Frequently Asked Questions - FAQ</h1>
                <hr>

            
                <div id="accordion">
                    <!-- Section 1 -->
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Accommodation - Search
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <h4>How do I search for a suitable hotel or apartment for my stay?</h4>
                                <p>It is very easy. First, enter the name of your destination/hotel including the stay dates in the blue "search field". Then simply click on the red "Search" button. Immediately all available rooms will be displayed, including the prices for the entire stay (number of nights previously specified). You can also use our filters for more specific accommodation desires, such as room price, star rating, hotel type, amenities, etc. At the top of the page, you can also sort the accommodations by popularity, room price, guest rating, and distance to the center. You can also select a suitable accommodation on the map on our homepage - all hotels are listed there along with the main attractions. This is helpful if you do not know the destination well but want to stay near a certain attraction.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2 -->
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Accommodation - Types of Rooms / Facilities / Services
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <h4>How do I find out what facilities/services each hotel offers?</h4>
                                <p>Please take a look at the "Hotel Basic Information" section. This section also includes information about check-in/out. Hotel facilities/services are listed in the hotel basic information, right under the offer of available rooms. Please note that some of the facilities may be located outside of the hotel and may incur additional costs.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3 -->
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Booking Process
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                <h4>How do I book accommodation?</h4>
                                <p>A booking is only possible by filling out the reservation form on our website. Please select the dates of your stay and the type of room you have chosen. The system will show you the price for the accommodation (always check the room conditions). If you agree with the total price and the booking conditions, simply click on the red "Book Now" button, and the reservation form will be displayed. Once you have completed and clicked on the "Book Now" button on the order form, your reservation will be confirmed to your email address shortly thereafter.</p>
                                <h4>How do I know that my reservation is confirmed?</h4>
                                <p>After completing and sending the order form, you will automatically receive a confirmation email with your order number. Within 30 minutes, you will receive a confirmation of your accommodation. The accommodation booking confirmation serves as your voucher, so do not forget to print it out and take it with you as it contains all the important details (address of your hotel, contact phone numbers, and other instructions). If you have specified special requests in your order form, such as an extra bed, a non-smoking room, parking, etc., always check directly with the hotel whether your request has been noted and whether it can be arranged for you.</p>
                                <h4>Can I book your services by phone, email, or fax?</h4>
                                <p>Unfortunately not. If you would like to make a booking, please fill out the order form on our website.</p>
                                <h4>I have made a reservation but have not received a confirmation. What should I do?</h4>
                                <p>Before you complete your reservation, please check your email address, as an error in the email address is the most common reason why our customers do not receive their confirmations. In some cases, our emails may also end up in the "Spam folder", so please check it as well. In any case, please try to contact us by email, as we are happy to help and solve the problem as quickly as possible.</p>
                                <p>How many rooms can I book at the same time? You can book as many rooms as are available for the selected period.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4 -->
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Changing a Booking / Cancellation
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body">
                                <h4>How do I cancel my booking?</h4>
                                <p>Please click on the link provided in the accommodation booking confirmation and cancel your reservation.</p>
                                <h4>How do I know that my reservation is canceled?</h4>
                                <p>If your reservation has been canceled, you will receive a cancellation confirmation from us. If you do not hear from us within 30 minutes, please contact us in another way (by email).</p>
                                <h4>What are the cancellation conditions? Until when can I change the booking without a fee?</h4>
                                <p>Each room has its own cancellation conditions, and this information is always found in the room conditions. Generally, your reservation can be canceled or changed a few days before your arrival. However, there are some exceptions, such as "Non-refundable" or "Special Conditions" rooms. You can check the room conditions via the room type.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <?php include 'components/footer.php'; ?>
    </footer>
    <?php include 'includes/scripts.php'; ?>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
