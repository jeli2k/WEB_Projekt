<?php
require_once("dbaccess.php");
require_once("dbfunctions.php");
function register($firstname, $lastname, $email, $password, $city, $street, $zipCode) {

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    saveRegister($firstname, $lastname, $email, $hashedPassword, $city, $street, $zipCode);

}

function login($email, $password) {
    $userData = findUserByEmail($email);

    if ($userData === null) {
        return false;
    }

    if (password_verify($password, $userData['hashedPassword'])) {
        return $userData; // returns user data if password is correct
    }

    return false; // return false if password is incorrect
}

function emailExists($email) {
    global $db;

    $sql = "SELECT COUNT(*) AS count FROM userdata WHERE email = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($count);
        $stmt->fetch();

        return $count > 0;
    }

    return false;
}



?>