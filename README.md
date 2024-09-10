# Sticky Notes Application

This repository contains a Dockerized PHP-FPM 8.3 application with Nginx and MySQL. It includes a simple sticky notes application that demonstrates how to set up and run a web application using Docker Compose.

## Application Flow

1. **Docker Setup**:
   - The `Dockerfile` sets up the PHP-FPM environment, installs necessary PHP extensions, and configures Nginx.
   - The `docker-compose.yml` file defines two services: `web` (for the PHP-FPM and Nginx setup) and `db` (for the MySQL database).

2. **Service Details**:
   - **Web Service**:
     - Built from the `Dockerfile`.
     - Listens on port 8080 and maps to port 80 in the container.
     - Uses environment variables from the `.env` file.
     - Mounts the current directory to `/var/www/html` in the container.
   - **Database Service**:
     - Uses the MySQL 8.0 image.
     - Restarts automatically on failure.
     - Initializes the database with `init.sql` and stores data in a Docker volume `db_data`.

3. **Application Flow**:
   - **Nginx** serves as the web server and forwards requests to PHP-FPM.
   - **PHP-FPM** processes PHP files and interacts with the MySQL database.
   - **MySQL** stores the application data and is configured using environment variables.

## Environment Variables

The `.env` file contains configuration settings for the MySQL database. These variables are loaded into the `db_connect.php` script using the `getenv()` function:

- **MYSQL_ROOT_PASSWORD**: The root password for MySQL.
- **MYSQL_DATABASE**: The name of the database to use.
- **MYSQL_USER**: The MySQL user to connect as.
- **MYSQL_PASSWORD**: The password for the MySQL user.

In `db/db_connect.php`, these variables are accessed to establish a connection to the MySQL database:

```php
<?php
$servername = 'db'; // The service name for MySQL in Docker Compose
$username = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
$dbname = getenv('MYSQL_DATABASE');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```
## Getting Started

### Prerequisites

- Docker installed on your machine.
- Docker Compose installed on your machine.

## Setup

### Clone the Repository

```bash
git clone <repository-url>
cd <repository-directory>
```
### Prepare Environment Variables

Copy the example environment file to .env:

```bash
cp env-template .env
```
Edit the .env file to match your database configuration:
```bash
vim .env
```
### Update the database details as needed.

Build and Start the Application

```bash
docker-compose up --build
```

## Access the Application

Open your web browser and go to http://localhost:8080 to see the application running.

### Troubleshooting

*Connection Issues*
* Ensure that the MySQL service is running and accessible.
* Verify that environment variables in the .env file are correctly set.

## Logs

View logs for the web service using:

```bash
docker-compose logs web
```

View logs for the database service using:

```bash
docker-compose logs db
```