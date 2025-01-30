<?php
error_reporting(0);
include("../include/function.php");
if($_SESSION['email']=="")
{
header('../location:login.php');
}
$view_id=$_GET['view_id'];

//Update Data ....wrap



$cumpany_sql=mysqli_query($conn,"SELECT * FROM order_tbl WHERE company_id='".$view_id."'");
$company_row=mysqli_fetch_assoc($cumpany_sql);
@extract($company_row);

//// company Contact data /////
$product_sql=mysqli_query($conn,"SELECT * FROM product_tbl WHERE id='".$product_id."'");
$product_row=mysqli_fetch_assoc($product_sql);

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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!-- Title -->
      <title><?php title(); ?>-Customer Product Details</title>
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
      <!--Quick settings end -->
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
                  <li class="breadcrumb-item active">Customer Product Details</li>
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
<form method="post" enctype="multipart/form-data">
<div class="content-wrapper">
<div class="row justify-content-center gutters">

<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">

<div class="card m-0">
<div class="card-header">
<h3>Customer Product Details</h3>
<div class="card-body">
<div class="row gutters">
<div class="col-xl-10 col-lg-10 col-md-10 col-sm-10">



<div class="form-group">
<label for="inputName" class="col-form-label">Product Name</label>
<input type="text" class="form-control"   name="name" value="<?=$product_row['product_name'];?>" readonly>
</div> 

<div class="form-group">
<label for="inputName" class="col-form-label">Gtins Name</label>
<input type="text" class="form-control"   value="<?=$product_row['gtins_name'];?>" readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Registration Fees</label>
<input type="text" class="form-control"   name="name_ar" value="<?=$product_row['registration_fee'];?>" readonly>
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Gln Annual Fee</label>
<?php
if($gln_price!=''){
echo'<input type="text" class="form-control"   name="pobox" value="'.$gln_price.'"readonly >';
}
else{
   echo'<input type="text" class="form-control"  value="Not Selected" readonly >';
}
?>
</div>



<div class="form-group">
<label for="inputName" class="col-form-label">Gtins Annual Fee</label>
<input type="text" class="form-control"  name="country"  value="<?=$product_row['gtins_annual_fee'];?>" readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">SSCC Annual Fee</label>
<?php
if($sscc_price!=''){
echo'<input type="text" class="form-control"    value="'.$sscc_price.'"readonly >';
}
else{
   echo'<input type="text" class="form-control"  value="Not Selected" readonly >';
}
?>
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Annual Subscription Fee</label>
<input type="text" class="form-control"    value="<?=$annual_subscription_fee;?>" readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Annual Total Price</label>
<input type="text" class="form-control"    value="<?=$annual_total_price;?>" readonly >
</div>



</div>
</div>
</div>
</div>


</div>
<!--col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6-->










</div>
</div>

</from>
<!-- Content wrapper end -->
          
</div>
        
<!-- Footer start -->
<?php include("../include/footer.php"); ?>
<!-- Footer end -->
</div>
<!-- Required jQuery first, then Bootstrap Bundle JS -->
<?php include ("../include/main_js.php"); ?>
</body>
</html>