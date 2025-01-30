<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'gs1_oman';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header('Content-Type: text/plain');

$query = "
    SELECT id, name, name_ar, riyada_certificate, exp_date, created_date, status,
           pobox, zipcode, address, city, country,
           mobile_number, phone_number, fax_number, user_email,
           cr_number, cr_legal_type, number_of_employee
    FROM company_registration 
    ORDER BY id DESC 
    LIMIT 5
";

$result = $conn->query($query);

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Registration ID: " . $row['id'] . "\n";
            echo "Company Details:\n";
            echo "----------------\n";
            echo "Name (English): " . $row['name'] . "\n";
            echo "Name (Arabic): " . $row['name_ar'] . "\n";
            echo "PO Box: " . $row['pobox'] . "\n";
            echo "Zip Code: " . $row['zipcode'] . "\n";
            echo "Address: " . $row['address'] . "\n";
            echo "City: " . $row['city'] . "\n";
            echo "Country: " . $row['country'] . "\n";
            
            echo "\nContact Information:\n";
            echo "-------------------\n";
            echo "Mobile: " . $row['mobile_number'] . "\n";
            echo "Phone: " . $row['phone_number'] . "\n";
            echo "Fax: " . $row['fax_number'] . "\n";
            echo "Email: " . $row['user_email'] . "\n";
            
            echo "\nBusiness Information:\n";
            echo "--------------------\n";
            echo "CR Number: " . $row['cr_number'] . "\n";
            echo "Legal Type: " . $row['cr_legal_type'] . "\n";
            echo "Number of Employees: " . $row['number_of_employee'] . "\n";
            echo "Riyada Certificate: " . $row['riyada_certificate'] . "\n";
            if ($row['riyada_certificate'] == 'Yes') {
                echo "Riyada Expiry Date: " . $row['exp_date'] . "\n";
            }
            
            echo "\nRegistration Status:\n";
            echo "-------------------\n";
            echo "Created Date: " . $row['created_date'] . "\n";
            echo "Status: " . $row['status'] . "\n";
            
            echo "\n=============================\n\n";
        }
    } else {
        echo "No records found.\n";
    }
} else {
    echo "Error: " . $conn->error . "\n";
}

$conn->close();
?> 