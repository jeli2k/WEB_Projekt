<!-- loggedIn.php checks if a user is logged in -->
<?php
session_start();

// Check if logout parameter is set to true
if (isset($_POST['logout']) && $_POST['logout'] == 'true') {
    // Logout the user
    unset($_SESSION['email']);
    unset($_SESSION['pw']);

    // Output a logout message
    // echo "You have been successfully logged out.";
    header("Location: ../home.php");
    exit();
}

// Check if the post parameters username and password are set and equal to "admin"
if (isset($_POST['email']) && isset($_POST['pw']) && $_POST['email'] == 'admin@admin.com' && $_POST['pw'] == 'admin') {
    // Admin login logic (you can customize this part according to your needs)
    $_SESSION['admin'] = true;
    header("Location: ../home.php"); // Redirect to admin home page
    exit();
}

exit();
?>
