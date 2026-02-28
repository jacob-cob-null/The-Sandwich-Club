<?php
// Connection settings are read from Docker environment variables.

// Fallback values mirror the .env.example defaults for convenience.
$servername = getenv('DB_HOST')     ?: 'db';
$username   = getenv('DB_USER')     ?: 'root';
$password   = getenv('DB_PASSWORD') ?: 'secret';
$dbname     = getenv('DB_NAME')     ?: 'restaurant_db';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, 'utf8mb4');
