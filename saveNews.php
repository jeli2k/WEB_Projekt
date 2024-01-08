<?php
require_once "dbaccess.php";

if("POST" === $_SERVER["REQUEST_METHOD"]) {
    saveNews($_POST["title"], $_POST["text"]);
}

header("Location: news.php");