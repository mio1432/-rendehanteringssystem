<?php
require_once("inc.php");
$conn = conn("projdb");
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
    <title>Document</title>
    <link rel="stylesheet" href="stylelogg.css">
    <link rel="stylesheet" href="stylekon.css">
</head>
<body>
<div class="header"><h1>FlensFastigheter</h1></div>
    <div id="stuff">
        <div class="hem"><a href="index.php">Hem</a></div>
        <?php if($level < 10){ ?>
                <a href="logg.php">Logga In</a>
            <?php } ?>
        <?php if($level >= 10){ ?>
                <a href="an.php">Ärende</a>
            <?php } ?>
        <?php if($level >= 10){ ?>
                <a href="logout.php">Logga ut</a>
            <?php } ?>
        
    </div>
