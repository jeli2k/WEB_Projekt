<?php
session_start();

// Check if logout parameter is set to true
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    // Logout the user
    unset($_SESSION['email']);
    unset($_SESSION['pw']);

    echo "You have been successfully logged out.";
    header("Location: ../home.php");
    exit();
}

// check if the post parameters username and password are set and equal to "admin"
if (isset($_POST['email']) && isset($_POST['pw']) && $_POST['email'] == 'admin@admin.com' && $_POST['pw'] == 'admin') {
    // admin login logic
    $_SESSION['admin'] = true;
    header("Location: ../home.php"); // Redirect to admin home page
    exit();
}

exit();
?>
