-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Sep 2020 pada 18.21
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `config`
--

CREATE TABLE `config` (
  `id` int(5) NOT NULL,
  `name` varchar(45) NOT NULL,
  `value` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `config`
--

INSERT INTO `config` (`id`, `name`, `value`) VALUES
(1, 'order_status', '1:L_PENDING,2:L_PROCESS,3:L_FAILED,4:L_SUCCESS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(5) NOT NULL,
  `name` varchar(40) NOT NULL,
  `parent_id` smallint(5) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `route` varchar(150) NOT NULL,
  `icon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`menu_id`, `name`, `parent_id`, `status`, `route`, `icon`) VALUES
(1, 'Dashboard', 0, 1, 'dashboard', 'fas fa-tachometer-alt'),
(2, 'Produk', 0, 1, 'product', 'fas fa-tachometer-alt'),
(3, 'Pesanan', 0, 1, '', 'fas fa-tachometer-alt'),
(4, 'Pesanan Pelanggan', 3, 1, 'order', 'fas fa-tachometer-alt'),
(5, 'Sejarah Pesanan', 3, 1, 'historyorder', 'fas fa-tachometer-alt'),
(6, 'Pengaturan', 0, 1, '', 'fas fa-tachometer-alt'),
(7, 'Pengaturan Pembayaran', 6, 1, 'paymentsetting', 'fas fa-tachometer-alt'),
(8, 'Pengaturan Grup Harga Barang', 6, 1, 'gouphargabarangpengaturan', 'fas fa-tachometer-alt');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_access`
--

CREATE TABLE `menu_access` (
  `role_id` smallint(6) NOT NULL,
  `menu_id` smallint(6) NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu_access`
--

INSERT INTO `menu_access` (`role_id`, `menu_id`, `type`) VALUES
(1, 1, 2),
(1, 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_type`
--

CREATE TABLE `payment_type` (
  `payment_id` int(5) NOT NULL,
  `payment_name` varchar(255) NOT NULL,
  `account_number` int(5) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `price_group`
--

CREATE TABLE `price_group` (
  `price_group_id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(16,2) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `product_id` char(5) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `weight` int(10) NOT NULL,
  `price_group_id` tinyint(5) NOT NULL,
  `price` decimal(16,2) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `proof_payment`
--

CREATE TABLE `proof_payment` (
  `order_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `payment_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `role_id` int(5) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'distributor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `store_order`
--

CREATE TABLE `store_order` (
  `id` int(5) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `user_id` int(5) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_price` decimal(16,2) NOT NULL,
  `note` text NOT NULL,
  `seller_user_id` int(5) NOT NULL,
  `variation_id` int(5) NOT NULL,
  `variation_name` varchar(255) NOT NULL,
  `variation_detail_name` varchar(255) NOT NULL,
  `status` tinyint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `role_id` int(5) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `fullname`, `role_id`, `telp`, `address`) VALUES
(1, 'test', '$2y$10$qPXrNjGZy9teYyCLXHCspuy37m2sMbhVpBxB3L0u.GrFSFwwT1QQm', 'testting', 1, '0866666666', 'testing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `variation`
--

CREATE TABLE `variation` (
  `variation_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `variation_name` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `variation_detail`
--

CREATE TABLE `variation_detail` (
  `id` int(5) NOT NULL,
  `variation_id` int(5) NOT NULL,
  `name_detail_variation` varchar(255) NOT NULL,
  `qty` int(5) NOT NULL,
  `price` decimal(16,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indeks untuk tabel `menu_access`
--
ALTER TABLE `menu_access`
  ADD PRIMARY KEY (`role_id`,`menu_id`);

--
-- Indeks untuk tabel `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indeks untuk tabel `price_group`
--
ALTER TABLE `price_group`
  ADD PRIMARY KEY (`price_group_id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indeks untuk tabel `proof_payment`
--
ALTER TABLE `proof_payment`
  ADD PRIMARY KEY (`order_id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indeks untuk tabel `store_order`
--
ALTER TABLE `store_order`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `variation`
--
ALTER TABLE `variation`
  ADD PRIMARY KEY (`variation_id`);

--
-- Indeks untuk tabel `variation_detail`
--
ALTER TABLE `variation_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `config`
--
ALTER TABLE `config`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `payment_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `price_group`
--
ALTER TABLE `price_group`
  MODIFY `price_group_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `proof_payment`
--
ALTER TABLE `proof_payment`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `store_order`
--
ALTER TABLE `store_order`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `variation`
--
ALTER TABLE `variation`
  MODIFY `variation_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `variation_detail`
--
ALTER TABLE `variation_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
