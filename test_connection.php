<?php
echo "Testing database connection...\n";

$host = 'localhost';
$db = 'instagrocery_db';
$user = 'root';
$pass = '';

try {
    // Test basic MySQL connection first
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ MySQL connection successful!\n";
    
    // Check if database exists
    $stmt = $pdo->query("SHOW DATABASES LIKE '$db'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Database '$db' exists!\n";
        
        // Try connecting to the specific database
        $pdo_db = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "✅ Connection to '$db' successful!\n";
        
        // Check tables
        $stmt = $pdo_db->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        echo "📋 Tables found: " . implode(", ", $tables) . "\n";
        
    } else {
        echo "❌ Database '$db' does not exist!\n";
        echo "💡 You need to create the database and import the SQL file.\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "\n";
    
    // Additional debugging info
    echo "\n🔍 Debug Info:\n";
    echo "Host: $host\n";
    echo "Database: $db\n";
    echo "Username: $user\n";
    echo "Password: " . (empty($pass) ? "(empty)" : "(set)") . "\n";
}
?>
