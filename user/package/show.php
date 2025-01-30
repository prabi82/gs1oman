<?php
error_reporting(0);
include("../include/function.php");
if($_SESSION['user_email']=="")
{
header('location:../login.php');
}
$_SESSION['filter_status']=$_GET['stype']; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$current = date('Y-m-d');
$sql2 =mysqli_query($conn,"update `order_tbl` set expired	='1' where expiry_date <='".$current."' and status = 1");
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
<li class="breadcrumb-item"><a href="#">Product</a></li>
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
<form method="GET" enctype="multipart/form-data" action="">

<!-- Card Start -->
<div class="card m-0">
 
<!-- Start Card Body ---->
<div class="card-body">

<!-- Start gutters ---->
<div class="row gutters" >
 

<!-- 2nd Col-4 Start ---->
<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3" >

<!-- Form Group Start -->     
<div class="form-group">
<label for="inputName" class="col-form-label">Status</label>
<select name="stype" class="form-control" required="">
<option disabled selected>Please Select </option>
<option  <?php if($_SESSION['filter_status']==6) echo 'selected'; ?>  value="6">All</option>
<option <?php if($_SESSION['filter_status']==0) echo 'selected'; ?> value="0">Pending Payment</option>
<option <?php if($_SESSION['filter_status']==1) echo 'selected'; ?>  value="1">Approved</option>
<option style="display:none" <?php if($_SESSION['filter_status']==2) echo 'selected'; ?> value="2">Rejected</option>
<option style="display:none" <?php if($_SESSION['filter_status']==3) echo 'selected'; ?> value="3">Disabled</option>
<option <?php if($_SESSION['filter_status']=='Expired') echo 'selected'; ?>  value="Expired">Expired</option>
<option style="display:none" <?php if($_SESSION['filter_status']=='Verified') echo 'selected'; ?> value="Verified">Verified</option>
</select>



</div>
<!-- Form Group Wrap --> 


</div>
<!-- 2nd Col-4 Wrap ---->


<!-- last Col-2 Start ---->
<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 mt-4">

<!-- Form Group Start -->     
<div class="form-group">

<input type="submit" name="search" class="btn btn-success" value="Filter">
<a href="show.php?page=Pack"><input type="button" name="Reset" class="btn btn-warning" value="Reset"></a>
<br>

</div>
<!-- Form Group Wrap --> 


</div>
<!-- last Col-2 Wrap ---->

 
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
<form method="GET" action="" enctype="multipart/form-data">

<div class="row t-header">
<div class="col-md-6">
<div class="t-header">Manage Product</div>
</div>
<?php 

$user_mail=$_SESSION['user_email'];

?>
<div class="col-md-6" style="display:flex; flex-direction: row-reverse;">
<a href="add.php?page=Pack"><input type="button" name="submit" class="btn btn-success" value="Add New "></a>
</div>



</div>

</form>

<div class="table-responsive">
<table id="basicExample" class="table custom-table">
<thead>
<tr> 
<th>Sno</th>
<!--<th>Product Name</th>-->
<th>Prefix Type</th>
<!--<th>Gtins Name</th>-->
<th>Package</th>
<!--<th>Registration Fees</th>-->
<th>Registration</th>
<th>Gtins Annual Fees</th>
<th>Gln Annual Fees</th>
<th>SSCC Annual Fees</th>
<th>Annual Subscription Fee</th>
<th>Total</th>
<th>Order Date</th>
<th>Expiry Date</th>
<th>Remaining Days</th>
<th>Renew Status</th>
<th>Status</th>
<th>Download Certicate </th>
<th>Action</th> 
</tr>
</thead>
<tbody>

<?php
if(isset($_GET['search'])){

$stype=$_GET['stype'];
$stype1=$_GET['stype1'];


if(($stype!='') && $stype==1){

$query=mysqli_query($conn, "SELECT  * FROM `order_tbl` WHERE `status`='1' and expired !=1 AND old = 0 AND user_email='".$_SESSION['user_email']."'") or die(mysqli_error());
}
elseif(($stype!='Expired') && ($stype!='Verified') &&  $stype==0){

$query=mysqli_query($conn, "SELECT  * FROM `order_tbl` WHERE `status`='0' and expired !=0 AND old = 0 AND user_email='".$_SESSION['user_email']."'") or die(mysqli_error());
}

elseif(($stype!='') && ($stype=='Expired') ){

$query=mysqli_query($conn, "SELECT  * FROM `order_tbl` WHERE `expired`='1' and old = 0  AND user_email='".$_SESSION['user_email']."'") or die(mysqli_error());
}
else{

$query=mysqli_query($conn, "SELECT  * FROM `order_tbl` WHERE user_email='".$_SESSION['user_email']."' AND old = 0 ");
}
$row=mysqli_num_rows($query);
if($row>0){
$n=1;
while($fetch=mysqli_fetch_array($query)){
$product_query=mysqli_fetch_array(mysqli_query($conn, "SELECT  * FROM `product_tbl` WHERE id='".$fetch['product_id']."'") );
$status=$fetch['status'];
$bid=$fetch['id'];
$certificate_pdf=$fetch['certificate_pdf'];

//Expiry Data
$date1=$fetch['order_date'];
$date2=$fetch['expiry_date'];
$date3=date('Y-m-d');

$purchased_date=strtotime($date1);
$exp_date=strtotime($date2);
$today_date=strtotime($date3);

$diff = $exp_date - $today_date;
$num=round($diff / 86400);



?>

<tr> 
<td><?php echo $n; $n++;?></td>
<td><?=$product_query['product_name'];?></td>
<td><?=$product_query['gtins_name'];?></td>
<td>
<?php 
if($fetch['registration_fee']!='' || $fetch['registration_fee']!=0){
echo $fetch['registration_fee'];
}
else{
echo "---";
}
?>
</td>

<td>
<?php 
if($fetch['gtins_annual_fee']!='' || $fetch['gtins_annual_fee']!=0){
echo $fetch['gtins_annual_fee'];
}
else{
echo "---";
}
?>
</td>

<td>
<?php 
if($fetch['gln_price']!='' || $fetch['gln_price']!=0){
echo $fetch['gln_price'];
}
else{
echo "-";
}
?>
</td>

<td>
<?php 
if($fetch['sscc_price']!='' || $fetch['sscc_price']!=0){
echo $fetch['sscc_price'];
}
elseif($fetch['sscc_price']=='' || $fetch['sscc_price']==0){
echo "Not";
}
?>
</td>
<td>
<?php echo $fetch['annual_subscription_fee']?>
</td>
<td>
<?php echo $fetch['annual_total_price']?>
</td>
<td>
<?php echo $fetch['order_date']?>
</td>
<td>
<?php echo $fetch['expiry_date']?>
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
if($status==0){
echo"<span class='badge badge-warning'>Pending</span>";
}
elseif($status==1 && $fetch['expired']!=1){
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


<td>



<?php

if($date2 >=$date3){

if($num>"0"){
if($status==1){
echo'<span class="badge badge-success"><a href="'.$base_url.''.$fetch['certificate_pdf'].'" download>Download GCP</a></span>';


//echo $id;
				/* $querygln=mysqli_query($conn,$glnprice)or die(mysqli_error($conn));
				$glnprice2=mysqli_fetch_assoc($querygln);
				//echo '<pre>';
				//print_r($glnprice2);
				if(isset($glnprice2['gln_price']) && !empty($glnprice2['gln_price'])){
	echo '&nbsp;'; // Add spacing
	echo'<span class="badge badge-success"><a href="https://gs1oman.com/'.$fetch['certificate_glnpdf'].'" download>Download GLN </a></span>';
} */
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



<td><a href="view.php?view_id=<?=$fetch['company_id']?>&id=<?=$fetch['id']?>&page=Pack"><i class='fa fa-eye' style='font-size:20px; color:#008dbd;'></i></a></td>
 
</tr>

<tr>
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
<form>
      <div class="modal-body">

    <div class="form-group">
    <label for="exampleInputEmail1">Product Name</label>
    <input type="text" class="form-control" value="<?=$product_query['product_name'];?>" disabled readonly>
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
    <input type="text" class="form-control" value="<?=date('Y/12/31');?>" disabled readonly>
  </div>

   <div class="form-group">
    <label for="exampleInputEmail1">Renewal Price</label>
    <input type="text" class="form-control" value="850.000 OMR" disabled readonly>
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



<tr>


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

<?php  $id=$fetch['id'];
 ?>
    <div class="form-group">
    <label for="exampleInputEmail1">Product Name</label>
    <input type="text" class="form-control" value="<?=$product_query['product_name'];?>" disabled readonly>
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
		
		$query=mysqli_query($conn, "SELECT  * FROM `order_tbl` WHERE user_email='".$_SESSION['user_email']."' AND old = 0 ") or die(mysqli_error());
		$n=1;
		while($fetch=mysqli_fetch_array($query)){
	$product_query=mysqli_fetch_array(mysqli_query($conn, "SELECT  * FROM `product_tbl` WHERE id='".$fetch['product_id']."'") );
			$status=$fetch['status'];
			$renew_status=$fetch['renew_status'];
			$renew_date=$fetch['renew_date'];
			$bid=$fetch['id'];

			//Expiry Data
$date1=$fetch['order_date'];
$date2=$fetch['expiry_date'];
$date3=date('Y-m-d');

$purchased_date=strtotime($date1);
$exp_date=strtotime($date2);
$today_date=strtotime($date3);

$diff = $exp_date - $today_date;
$num=round($diff / 86400);

?>
	<tr>
<td><?php echo $n; $n++;?></td>
<td><?=$product_query['product_name'];?></td>
<td><?=$product_query['gtins_name'];?></td>
<td>
<?php 
if($fetch['registration_fee']!='' || $fetch['registration_fee']!=0){
echo $fetch['registration_fee'];
}
else{
echo "---";
}
?>
</td>

<td>
<?php 
if($fetch['gtins_annual_fee']!='' || $fetch['gtins_annual_fee']!=0){
echo $fetch['gtins_annual_fee'];
}
else{
echo "---";
}
?>
</td>

<td>
<?php 
if($fetch['gln_price']!='' || $fetch['gln_price']!=0){
echo $fetch['gln_price'];
}
else{
echo "-";
}
?>
</td>

<td>
<?php 
if($fetch['sscc_price']!='' || $fetch['sscc_price']!=0){
echo $fetch['sscc_price'];
}
elseif($fetch['sscc_price']=='' || $fetch['sscc_price']==0){
echo "Not";
}
?>
</td>
<td>
<?php echo $fetch['annual_subscription_fee']?>
</td>
<td>
<?php echo $fetch['annual_total_price']?>
</td>
<td>
<?php echo $fetch['order_date']?>
</td>
<td>
<?php echo $fetch['expiry_date']?>
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


<td>



<?php

if($date2 >=$date3){

if($num>"0"){
if($status==1){
echo'<span class="badge badge-success"><a href="'.$base_url.''.$fetch['certificate_pdf'].'" download>Download GCP</a></span>';
$id=$fetch['id'];
$glnprice="SELECT `gln_price` FROM order_tbl WHERE id='".$id."' ";

/* $glnprice="SELECT `gln_price` FROM order_tbl WHERE id='".$id."' ";
echo $glnprice;
die;*/
				$querygln=mysqli_query($conn,$glnprice)or die(mysqli_error($conn));
				$glnprice2=mysqli_fetch_assoc($querygln);
				
				if(isset($glnprice2['gln_price']) && !empty($glnprice2['gln_price'])){
	echo '&nbsp;'; // Add spacing
	echo'<span class="badge badge-success"><a href="https://gs1oman.com/'.$fetch['certificate_glnpdf'].'" download>Download GLN </a></span>';
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

<td><a href="view.php?view_id=<?=$fetch['company_id']?>&&id=<?=$fetch['id']?>&&page=Pack"><i class='fa fa-eye' style='font-size:20px; color:#008dbd;'></i></a></td>
		 
		  
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
$order_tbl = "SELECT * FROM  order_tbl WHERE  id='".$renew_id1."'";
$res=mysqli_query($conn, $order_tbl);
$fetch_row=mysqli_fetch_array($res);
$renew_date=$fetch_row['renew_date'];
if(($renew_date=='0000-00-00') || ($renew_date=='') ){
	$resultIndicator = 	$_REQUEST['resultIndicator'];
	$user_id = $fetch_row['company_id'];
	$order_id = 'Barcode'.(rand(1,10000));
	$product_id = $fetch_row['product_id'];
	$id = $fetch_row['id'];
	$user_email = $fetch_row['user_email'];
	$registration_fee = $fetch_row['registration_fee'];
	$gtins_annual_fee = $fetch_row['gtins_annual_fee'];
	$gln_price = $fetch_row['gln_price'];
	$annual_subscription_fee = $fetch_row['annual_subscription_fee'];
	$order_date = date('Y-m-d');
	
	if($fetch_row['status']==0) {
		$order_id = $fetch_row['order_id'];
	} else {
	$sql2 =mysqli_query($conn,"update `order_tbl` set old	='1' where id ='".$id."'");
	
	$sql2 =mysqli_query($conn,"INSERT INTO `order_tbl`(company_id ,order_id,  product_id ,user_email,annual_total_price,parent_id, renew_price,order_date,status,registration_fee,gtins_annual_fee,gln_price,annual_subscription_fee) VALUES('$user_id','$order_id','$product_id' ,'$user_email' ,'$renew_price','$id','$renew_price','$order_date','0','$registration_fee','$gtins_annual_fee','$gln_price','$annual_subscription_fee')");
	}
	header("Location: payment.php?_token=".base64_encode($order_id).""); 
	die;

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

<?php  $id=$fetch['id'];
 ?>
    <div class="form-group">
    <label for="exampleInputEmail1">Product Name</label>
    <input type="text" class="form-control" value="<?=$product_query['product_name'];?>" disabled readonly>
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
    
    ?>
    <input type="hidden" class="form-control" name="renew_date1" value="<?=$rdate;?>" disabled readonly>
    <input type="text" class="form-control" name="" value="<?=$rdate;?>" disabled readonly>
    <input type="hidden" class="form-control" name="renew_status1" value="0">
    <input type="hidden" class="form-control" name="renew_id1" value="<?=$fetch['id'];?>">
  </div>

   <div class="form-group">
    <label for="exampleInputEmail1">Renewal Price</label>
    <input type="text" class="form-control" name="renew_price" value="850.00 OMR" disabled readonly>
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


<?php
if(!empty($_GET['image_id']))
{
$id=$_GET['image_id'];
$sql_f="SELECT c.* , o.*,cc.* FROM company_tbl c,order_tbl o, company_contacts_tbl cc WHERE c.id=o.company_id AND c.id=cc.company_id";

#$sql_f="SELECT * FROM `product_tbl` WHERE  id ='$id'";// use for delete image from folder 
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