<?php
require_once '../includes/DatabaseConnection.php';

try {
    // Kiểm tra table comments có tồn tại không
    $stmt = $pdo->query("SHOW TABLES LIKE 'comments'");
    $table_exists = $stmt->rowCount() > 0;
    
    if ($table_exists) {
        echo "✅ Table 'comments' exists!<br>";
        
        // Kiểm tra structure của table
        $stmt = $pdo->query("DESCRIBE comments");
        $columns = $stmt->fetchAll();
        
        echo "<h3>Table structure:</h3>";
        foreach ($columns as $column) {
            echo "- " . $column['Field'] . " (" . $column['Type'] . ")<br>";
        }
    } else {
        echo "❌ Table 'comments' does not exist!<br>";
        echo "Please create the table first.";
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>