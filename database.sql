-- SQL dump for ci4_auth_app
CREATE DATABASE IF NOT EXISTS `ci4_auth_app` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `ci4_auth_app`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(191) NOT NULL UNIQUE,
  `password_hash` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `signature_image` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default admin user
-- Email: admin@example.com
-- Password: admin123
INSERT INTO `users` (`first_name`, `last_name`, `email`, `password_hash`, `is_admin`, `created_at`, `updated_at`) 
VALUES ('Admin', 'User', 'admin@example.com', '$2y$10$a0L/I1BOg/si5hnqpEL2ue.ZZ5hyqtrbSPiKlchgAGQeRexmxVri2', 1, NOW(), NOW());

-- Note: The password hash above is for 'admin123'
-- ⚠️ IMPORTANT: Change the password after first login!
-- 
-- To create admin user using seeder instead, run:
-- php spark db:seed AdminUserSeeder

