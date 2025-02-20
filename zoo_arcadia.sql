-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 20 fév. 2025 à 22:08
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
-- Base de données : `zoo_arcadia`
--

-- --------------------------------------------------------

--
-- Structure de la table `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `habitat_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `arrival_date` date NOT NULL,
  `specie_id` int(11) NOT NULL,
  `current_state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `animals`
--

INSERT INTO `animals` (`id`, `habitat_id`, `name`, `surname`, `image`, `arrival_date`, `specie_id`, `current_state`) VALUES
(1, 3, 'martin', 'le penseur', 'zoo-arcadia-singe.webp', '2023-05-02', 1, 'En forme'),
(2, 3, 'pedro', 'le beau parleur', 'zoo-arcadia-ara.webp', '2023-05-02', 2, 'Fatigué'),
(3, 3, 'gru', 'le flamboyant', 'zoo-arcadia-toucan.webp', '2023-05-02', 3, 'Reposé'),
(4, 2, 'ninja', 'la sprinteuse', 'zoo-arcadia-tortue.webp', '2023-05-02', 4, 'Lent et fatigué'),
(5, 2, 'daphne', 'la masquotte', 'zoo-arcadia-loutre.webp', '2023-05-02', 6, 'En pleine forme'),
(6, 2, 'croco', 'le mordant', 'zoo-arcadia-habitats-marais.webp', '2023-05-02', 5, 'Somnolent'),
(7, 1, 'sophie', 'la girafe', 'zoo-arcadia-girafe.webp', '2023-05-02', 7, 'Actif et curieux'),
(8, 1, 'dumbo', 'l\'innarêtable', 'zoo-arcadia-elephant-xl.webp', '2023-05-02', 8, 'Détendu'),
(9, 1, 'Iris', 'la peureuse', 'zoo-arcadia-rhinoceros.webp', '2023-05-02', 9, 'Prudente');

-- --------------------------------------------------------

--
-- Structure de la table `animals_foods`
--

CREATE TABLE `animals_foods` (
  `animals_id` int(11) NOT NULL,
  `foods_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `animals_foods`
--

INSERT INTO `animals_foods` (`animals_id`, `foods_id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(2, 2),
(3, 1),
(3, 3),
(4, 6),
(4, 7),
(4, 8),
(5, 4),
(6, 4),
(6, 5),
(7, 6),
(7, 7),
(7, 8),
(8, 1),
(8, 6),
(8, 7),
(9, 6),
(9, 7),
(9, 9);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `habitat_id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `habitat_id`, `comment`, `date`) VALUES
(1, 2, 'Premier commentaire', '2025-02-11 08:02:41');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250126151243', '2025-01-26 15:12:51', 164),
('DoctrineMigrations\\Version20250126151558', '2025-01-26 15:16:32', 12),
('DoctrineMigrations\\Version20250126151843', '2025-01-26 15:19:23', 52),
('DoctrineMigrations\\Version20250126152051', '2025-01-26 15:21:10', 52),
('DoctrineMigrations\\Version20250127030321', '2025-01-27 03:04:00', 7),
('DoctrineMigrations\\Version20250129084416', '2025-01-29 08:45:09', 66),
('DoctrineMigrations\\Version20250129085933', '2025-01-29 09:00:44', 11),
('DoctrineMigrations\\Version20250129090258', '2025-01-29 09:03:43', 94),
('DoctrineMigrations\\Version20250129091313', '2025-01-29 09:13:44', 9),
('DoctrineMigrations\\Version20250131085958', '2025-01-31 09:00:58', 108),
('DoctrineMigrations\\Version20250210100916', '2025-02-10 10:09:51', 67),
('DoctrineMigrations\\Version20250210102551', '2025-02-10 10:26:07', 99),
('DoctrineMigrations\\Version20250210104722', '2025-02-10 10:47:25', 7),
('DoctrineMigrations\\Version20250211022017', '2025-02-11 02:21:19', 96),
('DoctrineMigrations\\Version20250211024338', '2025-02-11 02:43:43', 9),
('DoctrineMigrations\\Version20250211091900', '2025-02-11 09:19:11', 144);

-- --------------------------------------------------------

--
-- Structure de la table `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `weight` double NOT NULL,
  `date` date NOT NULL,
  `details` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `exam`
--

INSERT INTO `exam` (`id`, `animal_id`, `food_id`, `weight`, `date`, `details`) VALUES
(1, 3, 3, 3, '2025-02-12', 'Rien de plus'),
(2, 3, 3, 3, '2025-02-12', 'Rien de plus'),
(3, 4, 1, 0.2, '1995-02-12', 'Test');

-- --------------------------------------------------------

--
-- Structure de la table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `foods`
--

INSERT INTO `foods` (`id`, `name`) VALUES
(1, 'Fruits'),
(2, 'Graines'),
(3, 'Insectes'),
(4, 'Poisson'),
(5, 'Viande'),
(6, 'Feuilles'),
(7, 'Herbes'),
(8, 'Fleurs'),
(9, 'Bambou');

-- --------------------------------------------------------

--
-- Structure de la table `habitats`
--

CREATE TABLE `habitats` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `icon_menu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `habitats`
--

INSERT INTO `habitats` (`id`, `name`, `description`, `image`, `icon_menu`) VALUES
(1, 'savane', 'Découvrez notre savane au zoo, un vaste territoire doré où rhinocéros, majestueux éléphants et nos girafes évoluent dans un décor digne des plaines africaines', 'zoo-arcadia-habitats-savane.webp', 'zoo-arcadia-brown_menu.webp'),
(2, 'marais', 'Plongez au cœur de notre marais où figurent nos crocodiles, tortues d’eau douce et nos loutres.', 'zoo-arcadia-habitats-marais.webp', 'zoo-arcadia-marais-menu.webp'),
(3, 'jungle', 'Explorez notre jungle au zoo, un écrin de verdure où singes espiègles, perroquets colorés et majestueux toucans cohabitent en harmonie.', 'zoo-arcadia-habitats-jungle.webp', 'zoo-arcadia-green_menu.webp');

-- --------------------------------------------------------

--
-- Structure de la table `horaires`
--

CREATE TABLE `horaires` (
  `id` int(11) NOT NULL,
  `jour` varchar(10) NOT NULL,
  `opening_hours` time NOT NULL,
  `closing_hours` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `horaires`
--

INSERT INTO `horaires` (`id`, `jour`, `opening_hours`, `closing_hours`) VALUES
(1, 'Lundi', '09:00:00', '18:00:00'),
(2, 'Mardi', '09:00:00', '18:00:00'),
(3, 'Mercredi', '09:00:00', '18:00:00'),
(4, 'Jeudi', '09:00:00', '18:00:00'),
(5, 'Vendredi', '09:00:00', '18:00:00'),
(6, 'Samedi', '10:00:00', '20:00:00'),
(7, 'Dimanche', '11:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `images_animals`
--

CREATE TABLE `images_animals` (
  `id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `meals`
--

CREATE TABLE `meals` (
  `id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `hours` time NOT NULL,
  `quantity` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `meals`
--

INSERT INTO `meals` (`id`, `animal_id`, `food_id`, `date`, `hours`, `quantity`) VALUES
(1, 1, 1, '1995-06-26', '19:30:00', 1.2);

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `score` smallint(6) NOT NULL,
  `comment` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`id`, `pseudo`, `score`, `comment`, `date`, `status_id`) VALUES
(1, 'Alice', 5, 'Superbe expérience, les animaux sont bien traités.', '2025-01-31 10:10:27', 2),
(2, 'Bob', 4, 'Beau parc, mais un peu trop de monde.', '2025-01-31 10:10:27', 2),
(4, 'David', 5, 'Magnifique ! Les girafes sont impressionnantes.', '2025-01-31 10:10:27', 2),
(5, 'Emma', 2, 'Beaucoup d\'attente aux attractions.', '2025-01-31 10:10:27', 2),
(6, 'Franck', 4, 'Très bien, propre et bien organisé.', '2025-01-31 10:10:27', 2),
(8, 'Hugo', 5, 'Expérience incroyable, on reviendra !', '2025-01-31 10:10:27', 2),
(9, 'Isabelle', 1, 'Déçu par le peu d\'animaux visibles.', '2025-01-31 10:10:27', 2),
(10, 'Julien', 4, 'Les enfants ont adoré, belle journée.', '2025-01-31 10:10:27', 2),
(11, 'Karine', 5, 'Un lieu magnifique et bien entretenu.', '2025-01-31 10:10:27', 2),
(12, 'Louis', 2, 'Cher pour ce que c\'est.', '2025-01-31 10:10:27', 2),
(14, 'Nicolas', 4, 'Belles infrastructures, bien pensé.', '2025-01-31 10:10:27', 2),
(15, 'Océane', 5, 'J\'ai adoré les spectacles avec les otaries.', '2025-01-31 10:10:27', 2),
(16, 'Pierre', 3, 'Pas mal, mais il manque un coin ombragé.', '2025-01-31 10:10:27', 2),
(17, 'Quentin', 4, 'Bon moment en famille.', '2025-01-31 10:10:27', 2),
(18, 'Roxane', 5, 'La girafe est trop mignonne.', '2025-01-31 10:10:27', 2),
(20, 'Théo', 5, 'Expérience inoubliable, je recommande !', '2025-01-31 10:10:27', 2);

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `url_icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `url_icon`) VALUES
(1, 'Visite en petit train2', 'Moment de détente', 'zoo-arcadia-train.webp'),
(2, 'Visite en petit train', 'Moment de détente', 'zoo-arcadia-train.webp'),
(3, 'visite guidée (gratuit)', 'visite des habitats', 'zoo-arcadia-carte.webp');

-- --------------------------------------------------------

--
-- Structure de la table `species`
--

CREATE TABLE `species` (
  `id` int(11) NOT NULL,
  `specie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `species`
--

INSERT INTO `species` (`id`, `specie`) VALUES
(1, 'saïmiri'),
(2, 'ara'),
(3, 'toucan'),
(4, 'tortue'),
(5, 'crocodile'),
(6, 'loutre'),
(7, 'girafe'),
(8, 'éléphant'),
(9, 'rhinocéros');

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `id` int(11) NOT NULL,
  `statut` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`id`, `statut`) VALUES
(1, 'to_checked'),
(2, 'checked');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(13, 'zooarcadia.pro@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$LOHXlK6dNqu5nb.QihbNsett8OPcwujSox3R0emqUqGCsXk06fz9y');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_966C69DDAFFE2D26` (`habitat_id`),
  ADD KEY `IDX_966C69DDD5436AB7` (`specie_id`);

--
-- Index pour la table `animals_foods`
--
ALTER TABLE `animals_foods`
  ADD PRIMARY KEY (`animals_id`,`foods_id`),
  ADD KEY `IDX_D7EA35132B9E58` (`animals_id`),
  ADD KEY `IDX_D7EA357BC2350B` (`foods_id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5F9E962AAFFE2D26` (`habitat_id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_38BBA6C68E962C16` (`animal_id`),
  ADD KEY `IDX_38BBA6C6BA8E87C4` (`food_id`);

--
-- Index pour la table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `habitats`
--
ALTER TABLE `habitats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `horaires`
--
ALTER TABLE `horaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `images_animals`
--
ALTER TABLE `images_animals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_91177BF8E962C16` (`animal_id`);

--
-- Index pour la table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E229E6EA8E962C16` (`animal_id`),
  ADD KEY `IDX_E229E6EABA8E87C4` (`food_id`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6970EB0F6BF700BD` (`status_id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `species`
--
ALTER TABLE `species`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `habitats`
--
ALTER TABLE `habitats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `horaires`
--
ALTER TABLE `horaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `images_animals`
--
ALTER TABLE `images_animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `species`
--
ALTER TABLE `species`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `statut`
--
ALTER TABLE `statut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `FK_966C69DDAFFE2D26` FOREIGN KEY (`habitat_id`) REFERENCES `habitats` (`id`),
  ADD CONSTRAINT `FK_966C69DDD5436AB7` FOREIGN KEY (`specie_id`) REFERENCES `species` (`id`);

--
-- Contraintes pour la table `animals_foods`
--
ALTER TABLE `animals_foods`
  ADD CONSTRAINT `FK_D7EA35132B9E58` FOREIGN KEY (`animals_id`) REFERENCES `animals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D7EA357BC2350B` FOREIGN KEY (`foods_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_5F9E962AAFFE2D26` FOREIGN KEY (`habitat_id`) REFERENCES `habitats` (`id`);

--
-- Contraintes pour la table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `FK_38BBA6C68E962C16` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`id`),
  ADD CONSTRAINT `FK_38BBA6C6BA8E87C4` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`);

--
-- Contraintes pour la table `images_animals`
--
ALTER TABLE `images_animals`
  ADD CONSTRAINT `FK_91177BF8E962C16` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`id`);

--
-- Contraintes pour la table `meals`
--
ALTER TABLE `meals`
  ADD CONSTRAINT `FK_E229E6EA8E962C16` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`id`),
  ADD CONSTRAINT `FK_E229E6EABA8E87C4` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`);

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_6970EB0F6BF700BD` FOREIGN KEY (`status_id`) REFERENCES `statut` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
