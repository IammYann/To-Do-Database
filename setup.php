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
$sql = file_get_contents('schema.sql');

// Execute the SQL commands
if ($conn->multi_query($sql)) {
    echo "Database and table created successfully!";
} else {
    echo "Error: " . $conn->error;
}

// Close connection
$conn->close();
?>
