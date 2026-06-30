<?php
include "config.php";

// quando invio il form salvo il nuovo oggetto
if (isset($_POST['salva'])) {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
    $descrizione = mysqli_real_escape_string($conn, $_POST['descrizione']);

    $sql = "INSERT INTO oggetti (nome, categoria, descrizione, disponibile) VALUES ('$nome', '$categoria', '$descrizione', 1)";
    mysqli_query($conn, $sql);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <title>Aggiungi oggetto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Aggiungi un oggetto</h1>

    <form method="post" action="aggiungi.php" class="form">
        <label>Nome</label>
        <input type="text" name="nome" required>

        <label>Categoria</label>
        <input type="text" name="categoria" placeholder="Libri, Attrezzi, DVD...">

        <label>Descrizione</label>
        <textarea name="descrizione" rows="4"></textarea>

        <div class="azioni">
            <button type="submit" name="salva" class="bottone">Salva</button>
            <a href="index.php" class="bottone grigio">Annulla</a>
        </div>
    </form>
</div>

</body>
</html>
