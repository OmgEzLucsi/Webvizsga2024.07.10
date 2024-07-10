
CREATE DATABASE service;


USE service;


CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    serial_number VARCHAR(50) NOT NULL,
    manufacturer VARCHAR(50) NOT NULL,
    type VARCHAR(50) NOT NULL,
    date_received DATE NOT NULL,
    status ENUM('Beérkezett', 'Hibafeltárás', 'Alkatrészbeszerzésalatt', 'Javítás', 'Kész') NOT NULL,
    last_status_update DATETIME NOT NULL
);


CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(id)
);
