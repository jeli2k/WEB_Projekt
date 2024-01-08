<?php
require_once("dbaccess.php");
require_once("dbfunctions.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // TODO: Validation

    // set default image URL
    $defaultImageUrl = "uploads/news/default_news_image.png";

    // check if an image is uploaded
    if (isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"])) {
        // validate image file type
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

        if (in_array($imageExtension, $allowedExtensions)) {
            // upload the image
            $targetDirectory = "uploads/news/";
            $imageName = basename($_FILES["image"]["name"]);
            $targetFilePath = $targetDirectory . $imageName;
            move_uploaded_file($_FILES["image"]["tmp_name"], "../" . $targetFilePath);

            // set the image URL to the uploaded image path
            $imageUrl = $targetFilePath;
        } else {
            // invalid image type, use default image URL
            $imageUrl = $defaultImageUrl;
        }
    } else {
        // No image uploaded, use default image URL
        $imageUrl = $defaultImageUrl;
    }

    saveNews($_POST["title"], $_POST["text"], $imageUrl);
}

header("Location: ../home.php");
?>
