<!-- WIP login validation -->

<?php
session_start();
$email = $_POST["email"];

// Validate email (TODO: Datenbank check)
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // email valid
    // Datenbank check E-Mail placeholder
    $email_validation = "valid";
} else {
    // email invalid
    $email_validation = "invalid";
}

// Validate password
$pw = $_POST["pw"];
$pw_validation = /*Datenbank check password placeholder*/ strlen($pw) >= 4 ? "valid" : "invalid";

/// TODO: Remember Me

setcookie("validemail", $email_validation, time() + (86400 * 30), "/");     // 86400 * 30 = 30 Tage
setcookie("email", $email, time() + (86400 * 30), "/");
$_SESSION["validpw"] = $pw_validation;
$_SESSION["pw"] = $pw;

if ($email_validation == "valid" && $pw_validation == "valid") {
    header("Location: ../home.php");
} else {
    header("Location: ../login.php");
}
exit();

// previously in head:
//header("Location: ../login.php?validemail=".$email_validation."&email=".$email . "&validpw=".$pw_validation."&pw=".$pw);

?>