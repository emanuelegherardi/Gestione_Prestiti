# Gestionale Prestiti Emanuele Gherardi

Applicazione web per tenere traccia di oggetti prestati (libri, attrezzi, DVD...): chi li ha presi, quando e quando vanno restituiti.

## Funzionalità
- Elenco degli oggetti con stato (disponibile / in prestito)
- Aggiunta, modifica ed eliminazione degli oggetti
- Registrazione di un prestito con persona e data di restituzione
- Restituzione e aggiornamento automatico dello stato
- Storico di tutti i prestiti passati
- Ricerca per nome o categoria

## Tecnologie usate
- PHP
- MySQL
- HTML / CSS

## Come avviarlo in locale
1. Installare un ambiente con PHP e MySQL (es. XAMPP)
2. Copiare la cartella del progetto in `htdocs`
3. Importare il file `database.sql` da phpMyAdmin (crea il database e qualche dato di esempio)
4. Se serve, modificare user e password in `config.php`
5. Aprire il browser su `http://localhost/gestionale-prestiti/`

## Struttura del database
- **oggetti**: gli oggetti prestabili, con un campo che indica se sono disponibili
- **prestiti**: collegata a oggetti tramite chiave esterna, registra ogni prestito con data e restituzione

