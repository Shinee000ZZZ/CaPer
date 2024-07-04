-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jul 2024 pada 12.02
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `caper`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `catatan`
--

CREATE TABLE `catatan` (
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `lokasi` char(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `id_table` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `catatan`
--

INSERT INTO `catatan` (`tanggal`, `waktu`, `deskripsi`, `lokasi`, `foto`, `user_id`, `id_table`) VALUES
('2024-06-11', '11:05:30', 'Foto sama rencang rencang', 'SMK Negeri 1 Banjar, Jalan Kyai Haji Mustofa, Banjar, Jawa Barat, Jawa, 46311, Indonesia', '9ntf1i.jpg', 9, 1),
('2024-06-11', '11:08:17', 'arkan', 'SMK Negeri 1 Banjar, Jalan Kyai Haji Mustofa, Banjar, Jawa Barat, Jawa, 46311, Indonesia', 'sqdndho.jpg', 9, 2),
('2024-06-11', '21:50:05', 'so imut ica sama lusi wkwk', 'SMK Negeri 1 Banjar, Jalan Kyai Haji Mustofa, Banjar, Jawa Barat, Jawa, 46311, Indonesia', 't6ohj.jpg', 9, 3),
('2024-06-14', '17:41:20', 'petor', 'Mekarbakti, Garut, Jawa Barat, Jawa, 44152, Indonesia', 'jaay3.jpg', 9, 5),
('2024-06-14', '19:20:39', 'JEFRI NICHOL!!???????', 'Jalan Morse, Braga, Sumur Bandung, Bandung, Jawa Barat, Jawa, 40111, Indonesia', 'jfvzs.jpg', 9, 9),
('2024-06-14', '19:22:00', 'MEWING GODD', 'Jalan Balong Gede, Balonggede, Regol, Bandung, Jawa Barat, Jawa, 40251, Indonesia', '7v4f26.jpg', 9, 10),
('2024-06-14', '20:02:34', 'KING BALD WINN!?????? HEL NAWW', 'Subang, Jawa Barat, Jawa, 41211, Indonesia', '64wepf.jpg', 9, 12),
('2024-06-14', '20:22:35', '././/./.././.', 'jirlah', 'g4fqwq.jpg', 9, 18),
('2024-06-14', '20:24:01', 'arkan belok pacar fathir', 'Subang, Jawa Barat, Jawa, 41211, Indonesia', '7ff4.jpg', 9, 19),
('2024-06-14', '20:36:23', 'APAPAPAPPAPAPPAPAA', 'Subang, Jawa Barat, Jawa, 41211, Indonesia', 'y60bon.jpg', 9, 21),
('2024-06-14', '20:41:09', 'FAREL BOT', 'Purwaharja, Banjar, Jawa Barat, Jawa, 46331, Indonesia', '2x4axr.jpg', 9, 24),
('2024-06-15', '13:53:15', 'kokok', 'Jalan Cibadak, Cibadak, Astanaanyar, Bandung, Jawa Barat, Jawa, 40181, Indonesia', '5mv2g4.jpg', 9, 48),
('2024-06-15', '14:14:33', 'bexiiieerr', 'Jalan Cibadak, Cibadak, Astanaanyar, Bandung, Jawa Barat, Jawa, 40181, Indonesia', 'q28psw.jpg', 9, 55),
('2024-06-15', '22:32:33', 'pp', 'DeRain, 76-80, Jalan Lengkong Kecil, Paledang, Lengkong, Bandung, Jawa Barat, Jawa, 40261, Indonesia', 'ajui0x.jpg', 9, 67),
('2024-06-19', '12:09:53', 'apa', 'SMK Negeri 1 Banjar, Jalan Kyai Haji Mustofa, Banjar, Jawa Barat, Jawa, 46311, Indonesia', 'p6b44q.jpg', 9, 69);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(9, 'bejir', 'bejir123'),
(20, 'saltun', 'qwerty'),
(21, 'Jasmine', 'haha123'),
(22, 'Saltun Ganteng', '123'),
(23, 'lah', 'lah'),
(24, 'anjay', 'pppooo'),
(25, 'Sultan', 'qwerty'),
(26, 'POPO', 'asqw'),
(27, 'pp', 'oo'),
(28, 'asas', 'ddd'),
(29, 'fathir', '111'),
(30, 'local', 'admin'),
(31, 'locall', 'admin'),
(32, 'localll', 'hahay'),
(33, 'ambivertbikinbingung', 'ww'),
(35, 'jj', 'jedag');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`tanggal`,`waktu`,`lokasi`),
  ADD UNIQUE KEY `id_table` (`id_table`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `catatan`
--
ALTER TABLE `catatan`
  MODIFY `id_table` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
