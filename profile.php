<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Je account</title>
</head>
<body>
    <h1>account</h1>

    <?php
        session_start();

        if(!$_SESSION["user"]) {
            header("location: index.php?return=callback");
        }

        echo "Welkom " . $_SESSION["user"];
    ?>
</body>
</html>