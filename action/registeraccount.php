<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        echo $username . "  " . $password;
        $bool = true;

        $conn = mysqli_connect("localhost", "root", "", "dingenonthouden");
        $query = mysqli_query($conn, "Select * from users"); // Query the users table

        while($row = mysqli_fetch_assoc($query)) {
            $table_users = $row["username"];
            if($username == $table_users) {
                $bool = false;
                Print "<script>alert('Username has been taken');</script>";
                header("location: ../register.php");
            }
        }

        if($bool) {
            mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
            Print "<script>alert('Succesfull login');</script>";
            header("location: ../home.php");
            session_start();
            $_SESSION['user'] = $username;
        }
    }
?>