<?php
// change
include_once(__DIR__ . "/../data/dbaccess.php");

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
     // Check if a new password is provided
     if (!empty($newPassword)) {
        // Require the old password when updating the password
        if (empty($oldPassword) || !password_verify($oldPassword, $_SESSION['userData']['hashedPassword'])) {
            $errors['oldPassword'] = "Incorrect old password";
        }
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

    $successMessage = '';
    if (count($errors) === 0) {
        // hash the new password if provide
        if (!empty($newPassword)) {
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        } else {
            // use existing hashedPassword if no new password is provided
            $hashedNewPassword = $_SESSION['userData']['hashedPassword'];
        }
        // save in database
        updateRegister($name, $lastname, $email, $hashedNewPassword, $city, $street, $zipCode);

        // update session data
        $_SESSION['userData']['name'] = $name;
        $_SESSION['userData']['lastname'] = $lastname;
        $_SESSION['userData']['email'] = $email;
        $_SESSION['userData']['password'] =  password_hash($newPassword, PASSWORD_DEFAULT); // hash the password
        $_SESSION['userData']['city'] = $city;
        $_SESSION['userData']['street'] = $street;
        $_SESSION['userData']['zipCode'] = $zipCode;

        $successMessage = "Change successful!";
        
    }

}

?>
