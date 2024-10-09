<?php
require('assets/config/config.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dieren Opvang</title>
    <link rel="stylesheet" href="assets/css/style.css">
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
<div class="adoptie-container">
    <?php

    $query = "SELECT * FROM do_dierenKaart";
    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($item = mysqli_fetch_assoc($result)) {
            echo '<div class="adoptie">';
            echo '<div class="adoptie-inner">';

            // Weergave van dierinformatie
            if ($item['ras'] != NULL) {
                echo '<h2>' . $item['ras'] . '</h2>';
            } elseif ($item['soort_dier'] != NULL) {
                echo '<h2>' . $item['soort_dier'] . '</h2>';
            }
            echo '<img src="' . $item['foto'] . '" alt="Foto van het dier">';

            // Link naar adoptieformulier met product_id van het dier
            echo '<p><a href="adoptie_form.php?der_id=' . $item['der_id'] . '">Adopteer dit dier</a></p>';

            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>Geen adopteerbare dieren gevonden.</p>';
    }

    ?>
</div>

<footer class="footer">

    <div class="contact">
        <h2>
            Contact
        </h2>
        <p>
            Contact persoon: Mihai Mereneanu
        </p>
        <p>
            E-mail: 089621@glr.nl
        </p>
        <p>
            Tel. nr.: 0612345678
        </p>
    </div>

    <div class="logo">
        <img src="assets/img/logo.png" alt="logo">
    </div>
</footer>
</body>
</html>
