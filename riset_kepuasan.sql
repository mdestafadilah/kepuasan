-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 23, 2014 at 04:12 
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `riset_kepuasan`
--

-- --------------------------------------------------------

--
-- Table structure for table `aturan`
--

CREATE TABLE IF NOT EXISTS `aturan` (
  `aturan_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `variabel` varchar(10) NOT NULL DEFAULT '' COMMENT 'nama variabel',
  `nilai` float(6,0) NOT NULL DEFAULT '0' COMMENT 'Nilai minimal variabel',
  `nfuzzy` double(4,2) NOT NULL COMMENT 'dibagi 100 dulu',
  PRIMARY KEY (`aturan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `aturan`
--

INSERT INTO `aturan` (`aturan_id`, `variabel`, `nilai`, `nfuzzy`) VALUES
(9, 'kecewa', 40, 0.40),
(10, 'biasa', 65, 0.65),
(11, 'puas', 80, 0.80);

-- --------------------------------------------------------

--
-- Table structure for table `banksoal`
--

CREATE TABLE IF NOT EXISTS `banksoal` (
  `banksoal_id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` varchar(255) NOT NULL,
  `faktor` enum('dirasakan','diharapkan') DEFAULT 'dirasakan' COMMENT 'Berdasarkan teori prasaruman',
  `dimensi_id` mediumint(9) NOT NULL,
  `publish` tinyint(1) NOT NULL,
  PRIMARY KEY (`banksoal_id`),
  KEY `dimensi_id` (`dimensi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `banksoal`
--

INSERT INTO `banksoal` (`banksoal_id`, `pertanyaan`, `faktor`, `dimensi_id`, `publish`) VALUES
(1, 'Karyawan berpenampilan rapi dan professional', 'dirasakan', 1, 1),
(2, 'Karyawan berpenampilan rapi dan professional', 'diharapkan', 1, 1),
(3, 'Peralatan dalam merawat pasien lengkap', 'diharapkan', 2, 1),
(4, 'Peralatan dalam merawat pasien lengkap', 'dirasakan', 2, 1),
(5, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 3, 1),
(6, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'diharapkan', 4, 1),
(7, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'dirasakan', 4, 1),
(8, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'dirasakan', 5, 1),
(9, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'diharapkan', 5, 1),
(10, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'dirasakan', 3, 1),
(11, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 1),
(12, 'Perawat memberikan pelayanan tepat di saat client membetuhkannya', 'dirasakan', 2, 1),
(13, 'Perawat memberikan pelayanan tepat di saat client membetuhkannya', 'dirasakan', 2, 0),
(15, 'Perawat selalu bersedia membantu anda', 'dirasakan', 2, 0),
(16, 'Perawat selalu bersedia membantu anda', 'dirasakan', 2, 0),
(17, 'Perawat secara konsisten bersikap ramah terhadap anda', 'dirasakan', 3, 0),
(18, 'Perawat secara konsisten bersikap ramah terhadap anda', 'dirasakan', 3, 0),
(19, 'Perawat mempunyai pengetahuan yang baik, ketika anda memiliki pertanyaan yang diajukan', 'dirasakan', 3, 0),
(20, 'Perawat mempunyai pengetahuan yang baik, ketika anda memiliki pertanyaan yang diajukan', 'dirasakan', 3, 0),
(21, 'Perusahaan memberikan anda perhatian khusus secara individu', 'dirasakan', 4, 0),
(22, 'Perusahaan meninggalkan kesan yang baik di hati anda', 'dirasakan', 4, 0),
(23, 'Perusahaan meninggalkan kesan yang baik di hati anda', 'dirasakan', 4, 0),
(24, 'Perawat memahami kebutuhan tertentu terhadap client/ pelanggan', 'dirasakan', 4, 0),
(25, 'Perawat memahami kebutuhan tertentu terhadap client/ pelanggan', 'dirasakan', 4, 0),
(26, 'Karyawan berpenampilan rapi dan professional?', 'dirasakan', 9, 0),
(27, 'Perusahaan memberikan anda perhatian khusus secara individu', 'dirasakan', 4, 0),
(28, 'test lagi dan lagi', 'dirasakan', 11, 0),
(29, 'manajer', 'dirasakan', 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('e09d4ab0bb96fa3706ca5cfac8daf8c4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 5.1; rv:24.0) Gecko/20140329 Firefox/24.0 PaleMoon/24.4.2', 1398124150, 'a:2:{s:9:"user_data";s:0:"";s:17:"flash:old:message";s:78:"<div class="alert alert-info alert-login"><p>Logged Out Successfully</p></div>";}');

-- --------------------------------------------------------

--
-- Table structure for table `dimensi`
--

CREATE TABLE IF NOT EXISTS `dimensi` (
  `dimensi_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL COMMENT 'batasan masalah hanya 5, dalam teori ada 10',
  `keterangan` text NOT NULL,
  PRIMARY KEY (`dimensi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `dimensi`
--

INSERT INTO `dimensi` (`dimensi_id`, `nama`, `keterangan`) VALUES
(1, 'kehandalan', 'Dalam Bahasa Inggris ''Reliability'' yaitu kemampuan untuk memberikan pelayanan yang sesuia dengan janji yang ditawarkan/ Reliabilitas yaitu memberikan pelayanan penuh kehangatan, keteguhan dalam menangani pelanggan, melakukan pelayanan dengan baik (Kang dan James, 2004)'),
(2, 'ketanggapan', 'Dalam Bahasa Inggris ''Responbility'' yaitu kemampuan karyawan dalam membantu pelanggan dalam memberikan pelayanan yang sigap dan tanggap/ Tanggapan yaitu menjaga performa pelayanan terhadap pelangggan dan siap membaca respon permintaan pelanggan (Kang dan James, 2004).'),
(3, 'kepastian', 'Jaminan dalam bahasa inggris ''Assurance'' yaitu kemampuan karyawan dalam produk, perhatian, keramah tamahan, dan kepercayaan terhadap perusahaan'),
(4, 'empati', 'dalam bahas nggris ''Empathy'' yaitu perhatian secara individual yang diberikan perusahaan kepada pelanggan, seperti mudah menghubungi perusahaan, mengerti kebutuhan konsumen'),
(5, 'berwujud', 'dalam bahasa inggris ''tangible'' yaitu penampilan fisik, seperti ruangan, karyawan, kenyamana, komunikasi dan penampilan/ Bukti langsung yaitu memanfaatkan peralatan modern, fasilitas visual yang menarik, dan karyawan yang terampil (Kang dan James, 2004).'),
(6, 'komunikasi', 'dalam bahasa ingggris ''communitaciton''/ Komunikasi yaitu menggunakan bahasa yang tepat kepada pelanggan agar mereka merasa diperlakukan secara istimewa dan lebih kepada kebutuhan emosional.'),
(7, 'akses', 'dalam bahasa inggris ''access''/ Akses merupakan kemudahan untuk dihubungi dari persepsi pelanggan, baik telepon, fax, email serta komunikasi lainnya.'),
(8, 'pengertian', 'dalam bahasa inggris ''understanding''/ Pengertian yaitu menunjukkan pengertian kepada pelanggan dan memandang mereka sebagai seorang manusia dan mereka juga merasa diperlakukan secara istimewa.'),
(9, 'komptentsi', 'dalam bahasa inggris ''Competency'' / Empati yaitu memberikan perhatian individu pelanggan, karyawan yang berurusan dengan pelanggan secara peduli, memiliki kepentingan pelanggan dan memahami kebutuhan pelanggan serta nyaman (Kang dan James, 2004).'),
(10, 'kesopanan', 'dalam bahasa inggris ''courtsey'' / Jaminan yaitu karyawan yang menanampakan kepercayan terhadap pelanggan, membuat pelanggan merasa aman terhadap mereka dan karyawan yang sopan (Kang dan James, 2004).'),
(11, 'cobacoba', 'kali aja bisah');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator Utama Sistem (IT Staff)'),
(3, 'konsumen', 'Konsumen Perusahaan'),
(4, 'perawat', 'Perawat Perusahaan'),
(6, 'direktur', 'Direktur Perusahaan'),
(25, 'manajer', 'Administrator Perusahaan'),
(26, 'members', 'Default User Belum ada Hak Akses'),
(27, 'leveladd', 'leveladd');

-- --------------------------------------------------------

--
-- Table structure for table `himpunan`
--

CREATE TABLE IF NOT EXISTS `himpunan` (
  `himpunan_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `kecewa_min` int(10) DEFAULT NULL,
  `kecewa_max` int(10) DEFAULT NULL,
  `biasa_min` int(10) DEFAULT NULL,
  `biasa_max` int(10) DEFAULT NULL,
  `puas_min` int(10) DEFAULT NULL,
  `puas_max` int(10) DEFAULT NULL,
  PRIMARY KEY (`himpunan_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `himpunan`
--

INSERT INTO `himpunan` (`himpunan_id`, `kecewa_min`, `kecewa_max`, `biasa_min`, `biasa_max`, `puas_min`, `puas_max`) VALUES
(1, 0, 40, 40, 65, 65, 80),
(2, 0, 60, 60, 80, 80, 100),
(3, 0, 45, 50, 65, 85, 100);

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE IF NOT EXISTS `jawaban` (
  `jawaban_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `banksoal_id` int(11) DEFAULT NULL,
  `user_id` mediumint(8) unsigned DEFAULT NULL,
  `created` int(10) unsigned DEFAULT NULL,
  `aturan_id` mediumint(8) DEFAULT NULL,
  `dimensi_id` mediumint(9) DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  PRIMARY KEY (`jawaban_id`),
  KEY `banksoal_id` (`banksoal_id`),
  KEY `user_id` (`user_id`),
  KEY `aturan_id` (`aturan_id`),
  KEY `dimensi_id` (`dimensi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`jawaban_id`, `banksoal_id`, `user_id`, `created`, `aturan_id`, `dimensi_id`, `status`) VALUES
(1, 1, 61, 1380608991, 11, 1, '0'),
(2, 2, 61, 1380608994, 10, 1, '0'),
(3, 3, 61, 1380608998, 11, 2, '0'),
(4, 4, 61, 1380609002, 11, 2, '0'),
(5, 5, 61, 1380609006, 10, 3, '0'),
(6, 6, 61, 1380609011, 10, 4, '0'),
(7, 7, 61, 1380609014, 10, 4, '0'),
(8, 8, 61, 1380609020, 10, 5, '0'),
(9, 9, 61, 1380609025, 11, 5, '0'),
(10, 10, 61, 1380609031, 11, 3, '0'),
(11, 1, 66, 1381270453, 10, 1, '0'),
(12, 2, 66, 1381270459, 9, 1, '0'),
(13, 3, 66, 1381270464, 11, 2, '0'),
(14, 4, 66, 1381270468, 10, 2, '0'),
(15, 5, 66, 1381270473, 11, 3, '0'),
(16, 6, 66, 1381270481, 11, 4, '0'),
(17, 7, 66, 1381270487, 10, 4, '0'),
(18, 8, 66, 1381270493, 9, 5, '0'),
(19, 9, 66, 1381270500, 10, 5, '0'),
(20, 10, 66, 1381270504, 9, 3, '0'),
(21, 1, 73, 1381671486, 10, 1, '0'),
(22, 2, 73, 1381671489, 11, 1, '0'),
(23, 3, 73, 1381671491, 10, 2, '0'),
(24, 4, 73, 1381671493, 11, 2, '0'),
(25, 5, 73, 1381671495, 9, 3, '0'),
(26, 6, 73, 1381671499, 10, 4, '0'),
(27, 7, 73, 1381671501, 11, 4, '0'),
(28, 8, 73, 1381671503, 10, 5, '0'),
(29, 9, 73, 1381671507, 11, 5, '0'),
(30, 10, 73, 1381671510, 11, 3, '0'),
(31, 1, 65, 1381745174, 11, 1, '0'),
(32, 2, 65, 1381745178, 11, 1, '0'),
(33, 3, 65, 1381745183, 10, 2, '0'),
(34, 4, 65, 1381745186, 10, 2, '0'),
(35, 5, 65, 1381745196, 9, 3, '0'),
(36, 6, 65, 1381745199, 10, 4, '0'),
(37, 7, 65, 1381745241, 11, 4, '0'),
(38, 8, 65, 1381745247, 11, 5, '0'),
(39, 9, 65, 1381745253, 11, 5, '0'),
(40, 10, 65, 1381745259, 10, 3, '0'),
(41, 1, 62, 1382518072, 11, 1, '1'),
(42, 2, 62, 1382518074, 10, 1, '1'),
(43, 3, 62, 1382518078, 11, 2, '1'),
(44, 4, 62, 1382518081, 10, 2, '1'),
(45, 5, 62, 1382518084, 10, 3, '1'),
(46, 6, 62, 1382518088, 11, 4, '1'),
(47, 7, 62, 1382518090, 10, 4, '1'),
(48, 8, 62, 1382518093, 10, 5, '1'),
(49, 9, 62, 1382518096, 11, 5, '1'),
(50, 10, 62, 1382518099, 10, 3, '1'),
(51, 1, 78, 1384733270, 11, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_konsumen`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `riset_kepuasan`.`jawaban_konsumen` AS select `riset_kepuasan`.`banksoal`.`pertanyaan` AS `pertanyaan`,`riset_kepuasan`.`aturan`.`variabel` AS `variabel`,`riset_kepuasan`.`aturan`.`nilai` AS `nilai`,`riset_kepuasan`.`aturan`.`nfuzzy` AS `nfuzzy`,`riset_kepuasan`.`dimensi`.`nama` AS `dimensi`,`riset_kepuasan`.`users`.`first_name` AS `first_name`,`riset_kepuasan`.`users`.`last_name` AS `last_name` from ((((`riset_kepuasan`.`jawaban` join `riset_kepuasan`.`banksoal` on((`riset_kepuasan`.`jawaban`.`banksoal_id` = `riset_kepuasan`.`banksoal`.`banksoal_id`))) join `riset_kepuasan`.`aturan` on((`riset_kepuasan`.`jawaban`.`aturan_id` = `riset_kepuasan`.`aturan`.`aturan_id`))) join `riset_kepuasan`.`dimensi` on(((`riset_kepuasan`.`jawaban`.`dimensi_id` = `riset_kepuasan`.`dimensi`.`dimensi_id`) and (`riset_kepuasan`.`banksoal`.`dimensi_id` = `riset_kepuasan`.`dimensi`.`dimensi_id`)))) join `riset_kepuasan`.`users` on((`riset_kepuasan`.`jawaban`.`user_id` = `riset_kepuasan`.`users`.`id`)));

--
-- Dumping data for table `jawaban_konsumen`
--

INSERT INTO `jawaban_konsumen` (`pertanyaan`, `variabel`, `nilai`, `nfuzzy`, `dimensi`, `first_name`, `last_name`) VALUES
('Karyawan berpenampilan rapi dan professional', 'kecewa', 40, 0.40, 'kehandalan', 'muhamad', 'zikri'),
('Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'kecewa', 40, 0.40, 'berwujud', 'muhamad', 'zikri'),
('Perawat memiliki reputasi yang baik dimata pelanggan', 'kecewa', 40, 0.40, 'kepastian', 'muhamad', 'zikri'),
('Perawat memiliki reputasi yang baik dimata pelanggan', 'kecewa', 40, 0.40, 'kepastian', 'aditia', 'prasetyo'),
('Perawat memiliki reputasi yang baik dimata pelanggan', 'kecewa', 40, 0.40, 'kepastian', 'disar', 'ayus'),
('Karyawan berpenampilan rapi dan professional', 'biasa', 65, 0.65, 'kehandalan', 'regita', 'sari'),
('Perawat memiliki reputasi yang baik dimata pelanggan', 'biasa', 65, 0.65, 'kepastian', 'regita', 'sari'),
('Para perawat akan memberikan pelayanan yang baik pertama kali', 'biasa', 65, 0.65, 'empati', 'regita', 'sari'),
('Para perawat akan memberikan pelayanan yang baik pertama kali', 'biasa', 65, 0.65, 'empati', 'regita', 'sari'),
('Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'biasa', 65, 0.65, 'berwujud', 'regita', 'sari'),
('Karyawan berpenampilan rapi dan professional', 'biasa', 65, 0.65, 'kehandalan', 'muhamad', 'zikri'),
('Peralatan dalam merawat pasien lengkap', 'biasa', 65, 0.65, 'ketanggapan', 'muhamad', 'zikri'),
('Para perawat akan memberikan pelayanan yang baik pertama kali', 'biasa', 65, 0.65, 'empati', 'muhamad', 'zikri'),
('Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'biasa', 65, 0.65, 'berwujud', 'muhamad', 'zikri'),
('Karyawan berpenampilan rapi dan professional', 'biasa', 65, 0.65, 'kehandalan', 'aditia', 'prasetyo'),
('Peralatan dalam merawat pasien lengkap', 'biasa', 65, 0.65, 'ketanggapan', 'aditia', 'prasetyo'),
('Para perawat akan memberikan pelayanan yang baik pertama kali', 'biasa', 65, 0.65, 'empati', 'aditia', 'prasetyo'),
('Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'biasa', 65, 0.65, 'berwujud', 'aditia', 'prasetyo'),
('Peralatan dalam merawat pasien lengkap', 'biasa', 65, 0.65, 'ketanggapan', 'disar', 'ayus'),
('Peralatan dalam merawat pasien lengkap', 'biasa', 65, 0.65, 'ketanggapan', 'disar', 'ayus'),
('Para perawat akan memberikan pelayanan yang baik pertama kali', 'biasa', 65, 0.65, 'empati', 'disar', 'ayus'),
('Perawat memiliki reputasi yang baik dimata pelanggan', 'biasa', 65, 0.65, 'kepastian', 'disar', 'ayus'),
('Karyawan berpenampilan rapi dan professional', 'biasa', 65, 0.65, 'kehandalan', 'lazia', 'lita'),
('Peralatan dalam merawat pasien lengkap', 'biasa', 65, 0.65, 'ketanggapan', 'lazia', 'lita'),
('Perawat memiliki reputasi yang baik dimata pelanggan', 'biasa', 65, 0.65, 'kepastian', 'lazia', 'lita'),
('Para perawat akan memberikan pelayanan yang baik pertama kali', 'biasa', 65, 0.65, 'empati', 'lazia', 'lita'),
('Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'biasa', 65, 0.65, 'berwujud', 'lazia', 'lita'),
('Perawat memiliki reputasi yang baik dimata pelanggan', 'biasa', 65, 0.65, 'kepastian', 'lazia', 'lita'),
('Karyawan berpenampilan rapi dan professional', 'puas', 80, 0.80, 'kehandalan', 'regita', 'sari'),
('Peralatan dalam merawat pasien lengkap', 'puas', 80, 0.80, 'ketanggapan', 'regita', 'sari'),
('Peralatan dalam merawat pasien lengkap', 'puas', 80, 0.80, 'ketanggapan', 'regita', 'sari'),
('Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'puas', 80, 0.80, 'berwujud', 'regita', 'sari'),
('Perawat memiliki reputasi yang baik dimata pelanggan', 'puas', 80, 0.80, 'kepastian', 'regita', 'sari'),
('Peralatan dalam merawat pasien lengkap', 'puas', 80, 0.80, 'ketanggapan', 'muhamad', 'zikri'),
('Perawat memiliki reputasi yang baik dimata pelanggan', 'puas', 80, 0.80, 'kepastian', 'muhamad', 'zikri'),
('Para perawat akan memberikan pelayanan yang baik pertama kali', 'puas', 80, 0.80, 'empati', 'muhamad', 'zikri'),
('Karyawan berpenampilan rapi dan professional', 'puas', 80, 0.80, 'kehandalan', 'aditia', 'prasetyo'),
('Peralatan dalam merawat pasien lengkap', 'puas', 80, 0.80, 'ketanggapan', 'aditia', 'prasetyo'),
('Para perawat akan memberikan pelayanan yang baik pertama kali', 'puas', 80, 0.80, 'empati', 'aditia', 'prasetyo'),
('Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'puas', 80, 0.80, 'berwujud', 'aditia', 'prasetyo'),
('Perawat memiliki reputasi yang baik dimata pelanggan', 'puas', 80, 0.80, 'kepastian', 'aditia', 'prasetyo'),
('Karyawan berpenampilan rapi dan professional', 'puas', 80, 0.80, 'kehandalan', 'disar', 'ayus'),
('Karyawan berpenampilan rapi dan professional', 'puas', 80, 0.80, 'kehandalan', 'disar', 'ayus'),
('Para perawat akan memberikan pelayanan yang baik pertama kali', 'puas', 80, 0.80, 'empati', 'disar', 'ayus'),
('Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'puas', 80, 0.80, 'berwujud', 'disar', 'ayus'),
('Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'puas', 80, 0.80, 'berwujud', 'disar', 'ayus'),
('Karyawan berpenampilan rapi dan professional', 'puas', 80, 0.80, 'kehandalan', 'lazia', 'lita'),
('Peralatan dalam merawat pasien lengkap', 'puas', 80, 0.80, 'ketanggapan', 'lazia', 'lita'),
('Para perawat akan memberikan pelayanan yang baik pertama kali', 'puas', 80, 0.80, 'empati', 'lazia', 'lita'),
('Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'puas', 80, 0.80, 'berwujud', 'lazia', 'lita'),
('Karyawan berpenampilan rapi dan professional', 'puas', 80, 0.80, 'kehandalan', 'sifar', 'lestari');

-- --------------------------------------------------------

--
-- Table structure for table `kesimpulan`
--

CREATE TABLE IF NOT EXISTS `kesimpulan` (
  `kesimpulan_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `kesimpulan` text NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `dimensi` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`kesimpulan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `kesimpulan`
--

INSERT INTO `kesimpulan` (`kesimpulan_id`, `kesimpulan`, `publish`, `dimensi`) VALUES
(19, 'Tingkatkan pelayanan terhadap konsumen, Tingkatkan lagi ketanggapan atau tingkatkan respon anda', 1, 'kehandalan,ketanggapan'),
(20, 'Lakukan komunikasi secara sering, perhatikan kesopanan pakaian dan ucapan', 1, 'komunikasi,kesopanan'),
(21, 'meningkatkan keramahan terhadap pelanggan, meningkatkan komunikasi dengan pelanggan', 1, 'kepastian,berwujud');

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE IF NOT EXISTS `konsumen` (
  `konsumen_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `foto` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT 'none.jpg',
  `user_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`konsumen_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`konsumen_id`, `foto`, `user_id`) VALUES
(1, 'none.jpg', 61),
(2, 'none.jpg', 62),
(3, 'none.jpg', 65),
(4, 'none.jpg', 66),
(5, 'none.jpg', 73),
(6, 'none.jpg', 75),
(7, 'none.jpg', 76),
(8, 'none.jpg', 77),
(9, 'none.jpg', 78),
(10, 'none.jpg', 74);

-- --------------------------------------------------------

--
-- Table structure for table `mu`
--

CREATE TABLE IF NOT EXISTS `mu` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `MuKecewa` double NOT NULL DEFAULT '0',
  `MuBiasa` double NOT NULL DEFAULT '0',
  `MuPuas` double NOT NULL DEFAULT '0',
  `MuFire` float NOT NULL,
  `MuHasil` double DEFAULT NULL,
  `user_id` mediumint(8) unsigned DEFAULT NULL,
  `dimensi_id` mediumint(9) DEFAULT NULL,
  `banksoal_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `dimensi_id` (`dimensi_id`),
  KEY `banksoal_id` (`banksoal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `mu`
--

INSERT INTO `mu` (`id`, `MuKecewa`, `MuBiasa`, `MuPuas`, `MuFire`, `MuHasil`, `user_id`, `dimensi_id`, `banksoal_id`) VALUES
(1, 0.5, 0.5, 0, 0.525, 52.5, 66, 1, 2),
(2, 0, 1, 0, 0.65, 65, 65, 2, 3),
(3, 0, 0.5, 0.5, 0.725, 72.5, 73, 2, 3),
(4, 0, 0, 1, 0.8, 80, 61, 2, 3),
(5, 0, 0.5, 0.5, 0.725, 72.5, 66, 2, 4),
(6, 0, 0.5, 0.5, 0.725, 72.5, 73, 1, 1),
(7, 0, 0, 1, 0.8, 80, 65, 1, 1),
(8, 0, 0.5, 0.5, 0.725, 72.5, 61, 1, 2),
(9, 0.2, 0.8, 0, 0.6, 60, 73, 3, 5),
(10, 0.2, 0.8, 0, 0.6, 60, 66, 3, 10),
(11, 0.5, 0.5, 0, 0.525, 52.5, 65, 3, 5),
(12, 0, 0.5, 0.5, 0.725, 72.5, 61, 3, 5),
(13, 0, 1, 0, 0.65, 65, 61, 4, 6),
(14, 0, 0.5, 0.5, 0.725, 72.5, 65, 4, 6),
(15, 0, 0.5, 0.5, 0.725, 72.5, 73, 4, 6),
(16, 0, 0.5, 0.5, 0.725, 72.5, 66, 4, 7),
(17, 0.5, 0.5, 0, 0.525, 52.5, 66, 5, 8),
(18, 0, 0.5, 0.5, 0.725, 72.5, 73, 5, 8),
(19, 0, 0.5, 0.5, 0.725, 72.5, 61, 5, 8),
(20, 0, 0, 1, 0.8, 80, 65, 5, 8);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `riset_kepuasan`.`pengguna` AS select `riset_kepuasan`.`users`.`id` AS `id`,`riset_kepuasan`.`users`.`username` AS `username`,`riset_kepuasan`.`users`.`email` AS `email`,`riset_kepuasan`.`users`.`first_name` AS `first_name`,`riset_kepuasan`.`users`.`last_name` AS `last_name`,`riset_kepuasan`.`users`.`address` AS `address`,`riset_kepuasan`.`users`.`phone` AS `phone`,`riset_kepuasan`.`users`.`dob` AS `dob`,`riset_kepuasan`.`users`.`sex` AS `sex`,`riset_kepuasan`.`users`.`elderly` AS `elderly`,`riset_kepuasan`.`users`.`jawaban` AS `jawaban` from `riset_kepuasan`.`users`;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `email`, `first_name`, `last_name`, `address`, `phone`, `dob`, `sex`, `elderly`, `jawaban`) VALUES
(30, 'admin', 'm.desta.fadilah@gmail.com', 'Ben', 'admin', 'Jakarta', '09898989', '1989-12-12', 'L', NULL, 0),
(56, 'manajer', 'manajer@perawatku.com', 'Manajer', 'Dua', 'Add From Admin', '(898) 989-8989', '0000-00-00', 'P', NULL, 0),
(57, 'direktur', 'direktur@perawatku.com', 'Direktur', 'Dua', 'Add From Admin', '(898) 989-8989', '0000-00-00', 'L', NULL, 0),
(58, 'admindua', 'admin.dua@perawatku.com', 'Admin', 'Dua', 'Add From Admin page', '(778) 787-8787', '0000-00-00', 'P', NULL, 0),
(59, 'quinsa', 'quinsa@perawatku.com', 'quinsa', 'sarah', 'Jl. Pondok Pinang 5 Rt 007 / 02 ', '(898) 989-8988', '1990-01-01', 'L', 'ortu', 0),
(60, 'carisa', 'carisa@perawatku.com', 'carisa', 'safitri', 'Jl.  Pondok Pinang 6 Rt 009/02 No. 38', '(898) 989-8989', '1990-08-14', 'L', 'ortu', 0),
(61, 'regita', 'regita.sari@gmail.com', 'regita', 'sari', 'Jl. Pondok Ranji Rt 03/02  Ciputat', '(000) 999-9999', '1974-11-06', 'L', NULL, 10),
(62, 'lazia', 'lazia@perawatku.com', 'lazia', 'lita', 'Jl. Pondok Ranji Rt 04/02 Ciputat Timur', '(000) 999-9999', '1977-08-20', 'L', NULL, 10),
(63, 'fardan', 'fardan@perawatku.com', 'fardan', 'cahyadi', 'Jl. Pondok Pinang 6 Rt 010/02 No. 31 Keb-lama', '(787) 878-7878', '1991-08-06', 'L', 'balita', 0),
(64, 'yekizi', 'yekizi@perawatku.com', 'yekizi', 'sharma', 'Jl . Program Dalam Rt 002/4 No. 22 Pancoran Mas Depok', '(898) 988-9898', '2013-08-21', 'L', 'balita', 0),
(65, 'disar', 'disar.ayu@yahoo.com', 'disar', 'ayus', 'Jl. Pondok Pinang  5 Rt 008/02 ', '(000) 999-9999', '1976-08-05', 'L', NULL, 10),
(66, 'muhamad', 'muhamad.zikri@yahoo.co.id', 'muhamad', 'zikri', 'Jl. Pondok Ranji Rt 03/04 Ciputat', '(000) 999-9999', '1981-08-06', 'P', NULL, 10),
(67, 'salsabilla', 'salsabilla@perawatku.com', 'salsabilla', 'syifa', 'Jl. Pondok Ranji Rt 01 / 02 Ciputat Timur', '(621) 8967-7786', '1990-08-26', 'P', 'balita', 0),
(68, 'siska', 'siska@perawatku.com', 'siska', 'aulia', 'Jl. Nusajaya No.3 Pondok ranji ,Tangerang Selatan', '(343) 434-3434', '1990-08-14', 'L', 'adk', 0),
(69, 'satrio', 'satrio@perawatku.com', 'satrio', 'wibowo', 'Jl. Gotong Royong II Rt 07/06 No.2 Gandaria Utara, Jaksel', '(454) 888-8888', '1991-08-13', 'L', 'ortu', 0),
(70, 'fikri', 'fikri@perawatku.com', 'fikri', 'ariansyah', 'Jl. Cagaralam Selatan Rt 002/ 5  Pancoran Mas', '(454) 888-8888', '2013-02-13', 'L', 'balita', 0),
(71, 'aulia', 'aulia@perawatku.com', 'aulia', 'julia', 'Jl. Nusajaya Rt 02/04 Kampung Bulakan', '(898) 989-8989', '1992-08-20', 'L', 'balita', 0),
(72, 'aprianti', 'aprianti@perawatku.com', 'nuke', 'aprianti', 'Jl. Pondok Ranji Rt 04/02 (Kontrakan Pak Dayat) Ciputat', '(998) 989-8989', '1981-03-08', 'P', 'ortu', 0),
(73, 'aditia', 'aditia.prasetyo@hotmail.com', 'aditia', 'prasetyo', 'Jl. H. Jian Rt01/07 Jakarta', '(787) 878-7878', '1965-06-12', 'L', NULL, 10),
(74, 'binetha', 'binetha@gmail.com', 'Binetha', 'Sona', 'Jl. H. Jian 2 Rt002/7 No.25 Cipete Utara', '(989) 898-9898', '1955-08-12', 'L', NULL, 0),
(75, 'hafiza', 'hafiza.hazna@yahoo.com', 'hafiza', 'haznah', 'Jl. Sawo 2 Rt 008/002 No.13 Cipete Utara Jakarta Selatan', '(899) 787-9797', '1976-04-10', 'P', NULL, 0),
(76, 'fendi', 'fendi.wardana@gmail.com', 'fendi', 'wardana', 'Jl. Pondok Ranji Rt 04/02 (Kontrakan Pak Dayat) Ciputat Timur', '(898) 989-8989', '1988-08-12', 'L', NULL, 0),
(77, 'marvel', 'marvel.john@gmail.com', 'Marvel', 'saja', 'Jl. Pondok Ranji Rt 04/02 (Kontrakan Pak Dayat) Ciputat Timur', '(000) 999-9999', '1965-02-21', 'L', NULL, 0),
(78, 'sifar', 'sifar.lestari@hotmail.com', 'sifar', 'lestari', 'Jl. Pondok Ranji Rt 06/02 (Kontrakan Pak Dayat) Ciputat', '(898) 989-8989', '2013-01-06', 'L', NULL, 1),
(79, 'pengguna', 'pengguna@user.com', 'pengguna', 'users', 'pengguna users biasa', '(998) 989-899_', '0000-00-00', 'P', NULL, 0),
(80, 'penggunamanajerlagi', 'pengguna@perawatku.com', 'Penggunalagi', 'lagilagi', 'pengguna lagi dan lagi', '(898) 989-8989', '0000-00-00', 'P', NULL, 0),
(81, 'DestaPerawat', 'desta@perawat.com', 'DestaPerawat', 'DestaPerawat', 'Jakarta Raya', '(021) 553-4845', '0000-00-00', 'L', 'balita', 0),
(82, 'DestaPelanggan', 'desta@pelanggan.com', 'DestaPelanggan', 'DestaPelanggan', 'Tangerang', '(838) 989-7373', '0000-00-00', 'L', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna_konsumen`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `riset_kepuasan`.`pengguna_konsumen` AS select distinct `riset_kepuasan`.`users`.`username` AS `username`,`riset_kepuasan`.`users`.`email` AS `email`,`riset_kepuasan`.`users`.`last_login` AS `last_login`,`riset_kepuasan`.`users`.`active` AS `active`,`riset_kepuasan`.`users`.`first_name` AS `first_name`,`riset_kepuasan`.`users`.`last_name` AS `last_name`,`riset_kepuasan`.`users`.`address` AS `address`,`riset_kepuasan`.`users`.`phone` AS `phone`,`riset_kepuasan`.`users`.`dob` AS `dob`,`riset_kepuasan`.`users`.`sex` AS `sex`,`riset_kepuasan`.`users`.`id` AS `user_id`,`riset_kepuasan`.`users`.`jawaban` AS `jawaban` from (`riset_kepuasan`.`users` join `riset_kepuasan`.`users_groups` on((`riset_kepuasan`.`users_groups`.`user_id` = `riset_kepuasan`.`users`.`id`))) where (`riset_kepuasan`.`users_groups`.`group_id` = '3');

--
-- Dumping data for table `pengguna_konsumen`
--

INSERT INTO `pengguna_konsumen` (`username`, `email`, `last_login`, `active`, `first_name`, `last_name`, `address`, `phone`, `dob`, `sex`, `user_id`, `jawaban`) VALUES
('regita', 'regita.sari@gmail.com', 1384210064, 1, 'regita', 'sari', 'Jl. Pondok Ranji Rt 03/02  Ciputat', '(000) 999-9999', '1974-11-06', 'L', 61, 10),
('muhamad', 'muhamad.zikri@yahoo.co.id', 1384209954, 1, 'muhamad', 'zikri', 'Jl. Pondok Ranji Rt 03/04 Ciputat', '(000) 999-9999', '1981-08-06', 'P', 66, 10),
('disar', 'disar.ayu@yahoo.com', 1384209991, 1, 'disar', 'ayus', 'Jl. Pondok Pinang  5 Rt 008/02 ', '(000) 999-9999', '1976-08-05', 'L', 65, 10),
('lazia', 'lazia@perawatku.com', 1384210082, 1, 'lazia', 'lita', 'Jl. Pondok Ranji Rt 04/02 Ciputat Timur', '(000) 999-9999', '1977-08-20', 'L', 62, 10),
('sifar', 'sifar.lestari@hotmail.com', 1384733236, 1, 'sifar', 'lestari', 'Jl. Pondok Ranji Rt 06/02 (Kontrakan Pak Dayat) Ciputat', '(898) 989-8989', '2013-01-06', 'L', 78, 1),
('fendi', 'fendi.wardana@gmail.com', 1379387205, 1, 'fendi', 'wardana', 'Jl. Pondok Ranji Rt 04/02 (Kontrakan Pak Dayat) Ciputat Timur', '(898) 989-8989', '1988-08-12', 'L', 76, 0),
('aditia', 'aditia.prasetyo@hotmail.com', 1382519231, 1, 'aditia', 'prasetyo', 'Jl. H. Jian Rt01/07 Jakarta', '(787) 878-7878', '1965-06-12', 'L', 73, 10),
('binetha', 'binetha@gmail.com', 1378943274, 1, 'Binetha', 'Sona', 'Jl. H. Jian 2 Rt002/7 No.25 Cipete Utara', '(989) 898-9898', '1955-08-12', 'L', 74, 0),
('hafiza', 'hafiza.hazna@yahoo.com', 1378299498, 1, 'hafiza', 'haznah', 'Jl. Sawo 2 Rt 008/002 No.13 Cipete Utara Jakarta Selatan', '(899) 787-9797', '1976-04-10', 'P', 75, 0),
('marvel', 'marvel.john@gmail.com', 1384210008, 1, 'Marvel', 'saja', 'Jl. Pondok Ranji Rt 04/02 (Kontrakan Pak Dayat) Ciputat Timur', '(000) 999-9999', '1965-02-21', 'L', 77, 0),
('DestaPelanggan', 'desta@pelanggan.com', 1381673661, 1, 'DestaPelanggan', 'DestaPelanggan', 'Tangerang', '(838) 989-7373', '0000-00-00', 'L', 82, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna_perawat`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `riset_kepuasan`.`pengguna_perawat` AS select distinct `riset_kepuasan`.`users`.`id` AS `id`,`riset_kepuasan`.`users`.`ip_address` AS `ip_address`,`riset_kepuasan`.`users`.`username` AS `username`,`riset_kepuasan`.`users`.`password` AS `password`,`riset_kepuasan`.`users`.`salt` AS `salt`,`riset_kepuasan`.`users`.`email` AS `email`,`riset_kepuasan`.`users`.`activation_code` AS `activation_code`,`riset_kepuasan`.`users`.`forgotten_password_code` AS `forgotten_password_code`,`riset_kepuasan`.`users`.`forgotten_password_time` AS `forgotten_password_time`,`riset_kepuasan`.`users`.`remember_code` AS `remember_code`,`riset_kepuasan`.`users`.`created_on` AS `created_on`,`riset_kepuasan`.`users`.`last_login` AS `last_login`,`riset_kepuasan`.`users`.`active` AS `active`,`riset_kepuasan`.`users`.`first_name` AS `first_name`,`riset_kepuasan`.`users`.`last_name` AS `last_name`,`riset_kepuasan`.`users`.`address` AS `address`,`riset_kepuasan`.`users`.`phone` AS `phone`,`riset_kepuasan`.`users`.`dob` AS `dob`,`riset_kepuasan`.`users`.`sex` AS `sex`,`riset_kepuasan`.`users`.`elderly` AS `elderly`,`riset_kepuasan`.`users`.`jawaban` AS `jawaban`,`riset_kepuasan`.`users`.`id` AS `user_id` from (`riset_kepuasan`.`users` join `riset_kepuasan`.`users_groups` on((`riset_kepuasan`.`users_groups`.`user_id` = `riset_kepuasan`.`users`.`id`))) where (`riset_kepuasan`.`users_groups`.`group_id` = '4') limit 10;

--
-- Dumping data for table `pengguna_perawat`
--

INSERT INTO `pengguna_perawat` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `address`, `phone`, `dob`, `sex`, `elderly`, `jawaban`, `user_id`) VALUES
(63, '\0\0', 'fardan', '321266a102fdf7c4e5428fed35edbc5ffe226a7b', NULL, 'fardan@perawatku.com', NULL, NULL, NULL, NULL, 1373430280, 1384210028, 1, 'fardan', 'cahyadi', 'Jl. Pondok Pinang 6 Rt 010/02 No. 31 Keb-lama', '(787) 878-7878', '1991-08-06', 'L', 'balita', 0, 63),
(60, '\0\0', 'carisa', '8ba30e0fef834632c9dda8ef2911328ef9924462', NULL, 'carisa@perawatku.com', NULL, NULL, NULL, NULL, 1373428504, 1378729075, 1, 'carisa', 'safitri', 'Jl.  Pondok Pinang 6 Rt 009/02 No. 38', '(898) 989-8989', '1990-08-14', 'L', 'ortu', 0, 60),
(68, '\0\0', 'siska', '478d8baf22b44ae669225d7d25d8e798b515a97f', NULL, 'siska@perawatku.com', NULL, NULL, NULL, NULL, 1374630172, 1379387133, 1, 'siska', 'aulia', 'Jl. Nusajaya No.3 Pondok ranji ,Tangerang Selatan', '(343) 434-3434', '1990-08-14', 'L', 'adk', 0, 68),
(67, '\0\0', 'salsabilla', 'bf59aba2f196045275a4c8790091e9c775aa97c5', NULL, 'salsabilla@perawatku.com', NULL, NULL, NULL, NULL, 1374630143, 1384210103, 1, 'salsabilla', 'syifa', 'Jl. Pondok Ranji Rt 01 / 02 Ciputat Timur', '(621) 8967-7786', '1990-08-26', 'P', 'balita', 0, 67),
(64, '\0\0', 'yekizi', 'a0eca4b58d9472b00289d4cf2cc7e385f034dd4f', NULL, 'yekizi@perawatku.com', NULL, NULL, NULL, NULL, 1373430312, 1381845192, 1, 'yekizi', 'sharma', 'Jl . Program Dalam Rt 002/4 No. 22 Pancoran Mas Depok', '(898) 988-9898', '2013-08-21', 'L', 'balita', 0, 64),
(69, '\0\0', 'satrio', '09d87a20ff6a75d5bd30b3fe6355617648c39028', NULL, 'satrio@perawatku.com', NULL, NULL, NULL, NULL, 1374630197, 1384209308, 1, 'satrio', 'wibowo', 'Jl. Gotong Royong II Rt 07/06 No.2 Gandaria Utara, Jaksel', '(454) 888-8888', '1991-08-13', 'L', 'ortu', 0, 69),
(70, '\0\0', 'fikri', 'a62df90f4cf1e77bd2a4920b14f379fde8c6ee78', NULL, 'fikri@perawatku.com', NULL, NULL, NULL, NULL, 1374630246, 1379277706, 1, 'fikri', 'ariansyah', 'Jl. Cagaralam Selatan Rt 002/ 5  Pancoran Mas', '(454) 888-8888', '2013-02-13', 'L', 'balita', 0, 70),
(71, '\0\0', 'aulia', '0bb1f001d4efff616f12b754eb6571b2cc188789', NULL, 'aulia@perawatku.com', NULL, NULL, NULL, NULL, 1374630294, 1382519244, 1, 'aulia', 'julia', 'Jl. Nusajaya Rt 02/04 Kampung Bulakan', '(898) 989-8989', '1992-08-20', 'L', 'balita', 0, 71),
(72, '\0\0', 'aprianti', 'c54879c76051612563fbe12d865079d5132ec8a0', NULL, 'aprianti@perawatku.com', NULL, NULL, NULL, NULL, 1374630342, 1384209331, 1, 'nuke', 'aprianti', 'Jl. Pondok Ranji Rt 04/02 (Kontrakan Pak Dayat) Ciputat', '(998) 989-8989', '1981-03-08', 'P', 'ortu', 0, 72),
(59, '\0\0', 'quinsa', 'd0cff6bc1c753127818e6fedf71e9bdae6591da6', NULL, 'quinsa@perawatku.com', NULL, NULL, NULL, NULL, 1373426468, 1376456852, 1, 'quinsa', 'sarah', 'Jl. Pondok Pinang 5 Rt 007 / 02 ', '(898) 989-8988', '1990-01-01', 'L', 'ortu', 0, 59);

-- --------------------------------------------------------

--
-- Table structure for table `perawat`
--

CREATE TABLE IF NOT EXISTS `perawat` (
  `perawat_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `foto` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT 'none.jpg',
  `ijasah` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT 'none.jpg',
  `user_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`perawat_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Dumping data for table `perawat`
--

INSERT INTO `perawat` (`perawat_id`, `foto`, `ijasah`, `user_id`) VALUES
(1, 'none.jpg', 'none.jpg', 59),
(2, 'none.jpg', 'none.jpg', 63),
(3, 'none.jpg', 'none.jpg', 68),
(4, 'none.jpg', 'none.jpg', 70),
(5, 'none.jpg', 'none.jpg', 60),
(6, 'none.jpg', 'none.jpg', 69),
(7, 'none.jpg', 'none.jpg', 70),
(8, 'none.jpg', 'none.jpg', 71),
(9, 'none.jpg', 'none.jpg', 72);

-- --------------------------------------------------------

--
-- Table structure for table `rawatkonsumen`
--

CREATE TABLE IF NOT EXISTS `rawatkonsumen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `konsumen_id` mediumint(8) unsigned NOT NULL,
  `perawat_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `konsumen_id` (`konsumen_id`),
  KEY `perawat_id` (`perawat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `rawatkonsumen`
--

INSERT INTO `rawatkonsumen` (`id`, `konsumen_id`, `perawat_id`) VALUES
(1, 65, 69),
(3, 61, 64),
(4, 66, 72),
(5, 62, 67),
(6, 78, 70),
(8, 73, 71),
(9, 74, 59),
(10, 77, 63),
(11, 75, 60),
(12, 76, 68),
(13, 82, 81);

-- --------------------------------------------------------

--
-- Table structure for table `search`
--

CREATE TABLE IF NOT EXISTS `search` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `query_string` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `search`
--

INSERT INTO `search` (`id`, `query_string`) VALUES
(13, 'pilih_handal=and&amp;pilih_tanggap=+&amp;pilih_pasti=+&amp;pilih_empati=+&amp;kehandalan=9&amp;ketanggapan=11&amp;kepastian=&amp;empati=0&amp;berwujud=0'),
(14, 'pilih_handal=and&amp;pilih_tanggap=+&amp;pilih_pasti=+&amp;pilih_empati=+&amp;kehandalan=9&amp;ketanggapan=10&amp;kepastian=&amp;empati=0&amp;berwujud=0'),
(15, 'pilih_handal=+&amp;pilih_tanggap=+&amp;pilih_pasti=+&amp;pilih_empati=+&amp;kehandalan=&amp;ketanggapan=&amp;kepastian=&amp;empati=0&amp;berwujud=0'),
(16, 'pilih_handal=and&amp;pilih_tanggap=+&amp;pilih_pasti=+&amp;pilih_empati=+&amp;kehandalan=9&amp;ketanggapan=&amp;kepastian=&amp;empati=0&amp;berwujud=0'),
(17, 'pilih_handal=&amp;pilih_tanggap=0&amp;pilih_pasti=0&amp;pilih_empati=0&amp;kehandalan=0&amp;ketanggapan=0&amp;kepastian=0&amp;empati=0&amp;berwujud=0');

-- --------------------------------------------------------

--
-- Table structure for table `soal_publish`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `riset_kepuasan`.`soal_publish` AS select `riset_kepuasan`.`banksoal`.`banksoal_id` AS `banksoal_id`,`riset_kepuasan`.`banksoal`.`pertanyaan` AS `pertanyaan`,`riset_kepuasan`.`banksoal`.`faktor` AS `faktor`,`riset_kepuasan`.`banksoal`.`publish` AS `publish`,`riset_kepuasan`.`dimensi`.`nama` AS `dimensi` from (`riset_kepuasan`.`banksoal` join `riset_kepuasan`.`dimensi`) where (`riset_kepuasan`.`banksoal`.`publish` = 1);

--
-- Dumping data for table `soal_publish`
--

INSERT INTO `soal_publish` (`banksoal_id`, `pertanyaan`, `faktor`, `publish`, `dimensi`) VALUES
(1, 'Karyawan berpenampilan rapi dan professional', 'dirasakan', 1, 'kehandalan'),
(1, 'Karyawan berpenampilan rapi dan professional', 'dirasakan', 1, 'ketanggapan'),
(1, 'Karyawan berpenampilan rapi dan professional', 'dirasakan', 1, 'kepastian'),
(1, 'Karyawan berpenampilan rapi dan professional', 'dirasakan', 1, 'empati'),
(1, 'Karyawan berpenampilan rapi dan professional', 'dirasakan', 1, 'berwujud'),
(1, 'Karyawan berpenampilan rapi dan professional', 'dirasakan', 1, 'komunikasi'),
(1, 'Karyawan berpenampilan rapi dan professional', 'dirasakan', 1, 'akses'),
(1, 'Karyawan berpenampilan rapi dan professional', 'dirasakan', 1, 'pengertian'),
(1, 'Karyawan berpenampilan rapi dan professional', 'dirasakan', 1, 'komptentsi'),
(1, 'Karyawan berpenampilan rapi dan professional', 'dirasakan', 1, 'kesopanan'),
(1, 'Karyawan berpenampilan rapi dan professional', 'dirasakan', 1, 'cobacoba'),
(2, 'Karyawan berpenampilan rapi dan professional', 'diharapkan', 1, 'kehandalan'),
(2, 'Karyawan berpenampilan rapi dan professional', 'diharapkan', 1, 'ketanggapan'),
(2, 'Karyawan berpenampilan rapi dan professional', 'diharapkan', 1, 'kepastian'),
(2, 'Karyawan berpenampilan rapi dan professional', 'diharapkan', 1, 'empati'),
(2, 'Karyawan berpenampilan rapi dan professional', 'diharapkan', 1, 'berwujud'),
(2, 'Karyawan berpenampilan rapi dan professional', 'diharapkan', 1, 'komunikasi'),
(2, 'Karyawan berpenampilan rapi dan professional', 'diharapkan', 1, 'akses'),
(2, 'Karyawan berpenampilan rapi dan professional', 'diharapkan', 1, 'pengertian'),
(2, 'Karyawan berpenampilan rapi dan professional', 'diharapkan', 1, 'komptentsi'),
(2, 'Karyawan berpenampilan rapi dan professional', 'diharapkan', 1, 'kesopanan'),
(2, 'Karyawan berpenampilan rapi dan professional', 'diharapkan', 1, 'cobacoba'),
(3, 'Peralatan dalam merawat pasien lengkap', 'diharapkan', 1, 'kehandalan'),
(3, 'Peralatan dalam merawat pasien lengkap', 'diharapkan', 1, 'ketanggapan'),
(3, 'Peralatan dalam merawat pasien lengkap', 'diharapkan', 1, 'kepastian'),
(3, 'Peralatan dalam merawat pasien lengkap', 'diharapkan', 1, 'empati'),
(3, 'Peralatan dalam merawat pasien lengkap', 'diharapkan', 1, 'berwujud'),
(3, 'Peralatan dalam merawat pasien lengkap', 'diharapkan', 1, 'komunikasi'),
(3, 'Peralatan dalam merawat pasien lengkap', 'diharapkan', 1, 'akses'),
(3, 'Peralatan dalam merawat pasien lengkap', 'diharapkan', 1, 'pengertian'),
(3, 'Peralatan dalam merawat pasien lengkap', 'diharapkan', 1, 'komptentsi'),
(3, 'Peralatan dalam merawat pasien lengkap', 'diharapkan', 1, 'kesopanan'),
(3, 'Peralatan dalam merawat pasien lengkap', 'diharapkan', 1, 'cobacoba'),
(4, 'Peralatan dalam merawat pasien lengkap', 'dirasakan', 1, 'kehandalan'),
(4, 'Peralatan dalam merawat pasien lengkap', 'dirasakan', 1, 'ketanggapan'),
(4, 'Peralatan dalam merawat pasien lengkap', 'dirasakan', 1, 'kepastian'),
(4, 'Peralatan dalam merawat pasien lengkap', 'dirasakan', 1, 'empati'),
(4, 'Peralatan dalam merawat pasien lengkap', 'dirasakan', 1, 'berwujud'),
(4, 'Peralatan dalam merawat pasien lengkap', 'dirasakan', 1, 'komunikasi'),
(4, 'Peralatan dalam merawat pasien lengkap', 'dirasakan', 1, 'akses'),
(4, 'Peralatan dalam merawat pasien lengkap', 'dirasakan', 1, 'pengertian'),
(4, 'Peralatan dalam merawat pasien lengkap', 'dirasakan', 1, 'komptentsi'),
(4, 'Peralatan dalam merawat pasien lengkap', 'dirasakan', 1, 'kesopanan'),
(4, 'Peralatan dalam merawat pasien lengkap', 'dirasakan', 1, 'cobacoba'),
(5, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'kehandalan'),
(5, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'ketanggapan'),
(5, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'kepastian'),
(5, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'empati'),
(5, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'berwujud'),
(5, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'komunikasi'),
(5, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'akses'),
(5, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'pengertian'),
(5, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'komptentsi'),
(5, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'kesopanan'),
(5, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'cobacoba'),
(6, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'diharapkan', 1, 'kehandalan'),
(6, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'diharapkan', 1, 'ketanggapan'),
(6, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'diharapkan', 1, 'kepastian'),
(6, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'diharapkan', 1, 'empati'),
(6, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'diharapkan', 1, 'berwujud'),
(6, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'diharapkan', 1, 'komunikasi'),
(6, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'diharapkan', 1, 'akses'),
(6, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'diharapkan', 1, 'pengertian'),
(6, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'diharapkan', 1, 'komptentsi'),
(6, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'diharapkan', 1, 'kesopanan'),
(6, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'diharapkan', 1, 'cobacoba'),
(7, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'dirasakan', 1, 'kehandalan'),
(7, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'dirasakan', 1, 'ketanggapan'),
(7, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'dirasakan', 1, 'kepastian'),
(7, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'dirasakan', 1, 'empati'),
(7, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'dirasakan', 1, 'berwujud'),
(7, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'dirasakan', 1, 'komunikasi'),
(7, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'dirasakan', 1, 'akses'),
(7, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'dirasakan', 1, 'pengertian'),
(7, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'dirasakan', 1, 'komptentsi'),
(7, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'dirasakan', 1, 'kesopanan'),
(7, 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'dirasakan', 1, 'cobacoba'),
(8, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'dirasakan', 1, 'kehandalan'),
(8, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'dirasakan', 1, 'ketanggapan'),
(8, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'dirasakan', 1, 'kepastian'),
(8, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'dirasakan', 1, 'empati'),
(8, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'dirasakan', 1, 'berwujud'),
(8, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'dirasakan', 1, 'komunikasi'),
(8, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'dirasakan', 1, 'akses'),
(8, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'dirasakan', 1, 'pengertian'),
(8, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'dirasakan', 1, 'komptentsi'),
(8, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'dirasakan', 1, 'kesopanan'),
(8, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'dirasakan', 1, 'cobacoba'),
(9, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'diharapkan', 1, 'kehandalan'),
(9, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'diharapkan', 1, 'ketanggapan'),
(9, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'diharapkan', 1, 'kepastian'),
(9, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'diharapkan', 1, 'empati'),
(9, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'diharapkan', 1, 'berwujud'),
(9, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'diharapkan', 1, 'komunikasi'),
(9, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'diharapkan', 1, 'akses'),
(9, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'diharapkan', 1, 'pengertian'),
(9, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'diharapkan', 1, 'komptentsi'),
(9, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'diharapkan', 1, 'kesopanan'),
(9, 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'diharapkan', 1, 'cobacoba'),
(10, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'dirasakan', 1, 'kehandalan'),
(10, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'dirasakan', 1, 'ketanggapan'),
(10, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'dirasakan', 1, 'kepastian'),
(10, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'dirasakan', 1, 'empati'),
(10, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'dirasakan', 1, 'berwujud'),
(10, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'dirasakan', 1, 'komunikasi'),
(10, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'dirasakan', 1, 'akses'),
(10, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'dirasakan', 1, 'pengertian'),
(10, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'dirasakan', 1, 'komptentsi'),
(10, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'dirasakan', 1, 'kesopanan'),
(10, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'dirasakan', 1, 'cobacoba'),
(11, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'kehandalan'),
(11, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'ketanggapan'),
(11, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'kepastian'),
(11, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'empati'),
(11, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'berwujud'),
(11, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'komunikasi'),
(11, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'akses'),
(11, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'pengertian'),
(11, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'komptentsi'),
(11, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'kesopanan'),
(11, 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', 1, 'cobacoba'),
(12, 'Perawat memberikan pelayanan tepat di saat client membetuhkannya', 'dirasakan', 1, 'kehandalan'),
(12, 'Perawat memberikan pelayanan tepat di saat client membetuhkannya', 'dirasakan', 1, 'ketanggapan'),
(12, 'Perawat memberikan pelayanan tepat di saat client membetuhkannya', 'dirasakan', 1, 'kepastian'),
(12, 'Perawat memberikan pelayanan tepat di saat client membetuhkannya', 'dirasakan', 1, 'empati'),
(12, 'Perawat memberikan pelayanan tepat di saat client membetuhkannya', 'dirasakan', 1, 'berwujud'),
(12, 'Perawat memberikan pelayanan tepat di saat client membetuhkannya', 'dirasakan', 1, 'komunikasi'),
(12, 'Perawat memberikan pelayanan tepat di saat client membetuhkannya', 'dirasakan', 1, 'akses'),
(12, 'Perawat memberikan pelayanan tepat di saat client membetuhkannya', 'dirasakan', 1, 'pengertian'),
(12, 'Perawat memberikan pelayanan tepat di saat client membetuhkannya', 'dirasakan', 1, 'komptentsi'),
(12, 'Perawat memberikan pelayanan tepat di saat client membetuhkannya', 'dirasakan', 1, 'kesopanan'),
(12, 'Perawat memberikan pelayanan tepat di saat client membetuhkannya', 'dirasakan', 1, 'cobacoba');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `address` text,
  `phone` varchar(20) DEFAULT NULL,
  `dob` date NOT NULL,
  `sex` char(1) NOT NULL,
  `elderly` enum('adk','balita','ortu') DEFAULT NULL,
  `jawaban` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `address`, `phone`, `dob`, `sex`, `elderly`, `jawaban`) VALUES
(30, '\0\0', 'admin', 'afaed771209c36d60cf035f2b24b70c695b56480', NULL, 'm.desta.fadilah@gmail.com', NULL, NULL, NULL, NULL, 1372573989, 1398124142, 1, 'Ben', 'admin', 'Jakarta', '09898989', '1989-12-12', 'L', NULL, 0),
(56, '\0\0', 'manajer', 'a4879a8682d338162efc9bff82f0fd7fcfcd7a28', NULL, 'manajer@perawatku.com', NULL, NULL, NULL, NULL, 1373425567, 1386570286, 1, 'Manajer', 'Dua', 'Add From Admin', '(898) 989-8989', '0000-00-00', 'P', NULL, 0),
(57, '\0\0', 'direktur', 'f3c8ebdd95deab762d89fd3e5a5d121c28a4c826', NULL, 'direktur@perawatku.com', NULL, NULL, NULL, NULL, 1373425637, 1396019156, 1, 'Direktur', 'Dua', 'Add From Admin', '(898) 989-8989', '0000-00-00', 'L', NULL, 0),
(58, '\0\0', 'admindua', '3b2e89dfe76bf92113d4f819ba0bcfe7eb3f8a90', NULL, 'admin.dua@perawatku.com', 'ea13edb3a4c5fb75b2a93f6960d31f73da814a58', NULL, NULL, NULL, 1373425708, 1375767228, 0, 'Admin', 'Dua', 'Add From Admin page', '(778) 787-8787', '0000-00-00', 'P', NULL, 0),
(59, '\0\0', 'quinsa', 'd0cff6bc1c753127818e6fedf71e9bdae6591da6', NULL, 'quinsa@perawatku.com', NULL, NULL, NULL, NULL, 1373426468, 1376456852, 1, 'quinsa', 'sarah', 'Jl. Pondok Pinang 5 Rt 007 / 02 ', '(898) 989-8988', '1990-01-01', 'L', 'ortu', 0),
(60, '\0\0', 'carisa', '8ba30e0fef834632c9dda8ef2911328ef9924462', NULL, 'carisa@perawatku.com', NULL, NULL, NULL, NULL, 1373428504, 1378729075, 1, 'carisa', 'safitri', 'Jl.  Pondok Pinang 6 Rt 009/02 No. 38', '(898) 989-8989', '1990-08-14', 'L', 'ortu', 0),
(61, '\0\0', 'regita', 'c967ff20786b069ac77e519913b155c7aee1b5b8', NULL, 'regita.sari@gmail.com', NULL, NULL, NULL, NULL, 1373429658, 1384210064, 1, 'regita', 'sari', 'Jl. Pondok Ranji Rt 03/02  Ciputat', '(000) 999-9999', '1974-11-06', 'L', NULL, 10),
(62, '\0\0', 'lazia', 'c7dd293489d5ff98c375a5505e50160745fe241f', NULL, 'lazia@perawatku.com', NULL, NULL, NULL, NULL, 1373429795, 1384210082, 1, 'lazia', 'lita', 'Jl. Pondok Ranji Rt 04/02 Ciputat Timur', '(000) 999-9999', '1977-08-20', 'L', NULL, 10),
(63, '\0\0', 'fardan', '321266a102fdf7c4e5428fed35edbc5ffe226a7b', NULL, 'fardan@perawatku.com', NULL, NULL, NULL, NULL, 1373430280, 1384210028, 1, 'fardan', 'cahyadi', 'Jl. Pondok Pinang 6 Rt 010/02 No. 31 Keb-lama', '(787) 878-7878', '1991-08-06', 'L', 'balita', 0),
(64, '\0\0', 'yekizi', 'a0eca4b58d9472b00289d4cf2cc7e385f034dd4f', NULL, 'yekizi@perawatku.com', NULL, NULL, NULL, NULL, 1373430312, 1381845192, 1, 'yekizi', 'sharma', 'Jl . Program Dalam Rt 002/4 No. 22 Pancoran Mas Depok', '(898) 988-9898', '2013-08-21', 'L', 'balita', 0),
(65, '\0\0', 'disar', 'b562c34a4fc6f30a7433458b149e1a96c434f562', NULL, 'disar.ayu@yahoo.com', NULL, NULL, NULL, NULL, 1373430372, 1384209991, 1, 'disar', 'ayus', 'Jl. Pondok Pinang  5 Rt 008/02 ', '(000) 999-9999', '1976-08-05', 'L', NULL, 10),
(66, '\0\0', 'muhamad', '48a60fc1cd43be8f3fba01f499f4d434482d3a73', NULL, 'muhamad.zikri@yahoo.co.id', NULL, NULL, NULL, NULL, 1374247493, 1384209954, 1, 'muhamad', 'zikri', 'Jl. Pondok Ranji Rt 03/04 Ciputat', '(000) 999-9999', '1981-08-06', 'P', NULL, 10),
(67, '\0\0', 'salsabilla', 'bf59aba2f196045275a4c8790091e9c775aa97c5', NULL, 'salsabilla@perawatku.com', NULL, NULL, NULL, NULL, 1374630143, 1384210103, 1, 'salsabilla', 'syifa', 'Jl. Pondok Ranji Rt 01 / 02 Ciputat Timur', '(621) 8967-7786', '1990-08-26', 'P', 'balita', 0),
(68, '\0\0', 'siska', '478d8baf22b44ae669225d7d25d8e798b515a97f', NULL, 'siska@perawatku.com', NULL, NULL, NULL, NULL, 1374630172, 1379387133, 1, 'siska', 'aulia', 'Jl. Nusajaya No.3 Pondok ranji ,Tangerang Selatan', '(343) 434-3434', '1990-08-14', 'L', 'adk', 0),
(69, '\0\0', 'satrio', '09d87a20ff6a75d5bd30b3fe6355617648c39028', NULL, 'satrio@perawatku.com', NULL, NULL, NULL, NULL, 1374630197, 1384209308, 1, 'satrio', 'wibowo', 'Jl. Gotong Royong II Rt 07/06 No.2 Gandaria Utara, Jaksel', '(454) 888-8888', '1991-08-13', 'L', 'ortu', 0),
(70, '\0\0', 'fikri', 'a62df90f4cf1e77bd2a4920b14f379fde8c6ee78', NULL, 'fikri@perawatku.com', NULL, NULL, NULL, NULL, 1374630246, 1379277706, 1, 'fikri', 'ariansyah', 'Jl. Cagaralam Selatan Rt 002/ 5  Pancoran Mas', '(454) 888-8888', '2013-02-13', 'L', 'balita', 0),
(71, '\0\0', 'aulia', '0bb1f001d4efff616f12b754eb6571b2cc188789', NULL, 'aulia@perawatku.com', NULL, NULL, NULL, NULL, 1374630294, 1382519244, 1, 'aulia', 'julia', 'Jl. Nusajaya Rt 02/04 Kampung Bulakan', '(898) 989-8989', '1992-08-20', 'L', 'balita', 0),
(72, '\0\0', 'aprianti', 'c54879c76051612563fbe12d865079d5132ec8a0', NULL, 'aprianti@perawatku.com', NULL, NULL, NULL, NULL, 1374630342, 1384209331, 1, 'nuke', 'aprianti', 'Jl. Pondok Ranji Rt 04/02 (Kontrakan Pak Dayat) Ciputat', '(998) 989-8989', '1981-03-08', 'P', 'ortu', 0),
(73, '\0\0', 'aditia', '16224c1077e3cef91e77e2de90600e1254a16244', NULL, 'aditia.prasetyo@hotmail.com', NULL, NULL, NULL, NULL, 1374630423, 1382519231, 1, 'aditia', 'prasetyo', 'Jl. H. Jian Rt01/07 Jakarta', '(787) 878-7878', '1965-06-12', 'L', NULL, 10),
(74, '\0\0', 'binetha', 'a4382aab316ce051fa32f6be1a9b00caa60dd0ec', NULL, 'binetha@gmail.com', NULL, NULL, NULL, NULL, 1374630452, 1378943274, 1, 'Binetha', 'Sona', 'Jl. H. Jian 2 Rt002/7 No.25 Cipete Utara', '(989) 898-9898', '1955-08-12', 'L', NULL, 0),
(75, '\0\0', 'hafiza', '72fb57b21c3d93570a9eecad3910ff4fb3d30a08', NULL, 'hafiza.hazna@yahoo.com', NULL, NULL, NULL, NULL, 1374630482, 1378299498, 1, 'hafiza', 'haznah', 'Jl. Sawo 2 Rt 008/002 No.13 Cipete Utara Jakarta Selatan', '(899) 787-9797', '1976-04-10', 'P', NULL, 0),
(76, '\0\0', 'fendi', '398eef49ba7f12d980413f0870b8c90c0f379c0e', NULL, 'fendi.wardana@gmail.com', NULL, NULL, NULL, NULL, 1374630504, 1379387205, 1, 'fendi', 'wardana', 'Jl. Pondok Ranji Rt 04/02 (Kontrakan Pak Dayat) Ciputat Timur', '(898) 989-8989', '1988-08-12', 'L', NULL, 0),
(77, '\0\0', 'marvel', '3c2382f6ebca01888eedd22a3ab43702c8533507', NULL, 'marvel.john@gmail.com', NULL, NULL, NULL, NULL, 1374630531, 1384210008, 1, 'Marvel', 'saja', 'Jl. Pondok Ranji Rt 04/02 (Kontrakan Pak Dayat) Ciputat Timur', '(000) 999-9999', '1965-02-21', 'L', NULL, 0),
(78, '\0\0', 'sifar', '34cbf2bc2c31e5e6b6e1b1fabea4847884d6bc4b', NULL, 'sifar.lestari@hotmail.com', NULL, NULL, NULL, NULL, 1374630554, 1384733236, 1, 'sifar', 'lestari', 'Jl. Pondok Ranji Rt 06/02 (Kontrakan Pak Dayat) Ciputat', '(898) 989-8989', '2013-01-06', 'L', NULL, 1),
(79, '\0\0', 'pengguna', '2f74d1e9e990c4ab72a4778d680d45196f9c9932', NULL, 'pengguna@user.com', NULL, NULL, NULL, NULL, 1374643704, 1374643704, 1, 'pengguna', 'users', 'pengguna users biasa', '(998) 989-899_', '0000-00-00', 'P', NULL, 0),
(80, '\0\0', 'penggunamanajerlagi', '72093421dbd06dcee1a8d69e7cd0ffa1e9c3b789', NULL, 'pengguna@perawatku.com', NULL, NULL, NULL, NULL, 1374643897, 1374643897, 1, 'Penggunalagi', 'lagilagi', 'pengguna lagi dan lagi', '(898) 989-8989', '0000-00-00', 'P', NULL, 0),
(81, '\0\0', 'DestaPerawat', 'a64c5590444fc117356770a8912bb7a20ed5fcbd', NULL, 'desta@perawat.com', NULL, NULL, NULL, NULL, 1381673337, 1381673337, 1, 'DestaPerawat', 'DestaPerawat', 'Jakarta Raya', '(021) 553-4845', '0000-00-00', 'L', 'balita', 0),
(82, '\0\0', 'DestaPelanggan', '03d690ef5ca5454e51c1219918042d1b3f1326c8', NULL, 'desta@pelanggan.com', NULL, NULL, NULL, NULL, 1381673384, 1381673661, 1, 'DestaPelanggan', 'DestaPelanggan', 'Tangerang', '(838) 989-7373', '0000-00-00', 'L', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=195 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(128, 30, 1),
(137, 56, 25),
(138, 57, 6),
(139, 58, 1),
(142, 61, 3),
(144, 63, 4),
(163, 79, 6),
(168, 60, 4),
(170, 66, 3),
(171, 68, 4),
(172, 67, 4),
(173, 65, 3),
(174, 62, 3),
(175, 64, 4),
(176, 78, 3),
(177, 76, 3),
(178, 69, 4),
(179, 70, 4),
(180, 71, 4),
(181, 72, 4),
(182, 73, 3),
(183, 74, 3),
(184, 75, 3),
(185, 59, 4),
(187, 77, 3),
(191, 80, 25),
(193, 82, 3),
(194, 81, 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `banksoal`
--
ALTER TABLE `banksoal`
  ADD CONSTRAINT `banksoal_ibfk_3` FOREIGN KEY (`dimensi_id`) REFERENCES `dimensi` (`dimensi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_10` FOREIGN KEY (`dimensi_id`) REFERENCES `dimensi` (`dimensi_id`),
  ADD CONSTRAINT `jawaban_ibfk_3` FOREIGN KEY (`banksoal_id`) REFERENCES `banksoal` (`banksoal_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_9` FOREIGN KEY (`aturan_id`) REFERENCES `aturan` (`aturan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD CONSTRAINT `konsumen_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mu`
--
ALTER TABLE `mu`
  ADD CONSTRAINT `mu_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `mu_ibfk_2` FOREIGN KEY (`dimensi_id`) REFERENCES `dimensi` (`dimensi_id`),
  ADD CONSTRAINT `mu_ibfk_3` FOREIGN KEY (`banksoal_id`) REFERENCES `banksoal` (`banksoal_id`);

--
-- Constraints for table `perawat`
--
ALTER TABLE `perawat`
  ADD CONSTRAINT `perawat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `rawatkonsumen`
--
ALTER TABLE `rawatkonsumen`
  ADD CONSTRAINT `rawatkonsumen_ibfk_4` FOREIGN KEY (`konsumen_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rawatkonsumen_ibfk_5` FOREIGN KEY (`perawat_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
