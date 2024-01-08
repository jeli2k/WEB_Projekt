<?php
session_start();
include_once("../data/userService.php");

$userEmail = $_POST['email'];
$password = $_POST['password'];

$_SESSION['admin'] = false;
// check if the user is an admin
$adminLogin = findAdminLogin($userEmail);

if ($adminLogin !== null && password_verify($password, $adminLogin['hashedPassword'])) { 
    $_SESSION['admin'] = true;
    $_SESSION['loggedIn'] = true;
    $_SESSION['email'] = $userEmail;  
    header("Location: ../home.php");
    exit();
}

// if not an admin, check regular user login
$userData = login($userEmail, $password); // Assuming login function now returns user data including status

if ($userData && $userData['status'] == 1) {
    $_SESSION['error'] = "Your account is currently inactive. Please contact support.";
    header("Location: ../login.php");
    exit();
} elseif ($userData) {
    // set Session
    $_SESSION['loggedIn'] = true;
    $_SESSION['email'] = $userEmail;
    header("Location: ../home.php");
    exit();
}

// if neither admin nor regular user, or if status is not 1, show error
$_SESSION['error'] = "Invalid email or password";
header("Location: ../login.php");
exit();
?>
