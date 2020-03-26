<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Character info</title>
</head>
<body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "mysql";


        $conn = new PDO("mysql:host=$servername;dbname=school_php", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $table = $conn->query("SELECT * FROM characters ORDER BY `name`");
        $rows = $table->fetchAll(PDO::FETCH_NUM);
        $count = $table->rowCount();

        $id = $_GET['id'];

        $stmt = $conn->prepare("SELECT * FROM characters WHERE id=?");
        $stmt->execute([$id]);
        $char = $stmt->fetch();
        ?>
    <header>
        <h1><?="$char[1]"?></h1>
        <a href="index.php">Terug</a>
    </header>
    <div id="center-div" style="padding-bottom: 1%;">
    <?php
        echo "<img src='images/$char[2]' alt='No Image found'>";
        echo "<div id='bio'>".nl2br($char['4'])."</div>";
        echo "<div id='charStats' style='background-color: $char[5];'<b>$char[3]</b><br> $char[6]<br> $char[7]<br><br> ";
        if($char[8] != null){echo "<b class='itemTile'>Weapon: </b>$char[8]";}
        if($char[9] != null){echo "<br><b class='itemTile'>Armor: </b>$char[9]";};?>
    </div></div>
</body>
</html>