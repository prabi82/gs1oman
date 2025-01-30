<?php
require_once('../includes/config.php');

$query = "SELECT id, name, riyada_certificate, exp_date FROM company_registration ORDER BY id DESC LIMIT 5";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "Recent Company Registrations:\n";
    echo "----------------------------\n";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row['id'] . "\n";
        echo "Company Name: " . $row['name'] . "\n";
        echo "Riyada Certificate: " . $row['riyada_certificate'] . "\n";
        echo "Expiry Date: " . $row['exp_date'] . "\n";
        echo "----------------------------\n";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}
?> 