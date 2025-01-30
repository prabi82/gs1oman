<?php 
include("../include/function.php");
error_reporting(0);
 
    


     if($_SESSION['filter_status']!=''){

$delimiter = ","; 
       $filename = "members-data_" . date('Y-m-d') . ".csv";
      
      // Create a file pointer 
      $f = fopen('php://memory', 'w'); 

    // Set column headers 
    $fields = array('order_id', 'prefix_num', 'gln_number', 'user_email', 'registration_fee', 'gtins_annual_fee', 'order_date'); 
    fputcsv($f, $fields, $delimiter);


$query = "SELECT * from order_tbl WHERE `status`='".$_SESSION['filter_status']."'  ORDER BY id ASC";  
      $result = mysqli_query($conn, $query);

    // Output each row of the data, format line as csv and write to file pointer 
    while($row = mysqli_fetch_assoc($result)){  
         $lineData = array($row['order_id'], $row['prefix_num'], $row['gln_number'], $row['user_email'], $row['registration_fee'], $row['gtins_annual_fee'], $row['order_date']); 
        fputcsv($f, $lineData, $delimiter); 
    } 

    // Move back to beginning of file 
    fseek($f, 0); 

     // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 

     //output all remaining data on a file pointer 
    fpassthru($f); 


}

else{

       $delimiter = ","; 
       $filename = "members-data_" . date('Y-m-d') . ".csv";
      
      // Create a file pointer 
      $f = fopen('php://memory', 'w'); 

    // Set column headers 
    $fields = array('order_id', 'prefix_num', 'gln_number', 'user_email', 'registration_fee', 'gtins_annual_fee', 'order_date'); 
    fputcsv($f, $fields, $delimiter);


$query = "SELECT * from order_tbl   ORDER BY id ASC";  
      $result = mysqli_query($conn, $query);

    // Output each row of the data, format line as csv and write to file pointer 
    while($row = mysqli_fetch_assoc($result)){  
         $lineData = array($row['order_id'], $row['prefix_num'], $row['gln_number'], $row['user_email'], $row['registration_fee'], $row['gtins_annual_fee'], $row['order_date']); 
        fputcsv($f, $lineData, $delimiter); 
    } 

    // Move back to beginning of file 
    fseek($f, 0); 

     // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 

     //output all remaining data on a file pointer 
    fpassthru($f); 

}



        




?>