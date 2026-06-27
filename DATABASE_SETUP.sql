-- =========================================================
-- MAISON DE HOOR - DATABASE SETUP FOR LARAVEL
-- Run this file in MySQL Workbench to create the database
-- =========================================================

-- Create Database
CREATE DATABASE IF NOT EXISTS reema_shop;
USE reema_shop;

-- Sample Categories (run after migrations)
-- INSERT INTO categories (name, description, image, created_at, updated_at) VALUES
-- ('Electronics', 'Electronic devices and gadgets', NULL, NOW(), NOW()),
-- ('Fashion', 'Clothing and accessories', NULL, NOW(), NOW()),
-- ('Home & Garden', 'Home and garden products', NULL, NOW(), NOW()),
-- ('Books', 'Books and educational materials', NULL, NOW(), NOW());

-- Sample Products (run after migrations - adjust category_id as needed)
-- INSERT INTO products (name, description, price, stock, category_id, image, created_at, updated_at) VALUES
-- ('Laptop', 'High-performance laptop', 999.99, 5, 1, NULL, NOW(), NOW()),
-- ('Phone', 'Latest smartphone model', 699.99, 10, 1, NULL, NOW(), NOW()),
-- ('T-Shirt', 'Cotton t-shirt', 19.99, 50, 2, NULL, NOW(), NOW()),
-- ('Jeans', 'Classic blue jeans', 49.99, 30, 2, NULL, NOW(), NOW()),
-- ('Coffee Maker', 'Automatic coffee machine', 89.99, 15, 3, NULL, NOW(), NOW());

-- =========================================================
-- SETUP INSTRUCTIONS:
-- =========================================================
-- 1. Copy this entire file
-- 2. Open MySQL Workbench
-- 3. File → Open SQL Script → Select this file
-- 4. Click Execute (⚡) button
-- 5. Go back to terminal and run: php artisan migrate
-- 6. Your database is ready!
-- =========================================================
