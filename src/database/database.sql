-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.8 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.1.0.4545
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for lab_test_shop_ci
DROP DATABASE IF EXISTS `lab_test_shop_ci`;
CREATE DATABASE IF NOT EXISTS `lab_test_shop_ci` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `lab_test_shop_ci`;


-- Dumping structure for table lab_test_shop_ci.tbl_admin
DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `admin_level_id` int(10) DEFAULT NULL,
  `last_login` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `enable` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table lab_test_shop_ci.tbl_admin: ~1 rows (approximately)
DELETE FROM `tbl_admin`;
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
INSERT INTO `tbl_admin` (`id`, `firstname`, `lastname`, `email`, `username`, `password`, `admin_level_id`, `last_login`, `created`, `modified`, `enable`) VALUES
	(1, 'Admin', 'Admin', 'admin@openarc.lk', 'admin', 'c924940e2d1e00f73255720a9bc3257f1f12300b05c345f994bf009a4850950ad8ebe3e4f7d464ba72e316925392d9b4d6823138e41b58caab97fd9e55404aaa', 1, '2014-02-17 12:08:17', '2014-02-17 12:08:18', '2014-02-17 12:08:19', 1);
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;


-- Dumping structure for table lab_test_shop_ci.tbl_ci_sessions
DROP TABLE IF EXISTS `tbl_ci_sessions`;
CREATE TABLE IF NOT EXISTS `tbl_ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(44) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL DEFAULT '0',
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table lab_test_shop_ci.tbl_ci_sessions: ~0 rows (approximately)
DELETE FROM `tbl_ci_sessions`;
/*!40000 ALTER TABLE `tbl_ci_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_ci_sessions` ENABLE KEYS */;


-- Dumping structure for table lab_test_shop_ci.tbl_download
DROP TABLE IF EXISTS `tbl_download`;
CREATE TABLE IF NOT EXISTS `tbl_download` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `download_type_id` int(10) DEFAULT NULL,
  `path` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `enable` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table lab_test_shop_ci.tbl_download: ~2 rows (approximately)
DELETE FROM `tbl_download`;
/*!40000 ALTER TABLE `tbl_download` DISABLE KEYS */;
INSERT INTO `tbl_download` (`id`, `title`, `download_type_id`, `path`, `created`, `modified`, `enable`) VALUES
	(1, 'ss', 2, 'video/sssss3.mp4', '2014-07-21 10:30:54', '2014-07-21 10:57:29', 1),
	(2, 'rr', 2, 'video/sssss5.mp4', '2014-07-21 12:07:20', '2014-07-21 12:07:20', 1);
/*!40000 ALTER TABLE `tbl_download` ENABLE KEYS */;


-- Dumping structure for table lab_test_shop_ci.tbl_download_type
DROP TABLE IF EXISTS `tbl_download_type`;
CREATE TABLE IF NOT EXISTS `tbl_download_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `download_type` varchar(50) DEFAULT NULL,
  `enable` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table lab_test_shop_ci.tbl_download_type: ~3 rows (approximately)
DELETE FROM `tbl_download_type`;
/*!40000 ALTER TABLE `tbl_download_type` DISABLE KEYS */;
INSERT INTO `tbl_download_type` (`id`, `download_type`, `enable`) VALUES
	(1, 'Music', 1),
	(2, 'Video', 1),
	(3, 'Image', 1);
/*!40000 ALTER TABLE `tbl_download_type` ENABLE KEYS */;


-- Dumping structure for table lab_test_shop_ci.tbl_migrations
DROP TABLE IF EXISTS `tbl_migrations`;
CREATE TABLE IF NOT EXISTS `tbl_migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table lab_test_shop_ci.tbl_migrations: ~1 rows (approximately)
DELETE FROM `tbl_migrations`;
/*!40000 ALTER TABLE `tbl_migrations` DISABLE KEYS */;
INSERT INTO `tbl_migrations` (`version`) VALUES
	(4);
/*!40000 ALTER TABLE `tbl_migrations` ENABLE KEYS */;


-- Dumping structure for table lab_test_shop_ci.tbl_option
DROP TABLE IF EXISTS `tbl_option`;
CREATE TABLE IF NOT EXISTS `tbl_option` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `option_name` text,
  `variable_name` text,
  `option_value` text,
  `scale` varchar(100) DEFAULT NULL,
  `option_type` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table lab_test_shop_ci.tbl_option: ~0 rows (approximately)
DELETE FROM `tbl_option`;
/*!40000 ALTER TABLE `tbl_option` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_option` ENABLE KEYS */;


-- Dumping structure for table lab_test_shop_ci.tbl_option_type
DROP TABLE IF EXISTS `tbl_option_type`;
CREATE TABLE IF NOT EXISTS `tbl_option_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `option_type` varchar(50) DEFAULT NULL,
  `enable` tinyint(3) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table lab_test_shop_ci.tbl_option_type: ~3 rows (approximately)
DELETE FROM `tbl_option_type`;
/*!40000 ALTER TABLE `tbl_option_type` DISABLE KEYS */;
INSERT INTO `tbl_option_type` (`id`, `option_type`, `enable`, `created`, `modified`) VALUES
	(1, 'General', 1, '2014-07-19 17:57:38', '2014-07-19 17:57:38'),
	(2, 'Social Media', 1, '2014-07-19 17:57:38', '2014-07-19 17:57:38'),
	(3, 'Configuration', 1, '2014-07-19 18:00:02', '2014-07-19 18:00:02');
/*!40000 ALTER TABLE `tbl_option_type` ENABLE KEYS */;


-- Dumping structure for table lab_test_shop_ci.tbl_pages
DROP TABLE IF EXISTS `tbl_pages`;
CREATE TABLE IF NOT EXISTS `tbl_pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `order_column` int(11) NOT NULL,
  `body` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table lab_test_shop_ci.tbl_pages: ~0 rows (approximately)
DELETE FROM `tbl_pages`;
/*!40000 ALTER TABLE `tbl_pages` DISABLE KEYS */;
INSERT INTO `tbl_pages` (`id`, `title`, `slug`, `order_column`, `body`, `meta_keywords`, `meta_description`, `created`, `modified`, `parent_id`) VALUES
	(1, 'sample', 'sample', 0, '<p>sdfsd</p>', 'sdf', 'dsf', '2015-09-02 19:50:53', '2015-09-02 19:50:53', 1);
/*!40000 ALTER TABLE `tbl_pages` ENABLE KEYS */;


-- Dumping structure for table lab_test_shop_ci.tbl_recipe
DROP TABLE IF EXISTS `tbl_recipe`;
CREATE TABLE IF NOT EXISTS `tbl_recipe` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `recipe_title` varchar(50) NOT NULL,
  `recipe_image` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(3) NOT NULL,
  `order_column` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table lab_test_shop_ci.tbl_recipe: ~4 rows (approximately)
DELETE FROM `tbl_recipe`;
/*!40000 ALTER TABLE `tbl_recipe` DISABLE KEYS */;
INSERT INTO `tbl_recipe` (`id`, `recipe_title`, `recipe_image`, `created`, `modified`, `status`, `order_column`) VALUES
	(8, 'dddd', 'madss.jpg', '2014-07-14 10:52:52', '2014-07-19 14:42:06', 0, 1),
	(9, 'jgfhfghgfhg', 'madss.jpg', '2014-07-14 11:03:03', '2014-07-19 14:42:06', 1, 3),
	(10, 'Thukpa – Tibetan Noodles Soup', 'slide1-735x350.jpg', '2014-07-19 14:34:30', '2014-07-19 14:42:06', 1, 2),
	(11, 'gggg', 'madss.jpg', '2014-07-21 09:51:27', '2014-07-21 09:51:27', 1, 4);
/*!40000 ALTER TABLE `tbl_recipe` ENABLE KEYS */;


-- Dumping structure for table lab_test_shop_ci.tbl_users
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(128) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table lab_test_shop_ci.tbl_users: ~1 rows (approximately)
DELETE FROM `tbl_users`;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` (`id`, `email`, `password`, `name`) VALUES
	(1, 'admin@openarc.lk', 'c924940e2d1e00f73255720a9bc3257f1f12300b05c345f994bf009a4850950ad8ebe3e4f7d464ba72e316925392d9b4d6823138e41b58caab97fd9e55404aaa', 'Admin');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
