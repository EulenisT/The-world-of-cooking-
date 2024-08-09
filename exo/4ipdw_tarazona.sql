-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 17 avr. 2023 à 09:22
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
-- Base de données : `4ipdw_tarazona`
--
CREATE DATABASE IF NOT EXISTS `4ipdw_tarazona` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE `4ipdw_tarazona`;

-- --------------------------------------------------------

--
-- Structure de la table `t_catalogue`
--

DROP TABLE IF EXISTS `t_catalogue`;
CREATE TABLE IF NOT EXISTS `t_catalogue` (
  `id_cat` int NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `name_cat` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'nom de l''article ',
  `price_cat` float DEFAULT NULL COMMENT 'prix de l''article',
  `image_cat` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'photo',
  `title_cat` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'titre général',
  `descrip_cat` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'description de l''article',
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `t_catalogue`
--

INSERT INTO `t_catalogue` (`id_cat`, `name_cat`, `price_cat`, `image_cat`, `title_cat`, `descrip_cat`) VALUES
(1, 'article n°1', 250, 'Model/media/cuisineàinduction(1).jpg', 'Plaque de cuisson à induction', 'Affichage de la chaleur: oui, chauffe rapide: oui, sécurité enfants: oui'),
(2, 'article n°2', 300, 'Model/media/cuisineàinduction(2).jpg', 'Plaque de cuisson à induction', 'Affichage de la chaleur: oui, chauffe rapide: oui, sécurité enfants: oui'),
(3, 'article n°3', 315, 'Model/media/cuisineàinduction(3).jpg', 'Plaque de cuisson à induction', 'Affichage de la chaleur: oui, chauffe rapide: oui, sécurité enfants: oui'),
(4, 'article n°4', 400, 'Model/media/cuisineàinduction(4).jpg', 'Plaque de cuisson à induction', 'Affichage de la chaleur: oui, chauffe rapide: oui, sécurité enfants: oui'),
(5, 'article n°5', 148, 'Model/media/Batterie de cuisine (1).jpg', 'Batterie cuisine rouge ', 'Empilables pour un rangement optimal Le revêtement anti-adhésif titanium Poignée 100% sûr'),
(6, 'article n°6', 193, 'Model/media/Batterie de cuisine (2).jpg', 'Batterie cuisine noire ', 'Aluminium forgé Anti-adhésif écologique marbre Convient à tous types de cuisines Design exclusif en métal Peut passer au lave-vaisselle'),
(7, 'article n°7', 160, 'Model/media/Batterie de cuisine (3).jpg', 'Batterie cuisine noire ', 'Aluminium forgé Anti-adhésif écologique marbre Convient à tous types de cuisines Design exclusif en métal Peut passer au lave-vaisselle'),
(8, 'article n°8', 120, 'Model/media/Batterie de cuisine (4).jpg', 'Batterie cuisine noire ', 'Empilables pour un rangement optimal Le revêtement anti-adhésif titanium Poignée 100% sûr'),
(9, 'article n°9', 43, 'Model/media/poêle(1).jpg', 'Poêle ', 'Poêle avec extra résistant Base à induction robuste avec plaque en acier inoxydable'),
(10, 'article n°10', 37, 'Model/media/poêle(2).jpg', 'Poêle ', 'Poêle avec extra résistant Base à induction robuste avec plaque en acier inoxydable'),
(11, 'article n°11', 30, 'Model/media/poêle(3).jpg', 'Poêle ', 'Poêle avec extra résistant Base à induction robuste avec plaque en acier inoxydable'),
(12, 'article n°12', 40, 'Model/media/poêle(4).jpg', 'Poêle ', 'Poêle avec extra résistant Base à induction robuste avec plaque en acier inoxydable'),
(13, 'article n°13', 35, 'Model/media/poêleàcrêpe(1).jpg', 'Poêle ', 'Pour des crêpes parfaites. Ne colle pas, ne brûle pas Convient à tous les types de cuisinières Pour un dessert sucré savoureux'),
(14, 'article n°14', 20, 'Model/media/poêleàcrêpe(2).jpg', 'Poêle rouge ', 'Pour des crêpes parfaites. Ne colle pas, ne brûle pas Convient à tous les types de cuisinières Pour un dessert sucré savoureux'),
(15, 'article n°15', 18, 'Model/media/poêleàcrêpe(3).jpg', 'Poêle ', 'Pour des crêpes parfaites. Ne colle pas, ne brûle pas Convient à tous les types de cuisinières Pour un dessert sucré savoureux');

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

DROP TABLE IF EXISTS `t_user`;
CREATE TABLE IF NOT EXISTS `t_user` (
  `id_user` int NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `name_user` varchar(32) COLLATE latin1_general_ci NOT NULL COMMENT 'login de l''utilisateur',
  `password_user` varchar(64) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'mot de passe de l''utilisateur',
  `role_user` varchar(8) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `name_user_index` (`name_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='table des utilisateurs ';

--
-- Déchargement des données de la table `t_user`
--

INSERT INTO `t_user` (`id_user`, `name_user`, `password_user`, `role_user`) VALUES
(1, 'admin', NULL, 'admin'),
(2, 'user', NULL, 'client');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
