<?php
// Test MySQL connection
$host = '127.0.0.1';
$user = 'root';
$password = '';
$database = 'reema_shop';

try {
    $conn = new mysqli($host, $user, $password, $database);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    echo "✅ DATABASE CONNECTION SUCCESSFUL!\n";
    echo "Host: " . $host . "\n";
    echo "Database: " . $database . "\n";
    
    // Check if videos table exists
    $result = $conn->query("SHOW TABLES LIKE 'videos'");
    if ($result->num_rows > 0) {
        echo "✅ Videos table EXISTS\n";
    } else {
        echo "❌ Videos table NOT FOUND - need to create it\n";
    }
    
    $conn->close();
    
} catch (Exception $e) {
    echo "❌ CONNECTION ERROR: " . $e->getMessage();
}
?>
