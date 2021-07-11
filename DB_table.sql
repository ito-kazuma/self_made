-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 11, 2021 at 06:52 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Football`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL COMMENT '管理者ID',
  `name` varchar(64) NOT NULL COMMENT '名前',
  `furigana` varchar(64) NOT NULL COMMENT 'ふりがな',
  `email` varchar(100) NOT NULL COMMENT 'メールアドレス',
  `password` varchar(64) NOT NULL COMMENT 'パスワード'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `furigana`, `email`, `password`) VALUES
(1, '伊藤', 'イトウ', 'admin@ne.jp', '$2y$10$kICFUH3Fm6YEtDAvNXqYQu7d8RWZejkQVv0S3S67/jJTGauvETWGK');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL COMMENT 'イベントID ',
  `admin_id` int(11) DEFAULT NULL COMMENT '管理者ID',
  `event_date` date DEFAULT NULL COMMENT '日付',
  `open_time` varchar(11) NOT NULL COMMENT '開始時間',
  `close_time` varchar(11) NOT NULL COMMENT '終了時間',
  `recruiting` int(11) NOT NULL COMMENT '募集期間',
  `count` int(11) NOT NULL COMMENT '募集人数',
  `price` int(11) NOT NULL COMMENT '価格',
  `note` varchar(100) DEFAULT 'キャンセルは電話のみ' COMMENT '備考'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `admin_id`, `event_date`, `open_time`, `close_time`, `recruiting`, `count`, `price`, `note`) VALUES
(28, NULL, '2021-07-31', '10:00', '12:00', 2, 20, 1000, 'お支払いは受付です。キャンセルは電話のみ'),
(29, NULL, '2021-08-07', '14:00', '16:00', 2, 20, 1000, 'お支払いは受付です。キャンセルは電話のみ'),
(41, NULL, '2021-08-22', '12:00', '14:00', 2, 1, 1000, 'お支払いは受付です。キャンセルは電話のみ');

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE `reserve` (
  `id` int(11) NOT NULL COMMENT '予約ID',
  `user_id` int(11) NOT NULL COMMENT 'ユーザーID ',
  `event_id` int(11) NOT NULL COMMENT 'イベントID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reserve`
--

INSERT INTO `reserve` (`id`, `user_id`, `event_id`) VALUES
(1, 169, 1),
(54, 1, 40),
(66, 213, 41);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL COMMENT 'ユーザーID',
  `name` varchar(64) NOT NULL COMMENT '名前',
  `furigana` varchar(64) NOT NULL COMMENT 'ふりがな',
  `nickname` varchar(16) DEFAULT NULL COMMENT 'ニックネーム',
  `age` varchar(11) DEFAULT NULL COMMENT '年齢',
  `sex` varchar(11) DEFAULT NULL COMMENT '性別',
  `tel` varchar(11) NOT NULL COMMENT '電話番号',
  `email` varchar(32) NOT NULL COMMENT 'メールアドレス',
  `password` varchar(64) NOT NULL COMMENT 'パスワード'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `furigana`, `nickname`, `age`, `sex`, `tel`, `email`, `password`) VALUES
(169, '伊藤', 'イトウ', '', '', '', '09012345678', 'test123@ne.jp', '$2y$10$3jZvdLOyywRp.hR6PGZFBu7mJ87udqhiK3xc5rZH0VAtOwGFiYW5G'),
(209, '山田太郎', 'ヤマダタロウ', 'タロー', '26', '男', '09012345678', 'test@ne.jp', '$2y$10$fRT28BDKRRxz4ACocEBIme6VgHop3rP6emhhEg11MDXmo7HS00NbO'),
(210, '田中', 'タナカ', 'タナカ', '36', '男', '09012345678', 'test@jp', '$2y$10$090H4EYnbPyw46ExVXRk8uD8pVBQQ/C5bZcP/bFdXSaFzL.tTx91a'),
(213, '伊藤和馬', 'イトウカズマ', 'カズマ', '20', '男', '09012345678', 'kazuma@ne.jp', '$2y$10$ph78yRWTAfaj7U9gI4eNf.2XIHIsN8S3PBMR8dPZ.VLRPCeji.jDC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理者ID', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'イベントID ', AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `reserve`
--
ALTER TABLE `reserve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '予約ID', AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ユーザーID', AUTO_INCREMENT=214;
