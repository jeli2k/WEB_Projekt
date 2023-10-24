<!DOCTYPE html> 
<html lang="de">
    <head>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>The name of the website</title> 
    </head>
    <body>
    <?php 
        include "header.php";
        

        $integer = 1;
        $character = 'c';
        $boolean = true;
        $floatvalue = 5.322;
        $array = array(1, 2, 3, 4, 5);
    
        function greet($name) {
            print("Hello" . $name);
        }
        echo "<br>";
        greet("John");
        // == checks if the value is the same
        // === checks if the value and the type is the same
        $value = 5;
        if ($value == "5") {
            echo "Success";
        } else {
            echo "Failure";
        }
        
        echo "<br>";
        echo "<h3>Heading3</h3>";

    ?>

    </body>
</html>