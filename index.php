<!DOCTYPE html>
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
        <div class="kon"><a href="kon.php">Kontakt</a></div>
        
    </div>
    <div class="mid"></div>
    <div class="bildb"></div>
    <div class="bild"><img src="flensfastighet.png" alt=""></div>
    <div class="flenbild"><img src="flenrum.png" alt=""></div>
    
    



</body>
</html>