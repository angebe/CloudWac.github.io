-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 06 Septembre 2015 à 22:16
-- Version du serveur :  10.0.21-MariaDB-1~utopic
-- Version de PHP :  5.6.4-4ubuntu6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `Blog_MVC`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `auteur` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text,
  `tags` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `auteur`, `user_id`, `content`, `tags`, `created`, `updated`) VALUES
(9, 'ccc', 'marcus', 0, 'ccc', 'ccc', '2015-09-03 13:10:39', NULL),
(13, 'hopital', 'marcus', 0, 'azerty', '#long', '2015-09-03 15:17:26', NULL),
(14, 'fififif', 'marcus', 0, 'soire cremaillere\r\n', 'party', '2015-09-04 19:30:59', NULL),
(15, 'efoijzepfok', '4', 0, 'PQODKPZEOKFPÙZ', 'QPdkazepùd', '2015-09-05 18:25:10', NULL),
(16, '10', '4', 0, '10', '10', '2015-09-06 11:01:32', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `bookmarks`
--

CREATE TABLE IF NOT EXISTS `bookmarks` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` text,
  `url` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `bookmarks_tags`
--

CREATE TABLE IF NOT EXISTS `bookmarks_tags` (
  `bookmark_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) NOT NULL,
  `username` text NOT NULL,
  `message` text NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `username`, `message`, `article_id`) VALUES
(3, 'marcus', 'qsdqsd', 8),
(4, 'marcus', 'qsdqs', 8),
(5, 'marcus', 'azeazeaze', 8),
(6, 'marcus', 'TEST  TQS T QSTQS', 8),
(7, 'marcus', 'FDP ! :D', 8),
(8, 'marcus', 'idje', 8),
(9, 'jason', 'sisi', 8),
(10, 'marcus', '', 9),
(11, 'marcus', '', 9),
(12, 'marcus', 'FIODPc,qpmc', 9),
(13, 'marcus', 'QIODFAZPROFKPZKfioaej', 9),
(14, 'marcus', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
`id` int(11) NOT NULL,
  `from` varchar(25) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `lastname`, `email`, `birthdate`, `password`, `role`, `created`, `modified`) VALUES
(4, 'marcus', 'LA GROSSE BITE A DUDULE !', 'marcus', 'ptit_ricain@hotmail.fr', '2015-09-02', '$2y$10$kdgRHpTyA.FdTEWOuKqyWOQLw1fdZsVl8PxjTVmU/EqPFE2FJR.0S', 'admin', '2015-09-02 01:42:05', '2015-09-06 10:56:08'),
(7, 'jason', 'jason', 'jason', 'jason@ja.fr', '2003-07-13', '$2y$10$1Jbpm6kIQrU1M0cX6ujm/Of8EI/iVbcDqt.bKRiuEFhsDPUQQHpTy', '', '2015-09-05 15:00:23', '2015-09-05 15:00:23'),
(8, 'momo', 'momo', 'momo', 'momo@mo.mo', '2002-07-05', '$2y$10$f34CxPE8Zjwn7lX58cMMeOGQdFpRncU1Rsf3LtCcPzcrEi0eWgPL6', 'blogger', '2015-09-05 15:05:47', '2015-09-05 15:05:47');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bookmarks`
--
ALTER TABLE `bookmarks`
 ADD PRIMARY KEY (`id`), ADD KEY `user_key` (`user_id`);

--
-- Index pour la table `bookmarks_tags`
--
ALTER TABLE `bookmarks_tags`
 ADD PRIMARY KEY (`bookmark_id`,`tag_id`), ADD KEY `tag_key` (`tag_id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `title` (`title`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `bookmarks`
--
ALTER TABLE `bookmarks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `bookmarks`
--
ALTER TABLE `bookmarks`
ADD CONSTRAINT `user_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `bookmarks_tags`
--
ALTER TABLE `bookmarks_tags`
ADD CONSTRAINT `bookmark_key` FOREIGN KEY (`bookmark_id`) REFERENCES `bookmarks` (`id`),
ADD CONSTRAINT `tag_key` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
