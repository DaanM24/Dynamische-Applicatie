<?php
$servername = "localhost";
$username = "root";
$password = "mysql";


    $conn = new PDO("mysql:host=$servername;dbname=school_php", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $table = $conn->query("SELECT * FROM characters ORDER BY `name`");
    $rows = $table->fetchAll(PDO::FETCH_NUM);
    $count = $table->rowCount();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Characters</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id='mainbody'>
        <div id='title'>
        <?php 
        $query = $conn->prepare("SELECT count('id') AS total FROM characters");
            $query->execute();
            $result = $query->fetchall();
            foreach($result as $count){
                echo "Alle ".$count['total']." characters uit de database";
            }
        ?>
        </div>
        <div id='body'>
        <?php 
        foreach($rows as $row) {
            echo "<div class='char'>";
            echo "<img src='images/$row[2]' alt='No Image found' class='charImg'>";
            echo "<h2 class='name'>$row[1]</h2>";
            echo "<div class='stats'><p>Health</p> <b>$row[3]</b><br> <p>Attack</p> <b>$row[6]</b><br> <p>Defense</p> <b>$row[7]</b></div>";
            echo "<a href='character.php?id=$row[0]' class='show'> bekijk<a/> <br><hr>";
            echo "</div>";
        }
        ?>
        </div>
        <?php include "includes/footer.php";?>
    </div>
</body>
</html>
