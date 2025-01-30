<?php
include("../include/function.php");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?=$base_url?><?=$rows_website['favicon']?>" />
	<title><?php title(); ?></title>
</head>
<!-- Bootstrap css -->
<?php include("../include/table_css.php"); ?>


</head>
<body>
   
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

		<div class="col-md-8 mx-auto mt-5">
		  <div class="alert alert-success" role="alert">
			<h4 class="alert-heading">Transaction Successfull</h4>
			
			
			<hr>
			<a href="https://gs1oman.com/user/package/add.php" class="btn btn-outline-light btn-success">Make Another Payment</a>
		  </div>
		</div>
		
		</div>
</div>

</div>





</body>
<?php include('footer.php'); ?>
</html>