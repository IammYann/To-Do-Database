<?php
$host = 'localhost';
$dbname = 'todo_db';
$username = 'root';
$password = '';

// Create connection
$conn = new mysqli($host, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read the SQL file
$sql = ('CREATE DATABASE IF NOT EXISTS todo_db;

USE todo_db;

CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task VARCHAR(255) NOT NULL
);
');

// Execute the SQL commands
if ($conn->multi_query($sql)) {
    echo "Database and table created successfully!";
} else {
    echo "Error: " . $conn->error;
}

// Close connection
$conn->close();
?>
