<!-- WIP login validation -->

<?php

$email = $_POST["email"];

// Validate email
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // email valid
    $email_validation = "valid";
} else {
    // email invalid
    $email_validation = "invalid";
}

// Validate password
$pw = $_POST["pw"];

$pw_validation = /*Datenbank check password placeholder*/ strlen($pw) >= 4 ? "valid" : "invalid";

session_start();
setcookie("validemail", $email_validation, time() + (86400 * 30), "/");
setcookie("email", $email, time() + (86400 * 30), "/");
setcookie("validpw", $pw_validation, time() + (86400 * 30), "/");
setcookie("pw", $pw, time() + (86400 * 30), "/");
header("Location: ../login.php");
exit();

// previously in head:
//header("Location: ../login.php?validemail=".$email_validation."&email=".$email . "&validpw=".$pw_validation."&pw=".$pw);

?>