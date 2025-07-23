-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2025 at 08:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courseworkphpdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date_posted` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `question_id`, `user_id`, `content`, `date_posted`) VALUES
(1, 70, 47, 'â', '2025-07-22 19:25:17'),
(2, 70, 47, 'ey', '2025-07-22 19:25:21'),
(3, 72, 48, 'Hey', '2025-07-23 00:25:57'),
(4, 72, 48, 'I love your question.', '2025-07-23 00:35:15');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `module_id`) VALUES
(25, 'COMP 1841 - Web Programming 1.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `date_posted` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `title`, `content`, `image_path`, `date_posted`, `user_id`, `module_id`) VALUES
(68, 'Why is my PHP form not sending emails?', 'I\'m trying to send an email using PHPMailer, but I keep getting a \"Could not authenticate\" error. I\'ve enabled \"less secure apps\" and used an app password, but it\'s still not working. Any ideas?\r\n\r\n', 'uploads/1753183648_OIP.jpg', '2025-07-22 18:27:28', 48, 25),
(69, 'How to center a div using CSS Flexbox?', ' want to center a card in the middle of the screen, both vertically and horizontally. I tried using margin: auto, but it doesn’t work. Should I use Flexbox instead? How would the CSS look?\r\n\r\n', 'uploads/1753183759_OIP (1).jpg', '2025-07-22 18:29:19', 49, 25),
(70, 'How to validate an email with JavaScript?', 'I want to make sure users enter a valid email address before submitting my form. What’s a good JavaScript function to check email format?\r\n\r\n', 'uploads/1753183796_OIP (2).jpg', '2025-07-22 18:29:56', 49, 25),
(71, 'Bootstrap modal not opening on button click?', 'I added a modal using Bootstrap 5, and wired it to a button, but nothing happens when I click it. I included the Bootstrap CDN in my HTML. What could be missing?\r\n\r\n', 'uploads/1753183853_OIP (3).jpg', '2025-07-22 18:30:53', 50, 25),
(72, 'Best way to connect to MySQL using PDO?', 'I’m building a small web app and want to use PDO for database access. What’s the most secure way to establish a connection and handle errors?', 'uploads/1753183883_OIP (4).jpg', '2025-07-22 18:31:23', 50, 25);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `hashed_password` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `hashed_password`, `role`) VALUES
(47, 'hyn', 'ngthtrungogjz@gmail.com', '', '$2y$10$FKTaBN9ZacLlDuOuOCH4neJtJLZXAY5PbtB6PMOthSaHa3edf62OC', 'admin'),
(48, 'cr7', 'ronaldona@gmail.com', '', '$2y$10$pt2Hx0eUrjHMK6kMDHI/0u4Y1QuCfx2E7oIuwZLfdM3KiLKUcB5vO', 'user'),
(49, 'm10', 'thanhdatvo.4805@gmail.com', '', '$2y$10$BbowzAgc2uce8LVjZa/gfel7SGMWKCf0T0v6zDPpgnIsVkpX.1ezG', 'user'),
(50, 'n9', 'nguyenvuphuongthuy55664@gmail.com', '', '$2y$10$PcZQVz3TQtU.Cp5rf3T3gOPNNXN9B4q/bZy1chbKFgYY5gvdukTw.', 'user'),
(51, 'ney2', 'ngtrung@gmail.com', '', '$2y$10$rIz7YJIBFUtBBkwbCX5Wh.5HdvH3nO8c8wxCZkXpak1qHqPCmaDiK', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_module_id` (`module_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `fk_module_id` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
