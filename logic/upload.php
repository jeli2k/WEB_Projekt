<?php

var_dump($_FILES);

$name = $_FILES["doc"]["name"];
$tmp_name = $_FILES["doc"]["tmp_name"];

$id = uniqid(); // var_dump($id);

if (!is_dir("../upload")) {
    mkdir("../upload");
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

?>