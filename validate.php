<!-- WIP -->

<?php

$email_validation_class = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
}
    
// Validate email
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // email valid
    $email_validation_class = "is-valid";
} else {
    // email invalid
    $email_validation_class = "is-invalid";
}

header("Location: login.php?email_validation_class=".$email_validation_class);





/*
strlen(): get string length
$username = $_POST['username'];
$username_length = strlen($username);
$username_validation_class = "is-valid";

*/

?>