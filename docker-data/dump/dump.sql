-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 11, 2024 at 01:55 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teacoffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatars`
--

CREATE TABLE `avatars` (
  `id` int NOT NULL,
  `url_avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'Café', 'Catégorie regroupant différents types de café'),
(2, 'Thé', 'Catégorie regroupant différents types de thé');

-- --------------------------------------------------------

--
-- Table structure for table `charac`
--

CREATE TABLE `charac` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `charac`
--

INSERT INTO `charac` (`id`, `name`, `type`) VALUES
(254, 'Poids', 'kg'),
(255, 'Longueur', 'cm'),
(256, 'Volume', 'l'),
(257, 'Température', 'celsius'),
(258, 'Tension', 'volts'),
(259, 'Courant', 'ampere'),
(260, 'Surface', 'm2'),
(261, 'Consommation', 'watts'),
(262, 'Fréquence', 'hertz'),
(263, 'Durée', 'minute'),
(264, 'Capacité', 'ml'),
(265, 'Capacité de stockage', 'gigabyte'),
(266, 'Unité de temps', 'year'),
(267, 'Pays', 'country'),
(268, 'Couleur', 'color'),
(269, 'Taux', 'percent'),
(270, 'Débit', 'kmh'),
(271, 'Pression', 'pascal'),
(272, 'Prix', 'dolar'),
(273, 'Énergie', 'cal'),
(274, 'Résistance', 'ohm'),
(275, 'Luminosité', 'lux'),
(276, 'Son', 'decibel'),
(277, 'Quantité', 'unit'),
(278, 'Masse', 'ton'),
(279, 'Déplacement', 'km'),
(280, 'Humidité', 'percent'),
(281, 'Angle', 'degree'),
(282, 'Département', 'province'),
(283, 'Vitesse de rotation', 'rpm'),
(284, 'Prix', 'euro');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `comment` text,
  `users_id` int NOT NULL,
  `products_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `users_id`, `products_id`) VALUES
(1, 'Excellent thé!', 1, 1),
(2, 'J\'adore la saveur!', 2, 2),
(3, 'Espresso doux', 3, 3),
(4, 'Très bon café.', 4, 4),
(5, 'Le meilleur thé que j\'ai jamais goûté!', 5, 5),
(6, 'Délicieux et rafraîchissant.', 6, 6),
(7, 'Un must pour les amateurs de café.', 7, 7),
(8, 'Un thé aromatique et apaisant.', 8, 8),
(9, 'Café corsé avec une belle crema.', 9, 9),
(10, 'Thé vert léger et revigorant.', 10, 10),
(11, 'Le café parfait pour commencer la journée.', 11, 11),
(12, 'Thé noir classique et robuste.', 12, 12),
(13, 'Un café velouté et équilibré.', 13, 13),
(14, 'Thé aux agrumes rafraîchissant.', 14, 14),
(15, 'Café riche et plein de saveur.', 15, 15),
(16, 'Une infusion parfaite pour se détendre.', 16, 16),
(17, 'Le café idéal pour une pause.', 17, 17),
(18, 'Thé au jasmin délicieusement parfumé.', 18, 18),
(19, 'Un café doux et aromatique.', 19, 19),
(20, 'Thé épicé avec une touche de cannelle.', 20, 20),
(21, 'Café équilibré avec des notes de chocolat.', 21, 21),
(22, 'Thé fruité et vivifiant.', 22, 22),
(23, 'Le café parfaitement torréfié.', 23, 23),
(24, 'Thé oolong complexe et délicat.', 24, 24),
(25, 'Café doux et subtilement acidulé.', 25, 25),
(26, 'Thé au citron rafraîchissant.', 26, 26),
(27, 'Un café fort et intense.', 27, 27),
(28, 'Thé rooibos réconfortant.', 28, 28),
(29, 'Café velouté avec des notes de caramel.', 29, 29),
(30, 'Thé blanc délicat et floral.', 30, 30),
(31, 'Un café pour les connaisseurs.', 31, 31),
(32, 'Thé menthe rafraîchissant.', 32, 32),
(33, 'Café acidulé et fruité.', 33, 33),
(34, 'Thé au gingembre énergisant.', 34, 34),
(35, 'Café corsé avec une finale chocolatée.', 35, 35),
(36, 'Thé équilibré et parfumé.', 36, 36),
(37, 'Café doux avec des notes de noisette.', 37, 37),
(38, 'Thé camomille apaisant.', 38, 38),
(39, 'Café velouté et fruité.', 39, 39),
(40, 'Thé matcha énergétique.', 40, 40),
(41, 'Café intense avec une touche de caramel.', 41, 41),
(42, 'Thé chai épicé.', 42, 42),
(43, 'Café doux et aromatique.', 43, 43),
(44, 'Thé hibiscus revigorant.', 44, 44),
(45, 'Café équilibré avec des notes de fruits secs.', 45, 45),
(46, 'Thé earl grey classique.', 46, 46),
(47, 'Café riche avec une touche de vanille.', 47, 47),
(48, 'Thé fruité et rafraîchissant.', 48, 48),
(49, 'Café corsé et puissant.', 49, 49),
(50, 'Thé rooibos à la vanille.', 50, 50),
(51, 'Café doux et onctueux.', 51, 51),
(52, 'Thé vert matcha de qualité supérieure.', 52, 52),
(53, 'Café intense avec des arômes de noisette.', 53, 53),
(54, 'Thé blanc aux fleurs de cerisier.', 54, 54),
(55, 'Café corsé avec une longue finale.', 55, 55),
(56, 'Thé à la menthe poivrée.', 56, 56),
(57, 'Café velouté et équilibré.', 57, 57),
(58, 'Thé à la lavande apaisant.', 58, 58),
(59, 'Café fort et intense.', 59, 59),
(60, 'Thé aux baies sauvages.', 60, 60),
(61, 'Café délicat avec des notes de caramel.', 61, 61),
(62, 'Thé vert sencha japonais.', 62, 62),
(63, 'Café riche et aromatique.', 63, 63),
(64, 'Thé oolong au jasmin.', 64, 64),
(65, 'Café corsé et complexe.', 65, 65),
(66, 'Thé chai épicé.', 66, 66),
(67, 'Café doux et fruité.', 67, 67),
(68, 'Thé fruité et rafraîchissant.', 68, 68),
(69, 'Café velouté avec des notes de chocolat.', 69, 69),
(70, 'Thé noir corsé.', 70, 70),
(71, 'Café riche avec une finale caramélisée.', 71, 71),
(72, 'Thé aux épices chai.', 72, 72),
(73, 'Café intense et puissant.', 73, 73),
(74, 'Thé vert matcha de qualité premium.', 74, 74),
(75, 'Café équilibré avec des notes de noix.', 75, 75),
(76, 'Thé blanc délicat avec une note florale.', 76, 76),
(77, 'Café fort avec une touche de cacao.', 77, 77),
(78, 'Thé à la menthe fraîche.', 78, 78),
(79, 'Café velouté et équilibré.', 79, 79),
(80, 'Thé vert sencha rafraîchissant.', 80, 80),
(81, 'Café corsé avec des arômes de fruits secs.', 81, 81),
(82, 'Thé oolong floral et parfumé.', 82, 82),
(83, 'Café doux avec des notes de vanille.', 83, 83),
(84, 'Thé noir classique et riche.', 84, 84),
(85, 'Café riche et robuste.', 85, 85),
(86, 'Thé à la cerise sucrée.', 86, 86),
(87, 'Café corsé avec une finale douce.', 87, 87),
(88, 'Thé vert matcha énergisant.', 88, 88),
(89, 'Café velouté avec des notes de caramel.', 89, 89),
(90, 'Thé blanc délicat et floral.', 90, 90),
(91, 'Café intense avec une touche de noix.', 91, 91),
(92, 'Thé à la menthe fraîche.', 92, 92),
(93, 'Café équilibré et aromatique.', 93, 93),
(94, 'Thé oolong fruité et rafraîchissant.', 94, 94),
(95, 'Café doux avec des notes de cacao.', 95, 95),
(96, 'Thé noir corsé avec une finale douce.', 96, 96),
(97, 'Café riche et complexe.', 97, 97),
(98, 'Thé aux épices chai réconfortant.', 98, 98),
(99, 'Café intense avec des arômes de fruits.', 99, 99),
(100, 'Thé vert sencha rafraîchissant.', 100, 100);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `image_main` tinyint DEFAULT NULL,
  `url_image` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image_main`, `url_image`) VALUES
(1, 1, 'café-affogato.png'),
(2, 1, 'café-americano.png'),
(3, 1, 'café-bélizien.png'),
(4, 1, 'café-bio.png'),
(5, 1, 'café-bolivien.png'),
(6, 1, 'café-brésilien.png'),
(7, 1, 'café-cappuccino.png'),
(8, 1, 'café-colombien.png'),
(9, 1, 'café-costaricien.png'),
(10, 1, 'café-cubain.png'),
(11, 1, 'café-dominicain.png'),
(12, 1, 'café-Équatorien.png'),
(13, 1, 'café-Éthiopien.png'),
(14, 1, 'café-expresso.png'),
(15, 1, 'café-flat-white.png'),
(16, 1, 'café-grec.png'),
(17, 1, 'café-guatémaltèque.png'),
(18, 1, 'café-guyanien.png'),
(19, 1, 'café-haïtien.png'),
(20, 1, 'café-hawaïen.png'),
(21, 1, 'café-hondurien.png'),
(22, 1, 'café-irlandais.png'),
(23, 1, 'café-jamaïcain.png'),
(24, 1, 'café-java.png'),
(25, 1, 'café-kenyan.png'),
(26, 1, 'café-latté.png'),
(27, 1, 'café-long-black.png'),
(28, 1, 'café-macchiato.png'),
(29, 1, 'café-mexicain.png'),
(30, 1, 'café-moka.png'),
(31, 1, 'café-nicaraguayen.png'),
(32, 1, 'café-ougandais.png'),
(33, 1, 'café-panaméen.png'),
(34, 1, 'café-péruvien.png'),
(35, 1, 'café-portoricain.png'),
(36, 1, 'café-ristretto.png'),
(37, 1, 'café-salavadorien.png'),
(38, 1, 'café-sumatra.png'),
(39, 1, 'café-surinamien.png'),
(40, 1, 'café-tanzanien.png'),
(41, 1, 'café-trinidadien.png'),
(42, 1, 'café-turc.png'),
(43, 1, 'café-vénézuélien.png'),
(44, 1, 'café-vietnamien.png'),
(45, 1, 'café-yéménite.png'),
(46, 1, 'café-zimbabwéen.png'),
(47, 1, 'thé-vert.png'),
(48, 1, 'thé-noir.png'),
(49, 1, 'thé-blanc.png'),
(50, 1, 'thé-oolong.png'),
(51, 1, 'thé-jaune.png'),
(52, 1, 'thé-pu-erh.png'),
(53, 1, 'thé-matcha.png'),
(54, 1, 'thé-sencha.png'),
(55, 1, 'thé-genmaicha.png'),
(56, 1, 'thé-gunpowder.png'),
(57, 1, 'thé-darjeeling.png'),
(58, 1, 'thé-assam.png'),
(59, 1, 'thé-earl-grey.png'),
(60, 1, 'thé-english-breakfast.png'),
(61, 1, 'thé-irish-breakfast.png'),
(62, 1, 'thé-ceylan.png'),
(63, 1, 'thé-kenyan.png'),
(64, 1, 'thé-lapsang-souchong.png'),
(65, 1, 'thé-keemun.png'),
(66, 1, 'thé-yunnan.png'),
(67, 1, 'thé-nilgiri.png'),
(68, 1, 'thé-anxi-tieguanyin.png'),
(69, 1, 'thé-wuyi-rock.png'),
(70, 1, 'thé-bai-hao-yin-zhen.png'),
(71, 1, 'thé-bai-mu-dan.png'),
(72, 1, 'thé-shou-mei.png'),
(73, 1, 'thé-long-jing.png'),
(74, 1, 'thé-bi-luo-chun.png'),
(75, 1, 'thé-da-hong-pao.png'),
(76, 1, 'thé-jin-jun-mei.png'),
(77, 1, 'thé-gyokuro.png'),
(78, 1, 'thé-hojicha.png'),
(79, 1, 'thé-kukicha.png'),
(80, 1, 'thé-bancha.png'),
(81, 1, 'thé-rooibos.png'),
(82, 1, 'thé-yerba-mate.png'),
(83, 1, 'thé-honeybush.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `basket` tinyint(1) DEFAULT NULL,
  `status` enum('en attente','expedier','livrer','echec') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `users_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='		';

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `basket`, `status`, `created_at`, `updated_at`, `users_id`) VALUES
(1, 1, 'en attente', '2024-04-27 09:30:00', '2024-04-27 09:30:00', 3),
(2, 0, 'expedier', '2024-04-27 10:15:00', '2024-05-10 22:20:58', 4),
(3, 0, 'livrer', '2024-04-27 10:45:00', '2024-05-10 22:20:58', 5),
(4, 0, 'echec', '2024-04-27 11:20:00', '2024-05-10 22:20:58', 6),
(5, 1, 'en attente', '2024-04-27 11:45:00', '2024-04-27 11:45:00', 7),
(6, 0, 'expedier', '2024-04-27 12:10:00', '2024-05-10 22:20:58', 8),
(7, 0, 'livrer', '2024-04-27 12:35:00', '2024-05-10 22:20:58', 9),
(8, 0, 'echec', '2024-04-27 13:00:00', '2024-05-10 22:20:58', 10),
(9, 1, 'en attente', '2024-04-27 13:25:00', '2024-04-27 13:25:00', 11),
(10, 0, 'expedier', '2024-04-27 13:50:00', '2024-05-10 22:20:58', 12),
(11, 0, 'livrer', '2024-04-27 14:15:00', '2024-05-10 22:20:58', 13),
(12, 0, 'echec', '2024-04-27 14:40:00', '2024-05-10 22:20:58', 14),
(13, 1, 'en attente', '2024-04-27 15:05:00', '2024-04-27 15:05:00', 15),
(14, 0, 'expedier', '2024-04-27 15:30:00', '2024-05-10 22:20:58', 16),
(15, 0, 'livrer', '2024-04-27 15:55:00', '2024-05-10 22:20:58', 17),
(16, 0, 'echec', '2024-04-27 16:20:00', '2024-05-10 22:20:58', 18),
(17, 1, 'en attente', '2024-04-27 16:45:00', '2024-04-27 16:45:00', 19),
(18, 1, 'en attente', '2024-04-27 17:00:00', '2024-04-27 17:00:00', 20),
(19, 0, 'expedier', '2024-04-27 17:15:00', '2024-05-10 22:20:58', 21),
(20, 0, 'livrer', '2024-04-27 17:30:00', '2024-05-10 22:20:58', 22),
(21, 0, 'echec', '2024-04-27 17:45:00', '2024-05-10 22:20:58', 23),
(22, 1, 'en attente', '2024-04-27 18:00:00', '2024-04-27 18:00:00', 24),
(23, 0, 'expedier', '2024-04-27 18:15:00', '2024-05-10 22:20:58', 25),
(24, 0, 'livrer', '2024-04-27 18:30:00', '2024-05-10 22:20:58', 26),
(25, 0, 'echec', '2024-04-27 18:45:00', '2024-05-10 22:20:58', 27),
(26, 1, 'en attente', '2024-04-27 19:00:00', '2024-04-27 19:00:00', 28),
(27, 0, 'expedier', '2024-04-27 19:15:00', '2024-05-10 22:20:58', 29),
(28, 0, 'livrer', '2024-04-27 19:30:00', '2024-05-10 22:20:58', 30);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `price` float DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_id` int NOT NULL,
  `sub_category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity`, `created_at`, `updated_at`, `category_id`, `sub_category_id`) VALUES
(1, 'Café Affogato Corsé ', 'Café Corsé de provenance : Ghana  hawaïen, des notes de noisette et de chocolat noir avec des saveurs boisée et intense.', 12.5, 55, '2024-05-02 02:46:15', '2024-05-02 02:46:15', 1, 1),
(2, 'Café Americano Corsé ', 'Café Corsé de provenance : Inde  Faible, des notes de gingembre et de caramel avec des saveurs veloutée et onctueuse.', 4.5, 100, '2024-05-02 02:46:15', '2024-05-02 02:46:15', 1, 1),
(3, 'Café Bélizien Corsé ', 'Café Corsé de provenance : Népal  Noix, des notes de citron et de chocolat blanc avec des saveurs crémeuse et veloutée.', 3, 65, '2024-05-02 02:46:15', '2024-05-02 02:46:15', 1, 1),
(4, 'Café Bio Corsé ', 'Café Corsé d\'origine : Indonésie  Noix de coco, des notes de pruneaux et de cacao avec des saveurs acidulée et vive.', 11.5, 62, '2024-05-02 02:46:15', '2024-05-02 02:46:15', 1, 1),
(5, 'Café Bolivien Corsé ', 'Café Corsé de provenance : Rwanda  Jaune, des notes de réglisse et de caramel avec des saveurs biscuitée et réconfortante.', 2.5, 37, '2024-05-02 02:46:15', '2024-05-02 02:46:15', 1, 1),
(6, 'Café Brésilien Corsé ', 'Café Corsé de provenance : Burundi  Bio, des notes de cannelle et de caramel avec des saveurs noisette et boisée.', 5.25, 95, '2024-05-02 02:46:15', '2024-05-02 02:46:15', 1, 1),
(7, 'Café Cappuccino Corsé ', 'Café Corsé de provenance : Costa Rica  Gingembre, des notes de cacao et de noix avec des saveurs fruitée et vive.', 3, 75, '2024-05-02 02:46:15', '2024-05-02 02:46:15', 1, 1),
(8, 'Café Colombien Corsé ', 'Café Corsé de provenance : Tanzanie  arabica, des notes de baies et de chocolat avec des saveurs acidulée et vive.', 11, 92, '2024-05-02 02:46:15', '2024-05-02 02:46:15', 1, 1),
(9, 'Café Costaricien Corsé ', 'Café Corsé d\'origine : Équateur  Costa, des notes de noisette et de chocolat noir avec des saveurs florale et aromatique.', 11.25, 81, '2024-05-02 02:46:15', '2024-05-02 02:46:15', 1, 1),
(10, 'Café Cubain Corsé ', 'Café Corsé d\'origine : Tanzanie  Abricot, des notes de poivre et de chocolat noir avec des saveurs chocolatée et onctueuse.', 13.25, 58, '2024-05-02 02:46:15', '2024-05-02 02:46:15', 1, 1),
(11, 'Café Dominicain Corsé ', 'Café Corsé d\'origine : Nigeria  colombien, des notes de gingembre et de caramel avec des saveurs caramélisée et sucrée.', 10, 15, '2024-05-02 02:46:15', '2024-05-02 02:46:15', 1, 1),
(12, 'Café Équatorien Corsé ', 'Café Corsé de provenance : Indonésie  Faible, des notes de cerise et de chocolat au lait avec des saveurs chocolatée et onctueuse.', 14.5, 5, '2024-05-02 02:46:15', '2024-05-02 02:46:15', 1, 1),
(13, 'Café Éthiopien Corsé ', 'Café Corsé d\'origine : Guyana  Lavande, des notes de fleurs et de chocolat avec des saveurs chocolatée et équilibrée.', 8.5, 17, '2024-05-02 02:46:15', '2024-05-02 02:46:15', 1, 1),
(14, 'Café Expresso Corsé ', 'Café Corsé d\'origine : Cameroun  Brun, des notes de cerise et de chocolat au lait avec des saveurs grillée et intense.', 7.5, 81, '2024-05-02 02:46:16', '2024-05-02 02:46:16', 1, 1),
(15, 'Café Flat White Corsé ', 'Café Corsé de provenance : Guyana  turc, des notes de pomme et de chocolat au lait avec des saveurs corsée et intense.', 10, 2, '2024-05-02 02:46:16', '2024-05-02 02:46:16', 1, 1),
(16, 'Café Grec Corsé ', 'Café Corsé d\'origine : Guatemala  Bleu, des notes de caramel et de cacao avec des saveurs vanille et crémeuse.', 12.5, 28, '2024-05-02 02:46:16', '2024-05-02 02:46:16', 1, 1),
(17, 'Café Guatémaltèque Corsé ', 'Café Corsé d\'origine : Bolivie  Gourmet, des notes de réglisse et de caramel avec des saveurs vanille et crémeuse.', 13, 88, '2024-05-02 02:46:16', '2024-05-02 02:46:16', 1, 1),
(18, 'Café Guyanien Corsé ', 'Café Corsé de provenance : Trinité-et-Tobago  Amande, des notes de réglisse et de caramel avec des saveurs vanille et crémeuse.', 2.25, 97, '2024-05-02 02:46:16', '2024-05-02 02:46:16', 1, 1),
(19, 'Café Haïtien Corsé ', 'Café Corsé de provenance : El Salvador  Bio, des notes de tabac et de caramel avec des saveurs noisette et gourmande.', 6, 71, '2024-05-02 02:46:16', '2024-05-02 02:46:16', 1, 1),
(20, 'Café Hawaïen Corsé ', 'Café Corsé d\'origine : Burkina Faso  robusta, des notes de noisette et de chocolat noir avec des saveurs fruitée et acidulée.', 4.5, 89, '2024-05-02 02:46:16', '2024-05-02 02:46:16', 1, 1),
(21, 'Café Hondurien Corsé ', 'Café Corsé de provenance : Malaisie  paraguayen, des notes d\'agrumes et de caramel avec des saveurs chocolatée et équilibrée.', 11, 46, '2024-05-02 02:46:16', '2024-05-02 02:46:16', 1, 1),
(22, 'Café Irlandais Corsé ', 'Café Corsé d\'origine : Burkina Faso  nicaraguayen, des notes de tabac et de caramel avec des saveurs fruitée et délicate.', 9, 34, '2024-05-02 02:46:16', '2024-05-02 02:46:16', 1, 1),
(23, 'Café Jamaïcain Corsé ', 'Café Corsé de provenance : Sierra Leone  Bio, des notes de amande et de chocolat au lait avec des saveurs fumée et robuste.', 8.5, 23, '2024-05-02 02:46:16', '2024-05-02 02:46:16', 1, 1),
(24, 'Café Java Corsé ', 'Café Corsé de provenance : Thaïlande  Noisettes, des notes de citron et de chocolat blanc avec des saveurs fruitée et délicate.', 7, 93, '2024-05-02 02:46:16', '2024-05-02 02:46:16', 1, 1),
(25, 'Café Kenyan Corsé ', 'Café Corsé d\'origine : Vietnam  Gourmet, des notes de poire et de chocolat blanc avec des saveurs sucrée et fruitée.', 12, 67, '2024-05-02 02:46:16', '2024-05-02 02:46:16', 1, 1),
(26, 'Café Latté Corsé ', 'Café Corsé de provenance : Burundi  Noisette, des notes de fruits rouges et de chocolat noir avec des saveurs noisette et boisée.', 13.5, 70, '2024-05-02 02:46:16', '2024-05-02 02:46:16', 1, 1),
(27, 'Café Long Black Corsé ', 'Café Corsé de provenance : Trinité-et-Tobago  kona, des notes de vanille et de caramel avec des saveurs caramel et sucrée.', 8, 14, '2024-05-02 02:46:16', '2024-05-02 02:46:16', 1, 1),
(28, 'Café Macchiato Corsé ', 'Café Corsé d\'origine : Papouasie-Nouvelle-Guinée  Exotique, des notes de cerise et de chocolat au lait avec des saveurs fruitée et délicate.', 2.25, 36, '2024-05-02 02:46:16', '2024-05-02 02:46:16', 1, 1),
(29, 'Café Mexicain Corsé ', 'Café Corsé de provenance : Jamaïque  Ananas, des notes d\'agrumes et de caramel avec des saveurs boisée et intense.', 2, 59, '2024-05-02 02:46:16', '2024-05-02 02:46:16', 1, 1),
(30, 'Café Moka Corsé ', 'Café Corsé d\'origine : Togo  Citron, des notes de noisette et de chocolat noir avec des saveurs florale et délicate.', 10, 4, '2024-05-02 02:46:17', '2024-05-02 02:46:17', 1, 1),
(31, 'Café Nicaraguayen Corsé ', 'Café Corsé d\'origine : Brésil  vénézuélien, des notes d\'agrumes et de caramel avec des saveurs fruitée et vive.', 4.25, 63, '2024-05-02 02:46:17', '2024-05-02 02:46:17', 1, 1),
(32, 'Café Ougandais Corsé ', 'Café Corsé de provenance : Philippines  Pêche, des notes de gingembre et de caramel avec des saveurs corsée et intense.', 5.25, 34, '2024-05-02 02:46:17', '2024-05-02 02:46:17', 1, 1),
(33, 'Café Panaméen Corsé ', 'Café Corsé d\'origine : Honduras  Coco, des notes de réglisse et de caramel avec des saveurs gourmande et sucrée.', 8, 71, '2024-05-02 02:46:17', '2024-05-02 02:46:17', 1, 1),
(34, 'Café Péruvien Corsé ', 'Café Corsé d\'origine : Thaïlande  péruvien, des notes d\'agrumes et de caramel avec des saveurs épicée et chaleureuse.', 10.5, 93, '2024-05-02 02:46:17', '2024-05-02 02:46:17', 1, 1),
(35, 'Café Portoricain Corsé ', 'Café Corsé d\'origine : Yémen  Noisette, des notes de poire et de chocolat blanc avec des saveurs épicée et chaleureuse.', 2, 36, '2024-05-02 02:46:17', '2024-05-02 02:46:17', 1, 1),
(36, 'Café Ristretto Corsé ', 'Café Corsé de provenance : République Dominicaine  Brun, des notes de caramel et de cacao avec des saveurs fruitée et acidulée.', 4.25, 92, '2024-05-02 02:46:17', '2024-05-02 02:46:17', 1, 1),
(37, 'Café Salavadorien Corsé ', 'Café Corsé d\'origine : Bolivie  Noix de pécan, des notes de fruits tropicaux et de chocolat avec des saveurs fruit sec et sucré.', 9.25, 91, '2024-05-02 02:46:17', '2024-05-02 02:46:17', 1, 1),
(38, 'Café Sumatra Corsé ', 'Café Corsé d\'origine : Burkina Faso  Équitable, des notes de miel et de fruits secs avec des saveurs fruit sec et sucré.', 8.5, 94, '2024-05-02 02:46:17', '2024-05-02 02:46:17', 1, 1),
(39, 'Café Surinamien Corsé ', 'Café Corsé d\'origine : République Dominicaine  Chocolaté, des notes de poivre et de chocolat noir avec des saveurs boisée et intense.', 3.25, 23, '2024-05-02 02:46:17', '2024-05-02 02:46:17', 1, 1),
(40, 'Café Tanzanien Corsé ', 'Café Corsé de provenance : Cameroun  Moyen, des notes de noisette et de chocolat noir avec des saveurs fruitée et vive.', 2.5, 15, '2024-05-02 02:46:17', '2024-05-02 02:46:17', 1, 1),
(41, 'Café Trinidadien Corsé ', 'Café Corsé de provenance : Ghana  Cardamome, des notes de cerise et de chocolat au lait avec des saveurs exotique et envoûtante.', 7, 86, '2024-05-02 02:46:17', '2024-05-02 02:46:17', 1, 1),
(42, 'Café Turc Corsé ', 'Café Corsé d\'origine : République centrafricaine  Coco, des notes de baies et de chocolat avec des saveurs acidulée et vive.', 11.25, 97, '2024-05-02 02:46:17', '2024-05-02 02:46:17', 1, 1),
(43, 'Café Vénézuélien Corsé ', 'Café Corsé d\'origine : Mexique  Faible, des notes de poivre et de chocolat noir avec des saveurs fumée et robuste.', 4, 35, '2024-05-02 02:46:17', '2024-05-02 02:46:17', 1, 1),
(44, 'Café Vietnamien Corsé ', 'Café Corsé de provenance : Laos  Abricot, des notes de menthe et de chocolat avec des saveurs fruitée et acidulée.', 2, 90, '2024-05-02 02:46:17', '2024-05-02 02:46:17', 1, 1),
(45, 'Café Yéménite Corsé ', 'Café Corsé d\'origine : Tanzanie  Mangue, des notes de baies et de chocolat avec des saveurs exotique et envoûtante.', 6.5, 53, '2024-05-02 02:46:17', '2024-05-02 02:46:17', 1, 1),
(46, 'Café Zimbabwéen Corsé ', 'Café Corsé d\'origine : Guatemala  galléga, des notes de caramel et de cacao avec des saveurs vanille et crémeuse.', 9, 95, '2024-05-02 02:46:17', '2024-05-02 02:46:17', 1, 1),
(47, 'Café Affogato Moyen ', 'Café Moyen de provenance : Colombie  Costa, des notes de pruneaux et de cacao avec des saveurs équilibrée et harmonieuse.', 11, 53, '2024-05-02 02:46:18', '2024-05-02 02:46:18', 1, 2),
(48, 'Café Americano Moyen ', 'Café Moyen d\'origine : Nigeria  mocha, des notes d\'agrumes et de caramel avec des saveurs fruitée et acidulée.', 4, 50, '2024-05-02 02:46:18', '2024-05-02 02:46:18', 1, 2),
(49, 'Café Bélizien Moyen ', 'Café Moyen de provenance : Togo  Moyen, des notes de pomme et de chocolat au lait avec des saveurs épicée et réconfortante.', 13, 32, '2024-05-02 02:46:18', '2024-05-02 02:46:18', 1, 2),
(50, 'Café Bio Moyen ', 'Café Moyen de provenance : Rwanda  Chaud, des notes de fleurs et de chocolat avec des saveurs corsée et intense.', 8.25, 73, '2024-05-02 02:46:18', '2024-05-02 02:46:18', 1, 2),
(51, 'Café Bolivien Moyen ', 'Café Moyen d\'origine : Madagascar  Vanillé, des notes de pomme et de chocolat au lait avec des saveurs biscuitée et réconfortante.', 11.5, 23, '2024-05-02 02:46:18', '2024-05-02 02:46:18', 1, 2),
(52, 'Café Brésilien Moyen ', 'Café Moyen d\'origine : Madagascar  Doux, des notes d\'agrumes et de caramel avec des saveurs fruitée et acidulée.', 2, 49, '2024-05-02 02:46:18', '2024-05-02 02:46:18', 1, 2),
(53, 'Café Cappuccino Moyen ', 'Café Moyen d\'origine : Nigeria  Doux, des notes de menthe et de chocolat avec des saveurs vanillée et crémeuse.', 12, 16, '2024-05-02 02:46:18', '2024-05-02 02:46:18', 1, 2),
(54, 'Café Colombien Moyen ', 'Café Moyen d\'origine : Cameroun  Pêche, des notes de piment et de caramel avec des saveurs chocolatée et onctueuse.', 14.25, 23, '2024-05-02 02:46:18', '2024-05-02 02:46:18', 1, 2),
(55, 'Café Costaricien Moyen ', 'Café Moyen d\'origine : Thaïlande  Pamplemousse, des notes de vanille et de caramel avec des saveurs corsée et intense.', 7.25, 59, '2024-05-02 02:46:18', '2024-05-02 02:46:18', 1, 2),
(56, 'Café Cubain Moyen ', 'Café Moyen d\'origine : Cameroun  bolivien, des notes de fruits tropicaux et de chocolat avec des saveurs veloutée et onctueuse.', 12.25, 18, '2024-05-02 02:46:18', '2024-05-02 02:46:18', 1, 2),
(57, 'Café Dominicain Moyen ', 'Café Moyen d\'origine : Burundi  Figues, des notes de baies et de chocolat avec des saveurs équilibrée et harmonieuse.', 13.5, 27, '2024-05-02 02:46:18', '2024-05-02 02:46:18', 1, 2),
(58, 'Café Équatorien Moyen ', 'Café Moyen de provenance : Ghana  turc, des notes de cacao et de noix avec des saveurs noisette et boisée.', 6.5, 73, '2024-05-02 02:46:18', '2024-05-02 02:46:18', 1, 2),
(59, 'Café Éthiopien Moyen ', 'Café Moyen de provenance : Zambie  vénézuélien, des notes de poivre et de chocolat noir avec des saveurs crémeuse et veloutée.', 4, 35, '2024-05-02 02:46:18', '2024-05-02 02:46:18', 1, 2),
(60, 'Café Expresso Moyen ', 'Café Moyen de provenance : Sierra Leone  Pistache, des notes de whisky et fumé avec des saveurs acidulée et vive.', 9.5, 67, '2024-05-02 02:46:18', '2024-05-02 02:46:18', 1, 2),
(61, 'Café Flat White Moyen ', 'Café Moyen d\'origine : République Dominicaine  Amande, des notes de fruits tropicaux et de chocolat avec des saveurs vanillée et crémeuse.', 10.25, 26, '2024-05-02 02:46:18', '2024-05-02 02:46:18', 1, 2),
(62, 'Café Grec Moyen ', 'Café Moyen d\'origine : Sierra Leone  Gourmet, des notes de amande et de chocolat au lait avec des saveurs florale et aromatique.', 6, 100, '2024-05-02 02:46:18', '2024-05-02 02:46:18', 1, 2),
(63, 'Café Guatémaltèque Moyen ', 'Café Moyen d\'origine : Brésil  jamaïcain, des notes de cannelle et de caramel avec des saveurs épicée et réconfortante.', 13.25, 41, '2024-05-02 02:46:19', '2024-05-02 02:46:19', 1, 2),
(64, 'Café Guyanien Moyen ', 'Café Moyen de provenance : Cameroun  Pomme, des notes de pomme et de chocolat au lait avec des saveurs fruit sec et sucré.', 9.25, 85, '2024-05-02 02:46:19', '2024-05-02 02:46:19', 1, 2),
(65, 'Café Haïtien Moyen ', 'Café Moyen de provenance : Malaisie  Menthe, des notes de whisky et fumé avec des saveurs fumée et robuste.', 8.5, 83, '2024-05-02 02:46:19', '2024-05-02 02:46:19', 1, 2),
(66, 'Café Hawaïen Moyen ', 'Café Moyen d\'origine : Tanzanie  Fruité, des notes de citron et de chocolat blanc avec des saveurs exotique et envoûtante.', 2, 16, '2024-05-02 02:46:19', '2024-05-02 02:46:19', 1, 2),
(67, 'Café Hondurien Moyen ', 'Café Moyen de provenance : Malaisie  Noix de cajou, des notes de pruneaux et de cacao avec des saveurs vanillée et crémeuse.', 6, 87, '2024-05-02 02:46:19', '2024-05-02 02:46:19', 1, 2),
(68, 'Café Irlandais Moyen ', 'Café Moyen d\'origine : Malaisie  vénézuélien, des notes de vanille et de caramel avec des saveurs biscuitée et réconfortante.', 5.25, 6, '2024-05-02 02:46:19', '2024-05-02 02:46:19', 1, 2),
(69, 'Café Jamaïcain Moyen ', 'Café Moyen d\'origine : Guatemala  Banane, des notes de baies et de chocolat avec des saveurs fruitée et acidulée.', 14.5, 65, '2024-05-02 02:46:19', '2024-05-02 02:46:19', 1, 2),
(70, 'Café Java Moyen ', 'Café Moyen d\'origine : Burkina Faso  Papaye, des notes de tabac et de caramel avec des saveurs florale et délicate.', 7, 19, '2024-05-02 02:46:19', '2024-05-02 02:46:19', 1, 2),
(71, 'Café Kenyan Moyen ', 'Café Moyen d\'origine : Burundi  sumatra, des notes de fleurs et de chocolat avec des saveurs vanille et crémeuse.', 8, 15, '2024-05-02 02:46:19', '2024-05-02 02:46:19', 1, 2),
(72, 'Café Latté Moyen ', 'Café Moyen d\'origine : Honduras  Lavande, des notes de pomme et de chocolat au lait avec des saveurs sucrée et fruitée.', 11.25, 14, '2024-05-02 02:46:19', '2024-05-02 02:46:19', 1, 2),
(73, 'Café Long Black Moyen ', 'Café Moyen de provenance : Rwanda  Pourpre, des notes de miel et de fruits secs avec des saveurs fruitée et délicate.', 12.25, 62, '2024-05-02 02:46:19', '2024-05-02 02:46:19', 1, 2),
(74, 'Café Macchiato Moyen ', 'Café Moyen d\'origine : Ouganda  jamaïcain, des notes de vanille et de caramel avec des saveurs fruitée et vive.', 12.5, 71, '2024-05-02 02:46:19', '2024-05-02 02:46:19', 1, 2),
(75, 'Café Mexicain Moyen ', 'Café Moyen d\'origine : Burundi  Caramélisé, des notes de piment et de caramel avec des saveurs chocolatée et équilibrée.', 2, 52, '2024-05-02 02:46:19', '2024-05-02 02:46:19', 1, 2),
(76, 'Café Moka Moyen ', 'Café Moyen de provenance : Inde  Filtre, des notes de tabac et de caramel avec des saveurs fumée et robuste.', 10, 91, '2024-05-02 02:46:19', '2024-05-02 02:46:19', 1, 2),
(77, 'Café Nicaraguayen Moyen ', 'Café Moyen d\'origine : Papouasie-Nouvelle-Guinée  Rouge, des notes de miel et de fruits secs avec des saveurs fruitée et délicate.', 6.25, 52, '2024-05-02 02:46:19', '2024-05-02 02:46:19', 1, 2),
(78, 'Café Ougandais Moyen ', 'Café Moyen d\'origine : Équateur  Bio, des notes de fruits tropicaux et de chocolat avec des saveurs sucrée et fruitée.', 5.25, 5, '2024-05-02 02:46:19', '2024-05-02 02:46:19', 1, 2),
(79, 'Café Panaméen Moyen ', 'Café Moyen d\'origine : Haïti  Costa, des notes de pruneaux et de cacao avec des saveurs fruitée et acidulée.', 4.25, 70, '2024-05-02 02:46:19', '2024-05-02 02:46:19', 1, 2),
(80, 'Café Péruvien Moyen ', 'Café Moyen de provenance : Guatemala  Noix de cajou, des notes de vanille et de caramel avec des saveurs exotique et envoûtante.', 7, 10, '2024-05-02 02:46:20', '2024-05-02 02:46:20', 1, 2),
(81, 'Café Portoricain Moyen ', 'Café Moyen de provenance : Guatemala  Épicé, des notes de pomme et de chocolat au lait avec des saveurs noisette et gourmande.', 10.25, 57, '2024-05-02 02:46:20', '2024-05-02 02:46:20', 1, 2),
(82, 'Café Ristretto Moyen ', 'Café Moyen de provenance : Venezuela  uruguayen, des notes de citron et de chocolat blanc avec des saveurs corsée et intense.', 10.5, 60, '2024-05-02 02:46:20', '2024-05-02 02:46:20', 1, 2),
(83, 'Café Salavadorien Moyen ', 'Café Moyen de provenance : Guatemala  Citron, des notes de baies et de chocolat avec des saveurs épicée et réconfortante.', 12.5, 68, '2024-05-02 02:46:20', '2024-05-02 02:46:20', 1, 2),
(84, 'Café Sumatra Moyen ', 'Café Moyen de provenance : Bolivie  éthiopien, des notes d\'agrumes et de caramel avec des saveurs vanillée et crémeuse.', 12.25, 32, '2024-05-02 02:46:20', '2024-05-02 02:46:20', 1, 2),
(85, 'Café Surinamien Moyen ', 'Café Moyen de provenance : Libéria  chilien, des notes de fruits tropicaux et de chocolat avec des saveurs florale et délicate.', 7, 95, '2024-05-02 02:46:20', '2024-05-02 02:46:20', 1, 2),
(86, 'Café Tanzanien Moyen ', 'Café Moyen d\'origine : Madagascar  Brun, des notes de fleurs et de chocolat avec des saveurs florale et délicate.', 2.25, 74, '2024-05-02 02:46:20', '2024-05-02 02:46:20', 1, 2),
(87, 'Café Trinidadien Moyen ', 'Café Moyen de provenance : Équateur  Vert, des notes de fleurs et de chocolat avec des saveurs acidulée et vive.', 10.25, 43, '2024-05-02 02:46:20', '2024-05-02 02:46:20', 1, 2),
(88, 'Café Turc Moyen ', 'Café Moyen d\'origine : Guyana  Crémeux, des notes de cerise et de chocolat au lait avec des saveurs fruitée et vive.', 8.5, 6, '2024-05-02 02:46:20', '2024-05-02 02:46:20', 1, 2),
(89, 'Café Vénézuélien Moyen ', 'Café Moyen d\'origine : Philippines  Fraise, des notes de pomme et de chocolat au lait avec des saveurs chocolatée et équilibrée.', 6.5, 10, '2024-05-02 02:46:20', '2024-05-02 02:46:20', 1, 2),
(90, 'Café Vietnamien Moyen ', 'Café Moyen d\'origine : Indonésie  Blond, des notes de cerise et de chocolat au lait avec des saveurs épicée et chaleureuse.', 12.5, 90, '2024-05-02 02:46:20', '2024-05-02 02:46:20', 1, 2),
(91, 'Café Yéménite Moyen ', 'Café Moyen de provenance : Panama  kopi luwak, des notes de caramel et de cacao avec des saveurs florale et délicate.', 12, 26, '2024-05-02 02:46:20', '2024-05-02 02:46:20', 1, 2),
(92, 'Café Zimbabwéen Moyen ', 'Café Moyen d\'origine : Inde  indien, des notes de cacao et de noix avec des saveurs noisette et gourmande.', 5.5, 17, '2024-05-02 02:46:20', '2024-05-02 02:46:20', 1, 2),
(93, 'Café Affogato Faible ', 'Café Faible de provenance : Indonésie  vietnamien, des notes d\'agrumes et de caramel avec des saveurs fruitée et vive.', 3, 20, '2024-05-02 02:46:20', '2024-05-02 02:46:20', 1, 3),
(94, 'Café Americano Faible ', 'Café Faible d\'origine : République centrafricaine  Pêche, des notes de amande et de chocolat au lait avec des saveurs corsée et intense.', 4.5, 3, '2024-05-02 02:46:20', '2024-05-02 02:46:20', 1, 3),
(95, 'Café Bélizien Faible ', 'Café Faible de provenance : Togo  colombien, des notes de fleurs et de chocolat avec des saveurs florale et aromatique.', 6.5, 11, '2024-05-02 02:46:20', '2024-05-02 02:46:20', 1, 3),
(96, 'Café Bio Faible ', 'Café Faible de provenance : Népal  vénézuélien, des notes d\'agrumes et de caramel avec des saveurs gourmande et sucrée.', 4.5, 61, '2024-05-02 02:46:20', '2024-05-02 02:46:20', 1, 3),
(97, 'Café Bolivien Faible ', 'Café Faible d\'origine : Mexique  Faible, des notes de baies et de chocolat avec des saveurs florale et aromatique.', 13, 26, '2024-05-02 02:46:21', '2024-05-02 02:46:21', 1, 3),
(98, 'Café Brésilien Faible ', 'Café Faible d\'origine : Vietnam  Équilibré, des notes de noisette et de chocolat noir avec des saveurs épicée et réconfortante.', 12.25, 76, '2024-05-02 02:46:21', '2024-05-02 02:46:21', 1, 3),
(99, 'Café Cappuccino Faible ', 'Café Faible d\'origine : Philippines  Ananas, des notes de caramel et de cacao avec des saveurs chocolatée et équilibrée.', 3, 99, '2024-05-02 02:46:21', '2024-05-02 02:46:21', 1, 3),
(100, 'Café Colombien Faible ', 'Café Faible de provenance : Sierra Leone  Crémeux, des notes de gingembre et de caramel avec des saveurs boisée et profonde.', 10.5, 59, '2024-05-02 02:46:21', '2024-05-02 02:46:21', 1, 3),
(101, 'Café Costaricien Faible ', 'Café Faible de provenance : Congo  Costa, des notes de fruits rouges et de chocolat noir avec des saveurs chocolatée et onctueuse.', 3.5, 36, '2024-05-02 02:46:21', '2024-05-02 02:46:21', 1, 3),
(102, 'Café Cubain Faible ', 'Café Faible d\'origine : Sierra Leone  Noix de cajou, des notes de caramel et de cacao avec des saveurs épicée et réconfortante.', 14.25, 79, '2024-05-02 02:46:21', '2024-05-02 02:46:21', 1, 3),
(103, 'Café Dominicain Faible ', 'Café Faible de provenance : Cameroun  galléga, des notes de cacao et de noix avec des saveurs florale et aromatique.', 9.5, 42, '2024-05-02 02:46:21', '2024-05-02 02:46:21', 1, 3),
(104, 'Café Équatorien Faible ', 'Café Faible d\'origine : Libéria  Équitable, des notes de pruneaux et de cacao avec des saveurs équilibrée et harmonieuse.', 6, 2, '2024-05-02 02:46:21', '2024-05-02 02:46:21', 1, 3),
(105, 'Café Éthiopien Faible ', 'Café Faible d\'origine : Guatemala  Boisé, des notes de tabac et de caramel avec des saveurs noisette et boisée.', 14.25, 33, '2024-05-02 02:46:21', '2024-05-02 02:46:21', 1, 3),
(106, 'Café Expresso Faible ', 'Café Faible de provenance : Sierra Leone  Équilibré, des notes de poivre et de chocolat noir avec des saveurs boisée et profonde.', 3.5, 31, '2024-05-02 02:46:21', '2024-05-02 02:46:21', 1, 3),
(107, 'Café Flat White Faible ', 'Café Faible de provenance : Mexique  Raisin, des notes de fruits tropicaux et de chocolat avec des saveurs acidulée et vive.', 9, 2, '2024-05-02 02:46:21', '2024-05-02 02:46:21', 1, 3),
(108, 'Café Grec Faible ', 'Café Faible de provenance : Éthiopie  Vanillé, des notes de poivre et de chocolat noir avec des saveurs fumée et robuste.', 13.25, 4, '2024-05-02 02:46:21', '2024-05-02 02:46:21', 1, 3),
(109, 'Café Guatémaltèque Faible ', 'Café Faible d\'origine : Venezuela  Noisettes, des notes de caramel et d\'épices avec des saveurs acidulée et vive.', 9.25, 86, '2024-05-02 02:46:21', '2024-05-02 02:46:21', 1, 3),
(110, 'Café Guyanien Faible ', 'Café Faible de provenance : Honduras  Noix de coco, des notes de poivre et de chocolat noir avec des saveurs caramélisée et sucrée.', 8.25, 54, '2024-05-02 02:46:21', '2024-05-02 02:46:21', 1, 3),
(111, 'Café Haïtien Faible ', 'Café Faible de provenance : Indonésie  Citron, des notes de citron et de chocolat blanc avec des saveurs exotique et envoûtante.', 14.5, 80, '2024-05-02 02:46:21', '2024-05-02 02:46:21', 1, 3),
(112, 'Café Hawaïen Faible ', 'Café Faible d\'origine : Brésil  Chocolaté, des notes de vanille et de caramel avec des saveurs florale et délicate.', 13.25, 80, '2024-05-02 02:46:21', '2024-05-02 02:46:21', 1, 3),
(113, 'Café Hondurien Faible ', 'Café Faible d\'origine : Vietnam  uruguayen, des notes de tabac et de caramel avec des saveurs noisette et gourmande.', 3.5, 37, '2024-05-02 02:46:21', '2024-05-02 02:46:21', 1, 3),
(114, 'Café Irlandais Faible ', 'Café Faible d\'origine : Guatemala  Faible, des notes de tabac et de caramel avec des saveurs noisette et boisée.', 11.5, 47, '2024-05-02 02:46:21', '2024-05-02 02:46:21', 1, 3),
(115, 'Café Jamaïcain Faible ', 'Café Faible d\'origine : Bolivie  Crémeux, des notes de cerise et de chocolat au lait avec des saveurs chocolatée et onctueuse.', 10.25, 63, '2024-05-02 02:46:21', '2024-05-02 02:46:21', 1, 3),
(116, 'Café Java Faible ', 'Café Faible de provenance : Équateur  mocha, des notes de miel et de fruits secs avec des saveurs caramel et sucrée.', 11.25, 94, '2024-05-02 02:46:22', '2024-05-02 02:46:22', 1, 3),
(117, 'Café Kenyan Faible ', 'Café Faible de provenance : Guatemala  Myrtille, des notes de cacao et de noix avec des saveurs acidulée et vive.', 12.25, 23, '2024-05-02 02:46:22', '2024-05-02 02:46:22', 1, 3),
(118, 'Café Latté Faible ', 'Café Faible de provenance : Congo  Noix, des notes de baies et de chocolat avec des saveurs gourmande et sucrée.', 13.5, 88, '2024-05-02 02:46:22', '2024-05-02 02:46:22', 1, 3),
(119, 'Café Long Black Faible ', 'Café Faible d\'origine : Papouasie-Nouvelle-Guinée  arabica, des notes de menthe et de chocolat avec des saveurs chocolatée et équilibrée.', 7, 5, '2024-05-02 02:46:22', '2024-05-02 02:46:22', 1, 3),
(120, 'Café Macchiato Faible ', 'Café Faible de provenance : El Salvador  Herbacé, des notes de pomme et de chocolat au lait avec des saveurs fruitée et vive.', 7.25, 4, '2024-05-02 02:46:22', '2024-05-02 02:46:22', 1, 3),
(121, 'Café Mexicain Faible ', 'Café Faible d\'origine : Burkina Faso  Prune, des notes de whisky et fumé avec des saveurs exotique et envoûtante.', 8.25, 65, '2024-05-02 02:46:22', '2024-05-02 02:46:22', 1, 3),
(122, 'Café Moka Faible ', 'Café Faible d\'origine : Timor oriental  Caramélisé, des notes de caramel et d\'épices avec des saveurs caramel et sucrée.', 6.5, 54, '2024-05-02 02:46:22', '2024-05-02 02:46:22', 1, 3),
(123, 'Café Nicaraguayen Faible ', 'Café Faible de provenance : Bolivie  kopi luwak, des notes d\'agrumes et de caramel avec des saveurs crémeuse et veloutée.', 8, 61, '2024-05-02 02:46:22', '2024-05-02 02:46:22', 1, 3),
(124, 'Café Ougandais Faible ', 'Café Faible de provenance : Ghana  Pistache, des notes de menthe et de chocolat avec des saveurs caramélisée et sucrée.', 8.5, 61, '2024-05-02 02:46:22', '2024-05-02 02:46:22', 1, 3),
(125, 'Café Panaméen Faible ', 'Café Faible de provenance : Madagascar  Sélectionné, des notes de vanille et de caramel avec des saveurs fumée et robuste.', 14, 68, '2024-05-02 02:46:22', '2024-05-02 02:46:22', 1, 3),
(126, 'Café Péruvien Faible ', 'Café Faible de provenance : Équateur  turc, des notes d\'agrumes et de caramel avec des saveurs cacao et intense.', 14, 100, '2024-05-02 02:46:22', '2024-05-02 02:46:22', 1, 3),
(127, 'Café Portoricain Faible ', 'Café Faible de provenance : Rwanda  jamaïcain, des notes de fruits tropicaux et de chocolat avec des saveurs chocolatée et équilibrée.', 11, 37, '2024-05-02 02:46:22', '2024-05-02 02:46:22', 1, 3),
(128, 'Café Ristretto Faible ', 'Café Faible de provenance : Népal  sumatra, des notes de cannelle et de caramel avec des saveurs boisée et intense.', 12.5, 55, '2024-05-02 02:46:22', '2024-05-02 02:46:22', 1, 3),
(129, 'Café Salavadorien Faible ', 'Café Faible d\'origine : Trinité-et-Tobago  Mûre, des notes de piment et de caramel avec des saveurs noisette et gourmande.', 6.5, 72, '2024-05-02 02:46:22', '2024-05-02 02:46:22', 1, 3),
(130, 'Café Sumatra Faible ', 'Café Faible d\'origine : Nicaragua  Boisé, des notes de tabac et de caramel avec des saveurs fruitée et acidulée.', 3.25, 42, '2024-05-02 02:46:22', '2024-05-02 02:46:22', 1, 3),
(131, 'Café Surinamien Faible ', 'Café Faible d\'origine : Sierra Leone  Clou de girofle, des notes de caramel et de cacao avec des saveurs chocolatée et onctueuse.', 6.25, 85, '2024-05-02 02:46:22', '2024-05-02 02:46:22', 1, 3),
(132, 'Café Tanzanien Faible ', 'Café Faible d\'origine : Vietnam  Terreux, des notes de fruits tropicaux et de chocolat avec des saveurs chocolatée et équilibrée.', 8.25, 94, '2024-05-02 02:46:22', '2024-05-02 02:46:22', 1, 3),
(133, 'Café Trinidadien Faible ', 'Café Faible de provenance : Tanzanie  Raisin, des notes de miel et de fruits secs avec des saveurs biscuitée et réconfortante.', 8.5, 3, '2024-05-02 02:46:22', '2024-05-02 02:46:22', 1, 3),
(134, 'Café Turc Faible ', 'Café Faible de provenance : République Dominicaine  Fruité, des notes de caramel et de cacao avec des saveurs gourmande et sucrée.', 10, 87, '2024-05-02 02:46:22', '2024-05-02 02:46:22', 1, 3),
(135, 'Café Vénézuélien Faible ', 'Café Faible de provenance : Congo  arabica, des notes de pruneaux et de cacao avec des saveurs épicée et chaleureuse.', 10.25, 35, '2024-05-02 02:46:23', '2024-05-02 02:46:23', 1, 3),
(136, 'Café Vietnamien Faible ', 'Café Faible d\'origine : Ouganda  Noir, des notes de citron et de chocolat blanc avec des saveurs vanille et crémeuse.', 3, 65, '2024-05-02 02:46:23', '2024-05-02 02:46:23', 1, 3),
(137, 'Café Yéménite Faible ', 'Café Faible d\'origine : Zimbabwe  Noix de coco, des notes de cerise et de chocolat au lait avec des saveurs vanille et crémeuse.', 9.25, 77, '2024-05-02 02:46:23', '2024-05-02 02:46:23', 1, 3),
(138, 'Café Zimbabwéen Faible ', 'Café Faible de provenance : Zimbabwe  Chocolaté, des notes d\'agrumes et de caramel avec des saveurs florale et aromatique.', 6, 20, '2024-05-02 02:46:23', '2024-05-02 02:46:23', 1, 3),
(139, 'Thé Vert Noir ', 'Thé Noir d\'origine : Honduras  Ceylan, des notes d\'herbes fraîches et de citron avec des saveurs bergamote et rafraîchissante.', 2.5, 91, '2024-05-02 02:46:47', '2024-05-02 02:46:47', 2, 4),
(140, 'Thé Noir Noir ', 'Thé Noir de provenance : Équateur  Yerba Mate, des notes de fleurs et de miel avec des saveurs agrumes et zestée.', 12, 37, '2024-05-02 02:46:47', '2024-05-02 02:46:47', 2, 4),
(141, 'Thé Blanc Noir ', 'Thé Noir d\'origine : République du Congo  Gunpowder, des notes de bois et d\'épices avec des saveurs herbacée et aromatique.', 5.25, 19, '2024-05-02 02:46:47', '2024-05-02 02:46:47', 2, 4),
(142, 'Thé Oolong Noir ', 'Thé Noir de provenance : Mozambique  Long Jing, des notes de cerise et de chocolat noir avec des saveurs herbacée et aromatique.', 13, 66, '2024-05-02 02:46:47', '2024-05-02 02:46:47', 2, 4),
(143, 'Thé Jaune Noir ', 'Thé Noir de provenance : Madagascar  Bai Hao Yin Zhen, des notes de baies et de vanille avec des saveurs framboise et acidulée.', 4, 65, '2024-05-02 02:46:47', '2024-05-02 02:46:47', 2, 4),
(144, 'Thé Pu-erh Noir ', 'Thé Noir de provenance : Mexique  Bai Hao Yin Zhen, des notes de baies et de vanille avec des saveurs amande et réconfortante.', 10, 75, '2024-05-02 02:46:47', '2024-05-02 02:46:47', 2, 4),
(145, 'Thé Matcha Noir ', 'Thé Noir d\'origine : Hawaï  Kenyan, des notes de fruits et d\'agrumes avec des saveurs miellée et douce.', 6, 25, '2024-05-02 02:46:47', '2024-05-02 02:46:47', 2, 4),
(146, 'Thé Sencha Noir ', 'Thé Noir d\'origine : République Dominicaine  Gyokuro, des notes de malt et de miel avec des saveurs réglisse et sucrée.', 2.25, 55, '2024-05-02 02:46:47', '2024-05-02 02:46:47', 2, 4),
(147, 'Thé Genmaicha Noir ', 'Thé Noir d\'origine : Honduras  Kukicha, des notes de menthe et de réglisse avec des saveurs réglisse et sucrée.', 10, 4, '2024-05-02 02:46:47', '2024-05-02 02:46:47', 2, 4),
(148, 'Thé Gunpowder Noir ', 'Thé Noir de provenance : Ouganda  Honeybush, des notes de fleurs et de miel avec des saveurs épicée et réconfortante.', 10, 4, '2024-05-02 02:46:47', '2024-05-02 02:46:47', 2, 4),
(149, 'Thé Darjeeling Noir ', 'Thé Noir d\'origine : Thaïlande  Gunpowder, des notes de grenade et de bergamote avec des saveurs poivrée et piquante.', 11.25, 3, '2024-05-02 02:46:47', '2024-05-02 02:46:47', 2, 4),
(150, 'Thé Assam Noir ', 'Thé Noir d\'origine : Équateur  Genmaicha, des notes de fleurs et de miel avec des saveurs fleur d\'oranger et envoûtante.', 5.5, 99, '2024-05-02 02:46:47', '2024-05-02 02:46:47', 2, 4),
(151, 'Thé Earl Grey Noir ', 'Thé Noir de provenance : Île Maurice  Keemun, des notes de grenade et de bergamote avec des saveurs amande et réconfortante.', 6.5, 40, '2024-05-02 02:46:47', '2024-05-02 02:46:47', 2, 4),
(152, 'Thé English Breakfast Noir ', 'Thé Noir de provenance : Vietnam  Bi Luo Chun, des notes de pamplemousse et de rose avec des saveurs fruit de la passion et exotique.', 4, 43, '2024-05-02 02:46:47', '2024-05-02 02:46:47', 2, 4),
(153, 'Thé Irish Breakfast Noir ', 'Thé Noir de provenance : Malaisie  Da Hong Pao, des notes d\'herbes fraîches et de citron avec des saveurs vanillée et crémeuse.', 10.5, 8, '2024-05-02 02:46:47', '2024-05-02 02:46:47', 2, 4),
(154, 'Thé Ceylan Noir ', 'Thé Noir de provenance : Inde  Oolong, des notes d\'herbes fraîches et de citron avec des saveurs fleur d\'oranger et envoûtante.', 7.25, 3, '2024-05-02 02:46:48', '2024-05-02 02:46:48', 2, 4),
(155, 'Thé Kenyan Noir ', 'Thé Noir de provenance : Soudan  Bai Hao Yin Zhen, des notes de pomme verte et de cannelle avec des saveurs maltée et corsée.', 5.25, 89, '2024-05-02 02:46:48', '2024-05-02 02:46:48', 2, 4),
(156, 'Thé Lapsang Souchong Noir ', 'Thé Noir d\'origine : Hawaï  Long Jing, des notes de bois et d\'épices avec des saveurs miellée et douce.', 11.25, 10, '2024-05-02 02:46:48', '2024-05-02 02:46:48', 2, 4),
(157, 'Thé Keemun Noir ', 'Thé Noir d\'origine : Ghana  Gyokuro, des notes de bois et d\'épices avec des saveurs bergamote et rafraîchissante.', 4, 96, '2024-05-02 02:46:48', '2024-05-02 02:46:48', 2, 4),
(158, 'Thé Yunnan Noir ', 'Thé Noir de provenance : Guatemala  Darjeeling, des notes de fruits et d\'agrumes avec des saveurs framboise et acidulée.', 12.25, 58, '2024-05-02 02:46:48', '2024-05-02 02:46:48', 2, 4),
(159, 'Thé Nilgiri Noir ', 'Thé Noir de provenance : Turquie  Shou Mei, des notes de bois et d\'épices avec des saveurs robuste et légèrement épicée.', 4.25, 29, '2024-05-02 02:46:48', '2024-05-02 02:46:48', 2, 4),
(160, 'Thé Anxi Tieguanyin Noir ', 'Thé Noir de provenance : Birmanie  Ceylan, des notes d\'abricot et de cardamome avec des saveurs fruit de la passion et exotique.', 9.25, 65, '2024-05-02 02:46:48', '2024-05-02 02:46:48', 2, 4),
(161, 'Thé Wuyi Rock Noir ', 'Thé Noir de provenance : Ghana  Bancha, des notes de grenade et de bergamote avec des saveurs fruitée et rafraîchissante.', 7.5, 89, '2024-05-02 02:46:48', '2024-05-02 02:46:48', 2, 4),
(162, 'Thé Bai Hao Yin Zhen Noir ', 'Thé Noir de provenance : Honduras  Da Hong Pao, des notes d\'abricot et de cardamome avec des saveurs bergamote et rafraîchissante.', 8, 31, '2024-05-02 02:46:48', '2024-05-02 02:46:48', 2, 4),
(163, 'Thé Bai Mu Dan Noir ', 'Thé Noir de provenance : Cameroun  Honeybush, des notes de mangue et de jasmin avec des saveurs cardamome et épicée.', 4.5, 15, '2024-05-02 02:46:48', '2024-05-02 02:46:48', 2, 4),
(164, 'Thé Shou Mei Noir ', 'Thé Noir d\'origine : Inde  Shou Mei, des notes de malt et de miel avec des saveurs framboise et acidulée.', 14, 91, '2024-05-02 02:46:48', '2024-05-02 02:46:48', 2, 4),
(165, 'Thé Long Jing Noir ', 'Thé Noir d\'origine : Nigeria  Da Hong Pao, des notes de pêche et de fleurs blanches avec des saveurs poivrée et piquante.', 8, 47, '2024-05-02 02:46:48', '2024-05-02 02:46:48', 2, 4),
(166, 'Thé Bi Luo Chun Noir ', 'Thé Noir d\'origine : Malaisie  Assam, des notes de végétaux et de beurre avec des saveurs biscuitée et réconfortante.', 5, 76, '2024-05-02 02:46:48', '2024-05-02 02:46:48', 2, 4),
(167, 'Thé Da Hong Pao Noir ', 'Thé Noir de provenance : Malawi  Earl Grey, des notes de fleurs et de miel avec des saveurs gingembre et énergisante.', 7.5, 35, '2024-05-02 02:46:48', '2024-05-02 02:46:48', 2, 4),
(168, 'Thé Jin Jun Mei Noir ', 'Thé Noir de provenance : Népal  Ceylan, des notes de bois et d\'épices avec des saveurs jasmin et apaisante.', 6.25, 62, '2024-05-02 02:46:48', '2024-05-02 02:46:48', 2, 4),
(169, 'Thé Gyokuro Noir ', 'Thé Noir d\'origine : Philippines  Yunnan, des notes de végétaux et de beurre avec des saveurs vanillée et crémeuse.', 3.25, 8, '2024-05-02 02:46:48', '2024-05-02 02:46:48', 2, 4),
(170, 'Thé Hojicha Noir ', 'Thé Noir d\'origine : Chine  Da Hong Pao, des notes d\'abricot et de cardamome avec des saveurs chocolatée et veloutée.', 7.5, 29, '2024-05-02 02:46:48', '2024-05-02 02:46:48', 2, 4),
(171, 'Thé Kukicha Noir ', 'Thé Noir d\'origine : Laos  English Breakfast, des notes de pêche et de fleurs blanches avec des saveurs robuste et légèrement épicée.', 6.25, 76, '2024-05-02 02:46:48', '2024-05-02 02:46:48', 2, 4),
(172, 'Thé Bancha Noir ', 'Thé Noir de provenance : République du Congo  Yerba Mate, des notes de bois et d\'épices avec des saveurs chocolatée et veloutée.', 14, 14, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 4),
(173, 'Thé Rooibos Noir ', 'Thé Noir de provenance : Indonésie  Da Hong Pao, des notes d\'abricot et de cardamome avec des saveurs citronnée et vive.', 5.25, 17, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 4),
(174, 'Thé Yerba Mate Noir ', 'Thé Noir d\'origine : Paraguay  Bai Mu Dan, des notes de bois et d\'épices avec des saveurs maltée et corsée.', 5, 51, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 4),
(175, 'Thé Honeybush Noir ', 'Thé Noir d\'origine : Papouasie-Nouvelle-Guinée  English Breakfast, des notes de pomme verte et de cannelle avec des saveurs pêche et sucrée.', 14.5, 49, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 4),
(176, 'Thé Vert Vert ', 'Thé Vert d\'origine : Honduras  Kenyan, des notes de cerise et de chocolat noir avec des saveurs fruitée et rafraîchissante.', 4, 78, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 5),
(177, 'Thé Noir Vert ', 'Thé Vert d\'origine : Île Maurice  Bai Hao Yin Zhen, des notes de terre et de foin avec des saveurs mentholée et rafraîchissante.', 9.5, 45, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 5),
(178, 'Thé Blanc Vert ', 'Thé Vert d\'origine : Turquie  Earl Grey, des notes de grenade et de bergamote avec des saveurs jasmin et apaisante.', 14.5, 100, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 5),
(179, 'Thé Oolong Vert ', 'Thé Vert de provenance : Chine  Jin Jun Mei, des notes de noix et de cacao avec des saveurs équilibrée et harmonieuse.', 13, 4, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 5),
(180, 'Thé Jaune Vert ', 'Thé Vert de provenance : Vietnam  Bai Mu Dan, des notes de fleurs et de miel avec des saveurs amande et réconfortante.', 3.25, 56, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 5),
(181, 'Thé Pu-erh Vert ', 'Thé Vert d\'origine : Yémen  Jin Jun Mei, des notes de pêche et de fleurs blanches avec des saveurs biscuitée et réconfortante.', 10, 76, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 5),
(182, 'Thé Matcha Vert ', 'Thé Vert de provenance : Inde  Jin Jun Mei, des notes de citronnelle et de gingembre avec des saveurs herbacée et aromatique.', 14.5, 53, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 5),
(183, 'Thé Sencha Vert ', 'Thé Vert de provenance : Birmanie  Yerba Mate, des notes de noix et de cacao avec des saveurs agrumes et zestée.', 5, 12, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 5),
(184, 'Thé Genmaicha Vert ', 'Thé Vert d\'origine : Mozambique  Ceylan, des notes de citronnelle et de gingembre avec des saveurs fleur d\'oranger et envoûtante.', 13, 78, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 5),
(185, 'Thé Gunpowder Vert ', 'Thé Vert de provenance : Paraguay  Irish Breakfast, des notes de végétaux et de beurre avec des saveurs amande et réconfortante.', 10, 97, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 5),
(186, 'Thé Darjeeling Vert ', 'Thé Vert de provenance : Philippines  Wuyi Rock, des notes de végétaux et de beurre avec des saveurs fruit de la passion et exotique.', 8.5, 94, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 5),
(187, 'Thé Assam Vert ', 'Thé Vert d\'origine : Bolivie  Genmaicha, des notes de végétaux et de beurre avec des saveurs florale et délicate.', 13.5, 7, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 5),
(188, 'Thé Earl Grey Vert ', 'Thé Vert d\'origine : Bolivie  Oolong, des notes de pêche et de fleurs blanches avec des saveurs vanillée et crémeuse.', 10, 19, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 5),
(189, 'Thé English Breakfast Vert ', 'Thé Vert de provenance : Inde  Wuyi Rock, des notes de mangue et de jasmin avec des saveurs herbacée et aromatique.', 12.5, 78, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 5),
(190, 'Thé Irish Breakfast Vert ', 'Thé Vert d\'origine : Tanzanie  Jin Jun Mei, des notes de baies et de vanille avec des saveurs bergamote et rafraîchissante.', 14.5, 2, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 5),
(191, 'Thé Ceylan Vert ', 'Thé Vert d\'origine : Honduras  Assam, des notes de végétaux et de beurre avec des saveurs miellée et douce.', 9, 35, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 5),
(192, 'Thé Kenyan Vert ', 'Thé Vert de provenance : Brésil  Assam, des notes de malt et de miel avec des saveurs anisée et épicée.', 11, 62, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 5),
(193, 'Thé Lapsang Souchong Vert ', 'Thé Vert d\'origine : Bolivie  Long Jing, des notes de pamplemousse et de rose avec des saveurs herbacée et aromatique.', 7.5, 88, '2024-05-02 02:46:49', '2024-05-02 02:46:49', 2, 5),
(194, 'Thé Keemun Vert ', 'Thé Vert d\'origine : Malawi  Long Jing, des notes de baies et de vanille avec des saveurs anisée et épicée.', 2.25, 26, '2024-05-02 02:46:50', '2024-05-02 02:46:50', 2, 5),
(195, 'Thé Yunnan Vert ', 'Thé Vert d\'origine : Soudan  Honeybush, des notes de terre et de foin avec des saveurs caramel et sucrée.', 9.25, 32, '2024-05-02 02:46:50', '2024-05-02 02:46:50', 2, 5),
(196, 'Thé Nilgiri Vert ', 'Thé Vert de provenance : Madagascar  Bai Mu Dan, des notes d\'herbes fraîches et de citron avec des saveurs miellée et douce.', 8.25, 74, '2024-05-02 02:46:50', '2024-05-02 02:46:50', 2, 5),
(197, 'Thé Anxi Tieguanyin Vert ', 'Thé Vert de provenance : Madagascar  Bi Luo Chun, des notes de menthe et de réglisse avec des saveurs miellée et douce.', 12.25, 34, '2024-05-02 02:46:50', '2024-05-02 02:46:50', 2, 5),
(198, 'Thé Wuyi Rock Vert ', 'Thé Vert d\'origine : Laos  Matcha, des notes de noix et de cacao avec des saveurs herbacée et aromatique.', 2.25, 98, '2024-05-02 02:46:50', '2024-05-02 02:46:50', 2, 5),
(199, 'Thé Bai Hao Yin Zhen Vert ', 'Thé Vert de provenance : Vietnam  Assam, des notes de grenade et de bergamote avec des saveurs réglisse et sucrée.', 5, 41, '2024-05-02 02:46:50', '2024-05-02 02:46:50', 2, 5),
(200, 'Thé Bai Mu Dan Vert ', 'Thé Vert d\'origine : Géorgie  Lapsang Souchong, des notes de bois et d\'épices avec des saveurs équilibrée et harmonieuse.', 9.25, 19, '2024-05-02 02:46:50', '2024-05-02 02:46:50', 2, 5),
(201, 'Thé Shou Mei Vert ', 'Thé Vert de provenance : Côte d\'Ivoire  Genmaicha, des notes de cerise et de chocolat noir avec des saveurs cardamome et épicée.', 2.25, 5, '2024-05-02 02:46:50', '2024-05-02 02:46:50', 2, 5),
(202, 'Thé Long Jing Vert ', 'Thé Vert de provenance : Honduras  Jin Jun Mei, des notes de vanille et de caramel avec des saveurs herbacée et aromatique.', 12, 21, '2024-05-02 02:46:50', '2024-05-02 02:46:50', 2, 5),
(203, 'Thé Bi Luo Chun Vert ', 'Thé Vert d\'origine : Honduras  Kenyan, des notes de malt et de miel avec des saveurs caramel et sucrée.', 7.5, 84, '2024-05-02 02:46:50', '2024-05-02 02:46:50', 2, 5),
(204, 'Thé Da Hong Pao Vert ', 'Thé Vert de provenance : Japon  Oolong, des notes de fleurs et de miel avec des saveurs florale et délicate.', 3.5, 76, '2024-05-02 02:46:50', '2024-05-02 02:46:50', 2, 5),
(205, 'Thé Jin Jun Mei Vert ', 'Thé Vert de provenance : Bolivie  Nilgiri, des notes de menthe et de réglisse avec des saveurs bergamote et rafraîchissante.', 12.5, 34, '2024-05-02 02:46:50', '2024-05-02 02:46:50', 2, 5),
(206, 'Thé Gyokuro Vert ', 'Thé Vert d\'origine : Thaïlande  Bi Luo Chun, des notes de vanille et de caramel avec des saveurs pêche et sucrée.', 14.25, 85, '2024-05-02 02:46:50', '2024-05-02 02:46:50', 2, 5),
(207, 'Thé Hojicha Vert ', 'Thé Vert de provenance : Cameroun  Rooibos, des notes de pamplemousse et de rose avec des saveurs framboise et acidulée.', 6, 18, '2024-05-02 02:46:50', '2024-05-02 02:46:50', 2, 5),
(208, 'Thé Kukicha Vert ', 'Thé Vert de provenance : Kenya  Long Jing, des notes de vanille et de caramel avec des saveurs rose et romantique.', 8.5, 10, '2024-05-02 02:46:50', '2024-05-02 02:46:50', 2, 5),
(209, 'Thé Bancha Vert ', 'Thé Vert de provenance : Thaïlande  Honeybush, des notes de bois et d\'épices avec des saveurs herbacée et aromatique.', 9.25, 23, '2024-05-02 02:46:50', '2024-05-02 02:46:50', 2, 5),
(210, 'Thé Rooibos Vert ', 'Thé Vert de provenance : Guatemala  Earl Grey, des notes de mangue et de jasmin avec des saveurs réglisse et sucrée.', 2, 82, '2024-05-02 02:46:50', '2024-05-02 02:46:50', 2, 5),
(211, 'Thé Yerba Mate Vert ', 'Thé Vert de provenance : Bangladesh  Genmaicha, des notes de pomme verte et de cannelle avec des saveurs vanillée et crémeuse.', 5.25, 51, '2024-05-02 02:46:50', '2024-05-02 02:46:50', 2, 5),
(212, 'Thé Honeybush Vert ', 'Thé Vert de provenance : République du Congo  Oolong, des notes de baies et de vanille avec des saveurs mentholée et rafraîchissante.', 9.5, 10, '2024-05-02 02:46:51', '2024-05-02 02:46:51', 2, 5),
(213, 'Thé Vert Blanc ', 'Thé Blanc de provenance : Ouganda  Sencha, des notes de cerise et de chocolat noir avec des saveurs citronnée et vive.', 6, 89, '2024-05-02 02:46:51', '2024-05-02 02:46:51', 2, 6),
(214, 'Thé Noir Blanc ', 'Thé Blanc de provenance : Ouganda  Irish Breakfast, des notes de végétaux et de beurre avec des saveurs florale et délicate.', 2.5, 91, '2024-05-02 02:46:51', '2024-05-02 02:46:51', 2, 6),
(215, 'Thé Blanc Blanc ', 'Thé Blanc d\'origine : Géorgie  Kukicha, des notes d\'herbes fraîches et de citron avec des saveurs jasmin et apaisante.', 8, 48, '2024-05-02 02:46:51', '2024-05-02 02:46:51', 2, 6),
(216, 'Thé Oolong Blanc ', 'Thé Blanc de provenance : Pérou  Bancha, des notes de malt et de miel avec des saveurs gingembre et énergisante.', 13, 55, '2024-05-02 02:46:51', '2024-05-02 02:46:51', 2, 6),
(217, 'Thé Jaune Blanc ', 'Thé Blanc de provenance : Birmanie  Sencha, des notes de grenade et de bergamote avec des saveurs bergamote et rafraîchissante.', 6, 4, '2024-05-02 02:46:51', '2024-05-02 02:46:51', 2, 6),
(218, 'Thé Pu-erh Blanc ', 'Thé Blanc de provenance : Malaisie  Pu-erh, des notes de cerise et de chocolat noir avec des saveurs vanillée et crémeuse.', 14, 24, '2024-05-02 02:46:51', '2024-05-02 02:46:51', 2, 6),
(219, 'Thé Matcha Blanc ', 'Thé Blanc d\'origine : Inde  English Breakfast, des notes de menthe et de réglisse avec des saveurs anisée et épicée.', 10.5, 28, '2024-05-02 02:46:51', '2024-05-02 02:46:51', 2, 6),
(220, 'Thé Sencha Blanc ', 'Thé Blanc de provenance : Taïwan  Matcha, des notes de fleurs et de miel avec des saveurs fleur d\'oranger et envoûtante.', 2.5, 48, '2024-05-02 02:46:51', '2024-05-02 02:46:51', 2, 6),
(221, 'Thé Genmaicha Blanc ', 'Thé Blanc d\'origine : Népal  Bai Mu Dan, des notes de malt et de miel avec des saveurs jasmin et apaisante.', 3, 56, '2024-05-02 02:46:51', '2024-05-02 02:46:51', 2, 6),
(222, 'Thé Gunpowder Blanc ', 'Thé Blanc de provenance : Paraguay  Bi Luo Chun, des notes de pêche et de fleurs blanches avec des saveurs anisée et épicée.', 10.25, 36, '2024-05-02 02:46:51', '2024-05-02 02:46:51', 2, 6),
(223, 'Thé Darjeeling Blanc ', 'Thé Blanc d\'origine : Honduras  Bancha, des notes de pomme verte et de cannelle avec des saveurs jasmin et apaisante.', 13.25, 97, '2024-05-02 02:46:51', '2024-05-02 02:46:51', 2, 6),
(224, 'Thé Assam Blanc ', 'Thé Blanc de provenance : République Dominicaine  Kukicha, des notes de citronnelle et de gingembre avec des saveurs réglisse et sucrée.', 6, 97, '2024-05-02 02:46:51', '2024-05-02 02:46:51', 2, 6),
(225, 'Thé Earl Grey Blanc ', 'Thé Blanc d\'origine : Ghana  Lapsang Souchong, des notes de raisin et de cannelle avec des saveurs fruitée et rafraîchissante.', 3.25, 6, '2024-05-02 02:46:51', '2024-05-02 02:46:51', 2, 6),
(226, 'Thé English Breakfast Blanc ', 'Thé Blanc d\'origine : Brésil  Oolong, des notes de pêche et de fleurs blanches avec des saveurs boisée et terreux.', 14.5, 45, '2024-05-02 02:46:51', '2024-05-02 02:46:51', 2, 6),
(227, 'Thé Irish Breakfast Blanc ', 'Thé Blanc de provenance : Rwanda  Nilgiri, des notes de bois et d\'épices avec des saveurs citronnée et vive.', 9.5, 12, '2024-05-02 02:46:51', '2024-05-02 02:46:51', 2, 6),
(228, 'Thé Ceylan Blanc ', 'Thé Blanc de provenance : Soudan  Gunpowder, des notes de pêche et de fleurs blanches avec des saveurs rose et romantique.', 4.25, 87, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6),
(229, 'Thé Kenyan Blanc ', 'Thé Blanc d\'origine : Mexique  Honeybush, des notes de grenade et de bergamote avec des saveurs florale et délicate.', 6.25, 50, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6),
(230, 'Thé Lapsang Souchong Blanc ', 'Thé Blanc d\'origine : Népal  Bai Mu Dan, des notes de grenade et de bergamote avec des saveurs citronnée et vive.', 9, 80, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6),
(231, 'Thé Keemun Blanc ', 'Thé Blanc de provenance : Indonésie  Rooibos, des notes d\'herbes fraîches et de citron avec des saveurs robuste et légèrement épicée.', 9.5, 28, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6),
(232, 'Thé Yunnan Blanc ', 'Thé Blanc de provenance : Chine  Darjeeling, des notes de grenade et de bergamote avec des saveurs framboise et acidulée.', 9.25, 44, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6),
(233, 'Thé Nilgiri Blanc ', 'Thé Blanc de provenance : Yémen  Bai Mu Dan, des notes de cerise et de chocolat noir avec des saveurs fruitée et rafraîchissante.', 6.5, 92, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6);
INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity`, `created_at`, `updated_at`, `category_id`, `sub_category_id`) VALUES
(234, 'Thé Anxi Tieguanyin Blanc ', 'Thé Blanc de provenance : Éthiopie  Honeybush, des notes de fleurs et de miel avec des saveurs anisée et épicée.', 8.5, 61, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6),
(235, 'Thé Wuyi Rock Blanc ', 'Thé Blanc d\'origine : Île Maurice  Irish Breakfast, des notes de terre et de foin avec des saveurs jasmin et apaisante.', 3, 20, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6),
(236, 'Thé Bai Hao Yin Zhen Blanc ', 'Thé Blanc d\'origine : Éthiopie  Long Jing, des notes de pomme verte et de cannelle avec des saveurs herbacée et aromatique.', 14.25, 43, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6),
(237, 'Thé Bai Mu Dan Blanc ', 'Thé Blanc d\'origine : Cameroun  Bai Hao Yin Zhen, des notes de cerise et de chocolat noir avec des saveurs herbacée et aromatique.', 13.25, 21, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6),
(238, 'Thé Shou Mei Blanc ', 'Thé Blanc d\'origine : Tanzanie  Shou Mei, des notes de citronnelle et de gingembre avec des saveurs boisée et terreux.', 4.25, 8, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6),
(239, 'Thé Long Jing Blanc ', 'Thé Blanc d\'origine : Brésil  Pu-erh, des notes de végétaux et de beurre avec des saveurs amande et réconfortante.', 9.25, 11, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6),
(240, 'Thé Bi Luo Chun Blanc ', 'Thé Blanc de provenance : Japon  Bancha, des notes de fruits et d\'agrumes avec des saveurs citronnée et vive.', 3.5, 5, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6),
(241, 'Thé Da Hong Pao Blanc ', 'Thé Blanc d\'origine : Turquie  Genmaicha, des notes de noix et de cacao avec des saveurs vanillée et crémeuse.', 7.25, 74, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6),
(242, 'Thé Jin Jun Mei Blanc ', 'Thé Blanc d\'origine : Brésil  Genmaicha, des notes de cerise et de chocolat noir avec des saveurs cardamome et épicée.', 4.5, 36, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6),
(243, 'Thé Gyokuro Blanc ', 'Thé Blanc de provenance : Éthiopie  Darjeeling, des notes de malt et de miel avec des saveurs fleur d\'oranger et envoûtante.', 5.25, 25, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6),
(244, 'Thé Hojicha Blanc ', 'Thé Blanc d\'origine : Taïwan  Kenyan, des notes de végétaux et de beurre avec des saveurs vanillée et crémeuse.', 13.25, 70, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6),
(245, 'Thé Kukicha Blanc ', 'Thé Blanc d\'origine : Kenya  Gunpowder, des notes de baies et de vanille avec des saveurs amande et réconfortante.', 12.25, 61, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6),
(246, 'Thé Bancha Blanc ', 'Thé Blanc d\'origine : Honduras  Bancha, des notes de pomme verte et de cannelle avec des saveurs chocolatée et veloutée.', 5, 31, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6),
(247, 'Thé Rooibos Blanc ', 'Thé Blanc de provenance : République Dominicaine  Kenyan, des notes de cerise et de chocolat noir avec des saveurs fleur d\'oranger et envoûtante.', 9.5, 73, '2024-05-02 02:46:52', '2024-05-02 02:46:52', 2, 6),
(248, 'Thé Yerba Mate Blanc ', 'Thé Blanc de provenance : Birmanie  Bancha, des notes d\'abricot et de cardamome avec des saveurs maltée et corsée.', 12.5, 87, '2024-05-02 02:46:53', '2024-05-02 02:46:53', 2, 6),
(249, 'Thé Honeybush Blanc ', 'Thé Blanc de provenance : Côte d\'Ivoire  Rooibos, des notes de grenade et de bergamote avec des saveurs vanillée et crémeuse.', 4.5, 66, '2024-05-02 02:46:53', '2024-05-02 02:46:53', 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `productscharac`
--

CREATE TABLE `productscharac` (
  `value` varchar(255) DEFAULT NULL,
  `charac_id` int NOT NULL,
  `products_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productsimages`
--

CREATE TABLE `productsimages` (
  `products_id` int UNSIGNED NOT NULL,
  `images_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productsimages`
--

INSERT INTO `productsimages` (`products_id`, `images_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20),
(21, 21),
(22, 22),
(23, 23),
(24, 24),
(25, 25),
(26, 26),
(27, 27),
(28, 28),
(29, 29),
(30, 30),
(31, 31),
(32, 32),
(33, 33),
(34, 34),
(35, 35),
(36, 36),
(37, 37),
(38, 38),
(39, 39),
(40, 40),
(41, 41),
(42, 42),
(43, 43),
(44, 44),
(45, 45),
(46, 46),
(139, 47),
(140, 48),
(141, 49),
(142, 50),
(143, 51),
(144, 52),
(145, 53),
(146, 54),
(147, 55),
(148, 56),
(149, 57),
(150, 58),
(151, 59),
(152, 60),
(153, 61),
(154, 62),
(155, 63),
(156, 64),
(157, 65),
(158, 66),
(159, 67),
(160, 68),
(161, 69),
(162, 70),
(163, 71),
(164, 72),
(165, 73),
(166, 74),
(167, 75),
(168, 76),
(169, 77),
(170, 78),
(171, 79),
(172, 80),
(173, 81),
(174, 82),
(175, 83);

-- --------------------------------------------------------

--
-- Table structure for table `productsorders`
--

CREATE TABLE `productsorders` (
  `orders_id` int NOT NULL,
  `products_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productsorders`
--

INSERT INTO `productsorders` (`orders_id`, `products_id`) VALUES
(1, 4),
(2, 5),
(3, 6),
(4, 7),
(5, 8),
(6, 9),
(7, 10),
(8, 11),
(9, 12),
(10, 13),
(11, 14),
(12, 15),
(13, 16),
(14, 17),
(15, 18),
(16, 19),
(17, 20),
(18, 21),
(19, 22),
(20, 23),
(21, 24),
(22, 25),
(23, 26),
(24, 27),
(25, 28);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int NOT NULL,
  `rating` int DEFAULT NULL,
  `products_id` int UNSIGNED NOT NULL,
  `users_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `rating`, `products_id`, `users_id`) VALUES
(1, 4, 1, 1),
(2, 5, 2, 2),
(3, 3, 3, 1),
(4, 4, 184, 53),
(5, 5, 166, 34),
(6, 4, 102, 96),
(7, 4, 66, 106),
(8, 3, 117, 47),
(9, 4, 196, 85),
(10, 5, 144, 142),
(11, 3, 197, 36),
(12, 2, 80, 52),
(13, 3, 100, 147),
(14, 2, 5, 140),
(15, 4, 42, 36),
(16, 3, 12, 95),
(17, 5, 192, 137),
(18, 4, 110, 118),
(19, 2, 187, 139),
(20, 4, 36, 80),
(21, 1, 1, 99),
(22, 2, 78, 19),
(23, 3, 190, 56),
(24, 5, 165, 25),
(25, 2, 39, 144),
(26, 2, 40, 53),
(27, 1, 153, 51),
(28, 2, 192, 94),
(29, 2, 61, 124),
(30, 1, 92, 111),
(31, 2, 71, 125),
(32, 1, 179, 38),
(33, 3, 8, 80),
(34, 3, 4, 79),
(35, 3, 53, 93),
(36, 2, 127, 42),
(37, 3, 118, 76),
(38, 4, 36, 102),
(39, 5, 56, 122),
(40, 2, 134, 104),
(41, 3, 17, 19),
(42, 2, 105, 73),
(43, 5, 161, 71),
(44, 5, 51, 70),
(45, 3, 75, 32),
(46, 5, 5, 48),
(47, 3, 135, 121),
(48, 5, 102, 90),
(49, 3, 95, 3),
(50, 4, 38, 2),
(51, 3, 78, 74),
(52, 2, 185, 120),
(53, 2, 126, 83),
(54, 5, 122, 74),
(55, 4, 123, 36),
(56, 2, 197, 138),
(57, 4, 73, 144),
(58, 4, 124, 150),
(59, 1, 122, 104),
(60, 4, 12, 61),
(61, 5, 1, 74),
(62, 3, 135, 15),
(63, 3, 190, 64),
(64, 2, 16, 86),
(65, 4, 88, 47),
(66, 2, 29, 11),
(67, 5, 77, 27),
(68, 4, 15, 30),
(69, 4, 52, 149),
(70, 1, 175, 133),
(71, 4, 48, 130),
(72, 4, 93, 72),
(73, 5, 106, 102),
(74, 5, 197, 78),
(75, 4, 109, 131),
(76, 4, 182, 67),
(77, 3, 27, 29),
(78, 3, 43, 59),
(79, 2, 71, 131),
(80, 2, 156, 10),
(81, 5, 145, 101),
(82, 1, 177, 135),
(83, 5, 75, 66),
(84, 1, 191, 95),
(85, 2, 93, 77),
(86, 1, 65, 14),
(87, 3, 41, 79),
(88, 1, 103, 79),
(89, 1, 147, 75),
(90, 2, 175, 85),
(91, 1, 51, 105),
(92, 4, 97, 43),
(93, 5, 185, 115),
(94, 1, 183, 69),
(95, 3, 67, 6),
(96, 1, 170, 102),
(97, 5, 25, 18),
(98, 2, 153, 24),
(99, 3, 190, 48),
(100, 4, 141, 50),
(101, 3, 123, 80),
(102, 5, 82, 97),
(103, 1, 16, 57),
(104, 4, 30, 116),
(105, 3, 149, 76),
(106, 2, 171, 69),
(107, 4, 49, 8),
(108, 3, 89, 100),
(109, 5, 190, 119),
(110, 1, 32, 70),
(111, 5, 164, 88),
(112, 3, 106, 44),
(113, 5, 71, 37),
(114, 1, 17, 140),
(115, 3, 45, 138),
(116, 5, 154, 23),
(117, 3, 135, 18),
(118, 3, 74, 32),
(119, 5, 20, 100),
(120, 1, 14, 48),
(121, 2, 181, 64),
(122, 2, 131, 19),
(123, 4, 168, 43),
(124, 5, 125, 67),
(125, 2, 74, 124),
(126, 1, 118, 137),
(127, 4, 44, 109),
(128, 5, 114, 1),
(129, 2, 115, 139),
(130, 5, 134, 105),
(131, 3, 58, 2),
(132, 1, 179, 139),
(133, 5, 163, 51),
(134, 2, 20, 125),
(135, 5, 146, 21),
(136, 3, 13, 124),
(137, 5, 47, 52),
(138, 1, 14, 43),
(139, 2, 40, 55),
(140, 2, 193, 32),
(141, 1, 10, 128),
(142, 1, 179, 33),
(143, 3, 71, 85),
(144, 4, 27, 56),
(145, 3, 20, 27),
(146, 3, 70, 2),
(147, 1, 16, 49),
(148, 2, 180, 58),
(149, 2, 185, 150),
(150, 2, 10, 92),
(151, 5, 131, 88),
(152, 5, 18, 79),
(153, 2, 41, 143),
(154, 1, 167, 117),
(155, 2, 102, 67),
(156, 4, 23, 75),
(157, 1, 41, 90),
(158, 2, 32, 93),
(159, 3, 31, 146),
(160, 2, 4, 139),
(161, 3, 18, 108),
(162, 2, 85, 27),
(163, 4, 111, 140),
(164, 5, 21, 88),
(165, 4, 60, 99),
(166, 2, 184, 73),
(167, 4, 170, 43),
(168, 5, 78, 63),
(169, 5, 47, 74),
(170, 4, 52, 7),
(171, 3, 33, 65),
(172, 4, 1, 6),
(173, 1, 158, 64),
(174, 4, 79, 116),
(175, 4, 11, 37),
(176, 1, 108, 82),
(177, 1, 175, 12),
(178, 4, 106, 59),
(179, 2, 141, 61),
(180, 5, 55, 101),
(181, 3, 141, 135),
(182, 2, 20, 63),
(183, 5, 152, 58),
(184, 4, 20, 80),
(185, 2, 55, 38),
(186, 3, 80, 105),
(187, 2, 67, 123),
(188, 1, 184, 59),
(189, 1, 142, 5),
(190, 1, 190, 112),
(191, 5, 24, 147),
(192, 3, 146, 10),
(193, 1, 83, 107),
(194, 2, 81, 17),
(195, 2, 62, 84),
(196, 5, 137, 121),
(197, 5, 77, 9),
(198, 1, 98, 8),
(199, 4, 159, 91),
(200, 4, 58, 90),
(201, 1, 152, 71),
(202, 1, 193, 92),
(203, 1, 179, 9),
(204, 3, 156, 20),
(205, 2, 43, 16),
(206, 5, 15, 112),
(207, 3, 36, 70),
(208, 4, 88, 135),
(209, 1, 23, 12),
(210, 1, 11, 13),
(211, 2, 24, 114),
(212, 3, 184, 43),
(213, 4, 99, 69),
(214, 4, 125, 111),
(215, 5, 164, 103),
(216, 5, 141, 102),
(217, 2, 70, 139),
(218, 3, 10, 83),
(219, 4, 79, 21),
(220, 3, 27, 21),
(221, 2, 9, 51),
(222, 3, 163, 57),
(223, 3, 10, 140),
(224, 3, 143, 13),
(225, 2, 24, 114),
(226, 3, 186, 50),
(227, 5, 55, 122),
(228, 2, 137, 116),
(229, 4, 125, 116),
(230, 5, 112, 131),
(231, 4, 156, 132),
(232, 1, 105, 81),
(233, 1, 172, 6),
(234, 3, 164, 54),
(235, 2, 98, 79),
(236, 1, 39, 75),
(237, 5, 198, 41),
(238, 2, 10, 21),
(239, 3, 58, 122),
(240, 2, 113, 34),
(241, 3, 88, 141),
(242, 2, 195, 123),
(243, 1, 70, 39),
(244, 2, 75, 30),
(245, 5, 138, 135),
(246, 2, 59, 43),
(247, 3, 152, 36),
(248, 5, 173, 88),
(249, 2, 156, 150),
(250, 4, 44, 25),
(251, 1, 67, 26),
(252, 5, 148, 23),
(253, 3, 42, 67),
(254, 3, 121, 42),
(255, 3, 188, 7),
(256, 2, 163, 137),
(257, 1, 164, 116),
(258, 2, 114, 112),
(259, 5, 138, 77),
(260, 3, 180, 8),
(261, 3, 101, 141),
(262, 1, 19, 136),
(263, 2, 118, 24),
(264, 1, 120, 144),
(265, 5, 17, 67),
(266, 5, 103, 100),
(267, 4, 187, 50),
(268, 5, 42, 77),
(269, 5, 30, 141),
(270, 2, 77, 32),
(271, 5, 177, 110),
(272, 5, 135, 69),
(273, 2, 176, 99),
(274, 4, 47, 38),
(275, 3, 188, 17),
(276, 4, 44, 145),
(277, 1, 197, 62),
(278, 1, 43, 119),
(279, 2, 50, 42),
(280, 4, 67, 117),
(281, 5, 18, 119),
(282, 4, 197, 139),
(283, 4, 100, 82),
(284, 2, 82, 64),
(285, 5, 45, 63),
(286, 3, 154, 99),
(287, 5, 176, 76),
(288, 5, 155, 47),
(289, 2, 36, 36),
(290, 4, 106, 105),
(291, 5, 78, 40),
(292, 1, 193, 56),
(293, 5, 141, 96),
(294, 1, 91, 7),
(295, 5, 43, 70),
(296, 4, 198, 141),
(297, 4, 151, 95),
(298, 5, 107, 4),
(299, 3, 99, 141),
(300, 1, 26, 12),
(301, 5, 146, 105),
(302, 2, 52, 74),
(303, 4, 185, 90),
(304, 1, 39, 57),
(305, 2, 77, 3),
(306, 5, 124, 46),
(307, 4, 80, 150),
(308, 5, 6, 110),
(309, 3, 114, 31),
(310, 2, 175, 76),
(311, 5, 181, 133),
(312, 4, 163, 1),
(313, 3, 161, 52),
(314, 2, 103, 98),
(315, 4, 112, 105),
(316, 5, 186, 38),
(317, 3, 104, 35),
(318, 3, 59, 102),
(319, 3, 94, 129),
(320, 5, 150, 24),
(321, 3, 46, 80),
(322, 5, 49, 48),
(323, 5, 70, 26),
(324, 4, 84, 111),
(325, 3, 197, 92),
(326, 1, 121, 114),
(327, 5, 130, 45),
(328, 3, 147, 18),
(329, 2, 101, 61),
(330, 3, 57, 139),
(331, 4, 26, 43),
(332, 1, 79, 124),
(333, 5, 30, 148),
(334, 3, 78, 82),
(335, 3, 21, 133),
(336, 1, 172, 150),
(337, 3, 14, 15),
(338, 2, 25, 116),
(339, 3, 12, 130),
(340, 1, 23, 23),
(341, 3, 124, 129),
(342, 3, 96, 28),
(343, 3, 162, 97),
(344, 4, 189, 63),
(345, 2, 179, 121),
(346, 2, 32, 129),
(347, 5, 93, 137),
(348, 1, 7, 107),
(349, 3, 32, 62),
(350, 3, 120, 48),
(351, 4, 182, 36),
(352, 3, 111, 62),
(353, 2, 138, 47),
(354, 3, 91, 126),
(355, 5, 126, 99),
(356, 3, 7, 145),
(357, 4, 131, 23),
(358, 4, 93, 148),
(359, 3, 119, 70),
(360, 3, 46, 87),
(361, 1, 47, 91),
(362, 2, 136, 78),
(363, 3, 34, 32),
(364, 3, 30, 10),
(365, 5, 47, 77),
(366, 5, 136, 132),
(367, 2, 10, 35),
(368, 1, 67, 98),
(369, 2, 62, 119),
(370, 1, 148, 96),
(371, 5, 192, 132),
(372, 3, 181, 1),
(373, 2, 103, 100),
(374, 4, 160, 111),
(375, 2, 32, 147),
(376, 2, 15, 26),
(377, 4, 126, 40),
(378, 3, 80, 102),
(379, 1, 188, 18),
(380, 4, 100, 29),
(381, 3, 145, 38),
(382, 1, 114, 101),
(383, 4, 26, 114),
(384, 2, 136, 37),
(385, 1, 20, 149),
(386, 4, 65, 97),
(387, 2, 65, 130),
(388, 2, 35, 120),
(389, 3, 195, 69),
(390, 2, 73, 118),
(391, 5, 144, 25),
(392, 4, 147, 114),
(393, 3, 121, 44),
(394, 4, 79, 1),
(395, 5, 25, 22),
(396, 2, 54, 50),
(397, 5, 33, 51),
(398, 2, 196, 48),
(399, 4, 37, 5),
(400, 4, 188, 136),
(401, 4, 134, 51),
(402, 4, 69, 107),
(403, 3, 87, 94),
(404, 5, 54, 130),
(405, 3, 185, 20),
(406, 5, 198, 49),
(407, 4, 43, 24),
(408, 1, 46, 108),
(409, 5, 83, 49),
(410, 2, 180, 57),
(411, 1, 166, 89),
(412, 3, 85, 123),
(413, 4, 111, 55),
(414, 1, 147, 27),
(415, 4, 184, 79),
(416, 5, 142, 150),
(417, 5, 50, 106),
(418, 4, 135, 18),
(419, 3, 94, 99),
(420, 5, 85, 71),
(421, 1, 12, 2),
(422, 5, 57, 127),
(423, 2, 66, 80),
(424, 4, 133, 57),
(425, 5, 53, 104),
(426, 4, 41, 9),
(427, 4, 31, 118),
(428, 3, 187, 47),
(429, 4, 153, 91),
(430, 4, 169, 7),
(431, 4, 54, 46),
(432, 4, 121, 139),
(433, 4, 40, 94),
(434, 3, 137, 135),
(435, 3, 87, 136),
(436, 1, 59, 130),
(437, 3, 129, 133),
(438, 3, 161, 82),
(439, 2, 189, 117),
(440, 1, 178, 51),
(441, 1, 5, 13),
(442, 2, 93, 47),
(443, 1, 158, 78),
(444, 2, 112, 21),
(445, 5, 109, 114),
(446, 1, 82, 97),
(447, 5, 193, 136),
(448, 4, 78, 13),
(449, 2, 7, 60),
(450, 5, 52, 93),
(451, 2, 133, 63),
(452, 1, 50, 142),
(453, 5, 193, 146),
(454, 5, 152, 2),
(455, 4, 168, 133),
(456, 5, 156, 37),
(457, 5, 126, 83),
(458, 5, 118, 62),
(459, 2, 28, 130),
(460, 5, 190, 6),
(461, 2, 112, 119),
(462, 2, 7, 48),
(463, 3, 100, 3),
(464, 4, 193, 3),
(465, 1, 167, 100),
(466, 4, 197, 85),
(467, 5, 106, 17),
(468, 5, 101, 94),
(469, 3, 18, 100),
(470, 1, 50, 17),
(471, 4, 131, 134),
(472, 3, 147, 36),
(473, 5, 39, 3),
(474, 3, 102, 3),
(475, 3, 136, 115),
(476, 4, 127, 124),
(477, 2, 109, 19),
(478, 5, 98, 80),
(479, 1, 63, 5),
(480, 1, 182, 145),
(481, 1, 107, 64),
(482, 3, 50, 111),
(483, 5, 87, 57),
(484, 4, 173, 80),
(485, 1, 136, 35),
(486, 1, 180, 23),
(487, 1, 145, 78),
(488, 3, 115, 90),
(489, 2, 88, 70),
(490, 5, 115, 135),
(491, 4, 15, 17),
(492, 2, 62, 84),
(493, 5, 124, 80),
(494, 4, 63, 36),
(495, 2, 86, 71),
(496, 1, 173, 27),
(497, 2, 169, 61),
(498, 3, 33, 59),
(499, 3, 22, 26),
(500, 3, 30, 22),
(501, 2, 196, 9),
(502, 2, 110, 107),
(503, 5, 87, 64);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `description`, `category_id`) VALUES
(1, 'Corsé', 'Des cafés avec une intensité prononcée et des arômes forts.', 1),
(2, 'Moyen', 'Des cafés équilibrés avec des arômes doux et légèrement acidulés.', 1),
(3, 'Faible', 'Des cafés légers avec des saveurs subtiles et une faible acidité.', 1),
(4, 'Noir', 'Des thés noirs riches et corsés avec des notes maltées.', 2),
(5, 'Vert', 'Des thés verts légers et rafraîchissants avec des notes végétales.', 2),
(6, 'Blanc', 'Des thés blancs délicats et floraux avec une douceur naturelle.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `full_name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `adress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` enum('user','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `birthday`, `adress`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Jean-Ely', 'jean-ely.gendau@laplateforme.io', '$argon2id$v=19$m=65536,t=2,p=1$qm60Qf7PnwiKVr6/rrG8QQ$J20T1VHEXxCzc8GoaDlYiTM8I5QhIK9EgjCUhnmwt7E', '1990-04-15', '83000 Toulon', 'admin', '2024-05-02 02:43:41', '2024-05-10 16:47:43'),
(2, 'Esteban', 'esteban.bare@laplateforme.io', '$argon2id$v=19$m=65536,t=2,p=1$qm60Qf7PnwiKVr6/rrG8QQ$J20T1VHEXxCzc8GoaDlYiTM8I5QhIK9EgjCUhnmwt7E', '1990-04-15', '83000 Toulon', 'admin', '2024-05-02 02:43:41', '2024-05-10 16:48:45'),
(3, 'Alexandre', 'alexandre.detroy@laplateforme.io', '$argon2id$v=19$m=65536,t=2,p=1$qm60Qf7PnwiKVr6/rrG8QQ$J20T1VHEXxCzc8GoaDlYiTM8I5QhIK9EgjCUhnmwt7E', '1990-04-15', '83000 Toulon', 'admin', '2024-05-02 02:43:41', '2024-05-10 16:48:45'),
(4, 'Jean-Philippe', 'jean-philippe.douzou@laplateforme.io', '$argon2id$v=19$m=65536,t=2,p=1$qm60Qf7PnwiKVr6/rrG8QQ$J20T1VHEXxCzc8GoaDlYiTM8I5QhIK9EgjCUhnmwt7E', '1990-04-15', '83000 Toulon', 'admin', '2024-05-02 02:43:41', '2024-05-10 16:48:45'),
(5, 'Angel', 'angel.putz@laplateforme.io', '$argon2id$v=19$m=65536,t=2,p=1$qm60Qf7PnwiKVr6/rrG8QQ$J20T1VHEXxCzc8GoaDlYiTM8I5QhIK9EgjCUhnmwt7E', '1990-04-15', '83000 Toulon', 'admin', '2024-05-02 02:43:41', '2024-05-10 16:48:45'),
(6, 'Ronnie Bartosinski', 'rbartosinski0@meetup.com', '$argon2id$v=19$m=65536,t=2,p=1$Y/dyR6x5AjX+SdRy/jBC/Q$ZXgtwiUUgo8Hc2vXkiWo1qjK1lRpqi+jhSyUuvhz5mM', '1978-09-08', '14690 Rapilly - 14', 'user', '2024-05-02 02:43:41', '2024-05-02 02:43:41'),
(7, 'Teddie Moakes', 'tmoakes1@europa.eu', '$argon2id$v=19$m=65536,t=2,p=1$yKT9jAub9IFyGcfHGSkOAA$/JyFQ7pr1L8mzdNVBY5m+0id6ucBknqE2CTjWX2IJjc', '1991-04-07', '41100 Pezou - 41', 'user', '2024-05-02 02:43:41', '2024-05-02 02:43:41'),
(8, 'Calvin MacQuaker', 'cmacquaker2@marketwatch.com', '$argon2id$v=19$m=65536,t=2,p=1$Mb2jroTHYHZzPy1OLqDThw$W0cvUPciUqj+72J04HnVI+GNbdqSwKQJXSfTYfc+KvU', '1965-05-09', '71500 Branges - 71', 'user', '2024-05-02 02:43:42', '2024-05-02 02:43:42'),
(9, 'Lawrence Grand', 'lgrand3@umich.edu', '$argon2id$v=19$m=65536,t=2,p=1$nyrrcFbbGOiXNXmpAlOD4Q$xWKgafwGnvMkI7TrX7ygdzXDM25MhG3WZl1ba/XUwu0', '1969-10-11', '17810 Pessines - 17', 'user', '2024-05-02 02:43:42', '2024-05-02 02:43:42'),
(10, 'Alanson Ebdin', 'aebdin4@flickr.com', '$argon2id$v=19$m=65536,t=2,p=1$tWBjUVfp8HwYFTO41ZutCg$jA1dtIM/3jTFKbNauNUqLUCfNHpUftIuKlxMYppQHQg', '2003-07-10', '77580 Guérard - 77', 'user', '2024-05-02 02:43:42', '2024-05-02 02:43:42'),
(11, 'Bonnee Lockhead', 'blockhead5@tinypic.com', '$argon2id$v=19$m=65536,t=2,p=1$QhLOVfCiKRIy8ee3uyM7ag$xmMbpirCbbmxHkBZ8ta7/ElWAv2kr8TygGN3Q4u2+xM', '1987-02-13', '28310 Neuvy-en-Beauce - 28', 'user', '2024-05-02 02:43:42', '2024-05-02 02:43:42'),
(12, 'Jarret Heale', 'jheale6@uol.com.br', '$argon2id$v=19$m=65536,t=2,p=1$eaqEKXU56gvQT4C7YjcyYg$b0wGs3y1Zr2kYCABkGiL3HTjy6Wd7Xcr5tAdKesxawk', '1993-04-02', '50440 Branville-Hague - 50', 'user', '2024-05-02 02:43:42', '2024-05-02 02:43:42'),
(13, 'Leyla Simionescu', 'lsimionescu7@ocn.ne.jp', '$argon2id$v=19$m=65536,t=2,p=1$FtrN0vuQYM1bZQwPmP0VLw$2Y852lqTxMH2IHIAIcI9LiCGEjPKpxAZUAGiSijNEg8', '1997-03-09', '59142 Villers-Outréaux - 59', 'user', '2024-05-02 02:43:42', '2024-05-02 02:43:42'),
(14, 'Lea Rennicks', 'lrennicks8@theguardian.com', '$argon2id$v=19$m=65536,t=2,p=1$sers8pHjAGBa0cAbbNx5IA$s5Fq81NOWtk6KCNT4NlrI1TiQov2eejRF78buLeJUkQ', '1981-11-24', '23480 Le Donzeil - 23', 'user', '2024-05-02 02:43:42', '2024-05-02 02:43:42'),
(15, 'Berkeley Serjeant', 'bserjeant9@comcast.net', '$argon2id$v=19$m=65536,t=2,p=1$2C10UUmYzHIw7FTn/aLUCw$kPrbre2SyuUmjuGJgLP+61EtJduHgu3ltpxuOf/vD8g', '1982-08-18', '86170 Maisonneuve - 86', 'user', '2024-05-02 02:43:42', '2024-05-02 02:43:42'),
(16, 'Ynez Reddings', 'yreddingsa@fastcompany.com', '$argon2id$v=19$m=65536,t=2,p=1$LTIh06fwKlBBIx7Xe0j6pQ$6S0/ZAU05UBQi3TqohxRfQ655hP+QQxAIcsSbCAlgeU', '1990-12-08', '80800 Daours - 80', 'user', '2024-05-02 02:43:43', '2024-05-02 02:43:43'),
(17, 'Noak Reston', 'nrestonb@yahoo.com', '$argon2id$v=19$m=65536,t=2,p=1$hpWml/uJsI10L5u+oJFt3Q$7ZiZzeUTjEg4P73Eya8y2deAhXg+pFMeINfMjapoBeA', '1971-11-12', '28630 Gellainville - 28', 'user', '2024-05-02 02:43:43', '2024-05-02 02:43:43'),
(18, 'Steffen Kleis', 'skleisc@china.com.cn', '$argon2id$v=19$m=65536,t=2,p=1$+kjKGjnhxxCMzHWDKaPo+w$OgBT8N+NM67H/jqrB+ixOhgjEGbpF0QOdO0m+8EpQt0', '1971-08-12', '25410 Routelle - 25', 'user', '2024-05-02 02:43:43', '2024-05-02 02:43:43'),
(19, 'Ossie Laver', 'olaverd@yellowpages.com', '$argon2id$v=19$m=65536,t=2,p=1$LO8Hyb3hJBWpnRtAMkCF5A$U/tGHNNTO4xkP3ZnTSnB2B6ILg+t+dRhqkKbe4aE6Q8', '1980-01-04', '27410 Ajou - 27', 'user', '2024-05-02 02:43:43', '2024-05-02 02:43:43'),
(20, 'Ruperta Ellul', 'rellule@privacy.gov.au', '$argon2id$v=19$m=65536,t=2,p=1$yXX4RO3yty/uAI8ZlIaeCA$KfhW+8w5PhSriLg2ssbmVnad0Yp3qHAMObtxUo5tX8g', '1975-03-22', '80590 Offignies - 80', 'user', '2024-05-02 02:43:43', '2024-05-02 02:43:43'),
(21, 'Freddie Jacobovitz', 'fjacobovitzf@soup.io', '$argon2id$v=19$m=65536,t=2,p=1$umJKtUc+UKI8Nw1pT0qXlw$/3fqsW674jQ37oxcJH7kiU0KKwdZOlzlEVopcICL3TM', '1970-11-03', '07400 Saint-Pierre-la-Roche - 07', 'user', '2024-05-02 02:43:43', '2024-05-02 02:43:43'),
(22, 'Wat Hannant', 'whannantg@noaa.gov', '$argon2id$v=19$m=65536,t=2,p=1$GFUzod2d0hnjThd/VflAEQ$gnhKhaPlO0cSNRNoWYcb5vaEUoMQuJpxcOSozb07UKA', '1986-03-25', '17590 Ars-en-Ré - 17', 'user', '2024-05-02 02:43:43', '2024-05-02 02:43:43'),
(23, 'Shaylah Unstead', 'sunsteadh@miibeian.gov.cn', '$argon2id$v=19$m=65536,t=2,p=1$tClqmtc9sw38KkhsX+HNow$X8UU/Tr75giD4HhXBYU5IBIzCvsZeH+p0wZnYBnleAE', '1993-03-29', '87460 Saint-Julien-le-Petit - 87', 'user', '2024-05-02 02:43:43', '2024-05-02 02:43:43'),
(24, 'Red Cromly', 'rcromlyi@mayoclinic.com', '$argon2id$v=19$m=65536,t=2,p=1$Aj20g7Rd97w5N4PUhH/fHg$HR7fPaZwd/D6WvJzn7lCvHbCLEpnvPgszf7hKimPSFQ', '1967-05-29', '46200 Lacave - 46', 'user', '2024-05-02 02:43:43', '2024-05-02 02:43:43'),
(25, 'Ester Bason', 'ebasonj@friendfeed.com', '$argon2id$v=19$m=65536,t=2,p=1$GSLbCa5FwepvY0tdMs8jAQ$hNJEwkJmEgx26jl7Et0lm8PWNp8crDAvnWPVb/9C7r4', '1985-08-01', '20116 Zérubia - 2A', 'user', '2024-05-02 02:43:44', '2024-05-02 02:43:44'),
(26, 'Henry Mariault', 'hmariaultk@purevolume.com', '$argon2id$v=19$m=65536,t=2,p=1$dcCnLjYZNaATmoxPMZlYMA$ASjnHi3cFc2LaKTbcexB8ohOBBQcYbG8OcXsvO4TRZw', '1994-07-23', '33580 Saint-Ferme - 33', 'user', '2024-05-02 02:43:44', '2024-05-02 02:43:44'),
(27, 'Sharline Adamczewski', 'sadamczewskil@etsy.com', '$argon2id$v=19$m=65536,t=2,p=1$fa5j0NUMaootCq2zZugRSA$dkZumPkGzwSoKKcdm2G8F4BVY07UTvCHsmi3e92WeMY', '1989-02-24', '24800 Sarrazac - 24', 'user', '2024-05-02 02:43:44', '2024-05-02 02:43:44'),
(28, 'Georgie Brenard', 'gbrenardm@wisc.edu', '$argon2id$v=19$m=65536,t=2,p=1$868FWIv1cCKT/Vw7MFU5nA$3tVZDjiuST7uFL9uhwHj0dHJZzUSzp/SLxVwnb9OrbY', '1969-06-19', '57580 Arriance - 57', 'user', '2024-05-02 02:43:44', '2024-05-02 02:43:44'),
(29, 'Lida Gabitis', 'lgabitisn@youtube.com', '$argon2id$v=19$m=65536,t=2,p=1$Rth60OxfZkLvPiEUgNij0A$QwGAVoQHA1sstBP4EEb2cSKBpFrVKN+5LVQ0rj9SroQ', '1988-04-08', '43320 Vazeilles-Limandre - 43', 'user', '2024-05-02 02:43:44', '2024-05-02 02:43:44'),
(30, 'Herschel Farthin', 'hfarthino@geocities.jp', '$argon2id$v=19$m=65536,t=2,p=1$DALRCvu6DhmLIBKr/GdgWg$yLe6ZZnLoISuoqxE4Nxbmelj8RjdhNVjmtRYnxCOps4', '1983-07-25', '37700 Saint-Pierre-des-Corps - 37', 'user', '2024-05-02 02:43:44', '2024-05-02 02:43:44'),
(31, 'Uriel Rosenfarb', 'urosenfarbp@pcworld.com', '$argon2id$v=19$m=65536,t=2,p=1$3BzHCeppc5Fet9PZ7gMNLg$7sehEXTLHzff7Sqpm3Gr9O47uowjaO4u2tCrC1zBDQs', '2000-02-18', '47320 Bourran - 47', 'user', '2024-05-02 02:43:44', '2024-05-02 02:43:44'),
(32, 'Woodrow Calbert', 'wcalbertq@com.com', '$argon2id$v=19$m=65536,t=2,p=1$zABeUFIxx/NPqNhduL1KPA$Exn7iucK8+fbrRbyykDAZlSf4sCL/VSargZPQxY9tn4', '1995-02-01', '60240 Énencourt-le-Sec - 60', 'user', '2024-05-02 02:43:44', '2024-05-02 02:43:44'),
(33, 'Celestine Spring', 'cspringr@live.com', '$argon2id$v=19$m=65536,t=2,p=1$Ekrhbi0K9kK+9AanveQOjQ$fRoMQwjJLOtXDFHx5FYaKDMPPheXYr0Q8F7c4NPpvO0', '1996-06-11', '62126 Conteville-lès-Boulogne - 62', 'user', '2024-05-02 02:43:45', '2024-05-02 02:43:45'),
(34, 'Stefanie Bowles', 'sbowless@nasa.gov', '$argon2id$v=19$m=65536,t=2,p=1$Oa42gUccellRHTzQbH3/Ww$LCwBERbKpg8FV2Z3kfYBRux6x7OgAaB8a5ZKn1hxYec', '1990-12-29', '54290 Villacourt - 54', 'user', '2024-05-02 02:43:45', '2024-05-02 02:43:45'),
(35, 'Glad Plumb', 'gplumbt@arizona.edu', '$argon2id$v=19$m=65536,t=2,p=1$qBVBmK7khLuCy6VuqphS7w$lZBURg0cjmyMFRI5R8u49Llc/NJcgLfAIesKA6LaS9Q', '1968-03-07', '50890 Condé-sur-Vire - 50', 'user', '2024-05-02 02:43:45', '2024-05-02 02:43:45'),
(36, 'Enoch Basilone', 'ebasiloneu@ameblo.jp', '$argon2id$v=19$m=65536,t=2,p=1$UvVVBQx6OobV+TqZ44d/hQ$LOUNd9MFKYlaPT9+TA7R2da2KbzbslR0xN1CipjDNOM', '1997-09-25', '80135 Yaucourt-Bussus - 80', 'user', '2024-05-02 02:43:45', '2024-05-02 02:43:45'),
(37, 'Lombard Sercombe', 'lsercombev@tripadvisor.com', '$argon2id$v=19$m=65536,t=2,p=1$CSByaVm7PYw55vLdE350sA$TH0Ec5a6I9c0OPksl93jp6e+qSocusYS3MSklizQZzo', '2004-12-22', '80600 Neuvillette - 80', 'user', '2024-05-02 02:43:45', '2024-05-02 02:43:45'),
(38, 'Cornela Barnwall', 'cbarnwallw@wikia.com', '$argon2id$v=19$m=65536,t=2,p=1$Q9Ng0k/NL1/aHHPXNnjl4A$g2aONRyZZz0JUXls3/rGqF6eypnx8jEi8iKaTk5dXuo', '1992-05-24', '63720 Clerlande - 63', 'user', '2024-05-02 02:43:45', '2024-05-02 02:43:45'),
(39, 'Rickey Jeratt', 'rjerattx@jigsy.com', '$argon2id$v=19$m=65536,t=2,p=1$JfpowuLLbpAGOxVjWstQjQ$J6kDK7OXqs2Yn/W93gSZeiRVa1sSdTfIVZgkA6Yb3X8', '1987-02-23', '57590 Laneuveville-en-Saulnois - 57', 'user', '2024-05-02 02:43:45', '2024-05-02 02:43:45'),
(40, 'Lambert De Zamudio', 'ldey@shinystat.com', '$argon2id$v=19$m=65536,t=2,p=1$2rWYtjRJ6Fv2YRdbK84SKw$sPkFq89E4wjGXdfyojI5V+qcuj2p7CFCt+JPoNkHG78', '1979-09-07', '39300 Conte - 39', 'user', '2024-05-02 02:43:45', '2024-05-02 02:43:45'),
(41, 'Shelagh Crocetto', 'scrocettoz@people.com.cn', '$argon2id$v=19$m=65536,t=2,p=1$GFsJoQtQbwiSAqFDil2xQQ$7JJXdv/Uv2zq6JyUW1oDCc5wakcaHdlqa6+h03feR6E', '1966-06-23', '87260 Saint-Hilaire-Bonneval - 87', 'user', '2024-05-02 02:43:45', '2024-05-02 02:43:45'),
(42, 'Fanchette Althrope', 'falthrope10@theglobeandmail.com', '$argon2id$v=19$m=65536,t=2,p=1$WQjrZHdKulDsFP/If/parg$qlvCmHWZmHaVl/JrrzrSErJmcZTxUaXsFLm4SnGoSZY', '1976-07-11', '64190 Ogenne-Camptort - 64', 'user', '2024-05-02 02:43:46', '2024-05-02 02:43:46'),
(43, 'Ellsworth Gildersleeve', 'egildersleeve11@wix.com', '$argon2id$v=19$m=65536,t=2,p=1$8czlzQ/rYbADVfrFGu1gdg$Uq0+mEu0c+HE90+lHjg42L7wGgvTmqa2ZgQHH3YlkJ4', '2003-11-23', '02650 Fossoy - 02', 'user', '2024-05-02 02:43:46', '2024-05-02 02:43:46'),
(44, 'Witty Mouat', 'wmouat12@de.vu', '$argon2id$v=19$m=65536,t=2,p=1$sUmFohBYNprKsYARwpbuzw$kUxIOaft9T45oKCEmXC/jH6bnEbUvQFjrWDeDOrtTg8', '1988-09-01', '20229 Campana - 2B', 'user', '2024-05-02 02:43:46', '2024-05-02 02:43:46'),
(45, 'Hewet Burke', 'hburke13@epa.gov', '$argon2id$v=19$m=65536,t=2,p=1$wZF0jtQeAmx+PrYDMZk9Iw$V4wNaaof6prM07AA06JKGH30vcuczUsr9/SR/rwsH0I', '1980-04-07', '16170 Mareuil - 16', 'user', '2024-05-02 02:43:46', '2024-05-02 02:43:46'),
(46, 'Riley Micklewright', 'rmicklewright14@archive.org', '$argon2id$v=19$m=65536,t=2,p=1$T0Khm6K7WvQAbzBMOltUQw$ZXZICoGbMjrQE81n8+8cXUdNFmiTzj19x9usbl+4eQo', '1982-08-19', '60810 Ognon - 60', 'user', '2024-05-02 02:43:46', '2024-05-02 02:43:46'),
(47, 'Derward Estcot', 'destcot15@so-net.ne.jp', '$argon2id$v=19$m=65536,t=2,p=1$tRZgtAke0ypeX3M6rbe3rQ$UY8F72Ljv2QXUli4htbsEdXhfbE7CFt+Fb7b5EE+2Fo', '2002-08-03', '38590 Saint-Étienne-de-Saint-Geoirs - 38', 'user', '2024-05-02 02:43:46', '2024-05-02 02:43:46'),
(48, 'Giraldo Bottby', 'gbottby16@php.net', '$argon2id$v=19$m=65536,t=2,p=1$AQ+Qr4+8teatHBE0xt6dpw$q478UWanfz4+deL76ALdkKdTY7NGvf7Uy3vNKxfydkU', '1988-11-16', '24360 Saint-Estèphe - 24', 'user', '2024-05-02 02:43:46', '2024-05-02 02:43:46'),
(49, 'Mada Birtchnell', 'mbirtchnell17@naver.com', '$argon2id$v=19$m=65536,t=2,p=1$oY1Wh+aVTF1zdsy/+ZNrlg$tEqs7Fu58VFGdqmbAdpqG3HI9xiKoodIJseyj/D9pyo', '1970-06-30', '93160 Noisy-le-Grand - 93', 'user', '2024-05-02 02:43:46', '2024-05-02 02:43:46'),
(50, 'Winny Newdick', 'wnewdick18@yandex.ru', '$argon2id$v=19$m=65536,t=2,p=1$rbWwK4A7Ay5IDabhU/glxA$QeYh9idLB3pY5F73GJFFj3wkJ7oQHxClgn6S3V8g0ck', '2004-10-26', '67290 Wingen-sur-Moder - 67', 'user', '2024-05-02 02:43:46', '2024-05-02 02:43:46'),
(51, 'Edgard Newlyn', 'enewlyn19@europa.eu', '$argon2id$v=19$m=65536,t=2,p=1$AvvDy8NfRpPjDSBH6E+tkA$MTq/sO6EHT4da+wquy12ZG1Bg9jRUARL19Z7zqupBh8', '1999-09-16', '84660 Maubec - 84', 'user', '2024-05-02 02:43:47', '2024-05-02 02:43:47'),
(52, 'Chilton Sprigin', 'csprigin1a@arizona.edu', '$argon2id$v=19$m=65536,t=2,p=1$zWBm8KDCHlYs/gw5f1Esjw$1lUao26iaA+hoQxITb+ZgZDjwQvdoVj/rxlF4T4eGok', '1990-09-15', '89710 Senan - 89', 'user', '2024-05-02 02:43:47', '2024-05-02 02:43:47'),
(53, 'Fenelia Yapp', 'fyapp1b@google.cn', '$argon2id$v=19$m=65536,t=2,p=1$CDl/Rbd/cDuyvyYFaEizEA$bef7HO3c/nIgJzTfEBsQ7o32dT6mCh91VLRDY8FHrlY', '1989-09-02', '73350 Champagny-en-Vanoise - 73', 'user', '2024-05-02 02:43:47', '2024-05-02 02:43:47'),
(54, 'Mickey McQuode', 'mmcquode1c@jigsy.com', '$argon2id$v=19$m=65536,t=2,p=1$0VcRZwYebwLrmGxDVeD0Yw$ZrP2eMw8nsZB5QkqsbRUMSBAcHRUqzULhl7Y4j8DfkI', '1976-07-11', '78125 La Boissière-École - 78', 'user', '2024-05-02 02:43:47', '2024-05-02 02:43:47'),
(55, 'Darrin Schruyers', 'dschruyers1d@usgs.gov', '$argon2id$v=19$m=65536,t=2,p=1$0sIh0gyDU+zRXLQ/LRXW9A$pdk0wOdAWdsBrFTRxrtf8JxJ0tEh4yW+79mJjtZ8iKA', '2003-04-01', '51800 Ville-sur-Tourbe - 51', 'user', '2024-05-02 02:43:47', '2024-05-02 02:43:47'),
(56, 'West Saffer', 'wsaffer1e@adobe.com', '$argon2id$v=19$m=65536,t=2,p=1$HR4MVwRLeswQo/vHl302iw$WiI2a6Ug5LRGU7OcG37O3pQObxkq7p77Se8fTUVgv6c', '2002-10-03', '09100 Ludiès - 09', 'user', '2024-05-02 02:43:47', '2024-05-02 02:43:47'),
(57, 'Cosetta Somerbell', 'csomerbell1f@yandex.ru', '$argon2id$v=19$m=65536,t=2,p=1$0P00jnxReblEabzhxAvtgQ$dC2Ri6Hqrzlf8J2XcVUdyC5U5wT9+6UfBaHQ4d5B/VI', '1990-08-24', '21320 Chazilly - 21', 'user', '2024-05-02 02:43:47', '2024-05-02 02:43:47'),
(58, 'Tracie Clawe', 'tclawe1g@chicagotribune.com', '$argon2id$v=19$m=65536,t=2,p=1$0jy7IDwaCyOEsv/o3/K8FQ$FBGK3nI32lPSuQHU1ZvhXcU08uttm9bT959yPIbzEQY', '1991-02-27', '12600 Thérondels - 12', 'user', '2024-05-02 02:43:47', '2024-05-02 02:43:47'),
(59, 'Ernestine Denyagin', 'edenyagin1h@mail.ru', '$argon2id$v=19$m=65536,t=2,p=1$35PM9I9CMFDULjj5lt2IHg$B2Ivx0oLvj0TuL03NGQ2T73uH5OvdIuIllVkIGOz0vQ', '1999-05-23', '53160 Hambers - 53', 'user', '2024-05-02 02:43:48', '2024-05-02 02:43:48'),
(60, 'Gardner Geake', 'ggeake1i@businesswire.com', '$argon2id$v=19$m=65536,t=2,p=1$NVIdssZjvtC2CxAtAnLa8w$ASQ4olCHR6o8kzR4qYhFtDRRJDRg1Eg5FPxvor8pXUE', '1988-07-02', '55120 Autrécourt-sur-Aire - 55', 'user', '2024-05-02 02:43:48', '2024-05-02 02:43:48'),
(61, 'Shaine MacCaghan', 'smaccaghan1j@wiley.com', '$argon2id$v=19$m=65536,t=2,p=1$5bkbYi84Cq6G4m2WHzXLPA$mv8zG19NbyoAhdrghpk2uz1JhxPbyW430yvG5pcLwDE', '1965-08-24', '25620 L\'Hôpital-du-Grosbois - 25', 'user', '2024-05-02 02:43:48', '2024-05-02 02:43:48'),
(62, 'Mag Haggeth', 'mhaggeth1k@networkadvertising.org', '$argon2id$v=19$m=65536,t=2,p=1$Q2KBcJTtClKSyAua14+a+A$tqyQZRcvFL7c8qqrEQzBhTLTdjEn5plMsvDvF8lYDIg', '1970-11-26', '72130 Sougé-le-Ganelon - 72', 'user', '2024-05-02 02:43:48', '2024-05-02 02:43:48'),
(63, 'Leyla Crush', 'lcrush1l@google.ca', '$argon2id$v=19$m=65536,t=2,p=1$Z31alDu6cNDArKKUrjnU+Q$+XDgdbDxQf1MNb/4/mh4M40kihu1S8jdlGuE43GNc7M', '1972-12-25', '54420 Pulnoy - 54', 'user', '2024-05-02 02:43:48', '2024-05-02 02:43:48'),
(64, 'Rafael Gossop', 'rgossop1m@ucla.edu', '$argon2id$v=19$m=65536,t=2,p=1$h16VuEOAuMOWblyWKGWe6w$EmaqS3eeXKknvDWKG8aRmI+dsqJ6Et3aUpJEZhxvT5A', '1973-11-07', '01220 Divonne-les-Bains - 01', 'user', '2024-05-02 02:43:48', '2024-05-02 02:43:48'),
(65, 'Orton Vido', 'ovido1n@salon.com', '$argon2id$v=19$m=65536,t=2,p=1$3u6OTkup5S8w5UEDnWEuGA$BHZrTHrPVspH/YOmBM4q7Vrn/zTFTtiV7h+7tTibE9Q', '1987-09-11', '76490 Saint-Nicolas-de-la-Haie - 76', 'user', '2024-05-02 02:43:48', '2024-05-02 02:43:48'),
(66, 'Giacobo Aloshechkin', 'galoshechkin1o@slashdot.org', '$argon2id$v=19$m=65536,t=2,p=1$LqBsGC5632NEG9S7j+NdGw$c7Dt8uYYacD2vADEYdjQaycjLFXBCIPH/GhalxIkIsA', '1978-12-25', '47200 Longueville - 47', 'user', '2024-05-02 02:43:48', '2024-05-02 02:43:48'),
(67, 'Molly Cud', 'mcud1p@nbcnews.com', '$argon2id$v=19$m=65536,t=2,p=1$Lk/xzBkRUzGYZxYH/Qx0XQ$UC1AZcJgw+liccUPbLgZSUJP07wrY3QjAjQC6Cg3voM', '1967-12-08', '24250 Domme - 24', 'user', '2024-05-02 02:43:48', '2024-05-02 02:43:48'),
(68, 'Pollyanna Brosh', 'pbrosh1q@virginia.edu', '$argon2id$v=19$m=65536,t=2,p=1$E53R87F7+ECAgT4KAmJtvA$DYSJAoP5ZpxJcPZV9ndiyjsgph0Z80VefqQ4Tx/QuUE', '1998-01-21', '17780 Saint-Nazaire-sur-Charente - 17', 'user', '2024-05-02 02:43:49', '2024-05-02 02:43:49'),
(69, 'Markus McKniely', 'mmckniely1r@guardian.co.uk', '$argon2id$v=19$m=65536,t=2,p=1$yafqGH4B18OykQL405dOvA$ye0S9WLVRMnp0PYlJseqX+UH8A1Fc9Zis2ATAIdyGFE', '1996-07-04', '43810 Saint-Pierre-du-Champ - 43', 'user', '2024-05-02 02:43:49', '2024-05-02 02:43:49'),
(70, 'Bernelle Tofpik', 'btofpik1s@lycos.com', '$argon2id$v=19$m=65536,t=2,p=1$q/OzaS9qUhNbxlU4kB5fjA$wcYWhcpIwouOnmS/TEnoIPO8RAWriEK5b0W3YXmeZ04', '1981-11-19', '82270 Montfermier - 82', 'user', '2024-05-02 02:43:49', '2024-05-02 02:43:49'),
(71, 'Meredithe Dumphy', 'mdumphy1t@tripod.com', '$argon2id$v=19$m=65536,t=2,p=1$lEO1dGBVNbyLwsqKSX3G1g$uri2re44XCfsWGKKMeLKU+MkN2TQUECBPeXkyjUSlUA', '1974-07-25', '66220 Vira - 66', 'user', '2024-05-02 02:43:49', '2024-05-02 02:43:49'),
(72, 'Jedd Bilbery', 'jbilbery1u@census.gov', '$argon2id$v=19$m=65536,t=2,p=1$hgJHOJs3e01wUoU9q9Rcsw$izj4JMMeCqNEOT27PViZ8uJVhOjMkfswFMDC6fOQ024', '1987-05-13', '07160 Le Chambon - 07', 'user', '2024-05-02 02:43:49', '2024-05-02 02:43:49'),
(73, 'Pall Bison', 'pbison1v@oracle.com', '$argon2id$v=19$m=65536,t=2,p=1$HjM1w6tjTsgpiSQW2VC5mA$ByK3OONzwVU9pDrsTG3DF3qzHZtGvxi9QE6uy5DlQZ0', '1976-03-04', '61240 La Genevraie - 61', 'user', '2024-05-02 02:43:49', '2024-05-02 02:43:49'),
(74, 'Klarrisa Goshawke', 'kgoshawke1w@reverbnation.com', '$argon2id$v=19$m=65536,t=2,p=1$cftOrvjkGUVBX1Ug5L0/iQ$OLOlAsyzBexru2UxPLhJ4WABoorxYQhmzll9BKyUx7E', '1993-03-27', '48300 Fontanès - 48', 'user', '2024-05-02 02:43:49', '2024-05-02 02:43:49'),
(75, 'Haslett Cashford', 'hcashford1x@china.com.cn', '$argon2id$v=19$m=65536,t=2,p=1$9iO/oT+4GkdwjjDUb1JMGA$SH9hIUNF+7/FBTu61crs3HEJed0GxyQu7uMmCOGwQG4', '1993-02-20', '21190 Auxey-Duresses - 21', 'user', '2024-05-02 02:43:49', '2024-05-02 02:43:49'),
(76, 'Bobette Whelpdale', 'bwhelpdale1y@4shared.com', '$argon2id$v=19$m=65536,t=2,p=1$KyT0Gn1z0n6PS5d4MwLaLg$NyOK8DUj2CgsWE0le7ZN+NAVEeo5jbfnDPD/NWUvqwg', '1978-07-08', '81110 Verdalle - 81', 'user', '2024-05-02 02:43:49', '2024-05-02 02:43:49'),
(77, 'Thedrick Ganny', 'tganny1z@phpbb.com', '$argon2id$v=19$m=65536,t=2,p=1$FAZSL/PhGKrrm4IQ/lWBOg$mJ8GRWGBBHz4J2mOP08WhimC43RnkTw0a+hISzl7huc', '2000-07-16', '32160 Tieste-Uragnoux - 32', 'user', '2024-05-02 02:43:50', '2024-05-02 02:43:50'),
(78, 'Pablo Zanotti', 'pzanotti20@rakuten.co.jp', '$argon2id$v=19$m=65536,t=2,p=1$u250OEapEETpuVRAWfaVGg$Ann2IcxKJiLqAjQ945XCz0a+QfGopyTiDZKMdTWOUak', '2003-11-19', '23800 Sagnat - 23', 'user', '2024-05-02 02:43:50', '2024-05-02 02:43:50'),
(79, 'Teriann Juarez', 'tjuarez21@about.me', '$argon2id$v=19$m=65536,t=2,p=1$n2IQ/ReQ0Um+/7Ix/F36ew$p+P6IzJfkdwh4quLQaDaObu5tLf3k82K76FLdgmTHRY', '1972-09-05', '50660 Trelly - 50', 'user', '2024-05-02 02:43:50', '2024-05-02 02:43:50'),
(80, 'Gertruda Croux', 'gcroux22@miibeian.gov.cn', '$argon2id$v=19$m=65536,t=2,p=1$OVWJqXlQg6IDdF/7ztCPHw$ZmAXEMvT9zVJD0sEz2mZbf1S4we/QsGpwZg5CGHsW9c', '1980-06-18', '55400 Vaux-devant-Damloup - 55', 'user', '2024-05-02 02:43:50', '2024-05-02 02:43:50'),
(81, 'Cesya Maccaig', 'cmaccaig23@nsw.gov.au', '$argon2id$v=19$m=65536,t=2,p=1$rbKN4twWPoptXRqT8ZVs9w$8YVlE7BpVdO+9xXSUljB/DweluCx55PTo961xE1sjYI', '1975-07-10', '91160 Longjumeau - 91', 'user', '2024-05-02 02:43:50', '2024-05-02 02:43:50'),
(82, 'Lorrie Trow', 'ltrow24@msn.com', '$argon2id$v=19$m=65536,t=2,p=1$XepcoeAMIWE/gv3s4p9Vfg$ykvWL+MbdYWifzon1vyqC2xRm8ne2nD/6H9MF5g3260', '2001-05-01', '78410 Bouafle - 78', 'user', '2024-05-02 02:43:50', '2024-05-02 02:43:50'),
(83, 'Kristyn Rontree', 'krontree25@infoseek.co.jp', '$argon2id$v=19$m=65536,t=2,p=1$fb7cu3NYnNTQ5bcy6Z1hYQ$YFkxzfIAw+oAG2rMaX2WObXSqEMVgQ8J95TsT8Fc9Ng', '1969-03-25', '77120 Saints - 77', 'user', '2024-05-02 02:43:50', '2024-05-02 02:43:50'),
(84, 'Ricardo Van der Beek', 'rvan26@mail.ru', '$argon2id$v=19$m=65536,t=2,p=1$eKVyctbJC9ZfbOYitvluqA$1iM69Czs+hjHydaVHK2A0fOrbm2yuvsWvBXX03TdJEM', '1994-07-19', '80490 Bailleul - 80', 'user', '2024-05-02 02:43:50', '2024-05-02 02:43:50'),
(85, 'Bart Ugoni', 'bugoni27@apache.org', '$argon2id$v=19$m=65536,t=2,p=1$AARKd6tvO/4vpZl0akqnMQ$2Y8xrqwFLVxVMSqqG1zGhhLgLNXEbWGcXAikfg2cS0I', '1991-10-17', '54470 Mandres-aux-Quatre-Tours - 54', 'user', '2024-05-02 02:43:50', '2024-05-02 02:43:50'),
(86, 'Hermann Boyda', 'hboyda28@amazonaws.com', '$argon2id$v=19$m=65536,t=2,p=1$PLXJmRBqDX8pAxCZmbK4Hw$d+WnTQtbSYSQ7HlBwmQlaGNTtO46LUuFG4vjcB8HncY', '1979-02-09', '14290 La Folletière-Abenon - 14', 'user', '2024-05-02 02:43:51', '2024-05-02 02:43:51'),
(87, 'Kermie Pretsel', 'kpretsel29@bloomberg.com', '$argon2id$v=19$m=65536,t=2,p=1$s/DP3nWUf3i7BPlV6TZQDQ$boB3CDIHp5JwV8Fgg4zPH66dSm9vrBjpmJ50EM9K0M8', '1970-12-03', '29410 Plounéour-Ménez - 29', 'user', '2024-05-02 02:43:51', '2024-05-02 02:43:51'),
(88, 'Giraud Peltzer', 'gpeltzer2a@archive.org', '$argon2id$v=19$m=65536,t=2,p=1$9/HERwSw5Op0Zj69QIBR6A$DbBF0OcoTSIcAdfI7H1av4E7nRErfglsuJpvNni8oHg', '2002-03-05', '14220 Mutrécy - 14', 'user', '2024-05-02 02:43:51', '2024-05-02 02:43:51'),
(89, 'Aubert Normanvill', 'anormanvill2b@hexun.com', '$argon2id$v=19$m=65536,t=2,p=1$DaS/PL7g0FG3xxqIeaEZGQ$GWjZcRliWzq2dWY1+uCHQKEvzwOpQC8KwH6hrT0SnDM', '1976-06-01', '55100 Sivry-la-Perche - 55', 'user', '2024-05-02 02:43:51', '2024-05-02 02:43:51'),
(90, 'Waiter Govern', 'wgovern2c@sohu.com', '$argon2id$v=19$m=65536,t=2,p=1$swm8WJ2wxKi3qEvCCjXAFw$BIhQhyoXmekp8r4wsdqM6qrF5J9WX1A41HeGIHEkc14', '1996-02-18', '16170 Saint-Cybardeaux - 16', 'user', '2024-05-02 02:43:51', '2024-05-02 02:43:51'),
(91, 'Sonny Motten', 'smotten2d@xing.com', '$argon2id$v=19$m=65536,t=2,p=1$DZFw3MNeITURaxI/9NWpsQ$Geluzi9RN+99SNyBCNnkFKbW40Wqit6yGpePO6dRJCM', '1987-05-16', '89240 Pourrain - 89', 'user', '2024-05-02 02:43:51', '2024-05-02 02:43:51'),
(92, 'Sansone Martinho', 'smartinho2e@cmu.edu', '$argon2id$v=19$m=65536,t=2,p=1$1gIdHBfUokBtn6RCp7GvHA$NjoPqIXoh87jUWypEyDBjlagTKMN4Mg7+vInoEV1OAU', '1968-01-07', '30820 Caveirac - 30', 'user', '2024-05-02 02:43:51', '2024-05-02 02:43:51'),
(93, 'Emanuel Atwool', 'eatwool2f@oaic.gov.au', '$argon2id$v=19$m=65536,t=2,p=1$ZfcmEaLc9qWVgTSf0kqgeg$eduOG8ygIZpqUmMgrZxDEtrvH4hMy3dXCf5oD/0eJug', '1987-08-02', '50200 Cambernon - 50', 'user', '2024-05-02 02:43:51', '2024-05-02 02:43:51'),
(94, 'Valentina Bozier', 'vbozier2g@rediff.com', '$argon2id$v=19$m=65536,t=2,p=1$IP1RhOW+kto740Nw0WMOIw$FMSualvZ626hXRHjuWLquIk1hn72s4Ma0x2V7ai5qbg', '1979-02-08', '35140 Saint-Christophe-de-Valains - 35', 'user', '2024-05-02 02:43:51', '2024-05-02 02:43:51'),
(95, 'De Ripping', 'dripping2h@quantcast.com', '$argon2id$v=19$m=65536,t=2,p=1$a8tiNosRqqxxnOPXHCO4/g$O0XTF0PFS3WLCbUa0LbC1Fdu7jH3tJXKlyTjtqDdl6U', '1994-01-04', '18340 Annoix - 18', 'user', '2024-05-02 02:43:52', '2024-05-02 02:43:52'),
(96, 'Dorisa Cordrey', 'dcordrey2i@house.gov', '$argon2id$v=19$m=65536,t=2,p=1$2pLhpcY1DvocT/7CGp7Ujg$50Yj9JFpcTCcBfSTwd3llyFg8tTj58JjkQBEKmsr8Ek', '1983-09-17', '12640 Rivière-sur-Tarn - 12', 'user', '2024-05-02 02:43:52', '2024-05-02 02:43:52'),
(97, 'Carlin Aires', 'caires2j@nydailynews.com', '$argon2id$v=19$m=65536,t=2,p=1$Jmmp9g/uhbh562JiQvOy0g$Ctc2fAPELAdPAgln0kInFwg/xjuk77rdgLFVxGYnRhQ', '2000-06-08', '64470 Lacarry-Arhan-Charritte-de-Haut - 64', 'user', '2024-05-02 02:43:52', '2024-05-02 02:43:52'),
(98, 'Myer Rosten', 'mrosten2k@columbia.edu', '$argon2id$v=19$m=65536,t=2,p=1$hsPD7LeHCbOfpoD6ym2tHQ$whCHzMOvivj6ZTRCCzzztJwi+12eJtl+Xz3OsbR14/4', '2000-07-30', '33340 Bégadan - 33', 'user', '2024-05-02 02:43:52', '2024-05-02 02:43:52'),
(99, 'Kimbra Prestie', 'kprestie2l@cyberchimps.com', '$argon2id$v=19$m=65536,t=2,p=1$FexgYQHom673HMqr0QHmgA$TqGLZBOFFDqLyMNLTdCj4OOq64/QScLuvsItYBgF9cc', '1979-03-24', '23150 Moutier-d\'Ahun - 23', 'user', '2024-05-02 02:43:52', '2024-05-02 02:43:52'),
(100, 'Aristotle Genese', 'agenese2m@flavors.me', '$argon2id$v=19$m=65536,t=2,p=1$NF0dmiwwtox9XFUzLaAELA$u5P9grbp9QJDFdxn8ymjmy+tlkLwIKw+1WrQoVR/L68', '1966-04-20', '49320 Saint-Sulpice - 49', 'user', '2024-05-02 02:43:52', '2024-05-02 02:43:52'),
(101, 'Lukas Spivie', 'lspivie2n@constantcontact.com', '$argon2id$v=19$m=65536,t=2,p=1$xNMCIfEsmyGhCBFvwRuq5Q$bD64xjHUR6MsJFprV46/xwRo5BrE4TJuA3p8w7RCNY4', '1968-10-13', '62270 Sibiville - 62', 'user', '2024-05-02 02:43:52', '2024-05-02 02:43:52'),
(102, 'Manny Pigford', 'mpigford2o@topsy.com', '$argon2id$v=19$m=65536,t=2,p=1$aYTfAK4gWZofM4irwc6rBw$bmPuAUrUDr/pS8qgMlEP67z0mw0Czkphee2sm45M8i4', '1994-12-22', '50450 La Baleine - 50', 'user', '2024-05-02 02:43:52', '2024-05-02 02:43:52'),
(103, 'Lana Dewick', 'ldewick2p@prnewswire.com', '$argon2id$v=19$m=65536,t=2,p=1$Lr0rJUoJnbHJcIKExO1/BQ$U8S5/2GDNh1pqOFaeqrvaxqKsGUq/820OG5xVT33tlg', '1993-10-23', '22100 Saint-Samson-sur-Rance - 22', 'user', '2024-05-02 02:43:52', '2024-05-02 02:43:52'),
(104, 'Stevana Langthorn', 'slangthorn2q@blog.com', '$argon2id$v=19$m=65536,t=2,p=1$lvmdqYHyHFoEsXlvN5hIPw$kceRfxvOJuELrtdzCFAKBxm5yVZLNdzpnr/uofxpPFo', '1985-06-20', '70130 Le Pont-de-Planches - 70', 'user', '2024-05-02 02:43:53', '2024-05-02 02:43:53'),
(105, 'Alida Morigan', 'amorigan2r@123-reg.co.uk', '$argon2id$v=19$m=65536,t=2,p=1$sX5bF6jQ27zA8bllu+27KQ$z7QIngQ4DFS0xLghZwH3+udBqASAGacgc/h8KompgQs', '1995-10-11', '26160 La Bégude-de-Mazenc - 26', 'user', '2024-05-02 02:43:53', '2024-05-02 02:43:53'),
(106, 'Barbara-anne Banton', 'bbanton2s@ameblo.jp', '$argon2id$v=19$m=65536,t=2,p=1$nkjazF1NGbQapWei+ZlNtQ$j8dlrwrIZa9vEWHJ4sxPW2bR7YAznoMTZQyF0LeWufQ', '1998-10-19', '50200 Heugueville-sur-Sienne - 50', 'user', '2024-05-02 02:43:53', '2024-05-02 02:43:53'),
(107, 'Richmound Harman', 'rharman2t@amazonaws.com', '$argon2id$v=19$m=65536,t=2,p=1$iR6Apwg/+wN5nj1uW6Vecw$ViCfJEqDtQagFo+gr7Jt/TwEnCb3+M72oBZq/Y2vJcg', '1972-05-24', '62610 Autingues - 62', 'user', '2024-05-02 02:43:53', '2024-05-02 02:43:53'),
(108, 'Leland Knaggs', 'lknaggs2u@yelp.com', '$argon2id$v=19$m=65536,t=2,p=1$VkhtDVhkKEKSqk13B6j8bQ$R9Mp+ew9Zg9rXSl3yjJjNFiyhgzxru5b1wtovPEt+wc', '1997-12-23', '88270 Racécourt - 88', 'user', '2024-05-02 02:43:53', '2024-05-02 02:43:53'),
(109, 'Heriberto Straffon', 'hstraffon2v@auda.org.au', '$argon2id$v=19$m=65536,t=2,p=1$Bojh3N7eQam+QCNX8pbBHQ$t9RKNWNeZxliUkdA3cml39Pu9GsdINSD45feLHQoGcw', '1966-11-10', '08430 Chagny - 08', 'user', '2024-05-02 02:43:53', '2024-05-02 02:43:53'),
(110, 'Arabele Ferrarin', 'aferrarin2w@patch.com', '$argon2id$v=19$m=65536,t=2,p=1$I7Npkbvw1sk9tfgkSUBJvg$R0ohq0m91ZrfXcJqy2j6R8xpz93ytFX8Ym+Bp6qzDuA', '1988-02-18', '09000 Celles - 09', 'user', '2024-05-02 02:43:53', '2024-05-02 02:43:53'),
(111, 'Ursuline Cumesky', 'ucumesky2x@geocities.com', '$argon2id$v=19$m=65536,t=2,p=1$k3AZdVNuzJxza+KF6l47ZA$xGkPaUyR4Rl4tHhfV9Pbx59AIVJqDMRUQgjgARXvF6Y', '1988-01-12', '51230 Corroy - 51', 'user', '2024-05-02 02:43:53', '2024-05-02 02:43:53'),
(112, 'Holly Schultz', 'hschultz2y@devhub.com', '$argon2id$v=19$m=65536,t=2,p=1$/dwZ/GvClUnCDh7+tHwDkg$VmUMHMQDEdba4hv/U2MC0iFXMC0lXlGqreFumDU1Xh0', '1998-10-21', '34360 Villespassans - 34', 'user', '2024-05-02 02:43:53', '2024-05-02 02:43:53'),
(113, 'Henri Bertrand', 'hbertrand2z@nih.gov', '$argon2id$v=19$m=65536,t=2,p=1$vk/VOX/R5pI1OcarYEuR/A$gqPlYRYOP/y7OeeAHYTG/+a3pV+NF65woPicurURaNs', '1971-02-18', '80132 Neufmoulin - 80', 'user', '2024-05-02 02:43:54', '2024-05-02 02:43:54'),
(114, 'Goddard McLeish', 'gmcleish30@narod.ru', '$argon2id$v=19$m=65536,t=2,p=1$O0VU9n79VC3V8m0BWBw7UA$g24FI+rzX64iBH5Z9UFCiPE3/VeItzR1eArwWnbZIJE', '1992-12-12', '72300 Sablé-sur-Sarthe - 72', 'user', '2024-05-02 02:43:54', '2024-05-02 02:43:54'),
(115, 'Austine Jakubovicz', 'ajakubovicz31@goo.ne.jp', '$argon2id$v=19$m=65536,t=2,p=1$5Jede5BSsNyNih/4WwwU5Q$IZ5BHSdHwa9fJ5TyBnUSXfL/vLPWh5Y8WMjyn/1/kOw', '1991-05-15', '02300 Bichancourt - 02', 'user', '2024-05-02 02:43:54', '2024-05-02 02:43:54'),
(116, 'Bernarr Ivimey', 'bivimey32@disqus.com', '$argon2id$v=19$m=65536,t=2,p=1$yZ3/zA8p/DotH0jp/jaROA$vVNpcu0h2itAwsyiLbm8c3++rXqM4XtiEvtwxFIQcEg', '1998-11-19', '21310 Bèze - 21', 'user', '2024-05-02 02:43:54', '2024-05-02 02:43:54'),
(117, 'Gloriana Woolmington', 'gwoolmington33@ocn.ne.jp', '$argon2id$v=19$m=65536,t=2,p=1$+8oIPOgYYlu4gXAA9b2//Q$V2ArVscl5T74+b/6cJzQsSuLt67LwsJqQayY0JVysHM', '1982-01-15', '09200 Erp - 09', 'user', '2024-05-02 02:43:54', '2024-05-02 02:43:54'),
(118, 'Murial Galland', 'mgalland34@zimbio.com', '$argon2id$v=19$m=65536,t=2,p=1$+p8FZoaZ9EZqnZGu1nhYTQ$aq5/yiOKE4AZGHUayE4uBntpKmRJDLfB0oR6qxOb8tE', '1995-09-05', '51120 Saudoy - 51', 'user', '2024-05-02 02:43:54', '2024-05-02 02:43:54'),
(119, 'Dolores Siss', 'dsiss35@surveymonkey.com', '$argon2id$v=19$m=65536,t=2,p=1$QXT3M+kTYR3gLXY33Sm1Tg$Uh4te3OKL61ZWpVxdLizp2608WScziSkZEiwHrAFfH0', '1979-11-20', '41370 Concriers - 41', 'user', '2024-05-02 02:43:54', '2024-05-02 02:43:54'),
(120, 'Huey Hanrahan', 'hhanrahan36@sciencedaily.com', '$argon2id$v=19$m=65536,t=2,p=1$4NuQIlHexlhFyYA3Aw8oJg$bJSLJbARoGwEKtJI67dVescC85biUxUtY6kplXE1GvE', '2003-03-08', '76460 Le Mesnil-Durdent - 76', 'user', '2024-05-02 02:43:54', '2024-05-02 02:43:54'),
(121, 'Terri Fodden', 'tfodden37@newsvine.com', '$argon2id$v=19$m=65536,t=2,p=1$zNVbIH4kDUtGXompCz+bAA$EKxTZCWnwxCFTLqzvhsoEKw5p3ODui06udwwMvb3mZw', '2001-08-07', '62123 Bailleulval - 62', 'user', '2024-05-02 02:43:54', '2024-05-02 02:43:54'),
(122, 'Trina Prior', 'tprior38@biblegateway.com', '$argon2id$v=19$m=65536,t=2,p=1$x8f3fbvVLU3nc86WepknUg$+iPD5DungG8fwqKMtOg+2w75CMCD9ubxhN7aZwcxqtQ', '1978-08-31', '47230 Mongaillard - 47', 'user', '2024-05-02 02:43:55', '2024-05-02 02:43:55'),
(123, 'Paulina Lovegrove', 'plovegrove39@utexas.edu', '$argon2id$v=19$m=65536,t=2,p=1$clnsWK72z8WPmjVzer4SGw$EPU6M3yuPX5So00rbw5P2ms3E+7396vNcOas5jNJhN8', '1982-04-07', '43100 Cohade - 43', 'user', '2024-05-02 02:43:55', '2024-05-02 02:43:55'),
(124, 'Rubina Pateman', 'rpateman3a@desdev.cn', '$argon2id$v=19$m=65536,t=2,p=1$vUm/ylc7tX04V/8m2M+DwQ$3wWOLb2GqIS1JyopSD4gtHQC1U4+X6KiDxn8lANIFBI', '1999-08-28', '81160 Saint-Juéry - 81', 'user', '2024-05-02 02:43:55', '2024-05-02 02:43:55'),
(125, 'Averil Hastwell', 'ahastwell3b@pen.io', '$argon2id$v=19$m=65536,t=2,p=1$Ox/6o1r9ijCvojdG41XRmA$tUXU4Xi26Y6LA3sKU1Aqqz2QNTY7+gxRLWMBkTKZPZk', '1991-12-06', '31370 Rieumes - 31', 'user', '2024-05-02 02:43:55', '2024-05-02 02:43:55'),
(126, 'Sully Jeggo', 'sjeggo3c@soundcloud.com', '$argon2id$v=19$m=65536,t=2,p=1$pAmYvB6OwMb25fzu1f8BAA$ymPf7HhUmB7HmqwxfAoVzA6e/ZMslfbGcjvOkA/elpk', '1988-09-23', '43300 Prades - 43', 'user', '2024-05-02 02:43:55', '2024-05-02 02:43:55'),
(127, 'Arlinda Hubbucke', 'ahubbucke3d@msn.com', '$argon2id$v=19$m=65536,t=2,p=1$jsvijIj1djMLbKjSnpCewQ$yFqQGEMi4AgA0yUbtZmJdSN6X9gJe0w27pfmt/j9J/k', '2005-03-26', '85690 Notre-Dame-de-Monts - 85', 'user', '2024-05-02 02:43:55', '2024-05-02 02:43:55'),
(128, 'Georgie Windley', 'gwindley3e@gizmodo.com', '$argon2id$v=19$m=65536,t=2,p=1$opJdK2JV/EPzOp99xK2V2g$yaDMjFYejvb7chr6M3LMR2ABDc83z2ubman3zSXiYWg', '1980-02-06', '29270 Saint-Hernin - 29', 'user', '2024-05-02 02:43:55', '2024-05-02 02:43:55'),
(129, 'Kippar Eacle', 'keacle3f@google.ca', '$argon2id$v=19$m=65536,t=2,p=1$TPNNKFpGfbg3Kj3/EJA4iA$WH/IwCNZSgrH7m7PKoenH3axkZ5DLb6mze32Jf51nfY', '1976-12-28', '79170 Villefollet - 79', 'user', '2024-05-02 02:43:55', '2024-05-02 02:43:55'),
(130, 'Karissa Harrison', 'kharrison3g@storify.com', '$argon2id$v=19$m=65536,t=2,p=1$urTl2z2+lxocp6lghAcsog$IBshQ20awaLyKb9+bROijMHRZk6tqGLzScJFFpHk3WQ', '1997-10-25', '76550 Ambrumesnil - 76', 'user', '2024-05-02 02:43:56', '2024-05-02 02:43:56'),
(131, 'Farley Chiplin', 'fchiplin3h@archive.org', '$argon2id$v=19$m=65536,t=2,p=1$3pfjAyQx1Z94C3uehCjkjg$mVP986Wl0w8sPxwXYekVeQ4yvy9b88JqntcRJKZRJRM', '1974-09-12', '22350 Yvignac-la-Tour - 22', 'user', '2024-05-02 02:43:56', '2024-05-02 02:43:56'),
(132, 'Fran Ivkovic', 'fivkovic3i@wsj.com', '$argon2id$v=19$m=65536,t=2,p=1$eaHnHkfUt35YJhfZXvnsZw$lTMyWmTIKsxPI4tcDd4Ac1942YGxGSYxDvxyoxEWoFs', '1980-09-12', '89290 Vincelles - 89', 'user', '2024-05-02 02:43:56', '2024-05-02 02:43:56'),
(133, 'Stanislaw Hewertson', 'shewertson3j@apache.org', '$argon2id$v=19$m=65536,t=2,p=1$xxbRDaqJkrUXLI4pHJ0a8g$kE7oGAzWwYqri2dTuvWqPXS7NvIsdXfy33kRG1TfDjg', '1972-02-03', '14250 Fontenay-le-Pesnel - 14', 'user', '2024-05-02 02:43:56', '2024-05-02 02:43:56'),
(134, 'Heinrick O\'Fallon', 'hofallon3k@unblog.fr', '$argon2id$v=19$m=65536,t=2,p=1$1563iNx190VC5oqymIl25g$o3XPrpjgWjGmpUAlkJ2d37dvcs/woAFluC2bD3fGsxw', '1973-03-23', '64300 Saint-Girons-en-Béarn - 64', 'user', '2024-05-02 02:43:56', '2024-05-02 02:43:56'),
(135, 'Wood Louisot', 'wlouisot3l@friendfeed.com', '$argon2id$v=19$m=65536,t=2,p=1$BFkSKH2uRAqqIecVieBkDw$9A5F7q2bU4aRphxQ4UxalAuE7ybhMalja2Etps3eMOI', '1991-04-22', '11240 Ferran - 11', 'user', '2024-05-02 02:43:56', '2024-05-02 02:43:56'),
(136, 'Cynthie Hamstead', 'chamstead3m@bbb.org', '$argon2id$v=19$m=65536,t=2,p=1$BFZC3QZ6iOUK14l7EPm0SQ$cuxfISOuyd2vhJZbYf64tQbjjC4OFUh1AXvBL1AiPEU', '1980-09-22', '21360 Bouhey - 21', 'user', '2024-05-02 02:43:56', '2024-05-02 02:43:56'),
(137, 'Hartwell Raecroft', 'hraecroft3n@wsj.com', '$argon2id$v=19$m=65536,t=2,p=1$UOQZT4ikWRmSFw9TjiJbOg$7j4U0hIxsib2RhAzZI/GarTQmkwe6CtIJY+umxtHJ/c', '1975-11-19', '51120 Chichey - 51', 'user', '2024-05-02 02:43:56', '2024-05-02 02:43:56'),
(138, 'Carr Dyett', 'cdyett3o@studiopress.com', '$argon2id$v=19$m=65536,t=2,p=1$0ZOmMT5Nt3nDniba11MY8w$tzUIXn2e5OYmp/oT1N0S+CCaMQD5OdbX6p6TWv/mJhc', '1966-06-28', '14130 Saint-Hymer - 14', 'user', '2024-05-02 02:43:56', '2024-05-02 02:43:56'),
(139, 'Tobit Limbert', 'tlimbert3p@bizjournals.com', '$argon2id$v=19$m=65536,t=2,p=1$kSACGnw4GoLBqGeqMZyrGw$n/t5lKvw/uGABZvnIZuxJCgK09e5k5PG0LKa0n0Z+Rs', '1981-04-09', '67590 Ohlungen - 67', 'user', '2024-05-02 02:43:57', '2024-05-02 02:43:57'),
(140, 'Bibi Wayt', 'bwayt3q@google.it', '$argon2id$v=19$m=65536,t=2,p=1$5xP8SDsA30yYqhhP1QKq7g$F5mFA4oEp2fOLr74t91uP4ePSz2jPx6hG8cZ9BnO7cA', '1988-07-15', '57136 Rimling - 57', 'user', '2024-05-02 02:43:57', '2024-05-02 02:43:57'),
(141, 'Andris Kedie', 'akedie3r@unblog.fr', '$argon2id$v=19$m=65536,t=2,p=1$nAqHLKS8STxPzuk3S5L9lQ$/UhwAfVMH8bChuMdvffZg3XXY0+NfMEJhaccCfpSFog', '1971-05-31', '80150 Lamotte-Buleux - 80', 'user', '2024-05-02 02:43:57', '2024-05-02 02:43:57'),
(142, 'Ania Kuhnel', 'akuhnel3s@examiner.com', '$argon2id$v=19$m=65536,t=2,p=1$pC87OaH59WbWROG3nxXKvA$T6Y8qjqwxH2ZtepakVo8TJbneNAgV8yNQz9zKvEbYhM', '1993-11-24', '18220 Aubinges - 18', 'user', '2024-05-02 02:43:57', '2024-05-02 02:43:57'),
(143, 'Aldwin Rickardes', 'arickardes3t@oaic.gov.au', '$argon2id$v=19$m=65536,t=2,p=1$03w74PvAmAlRfpqbAH3siw$3khUwb7c90QMVsujea89lXubOrAuUn+Cf73w/920yWQ', '1998-08-10', '50220 Céaux - 50', 'user', '2024-05-02 02:43:57', '2024-05-02 02:43:57'),
(144, 'Constantino Fawthorpe', 'cfawthorpe3u@webeden.co.uk', '$argon2id$v=19$m=65536,t=2,p=1$gwv4EU+u8iYYfa2edTQC8Q$gWWz9StRfdvW94wuxj08Gf6bOZ1fdpAPvyaXdevW1C8', '1989-11-27', '70310 La Rosière - 70', 'user', '2024-05-02 02:43:57', '2024-05-02 02:43:57'),
(145, 'Chrisse Proudley', 'cproudley3v@zdnet.com', '$argon2id$v=19$m=65536,t=2,p=1$+iIu2yoPTAM7SHpP+Dpbsw$1pj+pni+GuTgui0yfCot8353N+4Fe2vZsgwe1T9FMog', '1973-11-03', '77580 Pierre-Levée - 77', 'user', '2024-05-02 02:43:57', '2024-05-02 02:43:57'),
(146, 'Elora Kingsnoad', 'ekingsnoad3w@discovery.com', '$argon2id$v=19$m=65536,t=2,p=1$g6lou7nwbVrjx830C80Zaw$1jg2VS0CZ4AgxvN5DoUAudVf+12DajZMCQNuU7wGG+g', '1974-01-06', '17220 Croix-Chapeau - 17', 'user', '2024-05-02 02:43:57', '2024-05-02 02:43:57'),
(147, 'Hunt Joan', 'hjoan3x@facebook.com', '$argon2id$v=19$m=65536,t=2,p=1$sw5qYkeoyWCCJIFHTrFehA$CpHeVvsbk01sLdYTy6frXOh87Q2Vy1+MJHWhJkH5qkY', '1985-03-02', '43300 Chastel - 43', 'user', '2024-05-02 02:43:58', '2024-05-02 02:43:58'),
(148, 'Flynn Clemmensen', 'fclemmensen3y@huffingtonpost.com', '$argon2id$v=19$m=65536,t=2,p=1$okn5agIcOP32dPla0OJdHg$f62eGUV89fk1+QhmBEhMxP/O5MoxNwh9qtrZ6RkccEE', '1967-08-02', '68740 Balgau - 68', 'user', '2024-05-02 02:43:58', '2024-05-02 02:43:58'),
(149, 'Rufus Rickerd', 'rrickerd3z@trellian.com', '$argon2id$v=19$m=65536,t=2,p=1$2uV1TJ8bWrC8RYYT6kFOpQ$Bu/2NOqdpzAViNItsvLGZlwoGugE/UqHxhUDGHHLiuo', '1990-11-02', '53940 Le Genest-Saint-Isle - 53', 'user', '2024-05-02 02:43:58', '2024-05-02 02:43:58'),
(150, 'Estel Finlater', 'efinlater40@bloomberg.com', '$argon2id$v=19$m=65536,t=2,p=1$hL/ZiRNAjT4Tp87M11cAoQ$cNNqwirAhrV5NZsMFMqFoA1sJis8JSk57JiKi4FNgBU', '1984-02-16', '40120 Sarbazan - 40', 'user', '2024-05-02 02:43:58', '2024-05-02 02:43:58'),
(151, 'Querida Tawn', 'qtawn41@hibu.com', '$argon2id$v=19$m=65536,t=2,p=1$tFojro//iScDob59qjfbfQ$RdIul5MEEfA7hNTrfgezuyr9g1U/ht41FgkD8MHiDes', '1994-04-11', '79110 Bouin - 79', 'user', '2024-05-02 02:43:58', '2024-05-02 02:43:58'),
(152, 'Isador Cordell', 'icordell42@over-blog.com', '$argon2id$v=19$m=65536,t=2,p=1$SyM8f//O+XxnPzYTKhFR3w$CDloz2Yfg5DPiVioDTuCA6KmOM8fTr6av1Phtms1dNQ', '1993-05-09', '57590 Fossieux - 57', 'user', '2024-05-02 02:43:58', '2024-05-02 02:43:58'),
(153, 'Jourdain Kleinschmidt', 'jkleinschmidt43@1und1.de', '$argon2id$v=19$m=65536,t=2,p=1$CklRpYu9xKmjS517LCSqSg$SnC2d8JoWLguFwUKVJyfZGduf1cNWipniR+jRZsi6nk', '1991-10-02', '08370 Herbeuval - 08', 'user', '2024-05-02 02:43:58', '2024-05-02 02:43:58'),
(154, 'Say Heaysman', 'sheaysman44@google.cn', '$argon2id$v=19$m=65536,t=2,p=1$e3ZTUG1T8B7guxumh4iR2A$5nTCsgd8jBwy/4hVBUvvNViP7D6CRYEOpiW1gAC4IWM', '1992-07-11', '74520 Chênex - 74', 'user', '2024-05-02 02:43:58', '2024-05-02 02:43:58'),
(155, 'Petronilla Clifford', 'pclifford45@zdnet.com', '$argon2id$v=19$m=65536,t=2,p=1$L/ujQ77+emR0j+kRyBE6NA$INSAwaBD7p5WqEzZAXvE71yTy4S6DksY901s4SKWDsk', '1976-07-13', '59173 Renescure - 59', 'user', '2024-05-02 02:43:58', '2024-05-02 02:43:58'),
(156, 'Julina Pettifor', 'jpettifor46@indiegogo.com', '$argon2id$v=19$m=65536,t=2,p=1$sM3HUhDrsoHRR6/MJJCORA$dC4cCl0f7eNe82TQ8cPzFAgpLwmyHmYl8Z+Hf7ZIm/0', '1967-09-27', '76340 Fallencourt - 76', 'user', '2024-05-02 02:43:59', '2024-05-02 02:43:59'),
(157, 'Demetrius Shulver', 'dshulver47@prlog.org', '$argon2id$v=19$m=65536,t=2,p=1$9PCIHzScKyLOL8Ab/Gk0GA$r4wYM8trhYGhbjLo4cE8NUHx9b3OCaBgFPN7FuNEUFc', '1965-07-19', '50330 Carneville - 50', 'user', '2024-05-02 02:43:59', '2024-05-02 02:43:59'),
(158, 'Sheba Carmont', 'scarmont48@opera.com', '$argon2id$v=19$m=65536,t=2,p=1$8oUziNovKwvRvCA8/8NAxg$/u/nMr3f4DkNMne6FXOEdlymq/7IFk9Gk2SwE37SuWU', '1974-12-18', '30121 Mus - 30', 'user', '2024-05-02 02:43:59', '2024-05-02 02:43:59'),
(159, 'Malcolm Ephgrave', 'mephgrave49@amazon.com', '$argon2id$v=19$m=65536,t=2,p=1$vP8zDokQrasLCBqx580FTQ$dPVKgAYK1G3T1PkbUqCLv1hWwAXe0Gh8+4j/ueqXQQk', '2004-04-25', '70000 Coulevon - 70', 'user', '2024-05-02 02:43:59', '2024-05-02 02:43:59'),
(160, 'Rachele Splain', 'rsplain4a@yellowbook.com', '$argon2id$v=19$m=65536,t=2,p=1$LWoQenvvWi3dV22oqDEGrQ$CduHH0mF6NfgUn9kjwkUm3eGRJg4iRMR9zQGHMAjU3Y', '1966-11-06', '86200 Glénouze - 86', 'user', '2024-05-02 02:43:59', '2024-05-02 02:43:59'),
(161, 'Titus Arnett', 'tarnett4b@google.de', '$argon2id$v=19$m=65536,t=2,p=1$AG2pWFLO29tpjkD333uLfg$9vRFAmAt/YCL02yLISkJwGYsgIXWV0ZWT5/hRmMsJus', '1976-05-02', '01130 Saint-Germain-de-Joux - 01', 'user', '2024-05-02 02:43:59', '2024-05-02 02:43:59'),
(162, 'Beatrice Sleeman', 'bsleeman4c@google.fr', '$argon2id$v=19$m=65536,t=2,p=1$+KxqMYwOYbAXaRHmRSjxiQ$h2Bo3WKKDV1A6QAQLxcq2Cas8XAn9rDGh+asTrFbdRc', '1967-03-08', '80930 Ercheu - 80', 'user', '2024-05-02 02:43:59', '2024-05-02 02:43:59'),
(163, 'Joe Wattins', 'jwattins4d@behance.net', '$argon2id$v=19$m=65536,t=2,p=1$/pB6bPtozfFAwYzoXH94Hg$6AvNARfyDXcWT3xAF2AVLmL6JEv0Pi+b3NOqm0gxsLA', '1979-05-14', '27240 Grandvilliers - 27', 'user', '2024-05-02 02:43:59', '2024-05-02 02:43:59'),
(164, 'Bobbye Ganiford', 'bganiford4e@mediafire.com', '$argon2id$v=19$m=65536,t=2,p=1$aUA5bmuGB4d254qUGbogIQ$P9g/ubx04yKM0+uROuEc6jVbTk7S6fbK06h/5Sj1kXE', '2004-11-05', '23500 Sainte-Feyre-la-Montagne - 23', 'user', '2024-05-02 02:43:59', '2024-05-02 02:43:59'),
(165, 'Belinda Hamilton', 'bhamilton4f@bigcartel.com', '$argon2id$v=19$m=65536,t=2,p=1$TQ32iqyGEvcUEoGsAHnxqA$Gx5L31sD2CeLQyqNUzD1WPghMWO8pt4vWL00t8PrurM', '1987-03-18', '29150 Dinéault - 29', 'user', '2024-05-02 02:43:59', '2024-05-02 02:43:59'),
(166, 'Glori Delepine', 'gdelepine4g@google.co.jp', '$argon2id$v=19$m=65536,t=2,p=1$9le8yTciDNAxbZW1KQadAw$YXGlVVyYhDEK/yC4cNMVxSLz7a/U0MuxeGwOpo1AHsE', '1970-07-11', '88450 Bettegney-Saint-Brice - 88', 'user', '2024-05-02 02:44:00', '2024-05-02 02:44:00'),
(167, 'Adair Tchaikovsky', 'atchaikovsky4h@wired.com', '$argon2id$v=19$m=65536,t=2,p=1$cJoZVam6AHm6g7fDuw8QAg$ra5+xNjHj5VncYdguE2MD6TBaDjNgiTTp4ZSuKmkBGo', '1998-11-24', '59134 Herlies - 59', 'user', '2024-05-02 02:44:00', '2024-05-02 02:44:00'),
(168, 'Gennie Andrelli', 'gandrelli4i@google.pl', '$argon2id$v=19$m=65536,t=2,p=1$XEArLZBlMat3pJUspp48Fw$2Eh56Lh7pw7QkRe8vfc4NkD6M0xNtL+VUzWlsZuHSFE', '1971-12-16', '80260 La Vicogne - 80', 'user', '2024-05-02 02:44:00', '2024-05-02 02:44:00'),
(169, 'Clarisse Sheekey', 'csheekey4j@uiuc.edu', '$argon2id$v=19$m=65536,t=2,p=1$wUMRO8RLYAuXz/8ALaIYWA$Vcp1A7CBFnJTD9NW25l0E47gHgFEBsTyV3Y3vYoP+X0', '1989-03-27', '89330 Piffonds - 89', 'user', '2024-05-02 02:44:00', '2024-05-02 02:44:00'),
(170, 'Camile Anfusso', 'canfusso4k@ifeng.com', '$argon2id$v=19$m=65536,t=2,p=1$+POjq7+XawnHQ4+HMVzaUA$hSsJtsO6HqSk2XtIS9dATj/ofimnEXkCC4ZGD/2bBt0', '1975-06-28', '49320 Saint-Jean-des-Mauvrets - 49', 'user', '2024-05-02 02:44:00', '2024-05-02 02:44:00'),
(171, 'Reggie Alstead', 'ralstead4l@accuweather.com', '$argon2id$v=19$m=65536,t=2,p=1$KO3sBYB28Y0Z6Hz2Gw9C7w$z8TreKbp369MEdkxfHwiDw+CFbmm71PXyHGnCzB8fSw', '1985-09-26', '74420 Saint-André-de-Boëge - 74', 'user', '2024-05-02 02:44:00', '2024-05-02 02:44:00'),
(172, 'Alvie Matyasik', 'amatyasik4m@google.com.au', '$argon2id$v=19$m=65536,t=2,p=1$D99It1BpeVX1BQxOk3N9hw$i82riha2YshTKsdAEushoEZmRT+Y064A0MxmInRy4bk', '2004-04-08', '03150 Créchy - 03', 'user', '2024-05-02 02:44:00', '2024-05-02 02:44:00'),
(173, 'Gram Strand', 'gstrand4n@dagondesign.com', '$argon2id$v=19$m=65536,t=2,p=1$ToCq/LfC2cIh1EfCX6GHug$fQLQtHM4YZWHx2ZZjkA54X9+LPtl7+VwmbTBUwgFqqc', '1986-12-10', '80370 Montigny-les-Jongleurs - 80', 'user', '2024-05-02 02:44:00', '2024-05-02 02:44:00'),
(174, 'Arnaldo Stranahan', 'astranahan4o@google.co.uk', '$argon2id$v=19$m=65536,t=2,p=1$uCf2I6DEYB23uPYbEts85g$BgLWoc/0N/9VXCK/y8qqwyDX8Gcsnwo/aEb4NuIy/1s', '1972-08-05', '26110 Curnier - 26', 'user', '2024-05-02 02:44:00', '2024-05-02 02:44:00'),
(175, 'Ruttger Shuxsmith', 'rshuxsmith4p@businessinsider.com', '$argon2id$v=19$m=65536,t=2,p=1$ppbMVdP5xrb4ksuzPN3p6A$F401aij1T501vfmV7z6aAf1IZDL/in44g/tNLNqnyZ8', '1974-05-14', '54610 Bratte - 54', 'user', '2024-05-02 02:44:01', '2024-05-02 02:44:01'),
(176, 'Carie Ciobutaru', 'cciobutaru4q@amazon.co.uk', '$argon2id$v=19$m=65536,t=2,p=1$VM24o1PXDNikuCh6d70v5A$vUv9Z2WT1+58RfNdveAFuWiNSajN8qx+G2n48HsRBGk', '1972-10-06', '87160 Grands-Chézeaux - 87', 'user', '2024-05-02 02:44:01', '2024-05-02 02:44:01'),
(177, 'Wald Romao', 'wromao4r@studiopress.com', '$argon2id$v=19$m=65536,t=2,p=1$67tSGgKS0/+nB5o0YVTegA$5XxVhjexr+TULiAZJ/7EptAEnnN/ou8DHzAfG9VWBc8', '1971-06-25', '28310 Neuvy-en-Beauce - 28', 'user', '2024-05-02 02:44:01', '2024-05-02 02:44:01'),
(178, 'Josephina Wisdom', 'jwisdom4s@angelfire.com', '$argon2id$v=19$m=65536,t=2,p=1$87nEONgERfKRTiqw96MLCA$x2bArT8LhUe9ixcFD4q0jzuehC5R5+5jfSlOF5qQKV0', '1970-05-08', '59112 Annœullin - 59', 'user', '2024-05-02 02:44:01', '2024-05-02 02:44:01'),
(179, 'Torr Skotcher', 'tskotcher4t@wordpress.org', '$argon2id$v=19$m=65536,t=2,p=1$DbW24FG4IxHWyht+2gtJFg$b6W/jy21AaO+r3zawCztsWgvJT1PsV2kG1lZRPjM+G4', '2004-04-05', '30200 Saint-Laurent-de-Carnols - 30', 'user', '2024-05-02 02:44:01', '2024-05-02 02:44:01'),
(180, 'Alex Wainman', 'awainman4u@sourceforge.net', '$argon2id$v=19$m=65536,t=2,p=1$SWQnYDZcH/qpgmPTYnJ71Q$ipwiLVDPDSHCQSE1IpK+wXwk1vKg3Nd4dk6XbGKgxds', '1974-03-14', '13680 Lançon-Provence - 13', 'user', '2024-05-02 02:44:01', '2024-05-02 02:44:01'),
(181, 'Wilhelmina Hains', 'whains4v@vk.com', '$argon2id$v=19$m=65536,t=2,p=1$ku67SO5fx9KkCv4dwMqnHw$mp9ZK6ENwnYZw5rr8OR/ulrrYHEXCsBPpj5MTVqerlE', '2004-11-27', '60220 Boutavent - 60', 'user', '2024-05-02 02:44:01', '2024-05-02 02:44:01'),
(182, 'Tyrone Scalia', 'tscalia4w@accuweather.com', '$argon2id$v=19$m=65536,t=2,p=1$UxBzXVfHn8qtISHoncy8qA$qyxLWKzdgNDtpHHHUvpL1hY7IqkKbV4/QlpGwSxVNkI', '1974-10-02', '51200 Chavot-Courcourt - 51', 'user', '2024-05-02 02:44:01', '2024-05-02 02:44:01'),
(183, 'Verene Simenel', 'vsimenel4x@bloomberg.com', '$argon2id$v=19$m=65536,t=2,p=1$CC3po0JsXGx5msHCByxHDA$hIU3TNpk2jkZjXtarIFVgozxRv33uWzmv+njGwOgsss', '1996-07-23', '57070 Vany - 57', 'user', '2024-05-02 02:44:01', '2024-05-02 02:44:01'),
(184, 'Nelie Dellenbroker', 'ndellenbroker4y@home.pl', '$argon2id$v=19$m=65536,t=2,p=1$hmRrO//vbZtfELK7sUCaBA$+qz9eWaAIGIzLNABrM6bxi5vYzi2OF4UA+ZhnpSoDdE', '1965-12-09', '77400 Saint-Thibault-des-Vignes - 77', 'user', '2024-05-02 02:44:02', '2024-05-02 02:44:02'),
(185, 'Bobina Genicke', 'bgenicke4z@comcast.net', '$argon2id$v=19$m=65536,t=2,p=1$cYHp/onASxPIwzP58yybmQ$O7qPpIobIvApnaDf3NSBGBh7abL9qpAAeuBItR3TiBg', '1972-12-24', '77127 Lieusaint - 77', 'user', '2024-05-02 02:44:02', '2024-05-02 02:44:02'),
(186, 'Carly Thorp', 'cthorp50@ezinearticles.com', '$argon2id$v=19$m=65536,t=2,p=1$UBktMpz7dbyZSc92tXgD4w$L2UL09YilkgDFpnpxbk2d0r3qi8DucZENmaNE9yQ0QU', '1984-11-06', '86480 Rouillé - 86', 'user', '2024-05-02 02:44:02', '2024-05-02 02:44:02'),
(187, 'Stillmann Falcus', 'sfalcus51@1688.com', '$argon2id$v=19$m=65536,t=2,p=1$44LmkrFiV3UWTm6WE0cblQ$5nmB2iAkZiai5jvxoNWbjza93ob13+m89vZE+dA3Dpo', '1999-07-30', '89460 Bazarnes - 89', 'user', '2024-05-02 02:44:02', '2024-05-02 02:44:02'),
(188, 'Phillis Potteridge', 'ppotteridge52@wiley.com', '$argon2id$v=19$m=65536,t=2,p=1$sEkG3eH0CsbfSVCgce2Opw$rcgJVIceFQJRJTk18l3UxrsmRlZrsWifbJNbMgohaZg', '1984-03-01', '97640 Sada - 976', 'user', '2024-05-02 02:44:02', '2024-05-02 02:44:02'),
(189, 'Nikola Bunney', 'nbunney53@google.de', '$argon2id$v=19$m=65536,t=2,p=1$8EKxJ04i9Qjo8/5OJqAOtg$tRhE5fsL5ERhCcrCwnj0X5uhmUq1rs+wG4BPtJkGQSE', '1971-11-20', '40180 Tercis-les-Bains - 40', 'user', '2024-05-02 02:44:02', '2024-05-02 02:44:02'),
(190, 'Barbra Bosquet', 'bbosquet54@nytimes.com', '$argon2id$v=19$m=65536,t=2,p=1$1rWDwU+R0Na/bFwjq0pReA$rWuSPxpZL4Vi3cx7hL/pcQweRv3cBqmacIJxaunP414', '1987-12-23', '90500 Montbouton - 90', 'user', '2024-05-02 02:44:02', '2024-05-02 02:44:02'),
(191, 'Keriann Kleinstub', 'kkleinstub55@angelfire.com', '$argon2id$v=19$m=65536,t=2,p=1$CDH3qta2GcIPQSe5fJlHiw$JuNgW/8RU0X+iwbLeGB2UW4VbPAspUWqAb4dY17fHp0', '1972-02-26', '46190 Teyssieu - 46', 'user', '2024-05-02 02:44:02', '2024-05-02 02:44:02'),
(192, 'Lonnard Heifer', 'lheifer56@angelfire.com', '$argon2id$v=19$m=65536,t=2,p=1$m2Yyhe/aMJqe3dWOEDHWHA$yY+ldGRGPfG4hGITxHDcL5ZrsRPM+lcLOsjVMAIjtQQ', '1980-11-12', '38740 Chantelouve - 38', 'user', '2024-05-02 02:44:02', '2024-05-02 02:44:02'),
(193, 'Gearard Baptista', 'gbaptista57@mac.com', '$argon2id$v=19$m=65536,t=2,p=1$y5OwcumyXVKcOpKXSfYlcg$3Sg4lKZidqb5fEfFdvUlo91yO4ClBDSf3f5rFtgWdD8', '1996-08-11', '37460 Genillé - 37', 'user', '2024-05-02 02:44:03', '2024-05-02 02:44:03'),
(194, 'Cordey Hruska', 'chruska58@umn.edu', '$argon2id$v=19$m=65536,t=2,p=1$dNsCt9ko0IPReWF4R8PRwA$0x57iEopUADPvjIyO4Kn2NywrUvboQwGmrCaWoAPktQ', '1970-08-18', '45300 Boynes - 45', 'user', '2024-05-02 02:44:03', '2024-05-02 02:44:03'),
(195, 'Fredra Margeram', 'fmargeram59@bloomberg.com', '$argon2id$v=19$m=65536,t=2,p=1$aLCZCSPYbpMWC1Io2rnzGg$tTxZJsAt86Nowt3TgtB166PHwbFvxtoIUhpyd1MYOys', '1984-01-23', '83560 Esparron - 83', 'user', '2024-05-02 02:44:03', '2024-05-02 02:44:03'),
(196, 'Benson Gorrick', 'bgorrick5a@cmu.edu', '$argon2id$v=19$m=65536,t=2,p=1$LUpLBB7KJXLDc14GEub9PA$rM+dpe7bGZR2+bYD2GgU32CokMREaDF22I8wST5Y460', '1977-04-16', '52200 Mardor - 52', 'user', '2024-05-02 02:44:03', '2024-05-02 02:44:03'),
(197, 'Lind Gaylor', 'lgaylor5b@cnet.com', '$argon2id$v=19$m=65536,t=2,p=1$YXhVHElIXnXCyssSKd3Vcw$bbx67pqBbh3qE2U5XH0lxT592Z2WjcYCLfm5el5kZ1M', '1996-07-07', '73360 Échelles - 73', 'user', '2024-05-02 02:44:03', '2024-05-02 02:44:03'),
(198, 'Adrienne Trahmel', 'atrahmel5c@tripod.com', '$argon2id$v=19$m=65536,t=2,p=1$Xesjuau7P6t7KpcabI5OWg$Iv6YYXyo1V5IHpeyke+xfqEHuzbP3TCM1fDGalhqgFc', '1993-09-18', '40190 Hontanx - 40', 'user', '2024-05-02 02:44:03', '2024-05-02 02:44:03'),
(199, 'Nadya Morriarty', 'nmorriarty5d@sohu.com', '$argon2id$v=19$m=65536,t=2,p=1$OaSP2qGhf/02DieRp5vhuQ$i6wxuTxzntFC0pd3OroMuFnzz6RWtVXaTTGlHsM6L8g', '1968-12-28', '64350 Arrosès - 64', 'user', '2024-05-02 02:44:03', '2024-05-02 02:44:03'),
(200, 'Rab Blomefield', 'rblomefield5e@wikia.com', '$argon2id$v=19$m=65536,t=2,p=1$sw/J2eanjU4xwqWBK8EW2g$7+IbURmC3crcWgC3ddgvyxF4KBrABGdmQVeQHU4S0D8', '1968-10-09', '66690 Saint-André - 66', 'user', '2024-05-02 02:44:03', '2024-05-02 02:44:03'),
(201, 'Rodrique Hiseman', 'rhiseman5f@unblog.fr', '$argon2id$v=19$m=65536,t=2,p=1$4lYmBo+7M0YkXLswSWUCbA$IHMLI/PWtjpaQ7l4g/alSyI7Lp/WK/2Y6Far0nvsAMk', '1971-12-23', '81320 Murat-sur-Vèbre - 81', 'user', '2024-05-02 02:44:03', '2024-05-02 02:44:03'),
(202, 'Thibaud Abrahami', 'tabrahami5g@ebay.com', '$argon2id$v=19$m=65536,t=2,p=1$MYIE3PfXb76p7AnN5PJdug$bhw3uHMKMZyo9/N6EfJptXf6AhqBBqDlzkTCoI/hQeM', '1980-07-22', '21330 Larrey - 21', 'user', '2024-05-02 02:44:04', '2024-05-02 02:44:04'),
(203, 'Dionis Gibbens', 'dgibbens5h@dailymotion.com', '$argon2id$v=19$m=65536,t=2,p=1$N91XWE/U5MoI2G80WR7rTw$gbwJlRCvSLqUdsw+7IOsoUIGzj5oNxpM+eQ1g/r/0J0', '1997-04-23', '37160 Civray-sur-Esves - 37', 'user', '2024-05-02 02:44:04', '2024-05-02 02:44:04'),
(204, 'Bary Brehat', 'bbrehat5i@mozilla.org', '$argon2id$v=19$m=65536,t=2,p=1$88Ev3qQgQ3+gdIARD53l9A$HMZkKXxwxrvOt0NuliI5n6KAR/pWycn08wbJWTffOxQ', '1970-03-01', '30120 Bez-et-Esparon - 30', 'user', '2024-05-02 02:44:04', '2024-05-02 02:44:04');
INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `birthday`, `adress`, `role`, `created_at`, `updated_at`) VALUES
(205, 'Hannah Lord', 'hlord5j@hatena.ne.jp', '$argon2id$v=19$m=65536,t=2,p=1$WpM14STz5JaEUOWmyDnozQ$S3WRVA+mZmicoHD9uNAR7vx/XBFVmJj4m2M4xjLPNWk', '1972-11-18', '87190 Droux - 87', 'user', '2024-05-02 02:44:04', '2024-05-02 02:44:04'),
(206, 'testutilisateurs', 'testutilisateurs@gmail.fr', '$argon2id$v=19$m=65536,t=2,p=1$ASsa7bf6bxUu4pXMPK8eOQ$4qAR62OPdLmSJDymveoKE2CPKTOwtB/UQ4j1x8AV8so', NULL, NULL, 'user', '2024-05-06 11:58:09', '2024-05-06 11:58:09');

-- --------------------------------------------------------

--
-- Table structure for table `usersavatars`
--

CREATE TABLE `usersavatars` (
  `users_id` int NOT NULL,
  `avatars_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_has_products`
--

CREATE TABLE `users_has_products` (
  `users_id` int NOT NULL,
  `products_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_has_products`
--

INSERT INTO `users_has_products` (`users_id`, `products_id`) VALUES
(1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charac`
--
ALTER TABLE `charac`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comments_users1_idx` (`users_id`),
  ADD KEY `fk_comments_products1_idx` (`products_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_users1_idx` (`users_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_product_UNIQUE` (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `fk_products_category1_idx` (`category_id`),
  ADD KEY `fk_products_sub_category1_idx` (`sub_category_id`);

--
-- Indexes for table `productscharac`
--
ALTER TABLE `productscharac`
  ADD KEY `fk_productsCharac_charac1_idx` (`charac_id`),
  ADD KEY `fk_productsCharac_products1_idx` (`products_id`);

--
-- Indexes for table `productsimages`
--
ALTER TABLE `productsimages`
  ADD PRIMARY KEY (`products_id`),
  ADD KEY `fk_ProductsImages_images1_idx` (`images_id`);

--
-- Indexes for table `productsorders`
--
ALTER TABLE `productsorders`
  ADD KEY `fk_ProductsOrders_orders1_idx` (`orders_id`),
  ADD KEY `fk_ProductsOrders_products1_idx` (`products_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ratings_products1_idx` (`products_id`),
  ADD KEY `fk_ratings_users1_idx` (`users_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sub_category_category1_idx` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `usersavatars`
--
ALTER TABLE `usersavatars`
  ADD KEY `fk_UsersAvatars_users1_idx` (`users_id`),
  ADD KEY `fk_UsersAvatars_avatars1_idx` (`avatars_id`);

--
-- Indexes for table `users_has_products`
--
ALTER TABLE `users_has_products`
  ADD PRIMARY KEY (`users_id`,`products_id`),
  ADD KEY `fk_users_has_products_products1` (`products_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avatars`
--
ALTER TABLE `avatars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `charac`
--
ALTER TABLE `charac`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=504;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_products1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_comments_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `fk_products_sub_category1` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`id`);

--
-- Constraints for table `productscharac`
--
ALTER TABLE `productscharac`
  ADD CONSTRAINT `fk_productsCharac_charac1` FOREIGN KEY (`charac_id`) REFERENCES `charac` (`id`),
  ADD CONSTRAINT `fk_productsCharac_products1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `productsimages`
--
ALTER TABLE `productsimages`
  ADD CONSTRAINT `fk_ProductsImages_images1` FOREIGN KEY (`images_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `fk_ProductsImages_products1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `productsorders`
--
ALTER TABLE `productsorders`
  ADD CONSTRAINT `fk_ProductsOrders_orders1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `fk_ProductsOrders_products1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `fk_ratings_products1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_ratings_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `fk_sub_category_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `usersavatars`
--
ALTER TABLE `usersavatars`
  ADD CONSTRAINT `fk_UsersAvatars_avatars1` FOREIGN KEY (`avatars_id`) REFERENCES `avatars` (`id`),
  ADD CONSTRAINT `fk_UsersAvatars_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users_has_products`
--
ALTER TABLE `users_has_products`
  ADD CONSTRAINT `fk_users_has_products_products1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_users_has_products_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
