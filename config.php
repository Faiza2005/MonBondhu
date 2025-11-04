<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'health_assistant');
define('DB_USER', 'root');
define('DB_PASS', '');

// API Configuration
define('OPENAI_API_KEY', 'your_openai_api_key_here');

// Application settings
define('APP_NAME', 'Shastho Shohayika');
define('APP_VERSION', '1.0');
define('MAX_MESSAGE_LENGTH', 1000);

// Emergency contacts
define('EMERGENCY_NUMBER', '999');
define('MENTAL_HEALTH_SUPPORT', '1800-1888');

// Initialize session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Database connection
function getDBConnection() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        error_log("Database connection failed: " . $e->getMessage());
        return null;
    }
}
?> 