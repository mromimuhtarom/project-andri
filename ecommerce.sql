-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Okt 2020 pada 01.41
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
-- Struktur dari tabel `address`
--

CREATE TABLE `address` (
  `address_id` int(5) NOT NULL,
  `accept_name` varchar(255) DEFAULT NULL,
  `province_id` int(5) NOT NULL,
  `province_name` varchar(255) NOT NULL,
  `city_id` int(5) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `detail_address` text NOT NULL,
  `user_id` int(5) NOT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `status` tinyint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `address`
--

INSERT INTO `address` (`address_id`, `accept_name`, `province_id`, `province_name`, `city_id`, `city_name`, `postal_code`, `detail_address`, `user_id`, `telp`, `status`) VALUES
(1, 'Romi', 25, '', 3, '', '3454', 'dfgdf', 1, '082392191962', 2),
(2, 'winna', 4, '', 0, '', '324', 'fdbfgbfg', 1, '43556666', 1),
(3, NULL, 17, 'Kepulauan Riau', 48, 'Batam', '3455', 'vhgvh, bengkong', 2, NULL, 1),
(4, 'Franky', 17, 'Kepulauan Riau', 48, 'Batam', 'dsc', 'sdssd, bdfss', 2, '082244556677', 1),
(5, 'Mantap Jiwa sraya', 3, 'Banten', 402, 'Serang', '2142', 'sfsrrf,dgtgrt', 2, '082392191962', 2),
(6, 'Mantap Jiwa sraya', 1, 'Bali', 17, 'Badung', '2342', 'dsfsdf, sfdsd', 2, '082392191962', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `category_id` int(5) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `parent_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `parent_id`) VALUES
(1, 'Pakaian', 0),
(2, 'Baju Pria', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `chart`
--

CREATE TABLE `chart` (
  `id` int(5) NOT NULL,
  `product_id` char(5) NOT NULL,
  `variation_id` int(5) NOT NULL,
  `variation_detail_id` int(5) NOT NULL,
  `qty` int(5) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `chart`
--

INSERT INTO `chart` (`id`, `product_id`, `variation_id`, `variation_detail_id`, `qty`, `user_id`) VALUES
(1, 'bh001', 18, 4, 4, 1);

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
(2, 'Produk', 0, 1, 'product', 'fab fa-product-hunt'),
(3, 'Pesanan', 0, 1, '', 'fas fa-shopping-cart'),
(4, 'Pesanan Pelanggan', 3, 1, 'order', 'fas fa-shopping-cart'),
(5, 'Sejarah Pesanan', 3, 1, 'historyorder', 'fas fa-history'),
(6, 'Pengaturan', 0, 1, '', 'fas fa-cog'),
(7, 'Pengaturan Pembayaran', 6, 1, 'paymentsetting', 'fas fa-hammer'),
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

--
-- Dumping data untuk tabel `payment_type`
--

INSERT INTO `payment_type` (`payment_id`, `payment_name`, `account_number`, `user_id`) VALUES
(1, 'BNI', 3454352, 1);

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

--
-- Dumping data untuk tabel `price_group`
--

INSERT INTO `price_group` (`price_group_id`, `name`, `price`, `user_id`) VALUES
(1, 'tfg', '45000.00', 1),
(2, 'BGH', '50000.00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `product_id` char(5) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_id` int(5) NOT NULL,
  `weight` int(10) NOT NULL,
  `price_group_id` tinyint(5) NOT NULL,
  `price` decimal(16,2) NOT NULL,
  `user_id` int(5) NOT NULL,
  `picture` varchar(25) NOT NULL,
  `view` int(5) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `category_id`, `weight`, `price_group_id`, `price`, `user_id`, `picture`, `view`, `datetime`) VALUES
('bh001', 'Plang1', 2, 135, 1, '45000.00', 1, 'bh001.jpg', 0, '2020-09-27 12:07:10');

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
(1, 'distributor'),
(2, 'pemilik'),
(3, 'reseller'),
(4, 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `store_order`
--

CREATE TABLE `store_order` (
  `id` int(5) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_id` int(5) NOT NULL,
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
  `telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `fullname`, `role_id`, `telp`) VALUES
(1, 'test', '$2y$10$qPXrNjGZy9teYyCLXHCspuy37m2sMbhVpBxB3L0u.GrFSFwwT1QQm', 'testting', 1, '0866666666'),
(2, 'romi', '$2y$10$nAGM1JYHB26Z1ooihRUFvuwos5bG7Up462jIZ/fK6vJHxPLV70edi', 'Muhammad Romi Muhtarom', 4, '082392191962');

-- --------------------------------------------------------

--
-- Struktur dari tabel `variation`
--

CREATE TABLE `variation` (
  `variation_id` int(5) NOT NULL,
  `product_id` char(5) NOT NULL,
  `variation_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `variation`
--

INSERT INTO `variation` (`variation_id`, `product_id`, `variation_name`) VALUES
(18, 'bh001', 'sdfs');

-- --------------------------------------------------------

--
-- Struktur dari tabel `variation_detail`
--

CREATE TABLE `variation_detail` (
  `id` int(5) NOT NULL,
  `variation_id` int(5) NOT NULL,
  `name_detail_variation` varchar(255) DEFAULT NULL,
  `qty` int(5) NOT NULL,
  `price` decimal(16,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `variation_detail`
--

INSERT INTO `variation_detail` (`id`, `variation_id`, `name_detail_variation`, `qty`, `price`) VALUES
(4, 18, 'sdfs', 25, '45000.00'),
(5, 18, 'dfgdf', 25, '43543.00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `chart`
--
ALTER TABLE `chart`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `chart`
--
ALTER TABLE `chart`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `payment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `price_group`
--
ALTER TABLE `price_group`
  MODIFY `price_group_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `proof_payment`
--
ALTER TABLE `proof_payment`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `store_order`
--
ALTER TABLE `store_order`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `variation`
--
ALTER TABLE `variation`
  MODIFY `variation_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `variation_detail`
--
ALTER TABLE `variation_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
