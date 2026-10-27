-- ========================================================
-- SI-Berapi (Sistem Informasi Bencana Gunung Berapi)
-- MySQL Database Dump & Schema for XAMPP Localhost
-- Database: `si_berapi`
-- ========================================================

CREATE DATABASE IF NOT EXISTS `si_berapi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `si_berapi`;

-- 1. Table: users
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Admin: admin@siberapi.id / admin123
INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Pusat Pengendali SI-Berapi', 'admin@siberapi.id', '$2y$12$N2hZzP/mZlV6l7HqU8uF2eV55mFm6QOaL1Z8pDqmz5M4kM9gH7C5e', NOW(), NOW());

-- 2. Table: volcanoes
DROP TABLE IF EXISTS `volcanoes`;
CREATE TABLE `volcanoes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `height` int(11) NOT NULL,
  `status_level` enum('Normal','Waspada','Siaga','Awas') NOT NULL DEFAULT 'Normal',
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `description` text NOT NULL,
  `safety_radius` varchar(50) NOT NULL DEFAULT '3 km',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Table: missing_persons
DROP TABLE IF EXISTS `missing_persons`;
CREATE TABLE `missing_persons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reporter_name` varchar(255) NOT NULL,
  `reporter_phone` varchar(50) NOT NULL,
  `victim_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `characteristics` text NOT NULL,
  `volcano_id` bigint(20) unsigned DEFAULT NULL,
  `last_seen_location` varchar(255) NOT NULL,
  `last_seen_date` date NOT NULL,
  `status` enum('Dicari','Ditemukan') NOT NULL DEFAULT 'Dicari',
  `notes` text DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `missing_persons_volcano_id_foreign` (`volcano_id`),
  CONSTRAINT `missing_persons_volcano_id_foreign` FOREIGN KEY (`volcano_id`) REFERENCES `volcanoes` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Table: disaster_histories
DROP TABLE IF EXISTS `disaster_histories`;
CREATE TABLE `disaster_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `volcano_id` bigint(20) unsigned NOT NULL,
  `event_date` date NOT NULL,
  `description` text NOT NULL,
  `impact_summary` text NOT NULL,
  `casualties_count` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `disaster_histories_volcano_id_foreign` (`volcano_id`),
  CONSTRAINT `disaster_histories_volcano_id_foreign` FOREIGN KEY (`volcano_id`) REFERENCES `volcanoes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Table: education_contents
DROP TABLE IF EXISTS `education_contents`;
CREATE TABLE `education_contents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category` enum('definisi','penyebab','dampak','mitigasi') NOT NULL DEFAULT 'definisi',
  `content` longtext NOT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
