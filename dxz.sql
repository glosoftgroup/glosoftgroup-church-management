-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.18-0ubuntu0.16.04.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for agcchurch



-- Dumping structure for table agcchurch.accounts
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` blob NOT NULL,
  `code` blob NOT NULL,
  `account_type` blob NOT NULL,
  `tax` blob NOT NULL,
  `balance` blob NOT NULL,
  `created_by` blob,
  `modified_by` blob,
  `created_on` blob,
  `modified_on` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table agcchurch.accounts: ~0 rows (approximately)
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;


-- Dumping structure for table agcchurch.account_types
CREATE TABLE IF NOT EXISTS `account_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `campus_id` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table agcchurch.account_types: ~0 rows (approximately)
/*!40000 ALTER TABLE `account_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `account_types` ENABLE KEYS */;


-- Dumping structure for table agcchurch.address_book
CREATE TABLE IF NOT EXISTS `address_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address_book` varchar(256) NOT NULL DEFAULT '',
  `category` varchar(32) NOT NULL DEFAULT '',
  `contact_person` varchar(256) NOT NULL DEFAULT '',
  `business_name` varchar(256) NOT NULL DEFAULT '',
  `phone` varchar(256) NOT NULL DEFAULT '',
  `email` varchar(256) NOT NULL DEFAULT '',
  `address` text,
  `additional_info` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.address_book: ~0 rows (approximately)
/*!40000 ALTER TABLE `address_book` DISABLE KEYS */;
/*!40000 ALTER TABLE `address_book` ENABLE KEYS */;


-- Dumping structure for table agcchurch.address_book_category
CREATE TABLE IF NOT EXISTS `address_book_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.address_book_category: ~0 rows (approximately)
/*!40000 ALTER TABLE `address_book_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `address_book_category` ENABLE KEYS */;


-- Dumping structure for table agcchurch.advance_salary
CREATE TABLE IF NOT EXISTS `advance_salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee` varchar(256) NOT NULL DEFAULT '',
  `advance_date` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `amount` varchar(256) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.advance_salary: ~0 rows (approximately)
/*!40000 ALTER TABLE `advance_salary` DISABLE KEYS */;
/*!40000 ALTER TABLE `advance_salary` ENABLE KEYS */;


-- Dumping structure for table agcchurch.allocations
CREATE TABLE IF NOT EXISTS `allocations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `ministry` varchar(32) NOT NULL DEFAULT '',
  `amount` double DEFAULT NULL,
  `approved_by` varchar(32) NOT NULL DEFAULT '',
  `confirmed_by` varchar(32) NOT NULL DEFAULT '',
  `expenditure` double DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `description` text,
  `comment` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.allocations: ~0 rows (approximately)
/*!40000 ALTER TABLE `allocations` DISABLE KEYS */;
/*!40000 ALTER TABLE `allocations` ENABLE KEYS */;


-- Dumping structure for table agcchurch.allowances
CREATE TABLE IF NOT EXISTS `allowances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '',
  `amount` varchar(256) NOT NULL DEFAULT '',
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.allowances: ~0 rows (approximately)
/*!40000 ALTER TABLE `allowances` DISABLE KEYS */;
/*!40000 ALTER TABLE `allowances` ENABLE KEYS */;


-- Dumping structure for table agcchurch.announcements
CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT NULL,
  `title` varchar(256) NOT NULL DEFAULT '',
  `status` varchar(32) NOT NULL DEFAULT '',
  `file` varchar(32) NOT NULL,
  `brief_description` text,
  `upload_announcements` varchar(256) NOT NULL DEFAULT '',
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.announcements: ~0 rows (approximately)
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;


-- Dumping structure for table agcchurch.asset_category
CREATE TABLE IF NOT EXISTS `asset_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.asset_category: ~2 rows (approximately)
/*!40000 ALTER TABLE `asset_category` DISABLE KEYS */;
INSERT INTO `asset_category` (`id`, `name`, `description`, `created_by`, `modified_by`, `created_on`, `modified_on`) VALUES
	(1, 'Kitchen', 'Kitchen', 1, NULL, 1480927979, NULL),
	(2, 'Office', 'Office', 1, NULL, 1480949263, NULL);
/*!40000 ALTER TABLE `asset_category` ENABLE KEYS */;


-- Dumping structure for table agcchurch.asset_items
CREATE TABLE IF NOT EXISTS `asset_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.asset_items: ~0 rows (approximately)
/*!40000 ALTER TABLE `asset_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `asset_items` ENABLE KEYS */;


-- Dumping structure for table agcchurch.asset_stock
CREATE TABLE IF NOT EXISTS `asset_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT NULL,
  `supplier` varchar(32) NOT NULL DEFAULT '',
  `item` varchar(32) NOT NULL DEFAULT '',
  `quantity` varchar(256) NOT NULL DEFAULT '',
  `unit_price` varchar(256) NOT NULL DEFAULT '',
  `total` varchar(256) NOT NULL DEFAULT '',
  `person_responsible` varchar(32) NOT NULL DEFAULT '',
  `file` varchar(256) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.asset_stock: ~0 rows (approximately)
/*!40000 ALTER TABLE `asset_stock` DISABLE KEYS */;
/*!40000 ALTER TABLE `asset_stock` ENABLE KEYS */;


-- Dumping structure for table agcchurch.bank_accounts
CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(256) NOT NULL DEFAULT '',
  `account_name` varchar(256) NOT NULL DEFAULT '',
  `account_number` varchar(256) NOT NULL DEFAULT '',
  `branch` varchar(256) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.bank_accounts: ~0 rows (approximately)
/*!40000 ALTER TABLE `bank_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bank_accounts` ENABLE KEYS */;


-- Dumping structure for table agcchurch.baptism
CREATE TABLE IF NOT EXISTS `baptism` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `member` varchar(32) NOT NULL DEFAULT '',
  `ff_name` varchar(256) NOT NULL DEFAULT '',
  `fl_name` varchar(256) NOT NULL DEFAULT '',
  `father_religion` varchar(256) NOT NULL DEFAULT '',
  `father_phone` varchar(256) NOT NULL DEFAULT '',
  `father_email` varchar(256) NOT NULL DEFAULT '',
  `father_address` text,
  `mf_name` varchar(256) NOT NULL DEFAULT '',
  `ml_name` varchar(256) NOT NULL DEFAULT '',
  `mother_religion` varchar(256) NOT NULL DEFAULT '',
  `mother_phone` varchar(256) NOT NULL DEFAULT '',
  `mother_email` varchar(256) NOT NULL DEFAULT '',
  `mother_address` text,
  `gff_name` varchar(256) NOT NULL DEFAULT '',
  `gfl_name` varchar(256) NOT NULL DEFAULT '',
  `gf_age` varchar(256) NOT NULL DEFAULT '',
  `gf_phone` varchar(256) NOT NULL DEFAULT '',
  `gf_address` text,
  `gmf_name` varchar(256) NOT NULL DEFAULT '',
  `gml_name` varchar(256) NOT NULL DEFAULT '',
  `gm_age` varchar(256) NOT NULL DEFAULT '',
  `gm_phone` varchar(256) NOT NULL DEFAULT '',
  `gm_address` varchar(256) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.baptism: ~0 rows (approximately)
/*!40000 ALTER TABLE `baptism` DISABLE KEYS */;
/*!40000 ALTER TABLE `baptism` ENABLE KEYS */;


-- Dumping structure for table agcchurch.bible_quotes
CREATE TABLE IF NOT EXISTS `bible_quotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL DEFAULT '',
  `status` varchar(32) NOT NULL DEFAULT '',
  `content` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.bible_quotes: ~0 rows (approximately)
/*!40000 ALTER TABLE `bible_quotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `bible_quotes` ENABLE KEYS */;


-- Dumping structure for table agcchurch.cfd_parents
CREATE TABLE IF NOT EXISTS `cfd_parents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `child_id` int(11) NOT NULL DEFAULT '0',
  `type` varchar(256) NOT NULL DEFAULT '',
  `first_name` varchar(256) NOT NULL DEFAULT '',
  `last_name` varchar(256) NOT NULL DEFAULT '',
  `phone` varchar(256) NOT NULL DEFAULT '',
  `email` varchar(256) NOT NULL DEFAULT '',
  `address` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.cfd_parents: ~0 rows (approximately)
/*!40000 ALTER TABLE `cfd_parents` DISABLE KEYS */;
/*!40000 ALTER TABLE `cfd_parents` ENABLE KEYS */;


-- Dumping structure for table agcchurch.church_projects
CREATE TABLE IF NOT EXISTS `church_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '',
  `county` varchar(32) NOT NULL DEFAULT '',
  `location` varchar(256) NOT NULL DEFAULT '',
  `status` varchar(32) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.church_projects: ~0 rows (approximately)
/*!40000 ALTER TABLE `church_projects` DISABLE KEYS */;
INSERT INTO `church_projects` (`id`, `name`, `county`, `location`, `status`, `description`, `created_by`, `modified_by`, `created_on`, `modified_on`) VALUES
	(1, 'Children\'s Home', 'Nakuru', 'Nakuru', '1', 'Home', 1, 1, 1480949163, 1480949184);
/*!40000 ALTER TABLE `church_projects` ENABLE KEYS */;


-- Dumping structure for table agcchurch.collections_log
CREATE TABLE IF NOT EXISTS `collections_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collection_id` blob,
  `type` blob,
  `amount` blob,
  `created_by` blob,
  `modified_by` blob,
  `created_on` blob,
  `modified_on` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.collections_log: ~0 rows (approximately)
/*!40000 ALTER TABLE `collections_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `collections_log` ENABLE KEYS */;


-- Dumping structure for table agcchurch.contribution_types
CREATE TABLE IF NOT EXISTS `contribution_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.contribution_types: ~0 rows (approximately)
/*!40000 ALTER TABLE `contribution_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `contribution_types` ENABLE KEYS */;


-- Dumping structure for table agcchurch.core_settings
CREATE TABLE IF NOT EXISTS `core_settings` (
  `slug` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `default` text COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`slug`),
  UNIQUE KEY `unique - slug` (`slug`),
  KEY `index - slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Stores settings for the multi-site interface';

-- Dumping data for table agcchurch.core_settings: ~3 rows (approximately)
/*!40000 ALTER TABLE `core_settings` DISABLE KEYS */;
INSERT INTO `core_settings` (`slug`, `default`, `value`) VALUES
	('date_format', 'g:ia -- m/d/y', 'g:ia -- m/d/y'),
	('lang_direction', 'ltr', 'ltr'),
	('status_message', 'This site has been disabled by a super-administrator.', 'This site has been disabled by a super-administrator.');
/*!40000 ALTER TABLE `core_settings` ENABLE KEYS */;


-- Dumping structure for table agcchurch.core_sites
CREATE TABLE IF NOT EXISTS `core_sites` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ref` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `domain` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` int(11) NOT NULL DEFAULT '0',
  `updated_on` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Unique ref` (`ref`),
  UNIQUE KEY `Unique domain` (`domain`),
  KEY `ref` (`ref`),
  KEY `domain` (`domain`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table agcchurch.core_sites: ~0 rows (approximately)
/*!40000 ALTER TABLE `core_sites` DISABLE KEYS */;
INSERT INTO `core_sites` (`id`, `name`, `ref`, `domain`, `active`, `created_on`, `updated_on`) VALUES
	(1, 'Default Site', 'default', 'localhost', 1, 1361856990, 0);
/*!40000 ALTER TABLE `core_sites` ENABLE KEYS */;


-- Dumping structure for table agcchurch.core_users
CREATE TABLE IF NOT EXISTS `core_users` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `salt` varchar(6) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `group_id` int(11) DEFAULT NULL,
  `ip_address` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `activation_code` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` int(11) NOT NULL,
  `last_login` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forgotten_password_code` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_code` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Super User Information';

-- Dumping data for table agcchurch.core_users: ~0 rows (approximately)
/*!40000 ALTER TABLE `core_users` DISABLE KEYS */;
INSERT INTO `core_users` (`id`, `email`, `password`, `salt`, `group_id`, `ip_address`, `active`, `activation_code`, `created_on`, `last_login`, `username`, `forgotten_password_code`, `remember_code`) VALUES
	(1, 'evansogola@digitalvision.co.ke', '2a7a93fb841e8d17217f56895ccc93f38f2f9114', 'acf67', 1, '', 1, '', 1361856990, 1361856990, 'evans', NULL, NULL);
/*!40000 ALTER TABLE `core_users` ENABLE KEYS */;


-- Dumping structure for table agcchurch.current
CREATE TABLE IF NOT EXISTS `current` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` blob NOT NULL,
  `total` blob NOT NULL,
  `created_by` blob,
  `modified_by` blob,
  `created_on` blob,
  `modified_on` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.current: ~0 rows (approximately)
/*!40000 ALTER TABLE `current` DISABLE KEYS */;
/*!40000 ALTER TABLE `current` ENABLE KEYS */;


-- Dumping structure for table agcchurch.daily_inspirations
CREATE TABLE IF NOT EXISTS `daily_inspirations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL DEFAULT '',
  `message` text,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.daily_inspirations: ~0 rows (approximately)
/*!40000 ALTER TABLE `daily_inspirations` DISABLE KEYS */;
/*!40000 ALTER TABLE `daily_inspirations` ENABLE KEYS */;


-- Dumping structure for table agcchurch.dedications
CREATE TABLE IF NOT EXISTS `dedications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT NULL,
  `first_name` varchar(256) NOT NULL DEFAULT '',
  `middle_name` varchar(256) NOT NULL DEFAULT '',
  `last_name` varchar(256) NOT NULL DEFAULT '',
  `gender` varchar(256) NOT NULL DEFAULT '',
  `dob` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `location` varchar(256) NOT NULL DEFAULT '',
  `country` varchar(256) NOT NULL DEFAULT '',
  `city` varchar(256) NOT NULL DEFAULT '',
  `expected_dedication_date` int(11) DEFAULT NULL,
  `service_type` varchar(256) NOT NULL DEFAULT '',
  `description` text,
  `type` int(11) DEFAULT NULL,
  `father` int(11) DEFAULT NULL,
  `mother` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.dedications: ~0 rows (approximately)
/*!40000 ALTER TABLE `dedications` DISABLE KEYS */;
/*!40000 ALTER TABLE `dedications` ENABLE KEYS */;


-- Dumping structure for table agcchurch.deductions
CREATE TABLE IF NOT EXISTS `deductions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '',
  `amount` varchar(256) NOT NULL DEFAULT '',
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.deductions: ~0 rows (approximately)
/*!40000 ALTER TABLE `deductions` DISABLE KEYS */;
/*!40000 ALTER TABLE `deductions` ENABLE KEYS */;


-- Dumping structure for table agcchurch.donations
CREATE TABLE IF NOT EXISTS `donations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT NULL,
  `donor` varchar(256) NOT NULL DEFAULT '',
  `phone` varchar(256) NOT NULL DEFAULT '',
  `email` varchar(256) NOT NULL DEFAULT '',
  `address` text,
  `country` varchar(32) NOT NULL DEFAULT '',
  `city` varchar(256) NOT NULL DEFAULT '',
  `donation_type` varchar(256) NOT NULL DEFAULT '',
  `pledged_amount` varchar(256) NOT NULL DEFAULT '',
  `value` varchar(256) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.donations: ~0 rows (approximately)
/*!40000 ALTER TABLE `donations` DISABLE KEYS */;
/*!40000 ALTER TABLE `donations` ENABLE KEYS */;


-- Dumping structure for table agcchurch.emails
CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` blob,
  `sent_to` blob,
  `recipient` blob,
  `cc` blob,
  `description` blob,
  `attachment` blob,
  `type` blob,
  `status` blob,
  `created_by` blob,
  `modified_by` blob,
  `created_on` blob,
  `modified_on` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.emails: ~0 rows (approximately)
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;


-- Dumping structure for table agcchurch.email_recipients
CREATE TABLE IF NOT EXISTS `email_recipients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(256) NOT NULL DEFAULT '',
  `email_id` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.email_recipients: ~0 rows (approximately)
/*!40000 ALTER TABLE `email_recipients` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_recipients` ENABLE KEYS */;


-- Dumping structure for table agcchurch.email_templates
CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `description` text,
  `content` text,
  `status` enum('draft','live') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'draft',
  `created_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.email_templates: ~2 rows (approximately)
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` (`id`, `title`, `slug`, `description`, `content`, `status`, `created_by`, `created_on`, `modified_on`, `modified_by`) VALUES
	(1, 'Meetings Template', 'meetings', 'This is meetings template', '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">\r\n<meta name="viewport" content="initial-scale=1.0"> \r\n<meta name="format-detection" content="telephone=no">\r\n<title>Metric : Responsive Email Templates</title>\r\n<style type="text/css">\r\n\r\n/* Resets: see reset.css for details */\r\n.ReadMsgBody { width: 100%; background-color: #ffffff;}\r\n.ExternalClass {width: 100%; background-color: #ffffff;}\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height:100%;}\r\nhtml{width: 100%; }\r\nbody {-webkit-text-size-adjust:none; -ms-text-size-adjust:none; }\r\nbody {margin:0; padding:0;}\r\ntable {border-spacing:0;}\r\nimg{display:block !important;}\r\n\r\ntable td {border-collapse:collapse;}\r\n.yshortcuts a {border-bottom: none !important;}\r\n\r\n\r\n/* \r\n\r\nmain color = #2f9bbe\r\n\r\nother color = #186e8a\r\n\r\n\r\n*/\r\n\r\n\r\nimg{height:auto !important;}\r\n\r\n\r\n@media only screen and (max-width: 640px){\r\n  body{\r\n    width:auto!important;\r\n  }\r\n\r\n  table[class="container"]{\r\n    width: 100%!important;\r\n    padding-left: 20px!important; \r\n    padding-right: 20px!important; \r\n  }\r\n\r\n  img[class="image-100-percent"]{\r\n    width:100% !important;\r\n    height:auto !important;\r\n    max-width:100% !important;\r\n  }\r\n\r\n  img[class="small-image-100-percent"]{\r\n    width:100% !important;\r\n    height:auto !important;\r\n  }\r\n\r\n  table[class="full-width"]{\r\n    width:100% !important;\r\n  }\r\n\r\n  table[class="full-width-text"]{\r\n    width:100% !important;\r\n     background-color:#186e8a;\r\n     padding-left:20px !important;\r\n     padding-right:20px !important;\r\n  }\r\n\r\n  table[class="full-width-text2"]{\r\n    width:100% !important;\r\n     background-color:#f3f3f3;\r\n     padding-left:20px !important;\r\n     padding-right:20px !important; \r\n  }\r\n\r\n  table[class="col-2-3img"]{\r\n    width:50% !important;\r\n    margin-right: 20px !important;\r\n  }\r\n    table[class="col-2-3img-last"]{\r\n    width:50% !important;\r\n  }\r\n\r\n  table[class="col-2"]{\r\n    width:47% !important;\r\n    margin-right:20px !important;\r\n  }\r\n\r\n  table[class="col-2-last"]{\r\n    width:47% !important;\r\n  }\r\n\r\n  table[class="col-3"]{\r\n    width:29% !important;\r\n    margin-right:20px !important;\r\n  }\r\n\r\n  table[class="col-3-last"]{\r\n    width:29% !important;\r\n  }\r\n\r\n  table[class="row-2"]{\r\n    width:50% !important;\r\n  }\r\n\r\n  td[class="text-center"]{\r\n     text-align: center !important;\r\n   }\r\n\r\n  /* start clear and remove*/\r\n  table[class="remove"]{\r\n    display:none !important;\r\n  }\r\n\r\n  td[class="remove"]{\r\n    display:none !important;\r\n  }\r\n  /* end clear and remove*/\r\n\r\n  table[class="fix-box"]{\r\n    padding-left:20px !important;\r\n    padding-right:20px !important;\r\n  }\r\n  td[class="fix-box"]{\r\n    padding-left:20px !important;\r\n    padding-right:20px !important;\r\n  }\r\n\r\n  td[class="font-resize"]{\r\n    font-size: 18px !important;\r\n    line-height: 22px !important;\r\n  }\r\n\r\n\r\n}\r\n\r\n\r\n\r\n@media only screen and (max-width: 479px){\r\n  body{\r\n    font-size:10px !important;\r\n  }\r\n\r\n   table[class="container2"]{\r\n    width: 100%!important; \r\n    float:none !important;\r\n  }\r\n\r\n  img[class="image-100-percent"]{\r\n    width:100% !important;\r\n    height:auto !important;\r\n    max-width:100% !important;\r\n    min-width:124px !important;\r\n  }\r\n    img[class="small-image-100-percent"]{\r\n    width:100% !important;\r\n    height:auto !important;\r\n    max-width:100% !important;\r\n    min-width:124px !important;\r\n  }\r\n\r\n  table[class="full-width"]{\r\n    width:100% !important;\r\n  }\r\n\r\n  table[class="full-width-text"]{\r\n    width:100% !important;\r\n     background-color:#186e8a;\r\n     padding-left:20px !important;\r\n     padding-right:20px !important;\r\n  }\r\n\r\n  table[class="full-width-text2"]{\r\n    width:100% !important;\r\n     background-color:#f3f3f3;\r\n     padding-left:20px !important;\r\n     padding-right:20px !important;\r\n  }\r\n\r\n\r\n\r\n  table[class="col-2"]{\r\n    width:100% !important;\r\n    margin-right:0px !important;\r\n  }\r\n\r\n  table[class="col-2-last"]{\r\n    width:100% !important;\r\n   \r\n  }\r\n\r\n  table[class="col-3"]{\r\n    width:100% !important;\r\n    margin-right:0px !important;\r\n  }\r\n\r\n  table[class="col-3-last"]{\r\n    width:100% !important;\r\n   \r\n  }\r\n\r\n    table[class="row-2"]{\r\n    width:100% !important;\r\n  }\r\n\r\n\r\n  table[id="col-underline"]{\r\n    float: none !important;\r\n    width: 100% !important;\r\n    border-bottom: 1px solid #eee;\r\n  }\r\n\r\n  td[id="col-underline"]{\r\n    float: none !important;\r\n    width: 100% !important;\r\n    border-bottom: 1px solid #eee;\r\n  }\r\n\r\n  td[class="col-underline"]{\r\n    float: none !important;\r\n    width: 100% !important;\r\n    border-bottom: 1px solid #eee;\r\n  }\r\n\r\n\r\n\r\n   /*start text center*/\r\n  td[class="text-center"]{\r\n    text-align: center !important;\r\n\r\n  }\r\n\r\n  div[class="text-center"]{\r\n    text-align: center !important;\r\n  }\r\n   /*end text center*/\r\n\r\n\r\n\r\n  /* start  clear and remove */\r\n\r\n  table[id="clear-padding"]{\r\n    padding:0 !important;\r\n  }\r\n  td[id="clear-padding"]{\r\n    padding:0 !important;\r\n  }\r\n  td[class="clear-padding"]{\r\n    padding:0 !important;\r\n  }\r\n  table[class="remove-479"]{\r\n    display:none !important;\r\n  }\r\n  td[class="remove-479"]{\r\n    display:none !important;\r\n  }\r\n  table[class="clear-align"]{\r\n    float:none !important;\r\n  }\r\n  /* end  clear and remove */\r\n\r\n  table[class="width-small"]{\r\n    width:100% !important;\r\n  }\r\n\r\n  table[class="fix-box"]{\r\n    padding-left:0px !important;\r\n    padding-right:0px !important;\r\n  }\r\n  td[class="fix-box"]{\r\n    padding-left:0px !important;\r\n    padding-right:0px !important;\r\n  }\r\n    td[class="font-resize"]{\r\n    font-size: 14px !important;\r\n  }\r\n\r\n}\r\n@media only screen and (max-width: 320px){\r\n  table[class="width-small"]{\r\n    width:125px !important;\r\n  }\r\n  img[class="image-100-percent"]{\r\n    width:100% !important;\r\n    height:auto !important;\r\n    max-width:100% !important;\r\n    min-width:124px !important;\r\n  }\r\n\r\n}\r\n</style>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<!--start 100% wrapper (white background) -->\r\n<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#ececec;">\r\n\r\n  <!-- START TAB TOP -->\r\n    <tbody><tr>\r\n      <td valign="top">\r\n        <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="height:6px; background-color:#2f9bbe;">\r\n          <tbody><tr>\r\n            <td valign="top" height="6">\r\n              <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width" style="height:6px;">\r\n                <tbody><tr>\r\n                  <td valign="top" align="center"> \r\n                    <table width="150" align="left" border="0" cellspacing="0" cellpadding="0" class="clear-align" style="height:6px; background-color:#186e8a;">\r\n                      <tbody><tr>\r\n                        <td valign="top" height="6"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n  <!-- END TAB TOP -->\r\n\r\n  <!--START TOP NAVIGATION ?LAYOUT-->\r\n  <tr>\r\n    <td align="center" valign="top" class="fix-box">\r\n      \r\n      <!-- start top navigation container -->\r\n      <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="container" bgcolor="#ffffff" style="background-color:#ffffff;">\r\n      \r\n        <tbody><tr>\r\n          <td valign="top">\r\n              \r\n\r\n            <!-- start top navigaton -->\r\n            <table width="560" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width">\r\n              <tbody><tr>\r\n                <td valign="top">\r\n                \r\n                <table align="left" border="0" cellspacing="0" cellpadding="0" class="container2">\r\n                 \r\n                  <tbody><tr>\r\n                    <td align="center" valign="middle">\r\n                       <a href="#"><img src="http://localhost/sikul/assets/themes/admin/img/logo-sm.png" width="124" style="max-width:124px;" alt="Logo" border="0" hspace="0" vspace="0"></a>\r\n                    </td>\r\n                  </tr>\r\n\r\n                </tbody></table>\r\n\r\n                <!--start content nav -->\r\n                <table border="0" align="right" cellpadding="0" cellspacing="0" class="container2">\r\n\r\n                   <tbody><tr>\r\n                    <td height="20" valign="top" class="remove-479"></td>\r\n                  </tr>\r\n\r\n                   <!--start call us -->\r\n                  <tr>\r\n                     <td valign="top" align="center">\r\n                    \r\n                    <table align="right" border="0" cellpadding="0" cellspacing="0" class="clear-align">\r\n                      <tbody><tr>\r\n                      \r\n\r\n                        <td style="font-size: 13px;  line-height: 18px; color: #555555;  font-weight:normal; text-align: center; font-family:Arail,Tahoma, Helvetica, Arial, sans-serif;">\r\n\r\n                          <span style="color: #2f9bbe;">CALL US</span>\r\n                          +254 721 341 214\r\n                        </td>\r\n                      </tr>\r\n\r\n                    </tbody></table>\r\n                    </td>\r\n                  </tr>\r\n                  <!--end call us -->\r\n\r\n                  <!-- start space height -->\r\n                   <tr>\r\n                    <td height="10" valign="top"></td>\r\n                  </tr>\r\n                  <!-- start space height -->\r\n\r\n\r\n                  <!--start view online -->\r\n                  <tr>\r\n                    <td valign="top" align="center">\r\n                    \r\n                    <table align="right" border="0" cellpadding="0" cellspacing="0" class="clear-align">\r\n\r\n                      <tbody><tr>\r\n                      \r\n                        <td align="center" style="font-size: 13px;  line-height: 18px; color: #555555;  font-weight:normal; text-align: center; font-family:Arail,Tahoma, Helvetica, Arial, sans-serif;">\r\n\r\n                          <span style="color: #2f9bbe;">View online</span>\r\n                          \r\n                        </td>\r\n                      </tr>\r\n\r\n                    </tbody></table>\r\n                    </td>\r\n                  </tr>\r\n                  <!--end view online -->\r\n                  \r\n                \r\n                   <tr>\r\n                    <td height="20" valign="top"></td>\r\n                  </tr>\r\n\r\n                </tbody></table>\r\n                <!--end content nav -->\r\n\r\n               </td>\r\n             </tr>\r\n			 <tr>\r\n		   <td align="center" valign="top" class="fix-box">\r\n			 <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="container" style="background-color:#ffffff;">\r\n			   <tbody>\r\n			   <tr>\r\n				 <td valign="top" align="center" style="background-color:#ffffff;">\r\n				   <a href="#">\r\n					 <img class="image-100-percent" src="http://localhost/sikul/assets/themes/admin/img/email/Divider.png" height="9" alt="Divider" style="display:block; max-height:9px; " border="0" hspace="0" vspace="0"> \r\n				   </a>\r\n				 </td>\r\n               </tr>\r\n     </tbody></table>\r\n   </td>\r\n </tr>\r\n           </tbody></table>\r\n           <!-- end top navigaton -->\r\n          </td>\r\n        </tr>\r\n      </tbody></table>\r\n      <!-- end top navigation container -->\r\n\r\n    </td>\r\n  </tr>\r\n   <!--END TOP NAVIGATION ?LAYOUT-->\r\n\r\n   \r\n <!-- START LAYOUT 11 --> \r\n<tr>\r\n <td align="center" valign="top" class="fix-box">\r\n  <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width">\r\n    <tbody><tr>\r\n      <td valign="top">\r\n        \r\n\r\n      \r\n\r\n   <!-- start layout-11 container width 600px --> \r\n   <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="container" bgcolor="#ffffff" style="background-color: #ffffff; ">\r\n\r\n\r\n     <tbody><tr>\r\n       <td valign="top">\r\n\r\n         <!-- start layout-11 container width 560px --> \r\n         <table width="560" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width" bgcolor="#ffffff" style="background-color: #ffffff;">\r\n\r\n\r\n           <!-- start image content --> \r\n           <tbody><tr>\r\n             <td valign="top" width="100%">\r\n\r\n\r\n\r\n\r\n              <!-- start content left -->                      \r\n              <table width="100%" border="0" cellspacing="0" cellpadding="0" align="left" class="full-width">\r\n\r\n               <!--start space height --> \r\n               <tbody><tr>\r\n                 <td height="20"></td>\r\n               </tr>\r\n               <!--end space height --> \r\n\r\n                \r\n\r\n                <!--start space height -->                      \r\n                <tr>\r\n                  <td height="20"></td>\r\n                </tr>\r\n                <!--end space height -->                      \r\n\r\n                <tr>\r\n                  <td valign="top">\r\n\r\n                    <table border="0" cellspacing="0" cellpadding="0" align="left">\r\n                      <tbody><tr>\r\n\r\n                        <!-- space width -->                      \r\n                        <td valign="top">\r\n                          <table width="20" border="0" cellspacing="0" cellpadding="0" align="left">\r\n                            <tbody><tr>\r\n                              <td valign="top"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                        <!-- space width -->                      \r\n\r\n                         <!-- start text content --> \r\n                         <td valign="top">\r\n                           <table width="100%" border="0" cellspacing="0" cellpadding="0" align="left" class="width-small">\r\n                            \r\n                             <tbody><tr>\r\n                               <td style="text-align: left;"><font color="#a3a2a2" face="Arial, Tahoma, Helvetica, sans-serif"><span style="line-height: 22px;">\r\n                                   From: [FROM]</span></font><br><font color="#a3a2a2" face="Arial, Tahoma, Helvetica, sans-serif"><span style="line-height: 22px;"> \r\n								   To: [TO]</span></font><br><font color="#a3a2a2" face="Arial, Tahoma, Helvetica, sans-serif"><span style="line-height: 22px;">\r\n                                  REF: </span></font><b style="color: rgb(163, 162, 162); font-family: Arial, Tahoma, Helvetica, sans-serif; font-size: 13px; font-weight: normal; line-height: 22px; text-decoration: underline;">[SUBJECT]<br></b><font color="#a3a2a2" face="Arial, Tahoma, Helvetica, sans-serif"><span style="line-height: 22px;">Meeting Title: [MEETING TITLE]<br>Start Date: [DATE FROM]</span></font><br><font color="#a3a2a2" face="Arial, Tahoma, Helvetica, sans-serif"><span style="line-height: 22px;">End Date: [DATE TO]</span></font><br><font color="#a3a2a2" face="Arial, Tahoma, Helvetica, sans-serif"><span style="line-height: 22px;">Venue: [VENUE]</span></font><br><font color="#a3a2a2" face="Arial, Tahoma, Helvetica, sans-serif"><span style="line-height: 22px;">Importance: [IMPORTANCE]</span></font><br><font color="#a3a2a2" face="Arial, Tahoma, Helvetica, sans-serif"><span style="line-height: 22px;">\r\n								 \r\n								 \r\n                                  [DESCRIPTION]\r\n                                 \r\n\r\n                               </span></font></td>\r\n                             </tr> \r\n                             <!-- start height -->\r\n                             <tr>\r\n                               <td valign="top" height="10"></td>\r\n                             </tr>\r\n                              <!-- end height -->\r\n\r\n                             <tr>\r\n                               <td style="font-size: 13px; line-height: 22px; font-family:Arial,Tahoma, Helvetica, sans-serif; color:#a3a2a2; font-weight:normal; text-align:left; ">\r\n\r\n                                   <span style="color: #2f9bbe;">www.smartshule.com</span> : for more details. \r\n\r\n                               </td>\r\n                             </tr>                               \r\n                           </tbody></table>\r\n                         </td>\r\n                         <!-- end text content --> \r\n\r\n                      </tr>\r\n                    </tbody></table>\r\n\r\n                  </td>\r\n                </tr>\r\n\r\n                <!--start space height -->                      \r\n                <tr>\r\n                  <td height="20"></td>\r\n                </tr>\r\n                <!--end space height --> \r\n              </tbody></table>\r\n              <!-- end content left --> \r\n\r\n             </td>\r\n           </tr>\r\n           <!-- end image content --> \r\n\r\n         </tbody></table>\r\n         <!-- end layout-11 container width 560px --> \r\n       </td>\r\n     </tr>\r\n   </tbody></table>\r\n   <!-- end layout-11 container width 600px --> \r\n    </td>\r\n    </tr>\r\n\r\n  </tbody></table>\r\n </td>\r\n</tr>\r\n\r\n\r\n <!-- END LAYOUT 11 --> \r\n\r\n\r\n\r\n  <!-- start bottom angle finish layout-->\r\n    <tr>\r\n      <td valign="top" class="fix-box">\r\n        <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width">\r\n          <tbody><tr>\r\n            <td valign="top" width="20">\r\n              <table width="20" align="left" border="0" cellspacing="0" cellpadding="0">\r\n                <tbody><tr>\r\n\r\n                  <td valign="top" align="left">\r\n                    <a href="#">\r\n                      <img src="http://localhost/sikul/assets/themes/admin/img/email/Angle-top-left.png" width="20" alt="Angle-top-left" style="display:block; max-width:20px; " border="0" hspace="0" vspace="0">            \r\n                    </a>\r\n                  </td>\r\n\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n\r\n            <td valign="top">\r\n             <table width="560" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width" bgcolor="#b4b3b3" style="background-color: #b4b3b3; ">\r\n               <tbody><tr>\r\n\r\n                 <td valign="top" align="center" height="20" bgcolor="#b4b3b3" style="background-color: #b4b3b3; "></td>\r\n\r\n               </tr>\r\n             </tbody></table>\r\n            </td>\r\n\r\n          <td valign="top" width="20">\r\n              <table width="20" align="left" border="0" cellspacing="0" cellpadding="0">\r\n                <tbody><tr>\r\n\r\n                  <td valign="top" align="left">\r\n                    <a href="#">\r\n                      <img src="http://localhost/sikul/assets/themes/admin/img/email/Angle-top-right.png" width="20" alt="Angle-top-left" style="display:block; max-width:20px; " border="0" hspace="0" vspace="0">            \r\n                    </a>\r\n                  </td>\r\n\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <!-- end bottom angle finish layout-->\r\n\r\n\r\n<!-- START FOOTER layout-->\r\n  <tr>\r\n    <td align="center" valign="top" bgcolor="#ffffff" style="background-color: #ffffff; ">\r\n\r\n      <!-- start top navigation container -->  \r\n      <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="container" bgcolor="#ffffff">\r\n        <tbody><tr>\r\n          <td valign="top">\r\n\r\n            <table width="560" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width" bgcolor="#ffffff">\r\n              <!--start space height -->                      \r\n              <tbody><tr>\r\n                <td height="10"></td>\r\n              </tr>\r\n              <!--end space height --> \r\n              <tr>\r\n                <td valign="top">\r\n\r\n\r\n                  <!-- start logo footer and address -->  \r\n                  <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">\r\n                    <tbody><tr>\r\n                      <td valign="top">\r\n\r\n                        <table width="300" align="left" border="0" cellspacing="0" cellpadding="0" class="full-width">\r\n                          <tbody><tr>\r\n                            <td>\r\n                              <table align="left" border="0" cellspacing="0" cellpadding="0" class="full-width">\r\n\r\n                                <tbody><tr>\r\n                                  <td align="center" valign="middle">\r\n                                    <a href="#">\r\n                                      <img src="http://localhost/sikul/assets/themes/admin/img/logo-sm.png" width="124" style="max-width:124px;" alt="Logo" border="0" hspace="0" vspace="0">                        \r\n                                    </a>\r\n                                  </td>\r\n                                </tr>\r\n\r\n                              </tbody></table>\r\n                            </td>\r\n                          </tr>\r\n\r\n                          <tr>\r\n                            <td valign="top" align="center" style="font-size: 13px; line-height: 22px; font-family: Helvetica, sans-serif,Arial,Tahoma; color:#6d6d6d; font-weight:normal; text-align:left;" class="text-center">\r\n                              \r\n                                Company Name : <span style="color: #6d6d6d; font-weight: normal;">Smart shule</span> <br>                 \r\n                                Mail Us : <span style="color: #2f9bbe; font-weight: normal;"><a href="#" style="text-decoration: none; color: #2f9bbe; font-weight: normal;">info@smartshule.com</a> </span><br>\r\n                               Call Us : (254) 721 341 214\r\n\r\n                            </td>\r\n                          </tr>\r\n\r\n                        </tbody></table>\r\n\r\n                        <!--start icon socail navigation -->  \r\n                        <table border="0" align="right" cellpadding="0" cellspacing="0" class="container">\r\n\r\n                           <!--start space height -->                      \r\n                          <tbody><tr>\r\n                            <td height="20"></td>\r\n                          </tr>\r\n                          <!--end space height --> \r\n\r\n                           <tr>\r\n                            <td style="font-size: 22px; line-height: 24px; font-family: Arial,Tahoma,Helvetica, sans-serif; color:#555555; font-weight:normal; text-align:left; " class="text-center"><span style="color: #555555; font-weight: normal;">Smart<a href="#" style="text-decoration: none; color: #555555; font-weight: normal;">&nbsp;<span style="color:#2f9bbe;">Shule</span><br> \r\n                                    <span style="color:#a3a2a2; font-size:12px; line-height: 16px; font-weight: normal;">FOLLOW US ON SOCAIL</span>\r\n                                 \r\n                                </a>\r\n                              </span>\r\n                            </td>\r\n                          </tr>\r\n\r\n                          <tr>\r\n                            <td valign="top" align="left">\r\n\r\n                              <table border="0" align="left" cellpadding="0" cellspacing="0" class="container">\r\n                                <tbody><tr>\r\n                                  <td height="50" align="center" valign="middle" class="clear-padding">\r\n                                    <a href="#">\r\n                                      <img src="http://localhost/sikul/assets/themes/admin/img/email/icon-facebook.jpg" width="30" alt="icon-facebook" style="max-width:33px;" border="0" hspace="0" vspace="0">  \r\n                                    </a>\r\n                                  </td>\r\n                                  <td style="padding-left:5px; " height="50" align="center" valign="middle" class="clear-padding">\r\n                                    <a href="#">\r\n                                      <img src="http://localhost/sikul/assets/themes/admin/img/email/icon-twitter.jpg" width="30" alt="icon-twitter" style="max-width:30px;" border="0" hspace="0" vspace="0">  \r\n                                    </a>\r\n                                  </td>\r\n                                  <td style="padding-left:5px; " height="50" align="center" valign="middle" class="clear-padding">\r\n                                    <a href="#">\r\n                                      <img src="http://localhost/sikul/assets/themes/admin/img/email/icon-googleplus.jpg" width="30" alt="icon-googleplus" style="max-width:30px;" border="0" hspace="0" vspace="0">  \r\n                                    </a>\r\n                                  </td>\r\n                                  <td style="padding-left:5px;" height="50" align="center" valign="middle" class="clear-padding">\r\n                                    <a href="#">\r\n                                      <img src="http://localhost/sikul/assets/themes/admin/img/email/icon-rss.jpg" width="30" alt="icon-rss" style="max-width:30px;" border="0" hspace="0" vspace="0">  \r\n                                    </a>\r\n                                  </td>\r\n                                  <td style="padding-left:5px;" height="50" align="center" valign="middle" class="clear-padding">\r\n                                    <a href="#">\r\n                                      </a></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>', 'live', 3, 1402070442, NULL, NULL),
	(2, 'General', 'general', 'This is General Email template', '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">\r\n<meta name="viewport" content="initial-scale=1.0"> \r\n<meta name="format-detection" content="telephone=no">\r\n<title>Church Email</title>\r\n<style type="text/css">\r\n\r\n/* Resets: see reset.css for details */\r\n.ReadMsgBody { width: 100%; background-color: #ffffff;}\r\n.ExternalClass {width: 100%; background-color: #ffffff;}\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height:100%;}\r\nhtml{width: 100%; }\r\nbody {-webkit-text-size-adjust:none; -ms-text-size-adjust:none; }\r\nbody {margin:0; padding:0;}\r\ntable {border-spacing:0;}\r\nimg{display:block !important;}\r\n\r\ntable td {border-collapse:collapse;}\r\n.yshortcuts a {border-bottom: none !important;}\r\n\r\n\r\n/* \r\n\r\nmain color = #2f9bbe\r\n\r\nother color = #186e8a\r\n\r\n\r\n*/\r\n\r\n\r\nimg{height:auto !important;}\r\n\r\n\r\n@media only screen and (max-width: 640px){\r\n  body{\r\n    width:auto!important;\r\n  }\r\n\r\n  table[class="container"]{\r\n    width: 100%!important;\r\n    padding-left: 20px!important; \r\n    padding-right: 20px!important; \r\n  }\r\n\r\n  img[class="image-100-percent"]{\r\n    width:100% !important;\r\n    height:auto !important;\r\n    max-width:100% !important;\r\n  }\r\n\r\n  img[class="small-image-100-percent"]{\r\n    width:100% !important;\r\n    height:auto !important;\r\n  }\r\n\r\n  table[class="full-width"]{\r\n    width:100% !important;\r\n  }\r\n\r\n  table[class="full-width-text"]{\r\n    width:100% !important;\r\n     background-color:#186e8a;\r\n     padding-left:20px !important;\r\n     padding-right:20px !important;\r\n  }\r\n\r\n  table[class="full-width-text2"]{\r\n    width:100% !important;\r\n     background-color:#f3f3f3;\r\n     padding-left:20px !important;\r\n     padding-right:20px !important; \r\n  }\r\n\r\n  table[class="col-2-3img"]{\r\n    width:50% !important;\r\n    margin-right: 20px !important;\r\n  }\r\n    table[class="col-2-3img-last"]{\r\n    width:50% !important;\r\n  }\r\n\r\n  table[class="col-2"]{\r\n    width:47% !important;\r\n    margin-right:20px !important;\r\n  }\r\n\r\n  table[class="col-2-last"]{\r\n    width:47% !important;\r\n  }\r\n\r\n  table[class="col-3"]{\r\n    width:29% !important;\r\n    margin-right:20px !important;\r\n  }\r\n\r\n  table[class="col-3-last"]{\r\n    width:29% !important;\r\n  }\r\n\r\n  table[class="row-2"]{\r\n    width:50% !important;\r\n  }\r\n\r\n  td[class="text-center"]{\r\n     text-align: center !important;\r\n   }\r\n\r\n  /* start clear and remove*/\r\n  table[class="remove"]{\r\n    display:none !important;\r\n  }\r\n\r\n  td[class="remove"]{\r\n    display:none !important;\r\n  }\r\n  /* end clear and remove*/\r\n\r\n  table[class="fix-box"]{\r\n    padding-left:20px !important;\r\n    padding-right:20px !important;\r\n  }\r\n  td[class="fix-box"]{\r\n    padding-left:20px !important;\r\n    padding-right:20px !important;\r\n  }\r\n\r\n  td[class="font-resize"]{\r\n    font-size: 18px !important;\r\n    line-height: 22px !important;\r\n  }\r\n\r\n\r\n}\r\n\r\n\r\n\r\n@media only screen and (max-width: 479px){\r\n  body{\r\n    font-size:10px !important;\r\n  }\r\n\r\n   table[class="container2"]{\r\n    width: 100%!important; \r\n    float:none !important;\r\n  }\r\n\r\n  img[class="image-100-percent"]{\r\n    width:100% !important;\r\n    height:auto !important;\r\n    max-width:100% !important;\r\n    min-width:124px !important;\r\n  }\r\n    img[class="small-image-100-percent"]{\r\n    width:100% !important;\r\n    height:auto !important;\r\n    max-width:100% !important;\r\n    min-width:124px !important;\r\n  }\r\n\r\n  table[class="full-width"]{\r\n    width:100% !important;\r\n  }\r\n\r\n  table[class="full-width-text"]{\r\n    width:100% !important;\r\n     background-color:#186e8a;\r\n     padding-left:20px !important;\r\n     padding-right:20px !important;\r\n  }\r\n\r\n  table[class="full-width-text2"]{\r\n    width:100% !important;\r\n     background-color:#f3f3f3;\r\n     padding-left:20px !important;\r\n     padding-right:20px !important;\r\n  }\r\n\r\n\r\n\r\n  table[class="col-2"]{\r\n    width:100% !important;\r\n    margin-right:0px !important;\r\n  }\r\n\r\n  table[class="col-2-last"]{\r\n    width:100% !important;\r\n   \r\n  }\r\n\r\n  table[class="col-3"]{\r\n    width:100% !important;\r\n    margin-right:0px !important;\r\n  }\r\n\r\n  table[class="col-3-last"]{\r\n    width:100% !important;\r\n   \r\n  }\r\n\r\n    table[class="row-2"]{\r\n    width:100% !important;\r\n  }\r\n\r\n\r\n  table[id="col-underline"]{\r\n    float: none !important;\r\n    width: 100% !important;\r\n    border-bottom: 1px solid #eee;\r\n  }\r\n\r\n  td[id="col-underline"]{\r\n    float: none !important;\r\n    width: 100% !important;\r\n    border-bottom: 1px solid #eee;\r\n  }\r\n\r\n  td[class="col-underline"]{\r\n    float: none !important;\r\n    width: 100% !important;\r\n    border-bottom: 1px solid #eee;\r\n  }\r\n\r\n\r\n\r\n   /*start text center*/\r\n  td[class="text-center"]{\r\n    text-align: center !important;\r\n\r\n  }\r\n\r\n  div[class="text-center"]{\r\n    text-align: center !important;\r\n  }\r\n   /*end text center*/\r\n\r\n\r\n\r\n  /* start  clear and remove */\r\n\r\n  table[id="clear-padding"]{\r\n    padding:0 !important;\r\n  }\r\n  td[id="clear-padding"]{\r\n    padding:0 !important;\r\n  }\r\n  td[class="clear-padding"]{\r\n    padding:0 !important;\r\n  }\r\n  table[class="remove-479"]{\r\n    display:none !important;\r\n  }\r\n  td[class="remove-479"]{\r\n    display:none !important;\r\n  }\r\n  table[class="clear-align"]{\r\n    float:none !important;\r\n  }\r\n  /* end  clear and remove */\r\n\r\n  table[class="width-small"]{\r\n    width:100% !important;\r\n  }\r\n\r\n  table[class="fix-box"]{\r\n    padding-left:0px !important;\r\n    padding-right:0px !important;\r\n  }\r\n  td[class="fix-box"]{\r\n    padding-left:0px !important;\r\n    padding-right:0px !important;\r\n  }\r\n    td[class="font-resize"]{\r\n    font-size: 14px !important;\r\n  }\r\n\r\n}\r\n@media only screen and (max-width: 320px){\r\n  table[class="width-small"]{\r\n    width:125px !important;\r\n  }\r\n  img[class="image-100-percent"]{\r\n    width:100% !important;\r\n    height:auto !important;\r\n    max-width:100% !important;\r\n    min-width:124px !important;\r\n  }\r\n\r\n}\r\n</style>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<!--start 100% wrapper (white background) -->\r\n<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#ececec;">\r\n\r\n  <!-- START TAB TOP -->\r\n    <tbody><tr>\r\n      <td valign="top">\r\n        <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="height:6px; background-color:#2f9bbe;">\r\n          <tbody><tr>\r\n            <td valign="top" height="6">\r\n              <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width" style="height:6px;">\r\n                <tbody><tr>\r\n                  <td valign="top" align="center"> \r\n                    <table width="150" align="left" border="0" cellspacing="0" cellpadding="0" class="clear-align" style="height:6px; background-color:#186e8a;">\r\n                      <tbody><tr>\r\n                        <td valign="top" height="6"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n  <!-- END TAB TOP -->\r\n\r\n  <!--START TOP NAVIGATION ?LAYOUT-->\r\n  <tr>\r\n    <td align="center" valign="top" class="fix-box">\r\n      \r\n      <!-- start top navigation container -->\r\n      <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="container" bgcolor="#ffffff" style="background-color:#ffffff;">\r\n      \r\n        <tbody><tr>\r\n          <td valign="top">\r\n              \r\n\r\n            <!-- start top navigaton -->\r\n            <table width="560" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width">\r\n              <tbody><tr>\r\n                <td valign="top">\r\n                \r\n                <table align="left" border="0" cellspacing="0" cellpadding="0" class="container2">\r\n                 \r\n                  <tbody><tr>\r\n                    <td align="center" valign="middle">\r\n                       <a href="#"><img src="http://localhost/kanisa/assets/themes/admin/img/logo.png" width="124" style="max-width:124px;" alt="Logo" border="0" hspace="0" vspace="0"></a>\r\n                    </td>\r\n                  </tr>\r\n\r\n                </tbody></table>\r\n\r\n                <!--start content nav -->\r\n                <table border="0" align="right" cellpadding="0" cellspacing="0" class="container2">\r\n\r\n                   <tbody><tr>\r\n                    <td height="20" valign="top" class="remove-479"></td>\r\n                  </tr>\r\n\r\n                   <!--start call us -->\r\n                  <tr>\r\n                     <td valign="top" align="center">\r\n                    \r\n                    <table align="right" border="0" cellpadding="0" cellspacing="0" class="clear-align">\r\n                      <tbody><tr>\r\n                      \r\n\r\n                        <td style="font-size: 13px;  line-height: 18px; color: #555555;  font-weight:normal; text-align: center; font-family:Arail,Tahoma, Helvetica, Arial, sans-serif;">\r\n\r\n                          <span style="color: #2f9bbe;">CALL US</span>\r\n                          +254 721 341 214\r\n                        </td>\r\n                      </tr>\r\n\r\n                    </tbody></table>\r\n                    </td>\r\n                  </tr>\r\n                  <!--end call us -->\r\n\r\n                  <!-- start space height -->\r\n                   <tr>\r\n                    <td height="10" valign="top"></td>\r\n                  </tr>\r\n                  <!-- start space height -->\r\n\r\n\r\n                  <!--start view online -->\r\n                  <tr>\r\n                    <td valign="top" align="center">\r\n                    \r\n                    <table align="right" border="0" cellpadding="0" cellspacing="0" class="clear-align">\r\n\r\n                      <tbody><tr>\r\n                      \r\n                        <td align="center" style="font-size: 13px;  line-height: 18px; color: #555555;  font-weight:normal; text-align: center; font-family:Arail,Tahoma, Helvetica, Arial, sans-serif;">\r\n\r\n                          <span style="color: #2f9bbe;">View online</span>\r\n                          \r\n                        </td>\r\n                      </tr>\r\n\r\n                    </tbody></table>\r\n                    </td>\r\n                  </tr>\r\n                  <!--end view online -->\r\n                  \r\n                \r\n                   <tr>\r\n                    <td height="20" valign="top"></td>\r\n                  </tr>\r\n\r\n                </tbody></table>\r\n                <!--end content nav -->\r\n\r\n               </td>\r\n             </tr>\r\n			 <tr>\r\n		   <td align="center" valign="top" class="fix-box">\r\n			 <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="container" style="background-color:#ffffff;">\r\n			   <tbody>\r\n			   <tr>\r\n				 <td valign="top" align="center" style="background-color:#ffffff;">\r\n				   <a href="#">\r\n					 <img class="image-100-percent" src="http://localhost/church/assets/themes/admin/img/email/Divider.png" height="9" alt="Divider" style="display:block; max-height:9px; " border="0" hspace="0" vspace="0"> \r\n				   </a>\r\n				 </td>\r\n               </tr>\r\n     </tbody></table>\r\n   </td>\r\n </tr>\r\n           </tbody></table>\r\n           <!-- end top navigaton -->\r\n          </td>\r\n        </tr>\r\n      </tbody></table>\r\n      <!-- end top navigation container -->\r\n\r\n    </td>\r\n  </tr>\r\n   <!--END TOP NAVIGATION ?LAYOUT-->\r\n\r\n   \r\n <!-- START LAYOUT 11 --> \r\n<tr>\r\n <td align="center" valign="top" class="fix-box">\r\n  <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width">\r\n    <tbody><tr>\r\n      <td valign="top">\r\n        \r\n\r\n      \r\n\r\n   <!-- start layout-11 container width 600px --> \r\n   <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="container" bgcolor="#ffffff" style="background-color: #ffffff; ">\r\n\r\n\r\n     <tbody><tr>\r\n       <td valign="top">\r\n\r\n         <!-- start layout-11 container width 560px --> \r\n         <table width="560" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width" bgcolor="#ffffff" style="background-color: #ffffff;">\r\n\r\n\r\n           <!-- start image content --> \r\n           <tbody><tr>\r\n             <td valign="top" width="100%">\r\n\r\n\r\n\r\n\r\n              <!-- start content left -->                      \r\n              <table width="100%" border="0" cellspacing="0" cellpadding="0" align="left" class="full-width">\r\n\r\n               <!--start space height --> \r\n               <tbody><tr>\r\n                 <td height="20"></td>\r\n               </tr>\r\n               <!--end space height --> \r\n\r\n                \r\n\r\n                <!--start space height -->                      \r\n                <tr>\r\n                  <td height="20"></td>\r\n                </tr>\r\n                <!--end space height -->                      \r\n\r\n                <tr>\r\n                  <td valign="top">\r\n\r\n                    <table border="0" cellspacing="0" cellpadding="0" align="left">\r\n                      <tbody><tr>\r\n\r\n                        <!-- space width -->                      \r\n                        <td valign="top">\r\n                          <table width="20" border="0" cellspacing="0" cellpadding="0" align="left">\r\n                            <tbody><tr>\r\n                              <td valign="top"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                        <!-- space width -->                      \r\n\r\n                         <!-- start text content --> \r\n                         <td valign="top">\r\n                           <table width="100%" border="0" cellspacing="0" cellpadding="0" align="left" class="width-small">\r\n                            \r\n                             <tbody><tr>\r\n                               <td style="font-size: 13px; line-height: 22px; font-family:Arial,Tahoma, Helvetica, sans-serif; color:#a3a2a2; font-weight:normal; text-align:left; ">\r\n                                   From: [FROM]<br> \r\n								   To: [TO]<br>\r\n                                  REF: <b style="text-decoration:underline">[SUBJECT]</b><br>\r\n								 \r\n								 \r\n                                  [DESCRIPTION]\r\n                                 \r\n\r\n                               </td>\r\n                             </tr> \r\n                             <!-- start height -->\r\n                             <tr>\r\n                               <td valign="top" height="10"></td>\r\n                             </tr>\r\n                              <!-- end height -->\r\n\r\n                             <tr>\r\n                               <td style="font-size: 13px; line-height: 22px; font-family:Arial,Tahoma, Helvetica, sans-serif; color:#a3a2a2; font-weight:normal; text-align:left; ">\r\n\r\n                                   <span style="color: #2f9bbe;">www.smartchurch.com</span> : for more details. \r\n\r\n                               </td>\r\n                             </tr>                               \r\n                           </tbody></table>\r\n                         </td>\r\n                         <!-- end text content --> \r\n\r\n                      </tr>\r\n                    </tbody></table>\r\n\r\n                  </td>\r\n                </tr>\r\n\r\n                <!--start space height -->                      \r\n                <tr>\r\n                  <td height="20"></td>\r\n                </tr>\r\n                <!--end space height --> \r\n              </tbody></table>\r\n              <!-- end content left --> \r\n\r\n             </td>\r\n           </tr>\r\n           <!-- end image content --> \r\n\r\n         </tbody></table>\r\n         <!-- end layout-11 container width 560px --> \r\n       </td>\r\n     </tr>\r\n   </tbody></table>\r\n   <!-- end layout-11 container width 600px --> \r\n    </td>\r\n    </tr>\r\n\r\n  </tbody></table>\r\n </td>\r\n</tr>\r\n\r\n\r\n <!-- END LAYOUT 11 --> \r\n\r\n\r\n\r\n  <!-- start bottom angle finish layout-->\r\n    <tr>\r\n      <td valign="top" class="fix-box">\r\n        <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width">\r\n          <tbody><tr>\r\n            <td valign="top" width="20">\r\n              <table width="20" align="left" border="0" cellspacing="0" cellpadding="0">\r\n                <tbody><tr>\r\n\r\n                  <td valign="top" align="left">\r\n                    <a href="#">\r\n                      <img src="http://localhost/church/assets/themes/admin/img/email/Angle-top-left.png" width="20" alt="Angle-top-left" style="display:block; max-width:20px; " border="0" hspace="0" vspace="0">            \r\n                    </a>\r\n                  </td>\r\n\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n\r\n            <td valign="top">\r\n             <table width="560" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width" bgcolor="#b4b3b3" style="background-color: #b4b3b3; ">\r\n               <tbody><tr>\r\n\r\n                 <td valign="top" align="center" height="20" bgcolor="#b4b3b3" style="background-color: #b4b3b3; "></td>\r\n\r\n               </tr>\r\n             </tbody></table>\r\n            </td>\r\n\r\n          <td valign="top" width="20">\r\n              <table width="20" align="left" border="0" cellspacing="0" cellpadding="0">\r\n                <tbody><tr>\r\n\r\n                  <td valign="top" align="left">\r\n                    <a href="#">\r\n                      <img src="http://localhost/church/assets/themes/admin/img/email/Angle-top-right.png" width="20" alt="Angle-top-left" style="display:block; max-width:20px; " border="0" hspace="0" vspace="0">            \r\n                    </a>\r\n                  </td>\r\n\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <!-- end bottom angle finish layout-->\r\n\r\n\r\n<!-- START FOOTER layout-->\r\n  <tr>\r\n    <td align="center" valign="top" bgcolor="#ffffff" style="background-color: #ffffff; ">\r\n\r\n      <!-- start top navigation container -->  \r\n      <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="container" bgcolor="#ffffff">\r\n        <tbody><tr>\r\n          <td valign="top">\r\n\r\n            <table width="560" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width" bgcolor="#ffffff">\r\n              <!--start space height -->                      \r\n              <tbody><tr>\r\n                <td height="10"></td>\r\n              </tr>\r\n              <!--end space height --> \r\n              <tr>\r\n                <td valign="top">\r\n\r\n\r\n                  <!-- start logo footer and address -->  \r\n                  <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">\r\n                    <tbody><tr>\r\n                      <td valign="top">\r\n\r\n                        <table width="300" align="left" border="0" cellspacing="0" cellpadding="0" class="full-width">\r\n                          <tbody><tr>\r\n                            <td>\r\n                              <table align="left" border="0" cellspacing="0" cellpadding="0" class="full-width">\r\n\r\n                                <tbody><tr>\r\n                                  <td align="center" valign="middle">\r\n                                    <a href="#">\r\n                                      <img src="http://localhost/kanisa/assets/themes/admin/img/logo.png" width="124" style="max-width:124px;" alt="Logo" border="0" hspace="0" vspace="0">                        \r\n                                    </a>\r\n                                  </td>\r\n                                </tr>\r\n\r\n                              </tbody></table>\r\n                            </td>\r\n                          </tr>\r\n\r\n                          <tr>\r\n                            <td valign="top" align="center" style="font-size: 13px; line-height: 22px; font-family: Helvetica, sans-serif,Arial,Tahoma; color:#6d6d6d; font-weight:normal; text-align:left;" class="text-center">\r\n                              \r\n                                Company Name : <span style="color: #6d6d6d; font-weight: normal;">Smart church</span> <br>                 \r\n                                Mail Us : <span style="color: #2f9bbe; font-weight: normal;"><a href="#" style="text-decoration: none; color: #2f9bbe; font-weight: normal;">info@smartchurch.com</a> </span><br>\r\n                               Call Us : (254) 721 341 214\r\n\r\n                            </td>\r\n                          </tr>\r\n\r\n                        </tbody></table>\r\n\r\n                        <!--start icon socail navigation -->  \r\n                        <table border="0" align="right" cellpadding="0" cellspacing="0" class="container">\r\n\r\n                           <!--start space height -->                      \r\n                          <tbody><tr>\r\n                            <td height="20"></td>\r\n                          </tr>\r\n                          <!--end space height --> \r\n\r\n                           <tr>\r\n                            <td style="font-size: 22px; line-height: 24px; font-family: Arial,Tahoma,Helvetica, sans-serif; color:#555555; font-weight:normal; text-align:left; " class="text-center"><span style="color: #555555; font-weight: normal;">Smart<a href="#" style="text-decoration: none; color: #555555; font-weight: normal;">&nbsp;<span style="color:#2f9bbe;">Church</span><br> \r\n                                    <span style="color:#a3a2a2; font-size:12px; line-height: 16px; font-weight: normal;">FOLLOW US ON SOCAIL</span>\r\n                                 \r\n                                </a>\r\n                              </span>\r\n                            </td>\r\n                          </tr>\r\n\r\n                          <tr>\r\n                            <td valign="top" align="left">\r\n\r\n                              <table border="0" align="left" cellpadding="0" cellspacing="0" class="container">\r\n                                <tbody><tr>\r\n                                  <td height="50" align="center" valign="middle" class="clear-padding">\r\n                                    <a href="#">\r\n                                      <img src="http://localhost/church/assets/themes/admin/img/email/icon-facebook.jpg" width="30" alt="icon-facebook" style="max-width:33px;" border="0" hspace="0" vspace="0">  \r\n                                    </a>\r\n                                  </td>\r\n                                  <td style="padding-left:5px; " height="50" align="center" valign="middle" class="clear-padding">\r\n                                    <a href="#">\r\n                                      <img src="http://localhost/church/assets/themes/admin/img/email/icon-twitter.jpg" width="30" alt="icon-twitter" style="max-width:30px;" border="0" hspace="0" vspace="0">  \r\n                                    </a>\r\n                                  </td>\r\n                                  <td style="padding-left:5px; " height="50" align="center" valign="middle" class="clear-padding">\r\n                                    <a href="#">\r\n                                      <img src="http://localhost/church/assets/themes/admin/img/email/icon-googleplus.jpg" width="30" alt="icon-googleplus" style="max-width:30px;" border="0" hspace="0" vspace="0">  \r\n                                    </a>\r\n                                  </td>\r\n                                  <td style="padding-left:5px;" height="50" align="center" valign="middle" class="clear-padding">\r\n                                    <a href="#">\r\n                                      <img src="http://localhost/church/assets/themes/admin/img/email/icon-rss.jpg" width="30" alt="icon-rss" style="max-width:30px;" border="0" hspace="0" vspace="0">  \r\n                                    </a>\r\n                                  </td>\r\n                                  <td style="padding-left:5px;" height="50" align="center" valign="middle" class="clear-padding">\r\n                                    <a href="#">\r\n                                      </a></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>', 'live', 3, 1402070603, NULL, NULL);
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;


-- Dumping structure for table agcchurch.employee_allowances
CREATE TABLE IF NOT EXISTS `employee_allowances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_id` int(11) DEFAULT NULL,
  `allowance_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.employee_allowances: ~0 rows (approximately)
/*!40000 ALTER TABLE `employee_allowances` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_allowances` ENABLE KEYS */;


-- Dumping structure for table agcchurch.employee_deductions
CREATE TABLE IF NOT EXISTS `employee_deductions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_id` int(11) DEFAULT NULL,
  `deduction_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.employee_deductions: ~0 rows (approximately)
/*!40000 ALTER TABLE `employee_deductions` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_deductions` ENABLE KEYS */;


-- Dumping structure for table agcchurch.events
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL DEFAULT '',
  `start_date` int(11) DEFAULT NULL,
  `end_date` int(11) DEFAULT NULL,
  `venue` varchar(256) NOT NULL DEFAULT '',
  `file` varchar(256) NOT NULL DEFAULT '',
  `status` varchar(32) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.events: ~0 rows (approximately)
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;


-- Dumping structure for table agcchurch.expenses
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT NULL,
  `item` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `person_responsible` varchar(32) NOT NULL DEFAULT '',
  `file` varchar(256) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.expenses: ~0 rows (approximately)
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;


-- Dumping structure for table agcchurch.expenses_category
CREATE TABLE IF NOT EXISTS `expenses_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.expenses_category: ~4 rows (approximately)
/*!40000 ALTER TABLE `expenses_category` DISABLE KEYS */;
INSERT INTO `expenses_category` (`id`, `name`, `description`, `created_by`, `modified_by`, `created_on`, `modified_on`) VALUES
	(1, 'Electricity', '0', 1, NULL, 1421242519, NULL),
	(2, 'Kitchen', '0', 1, NULL, 1421243203, NULL),
	(3, 'Water', '0', 1, NULL, 1423131305, NULL),
	(4, 'Cleaning', '0', 1, NULL, 1423131365, NULL);
/*!40000 ALTER TABLE `expenses_category` ENABLE KEYS */;


-- Dumping structure for table agcchurch.expenses_items
CREATE TABLE IF NOT EXISTS `expenses_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.expenses_items: ~7 rows (approximately)
/*!40000 ALTER TABLE `expenses_items` DISABLE KEYS */;
INSERT INTO `expenses_items` (`id`, `name`, `description`, `created_by`, `modified_by`, `created_on`, `modified_on`) VALUES
	(1, 'test', '', 1, NULL, 1421169935, NULL),
	(2, 'Rice', '0', 1, NULL, 1421170331, NULL),
	(3, 'Mangose', '0', 1, NULL, 1421170377, NULL),
	(4, 'Electricity', '0', 1, NULL, 1421242276, NULL),
	(5, 'Water', '0', 1, NULL, 1421848704, NULL),
	(6, 'Carpet', '0', 1, NULL, 1423131374, NULL),
	(7, 'Soap', '0', 1, NULL, 1432634684, NULL);
/*!40000 ALTER TABLE `expenses_items` ENABLE KEYS */;


-- Dumping structure for table agcchurch.files
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL DEFAULT '',
  `type` varchar(32) NOT NULL DEFAULT '',
  `file` varchar(256) NOT NULL DEFAULT '',
  `fpath` varchar(256) NOT NULL DEFAULT '',
  `Column 6` varchar(256) NOT NULL DEFAULT '',
  `filesize` varchar(256) NOT NULL DEFAULT '',
  `folder` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.files: ~0 rows (approximately)
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;


-- Dumping structure for table agcchurch.folders
CREATE TABLE IF NOT EXISTS `folders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.folders: ~0 rows (approximately)
/*!40000 ALTER TABLE `folders` DISABLE KEYS */;
/*!40000 ALTER TABLE `folders` ENABLE KEYS */;


-- Dumping structure for table agcchurch.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table agcchurch.groups: ~4 rows (approximately)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `description`, `created_by`, `modified_by`, `created_on`, `modified_on`) VALUES
	(1, 'admin', 'Administrator', NULL, NULL, NULL, NULL),
	(2, 'members', 'General Users', NULL, 1, NULL, 1379858359),
	(3, 'committee', 'Committee Members', 1, 1, 1379858307, 1422967213),
	(4, 'pastor', 'Church Pastors', 1, 1, 1422970174, 1422970198);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;


-- Dumping structure for table agcchurch.group_permissions
CREATE TABLE IF NOT EXISTS `group_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `campus_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table agcchurch.group_permissions: ~20 rows (approximately)
/*!40000 ALTER TABLE `group_permissions` DISABLE KEYS */;
INSERT INTO `group_permissions` (`id`, `group_id`, `resource_id`, `campus_id`, `created_by`, `modified_by`, `created_on`, `modified_on`) VALUES
	(1, 4, 1, NULL, 1, 1, 1431426075, 1431599246),
	(2, 4, 2, NULL, 1, 1, 1431426211, 1431599246),
	(3, 4, 5, NULL, 1, NULL, 1431426211, NULL),
	(4, 4, 10, NULL, 1, NULL, 1431426211, NULL),
	(5, 4, 11, NULL, 1, NULL, 1431426211, NULL),
	(6, 4, 15, NULL, 1, NULL, 1431426211, NULL),
	(7, 4, 16, NULL, 1, NULL, 1431426212, NULL),
	(8, 4, 19, NULL, 1, NULL, 1431426212, NULL),
	(9, 4, 21, NULL, 1, NULL, 1431426212, NULL),
	(10, 4, 27, NULL, 1, NULL, 1431426212, NULL),
	(11, 4, 28, NULL, 1, NULL, 1431426212, NULL),
	(12, 4, 29, NULL, 1, NULL, 1431426212, NULL),
	(13, 4, 30, NULL, 1, NULL, 1431426212, NULL),
	(14, 4, 31, NULL, 1, NULL, 1431426212, NULL),
	(15, 4, 32, NULL, 1, NULL, 1431426212, NULL),
	(16, 4, 33, NULL, 1, NULL, 1431426212, NULL),
	(17, 4, 39, NULL, 1, NULL, 1431426212, NULL),
	(18, 4, 42, NULL, 1, NULL, 1431426212, NULL),
	(19, 4, 47, NULL, 1, NULL, 1431426212, NULL),
	(20, 4, 3, NULL, 1, NULL, 1431599246, NULL);
/*!40000 ALTER TABLE `group_permissions` ENABLE KEYS */;


-- Dumping structure for table agcchurch.hbcs
CREATE TABLE IF NOT EXISTS `hbcs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '',
  `estate` varchar(256) NOT NULL DEFAULT '',
  `meeting_day` varchar(32) NOT NULL DEFAULT '',
  `meeting_time` varchar(50) DEFAULT NULL,
  `overall_leader` varchar(32) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.hbcs: ~0 rows (approximately)
/*!40000 ALTER TABLE `hbcs` DISABLE KEYS */;
/*!40000 ALTER TABLE `hbcs` ENABLE KEYS */;


-- Dumping structure for table agcchurch.hbc_meetings
CREATE TABLE IF NOT EXISTS `hbc_meetings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT NULL,
  `hbc` varchar(32) NOT NULL DEFAULT '',
  `host` varchar(256) NOT NULL DEFAULT '',
  `hosts_phone_no` varchar(256) NOT NULL DEFAULT '',
  `house_number` varchar(256) NOT NULL DEFAULT '',
  `service_leader` varchar(32) NOT NULL DEFAULT '',
  `preacher` varchar(256) NOT NULL DEFAULT '',
  `brief_description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.hbc_meetings: ~0 rows (approximately)
/*!40000 ALTER TABLE `hbc_meetings` DISABLE KEYS */;
/*!40000 ALTER TABLE `hbc_meetings` ENABLE KEYS */;


-- Dumping structure for table agcchurch.hymns_manager
CREATE TABLE IF NOT EXISTS `hymns_manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hymn_title` varchar(256) NOT NULL DEFAULT '',
  `composer` varchar(256) NOT NULL DEFAULT '',
  `category` varchar(32) NOT NULL DEFAULT '',
  `lyrics` text,
  `file` varchar(256) NOT NULL DEFAULT '',
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.hymns_manager: ~0 rows (approximately)
/*!40000 ALTER TABLE `hymns_manager` DISABLE KEYS */;
/*!40000 ALTER TABLE `hymns_manager` ENABLE KEYS */;


-- Dumping structure for table agcchurch.meetings
CREATE TABLE IF NOT EXISTS `meetings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL DEFAULT '',
  `start_date` int(11) DEFAULT NULL,
  `end_date` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `venue` varchar(256) NOT NULL DEFAULT '',
  `others` varchar(256) DEFAULT NULL,
  `importance` varchar(256) NOT NULL DEFAULT '',
  `guests` varchar(32) NOT NULL DEFAULT '',
  `sms_alert` varchar(32) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.meetings: ~0 rows (approximately)
/*!40000 ALTER TABLE `meetings` DISABLE KEYS */;
/*!40000 ALTER TABLE `meetings` ENABLE KEYS */;


-- Dumping structure for table agcchurch.members
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_joined` blob,
  `hbc_id` blob,
  `title` blob NOT NULL,
  `member_code` blob NOT NULL,
  `first_name` blob NOT NULL,
  `last_name` blob NOT NULL,
  `gender` blob NOT NULL,
  `dob` blob,
  `phone1` blob NOT NULL,
  `phone2` blob NOT NULL,
  `email` blob NOT NULL,
  `id_no` blob NOT NULL,
  `country` blob NOT NULL,
  `county` blob NOT NULL,
  `location` blob NOT NULL,
  `address` blob,
  `marital_status` blob NOT NULL,
  `member_status` blob NOT NULL,
  `status` blob NOT NULL,
  `passport` blob NOT NULL,
  `occupation` blob NOT NULL,
  `education_level` blob NOT NULL,
  `employer` blob NOT NULL,
  `how_joined` blob NOT NULL,
  `baptised` blob NOT NULL,
  `confirmed` blob NOT NULL,
  `description` blob,
  `created_by` blob,
  `modified_by` blob,
  `created_on` blob,
  `modified_on` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.members: ~0 rows (approximately)
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
/*!40000 ALTER TABLE `members` ENABLE KEYS */;


-- Dumping structure for table agcchurch.members_ministry_support
CREATE TABLE IF NOT EXISTS `members_ministry_support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `tithe_id` int(11) DEFAULT NULL,
  `type` varchar(256) NOT NULL DEFAULT '',
  `amount` float DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.members_ministry_support: ~0 rows (approximately)
/*!40000 ALTER TABLE `members_ministry_support` DISABLE KEYS */;
/*!40000 ALTER TABLE `members_ministry_support` ENABLE KEYS */;


-- Dumping structure for table agcchurch.members_other_contributions
CREATE TABLE IF NOT EXISTS `members_other_contributions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `tithe_id` int(11) DEFAULT NULL,
  `type` varchar(256) NOT NULL DEFAULT '',
  `amount` float DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.members_other_contributions: ~0 rows (approximately)
/*!40000 ALTER TABLE `members_other_contributions` DISABLE KEYS */;
/*!40000 ALTER TABLE `members_other_contributions` ENABLE KEYS */;


-- Dumping structure for table agcchurch.members_seed_planting
CREATE TABLE IF NOT EXISTS `members_seed_planting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `tithe_id` int(11) DEFAULT NULL,
  `type` varchar(256) NOT NULL DEFAULT '',
  `amount` float DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.members_seed_planting: ~0 rows (approximately)
/*!40000 ALTER TABLE `members_seed_planting` DISABLE KEYS */;
/*!40000 ALTER TABLE `members_seed_planting` ENABLE KEYS */;


-- Dumping structure for table agcchurch.members_thanks_giving
CREATE TABLE IF NOT EXISTS `members_thanks_giving` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `tithe_id` varchar(256) NOT NULL DEFAULT '',
  `type` varchar(256) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table agcchurch.members_thanks_giving: ~0 rows (approximately)
/*!40000 ALTER TABLE `members_thanks_giving` DISABLE KEYS */;
/*!40000 ALTER TABLE `members_thanks_giving` ENABLE KEYS */;


-- Dumping structure for table agcchurch.members_tithe
CREATE TABLE IF NOT EXISTS `members_tithe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(256) NOT NULL DEFAULT '',
  `tithe_id` varchar(256) NOT NULL DEFAULT '',
  `type` varchar(256) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.members_tithe: ~0 rows (approximately)
/*!40000 ALTER TABLE `members_tithe` DISABLE KEYS */;
/*!40000 ALTER TABLE `members_tithe` ENABLE KEYS */;


-- Dumping structure for table agcchurch.member_groups
CREATE TABLE IF NOT EXISTS `member_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.member_groups: ~4 rows (approximately)
/*!40000 ALTER TABLE `member_groups` DISABLE KEYS */;
INSERT INTO `member_groups` (`id`, `member_id`, `group_id`, `created_by`, `modified_by`, `created_on`, `modified_on`) VALUES
	(1, 28, 3, NULL, 1, NULL, 1424772418),
	(2, 28, 2, NULL, 1, NULL, 1424772418),
	(3, 30, 4, NULL, 1, NULL, 1433246304),
	(4, 27, 2, NULL, 1, NULL, 1433246342);
/*!40000 ALTER TABLE `member_groups` ENABLE KEYS */;


-- Dumping structure for table agcchurch.member_ministries
CREATE TABLE IF NOT EXISTS `member_ministries` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` varchar(20) NOT NULL,
  `ministry_id` varchar(100) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table agcchurch.member_ministries: ~0 rows (approximately)
/*!40000 ALTER TABLE `member_ministries` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_ministries` ENABLE KEYS */;


-- Dumping structure for table agcchurch.ministries
CREATE TABLE IF NOT EXISTS `ministries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(256) NOT NULL DEFAULT '',
  `name` varchar(256) NOT NULL DEFAULT '',
  `leader` varchar(32) NOT NULL DEFAULT '',
  `telephone` varchar(256) NOT NULL DEFAULT '',
  `mobile` varchar(256) NOT NULL DEFAULT '',
  `email` varchar(256) NOT NULL DEFAULT '',
  `congregation_size` varchar(256) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.ministries: ~0 rows (approximately)
/*!40000 ALTER TABLE `ministries` DISABLE KEYS */;
/*!40000 ALTER TABLE `ministries` ENABLE KEYS */;


-- Dumping structure for table agcchurch.ministry_support
CREATE TABLE IF NOT EXISTS `ministry_support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` blob,
  `totals` blob,
  `member` blob NOT NULL,
  `amount` blob NOT NULL,
  `bank` blob NOT NULL,
  `treasurer` blob NOT NULL,
  `confirmed_by` blob NOT NULL,
  `description` blob,
  `created_by` blob,
  `modified_by` blob,
  `created_on` blob,
  `modified_on` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.ministry_support: ~0 rows (approximately)
/*!40000 ALTER TABLE `ministry_support` DISABLE KEYS */;
/*!40000 ALTER TABLE `ministry_support` ENABLE KEYS */;


-- Dumping structure for table agcchurch.new_log
CREATE TABLE IF NOT EXISTS `new_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sn_table` blob,
  `row_id` blob,
  `col` blob,
  `val` blob,
  `campus_id` blob,
  `dept` blob,
  `sent` blob,
  `flag` blob,
  `created_by` blob,
  `modified_by` blob,
  `created_on` blob,
  `modified_on` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table agcchurch.new_log: ~0 rows (approximately)
/*!40000 ALTER TABLE `new_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `new_log` ENABLE KEYS */;


-- Dumping structure for table agcchurch.offerings
CREATE TABLE IF NOT EXISTS `offerings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` blob,
  `status` blob,
  `amount` blob NOT NULL,
  `treasurer` blob NOT NULL,
  `confirmed_by` blob NOT NULL,
  `bank_deposited` blob NOT NULL,
  `description` blob,
  `created_by` blob,
  `modified_by` blob,
  `created_on` blob,
  `modified_on` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.offerings: ~0 rows (approximately)
/*!40000 ALTER TABLE `offerings` DISABLE KEYS */;
/*!40000 ALTER TABLE `offerings` ENABLE KEYS */;


-- Dumping structure for table agcchurch.other_contributions
CREATE TABLE IF NOT EXISTS `other_contributions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` blob,
  `contribution_type` blob,
  `totals` blob,
  `member` blob NOT NULL,
  `amount` blob NOT NULL,
  `bank` blob NOT NULL,
  `treasurer` blob NOT NULL,
  `confirmed_by` blob NOT NULL,
  `description` blob,
  `created_by` blob,
  `modified_by` blob,
  `created_on` blob,
  `modified_on` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.other_contributions: ~0 rows (approximately)
/*!40000 ALTER TABLE `other_contributions` DISABLE KEYS */;
/*!40000 ALTER TABLE `other_contributions` ENABLE KEYS */;


-- Dumping structure for table agcchurch.other_revenues
CREATE TABLE IF NOT EXISTS `other_revenues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT NULL,
  `project` varchar(32) NOT NULL DEFAULT '',
  `amount` varchar(256) NOT NULL DEFAULT '',
  `collected_by` varchar(32) NOT NULL DEFAULT '',
  `bank` varchar(32) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.other_revenues: ~0 rows (approximately)
/*!40000 ALTER TABLE `other_revenues` DISABLE KEYS */;
/*!40000 ALTER TABLE `other_revenues` ENABLE KEYS */;


-- Dumping structure for table agcchurch.o_sessions
CREATE TABLE IF NOT EXISTS `o_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table agcchurch.o_sessions: ~2 rows (approximately)
/*!40000 ALTER TABLE `o_sessions` DISABLE KEYS */;
INSERT INTO `o_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
	('2f3a969a6faa116d5e37cd90022f270b', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/58.0.3029.96 Chrome/58.0.3029.96 ', 1494511219, ''),
	('858ec784d52b62a2a2abf931c69b590d', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/58.0.3029.96 Chrome/58.0.3029.96 ', 1494517902, 'a:7:{s:9:"user_data";s:0:"";s:5:"email";s:12:"jj@admin.com";s:2:"id";s:1:"5";s:7:"user_id";s:1:"5";s:8:"group_id";s:1:"2";s:5:"group";s:7:"members";s:15:"flash:old:error";s:21:"Backend Access Denied";}');
/*!40000 ALTER TABLE `o_sessions` ENABLE KEYS */;


-- Dumping structure for table agcchurch.paid_pledges
CREATE TABLE IF NOT EXISTS `paid_pledges` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pledge_id` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `bank` int(11) DEFAULT NULL,
  `remarks` text NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `transaction_no` varchar(50) NOT NULL,
  `amount` float DEFAULT NULL,
  `balance` float DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table agcchurch.paid_pledges: ~0 rows (approximately)
/*!40000 ALTER TABLE `paid_pledges` DISABLE KEYS */;
/*!40000 ALTER TABLE `paid_pledges` ENABLE KEYS */;


-- Dumping structure for table agcchurch.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table agcchurch.permissions: ~21 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `group_id`, `res_id`, `route_id`, `created_by`, `modified_by`, `created_on`, `modified_on`) VALUES
	(1, 4, 2, 8, 1, NULL, 1431426211, NULL),
	(2, 4, 5, 19, 1, NULL, 1431426211, NULL),
	(3, 4, 10, 35, 1, 1, 1431426211, 1490776087),
	(4, 4, 11, 38, 1, NULL, 1431426211, NULL),
	(5, 4, 15, 51, 1, NULL, 1431426211, NULL),
	(6, 4, 16, 54, 1, NULL, 1431426212, NULL),
	(7, 4, 19, 64, 1, NULL, 1431426212, NULL),
	(8, 4, 21, 75, 1, NULL, 1431426212, NULL),
	(9, 4, 27, 107, 1, NULL, 1431426212, NULL),
	(10, 4, 28, 113, 1, NULL, 1431426212, NULL),
	(11, 4, 29, 116, 1, NULL, 1431426212, NULL),
	(12, 4, 30, 119, 1, NULL, 1431426212, NULL),
	(13, 4, 31, 123, 1, NULL, 1431426212, NULL),
	(14, 4, 32, 132, 1, NULL, 1431426212, NULL),
	(15, 4, 33, 138, 1, NULL, 1431426212, NULL),
	(16, 4, 39, 172, 1, NULL, 1431426212, NULL),
	(17, 4, 42, 189, 1, NULL, 1431426212, NULL),
	(18, 4, 47, 235, 1, NULL, 1431426212, NULL),
	(19, 4, 3, 12, 1, 1, 1431599246, 1494517836),
	(20, 4, 10, 37, 1, 1, 1490775584, 1490776087),
	(21, 4, 10, 36, 1, NULL, 1490776087, NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;


-- Dumping structure for table agcchurch.petty_cash
CREATE TABLE IF NOT EXISTS `petty_cash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT NULL,
  `item` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `voucher_number` varchar(256) NOT NULL DEFAULT '',
  `amount` varchar(256) NOT NULL DEFAULT '',
  `authorised_by` varchar(32) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.petty_cash: ~0 rows (approximately)
/*!40000 ALTER TABLE `petty_cash` DISABLE KEYS */;
/*!40000 ALTER TABLE `petty_cash` ENABLE KEYS */;


-- Dumping structure for table agcchurch.pledges
CREATE TABLE IF NOT EXISTS `pledges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT NULL,
  `title` varchar(256) NOT NULL DEFAULT '',
  `member` varchar(32) NOT NULL DEFAULT '',
  `amount` varchar(256) NOT NULL DEFAULT '',
  `expected_pay_date` int(11) DEFAULT NULL,
  `status` varchar(32) NOT NULL DEFAULT '',
  `remarks` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.pledges: ~0 rows (approximately)
/*!40000 ALTER TABLE `pledges` DISABLE KEYS */;
/*!40000 ALTER TABLE `pledges` ENABLE KEYS */;


-- Dumping structure for table agcchurch.prayer_requests
CREATE TABLE IF NOT EXISTS `prayer_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_date` int(11) DEFAULT NULL,
  `phone_number` varchar(256) NOT NULL DEFAULT '',
  `first_name` varchar(256) NOT NULL DEFAULT '',
  `second_name` varchar(256) NOT NULL DEFAULT '',
  `address` varchar(256) NOT NULL DEFAULT '',
  `membership` varchar(32) NOT NULL DEFAULT '',
  `prayer_request` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.prayer_requests: ~0 rows (approximately)
/*!40000 ALTER TABLE `prayer_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `prayer_requests` ENABLE KEYS */;


-- Dumping structure for table agcchurch.processed_files
CREATE TABLE IF NOT EXISTS `processed_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` blob,
  `length` blob,
  `processed` blob,
  `campus_id` blob,
  `dept` blob,
  `created_by` blob,
  `modified_by` blob,
  `created_on` blob,
  `modified_on` blob,
  `ref_id` int(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table agcchurch.processed_files: ~0 rows (approximately)
/*!40000 ALTER TABLE `processed_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `processed_files` ENABLE KEYS */;


-- Dumping structure for table agcchurch.purchase_order
CREATE TABLE IF NOT EXISTS `purchase_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_date` int(11) DEFAULT NULL,
  `supplier` int(9) NOT NULL,
  `quatity` varchar(256) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `amount` varchar(256) NOT NULL DEFAULT '',
  `vat` varchar(256) NOT NULL DEFAULT '',
  `total` varchar(256) NOT NULL DEFAULT '',
  `comment` text,
  `status` int(11) DEFAULT NULL,
  `balance` float DEFAULT NULL,
  `due_date` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table agcchurch.purchase_order: ~0 rows (approximately)
/*!40000 ALTER TABLE `purchase_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_order` ENABLE KEYS */;


-- Dumping structure for table agcchurch.purchase_order_list
CREATE TABLE IF NOT EXISTS `purchase_order_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(9) NOT NULL,
  `quantity` float NOT NULL,
  `description` text NOT NULL,
  `unit_price` float NOT NULL,
  `totals` double NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table agcchurch.purchase_order_list: ~0 rows (approximately)
/*!40000 ALTER TABLE `purchase_order_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_order_list` ENABLE KEYS */;


-- Dumping structure for table agcchurch.purchase_order_payment
CREATE TABLE IF NOT EXISTS `purchase_order_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` blob NOT NULL,
  `amount` blob NOT NULL,
  `date` blob NOT NULL,
  `pay_type` blob NOT NULL,
  `account` blob NOT NULL,
  `remarks` blob NOT NULL,
  `created_by` blob,
  `modified_by` blob,
  `created_on` blob,
  `modified_on` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table agcchurch.purchase_order_payment: ~0 rows (approximately)
/*!40000 ALTER TABLE `purchase_order_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_order_payment` ENABLE KEYS */;


-- Dumping structure for table agcchurch.record_salaries
CREATE TABLE IF NOT EXISTS `record_salaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_date` int(11) DEFAULT NULL,
  `employee` int(11) DEFAULT NULL,
  `basic_salary` float DEFAULT NULL,
  `total_deductions` float DEFAULT NULL,
  `total_allowance` float DEFAULT NULL,
  `nhif` float DEFAULT NULL,
  `advance` float DEFAULT NULL,
  `bank_details` text NOT NULL,
  `month` varchar(50) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `deductions` text NOT NULL,
  `allowances` text NOT NULL,
  `nhif_no` varchar(255) NOT NULL,
  `nssf_no` varchar(255) NOT NULL,
  `salary_method` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.record_salaries: ~0 rows (approximately)
/*!40000 ALTER TABLE `record_salaries` DISABLE KEYS */;
/*!40000 ALTER TABLE `record_salaries` ENABLE KEYS */;


-- Dumping structure for table agcchurch.relatives
CREATE TABLE IF NOT EXISTS `relatives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL DEFAULT '0',
  `first_name` varchar(256) NOT NULL DEFAULT '',
  `last_name` varchar(256) NOT NULL DEFAULT '',
  `gender` varchar(32) NOT NULL DEFAULT '',
  `type` varchar(32) NOT NULL DEFAULT '',
  `relationship` varchar(32) NOT NULL DEFAULT '',
  `phone` varchar(256) NOT NULL DEFAULT '',
  `location` varchar(256) NOT NULL DEFAULT '',
  `email` varchar(256) NOT NULL DEFAULT '',
  `additionals` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.relatives: ~0 rows (approximately)
/*!40000 ALTER TABLE `relatives` DISABLE KEYS */;
/*!40000 ALTER TABLE `relatives` ENABLE KEYS */;


-- Dumping structure for table agcchurch.reports
CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dtae` int(11) DEFAULT NULL,
  `title` varchar(256) NOT NULL DEFAULT '',
  `item_id` varchar(256) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.reports: ~0 rows (approximately)
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;


-- Dumping structure for table agcchurch.resources
CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resource` varchar(255) NOT NULL,
  `cat` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table agcchurch.resources: 66 rows
/*!40000 ALTER TABLE `resources` DISABLE KEYS */;
INSERT INTO `resources` (`id`, `resource`, `cat`, `description`, `created_by`, `modified_by`, `created_on`, `modified_on`) VALUES
	(1, 'address_book', '   Contacts Directory', 'Address Book', 1, 1, 1431422584, 1431432280),
	(2, 'address_book_category', '     Contacts Directory', 'Address Book Category', 1, 1, 1431422584, 1431432283),
	(3, 'advance_salary', '   Payroll', 'Advance Salary', 1, 1, 1431422584, 1431432290),
	(4, 'allowances', '   Payroll', 'Allowances', 1, 1, 1431422584, 1431432242),
	(5, 'announcements', '   Communication', 'Announcements', 1, 1, 1431422584, 1431432341),
	(6, 'asset_category', '   Assets Management', 'Asset Category', 1, 1, 1431422584, 1431432371),
	(7, 'asset_items', '      Assets Management', 'Asset Items', 1, 1, 1431422584, 1431432374),
	(8, 'asset_stock', '      Assets Management', 'Asset Stock', 1, 1, 1431422584, 1431432380),
	(9, 'bank_accounts', '   Church Accounts', 'Bank Accounts', 1, 1, 1431422584, 1431432394),
	(10, 'baptism', '    Members Management ', 'Baptism', 1, 1, 1431422584, 1431432597),
	(11, 'bible_quotes', 'Resources', 'Bible Quotes', 1, 1, 1431422584, 1431433079),
	(12, 'cfd_parents', '    Members Management ', 'Dedication Parents', 1, 1, 1431422584, 1431433472),
	(13, 'contribution_types', '      Church Accounts', 'Contribution Types', 1, 1, 1431422584, 1431432400),
	(14, 'current', '', 'Current', 1, NULL, 1431422584, NULL),
	(15, 'daily_inspirations', 'Resources', 'Daily Inspiration', 1, 1, 1431422584, 1431433450),
	(16, 'dedications', 'Members Management', 'Dedications', 1, 1, 1431422584, 1431432995),
	(17, 'deductions', 'Payroll', 'Deductions', 1, 1, 1431422584, 1431433261),
	(18, 'donations', 'Church Accounts', 'Donations', 1, 1, 1431422584, 1431433288),
	(19, 'email_templates', 'Communication', 'Email Templates', 1, 1, 1431422584, 1431433295),
	(20, 'emails', 'Communication', 'Emails', 1, 1, 1431422584, 1431433299),
	(21, 'events', 'Communication', 'Events', 1, 1, 1431422584, 1431433303),
	(22, 'expenses', 'Church Accounts', 'Expenses', 1, 1, 1431422584, 1431432987),
	(23, 'expenses_category', 'Church Accounts', 'Expenses Category', 1, 1, 1431422584, 1431432981),
	(24, 'expenses_items', 'Church Accounts', 'Expenses Items', 1, 1, 1431422584, 1431432976),
	(25, 'files', 'Communication', 'Files', 1, 1, 1431422584, 1431433310),
	(26, 'groups', '', 'Groups', 1, NULL, 1431422584, NULL),
	(27, 'hbc_meetings', 'Members Management', 'HBC Meetings', 1, 1, 1431422584, 1431433436),
	(28, 'hbcs', 'Members Management', 'HBCs', 1, 1, 1431422584, 1431433430),
	(29, 'hymns_manager', 'Resources', 'Hymns Manager', 1, 1, 1431422584, 1431433109),
	(30, 'meetings', 'Communication', 'Meetings', 1, 1, 1431422584, 1431433118),
	(31, 'members', 'Members Management', 'Members', 1, 1, 1431422584, 1431432958),
	(32, 'ministries', 'Members Management', 'Ministries', 1, 1, 1431422584, 1431432952),
	(33, 'ministry_support', 'Members Management', 'Ministry Support', 1, 1, 1431422584, 1431432944),
	(34, 'offerings', 'Church Accounts', 'Offerings', 1, 1, 1431422584, 1431432937),
	(35, 'other_contributions', 'Church Accounts', 'Other Contributions', 1, 1, 1431422584, 1431432931),
	(36, 'permissions', '', 'Permissions', 1, NULL, 1431422584, NULL),
	(37, 'petty_cash', 'Church Accounts', 'Petty Cash', 1, 1, 1431422584, 1431432862),
	(38, 'pledges', 'Church Accounts', 'Pledges', 1, 1, 1431422584, 1431432856),
	(39, 'prayer_requests', 'Resources', 'Prayer Requests', 1, 1, 1431422584, 1431433127),
	(40, 'purchase_order', 'Church Accounts', 'Purchase Order', 1, 1, 1431422584, 1431432849),
	(41, 'record_salaries', 'Payroll', 'Record Salaries', 1, 1, 1431422584, 1431433245),
	(42, 'relatives', '    Members Management ', 'Relatives', 1, 1, 1431422584, 1431432684),
	(43, 'reports', 'Reports', 'Reports', 1, 1, 1431422584, 1431433138),
	(44, 'salaries', 'Payroll', 'Salaries', 1, 1, 1431422584, 1431433240),
	(45, 'sandbox', '', 'Sandbox', 1, NULL, 1431422584, NULL),
	(46, 'seed_planting', 'Church Accounts', 'Seed Planting', 1, 1, 1431422584, 1431432830),
	(47, 'sermons', 'Resources', 'Sermons', 1, 1, 1431422584, 1431433147),
	(48, 'settings', 'Settings', 'Settings', 1, 1, 1431422584, 1431433228),
	(49, 'sms', 'Communication', 'Sms', 1, 1, 1431422584, 1431433222),
	(50, 'sms_subscriptions', 'Communication', 'Sms Subscriptions', 1, 1, 1431422584, 1431433212),
	(51, 'ss_parents', 'Members Management', 'Sunday School Parents', 1, 1, 1431422584, 1431433390),
	(52, 'sunday_school', 'Members Management', 'Sunday School', 1, 1, 1431422584, 1431432816),
	(53, 'take_stock', 'Assets Management', 'Take Stock', 1, 1, 1431422584, 1431433200),
	(54, 'task_manager', 'Resources', 'Task Manager', 1, 1, 1431422584, 1431433188),
	(55, 'tax_config', 'Payroll', 'Tax Config', 1, 1, 1431422584, 1431433171),
	(56, 'testmodes', '', 'Testmodes', 1, NULL, 1431422584, NULL),
	(57, 'thanks_giving', 'Members Management', 'Thanks Giving', 1, 1, 1431422584, 1431432808),
	(58, 'tithes', '      Church Accounts', 'Tithes', 1, 1, 1431422584, 1431432480),
	(59, 'tools', '', 'Tools', 1, NULL, 1431422584, NULL),
	(60, 'users', '', 'Users', 1, NULL, 1431422584, NULL),
	(61, 'visitors', 'Members Management ', 'Visitors', 1, 1, 1431422584, 1431432801),
	(62, 'weddings', 'Resources', 'Weddings', 1, 1, 1431422584, 1431432785),
	(63, 'allocations', '', 'Allocations', 1, NULL, 1433680342, NULL),
	(64, 'allocations_expenditure', '', 'Allocations Expenditure', 1, NULL, 1433680342, NULL),
	(65, 'folders', '', 'Folders', 1, NULL, 1433680342, NULL),
	(66, 'video_sermons', '', 'Video Sermons', 1, NULL, 1433680343, NULL);
/*!40000 ALTER TABLE `resources` ENABLE KEYS */;


-- Dumping structure for table agcchurch.routes
CREATE TABLE IF NOT EXISTS `routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resource` int(11) NOT NULL,
  `method` varchar(255) NOT NULL,
  `is_menu` tinyint(4) NOT NULL,
  `description` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=310 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table agcchurch.routes: 309 rows
/*!40000 ALTER TABLE `routes` DISABLE KEYS */;
INSERT INTO `routes` (`id`, `resource`, `method`, `is_menu`, `description`, `icon`, `created_by`, `modified_by`, `created_on`, `modified_on`) VALUES
	(1, 1, 'index', 1, 'Address Book', 'clip-list', 1, NULL, 1431424708, NULL),
	(2, 1, 'customers', 1, 'Customers Address Book', '', 1, NULL, 1431424708, NULL),
	(3, 1, 'suppliers', 1, 'Suppliers Address Book', '', 1, NULL, 1431424708, NULL),
	(4, 1, 'others', 1, 'Others Address Book', '', 1, NULL, 1431424708, NULL),
	(5, 1, 'quick_add', 0, 'Quick Add Address Book', '', 1, 1, 1431424708, 1436884553),
	(6, 1, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424708, NULL),
	(7, 1, 'edit', 1, 'Edit Address Book', 'clip-pencil', 1, NULL, 1431424708, NULL),
	(8, 2, 'index', 1, 'Address Book Category', 'clip-list', 1, NULL, 1431424708, NULL),
	(9, 2, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424708, NULL),
	(10, 2, 'quick_add', 1, 'Quick Add Category', '', 1, 1, 1431424708, 1431425312),
	(11, 2, 'edit', 1, 'Edit Category', 'clip-pencil', 1, 1, 1431424708, 1431425342),
	(12, 3, 'index', 1, 'Advance Salary', 'clip-list', 1, NULL, 1431424708, NULL),
	(13, 3, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424708, NULL),
	(14, 3, 'edit', 1, 'Edit Advance Salary', 'clip-pencil', 1, NULL, 1431424708, NULL),
	(15, 3, 'void', 1, 'Void Advance Salary', 'clip-close-4', 1, NULL, 1431424708, NULL),
	(16, 4, 'index', 1, 'Allowances', 'clip-list', 1, NULL, 1431424708, NULL),
	(17, 4, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424708, NULL),
	(18, 4, 'edit', 1, 'Edit Allowances', 'clip-pencil', 1, NULL, 1431424708, NULL),
	(19, 5, 'index', 1, 'Announcements', 'clip-list', 1, NULL, 1431424708, NULL),
	(20, 5, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424708, NULL),
	(21, 5, 'edit', 1, 'Edit Announcements', 'clip-pencil', 1, NULL, 1431424708, NULL),
	(22, 6, 'index', 1, 'Asset Category', 'clip-list', 1, NULL, 1431424708, NULL),
	(23, 6, 'quick_add', 1, 'Quick Add', '', 1, 1, 1431424708, 1431425293),
	(24, 6, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424708, NULL),
	(25, 6, 'edit', 1, 'Edit Asset Category', 'clip-pencil', 1, NULL, 1431424708, NULL),
	(26, 7, 'index', 1, 'Asset Items', 'clip-list', 1, NULL, 1431424709, NULL),
	(27, 7, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(28, 7, 'edit', 1, 'Edit Asset Items', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(29, 8, 'index', 1, 'Asset Stock', 'clip-list', 1, NULL, 1431424709, NULL),
	(30, 8, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(31, 8, 'edit', 1, 'Edit Asset Stock', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(32, 9, 'index', 1, 'Bank Accounts', 'clip-list', 1, NULL, 1431424709, NULL),
	(33, 9, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(34, 9, 'edit', 1, 'Edit Bank Accounts', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(35, 10, 'index', 1, 'Baptism', 'clip-list', 1, NULL, 1431424709, NULL),
	(36, 10, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(37, 10, 'edit', 1, 'Edit Baptism', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(38, 11, 'index', 1, 'Bible Quotes', 'clip-list', 1, NULL, 1431424709, NULL),
	(39, 11, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(40, 11, 'edit', 1, 'Edit Bible Quotes', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(41, 12, 'index', 1, 'Cfd Parents', 'clip-list', 1, NULL, 1431424709, NULL),
	(42, 12, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(43, 12, 'edit', 1, 'Edit Cfd Parents', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(44, 13, 'index', 1, 'Contribution Types', 'clip-list', 1, NULL, 1431424709, NULL),
	(45, 13, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(46, 13, 'quick_add', 1, 'Quick Add Contribution Types', '', 1, NULL, 1431424709, NULL),
	(47, 13, 'edit', 1, 'Edit Contribution Types', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(48, 14, 'index', 1, 'Current', 'clip-list', 1, NULL, 1431424709, NULL),
	(49, 14, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(50, 14, 'edit', 1, 'Edit Current', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(51, 15, 'index', 1, 'Daily Inspirations', 'clip-list', 1, NULL, 1431424709, NULL),
	(52, 15, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(53, 15, 'edit', 1, 'Edit Daily Inspirations', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(54, 16, 'index', 1, 'Dedications', 'clip-list', 1, NULL, 1431424709, NULL),
	(55, 16, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(56, 16, 'edit', 1, 'Edit Dedications', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(57, 16, 'dedicate', 1, 'Dedicate Dedications', '', 1, NULL, 1431424709, NULL),
	(58, 17, 'index', 1, 'Deductions', 'clip-list', 1, NULL, 1431424709, NULL),
	(59, 17, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(60, 17, 'edit', 1, 'Edit Deductions', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(61, 18, 'index', 1, 'Donations', 'clip-list', 1, NULL, 1431424709, NULL),
	(62, 18, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(63, 18, 'edit', 1, 'Edit Donations', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(64, 19, 'index', 1, 'Email Templates', 'clip-list', 1, NULL, 1431424709, NULL),
	(65, 19, 'import', 1, 'Import Email Templates', '', 1, NULL, 1431424709, NULL),
	(66, 19, 'export', 1, 'Export Email Templates', '', 1, NULL, 1431424709, NULL),
	(67, 19, 'help', 1, 'Help Email Templates', '', 1, NULL, 1431424709, NULL),
	(68, 19, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(69, 19, 'edit', 1, 'Edit Email Templates', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(70, 19, 'preview', 1, 'Preview Email Templates', '', 1, NULL, 1431424709, NULL),
	(71, 19, 'action', 1, 'Action Email Templates', '', 1, NULL, 1431424709, NULL),
	(72, 20, 'index', 1, 'Emails', 'clip-list', 1, NULL, 1431424709, NULL),
	(73, 20, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(74, 20, 'edit', 1, 'Edit Emails', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(75, 21, 'index', 1, 'Events', 'clip-list', 1, NULL, 1431424709, NULL),
	(76, 21, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(77, 21, 'edit', 1, 'Edit Events', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(78, 22, 'index', 1, 'Expenses', 'clip-list', 1, NULL, 1431424709, NULL),
	(79, 22, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(80, 22, 'edit', 1, 'Edit Expenses', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(81, 23, 'index', 1, 'Expenses Category', 'clip-list', 1, NULL, 1431424709, NULL),
	(82, 23, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(83, 23, 'quick_add', 1, 'Quick Add Expenses Category', '', 1, NULL, 1431424709, NULL),
	(84, 23, 'edit', 1, 'Edit Expenses Category', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(85, 24, 'index', 1, 'Expenses Items', 'clip-list', 1, NULL, 1431424709, NULL),
	(86, 24, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(87, 24, 'quick_add', 1, 'Quick Add Expenses Items', '', 1, NULL, 1431424709, NULL),
	(88, 24, 'edit', 1, 'Edit Expenses Items', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(89, 25, 'index', 1, 'Files', 'clip-list', 1, NULL, 1431424709, NULL),
	(90, 25, 'folder', 1, 'Folder Files', '', 1, NULL, 1431424709, NULL),
	(91, 25, 'get_files', 1, 'Get Files Files', '', 1, NULL, 1431424709, NULL),
	(92, 25, 'import', 1, 'Import Files', '', 1, NULL, 1431424709, NULL),
	(93, 25, 'export', 1, 'Export Files', '', 1, NULL, 1431424709, NULL),
	(94, 25, 'help', 1, 'Help Files', '', 1, NULL, 1431424709, NULL),
	(95, 25, 'files_list', 1, 'Files List Files', '', 1, NULL, 1431424709, NULL),
	(96, 25, 'files_upload', 1, 'Files Upload Files', '', 1, NULL, 1431424709, NULL),
	(97, 25, 'upload', 1, 'Upload Files', '', 1, NULL, 1431424709, NULL),
	(98, 25, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(99, 25, 'created', 1, 'Created Files', '', 1, NULL, 1431424709, NULL),
	(100, 25, 'edited', 1, 'Edited Files', '', 1, NULL, 1431424709, NULL),
	(101, 25, 'edit', 1, 'Edit Files', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(102, 25, 'preview', 1, 'Preview Files', '', 1, NULL, 1431424709, NULL),
	(103, 25, 'action', 1, 'Action Files', '', 1, NULL, 1431424709, NULL),
	(104, 26, 'index', 1, 'Groups', 'clip-list', 1, NULL, 1431424709, NULL),
	(105, 26, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(106, 26, 'edit', 1, 'Edit Groups', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(107, 27, 'index', 1, 'Hbc Meetings', 'clip-list', 1, NULL, 1431424709, NULL),
	(108, 27, 'meetings', 1, 'Meetings Hbc Meetings', '', 1, NULL, 1431424709, NULL),
	(109, 27, 'add', 1, 'Add Hbc Meetings', '', 1, NULL, 1431424709, NULL),
	(110, 27, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(111, 27, 'edit', 1, 'Edit Hbc Meetings', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(112, 28, 'upload_hbcsc', 1, 'Upload Hbcsc Hbcs', '', 1, NULL, 1431424709, NULL),
	(113, 28, 'index', 1, 'Hbcs', 'clip-list', 1, NULL, 1431424709, NULL),
	(114, 28, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(115, 28, 'edit', 1, 'Edit Hbcs', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(116, 29, 'index', 1, 'Hymns Manager', 'clip-list', 1, NULL, 1431424709, NULL),
	(117, 29, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(118, 29, 'edit', 1, 'Edit Hymns Manager', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(119, 30, 'index', 1, 'Meetings', 'clip-list', 1, NULL, 1431424709, NULL),
	(120, 30, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(121, 30, 'edit', 1, 'Edit Meetings', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(122, 31, 'add_members', 1, 'Add Members Members', '', 1, NULL, 1431424709, NULL),
	(123, 31, 'index', 1, 'Members', 'clip-users-2', 1, NULL, 1431424709, NULL),
	(124, 31, 'add_groups', 1, 'Add Groups Members', '', 1, NULL, 1431424709, NULL),
	(125, 31, 'upload_members', 1, 'Upload Members Members', '', 1, NULL, 1431424709, NULL),
	(126, 31, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(127, 31, 'update_mems', 1, 'Update Mems Members', '', 1, NULL, 1431424709, NULL),
	(128, 31, 'search', 1, 'Search Members', 'clip-search', 1, NULL, 1431424709, NULL),
	(129, 31, 'profile', 1, 'Profile Members', '', 1, NULL, 1431424709, NULL),
	(130, 31, 'edit', 1, 'Edit Members', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(131, 31, 'remove_ministry', 1, 'Remove Ministry Members', '', 1, NULL, 1431424709, NULL),
	(132, 32, 'index', 1, 'Ministries', 'clip-list', 1, NULL, 1431424709, NULL),
	(133, 32, 'members', 1, 'Members Ministries', '', 1, NULL, 1431424709, NULL),
	(134, 32, 'search', 1, 'Search Ministries', 'clip-search', 1, NULL, 1431424709, NULL),
	(135, 32, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(136, 32, 'edit', 1, 'Edit Ministries', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(137, 32, 'remove_member', 1, 'Remove Member Ministries', '', 1, NULL, 1431424709, NULL),
	(138, 33, 'index', 1, 'Ministry Support', 'clip-list', 1, NULL, 1431424709, NULL),
	(139, 33, 'voided', 1, 'Voided Ministry Support', 'clip-close-4', 1, NULL, 1431424709, NULL),
	(140, 33, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(141, 33, 'view_members', 1, 'View Members Ministry Support', '', 1, NULL, 1431424709, NULL),
	(142, 33, 'edit', 1, 'Edit Ministry Support', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(143, 33, 'void', 1, 'Void Ministry Support', 'clip-close-4', 1, NULL, 1431424709, NULL),
	(144, 34, 'index', 1, 'Offerings', 'clip-list', 1, NULL, 1431424709, NULL),
	(145, 34, 'voided', 1, 'Voided Offerings', 'clip-close-4', 1, NULL, 1431424709, NULL),
	(146, 34, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(147, 34, 'edit_removed', 1, 'Edit Removed Offerings', '', 1, NULL, 1431424709, NULL),
	(148, 34, 'void', 1, 'Void Offerings', 'clip-close-4', 1, NULL, 1431424709, NULL),
	(149, 35, 'index', 1, 'Other Contributions', 'clip-list', 1, NULL, 1431424709, NULL),
	(150, 35, 'voided', 1, 'Voided Other Contributions', 'clip-close-4', 1, NULL, 1431424709, NULL),
	(151, 35, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(152, 35, 'custom', 1, 'Custom Other Contributions', '', 1, NULL, 1431424709, NULL),
	(153, 35, 'view_members', 1, 'View Members Other Contributions', '', 1, NULL, 1431424709, NULL),
	(154, 35, 'edit', 1, 'Edit Other Contributions', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(155, 35, 'void', 1, 'Void Other Contributions', 'clip-close-4', 1, NULL, 1431424709, NULL),
	(156, 36, 'index', 1, 'Permissions', 'clip-list', 1, NULL, 1431424709, NULL),
	(157, 36, 'view', 1, 'View Permissions', '', 1, NULL, 1431424709, NULL),
	(158, 36, 'assign', 1, 'Assign Permissions', '', 1, NULL, 1431424709, NULL),
	(159, 36, 'get_routes', 1, 'Get Routes Permissions', '', 1, NULL, 1431424709, NULL),
	(160, 37, 'index', 1, 'Petty Cash', 'clip-list', 1, NULL, 1431424709, NULL),
	(161, 37, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(162, 37, 'edit', 1, 'Edit Petty Cash', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(163, 38, 'index', 1, 'Pledges', 'clip-list', 1, NULL, 1431424709, NULL),
	(164, 38, 'paid', 1, 'Paid Pledges', '', 1, NULL, 1431424709, NULL),
	(165, 38, 'voided', 1, 'Voided Pledges', 'clip-close-4', 1, NULL, 1431424709, NULL),
	(166, 38, 'pending', 1, 'Pending Pledges', '', 1, NULL, 1431424709, NULL),
	(167, 38, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(168, 38, 'payment', 1, 'Payment Pledges', '', 1, NULL, 1431424709, NULL),
	(169, 38, 'edit', 1, 'Edit Pledges', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(170, 38, 'void', 1, 'Void Pledges', 'clip-close-4', 1, NULL, 1431424709, NULL),
	(171, 38, 'void_paid', 1, 'Void Paid Pledges', '', 1, NULL, 1431424709, NULL),
	(172, 39, 'index', 1, 'Prayer Requests', 'clip-list', 1, NULL, 1431424709, NULL),
	(173, 39, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(174, 39, 'edit', 1, 'Edit Prayer Requests', 'clip-pencil', 1, NULL, 1431424709, NULL),
	(175, 40, 'index', 1, 'Purchase Order', 'clip-list', 1, NULL, 1431424709, NULL),
	(176, 40, 'voided', 1, 'Voided Purchase Order', 'clip-close-4', 1, NULL, 1431424709, NULL),
	(177, 40, 'void', 1, 'Void Purchase Order', 'clip-close-4', 1, NULL, 1431424709, NULL),
	(178, 40, 'order', 1, 'Order Purchase Order', '', 1, NULL, 1431424709, NULL),
	(179, 40, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(180, 40, 'make_pay', 1, 'Make Pay Purchase Order', '', 1, NULL, 1431424709, NULL),
	(181, 40, 'edit_old', 1, 'Edit Old Purchase Order', '', 1, NULL, 1431424709, NULL),
	(182, 41, 'index', 1, 'Record Salaries', 'clip-list', 1, NULL, 1431424709, NULL),
	(183, 41, 'employees', 1, 'Employees Record Salaries', '', 1, NULL, 1431424709, NULL),
	(184, 41, 'my_slips', 1, 'My Slips Record Salaries', '', 1, NULL, 1431424709, NULL),
	(185, 41, 'slip', 1, 'Slip Record Salaries', '', 1, NULL, 1431424709, NULL),
	(186, 41, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424709, NULL),
	(187, 41, 'edit_removed', 1, 'Edit Removed Record Salaries', '', 1, NULL, 1431424710, NULL),
	(188, 41, 'delete_removed', 1, 'Delete Removed Record Salaries', '', 1, NULL, 1431424710, NULL),
	(189, 42, 'index', 1, 'Relatives', 'clip-list', 1, NULL, 1431424710, NULL),
	(190, 42, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424710, NULL),
	(191, 42, 'edit', 1, 'Edit Relatives', 'clip-pencil', 1, NULL, 1431424710, NULL),
	(192, 43, 'index', 1, 'Reports', 'clip-list', 1, NULL, 1431424710, NULL),
	(193, 43, 'accounts_reports', 1, 'Accounts Reports Reports', '', 1, NULL, 1431424710, NULL),
	(194, 43, 'filter_account', 1, 'Filter Account Reports', '', 1, NULL, 1431424710, NULL),
	(195, 43, 'accounts_date', 1, 'Accounts Date Reports', '', 1, NULL, 1431424710, NULL),
	(196, 43, 'members_reports', 1, 'Members Reports Reports', '', 1, NULL, 1431424710, NULL),
	(197, 43, 'filter_members', 1, 'Filter Members Reports', '', 1, NULL, 1431424710, NULL),
	(198, 43, 'members_byDate', 1, 'Members Bydate Reports', '', 1, NULL, 1431424710, NULL),
	(199, 43, 'members_custom_filter', 1, 'Members Custom Filter Reports', '', 1, NULL, 1431424710, NULL),
	(200, 43, 'filter_hbc_members', 1, 'Filter Hbc Members Reports', '', 1, NULL, 1431424710, NULL),
	(201, 43, 'filter_visitors', 1, 'Filter Visitors Reports', '', 1, NULL, 1431424710, NULL),
	(202, 43, 'visitors_byDate', 1, 'Visitors Bydate Reports', '', 1, NULL, 1431424710, NULL),
	(203, 43, 'filter_baptism', 1, 'Filter Baptism Reports', '', 1, NULL, 1431424710, NULL),
	(204, 43, 'baptism_byDate', 1, 'Baptism Bydate Reports', '', 1, NULL, 1431424710, NULL),
	(205, 43, 'filter_dedications', 1, 'Filter Dedications Reports', '', 1, NULL, 1431424710, NULL),
	(206, 43, 'dedications_byDate', 1, 'Dedications Bydate Reports', '', 1, NULL, 1431424710, NULL),
	(207, 43, 'filter_ssSchool', 1, 'Filter Ssschool Reports', '', 1, NULL, 1431424710, NULL),
	(208, 43, 'ssSchool_byDate', 1, 'Ssschool Bydate Reports', '', 1, NULL, 1431424710, NULL),
	(209, 43, 'filter_ministry_members', 1, 'Filter Ministry Members Reports', '', 1, NULL, 1431424710, NULL),
	(210, 43, 'ministry_members', 1, 'Ministry Members Reports', '', 1, NULL, 1431424710, NULL),
	(211, 43, 'ministry_search', 1, 'Ministry Search Reports', '', 1, NULL, 1431424710, NULL),
	(212, 43, 'sms_reports', 1, 'Sms Reports Reports', '', 1, NULL, 1431424710, NULL),
	(213, 43, 'filter_sms', 1, 'Filter Sms Reports', '', 1, NULL, 1431424710, NULL),
	(214, 43, 'current_monthSMS', 1, 'Current Monthsms Reports', '', 1, NULL, 1431424710, NULL),
	(215, 43, 'sms_byDate', 1, 'Sms Bydate Reports', '', 1, NULL, 1431424710, NULL),
	(216, 43, 'sms_purchased', 1, 'Sms Purchased Reports', '', 1, NULL, 1431424710, NULL),
	(217, 43, 'purchased_byDate', 1, 'Purchased Bydate Reports', '', 1, NULL, 1431424710, NULL),
	(218, 43, 'assets_reports', 1, 'Assets Reports Reports', '', 1, NULL, 1431424710, NULL),
	(219, 43, 'filter_assets', 1, 'Filter Assets Reports', '', 1, NULL, 1431424710, NULL),
	(220, 43, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424710, NULL),
	(221, 43, 'edit', 1, 'Edit Reports', 'clip-pencil', 1, NULL, 1431424710, NULL),
	(222, 44, 'index', 1, 'Salaries', 'clip-list', 1, NULL, 1431424710, NULL),
	(223, 44, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424710, NULL),
	(224, 44, 'edit', 1, 'Edit Salaries', 'clip-pencil', 1, NULL, 1431424710, NULL),
	(225, 44, 'get_nhif', 1, 'Get Nhif Salaries', '', 1, NULL, 1431424710, NULL),
	(226, 45, 'exp', 1, 'Exp Sandbox', '', 1, NULL, 1431424710, NULL),
	(227, 45, 'index', 1, 'Sandbox', 'clip-list', 1, NULL, 1431424710, NULL),
	(228, 45, 'fix', 1, 'Fix Sandbox', '', 1, NULL, 1431424710, NULL),
	(229, 46, 'index', 1, 'Seed Planting', 'clip-list', 1, NULL, 1431424710, NULL),
	(230, 46, 'voided', 1, 'Voided Seed Planting', 'clip-close-4', 1, NULL, 1431424710, NULL),
	(231, 46, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424710, NULL),
	(232, 46, 'view_members', 1, 'View Members Seed Planting', '', 1, NULL, 1431424710, NULL),
	(233, 46, 'edit', 1, 'Edit Seed Planting', 'clip-pencil', 1, NULL, 1431424710, NULL),
	(234, 46, 'void', 1, 'Void Seed Planting', 'clip-close-4', 1, NULL, 1431424710, NULL),
	(235, 47, 'index', 1, 'Sermons', 'clip-list', 1, NULL, 1431424710, NULL),
	(236, 47, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424710, NULL),
	(237, 47, 'edit', 1, 'Edit Sermons', 'clip-pencil', 1, NULL, 1431424710, NULL),
	(238, 48, 'index', 1, 'Settings', 'clip-list', 1, NULL, 1431424710, NULL),
	(239, 48, 'index_reloaded', 1, 'Index Reloaded Settings', '', 1, NULL, 1431424710, NULL),
	(240, 48, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424710, NULL),
	(241, 48, 'edit', 1, 'Edit Settings', 'clip-pencil', 1, NULL, 1431424710, NULL),
	(242, 49, 'index', 1, 'Sms', 'clip-list', 1, NULL, 1431424710, NULL),
	(243, 49, 'my_sms', 1, 'My Sms Sms', '', 1, NULL, 1431424710, NULL),
	(244, 49, 'compose', 1, 'Compose Sms', '', 1, NULL, 1431424710, NULL),
	(245, 49, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424710, NULL),
	(246, 49, 'edit_removed', 1, 'Edit Removed Sms', '', 1, NULL, 1431424710, NULL),
	(247, 50, 'index', 1, 'Sms Subscriptions', 'clip-list', 1, NULL, 1431424710, NULL),
	(248, 50, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424710, NULL),
	(249, 50, 'edit', 1, 'Edit Sms Subscriptions', 'clip-pencil', 1, NULL, 1431424710, NULL),
	(250, 51, 'index', 1, 'Ss Parents', 'clip-list', 1, NULL, 1431424710, NULL),
	(251, 51, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424710, NULL),
	(252, 51, 'edit', 1, 'Edit Ss Parents', 'clip-pencil', 1, NULL, 1431424710, NULL),
	(253, 52, 'index', 1, 'Sunday School', 'clip-list', 1, NULL, 1431424710, NULL),
	(254, 52, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424710, NULL),
	(255, 52, 'search', 1, 'Search Sunday School', 'clip-search', 1, NULL, 1431424710, NULL),
	(256, 52, 'profile', 1, 'Profile Sunday School', '', 1, NULL, 1431424710, NULL),
	(257, 52, 'edit', 1, 'Edit Sunday School', 'clip-pencil', 1, NULL, 1431424710, NULL),
	(258, 52, 'remove_parent', 1, 'Remove Parent Sunday School', '', 1, NULL, 1431424710, NULL),
	(259, 53, 'index', 1, 'Take Stock', 'clip-list', 1, NULL, 1431424710, NULL),
	(260, 53, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424710, NULL),
	(261, 53, 'edit', 1, 'Edit Take Stock', 'clip-pencil', 1, NULL, 1431424710, NULL),
	(262, 54, 'index', 1, 'Task Manager', 'clip-list', 1, NULL, 1431424710, NULL),
	(263, 54, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424710, NULL),
	(264, 54, 'edit', 1, 'Edit Task Manager', 'clip-pencil', 1, NULL, 1431424710, NULL),
	(265, 55, 'index', 1, 'Tax Config', 'clip-list', 1, NULL, 1431424710, NULL),
	(266, 55, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424710, NULL),
	(267, 55, 'edit', 1, 'Edit Tax Config', 'clip-pencil', 1, NULL, 1431424710, NULL),
	(268, 56, 'index', 1, 'Testmodes', 'clip-list', 1, NULL, 1431424710, NULL),
	(269, 56, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424710, NULL),
	(270, 56, 'edit', 1, 'Edit Testmodes', 'clip-pencil', 1, NULL, 1431424710, NULL),
	(271, 57, 'index', 1, 'Thanks Giving', 'clip-list', 1, NULL, 1431424710, NULL),
	(272, 57, 'voided', 1, 'Voided Thanks Giving', 'clip-close-4', 1, NULL, 1431424710, NULL),
	(273, 57, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424710, NULL),
	(274, 57, 'view_members', 1, 'View Members Thanks Giving', '', 1, NULL, 1431424710, NULL),
	(275, 57, 'edit', 1, 'Edit Thanks Giving', 'clip-pencil', 1, NULL, 1431424710, NULL),
	(276, 57, 'void', 1, 'Void Thanks Giving', 'clip-close-4', 1, NULL, 1431424710, NULL),
	(277, 58, 'index', 1, 'Tithes', 'clip-list', 1, NULL, 1431424710, NULL),
	(278, 58, 'voided', 1, 'Voided Tithes', 'clip-close-4', 1, NULL, 1431424710, NULL),
	(279, 58, 'sms_tithe', 1, 'Sms Tithe Tithes', '', 1, NULL, 1431424710, NULL),
	(280, 58, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424710, NULL),
	(281, 58, 'receipt', 1, 'Receipt Tithes', '', 1, NULL, 1431424710, NULL),
	(282, 58, 'view_members', 1, 'View Members Tithes', '', 1, NULL, 1431424710, NULL),
	(283, 58, 'edit', 1, 'Edit Tithes', 'clip-pencil', 1, NULL, 1431424710, NULL),
	(284, 58, 'void', 1, 'Void Tithes', 'clip-close-4', 1, NULL, 1431424710, NULL),
	(285, 59, 'index', 1, 'Tools', 'clip-list', 1, NULL, 1431424710, NULL),
	(286, 60, 'index', 1, 'Users', 'clip-list', 1, NULL, 1431424710, NULL),
	(287, 60, 'search_around', 1, 'Search Around Users', '', 1, NULL, 1431424710, NULL),
	(288, 60, 'edit', 1, 'Edit Users', 'clip-pencil', 1, NULL, 1431424710, NULL),
	(289, 60, 'change_password', 1, 'Change Password Users', '', 1, NULL, 1431424710, NULL),
	(290, 60, 'forgot_password', 1, 'Forgot Password Users', '', 1, NULL, 1431424710, NULL),
	(291, 60, 'reset_password', 1, 'Reset Password Users', '', 1, NULL, 1431424710, NULL),
	(292, 60, 'activate', 1, 'Activate Users', '', 1, NULL, 1431424710, NULL),
	(293, 60, 'deactivate', 1, 'Deactivate Users', '', 1, NULL, 1431424710, NULL),
	(294, 60, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424710, NULL),
	(295, 60, 'profile', 1, 'Profile Users', '', 1, NULL, 1431424710, NULL),
	(296, 60, 'add_connection', 1, 'Add Connection Users', '', 1, NULL, 1431424710, NULL),
	(297, 60, 'fetch_notes', 1, 'Fetch Notes Users', '', 1, NULL, 1431424710, NULL),
	(298, 61, 'index', 1, 'Visitors', 'clip-list', 1, NULL, 1431424710, NULL),
	(299, 61, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424710, NULL),
	(300, 61, 'edit', 1, 'Edit Visitors', 'clip-pencil', 1, NULL, 1431424710, NULL),
	(301, 62, 'index', 1, 'Weddings', 'clip-list', 1, NULL, 1431424710, NULL),
	(302, 62, 'create', 1, 'Add New ', 'clip-plus-circle-2', 1, NULL, 1431424710, NULL),
	(303, 62, 'edit', 1, 'Edit Weddings', 'clip-pencil', 1, NULL, 1431424710, NULL),
	(304, 36, 'fix_resources', 1, 'Fix Resources Permissions', '', 1, NULL, 1431437357, NULL),
	(305, 48, 'backup', 1, 'Backup Settings', '', 1, NULL, 1431599521, NULL),
	(306, 22, 'by_item', 1, 'By Item Expenses', '', 1, NULL, 1433680334, NULL),
	(307, 22, 'by_category', 1, 'By Category Expenses', '', 1, NULL, 1433680334, NULL),
	(308, 24, 'petty_add', 1, 'Petty Add Expenses Items', '', 1, NULL, 1433680334, NULL),
	(309, 37, 'by_item', 1, 'By Item Petty Cash', '', 1, NULL, 1433680334, NULL);
/*!40000 ALTER TABLE `routes` ENABLE KEYS */;


-- Dumping structure for table agcchurch.salaries
CREATE TABLE IF NOT EXISTS `salaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee` varchar(256) NOT NULL DEFAULT '',
  `salary_method` varchar(256) NOT NULL DEFAULT '',
  `basic_salary` float DEFAULT NULL,
  `nhif` float DEFAULT NULL,
  `bank_account_no` varchar(256) NOT NULL DEFAULT '',
  `bank_name` varchar(256) NOT NULL DEFAULT '',
  `nhif_no` varchar(256) NOT NULL DEFAULT '',
  `nssf_no` varchar(256) NOT NULL DEFAULT '',
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.salaries: ~0 rows (approximately)
/*!40000 ALTER TABLE `salaries` DISABLE KEYS */;
/*!40000 ALTER TABLE `salaries` ENABLE KEYS */;


-- Dumping structure for table agcchurch.seed_planting
CREATE TABLE IF NOT EXISTS `seed_planting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` blob,
  `totals` blob,
  `member` blob NOT NULL,
  `amount` blob NOT NULL,
  `bank` blob NOT NULL,
  `treasurer` blob NOT NULL,
  `confirmed_by` blob NOT NULL,
  `description` blob,
  `created_by` blob,
  `modified_by` blob,
  `created_on` blob,
  `modified_on` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.seed_planting: ~0 rows (approximately)
/*!40000 ALTER TABLE `seed_planting` DISABLE KEYS */;
/*!40000 ALTER TABLE `seed_planting` ENABLE KEYS */;


-- Dumping structure for table agcchurch.sermons
CREATE TABLE IF NOT EXISTS `sermons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_date` int(11) DEFAULT NULL,
  `title` varchar(256) NOT NULL DEFAULT '',
  `service_leader` varchar(256) NOT NULL DEFAULT '',
  `first_service` varchar(256) NOT NULL DEFAULT '',
  `second_service` varchar(256) NOT NULL DEFAULT '',
  `pastor_on_duty` varchar(32) NOT NULL DEFAULT '',
  `file` varchar(32) NOT NULL DEFAULT '',
  `sermon_theme` text,
  `description` text,
  `upload_sermon` varchar(256) NOT NULL DEFAULT '',
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.sermons: ~0 rows (approximately)
/*!40000 ALTER TABLE `sermons` DISABLE KEYS */;
INSERT INTO `sermons` (`id`, `service_date`, `title`, `service_leader`, `first_service`, `second_service`, `pastor_on_duty`, `file`, `sermon_theme`, `description`, `upload_sermon`, `created_by`, `modified_by`, `created_on`, `modified_on`) VALUES
	(1, 1480798800, 'Lost Sheep', 'Musau', '10.30', '11.30', '1', '', 'Lost Sheep', 'Lost Sheep and the coin', '', 1, 1, 1480952994, 1480953014);
/*!40000 ALTER TABLE `sermons` ENABLE KEYS */;


-- Dumping structure for table agcchurch.servers
CREATE TABLE IF NOT EXISTS `servers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `license` blob,
  `status` blob NOT NULL,
  `created_by` blob,
  `modified_by` blob,
  `created_on` blob,
  `modified_on` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table agcchurch.servers: ~2 rows (approximately)
/*!40000 ALTER TABLE `servers` DISABLE KEYS */;
INSERT INTO `servers` (`id`, `license`, `status`, `created_by`, `modified_by`, `created_on`, `modified_on`) VALUES
	(1, _binary 0xA6DAD194194075B7FB69B56AE801A72E9A65057B345E4E232237DF245485FC3A4750A64633022949A211CEEA53E1F1F0A6DAD194194075B7FB69B56AE801A72EA6DAD194194075B7FB69B56AE801A72E5F27A34697BD47F2AE9FB620DE3BC0388459C565724B0FC65F52E278C21B0D5A9128A1A6E3B7C0D825B599690DD4B63D6257B25D719D96B01594368A13C01D4B0E7A22FAEAA8FB778BC388C10FD63DA06510A4520E8D5BD6456792DA900F04A274777869BB446CF461E88C796B005FF57E92C69ECF17672599F8BDBBBD5469EE897E3A6B24456F88AEBC517FA7B53EFC24EC2E81BD0CC80450AF1DA02CC5BBCF780556EA9CC8827E606BB930F06E0956349F2C4F90389D894B1800E144CBF02AEF08876BCF863983B9468134D154CD8AB9DAADCE46DF9C3932117292E330FAB2328EFCE3F2318678D1BE6399896B654C0256A2511673BC69E9516DAF9F55D071868064ACCBBA6460E9F9024024D72DD0EB2DA2E2D193421FD5C8FCE637A023735BEF7E3E3878A654373F38A6D6FF4F8BD3FFFEB38CF4DA363072DD75041BECBC2E5042E757A323EF314CC2D06AADEFD655F4BF69CB7B511E77429168E2A1960485E3EA24A1E2B5751CC9F4A9255DFA2662EBF8DE9F4EB02DA4813E960DB28EEB13B39DEFF1493250FF2C11E11D5B47E84D7CFF9BFE2E47FFACD7D81C3D7D02A20AE1241291E6973360C0B180F8153283BB4275A58BCA95720D696416889A7B574F7FA3E0A294EB16602A96694AB187956C2A0172B813EC6C3473ACCA7CE70E6FF3032C89C1BCEA89B064BEA0443E4B8C24EAA3BBC76F1B020A40B97FC9C6D286616D48C9835D533535F7D8EDEFB51529840428A4E5A0F6E07B870C3D9D0D6BCEA0709D65C48216083167EA9DCE188C3AAF0CCF152EBFCD4FFDAB8319AB3A180757C025FB28797729254C47A3803F7893BABE0AA4776E28B9E36EC9C4E74165F5BE9CC1E1798CF45E0A040B3DD8639C0EA648B4F44AB1BB18083DFAD15BA278E59F9E5C958A6623B5ADF0374D70E4F5B1FBA917DBDAF590B6475D056CDD513124D9E8040EB7BAFA138DDC35FA41F69FB76A885A9334A14271C1C4DEC527A1AD9D1B2C4125834780FFC1D974EAC20EA213CF6BE0077606E843C3933DDA53044CE7547B89FB1B280D4D87AEEE87E759F1C7440F5BB47D3EFE600722660DE884C6A134FED48D2E8F6A51410B51FF016CAED31C869FFDCF568062C7350B013E8C84A29DA36EB304BF6951023AF4E5F232E704A31DC24C29E840A92750091BF887191885308BF43133738F62B44D56728C12F6C6178B36FA1319074A8EED38E1B70AB27C87BDACD01A7B5A8487689EB919A1A2D0F6772514CB4D74BCF083E8A3C1E3C631B27ED37915F9A9EBD9227578C8D34BCF170A83163E703C2CFA6339C76D892FFC0C61A23BF2BFCC06ADDCD9497A958AC2291F246BD3FD7C110D88F0C582DF7331B1F18A2E4C4C313EA9D9AC0FB46CCE3354A99EB8C5A8503C6DFF1D569B5C6986DE6BD4DAC3ADA01A736A9F0B49BD162F143F7626E3FE11042D705016EBBAF04D0D9E419E702CD1FE41BC488C7A4575CC31DBF6EEA06E82E7411F64842085F1E2654B7B88CFB069470ED1396471E28BC8EE2D749B6C2A632D8A0079D7295392AD6E20BA4160E605298CF7FB4C621CEB9D9D3684EEFCB6BBF261FE210748E464E0541F64702C6171479161DC3D2188E09E360683BC39A542EBB4D539491A212713B1B7BB53FA573832F533432449A541C45626EF6B508717B49D74DF1F95CD51A6DAD194194075B7FB69B56AE801A72E9545174A8F68320A8A206374E78C113F663560EF9BE9F1B87D04A4790D3143FAA6DAD194194075B7FB69B56AE801A72E054104C22053E020BFFB2E7862886569, _binary 0x82A1E878C5AC69376CB8B60F78D0D878, _binary 0x9E0C3309C8FB9A2C9E37ECDA3339171B, NULL, _binary 0x98921D7F2F14DB1696E3EA036F2FFC2D, NULL),
	(2, _binary 0xFD4E0185CDA7D53C019816624BABC1D1DD47CCEC68364FF519C0E9A6850DEAC378EB4505647F2EAEF7E764ADF5F44BF7FD4E0185CDA7D53C019816624BABC1D1FD4E0185CDA7D53C019816624BABC1D194157727F74FD79D5FDAA1ADAFCA86B9D02BB7D6B512814CB8DE26479437C6AD3D0DD0F7B69B0D49445202079C46B3028A01EA867BC19BAD2DBB6C2CF9A07942838557FA287E17C961C20CEDA1473F0CAD329C3D8DC8003567C5A6FE221F6B51925DA72ADCDC58361D2A6193450DF3D16337FC1FCCC0E26E5154E5857C8622104C6AE9D0822BF6520ED9576C350AE90264876549B5D5B6CFB2668DEAAF3C12B7C6A6AA7EB6FBE13BF15305EA49CAF04E2554A7BCEB5EA2092CDFA161F7FC6CA871596E89B3CD3DD61D125028011709C091DA944EADE5BFD24BC68A933AFCDDC070ED59E3D67E98F792D988A85822047E5F3244F6D97938FC98DB6BE54774F5651D48DF3F84ABC0BF2911EF50E2D7E4B1DE3E353102DA9F75EC2C26D751A5AEE740FE40FFE7C4825F015E74377AD5F5657AF9D3F617BF3839EA1CEC0C5F2BD2B7055EFAE625D4EE4E5FC9FCD04CDAE3E9FA56F99A93AE81159C32F68372DECCA0C2333F3A59456EFEE523A7918538EA3D3DE96CB8BC1E089E4C4D60F80C9D35818BEBB392651AF88FD56608F63FC5607CC8BC5AFCB3C937C64A462545D618755880D02E00EC0C447B5D87E179AE9D58A4BE18C1F1E9E985AD798810EAAB4308FC69D76CB14EC9531CDBAE6AD6E1F315A706F66244CE825D2E7D76204BE414F340D6A13DDBE49098D964056F3AB3C08D9E320F60BD19D13E48B00D74E406206AEADD5F32A811AA3CF5C972AEDD336CE27DADA9A9F394647A783019068320544568D0AE153E426934769FA3CEED8DAAFABE33BBC73A9D49232D0162DCFAE9426769A98FD5A275D988098F03F73C65F57F66C448176BF9DC3E8AFB1117BFD1808C07A19D762348C4C5B6B490CC74F0A643E2D633E08B25F61553A071D8E44F60ED5AC1C23524CDDB45A141F8C660AA33AF8B5C545A4D1B36EEC62287C09ABEF442316CE7B91955B4B2DA278223E2FBB01005357F9E077AF440347A59021AD7DB0F6684AD123509166F7E87FCD8E3C29D6DA398C76E6792F74BA26962FBD2EEFAFEF4FFE940C778807CD0B8B00733FBADE0CDC0C12D78F2541DEE9B72494982615B86B8614452E524D315AEE9B5D0EB03FF9F9CD00CD3CBD9018365BF116B3A21A112AD514AACB6FDD5634E6B74E3BA6235C113626434C8558B183059AB234BE932AA3F23BB685F2D357445EDB2D2D4BFFCE907F078119EEEF2B81079F3D581A68D75DF22CADDF5B84B487CBA678B16ECEDAA082E51002418D75FA61B4444A88E71FA7D63B902187188889FE18894C282433ED896A6ADD0D661DBD33C3B01F35518067DBF246E5DFF22B797A0844DA86A5F063B363BFC8420681DFA6AA30064C59C5A94B03652337A9E63B4B3CD8BE8477FBED0285344FF60D18EECFDAFF4A220FA10F4267E0721F7D40F1417EB8CEA3C8CF575669046B07AC64A27B8EB5ADE65B97D81B28685A28CC54AD94F09CAC09AFE32ECFF917976A63177071810356AF3C217BD4C155B978648F82EB51267959E37EF8106FC4A8A43AF035E12C751F3230CD3C3FF8F60EDB58FF62BCD73F3B81CAFEE8C22AB0552A50535F1DBB89A1E5AD9304A8C2CE656BB5D775FA73C894CD7CD478D8F4BE1D1D7961464F845CFB598EE9ED7B7D2DFC92BC85CA71C3252A6D5324A6F267D973A08255EA8994829B614E2D2235B2E2058BDE34BA6AEFD0F6B651FC4FD4E0185CDA7D53C019816624BABC1D1DB020F74F4B0B4B4969A870B0C3901BD181945F57436D65F02AAAD7FC42CCC8BFD4E0185CDA7D53C019816624BABC1D19BECA2392B2BA10A544BB1362B5E9E18, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D, NULL, _binary 0x5B61ACF23088A2214D164D7524A6193E, NULL);
/*!40000 ALTER TABLE `servers` ENABLE KEYS */;


-- Dumping structure for table agcchurch.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT NULL,
  `name` varchar(256) NOT NULL DEFAULT '',
  `address` text,
  `county` varchar(256) NOT NULL DEFAULT '',
  `town` varchar(256) NOT NULL DEFAULT '',
  `phone` varchar(256) NOT NULL DEFAULT '',
  `other_phones` varchar(256) NOT NULL DEFAULT '',
  `email` varchar(256) NOT NULL DEFAULT '',
  `sender_id` varchar(256) NOT NULL DEFAULT '',
  `sms_initial` varchar(256) NOT NULL DEFAULT '',
  `member_code_initial` varchar(256) NOT NULL DEFAULT '',
  `file` varchar(256) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `date`, `name`, `address`, `county`, `town`, `phone`, `other_phones`, `email`, `sender_id`, `sms_initial`, `member_code_initial`, `file`, `created_by`, `modified_by`, `created_on`, `modified_on`) VALUES
	(1, 1333400400, 'Karen Africa Gospel Church', 'Box 12548', 'Nairobi', 'Umoja', '(072) 134-1214', '0205285243/07213584587', 'info@smartchurch.com', 'M-SHAMBA', 'Hello', 'MLC', 'AGC_LOGO.png', 1, 1, 1422976879, 1480767179);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;


-- Dumping structure for table agcchurch.sms
CREATE TABLE IF NOT EXISTS `sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipient` varchar(32) NOT NULL DEFAULT '',
  `status` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `group_type` varchar(50) DEFAULT NULL,
  `sent_to` varchar(50) DEFAULT NULL,
  `message` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.sms: ~0 rows (approximately)
/*!40000 ALTER TABLE `sms` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms` ENABLE KEYS */;


-- Dumping structure for table agcchurch.sms_counter
CREATE TABLE IF NOT EXISTS `sms_counter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sent` blob,
  `balance` blob,
  `created_by` blob,
  `modified_by` blob,
  `created_on` blob,
  `modified_on` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.sms_counter: ~0 rows (approximately)
/*!40000 ALTER TABLE `sms_counter` DISABLE KEYS */;
INSERT INTO `sms_counter` (`id`, `sent`, `balance`, `created_by`, `modified_by`, `created_on`, `modified_on`) VALUES
	(1, _binary '', _binary 0xCDF3A1CB3F3EE08D0E0C63E679397C3A, _binary 0x31, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D, _binary 0x31343231323432353139, _binary 0x8C230A7FA1B2E07A93E7218572FA8BF8);
/*!40000 ALTER TABLE `sms_counter` ENABLE KEYS */;


-- Dumping structure for table agcchurch.sms_subscriptions
CREATE TABLE IF NOT EXISTS `sms_subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member` varchar(32) NOT NULL DEFAULT '',
  `bible_quotes` varchar(32) NOT NULL DEFAULT '',
  `daily_inspirations` varchar(32) NOT NULL DEFAULT '',
  `created_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.sms_subscriptions: ~0 rows (approximately)
/*!40000 ALTER TABLE `sms_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms_subscriptions` ENABLE KEYS */;


-- Dumping structure for table agcchurch.ss_parents
CREATE TABLE IF NOT EXISTS `ss_parents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `child_id` int(11) NOT NULL DEFAULT '0',
  `first_name` varchar(256) NOT NULL DEFAULT '',
  `last_name` varchar(256) NOT NULL DEFAULT '',
  `gender` varchar(256) NOT NULL DEFAULT '',
  `relationship` varchar(256) NOT NULL DEFAULT '',
  `phone1` varchar(256) NOT NULL DEFAULT '',
  `phone2` varchar(256) NOT NULL DEFAULT '',
  `email` varchar(256) NOT NULL DEFAULT '',
  `address` text,
  `county` varchar(256) NOT NULL DEFAULT '',
  `location` varchar(256) NOT NULL DEFAULT '',
  `additionals` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.ss_parents: ~0 rows (approximately)
/*!40000 ALTER TABLE `ss_parents` DISABLE KEYS */;
/*!40000 ALTER TABLE `ss_parents` ENABLE KEYS */;


-- Dumping structure for table agcchurch.sunday_school
CREATE TABLE IF NOT EXISTS `sunday_school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_joined` int(11) DEFAULT NULL,
  `first_name` varchar(256) NOT NULL DEFAULT '',
  `last_name` varchar(256) NOT NULL DEFAULT '',
  `dob` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `gender` varchar(256) NOT NULL,
  `relationship` varchar(256) NOT NULL,
  `home_phone` varchar(256) NOT NULL,
  `baptised` varchar(256) NOT NULL,
  `confirmed` varchar(256) NOT NULL,
  `how_joined` varchar(256) NOT NULL,
  `residential` varchar(256) NOT NULL,
  `special_interest` text,
  `strengths` text,
  `weaknesses` text,
  `health` text,
  `passport` varchar(256) NOT NULL DEFAULT '',
  `additionals` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.sunday_school: ~0 rows (approximately)
/*!40000 ALTER TABLE `sunday_school` DISABLE KEYS */;
/*!40000 ALTER TABLE `sunday_school` ENABLE KEYS */;


-- Dumping structure for table agcchurch.take_stock
CREATE TABLE IF NOT EXISTS `take_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT NULL,
  `asset_name` varchar(32) NOT NULL DEFAULT '',
  `remaining_stock` varchar(256) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.take_stock: ~0 rows (approximately)
/*!40000 ALTER TABLE `take_stock` DISABLE KEYS */;
/*!40000 ALTER TABLE `take_stock` ENABLE KEYS */;


-- Dumping structure for table agcchurch.task_manager
CREATE TABLE IF NOT EXISTS `task_manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL DEFAULT '',
  `date` int(11) DEFAULT NULL,
  `status` varchar(32) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.task_manager: ~0 rows (approximately)
/*!40000 ALTER TABLE `task_manager` DISABLE KEYS */;
/*!40000 ALTER TABLE `task_manager` ENABLE KEYS */;


-- Dumping structure for table agcchurch.tax_config
CREATE TABLE IF NOT EXISTS `tax_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '',
  `amount` varchar(256) NOT NULL DEFAULT '',
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.tax_config: ~2 rows (approximately)
/*!40000 ALTER TABLE `tax_config` DISABLE KEYS */;
INSERT INTO `tax_config` (`id`, `name`, `amount`, `created_by`, `modified_by`, `created_on`, `modified_on`) VALUES
	(1, 'PAYE', '16', 1, NULL, 1422346949, NULL),
	(2, 'VAT', '16', 1, NULL, 1422346949, NULL);
/*!40000 ALTER TABLE `tax_config` ENABLE KEYS */;


-- Dumping structure for table agcchurch.thanks_giving
CREATE TABLE IF NOT EXISTS `thanks_giving` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` blob,
  `member` blob NOT NULL,
  `amount` blob NOT NULL,
  `bank` blob NOT NULL,
  `totals` blob,
  `treasurer` blob NOT NULL,
  `confirmed_by` blob NOT NULL,
  `description` blob,
  `created_by` blob,
  `modified_by` blob,
  `created_on` blob,
  `modified_on` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.thanks_giving: ~0 rows (approximately)
/*!40000 ALTER TABLE `thanks_giving` DISABLE KEYS */;
/*!40000 ALTER TABLE `thanks_giving` ENABLE KEYS */;


-- Dumping structure for table agcchurch.tithes
CREATE TABLE IF NOT EXISTS `tithes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` blob,
  `bank` blob NOT NULL,
  `treasurer` blob NOT NULL,
  `confirmed_by` blob NOT NULL,
  `totals` blob,
  `description` blob,
  `created_by` blob,
  `modified_by` blob,
  `created_on` blob,
  `modified_on` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.tithes: ~0 rows (approximately)
/*!40000 ALTER TABLE `tithes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tithes` ENABLE KEYS */;


-- Dumping structure for table agcchurch.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` blob NOT NULL,
  `ip_address` blob NOT NULL,
  `username` blob NOT NULL,
  `password` blob NOT NULL,
  `salt` blob,
  `email` blob NOT NULL,
  `activation_code` blob,
  `first_name` blob,
  `last_name` blob,
  `phone` blob,
  `forgotten_password_code` blob,
  `remember_code` blob,
  `created_on` blob NOT NULL,
  `last_login` blob,
  `active` blob,
  `bio` blob,
  `created_by` blob,
  `modified_by` blob,
  `modified_on` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table agcchurch.users: ~5 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `group_id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `first_name`, `last_name`, `phone`, `forgotten_password_code`, `remember_code`, `created_on`, `last_login`, `active`, `bio`, `created_by`, `modified_by`, `modified_on`) VALUES
	(1, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D, _binary 0x8DAE8C71F911EAC0F2518C609ACBB13D, _binary 0xB0C6204D92E820BDD9B382D8F6192146, _binary 0x059B467B01BA3FD865E8FEB1B2CA42072AD4141EE4F3DCE0C84DAC22AFDC111008FA455C9D750ADCF2FFFDC05312EE1E, _binary 0x71BF490A36D1388798EFA45F3873A254, _binary 0x0EB8F055B6C50C5EDF71649A9F86BAB2, _binary 0xA545ACD59A5C75D85E429545B1B87E8A, _binary 0xF50A452DBB53F438439B1B253706CE71, _binary 0x9F58D531D84034BA1BB50F1B0AA21762, _binary 0x9833BA881C4EC01E0D747C21F7C0AEB5, _binary 0xA545ACD59A5C75D85E429545B1B87E8A, _binary 0x64373366363036663536323265333332343632356632356631643937636238356532636330663636, _binary 0x88F2AC67959D408673AB63A7F8C52F58, _binary 0x31343934353137383039, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D, NULL, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D, _binary 0x632373B1CBE3A80F4E1619F3947B75C3),
	(2, _binary 0x90065FE9EA51973A4989393C1F3A44AF, _binary 0xC1BD6816EF79C1356CC4B0BBFC854DBB, _binary 0x8629A24CD97C1D65A5A83A231CB02E39, _binary 0x70AC63A125662F24DE2C18D8A6BB9FCA857EDD2D94DF0B7DF332BCC4168C9827DE9DE68CDA1D684D431346C154F66536, NULL, _binary 0x3B4A47C5142A37811E62169A0C859E82, NULL, _binary 0xCB636B55031F4C3018F7CA4575B02A68, _binary 0xD9F2B1DA7A7A12E073D0F17A0F6E3544, _binary 0xD623A851185391639992510F2D3A00B3, NULL, NULL, _binary 0x83001A6F31C4D7F2D2D37B23D9D8E1C8, _binary 0x31343930373736323434, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D, NULL, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D, _binary 0xCFBC6FC6965272BE6FA2DFA7D00FFDBA),
	(3, _binary 0x90065FE9EA51973A4989393C1F3A44AF, _binary 0xC1BD6816EF79C1356CC4B0BBFC854DBB, _binary 0xDDCAB4581F1EB4A2F02B536FE64D7F79, _binary 0x452F6F4F3BD6B8FD5370D2CACA2201EDEC12F1035BC44CADB996B0DC851AA146BBA25C205BBC06DDFE954EF5959C1FBF, NULL, _binary 0xAB20D12201CF113367C690A73BBCA206, NULL, _binary 0xF3ABFA7A76633A5696999BCCB966E2AD, _binary 0xD9F2B1DA7A7A12E073D0F17A0F6E3544, _binary 0x0B71B5C0ABBC69717E2CCA0D71D38D98, NULL, NULL, _binary 0x7F4024D92F831B5CCAAC4DDCFB8F80C5, _binary 0x31343139393336353533, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D, NULL, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D, _binary 0x3609C9EC305D6885F239A8FD352B0449),
	(4, _binary 0x90065FE9EA51973A4989393C1F3A44AF, _binary 0x8DAE8C71F911EAC0F2518C609ACBB13D, _binary 0xF01FF376BA4FBBE5B2FBAFC61D432F74, _binary 0x02C5D4B49DB5BC5D5D9966C8B1F62B05D468D34FB23E79E1212E2FFE3C416E8ED1319FE6FC7111CC51E844472C6B4690, NULL, _binary 0x155FBD3EDAE4DDA9C375CFC2E3576DCE, NULL, _binary 0x5A67F3DE2994745C6CB4C3360F6A1EF0, _binary 0xB9BF66345DA59B8A0CF2216B3E9994AA, _binary 0xE5CC65B19014C41F8496FE5904D8B9E8, NULL, NULL, _binary 0xBC522691E6C9FBE9C83126E88D8821DC, _binary 0xBC522691E6C9FBE9C83126E88D8821DC, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D, NULL, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D, _binary 0x8DA3C85600C8C494D025D768BEB4B76F),
	(5, _binary 0x90065FE9EA51973A4989393C1F3A44AF, _binary 0xC1BD6816EF79C1356CC4B0BBFC854DBB, _binary 0x5F162C22436698E7AA366FD2D5E2196F, _binary 0x239AAC24F88A321657413F397B8D58BCBBE0B2B77D83F6ECCCF6060238177770EB47740CE3EABE4D01D6367235911D45, NULL, _binary 0xE83A34F76052C1A7099CB946CFDAFE89, NULL, _binary 0xA6680427CD8CC901FC628C00BA117F2B, _binary 0xD818A259280AD5BC9A0074E2A7CD9652, _binary 0xF2A9806CC1F9FB42027523C8DC6E0887, NULL, NULL, _binary 0x2106FFED3079C380C206E260D2BCBAB2, _binary 0x31343934353137393039, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D, NULL, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D, NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table agcchurch.users_groups
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` blob NOT NULL,
  `group_id` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

-- Dumping data for table agcchurch.users_groups: ~6 rows (approximately)
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
	(10, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D, _binary 0x00735F6218FD3E7241F3FCD72E6A3B8D),
	(13, _binary 0xCFA10A53AC284DB808F6BEDD952EB03D, _binary 0xCFA10A53AC284DB808F6BEDD952EB03D),
	(14, _binary 0xCFA10A53AC284DB808F6BEDD952EB03D, _binary 0x90065FE9EA51973A4989393C1F3A44AF),
	(16, _binary 0xCDF3A1CB3F3EE08D0E0C63E679397C3A, _binary 0x90065FE9EA51973A4989393C1F3A44AF),
	(18, _binary 0x90065FE9EA51973A4989393C1F3A44AF, _binary 0xCDF3A1CB3F3EE08D0E0C63E679397C3A),
	(19, _binary 0x6278D03ADB36391E12615A9C8A0FE2DD, _binary 0xCDF3A1CB3F3EE08D0E0C63E679397C3A);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;


-- Dumping structure for table agcchurch.video_sermons
CREATE TABLE IF NOT EXISTS `video_sermons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL DEFAULT '',
  `value` varchar(256) NOT NULL DEFAULT '',
  `file` varchar(256) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.video_sermons: ~0 rows (approximately)
/*!40000 ALTER TABLE `video_sermons` DISABLE KEYS */;
/*!40000 ALTER TABLE `video_sermons` ENABLE KEYS */;


-- Dumping structure for table agcchurch.visitors
CREATE TABLE IF NOT EXISTS `visitors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_date` int(11) DEFAULT NULL,
  `first_name` varchar(256) NOT NULL DEFAULT '',
  `last_name` varchar(256) NOT NULL DEFAULT '',
  `gender` varchar(256) NOT NULL DEFAULT '',
  `phone` varchar(256) NOT NULL DEFAULT '',
  `email` varchar(256) NOT NULL DEFAULT '',
  `county` varchar(256) NOT NULL DEFAULT '',
  `location` varchar(256) NOT NULL DEFAULT '',
  `directed_by` varchar(256) NOT NULL DEFAULT '',
  `interested_in_membership` int(1) NOT NULL,
  `saved` int(1) NOT NULL,
  `baptised` int(1) NOT NULL,
  `know_more` int(1) NOT NULL,
  `ministries_interest` int(1) NOT NULL,
  `come_back` int(1) NOT NULL,
  `additionals` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.visitors: ~0 rows (approximately)
/*!40000 ALTER TABLE `visitors` DISABLE KEYS */;
/*!40000 ALTER TABLE `visitors` ENABLE KEYS */;


-- Dumping structure for table agcchurch.weddings
CREATE TABLE IF NOT EXISTS `weddings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wedding_date` int(11) DEFAULT NULL,
  `bride` varchar(32) NOT NULL DEFAULT '',
  `bridegroom` varchar(32) NOT NULL DEFAULT '',
  `venue` varchar(256) NOT NULL DEFAULT '',
  `status` varchar(32) NOT NULL DEFAULT '',
  `brief_description` text,
  `wedding_photo` varchar(256) NOT NULL DEFAULT '',
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table agcchurch.weddings: ~0 rows (approximately)
/*!40000 ALTER TABLE `weddings` DISABLE KEYS */;
/*!40000 ALTER TABLE `weddings` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
