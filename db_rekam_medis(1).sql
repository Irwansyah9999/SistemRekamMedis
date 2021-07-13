-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2021 at 05:55 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rekam_medis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokter`
--

CREATE TABLE `tb_dokter` (
  `id_dokter` varchar(10) NOT NULL,
  `nama_dokter` varchar(25) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `alamat` text,
  `foto` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dokter`
--

INSERT INTO `tb_dokter` (`id_dokter`, `nama_dokter`, `tanggal_lahir`, `jenis_kelamin`, `email`, `no_telepon`, `alamat`, `foto`) VALUES
('D1', 'Maryati', '1993-12-12', 'P', 'maryati@gmail.com', '087871604911', 'Jl. Cengkareng', 'user/dokter/Maryati.png'),
('D2', 'Siti Darmawati', '1993-08-12', 'P', 'darmawati@gmail.com', '083807264097', 'Jl. Dadap', 'user/dokter/.jpg'),
('D3', 'Ana Widiana', '1995-02-07', 'P', 'widianaana@gmail.com', '081911221955', 'Jl. Cikupa', 'user/dokter/Ana Widiana.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `id_pasien` int(8) NOT NULL,
  `nama_pasien` varchar(25) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `golongan_darah` varchar(2) NOT NULL,
  `pekerjaan` varchar(25) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pasien`
--

INSERT INTO `tb_pasien` (`id_pasien`, `nama_pasien`, `tanggal_lahir`, `jenis_kelamin`, `golongan_darah`, `pekerjaan`, `no_telepon`, `alamat`) VALUES
(2, 'Me mei', '1999-12-02', 'P', 'AB', 'Lainnya', '089125381902', 'Jl. Cengklong'),
(3, 'Suryadi', '1999-12-04', 'L', 'B', 'Karyawan Swasta', '081821692013', 'Jl. Kosambi Timur '),
(4, 'Putri Ningrum', '1996-01-07', 'P', 'B', 'Wiraswasta', '081821692013', 'Jl. Perancis'),
(5, 'Indah Kurnia', '1995-01-07', 'P', 'B', 'Karyawan Swasta', '085219782651', 'Jl. Jatimulya'),
(6, 'Gusti Putra', '1992-12-21', 'L', 'O', 'Wiraswasta', '081127186542', 'Jl. Belimbing'),
(7, 'Susi Lestari', '1995-03-01', 'P', 'O', 'Lainnya', '081165298713', 'Jl. Kemplang'),
(8, 'Surya Atmaja', '2007-05-02', 'L', 'A', 'Lainnya', '089518762901', 'Jl.Cengklong'),
(9, 'Tita Nurdiana', '1997-07-29', 'P', 'O', 'Karyawan Swasta', '083813982763', 'Jl. Muara'),
(10, 'Bejo Suherman', '1990-11-06', 'L', 'A', 'Lainnya', '081176435218', 'Jl. Muara'),
(11, 'siti aisah', '1996-02-14', 'P', 'B', 'Lainnya', '081527672122', 'jl. dadap'),
(12, 'andriyani ', '2010-03-10', 'P', 'A', 'Lainnya', '081567867546', 'kp. cengklong\r\n '),
(13, 'nur hadiyani ', '2015-04-15', 'P', 'AB', 'Lainnya', '089878675754', 'kp. belimbing'),
(14, 'rindi agustin', '2005-12-23', 'P', 'A', 'Karyawan Swasta', '089879543578', 'jl. kosambi'),
(15, 'fikri ramadhan ', '2017-01-19', 'L', 'O', 'Lainnya', '085745674321', 'jalan raya perancis'),
(16, 'hafiz muzammil', '2015-05-14', 'L', 'A', 'Lainnya', '087868342569', 'jl. cengklong\r\n'),
(17, 'siti azini', '2004-02-11', 'P', 'O', 'Wiraswasta', '087865432167', 'jl. kemplang'),
(18, 'm. zikry', '2015-02-28', 'L', 'A', 'Karyawan Swasta', '089865567531', 'kp. tawang'),
(19, 'renita pratiwi', '2010-07-21', 'P', 'O', 'Lainnya', '089856743217', 'kp.belimbing'),
(20, 'amelia ayu', '2010-12-21', 'P', 'A', 'Lainnya', '085644378517', 'kp. belimbing'),
(21, 'nindi aulia', '2018-02-27', 'P', 'O', 'Lainnya', '083897654429', 'kp. tawang\r\n'),
(22, 'diana lestari', '2011-11-23', 'P', 'O', 'Lainnya', '0812546377', 'jl.dadap'),
(23, 'karisma atmajaya', '1999-11-27', 'P', 'O', 'Wiraswasta', '087765389027', 'jl. kosambi timur'),
(24, 'aditya permana', '2016-02-25', 'P', 'O', 'Lainnya', '083854123358', 'kp.cengklong'),
(25, 'rika anita', '2012-10-17', 'P', 'O', 'Lainnya', '081264865646', 'kp.belimbing'),
(26, 'fitri afifah', '2000-09-30', 'P', 'B', 'Karyawan Swasta', '083855312270', 'jl. perancis'),
(27, 'kiki agustian', '2015-02-10', 'L', 'A', 'Wiraswasta', '089832441255', 'jl. dadap'),
(28, 'riri anita', '2002-03-06', 'P', 'B', 'Karyawan Swasta', '087732553476', 'kp. cengklong'),
(29, 'khoirul umam', '1998-08-06', 'L', 'O', 'Wiraswasta', '081232401129', 'jl. dadap'),
(30, 'fitri karlina', '2017-01-28', 'P', 'B', 'Lainnya', '089864331780', 'jl. kosambi\r\n'),
(31, 'iis ', '2018-01-02', 'P', 'A', 'Lainnya', '087712314876', 'jl. kemplang'),
(32, 'vivi alvinah', '1999-12-14', 'P', 'A', 'Karyawan Swasta', '089834234450', 'jl. dadap'),
(33, 'handi winata', '1995-05-25', 'L', 'B', 'PNS', '087765431789', 'kp. tawang'),
(34, 'ihwan arrasyid', '2001-11-14', 'L', 'A', 'Karyawan Swasta', '087765443211', 'kp. cengklong'),
(35, 'siti ainun', '2013-02-10', 'P', 'O', 'Lainnya', '089624532190', 'jl. kosambi timur'),
(36, 'rina ayu lestari', '1990-12-24', 'P', 'O', 'PNS', '081265211309', 'jl. salembaran jaya'),
(37, 'rita ayu ningsih', '2016-04-04', 'P', 'A', 'Lainnya', '081255326549', 'kp. kemplang'),
(38, 'puput kirana', '1999-02-22', 'P', 'B', 'Karyawan Swasta', '087735129021', 'jl. raya perancis'),
(39, 'm.bagus', '2013-11-01', 'L', 'A', 'Lainnya', '081266475432', 'kp. belimbing'),
(40, 'diki prasetya', '2010-01-02', 'L', 'AB', 'Lainnya', '083876532765', 'jl. salembaran jaya'),
(41, 'reza anugrah', '2016-12-08', 'L', 'B', 'Lainnya', '089654127965', 'kp. muara'),
(42, 'maria ', '1996-01-12', 'P', 'B', 'Wiraswasta', '087844322180', 'kp. cengklong'),
(43, 'agnes monika', '2018-09-24', 'P', 'B', 'Lainnya', '081236887654', 'jl. kemplang'),
(44, 'sheila anisa ', '2000-11-01', 'P', 'O', 'Karyawan Swasta', '089652182368', 'kp. tawang'),
(45, 'sintia ', '2017-09-11', 'P', 'A', 'Lainnya', '087756491327', 'jl. perancis'),
(46, 'ahmad mufaqih', '2014-02-03', 'L', 'O', 'Lainnya', '081238901239', 'jl. kemplang'),
(47, 'maryanih', '1996-01-03', 'P', 'B', 'Karyawan Swasta', '081289765906', 'kp. cengklong'),
(48, 'rifa ayu ', '2018-07-17', 'P', 'A', 'Lainnya', '087659089005', 'jl. dadap'),
(49, 'fika indriyani', '2015-04-14', 'P', 'B', 'Lainnya', '089875443754', 'jl. perancis'),
(50, 'kinanti ', '1995-08-22', 'P', 'B', 'Wiraswasta', '081237901208', 'jl. cengklong'),
(51, 'reno ardiyansah', '2015-03-31', 'L', 'O', 'Lainnya', '087654312007', 'kp. kemplang');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemeriksaan`
--

CREATE TABLE `tb_pemeriksaan` (
  `id_pemeriksaan` int(5) NOT NULL,
  `tanggal_pemeriksaan` date DEFAULT NULL,
  `keterangan` text,
  `status` varchar(10) NOT NULL,
  `id_pasien` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pemeriksaan`
--

INSERT INTO `tb_pemeriksaan` (`id_pemeriksaan`, `tanggal_pemeriksaan`, `keterangan`, `status`, `id_pasien`) VALUES
(1, '2019-12-23', 'Pasien tidak sadarkan diri', 'Dibuat', 2),
(2, '2020-01-27', 'sering pusing', 'Dibuat', 3),
(3, '2020-01-27', 'Gigi bolong', 'Dibuat', 4),
(4, '2020-01-27', 'Mual dan pusing', 'Dibuat', 5),
(5, '2020-01-27', 'diare dan muntah', 'Dibuat', 6),
(6, '2020-01-27', 'pusing dan mual', 'Dibuat', 7),
(7, '2020-01-27', 'sakit kepala', 'Dibuat', 8),
(8, '2020-02-09', 'Tes', 'Dibuat', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemeriksaan_detail`
--

CREATE TABLE `tb_pemeriksaan_detail` (
  `id_pemeriksaan_detail` int(10) NOT NULL,
  `id_pemeriksaan` int(5) NOT NULL,
  `tanggal_pemeriksaan_detail` date DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `keluhan` text NOT NULL,
  `diagnosa` text NOT NULL,
  `id_dokter` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pemeriksaan_detail`
--

INSERT INTO `tb_pemeriksaan_detail` (`id_pemeriksaan_detail`, `id_pemeriksaan`, `tanggal_pemeriksaan_detail`, `status`, `keluhan`, `diagnosa`, `id_dokter`) VALUES
(1, 1, '2019-12-23', 'darurat', 'Tidak terjadi keluhan', 'kekurangan oksigen', 'D2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pendaftaran`
--

CREATE TABLE `tb_pendaftaran` (
  `no_pendaftaran` int(11) NOT NULL,
  `tanggal_pendaftaran` datetime DEFAULT NULL,
  `status_pendaftar` varchar(10) NOT NULL,
  `id_pasien` int(10) NOT NULL,
  `nip` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pendaftaran`
--

INSERT INTO `tb_pendaftaran` (`no_pendaftaran`, `tanggal_pendaftaran`, `status_pendaftar`, `id_pasien`, `nip`) VALUES
(1, '2020-02-04 00:00:00', 'lama', 2, 'RE001'),
(2, '2020-02-04 00:00:00', 'baru', 3, 'RE001'),
(3, '2020-02-04 00:00:00', 'baru', 4, 'RE001'),
(4, '2020-02-04 00:00:00', 'baru', 5, 'RE001'),
(5, '2020-02-04 00:00:00', 'lama', 6, 'RE001'),
(6, '2020-02-04 00:00:00', 'lama', 7, 'RE001'),
(7, '2020-02-04 00:00:00', 'baru', 8, 'RE001'),
(8, '2020-02-04 00:00:00', 'lama', 9, 'RE001'),
(9, '2020-02-04 00:00:00', 'lama', 10, 'RE001'),
(10, '2020-02-04 00:00:00', 'lama', 11, 'RE001'),
(11, '2020-02-04 00:00:00', 'baru', 12, 'RE001'),
(12, '2020-02-04 00:00:00', 'lama', 13, 'RE001'),
(13, '2020-02-04 00:00:00', 'baru', 14, 'RE001'),
(14, '2020-02-04 00:00:00', 'lama', 15, 'RE001'),
(15, '2020-02-04 00:00:00', 'lama', 16, 'RE001'),
(16, '2020-02-04 00:00:00', 'lama', 17, 'RE001'),
(17, '2020-02-04 00:00:00', 'baru', 18, 'RE001'),
(18, '2020-02-04 00:00:00', 'baru', 19, 'RE001'),
(19, '2020-02-04 00:00:00', 'baru', 20, 'RE001'),
(20, '2020-02-04 00:00:00', 'lama', 21, 'RE001'),
(21, '2020-02-04 00:00:00', 'lama', 22, 'RE001'),
(22, '2020-02-04 00:00:00', 'lama', 23, 'RE001'),
(23, '2020-02-04 00:00:00', 'lama', 24, 'RE001'),
(24, '2020-02-04 00:00:00', 'lama', 25, 'RE001'),
(25, '2020-02-04 00:00:00', 'baru', 26, 'RE001'),
(26, '2020-02-04 00:00:00', 'lama', 27, 'RE001'),
(27, '2020-02-04 00:00:00', 'baru', 28, 'RE001'),
(28, '2020-02-04 00:00:00', 'lama', 29, 'RE001'),
(29, '2020-02-04 00:00:00', 'baru', 30, 'RE001'),
(30, '2020-02-04 00:00:00', 'baru', 31, 'RE001'),
(31, '2020-02-04 00:00:00', 'lama', 31, 'RE001'),
(32, '2020-02-04 00:00:00', 'lama', 32, 'RE001'),
(33, '2020-02-04 00:00:00', 'lama', 33, 'RE001'),
(34, '2020-02-04 00:00:00', 'lama', 34, 'RE001'),
(35, '2020-02-04 00:00:00', 'baru', 35, 'RE001'),
(36, '2020-02-04 00:00:00', 'baru', 36, 'RE001'),
(37, '2020-02-04 00:00:00', 'lama', 37, 'RE001'),
(38, '2020-02-04 00:00:00', 'baru', 38, 'RE001'),
(39, '2020-02-04 00:00:00', 'lama', 39, 'RE001'),
(40, '2020-02-04 00:00:00', 'lama', 40, 'RE001'),
(41, '2020-02-04 00:00:00', 'lama', 41, 'RE001'),
(42, '2020-02-04 00:00:00', 'lama', 42, 'RE001'),
(43, '2020-02-04 00:00:00', 'baru', 43, 'RE001'),
(44, '2020-02-04 00:00:00', 'lama', 44, 'RE001'),
(45, '2020-02-04 00:00:00', 'lama', 45, 'RE001'),
(46, '2020-02-04 00:00:00', 'baru', 46, 'RE001'),
(47, '2020-02-04 00:00:00', 'baru', 47, 'RE001'),
(48, '2020-02-04 00:00:00', 'lama', 48, 'RE001'),
(49, '2020-02-04 00:00:00', 'lama', 49, 'RE001'),
(50, '2020-02-04 00:00:00', 'lama', 50, 'RE001'),
(51, '2020-02-04 00:00:00', 'lama', 51, 'RE001');

-- --------------------------------------------------------

--
-- Table structure for table `tb_resepsionis`
--

CREATE TABLE `tb_resepsionis` (
  `nip` varchar(10) NOT NULL,
  `nama_resepsionis` varchar(25) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `email` varchar(25) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `alamat` text,
  `foto` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_resepsionis`
--

INSERT INTO `tb_resepsionis` (`nip`, `nama_resepsionis`, `tanggal_lahir`, `email`, `no_telepon`, `alamat`, `foto`) VALUES
('RE001', 'Farah Nurpadilah', '1996-12-22', 'nurpadilah@gmail.com', '081717714043', 'Jl. Rawa Lumpang', 'user/resepsionis/Dea.PNG'),
('RE003', 'Desi Ratna', '2020-02-14', 'Quenn@gmail.com', '08811335578', 'jhgh', 'user/resepsionis/Desi Ratna.jpg'),
('RE004', 'Dewi', '1995-02-11', 'dewi@gmail.com', '088112233', 'teluk naga, kota tangerang', 'user/resepsionis/Dewi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(10) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `hak_akses` varchar(10) NOT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `password`, `hak_akses`, `foto`) VALUES
('A001', 'Wahyu Windarto ', 'wahyu@gmail.com', 'admin123', 'A', NULL),
('D1', 'Maryati', 'maryati@gmail.com', 'Dokter1', 'D', 'user/dokter/Maryati.png'),
('D2', 'Siti Darmawati', 'darmawati@gmail.com', 'Dokter2', 'D', NULL),
('D3', 'Ana Widiana', 'waidianana@gmail.com', 'Dokter3', 'D', NULL),
('RE001', 'Farah Nurpadilah', 'nurpadilah@gmail.com', 're001', 'R', NULL),
('RE003', 'Desi Ratna', 'Quenn@gmail.com', '12345678', 'R', 'user/resepsionis/Desi Ratna.jpg'),
('RE004', 'Dewi', 'dewi@gmail.com', '19950211', 'R', 'user/resepsionis/Dewi.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `tb_pemeriksaan`
--
ALTER TABLE `tb_pemeriksaan`
  ADD PRIMARY KEY (`id_pemeriksaan`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indexes for table `tb_pemeriksaan_detail`
--
ALTER TABLE `tb_pemeriksaan_detail`
  ADD PRIMARY KEY (`id_pemeriksaan_detail`),
  ADD KEY `id_pemeriksaan` (`id_pemeriksaan`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indexes for table `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  ADD PRIMARY KEY (`no_pendaftaran`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `tb_resepsionis`
--
ALTER TABLE `tb_resepsionis`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
  MODIFY `id_pasien` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tb_pemeriksaan`
--
ALTER TABLE `tb_pemeriksaan`
  MODIFY `id_pemeriksaan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_pemeriksaan_detail`
--
ALTER TABLE `tb_pemeriksaan_detail`
  MODIFY `id_pemeriksaan_detail` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  MODIFY `no_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_pemeriksaan`
--
ALTER TABLE `tb_pemeriksaan`
  ADD CONSTRAINT `tb_pemeriksaan_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `tb_pasien` (`id_pasien`);

--
-- Constraints for table `tb_pemeriksaan_detail`
--
ALTER TABLE `tb_pemeriksaan_detail`
  ADD CONSTRAINT `tb_pemeriksaan_detail_ibfk_1` FOREIGN KEY (`id_pemeriksaan`) REFERENCES `tb_pemeriksaan` (`id_pemeriksaan`),
  ADD CONSTRAINT `tb_pemeriksaan_detail_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `tb_dokter` (`id_dokter`);

--
-- Constraints for table `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  ADD CONSTRAINT `tb_pendaftaran_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `tb_resepsionis` (`nip`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
