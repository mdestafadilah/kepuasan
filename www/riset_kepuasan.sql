/*
Navicat MySQL Data Transfer

Source Server         : mySQL
Source Server Version : 50141
Source Host           : localhost:3306
Source Database       : riset_kepuasan

Target Server Type    : MYSQL
Target Server Version : 50141
File Encoding         : 65001

Date: 2013-09-21 18:39:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for aturan
-- ----------------------------
DROP TABLE IF EXISTS `aturan`;
CREATE TABLE `aturan` (
  `aturan_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `variabel` varchar(10) NOT NULL DEFAULT '' COMMENT 'nama variabel',
  `nilai` float(6,0) NOT NULL DEFAULT '0' COMMENT 'Nilai minimal variabel',
  `nfuzzy` double(4,2) NOT NULL COMMENT 'dibagi 100 dulu',
  PRIMARY KEY (`aturan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of aturan
-- ----------------------------
INSERT INTO `aturan` VALUES ('9', 'kecewa', '40', '0.40');
INSERT INTO `aturan` VALUES ('10', 'biasa', '65', '0.65');
INSERT INTO `aturan` VALUES ('11', 'puas', '80', '0.80');

-- ----------------------------
-- Table structure for banksoal
-- ----------------------------
DROP TABLE IF EXISTS `banksoal`;
CREATE TABLE `banksoal` (
  `banksoal_id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` varchar(255) NOT NULL,
  `faktor` enum('dirasakan','diharapkan') DEFAULT 'dirasakan' COMMENT 'Berdasarkan teori prasaruman',
  `dimensi_id` mediumint(9) NOT NULL,
  `publish` tinyint(1) NOT NULL,
  PRIMARY KEY (`banksoal_id`),
  KEY `dimensi_id` (`dimensi_id`),
  CONSTRAINT `banksoal_ibfk_3` FOREIGN KEY (`dimensi_id`) REFERENCES `dimensi` (`dimensi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of banksoal
-- ----------------------------
INSERT INTO `banksoal` VALUES ('1', 'Karyawan berpenampilan rapi dan professional', 'dirasakan', '1', '1');
INSERT INTO `banksoal` VALUES ('2', 'Karyawan berpenampilan rapi dan professional', 'diharapkan', '1', '1');
INSERT INTO `banksoal` VALUES ('3', 'Peralatan dalam merawat pasien lengkap', 'diharapkan', '2', '1');
INSERT INTO `banksoal` VALUES ('4', 'Peralatan dalam merawat pasien lengkap', 'dirasakan', '2', '1');
INSERT INTO `banksoal` VALUES ('5', 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', '3', '1');
INSERT INTO `banksoal` VALUES ('6', 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'diharapkan', '4', '1');
INSERT INTO `banksoal` VALUES ('7', 'Para perawat akan memberikan pelayanan yang baik pertama kali', 'dirasakan', '4', '1');
INSERT INTO `banksoal` VALUES ('8', 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'dirasakan', '5', '1');
INSERT INTO `banksoal` VALUES ('9', 'Perusahaan memberikan pelayanan sesuai dengan jangka waktu yang dijanjikan', 'diharapkan', '5', '1');
INSERT INTO `banksoal` VALUES ('10', 'Perawat memiliki reputasi yang baik dimata pelanggan', 'dirasakan', '3', '1');
INSERT INTO `banksoal` VALUES ('11', 'Perawat memiliki reputasi yang baik dimata pelanggan', 'diharapkan', '1', '1');
INSERT INTO `banksoal` VALUES ('12', 'Perawat memberikan pelayanan tepat di saat client membetuhkannya', 'dirasakan', '2', '1');
INSERT INTO `banksoal` VALUES ('13', 'Perawat memberikan pelayanan tepat di saat client membetuhkannya', 'dirasakan', '2', '0');
INSERT INTO `banksoal` VALUES ('15', 'Perawat selalu bersedia membantu anda', 'dirasakan', '2', '0');
INSERT INTO `banksoal` VALUES ('16', 'Perawat selalu bersedia membantu anda', 'dirasakan', '2', '0');
INSERT INTO `banksoal` VALUES ('17', 'Perawat secara konsisten bersikap ramah terhadap anda', 'dirasakan', '3', '0');
INSERT INTO `banksoal` VALUES ('18', 'Perawat secara konsisten bersikap ramah terhadap anda', 'dirasakan', '3', '0');
INSERT INTO `banksoal` VALUES ('19', 'Perawat mempunyai pengetahuan yang baik, ketika anda memiliki pertanyaan yang diajukan', 'dirasakan', '3', '0');
INSERT INTO `banksoal` VALUES ('20', 'Perawat mempunyai pengetahuan yang baik, ketika anda memiliki pertanyaan yang diajukan', 'dirasakan', '3', '0');
INSERT INTO `banksoal` VALUES ('21', 'Perusahaan memberikan anda perhatian khusus secara individu', 'dirasakan', '4', '0');
INSERT INTO `banksoal` VALUES ('22', 'Perusahaan meninggalkan kesan yang baik di hati anda', 'dirasakan', '4', '0');
INSERT INTO `banksoal` VALUES ('23', 'Perusahaan meninggalkan kesan yang baik di hati anda', 'dirasakan', '4', '0');
INSERT INTO `banksoal` VALUES ('24', 'Perawat memahami kebutuhan tertentu terhadap client/ pelanggan', 'dirasakan', '4', '0');
INSERT INTO `banksoal` VALUES ('25', 'Perawat memahami kebutuhan tertentu terhadap client/ pelanggan', 'dirasakan', '4', '0');
INSERT INTO `banksoal` VALUES ('26', 'Karyawan berpenampilan rapi dan professional?', 'dirasakan', '9', '0');
INSERT INTO `banksoal` VALUES ('27', 'Perusahaan memberikan anda perhatian khusus secara individu', 'dirasakan', '4', '0');
INSERT INTO `banksoal` VALUES ('28', 'test lagi dan lagi', 'dirasakan', '2', '1');

-- ----------------------------
-- Table structure for ci_sessions
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ci_sessions
-- ----------------------------
INSERT INTO `ci_sessions` VALUES ('5aae4bbd7a9adfeb1a2145f8917ce9ef', '127.0.0.1', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/537.36 CoolNovo/2.0.9.20', '1379739079', 'a:7:{s:9:\"user_data\";s:0:\"\";s:8:\"identity\";s:7:\"manajer\";s:8:\"username\";s:7:\"manajer\";s:5:\"email\";s:21:\"manajer@perawatku.com\";s:7:\"user_id\";s:2:\"56\";s:14:\"old_last_login\";s:10:\"1379715791\";s:8:\"loggedin\";b:1;}');

-- ----------------------------
-- Table structure for dimensi
-- ----------------------------
DROP TABLE IF EXISTS `dimensi`;
CREATE TABLE `dimensi` (
  `dimensi_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL COMMENT 'batasan masalah hanya 5, dalam teori ada 10',
  `keterangan` text NOT NULL,
  PRIMARY KEY (`dimensi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dimensi
-- ----------------------------
INSERT INTO `dimensi` VALUES ('1', 'kehandalan', 'Dalam Bahasa Inggris \'Reliability\' yaitu kemampuan untuk memberikan pelayanan yang sesuia dengan janji yang ditawarkan/ Reliabilitas yaitu memberikan pelayanan penuh kehangatan, keteguhan dalam menangani pelanggan, melakukan pelayanan dengan baik (Kang dan James, 2004)');
INSERT INTO `dimensi` VALUES ('2', 'ketanggapan', 'Dalam Bahasa Inggris \'Responbility\' yaitu kemampuan karyawan dalam membantu pelanggan dalam memberikan pelayanan yang sigap dan tanggap/ Tanggapan yaitu menjaga performa pelayanan terhadap pelangggan dan siap membaca respon permintaan pelanggan (Kang dan James, 2004).');
INSERT INTO `dimensi` VALUES ('3', 'kepastian', 'Jaminan dalam bahasa inggris \'Assurance\' yaitu kemampuan karyawan dalam produk, perhatian, keramah tamahan, dan kepercayaan terhadap perusahaan');
INSERT INTO `dimensi` VALUES ('4', 'empati', 'dalam bahas nggris \'Empathy\' yaitu perhatian secara individual yang diberikan perusahaan kepada pelanggan, seperti mudah menghubungi perusahaan, mengerti kebutuhan konsumen');
INSERT INTO `dimensi` VALUES ('5', 'berwujud', 'dalam bahasa inggris \'tangible\' yaitu penampilan fisik, seperti ruangan, karyawan, kenyamana, komunikasi dan penampilan/ Bukti langsung yaitu memanfaatkan peralatan modern, fasilitas visual yang menarik, dan karyawan yang terampil (Kang dan James, 2004).');
INSERT INTO `dimensi` VALUES ('6', 'komunikasi', 'dalam bahasa ingggris \'communitaciton\'/ Komunikasi yaitu menggunakan bahasa yang tepat kepada pelanggan agar mereka merasa diperlakukan secara istimewa dan lebih kepada kebutuhan emosional.');
INSERT INTO `dimensi` VALUES ('7', 'akses', 'dalam bahasa inggris \'access\'/ Akses merupakan kemudahan untuk dihubungi dari persepsi pelanggan, baik telepon, fax, email serta komunikasi lainnya.');
INSERT INTO `dimensi` VALUES ('8', 'pengertian', 'dalam bahasa inggris \'understanding\'/ Pengertian yaitu menunjukkan pengertian kepada pelanggan dan memandang mereka sebagai seorang manusia dan mereka juga merasa diperlakukan secara istimewa.');
INSERT INTO `dimensi` VALUES ('9', 'komptentsi', 'dalam bahasa inggris \'Competency\' / Empati yaitu memberikan perhatian individu pelanggan, karyawan yang berurusan dengan pelanggan secara peduli, memiliki kepentingan pelanggan dan memahami kebutuhan pelanggan serta nyaman (Kang dan James, 2004).');
INSERT INTO `dimensi` VALUES ('10', 'kesopanan', 'dalam bahasa inggris \'courtsey\' / Jaminan yaitu karyawan yang menanampakan kepercayan terhadap pelanggan, membuat pelanggan merasa aman terhadap mereka dan karyawan yang sopan (Kang dan James, 2004).');
INSERT INTO `dimensi` VALUES ('11', 'cobacoba', 'kali aja bisah');

-- ----------------------------
-- Table structure for fquery
-- ----------------------------
DROP TABLE IF EXISTS `fquery`;
CREATE TABLE `fquery` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `query_string` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fquery
-- ----------------------------
INSERT INTO `fquery` VALUES ('13', 'pilih_handal=and&amp;pilih_tanggap=+&amp;pilih_pasti=+&amp;pilih_empati=+&amp;kehandalan=9&amp;ketanggapan=11&amp;kepastian=&amp;empati=0&amp;berwujud=0');
INSERT INTO `fquery` VALUES ('14', 'pilih_handal=and&amp;pilih_tanggap=+&amp;pilih_pasti=+&amp;pilih_empati=+&amp;kehandalan=9&amp;ketanggapan=10&amp;kepastian=&amp;empati=0&amp;berwujud=0');
INSERT INTO `fquery` VALUES ('15', 'pilih_handal=+&amp;pilih_tanggap=+&amp;pilih_pasti=+&amp;pilih_empati=+&amp;kehandalan=&amp;ketanggapan=&amp;kepastian=&amp;empati=0&amp;berwujud=0');
INSERT INTO `fquery` VALUES ('16', 'pilih_handal=and&amp;pilih_tanggap=+&amp;pilih_pasti=+&amp;pilih_empati=+&amp;kehandalan=9&amp;ketanggapan=&amp;kepastian=&amp;empati=0&amp;berwujud=0');
INSERT INTO `fquery` VALUES ('17', 'pilih_handal=&amp;pilih_tanggap=0&amp;pilih_pasti=0&amp;pilih_empati=0&amp;kehandalan=0&amp;ketanggapan=0&amp;kepastian=0&amp;empati=0&amp;berwujud=0');

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'admin', 'Administrator Utama Sistem (IT Staff)');
INSERT INTO `groups` VALUES ('3', 'konsumen', 'Konsumen Perusahaan');
INSERT INTO `groups` VALUES ('4', 'perawat', 'Perawat Perusahaan');
INSERT INTO `groups` VALUES ('6', 'direktur', 'Direktur Perusahaan');
INSERT INTO `groups` VALUES ('25', 'manajer', 'Administrator Perusahaan');
INSERT INTO `groups` VALUES ('26', 'members', 'Default User Belum ada Hak Akses');

-- ----------------------------
-- Table structure for himpunan
-- ----------------------------
DROP TABLE IF EXISTS `himpunan`;
CREATE TABLE `himpunan` (
  `himpunan_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `kecewa_max` int(10) DEFAULT NULL,
  `kecewa_min` int(10) DEFAULT NULL,
  `biasa_min` int(10) DEFAULT NULL,
  `biasa_tgh` int(10) DEFAULT NULL,
  `puas_min` int(10) DEFAULT NULL,
  `puas_max` int(10) DEFAULT NULL,
  PRIMARY KEY (`himpunan_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of himpunan
-- ----------------------------
INSERT INTO `himpunan` VALUES ('1', '0', '40', '40', '65', '65', '80');

-- ----------------------------
-- Table structure for jawaban
-- ----------------------------
DROP TABLE IF EXISTS `jawaban`;
CREATE TABLE `jawaban` (
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
  KEY `dimensi_id` (`dimensi_id`),
  CONSTRAINT `jawaban_ibfk_10` FOREIGN KEY (`dimensi_id`) REFERENCES `dimensi` (`dimensi_id`),
  CONSTRAINT `jawaban_ibfk_3` FOREIGN KEY (`banksoal_id`) REFERENCES `banksoal` (`banksoal_id`) ON UPDATE CASCADE,
  CONSTRAINT `jawaban_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `jawaban_ibfk_9` FOREIGN KEY (`aturan_id`) REFERENCES `aturan` (`aturan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jawaban
-- ----------------------------
INSERT INTO `jawaban` VALUES ('121', '1', '61', '1378268023', '9', '1', '0');
INSERT INTO `jawaban` VALUES ('122', '2', '61', '1378268025', '10', '1', '0');
INSERT INTO `jawaban` VALUES ('123', '3', '61', '1378268027', '9', '2', '0');
INSERT INTO `jawaban` VALUES ('124', '4', '61', '1378268030', '10', '2', '0');
INSERT INTO `jawaban` VALUES ('125', '5', '61', '1378268032', '11', '3', '0');
INSERT INTO `jawaban` VALUES ('126', '6', '61', '1378268034', '9', '4', '0');
INSERT INTO `jawaban` VALUES ('127', '7', '61', '1378268037', '10', '4', '0');
INSERT INTO `jawaban` VALUES ('128', '8', '61', '1378268039', '9', '5', '0');
INSERT INTO `jawaban` VALUES ('129', '9', '61', '1378268042', '11', '5', '0');
INSERT INTO `jawaban` VALUES ('130', '10', '61', '1378268045', '9', '3', '0');
INSERT INTO `jawaban` VALUES ('131', '1', '66', '1378268278', '10', '1', '0');
INSERT INTO `jawaban` VALUES ('132', '2', '66', '1378268280', '11', '1', '0');
INSERT INTO `jawaban` VALUES ('133', '3', '66', '1378268282', '10', '2', '0');
INSERT INTO `jawaban` VALUES ('134', '4', '66', '1378268284', '9', '2', '0');
INSERT INTO `jawaban` VALUES ('135', '5', '66', '1378268287', '11', '3', '0');
INSERT INTO `jawaban` VALUES ('136', '6', '66', '1378268289', '10', '4', '0');
INSERT INTO `jawaban` VALUES ('137', '7', '66', '1378268291', '11', '4', '0');
INSERT INTO `jawaban` VALUES ('138', '8', '66', '1378268293', '9', '5', '0');
INSERT INTO `jawaban` VALUES ('139', '9', '66', '1378268295', '10', '5', '0');
INSERT INTO `jawaban` VALUES ('140', '10', '66', '1378268298', '9', '3', '0');
INSERT INTO `jawaban` VALUES ('141', '1', '65', '1378268441', '10', '1', '0');
INSERT INTO `jawaban` VALUES ('142', '2', '65', '1378268443', '11', '1', '0');
INSERT INTO `jawaban` VALUES ('143', '3', '65', '1378268444', '9', '2', '0');
INSERT INTO `jawaban` VALUES ('144', '4', '65', '1378268446', '10', '2', '0');
INSERT INTO `jawaban` VALUES ('145', '5', '65', '1378268448', '9', '3', '0');
INSERT INTO `jawaban` VALUES ('146', '6', '65', '1378268450', '10', '4', '0');
INSERT INTO `jawaban` VALUES ('147', '7', '65', '1378268451', '11', '4', '0');
INSERT INTO `jawaban` VALUES ('148', '8', '65', '1378268453', '9', '5', '0');
INSERT INTO `jawaban` VALUES ('149', '9', '65', '1378268455', '9', '5', '0');
INSERT INTO `jawaban` VALUES ('150', '10', '65', '1378268457', '10', '3', '0');
INSERT INTO `jawaban` VALUES ('151', '1', '62', '1378269273', '9', '1', '0');
INSERT INTO `jawaban` VALUES ('152', '2', '62', '1378269275', '11', '1', '0');
INSERT INTO `jawaban` VALUES ('153', '3', '62', '1378269282', '11', '2', '0');
INSERT INTO `jawaban` VALUES ('154', '4', '62', '1378269283', '10', '2', '0');
INSERT INTO `jawaban` VALUES ('155', '5', '62', '1378269285', '9', '3', '0');
INSERT INTO `jawaban` VALUES ('156', '6', '62', '1378269287', '10', '4', '0');
INSERT INTO `jawaban` VALUES ('157', '7', '62', '1378269290', '11', '4', '0');
INSERT INTO `jawaban` VALUES ('158', '8', '62', '1378269293', '9', '5', '0');
INSERT INTO `jawaban` VALUES ('159', '9', '62', '1378269295', '10', '5', '0');
INSERT INTO `jawaban` VALUES ('160', '10', '62', '1378269298', '10', '3', '0');
INSERT INTO `jawaban` VALUES ('161', '1', '75', '1378299503', '9', '1', '0');
INSERT INTO `jawaban` VALUES ('162', '2', '75', '1378299505', '10', '1', '0');
INSERT INTO `jawaban` VALUES ('163', '3', '75', '1378299507', '10', '2', '0');
INSERT INTO `jawaban` VALUES ('164', '4', '75', '1378299509', '9', '2', '0');
INSERT INTO `jawaban` VALUES ('165', '5', '75', '1378299510', '10', '3', '0');
INSERT INTO `jawaban` VALUES ('166', '6', '75', '1378299511', '9', '4', '0');
INSERT INTO `jawaban` VALUES ('167', '7', '75', '1378299513', '10', '4', '0');
INSERT INTO `jawaban` VALUES ('168', '8', '75', '1378299514', '9', '5', '0');
INSERT INTO `jawaban` VALUES ('169', '9', '75', '1378299517', '10', '5', '0');
INSERT INTO `jawaban` VALUES ('170', '10', '75', '1378299520', '9', '3', '0');
INSERT INTO `jawaban` VALUES ('171', '1', '61', '1379033822', '11', '1', '0');
INSERT INTO `jawaban` VALUES ('172', '1', '77', '1379385473', '11', '1', '1');
INSERT INTO `jawaban` VALUES ('174', '3', '77', '1379385479', '11', '2', '1');
INSERT INTO `jawaban` VALUES ('176', '5', '77', '1379385484', '11', '3', '1');
INSERT INTO `jawaban` VALUES ('177', '6', '77', '1379385489', '11', '4', '1');
INSERT INTO `jawaban` VALUES ('179', '8', '77', '1379385499', '11', '5', '0');
INSERT INTO `jawaban` VALUES ('181', '10', '77', '1379385505', '11', '3', '1');
INSERT INTO `jawaban` VALUES ('182', '1', '76', '1379386838', '11', '1', '1');
INSERT INTO `jawaban` VALUES ('183', '2', '76', '1379387043', '11', '1', '1');
INSERT INTO `jawaban` VALUES ('184', '3', '76', '1379387052', '10', '2', '1');
INSERT INTO `jawaban` VALUES ('185', '4', '76', '1379387056', '10', '2', '1');
INSERT INTO `jawaban` VALUES ('186', '5', '76', '1379387063', '11', '3', '1');
INSERT INTO `jawaban` VALUES ('187', '6', '76', '1379387067', '11', '4', '1');
INSERT INTO `jawaban` VALUES ('188', '7', '76', '1379387071', '10', '4', '1');
INSERT INTO `jawaban` VALUES ('189', '8', '76', '1379387077', '10', '5', '1');
INSERT INTO `jawaban` VALUES ('190', '9', '76', '1379387080', '10', '5', '1');
INSERT INTO `jawaban` VALUES ('191', '10', '76', '1379387085', '11', '3', '1');

-- ----------------------------
-- Table structure for kesimpulan
-- ----------------------------
DROP TABLE IF EXISTS `kesimpulan`;
CREATE TABLE `kesimpulan` (
  `kesimpulan_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `kesimpulan` text NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `dimensi` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`kesimpulan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kesimpulan
-- ----------------------------
INSERT INTO `kesimpulan` VALUES ('19', 'Tingkatkan pelayanan terhadap konsumen, Tingkatkan lagi ketanggapan atau tingkatkan respon anda', '1', 'kehandalan,ketanggapan');

-- ----------------------------
-- Table structure for konsumen
-- ----------------------------
DROP TABLE IF EXISTS `konsumen`;
CREATE TABLE `konsumen` (
  `konsumen_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `foto` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT 'none.jpg',
  `user_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`konsumen_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `konsumen_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of konsumen
-- ----------------------------
INSERT INTO `konsumen` VALUES ('1', 'none.jpg', '61');
INSERT INTO `konsumen` VALUES ('2', 'none.jpg', '62');
INSERT INTO `konsumen` VALUES ('3', 'none.jpg', '65');
INSERT INTO `konsumen` VALUES ('4', 'none.jpg', '66');
INSERT INTO `konsumen` VALUES ('5', 'none.jpg', '73');
INSERT INTO `konsumen` VALUES ('6', 'none.jpg', '75');
INSERT INTO `konsumen` VALUES ('7', 'none.jpg', '76');
INSERT INTO `konsumen` VALUES ('8', 'none.jpg', '77');
INSERT INTO `konsumen` VALUES ('9', 'none.jpg', '78');
INSERT INTO `konsumen` VALUES ('10', 'none.jpg', '74');

-- ----------------------------
-- Table structure for mu
-- ----------------------------
DROP TABLE IF EXISTS `mu`;
CREATE TABLE `mu` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `MuKecewa` double NOT NULL DEFAULT '0',
  `MuBiasa` double NOT NULL DEFAULT '0',
  `MuPuas` double NOT NULL DEFAULT '0',
  `MuFire` float NOT NULL,
  `user_id` mediumint(8) unsigned DEFAULT NULL,
  `dimensi_id` mediumint(9) DEFAULT NULL,
  `banksoal_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `dimensi_id` (`dimensi_id`),
  KEY `banksoal_id` (`banksoal_id`),
  CONSTRAINT `mu_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `mu_ibfk_2` FOREIGN KEY (`dimensi_id`) REFERENCES `dimensi` (`dimensi_id`),
  CONSTRAINT `mu_ibfk_3` FOREIGN KEY (`banksoal_id`) REFERENCES `banksoal` (`banksoal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mu
-- ----------------------------
INSERT INTO `mu` VALUES ('12', '0.13', '0.87', '0', '0.617', '61', '1', '1');
INSERT INTO `mu` VALUES ('13', '0.5', '0.5', '0', '0.525', '65', '2', '3');
INSERT INTO `mu` VALUES ('14', '0', '0.5', '0.5', '0.725', '66', '1', '1');
INSERT INTO `mu` VALUES ('15', '0.2', '0.8', '0', '0.6', '62', '1', '1');
INSERT INTO `mu` VALUES ('16', '0.5', '0.5', '0', '0.525', '75', '1', '1');
INSERT INTO `mu` VALUES ('17', '0', '0.5', '0.5', '0.725', '65', '1', '1');
INSERT INTO `mu` VALUES ('18', '0.5', '0.5', '0', '0.525', '75', '2', '4');
INSERT INTO `mu` VALUES ('19', '0', '0.5', '0.5', '0.725', '62', '2', '4');
INSERT INTO `mu` VALUES ('20', '0.5', '0.5', '0', '0.525', '66', '2', '4');
INSERT INTO `mu` VALUES ('21', '0.5', '0.5', '0', '0.525', '65', '3', '5');
INSERT INTO `mu` VALUES ('22', '0.5', '0.5', '0', '0.525', '61', '2', '3');
INSERT INTO `mu` VALUES ('23', '0.5', '0.5', '0', '0.525', '75', '3', '10');
INSERT INTO `mu` VALUES ('24', '0.5', '0.5', '0', '0.525', '62', '3', '5');
INSERT INTO `mu` VALUES ('25', '0.2', '0.8', '0', '0.6', '66', '3', '10');
INSERT INTO `mu` VALUES ('26', '0.2', '0.8', '0', '0.6', '61', '3', '10');
INSERT INTO `mu` VALUES ('27', '0', '0.5', '0.5', '0.725', '65', '4', '6');
INSERT INTO `mu` VALUES ('28', '0.5', '0.5', '0', '0.525', '75', '4', '6');
INSERT INTO `mu` VALUES ('29', '0', '0.5', '0.5', '0.725', '62', '4', '6');
INSERT INTO `mu` VALUES ('30', '0', '0.5', '0.5', '0.725', '66', '4', '6');
INSERT INTO `mu` VALUES ('31', '0.5', '0.5', '0', '0.525', '61', '4', '6');
INSERT INTO `mu` VALUES ('32', '1', '0', '0', '0.4', '65', '5', '8');
INSERT INTO `mu` VALUES ('33', '0.5', '0.5', '0', '0.525', '75', '5', '8');
INSERT INTO `mu` VALUES ('34', '0.5', '0.5', '0', '0.525', '62', '5', '8');
INSERT INTO `mu` VALUES ('35', '0.2', '0.8', '0', '0.6', '61', '5', '8');
INSERT INTO `mu` VALUES ('36', '0.5', '0.5', '0', '0.525', '66', '5', '8');
INSERT INTO `mu` VALUES ('37', '0', '0', '1', '0.8', '77', '5', '8');

-- ----------------------------
-- Table structure for perawat
-- ----------------------------
DROP TABLE IF EXISTS `perawat`;
CREATE TABLE `perawat` (
  `perawat_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `foto` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT 'none.jpg',
  `ijasah` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT 'none.jpg',
  `user_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`perawat_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `perawat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of perawat
-- ----------------------------
INSERT INTO `perawat` VALUES ('1', 'none.jpg', 'none.jpg', '59');
INSERT INTO `perawat` VALUES ('2', 'none.jpg', 'none.jpg', '63');
INSERT INTO `perawat` VALUES ('3', 'none.jpg', 'none.jpg', '68');
INSERT INTO `perawat` VALUES ('4', 'none.jpg', 'none.jpg', '70');
INSERT INTO `perawat` VALUES ('5', 'none.jpg', 'none.jpg', '60');
INSERT INTO `perawat` VALUES ('6', 'none.jpg', 'none.jpg', '69');
INSERT INTO `perawat` VALUES ('7', 'none.jpg', 'none.jpg', '70');
INSERT INTO `perawat` VALUES ('8', 'none.jpg', 'none.jpg', '71');
INSERT INTO `perawat` VALUES ('9', 'none.jpg', 'none.jpg', '72');

-- ----------------------------
-- Table structure for rawatkonsumen
-- ----------------------------
DROP TABLE IF EXISTS `rawatkonsumen`;
CREATE TABLE `rawatkonsumen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `konsumen_id` mediumint(8) unsigned NOT NULL,
  `perawat_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `konsumen_id` (`konsumen_id`),
  KEY `perawat_id` (`perawat_id`),
  CONSTRAINT `rawatkonsumen_ibfk_4` FOREIGN KEY (`konsumen_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rawatkonsumen_ibfk_5` FOREIGN KEY (`perawat_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rawatkonsumen
-- ----------------------------
INSERT INTO `rawatkonsumen` VALUES ('1', '65', '69');
INSERT INTO `rawatkonsumen` VALUES ('3', '61', '64');
INSERT INTO `rawatkonsumen` VALUES ('4', '66', '72');
INSERT INTO `rawatkonsumen` VALUES ('5', '62', '67');
INSERT INTO `rawatkonsumen` VALUES ('6', '78', '70');
INSERT INTO `rawatkonsumen` VALUES ('8', '73', '71');
INSERT INTO `rawatkonsumen` VALUES ('9', '74', '59');
INSERT INTO `rawatkonsumen` VALUES ('10', '77', '63');
INSERT INTO `rawatkonsumen` VALUES ('11', '75', '60');
INSERT INTO `rawatkonsumen` VALUES ('12', '76', '68');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
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
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('30', 0x7F000001, 'admin', 'afaed771209c36d60cf035f2b24b70c695b56480', null, 'm.desta.fadilah@gmail.com', null, null, null, null, '1372573989', '1379482811', '1', 'Ben', 'admin', 'Jakarta', '09898989', '1989-12-12', 'L', null, '0');
INSERT INTO `users` VALUES ('56', 0x7F000001, 'manajer', 'a4879a8682d338162efc9bff82f0fd7fcfcd7a28', null, 'manajer@perawatku.com', null, null, null, null, '1373425567', '1379734180', '1', 'Manajer', 'Dua', 'Add From Admin', '(898) 989-8989', '0000-00-00', 'P', null, '0');
INSERT INTO `users` VALUES ('57', 0x7F000001, 'direktur', 'f3c8ebdd95deab762d89fd3e5a5d121c28a4c826', null, 'direktur@perawatku.com', null, null, null, null, '1373425637', '1378672452', '1', 'Direktur', 'Dua', 'Add From Admin', '(898) 989-8989', '0000-00-00', 'L', null, '0');
INSERT INTO `users` VALUES ('58', 0x7F000001, 'admindua', '3b2e89dfe76bf92113d4f819ba0bcfe7eb3f8a90', null, 'admin.dua@perawatku.com', 'ea13edb3a4c5fb75b2a93f6960d31f73da814a58', null, null, null, '1373425708', '1375767228', '0', 'Admin', 'Dua', 'Add From Admin page', '(778) 787-8787', '0000-00-00', 'P', null, '0');
INSERT INTO `users` VALUES ('59', 0x7F000001, 'quinsa', 'd0cff6bc1c753127818e6fedf71e9bdae6591da6', null, 'quinsa@perawatku.com', null, null, null, null, '1373426468', '1376456852', '1', 'quinsa', 'sarah', 'Jl. Pondok Pinang 5 Rt 007 / 02 ', '(898) 989-8988', '1990-01-01', 'L', 'ortu', '0');
INSERT INTO `users` VALUES ('60', 0x7F000001, 'carisa', '8ba30e0fef834632c9dda8ef2911328ef9924462', null, 'carisa@perawatku.com', null, null, null, null, '1373428504', '1378729075', '1', 'carisa', 'doanks', 'Jl.  Pondok Pinang 6 Rt 009/02 No. 38', '(898) 989-8989', '1990-08-14', 'L', 'ortu', '0');
INSERT INTO `users` VALUES ('61', 0x7F000001, 'regita', 'c967ff20786b069ac77e519913b155c7aee1b5b8', null, 'regita.sari@gmail.com', null, null, null, null, '1373429658', '1379389819', '1', 'regita', 'sari', 'Jl. Pondok Ranji Rt 03/02  Ciputat', '(121) 212-1212', '0000-00-00', 'L', null, '0');
INSERT INTO `users` VALUES ('62', 0x7F000001, 'lazia', 'c7dd293489d5ff98c375a5505e50160745fe241f', null, 'lazia@perawatku.com', null, null, null, null, '1373429795', '1378269268', '1', 'lazia', 'lita', 'Jl. Pondok Ranji Rt 04/02 Ciputat Timur', '(121) 212-1212', '1977-08-20', 'L', null, '0');
INSERT INTO `users` VALUES ('63', 0x7F000001, 'fardan', '321266a102fdf7c4e5428fed35edbc5ffe226a7b', null, 'abg@perawatku.com', null, null, null, null, '1373430280', '1379277734', '1', 'fardan', 'gustaf', 'Jl. Pondok Pinang 6 Rt 010/02 No. 31 Keb-lama', '(787) 878-7878', '1991-08-06', 'L', 'balita', '0');
INSERT INTO `users` VALUES ('64', 0x7F000001, 'yekizi', 'a0eca4b58d9472b00289d4cf2cc7e385f034dd4f', null, 'yekizi@perawatku.com', null, null, null, null, '1373430312', '1379061887', '1', 'yekizi', 'sharma', 'Jl . Program Dalam Rt 002/4 No. 22 Pancoran Mas Depok', '(898) 988-9898', '2013-08-21', 'L', 'balita', '0');
INSERT INTO `users` VALUES ('65', 0x7F000001, 'disar', 'b562c34a4fc6f30a7433458b149e1a96c434f562', null, 'disar.ayu@yahoo.com', null, null, null, null, '1373430372', '1378729168', '1', 'disar', 'ayus', 'Jl. Pondok Pinang  5 Rt 008/02 ', '(898) 888-7878', '1976-08-05', 'L', null, '0');
INSERT INTO `users` VALUES ('66', 0x7F000001, 'muhamad', '48a60fc1cd43be8f3fba01f499f4d434482d3a73', null, 'muhamad.ss@yahoo.co.id', null, null, null, null, '1374247493', '1378935671', '1', 'muhamad', 'zikri', 'Jl. Pondok Ranji Rt 03/04 Ciputat', '(343) 434-3434', '2013-08-06', 'P', null, '0');
INSERT INTO `users` VALUES ('67', 0x7F000001, 'salsabilla', 'bf59aba2f196045275a4c8790091e9c775aa97c5', null, 'salsabilla@perawatku.com', null, null, null, null, '1374630143', '1376364577', '1', 'salsabilla', 'syifa', 'Jl. Pondok Ranji Rt 01 / 02 Ciputat Timur', '(621) 8967-7786', '1990-08-26', 'P', 'balita', '0');
INSERT INTO `users` VALUES ('68', 0x7F000001, 'siska', '478d8baf22b44ae669225d7d25d8e798b515a97f', null, 'siska@perawatku.com', null, null, null, null, '1374630172', '1379387133', '1', 'siska', 'aulia', 'Jl. Nusajaya No.3 Pondok ranji ,Tangerang Selatan', '(343) 434-3434', '1990-08-14', 'L', 'adk', '0');
INSERT INTO `users` VALUES ('69', 0x7F000001, 'satrio', '09d87a20ff6a75d5bd30b3fe6355617648c39028', null, 'satrio@perawatku.com', null, null, null, null, '1374630197', '1374630197', '1', 'satrio', 'wibowo', 'Jl. Gotong Royong II Rt 07/06 No.2 Gandaria Utara, Jaksel', '(454) 888-8888', '1991-08-13', 'L', 'ortu', '0');
INSERT INTO `users` VALUES ('70', 0x7F000001, 'fikri', 'a62df90f4cf1e77bd2a4920b14f379fde8c6ee78', null, 'fikri@perawatku.com', null, null, null, null, '1374630246', '1379277706', '1', 'fikri', 'ariansyah', 'Jl. Cagaralam Selatan Rt 002/ 5  Pancoran Mas', '(454) 888-8888', '2013-02-13', 'L', 'balita', '0');
INSERT INTO `users` VALUES ('71', 0x7F000001, 'aulia', '0bb1f001d4efff616f12b754eb6571b2cc188789', null, 'aulia@perawatku.com', null, null, null, null, '1374630294', '1376976686', '1', 'aulia', 'julia', 'Jl. Nusajaya Rt 02/04 Kampung Bulakan', '(898) 989-8989', '1992-08-20', 'L', 'balita', '0');
INSERT INTO `users` VALUES ('72', 0x7F000001, 'nukes', 'c54879c76051612563fbe12d865079d5132ec8a0', null, 'nukes@perawatku.com', null, null, null, null, '1374630342', '1379277672', '1', 'nuke', 'aprianti', 'Jl. Pondok Ranji Rt 04/02 (Kontrakan Pak Dayat) Ciputat', '(998) 989-8989', '1981-03-08', 'P', 'ortu', '0');
INSERT INTO `users` VALUES ('73', 0x7F000001, 'aditia', '16224c1077e3cef91e77e2de90600e1254a16244', null, 'aditia.prasetyo@hotmail.com', null, null, null, null, '1374630423', '1378246479', '1', 'aditia', 'prasetyo', 'Jl. H. Jian Rt01/07 Jakarta', '(787) 878-7878', '1965-06-12', 'L', null, '0');
INSERT INTO `users` VALUES ('74', 0x7F000001, 'binetha', 'a4382aab316ce051fa32f6be1a9b00caa60dd0ec', null, 'binetha@gmail.com', null, null, null, null, '1374630452', '1378943274', '1', 'Binetha', 'Sona', 'Jl. H. Jian 2 Rt002/7 No.25 Cipete Utara', '(989) 898-9898', '1955-08-12', 'L', null, '0');
INSERT INTO `users` VALUES ('75', 0x7F000001, 'hafiza', '72fb57b21c3d93570a9eecad3910ff4fb3d30a08', null, 'hafiza.hazna@yahoo.com', null, null, null, null, '1374630482', '1378299498', '1', 'hafiza', 'haznah', 'Jl. Sawo 2 Rt 008/002 No.13 Cipete Utara Jakarta Selatan', '(899) 787-9797', '1976-04-10', 'P', null, '0');
INSERT INTO `users` VALUES ('76', 0x7F000001, 'fendi', '398eef49ba7f12d980413f0870b8c90c0f379c0e', null, 'fendi.wardana@gmail.com', null, null, null, null, '1374630504', '1379387205', '1', 'fendi', 'wardana', 'Jl. Pondok Ranji Rt 04/02 (Kontrakan Pak Dayat) Ciputat Timur', '(898) 989-8989', '1988-08-12', 'L', null, '10');
INSERT INTO `users` VALUES ('77', 0x7F000001, 'marvel', '3c2382f6ebca01888eedd22a3ab43702c8533507', null, 'marvel.john@gmail.com', null, null, null, null, '1374630531', '1379385465', '1', 'Marvel', 'saja', 'Jl. Pondok Ranji Rt 04/02 (Kontrakan Pak Dayat) Ciputat Timur', '(799) 898-9898', '1957-02-21', 'L', null, '0');
INSERT INTO `users` VALUES ('78', 0x7F000001, 'sifar', '34cbf2bc2c31e5e6b6e1b1fabea4847884d6bc4b', null, 'siti.sifar@hotmail.com', null, null, null, null, '1374630554', '1378637770', '1', 'siti', 'lestari', 'Jl. Pondok Ranji Rt 06/02 (Kontrakan Pak Dayat) Ciputat', '(898) 989-8989', '2013-01-06', 'L', null, '0');
INSERT INTO `users` VALUES ('79', 0x7F000001, 'pengguna', '2f74d1e9e990c4ab72a4778d680d45196f9c9932', null, 'pengguna@user.com', null, null, null, null, '1374643704', '1374643704', '1', 'pengguna', 'users', 'pengguna users biasa', '(998) 989-899_', '0000-00-00', 'P', null, '0');
INSERT INTO `users` VALUES ('80', 0x7F000001, 'penggunamanajerlagi', '72093421dbd06dcee1a8d69e7cd0ffa1e9c3b789', null, 'pengguna@lagi.com', null, null, null, null, '1374643897', '1374643897', '1', 'Penggunalagi', 'lagilagi', 'pengguna lagi dan lagi', '(898) 989-8989', '0000-00-00', 'P', null, '0');

-- ----------------------------
-- Table structure for users_groups
-- ----------------------------
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users_groups
-- ----------------------------
INSERT INTO `users_groups` VALUES ('128', '30', '1');
INSERT INTO `users_groups` VALUES ('137', '56', '25');
INSERT INTO `users_groups` VALUES ('138', '57', '6');
INSERT INTO `users_groups` VALUES ('139', '58', '1');
INSERT INTO `users_groups` VALUES ('142', '61', '3');
INSERT INTO `users_groups` VALUES ('144', '63', '4');
INSERT INTO `users_groups` VALUES ('163', '79', '6');
INSERT INTO `users_groups` VALUES ('167', '80', '25');
INSERT INTO `users_groups` VALUES ('168', '60', '4');
INSERT INTO `users_groups` VALUES ('170', '66', '3');
INSERT INTO `users_groups` VALUES ('171', '68', '4');
INSERT INTO `users_groups` VALUES ('172', '67', '4');
INSERT INTO `users_groups` VALUES ('173', '65', '3');
INSERT INTO `users_groups` VALUES ('174', '62', '3');
INSERT INTO `users_groups` VALUES ('175', '64', '4');
INSERT INTO `users_groups` VALUES ('176', '78', '3');
INSERT INTO `users_groups` VALUES ('177', '76', '3');
INSERT INTO `users_groups` VALUES ('178', '69', '4');
INSERT INTO `users_groups` VALUES ('179', '70', '4');
INSERT INTO `users_groups` VALUES ('180', '71', '4');
INSERT INTO `users_groups` VALUES ('181', '72', '4');
INSERT INTO `users_groups` VALUES ('182', '73', '3');
INSERT INTO `users_groups` VALUES ('183', '74', '3');
INSERT INTO `users_groups` VALUES ('184', '75', '3');
INSERT INTO `users_groups` VALUES ('185', '59', '4');
INSERT INTO `users_groups` VALUES ('187', '77', '3');
INSERT INTO `users_groups` VALUES ('188', '81', '4');
INSERT INTO `users_groups` VALUES ('189', '82', '4');
