<?php
require('assets/config/config.php')
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
        <a class="navLink" href="adoptie.php">
            <span class="link">Adoptie</span>
        </a>
    </nav>
</div>


<div class="afstand-form">


    <h1 class="form-title">Klantenkaart</h1>

    <form action="verwerk.php" method="post">
        <!-- Klantgegevens -->
        <label for="voornaam">Voornaam:</label>
        <input type="text" id="voornaam" name="voornaam" required><br><br>

        <label for="tussenvoegsel">Tussenvoegsel:</label>
        <input type="text" id="tussenvoegsel" name="tussenvoegsel"><br><br>

        <label for="achternaam">Achternaam:</label>
        <input type="text" id="achternaam" name="achternaam" required><br><br>

        <label for="adres">Volledig adres:</label>
        <textarea id="adres" name="adres" rows="3" required></textarea><br><br>

        <label for="telefoon">Telefoonnummer(s):</label>
        <input type="text" id="telefoon" name="telefoon" required><br><br>

        <label for="email">Mailadres(sen):</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="legitimatie">Legitimatie (soort en nummer):</label>
        <input type="text" id="legitimatie" name="legitimatie" required><br><br>

        <hr>

        <h2>Dierenkaart</h2>
        <!-- Diergegevens -->
        <label for="soort">Soort dier:</label>
        <input type="text" id="soort" name="soort" required><br><br>

        <label for="ras">Ras:</label>
        <input type="text" id="ras" name="ras"><br><br>

        <label for="kleur">Kleur:</label>
        <input type="text" id="kleur" name="kleur" required><br><br>

        <label for="geboortedatum">Geboortedatum:</label>
        <input type="date" id="geboortedatum" name="geboortedatum" required><br><br>

        <label for="datum_binnengekomen">Datum aankomst:</label>
        <input type="date" id="datum_binnengekomen" name="datum_binnengekomen" required><br><br>

        <label for="geslacht">Geslacht:</label>
        <select id="geslacht" name="geslacht" required>
            <option value="man">Man</option>
            <option value="vrouw">Vrouw</option>
        </select><br><br>

        <label for="gecastreerd">Gecastreerd:</label>
        <input type="radio" id="gecastreerd_ja" name="gecastreerd" value="ja" required>
        <label for="gecastreerd_ja">Ja</label>
        <input type="radio" id="gecastreerd_nee" name="gecastreerd" value="nee" required>
        <label for="gecastreerd_nee">Nee</label><br><br>

        <label for="kenmerken">Overige kenmerken:</label>
        <textarea id="kenmerken" name="kenmerken" rows="3"></textarea><br><br>

        <label for="medische_gegevens">Medische gegevens:</label>
        <textarea id="medische_gegevens" name="medische_gegevens" rows="3"></textarea><br><br>

        <label for="inenting">Geënt tegen:</label>
        <input type="text" id="inenting" name="inenting"><br><br>

        <label for="datum_inenting">Datum enting:</label>
        <input type="date" id="datum_inenting" name="datum_inenting"><br><br>

        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto"><br><br>

        <label for="documenten">Upload documenten:</label>
        <input type="file" id="documenten" name="documenten" multiple><br><br>

        <input type="submit" value="Versturen">
    </form>

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
