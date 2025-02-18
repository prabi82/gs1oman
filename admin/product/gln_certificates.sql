CREATE TABLE IF NOT EXISTS `gln_certificates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `gln_number` varchar(255) NOT NULL,
  `location_name` varchar(255) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `registration_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `certificate_img` varchar(255) NOT NULL,
  `certificate_pdf` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `gln_certificates_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_tbl` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; 