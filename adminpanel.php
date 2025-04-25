<?php
require_once("inc.php");
$conn = conn("projdb");

// Bara admin
if (!isset($_SESSION['level']) || $_SESSION['level'] != 100) {
    header("Location: index.php");
    exit();
}

// Uppdatera status om admin har skickat formulär
if (isset($_POST['update_status'])) {
    $id = intval($_POST['id']);
    $new_status = $_POST['status'];
    $sql = "UPDATE tblfel SET status='$new_status' WHERE id=$id";
    mysqli_query($conn, $sql);
}

// Ta bort felanmälan
if (isset($_POST['delete_report'])) {
    $id = intval($_POST['id']);
    $sql = "DELETE FROM tblfel WHERE id=$id";
    mysqli_query($conn, $sql);
}

// Hämta alla felanmälningar
$result = mysqli_query($conn, "SELECT * FROM tblfel ORDER BY id DESC");
$level = isset($_SESSION['level']) ? intval($_SESSION['level']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adminpanel - Felanmälningar</title>
    <link rel="stylesheet" href="styleadmin.css">
</head>
<body>

<div class="header"><h1>Admin</h1></div>

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
 <div class="mid"><img src="flenbg.png" alt=""></div>
<table>
    <tr>
        <th>ID</th>
        <th>Feltyp</th>
        <th>Beskrivning</th>
        <th>Kontakt</th>
        <th>Status</th>
        <th>Datum</th>
        <th>Ändra status</th>
        <th>Ta bort</th> <!-- Ny kolumn för borttagning -->
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['feltyp']) ?></td>
            <td><?= nl2br(htmlspecialchars($row['beskrivning'])) ?></td>
            <td><?= htmlspecialchars($row['kontaktinfo']) ?></td>
            <td><?= htmlspecialchars($row['status']) ?></td>
            <td><?= $row['datum'] ?></td>
            <td>
                <form class="inline" method="POST">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <select name="status">
                        <option value="Ej behandlad" <?= $row['status'] == "Ej behandlad" ? "selected" : "" ?>>Ej behandlad</option>
                        <option value="Pågående" <?= $row['status'] == "Pågående" ? "selected" : "" ?>>Pågående</option>
                        <option value="Löst" <?= $row['status'] == "Löst" ? "selected" : "" ?>>Löst</option>
                    </select>
                    <input type="submit" name="update_status" value="Spara">
                </form>
            </td>
            <td>
                <form class="inline" method="POST" onsubmit="return confirm('Är du säker på att du vill ta bort denna felanmälan?');">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="submit" name="delete_report" value="Ta bort" style="background-color: red; color: white;">
                </form>
            </td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
