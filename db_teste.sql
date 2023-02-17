-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 17, 2023 at 09:50 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_teste`
--

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` bigint(11) UNSIGNED ZEROFILL NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissao` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_criacao` datetime NOT NULL,
  `data_atualizacao` datetime NOT NULL,
  `status` int NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `uuid`, `nome`, `cpf`, `email`, `senha`, `permissao`, `data_criacao`, `data_atualizacao`, `status`, `img`) VALUES
(1, '1', 'Melqui Vunge', 25449112807, 'melquilegend@gmail.com', '$2y$10$hXUTGbgqPVxU3l33HugH3.VcFRqLswNFkfkkX3SV//vXC4pgeiJkm', '3,2,1,0', '2023-02-16 16:54:44', '2023-02-16 16:54:44', 1, 'okeniom_22.png'),
(2, '2', 'Maria', 27755943364, 'maria@gmail.com', '$2y$10$cB6pX/o0B40PXSu/Gehmveq157MK4sg6dsaiRsZhX6UVloApPnXom', '3', '2023-02-16 18:25:05', '2023-02-17 03:32:02', 1, 'oke.png'),
(14, '', 'Amanda Ornelas', 33936643016, 'amanda@gmail.com', '$2y$10$RAmW.d2GBDrMh/K8iKAixewoOh6P8SrvgEnGtNdz7nG8nKjAJ5aNu', '3', '2023-02-17 05:03:31', '2023-02-17 06:16:08', 1, 'okenio_inevitavel.jpeg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
