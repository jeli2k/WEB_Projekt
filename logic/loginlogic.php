<?php
session_start();
// new database logic
include_once("../data/userService.php");

$email = $_POST['email'];
$password = $_POST['password'];

if ($email === "admin@admin.com" && $password === "admin") {
    $_SESSION['admin'] = true;
    $_SESSION['loggedIn'] = true;
    header("Location: ../home.php?loggedIn=true?admin=true");
    exit();
}

if (login($email, $password)) {
    // set Session
    $_SESSION['loggedIn'] = true;
    // debug at the end
    header("Location: ../home.php?loggedIn=true");
    exit();
}
// debug at the end
header("Location: ../login.php?loggedIn=false");
$error = "Invalid email or password";


/*
// old logic
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $enteredEmail = htmlspecialchars($_POST['email']);
    $enteredPassword = htmlspecialchars($_POST['password']);

    // check if admin
    if ($enteredEmail === "admin@admin.com" && $enteredPassword === "admin") {
        $_SESSION['admin'] = true;
        $_SESSION['loggedIn'] = true;
        header("Location: home.php");
        exit();
    }
    // Check if user data exists in the session
    if (isset($_SESSION['userData'])) {
        if ($enteredEmail === $_SESSION['userData']['email'] && $enteredPassword === $_SESSION['userData']['password']) {
            $_SESSION['loggedIn'] = true;
            header("Location: home.php");
            exit();
        } else {
            $error = 'Invalid email or password.';
        }
    } else {
        $error = 'No user data found. Please register first.';
    }
}
*/

?>