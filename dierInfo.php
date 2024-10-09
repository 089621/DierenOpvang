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
        <a class="navLink" href="adoptie.php">
            <span class="link">Adoptie</span>
        </a>
        <a class="navLink" href="afstand.php">
            <span class="link">Afstand</span>
        </a>
    </nav>
</div>
<div>
    <?php

            $query = "SELECT * FROM do_dierenKaart";
            $result = mysqli_query($mysqli, $query);

            if (mysqli_num_rows($result)>0){

                while ($item = mysqli_fetch_assoc($result)) {

                    echo '<div class="flip-card">';
                        echo '<div class="flip-card-inner">';
                            echo '<div class="flip-card-front">';

                                if ($item['ras'] != NULL) {
                                    echo '<h2>' . $item['ras'] . '</h2>';
                                } elseif ($item['soort_dier'] != NULL) {
                                    echo '<h2>' . $item['soort_dier'] . '</h2>';
                                }
                                echo '<img src="' . $item['foto'] . '" alt="Foto van de dier">';
                                echo '<h4>' . $item['kleur'] . '</h4>';

                                echo '</div>';

                                echo '<div class="flip-card-back">';

                                if ($item['geboortedatum'] != NULL) {
                                    echo '<p>Geboortedatum: ' . date('d-m-Y', strtotime($item['geboortedatum'])) . '</p>';
                                }
                                if ($item['datum_binnengekomen'] != NULL) {
                                    echo '<p>Datum Binnengekomen: ' . date('d-m-Y', strtotime($item['datum_binnengekomen'])) . '</p>';
                                }
                                echo '<p>Geslacht: ' . $item['geslacht'] . '</p>';

                                if ($item['gecastreerd'] !== NULL) {
                                    echo '<p>Gecastreerd: ' . ($item['gecastreerd'] ? 'Ja' : 'Nee') . '</p>';
                                }

                                echo '<p>Overige Kenmerken: ' . $item['overige_kenmerken'] . '</p>';
                                echo '<p>Medische Gegevens: ' . $item['medische_gegevens'] . '</p>';
                                echo '<p>Adoptie kosten: €' . $item['adoptieKost'] . '</p>';
                                echo '<p>Geënt: ' . ($item['geënt'] ? 'Ja' : 'Nee') . '</p>';

                                if ($item['enting_datum'] != NULL) {
                                    echo '<p>Enting Datum: ' . date('d-m-Y', strtotime($item['enting_datum'])) . '</p>';
                                }

                                 echo '</div>';
                        echo '</div>';
                    echo '</div>';

                }
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

<script src="assets/js/cards.js" "></script>
</body>
</html>
