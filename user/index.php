	<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	include("include/function.php");
	if(!isset($_SESSION['user_email']))
	{
		header('Location: login.php');
		exit();
	}
	?>
	<!doctype html>
	<html lang=en>
	<head>
	<meta charset=utf-8>
	<meta name=viewport content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name=description content="Responsive Bootstrap4">
	<meta name=author content>
	<link rel="shortcut icon" href="<?=$base_url?><?=$rows_website['favicon']?>"/>
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
   <?php
$query=mysqli_query($conn, "SELECT  * FROM `company_tbl` WHERE user_email='".$_SESSION['user_email']."'" ) or die(mysqli_error());
$row=mysqli_num_rows($query);
$fetch=mysqli_fetch_array($query);
?>


	<div class="col-xl-3 col-lg-4 col-md-4 col-sm-4 col-12">
	<div class="info-tiles" style="width:300px; height:150px">
	<div class=info-icon>
	<i class=icon-user></i>
	</div>
	<a href="<?=$user_url?>registration/edit.php?view_id=<?=$fetch['id']?>&&page=REV"><div class="stats-detail mt-4">
	<p>Registration</p>
	</div></a>
	</div>
	</div>


	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
	<div class="info-tiles" style="width:300px; height:150px">
	<div class=info-icon>
	<i class=icon-lock></i>
	</div>
	<a href="<?=$user_url?>package/show.php?stype=1&search=Filter&page=Pack"><div class="stats-detail">
	<h3>
	<?php
	$sql="SELECT * FROM `order_tbl` WHERE status='1' AND user_email='".$_SESSION['user_email']."'";
	$q=mysqli_query($conn,$sql);
	$row=mysqli_num_rows($q);
	echo $row ; ?></h3>
	<p>Subscriptions</p>
	</div></a>
	</div>
	</div>

	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
	<div class="info-tiles" style="width:300px; height:150px">
	<div class=info-icon>
	<i class=icon-lock-open></i>
	</div>
	<a href="<?=$user_url?>package/show.php?stype=0&search=Filter&page=Pack"><div class=stats-detail>
	<h3>
	<?php
	$sql="SELECT * FROM `order_tbl` WHERE status!='1' AND user_email='".$_SESSION['user_email']."'";
	$q=mysqli_query($conn,$sql);
	$row=mysqli_num_rows($q);
	echo $row ; ?></h3>
	<p>Subscription Pending</p>
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