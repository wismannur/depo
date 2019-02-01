-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 01 Feb 2019 pada 10.36
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory_depo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE `employees` (
  `user_id` int(11) NOT NULL,
  `FullName` varchar(20) DEFAULT NULL,
  `Title` varchar(30) DEFAULT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Password` varchar(50) NOT NULL DEFAULT '',
  `UserLevel` int(11) DEFAULT NULL,
  `Username` varchar(20) NOT NULL DEFAULT '',
  `Activated` enum('Y','N') NOT NULL DEFAULT 'N',
  `kode_depo` varchar(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `employees`
--

INSERT INTO `employees` (`user_id`, `FullName`, `Title`, `Address`, `Email`, `Photo`, `Password`, `UserLevel`, `Username`, `Activated`, `kode_depo`) VALUES
(1, 'Admin', 'System Administrator', '', '', 'EmpID1.jpg', '12345', -1, '01-admin', 'Y', '01'),
(2, 'Admin', 'System Administrator', '', '', 'EmpID2.jpg', '12345', -1, '02-admin', 'Y', '02'),
(3, 'Admin', 'System Administrator', '', '', 'EmpID3.jpg', '12345', -1, '03-admin', 'Y', '03'),
(10, 'AHMAD DEWATA', NULL, NULL, NULL, NULL, '12345', 1, '01-canvas', 'Y', '01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_armada`
--

CREATE TABLE `tbl_armada` (
  `armada_id` int(11) NOT NULL,
  `no_mobil` varchar(10) DEFAULT NULL,
  `deskripsi` varchar(50) DEFAULT NULL,
  `sopir` varchar(35) DEFAULT NULL,
  `kode_depo` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_armada`
--

INSERT INTO `tbl_armada` (`armada_id`, `no_mobil`, `deskripsi`, `sopir`, `kode_depo`) VALUES
(3, 'Z.8156.DE ', 'L-300', 'AGUS SUTANDI', '02'),
(6, 'D.8564.CU', 'L-300', 'WAHYANTO', '02'),
(7, 'Z.8759.DC', 'LAYANAN', 'DADANG', '02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `bank_id` int(11) NOT NULL,
  `no_rekening` varchar(25) DEFAULT NULL,
  `nama_bank` varchar(50) DEFAULT NULL,
  `acc_no` varchar(25) DEFAULT NULL,
  `kode_depo` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_bank`
--

INSERT INTO `tbl_bank` (`bank_id`, `no_rekening`, `nama_bank`, `acc_no`, `kode_depo`) VALUES
(1, '283-0324723', 'BANK BCA', '1.1.1.2.1', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL,
  `customer_code` varchar(10) DEFAULT NULL,
  `customer_group` varchar(3) DEFAULT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `contact_name` varchar(50) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `address3` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `wilayah_id` int(11) DEFAULT NULL,
  `subwil_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `npwp` varchar(25) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `invoice_max` int(1) DEFAULT '1',
  `saldo_awal` double DEFAULT NULL,
  `kode_depo` varchar(3) DEFAULT NULL,
  `due_day` int(2) DEFAULT NULL,
  `curency` double DEFAULT NULL,
  `freight` double DEFAULT NULL,
  `tax` enum('1','0') NOT NULL,
  `ar_acc` varchar(15) DEFAULT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `credit_max` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `customer_code`, `customer_group`, `customer_name`, `contact_name`, `address1`, `address2`, `address3`, `phone`, `wilayah_id`, `subwil_id`, `area_id`, `npwp`, `fax`, `discount`, `invoice_max`, `saldo_awal`, `kode_depo`, `due_day`, `curency`, `freight`, `tax`, `ar_acc`, `sales_id`, `credit_max`) VALUES
(4, '', '', 'Senang, Pd', 'Atep', 'Jl. Astana Anyar', 'Jl. Astana Anyar', 'Bandung', '022', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(24, '', '', 'Karya Abadi, Tk', 'Andi', 'Jl. Cibaduyut 134', 'Jl. Cibaduyut', 'Bandung', '081321514943', 1, 14, 55, '', NULL, 0, 0, 1125000, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(29, '', '', 'Mulya Sari,lw', 'Eko', 'Jl. Soekarno-hatta ( Dpn Lwpj)', 'Jl. Soekarno-hatta ( Dpn Lwpj)', 'Bandung', '085220679662', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(41, '', '', 'Cobra, Tk', 'Ny. Yayah/ Bp. Eye', 'Jl Cicaheum/pasar', 'Jl Cicaheum/pasar', 'Bandung', '08132043734', 1, 14, 52, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(44, '', '', 'Mekar Sari, Tk', '', 'Pasar Cicaheum', 'Pasar Cicaheum', 'Bandung', '5227714', 1, 14, 52, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(51, '', '', 'Kartika Sari, TK', '', 'JL. HAJI AKBAR NO. 4 KEBON KAWUNG', 'JL. HAJI AKBAR NO. 4 KEBON KAWUNG', 'BANDUNG', '022-4231355', 1, 13, 60, '', NULL, 0, 0, 61287840, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(52, '', '', 'Sumber Sari', '', 'Jl. Ir. H Juanda Cianjur', 'Jl. Ir. H Juanda Cianjur', 'Cianjur', '0263262530', 1, 3, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(54, '', '', 'Aneka Baru', '', 'Jl.ir.h Juanda Cianjur', 'JL. IR. JUANDA CIANJUR', 'Cianjur', '0263-263941', 1, 5, 19, '', NULL, 0, 0, 723000, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(67, '', '', 'Sumber Rejeki, Tk', 'Mamih', 'Jl. Raya Cimindi No. 201', 'Jl. Raya Cimindi No. 201', 'Bandung Lk', '022 6033346', 1, 13, 61, '', NULL, 0, 0, 2228000, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(68, '', '', 'Rido, Tk', 'Cucu/eli', 'Jl. Kol. Masturi No. 15 Cimahi', 'Jl. Kol. Masturi No. 15 Cimahi', 'Bandung Lk', '022 6642741', 1, 13, 61, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(71, '', '', 'Mustika Sari, Tk', '', 'Jl. Gandawijaya No. 583', 'Jl. Gandawijaya No. 583', 'Bandung Lk', '081321052202', 1, 13, 61, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(80, '', '', 'Sari Raos, Tk', 'Hj.sumarsih', 'Jl. Cihampelas 91b', 'Jl. Cihampelas 91b', 'Bandung', '022 2030053', 1, 13, 60, '', NULL, 0, 0, 4800000, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(85, '', '', 'Putri, Tk', 'Adam Firdaus', 'Jl. Cihampelas 122', 'Jl. Cihampelas 122', 'Bandung', '2038993', 1, 13, 60, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(105, '', '', 'Daarut-tauhid Supermarket', 'Edwar', 'Jl. Geger Kalong Girang No.67', 'Jl. Geger Kalong Girang No.67', 'Bandung', '2002075', 1, 13, 62, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(109, '', '', 'Iing,tk', 'H. Iing', 'Statsiun Kiara Condong', 'Statsiun Kiara Condong', 'Bandung', '081321139351', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(121, '', '', 'Surya Mas, Tk', '', 'Jl. Raya Kopo', 'Jl. Raya Kopo', 'Bandung', '022-5209166', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(127, '', '', 'Harum Sari, Lw', 'H. Yayat', 'Jl. Leuwi Panjang 136b', 'Jl. Leuwi Panjang 136b', 'Bandung', '70814941', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(130, '', '', 'Suka Sari, Lw', 'Hj. Masitoh', 'Terminal Leuwi Panjang', 'Terminal Leuwi Panjang', 'Bandung', '92207598', 1, 14, 56, '', NULL, 0, 0, 4184000, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(132, '', '', 'Sari Intan, Lw', '', 'Terminal Leuwi Panjang 204', 'Terminal Leuwi Panjang 204', 'Bandung', '', 1, 14, 56, '', NULL, 0, 0, 277500, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(133, '', '', 'Kartika Rasa, Lw', 'H. Syamsudin', 'Terminal Leuwi Panjang', 'Terminal Leuwi Panjang', 'Bandung', '60970783', 1, 14, 56, '', NULL, 0, 0, 528000, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(134, '', '', 'Aneka Rasa, Lw', 'Dede Chandra', 'Terminal Leuwi Panjang', 'Terminal Leuwi Panjang', 'Bandung', '085722172221', 1, 14, 56, '', NULL, 0, 0, 528000, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(135, '', '', 'Sari Berkah, Lw', 'Sofi', 'Term Leuwi Panjang Loss 1 No. 145', 'Term Leuwi Panjang Loss 1 No. 144', 'Bandung', '081802087687', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(141, '', '', 'Sari Gurih, Lw', 'H. Andi', 'Jl.terminal Leuwipanjang', 'Jl.terminal Leuwipanjang', 'Bandung', '0818206810', 1, 14, 56, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(144, '', '', 'Inti Rasa, Lw', 'H. Zaenal', 'Leuwi Panjang', 'Leuwi Panjang', 'Bandung', '0816623123', 1, 14, 56, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(145, '', '', 'Boga Rasa, Lw', 'H. Uhe', 'Leuwi Panjang', 'Leuwi Panjang', 'Bandung', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(153, '', '', 'Purnama, Tk', 'Ko Sindu', 'Jl. Raya Majalaya', 'Jl. Raya Majalaya', 'Bandung Lk', '0225950256', 1, 14, 58, '', NULL, 0, 0, 502500, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(168, '', '', 'Oncom Jaya Psr Klk, Tk', 'Rosita', 'Jl. Pasir Kaliki', 'Jl. Pasir Kaliki', 'Bandung', '022 4237768', 1, 13, 60, '', NULL, 0, 0, 516000, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(169, '', '', 'Padalarang Jaya, Tk', 'Eddy Chandra', 'Jl. Raya Padalarang No. 49', 'Jl. Raya Padalarang', 'Bandung Lk', '6809123', 1, 13, 61, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(170, '', '', 'Melati, Tk', '', 'Jl. Raya Padalarang', '', 'Bandung Lk', '', 1, 2, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(174, 'PDL01', '', 'Wendi, Tk', 'Iwan', 'Jl. Raya Padalarang 529', 'Jl. Raya Padalarang 529', 'Bandung Lk', '022-6809737', 1, 13, 61, '', NULL, 0, 0, 5811000, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(195, '', '', 'Nam Hong', '', 'Jl.harun Kabir', '', 'Sukabumi', '0266-221366', 1, 4, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(203, '', '', 'Kita, Tk', '', 'Jln Ciwangi Sukabumi', '', 'Sukabumi', '', 1, 4, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(205, '', '', 'Sindang Sari, Tk', 'Tarigan', 'Terminal Sukabumi', '', 'Sukabumi', '0266-7078236', 1, 5, 0, '', NULL, 0, 0, 5030000, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(207, '', '', 'Maju, Tk', '', 'Jl Ciwangi', '', 'Sukabumi', '', 1, 4, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(211, '', '', 'Insidentil', '', 'Jl. Surya Sumantri', '', 'Bandung', '', 1, 13, 54, '', NULL, 0, 0, 2408000, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(226, '', '', 'Tiga Rasa, Tk', 'H. Abdullah', 'Jl. Raya Ujung Berung', 'Jl. Raya Ujung Berung', 'Bandung Lk', '082119604845', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(239, '', '', 'Mirasa Yana', '', 'Cileunyi', '', 'Bandung Lk', '', 1, 2, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(240, '', '', 'Mirasa Stpdn', '', 'Cileunyi', '', 'Bandung Lk', '08122326101', 1, 2, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(241, '', '', 'Mirasa Jajang', '', 'Cileunyi', '', 'Bandung Lk', '', 1, 2, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(260, '', '', 'Liana, Tk', '', 'Suka Bumi', '', 'Sukabumi', '', 1, 4, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(273, '', '', 'H Dadang', 'Hj. Dadang', 'Jl. Azis Pasar Baru', 'Jl. Azis Pasar Baru', 'Bandung', '085659314555', 1, 13, 62, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(277, '', '', 'Sawargi, Lw', 'Deden', 'Jl. Soekarno Hatta No. 28a/200', 'Jl. Soekarno Hatta No. 28a/200', 'Bandung', '081214058015', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(279, '', '', 'Sari Milo ,lw', 'H. Uhe', 'Leuwi Panjang', 'Leuwi Panjang', 'Bandung', '5207880', 1, 14, 56, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(307, '', '', 'Engkus', '', '', '', '', '', 1, 2, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(321, '', '', 'Aneka Sari, Cnj', '', 'Cianjur', '', '', '', 1, 3, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(325, '', '', 'Harum Sari, Cbt', 'Deni/aldi', 'Jl. Batu Jajar No. 228', 'Jl. Batu Jajar 288', 'Bandung', '08122254705', 1, 13, 61, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(327, '', '', 'Sami Rasa Milo', 'Hj. Tuti', 'Pasar Kosambi Lt 1 Blok A No. 1', 'Pasar Kosambi Lt. 1 Blok A No. 1', 'Bandung', '08112230379', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(328, '', '', 'Sindang Laris', 'Hj. Dedih', 'Pasar Kosambi No. 3-4', 'Pasar Kosambi No. 3-4', 'Bandung', '4218603', 1, 14, 52, '', NULL, 0, 0, 12000000, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(329, '', '', 'Boga Rasa, Ujb', 'Ibu Yuyun', 'Ujung Berung', 'Ujung Berung', 'Bandung', '08818278550', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(330, '', '', 'Lilik, Tk', '', 'Bbk. Jeruk', '', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(417, '', '', 'TK. Sari Alam', '', 'SUBANG', 'SUBANG', 'BANDUNG', '08131292042', 7, 18, 64, '', NULL, 0, 0, 500000, '02', 0, 1, 0, '', '1.1.2.1.2', 0, 0),
(486, '', '', 'Sangkan Jaya', '', 'Jl Tampo Mas', '', '', '', 1, 2, 14, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.3', 0, 0),
(503, '', '', 'Ecin', '', 'Nagreg', '', '', '', 1, 2, 15, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(541, '', '', 'Tri Rasa', 'Enjang / Jajat', 'Jl. Cipadung No. 117 Cibiru', 'Jl. Cipadung No. 117 Cibiru', 'Bandung', '081322350666', 1, 14, 52, '', NULL, 0, 0, 2914000, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(734, '', '', 'Sari Manis, Sbg', '', 'Lebak Siuh Subang', '', 'Subang', '', 7, 18, 64, '', NULL, 0, 0, 16674000, '02', 0, 1, 0, '', '1.1.2.1.2', 0, 0),
(799, '', '', 'Sari Rasa, Cbt', 'Hj. Tuti', 'Cibaduyut 79', 'Cibaduyut 79', 'Bandung', '5403668', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(818, '', '', 'Hegar Manah', 'Kamal', 'Jl Ambon', 'Jl Ambon', 'Bandung', '0815691097125', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(820, '', '', 'Khodijah', 'Ganda', 'Jl. Stasiun Halll', 'Jl. Stasiun Halll', 'Bandung', '70818721', 1, 13, 60, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(825, '', '', 'AL BAROKAH', '', 'JL. OTISTA SUBANG', 'JL. OTISTA SUBANG', 'SUBANG', '082122404511', 7, 18, 64, '', NULL, 0, 0, 10886000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(879, '', '', 'Selera Utama', 'Opick', 'Jl. Stasiun Barat', 'Jl. Stasiun Barat', 'Bandung', '081809525533', 1, 13, 60, '', NULL, 0, 0, 1018000, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(950, 'STS01', '', 'Mawar Rasa, Tk', 'H. Edi', 'Stasiun Hall Bandung', 'Stasiun Hall Bandung', 'Bandung', '081573017374', 1, 13, 60, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(1015, '', '', 'Karya Umbi/usman', 'Pak. Ade', 'Jl. Cihampeulas No. 186', 'Jl. Cihampelas No. 186', 'Bandung', '08132051779', 1, 13, 60, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(1078, '', '', 'Rasa Pas', '', 'Stasiun', 'Stasiun', 'Bandung', '', 1, 13, 60, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(1099, '', '', 'Dodol Intan', '', 'Drs Ramayani', '', 'Cianjur', '', 1, 5, 19, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(1170, '', '', 'Mulya Sari, Tk', '', 'Jl Komas 197 Parompong', 'Jl Komas 197 Parompong', 'Bandung', '', 1, 13, 62, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(1171, '', '', 'Laksana Grup', '', 'Jl. Parompong 277 Lembang', 'Jl. Parompong 277 Lembang', 'Bandung', '2787833', 1, 13, 62, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(1182, '', '', 'Mandiri, Tk', 'Ratna', 'Jl. Ir. H. Juanda No. 226', 'Jl. Ir. H. Juanda No. 226', 'Bandung', '085314824636', 1, 13, 63, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(1205, '', '', 'Supriadi, Pdl', 'Mamih', 'Jl. Padalarang', 'Jl. Padalarang', 'Bandung', '0226810221', 1, 13, 61, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(1216, '', '', 'Sari Raos, Sederhana', '', 'Pasar Sederhana', 'Pasar Sederhana', 'Bandung', '2033713', 1, 13, 62, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(1229, '', '', 'Sari Sunda Oncom', '', 'Jl Kopo Sayati 226', 'Jl Kopo Sayati 226', 'Bandung', '081563746378', 1, 14, 55, '', NULL, 0, 0, 1044000, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(1283, '', '', 'Anugrah, Klp', 'Bpk Ari', 'Itc-2 Kebon Kalapa, Lt Dasar E 01-03', 'Jl. Kebun Kelapa', 'Bandung', '081322288962', 1, 14, 53, '', NULL, 0, 0, 749500, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(1296, '', '', 'Laksana Rizki', 'Rini Andriyani', 'Jl. Cibaduyut No. 133/d', 'Jl. Cibaduyut No. 133/d', 'Bandung', '081320339918', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(1298, '', '', 'Saung Laksana', 'Dinna', 'Jl. H. Akbar No. 2 Bandung (stasiun)', 'Jl. H. Akbar No. 2 Bandung (stasiun)', 'Bandung', '022-4204072', 1, 13, 60, '', NULL, 0, 0, 2322000, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(1353, '', '', 'Katapang 126', '', 'Kl. Katapang', 'Kl. Katapang', 'Bandung', '022-5891985', 1, 14, 55, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(1446, '', '', 'Mulya Sari, Cbt', 'Weddy', 'Jl Cibaduyut 53', 'Jl Cibaduyut', 'Bandung', '784306465', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(1458, '', '', 'Pusaka, Cimindi', '', 'Jl Cimindi', '', 'Bandung', '', 1, 1, 11, '', NULL, 0, 0, 2228000, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(1462, '', '', 'Sari Priangan, Lw', 'Pa. Ihin', 'Jl. Soekarno-hatta No. 239', 'Jl. Soekarno-hatta No. 239', 'Bandung', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(1474, '', '', 'Aneka Rasa, Ujb', 'Wawan/dadan', 'Jl. Ujung Berung Los Mav No. 17', 'Jl. Ujung Berung', 'Bandung', '7611535', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(1478, '', '', 'Sari Sari, Lw', 'H. Odih', 'Leuwipanjang', 'Leuwipanjang', 'Bandung', '0852215005', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(1486, '', '', 'Ong, Tk', '', 'Jl. Tampomas 123, Sumedang', 'Jl. Tampomas 123, Sumedang', 'Bandung', '201222', 1, 1, 42, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(1545, '', '', 'Odjo Lali', 'Bpk. Adi', 'Cihampelas No.131', 'Cihampelas', 'Bandung', '022-2033025', 1, 13, 60, '', NULL, 0, 0, 16602000, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(1589, '', '', 'Mustika Sari Raos', '', 'Jl. Raya Dayeuhkolot', '', 'Bandung', '5232834', 1, 14, 58, '', NULL, 0, 0, 2201500, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(1598, '', '', 'Pandan Wangi', 'Zulkifli/ Hanafi', 'Jl. Geger Kalong Girang No. 57', 'Jl. Geger Kalong Girang No. 57', 'Bandung', '2011530', 1, 13, 62, '', NULL, 0, 0, 308000, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(1650, '', '', 'Kabita', 'Wawan', 'Jl. Dr. Junjunan No. 41', 'Jl. Dr. Junjunan No. 41', 'Bandung', '6073643', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(1670, '', '', 'Enok, Kircon', 'Bu Enok', 'Psr. Kiara Conding/ Bawah Fly-over', 'Kiara Condong', 'Bandung', '', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(1706, '', '', 'Sari Rejeki', 'Iting', 'Jl. Soekarno Hatta', 'Jl. Soekarno Hatta', 'Bandung', '081320244197', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(1752, '', '', 'Selera, Paster', 'H. Eman Achdiat', 'Jl. Dr. Junjunan No. 39', 'Pasteur', 'Bandung', '6020383', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(1775, '', '', 'Ude Priangan 2', '', 'Terminal Cicaheum', 'Terminal Cicaheum', 'Bandung', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(1788, '', '', 'Ilyas, Cicaheum', 'P. Ilyas', 'Cicaheum', 'Cicaheum', 'Bandung', '081221195555', 1, 14, 52, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(1789, '', '', 'Cinta Laksana, Pasteur', 'H. Nurmiati', 'Pasteur', 'Pasteur', 'Bandung', '6073403', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(1822, '', '', 'Okeke Ii', 'Mukarom', 'Jl. Padalarang No. 263', 'Jl. Padalarang No. 263', 'Bandung', '022-6805852', 1, 13, 61, '', NULL, 0, 0, 5148000, '02', 0, 1, 0, '1', '1.1.2.1.1', 18, 0),
(1832, '', '', 'Sari Nikmat, Lw', 'H. Agus', 'Leuwi Panjang', 'Leuwi Panjang', 'Bandung', '5226573', 1, 14, 56, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(1836, '', '', 'Sumber Raos, Kp', '', 'Komplek Kopo Permai 3 Blok F-4 No. 2', 'Kopo Permai', 'Bandung', '5406041', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(1867, '', '', 'Sandi', 'Sandi', 'Pasar Antri Blok A 144-145', 'Pasar Antri Blok A 144-145', 'Cimahi', '', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '1', '1.1.2.1.1', 18, 0),
(1887, '', '', 'Agir', '', 'Cimahi', 'Cimahi', 'Bandung', '', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '1', '1.1.2.1.1', 18, 0),
(1895, '', '', 'Pusaka, Ciroyom', '', '', 'Jl Raya Ciroyom', 'Bandung', '0227306416', 1, 1, 42, '', NULL, 0, 0, 0, '02', 0, 1, 0, '1', '1.1.2.1.1', 16, 0),
(1905, '', '', 'Snack Corner, Riau', '', 'Jl. Re. Martadinata No. 51', 'Jl. Re. Martadinata No. 51', 'Bandung', '022-4217878', 1, 13, 63, '', NULL, 0, 0, 522000, '02', 0, 1, 0, '1', '1.1.2.1.1', 18, 0),
(1918, '', '', 'Pak Erwin', '', 'Jl Dewi Sartika 100', 'Jl Dewi Sartika 100', 'Bandung', '', 1, 1, 11, '', NULL, 0, 0, 0, '02', 0, 1, 0, '1', '1.1.2.1.1', 14, 0),
(1920, '', '', 'Dindin', '', 'Jl. Dewi Sartika 100', 'Jl. Dewi Sartika 100', 'Bandung', '', 1, 1, 11, '', NULL, 0, 0, 0, '02', 0, 1, 0, '1', '1.1.2.1.1', 14, 0),
(1921, '', '', 'Agung (gudang)', '', 'Jl. Dewi Sartika', 'Jl. Dewi Sartika', 'Bandung', '', 1, 1, 11, '', NULL, 0, 0, 0, '02', 0, 1, 0, '1', '1.1.2.1.1', 14, 0),
(1962, '', '', 'Tempe Raos, Dede Pak', 'Bpk Ade', 'Jl, Dr. Junjunan No. 83 Pasteur', 'Jl, Dr. Junjunan No. 83 Pasteur', 'Bandung', '081320341498', 1, 13, 59, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(1979, '', '', 'Asean Grutty', 'Ibu Ira', 'Jl. Cibaduyut', 'Jl. Cibaduyut', 'Bandung', '081906823224', 1, 14, 55, '', NULL, 0, 0, 6472000, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(1986, '', '', 'Jati Rasa, Lw', '', 'Jl. Leuwi Panjang', 'Jl. Leuwi Panjang', 'Bandung', '08996064660', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(1987, '', '', 'Bp. Ayek', '', 'Jl. Dewi Sartika 100', 'Jl. Dewi Sartika 100', 'Bandung', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(1990, '', '', 'Sop Buntut', 'Yani', 'Padalarang', 'Padalarang', 'Bandung', '0813221324849', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(1992, '', '', 'Rizki Snack, Gian', 'H. Iyad', 'Jl. Dr. Junjunan No. 47', 'Pasteur', 'Bandung', '6075376', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(2035, '', '', 'Rumah Snack', 'Pak Adi', 'Jl. Cihampelas', 'Jl. Cihampelas', 'Bandung', '085722181842', 1, 13, 60, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2044, '', '', 'Wahyanto', 'Wahyanto', 'Jl. Dewi Sartika 100', 'Jl. Dewi Sartika 100', 'Bandung', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(2056, '', '', 'Okeke 1, Tk', '', 'Cipanas', 'Cipanas', '', '', 0, NULL, 0, '', NULL, 0, 0, 5424000, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(2078, '', '', 'Eli, Hj', '', 'Jl. Cijagra', 'Jl. Cijagra', 'Bandung', '', 1, 1, 11, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(2089, '', '', 'Hanaya/Dian Sari', 'Faizal/ Ani', 'Jatinangor', 'Jatinangor', 'Bandung', '76726004', 1, 13, 60, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2129, '', '', 'Jaya Rasa', 'Iis', 'Rest Area Pasteur', 'Rest Area Pasteur', 'Bandung', '081320318155', 1, NULL, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2132, '', '', 'Oleh Oleh Bandung, Chmpls', 'Dede', 'Jl. Cihampelas 118 Bandung', 'Jl. Cihampelas 118 Bandung', 'Bandung', '73990268', 1, 13, 60, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2189, '', '', 'Suka Ria, Palimanan', '', 'Palimanan (jl. Raya Plered No. 31)', 'Palimanan (jl. Raya Plered No. 31)', 'Purwakarta', '0231 321309', 1, 4, 24, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.2', 22, 0),
(2210, '', '', 'Rohman, Bp', 'Bp. Rohman', 'Jl. Soekarno Hatta 159', 'Jl. Soekarno Hatta 159', 'Bandung', '', 1, 14, 55, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2211, '', '', 'Ampera. R.m (bepas)', 'Yadi', 'Jl. Soekarno Hatta 394', 'Jl. Soekarno Hatta 394', 'Bandung', '087821071268', 1, 14, 54, '', NULL, 0, 0, 1302000, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2215, '', '', 'Vita Sari, Kurdi', 'Ibu Ester', 'Jl. Kurdi No. 49 Bandung', 'Jl. Kurdi No. 49 Bandung', 'Bandung', '5203429', 1, 14, 54, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2228, '', '', 'Mm Tiara', '', 'Jl. Astana Anyar No. 19', 'Jl. Astana Anyar No. 19', 'Bandung', '4204227', 1, 14, 55, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2230, '', '', 'Pasirkaliki Sosis, Pd', '', 'Jl. Lengkong Kecil No. 61', 'Jl. Lengkong Kecil No. 61', 'Bandung', '435487', 1, 14, 53, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2232, '', '', 'Canary Bakery', '', 'Jl. Braga No. 12 Bandung', 'Jl. Braga No. 12', 'Bandung', '4208396', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2233, 'BU002', '', 'Maya Sari, Tk', 'Dessy', 'Jl. Abdurahman Saleh No. 71', 'Jl. Abdurahman Saleh No. 71', 'Bandung', '91199953', 1, 13, 59, '', NULL, 0, 0, 5148000, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2234, '', '', 'Pasirkaliki Sosis, 2', '', 'Jl. Abdurahman Saleh No. 34', 'Jl. Abdurahman Saleh No. 34', 'Bandung', '60001929', 1, 13, 59, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2236, '', '', 'Dewi Pasti Ceria, City Travel', 'Bu Dewi', 'Jl. Dipati Ukur No 53', 'Jl. Dipati Ukur No 53', 'Bandung', '70659196', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(2238, '', '', 'Vita Sari, Brg', 'Ester/chandrawati', 'Jl. Burangrang No. 5 Bandung', 'Jl. Burangrang No. 5 Bandung', 'Bandung', '7304736', 1, 14, 53, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2243, '', '', 'Selamat 3, Toserba', '', 'Cianjur', 'Cianjur', 'Cianjur', '', 1, 5, 19, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.2', 22, 0),
(2250, '', '', 'Oncom Kabita', '', 'Jl. Pasir Koja No. 32', 'Jl. Pasir Koja No. 32', 'Bandung', '439766', 1, 14, 55, '', NULL, 0, 0, 468000, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2252, '', '', 'Pasirkaliki Sosis, 3', 'Anwar', 'Jl. Pasirkaliki No. 62', 'Jl. Pasirkaliki No. 62', 'Bandung', '4204485', 1, 13, 60, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2254, '', '', 'Prima Rasa, Peta', '', 'Jl. Peta No. 63 Bandung', 'Jl. Peta No. 63', 'Bandung', '91199010', 1, 14, 54, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2257, '', '', 'Eka Rasa, Serabi', 'Fredy', 'Jl. Burangrang No. 45 Bandung', 'Jl. Burangrang No. 45 Bandung', 'Bandung', '92043692', 1, 14, 53, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2258, '', '', 'Prima Rasa, Buah Batu', 'Bu Anung', 'Jl. Buah Batu No. 167 A Bandung', 'Jl. Buah Batu No. 167 A Bandung', 'Bandung', '7311537', 1, 14, 54, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2260, '', '', 'Mocci Kaswari Asli (lampion)', 'Bp. ujang', 'JL. kenari no. 24 sukabumi', 'jl. kenari no. 24 sukabumi', 'Sukabumi', '0266232092', 0, 5, 20, '', NULL, 0, 0, 112000, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(2265, '', '', 'Dunia Buah-buahan, Peta', 'Patricia', 'Jl. Pelajar Pejuang 45 No.14', 'Jl. Peta', 'Bandung', '022 7318585', 1, 14, 53, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2273, '', '', 'Resa Sari, Tk', 'Yusup', 'Jl. Cicaheum', 'Jl. Cicaheum', 'Bandung', '92584055', 1, 14, 52, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2280, '', '', 'Cemilan Kita', '', 'Jl. Otista 267', 'Jl. Otista 261', 'Bandung', '4203131', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2304, '', '', 'Maya Sari, 2', 'David', 'Jl. Kebon Kawung 22', 'Jl. Kebon Kawung 77', 'Bandung', '4222444', 1, 13, 60, '', NULL, 0, 0, 1356000, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2313, '', '', 'Maya Sari, St Bdg', '', 'Jl. Stasiun Bandung', 'Jl. Stasiun Bandung', 'Bandung', '022 70402915', 1, 13, 60, '', NULL, 0, 0, 1621000, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2314, '', '', 'Maya Sari, Btc', '', 'Jl. Pasteur No. 143-149,btc', 'Jl. Pasteur No. 143-149,btc', 'Bandung', '6126375', 1, 13, 59, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2315, '', '', 'Maya Sari, 5 (surya Sumantri)', '', 'Jl. Surya Sumantri 63', 'Jl. Surya Sumantri 63', 'Bandung', '2003000', 1, 13, 59, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2316, '', '', 'Maya Sari, Chmpls', '', 'Jl. Cihampelas', 'Jl. Cihampelas', 'Bandung', '2042678', 1, 13, 60, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2332, '', '', 'Koperasi Pjka, Bandung', 'Bp. Wawan', 'Jl. Sts Selatan', 'Jl. Sts Selatan', 'Bandung', '4202015', 1, 13, 60, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2333, '', '', 'Maya Sari, Ss', '', 'Jl. Sumber Hegar No. 12', 'Jl. Sumber Hegar No. 12', 'Bandung', '6017081', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2345, '', '', 'Ros Sari, Tk', 'H. Nandang/pupun', 'Jl. Gatot Subroto No. 50 Cimahi', 'Jl. Gatot Subroto No. 50 Cimahi', 'Bandung', '70542768', 1, 13, 61, '', NULL, 0, 0, 1572000, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2369, '', '', 'Prima Rasa, Kemuning', 'Viky', 'Jl. Kemuning No. 20', 'Jl. Kemuning', 'Bandung', '022 7204873', 1, 13, 63, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2376, '', '', 'Elly, Ibu', '', '', '', 'Bandung', '', 1, 1, 11, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(2391, '', '', 'Dailly Snack, Tk', 'Deddy', 'Jl. Re. Martadinata', 'Jl. Riau', 'Bandung', '022 91520619', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(2414, '', '', 'Dani Setiawan, Ibu', '', 'Jl. Anggrek No. 14 Bandung', 'Jl. Anggrek No. 14 Bandung', 'Bandung', '', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2423, '', '', 'Roni, Bp', '', 'Bandung', 'Bandung', 'Bandung', '', 1, 14, 59, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 14, 0),
(2425, '', '', 'Putra Pusaka', 'H Asep', 'Jl. Leuwi Gajah No. 66 Cimindi', 'Jl. Leuwi Gajah No. 66 Cimindi', 'Bandung', '022 93531341', 1, 13, 61, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2426, '', '', 'Selamat 5, Toserba Cipanas', '', 'Cipanas', 'Cipanas', '', '', 1, 1, 12, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 21, 0),
(2433, '', '', 'Rumah Mode, Setia Budi', 'Ibu Wence', 'Jl. Setia Budi No.41', 'Jl. Setia Budi Bandung', 'Bandung', '2033031', 1, 13, 62, '', NULL, 0, 0, 6312000, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2444, '', '', 'Puncak Sari, Ast Anyar', '', 'Jl. Astana Anyar Los 5 A', 'Jl. Astana Anyar Los 5 A', 'Bandung', '5203084', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2453, '', '', 'Selamat 7, Toserba Ciranjang', '', 'Ciranjang', 'Ciranjang', '', '', 1, 5, 19, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 21, 0),
(2455, '', '', 'Prima Rasa, Antapani', '', 'Jl. Purwakarta No. 95 Antapani', 'Jl. Antapani', 'Bandung', '7200128', 1, 14, 53, '', NULL, 0, 0, 837000, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2456, '', '', 'Odah, Ibu', 'Ibu Odah', 'Jl. Purwakarta No. 118', 'Jl. Purwakarta No. 118', 'Bandung', '7202718', 1, 14, 53, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2477, '', '', 'Iing, 2', '', 'Jl. Kiara Condong', 'Jl. Kiara Condong', 'Bandung', '', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2479, '', '', 'Legit Sari, Ciwidey', '', 'Jl. Ciwidey No. 11', 'Jl. Ciwidey No. 11', 'Bandung', '5928572', 1, 14, 57, '', NULL, 0, 0, 731500, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2480, '', '', 'Pasti Legit', '', 'Jl. Ry Ciwidey No 13', 'Jl. Ry Ciwidey No 13', 'Bandung', '76561966', 1, 14, 57, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2481, '', '', 'Citra Rasa,cwdy', '', 'Jl. Cincin No 372', 'Jl. Cincin No 372', 'Bandung', '085234142906', 1, 14, 57, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2486, '', '', 'Naga Sari, Cicaheum', 'Ali', 'Perempatan Cicaheum', 'Perempatan Cicaheum', 'Bandung', '081221077442', 1, 14, 52, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2493, '', '', 'Sinar Baru, Caringin', '', 'Komp. Caringin Blok A2. No. 33', 'Komp. Caringin Blok A2. No. 33', 'Bandung', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2494, '', '', 'Nur Fajar, Lw Panjang', 'Bu Nur', 'Leuwi Panjang', 'Leuwi Panjang', 'Bandung', '081321314113', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2497, '', '', 'H. Ayi Dimyati, Bp', '', 'Jl. Bukit Dago Utara Ii No. 39', 'Jl. Bukit Dago Utara Ii No. 39', 'Bandung', '2508959', 1, 1, 11, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(2499, '', '', 'Jujun, Cibaduyut', '', 'Jl. Cibaduyut', 'Jl. Cibaduyut', 'Bandung', '', 1, 13, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(2505, '', '', 'Sari Rizky, Lw Panjang', '', 'Jl. Leuwi Panjang Bandung', 'Jl. Leuwi Panjang Bandung', 'Bandung', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2506, '', '', 'Citra Rasa, Lw Panjang', 'Sunaryo', 'Leuwi Panjang', 'Leuwi Panjang', 'Bandung', '5407969', 1, 14, 56, '', NULL, 0, 0, 528000, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2525, '', '', 'ANINA SNACK', '', 'POM BENSIN KATAPNG', 'POM BENSIN KATAPANG', 'Bandung', '', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(2531, '', '', 'Ibu Ami', '', 'Lembang', 'Lembang', 'Bandung', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(2540, '', '', 'Suka Rasa, Kb Jukut', '', 'Kebon Jukut', 'Kebon Jukut', 'Bandung', '085624626400', 1, 13, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(2566, '', '', 'Rest Pringsewu, Indramayu', '', 'Indramayu', 'Indramayu', 'Indramayu', '0234506565', 1, 4, 32, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.2', 5, 0),
(2569, '', '', 'Halimah, Pasteur', 'Halimah', 'Jl. Dr. Junjunan No. 57', 'Jl. Dr. Junjunan No. 57', 'Bandung', '085624251969', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(2578, '', '', 'Aneka Jaya, Kircon', 'Wahyudi', 'Jl. Kebaktian 1 No. 16 (kircon) Bandung', 'Jl. Kebaktian 1 No. 16 (kircon) Bandung', 'Bandung', '081221203330', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(2582, '', '', 'Mitra Indah, 2 Crb', '', 'Beber Cirebon', 'Beber Cirebon', 'Cirebon', '085224108602', 1, 4, 39, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.2', 5, 0),
(2587, '', '', 'S 28, Tk', 'Meifi Awaludin', 'Jl. Sulanjana No. 28 Bandung', 'Jl. Sulanjana No. 28 Bandung', 'Bandung', '75450720', 1, 13, 63, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2598, '', '', 'Prima Rasa, Paskal', 'Andre', 'Jl. Pasir Kaliki No. 43', 'Jl. Pasir Kaliki', 'Bandung', '', 1, 13, 60, '', NULL, 0, 0, 2704000, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2601, '', '', 'Sentra Oleh-oleh Teh Diah', 'Hj. Sofia Eddy', 'Jl. Raya Bojong - Cilimus Kuningan', 'Jl. Raya Bojong - Cilimus Kuningan', 'Kuningan', '0232614188', 1, 4, 39, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.2', 5, 0),
(2608, '', '', 'Ujang Skm', '', 'Office', 'Office', 'Bandung', '', 1, 1, 12, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.2.1.2.9', 14, 0),
(2609, '', '', 'Labelle, Tk', 'Bp. Jimmy', 'Jl. Ir. Juanda No. 73 Bandung', 'Jl. Ir. Juanda No. 73 Bandung', 'Bandung', '4205570', 1, 13, 63, '', NULL, 0, 0, 636000, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2611, '', '', 'Aaa, Tk', 'Bpk. Iching Saputra', 'Jl. Sersan Bajuri No. 3 (ledeng) Bandung', 'Jl. Sersan Bajuri No. 3 (ledeng) Bandung', 'Bandung', '022-2011146', 1, 13, 62, '', NULL, 0, 0, 415500, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2615, '', '', 'Yeni, Parmindo', 'Bu Yeni', 'Parmindo', 'Parmindo', 'Bandung', '', 1, 13, 62, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2616, '', '', 'Sam''s', 'Andi', 'Jl. Ir. H. Juanda No. 73', 'Jl. Ir. H. Juanda No. 73', 'Bandung', '022-2534450', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 23, 0),
(2617, '', '', 'Koperasi Itb, Bandung', 'Bpk. Agus', 'Jl. Ganesha No. 15 E', 'Jl. Ganesha No. 15 E', 'Bandung', '022-2508174', 1, 13, 63, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2625, '', '', 'Pring Sewu, Crb', '', 'Tegal Gubuk Cirebon', 'Tegal Gubuk Cirebon', '', '', 1, 1, 39, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 22, 0),
(2626, '', '', 'Ny. Liem', 'Ibu Eti / Ibu Frida/lita', 'Jl. Naripan 80 Bandung 40112', 'Jl. Naripan 80 Bandung 40112', 'Bandung', '022-4205599', 1, 13, 63, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2628, '', '', 'Yati, Ibu (kartika Sari, Tk)', 'Ibu Yati - 2008681', 'Jl. Sariwangi Asri 1 No. 17 Ciwaruga', 'Jl. Sariwangi Asri 1 No. 17 Ciwaruga', 'Bandung', '022-2019025', 1, 13, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(2635, '', '', 'Kampung Gajah', 'Ibu Meli', 'Jl. Sersan Bajuri Km 3,8', 'Jl. Sersan Bajuri Km', 'Bandung', '022-2784545', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(2637, '', '', 'Dua Saudara, Cibiru 2', 'H. Lili Sadeli', 'Jl. Bunderan Cibiru No 111', 'Cibiru', 'Bandung', '08121476142', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2639, '', '', 'Kop.ksu.sejahtera Bersama', '', 'Jl Gede Bage Selatan No 90', 'Jl Gede Bage Selatan No 90', 'Bandung', '0227304525', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2656, '', '', 'Palasari', '', 'Jl. Mayor Abd Rahman 153', 'Jl. Mayor Abd Rahman 153', 'Bandung', '0261201500', 1, 1, 42, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 16, 0),
(2662, '', '', 'Ideal, Tk', 'Laedi', 'Jl. Dr. Junjunan No. 35a - Pasteur', 'Jl. Dr. Junjunan No. 35a - Pasteur', 'Bandung', '6001967', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(2667, '', '', 'Vanisa, Tk', 'Ibu Nurul', 'Jl. Soekarno Hatta 397', 'Jl. Soekarno Hatta 397', 'Bandung', '91804660', 1, 14, 54, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2671, '', '', 'Carrefour, Sukajadi', '', 'Jl. Sukajadi', 'Jl. Sukajadi', 'Bandung', '', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(2675, '', '', 'Hegar Manah, Caringin', 'Pa Otes/yudi', 'Jl. Soekarno Hatta No. 193-caringin', 'Caringin', 'Bandung', '085210053345', 1, 14, 55, '', NULL, 0, 0, 1776000, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2679, '', '', 'Carrefour Kiara Condong', '', 'Jl. Kiara Condong', 'Jl. Kiara Condong', 'Bandung', '', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2681, '', '', 'Harum Rasa, Cicaheum', 'Budi', 'Terminal Cicaheum', 'Terminal Cicaheum', 'Bandung', '91953919', 1, 14, 52, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2685, '', '', 'Goela Merah, Tk', 'Ibu Tatty Yasmin', 'Jl. Soekarno Hatta 385', 'Jl. Soekarno Hatta 385', 'Bandung', '92346463', 1, 14, 54, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2695, '', '', 'Ibu Hj. Tuti', '', 'Jl. Sukajadi No. 1 Lt. 2', 'Jl. Sukajadi No. 1 Lt. 2', 'Bandung', '', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(2699, '', '', 'Fen''s Tk', 'Fenti', 'Jl. Batu Nunggal Indah I/64', 'Jl. Batu Nunggal Indah I/64', 'Bandung', '7513535', 1, 14, 54, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2708, '', '', 'Naufal, Padalarang', 'Dewi/yudi', 'Jl. Padalarang', 'Jl. Padalarang', 'Bandung', '0852079292', 1, 13, 61, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2713, '', '', 'Kampung Baso', 'Ibu Meina', 'Jl. Setiabudi No. 316', 'Jl. Setiabudi No. 316', 'Bandung', '91836697', 1, 13, 62, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2714, '', '', 'Kedai Nyonya Rumah', 'Ida', 'Jl. Naripan No 92c Bandung', 'Jl. Naripan No 92c Bandung', 'Bandung', '4210426', 1, 13, 63, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2717, '', '', 'Sokita, Tk', 'Terry W', 'Jl. Pasirkaliki No 73', 'Jl. Pasirkaliki No 73', 'Bandung', '6016673', 1, 13, 60, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2718, '', '', 'French Bakery, Tk', 'Bp. Tantan', 'Jl. Braga 35', 'Jl. Braga 35', 'Bandung', '4208188', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2719, '', '', 'Maha Karya Bandung Brownis', 'Bp. Nandang', 'Jl. Setiabudi No 103', 'Jl. Setiabudi No 103', 'Bandung', '085222291229', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(2720, '', '', 'KECIMPRING', 'Ibu Lilis', 'Jl. Dr. Djunjunan 155 E', 'Jl. Dr. Djunjunan', 'Bandung', '081395422839', 1, 13, 59, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2722, '', '', 'Rotiku', 'Ibu Ati / Sri', 'Jl. Pasteur 139 (food Market)', 'Jl. Pasteur 139 (food Market)', 'Bandung', '2042482', 1, 13, 59, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2732, '', '', 'Grafika Kopatra', 'Bpk. Nono', 'Jl. Raya Tangkuban Perahu', 'Jl. Raya Tangkuban Perahu', '', '085222470228', 1, 1, 12, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 23, 0),
(2733, '', '', 'Tahu Tauhid', 'Bu Tita', 'Jl. Sesko Au 20', 'Jl. Sesko Au 20', '', '95579046', 1, 1, 12, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 23, 0),
(2734, '', '', 'Sangu Liwet Ibu Ika', 'Bayu', 'Jl. Raya Ciwidey', 'Jl. Raya Ciwidey', 'Bandung', '085722639306', 1, 14, 57, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2736, '', '', 'Saung Lembur Awi, Ciwidey', 'Ira', 'Jl. Raya Ciwidey', 'Jl. Raya Ciwidey', 'Bandung', '085220512168', 1, 14, 57, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2737, '', '', 'Saung Sari, Rm (ciwidey)', 'Ibu Lilis', 'Jl. Raya Ciwidey', 'Jl. Raya Ciwidey', 'Bandung', '081931314503', 1, 14, 57, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2738, '', '', 'Mulia Store, Sm', 'Deni', 'Jl. Batu Nunggal Indah 9 No. 1', 'Jl. Batu Nunggal Indah 9 No. 1', 'Bandung', '76015190', 1, 14, 54, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2743, '', '', 'Rotiku, Cafe Bandara', 'Ibu Ati / Sri', 'Bandara Husein', 'Bandara Husein', 'Bandung', '2042482', 1, 13, 59, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2745, '', '', 'Kaya Rasa, Mekarwangi', 'Bu Reza', 'Jl. Mekarwangi No 5 Bandung', 'Jl. Mekarwangi No 5 Bandung', 'Bandung', '5207143', 1, 14, 55, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2746, '', '', 'Reza, Tk', 'Ibu Yanti', 'Jl. Raya Katapang Km. 17', 'Jl. Raya Katapang Km. 17', 'Bandung', '083821348983', 1, 1, 12, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 23, 0),
(2747, '', '', 'Mekar Store', 'Hendra', 'Jl. Mekar Kencana No. 22', 'Jl. Mekar Kencana No. 22', 'Bandung', '92772362', 1, 14, 54, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2748, '', '', 'Ibu Eneng / Bp Apep', 'Apep', 'Situ Patenggang', 'Situ Patenggang', 'Ciwidey', '081322678263', 1, 14, 57, '', NULL, 0, 0, 2733000, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2752, '', '', 'Waryah (ciwidey)', 'Ibu Waryah', 'Kawah Putih', 'Kawah Putih', 'Ciwidey', '081563528149', 1, 14, 57, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2753, '', '', 'Saung Gawir, Rm', 'Wati Setiawati', 'Jl. Raya Ciwidey', 'Jl. Raya Ciwidey', 'Bandung', '', 1, 14, 57, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2755, '', '', 'Yuri Bery, Tk', 'Lilis', 'Jl. Raya Rancabali Km.5', 'Jl. Raya Rancabali Km.5', 'Ciwidey', '85920516', 1, 1, 12, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 23, 0),
(2759, '', '', 'Saung Pengkolan 2, Rm', '', 'Jl. Raya Tangkuban Perahu No. 81 Lembang', 'Jl. Raya Tangkuban Perahu No. 81 Lembang', 'Bandung', '2789344', 1, 1, 11, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(2761, '', '', 'Asti, Rm (ibu Hj. Tati)', '', 'Pangalengan', 'Pangalengan', 'Bandung', '', 1, 14, 57, '', NULL, 0, 0, 955000, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2766, '', '', 'Cucu, Pasteur', '', 'Jl. Pasteur / Cipedes', 'Jl. Pasteur', 'Bandung', '081802240396', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(2768, '', '', 'Rammona, Bakery', 'Bp. Hendri', 'Jl. Kopo Perma Iii Blok F10 No. 3', 'Jl. Kopo Perma Iii Blok F10 No. 3', 'Bandung', '5406600', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2771, '', '', 'Family, Tk', '', 'PANGALENGAN', 'PANGALENGAN', 'Bandung', '', 1, 13, 57, '', NULL, 0, 0, 516000, '02', 14, 1, 0, '', '1.1.2.1.1', 74, 0),
(2774, '', '', 'Rotiku, Setiabudi', 'Ibu Ati/ Afi', 'Jl. Setiabudi', 'Jl. Setiabudi', 'Bandung', '2042482', 1, 13, 62, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2786, '', '', 'H. Amir', 'H. Amir', 'Jl. Dr. Junjunan No. 45 Pasteur', 'Jl. Dr. Junjunan No. 45 Pasteur', 'Bandung', '022 6123875', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(2787, '', '', 'Botram', 'Nci', 'Kosambi', 'Kosambi', 'Bandung', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2791, '', '', 'Ros Sari', '', 'Gatsu', 'Gatsu', '', '', 1, 1, 42, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 16, 0),
(2802, '', '', 'Devi Rofina', '', 'Pasar Baru Lt. 4 Blok C No.1f', 'Pasar Baru Lt. 4 Blok C No.1f', 'Bandung', '', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2803, '', '', 'Jaya Rasa, 2', 'E. Sopandi/iis', 'Jl. Pungkur No. 44 B, Itc Kebon Kalapa', 'Kebon Kelapa', 'Bandung', '081320318155', 1, 14, 53, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2804, '', '', 'Ibu Dewi', '', 'Garut', 'Garut', 'Garut', '', 1, 1, 11, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(2816, '', '', 'Ujang, Sales', '', 'Dewi Sartika No. 100', 'Bandung', 'Bandung', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(2822, '', '', 'Putri Inti Sari', 'H. Dedy', 'Jl. Raya Parkir Barat No. 16 Sariater', 'Jl. Raya Parkir Barat No. 16 Sariater', 'Bandung', '087821461115', 1, 1, 43, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 61, 0),
(2823, '', '', 'Tk. H. Atang', 'Pak Atang', 'Jln. Raya  Ciater', 'Jln. Raya  Ciater', 'Bandung', '0260 471083', 1, 1, 43, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 61, 0),
(2827, '', '', 'Tk. Imanda', 'Hd. Ermawan', 'Jln. Tangkuban Perahu No. 177', 'Jln. Tangkuban Perahu No. 177', 'Bandung', '022 2788246', 1, 1, 43, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 61, 0),
(2834, '', '', 'Laris Manis', 'Ibu Hj Syofyan', 'Jl. Jend A. Yani / Pasar Kosambi Blok A No. 16', 'Jl. Jend A. Yani / Pasar Kosambi Blok A No. 16', 'Bandung', '0224222502', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2835, '', '', 'Tk. Oleh Oleh Sukabumi', '', 'Jl. Ahmad Sanusi', 'Jl. Ahmad Sanusi', 'Sukabumi', '', 1, 5, 20, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 61, 0),
(2836, '', '', 'Laris Tk, Cmh', 'Tatamg/lia', 'Jl. Gatot Subroto No. 62 Cimahi', 'Jl. Gatot Subroto No. 62 Cimahi', 'Cimahi', '93583147', 1, 13, 61, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2838, '', '', 'Yati, Gordon', 'Yati', 'Pasar Gordon', 'Pasar Gordon', 'Bandung', '7567588', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2839, '', '', 'Mingkana, Bapa', '', 'Bandung', 'Bandung', 'Bandung', '', 1, 13, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(2842, '', '', 'Sartika Tk', 'Pa Andi', 'Jl. Surapati No.54', 'Jl. Surapati No.54', 'Bandung', '083821477847', 1, 13, 63, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2843, '', '', 'Rindu Rasa', 'Undang', 'Jl. Surapati No. 60', 'Jl. Surapati No. 60', 'Bandung', '022 7218057', 1, 13, 63, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2847, '', '', 'Aroma Snack, Lw', 'Bp. Yana / Bp/ Sopyan', 'Jl. Sukarno Hatta Depan Term.lewi Panjang', 'Jl. Sukarno Hatta Depan Term.lewi Panjang', 'Bandung', '08562295568', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2848, '', '', 'Sri Rejeki, Lw', 'Ibu Iting', 'Jl. Soekarno Hatta (terminal Lw. Panjang)', 'Jl. Soekarno Hatta (terminal Lw. Panjang)', 'Bandung', '081320244197', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2852, '', '', 'Rose Bread', 'Rossy', 'Jl. Moh. Toha 188', 'Jl. Moh. Toha 188', 'Bandung', '022 5202968', 1, 14, 54, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2853, '', '', 'O.s Bakery', 'Ibu Lis/fardan', 'Jl. Palasari No. 27', 'Jl. Palasari No. 27', 'Bandung', '022 7304329', 1, 14, 53, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2855, '', '', 'Rossi', '', 'Dewi Sartika 100', 'Dewi Sartika 100', 'Bandung', '', 1, 1, 11, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(2857, '', '', 'Ima Rasa / Toni', '', 'SOEKARNO HATTA NO. 576', 'SOEKARNO HATTA NO. 576', 'BANDUNG', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2859, '', '', 'Tenzo Bakkery', 'Fanni Yovita', 'Jl. Sulaksana 1 No. 33', 'Jl. Sulaksana 1 No. 33', 'Bandung', '022 7271930', 1, 14, 53, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2860, '', '', 'Cafetaria Tk', 'Bp. Sugih / Aria', 'Jl. Pasirkaliki No. 170', 'Jl. Pasirkaliki No. 170', 'Bandung', '081316226322', 1, 13, 60, '', NULL, 0, 0, 0, '02', 28, 1, 0, '', '1.1.2.1.1', 18, 0),
(2861, '', '', 'Yaya, Pa', 'Yaya', 'Kawah Putih - Ciwidey', 'Kawah Putih - Ciwidey', 'Bandung', '', 1, 14, 57, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2863, '', '', 'Degung Raya, Tk', '', 'Jl. Jend. Sudirman No. 28 Sukabumi', 'Jl. Jend. Sudirman No. 28 Sukabumi', 'Sukabumi', '0266 222672', 1, 5, 20, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 61, 0),
(2864, '', '', 'Srikaya, Tk', '', 'Jl. Jend Ahmad Yani No. 283', 'Jl. Jend Ahmad Yani No. 283', 'Sukabumi', '0266 222368', 1, 5, 20, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 61, 0),
(2882, '', '', 'Lingga Jaya Rm', '', 'Jl. Mayor Abdurachman', 'Jl. Mayor Abdurachman', 'Sumedang', '', 1, 1, 42, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 16, 0),
(2883, '', '', 'Sari Rasa Rm', '', 'Jl. Raya Cimayor No. 10 Km.3 Sumedang', 'Jl. Raya Cimayor No. 10 Km.3 Sumedang', 'Sumedang', '02612700495', 1, 1, 42, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 16, 0),
(2884, '', '', 'Tiga Bersaudara, Tk', '', 'Jl. Pangeran Kornel Sumedang', 'Jl. Pangeran Kornel Sumedang', 'Sumedang', '', 1, 1, 42, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 16, 0),
(2885, '', '', 'Sinar Sari Smd', '', 'Jl. Pangeran Kornel', 'Jl. Pangeran Kornel', 'Sumedang', '', 1, 1, 42, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 16, 0),
(2886, '', '', 'Bolu Suka Suka, A. Yani', 'Bu Ida', 'Jl. Ahmad Yani No. 614', 'Jl. Ahmad Yani No. 614', 'Bandung', '7208057', 1, 14, 53, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2887, '', '', 'Colenak Murdi Putra Tk', 'Bety/hj. Sopian', 'Jl. Ahmad Yani No. 733', 'Jl. Ahmad Yani No. 733', 'Bandung', '022 91201002', 1, 14, 53, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2888, '', '', 'Satria, Tk', 'Yustin', 'Jl. Cikutra Barat No. 115', 'Jl. Cikutra Barat No. 115', 'Bandung', '022 2511640', 1, 13, 63, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2889, '', '', 'Sari Rasa, A. Yani', 'Bu Cicin', 'Jl. Jend A. Yani No. 401/409', 'Jl. Jend A. Yani No. 401/409', 'Bandung', '022 7101296', 1, 14, 53, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2890, '', '', 'Hen Tk', 'Wawa', 'Jl. A. Yani No. 413', 'Jl. A. Yani No. 413', 'Bandung', '022 7271541', 1, 14, 53, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2894, '', '', 'Zulfa Taste, Bkr', 'Rini/tomi', 'Jl. Cikutra Barat No. 75', 'Jl. Cikutra Barat No. 75', 'Bandung', '022 2500616', 1, 13, 63, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2895, '', '', 'Mufin Aneka Kue', 'Teni Teja Indah', 'Margahayu Raya Barat G2/47 Bandung', 'Margahayu Raya Barat G2/47 Bandung', 'Bandung', '022 7569447', 1, 14, 54, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 73, 0),
(2897, '', '', 'Ersa, Tk', '', 'Ciateur', 'Ciateur', '', '', 1, 1, 43, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 61, 0),
(2899, '', '', 'Laksana Mekar Tk', '', 'Jl. Raya Lembang', 'Jl. Raya Lembang', '', '', 1, 1, 43, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 61, 0),
(2900, '', '', 'Kabitha Rm', '', 'Tomo/kadipaten', 'Tomo/kadipaten', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.2', 16, 0),
(2904, '', '', 'Griya Ibu Kadi', 'Ibu Weti/bambang', 'Jl. Raya Pasteur', 'Jl. Raya Pasteur', 'Bandung', '082117568451', 1, 13, 59, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2907, '', '', 'Sari Rizky, Cibiru', 'Jejen', 'Bunderan Cibiru', 'Bunderan Cibiru', 'Bandung', '022 5415206', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2908, '', '', 'Rizky Tk', 'Acep/kusmawan', 'Pasar Ujung Berung', 'Pasar Ujung Berung', 'Bandung', '085215164162', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2909, '', '', 'Puspita Tk', 'Sutisna', 'Pasar Ujung Berung', 'Pasar Ujung Berung', 'Bandung', '081220842677', 1, 14, 52, '', NULL, 0, 0, 468000, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2910, '', '', 'Nur Faujah Tk', 'Lina', 'Pasar Ujung Berung', 'Pasar Ujung Berung', 'Bandung', '089655016941', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2911, '', '', 'Sehu Tk', 'Bp. Sehu', 'Pasar Ujung Berung', 'Pasar Ujung Berung', 'Bandung', '085320388403', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2914, '', '', 'Cita Rasa, Tk', 'Ibu Hera', 'Taman Cibaduyut Indah Ruko R 2', 'Taman Cibaduyut Indah Ruko R 2', 'Bandung', '022 91523963', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2915, '', '', 'Red Tulip Bakkery', 'Susi', 'Jl. Batununggal Indah Ii No. 77', 'Jl. Batununggal Indah Ii No. 77', 'Bandung', '022 7510700', 1, 14, 54, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0);
INSERT INTO `tbl_customer` (`customer_id`, `customer_code`, `customer_group`, `customer_name`, `contact_name`, `address1`, `address2`, `address3`, `phone`, `wilayah_id`, `subwil_id`, `area_id`, `npwp`, `fax`, `discount`, `invoice_max`, `saldo_awal`, `kode_depo`, `due_day`, `curency`, `freight`, `tax`, `ar_acc`, `sales_id`, `credit_max`) VALUES
(2917, '', '', 'Raos Tk', 'H Sirod', 'Pasar Kosambi Blok A No. 8 A', 'Pasar Kosambi Blok A No. 8 A', 'Bandung', '022 4221275', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2918, '', '', 'Liem. Tk', 'Ibu Neni', 'Jl. Otoiskandar Dinata  B 11', 'Jl. Otoiskandar Dinata  B 11', 'Bandung', '022 4203995', 1, 14, 56, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2919, '', '', 'Selecta Bakkery', 'Bp. Edo', 'Jl. Lengkong Kecil 29', 'Jl. Lengkong Kecil', 'Bandung', '022 61155363', 1, 14, 53, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2920, '', '', 'Martha Sari', 'Marta', 'Jl. Pagarsih 184', 'Jl. Pagarsih 184', 'Bandung', '022 6016562', 1, 14, 56, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2921, '', '', 'Sony Bakkery', 'Ibu Kiki', 'Jl. Jakarta No.37', 'Jl. Jakarta No.37', 'Bandung', '022 7275605', 1, 14, 53, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2922, '', '', 'Nur Fadilah Tk', 'Abdul Rochim', 'Ujung Berung', 'Ujung Berung', 'Bandung', '081320351020', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2924, '', '', 'Sari Bakat', 'Iyan', 'Jl. Soekarno Hatta No.305  - Leuwi Panjang', 'Jl. Soekarno Hatta No.305  - Leuwi Panjang', 'Bandung', '085793275563', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2925, 'BU01', '', 'Seruni Tk', 'Ibu Marti', 'Jl. Kebonjati No. 181 Bandung', 'Jl. Kebonjati No. 181 Bandung', 'Bandung', '022 60925222', 1, 13, 59, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2926, '', '', 'Madura Tk', 'Bp. Ari Firmansyah', 'Jl. Setiabudi No 103 X', 'Jl. Setiabudi No 103 X', 'Bandung', '022 91651313', 1, 13, 62, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2927, '', '', 'Pasirkaliki Pd, Sukajadi', 'Bp. Anwar', 'Jl. Sukajadi No. 173 A', 'Jl. Sukajadi No. 173 A', 'Bandung', '022 2060420', 1, 13, 62, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2928, '', '', 'Isola Tk', 'Bp. Budi', 'Jl. Sersan Bajuri No. 1', 'Jl. Sersan Bajuri No. 1', 'Bandung', '', 1, 13, 62, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2930, '', '', 'Bolu Suka Suka, Jl. Pwk', 'Bu Dian', 'Jl. Purwakarta No. 50', 'Jl. Purwakarta No. 50', 'Bandung', '70651024', 1, 14, 53, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2931, '', '', 'Ramona Bakkery 2, Mekar Wangi', 'Bp. Ivan', 'Jl. Indrayasa 98 - Mekar Wangi', 'Jl. Indrayasa 98 - Mekar Wangi', 'Bandung', '022 76608900', 1, 14, 54, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2932, '', '', 'Sumber Rasa', '', 'Pasar Baru D1 L 25/23a. Jl. Pasar Utara', 'Pasar Baru D1 L 25/23a. Jl. Pasar Utara', 'Bandung', '085659314555', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2939, '', '', 'Arrahmah Oleh Oleh Bandung', 'Bp. Asep Masrur', 'Jl. Cibaduyut Pertigaan Perumahan Singgasana', 'Jl. Cibaduyut Pertigaan Perumahan Singgasana', 'Bandung', '081322810138', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2940, '', '', 'Makmur Tk', 'Bp. Kosim', 'Jl Raya Timur (cibabat)', 'Jl Raya Timur (cibabat)', 'Bandung', '022 6643044', 1, 13, 61, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2941, '', '', 'Bali Mitra', 'Ibu Beti', 'Rest Area Paster', 'Rest Area Paster', 'Bandung', '082117568451', 1, 13, 59, '', NULL, 0, 0, 948000, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2942, '', '', 'Cahayu Baru', 'Bp. Daryana', 'Jl. Cikutra No. 144', 'Jl. Cikutra No. 144', 'Bandung', '022 7103134', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 23, 0),
(2944, '', '', 'Dua Saudara, M Toha', 'Bp. Jajat', 'Jl. Moch Toha No. 159', 'Jl. Moch Toha No. 159', 'Bandung', '022 5229755', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2945, '', '', 'Permana Tk', 'Ibu S. Permana', 'Pasar Kosambi S.b. Blok A 46-47', 'Pasar Kosambi S.b. Blok A 46-47', 'Bandung', '022 4261778', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2947, '', '', 'Rumah Brownies', 'Bu Lani', 'Jl. Sulaksana Baru Iii No. 1', 'Jl. Sulaksana Baru Iii No. 1', 'Bandung', '022 70605031', 1, 14, 53, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2949, '', '', 'Sari Lezat, Lw', 'Bp. Dadi', 'Jl. Soekarno Hatta (dpn Term.leuwi Panjang)', 'Jl. Soekarno Hatta (dpn Term.leuwi Panjang)', 'Bandung', '081322297773', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2951, '', '', 'Simana Lagi', 'Kang Didin', 'Pasar Kosambi Blok B 1-3', 'Kosambi', 'Bandung', '022 4261702', 1, 14, 52, '', NULL, 0, 0, 8526000, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2954, '', '', 'Sari Barokah, Lw', '', 'Terminal Leuwi Panjang', 'Terminal Leuwi Panjang', 'Bandung', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2956, '', '', 'Agung, Ksm', 'P. Agung', 'Kosambi Dalam Block A', 'Kosambi Dalam', 'Bandung', '081220087748', 1, 14, 52, '', NULL, 0, 0, 264000, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2962, '', '', 'Merah Delima, Tk', 'Hj. Ima', 'Jl. Kolonel Masturi 201 Parongpong', 'Jl. Kolonel Masturi 201 Parongpong', 'Bandung', '70845547', 1, 13, 62, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2963, '', '', 'Marema, Tk', 'Uus', 'Pasar Kosambi Blok A 10', 'Pasar Kosambi Blok A 10', 'Bandung', '022 4220091', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2964, '', '', 'Sindang Jaya', 'Hj. Teti', 'Pasar Kosambi Lt Dasar No. 10', 'Pasar Kosambi Lt Dasar No. 10', 'Bandung', '022 7100173', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2965, '', '', 'Sami Rasa Milo, Jl. Jakarta', '', 'JL JAKARTA', 'JL JAKARTA', 'Bandung', '', 1, 14, 53, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2966, '', '', 'Jaya Rasa, Cbr', 'Susan Supendi', 'Jl. Raya Bunderan Cibiru', 'Jl. Raya Bunderan Cibiru', 'Bandung', '08882095100', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2967, '', '', 'Karya Rasa, Kircon', 'Pa Robby', 'Jl. Kiara Condong No. 351', 'Jl. Kiara Condong No. 351', 'Bandung', '022 92155178', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2969, '', '', 'Talent', 'Bu Venny', 'Jl. Saturnus Selatan Raya Blok L1/17', 'Jl. Saturnus Selatan Raya Blok L1/17', 'Bandung', '022 93362363', 1, 14, 54, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2975, '', '', 'Restu Ibu, Lw', 'Bu Tuti', 'Jl. Soekarno-hatta (dpn Lwpj)', 'Jl. Soekarno-hatta (dpn Lwpj)', 'Bandung', '081320244197', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2976, '', '', 'Rizky Snack, Lw', '', 'Jl. Leuwi Panjang No. 161', 'Jl. Leuwi Panjang No. 161', 'Bandung', '022 5230276', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2977, '', '', 'Genah Rasa, Lw', 'H. Zaenal', 'Trm. Leuwi Panjang', 'Trm. Leuwi Panjang', 'Bandung', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2981, '', '', 'Klontong Rizky Tk', 'Hj. Anna', 'Terminal Ciparay Blok 36-37', 'Terminal Ciparay Blok 36-37', 'Bandung', '', 1, 14, 58, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2985, '', '', 'Hikmah Tk', '', 'Cijampe', 'Cijampe', 'Bandung', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2986, '', '', 'Dede Tk', 'Dede', 'Komp. Batu Nunggal Indah No. 73', 'Komp. Batu Nunggal Indah No. 73', 'Bandung', '7519699', 1, 14, 54, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(2987, '', '', 'Maya Sari Paster', '', 'Pasteur', 'Pasteur', 'Bandung', '', 1, 13, 59, '', NULL, 0, 0, 744000, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(2988, '', '', 'Chandra Sari', 'Chandra', 'Jl. Cibaduyut No. 79 Bandung', 'Jl. Cibaduyut No. 79 Bandung', 'Bandung', '022 5403668', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(2995, '', '', 'Indo Snack', '', 'Jl. Dr. Junjunan Pasteur', 'Jl. Dr. Junjunan Pasteur', 'Bandung', '', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(2997, '', '', 'Maranti Tk', 'Pak Maman', 'Simpang Padalarang', 'Simpang Padalarang', 'Bandung', '085722581355', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3002, '', '', 'Sari Rizky, Antapani', 'Kokom', 'Antapani', 'Antapani', 'Bandung', '083827061904', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3004, '', '', 'Sari Rasa, Pasteur', 'Solihin', 'Jl. Dr. Junjunan', 'Jl. Dr. Junjunan', 'Bandung', '081322906126', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3006, '', '', 'Jaya Rasa, Pasteur', 'Iis', 'Rest Area Pasteur', 'Rest Area Pasteur', 'Bandung', '081320318155', 1, 13, 59, '', NULL, 0, 0, 684000, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(3007, '', '', 'Antapani Pd', 'SUNARYO', 'JL. PURWAKARTA NO. 21 RUKO ANTAPANI', 'JL. PURWAKARTA NO. 21 RUKO ANTAPANI', 'BANDUNG', '7200136', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3008, '', '', 'Liana Toserba', '', 'GERLONG', 'GERLONG', 'BANDUNG', '', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3010, '', '', 'Pusaka Kinkin', 'Kinkin', 'Jl. Leuwi Gajah No. 32 Cimindi', 'Jl. Leuwi Gajah No. 32 Cimindi', 'Bandung', '', 1, 13, 61, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(3011, '', '', 'Gasela', 'Barkah', 'Pateur', 'pasteur', 'Bandung', '', 1, 13, 59, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(3013, '', '', 'Supangkat', 'Budi', 'Jl. Raya Batujajar', 'Jl. Raya Batujajar', 'Bandung', '', 1, 13, 61, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(3014, '', '', 'Lharista', 'Ade', 'Jl. Raya Batujajar', 'Jl. Raya Batujajar', 'Bandung', '087822208829', 1, 13, 61, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(3015, '', '', 'Kangen Rasa', 'H. Entur', 'Jl. Raya Cimindi bawah jembatan layang', 'Jl. Raya Cimindi', 'Bandung', '085624626648', 1, 13, 61, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(3016, '', '', 'Ikhlas Tk', 'BP. FRANS', 'CIBADUYUT', 'CIBADUYUT', 'BANDUNG', '', 1, 14, 55, '', NULL, 0, 0, 9653000, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3018, '', '', 'Mekar Jaya', 'Adi/yusup', 'Jl. Raya Gadobangkong No. 17', 'Jl. Raya Gadobangkong No. 17', 'Bandung', '085795000686', 1, 13, 62, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(3019, '', '', 'Sugih Rasa', 'Asep', 'Jl. Raya Gadobangkong No. 1', 'Jl. Raya Gadobangkong No. 1', 'Bandung', '085222296766', 1, 13, 62, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(3021, '', '', 'Citi Trans', 'Dewi', 'Jl. Dipatiukur', 'Jl. Dipatiukur', 'Bandung', '022 6640865', 1, 13, 63, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(3022, '', '', 'P&d Cihapit', 'Yani', 'Jl. Cihapit No. 30', 'Jl. Cihapit No. 30', 'Bandung', '022 4207928', 1, 13, 63, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(3024, '', '', 'Warohmah', 'Yayan', 'Jl. Ir. H. Juanda No. 216 B', 'Jl. Ir. H. Juanda No. 216 B', 'Bandung', '022 2509057', 1, 13, 63, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(3026, '', '', 'Jembar Rasa', 'Wawan', 'Jl. Tubagus Ismail No. 12-a', 'Jl. Tubagus Ismail No. 12-a', 'Bandung', '02270994994', 1, 13, 63, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(3027, '', '', 'Triska Rasa', 'Gunawan', 'Jl. Cihapit No. 20', 'Jl. Cihapit No. 20', 'Bandung', '022 4240284', 1, 13, 63, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(3028, '', '', 'Pusaka', 'Asep', 'Jl. Surapati No. 52', 'Jl. Surapati No. 52', 'Bandung', '022 87820432', 1, 13, 63, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 18, 0),
(3029, '', '', 'Pipih, Ibu', 'Pipih', 'Pasar Citamuy, Katapang', 'Pasar Citamuy, Katapang', 'Bandung', '081221411423', 1, 14, 57, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(3030, '', '', 'Sarasa', 'Dede Rukman', 'Jl. Raya Kampung Warung No. 11', 'Jl. Raya Kampung Warung No. 11', 'Bandung', '08122436312', 1, 14, 57, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(3032, '', '', 'Yurry Berry', 'Lilis/m. Sholah', 'Jl. Raya Ciwidey', 'Jl. Raya Ciwidey', 'Bandung', '022 85920516', 1, 14, 57, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(3037, '', '', 'Hidayah', 'Opick', 'Jl. Raya Ciparay - Majalaya', 'Jl. Raya Ciparay - Majalaya', 'Bandung', '', 1, 14, 58, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(3038, '', '', 'Tasik', 'Opick', 'Terminal Ciparay Ks No. 3', 'Terminal Ciparay Ks No. 3', 'Bandung', '082115774983', 1, 14, 58, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(3039, '', '', 'Bu Euneng', 'Euneng', 'Terminal Ciparay Ks No. 15', 'Terminal Ciparay Ks No. 15', 'Bandung', '081322575105', 1, 14, 58, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(3040, '', '', 'Mega Fadilah', '', 'Jl. Raya Majalaya', 'Jl. Raya Majalaya', 'Bandung', '', 1, 14, 58, '', NULL, 0, 0, 0, '02', 14, 1, 0, '', '1.1.2.1.1', 45, 0),
(3041, '', '', 'Euis, Ibu Kircon', 'Bu Euis', 'Pasar Kiaracondong Los 1-2', 'Pasar Kiaracondong', 'Bandung', '022 7320488', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3043, '', '', 'Oleh Oleh Bandung, Buah Batu', 'Aep', 'Jl. Terusan Buah Batu No. 189', 'Jl. Terusan Buah Batu No. 189', 'Bandung', '081221183000', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3045, '', '', 'Agus Sales', '', 'JL. DEWI SARTIKA NO. 100', 'JL. DEWI SARTIKA NO. 100', 'BANDUNG', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3046, '', '', 'Wawan, Uber', 'WAWAN', 'PASAR UJUNG BERUNG', 'PASAR UJUNG BERUNG', 'BANDUNG', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3048, '', '', 'Kristie Bakery & Cake', '', 'JL. KEMUNING NO. 2 BANDUNG', 'JL. KEMUNING NO. 2 BANDUNG', 'BANDUNG', '7271931', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3050, '', '', 'Puja Rasa', '', 'JL. LEUWIPANJANG', 'JL. LEUWIPANJANG', 'BANDUNG', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3053, '', '', 'Tika', '', 'TERMINAL CIPARAY', 'TERMINAL CIPARAY', 'BANDUNG', '', 1, 14, 58, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3056, '', '', 'Rizky, Pdl', '', 'SIMPANG PADALARANG', 'SIMPANG PADALARANG', 'BANDUNG', '', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3057, '', '', 'Iwan', '', 'PASAR KIRCON', 'PASAR KIRCON', 'BANDUNG', '', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3058, '', '', 'Cucun, Ksm', '', 'KOSAMBI', 'KOSAMBI', 'BANDUNG', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3059, '', '', 'Sindang Rasa, Lw', '', 'LEUWI PANJANG', 'LEUWI PANJANG', 'BANDUNG', '', 1, 14, 56, '', NULL, 0, 0, 1517400, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3060, '', '', 'Pelangi Rasa', 'HJ. NUR', 'JL. CIBADUYUT NO. 56', 'JL. CIBADUYUT NO. 56', 'BANDUNG', '085862801085', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3061, '', '', 'Frans Bp', '', 'CIBADUYUT', 'CIBADUYUT', 'BANDUNG', '', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3065, '', '', 'Btc Direct Selling', '', 'PASTER', 'PASTER', 'BANDUNG', '', 1, NULL, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 71, 0),
(3069, '', '', 'PESONA RASA', 'PA ABDAL', 'CIBADUYUT', 'CIBADUYUT', 'BANDUNG', '081220555119', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3070, '', '', 'YUSUF ROHMATULLOH (PAMERAN)', 'YUSUF', 'MAHASISWA UIN', 'MAHASISWA UIN', 'BANDUNG', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3072, '', '', 'KRIUK KRIUK', 'IBU SELI', 'KARAWANG', 'KARAWANG', 'KARAWANG', '', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3074, '', '', 'GENAH RASA, DAGO', '', 'SIMPANG DAGO', 'SIMPANG DAGO', 'BANDUNG', '', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3076, '', '', 'PONYO TK', '', 'CIWIDEY', 'CIWIDEY', 'BANDUNG', '', 1, 14, 57, '', NULL, 0, 0, 664500, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3077, '', '', 'LON BP', 'BP. LON', 'SITU PATENGGANG', 'SITU PATENGGANG', 'BANDUNG', '081220537944', 1, 14, 57, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3080, '', '', 'DUDI PA', '', '', 'BANDUNG', 'BANDUNG', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3081, '', '', 'BRIGINA SARI', '', 'TERMINAL CICAHEUM', 'TERMINAL CICAHEUM', 'BANDUNG', '0853593822', 1, 14, 52, '', NULL, 0, 0, 1550000, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3082, '', '', 'DUA SAUDARA, KIRCON', '', 'KIARA CONDONG', 'KIARA CONDONG', 'BANDUNG', '', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3083, '', '', 'DUA SAUDARA, CIBIRU I', '', 'CIBIRU', 'CIBIRU', 'BANDUNG', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3086, '', '', 'BSM DIRECT SELLING', '', '', '', 'BANDUNG', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 71, 0),
(3090, '', '', 'SAMI RASA MILO 2 KSM', '', 'KOSAMBI', 'KOSAMBI', 'BANDUNG', '0224211600', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3094, '', '', 'SRI RASA', '', 'CIBADUYUT', 'CIBADUYUT', 'BANDUNG', '', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3097, '', '', 'TIA', '', 'PAMERAN', 'PAMERAN', 'BANDUNG', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 72, 0),
(3098, '', '', 'IBU TEZA', 'IBU TEZA', 'KORAN PR (JL. ASIA AFRIKA)', 'KORAN PR (JL. ASIA AFRIKA)', 'BANDUNG', '', 1, 13, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3099, '', '', 'YADI', 'YADI', 'CARINGIN', 'CARINGIN', 'BANDUNG', '085210053345', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3103, '', '', 'OHIM, UBER', 'BAPA OHIM', 'UJUNG BERUNG', 'UJUNG BERUNG', 'BANDUNG', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3104, '', '', 'DADAN, UBER', 'BAPA DADAN', 'UJUNG BERUNG', 'UJUNG BERUNG', 'BANDUNG', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3105, '', '', 'CITA RASA, UBER', '', 'UJUNG BERUNG', 'UJUNG BERUNG', 'BANDUNG', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3106, '', '', 'PUSAKA, ITC', '', 'ITC KEBON KALAPA', 'ITC KEBON KALAPA', 'BANDUNG', '', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3107, '', '', 'IBU ENENG, CIPARAY', 'TEH ENENG', 'CIPARAY', 'CIPARAY', 'BANDUNG', '', 1, 14, 58, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3110, '', '', 'KANG WAHYU', '', 'LEUWI PANJANG', 'LEUWI PANJANG', 'BANDUNG', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3115, '', '', 'PAK ADE', '', 'JL. H. AKBAR', 'JL. H. AKBAR', 'BANDUNG', '', 1, 13, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3117, '', '', 'IBU SOFYON', '', 'KOSAMBI', 'KOSAMBI', 'BANDUNG', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3118, '', '', 'Bp. SIROD', '', 'KOSAMBI', 'KOSAMBI', 'BANDUNG', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3120, '', '', 'DESKI', 'DESKI', 'JL. DEWI SARTIKA 100', 'JL. DEWI SARTIKA 100', 'BANDUNG', '', 1, 13, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3121, '', '', 'PAK RIDWAN', 'RIDWAN', 'JL. CIBADUYUT RAYA NO. 43', 'JL. CIBADUYUT RAYA NO. 43', 'BANDUNG', '', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3122, '', '', 'Bpk. H. Ayi Dimyati', '', 'KANTOR OPERASIONAL SETRA DUTA', 'KANTOR OPERASIONAL', 'BANDUNG', '0811206532', 1, 13, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3124, '', '', 'LARIS SNACK', '', 'JL. CIWIDEY / SOREANG - SADU KM 1', 'JL. CIWIDEY / SOREANG - SADU KM 1', '', '082295317909', 1, 13, 58, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3127, '', '', 'ITC', '', 'ITC', 'ITC', 'BANDUNG', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3128, '', '', 'PAK TONI', '', 'KIARA CONDONG', 'KIARA CONDONG', 'BANDUNG', '081221311550', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3133, '', '', 'TETANGGA ( FOTOCOPY)', '', 'JL. DEWI SARTIKA', 'JL. DEWI SARTIKA', 'BANDUNG', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3134, '', '', 'IBU YULI', '', 'JL. PESANTREN CIMAHI', 'JL. PESANTREN CIMAHI', 'BANDUNG', '081322217706', 1, 14, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3139, '', '', 'PAK DADANG', '', 'DAGO', 'DAGO', '', '', 1, 13, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3143, '', '', 'MAS DORI (PEGAWAI ODJOLALI)', '', 'CIHAMPELAS', 'CIHAMPELAS', 'BANDUNG', '', 1, 13, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3145, '', '', 'Hotel ASMILA', 'Ibu Cahya', 'Jl. Setiabudhi', 'Jl. Setiabudhi', 'Bandung', '', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3147, '', '', 'TEH IKA', 'TEHN IKA', 'CIPARAY', 'CIPARAY', '', '', 1, 14, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '', 45, 0),
(3149, '', '', 'Tah Ika', 'teh Ika', 'Ciparay', 'Ciparay', 'bandung', '', 1, 14, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3153, '', '', 'Aneka Rasa, Cibaduyut', '', 'Cibaduyut', 'Cibaduyut', 'BANDUNG', '', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3156, '', '', 'Dua Saudara, Pasirkoja', '', 'Perempatan Tol Pasirkoja', 'Perempatan Tol Pasirkoja', 'BAndung', '085315441754', 1, 14, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3158, '', '', 'ODJO LALI 126', 'TONI', 'JL. CIHAMPELAS', 'JL. CIHAMPELAS', 'BANDUNG', '085722181842', 1, 13, 60, '', NULL, 0, 0, 4872000, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3161, '', '', 'Toko 16', '', 'Cikutra', 'Cikutra', 'Bandung', '7202544', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3162, '', '', 'Formil Belakang', 'H. Cucu', 'Cibaduyut', 'Cibaduyut', 'Bandung', '081298465945', 1, 14, 55, '', NULL, 0, 0, 1700000, '02', 0, 1, 0, '', '1.1.2.1.1', 45, 0),
(3167, '', '', 'KOBEN', '', 'SEDERHANA', 'SEDERHANA', 'BANDUNG', '087722739399', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3168, '', '', 'SUKA SARI', '', 'CIHAMPELAS', 'CIHAMPELAS', 'BANDUNG', '', 1, 13, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3170, '', '', 'PRIMA RASA CIHAMPELAS', '', 'JL. CIHAMPELAS', 'JL. CIHAMPELAS', 'BANDUNG', '', 1, 13, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3172, '', '', 'ANEKA SARI', '', 'LEUWI PANJANG', 'LEUWI PANJANG', 'BANDUNG', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3173, '', '', 'RM. Seuhah Dalada', 'Bpk. Dede', 'Jl. Raya lembang 121', 'Jl. Raya lembang 121', 'Bandung', '08122400003', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3178, '', '', 'PAK YUKI', '', 'CIJAGRA', 'CIJAGRA', 'BANDUNG', '', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3181, '', '', 'Barokah Ibu', '', 'Terminal Leuwi Panjang No. 143', 'Terminal Leuwi Panjang No. 143', 'Bandung', '022.5230414', 1, 14, 56, '', NULL, 0, 0, 340000, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3183, '', '', 'Kartika Sari, CJR', '', 'JL. IR. H. JUANDA CIANJUR', 'JL. IR. H. JUANDA CIANJUR', 'CIANJUR', '0263-262520', 11, 15, 64, '', NULL, 0, 0, 1529500, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3186, '', '', 'Jati Rasa', '', 'Jl. Soekarno Hatta', 'Jl. Soekarno Hatta', 'Bandung', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3190, '', '', 'Pak Nana', '', 'Pasteur', 'Pasteur', 'Bandung', '087744009912', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3191, '', '', 'Jaya 2', 'Bu Marini', 'Pasar Sederhana', 'Pasar Sederhana', 'Bandung', '022.2030771', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3194, '', '', 'HEAVEN', '', 'JL. Lodaya', 'JL. Lodaya', 'Bandung', ' 022-7303987', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3196, '', '', 'Iteung / Santi', 'Iteung / Santi', 'Jl. Anggrek 55', 'JL. RAYA TANGKUBAN PERAHU NO. 186 CIBOGO LEMBANG', 'Bandung', '08562006007', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3198, '', '', 'Pak Aam', '', 'Cihampelas', 'Cihampelas', 'Bandung', '', 1, NULL, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3201, '', '', 'Ibu Atik', '', 'Jl. By Pass Ngurah Rai No. 89', 'Jl. By Pass Ngurah Rai No. 89', 'Bali', '0361-702288', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3203, '', '', 'Pak Agus', '', 'Jl. Dewi Sartika No. 100', 'Jl. Dewi Sartika No. 100', 'Bandung', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3205, '', '', 'Sindang Reret', 'Ibu Devi', 'Jl. Moh. Ramdhan', 'Jl. Moh. Ramdan', 'Bandung', '022-5228989', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3212, '', '', 'RM. Mergosari', 'FERI IRAWAN', 'Jl. Pelajar Pejuang No.90', 'Jl. Pelajar Pejuang No.90', 'BANDUNG', '085692567061', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3213, '', '', 'NITA', '', 'SPG', 'SPG', 'BANDUNG', '', 1, 14, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3217, '', '', 'Suka Sari', 'Ibu Vivin', 'Jl. Dr. Djunjunan No. 135', 'Jl. Dr. Djunjunan No. 135', 'Bandung', '081809118080', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3222, '', '', 'Garnison', '', '', '', 'BANDUNG', '', 1, 13, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3223, '', '', 'Ibu Joice, Putri Kekasih', '', 'Jl Asia Afrika No 118-120', 'Jl Asia Afrika No 118-120', '', '', 1, 13, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3224, '', '', 'TK BELVAN', '', 'JL. Terusan Buah Batu', 'JL. Terusan Buah Batu', 'Bandung', '', 1, 13, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3225, '', '', 'KAMPUNG GAJAH, PARONGPONG', 'BU CINCING', 'PARONGPONG', 'PARONGPONG', 'BANDUNG', '081802152288', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3226, '', '', 'PANCAKE MEDAN', '', 'JLN. LODAYA 100', 'JLN. LODAYA 100', 'BANDUNG', '', 1, 13, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3228, '', '', 'CAHAYA RASA, KOPO', '', 'kopo', 'kopo', 'BANDUNG', '', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3230, '', '', 'WISATA PAKU HAJI', '', 'JL. H. GOFUR KM 4', 'JL. H. GOFUR KM 4', 'BANDUNG', '', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3238, '', '', 'INSIDENTIL', '', 'jL.', '', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3240, '', '', 'INTAN', '', 'JL. Pasir Koja No.', 'JL. Pasir Koja No.', 'Bandung', '', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3248, '', '', 'PD. MAKMUR', '', 'JL. GEGERKALONG HILIR NO. 19', 'JL. GEGERKALONG HILIR NO. 19', 'BANDUNG', '022 2044697', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3249, '', '', 'RM. Ma Uneh', '', 'Jl. Setiabudhi No. 159', 'Jl. Setiabudhi No. 159', 'Bandung', '022.2011859', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3250, '', '', 'RM. Daun Pisang', '', 'Jl. Setiabudhi No. 134', 'Jl. Setiabudhi No.134', 'BANDUNG', '022. 2037575', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3251, '', '', 'PD. Rejeki', 'Bu Matria', 'Jl. Setiabudhi No. 50', 'Jl. Setiabudhi No. 50', 'BANDUNG', '022.91641659', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3252, '', '', 'MM. Inti Sari', '', 'JL. Setiabudhi No. 103', 'JL. Setiabudhi No. 103', 'BANDUNG', '022.2034650', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3253, '', '', 'KANTIN KPU', 'Bu Adah', 'Jl. Garut no. 9', 'Jl. Garut no. 9', 'Bandung', '081910500197', 1, NULL, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3254, '', '', 'Primer Koperasi Kartika', 'Bp. Napit', 'Jl. Ciremei No. 9', 'Jl. Ciremei No. 9', 'Bandung', '08122493205', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3255, '', '', 'Inti Mart Toha', 'Bp. Yudi', 'Jl. Muhammad Toha No. 77', 'Jl. muhammad Toha no.77', 'Bandung', '085659031993', 1, NULL, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3257, '', '', 'Inti Mart BKR', 'P. Toni', 'Jl. BKR No. 169', 'Jl. BKR No. 169', 'Bandung', '081320489874', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3258, '', '', 'Core 9', '', 'Jl. Komp. Surapati A.B no. 9', 'Jl. Komp. Surapati A.B no. 9', 'Bandung', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3259, '', '', 'Bulog Mart', 'Bu Noni', 'Jl. Soekarno Hatta No. 711 A', 'Jl. Soekarno Hatta No. 711 A', 'Bandung', '085722944401', 1, NULL, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3260, '', '', 'Koperasi Exagon', 'Bpk. Asep', 'Jl. RancaBolang no. 36', 'Jl. RancaBolang no. 36', 'Bandung', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3261, '', '', 'Koperasi Swadarma', 'Pak Yayat', 'Jl. Asia Afrika No. 119', 'Jl. Asia Afrika No. 119', 'Bandung', '022.88884112', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3262, '', '', 'KOPERASI SWADARMA', 'Pak Yayat', 'JL. ASIA AFRIKA NO. 119', 'JL. ASIA AFRIKA NO. 119', 'BANDUNG', '022-88884112', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3264, '', '', 'MINDO RASA', '', 'JL. PADASUKA,KOMP. RUKO SUCI RESIDENT NO. 44', 'JL. PADASUKA,KOMP. RUKO SUCI RESIDENT NO. 44', 'BANDUNG', '022-92054953', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3266, '', '', 'BAHAGIA MINI MARKET', 'ANNA', 'JL. H. JUANDA NO. 198', 'DAGO', 'BANDUNG', '022-2503747', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3269, '', '', 'GANDA JAYA', '', 'JL. KARAWITAN NO. 92', 'JL. KARAWITAN NO. 92', 'BANDUNG', '022-7302507', 1, NULL, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3270, '', '', 'PONYO CIBIRU', '', 'JL. RAYA CINUNUK NO. 168', 'JL. RAYA CINUNUK NO. 168', 'BANDUNG', '', 1, NULL, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3271, '', '', 'RM. SOP BUNTUT', '', 'JL. RAYA CIPACUNG NO. 17', 'JL. RAYA CIPACUNG NO. 17', 'BANDUNG', '', 1, NULL, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3272, '', '', 'JALU DESA', '', 'JL. RAYA CILEUNYI NO. 81', 'JL. RAYA CILEUNYI', '', '', 1, 13, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3273, '', '', 'PUTRI SNACK, CIJERAH', '', 'CIJERAH', 'CIJERAH', 'BANDUNG', '', 1, 14, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3274, '', '', 'MARGA LESTARI', '', 'CIJERAH', 'CIJERAH', 'BANDUNG', '08122227029', 1, 14, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3278, '', '', 'MM.BAROKAH', '', 'JLN.TUBAGUS ISMAIL NO.40', 'JLN.TUBAGUS ISMAIL NO.40', 'BANDUNG', '', 1, 13, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3279, '', '', 'KEDAI HARUMAN', '', 'JLN.BANTENG NO.100', 'JLN.BANTENG NO.100', 'BANDUNG', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3280, '', '', 'KWINET', '', 'JLN.GATOT SUBROTO NO.113', 'JLN.GATOT SUBROTO NO.113', 'BANDUNG', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3281, '', '', 'REINE', '', 'JLN.PABRIK ACI NO.30', 'JLN.PABRIK ACI NO.30', 'BANDUNG', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3283, '', '', 'PUTRA SNACK', '', 'JLN.CIHAMPELAS', 'JLN.CIHAMPELAS', 'BANDUNG', '', 0, NULL, 0, '', NULL, 0, 0, 4362000, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3286, '', '', 'SOSIS DN BASO', '', 'ABDURAHMAN SALEH', 'ABDURAHMAN SALEH', 'BANDUNG', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3289, '', '', 'SOSIS DN BASO', '', '', '', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '', 0, 0),
(3290, '', '', 'vmart', '', 'jln.lengkong kecil no.30', 'jln.lengkong kecil no.30', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3293, '', '', 'vmart', '', '', '', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3295, '', '', 'rinjani', '', 'jln.raya suparmin no.12 huseein', 'jln.raya suparmin no.12 huseein', '', '', 1, NULL, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3296, '', '', 'TK HELENA', '', 'JLN.RANCABENTANG', 'JLN.RANCABENTANG', '', '', 1, 13, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3297, '', '', 'TK.PERMATA', '', '', '', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3300, '', '', 'SUMBER BARU', '', 'KALI PAH APO', 'KALI PAH APO', 'BANDUNG', '', 1, 13, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3303, '', '', 'TK CEMILAN KITA', '', 'JLN.KALI PAH APO NO.16', 'JLN.KALI PAH APO NO.16', 'BANDUNG', '', 1, 13, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3304, '', '', 'TK SIDODADI', '', 'JLN.OTISTA NO.225', 'JLN.OTISTA NO.225', 'BANDUNG', '', 1, 13, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3306, '', '', 'TK ANIS', '', '', 'JLN.OTISTA', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3307, '', '', 'KOP. PTPN', '', 'JLN. SINDANG SIRNA NO 4', 'JLN. SINDANG SIRNA NO 4', 'BANDUNG', '', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3308, '', '', 'MM RANJANI', '', 'JLN.PELAJAR PEJUANG NO.42', 'JLN.PELAJAR PEJUANG NO.42', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3309, '', '', 'tk peuyeum ketan istimewa', '', 'jln.smp / cimahi no.1', 'jln.smp / cimahi no.1', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3310, '', '', 'tk manis', '', 'jln.gatsu no.112 cimahi', 'jln.gatsu no.112 cimahi', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3311, '', '', 'katapang', '', 'kopo', 'kopo', 'bandung', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3313, '', '', 'faf snack', '', 'lw.panjang', 'lw.panjang', 'bandung', '', 1, 13, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3314, '', '', 'Tk.anugrah', '', 'jln.itc 2 no.01', 'jln.itc 2 no.01', 'bandung', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3315, '', '', 'ANDIKA PASAR ANTRI', '', 'PASAR ANTRI', 'PASAR ANTRI', 'BANDUNG', '', 1, NULL, 61, '', NULL, 0, 0, 2076000, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3316, '', '', 'PAK SIROD', '', 'KOSAMBI', 'KOSAMBI', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3317, '', '', 'kop.kartika', '', 'jln.ceremei no.19', 'jln.ceremei no.19', 'BANDUNG', '', 1, 13, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3319, '', '', 'KONSUINCA', '', 'KEBON KELAPA', 'KEBON KELAPA', 'BANDUNG', '', 1, NULL, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3320, '', '', 'SARI NIKMAT ITC', '', 'ITC', 'ITC', 'BANDUNG', '085860035540', 1, 14, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3321, '', '', 'tk rafka', '', 'jln.pawdn o.4', 'jln.pawdn o.4', 'bandung', '', 1, NULL, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3322, '', '', 'TK BU ATIK', '', 'JLN.KARAWITAN', 'JLN.KARAWITAN', 'BANDUNG', '', 1, NULL, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3323, '', '', 'DIANA', 'DIANA', 'JL. CIBADUYUT', 'JL. CIBADUYUT', 'BANDUNG', '', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3326, '', '', 'TK. PADA SUKA RASA', '', 'JL. KEBON KOPI', 'JL. KEBON KOPI', 'BANDUNG', '', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3330, '', '', 'SEGITIGA. TK', '', 'JL. SRIWIJAYA CIMAHI', 'JL. SRIWIJAYA CIMAHI', 'BANDUNG', '', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3331, '', '', 'YUMMY. TK', '', 'CIMAHI', 'CIMAHI', 'BANDUNG', '', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3335, '', '', 'BPK. UJANG SNACK', '', 'JL. KOL. MASTURI', 'JL. KOL. MASTURI', 'BANDUNG', '', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3338, '', '', 'RASA. TK', '', 'JL. PAHLAWAN', 'JL. PAHLAWAN', 'BANDUNG', '', 1, 14, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3339, '', '', 'YANTI OLEH-OLEH', '', 'JL CIDURIAN UTARA NO 100', 'JL CIDURIAN UTARA NO 100', 'BANDUNG', '', 1, 13, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3340, '', '', 'KOGAR WASERDA', '', 'JL. NIAS', 'JL. NIAS', 'BANDUNG', '', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3341, '', '', 'MAYA SARI, PUNGKUR', '', 'JL PUNGKUR', 'JL PUNGKUR', 'BANDUNG', '', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3343, '', '', 'SARI INTAN', '', 'PASIR KOJA', 'PASIR KOJA', 'BANDUNG', '', 1, NULL, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '1', '1.1.2.1.1', 18, 0),
(3344, '', '', 'SARI INTAN', '', 'PASTEUR', 'PASTEUR', '', '', 1, NULL, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3349, '', '', 'GRUTY', '', 'CIBADUYUT', 'CIBADUYUT', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '', 0, 0),
(3351, '', '', 'WASERDA KOPRASI', '', 'JL. NIAS 3 NO.3', 'JL. NIAS 3 NO.3', '', '', 1, 13, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3352, '', '', 'ENDA', '', 'JL. NIAS 3 NO. 3', 'JL. NIAS 3 NO. 3', 'BANDUNG', '', 1, 13, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '1', '1.1.2.1.1', 73, 0),
(3354, '', '', 'MM INTISARI', '', 'JL SETIA BUDI', 'JL SETIA BUDI', '', '', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3355, '', '', 'MM BAROKAH', '', 'JL. TUBAGUS ISMAIL NO.40', 'JL. TUBAGUS ISMAIL NO.40', '', '', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3358, '', '', 'PEYEUM KETAN ISTIMEWA', '', 'JL. SMP 1 NO. 1 CIMAHI', 'JL. SMP 1 NO. 1 CIMAHI', 'BANDUNG', '', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3359, '', '', 'MM WIDYA', '', 'JL PAHLAWAN NO. 49', 'JL PAHLAWAN NO. 49', '', '', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3360, '', '', 'TK. IBU ARI', '', 'JL KARAWITAN NO. 103', 'JL KARAWITAN NO. 103', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3363, '', '', 'julia bakery', '', 'JL. RIAU NO. 11', 'JL. RIAU NO. 11', 'BANDUNG', '', 1, 13, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3364, '', '', 'TK REINATA', '', 'JL RANCA BOLANG NO. 10', 'JL RANCA BOLANG NO. 10', '', '', 1, 13, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3366, '', '', 'tk andini oleh-oleh', '', 'jl suci no.100', 'jl suci no.100', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3367, '', '', 'surya rasa', '', 'soekarno hatta', 'soekarno hatta', 'BANDUNG', '', 1, 13, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3370, '', '', 'mm nanutz', '', 'jl babakan ciparay', 'jl babakan ciparay', '', '', 1, 13, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3373, '', '', 'KOP. GEDUNG SATE', '', 'JL DIPONOGORO NO.22', 'JL DIPONOGORO NO.22', 'BANDUNG', '', 1, 14, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3374, '', '', 'MM OMI', '', 'JL PURNAWARMAN NO. 56', 'JL PURNAWARMAN NO. 56', 'BANDUNG', '', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3376, '', '', 'TK RIZKY', '', 'JL TERUSAN PSM NO.171', 'JL TERUSAN PSM NO.171', 'BANDUNG', '', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3377, '', '', 'JAYA BERKAH', '', 'KOSAMBI', 'KOSAMBI', 'BANDUNG', '', 1, NULL, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3378, '', '', 'sosis baso', '', 'jl lengkong kecil no. 61', 'jl lengkong kecil no. 61', 'bandung', '', 1, NULL, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3379, '', '', 'pak ujang snack', '', 'jl. kolonil masturi', 'jl. kolonil masturi', 'bandung', '', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3381, '', '', 'karina swalayan', '', 'jl tata surya no. 9 B', 'jl tata surya no. 9 B', '', '', 1, 14, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3382, '', '', 'CIPTA RASA', '', 'JL. KEBON KAWUNG', 'JL. KEBON KAWUNG', '', '', 1, 14, 56, '', NULL, 0, 0, 608000, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3383, '', '', 'PADA SUKA', '', 'KEBON JUKUT', 'KEBON JUKUT', '', '', 1, 13, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3386, '', '', 'CHIKA CEMERLANG SNACK', '', 'PASTER', 'PASTER', '', '', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3388, '', '', 'KEDAI NONI', 'Bapak Ferdinan', 'JL. CIHAMPELAS NO.137', 'JL. CIHAMPELAS NO.137', 'BANDUNG', '0816602237', 1, 14, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3391, '', '', 'TK, HRD', '', 'JL. PADASUKA NO.101 B', 'JL. PADASUKA NO.101 B', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3393, '', '', 'IBU AISAH', '', 'SITU PATENGGANG', 'SITU PATENGGANG', '', '', 1, 13, 57, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3398, '', '', 'BAGJA RASA', '', 'LEUWIPANJANG', 'LEUWIPANJANG', '', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3399, '', '', 'ULAH LALI', '', 'PASTER NO.75', 'PASTER NO.75', '', '', 1, 14, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3403, '', '', 'IBU ANIH OLEH-OLEH', '', 'JL. RAYA PATENGGANG NO.50', 'JL. RAYA PATENGGANG NO.50', 'BANDUNG', '', 1, 13, 57, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3404, '', '', 'PD PUTRA', '', 'JL RAYA PATENGGANG', 'JL RAYA PATENGGANG', '', '', 1, 13, 57, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3405, '', '', 'D''SEUHAH DA LADA', '', 'JL. RAYA LEMBANG NO.121', 'JL. RAYA LEMBANG NO.121', 'BANDUNG', '', 1, 14, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3406, '', '', 'TK. DINDA', '', 'JL. AHMAD YANI NO. 50', 'JL. AHMAD YANI NO. 50', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3407, '', '', 'SHANTI', '', 'PASTER', 'PASTER', '', '081320257831', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3410, '', '', 'TK. CIHAPIT', '', 'JL.CIHAPIT', 'JL.CIHAPIT', 'BANDUNG', '', 1, 13, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3412, '', '', 'TK. MIA OLEH-OLEH', '', 'JL. RAYA LEMBANG NO. 246', 'JL. RAYA LEMBANG NO. 246', 'BANDUNG', '', 1, 14, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3413, '', '', 'SM OLEH-OLEH', '', 'JL. SETIABUDI NO. 80 B', 'JL. SETIABUDI NO. 80 B', 'BANDUNG', '', 1, 14, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3414, '', '', 'D''SDL', '', 'JL. RAYA LEMBANG', 'JL. RAYA LEMBANG', '', '', 1, 14, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3415, '', '', 'NURMAN SNACK', '', 'JL. PURWAKARTA NO.118', 'JL. PURWAKARTA NO.118', 'BANDUNG', '', 1, 13, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3416, '', '', 'CLEAN 8', '', 'JL. GATSU NO. 426', 'JL. GATSU NO. 426', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3417, '', '', 'SIDIK RAOS', '', 'JL. DARWATI CIWASTRA', 'JL. DARWATI CIWASTRA', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3418, '', '', 'tk. rahmat', '', 'jl. majalaya no.117', 'jl. majalaya no.117', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3419, '', '', 'TK. IBU NANI', '', 'JL. RAYA PATENGGANG CIWIDEY', 'JL. RAYA PATENGGANG CIWIDEY', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3420, '', '', 'VICTORY', '', 'JL. DAGO', 'JL. DAGO', '', '', 1, 14, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3421, '', '', 'MONGGO LESTARI', '', 'JL. NANJUNG', 'JL. NANJUNG', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3423, '', '', 'SUNIA RASA', '', 'JL. SUNIARAJA NO.135', 'JL.SUNIARAJA', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3424, '', '', 'MIRASA', '', 'JL. KOLONEL MASTURI', 'JL. KOLONEL MASTURI', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3425, '', '', 'TK. ANTA', '', 'JL. KIARACONDONG', 'JL. KIARACONDONG', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3426, '', '', 'ROTI MENEL', '', 'JL.KARAWITAN NO.40', 'JL.KARAWITAN NO.40', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3427, '', '', 'FITRI OLEH-OLEH', '', 'JL. PADA SUKA NO. 10A', 'JL. PADA SUKA NO. 10A', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3428, '', '', 'RM. PAK YANA', '', 'JL. RINJANI SUPARMIN NO. 6', 'JL. RINJANI SUPARMIN NO. 6', '', '', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3429, '', '', 'ORCHID', '', '', '', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3430, '', '', 'LIMA JAYA', '', 'JL. BALE ENDAH', 'JL. BALE ENDAH', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3431, '', '', 'TK. NC - NDUT', '', 'JL. DARMAWATI NO.156', 'JL. DARMAWATI NO.156', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3432, '', '', 'TK. JANE', '', 'JL. GEGERKALONG NO.10 B', 'JL. GEGERKALONG NO.10 B', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3434, '', '', 'PT. BCS', '', 'JL. BOJONG KONENG ATAS NO. 43', 'JL. BOJONG KONENG ATAS NO. 43', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3436, '', '', 'NATA OLEH-OLEH', '', 'JL GATSU NO.245', 'JL GATSU NO.245', 'BANDUNG', '', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3439, '', '', 'TK. RAFLI SNACK', '', 'JL. CIWASTRA NO. 256', 'JL. CIWASTRA NO. 256', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3440, '', '', 'TK. IBU ITA', '', 'JL. CIWASTRA NO. 115', 'JL. CIWASTRA NO. 115', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3443, '', '', 'BERKAH SARI', '', 'PASTER', 'PASTER', 'BANDUNG', '', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3444, '', '', 'BATAGOR KINGSLAY', '', 'JL. VETERAN', 'JL. VETERAN', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3445, '', '', 'HARUM SARI', '', 'PASTER', 'PASTER', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3447, '', '', 'TK. JAHNA', '', 'JL. TERUSAN BUAH BATU NO. 101', 'JL. TERUSAN BUAH BATU NO. 101', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3449, '', '', 'TK. RAFI', '', 'JL. GEGERKALONG NO. 141', 'JL. GEGERKALONG NO. 141', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3450, '', '', 'SARI SEJATI', '', 'JL. LEUWI PANJANG', 'JL. LEUWI PANJANG', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3451, '', '', 'TK. DNC', '', 'JL. TERUSAN SOEKARNO HATTA NO.111', 'JL. TERUSAN SOEKARNO HATTA NO.111', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3452, '', '', 'HARYANTO DHARMATIN TUNGGAL', '', 'JL. SIMPANG PAHLAWAN 3 NO. 8 NEGALASARI CIBEUNYING JALER', 'JL. SIMPANG PAHLAWAN 3 NO. 8 NEGALASARI CIBEUNYING', 'BANDUNG', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3453, '', '', 'TK. CHIKO', '', 'JL. DAYEUH KOLOT', 'JL. DAYEUH KOLOT', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3454, '', '', 'TK. DIKI', '', 'BALE ENDAH', 'BALE ENDAH', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3456, '', '', 'TK. MAKMUR', '', 'JL. DAYEUH KOLOT NO. 101 B', 'JL. DAYEUH KOLOT NO. 101 B', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3457, '', '', 'ADI JAYA', '', 'JL. BALE ENDAH NO. 100', 'JL. BALE ENDAH NO. 100', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3458, '', '', 'MINAR 2', '', 'JL. KOLONEL MASTURI NO.8', 'JL. KOLONEL MASTURI NO.8', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3460, '', '', 'SINAR REJEKI', '', 'JL. BALE ENDAH 10 B', 'JL. BALE ENDAH 10 B', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3461, '', '', 'SHINTA', '', 'PASTEUR', 'PASTEUR', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3462, '', '', 'PAK OMAN', '', 'JL. CIWASTRA', 'JL. CIWASTRA', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3464, '', '', 'SURYA, TK', '', 'JL. BALE ENDAH NO.103', 'JL. BALE ENDAH NO.103', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3465, '', '', 'SRI REJEKI', '', 'JL. KIARA CONDONG', 'JL. KIARA CONDONG', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3468, '', '', 'MM PRIMER', '', 'JL. TERUSAN ANTAPANI 110', 'JL. TERUSAN ANTAPANI 110', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3469, '', '', 'HELEN', '', 'JL. SURAPATI NO. 10 B', 'JL. SURAPATI NO. 10 B', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3471, '', '', 'DUBAI SNACK', '', 'JL. CIDURIAN UTARA', 'JL. CIDURIAN UTARA', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3473, '', '', 'LUGINA, TK', '', 'JL. RAYA PANGALENGAN', 'JL. RAYA PANGALENGAN', 'BANDUNG', '', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3474, '', '', 'HARYONO, TK', '', 'JL. RAYA PANGALENGAN', 'JL. RAYA PANGALENGAN', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0);
INSERT INTO `tbl_customer` (`customer_id`, `customer_code`, `customer_group`, `customer_name`, `contact_name`, `address1`, `address2`, `address3`, `phone`, `wilayah_id`, `subwil_id`, `area_id`, `npwp`, `fax`, `discount`, `invoice_max`, `saldo_awal`, `kode_depo`, `due_day`, `curency`, `freight`, `tax`, `ar_acc`, `sales_id`, `credit_max`) VALUES
(3475, '', '', 'BAROKAH, TK', '', 'JL. RAYA PANGALENGAN NO. 25', 'JL. RAYA PANGALENGAN NO. 25', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3476, '', '', 'SRI RASA', '', 'JL. RAYA PANGALENGAN', 'JL. RAYA PANGALENGAN', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3478, '', '', 'TIRTA, TK', '', 'JL. RAYA LEMBANG', 'JL. RAYA LEMBANG', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3479, '', '', 'ARSIH, TK', '', 'JL. RAYA PANGALENGAN', 'JL. RAYA PANGALENGAN', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3480, '', '', 'VILA MELATI', '', 'JL. RAYA LEMBANG', 'JL. RAYA LEMBANG', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3483, '', '', 'ARRAHMAH OLEH - OLEH BANDUNG', '', 'JL. LEUWIPANJANG', 'JL. LEUWIPANJANG', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3485, '', '', 'TINTA, TK', '', 'JL. RAYA LEMBANG', 'JL. RAYA LEMBANG', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3488, '', '', 'TK. SARI MILO', '', 'JL. BALE EDAH', 'JL. BALE EDAH', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3489, '', '', 'IMAS, TK', '', 'JL. MEKAR WANGI NO. 102', 'JL. MEKAR WANGI NO. 102', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3492, '', '', 'KRIPIK TEMPE', '', 'JL. TERUSAN BUAH BATU NO. 189', 'JL. TERUSAN BUAH BATU NO. 189', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3494, '', '', 'TK. ADE KUE', '', 'PASAR SEDERHANA', 'PASAR SEDERHANA', '', '083822922079', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3496, '', '', 'KARYA GUNA, TK', '', 'JL. CIMINDI NO. 156', 'JL. CIMINDI NO. 156', 'BANDUNG', '', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3497, '', '', 'tk. rasa nikmat', '', 'jl. mekar wangi no. 101 cibaduyut', 'jl. mekar wangi no. 101 cibaduyut', 'bandung', '', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3499, '', '', 'tk. sarinah', '', 'jl. cibaduyut no. 11', 'jl. cibaduyut no. 11', 'bandung', '', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3500, '', '', 'TK. SARI RASA', '', 'JL. RAYA PANGALENGAN', 'JL. RAYA PANGALENGAN', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3502, '', '', 'tk. sarimbit', '', 'jl. ciwastra no.171', 'jl. ciwastra no.171', 'bandung', '', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3503, '', '', 'oleh-oleh kota kembang', 'IBU SUSI', 'jl. dago', 'jl. dago', '', '081266939363', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3505, '', '', 'tk. akbar', '', 'jl. ciparay no. 10', 'jl. ciparay no. 10', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3506, '', '', 'tk. mega barokah', '', 'jl. raya majalaya no. 241', 'jl. raya majalaya no. 241', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3507, '', '', 'tk. berkah ibu', '', 'jl. majalaya no. 100', 'jl. majalaya no. 100', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3509, '', '', 'YANA, SALES', '', 'JL. DEWI SARTIKA 100', 'JL. DEWI SARTIKA 100', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3511, '', '', 'PAK AGUS', '', 'CIMAHI', 'CIMAHI', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3513, '', '', 'IBU DIAN', '', 'JL. RAYA CIWIDEY NO. 1-B', 'JL. RAYA CIWIDEY NO. 1-B', 'BANDUNG', '', 1, 13, 57, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3518, '', '', 'TK. IBU RANI OLEH-OLEH', '', 'JL. CIMINDI NO. 201', 'JL. CIMINDI NO. 201', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3519, '', '', 'MARTHA KUE', '', 'JL. CIMINDI NO. 211', 'JL. CIMINDI NO. 211', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3520, '', '', 'OLEH-OLEH BANDUNG', '', 'UJUNG BERUNG', 'UJUNG BERUNG', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3525, '', '', 'RM. BUMBU DESA', 'IBU LULI KANIA', 'JL. LASWI NO. 1', 'JL. LASWI NO. 1', '', '0227100539', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3528, '', '', 'GENAH RASA', '', 'CIMINDI', 'CIMINDI', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3530, '', '', 'FLOATING MARKET', 'IBU MELANI', 'JL. GRAND HOTEL NO. 3E , LEMBANG', 'JL. GRAND HOTEL NO. 3E , LEMBANG', 'BANDUNG', '022-2787766', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3531, '', '', 'SARI MILO, 2', '', 'LEWIPANJANG', 'LEWIPANJANG', '', '', 0, NULL, 0, '', NULL, 0, 0, 1836000, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3533, '', '', 'IBU ARNI', 'IBU ARNI', 'JL. KAMPUS 1 NO. 07 KEBAKTIAN', 'JL. KAMPUS 1 NO. 07 KEBAKTIAN', 'BANDUNG', '081585565807', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3536, '', '', 'TK. EVITART', '', 'JL. IR. JUANDA NO. 83', 'JL. IR. JUANDA NO. 83', '', '022-92009828', 1, 14, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3537, '', '', 'LARISA, TK', 'IBU. INDRI', 'JL. TERUSAN JAKARTA', 'JL. TERUSAN JAKARTA', '', '', 0, NULL, 0, '', NULL, 0, 0, 816000, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3538, '', '', 'TOPS KM 72', 'BP. AGUS', 'REST AREA KM 72', 'REST AREA KM 72', '', '085289315632', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3539, '', '', 'TK. WENDY', '', 'PADALARANG NO. 528', 'PADALARANG O. 528', '', '022-6809373', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3540, '', '', 'TK. ANEKA BARU', '', 'CIANJUR', 'CIANJUR', '', '', 7, NULL, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3541, '', '', 'TK. KARTIKA SARI', '', 'JL. IR. H. JUANDA CIANJUR', 'JL. IR. H. JUANDA CIANJUR', '', '262520', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3542, '', '', 'TK. SUMBER WANGI', '', 'CIANJUR', 'CIANJUR', 'CIANJUR', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3543, '', '', 'PRIANGAN SARI', '', 'JL. RAYA BOGOR', 'JL. RAYA BOGOR', 'BOGOR', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3545, '', '', 'TK. ASGAR', 'BP. IYUS', 'JL. RAYA CARINGIN', 'JL. RAYA CARINGIN', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3546, '', '', 'TK. ROTI & KUE ABADI', '', 'JL. PURNAWARMAN', 'JL. PURNAWARMAN', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3547, '', '', 'TK. KOPATRA', '', 'JL. TANGKUBAN PERAHU CIKOLE', 'JL. TANGKUBAN PERAHU CIKOLE', '', '089661373102', 0, NULL, 0, '', NULL, 0, 0, 744750, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3548, '', '', 'BERKAH JAYA, TK', '', 'JL. KALI ASIN', 'JL. KALI ASIN', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3549, '', '', 'NIRMALA, TK', '', 'TAMBAK MEKAR', 'TAMBAK MEKAR', '', '', 7, 20, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3550, '', '', 'TK. CIREBON', 'IBU MAYA', 'JL. CIKALONG BYPAS', 'JL. CIKALONG BYPAS', '', '085924163444', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3552, '', '', 'OLEH-OLEH NIRMALA', '', 'JL. TAMBAK MEKAR CAGAK SUBANG', 'JL. TAMBAK MEKAR CAGAK SUBANG', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3553, '', '', 'KIOS TAPE KH. NURHAYATI', '', 'JL. RAYA KALI ASIN', 'JL. RAYA KALI ASIN', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3554, '', '', 'KIOS TAPE IBU EEN', '', 'JL. RAYA KALI ASIN', 'JL. RAYA KALI ASIN', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3555, '', '', 'PLAMBOYAN', '', 'JL. KALI ASIN', 'JL. KALI ASIN', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3556, '', '', 'KIOS TAPE MANDIRI', '', 'JL. BYPAS JOMIN CIKAMPEK', 'JL. BYPAS JOMIN CIKAMPEK', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3557, '', '', 'TOPS KM 62 SENTRA', '', 'REST AREA KM 62', 'REST AREA KM 62', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3558, '', '', 'TOPS KM 125', '', 'REST AREA KM 125', 'REST AREA KM 125', '', '', 13, 21, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3560, '', '', 'CITRA RASA', '', 'REST AREA KM 125', 'REST AREA KM 125', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3561, '', '', 'BPK. SUYUD', '', 'BUAH BATU', 'BUAH BATU', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3562, '', '', 'TK. PRIBUMI 05', 'JAJANG JAENAL', 'JL. RAYA KARANG TENGAH SADANG SAMOLA CIANJUR', 'JL. RAYA KARANG TENGAH SADANG SAMOLA CIANJUR', 'CIANJUR', '081220665222', 11, 15, 64, '', NULL, 0, 0, 274000, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3564, '', '', 'TK. SARI BAROKAH', 'UMAR', 'JL. RAYA SUKABUMI', 'JL. RAYA SUKABUMI', 'SUKABUMI', '085846584229', 11, 17, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3565, '', '', 'TAUCO CAP MEONG', 'BP. BUDI', 'JL. GUNUNG LANJUNG CIANJUR', 'JL. GUNUNG LANJUNG CIANJUR', 'CIANJUR', '081808482002', 11, 15, 64, '', NULL, 0, 0, 645000, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3566, '', '', 'BP. PALAH', 'BP. PALAH', 'JL. RAYA PUNCAK CIBEREUM', 'JL. RAYA PUNCAK CIBEREUM', '', '', 0, NULL, 0, '', NULL, 0, 0, 210000, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3567, '', '', 'TK. SEGAR', '', 'CISAAT', 'CISAAT', '', '', 11, 17, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3568, '', '', 'BP. APOY', '', 'DAGO', 'DAGO', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3569, '', '', 'KANTIN KEJUJURAN', '', 'JL. PANJUNAN NO. 125', 'JL. PANJUNAN NO. 125', 'BANDUNG', '', 1, 14, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3572, '', '', 'ANUGRAH, TK', '', 'PANGALENGAN', 'PANGALENGAN', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3574, '', '', 'YANTI', '', 'PANGALENGAN', 'PANGALENGAN', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3575, '', '', 'TK. BARINE', '', 'CIANJUR', 'CIANJUR', '', '', 11, 15, 64, '', NULL, 0, 0, 2500000, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3576, '', '', 'GILANG, TK', '', 'JL. MOH JAMIN', 'JL. MOH JAMIN', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3577, '', '', 'TK. ABBIAN', '', 'JL. KALI ASIN', 'JL. KALI ASIN', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3578, '', '', 'RM TAMAN SARI 3', '', 'PAMANUKAN', 'PAMANUKAN', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3579, '', '', 'RM TAMAN SARI STAN 4', '', 'JL. PAMANUKAN', 'JL. PAMANUKAN', '', '', 7, 19, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3580, '', '', 'MANDIRI I, TK', '', 'JL. BY JAMIN', 'JL. BY JAMIN', '', '08121883476', 7, 20, 64, '', NULL, 0, 0, 2968000, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3581, '', '', 'RM. NIKMAT', '', 'JL. SUKAMANDI CIASEM', 'JL. SUKAMANDI CIASEM', '', '081321801711', 7, 18, 64, '', NULL, 0, 0, 170000, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3582, '', '', 'MUBAROK, TK', '', 'PEUM CIKALONG PANTURA', 'PEUM CIKALONG PANTURA', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3583, '', '', 'KIOS NENG CICI', '', 'KALI ASIN', 'KALI ASIN', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3584, '', '', 'SAWARGI, 2', '', 'LEWIPANJANG', 'LEWIPANJANG', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3586, '', '', 'SUKA ZUKA, TK', 'INDRI', 'JL. KAUM SELATAN BATUJAJAR', 'JL. KAUM SELATAN BATUJAJAR', '', '', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3587, '', '', 'OLEH-OLEH INDONESIA', '', 'JL. ASIA AFRIKA NO. 81 BANDUNG', 'JL. ASIA AFRIKA NO. 81 BANDUNG', 'BANDUNG', '', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3588, '', '', 'KURNIA JAWA TIMUR, TK', '', 'LEMBANG', 'LEMBANG', '', '', 0, NULL, 0, '', NULL, 0, 0, 5335000, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3590, '', '', 'HESHI, TK', '', 'PASTER', 'PASTER', 'BANDUNG', '', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3591, '', '', 'PUSAKA, TK', '', 'CIWIDEY', 'CIWIDEY', '', '082317264000', 0, NULL, 0, '', NULL, 0, 0, 544500, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3592, '', '', 'KOP. TRIBUANA IV', 'SAHAR', 'JL. RAYA BATUJAJAR NO. 108', 'JL. RAYA BATUJAJAR NO. 108', '', '022-6865402', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3593, '', '', 'PASMART', 'IKA', 'REST AREA KM 42', 'REST AREA KM 42', '', '08983829456', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3594, '', '', 'ANY SNACK', '', 'REST AREA KM 125', 'REST AREA KM 125', '', '', 0, NULL, 0, '', NULL, 0, 0, 1836000, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3595, '', '', 'MANING, TK', '', 'LEWIPANJANG', 'LEWIPANJANG', '', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3596, '', '', 'SURYA SNACK', '', 'JL. CIHAMPELAS 118', 'JL. CIHAMPELAS 118', '', '', 1, 13, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3597, '', '', 'SARI RASA', '', 'PARONGPONG', 'PARONGPONG', '', '', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3598, '', '', 'INTI SARI', '', 'SETIA BUDI', 'SETIA BUDI', '', '', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3599, '', '', 'TAPE BANDUNG, TK', '', 'REST AREA KM 42', 'REST AREA KM 42', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3600, '', '', 'ROFA SNACK KM 97', '', 'REST AREA KM 97 PURWAKARTA', 'REST AREA KM 97 PURWAKARTA', '', '', 13, 21, 64, '', NULL, 0, 0, 3480000, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3601, '', '', 'ANI SNACK TIMUR', '', 'REST AREA KM 125', 'REST AREA KM 125', '', '', 13, 21, 0, '', NULL, 0, 0, 6489000, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3604, '', '', 'TAHU SUMEDANG, TK', '', 'REST AREA KM 42', 'REST AREA KM 42', '', '', 13, 21, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3605, '', '', 'MA''NING', '', 'LEWIPANJANG', 'LEWIPANJANG', '', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3606, '', '', 'KARTIKA SARI / TOPS', '', 'LEMBANG', 'LEMBANG', '', '', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3607, '', '', 'MEGA RASA / CINTA ASIH', '', 'JL. CIPAYUNG MEGA MENDUNG BOGOR', 'JL. CIPAYUNG MEGA MENDUNG BOGOR', '', '', 11, 16, 0, '', NULL, 0, 0, 1156500, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3610, '', '', 'UMI IRPAN, TK', '', 'LAPAK CIBEUREUM BATU LAWANG', 'LAPAK CIBEUREUM BATU LAWANG', '', '', 11, 15, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3611, '', '', 'SUMBER WANGI, TK', '', 'CIANJUR', 'CIANJUR', '', '', 11, 15, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3612, '', '', 'RM. CIBENING SARI', '', 'PURWAKARTA', 'PURWAKARTA', '', '', 7, 19, 0, '', NULL, 0, 0, 6000000, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3613, '', '', 'ALBAGDAD 2, TK', '', 'JL. RAYA CIKOPO', 'JL. RAYA CIKOPO', '', '', 7, 19, 0, '', NULL, 0, 0, 726000, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3614, '', '', 'BAROKAH JAYA', '', 'KALI ASIN', 'KALI ASIN', '', '', 7, 19, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3615, '', '', 'SAKURA, TK', '', 'PURWAKARTA', 'PURWAKARTA', '', '', 7, 19, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3616, '', '', 'PRIANGAN 1', '', 'BUNGUS SARI PURWAKARTA', 'BUNGUS SARI PURWAKARTA', '', '', 7, 19, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3617, '', '', 'MEDINAH, TK', 'BP. YANA', 'BALTOS TL. D2 BLOK. M-01', 'BALTOS TL. D2 BLOK. M-01', '', '081321893550', 1, 13, 63, '', NULL, 0, 0, 924000, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3618, '', '', 'AYUNDA, TK', '', 'TAMAN SARI BALUBUR', 'TAMAN SARI BALUBUR', '', '', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3619, '', '', 'BAROKAH, TK BALTOS', 'BP. IWAN', 'BALTOS LT. D2 F-11 BALUBUR BANDUNG', 'BALTOS LT. D2 F-11 BALUBUR BANDUNG', '', '085861404544', 1, 13, 63, '', NULL, 0, 0, 62000, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3620, '', '', 'KIOS MANG RUDI', '', 'JL. BOGOR MEGA MENDUNG', 'JL. BOGOR MEGA MENDUNG', '', '', 11, 16, 0, '', NULL, 0, 0, 546000, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3621, '', '', 'TK. FAIZ', '', 'A.YANI BOGOR', 'A.YANI BOGOR', '', '', 11, 16, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3622, '', '', 'SARI MANIS', '', 'CIANJUR', 'CIANJUR', '', '', 11, 15, 0, '', NULL, 0, 0, 5312000, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3623, '', '', 'SUKA SARI', '', 'CIANJUR', 'CIANJUR', '', '', 11, 15, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3624, '', '', 'SINDANG JAYA', '', 'SUKA BUMI', 'SUKA BUMI', '', '', 11, 17, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3625, '', '', 'RYO SNACK', '', 'CIPAYUNG', 'CIPAYUNG', '', '', 11, 16, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3627, '', '', 'KURNIA RASA, TK', '', 'BALUBUR', 'BALUBUR', '', '082177780070', 1, 13, 63, '', NULL, 0, 0, 528000, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3628, '', '', 'HARUM SARI, BEPAS', '', 'JL. SOEKARNO HATTA', 'JL. SOEKARNO HATTA', '', '', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3629, '', '', 'RM. HARAPAN II', '', 'JL. SUBANG TAMBAK MEKAR', 'JL. SUBANG TAMBAK MEKAR', '', '', 7, 18, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3630, '', '', 'TK. SINTA', '', 'JL. CAGAK SUBANG', 'JL. CAGAK SUBANG', '', '', 7, 18, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3631, '', '', 'RM. PANYINDUNGAN', '', 'PANGALENGAN', 'PANGALENGAN', '', '', 1, 13, 58, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3633, '', '', 'SUMBER REJEKI', '', 'CIATER', 'CIATER', '', '', 1, 13, 62, '', NULL, 0, 0, 1771000, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3634, '', '', 'KEDAI PANTAI TIMUR', '', 'PASTER', 'PASTER', '', '', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3635, '', '', 'RM. SRIKANDI', '', 'JL. PANTURA', 'JL. PANTURA', '', '087828471559', 7, 20, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3636, '', '', 'WIJAYA SAPUTRA, TK', '', 'KALI JATI SUBANG', 'KALI JATI SUBANG', '', '081223414971', 7, 18, 64, '', NULL, 0, 0, 1558000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3637, '', '', 'FAMILY TATANG S', '', 'JL. RAYA KALI ASIN', 'JL. RAYA KALI ASIN', '', '08131465956', 7, 19, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3638, '', '', 'PUTRA SOLO PERTIWI', '', 'JL. BY. JOMIN', 'JL. BY. JOMIN', '', '087779056992', 7, 19, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3639, '', '', 'MITA', '', 'JL. BY.JOMIN', 'JL. BY.JOMIN', '', '08777369077', 0, NULL, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3640, '', '', 'SARI MILO', '', 'TERMINAL SUKA BUMI', 'TERMINAL SUKA BUMI', 'SUKABUMI', '', 11, 17, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3643, '', '', 'RAOS RASA', '', 'BATUJAJAR', 'BATUJAJAR', 'BANDUNG', '', 1, 14, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3644, '', '', 'SEBER ASIH', '', 'CILILIN', 'CILILIN', 'BANDUNG', '', 1, 14, 0, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3645, '', '', 'MADU RASA', '', 'MEKAR MUKH CIHAMPELAS NO. 23', 'MEKAR MUKH CIHAMPELAS NO. 23', 'BANDUNG', '', 1, 13, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3647, '', '', 'TAMAN BUDAYA', '', 'DAGO', 'DAGO', '', '', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3649, '', '', 'HARUM JAYA, TK', '', 'JL. SETIA BUDHI', 'JL. SETIA BUDHI', '', '', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3650, '', '', 'BURHAN,TK', '', 'BALE ENDAH', 'BALE ENDAH', '', '', 1, 13, 58, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3651, '', '', 'HALIMI, TK', '', 'JL. DAGO LOS II NO. 110 TERMINAL DAGO', 'JL. DAGO LOS II NO. 110 TERMINAL DAGO', '', '', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3652, '', '', 'TK. MAMAN', '', 'DANGDEUR', 'DANGDEUR', '', '', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3653, '', '', 'KAMILA, TK', '', 'CIKAMPEK', 'CIKAMPEK', '', '', 7, 20, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3654, '', '', 'TAPE TAWAKAL', '', 'KALI ASIN', 'KALI ASIN', '', '', 7, 19, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3655, '', '', 'TAPE BU NENG', '', 'KALI SARI', 'KALI SARI', '', '', 7, 19, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3656, '', '', 'NANIAR BERKAH', '', 'CIKAMPEK', 'CIKAMPEK', '', '', 7, 20, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3657, '', '', 'KIOS GIAN PRIBUMI', '', 'SAMOLO CIANJUR', 'SAMOLO CIANJUR', '', '', 11, 15, 64, '', NULL, 0, 0, 225000, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3658, '', '', 'MANISAN KARTIKA SARI', '', 'CIANJUR', 'CIANJUR', '', '', 11, 15, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3659, '', '', 'LUGAI, TK', '', 'JL. RAYA CIPAYUNG', 'JL. RAYA CIPAYUNG', '', '', 11, 16, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3660, '', '', 'SHANTI PRIBUMI', '', 'SAMOLO / SADANG CIANJUR', 'SAMOLO / SADANG CIANJUR', '', '', 11, 15, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3661, '', '', 'HELBA', '', 'JL. RAYA SASAK CIHAMPELAS', 'JL. RAYA SASAK CIHAMPELAS', '', '', 1, 13, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3662, '', '', 'GMS', '', 'JL. RAYA SASAK BUBUR', 'JL. RAYA SASAK BUBUR', '', '', 1, 13, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3663, '', '', 'RASA HARUM', '', 'CIHAMPELAS', 'CIHAMPELAS', '', '', 1, 13, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3664, '', '', 'SEGER ASIH', '', 'CILILIN', 'CILILIN', '', '', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3665, '', '', 'SARI LEZAT', '', 'CIBADUYUT', 'CIBADUYUT', '', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3666, '', '', 'KENCANA', '', 'SASAK BUBUR CIHAMPELAS', 'SASAK BUBUR CIHAMPELAS', '', '', 1, 13, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3667, '', '', 'sari lezat, paster', '', 'paster', 'paster', '', '', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3668, '', '', 'TOPS, BUGETING PASTER', '', 'PASTER', 'PASTER', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3669, '', '', 'SARI RAOS 2', '', 'JL. CIHAMPELAS', 'JL. CIHAMPELAS', '', '', 1, 13, 60, '', NULL, 0, 0, 5088000, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3670, '', '', 'TOPS BUGETING LEMBANG', '', 'LEMBANG', 'LEMBANG', '', '', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3671, '', '', 'EKO', '', 'LEWIPANJANG', 'LEWIPANJANG', '', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3672, '', '', 'BAROKAH, PAGADEN', '', 'PASAR/ PLAZA PAGADEN', 'PASAR/ PLAZA PAGADEN', '', '', 7, 19, 64, '', NULL, 0, 0, 1148000, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3673, '', '', 'SRI WANGI, TK', '', 'PLAZA PAGADEN', 'PLAZA PAGADEN', '', '', 7, 18, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3674, '', '', 'MARKONI', '', 'PANTURA', 'PANTURA', '', '', 7, 20, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3675, '', '', 'ALAM SARI SPBU', '', 'SUBANG JL. CAGAG', 'SUBANG JL. CAGAG', 'SUBANG', '', 7, 18, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3676, '', '', 'MUTIARA', '', 'KALI ASIN', 'KALI ASIN', '', '', 7, 19, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3677, '', '', 'TAWAKAL', '', 'KALI ASIN', 'KALI ASIN', '', '', 7, 19, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3678, '', '', 'KIOS TAPE PANTURA', '', 'KALI ASIN', 'KALI ASIN', '', '', 7, 19, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3679, '', '', 'BUMI AYU', '', 'KALI ASIN', 'KALI ASIN', '', '', 7, 19, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3681, '', '', 'TOPS KM 32', '', 'REST AREA KM 32', 'REST AREA KM 32', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3682, '', '', 'TOPS KM 39', '', 'REST AREA KM 39', 'REST AREA KM 39', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3683, '', '', 'SADAR MUKTI', '', 'CIKAMPEK', 'CIKAMPEK', '', '', 7, 20, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3684, '', '', 'DMP BERKAH', '', 'PASTER', 'PASTER', '', '', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3685, '', '', 'MISBAH', '', 'JL. SUKABUMI', 'JL. SUKABUMI', '', '', 11, 17, 64, '', NULL, 0, 0, 299500, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3686, '', '', 'SAYA SUKA, TK', '', 'PASKAL', 'PASKAL', '', '', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3687, '', '', 'Bpk. M. Yusuf', 'Ibu Susi Victory', 'Jln. Sudirman No. 13 Bukit tinggi', 'Jln. Sudirman No. 13 Bukit tinggi', 'padang', '081266939363', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3688, '', '', 'MUNGKY SNACK', '', 'PARONGPONG', 'PARONGPONG', '', '', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3689, '', '', 'AL BAGDHADI 3', '', 'CILAMPRI SUBANG', 'CILAMPRI SUBANG', '', '', 7, 18, 64, '', NULL, 0, 0, 1734000, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3691, '', '', 'PUTRA MUTIARA', '', 'KALI ASIN', 'KALI ASIN', '', '', 7, 20, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3693, '', '', 'AS SIFAH', '', 'KALI ASIN', 'KALI ASIN', '', '', 7, 20, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3697, '', '', 'SINDANG RAJA I', '', 'SUBANG', 'SUBANG', '', '081320685421', 7, 18, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3698, '', '', 'RM HEGAR', '', 'TOL CIPLI KM 102', 'TOL CIPLI KM 102', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3699, '', '', 'OLEH-OLEH BDG & SOUVENIR', '', 'CIPALI KM 102', 'CIPALI KM 102', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3700, '', '', 'SARI MANIS, CIWIDEY', '', 'CIWIDEY', 'CIWIDEY', '', '', 1, 13, 57, '', NULL, 0, 0, 2496000, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3701, '', '', 'JEMBARAYA / BP. MAMAN', 'BP. MAMAN', 'RANCAEKEK NO. 332', 'RANCAEKEK NO. 332', '', '082116163000', 1, 13, 58, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3702, '', '', 'UTAMA RASA', '', 'JL. CIRANJANG', 'JL. CIRANJANG', 'CIANJUR', '', 11, 15, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3703, '', '', 'RIFKY ALAM SYAH', '', 'JL. RAYA OTISTA NO. 38 SUBANG', 'JL. RAYA OTISTA NO. 38 SUBANG', 'SUBANG', '082320248225', 7, 18, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3705, '', '', 'HARUM', '', 'SUBANG', 'SUBANG', '', '08122345231', 7, 18, 64, '', NULL, 0, 0, 2040000, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3706, '', '', 'SAFARI', '', 'PASAR JUM''AT PURWAKARTA', 'PASAR JUM''AT PURWAKARTA', '', '0264200566', 7, 19, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3707, '', '', 'SINAR PASAR', '', 'JL. SUDIRMAN PURWAKARTA', 'JL. SUDIRMAN PURWAKARTA', '', '0264200181', 7, 19, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3708, '', '', 'SHINTA, TK', '', 'JL. CAGAK SUBANG', 'JL. CAGAK SUBANG', '', '085322728380', 7, 18, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3711, '', '', 'TOPS, OLEH-OLEH BDG', '', 'JL. LEMBANG', 'LEMBANG', '', '', 1, 13, 62, '', NULL, 0, 0, 7728000, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3712, '', '', 'SDM', '', 'PASTER', 'PASTER', '', '', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3713, '', '', 'RIDHO ILAHI 2', '', 'CIKAMPEK', 'CIKAMPEK', '', '', 7, 20, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3714, '', '', 'kabita, pasir koja', '', 'jl. pasir koja', 'jl. pasir koja', '', '', 1, 14, 55, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3715, '', '', 'ANEKA RASA NUSANTARA', '', 'REST AREA KM 97', 'REST AREA KM 97', '', '022-88886633', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3718, '', '', 'CITRA RASA PUSAKA', '', 'JL. CIJERAH NO. 101', 'JL. CIJERAH NO. 101', '', '085324732755', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3720, '', '', 'DELTA SWALAWAYAN', 'IBU DIAN', 'JL. TAGOG RAYA CIMAHI', 'JL. TAGOG RAYA CIMAHI', '', '0226652464', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3722, '', '', 'ZAHRA, TK', '', 'CIHANJUANG CIMAHI', 'CIHANJUANG CIMAHI', '', '', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3725, '', '', 'SAWARGI, CIBIRU', '', 'CIBIRU', 'CIBIRU', '', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3726, '', '', 'eva sari', '', 'cibiru', 'cibiru', '', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3727, '', '', 'ERI SNACK', '', 'CIBIRU', 'CIBIRU', '', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 0, 0),
(3729, '', '', 'mustika, ujb', '', 'jl. ujung berung', 'jl. ujung berung', '', '082130193970', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3730, '', '', 'KUE FAMILY JAYA', '', 'CIKAMPEK', 'CIKAMPEK', '', '', 7, 20, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3731, '', '', 'BAMKAH, TK', '', 'PAGADEN PASAR PLAZA', 'PAGADEN PASAR PLAZA', '', '', 7, 20, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3732, '', '', 'MENANTI, TK', '', 'SUBANG', 'SUBANG', '', '', 7, 18, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3734, '', '', 'JAYA SAMUDRA', '', 'CARINGIN SUKABUMI', 'CARINGIN SUKABUMI', '', '', 11, 17, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3735, '', '', 'TOPS KM 62 JRM', 'KUSNADI', 'REST AREA KM 62', 'REST AREA KM 62', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3736, '', '', 'SMD BERKAH', '', 'PASTER', 'PASTER', '', '', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3737, '', '', 'RIO SNACK', '', 'CIPAYUNG', 'CIPAYUNG', '', '', 11, 16, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3738, '', '', 'TIGA RASA', '', 'LEWIPANJANG', 'LEWIPANJANG', '', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3740, '', '', 'TOPS 125 B', '', 'REST AREA 125', 'REST AREA 125', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3741, '', '', 'HARAPAN II', '', 'SUBANG', 'SUBANG', 'SUBANG', '', 7, 18, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3743, '', '', 'BP. YUSUF', '', 'JL. SUDIRMAN NO. 13 BUKIT TINGGI', 'JL. SUDIRMAN NO. 13 BUKIT TINGGI', '', '', 11, NULL, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3744, '', '', 'TOPS 72 B', '', 'KM 72 B', 'KM 72 B', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3746, '', '', 'DAILLY SNACK', '', 'LEMBANG', 'LEMBANG', '', '', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3747, '', '', 'GILANG', '', 'DEWI SARTIKA 100', 'DEWI SARTIKA 100', '', '', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3748, '', '', 'LANGGENG', '', 'PASAR CIBOGO SARI JADI', 'PASAR CIBOGO SARI JADI', '', '', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3751, '', '', 'sari mukti', '', 'soekarno hatta', 'soekarno hatta', '', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3752, '', '', 'jempol sari', '', 'soekarno hatta', 'soekarno hatta', '', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3754, '', '', 'NAURA', '', 'PANTURA SUBANG', 'PANTURA SUBANG', '', '', 7, 18, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3755, '', '', 'NAILA PUTRI', '', 'PANTURA SUBANG', 'PANTURA SUBANG', '', '', 7, 18, 64, '', NULL, 0, 0, 340000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3756, '', '', 'MAJENG', '', 'PASAR SARI JADI', 'PASAR SARI JADI', '', '', 1, 13, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3757, '', '', 'BAKAT JAYA', '', 'SUKABUMI', 'SUKABUMI', '', '', 11, 17, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3758, '', '', 'KALIMANTAN, TK', '', 'JL. CIANJUR', 'JL. CIANJUR', '', '', 11, 15, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3759, '', '', 'PANJI, WISATA MATAHARI', '', 'CIPAYUNG', 'CIPAYUNG', '', '', 11, 16, 64, '', NULL, 0, 0, 540000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3760, '', '', 'KMP PUNCAK', '', 'BOGOR', 'BOGOR', '', '', 11, 16, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3761, '', '', 'MAREM', '', 'KOSAMBI', 'KOSAMBI', '', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3763, '', '', 'HEGAR', '', 'KM. 102 CIPALI', 'KM. 102 CIPALI', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3764, '', '', 'ROIHAN SNACK', '', 'KM 88', 'KM 88', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3765, '', '', 'SARI RAOS 4', '', 'JL. LEMBANG', 'JL. LEMBANG', '', '', 1, 13, 62, '', NULL, 0, 0, 336000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3766, '', '', 'raniah', '', 'antapani, jl. purwakarta', 'antapani, jl. purwakarta', '', '', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3767, '', '', 'SITI RASA', '', 'JL. UJUNG BERUNG', 'JL. UJUNG BERUNG', '', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3768, '', '', 'GASELA, LW', '', 'LEUWIPANJANG', 'LEUWIPANJANG', '', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3769, '', '', 'SNACK JAWA', '', 'CIHAMPELAS 126 A', 'CIHAMPELAS 126 A', '', '', 1, 13, 60, '', NULL, 0, 0, 4242000, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3770, '', '', 'ARARY SNACK', '', 'REST AREA KM 125', 'REST AREA KM 125', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3771, '', '', 'WIDYA RASA', '', 'BATU JAJAR', 'BATU JAJAR', '', '', 1, 13, 60, '', NULL, 0, 0, 168000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3772, '', '', 'MILTY', '', 'JL. PUNCAK WISATA MATAHARI', 'JL. PUNCAK WISATA MATAHARI', '', '', 11, 16, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3773, '', '', 'ADRAH 42 SNACK', '', 'REST AREA KM 42', 'REST AREA KM 42', '', '', 13, 21, 64, '', NULL, 0, 0, 1872000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3774, '', '', 'CITRA RASA, TK', '', 'JL. IPIK GANDA MANAH PURWAKARTA', 'JL. IPIK GANDA MANAH PURWAKARTA', '', '', 7, 19, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3776, '', '', 'KATINEUNG', '', 'JL. CIPARAY', 'JL. CIPARAY', '', '', 1, 13, 58, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3777, '', '', 'DUTA RASA', '', 'JL. PASTEUR', 'JL. PASTEUR', '', '', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3778, '', '', 'ANEKA RASA', '', 'CIMAHI', 'CIMAHI', '', '', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3779, '', '', 'TK. BANJARAN', '', 'JL. RAYA PANGALENGAN 489', 'JL. RAYA PANGALENGAN 489', '', '', 1, 13, 58, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3780, '', '', 'OLEH-OLEH DODOL PICNIC / BP. SUYUD', '', 'BANDARA HUSEN', 'BANDARA HUSEN', '', '', 1, 13, 60, '', NULL, 0, 0, 255000, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3781, '', '', 'SARI PAKUAN', '', 'BARANANG SIANG BOGOR', 'BARANANG SIANG BOGOR', '', '', 11, 16, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3782, '', '', 'MAKARONI', '', 'PANTURA', 'PANTURA', '', '', 7, 20, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3783, '', '', 'FITRA RASA ABADI', '', 'JL. INGGIT GANDA PURWAKARTA', 'JL. INGGIT GANDA PURWAKARTA', '', '', 7, 19, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3786, '', '', 'NUSA SARI', '', 'CIAWI BOGOR', 'CIAWI BOGOR', '', '', 11, 16, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3787, '', '', 'OLEH-OLEH LESTARI', '', 'REST AREA KM72', 'REST AREA KM', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3788, '', '', 'TREND OLEH-OLEH', '', 'REST AREA KM 32', 'REST AREA KM 32', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3789, '', '', 'DMS', '', 'MAJALAYA', 'MAJALAYA', '', '', 1, 13, 58, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3790, '', '', 'RAINA', '', 'ANTAPANI', 'ANTAPANI', '', '', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3791, '', '', 'ANY SNACK SENTRAL', '', 'REST AREA KM 62', 'REST AREA KM 62', '', '', 13, 21, 64, '', NULL, 0, 0, 9105000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3792, '', '', 'PUTRA SALUYU 2', '', 'BARANANGSIANG BOGOR', 'BARANANGSIANG BOGOR', '', '', 11, 16, 64, '', NULL, 0, 0, 2310000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3794, '', '', 'BP. JAJANG', '', 'PANGALENGAN', 'PANGALENGAN', '', '', 1, 13, 58, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3795, '', '', 'TRI WANDI', '', 'JL. MELONG NO. 28 CIJERAH', 'JL. MELONG NO. 28 CIJERAH', '', '', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3796, '', '', 'LAPIS UCIL', '', 'BUAH BATU', 'BUAH BATU', '', '', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3797, '', '', 'H. ADE', '', 'PASAR CIWASTRA', 'PASAR CIWASTRA', '', '', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3799, '', '', 'PANTI SNACK', '', 'CIPAYUNG MATAHARI', 'CIPAYUNG MATAHARI', '', '', 11, 16, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3800, '', '', 'MUNGIL, TK', '', 'PASAR SUKA SARI', 'PASAR SUKA SARI', '', '', 11, 16, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3801, '', '', 'IBU IMAS', '', 'BUAH BATU', 'BUAH BATU', '', '', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3802, '', '', 'DUSUN BAMBU', '', 'LEMBANG', 'LEMBANG', '', '', 1, 13, 62, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3803, '', '', 'TRI ABADI', '', 'PURWAKARTA', 'PURWAKARTA', '', '', 7, 19, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3805, '', '', 'PANTURA', '', 'PANTURA KALI ASIN', 'PANTURA KALI ASIN', '', '', 7, 19, 64, '', NULL, 0, 0, 1265000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3806, '', '', 'KANG MUS', '', 'PASTER', 'PASTER', '', '', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3807, '', '', 'PURNAMA, CIWIDEY', '', 'CIWIDEY', 'CIWIDEY', '', '', 1, 13, 57, '', NULL, 0, 0, 1477000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3808, '', '', 'BANANA, TK', '', 'CIKAMPEK', 'CIKAMPEK', '', '', 7, 20, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3809, '', '', 'SURYA SARI', '', 'BOGOR', 'BOGOR', '', '', 11, 16, 64, '', NULL, 0, 0, 3550000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3810, '', '', 'IBU IMAS', '', 'CIWASTRA', 'CIWASTRA', '', '', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3811, '', '', 'MAMAH YULI', '', 'SUBANG', 'SUBANG', '', '', 7, 18, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3812, '', '', 'AL BAGDADY 1', '', 'CIKOPO / PURWAKARTA', 'CIKOPO / PURWAKARTA', '', '', 7, 19, 64, '', NULL, 0, 0, 210000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3814, '', '', 'ANISA', '', 'BOGOR', 'BOGOR', '', '', 11, 16, 64, '', NULL, 0, 0, 1620500, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3815, '', '', 'SOPHIA', '', 'LEMBANG', 'LEMBANG', '', '', 1, 13, 62, '', NULL, 0, 0, 582000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3817, '', '', 'HOTEL PUSPASARI', 'SHEILLA', 'CIATER', 'CIATER', '', '081321766122', 7, 18, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3818, '', '', 'LUTHFIA, TK', 'IBU. PURI', 'JL. CIHAMPELAS NO. 55 A', 'JL. CIHAMPELAS NO. 55 A', '', '082115104239', 1, 13, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3819, '', '', 'MAKMUR RASA', '', 'JL. RAYA SUBANG CIKOLE', 'JL. RAYA SUBANG CIKOLE', '', '081320527991', 7, 18, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3820, '', '', 'WALINI', '', 'CIWIDEY', 'CIWIDEY', '', '', 1, 13, 57, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3821, '', '', 'SIMPANG RAYA', '', 'BARANANG SIANG', 'BARANANG SIANG', '', '', 11, 16, 64, '', NULL, 0, 0, 734000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3822, '', '', 'WENDY 125', '', 'KM 125 REST AREA', 'KM 125 REST AREA', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3823, '', '', 'IBU YUNITA', '', 'KOSAMBI', 'KOSAMBI', '', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3826, '', '', 'KEPO SNACK NUSANTARA', '', 'REST AREA KM 62', 'REST AREA KM 62', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3827, '', '', 'SINDANG RAYA', '', 'BARANANG SIANG BOGOR', 'BARANANG SIANG BOGOR', '', '', 11, 16, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3829, '', '', 'TK. N.N', '', 'CIANJUR', 'CIANJUR', '', '', 11, 15, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3830, '', '', 'ADRAH SNACK', '', 'REST AREA KM 62', 'REST AREA KM 62', '', '', 13, 21, 64, '', NULL, 0, 0, 3000000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3831, '', '', 'MUSTIKA, TK', '', 'CIANJUR', 'CIANJUR', '', '', 11, 15, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3832, '', '', 'TK. OCEP SNACK', '', 'JL. BANTENG', 'JL. BANTENG', '', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3834, '', '', 'SAWARGI 3', '', 'LEWIPANJANG', 'LEWIPANJANG', '', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3835, '', '', 'JAYA BERSAMA', 'BP. BAYU', 'CIBINONG', 'CIBINONG', '', '', 11, 16, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3836, '', '', 'MULTY SNACK', '', 'BAZAR MATAHARI', 'BAZAR MATAHARI', '', '', 11, 16, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3837, '', '', 'LEGIT RASA', '', 'BUAH BATU', 'BUAH BATU', '', '', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3839, '', '', 'pak odoy', '', 'kali asin', 'kali asin', '', '', 7, 20, 64, '', NULL, 0, 0, 850000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3840, '', '', 'SANTIKA', '', 'MAYALAYA', 'MAYALAYA', '', '', 1, 13, 58, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3843, '', '', 'KATAJI', 'RIKI', 'DEPOK', 'DEPOK', '', '08988885807', 11, 16, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3845, '', '', 'PUSPA RASA', '', 'CIWASTRA', 'CIWASTRA', '', '', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3846, '', '', 'SADULUR, TK', '', 'UJUNG BERUNG', 'UJUNG BERUNG', '', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3847, '', '', 'H. MARZUKI', '', 'JL. RAYA PUNCAK GADOG', 'JL. RAYA PUNCAK GADOG', '', '', 11, 16, 64, '', NULL, 0, 0, 790000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3848, '', '', 'R & D', '', 'SUKABUMI', 'SUKABUMI', '', '', 11, 17, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3849, '', '', 'TEH NIA', '', 'TAMAN SAFARI ATAS', 'TAMAN SAFARI ATAS', '', '', 11, 16, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3850, '', '', 'EGI SNACK', '', 'KMP. CIPAYUNG', 'KMP. CIPAYUNG', '', '', 11, 16, 64, '', NULL, 0, 0, 415000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3851, '', '', 'KAPE SNACK', '', 'REST AREA KM 62', 'REST AREA KM 62', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3852, '', '', 'H. MUSLIM', '', 'BUAH BATU', 'BUAH BATU', '', '', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3854, '', '', 'RIFKY RASA 1', '', 'PAMANUKAN', 'PAMANUKAN', '', '', 7, 18, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3855, '', '', 'SYAKINA', '', 'CIKAMPEK', 'CIKAMPEK', '', '', 7, 20, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3857, '', '', 'KIOS TAPE 2011', '', 'CIKAMPEK', 'CIKAMPEK', '', '', 7, 20, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3858, '', '', 'KIOS PO ROSALIA', '', 'CIKAMPEK', 'CIKAMPEK', '', '082111763170', 7, 20, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3859, '', '', 'FAMILY JAYA', '', 'JL. H. JUANDA CIKAMPEK', 'JL. H. JUANDA CIKAMPEK', '', '', 7, 20, 64, '', NULL, 0, 0, 1200000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3860, '', '', 'TAMAN SARI', '', 'CIPALI', 'CIPALI', '', '', 7, 19, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3861, '', '', 'PERTIWI', '', 'JOMIN', 'JOMIN', '', '', 7, 20, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3862, '', '', 'H. M. SITEPU', '', 'SUKABUMI', 'SUKABUMI', '', '', 11, 17, 64, '', NULL, 0, 0, 2912500, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3863, '', '', 'OLEH-OLEH BANDUNG, TK', '', 'PELABUHAN RATU', 'PELABUHAN RATU', '', '', 11, 17, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3864, '', '', 'MOES', '', 'CICADAS', 'CICADAS', '', '', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3865, '', '', 'RM. WIJAYA SAPUTRA', '', 'PANTURA', 'PANTURA', '', '', 7, 18, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3866, '', '', 'PD. ROSALIA', '', 'CIKOPO CIKAMPEK', 'CIKOPO CIKAMPEK', '', '', 7, 20, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3867, '', '', 'TAMAN WISATA MATAHARI / WAHYU', '', 'PUNCAK BOGOR', 'PUNCAK BOGOR', '', '', 11, 16, 64, '', NULL, 0, 0, 1162000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3868, '', '', 'ROTI MUNGIL', '', 'TAJUR', 'TAJUR', '', '', 11, 16, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3869, '', '', 'HM. SITEPU', '', 'SUKABUMI', 'SUKABUMI', '', '', 11, 17, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3870, '', '', 'TK. JAMRUD BAKERY', '', 'BOGOR', 'BOGOR', '', '', 11, 16, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3872, '', '', 'FRIEZA', '', 'JL. VENUS TIMUR VII NO. 11 METRO SOEKARNO HATTA', 'JL. VENUS TIMUR VII NO. 11 METRO SOEKARNO HATTA', '', '081220523901', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3873, '', '', 'YUNITA', '', 'KOSAMBI', 'KOSAMBI', '', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3875, '', '', 'IBU SUNTIA', '', 'PANTURA', 'PANTURA', '', '', 7, 20, 64, '', NULL, 0, 0, 670000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3876, '', '', 'ROSALIA', '', 'CIKOPO PURWAKARTA', 'CIKOPO PURWAKARTA', '', '', 7, 19, 64, '', NULL, 0, 0, 170000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3877, '', '', 'PAK SARWAN', '', 'PANTURA', 'PANTURA', '', '', 7, 18, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3878, '', '', 'LESTARI', '', 'CIPALI', 'CIPALI', '', '', 7, 20, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3879, '', '', 'FIRMAN', '', 'BARANANG SIANG BOGOR', 'BARANANG SIANG BOGOR', '', '', 11, 16, 64, '', NULL, 0, 0, 1360000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3881, '', '', 'SELVIE SNACK', '', 'TAJUR BOGOR', 'TAJUR BOGOR', '', '', 11, 16, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3882, '', '', 'CHIKA', '', 'SIMPANG DAGO', 'SIMPANG DAGO', '', '', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3883, '', '', 'DAY SNACK & TEA', '', 'CIWIDEY', 'CIWIDEY', '', '', 1, 13, 57, '', NULL, 0, 0, 369000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3885, '', '', 'IBU PUPUN', '', 'PANTURA', 'PANTURA', '', '', 7, 20, 64, '', NULL, 0, 0, 300000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3886, '', '', 'HARUM SARI, CHP', '', 'CIHAMPELAS', 'CIHAMPELAS', '', '', 1, 13, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3887, '', '', 'SUMBER REJEKI', '', 'CIANJUR', 'CIANJUR', '', '085283888802', 11, 15, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3888, '', '', 'SARI BAROKAH PUNCAK', '', 'CIPAYUNG PUNCAK', 'CIPAYUNG PUNCAK', '', '', 11, 16, 64, '', NULL, 0, 0, 6301000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3889, '', '', 'DE'' ZENAL', '', 'JL. RAYA SUKABUMI', 'JL. RAYA SUKABUMI', '', '', 11, 17, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3890, '', '', 'SNACK RASA', '', 'PASAR KIRCON', 'PASAR KIRCON', '', '', 1, 14, 53, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3891, '', '', 'BAKUL SNACK', '', 'CIHAMPELAS', 'CIHAMPELAS', '', '', 1, 13, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3892, NULL, 'XX', '2001', NULL, 'JOMIN CIKAMPEK', 'JOMIN CIKAMPEK', NULL, NULL, 7, 18, NULL, NULL, NULL, 0, 0, 779500, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3893, '', '', 'JAMRUD', '', 'BARANANG SIANG', 'BARANANG SIANG', '', '', 11, 16, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3894, '', '', 'SEMPA JAYA', '', 'TERMINAL SUKABUMI', 'TERMINAL SUKABUMI', '', '', 11, 17, 64, '', NULL, 0, 0, 2788000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3896, '', '', 'MAYA SARI CMH', '', 'CIMAHI', 'CIMAHI', '', '', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3899, '', '', 'SARI ALAM 2', '', 'SUBANG', 'SUBANG', '', '', 7, 18, 64, '', NULL, 0, 0, 1714500, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3900, '', '', 'RM. SAMBEL COET', '', 'PANTURA SUBANG', 'PANTURA SUBANG', '', '', 7, 18, 64, '', NULL, 0, 0, 850000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3901, '', '', 'DIAN', '', 'DEWI SARTIKA 100', 'DEWI SARTIKA 100', '', '', 1, 14, 54, '', NULL, 0, 0, 414000, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0);
INSERT INTO `tbl_customer` (`customer_id`, `customer_code`, `customer_group`, `customer_name`, `contact_name`, `address1`, `address2`, `address3`, `phone`, `wilayah_id`, `subwil_id`, `area_id`, `npwp`, `fax`, `discount`, `invoice_max`, `saldo_awal`, `kode_depo`, `due_day`, `curency`, `freight`, `tax`, `ar_acc`, `sales_id`, `credit_max`) VALUES
(3902, '', '', 'D''ZENAL', '', 'CIANJUR', 'CIANJUR', '', '', 11, 15, 64, '', NULL, 0, 0, 720000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3903, '', '', 'ANY SNACK 72', '', 'REST AREA KM 72', 'REST AREA KM 72', '', '', 13, 21, 64, '', NULL, 0, 0, 1128000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3905, '', '', 'PRIMA SARI', '', 'BOGOR', 'BOGOR', '', '', 11, 16, 64, '', NULL, 0, 0, 936000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3906, '', '', 'RA''AR SNACK', '', 'REST AREA KM 42', 'REST AREA KM 42', '', '', 13, 21, 64, '', NULL, 0, 0, 1176000, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3907, '', '', 'KURNIA RASA 2', '', 'BALUBUR', 'BALUBUR', '', '', 1, 13, 63, '', NULL, 0, 0, 528000, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3908, '', '', 'TIWAN', '', 'BUBAT', 'BUBAT', '', '', 1, 14, 54, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3909, '', '', 'NUR ILAHI', '', 'CIBIRU', 'CIBIRU', '', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 14, 0),
(3910, '', '', 'TK. SARI MILO', '', 'CIKUTRA', 'CIKUTRA', '', '', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3911, '', '', 'TK. SINDANG SARI', '', 'SUBANG', 'SUBANG', '', '', 7, 18, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3912, '', '', 'SARI INTAN, TK', '', 'KOSAMBI', 'KOSAMBI', '', '', 1, 14, 52, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3914, '', '', 'IBU DEWI, TK', '', 'PASTEUR', 'PASTEUR', '', '', 1, 13, 59, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3915, '', '', 'AZAHRA', '', 'PANTURA', 'PANTURA', '', '082312151513', 7, 20, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3917, '', '', 'DASEF', '', 'CIKALONG', 'CIKALONG', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3918, '', '', 'KIOS 13', '', 'PURWAKARTA', 'PURWAKARTA', '', '085222884102', 7, 19, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3920, '', '', 'PAK HAJI ANDA', '', 'PASAR SEDERHANA', 'PASAR SEDERHANA', '', '', 1, 13, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3921, '', '', 'PAK AA ROSMANA', 'IBU AI', 'PASAR SEDERHANA', 'PASAR SEDERHANA', '', '085721568857', 1, 13, 60, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3922, '', '', 'UJENK MART', '', 'JL. DR OTTEN', 'JL. DR OTTEN', '', '', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3923, '', '', 'KUE PIA KAWITAN', '', 'JL. RAYA PANGALENGAN', 'JL. RAYA PANGALENGAN', '', '022-5979777', 1, 13, 58, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3924, '', '', 'HEGAR ( BP. H. AWAN )', '', 'JL. GADING TUTUKA NO. 7', 'JL. GADING TUTUKA NO. 7', '', '081320550812', 1, 13, 57, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3925, '', '', 'REST AREA PASIR JAMBU', 'BU SANDRA', 'JL. RAYA CIWIDEY', 'JL. RAYA CIWIDEY', '', '08989147933', 1, 13, 57, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3926, '', '', 'MAKAILA', '', 'JL. BLOK PESANTREN RT.02 RW. 07', 'JL. BLOK PESANTREN RT.02 RW. 07', '', '082319221865', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3927, '', '', 'MIKAILA', '', 'JL. BLOK PESANTREN RT. 02 RW. 07', 'JL. BLOK PESANTREN RT. 02 RW. 07', '', '082319221865', 1, 13, 61, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3929, '', '', 'BAROKAH, SURAPATI', '', 'JL. SURAPATI', 'JL. SURAPATI', '', '', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 73, 0),
(3930, '', '', 'SAMI JAYA', '', 'CIBUNGUR PURWAKARTA', 'CIBUNGUR PURWAKARTA', '', '', 7, 19, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3932, '', '', 'YAZID, CITRA RASA', '', 'BALUBUR', 'BALUBUR', 'BANDUNG', '', 1, 13, 63, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3934, '', '', 'SAHABAT PUTRA', '', 'LEUWI PANJANG', 'LEUWI PANJANG', 'BANDUNG', '', 1, 14, 56, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 18, 0),
(3935, '', '', 'PRIMA RAOS', '', 'REST AREA KM 88', 'REST AREA KM 88', '', '', 13, 21, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0),
(3936, '', '', 'SINAR BERLIAN', '', 'CIGOMBONG CIAWI', 'CIGOMBONG CIAWI', '', '', 11, 16, 64, '', NULL, 0, 0, 0, '02', 0, 1, 0, '', '1.1.2.1.1', 74, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_salesman`
--

CREATE TABLE `tbl_salesman` (
  `sales_id` int(11) NOT NULL,
  `sales_name` varchar(50) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `subwil_id` int(11) DEFAULT NULL,
  `wilayah_id` int(11) DEFAULT NULL,
  `sales_target` double DEFAULT NULL,
  `sales_intensif` double DEFAULT NULL,
  `kode_depo` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_salesman`
--

INSERT INTO `tbl_salesman` (`sales_id`, `sales_name`, `area_id`, `subwil_id`, `wilayah_id`, `sales_target`, `sales_intensif`, `kode_depo`) VALUES
(14, 'Q.Acc', 11, 1, 1, 0, 0, '01'),
(18, 'AGUS', 54, 14, 1, 0, 0, '02'),
(45, 'LINA', NULL, NULL, NULL, NULL, NULL, '02'),
(71, 'DESI-FITHA', NULL, NULL, NULL, NULL, NULL, '02'),
(72, 'DIRECT SELLING', NULL, NULL, NULL, NULL, NULL, '01'),
(73, 'YAYAN', NULL, NULL, NULL, NULL, NULL, '02'),
(74, 'DIAN', NULL, NULL, NULL, NULL, NULL, '02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_inv_canvas_item`
--

CREATE TABLE `tr_inv_canvas_item` (
  `master_id` int(11) DEFAULT NULL,
  `row_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_code` varchar(10) DEFAULT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `item_price` double DEFAULT NULL,
  `item_disc` double DEFAULT NULL,
  `item_qty` double DEFAULT NULL,
  `udet_id` int(11) DEFAULT NULL,
  `unit_id` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tr_inv_canvas_item`
--

INSERT INTO `tr_inv_canvas_item` (`master_id`, `row_id`, `item_id`, `item_code`, `item_name`, `item_price`, `item_disc`, `item_qty`, `udet_id`, `unit_id`) VALUES
(4, 5, 383, '02120002', NULL, 720000, 0, 1, NULL, NULL),
(5, 6, 325, '02120007', NULL, 372000, 0, 2, 17, NULL),
(6, 7, 505, '05170002', NULL, 170000, 0, 1, 66, NULL),
(6, 8, 352, '03180002', NULL, 0, 0, 1, 29, NULL),
(6, 9, 351, '03180003', NULL, 0, 0, 1, 28, NULL),
(6, 10, 353, '03180001', NULL, 0, 0, 1, 30, NULL),
(6, 11, 355, '03180012', NULL, 0, 0, 1, 31, NULL),
(6, 12, 344, '03180004', NULL, 0, 0, 1, 26, NULL),
(6, 13, 406, '04230003', NULL, 0, 0, 1, 53, NULL),
(6, 14, 405, '04230002', NULL, 0, 0, 1, 52, NULL),
(6, 15, 408, '04230006', NULL, 0, 0, 1, 55, NULL),
(6, 16, 407, '04230005', NULL, 0, 0, 1, 54, NULL),
(6, 17, 421, '04230009', NULL, 0, 0, 1, 59, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_inv_canvas_master`
--

CREATE TABLE `tr_inv_canvas_master` (
  `inv_id` int(11) NOT NULL,
  `inv_number` varchar(15) DEFAULT NULL,
  `inv_date` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `wilayah_id` int(11) DEFAULT NULL,
  `subwil_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `address3` varchar(50) DEFAULT NULL,
  `inv_amt` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `total_discount` double DEFAULT NULL,
  `is_tax` enum('1','0') DEFAULT '0',
  `tax_total` double DEFAULT NULL,
  `inv_total` double DEFAULT NULL,
  `paid_amt` double DEFAULT NULL,
  `tax_type` int(1) DEFAULT NULL,
  `paid` enum('1','0') NOT NULL,
  `tax_number` varchar(15) DEFAULT NULL,
  `tc_number` varchar(15) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `kode_depo` varbinary(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tr_inv_canvas_master`
--

INSERT INTO `tr_inv_canvas_master` (`inv_id`, `inv_number`, `inv_date`, `customer_id`, `wilayah_id`, `subwil_id`, `area_id`, `customer_name`, `address1`, `address2`, `address3`, `inv_amt`, `discount`, `total_discount`, `is_tax`, `tax_total`, `inv_total`, `paid_amt`, `tax_type`, `paid`, `tax_number`, `tc_number`, `user_id`, `lastupdate`, `sales_id`, `due_date`, `kode_depo`) VALUES
(4, 'FC0118000001', '2018-12-12', 3457, NULL, NULL, NULL, NULL, 'JL. BALE ENDAH NO. 100', 'JL. BALE ENDAH NO. 100', NULL, 720000, NULL, 0, '0', NULL, 720000, NULL, NULL, '0', NULL, NULL, 1, '2018-12-12 08:02:22', NULL, '2018-12-12', 0x3031),
(5, 'FC0118000002', '2018-12-13', 3457, NULL, NULL, NULL, NULL, 'JL. BALE ENDAH NO. 100', 'JL. BALE ENDAH NO. 100', NULL, 744000, NULL, 44000, '1', NULL, 770000, NULL, NULL, '0', NULL, NULL, 1, '2018-12-13 02:33:40', NULL, '2018-12-13', 0x3031),
(6, 'FC0219000001', '2019-01-09', 3398, NULL, NULL, NULL, NULL, 'LEUWIPANJANG', 'LEUWIPANJANG', NULL, 170000, NULL, 0, '0', NULL, 170000, NULL, NULL, '0', NULL, NULL, 2, '2019-01-09 15:02:45', NULL, '2019-01-09', 0x3032);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_inv_item`
--

CREATE TABLE `tr_inv_item` (
  `row_id` int(11) NOT NULL,
  `master_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_code` varchar(10) DEFAULT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `item_price` double DEFAULT NULL,
  `item_disc` double DEFAULT NULL,
  `item_qty` double DEFAULT NULL,
  `udet_id` int(11) DEFAULT NULL,
  `unit_id` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tr_inv_item`
--

INSERT INTO `tr_inv_item` (`row_id`, `master_id`, `item_id`, `item_code`, `item_name`, `item_price`, `item_disc`, `item_qty`, `udet_id`, `unit_id`) VALUES
(1, 1, 403, '02120016', NULL, 372000, 2, 1, 50, NULL),
(2, 1, 322, '02120010', NULL, 372000, 2, 1, 14, NULL),
(3, 2, 406, '04230003', NULL, 516000, 0, 15, 53, NULL),
(4, 3, 406, '04230003', NULL, 0, 0, 1, 53, NULL),
(5, 3, 405, '04230002', NULL, 0, 0, 1, 52, NULL),
(6, 3, 408, '04230006', NULL, 0, 0, 1, 55, NULL),
(7, 3, 402, '04230004', NULL, 0, 0, 1, 49, NULL),
(8, 3, 421, '04230009', NULL, 0, 0, 1, 59, NULL),
(9, 3, 468, '05160001', NULL, 12000, 0, 1, 64, NULL),
(10, 3, 478, '05170005', NULL, 17000, 0, 1, 65, NULL),
(11, 3, 505, '05170002', NULL, 170000, 0, 1, 66, NULL),
(12, 3, 352, '03180002', NULL, 0, NULL, 1, 29, NULL),
(13, 3, 351, '03180003', NULL, 0, NULL, 1, 28, NULL),
(14, 3, 403, '02120016', NULL, 372000, NULL, 1, 50, NULL),
(15, 3, 322, '02120010', NULL, 372000, NULL, 1, 14, NULL),
(16, 4, 406, '04230003', NULL, 0, 0, 10, 53, NULL),
(17, 4, 405, '04230002', NULL, 0, 0, 1, 52, NULL),
(18, 4, 408, '04230006', NULL, 0, 0, 1, 55, NULL),
(19, 4, 352, '03180002', NULL, 0, 0, 1, 29, NULL),
(20, 4, 351, '03180003', NULL, 0, 0, 1, 28, NULL),
(21, 4, 353, '03180001', NULL, 0, 0, 1, 30, NULL),
(22, 4, 355, '03180012', NULL, 0, 0, 10, 31, NULL),
(23, 4, 505, '05170002', NULL, 170000, 0, 10, 66, NULL),
(24, 4, 383, '02120002', NULL, 720000, 0, 1, 38, NULL),
(25, 4, 506, '00000001', NULL, NULL, 0, 10, 67, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_inv_master`
--

CREATE TABLE `tr_inv_master` (
  `inv_id` int(11) NOT NULL,
  `inv_number` varchar(15) DEFAULT NULL,
  `inv_date` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `wilayah_id` int(11) DEFAULT NULL,
  `subwil_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `address3` varchar(50) DEFAULT NULL,
  `inv_amt` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `total_discount` double DEFAULT NULL,
  `is_tax` enum('1','0') DEFAULT '0',
  `tax_total` double DEFAULT NULL,
  `inv_total` double DEFAULT NULL,
  `paid_amt` double DEFAULT NULL,
  `tax_type` int(1) DEFAULT NULL,
  `paid` enum('1','0') DEFAULT '0',
  `tax_number` varchar(15) DEFAULT NULL,
  `tc_number` varchar(15) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  `koreksi` double DEFAULT NULL,
  `tanggal_koreksi` date DEFAULT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `sopir` varchar(25) DEFAULT NULL,
  `no_mobil` varchar(15) DEFAULT NULL,
  `kode_depo` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tr_inv_master`
--

INSERT INTO `tr_inv_master` (`inv_id`, `inv_number`, `inv_date`, `customer_id`, `wilayah_id`, `subwil_id`, `area_id`, `customer_name`, `address1`, `address2`, `address3`, `inv_amt`, `discount`, `total_discount`, `is_tax`, `tax_total`, `inv_total`, `paid_amt`, `tax_type`, `paid`, `tax_number`, `tc_number`, `user_id`, `lastupdate`, `koreksi`, `tanggal_koreksi`, `sales_id`, `due_date`, `sopir`, `no_mobil`, `kode_depo`) VALUES
(1, 'FD0118000001', '2018-12-12', 2569, NULL, NULL, NULL, 'Halimah, Pasteur', 'Jl. Dr. Junjunan No. 57', 'Jl. Dr. Junjunan No. 57', 'Bandung', 729120, NULL, 0, '1', NULL, 802032, NULL, 2, '0', NULL, NULL, NULL, '2018-12-12 01:36:58', NULL, NULL, 18, '2018-12-12', NULL, NULL, '01'),
(2, 'FD0218000001', '2018-12-25', 3266, NULL, NULL, NULL, 'BAHAGIA MINI MARKET', 'JL. H. JUANDA NO. 198', 'DAGO', 'BANDUNG', 7740000, NULL, 0, '0', NULL, 7740000, NULL, 2, '0', NULL, NULL, 2, '2018-12-25 22:48:28', NULL, NULL, 73, '2018-12-25', NULL, NULL, '02'),
(3, 'FD0219000001', '2019-01-09', 3830, NULL, NULL, NULL, 'ADRAH SNACK', 'REST AREA KM 62', 'REST AREA KM 62', NULL, 199000, NULL, 0, '0', NULL, 199000, NULL, 2, '0', NULL, NULL, 2, '2019-01-09 14:53:52', NULL, NULL, 74, '2019-01-09', NULL, NULL, '02'),
(4, 'FD0219000002', '2019-01-15', 3266, NULL, NULL, NULL, 'BAHAGIA MINI MARKET', 'JL. H. JUANDA NO. 198', 'DAGO', 'BANDUNG', 2420000, NULL, 0, '0', NULL, 2420000, NULL, 2, '0', NULL, NULL, 2, '2019-01-15 05:40:00', NULL, NULL, 73, '2019-01-15', NULL, NULL, '02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_km_item_ar`
--

CREATE TABLE `tr_km_item_ar` (
  `row_id` int(11) NOT NULL,
  `master_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `inv_number` varchar(15) DEFAULT NULL,
  `inv_date` date DEFAULT NULL,
  `inv_amt` double DEFAULT '0',
  `paid_amt` double DEFAULT '0',
  `acc_no` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tr_km_item_ar`
--

INSERT INTO `tr_km_item_ar` (`row_id`, `master_id`, `customer_id`, `inv_number`, `inv_date`, `inv_amt`, `paid_amt`, `acc_no`) VALUES
(1, 1, NULL, 'FD0118000001', NULL, 0, 0, NULL),
(3, 3, NULL, 'FD0118000001', '2018-12-12', 802032, 802032, NULL),
(4, 4, 3383, NULL, NULL, 90000, 9000000, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_km_item_ar2`
--

CREATE TABLE `tr_km_item_ar2` (
  `row_id` int(11) NOT NULL,
  `master_id` int(11) DEFAULT NULL,
  `inv_number` varchar(15) DEFAULT NULL,
  `inv_date` date DEFAULT NULL,
  `inv_amt` double DEFAULT '0',
  `paid_amt` double DEFAULT '0',
  `acc_no` varchar(15) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tr_km_item_ar2`
--

INSERT INTO `tr_km_item_ar2` (`row_id`, `master_id`, `inv_number`, `inv_date`, `inv_amt`, `paid_amt`, `acc_no`, `customer_id`) VALUES
(1, 1, 'FD0118000001', NULL, 0, 0, NULL, NULL),
(3, 3, 'FD0118000001', '2018-12-12', 802032, 802032, NULL, NULL),
(4, 4, 'FC0219000001', '2019-01-09', 170000, 170000, NULL, 3266),
(5, 5, 'FC0219000001', '2019-01-09', 170000, 170000, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_km_master_ar`
--

CREATE TABLE `tr_km_master_ar` (
  `row_id` int(11) NOT NULL,
  `km_nomor` varchar(12) DEFAULT NULL,
  `km_tanggal` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `km_type` enum('1','2') DEFAULT '1' COMMENT '1:Pelunasan, 2.UangMuka',
  `km_acc` varchar(16) DEFAULT NULL,
  `cek_no` varchar(50) DEFAULT NULL,
  `Posted` bit(1) NOT NULL DEFAULT b'0',
  `tgl_jt` date DEFAULT NULL,
  `cek_amt` double DEFAULT NULL,
  `ret_number1` varchar(15) DEFAULT NULL,
  `ret_date1` date DEFAULT NULL,
  `retur_amt1` double DEFAULT NULL,
  `ret_number2` varchar(15) DEFAULT NULL,
  `ret_date2` date DEFAULT NULL,
  `retur_amt2` double DEFAULT NULL,
  `ret_number3` varchar(15) DEFAULT NULL,
  `ret_date3` date DEFAULT NULL,
  `retur_amt3` double DEFAULT NULL,
  `tunai_amt` double DEFAULT NULL,
  `dp_amt` double DEFAULT NULL,
  `km_amt` double DEFAULT NULL,
  `km_notes` varchar(100) DEFAULT NULL,
  `kode_depo` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tr_km_master_ar`
--

INSERT INTO `tr_km_master_ar` (`row_id`, `km_nomor`, `km_tanggal`, `customer_id`, `customer_name`, `km_type`, `km_acc`, `cek_no`, `Posted`, `tgl_jt`, `cek_amt`, `ret_number1`, `ret_date1`, `retur_amt1`, `ret_number2`, `ret_date2`, `retur_amt2`, `ret_number3`, `ret_date3`, `retur_amt3`, `tunai_amt`, `dp_amt`, `km_amt`, `km_notes`, `kode_depo`) VALUES
(1, NULL, NULL, 3457, NULL, NULL, NULL, NULL, b'0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'KR0118000001', '2018-12-25', 1545, NULL, '1', NULL, NULL, b'0', NULL, NULL, 'RP0118000001', '2018-12-25', 744003, NULL, NULL, NULL, NULL, NULL, NULL, 58029, NULL, 802032, NULL, '01'),
(4, 'KR0219000001', '2019-01-24', 3383, NULL, '1', NULL, NULL, b'0', NULL, NULL, NULL, NULL, 9000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9000000, 18000000, NULL, '02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_km_master_ar2`
--

CREATE TABLE `tr_km_master_ar2` (
  `row_id` int(11) NOT NULL,
  `km_nomor` varchar(12) DEFAULT NULL,
  `km_tanggal` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `km_type` enum('1','2') DEFAULT '1' COMMENT '1:Pelunasan, 2.UangMuka',
  `km_acc` varchar(16) DEFAULT NULL,
  `cek_no` varchar(50) DEFAULT NULL,
  `Posted` bit(1) NOT NULL DEFAULT b'0',
  `tgl_jt` date DEFAULT NULL,
  `cek_amt` double DEFAULT NULL,
  `ret_number1` varchar(15) DEFAULT NULL,
  `ret_date1` date DEFAULT NULL,
  `retur_amt1` double DEFAULT NULL,
  `ret_number2` varchar(15) DEFAULT NULL,
  `ret_date2` date DEFAULT NULL,
  `retur_amt2` double DEFAULT NULL,
  `ret_number3` varchar(15) DEFAULT NULL,
  `ret_date3` date DEFAULT NULL,
  `retur_amt3` double DEFAULT NULL,
  `tunai_amt` double DEFAULT NULL,
  `dp_amt` double DEFAULT NULL,
  `km_amt` double DEFAULT NULL,
  `km_notes` varchar(100) DEFAULT NULL,
  `kode_depo` varchar(3) DEFAULT NULL,
  `sales_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tr_km_master_ar2`
--

INSERT INTO `tr_km_master_ar2` (`row_id`, `km_nomor`, `km_tanggal`, `customer_id`, `customer_name`, `km_type`, `km_acc`, `cek_no`, `Posted`, `tgl_jt`, `cek_amt`, `ret_number1`, `ret_date1`, `retur_amt1`, `ret_number2`, `ret_date2`, `retur_amt2`, `ret_number3`, `ret_date3`, `retur_amt3`, `tunai_amt`, `dp_amt`, `km_amt`, `km_notes`, `kode_depo`, `sales_id`) VALUES
(1, NULL, NULL, 3457, NULL, NULL, NULL, NULL, b'0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'KR0118000001', '2018-12-25', 1545, NULL, '1', NULL, NULL, b'0', NULL, NULL, 'RP0118000001', '2018-12-25', 744003, NULL, NULL, NULL, NULL, NULL, NULL, 58029, NULL, 802032, NULL, '01', NULL),
(4, NULL, '2019-01-15', 3266, NULL, '1', NULL, NULL, b'0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'KR0219000001', '2019-01-16', 3398, NULL, NULL, NULL, NULL, b'0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 170000, NULL, 170000, NULL, '02', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_pb_item`
--

CREATE TABLE `tr_pb_item` (
  `row_id` int(11) NOT NULL,
  `master_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_code` varchar(10) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `udet_id` int(11) DEFAULT NULL,
  `unit_id` varchar(6) DEFAULT NULL,
  `item_qty` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tr_pb_item`
--

INSERT INTO `tr_pb_item` (`row_id`, `master_id`, `item_id`, `item_code`, `item_name`, `udet_id`, `unit_id`, `item_qty`) VALUES
(11, 5, 403, '02120016', NULL, 50, NULL, 10),
(12, 6, 403, '02120016', NULL, 50, NULL, 10),
(13, 7, 398, '02120012', NULL, 47, NULL, 5),
(14, 8, 403, '02120016', NULL, 50, NULL, 10),
(15, 8, 322, '02120010', NULL, 14, NULL, 20),
(16, 8, 324, '02120017', NULL, 16, NULL, 5),
(17, 8, 327, '02120014', NULL, 19, NULL, 7),
(18, 9, 403, '02120016', NULL, 50, NULL, 1),
(19, 9, 322, '02120010', NULL, 14, NULL, 1),
(20, 10, 323, '02120013', NULL, 15, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_pb_master`
--

CREATE TABLE `tr_pb_master` (
  `pb_id` int(11) NOT NULL,
  `kode_depo` varchar(3) DEFAULT NULL,
  `pb_number` varchar(15) DEFAULT NULL,
  `pb_date` date DEFAULT NULL,
  `pb_notes` tinytext,
  `lastupdate` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tr_pb_master`
--

INSERT INTO `tr_pb_master` (`pb_id`, `kode_depo`, `pb_number`, `pb_date`, `pb_notes`, `lastupdate`, `user_id`) VALUES
(5, '01', 'PB0118000001', '2018-12-12', 'Test - 01', '2018-12-12 01:18:27', NULL),
(6, '01', 'PB0118000002', '2018-12-12', 'Test - 01', '2018-12-12 01:19:46', NULL),
(7, '01', 'PB0118000003', '2018-12-12', 'Test - 03', '2018-12-12 01:24:50', NULL),
(8, '01', 'PB0118000004', '2018-12-25', NULL, '2018-12-25 05:37:44', 1),
(9, '02', 'PB0218000001', '2018-12-25', 'Test Counter', '2018-12-25 06:17:23', 2),
(10, '02', 'PB0218000002', '2018-12-25', NULL, '2018-12-25 06:17:36', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_retc_item`
--

CREATE TABLE `tr_retc_item` (
  `row_id` int(11) NOT NULL,
  `master_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_code` varchar(10) DEFAULT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `udet_id` int(11) DEFAULT NULL,
  `unit_id` varchar(6) DEFAULT NULL,
  `item_qty` double DEFAULT NULL,
  `is_bs` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tr_retc_item`
--

INSERT INTO `tr_retc_item` (`row_id`, `master_id`, `item_id`, `item_code`, `item_name`, `udet_id`, `unit_id`, `item_qty`, `is_bs`) VALUES
(1, 1, 403, '02120016', NULL, 50, NULL, 1, 'N'),
(2, 2, 401, '02120015', NULL, 48, NULL, 60000, 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_retc_master`
--

CREATE TABLE `tr_retc_master` (
  `retc_id` int(11) NOT NULL,
  `retc_number` varchar(15) DEFAULT NULL,
  `retc_date` date DEFAULT NULL,
  `sjc_number` varchar(15) DEFAULT NULL,
  `kode_depo` varchar(3) DEFAULT NULL,
  `retc_notes` tinytext,
  `sales_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tr_retc_master`
--

INSERT INTO `tr_retc_master` (`retc_id`, `retc_number`, `retc_date`, `sjc_number`, `kode_depo`, `retc_notes`, `sales_id`, `user_id`, `lastupdate`) VALUES
(1, 'RO0118000001', '2018-12-12', 'FD0118000002', '01', 'Test ke 1', 71, NULL, '2018-12-12 01:51:21'),
(2, 'RO0219000001', '2019-01-24', 'SJ0219000001', '02', '02', 18, 2, '2019-01-24 06:58:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_retp_item`
--

CREATE TABLE `tr_retp_item` (
  `row_id` int(11) NOT NULL,
  `master_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_code` varchar(10) DEFAULT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `udet_id` int(11) DEFAULT NULL,
  `unit_id` varchar(6) DEFAULT NULL,
  `item_qty` double DEFAULT NULL,
  `is_bs` enum('Y','N') NOT NULL,
  `is_rcv` bit(1) NOT NULL DEFAULT b'0',
  `rcv_qty` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tr_retp_item`
--

INSERT INTO `tr_retp_item` (`row_id`, `master_id`, `item_id`, `item_code`, `item_name`, `udet_id`, `unit_id`, `item_qty`, `is_bs`, `is_rcv`, `rcv_qty`) VALUES
(1, 1, 403, '02120016', NULL, 50, NULL, 1, 'Y', b'0', NULL),
(2, 1, 322, '02120010', NULL, 14, NULL, 2, 'N', b'0', NULL),
(3, 2, 403, '02120016', NULL, 50, NULL, 1, 'Y', b'0', NULL),
(4, 2, 322, '02120010', NULL, 14, NULL, 1, 'Y', b'0', NULL),
(5, 3, 325, '02120007', NULL, 17, NULL, 1000, 'N', b'0', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_retp_master`
--

CREATE TABLE `tr_retp_master` (
  `retp_id` int(11) NOT NULL,
  `retp_number` varchar(15) DEFAULT NULL,
  `retp_date` date DEFAULT NULL,
  `kode_depo` varchar(3) DEFAULT NULL,
  `retp_notes` tinytext,
  `rcv_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tr_retp_master`
--

INSERT INTO `tr_retp_master` (`retp_id`, `retp_number`, `retp_date`, `kode_depo`, `retp_notes`, `rcv_date`, `user_id`, `lastupdate`) VALUES
(1, 'RU0118000001', '2018-12-10', '01', NULL, NULL, NULL, NULL),
(2, 'RU0118000002', '2018-12-12', '01', NULL, NULL, NULL, '2018-12-12 01:52:09'),
(3, 'RU0219000001', '2019-01-24', '02', 'yeaaah', NULL, 2, '2019-01-24 06:59:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_ret_item`
--

CREATE TABLE `tr_ret_item` (
  `row_id` int(11) NOT NULL,
  `master_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_code` varchar(10) DEFAULT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `unit_id` varchar(6) DEFAULT NULL,
  `udet_id` int(11) DEFAULT NULL,
  `item_price` double DEFAULT NULL,
  `item_qty` double DEFAULT NULL,
  `item_disc` smallint(3) DEFAULT NULL,
  `is_bs` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tr_ret_item`
--

INSERT INTO `tr_ret_item` (`row_id`, `master_id`, `item_id`, `item_code`, `item_name`, `unit_id`, `udet_id`, `item_price`, `item_qty`, `item_disc`, `is_bs`) VALUES
(1, 1, 403, '02120016', NULL, NULL, 50, 372000, 1, 0, 'N'),
(2, 1, 322, '02120010', NULL, NULL, 14, 372000, 1, 0, 'N'),
(3, 2, 390, '05170001', NULL, NULL, 43, 170000, 1, 0, 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_ret_master`
--

CREATE TABLE `tr_ret_master` (
  `ret_id` int(11) NOT NULL,
  `ret_number` varchar(15) DEFAULT NULL,
  `ret_date` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `address3` varchar(50) DEFAULT NULL,
  `ret_amt` double DEFAULT NULL,
  `disc_total` double DEFAULT NULL,
  `ret_total` double DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  `kode_depo` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tr_ret_master`
--

INSERT INTO `tr_ret_master` (`ret_id`, `ret_number`, `ret_date`, `customer_id`, `customer_name`, `address1`, `address2`, `address3`, `ret_amt`, `disc_total`, `ret_total`, `user_id`, `lastupdate`, `kode_depo`) VALUES
(1, 'RP0118000001', '2018-12-25', 1545, NULL, 'Odjo Lali', 'Cihampelas No.131', NULL, 744003, 0, 744003, 1, '2018-12-25 08:31:02', '02'),
(2, 'RP0118000002', '2018-12-25', 1545, NULL, 'Odjo Lali', 'Cihampelas No.131', NULL, 170004, 0, 170004, 1, '2018-12-25 08:31:25', '02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_sjc_item`
--

CREATE TABLE `tr_sjc_item` (
  `row_id` int(11) NOT NULL,
  `master_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_code` varchar(10) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_price` double DEFAULT NULL,
  `item_qty` double DEFAULT NULL,
  `udet_id` int(11) DEFAULT NULL,
  `unit_id` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tr_sjc_item`
--

INSERT INTO `tr_sjc_item` (`row_id`, `master_id`, `item_id`, `item_code`, `item_name`, `item_price`, `item_qty`, `udet_id`, `unit_id`) VALUES
(1, 1, 403, '02120016', NULL, 316800, 5, 50, NULL),
(6, 4, 505, '05170002', NULL, 14500, 1, 66, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_sjc_master`
--

CREATE TABLE `tr_sjc_master` (
  `sjc_id` int(11) NOT NULL,
  `sjc_number` varchar(15) DEFAULT NULL,
  `sjc_date` date DEFAULT NULL,
  `sjc_notes` tinytext,
  `sales_id` int(11) DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `kode_depo` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tr_sjc_master`
--

INSERT INTO `tr_sjc_master` (`sjc_id`, `sjc_number`, `sjc_date`, `sjc_notes`, `sales_id`, `lastupdate`, `user_id`, `kode_depo`) VALUES
(1, 'FD0118000002', '2018-12-12', 'Test ke 1', 71, '2018-12-12 01:50:21', NULL, '01'),
(4, 'SJ0219000001', '2019-01-16', NULL, 18, '2019-01-16 10:46:23', 2, '02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `userlevelpermissions`
--

CREATE TABLE `userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `userlevelpermissions`
--

INSERT INTO `userlevelpermissions` (`userlevelid`, `tablename`, `permission`) VALUES
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}cars', 8),
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}cars2', 8),
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}categories', 8),
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}customers', 0),
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}dji', 8),
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}employees', 0),
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}home.php', 8),
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}models', 0),
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}news.php', 8),
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}order details extended', 0),
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}orderdetails', 0),
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}orders', 0),
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}orders2', 0),
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}products', 8),
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}Sales By Customer', 0),
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}shippers', 0),
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}suppliers', 0),
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}trademarks', 0),
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}userlevelpermissions', 0),
(-2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}userlevels', 0),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}cars', 104),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}cars2', 0),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}categories', 104),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}customers', 0),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}dji', 0),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}employees', 0),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}home.php', 0),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}models', 0),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}news.php', 0),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}order details extended', 0),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}orderdetails', 0),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}orders', 0),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}orders2', 0),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}products', 104),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}Sales By Customer', 0),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}shippers', 0),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}suppliers', 0),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}trademarks', 0),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}userlevelpermissions', 0),
(0, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}userlevels', 0),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}cars', 104),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}cars2', 105),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}categories', 104),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}customers', 104),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}dji', 104),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}employees', 0),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}home.php', 8),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}models', 105),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}news.php', 8),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}order details extended', 104),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}orderdetails', 105),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}orders', 105),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}orders2', 105),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}products', 104),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}Sales By Customer', 8),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}shippers', 104),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}suppliers', 104),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}trademarks', 105),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}userlevelpermissions', 105),
(1, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}userlevels', 105),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}cars', 111),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}cars2', 111),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}categories', 111),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}customers', 111),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}dji', 111),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}employees', 111),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}home.php', 8),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}models', 111),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}news.php', 8),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}order details extended', 111),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}orderdetails', 111),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}orders', 111),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}orders2', 111),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}products', 111),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}Sales By Customer', 8),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}shippers', 111),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}suppliers', 111),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}trademarks', 111),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}userlevelpermissions', 111),
(2, '{DFB61542-7FFC-43AB-88E7-31D7F8D95066}userlevels', 111);

-- --------------------------------------------------------

--
-- Struktur dari tabel `userlevels`
--

CREATE TABLE `userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `userlevels`
--

INSERT INTO `userlevels` (`userlevelid`, `userlevelname`) VALUES
(-2, 'Anonymous'),
(-1, 'Administrator'),
(0, 'Default'),
(1, 'Sales'),
(2, 'Administration'),
(3, 'Manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `kode_depo` (`kode_depo`),
  ADD KEY `Activated` (`Activated`);

--
-- Indexes for table `tbl_armada`
--
ALTER TABLE `tbl_armada`
  ADD PRIMARY KEY (`armada_id`),
  ADD KEY `no_mobil` (`no_mobil`),
  ADD KEY `kode_depo` (`kode_depo`);

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`bank_id`),
  ADD KEY `kode_depo` (`kode_depo`),
  ADD KEY `no_rekening` (`no_rekening`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `customer_code` (`customer_code`),
  ADD KEY `customer_group` (`customer_group`),
  ADD KEY `customer_name` (`customer_name`),
  ADD KEY `wilayah_id` (`wilayah_id`),
  ADD KEY `subwil_id` (`subwil_id`),
  ADD KEY `area_id` (`area_id`),
  ADD KEY `sales_id` (`sales_id`),
  ADD KEY `ar_acc` (`ar_acc`),
  ADD KEY `kode_depo` (`kode_depo`);

--
-- Indexes for table `tbl_salesman`
--
ALTER TABLE `tbl_salesman`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `kode_depo` (`kode_depo`);

--
-- Indexes for table `tr_inv_canvas_item`
--
ALTER TABLE `tr_inv_canvas_item`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `master_id` (`master_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `item_code` (`item_code`);

--
-- Indexes for table `tr_inv_canvas_master`
--
ALTER TABLE `tr_inv_canvas_master`
  ADD PRIMARY KEY (`inv_id`),
  ADD KEY `inv_number` (`inv_number`),
  ADD KEY `inv_date` (`inv_date`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `wilayah_id` (`wilayah_id`),
  ADD KEY `subwil_id` (`subwil_id`),
  ADD KEY `area_id` (`area_id`),
  ADD KEY `tax_number` (`tax_number`),
  ADD KEY `tc_number` (`tc_number`),
  ADD KEY `paid` (`paid`),
  ADD KEY `sales_id` (`sales_id`),
  ADD KEY `due_date` (`due_date`),
  ADD KEY `kode_depo` (`kode_depo`);

--
-- Indexes for table `tr_inv_item`
--
ALTER TABLE `tr_inv_item`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `master_id` (`master_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `item_code` (`item_code`);

--
-- Indexes for table `tr_inv_master`
--
ALTER TABLE `tr_inv_master`
  ADD PRIMARY KEY (`inv_id`),
  ADD KEY `inv_number` (`inv_number`),
  ADD KEY `inv_date` (`inv_date`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `wilayah_id` (`wilayah_id`),
  ADD KEY `subwil_id` (`subwil_id`),
  ADD KEY `area_id` (`area_id`),
  ADD KEY `tax_type` (`tax_type`),
  ADD KEY `tc_number` (`tc_number`),
  ADD KEY `sales_id` (`sales_id`),
  ADD KEY `kode_depo` (`kode_depo`);

--
-- Indexes for table `tr_km_item_ar`
--
ALTER TABLE `tr_km_item_ar`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `master_id` (`master_id`),
  ADD KEY `inv_no` (`inv_number`);

--
-- Indexes for table `tr_km_item_ar2`
--
ALTER TABLE `tr_km_item_ar2`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `master_id` (`master_id`),
  ADD KEY `inv_no` (`inv_number`);

--
-- Indexes for table `tr_km_master_ar`
--
ALTER TABLE `tr_km_master_ar`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `Nomor` (`km_nomor`),
  ADD KEY `Nomor_2` (`km_nomor`),
  ADD KEY `cust_code` (`customer_name`),
  ADD KEY `kas_acc` (`km_acc`),
  ADD KEY `cust_id` (`customer_id`),
  ADD KEY `kode_depo` (`kode_depo`);

--
-- Indexes for table `tr_km_master_ar2`
--
ALTER TABLE `tr_km_master_ar2`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `Nomor` (`km_nomor`),
  ADD KEY `Nomor_2` (`km_nomor`),
  ADD KEY `cust_code` (`customer_name`),
  ADD KEY `kas_acc` (`km_acc`),
  ADD KEY `cust_id` (`customer_id`),
  ADD KEY `kode_depo` (`kode_depo`),
  ADD KEY `sales_id` (`sales_id`);

--
-- Indexes for table `tr_pb_item`
--
ALTER TABLE `tr_pb_item`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `master_id` (`master_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `tr_pb_master`
--
ALTER TABLE `tr_pb_master`
  ADD PRIMARY KEY (`pb_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kode_depo` (`kode_depo`),
  ADD KEY `pb_number` (`pb_number`),
  ADD KEY `pb_date` (`pb_date`);

--
-- Indexes for table `tr_retc_item`
--
ALTER TABLE `tr_retc_item`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `master_id` (`master_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `item_code` (`item_code`);

--
-- Indexes for table `tr_retc_master`
--
ALTER TABLE `tr_retc_master`
  ADD PRIMARY KEY (`retc_id`),
  ADD KEY `kode_depo` (`kode_depo`),
  ADD KEY `retc_number` (`retc_number`),
  ADD KEY `retc_date` (`retc_date`),
  ADD KEY `sales_id` (`sales_id`);

--
-- Indexes for table `tr_retp_item`
--
ALTER TABLE `tr_retp_item`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `master_id` (`master_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `item_code` (`item_code`);

--
-- Indexes for table `tr_retp_master`
--
ALTER TABLE `tr_retp_master`
  ADD PRIMARY KEY (`retp_id`),
  ADD KEY `retp_number` (`retp_number`),
  ADD KEY `retp_date` (`retp_date`),
  ADD KEY `kode_depo` (`kode_depo`),
  ADD KEY `rcv_date` (`rcv_date`);

--
-- Indexes for table `tr_ret_item`
--
ALTER TABLE `tr_ret_item`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `master_id` (`master_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `item_code` (`item_code`);

--
-- Indexes for table `tr_ret_master`
--
ALTER TABLE `tr_ret_master`
  ADD PRIMARY KEY (`ret_id`),
  ADD KEY `ret_number` (`ret_number`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `ret_date` (`ret_date`);

--
-- Indexes for table `tr_sjc_item`
--
ALTER TABLE `tr_sjc_item`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `master_id` (`master_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `item_code` (`item_code`);

--
-- Indexes for table `tr_sjc_master`
--
ALTER TABLE `tr_sjc_master`
  ADD PRIMARY KEY (`sjc_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kode_depo` (`kode_depo`),
  ADD KEY `sjc_number` (`sjc_number`),
  ADD KEY `sjc_date` (`sjc_date`),
  ADD KEY `sales_id` (`sales_id`);

--
-- Indexes for table `userlevelpermissions`
--
ALTER TABLE `userlevelpermissions`
  ADD PRIMARY KEY (`userlevelid`,`tablename`);

--
-- Indexes for table `userlevels`
--
ALTER TABLE `userlevels`
  ADD PRIMARY KEY (`userlevelid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_armada`
--
ALTER TABLE `tbl_armada`
  MODIFY `armada_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3937;
--
-- AUTO_INCREMENT for table `tbl_salesman`
--
ALTER TABLE `tbl_salesman`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `tr_inv_canvas_item`
--
ALTER TABLE `tr_inv_canvas_item`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tr_inv_canvas_master`
--
ALTER TABLE `tr_inv_canvas_master`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tr_inv_item`
--
ALTER TABLE `tr_inv_item`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tr_inv_master`
--
ALTER TABLE `tr_inv_master`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tr_km_item_ar`
--
ALTER TABLE `tr_km_item_ar`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tr_km_item_ar2`
--
ALTER TABLE `tr_km_item_ar2`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tr_km_master_ar`
--
ALTER TABLE `tr_km_master_ar`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tr_km_master_ar2`
--
ALTER TABLE `tr_km_master_ar2`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tr_pb_item`
--
ALTER TABLE `tr_pb_item`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tr_pb_master`
--
ALTER TABLE `tr_pb_master`
  MODIFY `pb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tr_retc_item`
--
ALTER TABLE `tr_retc_item`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tr_retc_master`
--
ALTER TABLE `tr_retc_master`
  MODIFY `retc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tr_retp_item`
--
ALTER TABLE `tr_retp_item`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tr_retp_master`
--
ALTER TABLE `tr_retp_master`
  MODIFY `retp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tr_ret_item`
--
ALTER TABLE `tr_ret_item`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tr_ret_master`
--
ALTER TABLE `tr_ret_master`
  MODIFY `ret_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tr_sjc_item`
--
ALTER TABLE `tr_sjc_item`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tr_sjc_master`
--
ALTER TABLE `tr_sjc_master`
  MODIFY `sjc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
