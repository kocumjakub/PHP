create database carriers;

CREATE TABLE `carrier_point` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `external_id` varchar(255) NOT NULL,
  `carrier` varchar(255) NOT NULL,
  `type` enum('box','point') NOT NULL,
  `status` enum('available','temporarily_unavailable','closed','terminated') NOT NULL,
  `city` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `country` varchar(2) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `opening_hours` longtext DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `carrier_external_id_country` (`carrier`,`external_id`,`country`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci