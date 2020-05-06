<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Boi</title>
</head>
<body>
    <h2>Login here</h2>
    <a href="index.php">Go back</a>
    <form action="action/checklogin.php" method="POST">
        Username: <input type="text" name="username" required="required"> <br>
        Password <input type="password" name="password" required="required"><br>
        <input type="submit" value="login">
    </form>
</body>
</html>