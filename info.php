<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("templates/bootstrap.php"); ?>
   
    <link rel="stylesheet" href="style/info.css">
    <title>Uitgebreide info</title>
</head>
<body>
    <div class="topText">
        <h1>Uitgebreide info</h1>
        <div class="extra">
            <div class="sub">
                <a href="home.php">Home</a>
                <a href="action/logout.php">Log uit</a>
                <a href="">Over</a>
            </div>
        </div>
    </div>
    <div class="container">
        <p><a href="dingen.php">&larr; Terug</a></p>

        <div class="row">
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
                if(isset($_GET["id"])) {
                    $info = mysqli_query($conn, "SELECT * FROM dingen WHERE id={$_GET['id']}");
                    if(mysqli_num_rows($info) > 0) {
                        while($row = mysqli_fetch_assoc($info)) {
                            $html = "<b>Waarde</b>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Moment</b><br>";
                            $save = array("Monday"=>0, "Friday"=> 0, "Tuesday" => 0, "Wednesday"=>0, "Thursday"=>0, "Saturday"=>0, "Sunday"=>0);

                            $history = json_decode($row["history"]);
                            foreach(array_reverse($history) as $bla) {
                                $in = explode(",", $bla);
                                
                                $timestamp = substr($in[0], 1);
                                $value = substr($in[1], 0, -1);

                                $html .= substr($in[1], 0, -1) . "  -  " . date("D M j G:i:s", $timestamp)  . "<br>";
                                $save[date("l", $timestamp)] ++ ;
                            }

                            $max = array_search(max($save), $save);


                            echo html("div", array(
                                html("h4", "Volledige geschiedenis:", "title"),
                                html("div", html("p", $html, "para"), "centerdiv"), 
                                html("div", array(
                                    html("p", "asdf"),
                                    html("p", "Op " . html("b", $max) . html("span", " is er het vaakste een waarde bijgekomen"), "title"),
                            ), "Right")
                            ), "col-sm");

                            echo html("div", array(
                                html("h4", "content", "title"),
                            ), "col-sm");
                        }
                        
                    } else {
                        echo mysqli_num_rows($info);
                        echo html("h1", "Bestaat niet", "fail");
                    }
                
                } else {
                    echo html("h1", "Je hebt geen ding gekozen", "fail");
                }
            ?>
        </div>
    </div>
</body>
</html>