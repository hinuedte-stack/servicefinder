-- ServiceFinder Database Setup
-- Run this in phpMyAdmin or MySQL command line

CREATE DATABASE IF NOT EXISTS servicefinder;
USE servicefinder;

-- Table for users (both regular users and admins)
CREATE TABLE IF NOT EXISTS service_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    account_type ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for services added by admins
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    provider_id INT NOT NULL,
    service_name VARCHAR(255) NOT NULL,
    service_details TEXT NOT NULL,
    category VARCHAR(100) NOT NULL,
    experience VARCHAR(100) NOT NULL,
    contact_info VARCHAR(100) NOT NULL,
    service_image VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (provider_id) REFERENCES service_users(id) ON DELETE CASCADE
);

-- Insert a sample admin account (password: admin123)
INSERT INTO service_users (username, password, account_type) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin')
ON DUPLICATE KEY UPDATE username=username;

-- Insert a sample user account (password: user123)
INSERT INTO service_users (username, password, account_type) 
VALUES ('user', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user')
ON DUPLICATE KEY UPDATE username=username;

