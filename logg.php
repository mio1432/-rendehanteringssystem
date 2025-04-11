<?php
require_once("inc.php");
$conn = conn("projdb");

if (isset($_POST['btn'])) {
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM tbluser WHERE username='$name' AND password='$pass'";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) == 1) {
            $rad = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $rad['username'];
            $_SESSION['level'] = $rad['userlevel'];
            header("Location: logg.php"); // redirecta till sig själv efter lyckad inloggning
            exit();
        } else {
            $_SESSION['user'] = "";
            $_SESSION['level'] = "5ddf";
            $error = "Fel användarnamn eller lösenord!";
        }
    }
}

// Hämta användarens nivå från sessionen
$level = isset($_SESSION['level']) ? intval($_SESSION['level']) : 0;
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Logga In - FlensFastigheter</title>
    <link rel="stylesheet" href="stylelogg.css">
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
    </div>

    <?php
    if (isLevel(10)) { ?>
    <div class="box">
        <h1 class='welcome'>Välkommen <?=$_SESSION['user']?>!</h1>
        <p><a href='index.php'>Till startsidan</a></p>
        <p><a href='logout.php'>Logga ut</a></p>
    </div>
 <?php   } else {
        if (isset($error)) {
            echo "<p style='color:red;'>$error</p>";
        }
    ?>
    <div class="l">
        <form action="logg.php" method="POST">
            <input type="text" id="name" name="name" required placeholder="Skriv in användarnamn här">
            <input type="password" name="pass" id="pass" required placeholder="Skriv in lösenord här">
            <input type="submit" name="btn" value="Logga in">
        </form>
    </div>
    <?php } ?>
</body>
</html>
