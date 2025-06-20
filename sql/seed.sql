-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 20 juin 2025 à 19:28
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `touche_pas_au_klaxon`
--

--
-- Déchargement des données de la table `agence`
--

INSERT INTO `agence` (`id`, `nom`, `ville`) VALUES
(1, 'Agence Paris', 'Paris'),
(2, 'Agence Lyon', 'Lyon'),
(3, 'Agence Marseille', 'Marseille'),
(4, 'Agence Toulouse', 'Toulouse'),
(5, 'Agence Nice', 'Nice'),
(6, 'Agence Nantes', 'Nantes'),
(7, 'Agence Strasbourg', 'Strasbourg'),
(8, 'Agence Montpellier', 'Montpellier'),
(9, 'Agence Bordeaux', 'Bordeaux'),
(10, 'Agence Lille', 'Lille'),
(11, 'Agence Rennes', 'Rennes'),
(12, 'Agence Reims', 'Reims');

--
-- Déchargement des données de la table `trajet`
--

INSERT INTO `trajet` (`id`, `id_Utilisateur`, `id_agence_depart`, `id_agence_arrivee`, `date_depart`, `date_arrivee`, `places`) VALUES
(1, 1, 1, 2, '2026-06-12 08:00:00', '2026-06-12 10:00:00', 2),
(2, 2, 3, 4, '2026-06-13 09:00:00', '2026-06-13 11:00:00', 3),
(3, 3, 5, 6, '2026-06-14 14:00:00', '2026-06-14 16:00:00', 1);

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `téléphone`, `est_admin`) VALUES
(1, 'Martin', 'Alexandre', 'alexandre.martin@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0612345678', 0),
(2, 'Dubois', 'Sophie', 'sophie.dubois@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0698765432', 0),
(3, 'Bernard', 'Julien', 'julien.bernard@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0622446688', 0),
(4, 'Moreau', 'Camille', 'camille.moreau@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0611223344', 0),
(5, 'Lefèvre', 'Lucie', 'lucie.lefevre@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0777889900', 0),
(6, 'Leroy', 'Thomas', 'thomas.leroy@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0655443322', 0),
(7, 'Roux', 'Chloé', 'chloe.roux@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0633221199', 0),
(8, 'Petit', 'Maxime', 'maxime.petit@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0766778899', 0),
(9, 'Garnier', 'Laura', 'laura.garnier@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0688776655', 0),
(10, 'Dupuis', 'Antoine', 'antoine.dupuis@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0744556677', 0),
(11, 'Lefebvre', 'Emma', 'emma.lefebvre@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0699887766', 0),
(12, 'Fontaine', 'Louis', 'louis.fontaine@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0655667788', 0),
(13, 'Chevalier', 'Clara', 'clara.chevalier@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0788990011', 0),
(14, 'Robin', 'Nicolas', 'nicolas.robin@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0644332211', 0),
(15, 'Gauthier', 'Marine', 'marine.gauthier@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0677889922', 0),
(16, 'Fournier', 'Pierre', 'pierre.fournier@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0722334455', 0),
(17, 'Girard', 'Sarah', 'sarah.girard@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0688665544', 0),
(18, 'Lambert', 'Hugo', 'hugo.lambert@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0611223366', 0),
(19, 'Masson', 'Julie', 'julie.masson@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0733445566', 0),
(20, 'Henry', 'Arthur', 'arthur.henry@email.fr', '$2y$10$8.zwH6hxuMwcLOACAIbqUuYz9Co7gny4XC/nJMfeAUxkUrZtBm0Ve', '0666554433', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
