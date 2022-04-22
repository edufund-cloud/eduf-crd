-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.22-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for edufund_crd
CREATE DATABASE IF NOT EXISTS `edufund_crd` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `edufund_crd`;

-- Dumping structure for table edufund_crd.apply
CREATE TABLE IF NOT EXISTS `apply` (
  `data_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID` char(50) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `apply_date` date DEFAULT NULL,
  `product` varchar(100) DEFAULT NULL,
  `pic` varchar(100) DEFAULT NULL,
  `data_status` char(50) DEFAULT NULL,
  `data_active` tinyint(1) DEFAULT NULL,
  `data_create` datetime DEFAULT NULL,
  `user_create` int(11) DEFAULT NULL,
  `data_update` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  PRIMARY KEY (`data_id`),
  KEY `Index 2` (`ID`,`full_name`,`apply_date`,`product`,`pic`,`data_status`,`data_active`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edufund_crd.apply: ~0 rows (approximately)
/*!40000 ALTER TABLE `apply` DISABLE KEYS */;
/*!40000 ALTER TABLE `apply` ENABLE KEYS */;

-- Dumping structure for table edufund_crd.apply_address
CREATE TABLE IF NOT EXISTS `apply_address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `data_id` int(11) DEFAULT NULL,
  `alamat` tinytext DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kelurahan` varchar(50) DEFAULT NULL,
  `kode_pos` char(8) DEFAULT NULL,
  `status_tinggal` varchar(50) DEFAULT NULL,
  `lama_tinggal_tahun` char(4) DEFAULT NULL,
  `lama_tinggal_bulan` char(2) DEFAULT NULL,
  PRIMARY KEY (`address_id`),
  KEY `Index 2` (`data_id`,`provinsi`,`kota`,`kecamatan`,`kelurahan`,`kode_pos`,`status_tinggal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edufund_crd.apply_address: ~0 rows (approximately)
/*!40000 ALTER TABLE `apply_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `apply_address` ENABLE KEYS */;

-- Dumping structure for table edufund_crd.apply_attach
CREATE TABLE IF NOT EXISTS `apply_attach` (
  `attach_id` int(11) NOT NULL AUTO_INCREMENT,
  `data_id` int(11) DEFAULT 0,
  `description` tinytext DEFAULT NULL,
  `attach_url` tinytext DEFAULT NULL,
  `data_update` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  PRIMARY KEY (`attach_id`),
  KEY `Index 2` (`data_id`,`description`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edufund_crd.apply_attach: ~0 rows (approximately)
/*!40000 ALTER TABLE `apply_attach` DISABLE KEYS */;
/*!40000 ALTER TABLE `apply_attach` ENABLE KEYS */;

-- Dumping structure for table edufund_crd.apply_course
CREATE TABLE IF NOT EXISTS `apply_course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `data_id` int(11) DEFAULT 0,
  `nama_penyelenggara` varchar(255) DEFAULT NULL,
  `nama_program` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` char(25) DEFAULT NULL,
  `tanggal_pembayaran` date DEFAULT NULL,
  `total_pembiayaan` decimal(20,2) DEFAULT NULL,
  `uang_muka` decimal(20,2) DEFAULT NULL,
  `tenor` int(4) DEFAULT NULL,
  `cicilan_bulan` decimal(20,2) DEFAULT NULL,
  `bank_tujuan` varchar(100) DEFAULT NULL,
  `nama_rekening` varchar(100) DEFAULT NULL,
  `nomor_rekening` char(50) DEFAULT NULL,
  PRIMARY KEY (`course_id`),
  KEY `Index 2` (`data_id`,`nama_penyelenggara`,`nama_program`,`total_pembiayaan`,`tenor`,`bank_tujuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edufund_crd.apply_course: ~0 rows (approximately)
/*!40000 ALTER TABLE `apply_course` DISABLE KEYS */;
/*!40000 ALTER TABLE `apply_course` ENABLE KEYS */;

-- Dumping structure for table edufund_crd.apply_emergency
CREATE TABLE IF NOT EXISTS `apply_emergency` (
  `emergency_id` int(11) NOT NULL AUTO_INCREMENT,
  `data_id` int(11) NOT NULL DEFAULT 0,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `nomor_telepon` char(50) DEFAULT NULL,
  `hubungan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`emergency_id`),
  KEY `Index 2` (`data_id`,`hubungan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edufund_crd.apply_emergency: ~0 rows (approximately)
/*!40000 ALTER TABLE `apply_emergency` DISABLE KEYS */;
/*!40000 ALTER TABLE `apply_emergency` ENABLE KEYS */;

-- Dumping structure for table edufund_crd.apply_kta
CREATE TABLE IF NOT EXISTS `apply_kta` (
  `kta_id` int(11) NOT NULL AUTO_INCREMENT,
  `data_id` int(11) DEFAULT 0,
  `total_pembiayaan` decimal(20,2) DEFAULT NULL,
  `tenor` int(3) DEFAULT NULL,
  `biaya_admin` decimal(20,2) DEFAULT NULL,
  `total_pencairan` decimal(20,2) DEFAULT NULL,
  `cicilan_bulan` decimal(20,2) DEFAULT NULL,
  `bank_tujuan` varchar(50) DEFAULT NULL,
  `nama_rekening` varchar(50) DEFAULT NULL,
  `nomor_rekening` char(50) DEFAULT NULL,
  PRIMARY KEY (`kta_id`),
  KEY `Index 2` (`data_id`,`total_pembiayaan`,`tenor`,`bank_tujuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edufund_crd.apply_kta: ~0 rows (approximately)
/*!40000 ALTER TABLE `apply_kta` DISABLE KEYS */;
/*!40000 ALTER TABLE `apply_kta` ENABLE KEYS */;

-- Dumping structure for table edufund_crd.apply_note
CREATE TABLE IF NOT EXISTS `apply_note` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `data_id` int(11) DEFAULT NULL,
  `status` char(15) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `data_update` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `user_group` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`note_id`),
  KEY `Index 2` (`data_id`,`status`,`data_update`,`user_group`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edufund_crd.apply_note: ~0 rows (approximately)
/*!40000 ALTER TABLE `apply_note` DISABLE KEYS */;
/*!40000 ALTER TABLE `apply_note` ENABLE KEYS */;

-- Dumping structure for table edufund_crd.apply_personal
CREATE TABLE IF NOT EXISTS `apply_personal` (
  `personal_id` int(11) NOT NULL AUTO_INCREMENT,
  `data_id` int(11) DEFAULT 0,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` char(50) DEFAULT NULL,
  `status_perkawinan` char(50) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `pendidikan_terakhir` varchar(50) DEFAULT NULL,
  `nik` char(50) DEFAULT NULL,
  `npwp` char(50) DEFAULT NULL,
  `no_telepon` char(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nama_pasangan` varchar(50) DEFAULT NULL,
  `tempat_lahir_pasangan` varchar(100) DEFAULT NULL,
  `tanggal_lahir_pasangan` date DEFAULT NULL,
  `agama_pasangan` varchar(50) DEFAULT NULL,
  `jenis_kelamin_pasangan` varchar(50) DEFAULT NULL,
  `pendidikan_terakhir_pasangan` varchar(50) DEFAULT NULL,
  `status_perkawinan_pasangan` char(50) DEFAULT NULL,
  `nik_pasangan` char(50) DEFAULT NULL,
  `npwp_pasangan` char(50) DEFAULT NULL,
  `no_telepon_pasangan` char(50) DEFAULT NULL,
  `email_pasangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`personal_id`),
  KEY `Index 2` (`data_id`,`nik`,`npwp`,`no_telepon`,`email`) USING BTREE,
  KEY `Index 3` (`nik_pasangan`,`personal_id`,`no_telepon_pasangan`,`email_pasangan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edufund_crd.apply_personal: ~0 rows (approximately)
/*!40000 ALTER TABLE `apply_personal` DISABLE KEYS */;
/*!40000 ALTER TABLE `apply_personal` ENABLE KEYS */;

-- Dumping structure for table edufund_crd.apply_profession
CREATE TABLE IF NOT EXISTS `apply_profession` (
  `profession_id` int(11) NOT NULL AUTO_INCREMENT,
  `data_id` int(11) DEFAULT 0,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `bidang` varchar(255) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `lama_bekerja_tahun` char(4) DEFAULT NULL,
  `lama_bekerja_bulan` char(2) DEFAULT NULL,
  `penghasilan` decimal(20,2) DEFAULT NULL,
  `nama_kantor` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` char(50) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kelurahan` varchar(100) DEFAULT NULL,
  `kode_pos` char(8) DEFAULT NULL,
  PRIMARY KEY (`profession_id`),
  KEY `Index 2` (`data_id`,`pekerjaan`,`bidang`,`status`,`kota`,`kode_pos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edufund_crd.apply_profession: ~0 rows (approximately)
/*!40000 ALTER TABLE `apply_profession` DISABLE KEYS */;
/*!40000 ALTER TABLE `apply_profession` ENABLE KEYS */;

-- Dumping structure for table edufund_crd.gen_group
CREATE TABLE IF NOT EXISTS `gen_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `data_active` int(1) DEFAULT NULL,
  `data_create` datetime DEFAULT NULL,
  `user_create` int(11) DEFAULT NULL,
  `data_update` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  PRIMARY KEY (`group_id`),
  KEY `Index 2` (`data_active`,`description`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edufund_crd.gen_group: ~5 rows (approximately)
/*!40000 ALTER TABLE `gen_group` DISABLE KEYS */;
REPLACE INTO `gen_group` (`group_id`, `description`, `data_active`, `data_create`, `user_create`, `data_update`, `user_update`) VALUES
	(1, 'Credit Team', 1, '2022-03-22 04:03:03', 1, '2022-03-22 04:03:03', 1),
	(2, 'Marketing', 1, '2022-03-22 04:05:40', 1, '2022-03-22 04:05:40', 1),
	(3, 'Tech Team', 1, '2022-03-22 04:05:48', 1, '2022-03-22 04:05:48', 1),
	(4, 'Risk Analyst', 1, '2022-03-22 04:06:06', 1, '2022-03-22 04:06:06', 1),
	(5, 'CRO', 1, '2022-03-22 04:06:15', 1, '2022-03-22 04:06:15', 1),
	(6, 'CEO', 1, '2022-03-22 04:06:23', 1, '2022-03-22 04:06:23', 1),
	(7, 'Data Center', 1, '2022-03-24 16:48:08', 1, '2022-03-24 16:48:08', 1);
/*!40000 ALTER TABLE `gen_group` ENABLE KEYS */;

-- Dumping structure for table edufund_crd.gen_menu
CREATE TABLE IF NOT EXISTS `gen_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `menu_title` varchar(50) DEFAULT NULL,
  `menu_home` char(1) DEFAULT NULL,
  `menu_description` varchar(255) DEFAULT NULL,
  `menu_target` char(6) DEFAULT NULL,
  `menu_order` int(6) DEFAULT NULL,
  `menu_file` varchar(255) DEFAULT NULL,
  `menu_icon` varchar(255) DEFAULT NULL,
  `data_active` int(1) DEFAULT NULL,
  `data_create` datetime DEFAULT NULL,
  `user_create` int(11) DEFAULT NULL,
  `data_update` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `Index 2` (`data_active`,`parent_id`,`menu_home`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edufund_crd.gen_menu: ~22 rows (approximately)
/*!40000 ALTER TABLE `gen_menu` DISABLE KEYS */;
REPLACE INTO `gen_menu` (`menu_id`, `parent_id`, `menu_title`, `menu_home`, `menu_description`, `menu_target`, `menu_order`, `menu_file`, `menu_icon`, `data_active`, `data_create`, `user_create`, `data_update`, `user_update`) VALUES
	(1, 0, 'Dashboard', '1', 'Dashboard', 'self', 0, 'pages/dashboard/dashboard_1.php', 'fa-tachometer-alt', 1, '2022-03-11 13:51:39', 0, '2022-03-11 13:51:43', 0),
	(2, 0, 'Settings', '0', 'Settings', 'self', 1, '', 'fa-tools', 1, '2022-03-11 13:53:50', 0, '2022-03-12 00:20:06', 1),
	(3, 0, 'Credit Team', '0', 'Credit Team', 'self', 3, '', 'fa-file-signature', 1, '2022-03-11 13:56:40', 0, '2022-03-24 12:42:16', 1),
	(4, 2, 'Users', '0', 'Setting User', 'self', 3, 'pages/user/tuser.php', 'fa-user', 1, '2022-03-11 13:59:48', 0, '2022-03-12 00:20:25', 1),
	(5, 2, 'Moduls', '0', 'Setting Modul', 'self', 4, 'pages/modul/tmodul.php', 'fa-clone', 1, '2022-03-11 14:01:49', 0, '2022-03-12 00:23:07', 1),
	(7, 21, 'Import Data  <small><i>(from *.csv)</i></small>', '0', 'Import Data External Format *.csv', 'blank', 0, 'tools/import/course', 'fa-circle text-danger', 1, '2022-03-12 00:40:43', 1, '2022-03-30 10:51:10', 1),
	(8, 21, 'Data Credit', '0', 'Data Credit', 'self', 2, 'pages/mis/tapply.php', 'fa-file-alt', 1, '2022-03-12 00:45:02', 1, '2022-03-24 14:02:23', 1),
	(9, 3, 'PV Process', '0', 'PV Process', 'self', 8, 'pages/pv/tapply.php', 'fa-check-circle', 1, '2022-03-12 00:48:33', 1, '2022-03-24 18:16:33', 1),
	(10, 0, 'Marketing', '0', 'Marketing', 'self', 100, '', 'fa-bookmark', 1, '2022-03-12 00:50:44', 1, '2022-03-25 16:43:48', 1),
	(11, 10, 'Complete Data', '0', 'Complete Data', 'self', 10, 'pages/partner/tapply.php', 'fa-hourglass', 1, '2022-03-12 00:53:31', 1, '2022-03-24 18:38:12', 1),
	(12, 0, 'Data Reject', '0', 'Tech Team', 'self', 11, '', 'fa-flag', 1, '2022-03-12 00:58:04', 1, '2022-03-25 16:34:50', 1),
	(13, 12, 'Data Reject', '0', 'Data Reject', 'self', 12, 'pages/tech/tapply.php', 'fa-trash-alt', 1, '2022-03-12 00:59:24', 1, '2022-03-24 18:47:29', 1),
	(14, 0, 'Risk Analyst', '0', 'Risk Analyst', 'self', 12, '', 'fa-eye', 1, '2022-03-12 01:01:44', 1, '2022-03-25 00:03:45', 1),
	(15, 14, 'Data Analysis', '0', 'Data Analysis', 'self', 13, 'pages/analyst/tapply.php', 'fa-file', 1, '2022-03-12 01:04:18', 1, '2022-03-25 01:42:22', 1),
	(16, 0, 'CRO', '0', 'CRO Process', 'self', 14, '', 'fa-circle', 1, '2022-03-12 01:06:37', 1, '2022-03-25 00:34:01', 1),
	(17, 16, 'Recommendation', '0', 'Recommendation Process', 'self', 15, 'pages/cro/tapply.php', 'fa-edit', 1, '2022-03-12 01:08:21', 1, '2022-03-25 03:46:16', 1),
	(18, 0, 'CEO', '0', 'CEO Process', 'self', 16, '', 'fa-file', 1, '2022-03-12 12:03:36', 1, '2022-03-25 00:35:19', 1),
	(19, 2, 'Change Password', '0', 'Change Password', 'self', 18, 'pages/user/fown_password.php', '', 0, '2022-03-15 12:49:40', 1, '2022-03-15 13:01:20', 1),
	(20, 2, 'Group User', '0', 'Group User', 'self', 3, 'pages/group/tgroup.php', 'fa-flag', 1, '2022-03-22 03:44:14', 1, '2022-03-22 03:45:38', 1),
	(21, 0, 'Data Center', '0', 'Data Center', 'self', 2, '', 'fa-database', 1, '2022-03-24 12:41:49', 1, '2022-03-24 12:41:49', 1),
	(22, 21, 'Import Data  <small><i>KTA</i></small>', '0', 'Import Data External KTA', 'blank', 1, 'tools/import/xcrs', 'fa-circle text-warning', 0, '2022-03-24 12:49:23', 1, '2022-03-30 10:50:21', 1),
	(23, 3, 'Data Pefindo', '0', 'Cek Data Pefindo', 'self', 0, 'pages/pefindo/tapply.php', 'fa-check-circle', 1, '2022-03-24 13:25:53', 1, '2022-03-24 17:31:17', 1),
	(24, 18, 'Approval Request', '0', 'Approval Request', 'self', 0, 'pages/ceo/tapply.php', 'fa-check-circle', 1, '2022-03-25 03:46:43', 1, '2022-03-25 03:46:43', 1);
/*!40000 ALTER TABLE `gen_menu` ENABLE KEYS */;

-- Dumping structure for table edufund_crd.gen_menu_access
CREATE TABLE IF NOT EXISTS `gen_menu_access` (
  `access_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT 0,
  `menu_id` tinytext DEFAULT NULL,
  `data_active` int(1) DEFAULT 0,
  `data_create` datetime DEFAULT NULL,
  `user_create` int(11) DEFAULT NULL,
  `data_update` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  PRIMARY KEY (`access_id`),
  KEY `Index 2` (`user_id`,`data_active`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edufund_crd.gen_menu_access: ~49 rows (approximately)
/*!40000 ALTER TABLE `gen_menu_access` DISABLE KEYS */;
REPLACE INTO `gen_menu_access` (`access_id`, `user_id`, `menu_id`, `data_active`, `data_create`, `user_create`, `data_update`, `user_update`) VALUES
	(1, 1, '1', 1, '2022-03-11 14:02:34', 0, '2022-03-11 14:02:38', 0),
	(2, 1, '2', 1, '2022-03-11 14:03:03', 0, '2022-03-25 03:46:53', 1),
	(3, 1, '3', 1, '2022-03-11 14:03:24', 0, '2022-03-25 03:46:53', 1),
	(4, 1, '4', 1, '2022-03-11 14:04:16', 0, '2022-03-25 03:46:53', 1),
	(5, 1, '5', 1, '2022-03-11 14:04:54', 0, '2022-03-25 03:46:53', 1),
	(6, 2, '2', 1, '2022-03-11 23:47:18', 1, '2022-03-11 23:48:25', 1),
	(7, 2, '3', 1, '2022-03-11 23:47:18', 1, '2022-03-11 23:48:25', 1),
	(8, 2, '4', 0, '2022-03-11 23:47:18', 1, '2022-03-11 23:48:25', 1),
	(9, 2, '5', 1, '2022-03-11 23:47:18', 1, '2022-03-11 23:48:25', 1),
	(10, 1, '6', 1, '2022-03-12 00:17:06', 1, '2022-03-12 00:17:06', 1),
	(11, 1, '7', 1, '2022-03-12 00:45:10', 1, '2022-03-25 03:46:53', 1),
	(12, 1, '8', 1, '2022-03-12 00:45:10', 1, '2022-03-25 03:46:53', 1),
	(13, 1, '9', 1, '2022-03-12 00:48:39', 1, '2022-03-25 03:46:53', 1),
	(14, 1, '10', 1, '2022-03-12 00:53:38', 1, '2022-03-25 03:46:53', 1),
	(15, 1, '11', 1, '2022-03-12 00:53:38', 1, '2022-03-25 03:46:53', 1),
	(16, 1, '12', 1, '2022-03-12 00:59:35', 1, '2022-03-25 03:46:53', 1),
	(17, 1, '13', 1, '2022-03-12 00:59:35', 1, '2022-03-25 03:46:53', 1),
	(18, 1, '14', 1, '2022-03-12 01:08:34', 1, '2022-03-25 03:46:53', 1),
	(19, 1, '15', 1, '2022-03-12 01:08:34', 1, '2022-03-25 03:46:53', 1),
	(20, 1, '16', 1, '2022-03-12 01:08:34', 1, '2022-03-25 03:46:53', 1),
	(21, 1, '17', 1, '2022-03-12 01:08:34', 1, '2022-03-25 03:46:53', 1),
	(22, 1, '18', 1, '2022-03-15 12:49:49', 1, '2022-03-25 03:46:53', 1),
	(23, 1, '19', 1, '2022-03-15 12:49:49', 1, '2022-03-15 12:49:49', 1),
	(24, 1, '20', 1, '2022-03-22 03:44:27', 1, '2022-03-25 03:46:53', 1),
	(25, 1, '21', 1, '2022-03-24 12:45:51', 1, '2022-03-25 03:46:53', 1),
	(26, 1, '22', 1, '2022-03-24 12:50:06', 1, '2022-03-25 03:46:53', 1),
	(27, 1, '23', 1, '2022-03-24 13:26:00', 1, '2022-03-25 03:46:53', 1),
	(28, 1, '24', 1, '2022-03-25 03:46:53', 1, '2022-03-25 03:46:53', 1),
	(29, 11, '2', 0, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(30, 11, '21', 0, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(31, 11, '3', 1, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(32, 11, '10', 0, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(33, 11, '12', 0, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(34, 11, '14', 0, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(35, 11, '16', 0, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(36, 11, '18', 0, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(37, 11, '4', 0, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(38, 11, '20', 0, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(39, 11, '5', 0, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(40, 11, '7', 0, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(41, 11, '22', 0, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(42, 11, '8', 0, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(43, 11, '23', 1, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(44, 11, '9', 1, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(45, 11, '11', 0, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(46, 11, '13', 0, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(47, 11, '15', 0, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(48, 11, '17', 0, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(49, 11, '24', 0, '2022-03-25 16:39:01', 1, '2022-03-25 16:39:01', 1),
	(50, 12, '2', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1),
	(51, 12, '21', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1),
	(52, 12, '3', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1),
	(53, 12, '12', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1),
	(54, 12, '14', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1),
	(55, 12, '16', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1),
	(56, 12, '18', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1),
	(57, 12, '10', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1),
	(58, 12, '4', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1),
	(59, 12, '20', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1),
	(60, 12, '5', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1),
	(61, 12, '7', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1),
	(62, 12, '8', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1),
	(63, 12, '23', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1),
	(64, 12, '9', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1),
	(65, 12, '13', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1),
	(66, 12, '15', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1),
	(67, 12, '17', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1),
	(68, 12, '24', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1),
	(69, 12, '11', 1, '2022-03-30 15:45:11', 1, '2022-03-30 15:45:11', 1);
/*!40000 ALTER TABLE `gen_menu_access` ENABLE KEYS */;

-- Dumping structure for table edufund_crd.gen_options
CREATE TABLE IF NOT EXISTS `gen_options` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) DEFAULT NULL,
  `option_value` longtext DEFAULT NULL,
  `option_category` varchar(255) DEFAULT NULL,
  `autoload` tinyint(1) DEFAULT NULL,
  `data_create` datetime DEFAULT NULL,
  `user_create` int(11) DEFAULT NULL,
  `data_update` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Index 2` (`option_category`,`option_name`,`autoload`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edufund_crd.gen_options: ~0 rows (approximately)
/*!40000 ALTER TABLE `gen_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `gen_options` ENABLE KEYS */;

-- Dumping structure for table edufund_crd.gen_usermeta
CREATE TABLE IF NOT EXISTS `gen_usermeta` (
  `meta_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  `data_create` datetime DEFAULT NULL,
  `user_create` int(11) DEFAULT NULL,
  `data_update` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `Index 2` (`user_id`,`meta_key`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edufund_crd.gen_usermeta: ~23 rows (approximately)
/*!40000 ALTER TABLE `gen_usermeta` DISABLE KEYS */;
REPLACE INTO `gen_usermeta` (`meta_id`, `user_id`, `meta_key`, `meta_value`, `data_create`, `user_create`, `data_update`, `user_update`) VALUES
	(1, 1, 'nick_name', 'desmosedigi', NULL, NULL, '2022-03-24 16:48:46', 1),
	(2, 1, 'user_level', 'root', NULL, NULL, '2022-03-24 16:48:46', 1),
	(3, 1, '1', '1', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1),
	(4, 10, 'nick_name', 'fdsfads12345', '2022-03-11 22:35:45', 1, '2022-03-11 23:09:54', 1),
	(5, 10, 'user_level', 'administrator', '2022-03-11 22:35:45', 1, '2022-03-11 23:09:54', 1),
	(12, 4, 'nick_name', 'dsfasdf', '2022-03-11 23:05:09', 1, '2022-03-11 23:05:09', 1),
	(13, 4, 'user_level', 'user', '2022-03-11 23:05:09', 1, '2022-03-11 23:05:09', 1),
	(14, 1, 'first_name', 'Jonathan', '2022-03-15 11:48:42', 1, '2022-03-15 13:29:19', 1),
	(15, 1, 'last_name', 'HS', '2022-03-15 11:48:42', 1, '2022-03-15 13:29:19', 1),
	(16, 1, 'user_phone', '082299592827', '2022-03-15 11:48:42', 1, '2022-03-15 13:29:19', 1),
	(17, 1, 'user_biography', 'Im a developer', '2022-03-15 11:48:42', 1, '2022-03-15 13:29:19', 1),
	(18, 1, 'user_picture', 'uploads/profile/1647325757.png', '2022-03-15 11:48:42', 1, '2022-03-15 13:29:19', 1),
	(19, 5, 'nick_name', 'dasdsa2', '2022-03-22 04:28:48', 1, '2022-03-22 04:28:59', 1),
	(20, 5, 'user_level', 'user', '2022-03-22 04:28:48', 1, '2022-03-22 04:28:59', 1),
	(21, 5, 'group_id', 'Marketing', '2022-03-22 04:28:48', 1, '2022-03-22 04:28:59', 1),
	(22, 1, 'group_id', 'Data Center', '2022-03-24 16:48:46', 1, '2022-03-24 16:48:46', 1),
	(23, 11, 'nick_name', 'kerofi', '2022-03-25 16:37:58', 1, '2022-03-30 15:44:35', 1),
	(24, 11, 'user_level', 'user', '2022-03-25 16:37:58', 1, '2022-03-30 15:44:35', 1),
	(25, 11, 'group_id', 'Credit Team', '2022-03-25 16:37:58', 1, '2022-03-30 15:44:35', 1),
	(26, 11, 'first_name', 'Lingga', '2022-03-25 16:41:41', 11, '2022-03-25 16:42:50', 11),
	(27, 11, 'last_name', 'Lingga', '2022-03-25 16:41:41', 11, '2022-03-25 16:42:50', 11),
	(28, 11, 'user_phone', '', '2022-03-25 16:41:41', 11, '2022-03-25 16:42:50', 11),
	(29, 11, 'user_biography', '', '2022-03-25 16:41:41', 11, '2022-03-25 16:42:50', 11),
	(30, 11, 'user_picture', 'uploads/profile/1648201300.png', '2022-03-25 16:41:41', 11, '2022-03-25 16:41:41', 11),
	(31, 12, 'nick_name', 'roy.napitupulu', '2022-03-30 15:44:11', 1, '2022-03-30 15:44:11', 1),
	(32, 12, 'user_level', 'user', '2022-03-30 15:44:11', 1, '2022-03-30 15:44:11', 1),
	(33, 12, 'group_id', 'Risk Analyst', '2022-03-30 15:44:11', 1, '2022-03-30 15:44:11', 1);
/*!40000 ALTER TABLE `gen_usermeta` ENABLE KEYS */;

-- Dumping structure for table edufund_crd.gen_users
CREATE TABLE IF NOT EXISTS `gen_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(50) NOT NULL DEFAULT '0',
  `user_email` varchar(80) DEFAULT NULL,
  `sys_pass` varchar(255) DEFAULT NULL,
  `user_level` varchar(25) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `data_active` int(1) DEFAULT NULL,
  `data_create` datetime DEFAULT NULL,
  `user_create` int(11) DEFAULT NULL,
  `data_update` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `Index 2` (`user_email`,`group_id`,`user_login`,`user_id`,`sys_pass`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edufund_crd.gen_users: ~2 rows (approximately)
/*!40000 ALTER TABLE `gen_users` DISABLE KEYS */;
REPLACE INTO `gen_users` (`user_id`, `user_login`, `user_email`, `sys_pass`, `user_level`, `group_id`, `data_active`, `data_create`, `user_create`, `data_update`, `user_update`) VALUES
	(1, 'desmosedigi', 'desmosedigi@gmail.com', 'e5ce5dd576879f302b232cb7b9f3d4a17e8ddcf4e08a8094e00e583420cb4f78', 'root', 7, 1, '2022-03-09 00:31:58', 0, '2022-03-24 16:48:46', 1),
	(11, 'kerofi', 'lingga@gmail.com', 'e5ce5dd576879f302b232cb7b9f3d4a17e8ddcf4e08a8094e00e583420cb4f78', 'user', 1, 1, '2022-03-25 16:37:58', 1, '2022-03-30 15:44:35', 1),
	(12, 'roy.napitupulu', 'roy@edufund.co.id', 'e5ce5dd576879f302b232cb7b9f3d4a17e8ddcf4e08a8094e00e583420cb4f78', 'user', 4, 1, '2022-03-30 15:44:11', 1, '2022-03-30 15:44:11', 1);
/*!40000 ALTER TABLE `gen_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
