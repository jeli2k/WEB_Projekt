<?php
// general access
// change for own database config
$host = "localhost";
$user = "root";
$password = "";
$database = "hotel";

$db = new mysqli($host, $user, $password, $database); // standard port 3306

if ($db->connect_error) {
    echo "Connection Error: " . $db->connect_error;
    exit();
}

?>