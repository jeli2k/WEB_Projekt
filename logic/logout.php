<?php
session_start();

if (isset($_POST['logout']) && $_POST['logout'] == 'true') {
    // Logout the user
    $_SESSION['loggedIn'] = false;
    //unset($_SESSION['userData']);
    //unset($_SESSION['loggedIn']);

    // Redirect to the home page or wherever you want after logout
    
}

header("Location: ../home.php");
exit(); 
?>