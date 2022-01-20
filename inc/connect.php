<?php
$servername = 'localhost';
$username = 'root';
$passwd = '';
$dbname = 'parfume.art';
try {
    $conn = new mysqli($servername,$username,$passwd,$dbname);
} catch (Exception $e) {
    die("Opps something went wrong...");
}
