<?php
// Database connection configuration
$host = 'localhost';       // Database server (typically 'localhost')
$dbname = 'survey_database'; // Replace with your actual database name
$username = 'root';        // Default MySQL username in XAMPP (can be different depending on your setup)
$password = '';            // Default MySQL password in XAMPP (empty by default)

// Set up the PDO connection
try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If the connection fails, display the error
    echo "Connection failed: " . $e->getMessage();
}
?>
