<?php
include("../include/function.php");

header('Content-Type: text/plain');

// Get a specific record
$view_id = isset($_GET['id']) ? $_GET['id'] : null;
if ($view_id) {
    $sql = "SELECT *, DATE_FORMAT(exp_date, '%Y-%m-%d') as exp_date_formatted 
            FROM company_tbl WHERE id = '$view_id'";
} else {
    $sql = "SELECT *, DATE_FORMAT(exp_date, '%Y-%m-%d') as exp_date_formatted 
            FROM company_tbl ORDER BY id DESC LIMIT 5";
}

$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Company ID: " . $row['id'] . "\n";
        echo "Company Name: " . $row['name'] . "\n";
        echo "Riyada Certificate: " . ($row['riyada_certificate'] ?? 'NULL') . "\n";
        echo "Expiry Date: " . ($row['exp_date_formatted'] ?? 'NULL') . "\n";
        echo "Created Date: " . ($row['created_date'] ?? 'NULL') . "\n";
        echo "Status: " . $row['status'] . "\n";
        echo "------------------------\n";
    }
} else {
    echo "Error: " . mysqli_error($conn) . "\n";
}

// Check table structure
echo "\nTable Structure:\n";
echo "----------------\n";
$structure = mysqli_query($conn, "SHOW COLUMNS FROM company_tbl WHERE Field IN ('riyada_certificate', 'exp_date')");
while ($row = mysqli_fetch_assoc($structure)) {
    echo "Field: " . $row['Field'] . "\n";
    echo "Type: " . $row['Type'] . "\n";
    echo "Null: " . $row['Null'] . "\n";
    echo "Default: " . $row['Default'] . "\n";
    echo "----------------\n";
}
?> 