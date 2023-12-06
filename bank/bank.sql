-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 03:02 PM
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
-- Database: `bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `crud` varchar(500) NOT NULL DEFAULT '[["1","0","0","0","0"],["2","0","0","0","0"],["3","0","0","0","0"],["4","0","0","0","0"],["10","0","0","0","0"],["5","0","0","0","0"],["6","0","0","0","0"],["7","0","0","0","0"],["0","0","1","0","0"],["9","0","0","0","0"]]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`id`, `role_id`, `crud`) VALUES
(1, 2, '[[\"1\",\"1\",\"1\",\"1\",\"1\"],[\"2\",\"1\",\"1\",\"1\",\"1\"],[\"3\",\"1\",\"1\",\"1\",\"1\"],[\"4\",\"1\",\"1\",\"1\",\"1\"],[\"5\",\"1\",\"1\",\"1\",\"1\"],[\"6\",\"1\",\"1\",\"1\",\"1\"],[\"7\",\"1\",\"1\",\"1\",\"1\"],[\"8\",\"1\",\"1\",\"1\",\"1\"],[\"9\",\"1\",\"1\",\"1\",\"1\"],[\"10\",\"1\",\"1\",\"1\",\"1\"]]'),
(2, 1, '[[\"1\",\"1\",\"1\",\"1\",\"1\"],[\"2\",\"1\",\"1\",\"1\",\"1\"],[\"3\",\"1\",\"1\",\"1\",\"1\"],[\"4\",\"1\",\"1\",\"1\",\"1\"],[\"5\",\"1\",\"1\",\"1\",\"1\"],[\"6\",\"1\",\"1\",\"1\",\"1\"]]');

-- --------------------------------------------------------

--
-- Table structure for table `access modules`
--

CREATE TABLE `access modules` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `icon` varchar(250) NOT NULL,
  `link` varchar(250) NOT NULL,
  `style` varchar(500) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `access modules`
--

INSERT INTO `access modules` (`id`, `name`, `icon`, `link`, `style`, `parent_id`) VALUES
(1, 'home', 'nav-icon fas fa-home text-black', '../home/index.php', 'color: forestgreen;', 0),
(2, 'transfer', 'nav-icon fas fa-money-bill text-black', '../transfer/', 'color: forestgreen;', 0),
(3, 'transcation history', 'nav-icon fas fa-list  text-black', '../transactions/', 'color: forestgreen;', 0),
(4, 'loan application', 'nav-icon fa-regular fas fa-credit-card text-black', '../loan_application /index.php\n', 'color: forestgreen;', 0),
(5, 'profile', 'nav-icon far fa-user  text-black', '../profile/index.php', 'color: forestgreen;', 0),
(6, ' logout', 'nav-icon fas fa-power-off  text-black', ' ../funtion/logout.php', 'color: red;', 0);

-- --------------------------------------------------------

--
-- Table structure for table `access_role`
--

CREATE TABLE `access_role` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `access_role`
--

INSERT INTO `access_role` (`id`, `name`) VALUES
(1, 'client ');

-- --------------------------------------------------------

--
-- Table structure for table `loan_data`
--

CREATE TABLE `loan_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `principal` decimal(10,2) NOT NULL,
  `fixed_interest_rate` decimal(5,2) NOT NULL,
  `duration` varchar(11) NOT NULL,
  `duration_type` varchar(250) NOT NULL,
  `specific_duration` int(11) NOT NULL,
  `next_of_kin` varchar(300) NOT NULL,
  `next_of_kin_phone` varchar(15) NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `status` varchar(300) NOT NULL DEFAULT 'pending',
  `total_amount` decimal(10,2) NOT NULL,
  `approved_date` date NOT NULL,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_data`
--

INSERT INTO `loan_data` (`id`, `user_id`, `principal`, `fixed_interest_rate`, `duration`, `duration_type`, `specific_duration`, `next_of_kin`, `next_of_kin_phone`, `interest`, `status`, `total_amount`, `approved_date`, `due_date`) VALUES
(1, 2, 3000000.00, 0.04, '2', 'years', 2, 'ade', '08065434567', 240000.00, 'due', 3240000.00, '2023-11-15', '2023-11-15'),
(2, 1, 3000.00, 0.10, '4', 'days', 4, 'noah', '06978445342', 1200.00, 'disapproved', 4200.00, '0000-00-00', '0000-00-00'),
(3, 3, 600000.00, 0.06, '12', 'weeks', 0, 'abiodun', '09087856342', 432000.00, 'pending', 1032000.00, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `role_ids` int(11) NOT NULL DEFAULT 1,
  `password` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `name`, `role_ids`, `password`, `email`) VALUES
(1, 'korede', 2, '81dc9bdb52d04dc20036dbd8313ed055', 'daystarowolabi@gmail.com'),
(2, 'shina', 2, 'cdaeb1282d614772beb1e74c192bebda', 'koredeowolabi62@gmail.com'),
(5, 'benita', 4, '4a7d1ed414474e4033ac29ccb8653d9b', 'benita@gmail.com'),
(6, 'ola', 3, 'cdaeb1282d614772beb1e74c192bebda', 'ola@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `staff_access`
--

CREATE TABLE `staff_access` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `crud` varchar(1000) NOT NULL DEFAULT '[["1","0","0","0","0"],["2","0","0","0","0"],["3","0","0","0","0"],["4","0","0","0","0"],["5","0","0","0","0"],["6","0","0","0","0"],["7","0","0","0","0"],["8","0","1","0","0"],["9","0","0","0","0"],["10","0","0","0","0"],["11","0","0","0","0"],["12","0","0","0","0"],["13","0","0","0","0"],["14","0","0","0","0"],["15","0","0","0","0"],["16","0","0","0","0"],["17","0","0","0","0"]]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_access`
--

INSERT INTO `staff_access` (`id`, `role_id`, `crud`) VALUES
(1, 2, '[[\"1\",\"1\",\"1\",\"1\",\"1\"],[\"2\",\"1\",\"1\",\"1\",\"1\"],[\"3\",\"1\",\"1\",\"1\",\"1\"],[\"4\",\"1\",\"1\",\"1\",\"1\"],[\"5\",\"1\",\"1\",\"1\",\"1\"],[\"6\",\"1\",\"1\",\"1\",\"1\"],[\"7\",\"1\",\"1\",\"1\",\"1\"],[\"8\",\"1\",\"1\",\"1\",\"1\"],[\"9\",\"1\",\"1\",\"1\",\"1\"],[\"10\",\"1\",\"1\",\"1\",\"1\"],[\"11\",\"1\",\"1\",\"1\",\"1\"],[\"12\",\"1\",\"1\",\"1\",\"1\"],[\"13\",\"1\",\"1\",\"1\",\"1\"],[\"14\",\"1\",\"1\",\"1\",\"1\"],[\"15\",\"1\",\"1\",\"1\",\"1\"],[\"16\",\"1\",\"1\",\"1\",\"1\"],[\"17\",\"1\",\"1\",\"1\",\"1\"]]'),
(2, 3, '[[\"1\",\"1\",\"1\",\"1\",\"1\"],[\"2\",\"1\",\"1\",\"1\",\"1\"],[\"3\",\"1\",\"1\",\"1\",\"1\"],[\"4\",\"1\",\"1\",\"1\",\"0\"],[\"5\",\"1\",\"1\",\"1\",\"0\"],[\"6\",\"1\",\"1\",\"1\",\"0\"],[\"7\",\"1\",\"1\",\"1\",\"0\"],[\"8\",\"1\",\"1\",\"1\",\"0\"],[\"9\",\"1\",\"1\",\"1\",\"0\"],[\"10\",\"1\",\"1\",\"1\",\"0\"],[\"11\",\"1\",\"1\",\"1\",\"0\"],[\"12\",\"1\",\"1\",\"1\",\"0\"],[\"13\",\"1\",\"1\",\"1\",\"0\"],[\"14\",\"1\",\"1\",\"1\",\"0\"],[\"15\",\"1\",\"1\",\"1\",\"0\"],[\"16\",\"0\",\"0\",\"0\",\"0\"],[\"17\",\"0\",\"0\",\"0\",\"0\"]]'),
(3, 4, '[[\"1\",\"0\",\"0\",\"0\",\"0\"],[\"2\",\"1\",\"1\",\"0\",\"0\"],[\"3\",\"1\",\"1\",\"0\",\"0\"],[\"4\",\"1\",\"1\",\"0\",\"0\"],[\"5\",\"0\",\"0\",\"0\",\"0\"],[\"6\",\"0\",\"0\",\"0\",\"0\"],[\"7\",\"0\",\"0\",\"0\",\"0\"],[\"8\",\"0\",\"0\",\"0\",\"0\"],[\"9\",\"1\",\"1\",\"0\",\"0\"],[\"10\",\"1\",\"1\",\"0\",\"0\"],[\"11\",\"1\",\"1\",\"0\",\"0\"],[\"12\",\"1\",\"1\",\"0\",\"0\"],[\"13\",\"1\",\"1\",\"0\",\"0\"],[\"14\",\"0\",\"0\",\"0\",\"0\"],[\"15\",\"0\",\"0\",\"0\",\"0\"],[\"16\",\"0\",\"0\",\"0\",\"0\"],[\"17\",\"0\",\"0\",\"0\",\"0\"]]'),
(4, 5, '[[\"1\",\"0\",\"0\",\"0\",\"0\"],[\"2\",\"0\",\"0\",\"0\",\"0\"],[\"3\",\"0\",\"0\",\"0\",\"0\"],[\"4\",\"0\",\"0\",\"0\",\"0\"],[\"5\",\"0\",\"0\",\"0\",\"0\"],[\"6\",\"0\",\"0\",\"0\",\"0\"],[\"7\",\"0\",\"0\",\"0\",\"0\"],[\"8\",\"0\",\"1\",\"0\",\"0\"],[\"9\",\"0\",\"0\",\"0\",\"0\"],[\"10\",\"0\",\"0\",\"0\",\"0\"],[\"11\",\"0\",\"0\",\"0\",\"0\"],[\"12\",\"0\",\"0\",\"0\",\"0\"],[\"13\",\"0\",\"0\",\"0\",\"0\"],[\"14\",\"0\",\"0\",\"0\",\"0\"],[\"15\",\"0\",\"0\",\"0\",\"0\"],[\"16\",\"0\",\"0\",\"0\",\"0\"],[\"17\",\"0\",\"0\",\"0\",\"0\"]]');

-- --------------------------------------------------------

--
-- Table structure for table `staff_modules`
--

CREATE TABLE `staff_modules` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `icon` text NOT NULL,
  `link` text NOT NULL,
  `parent_id` int(11) NOT NULL,
  `has_sub` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_modules`
--

INSERT INTO `staff_modules` (`id`, `name`, `icon`, `link`, `parent_id`, `has_sub`) VALUES
(1, 'dashboard', 'bi bi-grid-fill', '../home/index.php', 0, ''),
(2, 'staff management', 'fa fa-users', '#', 0, 'has-sub'),
(3, 'all staff', 'fa fa-genderless', '../staff_management/staff.php', 2, ''),
(4, 'roles', 'fa fa-genderless', '../staff_management/roles.php', 2, ''),
(5, 'manage users', 'fa fa-users', '#', 0, 'has-sub'),
(6, 'active users', 'fa fa-genderless', '../manage_user/active.php', 5, ''),
(7, 'banned users', 'fa fa-genderless', '../manage_user/banned.php', 5, ''),
(8, 'all users', 'fa fa-genderless', '../manage_user/user.php', 5, ''),
(9, 'loan management', 'fa fa-credit-card', '#', 0, 'has-sub'),
(10, 'approved loan', 'fa fa-genderless', '../loan_management/approved.php', 9, ''),
(11, 'pending loans', 'fa fa-genderless', '../loan_management/pending.php ', 9, ''),
(12, 'disapproved loans ', 'fa fa-genderless', '../loan_management/reject.php', 9, ''),
(13, 'all loans', 'fa fa-genderless', '../loan_management/all_loan.php', 9, ''),
(14, 'access management', 'fa fa-cogs', '#', 0, 'has-sub'),
(15, 'staff access', 'fa fa-genderless', '../staff_access/index.php', 14, '');

-- --------------------------------------------------------

--
-- Table structure for table `staff_roles`
--

CREATE TABLE `staff_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_roles`
--

INSERT INTO `staff_roles` (`id`, `name`) VALUES
(2, 'admin'),
(3, 'manager'),
(4, 'secretary ');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(30) NOT NULL,
  `account_id` int(30) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1=Cash in, 2= Withdraw, 3=transfer out,4=transfer in',
  `amount` float NOT NULL,
  `remark` text DEFAULT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `account_id`, `type`, `amount`, `remark`, `date_created`) VALUES
(1, 3, 3, 800, 'Transferred to 09027346296', '2023-09-24'),
(2, 1, 4, 800, 'Transferred from 08073929040', '2023-09-24'),
(3, 3, 3, 4200, 'Transferred to 09027346296', '2023-09-24'),
(4, 1, 4, 4200, 'Transferred from 08073929040', '2023-09-24'),
(5, 3, 3, 5000, 'Transferred to 09034066807', '2023-09-24'),
(6, 2, 4, 5000, 'Transferred from 08073929040', '2023-09-24'),
(7, 2, 3, 5000, 'Transferred to 08073929040', '2023-09-24'),
(8, 3, 4, 5000, 'Transferred from 09034066807', '2023-09-24'),
(9, 1, 3, 5000, 'Transferred to 08073929040', '2023-09-24'),
(10, 3, 4, 5000, 'Transferred from 09027346296', '2023-09-24'),
(11, 3, 3, 5000, 'Transferred to 09034066807', '2023-10-12'),
(12, 2, 4, 5000, 'Transferred from 08073929040', '2023-10-12'),
(13, 3, 3, 200, 'Transferred to 09034066807', '2023-10-12'),
(14, 2, 4, 200, 'Transferred from 08073929040', '2023-10-12'),
(15, 2, 3, 3090, 'Transferred to 09027346296', '2023-10-26'),
(16, 1, 4, 3090, 'Transferred from 09034066807', '2023-10-26');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(300) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role_id` varchar(10) NOT NULL DEFAULT '1',
  `account_balance` varchar(250) NOT NULL DEFAULT '0',
  `pin` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL DEFAULT 'active',
  `loan_amount` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `phone_number`, `password`, `role_id`, `account_balance`, `pin`, `status`, `loan_amount`) VALUES
(1, 'owolabi shina', 'daystar@gmail.com', '09027346296', '827ccb0eea8a706c4c34a16891f84e7b', '1', '18090', 'd47268e9db2e9aa3827bba3afb7ff94a', 'disable', 0.00),
(2, 'adeola muiz', 'adeolamuiz@gmail.com', '09034066807', '81dc9bdb52d04dc20036dbd8313ed055', '1', '17110', '4a7d1ed414474e4033ac29ccb8653d9b', 'active', 3011000.00),
(3, 'Aminu festus', 'aminu@gmail.com', '08073929040', 'cdaeb1282d614772beb1e74c192bebda', '1', '4800', 'b59c67bf196a4758191e42f76670ceba', 'active', 8000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `access modules`
--
ALTER TABLE `access modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `access_role`
--
ALTER TABLE `access_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_data`
--
ALTER TABLE `loan_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_access`
--
ALTER TABLE `staff_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_modules`
--
ALTER TABLE `staff_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_roles`
--
ALTER TABLE `staff_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `access modules`
--
ALTER TABLE `access modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `access_role`
--
ALTER TABLE `access_role`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `loan_data`
--
ALTER TABLE `loan_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `staff_access`
--
ALTER TABLE `staff_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff_modules`
--
ALTER TABLE `staff_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3335;

--
-- AUTO_INCREMENT for table `staff_roles`
--
ALTER TABLE `staff_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
