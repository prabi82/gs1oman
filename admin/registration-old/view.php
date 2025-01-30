<?php
error_reporting(0);
include("../include/function.php");
if($_SESSION['email']=="")
{
header('../location:login.php');
}
$view_id=$_GET['view_id'];
#"SELECT * FROM company_tbl WHERE id='".$view_id."'";
$cumpany_sql=mysqli_query($conn,"SELECT * FROM company_tbl WHERE id='".$view_id."'");
$company_row=mysqli_fetch_assoc($cumpany_sql);
@extract($company_row);

//// company Contact data /////
 #"SELECT * FROM company_contacts_tbl WHERE company_id='".$view_id."'";
$cumpany_contact_sql=mysqli_query($conn,"SELECT * FROM company_contacts_tbl WHERE company_id='".$view_id."'");
//$cumpany_contact_row=mysqli_fetch_assoc($cumpany_contact_sql);
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
                  <li class="breadcrumb-item active">COMPANY DETAILS</li>
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
                     <form method="post" enctype="multipart/form-data">
                        <div class="card m-0">
                           <div class="card-header">
                              <h3>COMPANY DETAILS</h3>
                           </div>
                           <div class="card-body">
                              <div class="row gutters">
                                 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    
                                    <div class="form-group">
                                       <label for="inputName" class="col-form-label">Company Name English *</label>
                                       <input type="text" class="form-control" id="gtin"  name="gtins_name" value="<?=$name?>" readonly>
                                    </div>
                                    <div class="form-group">
                                       <label for="inputName" class="col-form-label">Company Name Arabic *</label>
                                       <input type="text" class="form-control"   name="registration_fee" value="<?=$name_ar?>" readonly>
                                    </div>
                                    <div class="form-group">
                                       <label for="inputName" class="col-form-label">PO Box *</label>
                                       <input type="text" class="form-control"   name="gtins_annual_fee" value="<?=$pobox?>" readonly>
                                    </div>
                                    <div class="form-group">
                                       <label for="inputName" class="col-form-label">Zip/Postal Code *</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$zipcode?>" readonly>
                                    </div>
                                     <div class="form-group">
                                       <label for="inputName" class="col-form-label">Address English *</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$address?>" readonly>
                                    </div>
                                     <div class="form-group">
                                       <label for="inputName" class="col-form-label">Address Arabic *</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee"  value="<?=$address_ar?>" readonly>
                                    </div>
                                    
                                     <div class="form-group">
                                       <label for="inputName" class="col-form-label">City *</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$city?>" readonly>
                                    </div>
                                     <div class="form-group">
                                       <label for="inputName" class="col-form-label">Country *</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$country?>" readonly>
                                    </div>
                                     <div class="form-group">
                                       <label for="inputName" class="col-form-label">Mobile Number *</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$mobile_number?>" readonly>
                                    </div>
                                     <div class="form-group">
                                       <label for="inputName" class="col-form-label">Phone Number *</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$phone_number?>" readonly>
                                    </div>
                                     <div class="form-group">
                                       <label for="inputName" class="col-form-label">Fax Number</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$fax_number?>" readonly>
                                    </div>
                                     <div class="form-group">
                                       <label for="inputName" class="col-form-label">Website Address</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$website_address?>" readonly>
                                    </div>
                                    <h3>CR DETAILS</h3>
                                     <div class="form-group">
                                       <label for="inputName" class="col-form-label">Company Registration text (CR No.): *</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$cr_number?>" readonly>
                                    </div>
                                     <div class="form-group">
                                       <label for="inputName" class="col-form-label">Legal Type *</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$cr_legal_type?>" readonly>
                                    </div>
                                     <div class="form-group">
                                       <label for="inputName" class="col-form-label">CR Registration Date</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$cr_registration_date?>" readonly>
                                    </div>
                                     <div class="form-group">
                                       <label for="inputName" class="col-form-label">CR Expiry Date</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$cr_expiry_date?>" readonly>
                                    </div>
                                     <div class="form-group">
                                       <label for="inputName" class="col-form-label">Tax Registration text</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$cr_tax_registration_number?>" readonly>
                                    </div>
                                    <h3>LOGIN DETAILS</h3>
                                     <div class="form-group">
                                       <label for="inputName" class="col-form-label">User Name *</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$user_email?>" readonly>
                                    </div>
                                     <div class="form-group">
                                       <label for="inputName" class="col-form-label">Password *</label>
                                       <input type="password" class="form-control"   name="gln_annual_fee" value="<?=$cpassword?>" readonly>
                                    </div>
                                    <h3>BUSINESS TYPE</h3>
                                     <div class="form-group">
                                       <label for="inputName" class="col-form-label">Main Product Category *</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$business_type_product_category?>" readonly>
                                    </div> <div class="form-group">
                                       <label for="inputName" class="col-form-label">text of Employees</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$number_of_employee?>" readonly>
                                    </div>


<h3>ARE YOU IN HEALTHCARE?</h3>
 <div class="form-group">
<label for="inputName" class="col-form-label">Are you in identifying medical devices, which fall under the U.S. Food and Drug Administration (FDA) or Unique Device Identification System (UDI)? !</label>
<div class="col-md-12">
<input type="radio" name="healthcare_status" value="Yes"<?=($healthcare_status=='Yes')?'checked':'';?> class="tick"> &nbsp; Yes 
<input type="radio" name="healthcare_status" value="No" <?=($healthcare_status=='No')?'checked':'';?> class="tick"> &nbsp; No
</div>
</div>
                                    <h3>COMPANY CONTACTS MINIMUM 2 PERSONS</h3>
                                    <?php
                                    foreach($cumpany_contact_sql as $cumpany_contact_fire){
                                    ?>
                                     <div class="form-group">
                                       <label for="inputName" class="col-form-label">Title *</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$cumpany_contact_fire['title']?>" readonly>
                                    </div>
                                     <div class="form-group">
                                       <label for="inputName" class="col-form-label">First Name</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$cumpany_contact_fire['first_name']?>" readonly>
                                    </div>
                                    <div class="form-group">
                                       <label for="inputName" class="col-form-label">Last Name</label>
                                       <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$cumpany_contact_fire['last_name']?>" readonly>
                                    </div>
                                    <div class="form-group">
                                       <label for="inputName" class="col-form-label">Job Title</label>
                                      <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$cumpany_contact_fire['job_title']?>" readonly>
                                    </div>
                                    <div class="form-group">
                                       <label for="inputName" class="col-form-label">Job Title</label>
                                      <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$cumpany_contact_fire['email_id']?>" readonly>
                                    </div>
                                    <div class="form-group">
                                       <label for="inputName" class="col-form-label">Job Title</label>
                                      <input type="text" class="form-control"   name="gln_annual_fee" value="<?=$cumpany_contact_fire['phone_number1']?>" readonly>
                                    </div>
                                    <div class="form-group">
                                       <div class="col-md-12">
                        					<input type="radio" name="main" class="tick"> &nbsp; Is this main contact? </span>
                        				</div>
                                    </div>
                                    <?php } ?>




<h3>UPLOAD DOCUMENTS</h3>
<div class="row mb-4">
<div class="col-lg-4 col-md-4 text-center">
<label>Commercial Registration</label><br>

<a href="<?=$upload_document1?>" download><span class='badge badge-success'>Download</span></a>

</div>
<div class="col-lg-4 col-md-4 text-center">
<label>Chamber of Commercial Certificate </label><br>

<a href="<?=$upload_document2?>" download><span class='badge badge-success'>Download</span></a>

</div>
<div class="col-lg-4 col-md-4 text-center">
<label>Other Documnets</label><br>

<a href="<?=$upload_document3?>" download><span class='badge badge-success'>Download</span></a>

</div>
</div>
                                    
                                    


                                 </div>
                              </div>
                              <div class="row gutters">
                                 <div class="col-xl-12">
                                   <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Update">
                                    <a href="registration.php?page=REV"><input type="button" name="cancel" class="btn btn-warning" value="Back"></a>
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
         <!-- Footer start -->
         <?php include("../include/footer.php"); ?>
         <!-- Footer end -->
      </div>
      <!-- Required jQuery first, then Bootstrap Bundle JS -->
      <?php include ("../include/main_js.php"); ?>
   </body>
</html>