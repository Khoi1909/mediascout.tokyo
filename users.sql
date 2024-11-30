-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 03:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `UID` int(11) NOT NULL,
                         `username` varchar(20) NOT NULL,
                         `email` varchar(100) NOT NULL,
                         `password` varchar(20) NOT NULL,
                         `displayname` varchar(100) DEFAULT NULL,
                         `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
                         `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                         `gender` enum('Male','Female','Other') DEFAULT NULL,
                         `Birth_date` date DEFAULT NULL,
                         `profile_pic` varchar(255) DEFAULT NULL,
                         `token` varchar(255) DEFAULT NULL,
                         `is_verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for table `anime_history`
--
ALTER TABLE `anime_history`
    ADD PRIMARY KEY (`id`),
  ADD KEY `UID` (`UID`);

--
-- Indexes for table `anime_list`
--
ALTER TABLE `anime_list`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`UID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anime_history`
--
ALTER TABLE `anime_history`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anime_history`
--
ALTER TABLE `anime_history`
    ADD CONSTRAINT `anime_history_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
