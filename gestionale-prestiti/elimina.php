<?php
include "config.php";

$id = intval($_GET['id']);

// prima controllo se l'oggetto e' in prestito, in quel caso non lo cancello
$check = mysqli_query($conn, "SELECT disponibile FROM oggetti WHERE id=$id");
$riga = mysqli_fetch_assoc($check);

if ($riga && $riga['disponibile'] == 0) {
    echo "Non puoi eliminare un oggetto che e' attualmente in prestito. <a href='index.php'>Torna indietro</a>";
    exit;
}

// cancello anche eventuali prestiti vecchi collegati, altrimenti la foreign key da' errore
mysqli_query($conn, "DELETE FROM prestiti WHERE oggetto_id=$id");
mysqli_query($conn, "DELETE FROM oggetti WHERE id=$id");

header("Location: index.php");
exit;
?>
