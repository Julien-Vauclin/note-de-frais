-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 31 juil. 2023 à 13:06
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `note-de-frais`
--

-- --------------------------------------------------------

--
-- Structure de la table `expenses_claim`
--

DROP TABLE IF EXISTS `expenses_claim`;
CREATE TABLE IF NOT EXISTS `expenses_claim` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Price` float NOT NULL,
  `Reason` varchar(255) NOT NULL,
  `Proof` longtext NOT NULL,
  `Validation_date` date DEFAULT NULL,
  `Reason_of_cancel` varchar(50) DEFAULT NULL,
  `ID_EMPLOYEE` int NOT NULL,
  `ID_STATUS` int NOT NULL DEFAULT '1',
  `ID_EXPENSES_CLAIM_TYPE` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `EXPENSES_CLAIM_EMPLOYEE_FK` (`ID_EMPLOYEE`),
  KEY `EXPENSES_CLAIM_STATUS0_FK` (`ID_STATUS`),
  KEY `EXPENSES_CLAIM_EXPENSES_CLAIM_TYPE1_FK` (`ID_EXPENSES_CLAIM_TYPE`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `expenses_claim`
--



--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `expenses_claim`
--
ALTER TABLE `expenses_claim`
  ADD CONSTRAINT `EXPENSES_CLAIM_EMPLOYEE_FK` FOREIGN KEY (`ID_EMPLOYEE`) REFERENCES `employee` (`ID`),
  ADD CONSTRAINT `EXPENSES_CLAIM_EXPENSES_CLAIM_TYPE1_FK` FOREIGN KEY (`ID_EXPENSES_CLAIM_TYPE`) REFERENCES `expenses_claim_type` (`ID`),
  ADD CONSTRAINT `EXPENSES_CLAIM_STATUS0_FK` FOREIGN KEY (`ID_STATUS`) REFERENCES `status` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;