

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `filmes` (
  `id` int(3) NOT NULL,
  `nome` varchar(99) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `descricao` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `filmes` (`id`, `nome`, `genero`, `descricao`) VALUES
('01', 'Blade Runner', 'SciFi', 'aaaaaaaa'),
('02', 'Lord of The Rings', 'Fantasy', 'bbbbbbb'),
('03', 'Monty Python', 'Comedy', 'cccccccc'),
('04', 'Fight Club', 'Thriller', 'dddddddd');


ALTER TABLE `filmes`
  ADD PRIMARY KEY (`id`);
COMMIT;
