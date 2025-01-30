<?php
include("../include/function.php");
if($_SESSION['email']=="")
{
header('location:../login.php');
}
#$useremail = $_GET['useremail'];
#$username = $_GET['username'];
 error_reporting(0);

$_SESSION['filter_status']=$_GET['stype'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


?>
<!doctype html>
<html lang="en">

<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Meta -->
<meta name="description" content="Responsive Bootstrap4 Dashboard Template">
<meta name="author" content="ParkerThemes">
<link rel="shortcut icon" href="<?=$base_url?><?=$rows_website['favicon']?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<!-- Title -->
<title><?php title(); ?></title>


<!-- *************
************ Common Css Files *************
************ -->
<!-- Bootstrap css -->
<?php include("../include/table_css.php"); ?>


</head>
<body>


<!-- Loading ends -->


<!-- *************
************ Header section start *************
************* -->

<!-- Header start -->
<?php include("../include/top_header.php"); ?>
<!-- Header end -->

<!-- Screen overlay start -->
<div class="screen-overlay"></div>
<!-- Screen overlay end -->

<!-- Quicklinks box start -->
<?php  include("../include/quick_link.php"); ?>
<!-- Quicklinks box end -->

<!-- Quick settings start -->
<?php include ("../include/quick_setting.php"); ?>
<!-- Quick settings end -->

<!-- *************
************ Header section end *************
************* -->


<div class="container-fluid">


<!-- Navigation start -->
<?php include("../include/menu_navbar.php"); ?>
<!-- Navigation end -->


<!-- *************
************ Main container start *************
************* -->
<div class="main-container">
<!-- Page header start -->
<div class="page-header">
<ol class="breadcrumb">
<li class="breadcrumb-item">Home</li>
<li class="breadcrumb-item"><a href="#">Customer Product</a></li>
<li class="breadcrumb-item active">
</li>
</ol>

<ul class="app-actions">
<li>
<a href="#" >
<?php echo date("d/m/Y"); ?>
</a>
</li>
<li>
<a href="#" >
Back
</a>
</li>

</ul>
</div>
<!-- Page header end -->
 <div class="col-md-12" style="height:40px;">
<?php if(isset($_SESSION['message']))
{
echo "
<div id='alert' class='col-md-12 alert alert-success alert-dismissible fade show' role='alert' style='background:#51a362;'>
<p style='color:#e9f1eb; text-align:center; !important;'>".$_SESSION['message']."</p>
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
</div>";
}
unset($_SESSION['message']); ?>
</div>
<!-- Content wrapper start -->
<div class="content-wrapper">


<!-------------------------------------- Revenue Filter Start----------------------------- --->
<div class="row gutters">
<!-- Start  col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 Start --->
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">

<!-- Form Start  --->
<form method="GET" enctype="multipart/form-data" action="" name="upload_excel">

<!-- Card Start -->
<div class="card m-0">
 
<!-- Start Card Body ---->
<div class="card-body">

<!-- Start gutters ---->
<div class="row gutters" >
 

<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4" >  
<div class="form-group">
<label for="inputName" class="col-form-label">Status</label>
<select name="stype" class="form-control" required="">
<option disabled selected>Please Select </option>
<option value="">All</option>
<option value="0">Pending Approval</option>
<option value="1">Approved</option>
<option value="2">Rejected</option>
<option value="3">Disabled</option>
<!--<option value="Expired">Expired</option>-->
<option value="Expired">Expired</option>
<option value="Verified">Verified</option>
</select>
</div>
</div>

<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4" style="margin-top:34px;" > 
<div class="form-group">
<input type="submit" name="search" class="btn btn-success" value="Filter">
<a href="show.php?page=REV"><input type="button" name="Reset" class="btn btn-warning" value="Reset"></a>
<br>
</div>

</div>




<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4" style="display: flex;flex-direction: row-reverse; margin-top:34px;" > 
<div class="form-group">

<a href="exportData.php" class="btn btn-success"><i class="dwn"></i>Download Excel</a>
<a href="exportPdf.php" class="btn btn-danger"  download><i class="dwn"></i>Download Pdf</a>



</div>
</div>










 
</div>
<!-- Wrap gutters ---->
 
</div>
<!--  Card Body Wrap ---->


</div>
<!-- Card Wrap -->



</form>
<!-- Form Wrap Close  --->


</div>
</div>
<!-- Wrap / Close col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  --->

<!-- ---------------Revenuue Filter Wrap / Close-------------------------- --->
 
<!-- Row start -->
<div class="row gutters">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

<div class="table-container">
<form method="post">

<div class="row t-header">
<div class="col-md-2">
<div class="t-header">Manage Product</div>
</div>

<div class="col-md-7">

</div>

</div>

</form>

<div class="table-responsive">
<table id="basicExample" class="table custom-table">
<thead>
<tr> 
<th>Sno</th>
<th>Company Name</th>
<th>Product Name</th>
<th>Gtins Name</th>
<th>Date of Purchase</th>
<th>Expiry Date</th>
<th>Product Details</th>
<th>Subscription Fees</th>
<th>Annul Price</th>
<th>Prefix Number</th>
<th>GLN Number</th>
<th>Remaining Days</th>
<th>Renew Status</th>
<th>Certificate</th>
<th>Status</th>
<th>Action</th> 
</tr>
</thead>
<tbody>

<?php
if(isset($_GET['search'])){

$stype=$_GET['stype'];


if(($stype!='') && ($stype!='Expired') && ($stype!='Verified') ){
	
$query=mysqli_query($conn, "SELECT  * FROM `order_tbl` WHERE `status`='$stype'") or die(mysqli_error());
//echo "1";
}

elseif(($stype!='') && ($stype=='Verified') ){
	
$query=mysqli_query($conn, "SELECT  * FROM `order_tbl` WHERE `renew_status`='1'")  or die(mysqli_error());
//echo "2";
}

elseif(($stype!='') && ($stype=='Expired')){
	
//$query=mysqli_query($conn, "SELECT  * FROM `order_tbl` WHERE `renew_status`='0'") or die(mysqli_error());
$query=mysqli_query($conn, "SELECT  * FROM `order_tbl` WHERE `status`='0'") or die(mysqli_error());
//echo "3";
//echo $sql="SELECT  * FROM `order_tbl` WHERE `renew_status`='0'";
//$query=mysqli_query($conn,$sql);

}



else{
$query=mysqli_query($conn, "SELECT  * FROM `order_tbl`") or die(mysqli_error());
}
$row=mysqli_num_rows($query);
if($row>0){
$n=1;
while($fetch=mysqli_fetch_array($query)){
 $category_name=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `company_tbl` WHERE id='".$fetch['company_id']."'"));
$product_query=mysqli_fetch_array(mysqli_query($conn, "SELECT  * FROM `product_tbl` WHERE id='".$fetch['product_id']."'") );
$query1=mysqli_query($conn, "SELECT * FROM `product_tbl`") or die(mysqli_error());
			$fetch1=mysqli_fetch_array($query1);
$status=$fetch['status'];
$renew_status=$fetch['renew_status'];
$bid=$fetch['id'];
$year=date("Y", strtotime($fetch['order_date']));
$month=date("M", strtotime($fetch['order_date']));
$date=date("d", strtotime($fetch['order_date']));
$user_mail=$category_name['name'];
//Expiry Data
$date1=$fetch['order_date'];
$date2=$fetch['expiry_date'];

$date4=date('d-M-Y',$date2);
$date3=date('Y-m-d');


$purchased_date=strtotime($date1);
$exp_date=strtotime($date2);
//$exp_date=strtotime($date4);
$today_date=strtotime($date3);

$diff = $exp_date - $today_date;
$num=round($diff / 86400);


?>

<tr> 
		<td><?php echo $n; $n++;?></td>
	 
		<td><?=$category_name['name']?></td>
		<td><?php 
         if(($fetch['product_id']==$fetch1['id'])){
         	echo $fetch1['product_name'];
         }
         else{
         	echo $product_query['product_name'];
         }
         ?>
         	
         </td>
		<td><?php 
         if(($fetch['product_id']==$fetch1['id'])){
         	echo $fetch1['gtins_name'];
         }
         else{
         	echo $product_query['gtins_name'];
         }
         ?></td>

		<td><?=$date?>/<?=$month?>/<?=$year?></td>
		<!--<td><?=$fetch['expiry_date']?></td>-->
		<td><?php  $exptdate=$date2;
				$expdate=strtotime($exptdate);
				$exdate = date("d/M/Y", $expdate);
				echo $exdate;
				//echo"test"; 
				
				?></td>
      
			<td>
				<?php 
					if(isset($fetch['gtins_annual_fee']) && !empty($fetch['gtins_annual_fee'])){ ?>
					   GTIN:<?php echo $fetch['gtins_annual_fee'];
					   }else{ 
					  
					   } ?>
					   <?php if(isset($fetch['gln_price']) && !empty($fetch['gln_price'])){ ?>
					   GLN:<?php echo $fetch['gln_price'];
					   }else{ 
					   
					   } ?>
					  <?php if(isset($fetch['sscc_price']) && !empty($fetch['sscc_price'])){ ?>
						SSCC:<?php echo $fetch['sscc_price'];
					   }else{ 
					 
					   } 
					   if(empty($fetch['gtins_annual_fee']) && empty($fetch['gln_price']) && empty($fetch['sscc_price'])){
						   echo 'No Product Selected';
					   }
				   
			   ?>
		   </td>
			<td><?php if(($fetch['annual_subscription_fee']=="0")){
					echo "----";
				 }
				 else{
					echo $fetch['annual_subscription_fee'];
				 }
		
				?>
			</td>
			<td>
				<?php if(($fetch['annual_total_price']=="0")){
						echo "----";
				 }
				 else{
					echo $fetch['annual_total_price'];
				 }
		
				?>
			</td>

        <td><?php 
		if(($fetch['prefix_num']=="")){
         	echo "----";
         }
         else{
         	echo $fetch['prefix_num'];
         }
		
		?>
        </td>

        <td><?php 
		if(($fetch['gln_number']=="")){
         	echo "----";
         }
         else{
         	echo $fetch['gln_number'];
         }
		
		?>
        </td>

<td>
  <?php 
   if($date2 >=$date3){

  if($num>"0"){
  echo $num .'&nbsp; Days Remaining ' ;
}
elseif($num=="0"){
echo"Last Days Remaining";
}
elseif($num<"0"){
echo '<a href="" class="text-danger" data-toggle="modal" data-target="#exampleModal'.$fetch['id'].'">Expired</a>';
}

}

else{
  if($num<"0"){
  echo '<a href=""  class="text-danger" data-toggle="modal"  data-target="#exampleModal'.$fetch['id'].' ">Expired</a>';

}
}

  ?>
</td>

<td>
<?php 
$multiple_order 		= 	"SELECT * FROM multiple_order where order_id=".$fetch['id'];
$multiple_order_record 	= 	mysqli_query($conn, $multiple_order)	;
$fetch_record			=	mysqli_fetch_array($multiple_order_record);



 
 
 
// Fetching and displaying each record
$multiple_renew_status = 0;
if(isset($fetch_record) && !empty($fetch_record)){
	$multiple_renew_status = 1;
}

/* echo $multiple_renew_status;
echo "id".$fetch['id']; */


if ($date2 > $date3 && $multiple_renew_status == '1') {
    echo "<span class='badge badge-success'>Renewed</span>";
} 
else{
	

	if($date2 >=$date3){

	  if($num>"0"){
	  if(($renew_status==1) && ($renew_date=='0000-00-00') ){
	echo"<span class='badge badge-success'>Verified</span>";
	}
	  else{
	echo"<span class='badge badge-success'>Verified</span>";
	}

	}
	elseif($num=="0"){
	echo"<span class='badge badge-success'>Verified</span>";
	}
	elseif($num<"0"){
	if(($renew_status==1) && ($renew_date=='0000-00-00') ){
	echo"<span class='badge badge-success'>Verified</span>";
	}
	}

	}

	elseif(($renew_status==0) && ($renew_date!='0000-00-00') ){
	echo"<span class='badge badge-light'>Expired</span>";
	}

	else{
	  if($num<"0"){
	  echo '<span class="badge badge-danger">Expired</span>';

		}
		} 
    
} 

  ?>
<?php 

  /*  if($date2 >=$date3){

  if($num>"0"){
  if(($renew_status==1) && ($renew_date=='0000-00-00') ){
echo"<span class='badge badge-success'>Verified</span>";
}
  else{
echo"<span class='badge badge-success'>Verified</span>";
}

}
elseif($num=="0"){
echo"<span class='badge badge-success'>Verified</span>";
}
elseif($num<"0"){
if(($renew_status==1) && ($renew_date=='0000-00-00') ){
echo"<span class='badge badge-success'>Verified</span>";
}
}

}

elseif(($renew_status==0) && ($renew_date!='0000-00-00') ){
echo"<span class='badge badge-light'>Expired</span>";
}

else{
  if($num<"0"){
  echo '<span class="badge badge-danger">Expired</span>';

}
}

 */

  ?>





</td>




        <td>



<?php

if($date2 >=$date3){

if($num>"0"){
	if($status==1){
		if(($fetch['prefix_num']!='') && ('Renew Status'!='Verified')){
			echo'<span class="badge badge-success"><a href="'.$base_url.''.$fetch['certificate_pdf'].'" download>Download GCP</a></span>';
			$id=$fetch['id'];
			$glnprice="SELECT `gln_price` FROM order_tbl WHERE id='".$id."' ";
		//echo $id;
						$querygln=mysqli_query($conn,$glnprice)or die(mysqli_error($conn));
						$glnprice2=mysqli_fetch_assoc($querygln);
						//echo '<pre>';
						//print_r($glnprice2);
				if(isset($glnprice2['gln_price']) && !empty($glnprice2['gln_price'])){
					echo '&nbsp;'; // Add spacing
					echo'<span class="badge badge-success"><a href="https://gs1oman.com/'.$fetch['certificate_glnpdf'].'" download>Download GLN </a></span>';
				}
		}else{
		echo '-----';
	}
}
else{
echo"<span class='text-danger'>Certificate is not available</span>";
}

}

elseif($num=="0"){
if($status==1){
echo'<span class="badge badge-success"><a href="'.$base_url.''.$fetch['certificate_pdf'].'" download>Download </a></span>';
}
else{
echo"<span class='text-danger'>Certificate is not available</span>";
}

}

elseif($num<"0"){
echo"<span class='text-danger'>Certificate is not available</span>";
}

}

elseif($num<"0"){
echo"<span class='text-danger'>Certificate is not available</span>";
}


?>  


</td>
		
 	<td>
<?php
if($status==0){
echo"<span class='badge badge-warning'>Pending</span>";
}
elseif($status==1){
echo"<span class='badge badge-success'>Approved</span>";
}
elseif($status==2){
echo"<span class='badge badge-danger'>Rejected</span>";
}
elseif($status==3){
echo"<span class='badge badge-light'>Disabled</span>";
}
elseif($status=='Expired'){
echo"<span class='badge badge-light'>Expired</span>";
}
?>	

</td>


   <td><a href="edit.php?view_id=<?=$fetch['company_id']?>&&id=<?=$fetch['id']?>&&page=PROT"><i class='fa fa-edit' style='font-size:13px; color:#ea490b; ' ></i> <a href="view.php?view_id=<?=$fetch['company_id']?>&&id=<?=$fetch['id']?>&&page=PROT"><i class='fa fa-eye' style='font-size:13px; color:#008dbd;'></i> <a href="delete.php?image_id=<?php echo $bid;?>&&page=REV" onclick="return confirm('Are you sure want to delete?')"><i class='fa fa-trash' style='font-size:13px; color:#ff0000;' onclick="dlt1()" ></i> </a>
<!--<a href="show?image_id=<?php echo $bid; ?>&&page=REV"><i class='fa fa-trash' style='font-size:13px; color:#ff0000;'></i></a>--></td>   
 
</tr>


<tr>
 <?php 
if(isset($_POST['renew']))
{
$renew_id1=$_POST['renew_id1'];
$renew_date1=date('Y/12/31');
$renew_status1=$_POST['renew_status1'];
$renew_price="850";
$email_temp='<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0;">
   <meta name="format-detection" content="telephone=no"/>

   <!-- Responsive Mobile-First Email Template by Konstantin Savchenko, 2015.
   https://github.com/konsav/email-templates/  -->

   <style>

/* Reset styles */
body {
   margin: 0;
   padding: 0;
   min-width: 100%;
   width: 100% !important;
   height: 100% !important;
}

body,table,td,div,p,a {
   -webkit-font-smoothing: antialiased;
   text-size-adjust: 100%;
   -ms-text-size-adjust: 100%;
   -webkit-text-size-adjust: 100%;
   line-height: 100%;
}

table,td {
   mso-table-lspace: 0pt;
   mso-table-rspace: 0pt;
   border-collapse: collapse !important;
   border-spacing: 0;
}

img {
   border: 0;
   line-height: 100%;
   outline: none;
   text-decoration: none;
   -ms-interpolation-mode: bicubic;
}

#outlook a {
   padding: 0;
}

.ReadMsgBody {
   width: 100%;
}

.ExternalClass {
   width: 100%;
}

.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div {
   line-height: 100%;
}

/* Rounded corners for advanced mail clients only */
@media all and (min-width: 560px) {
   .container {
      border-radius: 8px;
      -webkit-border-radius: 8px;
      -moz-border-radius: 8px;
      -khtml-border-radius: 8px;
   }
}

/* Set color for auto links (addresses, dates, etc.) */
a,a:hover {
   color: #127DB3;
}

.footer a,.footer a:hover {
   color: #999999;
}

</style>

<!-- MESSAGE SUBJECT -->
<title>Barcode</title>

</head>

<!-- BODY -->
<!-- Set message background color (twice) and text color (twice) -->
<body topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0" width="100%" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;
   background-color: #F0F0F0;
   color: #000000;"
   bgcolor="#F0F0F0"
   text="#000000">

<!-- SECTION / BACKGROUND -->
<!-- Set message background color one again -->
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%;" class="background"><tr><td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;"
   bgcolor="#F0F0F0">

<!-- WRAPPER -->
<!-- Set wrapper width (twice) -->
<table border="0" cellpadding="0" cellspacing="0" align="center"
   width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
   max-width: 560px;" class="wrapper">



<!-- End of WRAPPER -->
</table>

<!-- WRAPPER / CONTEINER -->
<!-- Set conteiner background color -->
<table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF"width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit; max-width: 560px;" class="container">


<tr>
<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;
padding-top: 20px;" class="hero">
<a target="_blank" style="text-decoration: none;"href=""><img border="0" vspace="0" hspace="0" src="https://websutility.in/client-projects/barcode/images/logo.png"  style="width:100%; max-width: 200px;"/></a>
</td>
</tr>

<tr>
<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%;  font-size: 20px; font-weight:bold; padding-top:25px;font-family: sans-serif;" class="header">

Thanks you for joining with us!

</td>
</tr>
   
<tr>
<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%; padding-top: 25px; color: #000000;font-family: sans-serif;" class="paragraph">

Once It will be approved by admin then you can login successfully.
</td>
</tr>

   


   

   <!-- LIST -->
<tr>
<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%;" class="list-item"><table align="center" border="0" cellspacing="0" cellpadding="0" style="width: inherit; margin: 0; padding: 0; border-collapse: collapse; border-spacing: 0;">
         

         <tr>

           
            <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0;
               padding-top: 30px;
               padding-right: 20px;"><img
            border="0" vspace="0" hspace="0" style="padding: 0; margin: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block;
               color: #000000;"
               src="https://raw.githubusercontent.com/konsav/email-templates/master/images/list-item.png"
               alt="D" title="Designer friendly"
               width="50" height="50"></td>

            <!-- LIST ITEM TEXT -->
            <!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->
            <td align="left" valign="top" style="font-size: 17px; font-weight: 400; line-height: 160%; border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;
               padding-top: 25px;
               color: #000000;
               font-family: sans-serif;" class="paragraph">
                  <b style="color: #333333;">Renew Product Details</b><br/>
                  <li>Product Name: &nbsp; '.$product_query['product_name'].'</li>
                  <li>Gln Number: &nbsp; '.$fetch['gln_number'].'</li>
                  <li>Prefix Number: &nbsp; '.$fetch['prefix_num'].'</li>
                  <li>New Expiry Date: &nbsp; '.$renew_date1.'</li>
                  <li>Renew Total Fee: &nbsp; 850.00 OMR</li>
            </td>

         </tr>

      </table></td>
   </tr>

      
   <tr>
      <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
         padding-top: 25px;
         padding-bottom: 5px;" class="button"><a
         href="#" target="_blank" style="text-decoration: underline;">
            <table border="0" cellpadding="0" cellspacing="0" align="center" style="max-width: 240px; min-width: 120px; border-collapse: collapse; border-spacing: 0; padding: 0;"><tr><td align="center" valign="middle" style="padding: 12px 24px; margin: 0; text-decoration: underline; border-collapse: collapse; border-spacing: 0; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; -khtml-border-radius: 4px;"
               bgcolor="#E9703E"><a target="_blank" style="text-decoration: underline;
               color: #FFFFFF; font-family: sans-serif; font-size: 17px; font-weight: 400; line-height: 120%;"
               href="'.$base_url.'">
                  GS1 Oman
               </a>
         </td>
         </tr>
         </table>
         </a>
      </td>
   </tr>

   <!-- LINE -->
   <!-- Set line color -->
   <tr>
      <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
         padding-top: 25px;" class="line"><hr
         color="#E0E0E0" align="center" width="100%" size="1" noshade style="margin: 0; padding: 0;" />
      </td>
   </tr>

   

<!-- End of WRAPPER -->
</table>



<!-- End of SECTION / BACKGROUND -->
</td></tr></table>

</body>
</html>';

$order_tbl = "SELECT * FROM  order_tbl WHERE  id='".$renew_id1."' ";
$res=mysqli_query($conn, $order_tbl);
$fetch_row=mysqli_fetch_array($res);
$renew_date=$fetch_row['renew_date'];
$renew_status=$fetch_row['renew_status'];


if(($renew_status=='0') || ($renew_status=='') || ($renew_status!='1') ){
$mail = new PHPMailer(true);
             
    $mail->isSMTP(); 
       #$mail->SMTPDebug = 2;
       $mail->Host       = 'host33.theukhost.net';                     
      $mail->SMTPAuth   = true;                                   
      $mail->Username   = 'info@gs1oman.com';                    
      $mail->Password   = '9rsE@+3M[f*&';                             
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
      $mail->Port       = 465;                                    

    
      $mail->setFrom('info@gs1oman.com', 'Barcode');
      $mail->addAddress($user_mail);
      $mail->addAddress('info@gs1oman.com');
                 


    $mail->isHTML(true);                                 
    $mail->Subject = 'Barcode:Renew Product';
    $mail->Body    = $email_temp;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if($mail->send()){

$sql="UPDATE `order_tbl` SET `renew_price`='$renew_price' , `expiry_date`='$renew_date1' , `renew_date`='$renew_date1' , `renew_status`='1'  WHERE id='".$renew_id1."'";
$query=mysqli_query($conn,$sql)or die(mysqli_error($conn));
if($query)
{
echo "<script>window.location='show.php?page=Pack';</script>";
$_SESSION['message']="Product Renew Successfully";

}




}

else {
 
echo "<script>alert('Enter valid email.')</script>";

 }





  }


else{
  echo "<script>alert('Product Already Renewd')</script>";
}




}

?>



<!-- Modal -->

<div class="modal fade" id="exampleModal<?=$fetch['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="min-width:300px; ;max-width:1100px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Renew Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
<form method="post" action="">

      <div class="modal-body">

<?php echo $id=$fetch['id'];
 ?>
    <div class="form-group">
    <label for="exampleInputEmail1">Product Name</label>
    <input type="text" class="form-control" value="<?=$fetch1['product_name'];?>" disabled readonly>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Gln Numbere</label>
    <input type="text" class="form-control" value="<?=$fetch['gln_number'];?>" disabled readonly>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Prefix Nume</label>
    <input type="text" class="form-control" value="<?=$fetch['prefix_num'];?>" disabled readonly>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">New Expiry Date</label>
    <?php 
      $rdate=date('Y/12/31');
      //$rdate=date('31/M/Y');
      echo $rdate;
    ?>
    <input type="hidden" class="form-control" name="renew_date1" value="<?=$rdate;?>" disabled readonly>
    <input type="text" class="form-control" name="" value="<?=$rdate;?>" disabled readonly>
    <input type="hidden" class="form-control" name="renew_status1" value="0">
    <input type="hidden" class="form-control" name="renew_id1" value="<?=$fetch['id'];?>">
  </div>

   <div class="form-group">
    <label for="exampleInputEmail1">Renewal Price</label>
    <input type="text" class="form-control"  value="850" disabled readonly>
  </div>

  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input"  required>
    <label class="form-check-label"><a href="" data-toggle="modal" data-target="#myModal2" id="finalpay">Accept Terms and conditions</a></label>
  </div>


      </div>


      <div class="modal-footer">
        <button type="submit" name="renew" class="btn btn-primary">Renew</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>

      </form>


    </div>
  </div>
</div>

</tr>










<?php
			}
		}else{
			echo'
			<tr>
				<td colspan = "4"><center>Record Not Found</center></td>
			</tr>';
		}
	}else{
		$query=mysqli_query($conn, "SELECT * FROM `order_tbl`") or die(mysqli_error());
		$n=1;
		while($fetch=mysqli_fetch_array($query)){
		$category_name=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `company_tbl` WHERE id='".$fetch['company_id']."'"));
		$query1=mysqli_query($conn, "SELECT * FROM `product_tbl`") or die(mysqli_error());
		$fetch1=mysqli_fetch_array($query1);
		$status=$fetch['status'];
		$renew_status=$fetch['renew_status'];
		$bid=$fetch['id'];
		$year=date("Y", strtotime($fetch['order_date']));
        $month=date("M", strtotime($fetch['order_date']));
        $date=date("d", strtotime($fetch['order_date']));

$user_mail=$category_name['name'];
//Expiry Data
$date1=$fetch['order_date'];
$date2=$fetch['expiry_date'];
$date4=date('d-M-Y',$date2);;
$date3=date('Y-m-d');

$purchased_date=strtotime($date1);
$exp_date=strtotime($date4);
$today_date=strtotime($date3);

$diff = $exp_date - $today_date;
$num=round($diff / 86400);


        ?>
<tr> 
		<td><?php echo $n; $n++;?></td>
	 
		<td><?=$category_name['name']?></td>
		<td><?php 
         if(($fetch['product_id']==$fetch1['id'])){
         	echo $fetch1['product_name'];
         	
         }
         else{
         	echo "----";
			
         }
         ?>
         	
         </td>
		<td><?php 
         if(($fetch['product_id']==$fetch1['id'])){
         	echo $fetch1['gtins_name'];
         }
         else{
         	echo "----";
         }
         ?></td>

		<td><?=$date?>/<?=$month?>/<?=$year?></td>
		<!--<td><?=$date?>/<?=$month?>/<?=$year?></td>-->
		<!--<td><?=$fetch['expiry_date']?></td>-->
		<td><?php  $exptdate=$date2;
		$expdate=strtotime($exptdate);
		$exdate = date("d/M/Y", $expdate);
		echo $exdate;
		//echo"test"; 
		
		?></td>

      



		<td><?php if(($fetch['annual_subscription_fee']=="0")){
         	echo "----";
         }
         else{
         	echo $fetch['annual_subscription_fee'];
         }
		
		?></td>
		
		
		
		
		<td>
			<?php if(($fetch['annual_total_price']=="0")){
         	echo "----";
         }
         else{
         	echo $fetch['annual_total_price'];
         }
		
		?>
        </td>

        <td><?php 
		if(($fetch['prefix_num']=="")){
         	echo "----";
         }
         else{
         	echo $fetch['prefix_num'];
         }
		
		?>
        </td>

        <td><?php 
		if(($fetch['gln_number']=="")){
         	echo "----";
         }
         else{
         	echo $fetch['gln_number'];
         }
		
		?>
        </td>

<td>
  <?php 
   if($date2 >=$date3){

  if($num>"0"){
  echo $num .'&nbsp; Days Remaining ' ;

}
elseif($num=="0"){
echo"Last Days Remaining";
}
elseif($num<"0"){
echo '<a href="" class="text-danger" data-toggle="modal" data-target="#exampleModal'.$fetch['id'].'">Expired</a>';
}

}

else{
  if($num<"0"){
  echo '<a href=""  class="text-danger" data-toggle="modal"  data-target="#exampleModal'.$fetch['id'].' ">Expired</a>';

}
}

  ?>
</td>

<td>

<?php 
   if($date2 >=$date3){

  if($num>"0"){
  if(($renew_status==1) && ($renew_date=='0000-00-00') ){
echo"<span class='badge badge-success'>Verified</span>";
}
  else{
echo"<span class='badge badge-success'>Verified</span>";
}

}
elseif($num=="0"){
echo"<span class='badge badge-success'>Verified</span>";
}
elseif($num<"0"){
if(($renew_status==1) && ($renew_date=='0000-00-00') ){
echo"<span class='badge badge-success'>Verified</span>";
}
}

}

elseif(($renew_status==0) && ($renew_date!='0000-00-00') ){
echo"<span class='badge badge-light'>Expired</span>";
}

else{
  if($num<"0"){
  echo '<span class="badge badge-danger">Expired</span>';

}
}



  ?>





</td>




        <td>



<?php

if($date2 >=$date3){

if($num>"0"){
if($status==1){
echo'<span class="badge badge-success"><a href="'.$base_url.''.$fetch['certificate_pdf'].'" download>Download </a></span>';
}
else{
echo"<span class='text-danger'>Certificate is not available</span>";
}

}

elseif($num=="0"){
if($status==1){
echo'<span class="badge badge-success"><a href="'.$base_url.''.$fetch['certificate_pdf'].'" download>Download </a></span>';
}
else{
echo"<span class='text-danger'>Certificate is not available</span>";
}

}

elseif($num<"0"){
echo"<span class='text-danger'>Certificate is not available</span>";
}

}

elseif($num<"0"){
echo"<span class='text-danger'>Certificate is not available</span>";
}


?>  


</td>
		
 	<td>
<?php
if($status==0){
echo"<span class='badge badge-warning'>Pending</span>";
}
elseif($status==1){
echo"<span class='badge badge-success'>Approved</span>";
}
elseif($status==2){
echo"<span class='badge badge-danger'>Rejected</span>";
}
elseif($status==3){
echo"<span class='badge badge-light'>Disabled</span>";
}
?>	

</td>


	<td><!--<a href="editrenewal.php?view_id=<?=$fetch['company_id']?>&&id=<?=$fetch['id']?>&&page=PROT"><i class='fa fa-edit' style='font-size:13px; color:#ea490b; ' >renewal</i></a>-->
	<a href="edit.php?view_id=<?=$fetch['company_id']?>&&id=<?=$fetch['id']?>&&page=PROT"><i class='fa fa-edit' style='font-size:13px; color:#ea490b; ' ></i></a><a href="view.php?view_id=<?=$fetch['company_id']?>&&id=<?=$fetch['id']?>&&page=PROT"><i class='fa fa-eye' style='font-size:13px; color:#008dbd;'></i></a> <a href="delete.php?image_id=<?php echo $bid;?>&&page=REV" onclick="return confirm('Are you sure want to delete?')"><i class='fa fa-trash' style='font-size:13px; color:#ff0000;' onclick="dlt1()" ></i> </a>
<!--<a href="show?image_id=<?php echo $bid; ?>&&page=REV"><i class='fa fa-trash' style='font-size:13px; color:#ff0000;'></i></a> --></td>
 
</tr>




<tr>
 <?php 
if(isset($_POST['renew']))
{
$renew_id1=$_POST['renew_id1'];
$renew_date1=date('Y/12/31');
$renew_status1=$_POST['renew_status1'];
$renew_price="850";
$email_temp='<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0;">
   <meta name="format-detection" content="telephone=no"/>

   <!-- Responsive Mobile-First Email Template by Konstantin Savchenko, 2015.
   https://github.com/konsav/email-templates/  -->

   <style>

/* Reset styles */
body {
   margin: 0;
   padding: 0;
   min-width: 100%;
   width: 100% !important;
   height: 100% !important;
}

body,table,td,div,p,a {
   -webkit-font-smoothing: antialiased;
   text-size-adjust: 100%;
   -ms-text-size-adjust: 100%;
   -webkit-text-size-adjust: 100%;
   line-height: 100%;
}

table,td {
   mso-table-lspace: 0pt;
   mso-table-rspace: 0pt;
   border-collapse: collapse !important;
   border-spacing: 0;
}

img {
   border: 0;
   line-height: 100%;
   outline: none;
   text-decoration: none;
   -ms-interpolation-mode: bicubic;
}

#outlook a {
   padding: 0;
}

.ReadMsgBody {
   width: 100%;
}

.ExternalClass {
   width: 100%;
}

.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div {
   line-height: 100%;
}

/* Rounded corners for advanced mail clients only */
@media all and (min-width: 560px) {
   .container {
      border-radius: 8px;
      -webkit-border-radius: 8px;
      -moz-border-radius: 8px;
      -khtml-border-radius: 8px;
   }
}

/* Set color for auto links (addresses, dates, etc.) */
a,a:hover {
   color: #127DB3;
}

.footer a,.footer a:hover {
   color: #999999;
}

</style>

<!-- MESSAGE SUBJECT -->
<title>Barcode</title>

</head>

<!-- BODY -->
<!-- Set message background color (twice) and text color (twice) -->
<body topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0" width="100%" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;
   background-color: #F0F0F0;
   color: #000000;"
   bgcolor="#F0F0F0"
   text="#000000">

<!-- SECTION / BACKGROUND -->
<!-- Set message background color one again -->
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%;" class="background"><tr><td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;"
   bgcolor="#F0F0F0">

<!-- WRAPPER -->
<!-- Set wrapper width (twice) -->
<table border="0" cellpadding="0" cellspacing="0" align="center"
   width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
   max-width: 560px;" class="wrapper">



<!-- End of WRAPPER -->
</table>

<!-- WRAPPER / CONTEINER -->
<!-- Set conteiner background color -->
<table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF"width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit; max-width: 560px;" class="container">


<tr>
<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;
padding-top: 20px;" class="hero">
<a target="_blank" style="text-decoration: none;"href=""><img border="0" vspace="0" hspace="0" src="https://websutility.in/client-projects/barcode/images/logo.png"  style="width:100%; max-width: 200px;"/></a>
</td>
</tr>

<tr>
<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%;  font-size: 20px; font-weight:bold; padding-top:25px;font-family: sans-serif;" class="header">

Thanks you for joining with us!

</td>
</tr>
   
<tr>
<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%; padding-top: 25px; color: #000000;font-family: sans-serif;" class="paragraph">

Once It will be approved by admin then you can login successfully.
</td>
</tr>

   


   

   <!-- LIST -->
<tr>
<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%;" class="list-item"><table align="center" border="0" cellspacing="0" cellpadding="0" style="width: inherit; margin: 0; padding: 0; border-collapse: collapse; border-spacing: 0;">
         

         <tr>

           
            <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0;
               padding-top: 30px;
               padding-right: 20px;"><img
            border="0" vspace="0" hspace="0" style="padding: 0; margin: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block;
               color: #000000;"
               src="https://raw.githubusercontent.com/konsav/email-templates/master/images/list-item.png"
               alt="D" title="Designer friendly"
               width="50" height="50"></td>

            <!-- LIST ITEM TEXT -->
            <!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->
            <td align="left" valign="top" style="font-size: 17px; font-weight: 400; line-height: 160%; border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;
               padding-top: 25px;
               color: #000000;
               font-family: sans-serif;" class="paragraph">
                  <b style="color: #333333;">Renew Product Details</b><br/>
                  <li>Product Name: &nbsp; '.$product_query['product_name'].'</li>
                  <li>Gln Number: &nbsp; '.$fetch['gln_number'].'</li>
                  <li>Prefix Number: &nbsp; '.$fetch['prefix_num'].'</li>
                  <li>New Expiry Date: &nbsp; '.$renew_date1.'</li>
                  <li>Renew Total Fee: &nbsp; 850.00 OMR</li>
            </td>

         </tr>

      </table></td>
   </tr>

      
   <tr>
      <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
         padding-top: 25px;
         padding-bottom: 5px;" class="button"><a
         href="#" target="_blank" style="text-decoration: underline;">
            <table border="0" cellpadding="0" cellspacing="0" align="center" style="max-width: 240px; min-width: 120px; border-collapse: collapse; border-spacing: 0; padding: 0;"><tr><td align="center" valign="middle" style="padding: 12px 24px; margin: 0; text-decoration: underline; border-collapse: collapse; border-spacing: 0; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; -khtml-border-radius: 4px;"
               bgcolor="#E9703E"><a target="_blank" style="text-decoration: underline;
               color: #FFFFFF; font-family: sans-serif; font-size: 17px; font-weight: 400; line-height: 120%;"
               href="'.$base_url.'">
                  GS1 Oman
               </a>
         </td>
         </tr>
         </table>
         </a>
      </td>
   </tr>

   <!-- LINE -->
   <!-- Set line color -->
   <tr>
      <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
         padding-top: 25px;" class="line"><hr
         color="#E0E0E0" align="center" width="100%" size="1" noshade style="margin: 0; padding: 0;" />
      </td>
   </tr>

   

<!-- End of WRAPPER -->
</table>



<!-- End of SECTION / BACKGROUND -->
</td></tr></table>

</body>
</html>';

$order_tbl = "SELECT * FROM  order_tbl WHERE  id='".$renew_id1."' ";
$res=mysqli_query($conn, $order_tbl);
$fetch_row=mysqli_fetch_array($res);
$renew_date=$fetch_row['renew_date'];
$renew_status=$fetch_row['renew_status'];
$renew_date11=$fetch_row['renew_date'];

if(($renew_status=='0') || ($renew_status=='') || ($renew_status!='1') ){
$mail = new PHPMailer(true);
             
    $mail->isSMTP(); 
       #$mail->SMTPDebug = 2;
       $mail->Host       = 'host33.theukhost.net';                     
      $mail->SMTPAuth   = true;                                   
      $mail->Username   = 'info@gs1oman.com';                    
      $mail->Password   = '9rsE@+3M[f*&';                             
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
      $mail->Port       = 465;                                    

    
      $mail->setFrom('info@gs1oman.com', 'Barcode Renew Product');
      $mail->addAddress($user_mail);
      $mail->addAddress('info@gs1oman.com');
                 


    $mail->isHTML(true);                                 
    $mail->Subject = 'Barcode:Renew Product';
    $mail->Body    = $email_temp;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if($mail->send()){

$sql="UPDATE `order_tbl` SET `renew_price`='$renew_price' , `expiry_date`='$renew_date1' , `renew_date`='$renew_date1' , `renew_status`='1'  WHERE id='".$renew_id1."'";
$query=mysqli_query($conn,$sql)or die(mysqli_error($conn));
if($query)
{
echo "<script>window.location='show.php?page=Pack';</script>";
$_SESSION['message']="Product Renew Successfully";

}




}

else {
 
echo "<script>alert('Enter valid email.')</script>";

 }





  }


else{
  echo "<script>alert('Product Already Renewd')</script>";
}




}

?>



<!-- Modal -->

<div class="modal fade" id="exampleModal<?=$fetch['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="min-width:300px; ;max-width:1100px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Renew Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
<form method="post" action="">

      <div class="modal-body">

<?php echo $id=$fetch['id'];
 ?>
    <div class="form-group">
    <label for="exampleInputEmail1">Product Name</label>
    <input type="text" class="form-control" value="<?=$fetch1['product_name'];?>" disabled readonly>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Gln Numbere</label>
    <input type="text" class="form-control" value="<?=$fetch['gln_number'];?>" disabled readonly>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Prefix Nume</label>
    <input type="text" class="form-control" value="<?=$fetch['prefix_num'];?>" disabled readonly>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">New Expiry Date</label>
    <?php 
      $rdate=date('Y/12/31');
      //$rdate=date('31/OCT/Y');
      echo $rdate;
    ?>
    <input type="hidden" class="form-control" name="renew_date1" value="<?=$rdate;?>" disabled readonly>
    <input type="text" class="form-control" name="" value="<?=$rdate;?>" disabled readonly>
    <input type="hidden" class="form-control" name="renew_status1" value="0">
    <input type="hidden" class="form-control" name="renew_id1" value="<?=$fetch['id'];?>">
  </div>

   <div class="form-group">
    <label for="exampleInputEmail1">Renewal Price</label>
    <input type="text" class="form-control"  value="850" disabled readonly>
  </div>

  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input"  required>
    <label class="form-check-label"><a href="" data-toggle="modal" data-target="#myModal2" id="finalpay">Accept Terms and conditions</a></label>
  </div>


      </div>


      <div class="modal-footer">
        <button type="submit" name="renew" class="btn btn-primary">Renew</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>

      </form>


    </div>
  </div>
</div>

</tr>




<?php
		}
	}
?>
 	
</tbody>

</table>

</div>
</div>

</div>

</div>

<!-- Row end -->
 
</div>
</div>
<!-- Content wrapper end -->


</div>
<!-- *************
************ Main container end *************
************* -->
<?php
if(!empty($_GET['image_id']))
{
$id=$_GET['image_id'];
$sql_f="SELECT c.* , o.*,cc.* FROM company_tbl c,order_tbl o, company_contacts_tbl cc WHERE c.id=o.company_id AND c.id=cc.company_id";

#$sql_f="SELECT * FROM `product_tbl` WHERE  id ='$id'";// use for ` image from folder 
$query_f=mysqli_query($conn,$sql_f);
while($wo=mysqli_fetch_array($query_f))
{
#$image_name=$wo['image'];
}
$s="DELETE c.* , o.*,cc.* FROM company_tbl c,order_tbl o, company_contacts_tbl cc WHERE c.id=o.company_id AND c.id=cc.company_id";
$q=mysqli_query($conn,$s);
$query=mysqli_query($conn,$s) or die(mysqli_error($conn));
if($query)
{
	
echo
"<script>window.location='show.php?page=REV'</script>";
$_SESSION['message']="Record Deleted Successfully";
}
}

?>

<!-- Footer start -->
<?php include("../include/footer.php"); ?>
<!-- Footer end -->


</div>

<!-- *************
************ Required JavaScript Files *************
************* -->
<!-- Required jQuery first, then Bootstrap Bundle JS -->
<?php include("../include/table_js.php"); ?>




</body>

</html>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="min-width:200px; ;max-width:500px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Terms & Conditions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form>
      <div class="modal-body">
       
      <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..</p>
  



      </div>


   

      </form>


    </div>
  </div>
</div>