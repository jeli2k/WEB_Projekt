<?php
// general access
$host = "localhost";
$user = "root";
$password = "";
$database = "hotel";

$db = new mysqli($host, $user, $password, $database); // standardmäßig Port 3306

if ($db->connect_error) {
    echo "Connection Error: " . $db->connect_error;
    exit();
}

// put this in a separate php file // too specific for the general php file


?>