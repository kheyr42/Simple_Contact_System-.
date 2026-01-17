-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2026 at 06:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simple_contact_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `sex` varchar(30) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(40) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `user_type` varchar(40) DEFAULT NULL,
  `status` varchar(40) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `sex`, `username`, `password`, `phone`, `email`, `photo`, `user_type`, `status`, `created_at`, `reset_token`, `reset_expires`) VALUES
(3, 'Liibaan', 'Ahmed', 'Male', 'liban', '$2y$10$kFxOcw4OLmMem9v85fCsdOBtYTD160jiFwrRpC.qudfK9EevWHjBW', '0618900909', 'liibaan@gmail.com', '1766942266_labo.jpg', 'User', 'Active', '2025-12-29 04:18:31', NULL, NULL),
(4, 'Abdirahman ', 'Ahmed', 'Male', 'carab', '$2y$10$vNH7QHxn/81F9vXyXgnvTufWKVfyHok/GKBGXbipiiLwTkbCTRcpO', '0612346787', 'Abdirahman@gmail.com', '', 'Admin', 'Active', '2025-12-29 04:18:31', NULL, NULL),
(5, 'MUQTAAR', 'mohamed', 'Male', 'daaci', '$2y$10$DPK/4jZLTYjVs7k9rYRByexgWb9CSRWaNlgbEULjU6fYliQ2lR0oG', '0612898776', 'daaci@gmail.com', '', 'User', 'Active', '2025-12-29 04:18:31', NULL, NULL),
(6, 'Haaji', 'Abikar', 'Male', 'haaji', '$2y$10$8KEfhNS6YNhM7jclNjg6kOlbf0CimW/0XCG0zaiGD05YnX2PD1HBG', '0619796561', 'abikar@gmail.com', '', 'Admin', 'Active', '2025-12-29 04:18:31', NULL, NULL),
(8, 'Xafso', 'Amin', 'Female', 'Xafza', '$2y$10$CswOXw6mSlHnjJR18XIA4e6HlOrJoHYe7um.teoAfMXzZ/lctyss2', '0618900909', 'xafza@gmail.com', '', 'User', 'Active', '2025-12-29 05:28:31', NULL, NULL),
(9, 'caasho', 'Abdihafid', 'Female', 'caashuuni', '$2y$10$YwvzR8ZnAxgxW1idVkILHeU6loDL2EuSWApWvQFFe2PL81.t8IrTe', '0614233212', 'caasho@gmail.come', '', 'User', 'Not Active', '2026-01-04 14:51:15', NULL, NULL),
(10, 'shukri', 'mohamed', 'Female', 'sheymaa', '$2y$10$5zwXqubclTYW3pmVaC1AQOydE1iUxWLTJsEm5xefV7QPzZpbmwoYK', '0612211221', 'sheyma@gmail.come', '', 'User', 'Active', '2026-01-04 15:05:08', 'cafa1347d18a574c204724cc7137eb59', '2026-01-06 18:03:37'),
(11, 'Aboukar', 'Ahmed', 'Male', 'Abikar', '$2y$10$RmxZvHWtFo/st9kBSJr1ouzZMtJBvMl4yhtLebZHGfBcfQSCuFUJm', '0612892029', 'abikarahmed13@gmail.com', '', 'Admin', 'Active', '2026-01-04 15:54:07', NULL, NULL),
(12, 'Ahmed', 'Qalif', 'Male', 'Qalif', '$2y$10$TRv89E/p/VPVApwbufv1Se4J4laUaQB05vaJ4EpHH9iy2ebnjUsm2', '0612892029', 'Ahmed@gmail.com', '', 'Admin', 'Active', '2026-01-05 15:27:19', NULL, NULL),
(13, 'farhan', 'Dahir', 'Male', 'farhan', '$2y$10$zGKnI.Saed62.yRRyQM31esSTIP8G/HZS1jYLcPuhMlvg6yN8wQvG', '0617899889', 'farhan@gmail.come', '', 'Admin', 'Active', '2026-01-05 15:32:21', NULL, NULL),
(14, 'Liibaan', 'Ahmed', 'Male', 'liibaan', '827ccb0eea8a706c4c34a16891f84e7b', '0612345678', 'liibaan@example.com', 'profile.jpg', 'Admin', 'Active', '2026-01-05 18:36:38', NULL, NULL),
(15, 'Mohamed', 'Yahye', 'Male', 'moha', '$2y$10$xobJeaeodPuYTA85qsUsTe8OLyhZYAo228OsPpDnQyyMBUxx9c5Ca', '0612233445', 'mohamed@gmail.com', '1767680069_sab.jpg.jpg', 'User', 'Active', '2026-01-06 06:14:29', NULL, NULL),
(16, 'Abdikadir', 'Nor', 'Female', 'abdi', '$2y$10$2fiE0imjKQSalYzZof97xu..7Hy820QZM5XfFO3ym3pe/cyOO6Bau', '0619091221', 'abdi@gmail.com', '1767686171_emoj.png', 'User', 'Active', '2026-01-06 07:56:11', NULL, NULL),
(17, 'xanaan', 'osman', 'Female', 'hanaan', '$2y$10$4BUVnJGSV67iD4TwgwoofubTPG8PxC/0u5U1vcrxPBZUtPDON74NC', '0618901221', 'hanaan@gmail.com', '1767686993_sheep.jpg', 'User', 'Active', '2026-01-06 08:09:53', NULL, NULL),
(18, 'xasan', 'osman', 'Male', 'hassan', '$2y$10$8l800hr2DLYdhjoy2.g9TecKucwpHGTyYvebSHN2fesXpnmFQkwtm', '0723783289', 'hassan@gmail.come', '', 'Admin', 'Active', '2026-01-06 08:14:26', NULL, NULL),
(19, 'Mohamed', 'Abdullahi', 'Male', 'Mohamed', '$2y$10$kwxlgyJ6XoayHJMqebhUXOQwa/OHRwBxraMuAW/GiZ2z0QXjx2x/u', '0618122112', 'Mohamed@gmail.com', '', 'Admin', 'Active', '2026-01-06 08:18:35', NULL, NULL),
(20, 'mohamed', 'Sharif', 'Male', 'sharif', '$2y$10$UvT7WRU9sAUUP11A42oe/eEXhcG3hxbO6.ovGpAmmrN7CroVaXND.', '0612344323', 'sharif@gmail.com', '', 'User', 'Active', '2026-01-06 10:14:22', NULL, NULL),
(21, 'Abdirahmaan', 'Omar', 'Male', 'Mohamed', '$2y$10$xdwVnG3lU6Gcs30whWt1neeTX0bnIwWoG1/RlcrAu5MiYQ8Upe2AO', '611226645', 'cade11@gmail.com', '', 'Admin', 'Active', '2026-01-06 10:43:15', NULL, NULL),
(22, 'Abdirahmaan', 'Omar', 'Male', 'Mohamed', '$2y$10$8VUpnK.OB663c9n2ZEbhdOiKQ4OkSXWyXo9mZ/oO/SkxjiUWoiEnq', '611226645', 'cade11@gmail.com', '', 'Admin', 'Active', '2026-01-06 10:43:49', NULL, NULL),
(23, 'Abdirahmaan', 'Omar', 'Male', 'Mohamed', '$2y$10$GlAFGTlzCCDgRuFaTOBE9.UZH0rdWJHGvf2317R7XUqKBwQn0dADq', '611226645', 'cade11@gmail.com', '', 'Admin', 'Active', '2026-01-06 10:44:16', NULL, NULL),
(24, 'Abdirahmaan', 'Omar', 'Male', 'Mohamed', '$2y$10$4Yw1rxQR0dau0Inx3LD6ueNoT2Kfevk4f6JJtGqrn1zoatXgaA/o.', '611226645', 'cade11@gmail.com', '', 'Admin', 'Active', '2026-01-06 10:44:29', NULL, NULL),
(25, 'Abdirahmaan', 'Omar', 'Male', 'Mohamed', '$2y$10$n/myrDX7RJwtPUL0tXqyo./j1uTlto.MO0dcXslbHD.LLEM0t3xea', '611226645', 'cade11@gmail.com', '', 'Admin', 'Active', '2026-01-06 10:44:50', NULL, NULL),
(26, 'ayuub', 'xasan', 'Male', 'ayuub', '$2y$10$/GjUBfJTl01Ji.sp7pF25uHVFXa0BilzY7ETMfNgHafRdo.yodq2q', '611226645', 'cade11@gmail.com', '', 'Admin', 'Active', '2026-01-06 10:45:35', NULL, NULL),
(27, 'Xaaji', 'Abikar', 'Male', 'Haaji', '$2y$10$/mIOQjj82Ir.dHj5ZCQf..0W5Ngv3PVZddSDwSbGAL1VCCj.RhbNS', '0618981287', 'haaji@gmaile.come', '', 'Admin', 'Active', '2026-01-06 17:10:42', NULL, NULL),
(28, 'naabiil axmad ', 'saabir', 'Male', 'nabiil', '$2y$10$htHz2h8o0Vi0GevU6wDQ4.4uvFAL7zOfyuBaE9u4D5voDXezcelne', '0612892029', 'naabiil@gmail.com', '', 'Admin', 'Inactive', '2026-01-06 17:12:57', NULL, NULL),
(30, 'farhaan', 'muxudiin', 'Male', 'farhaan', '$2y$10$lmuwKSu2CnyB4T1F5OZriuG.BntHeyjpy9ybMzOsVeaJuHnAAUFf6', '0612789020', 'farhaan@gmail.com', '1767763038_emoj.png', 'Admin', 'Active', '2026-01-07 05:17:18', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
