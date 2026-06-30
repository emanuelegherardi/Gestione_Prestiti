-- Gestionale prestiti
-- Database e tabelle. Importare questo file in phpMyAdmin prima di usare il sito.

CREATE DATABASE IF NOT EXISTS gestionale_prestiti DEFAULT CHARACTER SET utf8;
USE gestionale_prestiti;

-- tabella degli oggetti che possono essere prestati
CREATE TABLE oggetti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    categoria VARCHAR(80),
    descrizione TEXT,
    disponibile TINYINT(1) DEFAULT 1
);

-- tabella dei prestiti
-- quando un oggetto e' in prestito, data_reso resta NULL finche' non torna
CREATE TABLE prestiti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    oggetto_id INT NOT NULL,
    persona VARCHAR(150) NOT NULL,
    data_prestito DATE NOT NULL,
    data_scadenza DATE,
    data_reso DATE DEFAULT NULL,
    FOREIGN KEY (oggetto_id) REFERENCES oggetti(id)
);

-- qualche dato di esempio per non partire da zero
INSERT INTO oggetti (nome, categoria, descrizione, disponibile) VALUES
('Il nome della rosa', 'Libri', 'Romanzo di Umberto Eco', 1),
('Trapano Bosch', 'Attrezzi', 'Trapano avvitatore a batteria', 1),
('Il Signore degli Anelli (DVD)', 'DVD', 'Trilogia versione estesa', 0),
('Scala in alluminio', 'Attrezzi', 'Scala 3 gradini', 1);

INSERT INTO prestiti (oggetto_id, persona, data_prestito, data_scadenza, data_reso) VALUES
(3, 'Marco Rossi', '2025-06-01', '2025-06-30', NULL);
