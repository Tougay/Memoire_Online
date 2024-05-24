-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 24 mai 2024 à 11:20
-- Version du serveur : 10.6.17-MariaDB
-- Version de PHP : 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `memoire_online`
--

-- --------------------------------------------------------

--
-- Structure de la table `memoires`
--

CREATE TABLE `memoires` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `universite` varchar(255) NOT NULL,
  `annee` int(11) NOT NULL,
  `fichier` varchar(255) NOT NULL,
  `domaine` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `memoires`
--

INSERT INTO `memoires` (`id`, `titre`, `auteur`, `universite`, `annee`, `fichier`, `domaine`) VALUES
(1, 'Système de gestion des étudiants', 'Hassan Ahmat Fadoul', 'ENASTIC', 2023, '158811.pdf', ''),
(2, 'Système de gestion de récrutement en ligne', 'Idriss Mht Ali', 'ENASTIC', 2023, 'CHMSC Student Management System.pdf', 'Informatique et Télécommunications'),
(3, 'Conception et réalisation d\'une application de gestion des ressources humaines', 'Hassan Fadoul', 'ENASTIC', 2020, '33103-les-bases-d-excel.pdf', 'Informatique et Télécommunications'),
(4, 'Gestion des Examen en ligne', 'Idriss Mht Ali', 'ENASTIC', 2021, 'pmtic_creation.pdf', 'Informatique et Télécommunications');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `memoires`
--
ALTER TABLE `memoires`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `memoires`
--
ALTER TABLE `memoires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
