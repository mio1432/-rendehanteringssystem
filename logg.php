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
            header("Location: index.php");
            exit(); // <- superviktig!
        } else {
            $_SESSION['user'] = "";
            $_SESSION['level'] = "";
            $error = "Fel användarnamn eller lösenord!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logga In</title>
    <link rel="stylesheet" href="stylelogg.css">
</head>
<body>
    <div class="header"><h1>FlensFastigheter</h1></div>
    <div id="stuff">
        <div class="hem"><a href="index.php">Hem</a></div>
        <div class="logg"><a href="logg.php">Logga In</a></div>
        <div class="om"><a href="kon.php">Kontakt</a></div>
    </div>

    <?php
    if (isLevel(10)) {
        echo "<h1>Välkommen " . $_SESSION['user'] . "</h1>";
        echo "<a href='index.php'>Till startsidan</a>";
    } else {
        if (isset($error)) {
            echo "<p style='color:red;'>$error</p>";
        }
    ?>
    <form action="logg.php" method="POST">
        <input type="text" id="name" name="name" required placeholder="Skriv in användarnamn här">
        <input type="password" name="pass" id="pass" required placeholder="Skriv in lösenord här">
        <input type="submit" name="btn" value="Logga in">
    </form>
    <?php } ?>
</body>
</html>
