<?php 
include("../include/function.php");
error_reporting(0);



     if($_SESSION['filter_status']!=''){
		
		$delimiter = ","; 
       $filename = "Financial-Report" . date('Y-m-d') . ".csv";
      
      // Create a file pointer 
      $f = fopen('php://memory', 'w'); 

   // Set column headers 
    $fields = array('Id', 'Type', 'Company', 'Product',  'Date of Purchase', 'Subscription Fees', 
          'Total'); 
    fputcsv($f, $fields, $delimiter);
			if($_SESSION['filter_status']==0){
				
			 $query = "SELECT * FROM `order_tbl` WHERE `order_date` >= DATE_FORMAT(CURRENT_DATE(), '%Y-%m-01')";
			
		} elseif($_SESSION['filter_status']==1){
			
			$current_year = date("Y");
			 $query = "SELECT * FROM `order_tbl` WHERE YEAR(`order_date`) = '$current_year'";
			
		} elseif ($_SESSION['filter_status']==2) {
			
			$previous_year = date("Y") - 1;
			$query = "SELECT * FROM `order_tbl` WHERE YEAR(`order_date`) = '$previous_year'";
			
		}elseif(($_SESSION['filter_status']=='sdate')){
					

			//echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#80bfff">'.$sdate1.' AND '.$sdate2.'</span>';
			
			//$query = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE  `order_date` BETWEEN '$sdate1' AND '$sdate2'") or die(mysqli_error());
			echo $query = "SELECT * FROM `order_tbl` WHERE  `order_date` BETWEEN '".$_SESSION['filter_sdate1']."' AND '".$_SESSION['filter_sdate2']."' ORDER BY id ASC";
			
		} else {
			$query = "SELECT * FROM `order_tbl`";
			
		}

		$result = mysqli_query($conn, $query);
		if (!$result) {
			die(mysqli_error($conn)); // Handle query execution errors
		}
			  

    // Output each row of the data, format line as csv and write to file pointer 
    		// Output each row of the data, format line as csv and write to file pointer 
			$counter=1;
		while ($row = mysqli_fetch_assoc($result)) {
			$category_name_query = mysqli_query($conn, "SELECT * FROM `company_tbl` WHERE id='" . $row['company_id'] . "'");
			$category_name_row = mysqli_fetch_array($category_name_query);
			$category_name = isset($category_name_row['name']) ? $category_name_row['name'] : '---';

			// Determine payment type
			$type = strpos($row['payment_data'], 'offline') !== false ? 'Cash' : 'Card';

			// Construct product list
			$products = array();

			if (isset($row['gtins_annual_fee']) && !empty($row['gtins_annual_fee'])) {
				$products[] = 'GTIN: ' . $row['gtins_annual_fee'];
			}

			if (isset($row['gln_price']) && !empty($row['gln_price'])) {
				$products[] = 'GLN: ' . $row['gln_price'];
			}

			if (isset($row['sscc_price']) && !empty($row['sscc_price'])) {
				$products[] = 'SSCC: ' . $row['sscc_price'];
			}

			// Format product list
			$productString = !empty($products) ? implode(', ', $products) : 'No Product Selected';
			$gtins_annual_fee=array();
			if(isset($row['gtins_annual_fee']) && !empty($row['gtins_annual_fee'])){
				$gtins_annual_fee[]= $row['gtins_annual_fee'];
			}else{
				$gtins_annual_fee[]='0';
			}
			$gtins_annual_fee = !empty($gtins_annual_fee) ? implode(', ', $gtins_annual_fee) : '0';
			// Use $annualfee directly without isset() check as you've already initialized it
			$lineData = array(
				$counter++,
				$type,
				$category_name,
				$productString,
				$row['order_date'],
				$row['annual_subscription_fee'],
				//$gtins_annual_fee, // Use $row['gtins_annual_fee'] directly here
				$row['annual_total_price']
			);

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
       $filename = "Financial-Report" . date('Y-m-d') . ".csv";
      
      // Create a file pointer 
      $f = fopen('php://memory', 'w'); 

    // Set column headers 
  $fields = array('Id', 'Type', 'Company', 'Product',  'Date of Purchase', 'Subscription Fees', 
         'Total'); 
    fputcsv($f, $fields, $delimiter);


$query = "SELECT * from order_tbl   ORDER BY id ASC";  
      $result = mysqli_query($conn, $query);
	  $counter=1;
				// Output each row of the data, format line as csv and write to file pointer 
		while ($row = mysqli_fetch_assoc($result)) {
			$category_name_query = mysqli_query($conn, "SELECT * FROM `company_tbl` WHERE id='" . $row['company_id'] . "'");
			$category_name_row = mysqli_fetch_array($category_name_query);
			$category_name = isset($category_name_row['name']) ? $category_name_row['name'] : '---';

			// Determine payment type
			$type = strpos($row['payment_data'], 'offline') !== false ? 'Cash' : 'Card';

			// Construct product list
			$products = array();

			if (isset($row['gtins_annual_fee']) && !empty($row['gtins_annual_fee'])) {
				$products[] = 'GTIN: ' . $row['gtins_annual_fee'];
			}

			if (isset($row['gln_price']) && !empty($row['gln_price'])) {
				$products[] = 'GLN: ' . $row['gln_price'];
			}

			if (isset($row['sscc_price']) && !empty($row['sscc_price'])) {
				$products[] = 'SSCC: ' . $row['sscc_price'];
			}

			// Format product list
			$productString = !empty($products) ? implode(', ', $products) : 'No Product Selected';
			$gtins_annual_fee=array();
			if(isset($row['gtins_annual_fee']) && !empty($row['gtins_annual_fee'])){
				$gtins_annual_fee[]= $row['gtins_annual_fee'];
			}else{
				$gtins_annual_fee[]='0';
			}
			$gtins_annual_fee = !empty($gtins_annual_fee) ? implode(', ', $gtins_annual_fee) : '0';
			// Use $annualfee directly without isset() check as you've already initialized it
			$lineData = array(
				$counter++,
				$type,
				$category_name,
				$productString,
				$row['order_date'],
				$row['annual_subscription_fee'],
				//$gtins_annual_fee, // Use $row['gtins_annual_fee'] directly here
				$row['annual_total_price']
			);

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