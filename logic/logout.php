<?php
session_start();

if (isset($_POST['logout']) && $_POST['logout'] == 'true') {
    // Logout the user
    // maybe session_unset();
    $_SESSION['loggedIn'] = false;
    $_SESSION['admin'] = false;
    
    //unset($_SESSION['userData']);
    //unset($_SESSION['loggedIn']);

    // Redirect to the home page or wherever you want after logout
    
}

header("Location: ../home.php");
exit(); 
?>