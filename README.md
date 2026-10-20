 Public Service Request Management System

**A web-based platform for efficient, transparent, and accessible public service request management.**

## 1. Introduction

The Public Service Request Management System is a web application designed to digitize and simplify how citizens submit public service requests and how administrators manage them.

The system provides a centralized platform where citizens can access available functionality, submit requests, and track their progress. Administrators can review submitted requests, manage records, and update request statuses through an administrative interface.

The project aims to improve service delivery, reduce paperwork, strengthen accountability, and promote efficient management of public service requests.

## 2. Problem Statement

Traditional public service request processes may involve paperwork, manual recordkeeping, delays in communication, and difficulties tracking request progress.

This system explores how web technologies can address these challenges by providing a structured digital approach to submitting, processing, and monitoring service requests.

## 3. Project Objectives

- Digitize the public service request submission process.
- Provide citizens with a convenient way to access request-management services.
- Enable administrators to review and process requests systematically.
- Improve the organization and accessibility of digital records.
- Support transparent request-status tracking.
- Promote accountability and efficiency in public service administration.

## 4. System Features

### Citizen Portal

- User registration and login.
- Personalized citizen dashboard.
- Submission of public service requests.
- Viewing submitted requests.
- Monitoring request statuses.
- Access to relevant request information.

### Administrator Portal

- Administrator authentication.
- Administrative dashboard.
- Viewing and reviewing submitted requests.
- Updating request statuses.
- Managing service request records.
- Monitoring requests to support effective service delivery.

### General Features

- Database-driven information management.
- Role-based access control.
- Form validation.
- Session-based authentication.
- Responsive user interface.
- Reusable components and organized project structure.

**Note:** Features listed above should be enabled and tested in the application before being described as fully implemented.

## 5. Technology Stack

| Technology | Application |
|---|---|
| PHP | Server-side logic and request processing |
| MySQL | Data storage and database management |
| HTML5 | Webpage structure |
| CSS3 | Interface styling and responsive design |
| JavaScript | Client-side interaction and validation |
| Apache | Web server |
| XAMPP | Local development environment |
| Git | Source-code version control |
| GitHub | Repository hosting and collaboration |

## 6. System Architecture

The application follows a basic client-server architecture.

1. **Presentation layer:** HTML, CSS, and JavaScript provide the user interface.
2. **Application layer:** PHP processes requests, validates input, manages sessions, and applies application rules.
3. **Data layer:** MySQL stores user information and service request records.
4. **Web server:** Apache serves the application and executes PHP scripts.

### Request Processing Workflow

1. A citizen accesses the application.
2. The citizen registers or logs in, where authentication is required.
3. The citizen submits a service request.
4. The application validates the submitted information.
5. The request is stored in the database.
6. An administrator reviews the request.
7. The administrator updates the request status as appropriate.
8. The citizen views the updated status through the application.

## 7. Project Structure

The following structure illustrates the intended organization of the application. Adjust it to match the actual files in your repository.

```text
public-service-system/
│
├── index.php
├── login.php
├── register.php
├── logout.php
├── database.sql
├── README.md
│
├── config/
│   └── database.php
│
├── includes/
│   ├── header.php
│   ├── footer.php
│   └── functions.php
│
├── citizen/
│   └── dashboard.php
│
├── admin/
│   └── dashboard.php
│
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── script.js
│   └── images/
│
└── uploads/
```

### Directory Responsibilities

- `index.php` — Public homepage and application entry point.
- `login.php` — User authentication interface and processing.
- `register.php` — New-user registration.
- `logout.php` — Session termination.
- `database.sql` — Database creation and table definitions.
- `config/` — Database and application configuration.
- `includes/` — Shared components and reusable functions.
- `citizen/` — Citizen-facing functionality.
- `admin/` — Administrative functionality.
- `assets/css/` — Stylesheets.
- `assets/js/` — JavaScript files.
- `assets/images/` — Interface images and graphics.
- `uploads/` — Uploaded documents, if supported.

## 8. Installation and Setup

### Prerequisites

Install the following software:

- XAMPP or an equivalent PHP development environment.
- PHP.
- MySQL or MariaDB.
- Apache.
- A modern web browser.
- Git, if using version control.

### Step 1: Clone the Repository

Open a terminal and run:

```bash
git clone YOUR_GITHUB_REPOSITORY_URL
```

Replace `YOUR_GITHUB_REPOSITORY_URL` with the actual URL of your GitHub repository.

Alternatively, download the repository as a ZIP file and extract it.

### Step 2: Move the Project

For XAMPP on Windows, place the project inside:

```text
C:\xampp\htdocs\public-service-system
```

Ensure that the main `index.php` file is in the project root.

### Step 3: Start Apache and MySQL

1. Open the XAMPP Control Panel.
2. Start Apache.
3. Start MySQL.
4. Confirm that both services are running.

### Step 4: Create the Database

Open:

```text
http://localhost/phpmyadmin/
```

Import the project's `database.sql` file using the **Import** tab.

If the SQL file does not create the database, create the database with the name expected by the application before importing the table definitions.

Verify that the required tables were created successfully.

### Step 5: Configure the Database

Open:

```text
config/database.php
```

Set the database host, username, password, and database name to match your local environment.

Example configuration:

```php
<?php

// Define the database connection settings.
$host = "localhost";
$username = "root";
$password = "";
$database = "public_service_system";

// Connect to the MySQL database.
$conn = new mysqli(
    $host,
    $username,
    $password,
    $database
);

// Handle connection errors without exposing credentials.
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die("Database connection failed. Please try again later.");
}

// Use UTF-8 for reliable text storage.
$conn->set_charset("utf8mb4");
```

This is an example. Use the database name defined in your SQL file and ensure that the connection variable matches the rest of your PHP code.

### Step 6: Run the Application

Open:

```text
http://localhost/public-service-system/
```

The homepage should load if the server, project paths, and database configuration are correct.

### Step 7: Test the Main Workflows

- Open the registration page and create a test account.
- Log in using the registered account.
- Verify that the correct dashboard opens.
- Test request submission if implemented.
- Confirm that administrators can access only authorized administrative features.
- Test request-status updates if implemented.
- Log out and verify that protected pages require authentication.

Create administrator accounts through a secure, controlled process. Do not assume an administrator account is automatically created during installation.

## 9. Database Documentation

The MySQL database stores the information required by the application's implemented modules.

Depending on the actual schema, it may include:

- **User records:** Account details and assigned roles.
- **Service request records:** Request descriptions, ownership, timestamps, and status.
- **Additional records:** Supporting information for any extra modules implemented.

The exact table names, columns, relationships, and constraints are defined in `database.sql`.

Before deployment, ensure that the database schema matches the queries used by the PHP application.

## 10. Security and Data Protection

The system should follow secure development practices when handling citizen accounts and service records.

Recommended measures include:

- Hash passwords with PHP's `password_hash()` function.
- Verify passwords with `password_verify()`.
- Use prepared statements to reduce SQL injection risks.
- Validate submitted data on the server.
- Escape untrusted output to help prevent cross-site scripting (XSS).
- Enforce role-based authorization on protected pages.
- Regenerate session IDs after successful authentication.
- Protect state-changing forms against cross-site request forgery (CSRF).
- Restrict access to uploaded documents.
- Keep database credentials and secrets out of public repositories.
- Disable public display of detailed errors in production.
- Use HTTPS when deployed to a public server.

Security controls must be implemented and tested; listing them here does not mean they are already present in the code.

## 11. Testing and Troubleshooting

### Apache 404 Error

- Confirm the project is inside the web server's document root.
- Check the requested URL and PHP filename.
- Verify that the file exists at the specified path.

### Database Connection Error

- Ensure MySQL is running.
- Verify the database name and credentials.
- Confirm that the database and required tables exist.
- Check the PHP error log for diagnostic information.

### Login or Registration Failure

- Confirm that form field names match the PHP processing logic.
- Check database constraints and required columns.
- Verify password hashing and verification.
- Review session handling and redirect paths.

### CSS or JavaScript Not Loading

- Verify the asset file paths.
- Check browser developer tools for errors.
- Confirm that filenames and directory names match the references in the HTML or PHP files.

## 12. Future Enhancements

Potential improvements include:

- Email and SMS notifications.
- Unique service request reference numbers.
- Request categorization and prioritization.
- Supporting document uploads.
- Search, filtering, and pagination.
- Administrative reports and analytics.
- Request history and audit trails.
- Accessibility improvements.
- Mobile-friendly interface enhancements.
- Production deployment and automated testing.

These are proposed improvements and are not necessarily part of the current implementation.

## 13. Contributing

Contributions are welcome if the repository is open to collaboration.

1. Fork the repository.
2. Create a feature branch.
3. Implement and test your changes.
4. Commit your changes with a descriptive message.
5. Submit a pull request describing the improvements.

Please avoid committing passwords, personal records, production credentials, or other confidential information.

## 14. Project Status

**Status: In development**

The project is intended to provide a digital approach to public service request submission and management. Features and documentation will be updated as development and testing progress.

## 15. Author

**Samuel Ndungu**

Business Information Technology graduate interested in software development, IT support, database management, and practical digital solutions.

GitHub: Add your GitHub profile URL.

## 16. License

A license has not yet been specified. Add a `LICENSE` file if you intend to distribute the project under a particular open-source license.

---

**Public Service Request Management System** — Building a foundation for more organized, accessible, and accountable public service delivery.
# Public Service Request Management System

**A web-based platform for efficient, transparent, and accessible public service request management.**

## 1. Introduction

The Public Service Request Management System is a web application designed to digitize and simplify how citizens submit public service requests and how administrators manage them.

The system provides a centralized platform where citizens can access available functionality, submit requests, and track their progress. Administrators can review submitted requests, manage records, and update request statuses through an administrative interface.

The project aims to improve service delivery, reduce paperwork, strengthen accountability, and promote efficient management of public service requests.

## 2. Problem Statement

Traditional public service request processes may involve paperwork, manual recordkeeping, delays in communication, and difficulties tracking request progress.

This system explores how web technologies can address these challenges by providing a structured digital approach to submitting, processing, and monitoring service requests.

## 3. Project Objectives

- Digitize the public service request submission process.
- Provide citizens with a convenient way to access request-management services.
- Enable administrators to review and process requests systematically.
- Improve the organization and accessibility of digital records.
- Support transparent request-status tracking.
- Promote accountability and efficiency in public service administration.

## 4. System Features

### Citizen Portal

- User registration and login.
- Personalized citizen dashboard.
- Submission of public service requests.
- Viewing submitted requests.
- Monitoring request statuses.
- Access to relevant request information.

### Administrator Portal

- Administrator authentication.
- Administrative dashboard.
- Viewing and reviewing submitted requests.
- Updating request statuses.
- Managing service request records.
- Monitoring requests to support effective service delivery.

### General Features

- Database-driven information management.
- Role-based access control.
- Form validation.
- Session-based authentication.
- Responsive user interface.
- Reusable components and organized project structure.

**Note:** Features listed above should be enabled and tested in the application before being described as fully implemented.

## 5. Technology Stack

| Technology | Application |
|---|---|
| PHP | Server-side logic and request processing |
| MySQL | Data storage and database management |
| HTML5 | Webpage structure |
| CSS3 | Interface styling and responsive design |
| JavaScript | Client-side interaction and validation |
| Apache | Web server |
| XAMPP | Local development environment |
| Git | Source-code version control |
| GitHub | Repository hosting and collaboration |

## 6. System Architecture

The application follows a basic client-server architecture.

1. **Presentation layer:** HTML, CSS, and JavaScript provide the user interface.
2. **Application layer:** PHP processes requests, validates input, manages sessions, and applies application rules.
3. **Data layer:** MySQL stores user information and service request records.
4. **Web server:** Apache serves the application and executes PHP scripts.

### Request Processing Workflow

1. A citizen accesses the application.
2. The citizen registers or logs in, where authentication is required.
3. The citizen submits a service request.
4. The application validates the submitted information.
5. The request is stored in the database.
6. An administrator reviews the request.
7. The administrator updates the request status as appropriate.
8. The citizen views the updated status through the application.

## 7. Project Structure

The following structure illustrates the intended organization of the application. Adjust it to match the actual files in your repository.

```text
public-service-system/
│
├── index.php
├── login.php
├── register.php
├── logout.php
├── database.sql
├── README.md
│
├── config/
│   └── database.php
│
├── includes/
│   ├── header.php
│   ├── footer.php
│   └── functions.php
│
├── citizen/
│   └── dashboard.php
│
├── admin/
│   └── dashboard.php
│
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── script.js
│   └── images/
│
└── uploads/
```

### Directory Responsibilities

- `index.php` — Public homepage and application entry point.
- `login.php` — User authentication interface and processing.
- `register.php` — New-user registration.
- `logout.php` — Session termination.
- `database.sql` — Database creation and table definitions.
- `config/` — Database and application configuration.
- `includes/` — Shared components and reusable functions.
- `citizen/` — Citizen-facing functionality.
- `admin/` — Administrative functionality.
- `assets/css/` — Stylesheets.
- `assets/js/` — JavaScript files.
- `assets/images/` — Interface images and graphics.
- `uploads/` — Uploaded documents, if supported.

## 8. Installation and Setup

### Prerequisites

Install the following software:

- XAMPP or an equivalent PHP development environment.
- PHP.
- MySQL or MariaDB.
- Apache.
- A modern web browser.
- Git, if using version control.

### Step 1: Clone the Repository

Open a terminal and run:

```bash
git clone YOUR_GITHUB_REPOSITORY_URL
```

Replace `YOUR_GITHUB_REPOSITORY_URL` with the actual URL of your GitHub repository.

Alternatively, download the repository as a ZIP file and extract it.

### Step 2: Move the Project

For XAMPP on Windows, place the project inside:

```text
C:\xampp\htdocs\public-service-system
```

Ensure that the main `index.php` file is in the project root.

### Step 3: Start Apache and MySQL

1. Open the XAMPP Control Panel.
2. Start Apache.
3. Start MySQL.
4. Confirm that both services are running.

### Step 4: Create the Database

Open:

```text
http://localhost/phpmyadmin/
```

Import the project's `database.sql` file using the **Import** tab.

If the SQL file does not create the database, create the database with the name expected by the application before importing the table definitions.

Verify that the required tables were created successfully.

### Step 5: Configure the Database

Open:

```text
config/database.php
```

Set the database host, username, password, and database name to match your local environment.

Example configuration:

```php
<?php

// Define the database connection settings.
$host = "localhost";
$username = "root";
$password = "";
$database = "public_service_system";

// Connect to the MySQL database.
$conn = new mysqli(
    $host,
    $username,
    $password,
    $database
);

// Handle connection errors without exposing credentials.
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die("Database connection failed. Please try again later.");
}

// Use UTF-8 for reliable text storage.
$conn->set_charset("utf8mb4");
```

This is an example. Use the database name defined in your SQL file and ensure that the connection variable matches the rest of your PHP code.

### Step 6: Run the Application

Open:

```text
http://localhost/public-service-system/
```

The homepage should load if the server, project paths, and database configuration are correct.

### Step 7: Test the Main Workflows

- Open the registration page and create a test account.
- Log in using the registered account.
- Verify that the correct dashboard opens.
- Test request submission if implemented.
- Confirm that administrators can access only authorized administrative features.
- Test request-status updates if implemented.
- Log out and verify that protected pages require authentication.

Create administrator accounts through a secure, controlled process. Do not assume an administrator account is automatically created during installation.

## 9. Database Documentation

The MySQL database stores the information required by the application's implemented modules.

Depending on the actual schema, it may include:

- **User records:** Account details and assigned roles.
- **Service request records:** Request descriptions, ownership, timestamps, and status.
- **Additional records:** Supporting information for any extra modules implemented.

The exact table names, columns, relationships, and constraints are defined in `database.sql`.

Before deployment, ensure that the database schema matches the queries used by the PHP application.

## 10. Security and Data Protection

The system should follow secure development practices when handling citizen accounts and service records.

Recommended measures include:

- Hash passwords with PHP's `password_hash()` function.
- Verify passwords with `password_verify()`.
- Use prepared statements to reduce SQL injection risks.
- Validate submitted data on the server.
- Escape untrusted output to help prevent cross-site scripting (XSS).
- Enforce role-based authorization on protected pages.
- Regenerate session IDs after successful authentication.
- Protect state-changing forms against cross-site request forgery (CSRF).
- Restrict access to uploaded documents.
- Keep database credentials and secrets out of public repositories.
- Disable public display of detailed errors in production.
- Use HTTPS when deployed to a public server.

Security controls must be implemented and tested; listing them here does not mean they are already present in the code.

## 11. Testing and Troubleshooting

### Apache 404 Error

- Confirm the project is inside the web server's document root.
- Check the requested URL and PHP filename.
- Verify that the file exists at the specified path.

### Database Connection Error

- Ensure MySQL is running.
- Verify the database name and credentials.
- Confirm that the database and required tables exist.
- Check the PHP error log for diagnostic information.

### Login or Registration Failure

- Confirm that form field names match the PHP processing logic.
- Check database constraints and required columns.
- Verify password hashing and verification.
- Review session handling and redirect paths.

### CSS or JavaScript Not Loading

- Verify the asset file paths.
- Check browser developer tools for errors.
- Confirm that filenames and directory names match the references in the HTML or PHP files.

## 12. Future Enhancements

Potential improvements include:

- Email and SMS notifications.
- Unique service request reference numbers.
- Request categorization and prioritization.
- Supporting document uploads.
- Search, filtering, and pagination.
- Administrative reports and analytics.
- Request history and audit trails.
- Accessibility improvements.
- Mobile-friendly interface enhancements.
- Production deployment and automated testing.

These are proposed improvements and are not necessarily part of the current implementation.

## 13. Contributing

Contributions are welcome if the repository is open to collaboration.

1. Fork the repository.
2. Create a feature branch.
3. Implement and test your changes.
4. Commit your changes with a descriptive message.
5. Submit a pull request describing the improvements.

Please avoid committing passwords, personal records, production credentials, or other confidential information.

## 14. Project Status

**Status: In development**

The project is intended to provide a digital approach to public service request submission and management. Features and documentation will be updated as development and testing progress.

## 15. Author

**Samuel Ndungu**

Business Information Technology graduate interested in software development, IT support, database management, and practical digital solutions.

GitHub: Add your GitHub profile URL.

## 16. License

A license has not yet been specified. Add a `LICENSE` file if you intend to distribute the project under a particular open-source license.

---

**Public Service Request Management System** — Building a foundation for more organized, accessible, and accountable public service delivery.
