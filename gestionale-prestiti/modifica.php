<?php
include "config.php";

// prendo l'id dall'url
$id = $_GET['id'];
$id = intval($id);

// se ho inviato il form aggiorno
if (isset($_POST['salva'])) {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
    $descrizione = mysqli_real_escape_string($conn, $_POST['descrizione']);

    $sql = "UPDATE oggetti SET nome='$nome', categoria='$categoria', descrizione='$descrizione' WHERE id=$id";
    mysqli_query($conn, $sql);

    header("Location: index.php");
    exit;
}

// carico i dati attuali dell'oggetto per riempire il form
$sql = "SELECT * FROM oggetti WHERE id=$id";
$risultato = mysqli_query($conn, $sql);
$oggetto = mysqli_fetch_assoc($risultato);

if (!$oggetto) {
    echo "Oggetto non trovato.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <title>Modifica oggetto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Modifica oggetto</h1>

    <form method="post" action="modifica.php?id=<?php echo $id; ?>" class="form">
        <label>Nome</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($oggetto['nome']); ?>" required>

        <label>Categoria</label>
        <input type="text" name="categoria" value="<?php echo htmlspecialchars($oggetto['categoria']); ?>">

        <label>Descrizione</label>
        <textarea name="descrizione" rows="4"><?php echo htmlspecialchars($oggetto['descrizione']); ?></textarea>

        <div class="azioni">
            <button type="submit" name="salva" class="bottone">Salva modifiche</button>
            <a href="index.php" class="bottone grigio">Annulla</a>
        </div>
    </form>
</div>

</body>
</html>
