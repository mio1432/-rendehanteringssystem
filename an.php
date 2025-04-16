<?php
require_once("inc.php");
$conn = conn("projdb");

if (isset($_POST['submit'])) {
    $feltyp = $_POST['feltyp'];
    $beskrivning = $_POST['beskrivning'];
    $kontaktinfo = $_POST['kontaktinfo'];

    $sql = "INSERT INTO tblfel (feltyp, beskrivning, kontaktinfo) VALUES ('$feltyp', '$beskrivning', '$kontaktinfo')";
    if (mysqli_query($conn, $sql)) {
        $message = "Felanmälan skickad! Tack för din anmälan.";
    } else {
        $message = "Något gick fel, försök igen.";
    }
}

$level = isset($_SESSION['level']) ? intval($_SESSION['level']) : 0;
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Felanmälan - FlensFastigheter</title>
    <link rel="stylesheet" href="stylean.css">
</head>
<body>
    <div class="header"><h1>Felanmälan</h1></div>

    <div id="stuff">
        <div class="hem"><a href="index.php">Hem</a></div>
        <div class="om"><a href="kon.php">Kontakt</a></div>
        <?php if($level >= 10){ ?>
            <a href="logout.php">Logga ut</a>
        <?php } ?>
    </div>

    <div id="felanmalan-form">
        <h2>Vänligen välj feltyp och fyll i informationen nedan</h2>

        <?php if (isset($message)) { echo "<p class='success-msg'>$message</p>"; } ?>

        <form action="an.php" method="POST">
            <label for="feltyp">Välj feltyp:</label>
            <select name="feltyp" id="feltyp" required>
                <option value="">-- Välj --</option>
                <option value="Vattenläcka">Vattenläcka</option>
                <option value="Elproblem">Elproblem</option>
                <option value="Skadedjur">Skadedjur</option>
                <option value="Övrigt">Övrigt</option>
            </select>

            <label for="beskrivning">Beskriv felet:</label>
            <textarea name="beskrivning" id="beskrivning" rows="5" required></textarea>

            <label for="kontaktinfo">Din kontaktinformation:</label>
            <input type="text" id="kontaktinfo" name="kontaktinfo" placeholder="Telefonnummer eller e-post" required>

            <input type="submit" name="submit" value="Skicka felanmälan">
        </form>
    </div>
</body>
</html>
