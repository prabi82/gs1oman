<?php
include("../include/function.php");
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

<!-- Title -->
<title><?php title(); ?></title>


<!-- *************
************ Common Css Files *************
************ -->
<!-- Bootstrap css -->
<?php include("../include/table_css.php"); ?>


</head>
<body>
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
<div class="container-fluid">
<?php include("../include/menu_navbar.php"); ?>
<div class="main-container">

<div class="content-wrapper">
<?php 

if(isset($_REQUEST['resultIndicator']) && !empty($_REQUEST['resultIndicator'])) {
	$resultIndicator = 	$_REQUEST['resultIndicator'];
	$query = "SELECT * FROM order_tbl where payment_data like '%".$resultIndicator."%' ORDER BY id DESc ";     
	$rs_result = mysqli_query ($conn, $query);
	$orderData = mysqli_fetch_array($rs_result);
	$id =  $orderData['id'];
	if(isset($id) && !empty($id)) {
		
       $nextYear =  date('Y');
	   $addTwoYears =  date('Y', strtotime('+1 year'));
	   $renewalDate=$addTwoYears.'-01-01';
	   $expiryDateDb= $nextYear.'-12-31';
		
		
		$UpQuery = "update order_tbl set status =1 , expiry_date= '".$expiryDateDb."'  where id = '".$id."' ";     
		$update_result = mysqli_query ($conn, $UpQuery);
		
		?>
	
		<div class="col-md-8 mx-auto mt-5">
		  <div class="alert alert-success" role="alert">
			<h4 class="alert-heading">Transaction Successfull</h4>
			
			
			<hr>
			<a href="https://gs1oman.com/user/package/add.php" class="btn btn-outline-light btn-success">Make Another Payment</a>
		  </div>
		</div>


		<?php
	} else {
		?>
		<div class="col-md-8 mx-auto mt-5">
		  <div class="alert alert-danger" role="alert">
			<h4 class="alert-heading">Transaction Error</h4>
			
			
			<hr>
			<a href="https://gs1oman.com/user/package/add.php" class="btn btn-outline-light btn-success">Try Again</a>
		  </div>
		</div>
		<?php
		
	}
}
?>
</div>
</div>

</div>





</body>
<?php include('footer.php'); ?>



