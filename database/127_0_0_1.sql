-- phpMyAdmin SQL Dump
-- version 4.3.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 18 mei 2015 om 22:06
-- Serverversie: 5.6.17
-- PHP-versie: 5.6.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `idAccounts` int(11) NOT NULL,
  `Username` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `salt` varchar(45) NOT NULL,
  `Reset` varchar(45) DEFAULT NULL,
  `Users_idUsers` int(11) NOT NULL,
  `Role_idRole` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `accounts`
--

INSERT INTO `accounts` (`idAccounts`, `Username`, `Password`, `salt`, `Reset`, `Users_idUsers`, `Role_idRole`) VALUES
(5, 'jan', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '5', NULL, 5, 1),
(6, 'hallo', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '6', NULL, 6, 1),
(7, 'kdlfjdfjkjk', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '7', NULL, 7, 1),
(8, 'test', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '8', NULL, 8, 1),
(9, 'test', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '9', NULL, 9, 1),
(10, 'test', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '10', NULL, 10, 1),
(11, 'Admins', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '11', NULL, 11, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `idBlog` int(11) NOT NULL,
  `Title` varchar(45) NOT NULL,
  `Content` text NOT NULL,
  `Accounts_idAccounts` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `blog`
--

INSERT INTO `blog` (`idBlog`, `Title`, `Content`, `Accounts_idAccounts`) VALUES
(6, 'hahahahhahahah', 'ahahahahahahahahah', 5),
(8, 'halllpooo', 'mkkdmdkmd', 11),
(9, 'hallp', 'kdjkdjdk', 11),
(10, 'testdghdj', 'hdjfhjfhfjhfj\r\n', 11);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `idComments` int(11) NOT NULL,
  `Text` text NOT NULL,
  `Blog_idBlog` int(11) DEFAULT NULL,
  `Accounts_idAccounts` int(11) NOT NULL,
  `Products_idProducts` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`idComments`, `Text`, `Blog_idBlog`, `Accounts_idAccounts`, `Products_idProducts`) VALUES
(3, 'djhdjdhdhd', NULL, 11, 1),
(4, 'kjkjlfghghgh', NULL, 11, 1),
(5, 'testghtghghgh', NULL, 11, NULL),
(6, 'test', NULL, 11, 1),
(7, 'djkfkldfjgfgdfjkg', NULL, 11, 1),
(8, 'tet', 6, 11, NULL),
(9, 'test', 6, 11, NULL),
(10, 'test', 6, 11, NULL),
(11, 'test', 10, 11, NULL),
(12, 'test', NULL, 11, 1),
(13, 'dfkfgkfdjgkfjgkdfgjfgkdjkfkl', NULL, 11, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pagina`
--

CREATE TABLE IF NOT EXISTS `pagina` (
  `paginaid` int(11) NOT NULL,
  `bestand` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `pagina`
--

INSERT INTO `pagina` (`paginaid`, `bestand`) VALUES
(1, 'admin_users.php'),
(2, 'content.php'),
(3, 'registratie.php'),
(4, 'public_blog.php'),
(5, 'login.php'),
(6, 'logout.php'),
(7, 'admin_blog.php'),
(8, 'admin_comments.php'),
(9, 'projects.php');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `idProducts` int(11) NOT NULL,
  `Title` varchar(45) NOT NULL,
  `Content` text NOT NULL,
  `Accounts_idAccounts` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`idProducts`, `Title`, `Content`, `Accounts_idAccounts`) VALUES
(1, 'kfdlfjdjkfkj', 'kfjfkjfkfjkfj', 11);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `idRole` int(11) NOT NULL,
  `Name` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `role`
--

INSERT INTO `role` (`idRole`, `Name`) VALUES
(1, 'gebruiker'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idUsers` int(11) NOT NULL,
  `Surename` varchar(45) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`idUsers`, `Surename`, `Name`, `Email`) VALUES
(5, 'piet', 'harry', 'jan@live.nl'),
(6, 'test', 'hallo', 'hallo@live.nl'),
(7, 'test', 'lomp', 'kjfk@live.nl'),
(8, 'hallo@live.nl', 'hallo', 'hahahah@live.nl'),
(9, 'hallo@live.nl', 'hallo', 'hahahah@live.nl'),
(10, 'hallo@live.nl', 'hallo', 'hahahah@live.nl'),
(11, 'Beheerder', 'Admin', 'admin@meekit.nl'),
(12, 'Beheerder', 'Admin', 'admin@meekit.nl');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`idAccounts`), ADD KEY `fk_Accounts_Users_idx` (`Users_idUsers`), ADD KEY `fk_Accounts_Role1_idx` (`Role_idRole`);

--
-- Indexen voor tabel `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`idBlog`), ADD KEY `fk_Blog_Accounts1_idx` (`Accounts_idAccounts`);

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`idComments`), ADD KEY `fk_Comments_Blog1_idx` (`Blog_idBlog`), ADD KEY `fk_Comments_Accounts1_idx` (`Accounts_idAccounts`), ADD KEY `fk_Comments_Products1_idx` (`Products_idProducts`);

--
-- Indexen voor tabel `pagina`
--
ALTER TABLE `pagina`
  ADD PRIMARY KEY (`paginaid`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`idProducts`), ADD KEY `fk_Products_Accounts1_idx` (`Accounts_idAccounts`);

--
-- Indexen voor tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idRole`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `accounts`
--
ALTER TABLE `accounts`
  MODIFY `idAccounts` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT voor een tabel `blog`
--
ALTER TABLE `blog`
  MODIFY `idBlog` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `idComments` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT voor een tabel `pagina`
--
ALTER TABLE `pagina`
  MODIFY `paginaid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `idProducts` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `role`
--
ALTER TABLE `role`
  MODIFY `idRole` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `accounts`
--
ALTER TABLE `accounts`
ADD CONSTRAINT `fk_Accounts_Role1` FOREIGN KEY (`Role_idRole`) REFERENCES `role` (`idRole`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Accounts_Users` FOREIGN KEY (`Users_idUsers`) REFERENCES `users` (`idUsers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `blog`
--
ALTER TABLE `blog`
ADD CONSTRAINT `fk_Blog_Accounts1` FOREIGN KEY (`Accounts_idAccounts`) REFERENCES `accounts` (`idAccounts`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `fk_Comments_Accounts1` FOREIGN KEY (`Accounts_idAccounts`) REFERENCES `accounts` (`idAccounts`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Comments_Blog1` FOREIGN KEY (`Blog_idBlog`) REFERENCES `blog` (`idBlog`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Comments_Products1` FOREIGN KEY (`Products_idProducts`) REFERENCES `products` (`idProducts`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `products`
--
ALTER TABLE `products`
ADD CONSTRAINT `fk_Products_Accounts1` FOREIGN KEY (`Accounts_idAccounts`) REFERENCES `accounts` (`idAccounts`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
