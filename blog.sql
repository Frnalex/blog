-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 02 sep. 2021 à 19:05
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `createdAt`, `user_id`) VALUES
(25, 'Vanilla JavaScript Code Snippets', 'Every now and again we have to deal with legacy code, wading through dark and eerie sides of the code base, often with a vague, ambiguous and unsettling documentation — if any is provided at all. In such cases, refactoring the component seems inevitable.\r\n\r\nOr perhaps you need to manage dates and arrays, or manipulate DOM — there is just no need to add an external dependency for a simple task of that kind, but we need to figure out the best way to do that. It’s always a good idea to explore lightweight vanilla JavaScript snippets as well — preferably the ones that don’t have any third-party dependencies. Fortunately, there is no shortage in tooling to do just that.', '2021-09-02 20:47:03', 1),
(26, 'Simplify Your Stack With A Custom-Made Static Site Generator', 'With the advent of the Jamstack movement, statically-served sites have become all the rage again. Most developers serving static HTML aren’t authoring native HTML. To have a solid developer experience, we often turn to tools called Static Site Generators (SSG).\r\n\r\nThese tools come with many features that make authoring large-scale static sites pleasant. Whether they provide simple hooks into third-party APIs like Gatsby’s data sources or provide in-depth configuration like 11ty’s huge collection of template engines, there’s something for everyone in static site generation.\r\n\r\nBecause these tools are built for diverse use cases, they have to have a lot of features. Those features make them powerful. They also make them quite complex and opaque for new developers. In this article, we’ll take the SSG down to its basic components and create our very own.', '2021-08-29 20:53:07', 9),
(27, 'Building A Dynamic Header With Intersection Observer', 'The Intersection Observer API is a JavaScript API that enables us to observe an element and detect when it passes a specified point in a scrolling container — often (but not always) the viewport — triggering a callback function.\r\n\r\nIntersection Observer can be considered more performant than listening for scroll events on the main thread, as it is asynchronous, and the callback will only fire when the element we’re observing meets the specified threshold, instead every time the scroll position is updated. In this article, we’ll walk through an example of how we can use Intersection Observer to build a fixed header component that changes when it intersects with different sections of the webpage.', '2021-07-15 20:53:39', 9),
(28, 'Styling Components In React', 'Styling React components over the years has improved and become much easier with various techniques and strategies. In this tutorial, we’re going to learn how to style React components using four major styling strategies — with examples on how to use them. In the process, I will explain the cons and pros of these styling strategies, and by the end of this tutorial, you’ll know all about styling React components and how they work along with the various methods that can be used for styling these components.', '2021-06-19 20:54:35', 1);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL,
  `flag` tinyint(1) NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_article_id` (`article_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `content`, `createdAt`, `flag`, `article_id`, `user_id`) VALUES
(49, 'Non magni nihil aut porro eligendi qui voluptatem molestias aut delectus autem et perferendis sequi aut iure eveniet et perferendis sint. Ea iste culpa 33 fugiat asperiores aut obcaecati earum sed sint saepe eos dolore molestias.', '2021-09-02 20:59:57', 0, 28, 1),
(50, 'Sit possimus delectus et sint fugiat sed neque optio est expedita animi id amet omnis ut inventore voluptatem aut iure molestiae. Et repudiandae iusto est galisum asperiores sit corrupti pariatur ut laborum blanditiis qui quia excepturi ut voluptatem voluptas. Et iste quo laborum nulla vel quis perspiciatis nam sunt repellendus aut molestiae iure.', '2021-09-02 21:00:13', 0, 26, 1),
(51, 'Rem deleniti nemo qui blanditiis necessitatibus est modi nobis et labore laborum. Non nihil rerum qui magni doloremque in explicabo ullam et maxime officiis quo eaque delectus a ducimus officia. Qui doloremque internos vel voluptas alias non consequatur necessitatibus et galisum consequatur!', '2021-09-02 21:01:08', 0, 28, 8),
(52, 'Et internos laudantium ut pariatur dolorem qui placeat dolores. Non beatae perferendis et animi facere hic quaerat omnis in laboriosam autem. Aut eveniet praesentium ut architecto quaerat aut eveniet enim sit provident voluptatem eos quos beatae sed molestiae repellendus.', '2021-09-02 21:01:25', 0, 27, 8),
(53, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2021-09-02 21:02:03', 0, 27, 8),
(54, 'Pellentesque in tellus sit amet arcu commodo pellentesque vitae eu elit. Integer nisi purus, mattis in augue id viverra.', '2021-09-02 21:03:08', 0, 26, 8),
(55, '\r\nDonec pretium velit leo. Nam sodales magna eget libero sodales elementum. In vitae dignissim nisl. Pellentesque et nisi.', '2021-09-02 21:03:19', 0, 26, 8),
(56, 'Donec ultricies, nulla sollicitudin semper scelerisque, ligula magna commodo eros, sit amet semper est felis finibus at.', '2021-09-02 21:03:55', 0, 25, 8),
(57, 'Donec ultricies, nulla sollicitudin semper scelerisque, ligula magna commodo eros, sit amet semper est felis finibus at.', '2021-09-02 21:04:28', 0, 28, 9),
(58, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In faucibus ex velit.', '2021-09-02 21:04:51', 0, 25, 9);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `createdAt` datetime NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `password`, `createdAt`, `role_id`) VALUES
(1, 'Alex', '$2y$10$vCDQqO.neF1qCCiNdh5js.ujF6ExidHNA7ie.rCbNu.YjWy1qJQVm', '2021-06-25 14:40:29', 1),
(8, 'User', '$2y$10$YyjtTTtbkL2G2NbrLxVWXO/OoQ3WEzJxllOj5CXQ4OwNAgH9/PN1K', '2021-09-02 20:49:53', 2),
(9, 'Admin', '$2y$10$T.uQNe.l9SCLyhEsdohD8uZIxUSmXEnwlYB3nd4v3ARr4hmhzSvo2', '2021-09-02 20:50:26', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_article_id` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
