<?php

error_reporting(0);

include("../include/function.php");

if($_SESSION['email']=="")

{

header('../location:login.php');

}

$view_id=$_GET['view_id'];

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

      <title><?php title(); ?>-COMPANY DETAILS</title>

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

                  <li class="breadcrumb-item active">COMPANY CONTACTS MINIMUM 2 PERSONS</li>

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

                 

<?php

$sql="SELECT * FROM `company_contacts_tbl` WHERE company_id='".$view_id."'  ORDER BY id ASC";

$query=mysqli_query($conn,$sql)or die(mysqli_error($conn));

$n=1;

while($row=mysqli_fetch_array($query))

{

?>



 <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">



 <div class="card">

  <img class="card-img-top" src="user.png" alt="Card image cap" style="width:80px; height=70px; border-radius:50%; margin: 20px;">

  <div class="card-body">

   <p class="card-text"><b>Title:-</b> &nbsp; <?=$row['title'];?></p>

    <p class="card-text"><b>First Name:-</b> &nbsp; <?=$row['first_name'];?></p>

     <p class="card-text"><b>Last Name:-</b> &nbsp; <?=$row['last_name'];?></p>

    <p class="card-text"><b>Email:-</b> &nbsp; <?=$row['email_id'];?></p>

    <p class="card-text"><b>Phone:-</b> &nbsp; <?=$row['phone_number1'];?></p>

    <p class="card-text"><b>Job Title:-</b> &nbsp; <?=$row['job_title'];?></p>

  </div>



</div>

                           

</div>

<?php  } ; ?>













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

         <!-- Footer start -->

         <?php include("../include/footer.php"); ?>

         <!-- Footer end -->

      </div>

      <!-- Required jQuery first, then Bootstrap Bundle JS -->

      <?php include ("../include/main_js.php"); ?>

   </body>

</html>