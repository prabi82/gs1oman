<?php
error_reporting(0);
include("../include/function.php");
if($_SESSION['user_email']=="")
{
header('../location:login.php');
}
$view_id=$_GET['view_id'];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['submit']))
{


// Form Submit Start 


//COMPANY DETAILS START

$name=$_POST['name'];
$name_ar=$_POST['name_ar'];
$pobox=$_POST['pobox'];
$zipcode=$_POST['zipcode'];
$address=$_POST['address'];
$address_ar=$_POST['address_ar'];
$country=$_POST['country'];
$city=$_POST['city'];
$mobile_number=$_POST['mobile_number'];
$phone_number=$_POST['phone_number'];
$fax_number=$_POST['fax_number'];
$website_address=$_POST['website_address'];
$promo_code=$_POST['promo_code'];
$healthcare_status=$_POST['healthcare_status'];
$main_contact_status=$_POST['main_contact_status'];
$status=$_POST['status'];
//COMPANY DETAILS WRAP


//CR DETAILS START 
$cr_number=$_POST['cr_number'];
$cr_legal_type=$_POST['cr_legal_type'];
$cr_registration_date=$_POST['cr_registration_date'];
$cr_expiry_date=$_POST['cr_expiry_date'];
$cr_tax_registration_number=$_POST['cr_tax_registration_number'];
// CR DETAILS WRAP

//LOGIN DETAILS START 
$user_email=$_POST['user_email'];
$cpassword=$_POST['password'];
$password=sha1($cpassword);
$business_type_product_category=$_POST['business_type_product_category'];
$number_of_employee=$_POST['number_of_employee'];
//LOGIN DETAILS WRAP


//Add More Persion 
$count = count($_POST["title"]);
$title=$_POST['title'];
$cc_id=$_POST['id'];
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$job_title=$_POST['job_title'];
$email_id=$_POST['email_id'];
$phone_number1 =$_POST['phone_number1'];

//Add More More WRAP


// Uploda Document Start 
//1st Document
$doc_name1=$_FILES['upload_document1']['name'];
$doc_tmp_name1=$_FILES['upload_document1']['tmp_name'];
$doc_path1=$base_url.'images/Upload/'.$doc_name1;

//2nd Document
$doc_name2=$_FILES['upload_document2']['name'];
$doc_tmp_name2=$_FILES['upload_document2']['tmp_name'];
$doc_path2=$base_url.'images/Upload/'.$doc_name2;


//3rd Document
$doc_name3=$_FILES['upload_document3']['name'];
$doc_tmp_name3=$_FILES['upload_document3']['tmp_name'];
$doc_path3=$base_url.'images/Upload/'.$doc_name3;
$email_temp='<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0;">
   <meta name="format-detection" content="telephone=no"/>

   <!-- Responsive Mobile-First Email Template by Konstantin Savchenko, 2015.
   https://github.com/konsav/email-templates/  -->

   <style>

/* Reset styles */
body {
   margin: 0;
   padding: 0;
   min-width: 100%;
   width: 100% !important;
   height: 100% !important;
}

body,table,td,div,p,a {
   -webkit-font-smoothing: antialiased;
   text-size-adjust: 100%;
   -ms-text-size-adjust: 100%;
   -webkit-text-size-adjust: 100%;
   line-height: 100%;
}

table,td {
   mso-table-lspace: 0pt;
   mso-table-rspace: 0pt;
   border-collapse: collapse !important;
   border-spacing: 0;
}

img {
   border: 0;
   line-height: 100%;
   outline: none;
   text-decoration: none;
   -ms-interpolation-mode: bicubic;
}

#outlook a {
   padding: 0;
}

.ReadMsgBody {
   width: 100%;
}

.ExternalClass {
   width: 100%;
}

.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div {
   line-height: 100%;
}

/* Rounded corners for advanced mail clients only */
@media all and (min-width: 560px) {
   .container {
      border-radius: 8px;
      -webkit-border-radius: 8px;
      -moz-border-radius: 8px;
      -khtml-border-radius: 8px;
   }
}

/* Set color for auto links (addresses, dates, etc.) */
a,a:hover {
   color: #127DB3;
}

.footer a,.footer a:hover {
   color: #999999;
}

</style>

<!-- MESSAGE SUBJECT -->
<title>Barcode</title>

</head>

<!-- BODY -->
<!-- Set message background color (twice) and text color (twice) -->
<body topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0" width="100%" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;
   background-color: #F0F0F0;
   color: #000000;"
   bgcolor="#F0F0F0"
   text="#000000">

<!-- SECTION / BACKGROUND -->
<!-- Set message background color one again -->
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%;" class="background"><tr><td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;"
   bgcolor="#F0F0F0">

<!-- WRAPPER -->
<!-- Set wrapper width (twice) -->
<table border="0" cellpadding="0" cellspacing="0" align="center"
   width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
   max-width: 560px;" class="wrapper">



<!-- End of WRAPPER -->
</table>

<!-- WRAPPER / CONTEINER -->
<!-- Set conteiner background color -->
<table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF"width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit; max-width: 560px;" class="container">


<tr>
<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;
padding-top: 20px;" class="hero">
<a target="_blank" style="text-decoration: none;"href=""><img border="0" vspace="0" hspace="0" src="https://websutility.in/client-projects/barcode/images/logo.png"  style="width:100%; max-width: 200px;"/></a>
</td>
</tr>


   
<tr>
<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%;  font-size: 20px; font-weight:bold; padding-top:25px;font-family: sans-serif;" class="header">';


if($status==0){
  $email_temp.='<span style="color:#ff9900">Your account request is still pending</span>'; 
}
elseif($status==1){
$email_temp.='<span style="color:#009900">Your account is Approved successfully</span>'; 
}
elseif($status==2){
$email_temp.='<span style="color:#cc0000">Your registration request is Rejected !</span>'; 
}
elseif($status==3){
$email_temp.='<span style="color:#ff0000">Your account is disabled or block for the short the period</span>'; 
}
$email_temp.='</td>
</tr>

   


   

   <!-- LIST -->
<tr>
<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%;" class="list-item"><table align="center" border="0" cellspacing="0" cellpadding="0" style="width: inherit; margin: 0; padding: 0; border-collapse: collapse; border-spacing: 0;">
         
<!-- LIST ITEM -->
<tr>

            
<td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0;padding-top: 30px;
padding-right: 20px;">
<img border="0" vspace="0" hspace="0" style="padding: 0; margin: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block; color: #000000;"src="https://raw.githubusercontent.com/konsav/email-templates/master/images/list-item.png" width="50" height="50"></td>

            <!-- LIST ITEM TEXT -->
            <!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->
            <td align="left" valign="top" style="font-size: 17px; font-weight: 400; line-height: 160%; border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;
               padding-top: 25px;
               color: #000000;
               font-family: sans-serif;" class="paragraph">
                  <b style="color: #333333;">Registration Details</b><br/>
                  <li>Company Name: &nbsp; '.$name.'</li>
                  <li>Mobile Number: &nbsp; '.$mobile_number.'</li>
                  <li>Email id: &nbsp; '.$user_email.'</li>
                  <li>Password: &nbsp; '.$cpassword.'</li>
                  
            </td>

         </tr>

         <!-- LIST ITEM -->
        

      </table></td>
   </tr>

      
   <tr>
      <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
         padding-top: 25px;
         padding-bottom: 5px;" class="button"><a
         href="#" target="_blank" style="text-decoration: underline;">
            <table border="0" cellpadding="0" cellspacing="0" align="center" style="max-width: 240px; min-width: 120px; border-collapse: collapse; border-spacing: 0; padding: 0;"><tr><td align="center" valign="middle" style="padding: 12px 24px; margin: 0; text-decoration: underline; border-collapse: collapse; border-spacing: 0; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; -khtml-border-radius: 4px;"
               bgcolor="#E9703E"><a target="_blank" style="text-decoration: underline;
               color: #FFFFFF; font-family: sans-serif; font-size: 17px; font-weight: 400; line-height: 120%;"
               href="'.$base_url.'">
                  Barcode
               </a>
         </td></tr></table></a>
      </td>
   </tr>

   <!-- LINE -->
   <!-- Set line color -->
   <tr>
      <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
         padding-top: 25px;" class="line"><hr
         color="#E0E0E0" align="center" width="100%" size="1" noshade style="margin: 0; padding: 0;" />
      </td>
   </tr>

   

<!-- End of WRAPPER -->
</table>



<!-- End of SECTION / BACKGROUND -->
</td></tr></table>

</body>
</html>';













 
if(isset($_GET['view_id']))
{
#$view_id=$_GET['view_id'];



if(!empty($doc_name1))
{
move_uploaded_file($doc_tmp_name1,$doc_path1);
$sql1="UPDATE `company_tbl` SET `upload_document1`='$doc_path1' WHERE id='$view_id'";
$query1=mysqli_query($conn,$sql1)or die(mysqli_error($conn)); 
}

if(!empty($doc_name2))
{
move_uploaded_file($doc_tmp_name2,$doc_path2);
$sql2="UPDATE `company_tbl` SET `upload_document2`='$doc_path2' WHERE id='$view_id'";
$query2=mysqli_query($conn,$sql2)or die(mysqli_error($conn)); 
}

if(!empty($doc_name3))
{
move_uploaded_file($doc_tmp_name3,$doc_path3);
 $sql3="UPDATE `company_tbl` SET `upload_document3`='$doc_path3' WHERE id='$view_id'";
$query3=mysqli_query($conn,$sql3)or die(mysqli_error($conn)); 


}
 $sql4="UPDATE `company_tbl` SET  
`name`='$name', 
`name_ar`='$name_ar', 
`pobox`='$pobox', 
`zipcode`='$zipcode', 
`address`='$address', 
`address_ar`='$address_ar',
`city`='$city', 
`country`='$country',
`mobile_number`='$mobile_number', 
`phone_number`='$phone_number', 
`fax_number`='$fax_number', 
`website_address`='$website_address', 
`cr_number`='$cr_number',
`cr_legal_type`='$cr_legal_type',
`cr_registration_date`='$cr_registration_date', 
`cr_expiry_date`='$cr_expiry_date',
`cr_tax_registration_number`='$cr_tax_registration_number',
`user_email`='$user_email',
`password`='$password', 
`cpassword`='$cpassword', 
`business_type_product_category`='$business_type_product_category',
`number_of_employee`='$number_of_employee', 
`healthcare_status`='$healthcare_status',
`main_contact_status`='$main_contact_status',  
`status`='$status' 
 WHERE id='$view_id'";
$query4=mysqli_query($conn,$sql4)or die(mysqli_error($conn));
 
//echo $count;exit;

#echo "Select * from company_contacts_tbl where company_id='$view_id'";
if($count > 1)
{
  for($i=0; $i<$count; $i++)
{
if(trim($_POST["title"][$i] != ''))
{
  // echo "<pre>";
 //print_r($_POST);
  
    $sql5=mysqli_query($conn,"UPDATE `company_contacts_tbl` SET 
   `title`='".$title[$i]."',
   `first_name`='".$first_name[$i]."', 
   `last_name`='".$last_name[$i]."', 
   `job_title`='".$job_title[$i]."', 
   `email_id`='".$email_id[$i]."',
   `phone_number1`='".$phone_number1[$i]."',
   `status`='".$status."'
   WHERE company_id='".$view_id."' and id='".$cc_id[$i]."'"); 

   /*echo "UPDATE `company_contacts_tbl` SET 
   `title`='".$title[$i]."',
   `first_name`='".$first_name[$i]."', 
   `last_name`='".$last_name[$i]."', 
   `job_title`='".$job_title[$i]."', 
   `email_id`='".$email_id[$i]."',
   `phone_number1`='".$phone_number1[$i]."',
   `status`='".$status."'
   WHERE company_id='".$view_id."' and id='".$cc_id[$i]."'";
*/

}
}
}
 
$sql6=mysqli_query($conn,"UPDATE `order_tbl` SET `user_email`='$user_email',`status`='$status' WHERE company_id='$view_id'");

$mail = new PHPMailer(true);
             
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'negiharender.websutility@gmail.com';                    
    $mail->Password   = 'zywfbierinyqfedl';                             
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

  
    $mail->setFrom('negiharender.websutility@gmail.com', 'Barcode');
    $mail->addAddress($user_email);
    $mail->addAddress('negiharender.websutility@gmail.com');
                 


    $mail->isHTML(true);                                 
    $mail->Subject = 'Barcode';
    $mail->Body    = $email_temp;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
if($mail->send()){


}

else {
echo $mail->Errorinfo; 
echo "<script>alert('Enter valid email.')</script>";

 }



echo "<script>window.location='show.php?page=REV';</script>";
$_SESSION['message']="Record Updated Successfully";

 echo "<script>window.location='show.php?page=REV';</script>";
 
}

 
}

//Update Data ....wrap



$cumpany_sql=mysqli_query($conn,"SELECT * FROM company_tbl WHERE id='".$view_id."'");
$company_row=mysqli_fetch_assoc($cumpany_sql);
@extract($company_row);

//// company Contact data /////
$cumpany_contact_sql=mysqli_query($conn,"SELECT * FROM company_contacts_tbl WHERE company_id='".$view_id."'");
#$cumpany_contact_row=mysqli_fetch_assoc($cumpany_contact_sql);

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
<form method="post" enctype="multipart/form-data">
<div class="content-wrapper">
<div class="row justify-content-center gutters">

<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">

<div class="card m-0">
<div class="card-header">
<h3>COMPANY DETAILS</h3>
<div class="card-body">
<div class="row gutters">
<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">

<div class="form-group">
<label for="inputName" class="col-form-label">Company Name English *</label>
<input type="text" class="form-control" id="gtin"  name="name" value="<?=$name?>" readonly>
</div> 

<div class="form-group">
<label for="inputName" class="col-form-label">Company Name Arabic *</label>
<input type="text" class="form-control"   name="name_ar" value="<?=$name_ar?>" readonly>
</div>


<div class="form-group">
<label for="inputName" class="col-form-label">PO Box *</label>
<input type="text" class="form-control"   name="pobox" value="<?=$pobox?>"readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Zip/Postal Code *</label>
<input type="text" class="form-control"   name="zipcode" value="<?=$zipcode?>" readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Address English *</label>
<input type="text" class="form-control"   name="address" value="<?=$address?>" readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Address Arabic *</label>
<input type="text" class="form-control"  name="address_ar"  value="<?=$address_ar?>" readonly >
</div>
 </div>

 
<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">                                   
<div class="form-group">
<label for="inputName" class="col-form-label">City *</label>
<input type="text" class="form-control"  name="city"  value="<?=$city?>" readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Country *</label>
<input type="text" class="form-control"  name="country"  value="<?=$country?>" readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Mobile Number *</label>
<input type="number" class="form-control"   name="mobile_number" value="<?=$mobile_number?>" readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Phone Number *</label>
<input type="number" class="form-control"   name="phone_number" value="<?=$phone_number?>" readonly>
</div>


<div class="form-group">
<label for="inputName" class="col-form-label">Fax Number</label>
<input type="text" class="form-control"   name="fax_number" value="<?=$fax_number?>" readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Website Address</label>
<input type="text" class="form-control"   name="website_address" value="<?=$website_address?>" readonly >
</div>

</div>



</div>
</div>
</div>
</div>


</div>
<!--col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6-->


<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">

<div class="card m-0">
<div class="card-header">
<h3>CR DETAILS/LOGIN DETAILS/BUSINESS TYPE</h3>
<div class="card-body">
<div class="row gutters">
<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">


<div class="form-group">
<label for="inputName" class="col-form-label">Company Registration No*</label>
<input type="text" class="form-control" name="cr_number" value="<?=$cr_number?>" readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Legal Type *</label>
<input type="text" class="form-control" name="cr_legal_type" value="<?=$cr_legal_type?>" readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">CR Registration Date</label>
<input type="date" class="form-control" name="cr_registration_date" value="<?=$cr_registration_date?>" readonly>
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">CR Expiry Date</label>
<input type="date" class="form-control" name="cr_expiry_date" value="<?=$cr_expiry_date?>" readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Tax Registration text</label>
<input type="text" class="form-control" name="cr_tax_registration_number" value="<?=$cr_tax_registration_number?>" readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Chamber of Commercial Certificate</label> <a href="<?=$upload_document2?>" download><span class="badge badge-success">Download</span></a>
<input type="text" class="form-control" name="upload_document2" value="<?php
$path3=$base_url."images/Upload/";
echo str_replace($path3, '', $upload_document2);?>" readonly>
</div>

</div>

<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">                                   

<div class="form-group">
<label for="inputName" class="col-form-label">User Name *</label>
<input type="text" class="form-control"   name="user_email" value="<?=$user_email?>" readonly>
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Password *</label>
<input type="text" class="form-control" name="password" value="<?=$cpassword?>" readonly >
</div>


 <div class="form-group">
 <label for="inputName" class="col-form-label">Main Product Category *</label>
<input type="text" class="form-control" name="business_type_product_category" value="<?=$business_type_product_category?>" readonly >
 </div> 

 <div class="form-group">
 <label for="inputName" class="col-form-label">text of Employees</label>
 <input type="text" class="form-control"   name="number_of_employee" value="<?=$number_of_employee?>" readonly>
 </div>

<div class="form-group">
<label for="inputName" class="col-form-label">Commercial Registration</label><a href="<?=$upload_document1?>" download><span class="badge badge-success">Download</span></a>
<input type="text" class="form-control" name="upload_document1" value="<?php
$path3=$base_url."images/Upload/";
echo str_replace($path3, '', $upload_document1);?>" readonly>
</div>


<div class="form-group">
<label for="inputName" class="col-form-label">Other Documnets</label><a href="<?=$upload_document3?>" download><span class="badge badge-success">Download</span></a>
<input type="text" class="form-control" name="upload_document3" value="<?php
$path3=$base_url."images/Upload/";
echo str_replace($path3, '', $upload_document3);?>" readonly>


</div>







</div>



</div>
</div>
</div>
</div>


</div>

<!--col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 --->



<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

<div class="card m-0">
<div class="card-header">
<h3>COMPANY CONTACTS MINIMUM 2 PERSONS</h3>
<div class="card-body">
<div class="row gutters">
<?php
$n=1;
foreach($cumpany_contact_sql as $cumpany_contact_fire){

?>
<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
<h4><?php echo $n; $n++;?> Person</h4>
<div class="form-group">
<label for="inputName" class="col-form-label">Title *</label>
<input type="text" class="form-control" name="title[]" value="<?=$cumpany_contact_fire['title']?>" readonly>
</div>
<input type="hidden" class="form-control"  name="id[]"  value="<?=$cumpany_contact_fire['id']?>" >
<div class="form-group">
<label for="inputName" class="col-form-label">First Name</label>
<input type="text" class="form-control" name="first_name[]"  value="<?=$cumpany_contact_fire['first_name']?>" readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Last Name</label>
<input type="text" class="form-control" name="last_name[]" value="<?=$cumpany_contact_fire['last_name']?>" readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Job Title</label>
<input type="text" class="form-control" name="job_title[]" value="<?=$cumpany_contact_fire['title']?>" readonly>
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Email Id</label>
<input type="email" class="form-control"   name="email_id[]" value="<?=$cumpany_contact_fire['email_id']?>" readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Phone Number</label>
<input type="text" class="form-control" name="phone_number1[]"   value="<?=$cumpany_contact_fire['phone_number1']?>" readonly >
</div>


</div>
<?php } ?>
<div class="form-group">
<label for="inputName" class="col-form-label">Is this main contact?</label>
<div class="col-md-12">
<input type="radio" name="main_contact_status" value="Yes"<?=($main_contact_status=='Yes')?'checked':'';?> class="tick" readonly> &nbsp; Yes 
<input type="radio" name="main_contact_status" value="No" <?=($main_contact_status=='No')?'checked':'';?> class="tick" readonly> &nbsp; No
</div>
</div>



</div>
</div>
</div>
</div>


</div>
<!--col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  -->


<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

<div class="card m-0">
<div class="card-header">
<h3>Status</h3>
<div class="card-body">
<div class="row gutters">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

<div class="form-group">
<label for="inputSubject" class="col-form-label">Status</label>
<input type="text" class="form-control" name="status"   value="<?=$status?>" readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">ARE YOU IN HEALTHCARE?</label>
<div class="col-md-12">
<input type="radio" name="healthcare_status" value="Yes"<?=($healthcare_status=='Yes')?'checked':'';?> class="tick" readonly> &nbsp; Yes 
<input type="radio" name="healthcare_status" value="No" <?=($healthcare_status=='No')?'checked':'';?> class="tick" readonly> &nbsp; No
</div>
</div>

<div class="row gutters">
<div class="col-xl-12">
<a href="registration.php?page=REV"><input type="button" name="cancel" class="btn btn-warning" value="Back"></a>
</div>
</div>


</div>

</div>
</div>
</div>
</div>


</div>

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