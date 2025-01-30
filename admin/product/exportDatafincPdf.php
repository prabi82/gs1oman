<?php

include("../include/function.php");
require('vendor/autoload.php');
if($_SESSION['filter_status']!=''){
		if($_SESSION['filter_status']==0){
				
			 $query = "SELECT * FROM `order_tbl` WHERE `order_date` >= DATE_FORMAT(CURRENT_DATE(), '%Y-%m-01')";
			
		} elseif($_SESSION['filter_status']==1){
			
			$current_year = date("Y");
			 $query = "SELECT * FROM `order_tbl` WHERE YEAR(`order_date`) = '$current_year'";
			
		} elseif ($_SESSION['filter_status']==2) {
			
			$previous_year = date("Y") - 1;
			$query = "SELECT * FROM `order_tbl` WHERE YEAR(`order_date`) = '$previous_year'";
			
		}elseif(($_SESSION['filter_status']=='sdate')){
			echo $query = "SELECT * FROM `order_tbl` WHERE  `order_date` BETWEEN '".$_SESSION['filter_sdate1']."' AND '".$_SESSION['filter_sdate2']."' ORDER BY id ASC";
			
		}  else {
			$query = "SELECT * FROM `order_tbl`";
			
		}

		$result = mysqli_query($conn, $query);
		if (!$result) {
			die(mysqli_error($conn)); // Handle query execution errors
		}
if(mysqli_num_rows($result)>0){
	$html='<style>table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<div style="text-align:center; margin-bottom:25px;">
    <img src="logo.png" alt="freeCodeCamp" width="140" height="100"/>
</div>
<table class="table">';
		$html.='<tr>
			<th>Id</th>
			<th>Type</th>
			<th>Company</th>
			<th>Product</th>
			<th>Date of Purchase</th>
			<th>Subscription Fees</th>
			
			<th>Total</th>
		</tr>';
		//$query = "SELECT * from order_tbl   ORDER BY id ASC";  
      //$result = mysqli_query($conn, $query);
	  $counter=1;
		while($row=mysqli_fetch_assoc($result)){
			//$category_name=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `company_tbl` WHERE id='".$row['company_id']."'"));
			$category_name_query = mysqli_query($conn, "SELECT * FROM `company_tbl` WHERE id='" . $row['company_id'] . "'");
			$category_name_row = mysqli_fetch_array($category_name_query);
			$category_name = isset($category_name_row['name']) ? $category_name_row['name'] : '---';
             $query1=mysqli_query($conn, "SELECT * FROM `product_tbl`") or die(mysqli_error());
			$fetch1=mysqli_fetch_array($query1);
			

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
			$html.='<tr>
				<td>'.$counter++.'</td>,
				<td>'.$type.'</td>
				<td>'.$category_name.'</td>
				<td>'.$productString.'</td>
				<td>'.$row['order_date'].'</td>
				<td>'.$row['annual_subscription_fee'].'</td>
				
				<td>'.$row['annual_total_price'].'</td>
			</tr>';
		
		}
	$html.='</table>';
}else{
	$html="Data not found";
}
$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file='Financial Report/'.time().'.pdf';
$mpdf->output($file,'I');
//D
//I
//F
//S

}


else{
	$res=mysqli_query($conn,"SELECT * from order_tbl  ORDER BY id ASC");
if(mysqli_num_rows($res)>0){
	$html='<style>table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style><div style="text-align: center; margin-bottom:25px">
    <img src="logo.png" alt="freeCodeCamp" width="140" height="100"/>
</div><table class="table">';
		$html.='<tr>
			<th>Id</th>
			<th>Type</th>
			<th>Company</th>
			<th>Product</th>
			<th>Date of Purchase</th>
			<th>Subscription Fees</th>
			
			<th>Total</th>
		</tr>';
		$query = "SELECT * from order_tbl   ORDER BY id ASC";  
      $result = mysqli_query($conn, $query);
	  $counter=1;
		while($row=mysqli_fetch_assoc($result)){
			//$category_name=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `company_tbl` WHERE id='".$row['company_id']."'"));
			$category_name_query = mysqli_query($conn, "SELECT * FROM `company_tbl` WHERE id='" . $row['company_id'] . "'");
			$category_name_row = mysqli_fetch_array($category_name_query);
			$category_name = isset($category_name_row['name']) ? $category_name_row['name'] : '---';
             $query1=mysqli_query($conn, "SELECT * FROM `product_tbl`") or die(mysqli_error());
			$fetch1=mysqli_fetch_array($query1);
			

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
			$html.='<tr>
				<td>'.$counter++.'</td>,
				<td>'.$type.'</td>
				<td>'.$category_name.'</td>
				<td>'.$productString.'</td>
				<td>'.$row['order_date'].'</td>
				<td>'.$row['annual_subscription_fee'].'</td>
			
				<td>'.$row['annual_total_price'].'</td>
			</tr>';
		}
	$html.='</table>';
}else{
	$html="Data not found";
}
$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file='Financial Report/'.time().'.pdf';
$mpdf->output($file,'I');
//D
//I
//F
//S
}



?>