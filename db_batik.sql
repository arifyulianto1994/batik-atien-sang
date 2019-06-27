-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27 Jun 2019 pada 06.23
-- Versi Server: 5.6.21
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_batik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_keluar`
--

CREATE TABLE IF NOT EXISTS `detail_keluar` (
  `kd_transaksi` char(15) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `kd_barang` char(7) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_keluar`
--

INSERT INTO `detail_keluar` (`kd_transaksi`, `tanggal_keluar`, `kd_barang`, `jumlah_keluar`, `harga`, `sub_total`) VALUES
('', '0000-00-00', 'B000001', 1, 1000, 1000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_masuk`
--

CREATE TABLE IF NOT EXISTS `detail_masuk` (
  `kd_transaksi` char(15) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `kd_barang` char(7) NOT NULL,
  `kd_supplier` char(7) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_masuk`
--

INSERT INTO `detail_masuk` (`kd_transaksi`, `tanggal_masuk`, `kd_barang`, `kd_supplier`, `jumlah_masuk`, `harga`, `sub_total`) VALUES
('TM-2019-0000001', '2019-06-27', 'B000004', 'S000003', 20, 20000, 400000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang_keluar`
--

CREATE TABLE IF NOT EXISTS `tb_barang_keluar` (
  `kd_transaksi` char(15) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `sub_total` int(11) NOT NULL,
  `created_user` int(2) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_barang_keluar`
--

INSERT INTO `tb_barang_keluar` (`kd_transaksi`, `tanggal_keluar`, `sub_total`, `created_user`, `created_date`) VALUES
('111', '2019-06-20', 1000, 0, '2019-06-19 17:02:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang_masuk`
--

CREATE TABLE IF NOT EXISTS `tb_barang_masuk` (
  `kd_transaksi` char(15) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `sub_total` int(11) NOT NULL,
  `created_user` int(2) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_barang_masuk`
--

INSERT INTO `tb_barang_masuk` (`kd_transaksi`, `tanggal_masuk`, `sub_total`, `created_user`, `created_date`) VALUES
('TM-2019-0000001', '2019-06-27', 400000, 0, '2019-06-27 04:21:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pakaian`
--

CREATE TABLE IF NOT EXISTS `tb_pakaian` (
  `kd_barang` char(7) NOT NULL DEFAULT '',
  `kd_supplier` char(7) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `kategori` enum('Blouse','Gamis','Brukat','Pakaian Anak','Sarimbit') NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stok` int(5) NOT NULL,
  `created_user` int(2) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_user` int(2) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pakaian`
--

INSERT INTO `tb_pakaian` (`kd_barang`, `kd_supplier`, `nama_barang`, `kategori`, `harga_beli`, `harga_jual`, `stok`, `created_user`, `created_date`, `updated_user`, `updated_date`) VALUES
('B000004', 'S000003', 'barang3', 'Brukat', 30000, 900000, 221, 4, '2019-06-26 02:27:29', 4, '2019-06-27 04:21:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peramalan`
--

CREATE TABLE IF NOT EXISTS `tb_peramalan` (
`id_peramalan` int(2) NOT NULL,
  `bulan_peramalan` varchar(8) NOT NULL,
  `jenis` enum('Blouse','Pakaian Anak','Gamis','Brukat','Sarimbit') NOT NULL,
  `hasil_peramalan` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_supplier`
--

CREATE TABLE IF NOT EXISTS `tb_supplier` (
  `kd_supplier` char(7) NOT NULL DEFAULT '',
  `nama_supplier` varchar(50) NOT NULL,
  `alamat_supplier` varchar(50) NOT NULL,
  `no_hp` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_supplier`
--

INSERT INTO `tb_supplier` (`kd_supplier`, `nama_supplier`, `alamat_supplier`, `no_hp`) VALUES
('S000002', 'Mega Busana', 'pkl', '081910298990'),
('S000003', 'Dapyuna', 'bdg', '0192736'),
('S000004', 'Batik Sari', 'Pekalongan', '081933');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
`id_user` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `telepon` char(13) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `hak_akses` enum('Admin','Manajer','','') NOT NULL,
  `status` enum('aktif','blokir') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama_user`, `telepon`, `foto`, `hak_akses`, `status`, `created_at`, `updated_at`) VALUES
(3, 'manajer', '69b731ea8f289cf16a192ce78a37b4f0', 'a', '085865524558', 'user-default.png', 'Manajer', 'aktif', '2019-03-24 03:27:25', '2019-06-25 02:46:32'),
(4, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'administrator', '08531420000', 'user-default.png', 'Admin', 'aktif', '2019-03-24 03:27:25', '2019-05-08 05:09:17'),
(5, 'pemilik', '58399557dae3c60e23c78606771dfa3d', 'pemilik', '08191290920', NULL, 'Manajer', 'aktif', '2019-04-05 02:07:56', '2019-05-03 13:46:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_keluar`
--
ALTER TABLE `detail_keluar`
 ADD PRIMARY KEY (`kd_transaksi`);

--
-- Indexes for table `detail_masuk`
--
ALTER TABLE `detail_masuk`
 ADD PRIMARY KEY (`kd_transaksi`);

--
-- Indexes for table `tb_barang_keluar`
--
ALTER TABLE `tb_barang_keluar`
 ADD PRIMARY KEY (`kd_transaksi`);

--
-- Indexes for table `tb_barang_masuk`
--
ALTER TABLE `tb_barang_masuk`
 ADD PRIMARY KEY (`kd_transaksi`);

--
-- Indexes for table `tb_pakaian`
--
ALTER TABLE `tb_pakaian`
 ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `tb_peramalan`
--
ALTER TABLE `tb_peramalan`
 ADD PRIMARY KEY (`id_peramalan`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
 ADD PRIMARY KEY (`kd_supplier`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_peramalan`
--
ALTER TABLE `tb_peramalan`
MODIFY `id_peramalan` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
