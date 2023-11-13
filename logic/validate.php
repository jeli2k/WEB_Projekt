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
$_SESSION["validpw"] = $pw_validation;
$_SESSION["pw"] = $pw;

// TODO:
// beides valid? leite gleich zu Homepage
// nicht valid? gehe zu login
if ($email_validation == "valid" && $pw_validation == "valid") {
    header("Location: ../home.php");
}
header("Location: ../login.php");
exit();

// previously in head:
//header("Location: ../login.php?validemail=".$email_validation."&email=".$email . "&validpw=".$pw_validation."&pw=".$pw);

?>