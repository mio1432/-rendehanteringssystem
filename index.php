<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['5ddf'])) {
    $level = intval($_SESSION['5ddf']);
}
else {
    $level = 10;
}
?>
<?php
$server="localhost";
$username="root";
$password="";
$conn=mysqli_connect($server, $username, $password, "projdb");

if(isset($_POST["submit"])){
    $username=$_POST["username"];
    $password=md5($_POST["password"]);
    $sql="INSERT INTO tbluser( username, password) VALUES ('$username', '$password')";
    $result=mysqli_query($conn,$sql);
    
}

$level = isset($_SESSION['level']) ? intval($_SESSION['level']) : 0;
?>

<html lang="en">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlensFastigheter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header"><h1>FlensFastigheter</h1></div>
    <div id="stuff">
        <div class="hem"><a href="index.php">Hem</a></div>
        <?php if($level < 10){ ?>
                <a href="logg.php">Logga In</a>
            <?php } ?>
        <div class="kon"><a href="kon.php">Kontakt</a></div>
            <?php if($level >= 10){ ?>
                <a href="an.php">Ärende</a>
            <?php } ?>
            <?php if($level >= 10){ ?>
                <a href="logout.php">Logga ut</a>
            <?php } ?>
            <?php if($level >= 100){ ?>
                <a href="adminpanel.php">Admin</a>
            <?php } ?>
        </div>
    <div class="mid"></div>
    <div class="bildb"></div>
    <div class="bild"><img src="flensfastighet.png" alt=""></div>
    <div class="flenbild"><img src="flenrum.png" alt=""></div>
    
    <div class="om">
        <div class="om-container">
            <h2>Om FlensFastigheter</h2>
            <p>
                FlensFastigheter är ett modernt och lokalt förankrat fastighetsbolag med hjärtat i Flen. 
                Vi förvaltar och underhåller bostäder med fokus på trygghet, tillgänglighet och kvalitet för våra hyresgäster. <br>  
                Genom vårt digitala ärendehanteringssystem gör vi det enkelt för dig som hyresgäst att rapportera fel, 
                följa dina ärenden och få snabb återkoppling - direkt via vår portal. <br>
                Vår vision är att skapa ett tryggt och trivsamt boende för alla våra hyresgäster, 
                samtidigt som vi utvecklar hållbara fastigheter för framtiden. <br> 
                Välkommen till FlensFastigheter - där omtanke bor.
            </p>
        </div>
    </div>
    <footer class="footer">
    <div class="footer-content">
        <p>&copy; 2025 FlensFastigheter. Alla rättigheter förbehållna.</p>
        <p>Bergslagsgatan 72, Lesjöfors | VD: Peter Hagelbössa (f. 1978)</p>
    </div>
    </footer>

</body>
</html>