<!-- WIP -->

<?php

$success = false;
$error = false;
$mssg = "Error";



$email = $_POST['email'];
$email_length = strlen($email);
//$email_validation_class = $email_length > 3 ? "valid" : "invalid";
$email_validation_class = "is-valid";

$result = isset($_GET["email"]) ? $_GET["email"] : "todo";

$username = $_POST['username'];
$username_length = strlen($username);
$username_validation_class = "is-valid";

header("Location: login.php?email_validation_class=".$email_validation_class);

?>