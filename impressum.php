<?php
require_once("data/dbaccess.php");
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <?php include 'includes/head.php'; ?>
    <link href="override.css" rel="stylesheet">
    <style>
        .rounded-img {
            width: 150px; /* Adjust the width as needed */
            height: 150px; /* Adjust the height as needed */
            object-fit: cover; /* Ensures the image covers the area without distortion */
            border-radius: 50%; /* Makes the image round */
        }
    </style>
    <title>Impressum</title>
</head>
<body>
    <nav>
       <?php include 'components/navbar.php'; ?> 
    </nav>

    <main class="container my-4">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="mb-4">Impressum</h1>

                <section class="mb-3">
                    <p>Sargsyan Jelinek & Partners</p>
                    <p>Hochstädtplatz 6</p>
                    <p>1200 Wien</p>
                    <p>Phone: +43 12345678</p>
                    <p>E-Mail: wi22b067@technikum-wien.at</p>
                </section>

                <section class="mb-3">
                    <p style="margin-bottom: 70px">Sargsyan Jelinek & Partners is represented by the personally liable partner:<br> Sargsyan Jelinek & Partners GmbH, Tulln, FN 251845</p>
                    <div class="row">
                        <div class="col-md-6 mb-3 text-center">
                            <img src="./Content/Hayk.jpg" alt="Hayk" title="Hayk" class="rounded-img img-fluid mb-2">
                            <p class="lead">Managing Director Hayk Sargsyan</p>
                        </div>
                        <div class="col-md-6 mb-3 text-center">
                            <img src="./Content/Fabian_Jelinek.jpg" alt="Fabian Jelinek" title="Fabian Jelinek" class="rounded-img img-fluid mb-2">
                            <p class="lead">Managing Director Fabian Jelinek</p>
                        </div>
                    </div>
                    <p style="margin-top: 50px">Commercial Court: Regional Court St. Pölten</p>
                    <p>Commercial Register Number: FN 251845</p>
                </section>
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
