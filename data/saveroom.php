<?php
require_once("dbaccess.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // TODO: Validation

    // Pass the $_FILES array for the image upload
    saveRoom($_POST["title"], $_POST["text"], $_POST["price"], $_FILES["image"]);
}

header("Location: ../home.php");
?>