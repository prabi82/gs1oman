<?php
include("../include/function.php");
if($_SESSION['email']=="")
{
header('../location:login.php');
}

if(isset($_POST['submit']))
{
$product_name=mysqli_real_escape_string($conn,$_POST['product_name']);
$gtins_name=mysqli_real_escape_string($conn,$_POST['gtins_name']);
$registration_fee=mysqli_real_escape_string($conn,$_POST['registration_fee']);
$gtins_annual_fee=mysqli_real_escape_string($conn,$_POST['gtins_annual_fee']);
$gln_annual_fee=mysqli_real_escape_string($conn,$_POST['gln_annual_fee']);
$sscc_annual_fee=mysqli_real_escape_string($conn,$_POST['sscc_annual_fee']);
$status=mysqli_real_escape_string($conn,$_POST['status']);

 
if(isset($_GET['id']))
{
$id=$_GET['id'];

$sql="UPDATE `product_tbl` SET  `product_name`='$product_name', `gtins_name`='$gtins_name', `registration_fee`='$registration_fee', `gtins_annual_fee`='$gtins_annual_fee', `gln_annual_fee`='$gln_annual_fee', `sscc_annual_fee`='$sscc_annual_fee',`status`='$status' WHERE id='$id'";
$query=mysqli_query($conn,$sql)or die(mysqli_error($conn));
if($query)
{
echo "<script>window.location='show.php?page=PD';</script>";
$_SESSION['message']="Product Updated Successfully";

}
}

}
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
<link rel="shortcut icon" href="../../images/Upload/logo/logo.png" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Title -->
<title><?php title(); ?>-Product</title>


<!-- *************
************ Common Css Files *************
************ -->
<!-- Bootstrap css -->
<?php include("../include/common_style.php"); ?>


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
<li class="breadcrumb-item">Home
</li>
<li class="breadcrumb-item active">Update Product</li>
</ol>

<ul class="app-actions">
<li>
<a href="#" >
<?php echo date("d/m/Y"); ?>
</a>
</li>

</ul>
</div>
<!-- Page header end -->


<!-- Content wrapper start -->
<div class="content-wrapper">


<div class="row justify-content-center gutters">
<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
<?php
$id=$_GET['id'];
$sql="SELECT * FROM `product_tbl` WHERE id='$id'";
$query=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($query);
?>
<form method="post" enctype="multipart/form-data">
<div class="card m-0">
<div class="card-header">
<div class="card-title">Update Product</div>

</div>
<div class="card-body">

<div class="row gutters">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

<div class="form-group">
<label for="inputName" class="col-form-label">Product  Name</label>
<input type="text" class="form-control" id="inputName" name="product_name" value="<?php echo $row['product_name']; ?>">
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Gtin Name</label>
<input type="text" class="form-control" id="gtin" value="<?php echo $row['gtins_name']; ?>"  name="gtins_name" >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Gtins Registration Fee</label>
<input type="number" class="form-control" value="<?php echo $row['registration_fee']; ?>"   name="registration_fee" >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Gtins Annul Fee</label>
<input type="number" class="form-control" value="<?php echo $row['gtins_annual_fee']; ?>"   name="gtins_annual_fee" >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Gln Annual Fee</label>
<input type="number" class="form-control" value="<?php echo $row['gln_annual_fee']; ?>"  name="gln_annual_fee" >
</div>

<div class="form-group" id="sscc">
<?php
if($row['gtins_name'] > 1000)
{
?>
<label for="inputName" class="col-form-label">SSCC Annual Fee</label>
<input type="number" class="form-control" value="<?=$row['sscc_annual_fee'];?>"  name="sscc_annual_fee" >
<?php }else {?>
 
<?php } ?>
</div>




<div class="form-group">
<label for="inputSubject" class="col-form-label">Status</label>
<select name="status" class="form-control">
<?php

if($row['status']==1)
{
echo "<option value='1' selected>Show</option>
<option value='0'>Hide</option>";
}
else{
echo "<option value='1' >Show</option>
<option value='0' selected >Hide</option>";
}
?>
	</select>
</div>
</div>


</div>

<div class="row gutters">
<div class="col-xl-12">
<input type="submit" id="submit" name="submit" class="btn btn-primary" value="Submit">
<a href="show.php?page=PD"><input type="button" name="cancel" class="btn btn-warning" value="Back"></a>
</div>

</div>

</div>
</div>
</form>

</div>
</div>


</div>
<!-- Content wrapper end -->


</div>
<!-- *************
************ Main container end *************
************* -->
<script>
    $(document).ready(function() {
    $("#gtin").on('keyup', function() {
        var gtin = $("#gtin").val();
        if (gtin>1000)
         $("#sscc").html("<label for='inputName' class='col-form-label'>Sscc Annual Fee</label><input type='number' class='form-control' name='sscc_annual_fee' value='<?=$row['sscc_annual_fee'];?>'>");
        else if (gtin<=1000)
          $("#sscc").html("<input type='number' class='form-control d-none'>");
        else
          $("#sscc").html("");
        
      });
    });
  </script>

<!-- Footer start -->
<?php include("../include/footer.php"); ?>
<!-- Footer end -->


</div>


<?php include ("../include/main_js.php"); ?>


</body>

</html>