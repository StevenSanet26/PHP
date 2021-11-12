-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql-server
-- Temps de generació: 26-05-2021 a les 10:41:16
-- Versió del servidor: 8.0.19
-- Versió de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `todo-list`
--
CREATE DATABASE IF NOT EXISTS `todo-list` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `todo-list`;

-- --------------------------------------------------------

--
-- Estructura de la taula `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Bolcament de dades per a la taula `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Estudis'),
(2, 'Treball'),
(3, 'Relacions socia'),
(4, 'Familia'),
(5, 'Esports');

-- --------------------------------------------------------

--
-- Estructura de la taula `todo`
--

CREATE TABLE `task` (
  `id` int NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `description` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `due_date` datetime DEFAULT NULL,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Bolcament de dades per a la taula `todo`
--

INSERT INTO `task` (`id`, `title`, `description`, `due_date`, `category_id`) VALUES
(1, 'Estudiar PHP', 'Cal preparar el projecte final.', '2021-05-19 12:37:22', 1),
(2, 'Regal Josep', 'He de quedar en Juli per vore què li comprem a Josep', '2021-05-31 12:37:22', 3),
(3, 'Control bases de dades', ' cal repasar les activitat de DML.', '2021-05-25 12:37:22', 1),
(4, 'Control de programació', 'Revisar la part pràtica per al control', '2021-05-31 12:37:22', 1);

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `todo`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_category` (`category_id`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la taula `todo`
--
ALTER TABLE `task`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `todo`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_cat_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
