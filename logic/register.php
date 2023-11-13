<?php

$firstname = $_POST["firstname"];
$firstname_validation = strlen($firstname) >= 4 ? "valid" : "invalid";

$lastname = $_POST["lastname"];
$lastname_validation = strlen($lastname) >= 4 ? "valid" : "invalid";

$email = $_POST["email"];
// Validate email
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // email valid
    $email_validation = "valid";
} else {
    // email invalid
    $email_validation = "invalid";
}

// todo: abprüfen ob City in Austria/Deutschland/Schweiz (Datenbank maybe?)
$city = $_POST["city"];
$city_validation = strlen($city) >= 2 ? "valid" : "invalid";

// todo: abprüfen ob City zu State passt (in Austria/Deutschland/Schweiz) (Datenbank maybe?)

// todo: abprüfen ob Zip in Austria/Deutschland/Schweiz (Datenbank maybe?)
$zip = $_POST["zip"];
$zip_validation = strlen($zip) == 4 ? "valid" : "invalid";

session_start();
setcookie("validfn", $firstname_validation, time() + (86400 * 30), "/");     // 86400 * 30 = 30 Tage
setcookie("firstname", $firstname, time() + (86400 * 30), "/");
setcookie("validln", $lastname_validation, time() + (86400 * 30), "/");    
setcookie("lastname", $lastname, time() + (86400 * 30), "/");
setcookie("validemail", $email_validation, time() + (86400 * 30), "/"); 
setcookie("email", $email, time() + (86400 * 30), "/");
setcookie("validcity", $city_validation, time() + (86400 * 30), "/");    
setcookie("city", $city, time() + (86400 * 30), "/");
setcookie("validzip", $zip_validation, time() + (86400 * 30), "/");    
setcookie("zip", $zip, time() + (86400 * 30), "/");

// TODO:
// beides valid? leite gleich zu Homepage
// nicht valid? gehe zu login
if ($firstname_validation == "valid" && $lastname_validation == "valid" && $email_validation == "valid" && $city_validation == "valid" && $zip_validation == "valid") {
    header("Location: ../home.php");
} else {
    header("Location: ../register.php");
}
exit();

// previously in head:
//header("Location: ../login.php?validemail=".$email_validation."&email=".$email . "&validpw=".$pw_validation."&pw=".$pw);

?>