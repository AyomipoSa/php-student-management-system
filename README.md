# PHP Student Management System

A full-featured student management system built with PHP and MySQL using Object-Oriented Programming (OOP). The application includes authentication, session management, CRUD operations, search, pagination, and Excel export functionality.


## Overview

This project was developed to demonstrate backend web development concepts using PHP and MySQL, with a focus on clean project structure, database relationships, authentication, and dynamic data management.

The system allows authenticated users to:

* Manage student records
* Manage cities and languages
* Search student records
* Paginate results from the database
* Export records to Excel
* Maintain secure user sessions

---

# Features

## Authentication & Security

* User registration
* Secure password hashing
* Login authentication
* Session protection
* Logout functionality

## Student Management

* Create students
* View student details
* Edit student records
* Delete student records

## Additional Management Modules

* Manage cities
* Manage languages
* Relational database structure

## Data Features

* Search functionality
* Pagination using MySQL queries
* Excel export using PhpSpreadsheet

## Frontend

* Responsive layout
* Clean CSS styling
* Organized template structure

---

# Technologies Used

| Technology     | Purpose               |
| -------------- | --------------------- |
| PHP            | Backend development   |
| MySQL          | Database management   |
| HTML5          | Structure             |
| CSS3           | Styling               |
| PhpSpreadsheet | Excel export          |
| Composer       | Dependency management |

---

# Project Structure

```text
php-student-management-system/
│
├── classes/                # PHP classes
├── templates/              # UI templates
│   ├── auth/
│   ├── manage/
│   ├── partials/
│   └── students/
│
├── vendor/                 # Composer dependencies
├── exports/                # Generated Excel files
│
├── index.php
├── students.php
├── login.php
├── register.php
├── logout.php
├── export_students.php
│
├── composer.json
├── composer.lock
├── student_management.sql
└── README.md
```

---

# Database Design

The project uses a relational MySQL database structure with relationships between:

* Students
* Cities
* Languages
* Users

A junction table is used to support many-to-many relationships between students and languages.

---

# Installation

## 1. Clone the repository

```bash
git clone https://github.com/YOUR_USERNAME/php-student-management-system.git
```

## 2. Open the project folder

```bash
cd php-student-management-system
```

## 3. Install dependencies

```bash
composer install
```

## 4. Create the database

Create a MySQL database and import the SQL file:

```text
student_management.sql
```

Suggested database name:

```text
student_management
```

---

# Database Configuration

Update database credentials inside:

```text
classes/Database.php
```

Example:

```php
private $host = "localhost";
private $username = "root";
private $password = "";
private $dbname = "student_management";
```

---

# Running the Application

## Using PHP Built-in Server

```bash
php -S localhost:8000
```

Open in browser:

```text
http://localhost:8000
```

---

# Demo Account

```text
Username: admin
Password: admin123
```

---

# Excel Export

The application supports exporting student records to Excel using PhpSpreadsheet.

Exported fields include:

* Name
* Surname
* Phone
* Email
* Gender
* City
* Languages

---

# Git Ignore

Recommended `.gitignore`:

```gitignore
/vendor/
/exports/
/students.xlsx
.DS_Store
```

---

# Future Improvements

* PDF export support
* User role management
* Dashboard analytics
* Student profile images
* REST API integration
* Email notifications

---

# Learning Outcomes

This project demonstrates practical understanding of:

* Object-Oriented PHP
* CRUD operations
* Authentication and sessions
* Relational database design
* Prepared statements
* Search and pagination
* Composer package management
* Third-party library integration
* Exporting dynamic data to Excel

---

# Author

Sanni Ayomipo Rodiat

---
