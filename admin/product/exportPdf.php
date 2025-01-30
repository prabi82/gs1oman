<?php
include("../include/function.php");
require('vendor/autoload.php');
if($_SESSION['filter_status']!=''){
$res=mysqli_query($conn,"SELECT * from order_tbl WHERE status='".$_SESSION['filter_status']."' ORDER BY id ASC");
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
</style>
<div style="text-align:center; margin-bottom:25px;">
    <img src="logo.png" alt="freeCodeCamp" width="165" height="100"/>
</div>
<table class="table">';
		$html.='<tr>
	   <th>Order Number</th>
	   <th>Company Name</th>
       <th>Product Name</th>
       <th>Gtins Name</th>
       <th>Date of Purchase</th>
       <th>Registration Fee</th>
       <th>Gtins Annual Fee</th>
       <th>Gln Price</th>
       <th>Sscc Price</th>
       <th>Annual Subscription Fees</th>
       <th>Annul Total Price</th>
       <th>Prefix Number</th>
       <th>GLN Number</th>
       <th>Status</th>
		</tr>';
		while($row=mysqli_fetch_assoc($res)){
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
			$html.='<tr>
			<td>'.$row['order_id'].'</td>
			<td>'.$category_name['name'].'</td>
			<td>'.$fetch1['product_name'].'</td>
			<td>'.$fetch1['gtins_name'].'</td>
			<td>'.$row['order_date'].'</td>
			<td>'.$row['registration_fee'].'</td>
			<td>'.$row['gtins_annual_fee'].'</td>
			<td>'.$row['gln_price'].'</td>
			<td>'.$row['sscc_price'].'</td>
			<td>'.$row['annual_subscription_fee'].'</td>
			<td>'.$row['annual_total_price'].'</td>
			<td>'.$row['prefix_num'].'</td>
			<td>'.$row['gln_number'].'</td>
			<td>'.$show_status.'</td>
			</tr>';
		}
	$html.='</table>';
}else{
	$html="Data not found";
}
$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file='media/'.time().'.pdf';
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
    <img src="logo.png" alt="freeCodeCamp" width="165" height="100"/>
</div><table class="table">';
		$html.='<tr>
		<th>Order Number</th>
	   <th>Company Name</th>
       <th>Product Name</th>
       <th>Gtins Name</th>
       <th>Date of Purchase</th>
        <th>Registration Fee</th>
       <th>Gtins Annual Fee</th>
       <th>Gln Price</th>
       <th>Sscc Price</th>
       <th>Annual Subscription Fees</th>
       <th>Annul Total Price</th>
       <th>Prefix Number</th>
       <th>GLN Number</th>
       <th>Status</th>
		</tr>';
		while($row=mysqli_fetch_assoc($res)){
		    
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
			$html.='<tr>
			<td>'.$row['order_id'].'</td>
			<td>'.$category_name['name'].'</td>
			<td>'.$fetch1['product_name'].'</td>
			<td>'.$fetch1['gtins_name'].'</td>
			<td>'.$row['order_date'].'</td>
			<td>'.$row['registration_fee'].'</td>
			<td>'.$row['gtins_annual_fee'].'</td>
			<td>'.$row['gln_price'].'</td>
			<td>'.$row['sscc_price'].'</td>
			<td>'.$row['annual_subscription_fee'].'</td>
			<td>'.$row['annual_total_price'].'</td>
			<td>'.$row['prefix_num'].'</td>
			<td>'.$row['gln_number'].'</td>
			<td>'.$show_status.'</td>
			</tr>';
		}
	$html.='</table>';
}else{
	$html="Data not found";
}
$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file='media/'.time().'.pdf';
$mpdf->output($file,'I');
//D
//I
//F
//S
}



?>