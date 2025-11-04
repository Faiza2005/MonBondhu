<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "monbondhu";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // If database doesn't exist, create it
    if ($conn->connect_errno == 1049) {
        createDatabaseAndTables($servername, $username, $password, $dbname);
        $conn = new mysqli($servername, $username, $password, $dbname);
    } else {
        die("Connection failed: " . $conn->connect_error);
    }
}

function createDatabaseAndTables($servername, $username, $password, $dbname) {
    // Create connection without database
    $temp_conn = new mysqli($servername, $username, $password);
    
    if ($temp_conn->connect_error) {
        die("Connection failed: " . $temp_conn->connect_error);
    }
    
    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($temp_conn->query($sql) === TRUE) {
        echo "Database created successfully<br>";
    } else {
        echo "Error creating database: " . $temp_conn->error;
    }
    
    // Select database
    $temp_conn->select_db($dbname);
    
    // Create users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(100),
        phone VARCHAR(20),
        email VARCHAR(100),
        username VARCHAR(50) UNIQUE,
        password_hash VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if ($temp_conn->query($sql) === TRUE) {
        echo "Users table created successfully<br>";
    } else {
        echo "Error creating table: " . $temp_conn->error;
    }
    
    // Insert demo user
    $demo_password = password_hash('demo123', PASSWORD_DEFAULT);
    $sql = "INSERT IGNORE INTO users (full_name, phone, email, username, password_hash) 
            VALUES ('Demo User', '0123456789', 'demo@monbondhu.com', 'demo', '$demo_password')";
    $temp_conn->query($sql);
    
    $temp_conn->close();
}
?>