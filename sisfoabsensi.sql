-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: 18 Agu 2016 pada 08.46
-- Versi Server: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sisdaftar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
`admin_id` int(11) NOT NULL,
  `admin_nama` varchar(50) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_nama`, `admin_email`, `admin_pass`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin'),
(2, 'Anugrah', 'test@gmail.com', 'password');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank`
--

CREATE TABLE `bank` (
`bank_id` int(2) NOT NULL,
  `bank_nama` varchar(30) NOT NULL,
  `bank_rek` varchar(20) NOT NULL,
  `bank_an` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bank`
--

INSERT INTO `bank` (`bank_id`, `bank_nama`, `bank_rek`, `bank_an`) VALUES
(1, 'Bank Central Asia', '2222222222', 'SMK Teknindo Jaya'),
(2, 'Bank Mandi sendiri', '11111111', 'SMK Teknindo Juy');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
`berita_id` int(11) NOT NULL,
  `berita_judul` varchar(50) NOT NULL,
  `berita_waktu` datetime NOT NULL,
  `berita_isi` text NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`berita_id`, `berita_judul`, `berita_waktu`, `berita_isi`, `admin_id`) VALUES
(1, 'Test', '2016-08-02 17:33:55', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nisl neque, scelerisque nec cursus quis, semper fermentum orci. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur in volutpat velit. Phasellus mi lectus, sollicitudin nec blandit iaculis, porttitor vel urna. Cras lacinia gravida sem, dictum commodo felis mattis a. Donec mattis volutpat quam ut lacinia. Aliquam iaculis bibendum justo, et ultricies est blandit a.</p><p>Integer porttitor, turpis at congue tempus, nulla lorem maximus dolor, id scelerisque libero libero sed velit. Suspendisse tempor enim turpis, eu malesuada arcu placerat eu. Curabitur pretium sapien risus, id dapibus risus venenatis ac. Pellentesque vestibulum aliquam mauris fringilla lacinia. Maecenas pulvinar consequat dui at tincidunt. Mauris elit turpis, tincidunt eget ante sed, tristique luctus augue. Mauris in lectus in libero venenatis interdum. Morbi at nulla vestibulum, tristique odio ut, pellentesque felis. Sed vestibulum est sem, in feugiat dui laoreet et. Sed quis eros sed ligula facilisis condimentum sit amet nec urna. Quisque ut magna sed ipsum euismod mattis. Maecenas et libero euismod elit lacinia rhoncus in eget lectus. Sed vehicula nec nunc a molestie. Aenean ac arcu id lacus maximus lacinia non accumsan enim. Aliquam erat volutpat. Nam vulputate lectus sit amet pellentesque pretium.</p>', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `casis`
--

CREATE TABLE `casis` (
`casis_id` int(5) NOT NULL,
  `casis_email` varchar(255) NOT NULL,
  `casis_pass` varchar(32) NOT NULL,
  `casis_nama` varchar(30) NOT NULL,
  `casis_tmplahir` varchar(20) NOT NULL,
  `casis_tgllahir` date NOT NULL,
  `casis_jk` int(1) NOT NULL,
  `casis_alamat` text NOT NULL,
  `casis_agama` varchar(15) NOT NULL,
  `casis_asal` varchar(30) NOT NULL,
  `casis_nem` float NOT NULL,
  `casis_nmayah` varchar(30) NOT NULL,
  `casis_nmibu` varchar(30) NOT NULL,
  `casis_pkayah` varchar(20) NOT NULL,
  `casis_pkibu` varchar(20) NOT NULL,
  `casis_telportu` varchar(13) NOT NULL,
  `casis_telpcasis` varchar(13) NOT NULL,
  `casis_foto` varchar(14) NOT NULL,
  `casis_skl` varchar(50) NOT NULL,
  `casis_raport` varchar(50) NOT NULL,
  `casis_status` int(1) NOT NULL,
  `jurusan_id` int(2) NOT NULL,
  `admin_id` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `casis`
--

INSERT INTO `casis` (`casis_id`, `casis_email`, `casis_pass`, `casis_nama`, `casis_tmplahir`, `casis_tgllahir`, `casis_jk`, `casis_alamat`, `casis_agama`, `casis_asal`, `casis_nem`, `casis_nmayah`, `casis_nmibu`, `casis_pkayah`, `casis_pkibu`, `casis_telportu`, `casis_telpcasis`, `casis_foto`, `casis_skl`, `casis_raport`, `casis_status`, `jurusan_id`, `admin_id`) VALUES
(5, 'zazaza@gmail.com', 'fb87582825f9d28a8d42c5e5e5e8b23d', 'adsadsad', 'Zahra', '1996-08-06', 2, 'jjbjbjkb', 'Hindu', 'bhjbh', 40, 'hjbhbhj', 'bhbhjbj', 'bhbhb', 'bbhb', '78787878787', '989898989', 'foto_5.jpeg', '', '', 1, 1, 0),
(6, 'amrukarim@gmail.com', '3f088ebeda03513be71d34d214291986', 'Muhammad Karim', 'jakarta', '2016-07-14', 1, 'asas', 'Islam', 'asas', 200, 'asasa', 'sdwsdw', 'dcsdc', 'asasdsad', '09878787878', '07879798878', '', '', '', 0, 1, 0),
(7, 'asas@gmail.com', '06964dce9addb1c5cb5d6e3d9838f733', 'karim', 'asas', '2016-07-12', 1, 'zdzds', 'Islam', 'asdas', 400, 'sdasd', 'adasd', 'asd', 'asd', 'asdas', 'asdasd', '', '', '', 1, 1, 0),
(8, 'test1@gmail.com', '', 'joko', '', '0000-00-00', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, 0, 0),
(10, 'test2@gmail.com', '', 'Jaka', 'Jakarta', '2016-07-05', 2, 'Hahaha', 'Buddha', 'SMP 4', 40, 'Jaka', 'Jiki', 'Staff', 'Kuli', '34543', '0892362632', 'foto_10.jpeg', 'skl_10.png', 'raport_10.jpeg', 2, 1, 0),
(11, 'test3@gmail.com', '', 'Karim Amrullah', '', '0000-00-00', 0, '', '', '', 0, '', '', '', '', '', '089650585757', '', '', '', 0, 0, 0),
(13, 'amrukarimde@gmail.com', '', 'Muhammad Karim Amrullah', '', '0000-00-00', 0, '', '', '', 0, '', '', '', '', '', '089650585757', '', '', '', 0, 0, 0),
(14, 'sulistyo@gmail.com', '', 'Sulistyo Widodo', 'Depok', '1996-02-02', 1, 'jalan raya citayam ', 'Islam', 'SMP Harapan Saja', 3.84, 'Jaya', 'Merdeka', 'buruh', 'wiraswasta', '088856745678', '085710270331', '', '', '', 2, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
`jurusan_id` int(2) NOT NULL,
  `jurusan_nm` varchar(20) NOT NULL,
  `jurusan_des` text NOT NULL,
  `admin_id` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`jurusan_id`, `jurusan_nm`, `jurusan_des`, `admin_id`) VALUES
(1, 'Multimedia', 'bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla ', 1),
(2, 'TKJ', 'bla bla bla', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfirmasi`
--

CREATE TABLE `konfirmasi` (
`konfirmasi_id` int(3) NOT NULL,
  `konfirmasi_nama` varchar(50) NOT NULL,
  `konfirmasi_jumlah` decimal(10,0) NOT NULL,
  `bank_id` int(2) NOT NULL,
  `casis_id` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `konfirmasi`
--

INSERT INTO `konfirmasi` (`konfirmasi_id`, `konfirmasi_nama`, `konfirmasi_jumlah`, `bank_id`, `casis_id`) VALUES
(1, 'jaka tarub', 1200000, 1, 10),
(2, 'Anugrah Junaedi', 3500000, 1, 12),
(3, 'Anugrah Junaedi', 3500000, 1, 11),
(4, 'Zahra', 3200000, 1, 5),
(5, 'sulistyo widodo', 900, 1, 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `slide`
--

CREATE TABLE `slide` (
`slide_id` int(2) NOT NULL,
  `slide_nama` varchar(50) NOT NULL,
  `slide_path` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `slide`
--

INSERT INTO `slide` (`slide_id`, `slide_nama`, `slide_path`) VALUES
(4, 'wewr', 'slide_1470127111wewr.png'),
(5, 'rwer', 'slide_1470127121rwer.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
 ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
 ADD PRIMARY KEY (`berita_id`);

--
-- Indexes for table `casis`
--
ALTER TABLE `casis`
 ADD PRIMARY KEY (`casis_id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
 ADD PRIMARY KEY (`jurusan_id`);

--
-- Indexes for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
 ADD PRIMARY KEY (`konfirmasi_id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
 ADD PRIMARY KEY (`slide_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
MODIFY `bank_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
MODIFY `berita_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `casis`
--
ALTER TABLE `casis`
MODIFY `casis_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
MODIFY `jurusan_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
MODIFY `konfirmasi_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
MODIFY `slide_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;