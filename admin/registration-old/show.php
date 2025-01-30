<?php
include("../include/function.php");
if($_SESSION['email']=="")
{
header('location:../login.php');
}
error_reporting(0);
 
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
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
<li class="breadcrumb-item"><a href="#">Registration</a></li>
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
<form method="POST" enctype="multipart/form-data" action="">

<!-- Card Start -->
<div class="card m-0">
 
<!-- Start Card Body ---->
<div class="card-body">

<!-- Start gutters ---->
<div class="row gutters" >
 


<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3" >
<!-- Form Group Start -->     
<div class="form-group">
<label for="inputName" class="col-form-label">Status</label>
<select name="stype" id="mySelect1" class="form-control">
<option disabled selected>Please Select </option>
<option value="">All</option>
<option value="0" <?=($_POST['stype']=='0')?'selected':'';?>>Pending Approval</option>
<option value="1" <?=($_POST['stype']=='1')?'selected':'';?>>Approved</option>
<option value="2" <?=($_POST['stype']=='2')?'selected':'';?>>Rejected</option>
<option value="3" <?=($_POST['stype']=='3')?'selected':'';?>>Disabled</option>
</select>
</div>
<!-- Form Group Wrap --> 
</div>


<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3" >
<div class="form-group">
<label for="inputName" class="col-form-label">Date Range</label>
<select class="form-control" id="mySelect" name="rfilter">
	<option selected disabled>Please Select </option>
    <option value="All" <?=($_POST['rfilter']=='All')?'selected':'';?>>All</option>
	<option value="<?=date('M-Y')?>" <?=($_POST['rfilter']==date('M-Y'))?'selected':'';?>>This Month</option>
	<option value="6months" <?=($_POST['rfilter']=='6months')?'selected':'';?>>6 Months</option>
	<option value="1year" <?=($_POST['rfilter']=='1year')?'selected':'';?>>One Year</option>
	<option value="sdate">Custom</option>
</select>
</div>
</div>

<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3" id="custom" style="margin-top:32px;">
<div class="form-group" style="display:flex;"><input type="submit" name="search" class="btn btn-success mx-2" value="Filter">&nbsp;<a href="show.php?page=VS"><input type="button" name="Reset" class="btn btn-warning" value="Reset"></a></div>
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
<div class="t-header">Manage Registration</div>
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
<th>Subscription Fees</th>
<th>Annul Price</th>
<th>Prefix Number</th>
<th>Gln Number</th>
<th>Status</th>
<th>Action</th> 
</tr>
</thead>
<tbody>

<?php

if(isset($_POST['search'])){

$stype=$_POST['stype'];
$sdate1=$_POST['sdate1'];
$sdate2=$_POST['sdate2'];
$rfilter=$_POST['rfilter'];

//1st Condiotion
if(($stype!='') && ($sdate1=='') && ($sdate2=='')){
if($stype==0){
  echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#FFCC00">All Pending Records</span>';
}
elseif($stype==1){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#42ba96">All Approved Records</span>';
}
elseif($stype==2){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#E85454">All Rejected Records</span>';
}
elseif($stype==3){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#808080">All Disabled Records</span>'; 
}


$query=mysqli_query($conn, "SELECT  * FROM `company_tbl` WHERE `status`='$stype'") or die(mysqli_error());
}

//2nd Condiotion

elseif(($sdate1!='') && ($sdate2!='') &&($stype=='')){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#80bfff">'.$sdate1.' AND '.$sdate2.'</span>';

$query=mysqli_query($conn, "SELECT  * FROM `company_tbl` WHERE `record_date` BETWEEN '$sdate1' AND '$sdate2'") or die(mysqli_error());
}


//3rd Condiotion
elseif(($rfilter=="All")){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#80bfff">All Record</span>';

$query=mysqli_query($conn, "SELECT  * FROM `company_tbl`") or die(mysqli_error());
}

//4th Condiotion
elseif(($rfilter==date('M-Y'))){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#80bfff"> '.$rfilter.'</span>';

$query=mysqli_query($conn, "SELECT  * FROM `company_tbl` WHERE `up_month`= '".$rfilter."'") or die(mysqli_error());
}

//5th Condiotion
elseif(($rfilter=="6months")){

echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#80bfff">Last 6 Months Records</span>';
#echo "SELECT * FROM visa_data WHERE `upload_date` >= CURDATE() - INTERVAL 6 MONTH AND upload_type=1";
 $query=mysqli_query($conn, "SELECT * FROM company_tbl WHERE `record_date` >= CURDATE() - INTERVAL 6 MONTH ") or die(mysqli_error());
 
}

//6th Condiotion
elseif(($rfilter=="1year")){

echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#80bfff">'.$rfilter.'</span>';
#echo "SELECT * FROM visa_data WHERE `upload_date` >= CURDATE() - INTERVAL 6 MONTH AND upload_type=1";
 $query=mysqli_query($conn, "SELECT * FROM company_tbl WHERE `record_date` >= CURDATE() - INTERVAL 1 YEAR ") or die(mysqli_error());
 
}

//7th Condiotion
elseif( ($stype!='') && ($sdate1!='') && ($sdate2!='') ){
if($stype==0){
  echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#FFCC00">All Pending Records</span>';
}
elseif($stype==1){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#42ba96">All Approved Records</span>';
}
elseif($stype==2){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#E85454">All Rejected Records</span>';
}
elseif($stype==3){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#808080">All Disabled Records</span>'; 
}

$query=mysqli_query($conn, "SELECT  * FROM `company_tbl` WHERE `record_date` BETWEEN '$sdate1' AND '$sdate2' AND status='$stype'") or die(mysqli_error());
}


//8th Condiotion
elseif( ($stype!='') && ($rfilter==date('M-Y')) ){
if($stype==0){
  echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#FFCC00">All Pending Records &nbsp; '.$rfilter.'</span>';
}
elseif($stype==1){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#42ba96">All Approved Records &nbsp; '.$rfilter.'</span>';
}
elseif($stype==2){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#E85454">All Rejected Records &nbsp; '.$rfilter.'</span>';
}
elseif($stype==3){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#808080">All Disabled Records &nbsp; '.$rfilter.'</span>'; 
}
$query=mysqli_query($conn, "SELECT  * FROM `company_tbl` WHERE `up_month`= '".$rfilter."'  AND status='$stype'") or die(mysqli_error());

}

//9th Condiotion
elseif( ($stype!='') && ($rfilter=='6months') ){
if($stype==0){
  echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#FFCC00">All Pending Records &nbsp; '.$rfilter.'</span>';
}
elseif($stype==1){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#42ba96">All Approved Records &nbsp; '.$rfilter.'</span>';
}
elseif($stype==2){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#E85454">All Rejected Records &nbsp; '.$rfilter.'</span>';
}
elseif($stype==3){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#808080">All Disabled Records &nbsp; '.$rfilter.'</span>'; 
}

$query=mysqli_query($conn, "SELECT * FROM company_tbl WHERE `record_date` >= CURDATE() - INTERVAL 6 MONTH AND status='$stype'") or die(mysqli_error());
}

//10th Condiotion
elseif( ($stype!='') && ($rfilter=='1year') ){
if($stype==0){
  echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#FFCC00">All Pending Records &nbsp; '.$rfilter.'</span>';
}
elseif($stype==1){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#42ba96">All Approved Records &nbsp; '.$rfilter.'</span>';
}
elseif($stype==2){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#E85454">All Rejected Records &nbsp; '.$rfilter.'</span>';
}
elseif($stype==3){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#808080">All Disabled Records &nbsp; '.$rfilter.'</span>'; 
}
$query=mysqli_query($conn, "SELECT * FROM company_tbl WHERE `record_date` >= CURDATE() - INTERVAL 1 YEAR AND status='$stype'") or die(mysqli_error());

}









else{
$query=mysqli_query($conn, "SELECT  * FROM `company_tbl`") or die(mysqli_error());
}
$row=mysqli_num_rows($query);
if($row>0){
$n=1;
while($fetch=mysqli_fetch_array($query)){
$query1=mysqli_query($conn, "SELECT * FROM `product_tbl`") or die(mysqli_error());
			$fetch1=mysqli_fetch_array($query1);
$status=$fetch['status'];
$bid=$fetch['id'];
?>

<tr> 
		<td><?php echo $n; $n++;?></td>
	 
		<td><?php echo $fetch['name']?></td>
		<td><?php echo $fetch['product_name']?></td>
		<td>
			<?php 
			if(($fetch['product_id']==$fetch1['id'])){
				echo $fetch1['gtins_name'];
			}
			else{
				echo"-----";
			}
		
	?></td>
		<td><?php echo $fetch['record_date']?></td>
		<td><?php echo $fetch['annual_subscription_fee']?></td>
		<td><?php echo $fetch['annual_total_price']?></td>
		<td>---</td>
		<td>---</td>
		
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


		<td><a href="edit.php?view_id=<?=$fetch['id']?>"><span class='badge badge-warning'>Edit</span></a>|<a href="view.php?view_id=<?=$fetch['id']?>"><span class='badge badge-info'>View</span></a>|<a href="show?image_id=<?php echo $bid; ?>&&page=REV"><span class='badge badge-danger'>Delete</span></a></td>
 
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
		$query=mysqli_query($conn, "SELECT * FROM `company_tbl`") or die(mysqli_error());
		$n=1;
		while($fetch=mysqli_fetch_array($query)){
			$query1=mysqli_query($conn, "SELECT * FROM `product_tbl`") or die(mysqli_error());
			$fetch1=mysqli_fetch_array($query1);
			$status=$fetch['status'];
			$bid=$fetch['id'];
?>
	<tr>
		<td><?php echo $n; $n++;?></td>
	 
		<td><?php echo $fetch['name']?></td>
		<td><?php echo $fetch['product_name']?></td>
		<td>
			<?php 
			if(($fetch['product_id']==$fetch1['id'])){
				echo $fetch1['gtins_name'];
			}
			else{
				echo"-----";
			}
		
	?></td>
		<td><?php echo $fetch['record_date']?></td>
		<td>
<?php 
			if(($fetch['annual_subscription_fee']=='0')){
				echo"-----";
			
			}
			else{
				echo $fetch['annual_subscription_fee'];
			}
		
	?>
			</td>
		<td>
			<?php 
			if(($fetch['annual_total_price']=='0')){
				echo"-----";
			
			}
			else{
				echo $fetch['annual_total_price'];
			}
		
	?>
			
				


			</td>
		<td>---</td>
		<td>---</td>
		
		

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


<td><a href="edit.php?view_id=<?=$fetch['id']?>"><span class='badge badge-warning'>Edit</span></a>|<a href="view.php?view_id=<?=$fetch['id']?>"><span class='badge badge-info'>View</span></a>|<a href="show?image_id=<?php echo $bid; ?>&&page=REV"><span class='badge badge-danger'>Delete</span></a></td>
		 
		  
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
<script type="text/javascript">
        setTimeout(function () {
  
            // Closing the alert
            $('#alert').alert('close');
        }, 2000);
    </script>
  <script>
    	$('#mySelect').on('change', function() {
  var result = $(this).val();
 
  if (result=='sdate')
     $("#custom").html('<div class="form-group" style="display:flex;"><label class="my-2 mx-2">From </label><input class="form-control" type="date" name="sdate1"><label class="my-2 mx-2">To</label><input class="form-control" type="date" name="sdate2"><input type="submit" name="search" class="btn btn-success ml-2 " value="Filter"></div>');


     


     if(result!='sdate')
     	
      
         $("#custom").html('<div class="form-group" style="display:flex;"><input type="submit" name="search" class="btn btn-success mx-2" value="Filter">&nbsp;<a href="show.php?page=VS"><input type="button" name="Reset" class="btn btn-warning" value="Reset"></a></div>');
});
    
  
  </script>


    <script>
    	$('#mySelect1').on('change', function() {
  var result = $(this).val();
     if(result!='sdate')
         $("#custom").html('<div class="form-group" style="display:flex;"><input type="submit" name="search" class="btn btn-success mx-2" value="Filter">&nbsp;<a href="show.php?page=VS"><input type="button" name="Reset" class="btn btn-warning" value="Reset"></a></div>');
});
    
  
  </script>