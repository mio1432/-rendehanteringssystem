<?php 
session_start();

function conn($db){
    $host="localhost";
    $user="root";
    $pass="";
    $conn=mysqli_connect($host,$user,$pass,$db);
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function isLevel($level){
    if(isset($_SESSION['level'])){
        if(intval($_SESSION['level'])>=$level){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}


?>