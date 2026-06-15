<?php
echo "Setting up database...\n";

$host = 'localhost';
$user = 'root';
$pass = '';

try {
    // Connect to MySQL server
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS instagrocery_db");
    echo "✅ Database 'instagrocery_db' created successfully!\n";
    
    // Use the database
    $pdo->exec("USE instagrocery_db");
    
    // Read and execute SQL file
    $sql = file_get_contents('instagrocery_db.sql');
    if ($sql) {
        $pdo->exec($sql);
        echo "✅ Database tables and data imported successfully!\n";
        echo "🎉 Setup complete! You can now run the application.\n";
    } else {
        echo "❌ Could not read SQL file.\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Setup failed: " . $e->getMessage() . "\n";
}
?>
