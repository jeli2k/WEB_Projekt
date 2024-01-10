<?php
session_start();
require_once("../data/dbaccess.php");
require_once("../data/dbfunctions.php");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
    // Specify the upload directory
    $uploadDirectory = 'uploads/news/';

    // Check if the file is uploaded successfully
    if ($_FILES['image'] && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        // Check if the file is an actual image
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            // Check file size (limit to 10MB)
            if ($_FILES['image']['size'] <= 10 * 1024 * 1024) {
                // Check file format
                $allowedFormats = ['jpeg', 'jpg', 'png'];
                $fileFormat = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

                if (in_array($fileFormat, $allowedFormats)) {
                    // Generate a unique filename to avoid overwriting existing files
                    $imageName = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME) . '.' . $fileFormat;
                    $uploadPath = $uploadDirectory . $imageName;

                    if (move_uploaded_file($_FILES['image']['tmp_name'], '../' . $uploadPath)) {
                        resizeImage("../" . $uploadPath, 650, 360);
                        // Update the image_url for the existing news article
                        $newsId = $_POST['news_id'];
                        $image_url = $uploadPath;

                        $sql = "UPDATE `news` SET `image_url` = ? WHERE `id` = ?";
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("si", $image_url, $newsId);

                        if ($stmt->execute()) {
                            // Success message
                            echo "File successfully uploaded and data updated in the database.";
                            header("Location: ../home.php");
                            exit();
                        } else {
                            // Error message for database update failure
                            echo "Error updating data in the database.";
                        }
                        $stmt->close();
                    } else {
                        // Error message for file upload failure
                        echo "Error uploading file.";
                    }
                } else {
                    // Error message for invalid file format
                    echo "Invalid file format. Allowed formats: " . implode(', ', $allowedFormats);
                }
            } else {
                // Error message for file size limit exceeded
                echo "File size exceeds the limit (10MB)";
            }
        } else {
            // Error message for invalid image
            echo "File is not a valid image";
        }
    } else {
        // Error message for file upload failure
        echo "File upload failed. Please check the file and try again";
    }
} else {
    // Redirect to home.php if accessed directly without form submission or if the user is not admin
    header("Location: ../home.php");
    exit();
}
?>
