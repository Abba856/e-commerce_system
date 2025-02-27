# e-commerce_system
### Backend development project assignment

## setting up the database schema since it forms the foundation for the rest of the system
### Database Schema Design
We'll create four main tables:
1. Users
2. Products
3. Orders
4. Order_Items

# SQL code to create a database named db_ecommerce_system
CREATE DATABASE db_ecommerce_system;
USE db_ecommerce_system;

# Create Users Table
-- Create Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',  -- Roles
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

# Create Products Table
-- Create Products Table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

# Create Orders Table
-- Create Orders Table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

# Create Order Items Table
-- Create Order Items Table
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id)
);


# Setting Up the Project
1. Install XAMPP:
Download and install XAMPP to run your local server and MySQL database.
2. Create the Project Directory:
In your htdocs (XAMPP) folder, create a directory, e.g., ecommerce-backend.
3. Set Up the Database:
Start MySQL via XAMPP.
Use phpMyAdmin to create a new database (e.g., db_ecommerce_system).
Run the SQL script above to create the tables.


# Admin dashboard setup tutorial
-->  https://youtube.com/playlist?list=PL_99hMDlL4d0iIf0aji2kc4_e8VleaFw2&si=PeOtUG6_tUFTLJZy




# config your git hub
### this tutorial will help you.

1. https://youtu.be/i_23KUAEtUM?si=80luL_M-92swvTpU
2. https://youtu.be/f0Dgp47sY14?si=UXlpdFtr3ZI7-dL6
3. https://youtu.be/eGaImwD8fPQ?si=4yuT1T28qOVaTAg5
4. https://youtu.be/vRxfnHtCxEo?si=z-yfnq65xSCxfqz_
5. https://youtu.be/Pwq7L9C9YyE?si=KGYzNtQfzmIY2gOX