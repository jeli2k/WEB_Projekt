<?php
require_once("dbaccess.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // TODO: Validation

    // Handle file upload
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "../Content/";
        $uploadPath = $uploadDir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);
        $imagePath = $uploadPath;
    }

    saveNews($_POST["title"], $_POST["text"], $imagePath);
}
header("Location: ../home.php");
?>


<?php
/*
require_once("dbaccess.php");

if ("POST" === $_SERVER["REQUEST_METHOD"]) {
    // TODO: Validation
    saveNews($_POST["title"], $_POST["text"]);
}
header("Location: ../home.php");

?>

