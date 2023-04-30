-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for cinema
CREATE DATABASE IF NOT EXISTS `cinema` /*!40100 DEFAULT CHARACTER SET utf32 COLLATE utf32_swedish_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cinema`;

-- Dumping structure for table cinema.acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int NOT NULL,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_acteur`),
  UNIQUE KEY `id_personne` (`id_personne`),
  CONSTRAINT `acteur_ibfk_1` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_swedish_ci;

-- Dumping data for table cinema.acteur: ~10 rows (approximately)
INSERT INTO `acteur` (`id_acteur`, `id_personne`) VALUES
	(0, 1),
	(4, 6),
	(2, 12),
	(3, 13),
	(5, 14),
	(6, 15),
	(8, 16),
	(7, 17),
	(1, 18),
	(9, 19);

-- Dumping structure for table cinema.film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int NOT NULL,
  `titre_film` varchar(200) COLLATE utf32_swedish_ci NOT NULL,
  `duree_film` int NOT NULL,
  `dateSortie_film` year NOT NULL,
  `image_film` varchar(50) COLLATE utf32_swedish_ci DEFAULT NULL,
  `note_film` decimal(2,1) DEFAULT NULL,
  `synopsis` text COLLATE utf32_swedish_ci,
  `id_realisateur` int NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `id_realisateur` (`id_realisateur`),
  CONSTRAINT `film_ibfk_1` FOREIGN KEY (`id_realisateur`) REFERENCES `realisateur` (`id_realisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_swedish_ci;

-- Dumping data for table cinema.film: ~15 rows (approximately)
INSERT INTO `film` (`id_film`, `titre_film`, `duree_film`, `dateSortie_film`, `image_film`, `note_film`, `synopsis`, `id_realisateur`) VALUES
	(0, 'Inglorious Basterds', 153, '2009', NULL, NULL, NULL, 0),
	(1, 'All About Lily Chou-Chou', 146, '2001', NULL, NULL, NULL, 1),
	(2, 'Love Letter', 117, '1995', NULL, NULL, NULL, 1),
	(3, 'Picnic', 68, '1996', NULL, NULL, NULL, 1),
	(4, 'Midsommar', 178, '2019', NULL, NULL, NULL, 2),
	(5, 'Hereditary', 127, '2018', NULL, NULL, NULL, 2),
	(6, 'Beau is Afraid', 179, '2023', NULL, NULL, NULL, 2),
	(7, 'The Lighthouse', 109, '2019', NULL, NULL, NULL, 3),
	(8, 'The Northman', 137, '2023', NULL, NULL, NULL, 3),
	(9, 'The Fabelmans', 151, '2023', NULL, NULL, NULL, 4),
	(10, 'E.T', 115, '1982', NULL, NULL, NULL, 4),
	(11, 'Les Dents de la mer', 124, '1975', NULL, NULL, NULL, 4),
	(12, 'La liste de Schindler', 195, '1993', NULL, NULL, NULL, 4),
	(13, 'Duel', 90, '1971', NULL, NULL, NULL, 4),
	(14, 'Portrait de la jeune fille en feu', 122, '2019', NULL, NULL, NULL, 5);

-- Dumping structure for table cinema.genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL,
  `nom_genre` varchar(50) COLLATE utf32_swedish_ci NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_swedish_ci;

-- Dumping data for table cinema.genre: ~14 rows (approximately)
INSERT INTO `genre` (`id_genre`, `nom_genre`) VALUES
	(0, 'Thriller'),
	(1, 'Comédie'),
	(2, 'Guerre'),
	(3, 'Drame'),
	(4, 'Fantastique'),
	(5, 'Mystère'),
	(6, 'Horreur'),
	(7, 'Action'),
	(8, 'Aventure'),
	(9, 'Famille'),
	(10, 'Science-fiction'),
	(11, 'Biographie'),
	(12, 'Historique'),
	(13, 'Romantique');

-- Dumping structure for table cinema.genrer
CREATE TABLE IF NOT EXISTS `genrer` (
  `id_film` int NOT NULL,
  `id_genre` int NOT NULL,
  PRIMARY KEY (`id_film`,`id_genre`),
  KEY `id_genre` (`id_genre`),
  CONSTRAINT `genrer_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `genrer_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_swedish_ci;

-- Dumping data for table cinema.genrer: ~32 rows (approximately)
INSERT INTO `genrer` (`id_film`, `id_genre`) VALUES
	(1, 0),
	(11, 0),
	(13, 0),
	(6, 1),
	(0, 2),
	(2, 3),
	(3, 3),
	(4, 3),
	(5, 3),
	(6, 3),
	(7, 3),
	(8, 3),
	(9, 3),
	(12, 3),
	(14, 3),
	(3, 4),
	(7, 4),
	(4, 5),
	(5, 5),
	(7, 5),
	(11, 5),
	(4, 6),
	(5, 6),
	(6, 6),
	(8, 7),
	(13, 7),
	(8, 8),
	(10, 8),
	(11, 8),
	(10, 9),
	(10, 10),
	(12, 11),
	(12, 12),
	(14, 13);

-- Dumping structure for table cinema.incarnerrole
CREATE TABLE IF NOT EXISTS `incarnerrole` (
  `id_film` int NOT NULL,
  `id_acteur` int NOT NULL,
  `id_role` int NOT NULL,
  PRIMARY KEY (`id_film`,`id_acteur`,`id_role`),
  KEY `id_acteur` (`id_acteur`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `incarnerrole_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `incarnerrole_ibfk_2` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`),
  CONSTRAINT `incarnerrole_ibfk_3` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_swedish_ci;

-- Dumping data for table cinema.incarnerrole: ~9 rows (approximately)
INSERT INTO `incarnerrole` (`id_film`, `id_acteur`, `id_role`) VALUES
	(0, 0, 0),
	(14, 2, 1),
	(14, 3, 2),
	(0, 4, 3),
	(2, 5, 4),
	(1, 6, 5),
	(3, 7, 6),
	(4, 8, 7),
	(6, 9, 9);

-- Dumping structure for table cinema.personne
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int NOT NULL,
  `nom` varchar(50) COLLATE utf32_swedish_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf32_swedish_ci NOT NULL,
  `dateDeNaissance` date NOT NULL,
  `sexe` varchar(20) CHARACTER SET utf32 COLLATE utf32_swedish_ci NOT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_swedish_ci;

-- Dumping data for table cinema.personne: ~20 rows (approximately)
INSERT INTO `personne` (`id_personne`, `nom`, `prenom`, `dateDeNaissance`, `sexe`) VALUES
	(0, 'Tarantino', 'Quentin', '1963-03-27', 'Homme'),
	(1, 'Pitt', 'William Bradley', '1963-12-18', 'Homme'),
	(2, 'Knightley', 'Keira', '1985-03-26', 'Femme'),
	(3, 'Sharma', 'Anushka', '1988-05-01', 'Femme'),
	(4, 'Padukone', 'Deepika', '1986-01-05', 'Femme'),
	(5, 'Nikkelsen', 'Mads', '1965-11-22', 'Homme'),
	(6, 'Kruger', 'Diane', '1976-07-15', 'Femme'),
	(7, 'Iwai', 'Shunji', '1963-01-24', 'Homme'),
	(8, 'Aster', 'Ari', '1986-06-15', 'Homme'),
	(9, 'Eggers', 'Robert', '1983-07-07', 'Homme'),
	(10, 'Spielberg', 'Steven', '1946-12-18', 'Homme'),
	(11, 'Sciamma', 'Céline', '1978-11-12', 'Femme'),
	(12, 'Merlant', 'Noémie', '1988-11-27', 'Femme'),
	(13, 'Golino ', 'Valeria', '1965-10-22', 'Femme'),
	(14, 'Nakayama', 'Miho', '1970-03-01', 'Femme'),
	(15, 'Ito', 'Ayumi', '1980-04-14', 'Femme'),
	(16, 'Asano', 'Tadonobu', '1973-11-27', 'Homme'),
	(17, 'Pugh', 'Florence', '1996-01-03', 'Femme'),
	(18, 'Jackson Harper', 'William', '1980-02-18', 'Homme'),
	(19, 'Phoenix', 'Joaquin', '1974-10-28', 'Homme');

-- Dumping structure for table cinema.realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_realisateur` int NOT NULL,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_realisateur`),
  UNIQUE KEY `id_personne` (`id_personne`),
  CONSTRAINT `realisateur_ibfk_1` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_swedish_ci;

-- Dumping data for table cinema.realisateur: ~6 rows (approximately)
INSERT INTO `realisateur` (`id_realisateur`, `id_personne`) VALUES
	(0, 0),
	(1, 7),
	(2, 8),
	(3, 9),
	(4, 10),
	(5, 11);

-- Dumping structure for table cinema.role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL,
  `nom_role` varchar(50) COLLATE utf32_swedish_ci NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_swedish_ci;

-- Dumping data for table cinema.role: ~10 rows (approximately)
INSERT INTO `role` (`id_role`, `nom_role`) VALUES
	(0, 'Aldo Raine dit "Aldo l\'Apache"'),
	(1, 'Marianne'),
	(2, 'La Comtesse'),
	(3, 'Bridget von Hammersmark'),
	(4, 'Itsuki Fujii'),
	(5, 'Yokô Kuno'),
	(6, 'Tsumuji'),
	(7, 'Dani'),
	(8, 'Josh'),
	(9, 'Beau wasserman');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
