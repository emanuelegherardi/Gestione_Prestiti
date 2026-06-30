<?php
include "config.php";

$id = intval($_GET['id']);

// quando confermo il prestito
if (isset($_POST['presta'])) {
    $persona = mysqli_real_escape_string($conn, $_POST['persona']);
    $scadenza = mysqli_real_escape_string($conn, $_POST['scadenza']);
    $oggi = date("Y-m-d");

    // registro il prestito
    $sql = "INSERT INTO prestiti (oggetto_id, persona, data_prestito, data_scadenza) VALUES ($id, '$persona', '$oggi', '$scadenza')";
    mysqli_query($conn, $sql);

    // segno l'oggetto come non disponibile
    mysqli_query($conn, "UPDATE oggetti SET disponibile=0 WHERE id=$id");

    header("Location: index.php");
    exit;
}

// carico il nome dell'oggetto per mostrarlo
$risultato = mysqli_query($conn, "SELECT nome FROM oggetti WHERE id=$id");
$oggetto = mysqli_fetch_assoc($risultato);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <title>Presta oggetto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Presta: <?php echo htmlspecialchars($oggetto['nome']); ?></h1>

    <form method="post" action="presta.php?id=<?php echo $id; ?>" class="form">
        <label>A chi lo presti?</label>
        <input type="text" name="persona" required>

        <label>Data restituzione prevista</label>
        <input type="date" name="scadenza">

        <div class="azioni">
            <button type="submit" name="presta" class="bottone">Conferma prestito</button>
            <a href="index.php" class="bottone grigio">Annulla</a>
        </div>
    </form>
</div>

</body>
</html>
