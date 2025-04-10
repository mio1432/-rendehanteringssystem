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
    <title>Document</title>
    <link rel="stylesheet" href="stylelogg.css">
</head>
<body>
<div class="header"><h1>FlensFastigheter</h1></div>
    <div id="stuff">
        <div class="hem"><a href="index.php">Hem</a></div>
        <div class="logg"><a href="logg.php">Logga In</a></div>
        <div class="om"><a href="kon.php">Kontakt</a></div>
        
    </div>


<div class="log">
    <form action="index.php" method="POST">
        <input id="namn" type="text" name="username" placeholder="Användarnamn">
        <input id="pas" type="password" name="password" placeholder="Lösenord">
        <input id="send" type="submit" name="submit" placeholder="Skicka">
    </form>
</div>
</body>
</html>