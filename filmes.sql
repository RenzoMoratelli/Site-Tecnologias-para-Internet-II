-- XAMPP-Lite
-- version 8.4.6
-- https://xampplite.sf.net/
--
-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2025 at 12:02 AM
-- Server version: 11.4.5-MariaDB-log
-- PHP Version: 8.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `renzo`
--

-- --------------------------------------------------------

--
-- Table structure for table `filmes`
--

CREATE TABLE `filmes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `ano` varchar(4) NOT NULL,
  `genero` int(2) NOT NULL,
  `descricao` varchar(500) NOT NULL
) ;

--
-- Dumping data for table `filmes`
--

INSERT INTO `filmes` (`id`, `nome`, `ano`, `genero`, `descricao`) VALUES
(1, 'Matrix', '1999', 6, 'Um hacker descobre que a realidade é uma simulação computadorizada e lidera a resistência contra as máquinas.'),
(2, 'Toy Story', '1995', 5, 'Aventura animada sobre brinquedos que ganham vida quando os humanos não estão por perto.'),
(3, 'O Poderoso Chefão', '1972', 2, 'A saga de uma família mafiosa e a ascensão de um de seus filhos ao poder do crime organizado.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `generos_constraint` (`genero`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `filmes`
--
ALTER TABLE `filmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `filmes`
--
ALTER TABLE `filmes`
  ADD CONSTRAINT `generos_constraint` FOREIGN KEY (`genero`) REFERENCES `generos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
