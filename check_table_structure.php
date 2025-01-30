<?php
include("admin/include/function.php");

// Check table structure
$result = mysqli_query($conn, "SHOW COLUMNS FROM company_tbl");
echo "Table Structure:\n";
echo "---------------\n";
while ($row = mysqli_fetch_assoc($result)) {
    echo "Field: " . $row['Field'] . "\n";
    echo "Type: " . $row['Type'] . "\n";
    echo "Null: " . $row['Null'] . "\n";
    echo "-----------------\n";
}

// Check recent entries
$result = mysqli_query($conn, "SELECT id, name, business_type_product_category FROM company_tbl ORDER BY id DESC LIMIT 5");
echo "\nRecent Entries:\n";
echo "---------------\n";
while ($row = mysqli_fetch_assoc($result)) {
    echo "ID: " . $row['id'] . "\n";
    echo "Name: " . $row['name'] . "\n";
    echo "Product Category: " . ($row['business_type_product_category'] ?? 'NULL') . "\n";
    echo "-----------------\n";
}
?> 