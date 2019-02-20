-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Feb 20, 2019 alle 19:59
-- Versione del server: 5.7.23
-- Versione PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tdw`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `acquisto`
--

DROP TABLE IF EXISTS `acquisto`;
CREATE TABLE IF NOT EXISTS `acquisto` (
  `ordine` int(11) NOT NULL,
  `prodotto` int(11) NOT NULL,
  `quantita` int(11) NOT NULL,
  `colore` varchar(50) NOT NULL,
  `taglia` varchar(50) NOT NULL,
  `prezzo` double NOT NULL,
  PRIMARY KEY (`ordine`,`prodotto`,`colore`,`taglia`),
  KEY `prodotto` (`prodotto`),
  KEY `ordine` (`ordine`,`prodotto`,`colore`,`taglia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

DROP TABLE IF EXISTS `carrello`;
CREATE TABLE IF NOT EXISTS `carrello` (
  `cliente` int(11) NOT NULL,
  `prodotto` int(11) NOT NULL,
  `quantita` int(11) NOT NULL,
  `colore` varchar(20) NOT NULL,
  `taglia` varchar(10) NOT NULL,
  PRIMARY KEY (`cliente`,`prodotto`,`colore`,`taglia`),
  KEY `prodotto` (`prodotto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `catalogo`
--

DROP TABLE IF EXISTS `catalogo`;
CREATE TABLE IF NOT EXISTS `catalogo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `immagine` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `catalogo`
--

INSERT INTO `catalogo` (`id`, `nome`, `immagine`) VALUES
(1, 'Swords', 'images/square_BF'),
(2, 'Manuscripts', 'images/square_manuscript'),
(3, 'Protective gears', 'images/square_gambeson'),
(4, 'Shields', 'images/large_buckler');

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descrizione` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `descrizione`) VALUES
(1, 'HEMA Leg Protection', 'We offer leg protection from major manufacturers such as Red Dragon and SPES.'),
(2, 'Steel Swords', ''),
(3, 'Syntethic Swords', 'We introduce you our own modern interpretation of training synthetic weapons. '),
(4, 'Buckler', ''),
(5, 'HEMA Torso Protection', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `data_reg` date NOT NULL,
  `ruolo` char(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`id`, `username`, `password`, `email`, `data_reg`, `ruolo`) VALUES
(1, 'admin', 'password', 'admin@saam.it', '2018-10-29', 'a');

-- --------------------------------------------------------

--
-- Struttura della tabella `colore`
--

DROP TABLE IF EXISTS `colore`;
CREATE TABLE IF NOT EXISTS `colore` (
  `colore` varchar(100) NOT NULL,
  `prodotto` int(11) NOT NULL,
  PRIMARY KEY (`colore`,`prodotto`),
  KEY `prodotto` (`prodotto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `colore`
--

INSERT INTO `colore` (`colore`, `prodotto`) VALUES
('One Color', 1),
('Black', 2),
('White', 2),
('One Color', 3),
('One Color', 4),
('One Color', 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `corriere`
--

DROP TABLE IF EXISTS `corriere`;
CREATE TABLE IF NOT EXISTS `corriere` (
  `nome` varchar(50) NOT NULL,
  `costo` float NOT NULL,
  PRIMARY KEY (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `corriere`
--

INSERT INTO `corriere` (`nome`, `costo`) VALUES
('Bartolini', 5.99),
('Poste Italiane', 3.99),
('SDA', 4.99),
('TNT', 5.49);

-- --------------------------------------------------------

--
-- Struttura della tabella `evidenzia`
--

DROP TABLE IF EXISTS `evidenzia`;
CREATE TABLE IF NOT EXISTS `evidenzia` (
  `vetrina` int(11) NOT NULL,
  `prodotto` int(11) NOT NULL,
  PRIMARY KEY (`vetrina`,`prodotto`),
  KEY `prodotto` (`prodotto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `evidenzia`
--

INSERT INTO `evidenzia` (`vetrina`, `prodotto`) VALUES
(1, 1),
(1, 2),
(2, 2),
(1, 3),
(1, 4),
(2, 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `immagine`
--

DROP TABLE IF EXISTS `immagine`;
CREATE TABLE IF NOT EXISTS `immagine` (
  `path` varchar(50) NOT NULL,
  `prodotto` int(11) NOT NULL,
  `principale` tinyint(1) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `immagine_ibfk_1` (`prodotto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `immagine`
--

INSERT INTO `immagine` (`path`, `prodotto`, `principale`) VALUES
('images/large_buckler.jpg', 5, 1),
('images/large_malleus.jpg', 3, 1),
('images/large_redDragon.jpg', 1, 1),
('images/large_spes_AP.jpg', 2, 1),
('images/square_BF.jpg', 4, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `indirizzi`
--

DROP TABLE IF EXISTS `indirizzi`;
CREATE TABLE IF NOT EXISTS `indirizzi` (
  `alias` varchar(50) NOT NULL,
  `cliente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `indirizzo` varchar(100) NOT NULL,
  `civico` int(11) NOT NULL,
  `citta` varchar(50) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `cap` int(11) NOT NULL,
  `stato` varchar(50) NOT NULL,
  `eliminato` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`alias`,`cliente`),
  KEY `cliente` (`cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `magazzino`
--

DROP TABLE IF EXISTS `magazzino`;
CREATE TABLE IF NOT EXISTS `magazzino` (
  `prodotto` int(11) NOT NULL,
  `colore` varchar(50) NOT NULL,
  `taglia` varchar(50) NOT NULL,
  `disponibilita` int(11) NOT NULL,
  PRIMARY KEY (`prodotto`,`colore`,`taglia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `magazzino`
--

INSERT INTO `magazzino` (`prodotto`, `colore`, `taglia`, `disponibilita`) VALUES
(1, 'One Color', 'One Size', 1),
(2, 'One Color', 'L', 6),
(2, 'One Color', 'M', 3),
(2, 'One Color', 'S', 5),
(3, 'One Color', 'One Size', 1),
(4, 'One Color', 'One Size', 14),
(5, 'One Color', 'One Size', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggi`
--

DROP TABLE IF EXISTS `messaggi`;
CREATE TABLE IF NOT EXISTS `messaggi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `numero` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `messaggio` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `metodipagamento`
--

DROP TABLE IF EXISTS `metodipagamento`;
CREATE TABLE IF NOT EXISTS `metodipagamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `tipo_carta` varchar(50) NOT NULL,
  `num_carta` bigint(20) NOT NULL,
  `eliminato` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cliente` (`cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

DROP TABLE IF EXISTS `ordine`;
CREATE TABLE IF NOT EXISTS `ordine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` int(11) NOT NULL,
  `eseguito` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stato` varchar(20) NOT NULL,
  `indirizzo` varchar(50) NOT NULL,
  `totale` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente` (`cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `pagamento`
--

DROP TABLE IF EXISTS `pagamento`;
CREATE TABLE IF NOT EXISTS `pagamento` (
  `ordine` int(11) NOT NULL,
  `metodo` int(11) NOT NULL,
  `stato` varchar(20) NOT NULL,
  PRIMARY KEY (`ordine`,`metodo`),
  KEY `metodo` (`metodo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

DROP TABLE IF EXISTS `prodotto`;
CREATE TABLE IF NOT EXISTS `prodotto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `desc_breve` varchar(100) NOT NULL,
  `desc_dett` varchar(500) NOT NULL,
  `prezzo` float NOT NULL,
  `categoria` int(11) NOT NULL,
  `catalogo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`),
  KEY `categoria` (`categoria`),
  KEY `catalogo` (`catalogo`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `prodotto`
--

INSERT INTO `prodotto` (`id`, `nome`, `desc_breve`, `desc_dett`, `prezzo`, `categoria`, `catalogo`) VALUES
(1, 'Red Dragon Knee And Shin Protectors', 'Offering some of the best protection and mobility on the market.', 'Offering some of the best protection and mobility on the market, our Knee and Shin Protectors are so well articulated you hardly know that you are wearing them. Unlike other leg protectors, ours articulate \"with\" the knee rather than restrict movement and most importantly offer side protection for the knee which is lacking on most of the protectors that are currently used. They are much less bulky than other protectors.\r\n\r\nOne size only.', 39.99, 1, 3),
(2, 'Gambeson Pro 350N', 'The new model of \"FG\" Gambeson PRO 350N is based on previous, well known and valued Gambeson.', 'The new model is equipped with fasteners for mounting an additional protection detachable, specially shaped, plastic pads. It lets you use the jacket as a full protection without necessity of wearing additional protectors to save the arm from hits. It also shortens the preparation time before training letting you enjoy the fight longer.', 219.95, 5, 3),
(3, 'Malleus Martialis Steel Sword', '', '', 279.99, 2, 1),
(4, 'BF Synthetic Sword v5', '', '', 78.95, 3, 1),
(5, 'Brocchiere Malleus Martialis Pro', 'Appositamente studiato per permettere una resa adeguata agli impatti con l’acciaio ', 'Il Brocchiere Pro è creato con uno speciale acciaio, appositamente studiato per permettere una resa adeguata agli impatti contro  l’acciaio coniugando un peso non eccessivo. Con i suoi 1200 gr. si accoppia perfettamente ai simulacri d’armi bianche con cui viene utilizzato.', 85.99, 4, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `prodottoscontato`
--

DROP TABLE IF EXISTS `prodottoscontato`;
CREATE TABLE IF NOT EXISTS `prodottoscontato` (
  `prodotto` int(11) NOT NULL,
  `data_inizio` date NOT NULL,
  `data_fine` date NOT NULL,
  `prezzo` float NOT NULL,
  PRIMARY KEY (`prodotto`,`data_inizio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `prodottoscontato`
--

INSERT INTO `prodottoscontato` (`prodotto`, `data_inizio`, `data_fine`, `prezzo`) VALUES
(2, '2019-02-18', '2019-02-28', 129.98),
(3, '2019-02-19', '2019-02-22', 236.89),
(5, '2019-02-01', '2019-03-26', 39.99);

-- --------------------------------------------------------

--
-- Struttura della tabella `spedizione`
--

DROP TABLE IF EXISTS `spedizione`;
CREATE TABLE IF NOT EXISTS `spedizione` (
  `corriere` varchar(50) NOT NULL,
  `ordine` int(11) NOT NULL,
  `stato` varchar(20) NOT NULL,
  PRIMARY KEY (`corriere`,`ordine`),
  KEY `spedizione_ibfk_2` (`ordine`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `taglia`
--

DROP TABLE IF EXISTS `taglia`;
CREATE TABLE IF NOT EXISTS `taglia` (
  `taglia` varchar(30) NOT NULL,
  `prodotto` int(11) NOT NULL,
  PRIMARY KEY (`taglia`,`prodotto`),
  KEY `prodotto` (`prodotto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `taglia`
--

INSERT INTO `taglia` (`taglia`, `prodotto`) VALUES
('One Size', 1),
('L', 2),
('M', 2),
('S', 2),
('One Size', 3),
('One Size', 4),
('One Size', 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `tipocategoria`
--

DROP TABLE IF EXISTS `tipocategoria`;
CREATE TABLE IF NOT EXISTS `tipocategoria` (
  `Catalogo` int(11) NOT NULL,
  `Categoria` int(11) NOT NULL,
  PRIMARY KEY (`Catalogo`,`Categoria`),
  KEY `Categoria` (`Categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `tipocategoria`
--

INSERT INTO `tipocategoria` (`Catalogo`, `Categoria`) VALUES
(3, 1),
(1, 2),
(1, 3),
(4, 4),
(3, 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `vetrina`
--

DROP TABLE IF EXISTS `vetrina`;
CREATE TABLE IF NOT EXISTS `vetrina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `vetrina`
--

INSERT INTO `vetrina` (`id`, `nome`) VALUES
(1, 'Best Seller'),
(2, 'On Sale');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `acquisto`
--
ALTER TABLE `acquisto`
  ADD CONSTRAINT `acquisto_ibfk_1` FOREIGN KEY (`prodotto`) REFERENCES `prodotto` (`id`),
  ADD CONSTRAINT `acquisto_ibfk_2` FOREIGN KEY (`ordine`) REFERENCES `ordine` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `carrello_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `carrello_ibfk_2` FOREIGN KEY (`prodotto`) REFERENCES `prodotto` (`id`);

--
-- Limiti per la tabella `colore`
--
ALTER TABLE `colore`
  ADD CONSTRAINT `colore_ibfk_1` FOREIGN KEY (`prodotto`) REFERENCES `prodotto` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `evidenzia`
--
ALTER TABLE `evidenzia`
  ADD CONSTRAINT `evidenzia_ibfk_2` FOREIGN KEY (`vetrina`) REFERENCES `vetrina` (`id`),
  ADD CONSTRAINT `evidenzia_ibfk_3` FOREIGN KEY (`prodotto`) REFERENCES `prodotto` (`id`);

--
-- Limiti per la tabella `immagine`
--
ALTER TABLE `immagine`
  ADD CONSTRAINT `immagine_ibfk_1` FOREIGN KEY (`prodotto`) REFERENCES `prodotto` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `indirizzi`
--
ALTER TABLE `indirizzi`
  ADD CONSTRAINT `indirizzi_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`);

--
-- Limiti per la tabella `magazzino`
--
ALTER TABLE `magazzino`
  ADD CONSTRAINT `magazzino_ibfk_1` FOREIGN KEY (`prodotto`) REFERENCES `prodotto` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `metodipagamento`
--
ALTER TABLE `metodipagamento`
  ADD CONSTRAINT `metodipagamento_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`);

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `ordine_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`);

--
-- Limiti per la tabella `pagamento`
--
ALTER TABLE `pagamento`
  ADD CONSTRAINT `pagamento_ibfk_1` FOREIGN KEY (`metodo`) REFERENCES `metodipagamento` (`id`),
  ADD CONSTRAINT `pagamento_ibfk_2` FOREIGN KEY (`ordine`) REFERENCES `ordine` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  ADD CONSTRAINT `prodotto_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `prodotto_ibfk_2` FOREIGN KEY (`catalogo`) REFERENCES `catalogo` (`id`);

--
-- Limiti per la tabella `prodottoscontato`
--
ALTER TABLE `prodottoscontato`
  ADD CONSTRAINT `prodottoscontato_ibfk_1` FOREIGN KEY (`prodotto`) REFERENCES `prodotto` (`id`);

--
-- Limiti per la tabella `spedizione`
--
ALTER TABLE `spedizione`
  ADD CONSTRAINT `spedizione_ibfk_2` FOREIGN KEY (`ordine`) REFERENCES `ordine` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `taglia`
--
ALTER TABLE `taglia`
  ADD CONSTRAINT `taglia_ibfk_1` FOREIGN KEY (`prodotto`) REFERENCES `prodotto` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tipocategoria`
--
ALTER TABLE `tipocategoria`
  ADD CONSTRAINT `tipocategoria_ibfk_1` FOREIGN KEY (`Catalogo`) REFERENCES `catalogo` (`id`),
  ADD CONSTRAINT `tipocategoria_ibfk_2` FOREIGN KEY (`Categoria`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
