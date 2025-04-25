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
            $_SESSION['level'] = intval($rad['userlevel']); // säkerställ att det är ett heltal

            // Skicka admin (level 100) till adminpanel
            if ($_SESSION['level'] === 100) {
                header("Location: adminpanel.php");
                exit();
            } else {
                header("Location: logg.php"); // Vanlig användare
                exit();
            }
        } else {
            $_SESSION['user'] = "";
            $_SESSION['level'] = 0; // sätt till 0 för att undvika strul
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
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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
                <a href="logout.php">Logga Ut</a>
            <?php } ?>
            <?php if($level >= 100){ ?>
                <a href="adminpanel.php">Admin</a>
            <?php } ?>
        </div>
    </div>
    <div class="mid"></div>
    <?php
    if (isLevel(10)) { ?>
    <div class="box">
    <div class="box-content">
        <h1 id='welcome'>Välkommen <?=$_SESSION['user']?>!</h1>
        <div class="btns">
            <a href='index.php' id="start">Till startsidan</a>
            <a href='logout.php' id="lo">Logga ut</a>
        </div>
    </div>
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
    <footer class="footer">
    <div class="footer-content">
        <p>&copy; 2025 FlensFastigheter. Alla rättigheter förbehållna.</p>
        <p>Bergslagsgatan 72, Lesjöfors | VD: Peter Hagelbössa (f. 1978)</p>
    </div>
    </footer>
</body>
</html>
