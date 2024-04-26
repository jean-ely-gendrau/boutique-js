-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 26, 2024 at 12:54 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'Thé', 'Différents types de thés'),
(2, 'Café', 'Différents grains de café et mélanges');

-- --------------------------------------------------------

--
-- Table structure for table `charac`
--

CREATE TABLE `charac` (
  `id` int NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `type` enum('kg','g','m','cm','country','color','amper','kelvin','wats','volts','celsius','ohm','byte','gigabyte','megabyte','m2','dolar','eu','livre','cal','kmh','day','week','year','month','hertz','percent','pixel','decibel','l','cl','ml') COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `charac`
--

INSERT INTO `charac` (`id`, `name`, `type`) VALUES
(1, 'Poids', 'kg'),
(2, 'Longueur', 'cm');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `comment` text COLLATE utf8mb4_general_ci,
  `users_id` int NOT NULL,
  `products_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `users_id`, `products_id`) VALUES
(1, 'Excellent thé!', 1, 1),
(2, 'J\'adore la saveur!', 2, 2),
(3, 'Espresso doux', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `image_main` tinyint DEFAULT NULL,
  `url_image` text COLLATE utf8mb4_general_ci,
  `products_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image_main`, `url_image`, `products_id`) VALUES
(1, 1, 'the_vert.png', 1),
(2, 1, 'the_noir.png', 2),
(3, 1, 'cafe_faible.png', 3),
(4, 1, 'cafe_fort.png', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `id_product` int DEFAULT NULL,
  `basket` tinyint(1) DEFAULT NULL,
  `status` enum('en attente','expedier','livrer','echec') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `users_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='		';

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `id_product`, `basket`, `status`, `created_at`, `updated_at`, `users_id`) VALUES
(1, 1, 1, 'en attente', '2024-04-26 14:48:01', '2024-04-26 14:48:01', 1),
(2, 3, 0, 'expedier', '2024-04-26 14:48:01', '2024-04-26 14:48:01', 2),
(3, 2, 1, 'livrer', '2024-04-26 14:48:01', '2024-04-26 14:48:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `productorder`
--

CREATE TABLE `productorder` (
  `products_id` int UNSIGNED NOT NULL,
  `orders_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productorder`
--

INSERT INTO `productorder` (`products_id`, `orders_id`) VALUES
(1, 1),
(3, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `price` float DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_id` int NOT NULL,
  `sub_category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity`, `created_at`, `updated_at`, `category_id`, `sub_category_id`) VALUES
(1, 'Thé au jasmin', 'Thé vert parfumé aux fleurs de jasmin', 5.99, 100, '2024-04-26 14:26:39', '2024-04-26 14:26:39', 1, 1),
(2, 'Thé Earl Grey', 'Thé noir aromatisé à l\'huile d\'orange bergamote', 4.99, 150, '2024-04-26 14:26:39', '2024-04-26 14:26:39', 1, 2),
(3, 'Grains d\'espresso', 'Grains d\'espresso torréfiés foncés avec une saveur riche', 9.99, 50, '2024-04-26 14:26:39', '2024-04-26 14:26:39', 2, 3),
(4, 'Café fort', 'Un café fort', 4.99, 100, '2024-04-26 14:26:39', '2024-04-26 14:37:30', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `productscharac`
--

CREATE TABLE `productscharac` (
  `value` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `products_id` int UNSIGNED NOT NULL,
  `charac_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productscharac`
--

INSERT INTO `productscharac` (`value`, `products_id`, `charac_id`) VALUES
('500', 1, 1),
('30', 1, 2),
('250', 2, 1),
('15', 2, 2);

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
(3, 3, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `description`, `category_id`) VALUES
(1, 'Thé vert', 'Thé non oxydé', 1),
(2, 'Thé noir', 'Thé entièrement oxydé', 1),
(3, 'Cafe faible', 'Café faible en caffeine', 2),
(4, 'Cafe Fort', 'Cafe Fort en cafféine', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `full_name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `adress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role` enum('user','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `birthday`, `adress`, `role`, `created_at`, `updated_at`) VALUES
(0, 'Jean-Ely', 'jean-ely.gendrau@laplateforme.io', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1990-04-15', '83000 Toulon', 'admin', '2024-04-26 14:46:20', '2024-04-26 14:46:20'),
(1, 'Esteban', 'esteban.bare@laplateforme.io', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1990-04-15', '83000 Toulon', 'admin', '2024-04-26 14:46:20', '2024-04-26 14:46:20'),
(2, 'Alexandre', 'alexandre.detroy@laplateforme.io', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1990-04-15', '83000 Toulon', 'admin', '2024-04-26 14:46:20', '2024-04-26 14:46:20'),
(3, 'Jean-Philippe', 'jean-philippe.douzou@laplateforme.io', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1990-04-15', '83000 Toulon', 'admin', '2024-04-26 14:46:20', '2024-04-26 14:46:20'),
(4, 'Angel', 'angel.putz@laplateforme.io', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1990-04-15', '83000 Toulon', 'admin', '2024-04-26 14:46:20', '2024-04-26 14:46:20'),
(5, 'Alice Smith', 'alice@example.com', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1990-04-15', '75001 Paris', 'user', '2024-04-26 14:46:20', '2024-04-26 14:46:20'),
(6, 'Bob Johnson', 'bob@example.com', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1985-09-20', '69001 Lyon', 'user', '2024-04-26 14:46:20', '2024-04-26 14:46:20'),
(7, 'Charlie Brown', 'charlie@example.com', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1988-12-10', '33000 Bordeaux', 'user', '2024-04-26 14:46:20', '2024-04-26 14:46:20'),
(8, 'Diana Miller', 'diana@example.com', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1983-06-25', '13001 Marseille', 'user', '2024-04-26 14:46:20', '2024-04-26 14:46:20'),
(9, 'Ethan Davis', 'ethan@example.com', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1992-03-08', '67000 Strasbourg', 'user', '2024-04-26 14:46:20', '2024-04-26 14:46:20'),
(10, 'Fiona Clark', 'fiona@example.com', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1987-11-03', '59000 Lille', 'user', '2024-04-26 14:46:20', '2024-04-26 14:46:20'),
(11, 'George Evans', 'george@example.com', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1984-08-17', '21000 Dijon', 'user', '2024-04-26 14:46:20', '2024-04-26 14:46:20'),
(12, 'Hannah Brown', 'hannah@example.com', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1991-05-29', '35000 Rennes', 'user', '2024-04-26 14:46:20', '2024-04-26 14:46:20'),
(13, 'Ian Wilson', 'ian@example.com', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1986-02-14', '44000 Nantes', 'user', '2024-04-26 14:46:20', '2024-04-26 14:46:20'),
(14, 'Julia Martinez', 'julia@example.com', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1982-09-07', '67000 Strasbourg', 'user', '2024-04-26 14:46:20', '2024-04-26 14:46:20'),
(15, 'Kevin Garcia', 'kevin@example.com', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1989-06-18', '13001 Marseille', 'user', '2024-04-26 14:46:20', '2024-04-26 14:46:20'),
(16, 'Linda Taylor', 'linda@example.com', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1983-03-22', '21000 Dijon', 'user', '2024-04-26 14:46:20', '2024-04-26 14:46:20'),
(17, 'Michael Lee', 'michael@example.com', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1990-12-05', '59000 Lille', 'user', '2024-04-26 14:46:20', '2024-04-26 14:46:20'),
(18, 'Natalie Harris', 'natalie@example.com', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1987-07-28', '35000 Rennes', 'user', '2024-04-26 14:46:20', '2024-04-26 14:46:20'),
(19, 'Oliver Clark', 'oliver@example.com', '$argon2id$v=19$m=65536,t=2,p=1$oWIfdaXwWwhVmovOBc2NAQ$EbsZ+JnZyyavkafS0hoc4HdaOB0ILWZESAZ7kVGa+Iw', '1985-04-14', '44000 Nantes', 'user', '2024-04-26 14:46:20', '2024-04-26 14:46:20');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_images_products1_idx` (`products_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_users1_idx` (`users_id`);

--
-- Indexes for table `productorder`
--
ALTER TABLE `productorder`
  ADD KEY `fk_ProductOrder_products1_idx` (`products_id`),
  ADD KEY `fk_ProductOrder_orders1_idx` (`orders_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_product_UNIQUE` (`id`),
  ADD KEY `fk_products_category1_idx` (`category_id`),
  ADD KEY `fk_products_sub_category1_idx` (`sub_category_id`);

--
-- Indexes for table `productscharac`
--
ALTER TABLE `productscharac`
  ADD KEY `fk_productsCharac_products1_idx` (`products_id`),
  ADD KEY `fk_productsCharac_charac1_idx` (`charac_id`);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `charac`
--
ALTER TABLE `charac`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_images_products1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `productorder`
--
ALTER TABLE `productorder`
  ADD CONSTRAINT `fk_ProductOrder_orders1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `fk_ProductOrder_products1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
