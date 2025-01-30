<?php
// Include database connection
require_once('../include/config.php');

// Test database connection
function testDatabaseConnection($conn) {
    if ($conn) {
        echo "✓ Database connection successful\n";
        return true;
    } else {
        echo "✗ Database connection failed: " . mysqli_connect_error() . "\n";
        return false;
    }
}

// Test company data retrieval
function testCompanyDataRetrieval($conn) {
    $test_id = 69; // Using the view_id from your URL
    $query = "SELECT * FROM company_tbl WHERE id = '$test_id'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $company = mysqli_fetch_assoc($result);
        echo "✓ Company data retrieval successful\n";
        echo "Company Name: " . $company['name'] . "\n";
        echo "Mobile Number: " . $company['mobile_number'] . "\n";
        echo "Phone Number: " . $company['phone_number'] . "\n";
        return true;
    } else {
        echo "✗ Company data retrieval failed: " . mysqli_error($conn) . "\n";
        return false;
    }
}

// Test company contacts retrieval
function testCompanyContactsRetrieval($conn) {
    $test_id = 69; // Using the view_id from your URL
    $query = "SELECT * FROM company_contacts_tbl WHERE company_id = '$test_id'";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $contact_count = mysqli_num_rows($result);
        echo "✓ Company contacts retrieval successful\n";
        echo "Number of contacts found: " . $contact_count . "\n";
        return true;
    } else {
        echo "✗ Company contacts retrieval failed: " . mysqli_error($conn) . "\n";
        return false;
    }
}

// Run tests
echo "Starting tests...\n\n";

$db_test = testDatabaseConnection($conn);
if ($db_test) {
    testCompanyDataRetrieval($conn);
    testCompanyContactsRetrieval($conn);
}

echo "\nTests completed.\n";
?> 