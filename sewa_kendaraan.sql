-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2026 at 10:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sewa kendaraan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kd_barang` varchar(6) NOT NULL,
  `nama_barang` varchar(40) NOT NULL,
  `harga` varchar(7) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `stok` int(3) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `gambar` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `nama_barang`, `harga`, `satuan`, `stok`, `deskripsi`, `status`, `gambar`) VALUES
('B-0002', 'Toyota Veloz', '450000', '', 3, 'Toyota Veloz cocok untuk pemakaian sewa pribadi seperti membawa keluarga dengann harga sewa menengah dan kapasitas kabin lebih lega', 'aktif', 'gambar-veloz.png'),
('B-0003', 'Toyota Calya', '240000', '', 2, 'Toyota Calya pilihan terbaik untuk penyewa rental yang membutuhkan space kabin luas, irit, dan dengan harga sewa yang terjangkau', 'aktif', 'gambar-calya.png'),
('B-0004', 'Toyota Agya', '225000', '', 3, 'Toyota Agya sangat cocok untuk calon konsumen rental muda, karena unit ini terkenal dengan irit, simpel, praktis, dan juga tentunya tampilan unitnya modern dan bergengsi', 'aktif', 'gambar-agya.png'),
('B-0005', 'Toyota Innova Reborn', '550000', '', 2, 'Toyota Innova Reborn (tersedia hanya varian diesel) sangat cocok untuk yang suka space kabin yang besar dan lega, serta mengutamakan kenyamanan dan tenaga yang besar', 'aktif', 'gambar-innova.png'),
('B-0006', 'Toyota Fortuner', '800000', '', 1, 'Toyota Fortuner sangat cocok untuk pemakaian sewa yang sering melewati jalan yang kurang mulus dengan tampilan mobil yang mewah, gagah, dan tentunya bergengsi', 'aktif', 'gambar-fortuner.png'),
('B-0008', 'Hiace Commuter', '1000000', '', 3, 'Hiace sangat cocok untuk membawa penumpang yang berjumlah banyak seperti berjumlah diatas 7 orang', 'aktif', 'gambar-hiace.png'),
('B-0009', 'Toyota Hilux', '780000', '', 3, 'Toyota Hilux sangat cocok untuk angkut barang dengan tampilan mobil yang luxury dan bisa melewati jalanan yang kurang bagus dengan baik', 'aktif', 'gambar-hilux.png'),
('B-0010', 'Suzuki Carry', '250000', '', 4, 'Suzuki Carry terkenal dengan pick up yang sering dipandang karena irit, biaya sewa yang murah, dan ukuran mobil yang tidak terlalu besar sehingga lebih praktis jika dibandingkan dengan pick up lainnya', 'aktif', 'gambar-carry.png');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_pelanggan` varchar(40) NOT NULL,
  `kd_barang` varchar(6) NOT NULL,
  `qty` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(40) NOT NULL,
  `nama_pelanggan` varchar(40) NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `telp_pelanggan` varchar(13) NOT NULL,
  `email_pelanggan` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat_pelanggan`, `telp_pelanggan`, `email_pelanggan`, `password`) VALUES
('naufal12', 'Naufal Fadhila', 'Mentok', '081368607715', 'naufal.fadhila127@gmail.com', 'admin123'),
('Naufal_Fadhila', 'Muhammad Naufal Fadhila', 'Mentok', '081368607715', 'naufal.fadhila127@gmail.com', '120706');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` varchar(5) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `metode_pembayaran` varchar(40) NOT NULL,
  `bukti_pembayaran` varchar(40) NOT NULL,
  `status_pembayaran` varchar(10) NOT NULL,
  `no_pemesanan` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `no_pemesanan` varchar(5) NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `status_pemesanan` varchar(9) NOT NULL,
  `total_pemesanan` varchar(8) NOT NULL,
  `id_pelanggan` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`no_pemesanan`, `tanggal_pemesanan`, `status_pemesanan`, `total_pemesanan`, `id_pelanggan`) VALUES
('1', '2026-05-21', 'Dikirim', '160000', 'naufal12'),
('10', '2026-06-02', 'Dikirim', '900000', 'Naufal_Fadhila'),
('2', '2026-05-21', 'Dikirim', '90000', 'naufal12'),
('3', '2026-05-21', 'Dikirim', '0', 'naufal12'),
('4', '2026-05-21', 'Dikirim', '340000', 'naufal12'),
('5', '2026-05-25', 'Dikirim', '360000', 'Naufal_Fadhila'),
('6', '2026-05-25', 'Dikirim', '120000', 'Naufal_Fadhila'),
('7', '2026-05-25', 'Dikirim', '10000', 'Naufal_Fadhila'),
('8', '2026-06-01', 'Dikirim', '900000', 'Naufal_Fadhila'),
('9', '2026-06-02', 'Dikirim', '1350000', 'Naufal_Fadhila');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_detail`
--

CREATE TABLE `pemesanan_detail` (
  `no_pemesanan` varchar(5) NOT NULL,
  `kd_barang` varchar(6) NOT NULL,
  `qty` int(3) NOT NULL,
  `harga` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan_detail`
--

INSERT INTO `pemesanan_detail` (`no_pemesanan`, `kd_barang`, `qty`, `harga`) VALUES
('1', 'B-0001', 1, '40000'),
('1', 'B-0007', 1, '120000'),
('10', 'B-0002', 2, '450000'),
('2', 'B-0003', 1, '90000'),
('4', 'B-0003', 2, '90000'),
('4', 'B-0004', 4, '40000'),
('5', 'B-0003', 4, '90000'),
('6', 'B-0004', 3, '40000'),
('7', 'B-0005', 1, '10000'),
('8', 'B-0002', 2, '450000'),
('9', 'B-0002', 3, '450000');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengirim` varchar(5) NOT NULL,
  `tanggal_pengirim` date NOT NULL,
  `no_resi` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `id_pembayaran` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_pelanggan`,`kd_barang`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`no_pemesanan`);

--
-- Indexes for table `pemesanan_detail`
--
ALTER TABLE `pemesanan_detail`
  ADD PRIMARY KEY (`no_pemesanan`,`kd_barang`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengirim`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
