<?php


if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    // set profile data to admin
    $_SESSION['userData'] = [
        'name' => "admin",
        'lastname' => "admin",
        'email' => "admin@admin.com",
        'password' => "admin", // TODO: hash the password
        'city' => "admin",
        'street' => "admin",
        'zipCode' => "1234"
    ];
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    if (empty($oldPassword) || $oldPassword !== $_SESSION['userData']['password']) {
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
        // Updating session data
        $_SESSION['userData']['name'] = $name;
        $_SESSION['userData']['lastname'] = $lastname;
        $_SESSION['userData']['email'] = $email;
        $_SESSION['userData']['password'] = $newPassword; // TODO: hash the password
        $_SESSION['userData']['city'] = $city;
        $_SESSION['userData']['street'] = $street;
        $_SESSION['userData']['zipCode'] = $zipCode;
    }
}
?>
