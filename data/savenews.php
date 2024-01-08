<?php
require_once("dbaccess.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // TODO: Validation

    // Handle file upload
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "uploads/news//";
        $uploadPath = $uploadDir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "../" . $uploadPath); // Keep "../" here if the target directory is one level above
        $imagePath = $uploadPath;
    } else {
        $imagePath = "uploads/news/default_news_image.png";
    }

    saveNews($_POST["title"], $_POST["text"], $imagePath);
}
header("Location: ../home.php");
?>
