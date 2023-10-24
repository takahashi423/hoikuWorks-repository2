-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-10-23 09:27:01
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `hoikunomikata`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `images`
--

CREATE TABLE `images` (
  `id` int(255) NOT NULL COMMENT 'イメージID',
  `path` varchar(255) NOT NULL COMMENT 'イメージパス',
  `name` varchar(255) NOT NULL COMMENT 'ファイル名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `likes`
--

CREATE TABLE `likes` (
  `id` int(255) NOT NULL COMMENT 'いいねID',
  `user_id` int(255) DEFAULT NULL COMMENT 'ユーザーID',
  `work_id` int(255) DEFAULT NULL COMMENT '作品ID',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'いいね日時',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `work_id`, `created_at`, `updated_at`) VALUES
(6, 4, 18, '2023-10-16 07:43:50', '2023-10-16 07:43:50'),
(17, 4, 11, '2023-10-16 09:40:16', '2023-10-16 09:40:16'),
(37, 4, 13, '2023-10-16 09:52:28', '2023-10-16 09:52:28'),
(90, 4, 10, '2023-10-17 02:38:50', '2023-10-17 02:38:50'),
(105, 4, 9, '2023-10-17 03:02:08', '2023-10-17 03:02:08'),
(130, 2, 10, '2023-10-23 03:38:10', '2023-10-23 03:38:10');

-- --------------------------------------------------------

--
-- テーブルの構造 `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` int(255) NOT NULL COMMENT 'リセットID',
  `email` varchar(255) NOT NULL COMMENT 'メールアドレス',
  `token` varchar(255) NOT NULL COMMENT 'トークン',
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6) COMMENT '登録日時',
  `update_at` datetime(6) NOT NULL DEFAULT current_timestamp(6) COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id`, `email`, `token`, `created_at`, `update_at`) VALUES
(25, 'p@p', '$2y$10$fN06HMam3X0B2Du/iljP/.r1LrcAw5XO6xtAe14..xnyTR8zz/oSm', '2023-10-20 16:07:48.000000', '2023-10-20 16:07:48.056798');

-- --------------------------------------------------------

--
-- テーブルの構造 `seasons`
--

CREATE TABLE `seasons` (
  `id` int(255) NOT NULL COMMENT '季節ID',
  `season_name` varchar(32) NOT NULL COMMENT '季節名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `seasons`
--

INSERT INTO `seasons` (`id`, `season_name`) VALUES
(1, '春'),
(2, '夏'),
(3, '秋'),
(4, '冬');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL COMMENT 'ユーザーID',
  `name` varchar(255) DEFAULT NULL COMMENT 'ユーザー名',
  `email` varchar(255) DEFAULT NULL COMMENT 'メールアドレス',
  `password` varchar(255) DEFAULT NULL COMMENT 'パスワード',
  `remember_token` varchar(255) DEFAULT NULL COMMENT 'リメンバートークン'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`) VALUES
(1, 'test', 'test@test', '$2y$10$Dn14UtPd0rbo/s9IoQyCzOJkkdIn9bO0nXfoAxpS6fgeeU8AK3/uu', 'JKPCRjgdJBseMJqsZlEGmgHj4ivGHLS71BLHuQZXQ2muQnVipR7fV2T6vnO6'),
(2, 'テスト', 'test@co.jp', '$2y$10$FZG86uW2hwCoTVaa/MmLJOcaQnKFKpOwpVCyAAPOeYy0P83kgsTPi', NULL),
(3, 'a', 'a@a', '$2y$10$Sl0RTJ0.lR1VaosZ2LAcpurulI2vLbgoT.fRlQISrcItQXbcxEXJ6', NULL),
(4, 'test', 'p@p', '$2y$10$yGtoCMuD5VmeWAKqVyH3EeK8Mh2BgcQMrv13kvAtrLy4S8UADyVHa', NULL),
(5, 'あ', 'pp@p', '$2y$10$UE.rq0t9gvC1yfNLSRPmwexIgOwJYIS..iBGr.zWmCwfADeSQz5C6', NULL),
(6, 'test', 'o@p', '$2y$10$CbR9smYxV6PFJ.NA4h8Qe.5SekGw.cxqeCRsSHQrXBsEcOS1ohokG', NULL),
(7, 'test2', 'l@l', '$2y$10$Ms1xIpjhzP/TXVtflzBsfOd/yYXSGkoPYjzzyk6KZdP/WFVdn0dLq', NULL),
(8, 'test', 'k@k', '$2y$10$lmLmyb/AjUJDzG1aMyCaEuh86bkkElL0qqaMcAsFZuHHr2MdxFp6G', NULL),
(9, 'あ', 'm@m', '$2y$10$xh5lVk1080QB1XScz.x/ge7vOprxldMTh4Crk8PKK/SNdlXY3KMCe', NULL),
(10, 'test5', 'i@i', '$2y$10$vykXbNbv8XF16rQnHBh00elUiYyY7Nt1KEtEXsgPSYrCFqlxlPCmm', NULL),
(11, 'test', 'e@e', '$2y$10$ogm6GDDvoTdlVvhE7OjHTOtaBVohCR5GSp0gY7c..ifdQ0ECwyJEi', NULL),
(12, 'テスト', 'e@p', '$2y$10$aaRYYdYC1CJMANgTCi7rtecZGsuU31cd2e5rnoTIQtP6CEJzbgCTe', NULL),
(13, 'test', 'pp@pp', '$2y$10$QYk6jlYAR7VYlDbv/wpJwOsJDTttJcJcidy9GQQANCw0g7N8.3Dbm', NULL),
(14, 'user', 'test@test2', '$2y$10$HQaCTJpgBox2eIbYqQX/8epV90Rr5v5LSsq6Iep0FIgmSWwxgU9QG', NULL),
(15, 'テスト１', 'q@q', '$2y$10$04ej1PDyUJy3cwx/2uBz..Hf6D5CQkvdn8RVm5DiR/dAFNzcMmsri', NULL),
(16, 'テスト２', 'w@w', '$2y$10$sJl4Bq7Bl6auI0IjIRf9Eei6e7uwI6UStRGTLnXr/RGojFKgRAd2u', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `works`
--

CREATE TABLE `works` (
  `id` int(255) NOT NULL COMMENT '作品ID',
  `user_id` int(11) DEFAULT NULL COMMENT 'ユーザーID',
  `title` varchar(255) DEFAULT NULL COMMENT '作品名',
  `image_path` varchar(255) NOT NULL COMMENT '作品画像パス',
  `material` varchar(255) DEFAULT NULL COMMENT '材料名',
  `season_id` varchar(255) NOT NULL COMMENT '季節ID',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '送信日付'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `works`
--

INSERT INTO `works` (`id`, `user_id`, `title`, `image_path`, `material`, `season_id`, `created_at`) VALUES
(8, 15, 'テスト', 'MJKziauZ04r9GyMzupITB87eWrQ85jHRFKkM58b5.png', 'テスト', '春', '2023-10-03 10:45:01'),
(9, 15, 'テスト２', 'a9FZNN5DS815IGuubD1GZULHrTrEdCSFoGLMgPzW.png', 'テスト２', '春', '2023-10-03 10:45:27'),
(10, 15, 'テスト３', 'Zvz9kQshiWT13lqZ5BOXAgculOjHdLyMdSkm6H26.png', 'テスト３', '春', '2023-10-03 10:45:50'),
(11, 16, 'てすと', 'XD5gsw0SHkRW9Nk1PyWo0WHMFtzWF7Crn0yGJ7D2.png', 'てすと', '春', '2023-10-03 10:46:41'),
(12, 16, 'てすと', 'MevXb0CZzHlmIMsCNEXvpTBzmzWGJlP12OSKGc6h.png', 'てすと', '春', '2023-10-03 10:47:02'),
(13, 16, '犬かもしれないネズミ', 'qog8V7Yr173gW37ZBKq4M0UPEN9SXxt8jwtWDFFr.png', 'あああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ', '春', '2023-10-03 13:40:39'),
(14, 16, 'テスト', 'nWONRug41REnmRB6mpBDOfi4Vlcg2zbVkkhgFTXw.png', '画用紙、絵の具', '夏', '2023-10-03 18:10:54'),
(18, 4, '最終テスト', 'bVzU6yzybZugEyAx4SG9WF3NfdUUJZdiXdVwYNvZ.png', 'テスト　夏から秋へ', '秋', '2023-10-04 00:21:33'),
(19, NULL, 'あ', 'XN4A3urT2k6okg0m1nYcBKnGuq6qDGK2oYgv2h6Z.png', 'あ', '春', '2023-10-04 18:06:04'),
(20, 4, '編集２', 'fRVM2lUxuGuMRcNdRDdtLWsPHcdWBCUljEnsfBKT.png', '編集', '春', '2023-10-04 18:08:16'),
(21, 4, 'B-C', 'RXHBSNnjODFcEMJckupyggeKKSwRy2gBaWBh3QvS.png', 'A', '春', '2023-10-06 14:19:08'),
(22, 4, '本気テスト', 'UlfBqPUTN7fYRfxghpNsgfZy533oiwTahHxNrLv3.png', '本気テスト', '夏', '2023-10-06 17:52:22'),
(23, 4, 'あ', 'f3PabVzYaSNemelewJHszFzxiN4CfB24A5IdC4w5.png', 'あ', '春', '2023-10-06 17:53:51'),
(24, 4, 'い→う', '42r0r2e2ZBzU139NnqQW6J3R2C4Ah2DHORZh3Gyp.png', 'い', '夏', '2023-10-06 17:54:15'),
(25, 4, 'テスト編集ver.2', 'wS1e1zdiWedFvlcDozQsnMbddW61rbiNtl6EW7BZ.png', 'これはテストです', '春', '2023-10-06 18:34:33'),
(26, 4, 'いいねチャレンジ', '1NiQxdwOnKZKdyJxMBmrxctSK1AAwXPFBkd9X6Bk.png', 'いいね', '夏', '2023-10-11 18:30:42'),
(27, 4, '花', 'sBGQhVBkROvb47JrxdepCOVqsiNQ8Ocvmu5Z1EdP.png', '紙', '春', '2023-10-20 16:22:02'),
(28, 2, '花の絵', 'UIeRbit4EdhUDPZ5Bt3hmDxbadoXVJak3kolj8kH.png', '絵の具', '夏', '2023-10-21 18:14:33'),
(29, 2, '夏の絵', 'BEQT9a8Oi4txnEAs72YuhBzdQArLYZqrz9HRy1gm.png', '画用紙', '夏', '2023-10-21 18:16:14'),
(30, 2, 'テスト', 'CJ02UUpLWcYTjTFc3yhXiF9NDvJhB6OzJQXUHFY4.png', '絵の具', '春', '2023-10-22 16:36:16');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `images`
--
ALTER TABLE `images`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'イメージID';

--
-- テーブルの AUTO_INCREMENT `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'いいねID', AUTO_INCREMENT=132;

--
-- テーブルの AUTO_INCREMENT `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'リセットID', AUTO_INCREMENT=27;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'ユーザーID', AUTO_INCREMENT=17;

--
-- テーブルの AUTO_INCREMENT `works`
--
ALTER TABLE `works`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT '作品ID', AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
