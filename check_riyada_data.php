<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'gs1omancom_barcode';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    header('Content-Type: text/plain');
    
    echo "Checking Riyada Certificate Data:\n";
    echo "================================\n\n";
    
    // Check company_tbl structure
    echo "Table Structure (company_tbl):\n";
    echo "-------------------------\n";
    $stmt = $pdo->query("SHOW COLUMNS FROM company_tbl WHERE Field IN ('riyada_certificate', 'exp_date', 'documents_req')");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Field: {$row['Field']}\n";
        echo "Type: {$row['Type']}\n";
        echo "Null: {$row['Null']}\n";
        echo "Default: {$row['Default']}\n";
        echo "-------------------------\n";
    }
    
    // Check recent registrations
    echo "\nRecent Registrations:\n";
    echo "-------------------\n";
    $stmt = $pdo->query("
        SELECT id, name, riyada_certificate, exp_date, documents_req 
        FROM company_tbl 
        ORDER BY id DESC 
        LIMIT 5
    ");
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: {$row['id']}\n";
        echo "Company: {$row['name']}\n";
        echo "Riyada Certificate: " . ($row['riyada_certificate'] ?? 'NULL') . "\n";
        echo "Expiry Date: " . ($row['exp_date'] ?? 'NULL') . "\n";
        echo "Documents: " . ($row['documents_req'] ?? 'NULL') . "\n";
        echo "-------------------\n";
    }
    
} catch (PDOException $e) {
    header('Content-Type: text/plain');
    echo "Database Error: " . $e->getMessage() . "\n";
}
?> 