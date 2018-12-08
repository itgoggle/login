-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 
-- サーバのバージョン： 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phpkiso`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `anketo`
--

CREATE TABLE `anketo` (
  `code` int(11) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `goiken` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `anketo`
--

INSERT INTO `anketo` (`code`, `nickname`, `email`, `goiken`) VALUES
(2, '浜崎順平', 'emialjikan@email.com', 'りり'),
(3, '浜崎順平', 'emialjikan@email.com', 'りり'),
(4, '唐澤貴洋', 'kosin@email.com', '当職は弁護士だ'),
(5, '唐澤貴洋', 'kosin@email.com', '当職は弁護士だ'),
(6, '唐澤貴洋', 'kosin@email.com', '当職は弁護士だ'),
(8, '磯野カツオ', 'hagechabing@email.com', 'ずるいや姉さん!'),
(9, '磯野カツオ', 'hagechabing@email.com', 'ずるいや姉さん!'),
(10, '磯野カツオ', 'hagechabing@email.com', 'ずるいや姉さん!'),
(11, '浜川裕平', 'zot_teikoku@email.com', 'なんとかしやがれ!');

-- --------------------------------------------------------

--
-- テーブルの構造 `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post` mediumtext NOT NULL,
  `post_date` datetime NOT NULL,
  `Author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `posts`
--

INSERT INTO `posts` (`post_id`, `post`, `post_date`, `Author`) VALUES
(1, 'ゾット帝国', '2018-11-30 09:31:03', 0),
(2, 'そして輝く', '2018-11-30 09:34:43', 0),
(4, 'ワイがもこうや...', '2018-11-30 20:45:38', 0),
(5, 'ワイがもこうや...', '2018-11-30 20:49:36', 10),
(6, 'クールないい男を目指している', '2018-12-03 19:55:45', 10);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `code` int(11) NOT NULL,
  `email` varchar(124) NOT NULL,
  `password` varchar(255) NOT NULL,
  `timestump` int(11) NOT NULL,
  `counter` int(11) NOT NULL,
  `gazo` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`code`, `email`, `password`, `timestump`, `counter`, `gazo`) VALUES
(1, 'syamu_game@email.com', '114514810', 0, 1, ''),
(2, 'hill_people@email.com', '114514810', 0, 4, ''),
(3, 'legend_of_hillpeople@email.com', '512810', 1543306972, 3, ''),
(4, 'karasawalove@email.com', '$2y$10$gyejRLPKxoI/fl2TKQjo6ObcyIncO8uoKGF/wBpZiFnWIPksHImPu', 0, 0, ''),
(5, 'udkkousei@email.com', '$2y$10$kTDZ1xhh8K1WCcV64YozSODSGF0WHRlwHGnydP8DhS4pS7EySHCYC', 0, 4, ''),
(6, 'kinnikuisnice@email.com', '$2y$10$GtIeIG5uknEZSydwip9aWuVSZgdcq4KfndAKLqOs7ECN5y2jxUmGK', 0, 0, ''),
(7, 'akumashindorubarom@email.com', '$2y$10$AQR4V985jUWDBG5gUtkLW.e76nrrWwrudkN1vjMjW.SZHr0B7MbWa', 0, 1, ''),
(8, 'krswtkhrkrs@email.com', '$2y$10$uLfDqw3wJ9r/4CBzA0EmnOjq4c9Wj22Ytzwc3XmTDpffEZpofs5ZG', 0, 0, ''),
(9, 'ajakong@ajax.com', '$2y$10$XYYEbIIkx5WkCAusJgX89eIB3pZtTotUo5TohJn715T6aW9XQG5Ky', 0, 0, ''),
(10, 'emialokashi@email.com', '$2y$10$bgLcgnIEJCNMaZ7lIPxuve6bEX9qdylPeW1Gdm34EZJEsmuQ2doWO', 0, 0, 'chinpan.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anketo`
--
ALTER TABLE `anketo`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anketo`
--
ALTER TABLE `anketo`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
