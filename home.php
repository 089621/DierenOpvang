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
        <a class="navLink" href="dierInfo.php">
            <span class="link">Dierinfo</span>
        </a>
        <a class="navLink" href="adoptie.php">
            <span class="link">Adoptie</span>
        </a>
        <a class="navLink" href="afstand.php">
            <span class="link">Afstand</span>
        </a>
    </nav>
</div>

<div class="container">
<div class="information">
        <h2>
            Dieren Opvang
        </h2>
        <p>In Nederland draaien veel dierenopvangcentra voornamelijk op vrijwilligerswerk, aangezien ze slechts beperkte of geen subsidies ontvangen. Deze centra zijn sterk afhankelijk van giften en donaties om de dagelijkse operaties te financieren en de dieren te verzorgen die ze opvangen. Ondanks de toewijding van vrijwilligers en de genereuze steun van de gemeenschap, worden deze opvangcentra geconfronteerd met de uitdaging om financieel en operationeel efficiënt te blijven.</p>
        <p>Een van de belangrijkste aspecten waar dierenopvangcentra mee te maken hebben, naast het bieden van onderdak en zorg aan dieren in nood, is het bijhouden van nauwkeurige administratie. Dit omvat financiële administratie om inkomsten en uitgaven te monitoren, evenals administratie met betrekking tot de dieren zelf, zoals medische geschiedenissen, vaccinaties en adoptiegegevens.</p>
    </div>

<div class="slideshow-container">
    <?php

        $query = "SELECT foto FROM do_dierenKaart";
        $result = mysqli_query($mysqli, $query);

        if (mysqli_num_rows($result) >0){
            while ($foto = mysqli_fetch_assoc($result)){
                echo '<div class="mySlides">';
                // Output image data from the database (replace 'foto' with your actual column name)
                echo '<img src="' . $foto['foto']. ' "alt = " foto dier " "' . '">';
                echo '</div>';
            }
        }
    ?>

</div>
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

<script src="assets/js/slideshow.js"></script>
</body>
</html>
