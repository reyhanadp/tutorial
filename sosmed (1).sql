-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23 Jul 2017 pada 09.42
-- Versi Server: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sosmed`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `friend`
--

CREATE TABLE `friend` (
  `email1` varchar(30) NOT NULL,
  `email2` varchar(30) NOT NULL,
  `konfirmasi` enum('belum','sudah') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `friend`
--

INSERT INTO `friend` (`email1`, `email2`, `konfirmasi`) VALUES
('reyhanadp@yahoo.co.id', 'reyhanadp@yahoo.co.id', 'sudah'),
('reyhanadp2@yahoo.co.id', 'hugo@gmail.com', 'sudah'),
('reyhanadp2@yahoo.co.id', 'reyhanadp2@yahoo.co.id', 'belum'),
('reyhanadp1@yahoo.co.id', 'reyhanadp1@yahoo.co.id', 'belum'),
('seilla@gmail.com', 'seilla@gmail.com', 'belum'),
('reyhanadp@yahoo.co.id', 'seilla@gmail.com', 'sudah'),
('hugo@gmail.com', 'hugo@gmail.com', 'sudah'),
('reyhanadp@yahoo.co.id', 'hugo@gmail.com', 'belum'),
('hugo@gmail.com', 'reyhanadp@yahoo.co.id', 'sudah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(11) NOT NULL,
  `email_pengirim` varchar(30) NOT NULL,
  `email_penerima` varchar(30) NOT NULL,
  `subjek` varchar(255) NOT NULL,
  `isi` longtext NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('belum','sudah') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `email_pengirim`, `email_penerima`, `subjek`, `isi`, `tanggal`, `status`) VALUES
(1, 'reyhanadp@yahoo.co.id', 'hugo@gmail.com', 'tes', '1234', '2017-07-22', 'sudah'),
(2, 'seilla@gmail.com', 'reyhanadp@yahoo.co.id', 'hallo', '1234123123', '2017-07-22', 'sudah'),
(3, 'hugo@gmail.com', 'reyhanadp@yahoo.co.id', 'hai', 'the specific HTML and CSS used to justify buttons (namely display: table-cell), the borders between them are doubled. In regular button groups, margin-left: -1px is used to stack the borders instead of removing them. However, margin doesn\'t work with display: table-cell. As a result, depending on your customizations to Bootstrap, you may wish to r', '2017-07-22', 'sudah'),
(4, 'reyhanadp@yahoo.co.id', 'hugo@gmail.com', 'gpp ko go', 'wwkwkkwkwk', '2017-07-22', 'sudah'),
(5, 'reyhanadp@yahoo.co.id', 'hugo@gmail.com', 'enak aja :P', 'wkkwkawkdawkdkawdk', '2017-07-22', 'sudah'),
(6, 'hugo@gmail.com', 'reyhanadp@yahoo.co.id', 'kenapa emang?', 'tes 121123123124', '2017-07-22', 'sudah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile`
--

CREATE TABLE `profile` (
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama_lengkap` varchar(40) NOT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` varchar(15) DEFAULT NULL,
  `alamat` varchar(70) DEFAULT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `profile`
--

INSERT INTO `profile` (`email`, `password`, `nama_lengkap`, `jenis_kelamin`, `tgl_lahir`, `agama`, `alamat`, `foto`) VALUES
('hugo@gmail.com', '123456789', 'hugo', '', '0000-00-00', '', '', '2013-02-25 10.57.48_1500768659.jpg'),
('reyhanadp1234@yahoo.co.id', 'lalilulelo', 'radp', '', '0000-00-00', '', '', '2013-09-01 19.28.22_1500768723.jpg'),
('reyhanadp1@yahoo.co.id', 'lalilulelo', 'Wiryawan Sunu Aji', 'wanita', '1990-07-19', 'Islam', '', 'chrome-logo_1500643325.jpg'),
('reyhanadp2@yahoo.co.id', 'lalilulelo', 'audian', '', '0000-00-00', '', '', '2013-04-25 07.04.51_1500768622.jpg'),
('reyhanadp@yahoo.co.id', 'abcd1234', 'reyhan audian dwi putra', 'wanita', '1997-06-16', 'Islam', 'Jl. Saluyu XVB No. 437', '1016444_748670025167488_1108001555_n_1500680917.jpg'),
('seilla@gmail.com', 'abcd1234567', 'Seilla DM', 'wanita', '2017-07-01', 'Islam', '', 'freepik_1500643712.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nama_lengkap` varchar(40) NOT NULL,
  `status` longtext NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id_status`, `email`, `nama_lengkap`, `status`, `waktu`) VALUES
(2, 'reyhanadp@yahoo.co.id', 'reyhan audian dwi putra', 'saya lapar', '2017-07-21 02:28:04'),
(3, 'reyhanadp@yahoo.co.id', 'reyhan audian dwi putra', '', '2017-07-21 02:30:35'),
(4, 'reyhanadp@yahoo.co.id', 'reyhan audian dwi putra', 'tes lagi ah', '2017-07-21 02:31:37'),
(5, 'hugo@gmail.com', 'hugo', 'pusing nih', '2017-07-21 03:36:27'),
(6, 'reyhanadp2@yahoo.co.id', 'reyhan audian dwi putra', 'cobain aja', '2017-07-21 06:05:36'),
(7, 'reyhanadp@yahoo.co.id', 'reyhan audian dwi putra', 'akhirnya bisa', '2017-07-21 06:19:41'),
(8, 'reyhanadp@yahoo.co.id', 'reyhan audian dwi putra', 'yeayyy', '2017-07-21 06:21:06'),
(9, 'reyhanadp@yahoo.co.id', 'reyhan audian dwi putra', 'saya suka makan nais goreng tpi minumnya apa ya enaknya? aduh ini teks panjang banget ya :(', '2017-07-21 07:20:30'),
(10, 'reyhanadp1@yahoo.co.id', 'Wiryawan Sunu Aji', 'Hai', '2017-07-21 13:23:11'),
(11, 'reyhanadp1@yahoo.co.id', 'Wiryawan Sunu Aji', 'wut', '2017-07-21 13:23:20'),
(12, 'seilla@gmail.com', 'Seilla DM', 'tes ini status pertama ku', '2017-07-21 13:27:55'),
(13, 'hugo@gmail.com', 'hugo', 'testes', '2017-07-23 07:23:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD KEY `fk_email1` (`email1`),
  ADD KEY `fk_email2` (`email2`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `fk_pengirim` (`email_pengirim`),
  ADD KEY `fk_penerima` (`email_penerima`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`email`),
  ADD KEY `nama_lengkap` (`nama_lengkap`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`),
  ADD KEY `nama_lengkap` (`nama_lengkap`),
  ADD KEY `fk_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `fk_email1` FOREIGN KEY (`email1`) REFERENCES `profile` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_email2` FOREIGN KEY (`email2`) REFERENCES `profile` (`email`);

--
-- Ketidakleluasaan untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD CONSTRAINT `fk_penerima` FOREIGN KEY (`email_penerima`) REFERENCES `profile` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pengirim` FOREIGN KEY (`email_pengirim`) REFERENCES `profile` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `fk_email` FOREIGN KEY (`email`) REFERENCES `profile` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nama_lengkap` FOREIGN KEY (`nama_lengkap`) REFERENCES `profile` (`nama_lengkap`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
