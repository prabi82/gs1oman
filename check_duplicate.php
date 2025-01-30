<?php

include("admin/include/function.php");
// Handle AJAX request

$response = '';
function hasUniqueValues($array) {
    return count($array) === count(array_unique($array));
}
function getDuplicateValues($array) {
    // Count the values in the array
    $valueCounts = array_count_values($array);
    
    // Filter the values that occur more than once
    $duplicates = array_filter($valueCounts, function($count) {
        return $count > 1;
    });
    
    // Get the keys (original values) of the duplicates
    return array_keys($duplicates);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   // print_r("test");die;

    $email_ids     =   $_POST['email_id'];
    $phone_numbers =   $_POST['phone_number1'];

   

	$emailUnique   =   hasUniqueValues($email_ids);
	$phoneUnique   =   hasUniqueValues($phone_numbers);

    if( count($email_ids) > 0 &&  count($phone_numbers) > 0 ) {
        if($emailUnique==true && $phoneUnique==true && isset($email_ids) && !empty($email_ids) && isset($phone_numbers)  && !empty($phone_numbers)) {

            $duplicate_emails           =   array();
            $duplicate_phone_numbers    =   array();

            foreach ($email_ids as $email_id) {
                if (!empty($email_id)) {
                    $email_id       =   mysqli_real_escape_string($conn, $email_id);
                    $sql_email      =   "SELECT COUNT(*) AS email_count FROM company_contacts_tbl WHERE email_id = '$email_id'";
                    $email_result   =   mysqli_query($conn, $sql_email);

                    if (!$email_result) {
                        die('Error executing query: ' . mysqli_error($conn));
                    }
                    $row            =   mysqli_fetch_assoc($email_result);
                    $email_count    =   $row['email_count'];
                  
                    // if (!$query_email) {
                    //     die('Error: ' . mysqli_error($conn));
                    // }

                    // $rows_email = mysqli_num_rows($query_email);

                    
                    if ($email_count != 0) {
                        $duplicate_emails[] = $email_id;
                    }
                }
            }

           

            foreach ($phone_numbers as $phone_number) {
                if (!empty($phone_number)) {
                    $phone_number   =   mysqli_real_escape_string($conn, $phone_number);
                    $sql_phone      =   "SELECT COUNT(*) AS phone_number_count FROM company_contacts_tbl WHERE phone_number1 = '$phone_number'";
                    $phone_result   =   mysqli_query($conn, $sql_phone);

                    // if (!$query_phone) {
                    //     die('Error: ' . mysqli_error($conn));
                    // }

                    if (!$phone_result) {
                        die('Error executing query: ' . mysqli_error($conn));
                    }
                    $row                    =   mysqli_fetch_assoc($phone_result);
                    $phone_number_count     =   $row['phone_number_count'];
                    if ($phone_number_count != 0) {
                        $duplicate_phone_numbers[] = $phone_number;
                    }
                  

                    // $rows_phone = mysqli_num_rows($query_phone);
                    // if ($rows_phone != 0) {
                    //     $duplicate_phone_numbers[] = $phone_number;
                    // }
                }
            }

            if (!empty($duplicate_emails) && !empty($duplicate_phone_numbers)) {
        	
                $response = 'Emails ' . implode(', ', $duplicate_emails) . ' and phone numbers ' . implode(', ', $duplicate_phone_numbers) . '  already exist in the database.';
            } elseif (!empty($duplicate_emails)) {
               $response = 'Emails ' . implode(', ', $duplicate_emails) . '  already exist in the database.';
            } elseif (!empty($duplicate_phone_numbers)) {
                 $response = 'Phone numbers ' . implode(', ', $duplicate_phone_numbers) . '  already exist in the database.';
            }
    	
    	} else {

            $duplicateEmails            =   getDuplicateValues($email_ids);
            $filteredEmailArray         =   array_filter($duplicateEmails);
            $duplicateEmailsImploded    =   implode(',', $filteredEmailArray);
            $duplicatePhones            =   getDuplicateValues($phone_numbers);
            $filteredPhoneArray         =   array_filter($duplicatePhones);
            $duplicatePhonesImploded    =   implode(',', $filteredPhoneArray);
            $duplicateString            =   $seperator  =   '';

            if(!empty($duplicateEmailsImploded) || !empty($duplicatePhonesImploded)) {
                if(!empty($duplicateEmailsImploded) && !empty($duplicatePhonesImploded)) {
                    $seperator = ' , ';
                }
                $duplicateString = '( '.$duplicateEmailsImploded.$seperator.$duplicatePhonesImploded.' )';
            }

            $response = 'Please input unique email and phone numbers '.$duplicateString;
    	}
    }
	echo $response;
}
// function to check unique

?>
