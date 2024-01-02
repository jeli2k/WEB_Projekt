<?php
require_once("data/dbaccess.php");

?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <?php include 'includes/head.php'; ?>
        <?php
        

        // check if the user is logged in
        $loggedIn = false;
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
            $loggedIn = true;
            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $userData = findUserByEmail($email);
            
                // check if user data retrieved succesfully
                if ($userData !== null) {
                    $firstname = $userData['firstname'];
                }
            }
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
                                // TODO: Register all Content and display firstname from database here.
                                echo "<a>Hello, " . htmlspecialchars($firstname) . "!</a>";
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
                <?php if ($loggedIn === true): ?>
    <!-- Rooms -->
                <section>
                    <div class="container mt-5">
                        <div class="row">
                            <?php
                            foreach (findAllRooms() as $room) {
                                echo '<div class="col-md-4 mb-4">';
                                echo '<div class="card text-center">';
                                echo '<img src="' . $room['image_url'] . '" class="card-img-top" alt="' . $room['title'] . ' Image">';
                                echo '<div class="card-body">';
                                echo '<h5 class="card-title">' . $room['title'] . '</h5>';
                                echo '<p class="card-text">' . $room['text'] . '</p>';
                                echo '<p class="card-text">Price: $' . number_format($room['price'], 2) . '</p>';
                                echo '<a href="booking.php?room=' . urlencode($room['title']) . '" class="btn btn-primary">Book Now</a>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </section>

                <?php endif; ?>
<!-- If user is not logged in, display news -->
    <!-- News -->
                <div class="container my-4">
                    <div class="row">
                        <?php
                        foreach (findAllNews() as $news) {
                            echo '<div class="col-md-4 mb-3">';
                            echo '<div class="card">';

                            // display image if available
                            if (isset($news['image_url']) && !empty($news['image_url']) && file_exists($news['image_url'])) {
                                echo '<img src="' . $news['image_url'] . '" class="card-img-top" alt="News Image">';
                            } else {
                                echo '<img src="Content/default_news_image.png" class="card-img-top" alt="Default News Image">';
                            }

                            echo '<div class="card-body">';
                            
                            // add news form if user is admin
                            if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                                echo '<form enctype="multipart/form-data" method="post" action="logic/upload.php">';
                                echo '<input type="file" name="image" id="image">';
                                echo '<input type="submit" value="Upload" name="submit">';
                                echo '</form>';
                            }
                            
                            echo '<h5 class="card-title">' . $news['title'] . '</h5>';
                            echo '<p class="card-text">' . $news['text'] . '</p>';
                            echo '<span>' . $news['date'] . '</span>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>

        <!-- ADMIN ONLY: Adding News -->
                <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
                    <h3>Add new News</h3>
                    <form method="post" action="data/savenews.php" enctype="multipart/form-data">
                        <div>
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title">
                        </div>
                        <div>
                            <label for="text">Text</label>
                            <input type="text" name="text" id="text">
                        </div>
                        <div>
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image">
                        </div>
                        <div>
                            <input type="submit" value="Save News">
                        </div>
                    </form>

                <!-- ADMIN ONLY: Adding Rooms -->
                <h3>Add new Room</h3>
                <form method="post" action="data/saveroom.php" enctype="multipart/form-data">
                    <div>
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title">
                    </div>
                    <div>
                        <label for="text">Text</label>
                        <input type="text" name="text" id="text">
                    </div>
                    <div>
                        <label for="price">Price</label>
                        <input type="text" name="price" id="price">
                    </div>
                    <div>
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image">
                    </div>
                    <div>
                        <input type="submit" value="Save Room">
                    </div>
                </form>

                <?php endif; ?>

            </main>    


        <?php include 'components/footer.php'; ?>
        <?php include 'includes/scripts.php'; ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>


