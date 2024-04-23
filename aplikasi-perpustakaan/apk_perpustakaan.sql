-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2024 at 07:03 AM
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
-- Database: `apk_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `BukuID` int(11) NOT NULL,
  `Judul` varchar(255) NOT NULL,
  `Penulis` varchar(255) NOT NULL,
  `Penerbit` varchar(255) NOT NULL,
  `TahunTerbit` int(11) NOT NULL,
  `JumlahBuku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`BukuID`, `Judul`, `Penulis`, `Penerbit`, `TahunTerbit`, `JumlahBuku`) VALUES
(4, 'Buku Cerdas Belajar Bahasa Indonesia', 'Kekey Simbolon', 'Erlangga 2021', 2022, 200),
(5, 'Buku Matematika Hebat', 'Indra Kurniawan', 'Erlangga', 2022, 290);

-- --------------------------------------------------------

--
-- Table structure for table `kategoribuku`
--

CREATE TABLE `kategoribuku` (
  `KategoriID` int(11) NOT NULL,
  `NamaKategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategoribuku`
--

INSERT INTO `kategoribuku` (`KategoriID`, `NamaKategori`) VALUES
(2, 'Cerita'),
(3, 'Ilmu Pengetahuan'),
(4, 'Misteri Horor');

-- --------------------------------------------------------

--
-- Table structure for table `kategoribuku_relasi`
--

CREATE TABLE `kategoribuku_relasi` (
  `KategoriBukuID` int(11) NOT NULL,
  `BukuID` int(11) NOT NULL,
  `KategoriID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategoribuku_relasi`
--

INSERT INTO `kategoribuku_relasi` (`KategoriBukuID`, `BukuID`, `KategoriID`) VALUES
(4, 4, 2),
(5, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `koleksipribadi`
--

CREATE TABLE `koleksipribadi` (
  `KoleksiID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BukuID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `koleksipribadi`
--

INSERT INTO `koleksipribadi` (`KoleksiID`, `UserID`, `BukuID`) VALUES
(2, 6, 5),
(3, 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `PeminjamanID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BukuID` int(11) NOT NULL,
  `TanggalPeminjaman` date NOT NULL,
  `TanggalPengembalian` date NOT NULL,
  `StatusPeminjaman` varchar(50) NOT NULL,
  `JmlhBuku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`PeminjamanID`, `UserID`, `BukuID`, `TanggalPeminjaman`, `TanggalPengembalian`, `StatusPeminjaman`, `JmlhBuku`) VALUES
(6, 6, 4, '2024-02-12', '2024-12-22', 'Dikembalikan', 10);

-- --------------------------------------------------------

--
-- Table structure for table `ulasanbuku`
--

CREATE TABLE `ulasanbuku` (
  `UlasanID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BukuID` int(11) NOT NULL,
  `PeminjamanID` int(11) NOT NULL,
  `Ulasan` text NOT NULL,
  `Rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `NamaLengkap` varchar(255) NOT NULL,
  `Alamat` text NOT NULL,
  `Level` enum('Admin','Petugas','Peminjam','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Password`, `Email`, `NamaLengkap`, `Alamat`, `Level`) VALUES
(4, 'Indra2212', 'b30e4272d67497cc23b6dadbb45248f3', 'indra2212@gmail.com', 'Indra Kurniawan', 'Fc Kurnia Punggur', 'Admin'),
(5, 'amunggaming', 'f3f6ba164e845f930d919fce4c3c7f48', 'amunggaming@gmail.com', 'Amung Nur Setya', 'Totokaton Punggur', 'Peminjam'),
(6, 'rinocanti', '8adab86da60976ac52698be79ef8d326', 'rinoagungdwi@gmail.com', 'Rino Agung Dwi', 'Totokaton', 'Peminjam'),
(7, 'kekey12', '58da48937447ecf464a0857197d4e814', 'kekey.sarah@gmail.com', 'Sarah Khaira Syafrina', 'Punggur', 'Petugas');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vdetailbuku`
-- (See below for the actual view)
--
CREATE TABLE `vdetailbuku` (
`TanggalPeminjaman` date
,`TanggalPengembalian` date
,`Judul` varchar(255)
,`Penulis` varchar(255)
,`Ulasan` text
,`Rating` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vdetailpeminjaman`
-- (See below for the actual view)
--
CREATE TABLE `vdetailpeminjaman` (
`Judul` varchar(255)
,`JmlhBuku` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vkoleksi`
-- (See below for the actual view)
--
CREATE TABLE `vkoleksi` (
`Judul` varchar(255)
,`Penulis` varchar(255)
,`TanggalPeminjaman` date
,`UserID` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vuser`
-- (See below for the actual view)
--
CREATE TABLE `vuser` (
`NamaLengkap` varchar(255)
,`Alamat` text
,`BukuID` int(11)
,`TanggalPeminjaman` date
,`TanggalPengembalian` date
,`JmlhBuku` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `vdetailbuku`
--
DROP TABLE IF EXISTS `vdetailbuku`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vdetailbuku`  AS SELECT `p`.`TanggalPeminjaman` AS `TanggalPeminjaman`, `p`.`TanggalPengembalian` AS `TanggalPengembalian`, `b`.`Judul` AS `Judul`, `b`.`Penulis` AS `Penulis`, `u`.`Ulasan` AS `Ulasan`, `u`.`Rating` AS `Rating` FROM ((`peminjaman` `p` join `buku` `b` on(`p`.`BukuID` = `b`.`BukuID`)) join `ulasanbuku` `u` on(`p`.`BukuID` = `u`.`BukuID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vdetailpeminjaman`
--
DROP TABLE IF EXISTS `vdetailpeminjaman`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vdetailpeminjaman`  AS SELECT `b`.`Judul` AS `Judul`, `p`.`JmlhBuku` AS `JmlhBuku` FROM (`buku` `b` join `peminjaman` `p`) WHERE `b`.`BukuID` = `p`.`BukuID` ;

-- --------------------------------------------------------

--
-- Structure for view `vkoleksi`
--
DROP TABLE IF EXISTS `vkoleksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vkoleksi`  AS SELECT `b`.`Judul` AS `Judul`, `b`.`Penulis` AS `Penulis`, `p`.`TanggalPeminjaman` AS `TanggalPeminjaman`, `kp`.`UserID` AS `UserID` FROM ((`buku` `b` join `peminjaman` `p` on(`b`.`BukuID` = `p`.`BukuID`)) join `koleksipribadi` `kp` on(`b`.`BukuID` = `kp`.`BukuID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vuser`
--
DROP TABLE IF EXISTS `vuser`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vuser`  AS SELECT `u`.`NamaLengkap` AS `NamaLengkap`, `u`.`Alamat` AS `Alamat`, `p`.`BukuID` AS `BukuID`, `p`.`TanggalPeminjaman` AS `TanggalPeminjaman`, `p`.`TanggalPengembalian` AS `TanggalPengembalian`, `p`.`JmlhBuku` AS `JmlhBuku` FROM (`user` `u` join `peminjaman` `p`) WHERE `u`.`UserID` = `p`.`UserID` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`BukuID`);

--
-- Indexes for table `kategoribuku`
--
ALTER TABLE `kategoribuku`
  ADD PRIMARY KEY (`KategoriID`);

--
-- Indexes for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD PRIMARY KEY (`KategoriBukuID`),
  ADD KEY `BukuID` (`BukuID`,`KategoriID`),
  ADD KEY `KategoriID` (`KategoriID`);

--
-- Indexes for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD PRIMARY KEY (`KoleksiID`),
  ADD KEY `UserID` (`UserID`,`BukuID`),
  ADD KEY `BukuID` (`BukuID`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`PeminjamanID`),
  ADD KEY `UserID` (`UserID`,`BukuID`),
  ADD KEY `BukuID` (`BukuID`);

--
-- Indexes for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  ADD PRIMARY KEY (`UlasanID`),
  ADD KEY `UserID` (`UserID`,`BukuID`),
  ADD KEY `BukuID` (`BukuID`),
  ADD KEY `PeminjamanID` (`PeminjamanID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `BukuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategoribuku`
--
ALTER TABLE `kategoribuku`
  MODIFY `KategoriID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  MODIFY `KategoriBukuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  MODIFY `KoleksiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `PeminjamanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  MODIFY `UlasanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD CONSTRAINT `kategoribuku_relasi_ibfk_1` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kategoribuku_relasi_ibfk_2` FOREIGN KEY (`KategoriID`) REFERENCES `kategoribuku` (`KategoriID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD CONSTRAINT `koleksipribadi_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `koleksipribadi_ibfk_2` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  ADD CONSTRAINT `ulasanbuku_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ulasanbuku_ibfk_2` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ulasanbuku_ibfk_3` FOREIGN KEY (`PeminjamanID`) REFERENCES `peminjaman` (`PeminjamanID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
