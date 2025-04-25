<?php
require_once("inc.php");
$conn = conn("projdb");

// Kontrollera att endast admin (level 100) får se denna sida
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 100) {
    header("Location: index.php");
    exit();
}

// Hämta alla felanmälningar
$sql = "SELECT * FROM tblfel ORDER BY id DESC"; // senaste överst
$result = mysqli_query($conn, $sql);
$level = isset($_SESSION['level']) ? intval($_SESSION['level']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adminpanel - Felanmälningar</title>
    <link rel="stylesheet" href="styleadmin.css"> <!-- Du kan styla hur du vill -->
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
            <?php if($level >= 100){ ?>
                <a href="adminpanel.php">Admin</a>
            <?php } ?>
        </div>
    <div class="content">
        <table>
            <tr>
                <th>ID</th>
                <th>Feltyp</th>
                <th>Beskrivning</th>
                <th>Kontaktinfo</th>
                <th>Datum</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['feltyp']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['beskrivning'])) ?></td>
                    <td><?= htmlspecialchars($row['kontaktinfo']) ?></td>
                    <td><?= $row['datum'] ?? '-' ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
