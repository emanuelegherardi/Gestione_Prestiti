<?php
include "config.php";

// uso una JOIN per prendere il nome dell'oggetto insieme ai dati del prestito
$sql = "SELECT prestiti.*, oggetti.nome AS nome_oggetto
        FROM prestiti
        JOIN oggetti ON prestiti.oggetto_id = oggetti.id
        ORDER BY prestiti.data_prestito DESC";

$risultato = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <title>Storico prestiti</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Storico prestiti</h1>
    <a href="index.php" class="bottone grigio">&laquo; Torna agli oggetti</a>

    <table>
        <tr>
            <th>Oggetto</th>
            <th>Persona</th>
            <th>Data prestito</th>
            <th>Scadenza</th>
            <th>Restituito il</th>
        </tr>

        <?php while ($riga = mysqli_fetch_assoc($risultato)) { ?>
        <tr>
            <td><?php echo htmlspecialchars($riga['nome_oggetto']); ?></td>
            <td><?php echo htmlspecialchars($riga['persona']); ?></td>
            <td><?php echo $riga['data_prestito']; ?></td>
            <td><?php echo $riga['data_scadenza']; ?></td>
            <td>
                <?php
                if ($riga['data_reso'] == null) {
                    echo "<span class='rosso'>Ancora in prestito</span>";
                } else {
                    echo $riga['data_reso'];
                }
                ?>
            </td>
        </tr>
        <?php } ?>
    </table>

    <?php if (mysqli_num_rows($risultato) == 0) { ?>
        <p>Nessun prestito registrato.</p>
    <?php } ?>
</div>

</body>
</html>
