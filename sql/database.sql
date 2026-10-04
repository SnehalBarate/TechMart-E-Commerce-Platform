CREATE DATABASE IF NOT EXISTS mini_store;
USE mini_store;

-- ============================================
-- USERS TABLE
-- ============================================

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- ============================================
-- PRODUCTS TABLE
-- ============================================

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    category VARCHAR(100)
);

-- ============================================
-- WISHLIST TABLE
-- ============================================

CREATE TABLE IF NOT EXISTS wishlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_email VARCHAR(255) NOT NULL,
    product_id INT NOT NULL
);

-- ============================================
-- ORDERS TABLE
-- ============================================

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_email VARCHAR(255) NOT NULL,
    product_name VARCHAR(255),
    price DECIMAL(10,2),
    quantity INT DEFAULT 1,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- PRODUCTS
-- ============================================

INSERT INTO products (name, price, image, category) VALUES
('Modern Watch', 1500.00, 'watch.jpg', 'Watch'),
('Wireless Buds', 2000.00, 'buds.jpg', 'Phone'),
('Leather Bag', 2500.00, 'bag.jpg', 'Other'),
('Smart Phone', 15000.00, 'phone.jpg', 'Phone'),
('Amazfit Smart Watch', 4999.00, 'amazfit.png', 'Watch'),
('Apple Watch', 8999.00, 'applewatch.png', 'Watch'),
('Canon Camera', 45000.00, 'camera.jpg', 'Camera'),
('Dell XPS Laptop', 95000.00, 'dellxps.png', 'Laptop'),
('Fossil Smart Watch', 12999.00, 'fossil.png', 'Watch'),
('Samsung Galaxy Watch', 24999.00, 'galaxywatch.png', 'Watch'),
('Wireless Headphones', 3999.00, 'headphones.jpg', 'Headphones'),
('HP Spectre Laptop', 89999.00, 'hpspectre.png', 'Laptop'),
('iPhone 15', 69999.00, 'iphone15.png', 'Phone'),
('Mechanical Keyboard', 2999.00, 'keyboard.jpg', 'Accessories'),
('Gaming Laptop', 75000.00, 'laptop.jpg', 'Laptop'),
('MacBook M3', 114999.00, 'macbookm3.png', 'Laptop'),
('Gaming Mouse', 1999.00, 'mouse.jpg', 'Accessories'),
('OnePlus 11', 54999.00, 'oneplus11.png', 'Phone'),
('Google Pixel 8', 59999.00, 'pixel8.png', 'Phone'),
('Power Bank', 1999.00, 'powerbank.jpg', 'Accessories'),
('ROG Gaming Laptop', 109999.00, 'rog.png', 'Laptop'),
('Samsung S23 Ultra', 99999.00, 's23ultra.png', 'Phone'),
('Bluetooth Speaker', 2999.00, 'speaker.jpg', 'Speaker'),
('Android Tablet', 24999.00, 'tablet.jpg', 'Tablet');
