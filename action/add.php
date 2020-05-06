<?php
    session_start();
    if(!$_SESSION["user"]) {
        header("location: ../index.php");
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $active = isset($_POST["public"]) && $_POST["public"] ? "1" : "0";
        $type = $_POST["type"];
        $info = $_POST["details"];
        $name = $_POST["naam"];
        $time =date("Y-m-d H:i:s" );
        $by = $_SESSION["user"];

        $conn = mysqli_connect("localhost", "root", "", "dingenonthouden");
        if(!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO dingen(details, naam, created_by, time_created, type, public, waarde) VALUES ('$info', '$name', '$by', '$time', '$type', '$active', 0)";
        if(mysqli_query($conn, $sql)) {
            echo "Success";
        } else {
            echo "Failed <br>" . mysqli_error($conn);
        }
        
        //header("location:../home.php");
    } else {
        header("location: ../home.php");
    }
?>