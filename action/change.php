<?php
    session_start();
    if(!$_SESSION["user"]) {
        header("location: ../index.php");
    }

    date_default_timezone_set("Europe/Amsterdam");

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "UPDATE dingen SET ";

        foreach($_POST as $key => $value) {
            if($key == "id") {
                continue;
            }
            else if($key == "public") {
                $sql .= "$key=$value ,";
            } else {
                $sql .= "$key='$value' ,";
            }
        }

        $sql = substr($sql, 0, -1);

        $time = time(); 
        if(isset($_POST["waarde"])) {
            $sql .= ", history=JSON_ARRAY_APPEND(history, '$', '[$time, {$_POST['waarde']}]')";
        }

        // Establish connection
        $conn = mysqli_connect("localhost", "root", "", "dingenonthouden");
        if(!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $idje = $_POST['id'];
        $sql .= " WHERE id=$idje";
        
        if(mysqli_query($conn, $sql)) {
            echo "Success";
        } else {
            echo "Fail <br>";
            echo mysqli_error($conn);
            echo $sql;
        }

        mysqli_close($conn);

        //header("location:../home.php");
    } else {
        // header("location: ../home.php");
    }
?>