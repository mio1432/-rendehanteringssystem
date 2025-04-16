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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlensFastigheter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header"><h1>FlensFastigheter</h1></div>
    <div id="stuff">
        <div class="hem"><a href="index.php">Hem</a></div>
        <div class="logg"><a href="logg.php">Logga In</a></div>
        <div class="om"><a href="kon.php">Kontakt</a></div>
            <?php if($level >= 10){ ?>
                <a href="an.php">Ärende</a>
            <?php } ?>
            <?php if($level >= 10){ ?>
                <a href="logout.php">Logga ut</a>
            <?php } ?>
        </div>
    <div class="mid"></div>
    <div class="bildb"></div>
    <div class="bild"><img src="flensfastighet.png" alt=""></div>
    <div class="flenbild"><img src="flenrum.png" alt=""></div>
    
    



</body>
</html>