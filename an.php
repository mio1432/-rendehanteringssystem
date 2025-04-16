<?php
// Anslut till databasen (eller gör en annan åtgärd)
require_once("inc.php");
$conn = conn("projdb");

if (isset($_POST['submit'])) {
    // Hämtar värdena från formuläret
    $feltyp = $_POST['feltyp'];
    $beskrivning = $_POST['beskrivning'];
    $kontaktinfo = $_POST['kontaktinfo'];

    // Spara till databasen (exempel)
    $sql = "INSERT INTO tblfel (feltyp, beskrivning, kontaktinfo) VALUES ('$feltyp', '$beskrivning', '$kontaktinfo')";
    if (mysqli_query($conn, $sql)) {
        $message = "Felanmälan skickad! Tack för din anmälan.";
    } else {
        $message = "Något gick fel, försök igen.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Felanmälan - FlensFastigheter</title>
    <link rel="stylesheet" href="stylean.css">
</head>
<body>
    <div class="header"><h1>Felanmälan</h1></div>
    
    <div id="felanmalan-form">
        <h2>Vänligen välj feltyp och fyll i informationen nedan</h2>

        <!-- Visa meddelande om felanmälan skickades -->
        <?php if (isset($message)) { echo "<p>$message</p>"; } ?>

        <form action="an.php" method="POST">
            <label for="feltyp">Välj feltyp:</label>
            <select name="feltyp" id="feltyp" required>
                <option value="Vattenläcka">Vattenläcka</option>
                <option value="Elproblem">Elproblem</option>
                <option value="Skadedjur">Skadedjur</option>
                <option value="Övrigt">Övrigt</option>
            </select><br><br>

            <label for="beskrivning">Beskriv felet:</label><br>
            <textarea name="beskrivning" id="beskrivning" rows="4" cols="50" required></textarea><br><br>

            <label for="kontaktinfo">Din kontaktinformation:</label><br>
            <input type="text" id="kontaktinfo" name="kontaktinfo" placeholder="Telefonnummer eller e-post" required><br><br>

            <input type="submit" name="submit" value="Skicka felanmälan">
        </form>
    </div>
</body>
</html>
