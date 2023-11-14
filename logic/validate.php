<!-- validate.php is used on the login page, checks if email + password combo exists in DB -->
<?php
session_start();
$email = $_POST["email"];
$pw = $_POST["pw"];

// Validate email (TODO: Datenbank check)
// Validate password (TODO: Datenbank check)

if ($email === "admin@admin.com") {
    if ($pw === "admin") {
        $_SESSION["email"] = $email;
        $email_validation = "valid";
        $pw_validation = "valid";
        $validity = true;
    } else {
        $pw_validation = "invalid";
    }
} else {
    $email_validation = "invalid";
    if ($pw !== "admin") {
        $pw_validation = "invalid";
    }
}

setcookie("validemail", $email_validation, time() + (86400 * 30), "/");     // 86400 * 30 = 30 Tage
setcookie("email", $email, time() + (86400 * 30), "/");
$_SESSION["validpw"] = $pw_validation;
$_SESSION["pw"] = $pw;

if ($validity === true) {
    header("Location: ../home.php");
} else {
    header("Location: ../login.php");
}
exit();

/// TODO: Remember Me

// previously in head:
//header("Location: ../login.php?validemail=".$email_validation."&email=".$email . "&validpw=".$pw_validation."&pw=".$pw);

?>