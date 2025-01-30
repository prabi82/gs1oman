		<?php
	error_reporting(0);
	include("include/function.php");
	if(!isset($_SESSION['email']))
	{
		header('location:login.php');
	}
	?>
	<!doctype html>
	<html lang=en>
	<head>
	<meta charset=utf-8>
	<meta name=viewport content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name=description content="Responsive Bootstrap4">
	<meta name=author content>
	<link rel="shortcut icon" href="<?=$base_url?><?=$rows_website['favicon']?>" />
	<title><?php title(); ?> - Dashboard</title>
	<?php include("include/common_style.php"); ?>
	</head>
	<body>
	<?php include("include/top_header.php"); ?>
	<div class=screen-overlay></div>
	<?php  include("include/quick_link.php"); ?>
	<?php include ("include/quick_setting.php"); ?>
	<div class=container-fluid>
	<?php include("include/menu_navbar.php"); ?>
	<div class=main-container>
	<div class=page-header>
	<ol class=breadcrumb>
	<li class=breadcrumb-item>Home</li>
	<li class="breadcrumb-item active">Dashboard</li>
	</ol>
	<ul class=app-actions>
	<li>
	<a href=#>
	<?php date_time(); ?>
	</a>
	</li>
	</ul>
	</div>
	<div class=content-wrapper>
	<div class=gutters>
	<div class="row gutters">

	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
	<div class=info-tiles>
	<div class=info-icon>
	<i class=icon-account_circle></i>
	</div>
	<a href="<?= $admin_url ?>manage_user/manage_admin.php"><div class=stats-detail>
	<h3><?php
	$sql="SELECT * FROM `admin_tbl`";
	$q=mysqli_query($conn,$sql);
	$row=mysqli_num_rows($q);
	echo $row ; ?></h3>
	<p>Total Admin</p>
	</div></a>
	</div>
	</div>

	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
	<div class=info-tiles>
	<div class=info-icon>
	<i class=icon-user></i>
	</div>
	<a href="<?=$admin_url?>registration/show.php?stype=1&search=Filter&page=REV">
	<div class=stats-detail>
	<h3><?php
	$sql="SELECT * FROM `company_tbl` WHERE status='1'";
	$q=mysqli_query($conn,$sql);
	$row=mysqli_num_rows($q);
	echo $row ; ?></h3>
	<p>Approved Customer</p>
	</div></a>
	</div>
	</div>

	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
	<div class=info-tiles>
	<div class=info-icon>
	<i class="icon-user icon-close"></i>
	</div>
	<a href="<?=$admin_url?>registration/show.php?stype=0&search=Filter&page=REV">
	<div class=stats-detail>
	<h3><?php
	$sql="SELECT * FROM `company_tbl` WHERE status!='1'";
	$q=mysqli_query($conn,$sql);
	$row=mysqli_num_rows($q);
	echo $row ; ?></h3>
	<p>Pending Customer</p>
	</div></a>
	</div>
	</div>

	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12" style="display:none;">
	<div class=info-tiles>
	<div class=info-icon>
	<i class="icon-settings"></i>
	</div>
	<a href="<?=$admin_url?>website_setting/website_setting_form.php?page=WS">
	<div class=stats-detail>
	<h3><?php
	$sql="SELECT * FROM `system_settings`";
	$q=mysqli_query($conn,$sql);
	$row=mysqli_num_rows($q);
	echo $row ; ?></h3>
	<p>Website Setting</p>
	</div></a>
	</div>
	</div>




	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12" style="display:none;">
	<div class=info-tiles>
	<div class=info-icon>
	<i class=icon-play></i>
	</div>
	<a href="<?=$admin_url?>package/show.php?page=PD"><div class=stats-detail>
	<h3><?php
	$sql="SELECT * FROM `product_tbl` WHERE status='1'";
	$q=mysqli_query($conn,$sql);
	$row=mysqli_num_rows($q);
	echo $row ; ?></h3>
	<p>Total Package</p>
	</div></a>
	</div>
	</div>

	

   
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
	<div class=info-tiles>
	<div class=info-icon>
	<i class=icon-lock></i>
	</div>
	<a href="<?=$admin_url?>product/common.php?stype=1&search=Filter&page=PROT"><div class=stats-detail>
	<h3>
	<?php
	$sql="SELECT * FROM `order_tbl` WHERE status='1'";
	$q=mysqli_query($conn,$sql);
	$row=mysqli_num_rows($q);
	echo $row ; ?></h3>
	<p>Subscriptions</p>
	</div></a>
	</div>
	</div>

	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
	<div class=info-tiles>
	<div class=info-icon>
	<i class=icon-lock-open></i>
	</div>
	<a href="<?= $admin_url ?>product/common.php?stype=0&search=Filter&page=PROT"><div class=stats-detail>
	<h3><?php
	$sql="SELECT * FROM `order_tbl` WHERE status!='1'";
	$q=mysqli_query($conn,$sql);
	$row=mysqli_num_rows($q);
	echo $row ; ?></h3>
	<p>Pending Subscriptions</p>
	</div></a>
	</div>
	</div>

	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
	<div class=info-tiles>
	<div class=info-icon>
	<i class=icon-lock-open></i>
	</div>
	<a href="<?= $admin_url ?>registration/show.php?stype=0&search=Filter"><div class=stats-detail>
	<h3><?php
	$sql="SELECT * FROM `company_tbl` WHERE status='0'";
	$q=mysqli_query($conn,$sql);
	$row=mysqli_num_rows($q);
	echo $row ; ?></h3>
	<p>Verify Date Updates Pending</p>
	</div></a>
	</div>
	</div>

  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
	<div class=info-tiles>
	<div class=info-icon>
	<i class="icon-user icon-close"></i>
	</div>
	<a href="<?=$admin_url?>product/common.php?stype=Expired&search=Filter&page=PROT">
	<div class=stats-detail>
	<h3><?php
	$sql="SELECT * FROM `order_tbl` WHERE renew_status='0'";
	$q=mysqli_query($conn,$sql);
	$row=mysqli_num_rows($q);
	echo $row ; ?></h3>
	<p>Expired Subscriptions</p>
	</div></a>
	</div>
	</div>


<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
	<div class=info-tiles>
	<div class=info-icon>
	<i class="icon-user icon-registered"></i>
	</div>
	<a href="<?=$admin_url?>registration/alregistrations.php">
	<div class=stats-detail>
	<h3><?php
	$sql="SELECT * from `company_tbl`";
	$q=mysqli_query($conn,$sql);
	$row=mysqli_num_rows($q);
	echo $row ; ?></h3>
	<p>All Registration</p>
	</div></a>
	</div>
	</div>
	



	

	

	



	





























	</div>
	</div>
	</div>
	</div>
	<?php include("include/footer.php"); ?>
	</div>
	<?php include ("include/main_js.php"); ?>
	</body>
	</html>