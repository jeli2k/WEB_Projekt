<?php

include_once("dbaccess.php");

function register($firstname, $lastname, $email, $password, $city, $street, $zipCode) {

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    saveRegister($firstname, $lastname, $email, $hashedPassword, $city, $street, $zipCode);

    //saveEmail($email, $hashedPassword);
}

function login($email, $password) {
    $userEmail = findUserByEmail($email);

    if ($userEmail === null) {
        return false;
    }

    return password_verify($password, $userEmail['hashedPassword']);
}



?>