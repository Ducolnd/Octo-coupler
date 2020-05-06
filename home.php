<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style/style.css">
    <?php include_once("templates/bootstrap.php"); ?>
</head>

<?php
    session_start();
    if(!$_SESSION["user"]) {
        header("location: index.php?return=callback");
    }

    $user = $_SESSION["user"];
?>

<body>
    <div class="container">
        <h2>Home page</h2>
        <p>Welcome <?php Print "$user"?>!</p>
        <a href="action/logout.php">Log uit</a>

        <h1>Ding toevoegen:</h1>
        <form action="action/add.php" method="POST">
            <label for="type">Soort ding</label>
            <select name="type" id="type">
                <option value="nummering">Nummering</option>
                <option value="acties">Acties</option>
                <option value="memory">Geheugen</option>
            </select><br>

            Publiek: <input type="checkbox" name="public" value="1"><br>

            Naam ding: (max 30 tekens)<br>
            <input required maxlength=30 type="text" name="naam"><br>
            <textarea required name="details" id="info" cols="50" rows="5">Informatie</textarea><br>

            <input type="submit" value="Toevoegen">
        </form>


        <div class="box">
            <a href="profile.php">Account bekijken</a>
            <a href="dingen.php">Dingen bekijken</a>
        </div>
    

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th style="width: 25%;" scope="col">Informatie</th>
                    <th scope="col">Naam</th>
                    <th scope="col">Maker</th>
                    <th scope="col">Tijd gemaakt</th>
                    <th scope="col">Type</th>
                    <th scope="col">Waarde</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $conn = mysqli_connect("localhost", "root", "", "dingenonthouden");
                    // $db = mysqli_select_db($conn, "dingen");
                    
                    if(!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $query = "select * from dingen ORDER BY id DESC";
                    $results = mysqli_query($conn, $query);

                    if(mysqli_num_rows($results) > 0) { 
                        while($row = mysqli_fetch_assoc($results)) {
                            Print "<tr>";
                                Print "<th scope='row'>" . $row['id'] . "</th>";
                                Print "<td scope='row'>" . $row['details'] . "</td>";
                                Print "<td scope='row'>" . $row['naam'] . "</td>";
                                Print "<td scope='row'>" . $row['created_by'] . "</td>";
                                Print "<td scope='row'>" . $row['time_created'] . "</td>";
                                Print "<td scope='row'>" . $row['type'] . "</td>";
                                Print "<td scope='row'>" . $row['waarde'] . "</td>";
                            Print "</tr>";
                        }
                    } else {echo "0 results";}
                ?>
            </tbody>
        </table>
    </div>

    <?php include_once("templates/bootstrapjs.php"); ?>
</body>
</html>