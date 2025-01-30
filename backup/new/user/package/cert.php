<?php
error_reporting(0);
include("../include/function.php");
if($_SESSION['user_email']=="")
{
header('../location:login.php');
}
$view_id=$_GET['view_id'];
$id=$_GET['id'];

//Update Data ....wrap



$cumpany_sql=mysqli_query($conn,"SELECT * FROM order_tbl WHERE company_id='".$view_id."' AND id='".$id."'");
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
      <title><?php title(); ?>-Package Details</title>
      <!-- *************
         ************ Common Css Files *************
         ************ -->
      <!-- Bootstrap css -->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

   <link rel="icon" type="icon" href="images/favicon.png">

   <!--<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/style.css">-->
   <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
      <?php include("../include/common_style.php"); ?>
    <script type="text/javascript">
   
      function printDiv(){
         var printContents = document.getElementById('printMe').innerHTML;
         var originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;

         window.print();

         document.body.innerHTML = originalContents;

      }
   </script>

   <style type="text/css">
       
         
         .text-orange {
             color: #f26234;
         }
         .bdr-top {
             border-top: 5px solid #f26234;
         }
         .ps{
            position: absolute;
            top:20%;
            left:45%;
            transform:translate(-50%, -50%); 
            color:red;
         }
         .sign{
            position: absolute;
            top:55%;
            left:50%;
            transform:translate(-50%, -50%); 
            color:red;
         }
     
      </style>
      
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
                  <li class="breadcrumb-item active">Product Certificate</li>
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

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" >

<div class="card m-0">
<div class="card-header">

<div class="card-body">
<div class="row gutters">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" id='printMe'>



<header>
   <div class="container">
      <div class="row my-5 align-items-center">
         <div class="col-md-4">
            <a href="#">
               <img class="certificate-logo"  style="height:100px " src="<?=$base_url?>images/logo-utopia.png" alt="GS1 Utopia" title="GS1 Utopia" />
            </a>
         </div>
         <div class="col-md-8">
            <p class="mb-0 text-end">The Global Language of Business</p>   
         </div>
      </div>
   </div>
</header>

<div class="container">
   <div class="row py-5">
      <div class="col-md-4">
         <div class="left-side">
            <div class="picbox justify-content-center align-items-center">
               <img src="<?=$base_url?>images/grey.jpg" style="width:300px;height:300px; ">
               <p class="ps">Program Seal (Optional)</p>
            </div>

            <div class="contactside mt-5">
               <ul class="list-unstyled text-blue">
                  <li><strong>GS1 Utopia</strong></li>
                  <li>Address Line 1</li>
                  <li>Address Line 2</li>
                  <li>Address Line 3</li>
                  <li><strong>T</strong> +00 (0)12 3456 7890</li>
                  <li><strong>E</strong> name@gs1utopia.org</li>
                  <li>www.gs1utopia.org</li>
               </ul>
               <ul class="list-unstyled text-blue">
                  <li><strong>Service Team (Freefone)</strong></li>
                  <li> +00 (0)12 3456 7890</li>
               </ul>
            </div>
         </div>
      </div>

      <div class="col-md-8">
         <div class="right-side bdr-top">
            <h1 class="text-orange mt-4">GS1 Utopia Annual Licence</h1>

            <h5>Licenced to:</h5>

            <ul class="list-unstyled mb-0">
               <li class="text-red">Company Name Line 1</li>
               <li class="text-red">Company Name Line 2</li>
            </ul>

            <small>"Licensee"</small>

            <hr>

            <h4>GS1 Company Prefix: <span style="color:red;"><?=$company_row['prefix_num'];?></span></h4>
            <p>For use in creating GS1  Indentification Keys as detailed in the GS1 General Specification which can be found on the GS1 Utopia website.</p>

            <hr>

            <h4>Legal Entitiy Global Location Number (GLN): <span style="color:red;"><?=$company_row['gln_number'];?></span></h4>

            <hr>

            <div class="row">
               <div class="col-md-6">
                  <h5>Expires: <span style="color:red;">01/01/<?=date('Y', strtotime('+1 year'));?></span></h5>
                  <hr>
                  <div class="signature mb-3">
                     <img src="<?=$base_url?>images/grey.jpg" style="width:100%; height:100px; ">
                     <p class="sign">Signature 1</p>
                  </div>
                  <ul class="list-unstyled">
                     <li>Name</li>
                     <li>Title, MO Name</li>
                  </ul>

               </div>

               <div class="col-md-6">
                  <h5>Account Number: <span class="text-red">xx/xx/xxx</span></h5>
                  <hr>
                  <div class="signature mb-3">
                     <img  src="<?=$base_url?>images/grey.jpg" style="width:100%; height:100px;">
                     <p class="sign">Signature 2</p>
                  </div>
                  <ul class="list-unstyled">
                     <li>Name</li>
                     <li>Title, MO Name</li>
                  </ul> 
               </div>
            </div>

            <p class="mt-2">The GS1 Company Prefix shown above is licenced for the sole use of the member named on this certificate. Transfer of numbers formed from this prefix to other companies is prohibited, including but not limited to selling, renting, leasing or donating all or a portion of these numbers. The licence to this prefix is valid for as long is the company numbers, coupon issuer numbers and GTIN-8 numbers are notified separately but are subject to the same licence conditions.</p>
            <p>This certificate and its associated schedules remain the property of GS1 Utopia.</p>

         </div>
      </div>


   </div>
</div>





</div>
<!--120 line-->

<div class="row gutters">
<div class="col-xl-12">
   <input type="button"  onclick="printDiv('printMe')"  class="btn btn-primary " value="Print">
   <a href="show.php?page=PACK"><input type="button" name="cancel" class="btn btn-warning" value="Back"></a>
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


<script type="text/javascript">
   $('#print').on('click', function() { // select print button with class "print," then on click run callback function
  $.print("#certificate"); // inside callback function the section with class "content" will be printed
});

// plugin creator and full list of options: https://github.com/DoersGuild/jQuery.print
</script>