
<?php  
require_once("dbaccess.php");
require_once("dbfunctions.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
</head>
<body>
    <h1>News</h1>

    <?php

    foreach(findAllNews() as $news) {
        echo "div";
        echo "<h2>" . $news["title"] . "</h2>";
        echo "<p>" . $news["content"] . "</p>";
        echo "<span>" . $news["date"] . "</span>";
        echo "</div>";
    }

    ?>

    <h3>Add new News</h3>
    <form method = "POST" action="saveNews.php">
        <input type="text" name="title" placeholder="Title">
        <textarea name="content" placeholder="Content"></textarea>
        <input type="submit" value="Save">


</body>
</html>
