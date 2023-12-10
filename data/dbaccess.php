<?php
// general access
$host = "localhost";
$user = "root";
$password = "";
$database = "livecoding";

$db = new mysqli($host, $user, $password, $database); // standardmäßig Port 3306

if ($db->connect_error) {
    echo "Connection Error: " . $db->connect_error;
    exit();
}

// put this in a separate php file // too specific for the general php file
function findAllNews () {
    global $db;
    $sql = "SELECT * FROM `news`";
    $result = $db->query($sql);

    $news = [];
    while ($row = $result->fetch_array()) {  // fetch_array() liefert ein Array mit numerischen und assoziativen Indizes
        $news[] = $row;
    }
    return $news;
}

// Bilder als Text mit dem Pfad in Datenbank abspeichern (../Content/img.png)
function saveNews($title, $text) {
    global $db;

    $sql = "INSERT INTO `news` (`title`, `text`) VALUES (?, ?)";  // ? placeholder against SQL Injection // prepared Statement
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ss", $title, $text); // ss = stringstring

    $stmt->execute();
}

function saveEmail($email, $hashedPassword) {
    global $db;
    if ($email != NULL && $hashedPassword != NULL) {
        $sql = "INSERT INTO `guest` (`email`, `password`) VALUES (?, ?)";  // ? placeholder against SQL Injection // prepared Statement
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ss", $email, $hashedPassword); // ss = stringstring

    $stmt->execute(); 
    }
}

function saveRegister($firstname, $lastname, $email, $hashedPassword, $city, $street, $zipCode) {
    global $db;
    if ($firstname != NULL && $lastname != NULL && $email != NULL && $hashedPassword != NULL && $city != NULL && $street != NULL && $zipCode != NULL) {
        $sql = "INSERT INTO `guest` (`firstname`, `lastname`, `email`, `password`, `city`, `street`, `zipCode`) VALUES (?, ?, ?, ?, ?, ?, ?)";  // ? placeholder against SQL Injection // prepared Statement
}

// TODO: Validation im php code, nicht im datenbank code
function findUserByEmail($email) {
    global $db;

    $sql = "SELECT * FROM `guest` WHERE `email` = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $email); // s = string

    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_array();
}


?>