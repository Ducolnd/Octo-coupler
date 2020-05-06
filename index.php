<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php Site</title>
</head>
<body>
    <?php
        echo "<p>Hello World</p>";
        if(isset($_GET["return"])) {
            if($_GET["return"] == "callback") {
                echo "<h1>Je moet inloggen om deze pagina te bekijken!</h1>";
            }
        }
    ?>

    <div>
        <h3>Naar <a href="home.php">hoofdmenu</a>?</h3>

    </div>

    <a href="login.php">Click here to login</a><br>
    <a href="register.php">Click here to register</a>


</body>
</html>