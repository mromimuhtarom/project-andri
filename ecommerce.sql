-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Okt 2020 pada 00.06
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
  `accept_name` varchar(100) DEFAULT NULL,
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
(1, 'Romi', 1, 'Bali', 17, 'Badung', '3454', 'dfgdf', 1, '082392191962', 1),
(2, 'winna', 4, 'Bengkulu', 62, 'Bengkulu', '324', 'fdbfgbfg', 1, '43556666', 2),
(3, NULL, 17, 'Kepulauan Riau', 48, 'Batam', '3455', 'vhgvh, bengkong', 2, NULL, 1),
(4, 'Franky', 17, 'Kepulauan Riau', 48, 'Batam', 'dsc', 'sdssd, bdfss', 2, '082244556677', 1),
(5, 'Mantap Jiwa sraya', 3, 'Banten', 402, 'Serang', '2142', 'sfsrrf,dgtgrt', 2, '082392191962', 2),
(6, 'Mantap Jiwa sraya', 1, 'Bali', 17, 'Badung', '2342', 'dsfsdf, sfdsd', 2, '082392191962', 1),
(7, 'Rizky Mashudi', 17, 'Kepulauan Riau', 48, 'Batam', '23456', 'Jl. Golden Prawn Komplek YKB Blok M No. 06,Bengkong', 5, '082392191962', 2),
(8, 'Yush Hige', 16, 'Kalimantan Utara', 257, 'Malinau', '2323423', 'dsfsdgfdsf,Bengkong', 6, '082392191962', 2),
(9, 'sdf', 3, 'Banten', 402, 'Serang', 'sd', 'sdf,sdf', 7, '082392191962', 2),
(10, 'Franky', 17, 'Kepulauan Riau', 48, 'Batam', '34563', 'dfg,bengkong', 8, '08111111111111', 2);

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
(1, 'Baju Pria', 0);

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
  `user_id` int(5) NOT NULL,
  `address_id` int(5) NOT NULL,
  `delivery_id` varchar(10) DEFAULT NULL,
  `service` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `chart`
--

INSERT INTO `chart` (`id`, `product_id`, `variation_id`, `variation_detail_id`, `qty`, `user_id`, `address_id`, `delivery_id`, `service`) VALUES
(2, 'bh001', 18, 0, 3, 2, 5, 'jne', 'OKE'),
(4, 'bh001', 18, 6, 10, 1, 1, 'pos', 'Paket Kilat Khusus');

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
(1, 'order_status', '1:L_PROCESS,2:L_FAILED,3:L_SUCCESS,4:L_APPROVE_PAYMENT'),
(2, 'delivery_service', 'jne:JNE,pos:Pos Indonesia,tiki:Tiki'),
(3, 'status', '0:L_DISABLED,1:L_ENABLED,2:L_REQUEST'),
(4, 'email_owner', 'jkj@na.com'),
(5, 'telp_owner', '082392191962'),
(6, 'title_tab_web', 'Eshoper');

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
(3, 'Pesanan', 0, 1, 'Orders', 'fas fa-shopping-cart'),
(4, 'Persetujuan Pembelian', 3, 1, 'Approvement-Payment', 'fas fa-shopping-cart'),
(5, 'Pesanan Pelanggan', 3, 1, 'Customer-Orders', 'fas fa-history'),
(6, 'Pengaturan', 0, 1, 'Settings', 'fas fa-cog'),
(7, 'Pengaturan Umum', 6, 1, 'General-Setting', 'fas fa-sliders-h'),
(8, 'Pengaturan Pembayaran', 6, 1, 'Payment-Setting', 'fas fa-hammer'),
(9, 'Pengaturan Grup Harga Barang', 6, 1, 'Price-Group', 'fas fa-tachometer-alt'),
(10, 'Category', 6, 1, 'Category', 'fas fa-layer-group'),
(11, 'Pengguna Admin', 0, 1, 'User-Admin', 'fas fa-user\r\n');

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
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(1, 4, 1),
(1, 5, 1),
(1, 6, 1),
(1, 7, 0),
(1, 8, 1),
(1, 9, 1),
(1, 10, 0),
(1, 11, 0),
(2, 1, 1),
(2, 2, 1),
(2, 3, 1),
(2, 4, 1),
(2, 5, 1),
(2, 6, 1),
(2, 7, 1),
(2, 8, 1),
(2, 9, 1),
(2, 10, 1),
(2, 11, 1),
(3, 1, 1),
(3, 2, 1),
(3, 3, 1),
(3, 4, 1),
(3, 5, 1),
(3, 6, 1),
(3, 7, 0),
(3, 8, 1),
(3, 9, 1),
(3, 10, 0),
(3, 11, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_type`
--

CREATE TABLE `payment_type` (
  `payment_id` int(5) NOT NULL,
  `payment_name` varchar(50) DEFAULT NULL,
  `account_number` varchar(25) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `payment_type`
--

INSERT INTO `payment_type` (`payment_id`, `payment_name`, `account_number`, `user_id`) VALUES
(2, 'BNI', '65737837', 1);

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
(2, 'BGH', '50000.00', 1),
(3, 'tgf', '45000.00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_id` char(5) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_id` int(5) NOT NULL,
  `weight` int(10) NOT NULL,
  `price_group_id` tinyint(5) NOT NULL,
  `price` decimal(16,2) NOT NULL,
  `user_id` int(5) NOT NULL,
  `picture` varchar(25) NOT NULL,
  `view` int(5) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `qty` int(5) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `product_id`, `product_name`, `category_id`, `weight`, `price_group_id`, `price`, `user_id`, `picture`, `view`, `datetime`, `qty`, `description`) VALUES
(1, 'bh001', 'Plang1', 1, 135, 3, '43000.00', 1, '1.jpg', 0, '2020-09-27 12:07:10', 30, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p> 									<p><b>Write Your Review</b></p>'),
(3, 'bh002', 'Permen', 1, 50, 2, '50000.00', 1, 'bh002.jpg', 0, '2020-10-29 16:26:00', 0, '<p>Permen ini adalah sebuah permen sayru yang sangat mantap</p>\r\n\r\n<p>pkokonya <span style=\"color:#f39c12\">enak</span></p>');

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
  `price_product` decimal(16,2) NOT NULL,
  `note` text NOT NULL,
  `seller_user_id` int(5) NOT NULL,
  `variation_id` int(5) NOT NULL,
  `variation_name` varchar(255) NOT NULL,
  `variation_detail_name` varchar(255) NOT NULL,
  `delivery_id` varchar(10) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `address_id` int(5) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `city_id` int(5) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `province_id` int(5) NOT NULL,
  `province_name` varchar(255) NOT NULL,
  `detail_address` text NOT NULL,
  `accept_name` varchar(255) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `status` tinyint(5) NOT NULL,
  `ongkir` int(12) NOT NULL,
  `payment_id` int(5) NOT NULL,
  `payment_name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `provementpic` varchar(255) DEFAULT NULL,
  `no_resi` varchar(255) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `store_order`
--

INSERT INTO `store_order` (`id`, `product_name`, `category_id`, `user_id`, `qty`, `price_product`, `note`, `seller_user_id`, `variation_id`, `variation_name`, `variation_detail_name`, `delivery_id`, `service_name`, `address_id`, `postal_code`, `city_id`, `city_name`, `province_id`, `province_name`, `detail_address`, `accept_name`, `telp`, `status`, `ongkir`, `payment_id`, `payment_name`, `picture`, `provementpic`, `no_resi`, `datetime`) VALUES
(1, 'Plang1', 2, 2, 4, '43543.00', 'Proses Pengiriman', 1, 18, 'sdfs', 'dfgdf', 'JNE', 'OKE', 5, '2142', 402, 'Serang', 3, 'Banten', 'Komplek Ykb Blok M No. 06', 'Mantap Jiwa sraya', '082392191962', 1, 24000, 1, 'bni', '1.jpg', '1.jpg', '4567896e433', '2020-10-11 08:56:25'),
(2, 'Plang1', 2, 1, 4, '45000.00', 'sdsd', 1, 18, 'sdfs', 'sdfs', 'pos', 'Paket Kilat Khusus', 1, '3454', 17, 'Badung', 1, 'Bali', 'Komplek Ykb Blok M No. 06', 'Romi', '082392191962', 2, 8000, 1, 'BNI', '1.jpg', '1.jpg', '4567896e433', '2020-10-19 08:50:51');

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
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `fullname`, `role_id`, `status`) VALUES
(1, 'test', '$2y$10$qPXrNjGZy9teYyCLXHCspuy37m2sMbhVpBxB3L0u.GrFSFwwT1QQm', 'testting', 2, 1),
(2, 'romi', '$2y$10$nAGM1JYHB26Z1ooihRUFvuwos5bG7Up462jIZ/fK6vJHxPLV70edi', 'Muhammad Romi Muhtarom', 4, 1),
(8, 'morin', '$2y$10$HQo8mMhry.MsASMzFtw.c.6Xkh8TZNLNAttbhhQAe1UCbLQ0nDWY.', 'Morin Higyo', 1, 1);

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
(18, 'bh001', 'ukuran permen');

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
(4, 18, 'sdfs', 21, '45000.00'),
(5, 18, 'dfgdf', 9, '43543.00'),
(6, 18, 'cvbc', 32, '45000.00'),
(7, 18, 'dfhdfgh', 32, '43000.00'),
(9, 18, 'dfgdf', 9, '43543.00'),
(10, 18, 'cvbc', 32, '45000.00'),
(11, 18, 'dfhdfgh', 32, '43000.00');

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
  ADD PRIMARY KEY (`id`,`product_id`);

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
  MODIFY `address_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `chart`
--
ALTER TABLE `chart`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `config`
--
ALTER TABLE `config`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `payment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `price_group`
--
ALTER TABLE `price_group`
  MODIFY `price_group_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `proof_payment`
--
ALTER TABLE `proof_payment`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `store_order`
--
ALTER TABLE `store_order`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `variation`
--
ALTER TABLE `variation`
  MODIFY `variation_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `variation_detail`
--
ALTER TABLE `variation_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
