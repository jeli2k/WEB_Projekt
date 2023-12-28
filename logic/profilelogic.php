<?php
// change
include_once("../data/dbaccess.php");

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

$errors = [];

// get user data from the database
$email = $_SESSION['email'];
$userData = findUserByEmail($email);

if ($userData === null) {
    // user data not found (or user was deleted)
    $errors[0] = "No User Data found";
    exit();
}

// assign user data to variables
$_SESSION['userData'] = [
    'name' => $userData['firstname'],
    'lastname' => $userData['lastname'],
    'email' => $userData['email'],
    'hashedPassword' => $userData['hashedPassword'],
    'city' => $userData['city'],
    'street' => $userData['street'],
    'zipCode' => $userData['zipCode'],
    'is_admin' => $userData['is_admin'],
];


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /*
    if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
        // set profile data to admin
        $_SESSION['userData'] = [
            'name' => "admin",
            'lastname' => "admin",
            'email' => "admin@admin.com",
            'password' => "admin",
            'city' => "admin",
            'street' => "admin",
            'zipCode' => "1234"
        ];
    }
    */

    $name = htmlspecialchars($_POST['name']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $oldPassword = htmlspecialchars($_POST['oldPassword']);
    $newPassword = htmlspecialchars($_POST['newPassword']);
    $city = htmlspecialchars($_POST['city']);
    $street = htmlspecialchars($_POST['street']);
    $zipCode = htmlspecialchars($_POST['zipCode']);

    // Validation
    if (empty($name)) {
        $errors['name'] = "Name is required";
    }
    if (empty($lastname)) {
        $errors['lastname'] = "Lastname is required";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Valid email is required";
    }
    if (empty($oldPassword) || !password_verify($oldPassword, $_SESSION['userData']['hashedPassword'])) {
        $errors['oldPassword'] = "Incorrect old password";
    }
    if (empty($newPassword)) {
        $errors['newPassword'] = "New password is required";
    }
    if (empty($city)) {
        $errors['city'] = "City is required";
    }
    if (empty($street)) {
        $errors['street'] = "Street is required";
    }
    if (empty($zipCode)) {
        $errors['zipCode'] = "Zip code is required";
    }
    
    if (count($errors) === 0) {
        // hash the new password
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        // save in database
        updateRegister($name, $lastname, $email, $hashedNewPassword, $city, $street, $zipCode);

        // update session data
        /*
        $_SESSION['userData']['name'] = $name;
        $_SESSION['userData']['lastname'] = $lastname;
        $_SESSION['userData']['email'] = $email;
        $_SESSION['userData']['password'] =  password_hash($newPassword, PASSWORD_DEFAULT); // hash the password
        $_SESSION['userData']['city'] = $city;
        $_SESSION['userData']['street'] = $street;
        $_SESSION['userData']['zipCode'] = $zipCode;
        */
    }

}

?>
