-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 20 fév. 2020 à 16:07
-- Version du serveur :  10.3.20-MariaDB
-- Version de PHP :  7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `common-database`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `id_tweet` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `content` varchar(140) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `id_tweet`, `id_member`, `content`, `date`) VALUES
(1, 2, 1, 'espèce de copieur !', '2020-02-17 16:57:09');

-- --------------------------------------------------------

--
-- Structure de la table `follower`
--

CREATE TABLE `follower` (
  `id_member` int(11) NOT NULL,
  `id_follower` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `following`
--

CREATE TABLE `following` (
  `id_member` int(255) NOT NULL,
  `id_following` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `following`
--

INSERT INTO `following` (`id_member`, `id_following`) VALUES
(3, 1),
(3, 2),
(3, 4),
(3, 6),
(2, 4),
(2, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `hashtag`
--

CREATE TABLE `hashtag` (
  `id_tweet` int(255) NOT NULL,
  `keyword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `hashtag`
--

INSERT INTO `hashtag` (`id_tweet`, `keyword`) VALUES
(2, 'onenvoiecequonveux');

-- --------------------------------------------------------

--
-- Structure de la table `member`
--

CREATE TABLE `member` (
  `id_member` int(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `inscription_date` date NOT NULL DEFAULT current_timestamp(),
  `profil_img` varchar(255) DEFAULT NULL,
  `activity` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `member`
--

INSERT INTO `member` (`id_member`, `lastname`, `firstname`, `pseudo`, `email`, `password`, `inscription_date`, `profil_img`, `activity`) VALUES
(1, 'rouyer', 'mickael', 'megaf89', 'megaf89@hotlail.fr', 'secret', '2020-02-02', '', 1),
(2, 'gilbert', 'edouard', 'gigi79', 'gigi79@hotmail.fr', 'secret', '1979-04-19', '', 1),
(3, 'dumont', 'sophie', 'soso90', 'soso90@hotmail.fr', 'secret', '1990-07-20', '', 1),
(4, 'felten', 'nico', 'nico90', 'nico90@hotmail.fr', 'secret', '1990-09-03', '', 1),
(5, 'Rouyer', 'Mickael', 'Megaf898', 'megaf89@hotmail.fr', '957f750a0f2dc64b481b86c0332b27f83088a8ee', '2020-02-17', NULL, 1),
(6, 'Fernand', 'Loic', 'Megaga89', 'megagaf89@hotmail.fr', '0979ff7ca487d34ed580925616d2a8843e45e870', '2020-02-17', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `private_message`
--

CREATE TABLE `private_message` (
  `id_message` int(255) NOT NULL,
  `id_member_sender` int(255) NOT NULL,
  `id_member_receiver` int(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `private_message`
--

INSERT INTO `private_message` (`id_message`, `id_member_sender`, `id_member_receiver`, `message`, `date`) VALUES
(1, 1, 3, 'trop fort !', '2020-12-14 00:00:00'),
(2, 2, 3, 'jme sens pas terrible', '2020-02-14 00:00:00'),
(3, 1, 3, 'je vais pas très bien', '2020-02-14 00:00:00'),
(4, 2, 1, 't\'as vu l\'om ?', '2020-02-14 00:00:00'),
(5, 1, 2, 'Nantes cest des niqués !', '2020-02-14 10:24:00'),
(6, 2, 4, 'a quelle heure demain ?', '2020-02-14 11:41:17'),
(7, 2, 1, 'trop bien!', '2020-02-14 14:00:48'),
(8, 4, 1, 'salut je suis nouveau', '2020-02-14 14:49:21');

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id_tweet` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id_tweet`, `id_member`, `pseudo`) VALUES
(1, 3, 'gigi79'),
(2, 1, 'espèce de copieur !');

-- --------------------------------------------------------

--
-- Structure de la table `tweet`
--

CREATE TABLE `tweet` (
  `id_tweet` int(255) NOT NULL,
  `id_member` int(255) NOT NULL,
  `content` varchar(140) NOT NULL,
  `img` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `id_member_retweet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tweet`
--

INSERT INTO `tweet` (`id_tweet`, `id_member`, `content`, `img`, `date`, `id_member_retweet`) VALUES
(1, 2, 'je tweete ce que je veux !', 'https://fr.wikipedia.org/wiki/Image#/media/Fichier:Image_created_with_a_mobile_phone.png', '2020-02-17 16:20:25', NULL),
(2, 3, 'moi aussi j\'envoie ce que je veux!', 'https://fr.wikipedia.org/wiki/Image#/media/Fichier:Image_created_with_a_mobile_phone.png', '2020-02-17 16:30:58', NULL),
(3, 1, 'trop bien la famille!', 'https://fr.wikipedia.org/wiki/Image#/media/Fichier:Image_created_with_a_mobile_phone.png', '2020-02-19 09:59:03', NULL),
(4, 4, 'rolalalalala!', 'https://fr.wikipedia.org/wiki/Image#/media/Fichier:Image_created_with_a_mobile_phone.png', '2020-02-19 09:59:46', NULL),
(5, 6, 'big bang theorie!', 'https://fr.wikipedia.org/wiki/Image#/media/Fichier:Image_created_with_a_mobile_phone.png', '2020-02-19 10:00:04', NULL),
(6, 2, 'deuxième tweet!', 'https://en.wikipedia.org/wiki/National_Hockey_League#/media/File:05_NHL_Shield.svg', '2020-02-19 10:09:21', NULL),
(7, 1, 'je tweete ce que je veux !', 'https://fr.wikipedia.org/wiki/Image#/media/Fichier:Image_created_with_a_mobile_phone.png', '2020-02-19 11:32:27', NULL),
(9, 1, 'je tweete ce que je veux !', 'https://fr.wikipedia.org/wiki/Image#/media/Fichier:Image_created_with_a_mobile_phone.png', '2020-02-19 12:01:36', 2),
(10, 1, 'moi aussi j\'envoie ce que je veux!', 'https://fr.wikipedia.org/wiki/Image#/media/Fichier:Image_created_with_a_mobile_phone.png', '2020-02-19 12:02:42', 3),
(11, 1, 'sdqdqfzfzef', 'https://concour-de-meuf-canon.skyrock.com/photo.html?id_article=2371868961&id_article_media=-1', '2020-02-20 15:57:01', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`);

--
-- Index pour la table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`),
  ADD UNIQUE KEY `pseudo` (`pseudo`,`email`);

--
-- Index pour la table `private_message`
--
ALTER TABLE `private_message`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `tweet`
--
ALTER TABLE `tweet`
  ADD PRIMARY KEY (`id_tweet`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `private_message`
--
ALTER TABLE `private_message`
  MODIFY `id_message` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `tweet`
--
ALTER TABLE `tweet`
  MODIFY `id_tweet` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
