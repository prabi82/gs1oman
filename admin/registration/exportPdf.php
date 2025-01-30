<?php
include("../include/function.php");
require('vendor/autoload.php');
if(($_SESSION['filter_status']!='') && ($_SESSION['filter_sdate1']=='') && ($_SESSION['filter_sdate2']=='')){
$res=mysqli_query($conn,"SELECT * from company_tbl WHERE status='".$_SESSION['filter_status']."' ORDER BY id ASC");
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
    <img src="logo.png" alt="freeCodeCamp" width="160" height="100"/>
</div>
<table class="table">';
		$html.='<tr>
		  <th>Company Name English</th>
		  <th>City</th>
		  <th>Company Name Arabic</th>
	    <th>Country</th>
	    <th>PO Box</th>
      <th>Mobile Number</th>
      <th>Zip/Postal Code</th>
      <th>Phone Number</th>
      <th>Address English</th>
      <th>Fax Number</th>
      <th>Address Arabic</th>
      <th>Website Address</th>
      <th>Company Registration No</th>
      <th>User Name</th>
      <th>Legal Type</th>
      <th>CR Registration Date</th>
      <th>Main Product Category</th>
      <th>CR Expiry Date</th>
      <th>Text of Employees</th>
      <th>Tax Registration text</th>
      <th>1 Person Title *</th>
      <th>1 Person First Name</th>
      <th>1 Person Last Name</th>
      <th>1 Person Job Title</th>
      <th>1 Person Email Id</th>
      <th>1 Person Phone Number</th>
      <th>2 Person Title *</th>
      <th>2 Person First Name</th>
      <th>2 Person Last Name</th>
      <th>2 Person Job Title</th>
      <th>2 Person Email Id</th>
      <th>2 Person Phone Number</th>
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


			$query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);
			$html.='<tr>
			<td>'.$row['name'].'</td>
			<td>'.$row['city'].'</td>
			<td>'.$$row['name_ar'].'</td>
			<td>'.$row['name_ar'].'</td>
			<td>'.$row['country'].'</td>
			<td>'.$row['pobox'].'</td>
			<td>'.$row['mobile_number'].'</td>
			<td>'.$row['zipcode'].'</td>
			<td>'.$row['phone_number'].'</td>
			<td>'.$row['address'].'</td>
			<td>'.$row['fax_number'].'</td>
			<td>'.$row['address_ar'].'</td>
			<td>'.$row['website_address'].'</td>
			<td>'.$row['cr_number'].'</td>
			<td>'.$row['user_email'].'</td>
			<td>'.$row['cr_legal_type'].'</td>
			<td>'.$row['cr_registration_date'].'</td>
			<td>'.$row['business_type_product_category'].'</td>
			<td>'.$row['cr_expiry_date'].'</td>
			<td>'.$row['cr_tax_registration_number'].'</td>
			<td>'.$fetch1['title'].'</td>
			<td>'.$fetch1['first_name'].'</td>
			<td>'.$fetch1['last_name'].'</td>
			<td>'.$fetch1['job_title'].'</td>
			<td>'.$fetch1['email_id'].'</td>
			<td>'.$fetch1['phone_number1'].'</td>
			<td>'.$fetch2['title'].'</td>
			<td>'.$fetch2['first_name'].'</td>
			<td>'.$fetch2['last_name'].'</td>
			<td>'.$fetch2['job_title'].'</td>
			<td>'.$fetch2['email_id'].'</td>
			<td>'.$fetch2['phone_number1'].'</td>
			<td>'.$show_status.'</td>
			</tr>';
		}
	$html.='</table>';
}else{
	$html="Data not found";
}
$mpdf=new \Mpdf\Mpdf([['orientation' => 'L'], 'format' => 'A4-L']);
#$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file='media/'.time().'.pdf';
$mpdf->output($file,'I');
//D
//I
//F
//S

}



elseif(($_SESSION['filter_status']=='') && ($_SESSION['filter_sdate1']!='') && ($_SESSION['filter_sdate2']!='')){
$res=mysqli_query($conn,"SELECT * FROM `company_tbl` WHERE `record_date` BETWEEN '".$_SESSION['filter_sdate1']."' AND '".$_SESSION['filter_sdate2']."'  ORDER BY id ASC");
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
  font-size:100px;
}


tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<div style="text-align:center; margin-bottom:25px;">
    <img src="logo.png" alt="freeCodeCamp" width="160" height="100"/>
</div>
<table class="table">';
		$html.='<tr>
		  <th>Company Name English</th>
		  <th>City</th>
		  <th>Company Name Arabic</th>
	    <th>Country</th>
	    <th>PO Box</th>
      <th>Mobile Number</th>
      <th>Zip/Postal Code</th>
      <th>Phone Number</th>
      <th>Address English</th>
      <th>Fax Number</th>
      <th>Address Arabic</th>
      <th>Website Address</th>
      <th>Company Registration No</th>
      <th>User Name</th>
      <th>Legal Type</th>
      <th>CR Registration Date</th>
      <th>Main Product Category</th>
      <th>CR Expiry Date</th>
      <th>Text of Employees</th>
      <th>Tax Registration text</th>
      <th>1 Person Title *</th>
      <th>1 Person First Name</th>
      <th>1 Person Last Name</th>
      <th>1 Person Job Title</th>
      <th>1 Person Email Id</th>
      <th>1 Person Phone Number</th>
      <th>2 Person Title *</th>
      <th>2 Person First Name</th>
      <th>2 Person Last Name</th>
      <th>2 Person Job Title</th>
      <th>2 Person Email Id</th>
      <th>2 Person Phone Number</th>
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


			$query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);
			$html.='<tr>
			<td>'.$row['name'].'</td>
			<td>'.$row['city'].'</td>
			<td>'.$$row['name_ar'].'</td>
			<td>'.$row['name_ar'].'</td>
			<td>'.$row['country'].'</td>
			<td>'.$row['pobox'].'</td>
			<td>'.$row['mobile_number'].'</td>
			<td>'.$row['zipcode'].'</td>
			<td>'.$row['phone_number'].'</td>
			<td>'.$row['address'].'</td>
			<td>'.$row['fax_number'].'</td>
			<td>'.$row['address_ar'].'</td>
			<td>'.$row['website_address'].'</td>
			<td>'.$row['cr_number'].'</td>
			<td>'.$row['user_email'].'</td>
			<td>'.$row['cr_legal_type'].'</td>
			<td>'.$row['cr_registration_date'].'</td>
			<td>'.$row['business_type_product_category'].'</td>
			<td>'.$row['cr_expiry_date'].'</td>
			<td>'.$row['cr_tax_registration_number'].'</td>
			<td>'.$fetch1['title'].'</td>
			<td>'.$fetch1['first_name'].'</td>
			<td>'.$fetch1['last_name'].'</td>
			<td>'.$fetch1['job_title'].'</td>
			<td>'.$fetch1['email_id'].'</td>
			<td>'.$fetch1['phone_number1'].'</td>
			<td>'.$fetch2['title'].'</td>
			<td>'.$fetch2['first_name'].'</td>
			<td>'.$fetch2['last_name'].'</td>
			<td>'.$fetch2['job_title'].'</td>
			<td>'.$fetch2['email_id'].'</td>
			<td>'.$fetch2['phone_number1'].'</td>
			<td>'.$show_status.'</td>
			</tr>';
		}
	$html.='</table>';
}else{
	$html="Data not found";
}
$mpdf=new \Mpdf\Mpdf([['orientation' => 'L'], 'format' => 'A4-L']);
#$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file='media/'.time().'.pdf';
$mpdf->output($file,'I');
//D
//I
//F
//S

}




elseif(($_SESSION['filter_rfilter']=='All')){
$res=mysqli_query($conn,"SELECT * FROM `company_tbl` ORDER BY id ASC");
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
  font-size:100px;
}


tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<div style="text-align:center; margin-bottom:25px;">
    <img src="logo.png" alt="freeCodeCamp" width="160" height="100"/>
</div>
<table class="table">';
		$html.='<tr>
		  <th>Company Name English</th>
		  <th>City</th>
		  <th>Company Name Arabic</th>
	    <th>Country</th>
	    <th>PO Box</th>
      <th>Mobile Number</th>
      <th>Zip/Postal Code</th>
      <th>Phone Number</th>
      <th>Address English</th>
      <th>Fax Number</th>
      <th>Address Arabic</th>
      <th>Website Address</th>
      <th>Company Registration No</th>
      <th>User Name</th>
      <th>Legal Type</th>
      <th>CR Registration Date</th>
      <th>Main Product Category</th>
      <th>CR Expiry Date</th>
      <th>Text of Employees</th>
      <th>Tax Registration text</th>
      <th>1 Person Title *</th>
      <th>1 Person First Name</th>
      <th>1 Person Last Name</th>
      <th>1 Person Job Title</th>
      <th>1 Person Email Id</th>
      <th>1 Person Phone Number</th>
      <th>2 Person Title *</th>
      <th>2 Person First Name</th>
      <th>2 Person Last Name</th>
      <th>2 Person Job Title</th>
      <th>2 Person Email Id</th>
      <th>2 Person Phone Number</th>
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


			$query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);
			$html.='<tr>
			<td>'.$row['name'].'</td>
			<td>'.$row['city'].'</td>
			<td>'.$$row['name_ar'].'</td>
			<td>'.$row['name_ar'].'</td>
			<td>'.$row['country'].'</td>
			<td>'.$row['pobox'].'</td>
			<td>'.$row['mobile_number'].'</td>
			<td>'.$row['zipcode'].'</td>
			<td>'.$row['phone_number'].'</td>
			<td>'.$row['address'].'</td>
			<td>'.$row['fax_number'].'</td>
			<td>'.$row['address_ar'].'</td>
			<td>'.$row['website_address'].'</td>
			<td>'.$row['cr_number'].'</td>
			<td>'.$row['user_email'].'</td>
			<td>'.$row['cr_legal_type'].'</td>
			<td>'.$row['cr_registration_date'].'</td>
			<td>'.$row['business_type_product_category'].'</td>
			<td>'.$row['cr_expiry_date'].'</td>
			<td>'.$row['cr_tax_registration_number'].'</td>
			<td>'.$fetch1['title'].'</td>
			<td>'.$fetch1['first_name'].'</td>
			<td>'.$fetch1['last_name'].'</td>
			<td>'.$fetch1['job_title'].'</td>
			<td>'.$fetch1['email_id'].'</td>
			<td>'.$fetch1['phone_number1'].'</td>
			<td>'.$fetch2['title'].'</td>
			<td>'.$fetch2['first_name'].'</td>
			<td>'.$fetch2['last_name'].'</td>
			<td>'.$fetch2['job_title'].'</td>
			<td>'.$fetch2['email_id'].'</td>
			<td>'.$fetch2['phone_number1'].'</td>
			<td>'.$show_status.'</td>
			</tr>';
		}
	$html.='</table>';
}else{
	$html="Data not found";
}
$mpdf=new \Mpdf\Mpdf([['orientation' => 'L'], 'format' => 'A4-L']);
#$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file='media/'.time().'.pdf';
$mpdf->output($file,'I');
//D
//I
//F
//S

}


elseif(($_SESSION['filter_rfilter']==date('M-Y'))){
$res=mysqli_query($conn,"SELECT * FROM `company_tbl` WHERE `up_month`='".$_SESSION['filter_rfilter']."'  ORDER BY id ASC");
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
  font-size:100px;
}


tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<div style="text-align:center; margin-bottom:25px;">
    <img src="logo.png" alt="freeCodeCamp" width="160" height="100"/>
</div>
<table class="table">';
		$html.='<tr>
		  <th>Company Name English</th>
		  <th>City</th>
		  <th>Company Name Arabic</th>
	    <th>Country</th>
	    <th>PO Box</th>
      <th>Mobile Number</th>
      <th>Zip/Postal Code</th>
      <th>Phone Number</th>
      <th>Address English</th>
      <th>Fax Number</th>
      <th>Address Arabic</th>
      <th>Website Address</th>
      <th>Company Registration No</th>
      <th>User Name</th>
      <th>Legal Type</th>
      <th>CR Registration Date</th>
      <th>Main Product Category</th>
      <th>CR Expiry Date</th>
      <th>Text of Employees</th>
      <th>Tax Registration text</th>
      <th>1 Person Title *</th>
      <th>1 Person First Name</th>
      <th>1 Person Last Name</th>
      <th>1 Person Job Title</th>
      <th>1 Person Email Id</th>
      <th>1 Person Phone Number</th>
      <th>2 Person Title *</th>
      <th>2 Person First Name</th>
      <th>2 Person Last Name</th>
      <th>2 Person Job Title</th>
      <th>2 Person Email Id</th>
      <th>2 Person Phone Number</th>
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


			$query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);
			$html.='<tr>
			<td>'.$row['name'].'</td>
			<td>'.$row['city'].'</td>
			<td>'.$$row['name_ar'].'</td>
			<td>'.$row['name_ar'].'</td>
			<td>'.$row['country'].'</td>
			<td>'.$row['pobox'].'</td>
			<td>'.$row['mobile_number'].'</td>
			<td>'.$row['zipcode'].'</td>
			<td>'.$row['phone_number'].'</td>
			<td>'.$row['address'].'</td>
			<td>'.$row['fax_number'].'</td>
			<td>'.$row['address_ar'].'</td>
			<td>'.$row['website_address'].'</td>
			<td>'.$row['cr_number'].'</td>
			<td>'.$row['user_email'].'</td>
			<td>'.$row['cr_legal_type'].'</td>
			<td>'.$row['cr_registration_date'].'</td>
			<td>'.$row['business_type_product_category'].'</td>
			<td>'.$row['cr_expiry_date'].'</td>
			<td>'.$row['cr_tax_registration_number'].'</td>
			<td>'.$fetch1['title'].'</td>
			<td>'.$fetch1['first_name'].'</td>
			<td>'.$fetch1['last_name'].'</td>
			<td>'.$fetch1['job_title'].'</td>
			<td>'.$fetch1['email_id'].'</td>
			<td>'.$fetch1['phone_number1'].'</td>
			<td>'.$fetch2['title'].'</td>
			<td>'.$fetch2['first_name'].'</td>
			<td>'.$fetch2['last_name'].'</td>
			<td>'.$fetch2['job_title'].'</td>
			<td>'.$fetch2['email_id'].'</td>
			<td>'.$fetch2['phone_number1'].'</td>
			<td>'.$show_status.'</td>
			</tr>';
		}
	$html.='</table>';
}else{
	$html="Data not found";
}
$mpdf=new \Mpdf\Mpdf([['orientation' => 'L'], 'format' => 'A4-L']);
#$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file='media/'.time().'.pdf';
$mpdf->output($file,'I');
//D
//I
//F
//S

}



elseif(($_SESSION['filter_rfilter']=='6months')){
$res=mysqli_query($conn,"SELECT * FROM `company_tbl` WHERE `record_date` >= CURDATE() - INTERVAL 6 MONTH  ORDER BY id ASC");
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
  font-size:100px;
}


tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<div style="text-align:center; margin-bottom:25px;">
    <img src="logo.png" alt="freeCodeCamp" width="160" height="100"/>
</div>
<table class="table">';
		$html.='<tr>
		  <th>Company Name English</th>
		  <th>City</th>
		  <th>Company Name Arabic</th>
	    <th>Country</th>
	    <th>PO Box</th>
      <th>Mobile Number</th>
      <th>Zip/Postal Code</th>
      <th>Phone Number</th>
      <th>Address English</th>
      <th>Fax Number</th>
      <th>Address Arabic</th>
      <th>Website Address</th>
      <th>Company Registration No</th>
      <th>User Name</th>
      <th>Legal Type</th>
      <th>CR Registration Date</th>
      <th>Main Product Category</th>
      <th>CR Expiry Date</th>
      <th>Text of Employees</th>
      <th>Tax Registration text</th>
      <th>1 Person Title *</th>
      <th>1 Person First Name</th>
      <th>1 Person Last Name</th>
      <th>1 Person Job Title</th>
      <th>1 Person Email Id</th>
      <th>1 Person Phone Number</th>
      <th>2 Person Title *</th>
      <th>2 Person First Name</th>
      <th>2 Person Last Name</th>
      <th>2 Person Job Title</th>
      <th>2 Person Email Id</th>
      <th>2 Person Phone Number</th>
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


			$query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);
			$html.='<tr>
			<td>'.$row['name'].'</td>
			<td>'.$row['city'].'</td>
			<td>'.$$row['name_ar'].'</td>
			<td>'.$row['name_ar'].'</td>
			<td>'.$row['country'].'</td>
			<td>'.$row['pobox'].'</td>
			<td>'.$row['mobile_number'].'</td>
			<td>'.$row['zipcode'].'</td>
			<td>'.$row['phone_number'].'</td>
			<td>'.$row['address'].'</td>
			<td>'.$row['fax_number'].'</td>
			<td>'.$row['address_ar'].'</td>
			<td>'.$row['website_address'].'</td>
			<td>'.$row['cr_number'].'</td>
			<td>'.$row['user_email'].'</td>
			<td>'.$row['cr_legal_type'].'</td>
			<td>'.$row['cr_registration_date'].'</td>
			<td>'.$row['business_type_product_category'].'</td>
			<td>'.$row['cr_expiry_date'].'</td>
			<td>'.$row['cr_tax_registration_number'].'</td>
			<td>'.$fetch1['title'].'</td>
			<td>'.$fetch1['first_name'].'</td>
			<td>'.$fetch1['last_name'].'</td>
			<td>'.$fetch1['job_title'].'</td>
			<td>'.$fetch1['email_id'].'</td>
			<td>'.$fetch1['phone_number1'].'</td>
			<td>'.$fetch2['title'].'</td>
			<td>'.$fetch2['first_name'].'</td>
			<td>'.$fetch2['last_name'].'</td>
			<td>'.$fetch2['job_title'].'</td>
			<td>'.$fetch2['email_id'].'</td>
			<td>'.$fetch2['phone_number1'].'</td>
			<td>'.$show_status.'</td>
			</tr>';
		}
	$html.='</table>';
}else{
	$html="Data not found";
}
$mpdf=new \Mpdf\Mpdf([['orientation' => 'L'], 'format' => 'A4-L']);
#$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file='media/'.time().'.pdf';
$mpdf->output($file,'I');
//D
//I
//F
//S

}


elseif(($_SESSION['filter_rfilter']=='1year')){
$res=mysqli_query($conn,"SELECT * FROM `company_tbl` WHERE `record_date` >= CURDATE() - INTERVAL 1 YEAR  ORDER BY id ASC");
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
  font-size:100px;
}


tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<div style="text-align:center; margin-bottom:25px;">
    <img src="logo.png" alt="freeCodeCamp" width="160" height="100"/>
</div>
<table class="table">';
		$html.='<tr>
		  <th>Company Name English</th>
		  <th>City</th>
		  <th>Company Name Arabic</th>
	    <th>Country</th>
	    <th>PO Box</th>
      <th>Mobile Number</th>
      <th>Zip/Postal Code</th>
      <th>Phone Number</th>
      <th>Address English</th>
      <th>Fax Number</th>
      <th>Address Arabic</th>
      <th>Website Address</th>
      <th>Company Registration No</th>
      <th>User Name</th>
      <th>Legal Type</th>
      <th>CR Registration Date</th>
      <th>Main Product Category</th>
      <th>CR Expiry Date</th>
      <th>Text of Employees</th>
      <th>Tax Registration text</th>
      <th>1 Person Title *</th>
      <th>1 Person First Name</th>
      <th>1 Person Last Name</th>
      <th>1 Person Job Title</th>
      <th>1 Person Email Id</th>
      <th>1 Person Phone Number</th>
      <th>2 Person Title *</th>
      <th>2 Person First Name</th>
      <th>2 Person Last Name</th>
      <th>2 Person Job Title</th>
      <th>2 Person Email Id</th>
      <th>2 Person Phone Number</th>
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


			$query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);
			$html.='<tr>
			<td>'.$row['name'].'</td>
			<td>'.$row['city'].'</td>
			<td>'.$$row['name_ar'].'</td>
			<td>'.$row['name_ar'].'</td>
			<td>'.$row['country'].'</td>
			<td>'.$row['pobox'].'</td>
			<td>'.$row['mobile_number'].'</td>
			<td>'.$row['zipcode'].'</td>
			<td>'.$row['phone_number'].'</td>
			<td>'.$row['address'].'</td>
			<td>'.$row['fax_number'].'</td>
			<td>'.$row['address_ar'].'</td>
			<td>'.$row['website_address'].'</td>
			<td>'.$row['cr_number'].'</td>
			<td>'.$row['user_email'].'</td>
			<td>'.$row['cr_legal_type'].'</td>
			<td>'.$row['cr_registration_date'].'</td>
			<td>'.$row['business_type_product_category'].'</td>
			<td>'.$row['cr_expiry_date'].'</td>
			<td>'.$row['cr_tax_registration_number'].'</td>
			<td>'.$fetch1['title'].'</td>
			<td>'.$fetch1['first_name'].'</td>
			<td>'.$fetch1['last_name'].'</td>
			<td>'.$fetch1['job_title'].'</td>
			<td>'.$fetch1['email_id'].'</td>
			<td>'.$fetch1['phone_number1'].'</td>
			<td>'.$fetch2['title'].'</td>
			<td>'.$fetch2['first_name'].'</td>
			<td>'.$fetch2['last_name'].'</td>
			<td>'.$fetch2['job_title'].'</td>
			<td>'.$fetch2['email_id'].'</td>
			<td>'.$fetch2['phone_number1'].'</td>
			<td>'.$show_status.'</td>
			</tr>';
		}
	$html.='</table>';
}else{
	$html="Data not found";
}
$mpdf=new \Mpdf\Mpdf([['orientation' => 'L'], 'format' => 'A4-L']);
#$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file='media/'.time().'.pdf';
$mpdf->output($file,'I');
//D
//I
//F
//S

}


elseif(($_SESSION['filter_status']!='') && ($_SESSION['filter_rfilter']==date('M-Y'))){
$res=mysqli_query($conn,"SELECT * FROM `company_tbl` WHERE `up_month`='".$_SESSION['filter_rfilter']."' AND status ='".$_SESSION['filter_status']."'  ORDER BY id ASC");
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
  font-size:100px;
}


tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<div style="text-align:center; margin-bottom:25px;">
    <img src="logo.png" alt="freeCodeCamp" width="160" height="100"/>
</div>
<table class="table">';
		$html.='<tr>
		  <th>Company Name English</th>
		  <th>City</th>
		  <th>Company Name Arabic</th>
	    <th>Country</th>
	    <th>PO Box</th>
      <th>Mobile Number</th>
      <th>Zip/Postal Code</th>
      <th>Phone Number</th>
      <th>Address English</th>
      <th>Fax Number</th>
      <th>Address Arabic</th>
      <th>Website Address</th>
      <th>Company Registration No</th>
      <th>User Name</th>
      <th>Legal Type</th>
      <th>CR Registration Date</th>
      <th>Main Product Category</th>
      <th>CR Expiry Date</th>
      <th>Text of Employees</th>
      <th>Tax Registration text</th>
      <th>1 Person Title *</th>
      <th>1 Person First Name</th>
      <th>1 Person Last Name</th>
      <th>1 Person Job Title</th>
      <th>1 Person Email Id</th>
      <th>1 Person Phone Number</th>
      <th>2 Person Title *</th>
      <th>2 Person First Name</th>
      <th>2 Person Last Name</th>
      <th>2 Person Job Title</th>
      <th>2 Person Email Id</th>
      <th>2 Person Phone Number</th>
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


			$query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);
			$html.='<tr>
			<td>'.$row['name'].'</td>
			<td>'.$row['city'].'</td>
			<td>'.$$row['name_ar'].'</td>
			<td>'.$row['name_ar'].'</td>
			<td>'.$row['country'].'</td>
			<td>'.$row['pobox'].'</td>
			<td>'.$row['mobile_number'].'</td>
			<td>'.$row['zipcode'].'</td>
			<td>'.$row['phone_number'].'</td>
			<td>'.$row['address'].'</td>
			<td>'.$row['fax_number'].'</td>
			<td>'.$row['address_ar'].'</td>
			<td>'.$row['website_address'].'</td>
			<td>'.$row['cr_number'].'</td>
			<td>'.$row['user_email'].'</td>
			<td>'.$row['cr_legal_type'].'</td>
			<td>'.$row['cr_registration_date'].'</td>
			<td>'.$row['business_type_product_category'].'</td>
			<td>'.$row['cr_expiry_date'].'</td>
			<td>'.$row['cr_tax_registration_number'].'</td>
			<td>'.$fetch1['title'].'</td>
			<td>'.$fetch1['first_name'].'</td>
			<td>'.$fetch1['last_name'].'</td>
			<td>'.$fetch1['job_title'].'</td>
			<td>'.$fetch1['email_id'].'</td>
			<td>'.$fetch1['phone_number1'].'</td>
			<td>'.$fetch2['title'].'</td>
			<td>'.$fetch2['first_name'].'</td>
			<td>'.$fetch2['last_name'].'</td>
			<td>'.$fetch2['job_title'].'</td>
			<td>'.$fetch2['email_id'].'</td>
			<td>'.$fetch2['phone_number1'].'</td>
			<td>'.$show_status.'</td>
			</tr>';
		}
	$html.='</table>';
}else{
	$html="Data not found";
}
$mpdf=new \Mpdf\Mpdf([['orientation' => 'L'], 'format' => 'A4-L']);
#$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file='media/'.time().'.pdf';
$mpdf->output($file,'I');
//D
//I
//F
//S

}



elseif(($_SESSION['filter_status']!='') && ($_SESSION['filter_rfilter']=='6months')){
$res=mysqli_query($conn,"SELECT * FROM `company_tbl` WHERE `record_date` >= CURDATE() - INTERVAL 6 MONTH AND status ='".$_SESSION['filter_status']."' ORDER BY id ASC");
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
  font-size:100px;
}


tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<div style="text-align:center; margin-bottom:25px;">
    <img src="logo.png" alt="freeCodeCamp" width="160" height="100"/>
</div>
<table class="table">';
		$html.='<tr>
		  <th>Company Name English</th>
		  <th>City</th>
		  <th>Company Name Arabic</th>
	    <th>Country</th>
	    <th>PO Box</th>
      <th>Mobile Number</th>
      <th>Zip/Postal Code</th>
      <th>Phone Number</th>
      <th>Address English</th>
      <th>Fax Number</th>
      <th>Address Arabic</th>
      <th>Website Address</th>
      <th>Company Registration No</th>
      <th>User Name</th>
      <th>Legal Type</th>
      <th>CR Registration Date</th>
      <th>Main Product Category</th>
      <th>CR Expiry Date</th>
      <th>Text of Employees</th>
      <th>Tax Registration text</th>
      <th>1 Person Title *</th>
      <th>1 Person First Name</th>
      <th>1 Person Last Name</th>
      <th>1 Person Job Title</th>
      <th>1 Person Email Id</th>
      <th>1 Person Phone Number</th>
      <th>2 Person Title *</th>
      <th>2 Person First Name</th>
      <th>2 Person Last Name</th>
      <th>2 Person Job Title</th>
      <th>2 Person Email Id</th>
      <th>2 Person Phone Number</th>
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


			$query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);
			$html.='<tr>
			<td>'.$row['name'].'</td>
			<td>'.$row['city'].'</td>
			<td>'.$$row['name_ar'].'</td>
			<td>'.$row['name_ar'].'</td>
			<td>'.$row['country'].'</td>
			<td>'.$row['pobox'].'</td>
			<td>'.$row['mobile_number'].'</td>
			<td>'.$row['zipcode'].'</td>
			<td>'.$row['phone_number'].'</td>
			<td>'.$row['address'].'</td>
			<td>'.$row['fax_number'].'</td>
			<td>'.$row['address_ar'].'</td>
			<td>'.$row['website_address'].'</td>
			<td>'.$row['cr_number'].'</td>
			<td>'.$row['user_email'].'</td>
			<td>'.$row['cr_legal_type'].'</td>
			<td>'.$row['cr_registration_date'].'</td>
			<td>'.$row['business_type_product_category'].'</td>
			<td>'.$row['cr_expiry_date'].'</td>
			<td>'.$row['cr_tax_registration_number'].'</td>
			<td>'.$fetch1['title'].'</td>
			<td>'.$fetch1['first_name'].'</td>
			<td>'.$fetch1['last_name'].'</td>
			<td>'.$fetch1['job_title'].'</td>
			<td>'.$fetch1['email_id'].'</td>
			<td>'.$fetch1['phone_number1'].'</td>
			<td>'.$fetch2['title'].'</td>
			<td>'.$fetch2['first_name'].'</td>
			<td>'.$fetch2['last_name'].'</td>
			<td>'.$fetch2['job_title'].'</td>
			<td>'.$fetch2['email_id'].'</td>
			<td>'.$fetch2['phone_number1'].'</td>
			<td>'.$show_status.'</td>
			</tr>';
		}
	$html.='</table>';
}else{
	$html="Data not found";
}
$mpdf=new \Mpdf\Mpdf([['orientation' => 'L'], 'format' => 'A4-L']);
#$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file='media/'.time().'.pdf';
$mpdf->output($file,'I');
//D
//I
//F
//S

}


elseif(($_SESSION['filter_status']!='') && ($_SESSION['filter_rfilter']=='1year')){
$res=mysqli_query($conn,"SELECT * FROM `company_tbl` WHERE `record_date` >= CURDATE() - INTERVAL 1 YEAR AND status ='".$_SESSION['filter_status']."'  ORDER BY id ASC");
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
  font-size:100px;
}


tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<div style="text-align:center; margin-bottom:25px;">
    <img src="logo.png" alt="freeCodeCamp" width="160" height="100"/>
</div>
<table class="table">';
		$html.='<tr>
		  <th>Company Name English</th>
		  <th>City</th>
		  <th>Company Name Arabic</th>
	    <th>Country</th>
	    <th>PO Box</th>
      <th>Mobile Number</th>
      <th>Zip/Postal Code</th>
      <th>Phone Number</th>
      <th>Address English</th>
      <th>Fax Number</th>
      <th>Address Arabic</th>
      <th>Website Address</th>
      <th>Company Registration No</th>
      <th>User Name</th>
      <th>Legal Type</th>
      <th>CR Registration Date</th>
      <th>Main Product Category</th>
      <th>CR Expiry Date</th>
      <th>Text of Employees</th>
      <th>Tax Registration text</th>
      <th>1 Person Title *</th>
      <th>1 Person First Name</th>
      <th>1 Person Last Name</th>
      <th>1 Person Job Title</th>
      <th>1 Person Email Id</th>
      <th>1 Person Phone Number</th>
      <th>2 Person Title *</th>
      <th>2 Person First Name</th>
      <th>2 Person Last Name</th>
      <th>2 Person Job Title</th>
      <th>2 Person Email Id</th>
      <th>2 Person Phone Number</th>
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


			$query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);
			$html.='<tr>
			<td>'.$row['name'].'</td>
			<td>'.$row['city'].'</td>
			<td>'.$$row['name_ar'].'</td>
			<td>'.$row['name_ar'].'</td>
			<td>'.$row['country'].'</td>
			<td>'.$row['pobox'].'</td>
			<td>'.$row['mobile_number'].'</td>
			<td>'.$row['zipcode'].'</td>
			<td>'.$row['phone_number'].'</td>
			<td>'.$row['address'].'</td>
			<td>'.$row['fax_number'].'</td>
			<td>'.$row['address_ar'].'</td>
			<td>'.$row['website_address'].'</td>
			<td>'.$row['cr_number'].'</td>
			<td>'.$row['user_email'].'</td>
			<td>'.$row['cr_legal_type'].'</td>
			<td>'.$row['cr_registration_date'].'</td>
			<td>'.$row['business_type_product_category'].'</td>
			<td>'.$row['cr_expiry_date'].'</td>
			<td>'.$row['cr_tax_registration_number'].'</td>
			<td>'.$fetch1['title'].'</td>
			<td>'.$fetch1['first_name'].'</td>
			<td>'.$fetch1['last_name'].'</td>
			<td>'.$fetch1['job_title'].'</td>
			<td>'.$fetch1['email_id'].'</td>
			<td>'.$fetch1['phone_number1'].'</td>
			<td>'.$fetch2['title'].'</td>
			<td>'.$fetch2['first_name'].'</td>
			<td>'.$fetch2['last_name'].'</td>
			<td>'.$fetch2['job_title'].'</td>
			<td>'.$fetch2['email_id'].'</td>
			<td>'.$fetch2['phone_number1'].'</td>
			<td>'.$show_status.'</td>
			</tr>';
		}
	$html.='</table>';
}else{
	$html="Data not found";
}
$mpdf=new \Mpdf\Mpdf([['orientation' => 'L'], 'format' => 'A4-L']);
#$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file='media/'.time().'.pdf';
$mpdf->output($file,'I');
//D
//I
//F
//S

}








else{
$res=mysqli_query($conn,"SELECT * FROM `company_tbl` ORDER BY id ASC");
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
  font-size:100px;
}


tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<div style="text-align:center; margin-bottom:25px;">
    <img src="logo.png" alt="freeCodeCamp" width="160" height="100"/>
</div>
<table class="table">';
		$html.='<tr>
		  <th>Company Name English</th>
		  <th>City</th>
		  <th>Company Name Arabic</th>
	    <th>Country</th>
	    <th>PO Box</th>
      <th>Mobile Number</th>
      <th>Zip/Postal Code</th>
      <th>Phone Number</th>
      <th>Address English</th>
      <th>Fax Number</th>
      <th>Address Arabic</th>
      <th>Website Address</th>
      <th>Company Registration No</th>
      <th>User Name</th>
      <th>Legal Type</th>
      <th>CR Registration Date</th>
      <th>Main Product Category</th>
      <th>CR Expiry Date</th>
      <th>Text of Employees</th>
      <th>Tax Registration text</th>
      <th>1 Person Title *</th>
      <th>1 Person First Name</th>
      <th>1 Person Last Name</th>
      <th>1 Person Job Title</th>
      <th>1 Person Email Id</th>
      <th>1 Person Phone Number</th>
      <th>2 Person Title *</th>
      <th>2 Person First Name</th>
      <th>2 Person Last Name</th>
      <th>2 Person Job Title</th>
      <th>2 Person Email Id</th>
      <th>2 Person Phone Number</th>
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


			$query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id ASC") or die(mysqli_error());
            $fetch1=mysqli_fetch_array($query1);

            $query2=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$row['id']."' ORDER BY id DESC") or die(mysqli_error());
            $fetch2=mysqli_fetch_array($query2);
			$html.='<tr>
			<td>'.$row['name'].'</td>
			<td>'.$row['city'].'</td>
			<td>'.$$row['name_ar'].'</td>
			<td>'.$row['name_ar'].'</td>
			<td>'.$row['country'].'</td>
			<td>'.$row['pobox'].'</td>
			<td>'.$row['mobile_number'].'</td>
			<td>'.$row['zipcode'].'</td>
			<td>'.$row['phone_number'].'</td>
			<td>'.$row['address'].'</td>
			<td>'.$row['fax_number'].'</td>
			<td>'.$row['address_ar'].'</td>
			<td>'.$row['website_address'].'</td>
			<td>'.$row['cr_number'].'</td>
			<td>'.$row['user_email'].'</td>
			<td>'.$row['cr_legal_type'].'</td>
			<td>'.$row['cr_registration_date'].'</td>
			<td>'.$row['business_type_product_category'].'</td>
			<td>'.$row['cr_expiry_date'].'</td>
			<td>'.$row['cr_tax_registration_number'].'</td>
			<td>'.$fetch1['title'].'</td>
			<td>'.$fetch1['first_name'].'</td>
			<td>'.$fetch1['last_name'].'</td>
			<td>'.$fetch1['job_title'].'</td>
			<td>'.$fetch1['email_id'].'</td>
			<td>'.$fetch1['phone_number1'].'</td>
			<td>'.$fetch2['title'].'</td>
			<td>'.$fetch2['first_name'].'</td>
			<td>'.$fetch2['last_name'].'</td>
			<td>'.$fetch2['job_title'].'</td>
			<td>'.$fetch2['email_id'].'</td>
			<td>'.$fetch2['phone_number1'].'</td>
			<td>'.$show_status.'</td>
			</tr>';
		}
	$html.='</table>';
}else{
	$html="Data not found";
}
$mpdf=new \Mpdf\Mpdf([['orientation' => 'L'], 'format' => 'A4-L']);
#$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file='media/'.time().'.pdf';
$mpdf->output($file,'I');
//D
//I
//F
//S

}


?>