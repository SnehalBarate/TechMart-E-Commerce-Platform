CREATE DATABASE IF NOT EXISTS mini_store;
USE mini_store;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    category VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS wishlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_email VARCHAR(255) NOT NULL,
    product_id INT NOT NULL
);

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_email VARCHAR(255) NOT NULL,
    product_name VARCHAR(255),
    price DECIMAL(10,2),
    quantity INT DEFAULT 1,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (name, price, image, category) VALUES
('Modern Watch', 1500.00, 'watch.jpg', 'Watch'),
('Wireless Buds', 2000.00, 'buds.jpg', 'Phone'),
('Leather Bag', 2500.00, 'bag.jpg', 'Other'),
('Smart Phone', 15000.00, 'phone.jpg', 'Phone');
