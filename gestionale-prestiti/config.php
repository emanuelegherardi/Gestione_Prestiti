<?php
// dati di connessione al database
// modificare user e password con quelli del proprio MySQL (con XAMPP di solito user=root e password vuota)

$host = "localhost";
$user = "root";
$password = "";
$nomedb = "gestionale_prestiti";

$conn = mysqli_connect($host, $user, $password, $nomedb);

if (!$conn) {
    die("Errore di connessione al database: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>
