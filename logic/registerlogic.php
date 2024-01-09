<?php
session_start();

include_once("../data/userService.php");

$errors = [];

$firstname = $_POST['name'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$city = $_POST['city'];
$street = $_POST['street'];
$zipCode = $_POST['zipCode'];

 // Validation
 if (strlen($firstname) < 3) {
    $errors['firstname'] = "Name must be 3 characters or longer";
}
if (strlen($lastname) < 3) {
    $errors['lastname'] = "Lastname must be 3 characters or longer";
}
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Valid email is required";
}
if (emailExists($email)) {
    $errors['email'] = "Email already in use";
}
if (empty($password)) {
    $errors['password'] = "Password is required";
}
if ($password !== $confirmPassword) {
    $errors['confirmPassword'] = "Passwords do not match";
}
if (strlen($city) < 2) {
    $errors['city'] = "City must be 2 characters or longer";
}
if (strlen($street) < 2) {
    $errors['street'] = "Street must be 2 characters or longer";
}
if (!ctype_digit($zipCode) || strlen($zipCode) !== 4) {
    $errors['zipCode'] = "Zip code must be 4 integers";
}

if (count($errors) === 0) {
    register($firstname, $lastname, $email, $password, $city, $street, $zipCode);
    $_SESSION['success'] = true;
    header("Location: ../login.php");  
} else {
     // store form data and errors in session
    $_SESSION['form_data'] = $_POST;
    $_SESSION['errors'] = $errors;

    header("Location: ../register.php");    
}
?>
