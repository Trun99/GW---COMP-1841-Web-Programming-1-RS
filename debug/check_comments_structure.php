<?php
require_once '../includes/DatabaseConnection.php';

try {
    echo "<h3>Checking comments table...</h3>";
    
    $stmt = $pdo->query("SHOW TABLES LIKE 'comments'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Table 'comments' exists<br><br>";
        
        echo "<h4>Current structure:</h4>";
        $stmt = $pdo->query("DESCRIBE comments");
        $columns = $stmt->fetchAll();
        
        foreach ($columns as $column) {
            echo "- " . $column['Field'] . " (" . $column['Type'] . ")<br>";
        }
        
        echo "<br><h4>Sample data:</h4>";
        $stmt = $pdo->query("SELECT * FROM comments LIMIT 3");
        $data = $stmt->fetchAll();
        
        if (empty($data)) {
            echo "No data in table<br>";
        } else {
            foreach ($data as $row) {
                echo "ID: " . $row['id'] . " | ";
                foreach ($row as $key => $value) {
                    echo $key . ": " . $value . " | ";
                }
                echo "<br>";
            }
        }
        
    } else {
        echo "❌ Table 'comments' does not exist<br>";
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>