<?php
require_once("dbaccess.php");

if ("POST" === $_SERVER["REQUEST_METHOD"]) {
    // TODO: Validation
    saveNews($_POST["title"], $_POST["text"]);
}
header("Location: ../home.php");

?>