<?php
include("admin/include/config.php");

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Query to get the most recent entries
$sql = "SELECT * FROM company_tbl ORDER BY id DESC LIMIT 5";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

echo "<h2>Last 5 Company Submissions:</h2>";
echo "<pre>";
while ($row = mysqli_fetch_assoc($result)) {
    print_r($row);
    echo "\n----------------------------------------\n";
}
echo "</pre>";
?> 