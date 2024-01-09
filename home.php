<?php
require_once("data/dbaccess.php");
require_once("data/dbfunctions.php");
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <?php include 'includes/head.php'; ?>
        <?php
        // clear datevalidation cookie
        setcookie("datevalidation", "", time() - 3600, "/");

        // unset the session variables related to booking when a new room is selected
        unset($_SESSION["arrivalDate"]);
        unset($_SESSION["departureDate"]);
        unset($_SESSION["withBreakfast"]);
        unset($_SESSION["withParking"]);
        unset($_SESSION["withPets"]);
        unset($_SESSION["selectedRoom"]);
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
            width: 100%;
            height: 240px;
            object-fit: cover;
            }

            body {
                background: linear-gradient(
                    to bottom, 
                    rgba(240, 240, 240, 0.7) 0%, 
                    rgba(204, 204, 204, 0.9) 50%, 
                    rgba(255, 255, 255, 1) 100%
                ), 
                url('uploads/news/background.jpg');
                background-size: cover;
                background-position: top center;
                background-repeat: no-repeat;
            }

        </style>
    </head>

    <body>
        <nav>
        <?php
            include 'components/navbar.php';
        ?>
        </nav>
                <div class="row">
                    <div class="col-md-12 text-center mb-3">
                        <div class="alert alert-info" role="alert">
                            <?php
                            if ($loggedIn === true) {
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
                                echo '<a href="booking.php?room=' . urlencode($room['title']) . '&roomId=' . urlencode($room['id']) . '" class="btn btn-primary">Book Now</a>';
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
                <section>
                    <div class="container my-4">
                        <div class="row">
                        <?php
                        foreach (findAllNews() as $news) {
                            echo '<div class="col-md-4 mb-3">';
                            echo '<div class="card">';

                            // display image if available
                            $imagePath = isset($news['image_url']) ? $news['image_url'] : '';
                            $imageName = pathinfo($imagePath, PATHINFO_FILENAME);
                            if (!empty($imagePath) && file_exists($imagePath)) {
                                echo '<img src="' . $imagePath . '" class="card-img-top" alt="' . $imageName . '">';
                            } else {
                                echo '<img src="uploads/news/default_news_image.png" class="card-img-top" alt="Default News Image">';
                            }

                            echo '<div class="card-body">';
                            
                            // add news form if user is admin
                            if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                                echo '<form enctype="multipart/form-data" method="post" action="logic/upload.php">';
                                echo '<input type="hidden" name="news_id" value="' . $news['id'] . '">';
                                echo '<input type="file" name="image" id="image">';
                                echo '<input type="submit" value="Upload" name="submit">';
                                echo '</form>';
                            }
                            
                            echo '<h5 class="card-title">' . $news['title'] . '</h5>';
                            echo '<p class="card-text">' . $news['text'] . '</p>';
                            echo '<span>' . "Upload-Date: " . $news['date'] . '</span>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                        </div>
                    </div>
                </section>
                

        <!-- ADMIN ONLY: Adding News -->
                <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
                    <section>
                        <div class="container my-4">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Add new News-Article</h3>
                                            <form method="post" action="data/savenews.php" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="text" name="title" id="title" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="text" class="form-label">Text</label>
                                                    <input type="text" name="text" id="text" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Image</label>
                                                    <input type="file" name="image" id="image" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="submit" value="Save News" class="btn btn-primary">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </section>

                <!-- ADMIN ONLY: Adding Rooms -->
                <section>
                    <div class="container my-4">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Add new Room</h3>
                                        <form method="post" action="data/saveroom.php" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" name="title" id="title" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="text" class="form-label">Text</label>
                                                <input type="text" name="text" id="text" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="price" class="form-label">Price</label>
                                                <input type="text" name="price" id="price" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Image</label>
                                                <input type="file" name="image" id="image" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <input type="submit" value="Save Room" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php endif; ?>

            </main>    

        <footer>
           <?php include 'components/footer.php'; ?> 
        </footer>
        <?php include 'includes/scripts.php'; ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>


