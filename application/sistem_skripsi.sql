-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 26, 2018 at 02:08 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sistem_skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(0, 'umus', '77cbc257e66302866cf6191754c0c8e3');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE IF NOT EXISTS `dosen` (
  `nik` bigint(20) NOT NULL,
  `nama_dosen` varchar(30) NOT NULL,
  `id_jurusan_dsn` int(11) NOT NULL,
  `id_konsentrasi_dsn` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nohp_dsn` int(11) NOT NULL,
  `email_dsn` varchar(30) NOT NULL,
  `foto_dsn` varchar(20) NOT NULL,
  PRIMARY KEY (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nik`, `nama_dosen`, `id_jurusan_dsn`, `id_konsentrasi_dsn`, `password`, `nohp_dsn`, `email_dsn`, `foto_dsn`) VALUES
(92128123, 'Nur Tulus Ujianto', 56217831, 56127312, '827ccb0eea8a706c4c34a16891f84e7b', 2147483647, 'deanheart09@gmail.com', 'file_1524314216.png'),
(182763182, 'Devi Adi Nufriana', 6761257, 198298312, '27232b8582ae0f5a763c0b2f07b7cd16', 128317923, 'deanheart09@gmail.com', 'file_1527342421.png'),
(564365776, 'Muhammad Bagas Gigih Y.P.S.T', 56217831, 56127312, '77cbc257e66302866cf6191754c0c8e3', 986646465, 'bagasgigih@gmail.com', 'file_1523525646.png'),
(604197405, 'Nur Ariesanto Ramdhan, M.Kom', 56217831, 561273712, '827ccb0eea8a706c4c34a16891f84e7b', 2147483647, 'nurariesanto@yahoo.com', 'file_1523525646.png'),
(5518261271, 'Ali Fikri, M.Kom', 55912823, 56127312, '827ccb0eea8a706c4c34a16891f84e7b', 876555672, 'deanheart09@gmail.com', 'file_1524881172.png'),
(23456789876543, 'Dean Heart', 55912823, 44768887, '827ccb0eea8a706c4c34a16891f84e7b', 8766562, 'jhkahdk@gmail.com', 'file_1525655277.png');

-- --------------------------------------------------------

--
-- Table structure for table `ide_skripsi`
--

CREATE TABLE IF NOT EXISTS `ide_skripsi` (
  `id_ide` bigint(20) NOT NULL,
  `nim_mhs_ide` bigint(20) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  PRIMARY KEY (`id_ide`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `id_jurusan` bigint(20) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  PRIMARY KEY (`id_jurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `jurusan`) VALUES
(127381, 'Ilmu Kesehatan'),
(6761257, 'Ekonomi'),
(55912823, 'Pendidikan'),
(56217831, 'Teknik'),
(871268212, 'Pertanian');

-- --------------------------------------------------------

--
-- Table structure for table `konsentrasi`
--

CREATE TABLE IF NOT EXISTS `konsentrasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jurusan_ksn` int(11) NOT NULL,
  `nik_kaprodi` bigint(20) NOT NULL,
  `konsentrasi` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=561273713 ;

--
-- Dumping data for table `konsentrasi`
--

INSERT INTO `konsentrasi` (`id`, `id_jurusan_ksn`, `nik_kaprodi`, `konsentrasi`) VALUES
(762612, 55912823, 5518261271, 'Bahasa Indonesia'),
(44768887, 55912823, 23456789876543, 'Guru Sekolah Dasar'),
(56127312, 56217831, 564365776, 'Informatika'),
(198298312, 6761257, 0, 'Akutansi'),
(561273712, 56217831, 604197405, 'Sipil');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE IF NOT EXISTS `konsultasi` (
  `id_konsultasi` int(11) NOT NULL AUTO_INCREMENT,
  `nim_mhs_ks` bigint(30) NOT NULL,
  `pembimbing` varchar(30) NOT NULL,
  `catatan` text NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_konsultasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=325 ;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id_konsultasi`, `nim_mhs_ks`, `pembimbing`, `catatan`, `tanggal`) VALUES
(322, 55201140012, 'Nur Ariesanto Ramdhan, M.Kom', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2018-04-24'),
(323, 55201140012, 'Nur Ariesanto Ramdhan, M.Kom', 'lsdnnskjncjeownjijacnkajndsjnkdasnkjdncownkjdcndksj', '2018-04-24'),
(324, 552011400126, 'Nur Ariesanto Ramdhan, M.Kom', 'lsdnnskjncjeownjijacnkajndsjn', '2018-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `nim` bigint(20) NOT NULL,
  `nama_mhs` varchar(30) NOT NULL,
  `pwd_mhs` varchar(200) NOT NULL,
  `id_jurusan_mhs` bigint(20) NOT NULL,
  `id_konsentrasi_mhs` bigint(20) NOT NULL,
  `id_skripsi_mhs` int(11) NOT NULL,
  `nohp_mhs` bigint(20) NOT NULL,
  `email_mhs` varchar(30) NOT NULL,
  `foto_mhs` varchar(30) NOT NULL,
  `QR_Code` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`nim`),
  KEY `id_skripsi_mhs` (`id_skripsi_mhs`),
  KEY `id_jurusan_mhs` (`id_jurusan_mhs`),
  KEY `id_konsentrasi_mhs` (`id_konsentrasi_mhs`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama_mhs`, `pwd_mhs`, `id_jurusan_mhs`, `id_konsentrasi_mhs`, `id_skripsi_mhs`, `nohp_mhs`, `email_mhs`, `foto_mhs`, `QR_Code`, `status`) VALUES
(55201140012, 'Devi Adi Nufriana', '77cbc257e66302866cf6191754c0c8e3', 56217831, 56127312, 1527262824, 85642612283, 'deanheart09@gmail.com', 'file_1527257619.png', '55201140012.png', 'Skripsi');

-- --------------------------------------------------------

--
-- Table structure for table `pemberitahuan`
--

CREATE TABLE IF NOT EXISTS `pemberitahuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pemberitahuan` varchar(300) NOT NULL,
  `catatan` text NOT NULL,
  `tanggal` varchar(40) NOT NULL,
  `penerima` bigint(20) NOT NULL,
  `pengirim` varchar(50) NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `pemberitahuan`
--

INSERT INTO `pemberitahuan` (`id`, `pemberitahuan`, `catatan`, `tanggal`, `penerima`, `pengirim`, `status`) VALUES
(33, 'Rancang Bangun Sistem Informasi Skripsi', 'Anda Di Tetapkan Sebagai Dosen Pembimbing Devi Adi Nufriana Silahkan Lihat Di Data Skripsi', '2018-04-24', 92128123, '604197405', '<span class="text-right badge badge-success"> <i class="fas fa-thumbs-up"></i> Diterima </span>'),
(34, 'Rancang Bangun Sistem Informasi Skripsi', 'Anda Di Tetapkan Sebagai Dosen Pembimbing Devi Adi Nufriana Silahkan Lihat Di Data Skripsi', '2018-04-24', 604197405, '604197405', '<span class="text-right badge badge-success"> <i class="fas fa-thumbs-up"></i> Diterima </span>'),
(35, 'Rancang Bangun Sistem Informasi Skripsi Online', 'Bagus Lanjutkan !!!', '2018-05-25', 55201140012, '564365776', '<span class="text-right badge badge-success"> <i class="fas fa-thumbs-up"></i> Diterima </span>'),
(36, 'Rancang Bangun Sistem Informasi Skripsi Online', 'Anda Di Tetapkan Sebagai Dosen Pembimbing Devi Adi Nufriana Silahkan Lihat Di Data Skripsi', '2018-05-25', 92128123, '564365776', '<span class="text-right badge badge-success"> <i class="fas fa-thumbs-up"></i> Diterima </span>'),
(37, 'Rancang Bangun Sistem Informasi Skripsi Online', 'Anda Di Tetapkan Sebagai Dosen Pembimbing Devi Adi Nufriana Silahkan Lihat Di Data Skripsi', '2018-05-25', 564365776, '564365776', '<span class="text-right badge badge-success"> <i class="fas fa-thumbs-up"></i> Diterima </span>');

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing`
--

CREATE TABLE IF NOT EXISTS `pembimbing` (
  `id_pmb` int(11) NOT NULL AUTO_INCREMENT,
  `nim_mhs_pmb` bigint(20) NOT NULL,
  `nik_dsn_pmb` int(11) NOT NULL,
  `id_skripsi_pmb` int(11) NOT NULL,
  `status_proposal` varchar(20) NOT NULL,
  `status_skripsi` varchar(20) NOT NULL,
  `level` varchar(30) NOT NULL,
  PRIMARY KEY (`id_pmb`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `pembimbing`
--

INSERT INTO `pembimbing` (`id_pmb`, `nim_mhs_pmb`, `nik_dsn_pmb`, `id_skripsi_pmb`, `status_proposal`, `status_skripsi`, `level`) VALUES
(13, 552011400123, 92128123, 1524583220, 'Belum Disetujui', 'Belum Disetujui', 'Pembimbing 1'),
(14, 552011400123, 604197405, 1524583220, 'Belum Disetujui', 'Belum Disetujui', 'Pembimbing 2'),
(15, 55201140012, 92128123, 1527262824, 'Belum Disetujui', 'Belum Disetujui', 'Pembimbing 1'),
(16, 55201140012, 564365776, 1527262824, 'Belum Disetujui', 'Belum Disetujui', 'Pembimbing 2');

-- --------------------------------------------------------

--
-- Table structure for table `skripsi`
--

CREATE TABLE IF NOT EXISTS `skripsi` (
  `id_skripsi` int(20) NOT NULL,
  `nim_mhs_skripsi` bigint(20) NOT NULL,
  `judul_skripsi` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` varchar(200) NOT NULL,
  `nilai` int(100) NOT NULL,
  PRIMARY KEY (`id_skripsi`),
  KEY `nim_mhs_skripsi` (`nim_mhs_skripsi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skripsi`
--

INSERT INTO `skripsi` (`id_skripsi`, `nim_mhs_skripsi`, `judul_skripsi`, `deskripsi`, `tanggal`, `nilai`) VALUES
(1527262824, 55201140012, 'Rancang Bangun Sistem Informasi Skripsi Online', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2018-05-25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE IF NOT EXISTS `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `token`, `user_id`, `created`) VALUES
(15, 'cb29ef256cdf704e0a2d06089cadd3', 2147483647, '2018-04-28'),
(16, 'd5496f0eee6ece4aef333b96ea2a8b', 2147483647, '2018-04-28'),
(17, 'd216cfb9e053abe808427c22ba7c7d', 2147483647, '2018-04-28'),
(18, 'c02f16b65ab8275dbe0ad30a9cea1d', 2147483647, '2018-04-28'),
(19, '245a84948031edfb1e7537356f4ccb', 2147483647, '2018-04-28'),
(20, '61ce856087d06ced37a9b0fd817181', 2147483647, '2018-04-28'),
(21, '48def2c8ea27e61ac462b37323b9e5', 23424324, '2018-04-28'),
(22, '10d7df726a33d7dd2b801083560566', 552011400123, '2018-04-29'),
(23, 'b41e6fa06e302d26e06e0995a0235a', 552011400123, '2018-04-29'),
(24, '1060c58543e283a8e4836d576f3594', 552011400123, '2018-04-29'),
(25, '24529948f9a6b5b2b2a79d549f128a', 552011400123, '2018-04-29'),
(26, '4ad289d33fdbc46366083e6ed6d8db', 552011400123, '2018-04-29'),
(27, 'd4cf7d41faa71bbc9cbe62e3cc2687', 552011400123, '2018-04-29'),
(28, '6c95fbde6582435f56d7aa1f752fc5', 552011400123, '2018-04-29'),
(29, '65ccba0dc0797b93da4d0d0544d00c', 552011400123, '2018-04-29'),
(30, '683450a2a470125d297704fd4d35e2', 552011400123, '2018-04-29'),
(31, 'c912791cd3555910eafacb895423c2', 552011400123, '2018-04-29'),
(32, 'ec76ec73e0b692c27588b5ccee9c46', 552011400123, '2018-04-29'),
(33, '388e9b0b5619c7919cf798298cf0e8', 552011400123, '2018-04-29'),
(34, '071a20c9cde59c92ec8446807f4201', 552011400123, '2018-04-29'),
(35, '0786faa17e2d55c26a24b59b51d63d', 552011400123, '2018-04-29'),
(36, '27265062e0ed463e26d49bc3d542c6', 552011400123, '2018-04-29'),
(37, '24896ef117f20f61ea160dded89d14', 552011400123, '2018-04-29'),
(38, '440e39952ad3dbb3e495dcee1086c3', 552011400123, '2018-04-29'),
(39, '20c14a2678018ea84f7cf523fb378e', 552011400123, '2018-04-29'),
(40, '4f9445d59c8f7a2f2ac9e3805d6b9d', 552011400123, '2018-04-29'),
(41, 'd12fee69155ea852693140fcdb4a1b', 55201140012, '2018-05-25'),
(42, '87e80718c661f99d0bbe6369c27007', 55201140012, '2018-05-25'),
(43, '356b6eeaea4a3a9d267e5d15e12f45', 55201140012, '2018-05-25'),
(44, '45268970710e946fd1e25584a88fab', 55201140012, '2018-05-25'),
(45, 'e3a3b9de42db9d3632780c7941fec7', 55201140012, '2018-05-25'),
(46, 'cf394fec07008a70127c0401ad73fa', 55201140012, '2018-05-25'),
(47, 'ad0bcba23361d9504d448b7359666e', 55201140012, '2018-05-26'),
(48, '50d3a7cde9b021fcccd00a4443488a', 55201140012, '2018-05-26'),
(49, 'd340c0c6b83b489bbc7f2dacd0aabf', 55201140012, '2018-05-26'),
(50, 'a94e8a2bf56923c051bdd1e64efbcf', 55201140012, '2018-05-26');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
