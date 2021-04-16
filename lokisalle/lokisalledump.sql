-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Mar 16 Février 2016 à 16:31
-- Version du serveur :  5.5.42
-- Version de PHP :  5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `lokisalle`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int(5) NOT NULL,
  `id_membre` int(5) DEFAULT NULL,
  `id_salle` int(5) NOT NULL,
  `commentaire` text NOT NULL,
  `note` int(2) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(6) NOT NULL,
  `montant` int(5) NOT NULL,
  `id_membre` int(5) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

CREATE TABLE `details_commande` (
  `id_details_commande` int(6) NOT NULL,
  `id_commande` int(6) NOT NULL,
  `id_produit` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(5) NOT NULL,
  `pseudo` varchar(15) NOT NULL,
  `mdp` varchar(32) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `sexe` enum('m','f') NOT NULL,
  `ville` varchar(20) NOT NULL,
  `cp` int(5) NOT NULL,
  `adresse` varchar(30) NOT NULL,
  `statut` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `sexe`, `ville`, `cp`, `adresse`, `statut`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'admin@gmail.com', 'f', 'Paris', 75011, '1 rue de l''admin', 1),
(2, 'test', 'test', 'test', 'test', 'test@gmail.com', 'm', 'Paris', 75011, '1 rue du test', 0);

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE `newsletter` (
  `id_newsletter` int(5) NOT NULL,
  `id_membre` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(5) NOT NULL,
  `date_arrivee` datetime NOT NULL,
  `date_depart` datetime NOT NULL,
  `id_salle` int(5) NOT NULL,
  `id_promo` int(2) DEFAULT NULL,
  `prix` int(5) NOT NULL,
  `etat` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `date_arrivee`, `date_depart`, `id_salle`, `id_promo`, `prix`, `etat`) VALUES
(1, '2016-05-22 09:00:00', '2017-06-22 18:00:00', 1, NULL, 300, 1),
(2, '2016-03-28 09:00:00', '2017-04-08 18:00:00', 2, NULL, 300, 1),
(3, '2016-05-05 09:00:00', '2016-06-06 09:00:00', 3, NULL, 300, 1),
(4, '2016-05-01 09:00:00', '2016-05-23 18:00:00', 4, NULL, 300, 1),
(5, '2016-04-04 09:00:00', '2016-05-23 18:00:00', 5, NULL, 500, 1),
(6, '2016-04-04 09:00:00', '2016-05-23 18:00:00', 6, NULL, 666, 1),
(7, '2016-03-28 09:00:00', '2016-05-23 18:00:00', 7, NULL, 500, 1),
(8, '2016-05-01 09:00:00', '2017-04-08 18:00:00', 8, NULL, 600, 1),
(9, '2016-04-04 09:00:00', '2017-04-08 18:00:00', 9, NULL, 350, 1),
(10, '2016-04-04 09:00:00', '2017-04-08 18:00:00', 10, NULL, 250, 1),
(11, '2016-04-04 09:00:00', '2017-04-08 18:00:00', 11, NULL, 350, 1),
(12, '2016-04-04 09:00:00', '2017-04-08 18:00:00', 12, NULL, 250, 1),
(13, '2016-03-28 09:00:00', '2017-05-09 00:00:00', 13, NULL, 350, 1),
(14, '2016-03-28 09:00:00', '2017-12-12 18:00:00', 14, NULL, 250, 1),
(15, '2016-04-28 09:00:00', '2017-06-21 18:00:00', 15, NULL, 300, 1),
(16, '2016-04-28 09:00:00', '2017-06-21 18:00:00', 16, NULL, 350, 1),
(17, '2016-05-01 09:00:00', '2017-12-12 18:00:00', 1, NULL, 250, 1),
(18, '2016-03-28 09:00:00', '2017-04-08 18:00:00', 18, NULL, 300, 1),
(19, '2016-04-28 09:00:00', '2017-04-08 18:00:00', 19, NULL, 250, 1),
(20, '2016-05-01 09:00:00', '2017-06-21 18:00:00', 20, NULL, 300, 1);

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `id_promo` int(2) NOT NULL,
  `code_promo` varchar(6) NOT NULL,
  `reduction` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id_salle` int(5) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `adresse` text NOT NULL,
  `cp` int(5) unsigned zerofill NOT NULL,
  `titre` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(200) NOT NULL,
  `capacite` int(3) NOT NULL,
  `categorie` enum('reunion') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `salle`
--

INSERT INTO `salle` (`id_salle`, `pays`, `ville`, `adresse`, `cp`, `titre`, `description`, `photo`, `capacite`, `categorie`) VALUES
(1, 'France', 'Paris', '10 rue Adresse', 75011, 'Salle Duval', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/1_room1.jpg', 50, 'reunion'),
(2, 'France', 'Paris', '10 rue Adresse', 75017, 'Salle Baron', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/2_room2.jpg', 20, 'reunion'),
(3, 'France', 'Paris', '10 rue Adresse', 75002, 'Salle Bardin', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/3_room3.jpg', 20, 'reunion'),
(4, 'France', 'Paris', '10 rue Adresse', 75002, 'Salle Baille', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/4_room4.jpg', 80, 'reunion'),
(5, 'France', 'Paris', '10 rue Adresse', 75003, 'Salle Ballerat', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/5_room5.jpg', 50, 'reunion'),
(6, 'France', 'Marseille', '10 rue Adresse', 13000, 'Salle Victoire', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/6_room6.jpg', 30, 'reunion'),
(7, 'France', 'Lyon', '10 rue Adresse', 69000, 'Salle Ballerat', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/7_room7.jpg', 15, 'reunion'),
(8, 'France', 'Paris', '10 rue Adresse', 75001, 'Salle Cabat', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/8_room8.jpg', 25, 'reunion'),
(9, 'France', 'Marseille', '10 rue Adresse', 13000, 'Salle Carri&egrave;re', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/9_room9.jpg', 10, 'reunion'),
(10, 'France', 'Lyon', '10 rue Adresse', 69000, 'Salle Cezanne', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/10_room10.jpg', 30, 'reunion'),
(11, 'France', 'Paris', '10 rue Adresse', 75004, 'Salle Clesinger', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/11_room11.jpg', 45, 'reunion'),
(12, 'France', 'Marseille', '10 rue Adresse', 13000, 'Salle Couture', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/12_room12.jpg', 20, 'reunion'),
(13, 'France', 'Paris', '10 rue Adresse', 75005, 'Salle Daubigny', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/13_room13.jpg', 30, 'reunion'),
(14, 'France', 'Lyon', '10 rue Adresse', 75006, 'Salle Delacroix', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/14_room14.jpg', 20, 'reunion'),
(15, 'France', 'Paris', '10 rue Adresse', 75007, 'Salle Delaroche', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/15_room15.jpg', 20, 'reunion'),
(16, 'France', 'Marseille', '10 rue Adresse', 75008, 'Salle Demanche', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/16_room16.jpg', 35, 'reunion'),
(17, 'France', 'Lyon', '10 rue Adresse', 69000, 'Salle Latour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/17_room17.jpg', 20, 'reunion'),
(18, 'France', 'Paris', '10 rue Adresse', 75009, 'Salle Jouvenet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/18_room18.jpg', 60, 'reunion'),
(19, 'France', 'Lyon', '10 rue Adresse', 69000, 'Salle Grimaud', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/19_room19.jpg', 65, 'reunion'),
(20, 'France', 'Paris', '10 rue Adresse', 75011, 'Salle Langlois', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in quam est. Sed et fermentum lorem. Cras a efficitur magna, at mollis neque. Vestibulum vel pharetra dolor. Ut non tristique risus, a tincidunt mi. Vivamus vel sem quis neque tristique dignissim quis vitae magna. ', '/lokisalle/photo/20_room20.jpg', 30, 'reunion');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`),
  ADD KEY `id_membre` (`id_membre`),
  ADD KEY `id_salle` (`id_salle`),
  ADD KEY `id_membre_2` (`id_membre`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `id_membre` (`id_membre`);

--
-- Index pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD PRIMARY KEY (`id_details_commande`),
  ADD KEY `id_commande` (`id_commande`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id_newsletter`),
  ADD KEY `id_membre` (`id_membre`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `id_salle` (`id_salle`),
  ADD KEY `id_promo` (`id_promo`);

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id_promo`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id_salle`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `details_commande`
--
ALTER TABLE `details_commande`
  MODIFY `id_details_commande` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id_newsletter` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id_promo` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id_salle` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id_salle`) REFERENCES `salle` (`id_salle`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD CONSTRAINT `details_commande_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `details_commande_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `newsletter`
--
ALTER TABLE `newsletter`
  ADD CONSTRAINT `newsletter_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`id_salle`) REFERENCES `salle` (`id_salle`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produit_ibfk_2` FOREIGN KEY (`id_promo`) REFERENCES `promotion` (`id_promo`) ON DELETE SET NULL ON UPDATE CASCADE;
