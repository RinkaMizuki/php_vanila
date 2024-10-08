-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 03:12 PM
-- Server version: 8.0.39-0ubuntu0.24.04.2
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_mvc_vanila`
--
CREATE DATABASE IF NOT EXISTS `php_mvc_vanila` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `php_mvc_vanila`;

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `base_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `short_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Truncate table before insert `socials`
--

TRUNCATE TABLE `socials`;
--
-- Dumping data for table `socials`
--

INSERT INTO `socials` (`id`, `name`, `base_url`, `short_name`, `icon`, `created_at`, `modified_at`) VALUES
(1, 'facebook', 'https://www.facebook.com/', 'fb', '<i class=\"fab fa-facebook-f fa-lg\"></i>', '2024-10-05 15:32:37', '2024-10-05 15:32:37'),
(2, 'twitter', 'https://www.x.com/', 'x', '<i class=\"fab fa-twitter fa-lg\"></i>', '2024-10-05 15:33:51', '2024-10-05 15:33:51'),
(3, 'instagram', 'https://www.instagram.com/', 'ins', '<i class=\"fab fa-instagram fa-lg\"></i>', '2024-10-05 15:34:26', '2024-10-05 15:34:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` text,
  `fullname` text,
  `age` int DEFAULT NULL,
  `address` text,
  `birthday` date DEFAULT NULL,
  `gender` tinyint(1) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `major` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `age`, `address`, `birthday`, `gender`, `email`, `password`, `avatar`, `url`, `phone`, `major`) VALUES
(1, 'rinka', 'Nguyễn Huỳnh Đức', 21, '941/13/4/25 Trần Xuân Soạn, Phường Tân Hưng, Quận 7', '2024-10-09', 1, NULL, NULL, NULL, NULL, NULL, ''),
(6, 'MH', 'Nguyễn Hồ Minh Hiển ', 20, 'Hóc môn', '2003-02-22', 0, NULL, NULL, NULL, NULL, NULL, ''),
(7, 'TP', 'Thanh Phong ', 22, 'Quận 12', '2002-02-02', 1, NULL, NULL, NULL, NULL, NULL, ''),
(10, 'Huy', 'huyne', 28, 'nnnn', NULL, 0, NULL, NULL, NULL, NULL, NULL, ''),
(11, 'Hien', 'hienlovedan', 25, 'asdasd', '2024-02-22', 0, NULL, NULL, NULL, NULL, NULL, ''),
(13, 'duc', 'ducnguyen', 18, 'Hule', '2024-01-09', 0, NULL, NULL, NULL, NULL, NULL, ''),
(16, 'register', '', 0, '', NULL, 0, 'register@gmail.com', '$2y$10$LuCGvGgHHAv7O/xzuxYXnOXcbzGPbLzjCStuijWBObytodyzkOItu', NULL, NULL, NULL, ''),
(17, 'mm', '', 0, '', NULL, 0, 'nguyenduc09012003@gmail.com', '$2y$10$.OjlBfkVRJtXd39bfF/dCOfNVCGCoORpsEd1zlux5L.n1B1ClA87K', NULL, NULL, NULL, ''),
(18, 'Quốc an', 'Quốc an', 19, 'ádokjsa', '2024-01-09', 1, NULL, NULL, NULL, NULL, NULL, ''),
(19, 'root', 'root nguyễn', 19, 'Củ chi', '2001-02-11', 0, 'root@gmail.com', '$2y$10$Lklq9fFeKlzv69Hw9XJbjOHJeb2n.uk/3qmdBtriIm/Fo3cziykMG', 'Gearvn_Honkai Impact 3rd_ (11).jpg', 'http://localhost:8081/upload/1728398723_Gearvn_Honkai Impact 3rd_ (11).jpg', '0867706538', 'Web Developer'),
(20, 'dsasd', 'asdsad', 123, 'asdcasd', '2024-01-09', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'add repo', 'Repo', 12, 'asd', '2223-01-02', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'test', 'testneeeee', 19, 'Cu chi', '2003-09-01', 1, 'test@gmail.com', '$2y$10$huCb4HR5vKKjXqv0c12vAuFzjhR3bmEOE3zRLNWFIHpm.MLm14vBm', '7.jpg', 'http://localhost:8081/upload/1728379047_7.jpg', '0987654321', 'asd'),
(23, 'abc', 'ddsadas', 312, 'sa', '1232-02-22', 1, 'abc@gmail.com', '$2y$10$EspehMqpp7mn2/KY2Pp4Se2d3RNntzuEMu0KWzuyYlwQQJqZZjwq2', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_socials`
--

CREATE TABLE `users_socials` (
  `user_id` int NOT NULL,
  `social_id` int NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Truncate table before insert `users_socials`
--

TRUNCATE TABLE `users_socials`;
--
-- Dumping data for table `users_socials`
--

INSERT INTO `users_socials` (`user_id`, `social_id`, `link`, `created_at`, `modified_at`) VALUES
(19, 1, 'ducdzpro.ak/', '2024-10-08 00:28:59', '2024-10-08 07:45:22'),
(19, 2, 'gd.ak', '2024-10-08 00:28:59', '2024-10-08 07:45:23'),
(19, 3, 'xzc123', '2024-10-08 00:28:59', '2024-10-08 07:45:23'),
(22, 1, '123', '2024-10-08 00:34:20', '2024-10-08 02:17:27'),
(22, 2, '546', '2024-10-08 00:34:20', '2024-10-08 02:17:27'),
(22, 3, '7689', '2024-10-08 00:34:20', '2024-10-08 02:17:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username_index` (`username`(255));

--
-- Indexes for table `users_socials`
--
ALTER TABLE `users_socials`
  ADD PRIMARY KEY (`user_id`,`social_id`),
  ADD UNIQUE KEY `unique_user_social` (`user_id`,`social_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `social_id` (`social_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_socials`
--
ALTER TABLE `users_socials`
  ADD CONSTRAINT `FK_users_socials_social` FOREIGN KEY (`social_id`) REFERENCES `socials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_users_socials_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
