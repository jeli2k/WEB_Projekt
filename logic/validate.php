<!-- WIP login validation -->

<?php

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
//}
    
// Validate email
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // email valid
    $email_validation = "valid";
} else {
    // email invalid
    $email_validation = "invalid";
}

$pw = $_POST["pw"];

$pw_validation = /*Datenbank check password placeholder*/ strlen($pw) >= 4 ? "valid" : "invalid";

// TODO: Combine Email + PW Validation in one header
header("Location: ../login.php?validemail=".$email_validation."&email=".$email);
//header("Location: ../login.php?validpw=".$pw_validation."&pw=".$pw);
//header("Location: ../login.php?validemail=".$email_validation."&email=".$email && "validpw=".$pw_validation."&pw=".$pw);

?>