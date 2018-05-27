-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 15 Mei 2018 pada 16.39
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_skripsi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(0, 'umus', '77cbc257e66302866cf6191754c0c8e3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `nik` bigint(20) NOT NULL,
  `nama_dosen` varchar(30) NOT NULL,
  `id_jurusan_dosen` int(11) NOT NULL,
  `id_konsentrasi_dsn` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nohp` int(11) NOT NULL,
  `email_dsn` varchar(30) NOT NULL,
  `foto` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`nik`, `nama_dosen`, `id_jurusan_dosen`, `id_konsentrasi_dsn`, `password`, `nohp`, `email_dsn`, `foto`) VALUES
(92128123, 'Nur Tulus Ujianto', 56217831, 56127312, '827ccb0eea8a706c4c34a16891f84e7b', 2147483647, 'deanheart09@gmail.com', 'file_1524314216.png'),
(564365776, 'Muhammad Bagas Gigih Y.P.S.T', 56217831, 56127312, '77cbc257e66302866cf6191754c0c8e3', 986646465, 'bagasgigih@gmail.com', 'file_1523525646.png'),
(604197405, 'Nur Ariesanto Ramdhan, M.Kom', 56217831, 561273712, '827ccb0eea8a706c4c34a16891f84e7b', 2147483647, 'nurariesanto@yahoo.com', 'file_1523525646.png'),
(5518261271, 'Ali Fikri, M.Kom', 55912823, 56127312, '827ccb0eea8a706c4c34a16891f84e7b', 876555672, 'deanheart09@gmail.com', 'file_1524881172.png'),
(23456789876543, 'Dean Heart', 55912823, 44768887, '827ccb0eea8a706c4c34a16891f84e7b', 8766562, 'jhkahdk@gmail.com', 'file_1525655277.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ide_skripsi`
--

CREATE TABLE `ide_skripsi` (
  `id_ide` bigint(20) NOT NULL,
  `nim_mhs_ide` bigint(20) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ide_skripsi`
--

INSERT INTO `ide_skripsi` (`id_ide`, `nim_mhs_ide`, `judul`, `deskripsi`, `tanggal`) VALUES
(1525160836, 5612728231123, 'Silky Heart', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Selasa, 01 Mei 2018');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` bigint(20) NOT NULL,
  `jurusan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `jurusan`) VALUES
(127381, 'Ilmu Kesehatan'),
(6761257, 'Ekonomi'),
(55912823, 'Pendidikan'),
(56217831, 'Teknik'),
(871268212, 'Pertanian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsentrasi`
--

CREATE TABLE `konsentrasi` (
  `id` int(11) NOT NULL,
  `id_jurusan_ksn` int(11) NOT NULL,
  `nik_kaprodi` bigint(20) NOT NULL,
  `konsentrasi` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `konsentrasi`
--

INSERT INTO `konsentrasi` (`id`, `id_jurusan_ksn`, `nik_kaprodi`, `konsentrasi`) VALUES
(762612, 55912823, 5518261271, 'Bahasa Indonesia'),
(44768887, 55912823, 23456789876543, 'Guru Sekolah Dasar'),
(56127312, 56217831, 564365776, 'Informatika'),
(198298312, 6761257, 0, 'Akutansi'),
(561273712, 56217831, 604197405, 'Sipil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id_konsultasi` int(11) NOT NULL,
  `nim_mhs_ks` bigint(30) NOT NULL,
  `pembimbing` varchar(30) NOT NULL,
  `catatan` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `konsultasi`
--

INSERT INTO `konsultasi` (`id_konsultasi`, `nim_mhs_ks`, `pembimbing`, `catatan`, `tanggal`) VALUES
(322, 552011400123, 'Nur Ariesanto Ramdhan, M.Kom', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2018-04-24'),
(323, 552011400123, 'Nur Ariesanto Ramdhan, M.Kom', 'lsdnnskjncjeownjijacnkajndsjnkdasnkjdncownkjdcndksj', '2018-04-24'),
(324, 552011400123, 'Nur Ariesanto Ramdhan, M.Kom', 'lsdnnskjncjeownjijacnkajndsjn', '2018-04-24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` bigint(20) NOT NULL,
  `nama_mhs` varchar(30) NOT NULL,
  `password_mhs` varchar(250) NOT NULL,
  `id_skripsi_mhs` bigint(20) NOT NULL,
  `id_jurusan_mhs` bigint(20) NOT NULL,
  `id_konsentrasi_mhs` bigint(20) NOT NULL,
  `nohp_mhs` bigint(20) NOT NULL,
  `email_mhs` varchar(30) NOT NULL,
  `foto_mhs` varchar(20) NOT NULL,
  `status_mhs` varchar(10) NOT NULL,
  `QR_Code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama_mhs`, `password_mhs`, `id_skripsi_mhs`, `id_jurusan_mhs`, `id_konsentrasi_mhs`, `nohp_mhs`, `email_mhs`, `foto_mhs`, `status_mhs`, `QR_Code`) VALUES
(23424324, 'Devi Adi', '77cbc257e66302866cf6191754c0c8e3', 0, 56217831, 56127312, 85642612283, 'dea@gmail.com', 'file_1524583091.png', 'Proses Skr', '552011400123.png'),
(55201140010, 'Nia Vera Mutiara', '827ccb0eea8a706c4c34a16891f84e7b', 0, 56217831, 56127312, 9261928621, 'niavera@gmail.com', 'file_1526087982.png', 'Proses Skr', '55201140010.png'),
(552011400123, 'Devi Adi Nufriana', '971bf9e4215019c7e1c2319c25ed5977', 1524583220, 56217831, 56127312, 85642612283, 'deanheart09@gmail.com', 'file_1524583091.png', 'Proses Skr', '552011400123.png'),
(5520114001231, 'Devi Adi', '77cbc257e66302866cf6191754c0c8e3', 0, 56217831, 56127312, 85642612283, 'deanheart9@gmail.com', 'file_1524583091.png', 'Proses Skr', '552011400123.png'),
(5612728231123, 'Silky Heart', '77cbc257e66302866cf6191754c0c8e3', 0, 56217831, 561273712, 766434678, 'deanheart9@gmail.com', 'file_1525093584.png', 'Proses Skr', '5612728231123.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemberitahuan`
--

CREATE TABLE `pemberitahuan` (
  `id` int(11) NOT NULL,
  `pemberitahuan` varchar(300) NOT NULL,
  `catatan` text NOT NULL,
  `tanggal` varchar(40) NOT NULL,
  `penerima` bigint(20) NOT NULL,
  `pengirim` varchar(50) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemberitahuan`
--

INSERT INTO `pemberitahuan` (`id`, `pemberitahuan`, `catatan`, `tanggal`, `penerima`, `pengirim`, `status`) VALUES
(33, 'Rancang Bangun Sistem Informasi Skripsi', 'Anda Di Tetapkan Sebagai Dosen Pembimbing Devi Adi Nufriana Silahkan Lihat Di Data Skripsi', '2018-04-24', 92128123, '604197405', '<span class="text-right badge badge-success"> <i class="fas fa-thumbs-up"></i> Diterima </span>'),
(34, 'Rancang Bangun Sistem Informasi Skripsi', 'Anda Di Tetapkan Sebagai Dosen Pembimbing Devi Adi Nufriana Silahkan Lihat Di Data Skripsi', '2018-04-24', 604197405, '604197405', '<span class="text-right badge badge-success"> <i class="fas fa-thumbs-up"></i> Diterima </span>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembimbing`
--

CREATE TABLE `pembimbing` (
  `id_pmb` int(11) NOT NULL,
  `nim_mhs_pmb` bigint(20) NOT NULL,
  `nik_dsn_pmb` int(11) NOT NULL,
  `id_skripsi_pmb` int(11) NOT NULL,
  `status_proposal` varchar(20) NOT NULL,
  `status_skripsi` varchar(20) NOT NULL,
  `level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembimbing`
--

INSERT INTO `pembimbing` (`id_pmb`, `nim_mhs_pmb`, `nik_dsn_pmb`, `id_skripsi_pmb`, `status_proposal`, `status_skripsi`, `level`) VALUES
(13, 552011400123, 92128123, 1524583220, 'Belum Disetujui', 'Belum Disetujui', 'Pembimbing 1'),
(14, 552011400123, 604197405, 1524583220, 'Belum Disetujui', 'Belum Disetujui', 'Pembimbing 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `nim` bigint(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `password` varchar(250) NOT NULL,
  `id_jurusan` bigint(20) NOT NULL,
  `id_konsentrasi` bigint(20) NOT NULL,
  `nohp` bigint(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `foto` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `skripsi`
--

CREATE TABLE `skripsi` (
  `id_skripsi` bigint(20) NOT NULL,
  `judul_skripsi` varchar(200) NOT NULL,
  `nim_mhs_skripsi` bigint(20) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `nilai` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `skripsi`
--

INSERT INTO `skripsi` (`id_skripsi`, `judul_skripsi`, `nim_mhs_skripsi`, `deskripsi`, `tanggal`, `nilai`, `status`) VALUES
(1524583220, 'Rancang Bangun Sistem Informasi Skripsi', 552011400123, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2018-04-24', 100, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tokens`
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
(40, '4f9445d59c8f7a2f2ac9e3805d6b9d', 552011400123, '2018-04-29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `ide_skripsi`
--
ALTER TABLE `ide_skripsi`
  ADD PRIMARY KEY (`id_ide`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `konsentrasi`
--
ALTER TABLE `konsentrasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id_konsultasi`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `pemberitahuan`
--
ALTER TABLE `pemberitahuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD PRIMARY KEY (`id_pmb`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `skripsi`
--
ALTER TABLE `skripsi`
  ADD PRIMARY KEY (`id_skripsi`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `konsentrasi`
--
ALTER TABLE `konsentrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=561273713;
--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id_konsultasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;
--
-- AUTO_INCREMENT for table `pemberitahuan`
--
ALTER TABLE `pemberitahuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `pembimbing`
--
ALTER TABLE `pembimbing`
  MODIFY `id_pmb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
