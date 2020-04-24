-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Apr 2020 pada 10.32
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `medicines`
--

CREATE TABLE `medicines` (
  `medic_id` int(16) UNSIGNED NOT NULL,
  `medic_name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `category` varchar(256) CHARACTER SET utf8 NOT NULL,
  `amount` int(16) NOT NULL,
  `cost` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `medicines`
--

INSERT INTO `medicines` (`medic_id`, `medic_name`, `description`, `category`, `amount`, `cost`) VALUES
(1, 'Paracetamol', '                                                    Obat penurun panas                                                ', 'Analgesik', 30, 45),
(2, 'Neuralgyn', '                                                    Obat sakit kepala                                                ', 'Analgesik', 23, 150),
(3, 'Acetaminophen', '                          Meredakan demam dan nyeri                        ', 'Analgesik', 42, 120),
(4, 'Temulawak', 'Tanaman obat herbal untuk mengobati sakit kuning, diare, maag, perut kembung dan pegal-pegal', 'Herbal', 55, 135),
(7, 'Sambilito', 'Tanaman herbal yang mampu melindungi hati dari efek negatif galaktosamin dan parasetamol.', 'Herbal', 50, 35);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `medic_id` int(10) UNSIGNED NOT NULL,
  `order_amount` double NOT NULL DEFAULT '0',
  `order_cost` double NOT NULL DEFAULT '0',
  `setted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `medic_id`, `order_amount`, `order_cost`, `setted`) VALUES
(1, 2, 1, 12, 1200, 1),
(3, 2, 2, 5, 750, 1),
(4, 2, 4, 5, 675, 1),
(5, 2, 4, 5, 675, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `email`, `is_admin`) VALUES
(1, 'admin', '$2y$10$O6wv/1VtdLea.Dsvr/Xyp.JyidNGhIepXWqUbOEIWZJckTEIHmE72', 'admin@guardian.com', 1),
(2, 'rahman', '$2y$10$BiOqXEn3rhT0cZb1TC79fuNL0sXk8.Uij0w9Cm3T4YocjsrRoI1De', 'rahman@gmail.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`medic_id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_medic_id` (`medic_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `medicines`
--
ALTER TABLE `medicines`
  MODIFY `medic_id` int(16) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_medic_id` FOREIGN KEY (`medic_id`) REFERENCES `medicines` (`medic_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
