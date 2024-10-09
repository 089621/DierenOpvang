<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$db_hostname = 'localhost';
$db_user = 'mihai';
$db_password = 'rf2wM5!60';
$db_name = 'db089621';

$mysqli = mysqli_connect($db_hostname, $db_user, $db_password, $db_name);

if (!$mysqli) {
    echo 'Geen verbinding met de database';
} else {
// echo "Verbonden met de database";
}

