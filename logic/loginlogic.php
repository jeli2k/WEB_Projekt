<?php

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

?>