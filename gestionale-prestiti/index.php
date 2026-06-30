<?php
include "config.php";

// se c'e' una ricerca la prendo, altrimenti stringa vuota
$cerca = "";
if (isset($_GET['cerca'])) {
    $cerca = $_GET['cerca'];
}

// costruisco la query. uso la ricerca solo se ho scritto qualcosa
if ($cerca != "") {
    $cerca_sql = mysqli_real_escape_string($conn, $cerca);
    $sql = "SELECT * FROM oggetti WHERE nome LIKE '%$cerca_sql%' OR categoria LIKE '%$cerca_sql%' ORDER BY nome";
} else {
    $sql = "SELECT * FROM oggetti ORDER BY nome";
}

$risultato = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <title>Gestionale Prestiti</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>
        <svg class="icona-titolo" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#3498db" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
        </svg>
        Gestionale Prestiti
    </h1>

    <div class="barra">
        <a href="aggiungi.php" class="bottone">+ Aggiungi oggetto</a>
        <a href="storico.php" class="bottone grigio">Storico prestiti</a>

        <form method="get" action="index.php" class="cerca">
            <input type="text" name="cerca" placeholder="Cerca per nome o categoria" value="<?php echo htmlspecialchars($cerca); ?>">
            <button type="submit">Cerca</button>
        </form>
    </div>

    <table>
        <tr>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Stato</th>
            <th>Azioni</th>
        </tr>

        <?php while ($riga = mysqli_fetch_assoc($risultato)) { ?>
        <tr>
            <td><?php echo htmlspecialchars($riga['nome']); ?></td>
            <td><?php echo htmlspecialchars($riga['categoria']); ?></td>
            <td>
                <?php if ($riga['disponibile'] == 1) { ?>
                    <span class="verde">Disponibile</span>
                <?php } else { ?>
                    <span class="rosso">In prestito</span>
                <?php } ?>
            </td>
            <td>
                <a href="modifica.php?id=<?php echo $riga['id']; ?>">Modifica</a> |
                <?php if ($riga['disponibile'] == 1) { ?>
                    <a href="presta.php?id=<?php echo $riga['id']; ?>">Presta</a> |
                <?php } else { ?>
                    <a href="restituisci.php?id=<?php echo $riga['id']; ?>">Restituisci</a> |
                <?php } ?>
                <a href="elimina.php?id=<?php echo $riga['id']; ?>" onclick="return confirm('Sicuro di voler eliminare questo oggetto?');">Elimina</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <?php if (mysqli_num_rows($risultato) == 0) { ?>
        <p>Nessun oggetto trovato.</p>
    <?php } ?>
</div>

<p class="firma">Emanuele Gherardi</p>

</body>
</html>