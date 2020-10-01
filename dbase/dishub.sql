-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Okt 2020 pada 16.29
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dishub`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidang`
--

CREATE TABLE `bidang` (
  `id_bidang` varchar(50) NOT NULL,
  `nm_bidang` varchar(255) NOT NULL,
  `initial` char(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_usr` int(11) NOT NULL,
  `no_peg` varchar(50) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `tgl_login` datetime DEFAULT NULL,
  `aktif` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_usr`, `no_peg`, `slug`, `username`, `password`, `nama`, `email`, `level`, `foto`, `created_at`, `updated_at`, `tgl_login`, `aktif`) VALUES
(1, 'DISHUB-90876', 'bangameck', 'bangameck', '$2y$10$8w/iYXvcFHdiJFwdlSwHr.0mPbxhwIfDvwannLy3CPieTywXw7XjG', 'Rahmad Riskiadii', 'bangameck@bangameck.com', 1, 'default.png', '2020-09-02 18:41:41', '2020-09-21 18:50:42', NULL, 'Y'),
(5, 'DISHUB-15276', 'renal', 'renal', '$2y$10$8w/iYXvcFHdiJFwdlSwHr.0mPbxhwIfDvwannLy3CPieTywXw7XjG', 'Renaldi Sahputra', 'rerey@gmail.com', 3, 'default.png', '2020-09-21 18:52:01', '2020-09-21 18:52:01', NULL, 'Y'),
(8, 'DISHUB-42638', 'hafizgz', 'hafizgz', '$2y$10$8w/iYXvcFHdiJFwdlSwHr.0mPbxhwIfDvwannLy3CPieTywXw7XjG', 'Hafis Rahmat Gazali', 'hafizgz@gmail.com', 1, 'default.png', '2020-09-21 20:55:01', '2020-09-21 21:27:44', NULL, 'Y'),
(10, 'DISHUB-79243', 'petra', 'petra', '$2y$10$8w/iYXvcFHdiJFwdlSwHr.0mPbxhwIfDvwannLy3CPieTywXw7XjG', 'Petra Aresa', 'petra@petra.com', 1, 'DISHUB-79243-petra-01-oktober-2020-010156.jpg', '2020-09-25 11:46:38', '2020-10-01 01:01:56', NULL, 'Y'),
(18, 'DISHUB-65072', 'kokok', 'kokok', '$2y$10$8w/iYXvcFHdiJFwdlSwHr.0mPbxhwIfDvwannLy3CPieTywXw7XjG', 'joko', 'joko@joko.com', 1, 'DISHUB-65072-kokok-01-oktober-2020-010055.png', '2020-09-25 13:38:46', '2020-10-01 01:00:55', NULL, 'Y'),
(38, 'DISHUB-61582', 'ijas', 'ijas', '$2y$10$8w/iYXvcFHdiJFwdlSwHr.0mPbxhwIfDvwannLy3CPieTywXw7XjG', 'Jasrianto', 'c@c.com', 3, 'DISHUB-61582-ijas-26-september-2020-172351.jpg', '2020-09-26 17:05:08', '2020-09-26 17:23:51', NULL, 'Y'),
(40, 'DISHUB-12654', 'rahmad', 'rahmad', '$2y$10$8w/iYXvcFHdiJFwdlSwHr.0mPbxhwIfDvwannLy3CPieTywXw7XjG', 'Rahmad Riskiadi, ST', 'rahmad.looker@gmail.com', 1, 'DISHUB-12654-rahmad-01-oktober-2020-011332.jpg', '2020-10-01 01:13:32', '2020-10-01 01:13:32', NULL, 'Y');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_usr`),
  ADD UNIQUE KEY `no_peg` (`no_peg`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_usr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
