<?php
include "config.php";

$id = intval($_GET['id']);
$oggi = date("Y-m-d");

// segno la data di reso sul prestito ancora aperto (quello senza data_reso)
mysqli_query($conn, "UPDATE prestiti SET data_reso='$oggi' WHERE oggetto_id=$id AND data_reso IS NULL");

// rimetto l'oggetto come disponibile
mysqli_query($conn, "UPDATE oggetti SET disponibile=1 WHERE id=$id");

header("Location: index.php");
exit;
?>
