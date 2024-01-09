<?php
session_start();

if (isset($_POST['logout']) && $_POST['logout'] == 'true') {
    // Logout the user
    $_SESSION['loggedIn'] = false;
    $_SESSION['admin'] = false;
    
}

header("Location: ../home.php");
exit(); 
?>