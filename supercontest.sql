-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
-- Server version: 5.7.25-log
-- PHP Version: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supercontest`
--

-- --------------------------------------------------------

CREATE DATABASE supercontest;

--
-- Table structure for table `picks_log`
--

CREATE TABLE `picks_log` (
  `primary_key` int(255) NOT NULL,
  `player_id` int(255) NOT NULL,
  `pick_1` varchar(40) NOT NULL,
  `pick_2` varchar(40) NOT NULL,
  `pick_3` varchar(40) NOT NULL,
  `pick_4` varchar(40) NOT NULL,
  `pick_5` varchar(40) NOT NULL,
  `week` varchar(10) NOT NULL,
  `time_entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `player_picks`
--

CREATE TABLE `player_picks` (
  `primary_key` int(255) NOT NULL,
  `player_id` int(255) NOT NULL,
  `pick_1` varchar(40) NOT NULL,
  `pick_2` varchar(40) NOT NULL,
  `pick_3` varchar(40) NOT NULL,
  `pick_4` varchar(40) NOT NULL,
  `pick_5` varchar(40) NOT NULL,
  `week` varchar(10) NOT NULL,
  `pick_1_wlt` float NOT NULL DEFAULT '0',
  `pick_2_wlt` float NOT NULL DEFAULT '0',
  `pick_3_wlt` float NOT NULL DEFAULT '0',
  `pick_4_wlt` float NOT NULL DEFAULT '0',
  `pick_5_wlt` float NOT NULL DEFAULT '0',
  `time_entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `week_score` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `player_roster`
--

CREATE TABLE `player_roster` (
  `player_id` int(11) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(256) NOT NULL,
  `fav_team` varchar(255) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Total_Score` float NOT NULL DEFAULT '0',
  `q1_score` float NOT NULL DEFAULT '0',
  `q2_score` float NOT NULL DEFAULT '0',
  `q3_score` float NOT NULL DEFAULT '0',
  `q4_score` float NOT NULL DEFAULT '0',
  `pin` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `regseason`
--

CREATE TABLE `regseason` (
  `Week` int(2) DEFAULT NULL,
  `Away` varchar(3) DEFAULT NULL,
  `A_spread` float DEFAULT NULL,
  `A_score` int(10) NOT NULL DEFAULT '0',
  `A_margin` int(10) DEFAULT NULL,
  `A_Pscore` float DEFAULT NULL,
  `Home` varchar(3) DEFAULT NULL,
  `H_spread` float DEFAULT NULL,
  `H_score` int(10) DEFAULT '0',
  `H_margin` int(10) DEFAULT NULL,
  `H_Pscore` float DEFAULT NULL,
  `Start_Date` date DEFAULT NULL,
  `Start_Time` varchar(8) DEFAULT NULL,
  `End_Date` date DEFAULT NULL,
  `End_Time` varchar(8) DEFAULT NULL,
  `id` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for table `picks_log`
--
ALTER TABLE `picks_log`
  ADD PRIMARY KEY (`primary_key`);

--
-- Indexes for table `player_picks`
--
ALTER TABLE `player_picks`
  ADD PRIMARY KEY (`primary_key`);

--
-- Indexes for table `player_roster`
--
ALTER TABLE `player_roster`
  ADD PRIMARY KEY (`player_id`);

--
-- Indexes for table `regseason`
--
ALTER TABLE `regseason`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `picks_log`
--
ALTER TABLE `picks_log`
  MODIFY `primary_key` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `player_picks`
--
ALTER TABLE `player_picks`
  MODIFY `primary_key` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `player_roster`
--
ALTER TABLE `player_roster`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regseason`
--
ALTER TABLE `regseason`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
