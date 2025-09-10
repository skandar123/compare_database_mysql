# Database Comparison Tool (PHP + MySQL)
### 📌 Overview

This project is a web-based tool built in PHP and MySQL to compare the schema of two databases.
It allows users to:

* Select two databases from a MySQL server.
* Compare all tables and columns between them.
* Compare specific tables across the two databases.
* Display results in a clean, styled grid layout:
  * ✅ Matching tables and columns.
  * ⚠️ Non-matching tables or columns with datatype differences.

### 🚀 Features

* Web interface to select two databases.
* Compare:
  * All tables between two databases.
  * Specific tables from each database.
* Highlights:
  * Matching table/column names with datatypes.
  * Non-matching tables/columns unique to each database.
* Responsive and styled interface using CSS grids.

### 📂 Project Structure

    compare_tables
    ├── config.php                # MySQL connection setup
    ├── db_query.php              # Query handling logic
    ├── select_db.php             # UI for selecting two databases
    ├── select_tables.php         # UI for selecting specific tables
    ├── all_tables.php            # Compare all tables between DBs
    ├── two_tables.php            # Compare two selected tables
    ├── style_compare_tables.css  # CSS for styling grids and layout

### ⚙️ Requirements

1. PHP 7.x or above
2. MySQL 5.7+ or MariaDB
3. Web server (Apache/Nginx with PHP support)

### 🔧 Setup Instructions

Clone or copy the project into your web server root (e.g., htdocs/ for XAMPP).

    git clone <repo-url>
    cd database-compare-tool

Update database credentials in config.php:

    <?php
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    ?>

Start your web server (XAMPP, WAMP, or similar).

Open the tool in your browser:

    http://localhost/database-compare-tool/select_db.php

### 🖥️ Usage

1. Step 1 – Select Databases

   * Navigate to select_db.php.
   * Choose two databases from the dropdown menus.
   * Click All Tables (to compare all tables) or Select Tables.

2. Step 2 – Compare Tables

* If you selected All Tables, results show:
  * ✅ Matching tables/columns.
  * ⚠️ Non-matching columns.
* If you selected Select Tables, choose specific tables from both databases.

3. Step 3 – View Results

* Matching data types are displayed side by side.
* Non-matching tables/columns are listed separately.

### 🎨 UI Preview

* Matching Tables and Columns: Green highlights show consistent schema.
* Non-Matching Columns: Displayed separately for each database.
* Clean grid layout with SeaGreen accent styling.

### 🔍 Example

#### Matching Output (DB1 vs DB2)

Table | Column | DB1 Type | DB2 Type |
------| ------ | -------- | -------- |
users | id     | int      | int      |
users | name   | varchar  | varchar  |

#### Non-Matching Output

* DB1 only: users.email (varchar)
* DB2 only: users.phone (varchar)

### 📌 Notes

* Only works on MySQL/MariaDB databases.
* Ensure the MySQL user has access to INFORMATION_SCHEMA.
* Tested on XAMPP with PHP 8.1 and MySQL 8.0.

### 👩‍💻 Author

Sayantika Kandar