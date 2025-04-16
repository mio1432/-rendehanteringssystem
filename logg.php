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
        <?php if($level < 10){ ?>
                <a href="logg.php">Logga In</a>
            <?php } ?>
        <div class="om"><a href="kon.php">Kontakt</a></div>
            <?php if($level >= 10){ ?>
                <a href="an.php">Ärende</a>
            <?php } ?>
            <?php if($level >= 10){ ?>
                <a href="logout.php">Logga ut</a>
            <?php } ?>
        </div>
    </div>
    <div class="mid"><img src="flenbg.png" alt=""></div>
    <?php
    if (isLevel(10)) { ?>
    <div class="box">
        <h1 id='welcome'>Välkommen <?=$_SESSION['user']?>!</h1>
        <p><a href='index.php'id="start" >Till startsidan</a></p>
        <p><a href='logout.php'id="lo" >Logga ut</a></p>
    </div>
 <?php   } else {
        if (isset($error)) {
            echo "<p style='color:red;'>$error</p>";
        }
    ?>
    <div class="l">
    <div class="login-box">
        <?php if (isset($error)) : ?>
            <div class="error-msg"><?= $error ?></div>
        <?php endif; ?>

        <form action="logg.php" method="POST">
            <h2>Logga in</h2>
            <input type="text" id="name" name="name" required placeholder="Användarnamn">
            <input type="password" name="pass" id="pass" required placeholder="Lösenord">
            <input type="submit" id="b" name="btn" value="Logga in">
        </form>
    </div>
</div>

    <?php } ?>
</body>
</html>
