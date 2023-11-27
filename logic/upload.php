<?php
session_start();
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Specify the upload directory
    if (!is_dir("../Content/uploads")) {
        mkdir("../Content/uploads");
    }
    $uploadDirectory = '../Content/uploads/';
    for ($i = 1; $i <= 3; $i++) { // 3 news articles, change if more
        $newsInputName = 'news' . $i;
    // Check if the file is uploaded successfully
        if ($_FILES[$newsInputName] && $_FILES[$newsInputName]['error'] == UPLOAD_ERR_OK) {
            // Check if the file is an actual image
            $check = getimagesize($_FILES[$newsInputName]['tmp_name']);
            if ($check !== false) {
                // Check if the file already exists
                $uniqueFilename = 'img_' . '_' . basename($_FILES[$newsInputName]['name']);
                $uploadPath = $uploadDirectory . $uniqueFilename;

                // Check if file exists
                if (!file_exists($uploadPath)) {
                    // Check file size (limit to 10MB)
                    if ($_FILES[$newsInputName]['size'] <= 10 * 1024 * 1024) {
                        // Check file format (allow only certain formats, e.g., jpeg, png, gif)
                        $allowedFormats = ['jpeg', 'jpg', 'png', 'gif'];
                        $fileFormat = strtolower(pathinfo($uploadPath, PATHINFO_EXTENSION));
                        if (in_array($fileFormat, $allowedFormats)) {
                            // Move the uploaded file to the specified directory
                            if (move_uploaded_file($_FILES[$newsInputName]['tmp_name'], $uploadPath)) {
                                // Save the upload path in a session variable
                                $uploadKey = 'uploadPath_news' . $i;
                                $_SESSION[$uploadKey] = $uploadPath;
                                // Success message
                                echo "File successfully uploaded. File path: $uploadPath";
                                header("Location: ../home.php");
                            } else {
                                // Error message
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
                    // Error message for file already exists
                    echo "File already exists. Please choose a different file name";
                }
            } else {
                // Error message for invalid image
                echo "File is not a valid image";
            }
        } else {
            // Error message for file upload failure
            echo "File upload failed. Please check the file and try again";
        }
    }

} else {
    // Redirect to home.php if accessed directly without form submission
    header("Location: ../home.php");
    exit();
}
?>


<?php
/* Old
var_dump($_FILES);

$name = $_FILES["doc"]["name"];
$tmp_name = $_FILES["doc"]["tmp_name"];

$id = uniqid(); // var_dump($id);

if (!is_dir("../Content/upload")) {
    mkdir("../Content/upload");
}

$new_file_name = $id . "_" . $name;

if (move_uploaded_file($tmp_name, "../upload/" . $new_file_name)) {
    header("Location: ../file-upload.php");
    exit();
    // echo "Upload successful!";
} else {
    // echo "Upload failed";
    // code weitergeben an Seite wo Error angezeigt wird
}
*/
?>