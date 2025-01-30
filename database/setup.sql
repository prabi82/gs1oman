-- Create admin_tbl if not exists
CREATE TABLE IF NOT EXISTS `admin_tbl` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `email_id` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `roles` varchar(50) DEFAULT 'admin',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default admin user if not exists
INSERT INTO `admin_tbl` (`email_id`, `password`, `roles`) 
SELECT 'admin@example.com', SHA1('admin123'), 'admin'
WHERE NOT EXISTS (SELECT 1 FROM `admin_tbl` WHERE email_id = 'admin@example.com');

-- Create system_settings table if not exists
CREATE TABLE IF NOT EXISTS `system_settings` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `website_name` varchar(255) DEFAULT 'GS1 Oman',
    `website_url` varchar(255) DEFAULT 'http://localhost/gs1oman.com/',
    `admin_url` varchar(255) DEFAULT 'http://localhost/gs1oman.com/admin/',
    `logo` varchar(255) DEFAULT 'images/logo.png',
    `favicon` varchar(255) DEFAULT 'images/favicon.ico',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default system settings if not exists
INSERT INTO `system_settings` (`id`, `website_name`, `website_url`, `admin_url`) 
SELECT 1, 'GS1 Oman', 'http://localhost/gs1oman.com/', 'http://localhost/gs1oman.com/admin/'
WHERE NOT EXISTS (SELECT 1 FROM `system_settings` WHERE id = 1); 