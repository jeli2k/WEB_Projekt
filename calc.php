<!-- PHP Calc Test -->
<?php

$a = $_POST['int-a']; // $_GET['int-a'] for GET
$b = $_POST['int-b']; // $_GET['int-b'] for GET

$result = $a + $b;

header("Location: login.php?result=".$result);

?>