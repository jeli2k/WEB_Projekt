<?php

include_once("dbaccess.php");

function register($firstname, $lastname, $email, $password, $city, $street, $zipCode) {

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    saveRegister($firstname, $lastname, $email, $hashedPassword, $city, $street, $zipCode);

    //saveEmail($email, $hashedPassword);
}

function login($email, $password) {
    $userData = findUserByEmail($email);

    if ($userData === null) {
        return false;
    }

    if (password_verify($password, $userData['hashedPassword'])) {
        return $userData; // Returns user data if password is correct
    }

    return false; // Return false if password is incorrect
}

function emailExists($email) {
    global $db; 

    $sql = "SELECT COUNT(*) FROM userdata WHERE email = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result(); // Needed for getting row count

    return $stmt->num_rows > 0;
}



?>