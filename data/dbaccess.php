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

// TODO Bilder als Text mit dem Pfad in Datenbank abspeichern (../Content/img.png)
function saveNews($title, $text) {
    global $db;

    $sql = "INSERT INTO `news` (`title`, `text`) VALUES (?, ?)";  // ? placeholder against SQL Injection // prepared Statement
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ss", $title, $text); // s = string

    $stmt->execute();
}

function saveEmail($email, $hashedPassword) {
    global $db;
    if ($email != NULL && $hashedPassword != NULL) {
        $sql = "INSERT INTO `userdata` (`email`, `hashedPassword`) VALUES (?, ?)";  // ? placeholder against SQL Injection // prepared Statement
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ss", $email, $hashedPassword); // s = string

    $stmt->execute(); 
    }
}

function saveRegister($firstname, $lastname, $email, $hashedPassword, $city, $street, $zipCode) {
    global $db;

    if ($firstname != NULL && $lastname != NULL && $email != NULL && $hashedPassword != NULL && $city != NULL && $street != NULL && $zipCode != NULL) {
        $sql = "INSERT INTO `userdata` (`firstname`, `lastname`, `email`, `hashedPassword`, `city`, `street`, `zipCode`) VALUES (?, ?, ?, ?, ?, ?, ?)";  // ? placeholder against SQL Injection // prepared Statement
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssssssi", $firstname, $lastname, $email, $hashedPassword, $city, $street, $zipCode); // s = string, i = integer
    
        $stmt->execute(); 
    }
}

function updateRegister($name, $lastname, $email, $hashedPassword, $city, $street, $zipCode) {
    global $db;

    if ($name != NULL && $lastname != NULL && $email != NULL && $hashedPassword != NULL && $city != NULL && $street != NULL && $zipCode != NULL) {
        $sql = "UPDATE `userdata` SET `firstname`=?, `lastname`=?, `hashedPassword`=?, `city`=?, `street`=?, `zipCode`=? WHERE `email`=?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sssssss", $name, $lastname, $hashedPassword, $city, $street, $zipCode, $email);
        $stmt->execute(); 
    }
}


function findRegister($email) {
    global $db;

    $sql = "SELECT `firstname`, `lastname`, `email`, `hashedPassword`, `city`, `street`, `zipCode` FROM `userdata` WHERE `email` = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $email); // s = string

    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_array();
}


// TODO: Validation im php code, nicht im datenbank code
function findUserByEmail($email) {
    global $db;

    $sql = "SELECT * FROM `userdata` WHERE `email` = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $email); // s = string

    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_array();
}

function findAdminLogin($email) {
    global $db;

    $sql = "SELECT * FROM `userdata` WHERE `email` = ? AND `is_admin` = 1";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $email); // s = string

    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Ensure the user, hashed password, and is_admin field are retrieved
    return ($user && isset($user['hashedPassword']) && isset($user['is_admin']) && $user['is_admin'] == 1) ? $user : null;
}


?>