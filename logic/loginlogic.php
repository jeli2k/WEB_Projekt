<?php
session_start();
include_once("../data/userService.php");

$userEmail = $_POST['email'];
$password = $_POST['password'];

$_SESSION['admin'] = false;
// check if the user is an admin
$adminLogin = findAdminLogin($userEmail);

if ($adminLogin !== null && password_verify($password, $adminLogin['hashedPassword'])) { // important: always use hashedPassword, no 'password' in the database, only 'hashedPassword'
    $_SESSION['admin'] = true;
    $_SESSION['loggedIn'] = true;
    $_SESSION['email'] = $userEmail;  // Set the user's email in the session
    header("Location: ../home.php");
    exit();
}

// if not an admin, check regular user login
if (login($userEmail, $password)) {
    // set Session
    $_SESSION['loggedIn'] = true;
    $_SESSION['email'] = $userEmail;  // Set the user's email in the session
    // debug at the end
    header("Location: ../home.php");
    exit();
}

// if neither admin nor regular user, show error
$_SESSION['error'] = "Invalid email or password";
// debug at the end
header("Location: ../login.php");
?>
