<?php

//form data opnemen
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$message = $_POST['messege'];

//pdf aanmaken
$mpdf = new \Mpdf\Mpdf();

//pdf data maken
$data  = '';

$data .= '<H1> Je details </H1>';

$data .= ' <strong>Voor Naam: </strong>' . $fname .' <br/>';
$data .= ' <strong>Achter Naam: </strong>' . $lname .' <br/>';
$data .= ' <strong>Email: </strong>' . $email .' <br/>';
$data .= ' <strong>Bericht: </strong>' . $message .' <br/>';

$mpdf ->WriteHtml($data);

$mpdf->Output('NAW.pdf', 'D');
