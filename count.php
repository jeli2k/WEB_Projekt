<!DOCTYPE html>
<html lang="de">
    <head>
        <?php include 'includes/head.php'; ?>
        <link href="style/<?php echo $theme?>.css" rel="stylesheet">
        <title>Login</title>
    </head>

    <body>
        <header>
            
        </header>

        <?php
            include 'components/navbar.php';

        session_start();

        // theme
        if (isset($_COOKIE["theme"])) {
            $theme = $_COOKIE["theme"];
        } else {
            $theme = "light";
            setcookie("theme", $theme);
        }

        // session
        if (isset($_GET["session"]) && $_GET["session"] === "reset") {
            $_SESSION["counter"] = 0;
            header("Location: count.php");
            exit();
        }
        
        // css switch
        if (isset($_GET["css"]) && $_GET["css"] === "switch") {
            setcookie("theme", $theme === "light" ? "dark" : "light");

            $_SESSION["counter"] = $_SESSION["counter"] - 1;
            header("Location: count.php");
            exit();
        }

        // counter
        if (isset($_SESSION["counter"])) {
            $_SESSION["counter"] = $_SESSION["counter"] + 1;
        } else {
            $_SESSION["counter"] = 1;
        }
    

        ?>

        <main>  
            <div>
                <h1>Visited Counter</h1>
            </div>  
        
            <div>
                <h2>Counter: <?php echo $_SESSION["counter"]; ?></h2>
            </div>

            <div>
             <a href="?session=reset">Reset</a>   
             <a href="?css=switch">Switch CSS</a>
            </div>
        </main>



    <?php include 'components/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
     </body>

</html>