<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'gs1_oman';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    header('Content-Type: text/plain');
    
    // Get the most recent registrations with all details
    echo "Recent Registration Details:\n";
    echo "==========================\n\n";
    
    $stmt = $pdo->query("
        SELECT *
        FROM company_registration 
        ORDER BY id DESC 
        LIMIT 5
    ");
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Registration ID: {$row['id']}\n";
        echo "Company Details:\n";
        echo "----------------\n";
        echo "Name (English): {$row['name']}\n";
        echo "Name (Arabic): {$row['name_ar']}\n";
        echo "PO Box: {$row['pobox']}\n";
        echo "Zip Code: {$row['zipcode']}\n";
        echo "Address: {$row['address']}\n";
        echo "City: {$row['city']}\n";
        echo "Country: {$row['country']}\n";
        
        echo "\nContact Information:\n";
        echo "-------------------\n";
        echo "Mobile: {$row['mobile_number']}\n";
        echo "Phone: {$row['phone_number']}\n";
        echo "Fax: {$row['fax_number']}\n";
        echo "Email: {$row['user_email']}\n";
        
        echo "\nBusiness Information:\n";
        echo "--------------------\n";
        echo "CR Number: {$row['cr_number']}\n";
        echo "Legal Type: {$row['cr_legal_type']}\n";
        echo "Number of Employees: {$row['number_of_employee']}\n";
        echo "Riyada Certificate: {$row['riyada_certificate']}\n";
        if ($row['riyada_certificate'] == 'Yes') {
            echo "Riyada Expiry Date: {$row['exp_date']}\n";
        }
        
        echo "\nRegistration Status:\n";
        echo "-------------------\n";
        echo "Created Date: {$row['created_date']}\n";
        echo "Status: {$row['status']}\n";
        
        echo "\n=============================\n\n";
    }
    
} catch (PDOException $e) {
    header('Content-Type: text/plain');
    echo "Database Error: " . $e->getMessage() . "\n";
}
?> 