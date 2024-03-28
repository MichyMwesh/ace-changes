-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2024 at 05:13 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `geeks`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `date`) VALUES
(1, 'Mcha', '$2y$10$DfcrzcKVRpLdoYrk.bwJFOa2Hta2eBqnQjo5asqx67hsTWvOuq/Iq', '2024-01-24 17:19:38'),
(2, 'Cate', '$2y$10$/ttHwPXiBKHa3Wa8lXEdA.hsblpF3AHXC3XTVj5SVjHhSuPdZPzI6', '2024-01-24 17:24:56');

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(55) NOT NULL,
  `name` varchar(11) NOT NULL,
  `email` varchar(11) NOT NULL,
  `subject` varchar(55) NOT NULL,
  `message` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'bet', 'bet@gmail.c', 'eeer', 'mmmmm'),
(2, 'bet', 'bet@gmail.c', 'eeer', 'mmmmm');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `cpassword` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `cpassword`, `date`) VALUES
(1, 'bet', '$2y$10$RstSXtBNNap1pUzFBJqX8egGSE/8HKlH8d.78FPnRB.', '', '2024-01-23 15:49:12'),
(2, '', '$2y$10$b4k1i8nTmdLFhNSWCGupNuPF8aMph/VS6jj8wv5jVno', '', '2024-01-23 15:54:23'),
(3, 'whitney', '$2y$10$FavOvo0L8HFHcUAEAJBbR.M/y2KJOtCrPHa5PYVRbgH', '', '2024-01-23 16:16:29'),
(4, 'Bonney', '$2y$10$HohLA8TdlRwAWDziYrhgp.mjBcnI9f7/PliwhlDTtX9', '', '2024-01-23 16:21:38'),
(5, 'joy', '$2y$10$6WxxPy0dMwvaDPK8y7RZw.kVkEjUzC4DOXGSRZRU3Y.', '', '2024-01-23 16:47:36'),
(6, 'HI', '$2y$10$Ub/GZCjMam4mSSIRt.CbQO0LR3Pzbjgpo.F4Qht1wfA', '', '2024-01-23 16:48:34'),
(7, 'yet', '$2y$10$9qniRlzWuK0.cL8EEYtCuebh7/hqegsWtkHQJuDT0KG', '', '2024-01-23 16:53:16'),
(8, 'juy', '$2y$10$dXIiJa.pSD87eVz/6FDGM.7lfPSHP4gid3d6OW3exE1', '', '2024-01-23 16:53:25'),
(9, 'jot', '$2y$10$UeyatAjwB8Dm3hyiT.3t7./iglHBrT/sfScr2uK9cls', '', '2024-01-23 16:57:02'),
(10, 'Michelle', '$2y$10$NdI6LK88lke63RrlaDRlGOXa9X7UB3BtAfS5jANxrpb', '', '2024-01-23 17:00:22'),
(11, 'yel', '$2y$10$prCOyUdLu5vUhD8/jdY0bOqIh5w2tgs3YehHNsAN9wN', '', '2024-01-23 17:02:54'),
(12, 'Michy', '$2y$10$PGAFKTEmap7rqmwTqbZFXOB5kuX5yo7eKJ5wZoHnL8q', '', '2024-01-24 16:52:46'),
(13, 'Ben', '$2y$10$SpbL/fnXx52802zaFY7xK.WmJlYdufyzcDxaj8g7wWw', '', '2024-01-24 17:14:06'),
(14, 'BEnu', '$2y$10$NGY3gLfJnPYVhRS9MI3ko.uRVf0MDgWMl4nJbJhMaLu', '', '2024-01-24 17:15:57'),
(15, 'Tabby', '$2y$10$UFCAprixYUC7c7U6yp66iOiyJwU0P7z7p2Wrh57qKww', '', '2024-01-24 17:57:43'),
(16, 'Bonny', '$2y$10$ubSrj9ePPD9PzcrmBBZ.fu0avnaD.LkkppyO6Acvnnq', '', '2024-01-24 23:03:18'),
(17, 'betty', '$2y$10$AxPLHRAJYjMJWUc6Nxn4IOqq4duSwkmX8R0f2ltCl6i', '', '2024-02-02 21:24:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
