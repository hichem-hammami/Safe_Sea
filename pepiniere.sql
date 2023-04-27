-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 28 avr. 2023 à 01:47
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pepiniere`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `identifiant` int(11) NOT NULL,
  `imageArticle` varchar(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `quantiteDisponible` int(11) NOT NULL
) ;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`identifiant`, `imageArticle`, `nom`, `categorie`, `description`, `prix`, `quantiteDisponible`) VALUES
(1, 'noisetier_long_bec.jpg', 'Noisetier à long bec', 'Arbres à noix', 'Le noisetier à long bec est un arbuste à noisettes extrêmement rustique, originaire du Canada. \n			Il est également tolérant à l’ombre et très résistant aux maladies.', '18', 20),
(2, 'chataignier_amerique.jpg', 'Chataigner d\'Amérique', 'Arbres à noix', 'Le châtaignier d’Amérique est un arbre à noix très réputé pour ses noix sucrées et faciles \n			 à récolter, et qui sont une excellente source de nourriture fiable.', '20', 44),
(3, 'noyer_noir.jpg', 'Noyer noir', 'Arbres à noix', 'Le noyer noir (Juglans nigra) est un noyer à croissance rapide dont la noix est appréciée\n            pour sa saveur particulière et ses propriétés médicinales.', '17', 66),
(4, 'prunier_noir.jpg', 'Prunier noir', 'Arbres fruitiers', 'Le prunier noir est un prunier sauvage indigène qui est le meilleur pollinisateur pour tous \n			les pruniers de type américain hybride. Il produit aussi un fruit savoureux et très sucré', '40', 33),
(5, 'prunier_alderman.jpg', 'Prunier Alderman', 'Arbres fruitiers', 'Le prunier Alderman est un prunier japonais particulièrement  ornemental et productif.\n			Chaque année, il fournit de belles grosses prunes sucrées et délicieuses.', '35', 25),
(6, 'poirier_siberie.jpg', 'Poirier de Sibérie', 'Arbres fruitiers', 'Le poirier de Sibérie est un excellent pollinisateur, en particulier pour \n			les poiriers de type ussuriensis, comme le poirier Ure, le Krazulya et le Vekovaya.', '25', 37),
(7, 'amelanchier_sauvage.jpg', 'Amélanchier sauvage', 'Arbustes fruitiers', 'L’amélanchier est un petit arbre originaire du nord des États-Unis et du Canada. Il produit \n			des fruits qui ont des similarités avec les bleuets, à la fois en apparence et en goût.', '25', 54),
(8, 'aronie_noire.jpg', 'Aronie noire', 'Arbustes fruitiers', 'L’aronie est un arbuste très rustique, indigène de l’est du Canada et reconnu pour ses bienfaits \n			pour la santé. Le fruit au goût unique est à la fois astringent et sucré. ', '20', 56),
(9, 'framboisier_pathfinder.jpg', 'Framboisier Pathfinder', 'Arbustes fruitiers', 'Le Pathfinder est le framboisier le plus productif et le plus résistant au froid. \n             Il produira rapidement de petits plants qui porteront des fruits d\'un execllent goût', '10', 5),
(10, 'camerisier.jpg', 'Camerisier', 'Arbustes fruitiers', ' Le camérisier est un petit arbuste qui produit le fruit le plus hâtif de la saison. La camerise \n			est un petit fruit pourpre ou bleu très foncé, riche en vitamine C et  en antioxydants', '22', 41),
(11, 'pommier-collet.jpg', 'Pommier Collet', 'Arbres fruitiers', 'Le pommier Collet est un arbre fruitier précoce et résistant aux maladies. Sa saveur \n			 sucrée et acidulé en fait une excellente pomme autant fraîche que cuite.', '35', 50),
(12, 'poirier-krazulya.jpg', 'Poirier Krazulya', 'Arbres fruitiers', 'Krazulya est un cultivar d’origine russe particulièrement rustique, en plus d’être aussi \n			 un très bel arbre. Parmi les premières à mûrir, sa poire est très goûteuse et savoureuse.', '30', 40);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `identifiant` varchar(255) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `quantiteArticle` int(11) NOT NULL,
  `prix` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`identifiant`, `idArticle`, `quantiteArticle`, `prix`) VALUES
('a4o384d7qdt3tkp2rbgl8rcq6i', 1, 1, '0'),
('a4o384d7qdt3tkp2rbgl8rcq6i', 2, 16, '0'),
('cm1jvtnkeirrucptchamosehhu', 1, 1, '0');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `identifiant` varchar(255) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `quantiteArticle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`identifiant`, `idArticle`, `quantiteArticle`) VALUES
('a4o384d7qdt3tkp2rbgl8rcq6i', 1, 1),
('a4o384d7qdt3tkp2rbgl8rcq6i', 7, 13),
('a4o384d7qdt3tkp2rbgl8rcq6i', 10, 4),
('cm1jvtnkeirrucptchamosehhu', 1, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`identifiant`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`identifiant`,`idArticle`),
  ADD KEY `FK_Commande_Article` (`idArticle`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`identifiant`,`idArticle`),
  ADD KEY `FK_Panier_Article` (`idArticle`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `identifiant` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_Commande_Article` FOREIGN KEY (`idArticle`) REFERENCES `article` (`identifiant`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `FK_Panier_Article` FOREIGN KEY (`idArticle`) REFERENCES `article` (`identifiant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
