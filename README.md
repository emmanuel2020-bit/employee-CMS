# Employee Management System – PHP CMS Project

This is a simple Employee Management System I built using PHP and MySQL as part of my coursework. It helped me understand how CMS systems work behind the scenes and gave me hands-on experience with working on a full-stack web app.

---

## 🗂 Project Summary

The system lets an admin manage employees, departments, and projects. There’s also a front-facing page where you can view employees and some company stats like how many people work in each department.

I tried to keep it basic and use only **core PHP** and **MySQL** (no frameworks) to get better at writing raw backend logic and database queries.

---

## 💡 Features

### Admin Panel
- Dashboard with quick stats (total employees, departments, projects, etc.)
- Add / Edit / Delete employees
- Manage departments
- Basic user management for admins
- Upload profile photo (stored as Base64 in DB for simplicity)

### Public Site
- View all active employees in a card-style layout
- Shows overall company stats and department breakdown

---

## 🧩 Database Tables

The app uses four main tables:
- `employees` – name, email, department, salary, status, etc.
- `departments` – just id, name, and description
- `projects` – basic info about company projects
- `users` – login credentials for admin

---

## ⚙️ Setup Guide

### You’ll need:
- XAMPP / WAMP or any local server with PHP and MySQL
- Web browser (tested on Chrome)

### Steps:
1. Open phpMyAdmin and create a new database called `employee_cms`
2. Import the SQL file: `admin/employee_cms.sql`
3. Go to `admin/includes/database.php` and check if the DB credentials match your local setup
4. Done!  
   - Open `http://localhost/employee-cms/` for the main site  
   - Admin panel: `http://localhost/employee-cms/admin/`

#### 🔐 Default Admin Credentials
- **Username**: `admin@company.com`  
- **Password**: `admin`  
*(Login page: `http://localhost/employee-cms/admin/`)*

---

## 🧱 File Structure

employee-cms/
├── admin/
│ ├── includes/ # DB config, functions, headers
│ ├── employees_*.php # Add, edit, view employees
│ ├── departments.php
│ ├── dashboard.php
│ ├── users.php
│ ├── logout.php
│ └── employee_cms.sql
├── index.php # Public homepage
└── README.md

yaml
Copy
Edit

---

## ✍️ What I Learned

- Connecting PHP with MySQL using `mysqli`
- Writing SQL queries manually (SELECT, INSERT, JOINs, etc.)
- Form submission with validation and error handling
- Storing image files as Base64 (I know it's not ideal but it worked!)
- Using sessions for admin login/logout
- Organizing PHP projects and separating concerns

---

## 🔧 Challenges Faced

- Validating file uploads securely
- Figuring out how to use SQL joins for departments
- Making sure errors don’t break the layout
- Building the dashboard counters dynamically
- CSS styling took a while (used CSS Grid + some inline styles)

---

## 🚨 Important Security Notes

This project is meant for learning only. Real-world apps should have:
- Strong password hashing (bcrypt instead of MD5)
- Prepared statements to stop SQL injection
- Input sanitization (esp. for file uploads)
- CSRF tokens on forms
- HTTPS and better session handling

---

## 🛠 Tools Used

- PHP 7.4+
- MySQL
- HTML5 + CSS3
- CKEditor for project description editing
- Font Awesome icons

---

## 📘 Notes

> This was built by me for learning PHP backend development. If you’re reviewing this project, feel free to suggest improvements.

---
