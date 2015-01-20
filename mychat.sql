-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 20, 2015 at 06:22 AM
-- Server version: 5.6.21-1~dotdeb.1
-- PHP Version: 5.5.20-1~dotdeb.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `chat`
--
DROP DATABASE IF EXISTS `chat`;
CREATE DATABASE `chat` CHARACTER SET utf8 COLLATE utf8_general_ci;
-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(16) NOT NULL AUTO_INCREMENT,
  `message_text` varchar(256) NOT NULL,
  `user_id` int(16) DEFAULT NULL,
  `is_ajax` int(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`),
  KEY `message_owner` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `message_text`, `user_id`, `is_ajax`, `created`) VALUES
(1, 'my first ajax message', 1, 1, '2015-01-19 21:43:16'),
(2, 'another ajax message', 1, 1, '2015-01-19 21:43:33'),
(3, 'and another message', 1, 1, '2015-01-19 21:47:18'),
(4, 'message from another browser', 2, 1, '2015-01-19 21:47:56'),
(5, 'hello <b>@user_6afcdddb</b>', 1, 1, '2015-01-19 21:48:25'),
(6, 'are you here?\r\n<b>@user_6afcdddb</b>, talk to me', 1, 1, '2015-01-19 21:57:18'),
(7, 'hi all, I`m newbe!', 3, 1, '2015-01-19 23:18:52'),
(8, 'anybody here?', 3, 1, '2015-01-19 23:19:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(16) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(64) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`) VALUES
(1, 'user_0b5da452'),
(2, 'user_6afcdddb'),
(3, 'user_8a7aa10e');


