-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 13, 2022 lúc 05:15 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `signup`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tokenpass`
--

CREATE TABLE `tokenpass` (
  `id_token` int(11) UNSIGNED NOT NULL,
  `token_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_expires` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tokenpass`
--

INSERT INTO `tokenpass` (`id_token`, `token_email`, `token_hash`, `token_expires`) VALUES
(31, 'huyhoang1123.00@gmail.com', '$2y$10$uaJkKZ.M.sU8358Uzc0K8uXB2Krm1ZYF/9DYjafvP6WxmmCwPVqde', '1647247368'),
(32, 'huyhoang1123.00@gmail.com', '87c0bf1cdbdb461ae08fef6c', '1647248416'),
(33, 'huyhoang1123.00@gmail.com', '56014c56e0018e1715194f1a', '1647250660'),
(34, 'huyhoang1123.00@gmail.com', '77c4c69b379fdbbc5feb0cda', '1647251216'),
(35, 'huyhoang1123.00@gmail.com', 'ce03426939f9d25070428ab5', '1647251374'),
(36, 'huyhoang1123.00@gmail.com', '2e0ded493a98fa069f81d658', '1647252153'),
(37, 'huyhoang1123.00@gmail.com', 'e5e13b954104a706251cdd05', '1647270823'),
(38, 'huyhoang1123.00@gmail.com', '5c398c7c2952cdffe3cace22', '1647272056'),
(39, 'huyhoang1123.00@gmail.com', '3f5bf08112e392674cc36996', '1647272577'),
(40, 'huyhoang1123.00@gmail.com', 'b0e2efb4888359488cc20608', '1647273404');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tokenpass`
--
ALTER TABLE `tokenpass`
  ADD PRIMARY KEY (`id_token`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tokenpass`
--
ALTER TABLE `tokenpass`
  MODIFY `id_token` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
