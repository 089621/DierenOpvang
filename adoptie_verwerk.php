<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('assets/config/config.php');
require('assets/tcpdf/TCPDF-main/tcpdf.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoload file
require 'vendor/autoload.php';

var_dump($_POST);
// Controleer of het formulier is verzonden via POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Verkrijg en valideer de ontvangen gegevens
    $derId = $_POST['der_id'];
    $klantNaam = htmlspecialchars($_POST['klant_naam']);
    $klantAdres = htmlspecialchars($_POST['klant_adres']);
    $klantEmail = htmlspecialchars($_POST['klant_email']);
    $klantTelefoon = htmlspecialchars($_POST['klant_telefoon']);
    $controleMoment = htmlspecialchars($_POST['controle_moment']);
    $adoptieDatum = date('Y-m-d');

    // Query om informatie op te halen over het geselecteerde dier
    $query = "SELECT * FROM do_dierenKaart WHERE der_id = $derId";
    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) > 0) {
        $dier = mysqli_fetch_assoc($result);

        // Insert adoptiegegevens in de database
        $insertQuery = "INSERT INTO do_adopties (der_id, klant_naam, klant_adres, klant_telefoon, klant_email, controle_moment, adoptie_datum)";
        $insertQuery .=  "VALUES ('$derId', '$klantNaam', '$klantAdres', '$klantTelefoon', '$klantEmail', '$controleMoment', '$adoptieDatum')";

        if (mysqli_query($mysqli, $insertQuery)) {
            // Adoptiegegevens succesvol opgeslagen in de database

            // Maak een nieuw PDF-document
            $pdf = new TCPDF();
            $pdf->SetFont('helvetica', '', 12);
            $pdf->AddPage();
            $pdf->Write(0, 'Adoptiebevestiging');
            $pdf->Ln();
            $pdf->Write(0, '----------------------------------');
            $pdf->Ln();
            $pdf->Write(0, 'Gekozen dier: ' . $dier['soort_dier'] . ' - ' . $dier['ras']);
            $pdf->Ln();
            $pdf->Write(0, 'Klantnaam: ' . $klantNaam);
            $pdf->Ln();
            $pdf->Write(0, 'Klantadres: ' . $klantAdres);
            $pdf->Ln();
            $pdf->Write(0, 'Controle moment: ' . $controleMoment);
            $pdf->Ln();

            // Definieer het absolute pad naar het PDF-bestand
            $pdfFilePath = '/var/www/vhosts/89621.stu.sd-lab.nl/httpdocs/dierenOpvang/adoptiebevestiging_' . $derId . '.pdf';

            // Output de PDF-inhoud naar het bestand
            $pdf->Output($pdfFilePath, 'F');

            // Verstuur e-mail met PDF als bijlage naar de klant
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Gmail SMTP-server
            $mail->Port = 587; // SMTP-poort voor Gmail
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = 'unnamed.person.intsat@gmail.com'; // Jouw Gmail e-mailadres
            $mail->Password = 'xyah hugd lund uhda'; // Jouw Gmail wachtwoord
            $mail->setFrom('unnamed.person.intsat@gmail.com', 'Mihai Mereneanu'); // Afzender
            $mail->addAddress($klantEmail, $klantNaam); // Ontvanger (klant)
            $mail->Subject = 'Adoptiebevestiging';
            $mail->Body = 'Beste ' . $klantNaam . ', hierbij ontvangt u de adoptiebevestiging.';
            $mail->addAttachment($pdfFilePath); // Voeg PDF toe als bijlage

            if ($mail->send()) {
                // E-mail met PDF is succesvol verzonden
                unlink($pdfFilePath); // Verwijder het tijdelijke PDF-bestand
                header("Location: adoptie_verwerk.php?der_id=$derId");
                exit();
            } else {
                // Fout bij het verzenden van de e-mail
                echo "Fout bij het verzenden van de e-mail: " . $mail->ErrorInfo;
            }
        } else {
            // Fout bij het opslaan van adoptiegegevens
            echo "Fout bij het opslaan van adoptiegegevens.";
        }
    } else {
        // Dier niet gevonden in de database
        echo "Dier niet gevonden.";
    }

    // Sluit de databaseverbinding
    mysqli_close($mysqli);
} else {
    die("No valid POST request received");

}

