DROP DATABASE IF EXISTS employee_cms;

CREATE DATABASE employee_cms;

USE employee_cms;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first VARCHAR(100),
    last VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(100),
    active VARCHAR(10),
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (first, last, email, password, active) VALUES 
('Admin', 'User', 'admin@company.com', 'md5_hash_here', 'Yes');

CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(20),
    department VARCHAR(100),
    position VARCHAR(100),
    hire_date DATE,
    salary DECIMAL(10,2),
    photo LONGTEXT,
    status ENUM('Active', 'Inactive', 'On Leave') DEFAULT 'Active',
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    manager_id INT,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO departments (name, description) VALUES 
('IT', 'Information Technology Department'),
('HR', 'Human Resources Department'),
('Marketing', 'Marketing and Sales Department'),
('Finance', 'Finance and Accounting Department');

INSERT INTO employees (first_name, last_name, email, phone, department, position, hire_date, salary) VALUES 
('John', 'Smith', 'john.smith@company.com', '555-0101', 'IT', 'Software Developer', '2023-01-15', 65000.00),
('Sarah', 'Johnson', 'sarah.johnson@company.com', '555-0102', 'HR', 'HR Manager', '2022-06-20', 75000.00),
('Mike', 'Davis', 'mike.davis@company.com', '555-0103', 'Marketing', 'Marketing Specialist', '2023-03-10', 55000.00),
('Lisa', 'Wilson', 'lisa.wilson@company.com', '555-0104', 'Finance', 'Accountant', '2022-11-05', 60000.00);

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    content TEXT,
    photo LONGTEXT,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO projects (title, content) VALUES 
('Employee Portal Development', 'Creating a new employee portal for better communication'),
('HR System Upgrade', 'Upgrading the HR management system'),
('Company Website Redesign', 'Redesigning the company website with new branding'); 