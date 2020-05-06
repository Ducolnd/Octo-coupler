<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("templates/bootstrap.php"); ?>
    <link rel="stylesheet" href="style/ding.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/post.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Jou dingen om te onthouden</title>

    <script>
        function doPost(value, id) {
            console.log($.post("action/change.php", {"waarde": value, "id": id}));
            location.reload();
            // console.log("success");
        }
    </script>
</head>

<body>
    <div class="topText">
        <h1>Jouw dingen om te onthouden</h1>
        <div class="extra">
            <div class="sub">
                <a href="home.php">Home</a>
                <a href="action/logout.php">Log uit</a>
                <a href="">Over</a>
            </div>
        </div>
    </div>

    

    <div class="container">
        <?php
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
        ?>
    
        <?php 
            require "templates/functions.php";
            session_start();
            if(!$_SESSION["user"]) {
                header("location: ../index.php");
            }
            
            $conn = mysqli_connect("localhost", "root", "", "dingenonthouden");
            
            if(!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $query = "select * from dingen";
            $results = mysqli_query($conn, $query);

            if(mysqli_num_rows($results) > 0) { 
                while($row = mysqli_fetch_assoc($results)) {
                    if($row["created_by"] == $_SESSION["user"]) {
                        if($row["type"] == "nummering") {
                            echo html("div", 
                            array(
                            html("a", html("h1", $row["naam"], "dinglinksub"), "dingLink", "info?id={$row['id']}?"),
                            html("div", html("p", $row["details"], "details"), "sub"),
                            html("h1", $row["waarde"], "value"),
                            html("div", array(html("p", "+", "plus", "", $row["id"], $row["waarde"]+1), html("p", "-", "minus", "", $row["id"], $row["waarde"]-1), html("h2", "veranderen", "midtext")), "change"),
                            html("div", html("div", array(
                                html("a", "Uitgebreide info", "", "info?id={$row['id']}"), 
                                html("a", "Geschiedenis", "", "history?id={$row['id']}"), 
                                html("a", "Info wijzigen")), "sub"), 
                                "extra")
                            ),
                            "box");
                            
                        }
                    } else {
                        html("div", html("h1", "Je hebt geen ongeslagen onthoud dingen"));
                    } 
                }
            } else {echo "0 results";}
        ?>
    </div>  
    <?php include_once("templates/bootstrapjs.php"); ?>
</body>
</html>