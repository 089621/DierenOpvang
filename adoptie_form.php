<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    require 'assets/config/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dieren Opvang</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/afstandForm.css">
</head>
<body>
<div class="header">
    <h1 class="title">
        Dieren Opvang
    </h1>
    <nav class="navigation">
        <a class="navLink" href="home.php">
            <span class="link">Home</span>
        </a>
        <a class="navLink" href="dierInfo.php">
            <span class="link">Dieren Informatie</span>
        </a>
        <a class="navLink" href="afstand.php">
            <span class="link">Afstand</span>
        </a>
    </nav>
</div>


<div class="adoptie-formulier-container">
    <?php
    // Ontvang het der_id van het geselecteerde dier
    if (isset($_GET['der_id'])) {
        $derId = $_GET['der_id'];

        // Query om informatie op te halen over het geselecteerde dier
        $query = "SELECT * FROM do_dierenKaart WHERE der_id = $derId";
        $result = mysqli_query($mysqli, $query);

        if (mysqli_num_rows($result) > 0) {
            $item = mysqli_fetch_assoc($result);
            echo '<h2 class="form-title">' . $item['ras'] . '</h2>';
            echo '<img src="' . $item['foto'] . '" alt="Foto van het dier">';

            // Formulier voor adoptie
            echo '<form method="post" action="adoptie_verwerk.php">';
            echo '<input type="hidden" name="der_id" value="' . $derId . '">';
            echo '<label for="klant_naam">Uw naam:</label>';
            echo '<input type="text" id="klant_naam" name="klant_naam" required><br>';
            echo '<label for="klant_adres">Uw adres:</label>';
            echo '<input type="text" id="klant_adres" name="klant_adres" required><br>';
            echo '<label for="klant_adres">Uw e-mail adres:</label>';
            echo '<input type="text" id="klant_email" name="klant_email" required><br>';
            echo '<label for="klant_telefoon">Uw telefoonnummer:</label> <br>';
            echo '<input type="tel" id="klant_telefoon" name="klant_telefoon" required><br>';
            echo '<label for="controle_moment">Gewenst controle moment:</label>';
            echo '<input type="text" id="controle_moment" name="controle_moment" required><br>';
            echo ' <input type="submit" name="submit" value="Verzenden">';
            echo '</form>';
        } else {
            echo '<p>Dier niet gevonden.</p>';
        }

        // Sluit databaseverbinding
        mysqli_close($mysqli);
    } else {
        echo '<p>Geen dier geselecteerd.</p>';
    }
    ?>
</div>
</body>
</html>