-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Dim 08 Mai 2016 à 14:18
-- Version du serveur :  5.5.42
-- Version de PHP :  5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `helloeyes`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id_article` int(5) NOT NULL,
  `reference` int(15) NOT NULL,
  `categorie` enum('optique','solaire') NOT NULL,
  `titre` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `genre` enum('m','f') NOT NULL,
  `photo` varchar(250) NOT NULL,
  `prix` double(7,2) NOT NULL,
  `stock` int(4) NOT NULL,
  `couleur` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id_article`, `reference`, `categorie`, `titre`, `description`, `genre`, `photo`, `prix`, `stock`, `couleur`) VALUES
(3, 100, 'optique', 'Lys Bleu', 'Le bon air frais de la prairie s&rsquo;invite non pas sous votre nez mais au-dessus ! Une monture tendance pr&ecirc;te &agrave; couvrir vos yeux de mille fleurs des pr&eacute;s, avec en bonus un pont dor&eacute; des plus charmants! Le meilleur alli&eacute; pour un look fleuri, s&rsquo;appelle Lys Blue! ', 'f', '/soutenance/photo/100_lysbleu1_1.jpg', 30.00, 5, 'Bleu/Plastique'),
(4, 101, 'optique', 'Saltimbanque', 'Saltimbanque a le d&eacute;tail qui tue avec ses tenons en forme de cristaux dor&eacute;s! Une monture qui vous fera voir le monde autrement: dites adieu au champs de vision encadr&eacute;. Avec son pont et ses branches m&eacute;tallis&eacute;es, elle reste tendance en toutes circonstances! ', 'f', '/soutenance/photo/101_saltimbanque1_1.png', 30.00, 5, 'Noir/Plastique'),
(5, 102, 'optique', 'Korea', '\r\nTout en rose p&acirc;le, Korea est une paire de lunettes qui n&#039;a pas froid aux yeux. Entre ses formes gracieuses chics comme tout et sa couleur pastel des plus tendances. On lui donne la note de 8/10 pour son c&ocirc;t&eacute; excentrique tout en &eacute;l&eacute;gance. ', 'f', '/soutenance/photo/102_korea1_1.jpg', 30.00, 4, 'Rose/Plastique'),
(6, 103, 'optique', 'Abacosred', 'N&eacute;e pour &ecirc;tre aim&eacute;e, Abacos Red regorge de charme. Une paire de lunettes aux formes rondes et g&eacute;n&eacute;reuses. &Eacute;lev&eacute;e dans l&rsquo;&eacute;tang de la tendance, cette monture jongle, tel la carpe ko&iuml;, entre le rouge cerise et blanc alb&acirc;tre. Fabuleuse! ', 'f', '/soutenance/photo/103_abacosred1_1.png', 30.00, 5, 'Rouge/Plastique/Metal'),
(7, 104, 'optique', 'Begonia Ecaille', '\r\nPanoplie r&eacute;ussie pour Begonia &Eacute;caille. Une paire de lunettes aux formes rectangulaires et g&eacute;n&eacute;reuses. Une monture au motif &eacute;caille endiabl&eacute;, enlac&eacute;e par des branches dor&eacute;es! Splendide! ', 'f', '/soutenance/photo/104_begoniaecaille1_1.png', 30.00, 5, 'Ecaille/Plastique'),
(8, 105, 'optique', 'Delice Blue', 'Pour bien d&eacute;marrer la journ&eacute;e, on commence par s&rsquo;octroyer une petite douceur sucr&eacute;e. D&eacute;lice Blue est une paire de lunettes aux formes rondes et pulpeuses. Merveilleux compagnon de votre quotidien, ce mod&egrave;le en ac&eacute;tate poli &agrave; la main est une preuve d&rsquo;excellence. ', 'f', '/soutenance/photo/105_deliceblue1_1.png', 30.00, 5, 'Bleu/Acetate'),
(9, 106, 'optique', 'Malibu Trans', 'La cit&eacute;e des anges renferme un magnifique tr&eacute;sor. Une monture aux formes ovales et plantureuses. Gracieuse, Malibu Trans est une paire de lunettes demi-cercl&eacute;e bord&eacute;e de m&eacute;tal dor&eacute;. C&eacute;leste!', 'f', '/soutenance/photo/106_malibutrans1_1.png', 30.00, 5, 'Blanc/Plastique/Metal'),
(10, 107, 'optique', 'Stefano Trans', 'Vous ne vous &eacute;chapperez pas &agrave; la fi&egrave;vre enchanteresse de L&rsquo;usine &agrave; lunettes. Stefano Trans est le mix brillant entre une monture aviator et la transparence. Tr&egrave;s en vogue, on aime ses formes g&eacute;n&eacute;reuses et son prix mini. ', 'f', '/soutenance/photo/107_stefanotrans1_1.jpg', 30.00, 5, 'Blanc/Opaque/Plastique'),
(11, 108, 'optique', 'Elmer', 'Hello Eyes envoie de l&rsquo;art tout comme elle envoie du lourd. Elmer s&rsquo;improvise &eacute;g&eacute;rie de la cat&eacute;gorie tendance. Une monture ronde au style et au design &eacute;tudi&eacute;. Ne reniant ni la qualit&eacute;, ni la bonne humeur, cette paire de lunettes en ac&eacute;tate poli &agrave; la main aime et expose son penchant pour la couleur! ', 'f', '/soutenance/photo/108_elmer1_1.png', 30.00, 5, 'Vert/Plastique'),
(12, 109, 'optique', 'Anna Pastel', '\r\nQu&#039;elle soit v&ecirc;tue de noir, rouge, bordeaux ou pastel, Anna est canon. Monture aux formes papillonnantes, flexible et tendance, on craque compl&egrave;tement pour cette douce Anna pastel. Et vous? ', 'f', '/soutenance/photo/109_annapastel1_1.jpg', 30.00, 5, 'Rose/Plastique'),
(13, 200, 'optique', 'Echide', '&Eacute;chide est une paire de lunettes de caract&egrave;re. Une monture en m&eacute;tal compl&egrave;tement enchanteresse, aux formes ovales et pulpeuses. Un look reptilien transpos&eacute; dans un ac&eacute;tate &eacute;caille. Sublime! ', 'm', '/soutenance/photo/200_echide1_1.png', 30.00, 5, 'Ecaille/Metal/Acetate'),
(14, 201, 'optique', 'Arizona', 'D&eacute;voilez votre c&ocirc;t&eacute; sauvage gr&acirc;ce &agrave; la Arizona! Un joli motif l&eacute;opard combin&eacute; &agrave; de jolies branches en cuir. D&eacute;licat &agrave; souhait!', 'm', '/soutenance/photo/201_arizona1_1.jpg', 30.00, 5, 'Leopard/Plastique'),
(15, 202, 'optique', 'Stanford', 'Objet du pass&eacute; tant convoit&eacute;, le vintage revient en force ! Et Stanford compte bien vous le prouver. Monture enti&egrave;rement en m&eacute;tal et d&eacute;grad&eacute;e argent, noir, v&eacute;ritable parfum des sixties. On la recommande sans h&eacute;sitation !', 'm', '/soutenance/photo/202_stanford1_1.jpg', 30.00, 5, 'Gris/Metal'),
(16, 203, 'optique', 'Tarot', 'Vous avez tir&eacute; la bonne carte! Tarot est une paire de lunettes marron &eacute;caille, int&eacute;gralement en plastique flexible. Une monture rectangulaire aux formes g&eacute;n&eacute;reuses et par&eacute;e d&rsquo;un pont cl&eacute;. Fusionnelle! ', 'm', '/soutenance/photo/203_tarot1_1.png', 30.00, 5, 'Ecaille/Acetate'),
(17, 204, 'optique', 'Hitchy', 'On embarque Hitchy dans son dressing &agrave; lunettes! Une monture ronde alliant noir et dorures. On aime son look endiabl&eacute; et ses croix rock&rsquo;n roll diss&eacute;min&eacute;es un peu partout. Juste ce qu&rsquo;il faut pour rester classe! ', 'm', '/soutenance/photo/204_hitchy1_1.jpg', 30.00, 5, 'Noir/Plastique/Metal'),
(18, 205, 'optique', 'Dalmatien', 'On l&rsquo;avoue, Dalmatien est tomb&eacute;e dans la marmite de la mode. Concoct&eacute;e pour le style, elle combine avec brio la transparence et le noir. Une paire de lunettes aux formes ovales et gracieuses dont les d&eacute;tails du pont nous ensorcelle. ', 'm', '/soutenance/photo/205_dalmatien1_1.jpg', 30.00, 5, 'Noir&Blanc/Plastique'),
(19, 206, 'optique', 'Parall&egrave;le', 'Parall&egrave;le &Eacute;caille est belle. Avec de petits bijoux tricolores sur le bout des branches, cette paire de lunettes nous fait chavirer. Une monture demi-cercl&eacute;e aux formes rectangulaires mariant dorures et imprim&eacute; &eacute;caille. Que du bonheur ! ', 'm', '/soutenance/photo/206_parallele1_1.jpg', 30.00, 5, 'Ecaille/Plastique/Metal'),
(20, 207, 'optique', 'Giovanni', 'Giovanni aime user de son accent italien. S&eacute;ducteur dans l&rsquo;&acirc;me, il sait d&eacute;voiler ce que lui a offert dame nature pour charmer : une forme aviator des plus classes et une musculature en ac&eacute;tate. Mais derri&egrave;re cette image soign&eacute;e, cette paire de lunettes de qualit&eacute; cache un prix imbattable! ', 'm', '/soutenance/photo/207_giovanni1_1.jpg', 30.00, 5, 'Ecaille/Plastique'),
(21, 208, 'optique', 'Karla', 'Une monture aux courbes divines ! La Karla se pare de branches dor&eacute;es et de nuances chatoyantes pour &eacute;clairer votre regard et rehausser votre style d&#039;une note r&eacute;tro. ', 'm', '/soutenance/photo/208_karla1_1.jpg', 30.00, 5, 'Ecaille/Plastique'),
(22, 209, 'optique', 'Libellule', '\r\nLibellule est une belle demoiselle. Une monture demi-cercl&eacute;e fi&egrave;re de ses formes ovales et plantureuses. Mais ce qui nous fascine le plus, ce sont ses branches aux formes originales et aux extr&eacute;mit&eacute;s ornement&eacute;es d&rsquo;embouts tricolores. ', 'm', '/soutenance/photo/209_libellule1_1.jpg', 30.00, 5, 'Noir/Plastique/Metal'),
(23, 300, 'solaire', 'Marsala', 'Envie d&rsquo;un moment de d&eacute;tente au-del&agrave; du rivage? L&rsquo;usine &agrave; lunettes vous emm&egrave;ne en croisi&egrave;re sur les 5 oc&eacute;ans avec Marsala Blue. Une d&eacute;clinaison de bleu fascinante dans une monture oversize. ', 'm', '/soutenance/photo/300_marsala1_1.jpg', 30.00, 5, 'Bleu/Opaque/Plastique'),
(24, 301, 'solaire', 'Carnage', 'Astucieux : un mod&egrave;le deux en un, pour alterner entre verres blancs et noirs.\r\nCascadeuse est une paire de lunettes &agrave; sensations fortes! Une alliance de diff&eacute;rents mat&eacute;riaux donnant un r&eacute;sultat surprenant. Un double pont en pont cl&eacute; et accompagn&eacute; de son acolyte en m&eacute;tal dor&eacute;. ', 'f', '/soutenance/photo/301_carnage1_1.jpg', 30.00, 5, 'Noir/Plastique/Metal'),
(25, 302, 'solaire', 'Myconos', 'La d&eacute;esse des &icirc;les grecques est sur L&rsquo;usine &agrave; lunettes! Myconos est une solaire demi-cercl&eacute;e plus que divine. Une devanture aux motifs dor&eacute;s embrass&eacute;e par des branches blanc ivoire. ', 'm', '/soutenance/photo/302_myconos1_1.jpg', 30.00, 4, 'Gris/Metal/Plastique'),
(26, 303, 'solaire', 'Doodle White', '\r\nLe blanc est la couleur de pr&eacute;dilection &agrave; porter cet &eacute;t&eacute;. Id&eacute;al pour mettre votre bronzage en valeur, Doodle White est la paire de lunettes de soleil &agrave; avoir dans son dressing &agrave; lunettes. Une monture style seventies aux formes rondes et g&eacute;n&eacute;reuses. ', 'f', '/soutenance/photo/303_doodlewhite1_1.jpg', 30.00, 4, 'Blanc/Plastique'),
(27, 304, 'solaire', 'Mono Yellow', '\r\nLes amateurs de tartes au citron succombent tous, face au charme sucr&eacute; de Mono Yellow. Une paire de lunettes ronde, habill&eacute;e de verres d&eacute;grad&eacute;s. Il est toujours bien difficile de r&eacute;sister &agrave; une solaire 100% tendance. Mais avec un mod&egrave;le muni d&rsquo;un pont cl&eacute; et d&rsquo;un prix mini, on est bienheureux d&rsquo;&ecirc;tre pass&eacute; sur L&rsquo;usine &agrave; lunettes!', 'f', '/soutenance/photo/304_monoyellow1_1.png', 30.00, 5, 'Jaune/Plastique'),
(28, 305, 'solaire', 'Errika Blue', 'Toujours au top du top, Erikka Blue fait partie de ces paires de lunettes de soleil design qu&rsquo;on r&ecirc;ve de porter. Une monture noir carbone m&ecirc;l&eacute;e &agrave; une devanture dor&eacute;e. En mode lunettes de vue ou en solaire : on l&rsquo;adore!', 'm', '/soutenance/photo/305_erikkablue1_1.jpg', 30.00, 5, 'Noir/Plastique/Metal'),
(29, 306, 'solaire', 'Terminus', 'Un aller sans retour au pays du soleil et de la mode : direction L&rsquo;usine &agrave; lunettes! Terminus est une solaire rectangulaire aux formes plantureuses. Le seul ticket pour un look plein d&rsquo;&eacute;l&eacute;gance . ', 'm', '/soutenance/photo/306_terminus1_1.jpg', 30.00, 5, 'Noir/Plastique'),
(30, 307, 'solaire', 'Cannelle Black', 'Grande est la tentation de s&rsquo;accaparer une monture aux formes papillonnantes et en m&eacute;tal dor&eacute;, n&rsquo;est-ce pas? D&eacute;di&eacute;e &agrave; cette &eacute;pice douce et chaleureuse, Cannelle Black revient dans les tons noirs. Une solaire &eacute;l&eacute;gante par&eacute;e d&rsquo;un pont cl&eacute;. ', 'm', '/soutenance/photo/307_cannelleblack1_1.jpg', 30.00, 5, 'Noir/Plastique/Metal'),
(31, 308, 'solaire', 'Glitter Brown', 'Envie d&#039;une paire de lunettes funky et &eacute;l&eacute;gante ? Glitter brown a toutes ces qualit&eacute;s avec son pont d&eacute;cal&eacute; et sa monture marron chocolat des plus chics. On dit oui &agrave; la mode &agrave; petit prix ! ', 'f', '/soutenance/photo/308_glitterbrown1_1.jpg', 30.00, 5, 'Marron/Bois/Metal'),
(32, 309, 'solaire', 'Empire State', 'Plus imposante que l&rsquo;Empire State Building, cette monture a le look qui d&eacute;coiffe. Une solaire noire par&eacute;e d&rsquo;une devanture aux reliefs g&eacute;om&eacute;triques. Unique en son genre! ', 'f', '/soutenance/photo/309_empirestate1_1.jpg', 30.00, 5, 'Noir/M&eacute;tal/Plastique');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int(5) NOT NULL,
  `id_membre` int(10) NOT NULL,
  `id_article` int(5) NOT NULL,
  `commentaire` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `avis`
--

INSERT INTO `avis` (`id_avis`, `id_membre`, `id_article`, `commentaire`, `date`) VALUES
(130, 3, 30, 'commentaire cannelle black', '2016-03-15 16:01:36'),
(131, 3, 32, 'Commentaire sur empire State 32', '2016-03-15 16:30:49'),
(132, 3, 31, 'Commentaire sur Glitter Brown', '2016-03-15 16:31:51'),
(137, 2, 31, 'Commentaire sur glitter brown by superadmin', '2016-03-17 12:36:06'),
(138, 2, 30, 'Magnifique j''en suis ravie !', '2016-03-17 12:39:25'),
(139, 28, 5, 'Parfaite et facile Ã  porter !', '2016-03-17 12:50:48');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(6) NOT NULL,
  `id_membre` int(5) DEFAULT NULL,
  `montant` double(7,2) NOT NULL,
  `date` datetime NOT NULL,
  `etat` enum('en cours de traitement','envoyé','livré') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_membre`, `montant`, `date`, `etat`) VALUES
(5, 2, 36.00, '2016-03-10 16:10:30', 'en cours de traitement'),
(6, 2, 72.00, '2016-03-10 16:41:24', 'en cours de traitement'),
(7, 28, 36.00, '2016-03-17 12:50:54', 'en cours de traitement');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(10) NOT NULL,
  `id_membre` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `sub_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`id_contact`, `id_membre`, `email`, `message`, `sub_date`) VALUES
(48, 3, 'starman@mail.com', 'Bonjour, j''ai fait une commande mais les lunettes ne conviennent plus. Comment faire ?', '2016-03-17 16:40:14');

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

CREATE TABLE `details_commande` (
  `id_details_commande` int(5) NOT NULL,
  `id_commande` int(6) NOT NULL,
  `id_article` int(5) NOT NULL,
  `quantite` int(4) NOT NULL,
  `prix` double(7,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `details_commande`
--

INSERT INTO `details_commande` (`id_details_commande`, `id_commande`, `id_article`, `quantite`, `prix`) VALUES
(5, 5, 26, 1, 36.00),
(6, 6, 32, 2, 36.00),
(7, 7, 5, 1, 36.00);

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
  `email` varchar(20) NOT NULL,
  `sexe` enum('m','f') NOT NULL,
  `photo` varchar(250) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `cp` int(5) unsigned zerofill NOT NULL,
  `adresse` text NOT NULL,
  `statut` int(1) NOT NULL,
  `inscription` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `sexe`, `photo`, `ville`, `cp`, `adresse`, `statut`, `inscription`) VALUES
(1, 'MonkeyMan', '12345', 'Dupont', 'Jean', 'monkey@mail.com', 'm', '', 'Paris', 75011, '10 rue St Maur', 0, '2016-03-17 12:43:53'),
(2, 'SuperAdmin', 'admin', 'Toung', 'Pagna', 'admin@mail.com', 'f', '', 'Paris', 75011, '4 rue Oberkampkf', 1, '2016-03-17 12:39:47'),
(3, 'Starman', '12345', 'Bowie', 'David', 'starman@mail.com', 'm', '', 'Mars', 10101, '1 rue de mars', 0, '2016-03-17 12:40:14'),
(24, 'DarkBador', '12345', 'Garland', 'Jadden', 'judith@gmail.com', 'm', '', 'Paris', 75011, '5 rue de Lappe', 0, '2016-03-17 12:40:22'),
(26, 'Sophie', '12345', 'Durand', 'Sophie', 'sophie@mail.com', 'f', '', 'Paris', 75018, '3 rue desportes', 0, '2016-03-17 12:40:38'),
(28, 'Naughty', '12345', 'Laporte', 'Marie', 'marie@mail.com', 'f', '/soutenance/photo/_Capture dâ€™eÌcran 2016-05-08 aÌ€ 13.42.32.png', 'Bourges', 18000, '10 rue de la Fraternit&eacute;', 0, '2016-05-08 14:16:49');

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE `newsletter` (
  `id_newsletter` int(5) NOT NULL,
  `id_membre` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Index pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD PRIMARY KEY (`id_details_commande`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id_newsletter`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id_article` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=140;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT pour la table `details_commande`
--
ALTER TABLE `details_commande`
  MODIFY `id_details_commande` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pour la table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id_newsletter` int(5) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
