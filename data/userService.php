<?php

include_once("dbaccess.php");

function register($firstname, $lastname, $email, $password, $city, $street, $zipCode) {

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    saveRegister($firstname, $lastname, $email, $hashedPassword, $city, $street, $zipCode);

    //saveEmail($email, $hashedPassword);
}

function login($email, $password) {
    $email = findUserByEmail($email);

    if (null === $email) {
        return false;
    }

    return password_verify($password, $email['password']);
}



?>