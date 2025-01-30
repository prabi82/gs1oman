<?php 
include("../include/function.php");
error_reporting(0);
 
    


     if($_SESSION['filter_status']!=''){

$delimiter = ","; 
       $filename = "user-product_" . date('Y-m-d') . ".csv";
      
      // Create a file pointer 
      $f = fopen('php://memory', 'w'); 

    // Set column headers 
    $fields = array('Order Number', 'Company Name', 'Product Name', 'Gtins Name',  'Date of Purchase', 
        'Registration Fee',  'Gtins Annual Fee',  'Gln Price',  'Sscc Price',  'Annual Subscription Fees', 
        'Annul Total Price','Prefix Number','GLN Number','Status'); 
    fputcsv($f, $fields, $delimiter);


$query = "SELECT * from order_tbl WHERE `status`='".$_SESSION['filter_status']."'  ORDER BY id ASC";  
      $result = mysqli_query($conn, $query);

    // Output each row of the data, format line as csv and write to file pointer 
    while($row = mysqli_fetch_assoc($result)){ 
    $category_name=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `company_tbl` WHERE id='".$row['company_id']."'"));
             $query1=mysqli_query($conn, "SELECT * FROM `product_tbl`") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            if(($row['status']==0)){
            $lineData = array($row['order_id'], $category_name['name'], $fetch1['product_name'], $fetch1['gtins_name'], $row['order_date'], $row['registration_fee'], $row['gtins_annual_fee'], $row['gln_price'], $row['sscc_price'], $row['annual_subscription_fee'], $row['annual_total_price'],$row['prefix_num'],$row['gln_number'],'Pending'); 
            }

            if(($row['status']==1)){
            $lineData = array($row['order_id'], $category_name['name'], $fetch1['product_name'], $fetch1['gtins_name'], $row['order_date'], $row['registration_fee'], $row['gtins_annual_fee'], $row['gln_price'], $row['sscc_price'], $row['annual_subscription_fee'], $row['annual_total_price'],$row['prefix_num'],$row['gln_number'],'Approved'); 
            }

              if(($row['status']==2)){
            $lineData = array($row['order_id'], $category_name['name'], $fetch1['product_name'], $fetch1['gtins_name'], $row['order_date'], $row['registration_fee'], $row['gtins_annual_fee'], $row['gln_price'], $row['sscc_price'], $row['annual_subscription_fee'], $row['annual_total_price'],$row['prefix_num'],$row['gln_number'],'Rejected'); 
            }

            if(($row['status']==3)){
            $lineData = array($row['order_id'], $category_name['name'], $fetch1['product_name'], $fetch1['gtins_name'], $row['order_date'], $row['registration_fee'], $row['gtins_annual_fee'], $row['gln_price'], $row['sscc_price'], $row['annual_subscription_fee'], $row['annual_total_price'],$row['prefix_num'],$row['gln_number'],'Disabled'); 
            }


         


        fputcsv($f, $lineData, $delimiter); 
    } 

    // Move back to beginning of file 
    fseek($f, 0); 

     // Set headers to download file rather than displayed 
       header("content-type:application/csv;charset=UTF-8");
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 

     //output all remaining data on a file pointer 
    fpassthru($f); 


}

else{

       $delimiter = ","; 
       $filename = "user-product_" . date('Y-m-d') . ".csv";
      
      // Create a file pointer 
      $f = fopen('php://memory', 'w'); 

    // Set column headers 
  $fields = array('Order Number', 'Company Name', 'Product Name', 'Gtins Name',  'Date of Purchase', 
        'Registration Fee',  'Gtins Annual Fee',  'Gln Price',  'Sscc Price',  'Annual Subscription Fees', 
        'Annul Total Price','Prefix Number','GLN Number','Status'); 
    fputcsv($f, $fields, $delimiter);


$query = "SELECT * from order_tbl   ORDER BY id ASC";  
      $result = mysqli_query($conn, $query);

    // Output each row of the data, format line as csv and write to file pointer 
    while($row = mysqli_fetch_assoc($result)){ 
        
        
          if($row['status']=='1'){
            $show_status='Approved';
        }
        elseif($row['status']=='2'){
           $show_status='Rejected'; 
        }
        elseif($row['status']=='3'){
         $show_status='Disabled'; 
         }
         elseif($row['status']=='0'){
         $show_status='Pending Approval'; 
         }
        
        
          $category_name=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `company_tbl` WHERE id='".$row['company_id']."'"));
             $query1=mysqli_query($conn, "SELECT * FROM `product_tbl`") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);


           
        $lineData = array($row['order_id'], $category_name['name'], $fetch1['product_name'], $fetch1['gtins_name'], $row['order_date'], $row['registration_fee'], $row['gtins_annual_fee'], $row['gln_price'], $row['sscc_price'], $row['annual_subscription_fee'], $row['annual_total_price'],$row['prefix_num'],$row['gln_number'], $show_status); 
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