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

 

}
}
}
 
$sql6=mysqli_query($conn,"UPDATE `order_tbl` SET `user_email`='$user_email',`status`='$status' WHERE company_id='$view_id'");

$mail = new PHPMailer(true);
             
     $mail->isSMTP(); 
	    #$mail->SMTPDebug = 2;
	    $mail->Host       = 'host33.theukhost.net';                     
	    $mail->SMTPAuth   = true;                                   
	    $mail->Username   = 'info@gs1oman.com';                    
	    $mail->Password   = '9rsE@+3M[f*&';                             
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
	    $mail->Port       = 465;                                    

	  
	    $mail->setFrom('info@gs1oman.com', 'Barcode');
	    $mail->addAddress($user_email);
	    $mail->addAddress('info@gs1oman.com');
                 


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



echo "<script>window.location='edit.php?view_id='.$view_id.'&&page=REV';</script>";
$_SESSION['message']="Account Updated Successfully";
$message=$_SESSION['message'];

 echo "<script>window.location='edit.php?view_id='.$view_id.'&&page=REV';</script>";
 
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
      <link rel="shortcut icon" href="<?=$base_url?><?=$rows_website['favicon']?>" />
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
<li><?php if(isset($_SESSION['message']))
                                    {
                                    message($message);   
                                    }
                                    unset($_SESSION['message']); ?></li>
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
<input type="text" class="form-control" id="gtin"  name="name" value="<?=$name?>">
</div> 

<div class="form-group">
<label for="inputName" class="col-form-label">Company Name Arabic *</label>
<input type="text" class="form-control"   name="name_ar" value="<?=$name_ar?>">
</div>


<div class="form-group">
<label for="inputName" class="col-form-label">PO Box *</label>
<input type="text" class="form-control"   name="pobox" value="<?=$pobox?>" >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Zip/Postal Code *</label>
<input type="text" class="form-control"   name="zipcode" value="<?=$zipcode?>" >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Address English *</label>
<input type="text" class="form-control"   name="address" value="<?=$address?>" >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Address Arabic *</label>
<input type="text" class="form-control"  name="address_ar"  value="<?=$address_ar?>" >
</div>
 </div>

 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">                                   
<div class="form-group">
<label for="inputName" class="col-form-label">City *</label>
<select class="form-control" name="city">
   <option selected disabled>Select City</option>
   <option value="Adam"<?=($city=='Adam')?'selected':'';?>>Adam   آدم</option>
   <option value="Al Ashkharah" <?=($city=='Al Ashkharah')?'selected':'';?>>Al Ashkharah الأشخرة</option>
   <option value="Al Buraimi" <?=($city=='Al Buraimi')?'selected':'';?>>Al Buraimi  البريمي</option>
   <option value="Al Hamra" <?=($city=='Al Hamra')?'selected':'';?>>Al Hamra   الحمراء</option>
<option value="Al Jazer" <?=($city=='Al Jazer')?'selected':'';?>>Al Jazer   الجزر</option>
<option value="Al Madina AZarqa" <?=($city=='Al Madina AZarqa')?'selected':'';?>>Al Madina A'Zarqa   المدينة الزرقاء</option>
<option value="Al Suwaiq" <?=($city=='Al Suwaiq')?'selected':'';?>>Al Suwaiq السويق</option>
<option value="As Sib" <?=($city=='As Sib')?'selected':'';?>>As Sib السيب</option>
<option value="Bahla" <?=($city=='Bahla')?'selected':'';?>>Bahla   بهلا</option>
<option value="Barka" <?=($city=='Barka')?'selected':'';?>>Barka   ولاية بركاء</option>
<option value="Bidbid" <?=($city=='Bidbid')?'selected':'';?>>Bidbid ولاية بدبد</option>
<option value="Bidiya" <?=($city=='Bidiya')?'selected':'';?>>Bidiya ولاية بدية</option>
<option value="Duqm" <?=($city=='Bidiya')?'selected':'';?>>Duqm  الدقم</option>
<option value="Haima" <?=($city=='Haima')?'selected':'';?>>Haima   ولاية هيما</option>
<option value="Ibra" <?=($city=='Ibra')?'selected':'';?>>Ibra  ولاية إبراء</option>
<option value="Ibri" <?=($city=='Ibri')?'selected':'';?>>Ibri  عبري</option>
<option value="Izki"  <?=($city=='Izki')?'selected':'';?>>Izki  ولاية إزكي</option>
<option value="Jabrin" <?=($city=='Jabrin')?'selected':'';?>>Jabrin جبرين</option>
<option value="Jalan Bani Bu Hassan" <?=($city=='Jalan Bani Bu Hassan')?'selected':'';?>>Jalan Bani Bu Hassan   ولاية جعلان بني بو حسن</option>
<option value="Khasab" <?=($city=='Khasab')?'selected':'';?>>Khasab ولاية خصب</option>
<option value="Mahooth" <?=($city=='Mahooth')?'selected':'';?>>Mahooth  ولاية محوت</option>
<option value="Manah" <?=($city=='Manah')?'selected':'';?>>Manah   ولاية منح</option>
<option value="Masirah" <?=($city=='Masirah')?'selected':'';?> >Masirah  جزيرة مصيرة</option>
<option value="Matrah" <?=($city=='Matrah')?'selected':'';?>>Matrah ولاية مطرح</option>
<option value="Mudhaireb" <?=($city=='Mudhaireb')?'selected':'';?>>Mudhaireb المضيرب</option>
<option value="Mudhaybi" <?=($city=='Mudhaybi')?'selected':'';?>>Mudhaybi   ولاية المضيبي</option>
                  <option value="Muscat" <?=($city=='Muscat')?'selected':'';?>>Muscat مسقط</option>
                  <option value="Nizwa" <?=($city=='Nizwa')?'selected':'';?>>Nizwa   ولاية نزوي</option>
                  <option value="Quriyat" <?=($city=='Nizwa')?'selected':'';?>>Quriyat  ولاية قريات</option>
                  <option value="Raysut" <?=($city=='Raysut')?'selected':'';?>>Raysut ريسوت</option>
                  <option value="Rustaq" <?=($city=='Rustaq')?'selected':'';?>>Rustaq ولاية الرستاق</option>
                  <option value="Ruwi" <?=($city=='Ruwi')?'selected':'';?>>Ruwi  روي</option>
                  <option value="Saham" <?=($city=='Saham')?'selected':'';?>>Saham   ولاية صحم</option>
                  <option value="Saiq  Saiq" <?=($city=='Saiq  Saiq')?'selected':'';?>>Saiq  Saiq</option>
                  <option value="Salalah" <?=($city=='Salalah')?'selected':'';?>>Salalah  صلالة</option>
                  <option value="Samail" <?=($city=='Samail')?'selected':'';?>>Samail ولاية سمائل</option>
                  <option value="Shinas" <?=($city=='Shinas')?'selected':'';?>>Shinas ولاية شناص</option>
                  <option value="Sohar" <?=($city=='Sohar')?'selected':'';?>>Sohar   صحار</option>
                  <option value="Sur" <?=($city=='Sur')?'selected':'';?>>Sur ولاية صور</option>
                  <option value="Tanam" <?=($city=='Tanam')?'selected':'';?>>Tan`am ولاية تنعم</option>
                  <option value="Thumrait" <?=($city=='Thumrait')?'selected':'';?>>Thumrait   ثمريت</option>
                  <option value="Other" <?=($city=='Other')?'selected':'';?>>Other   آخر</option>
</select>


</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Country *</label>
<select class="form-control" name="country" required>
                  <option selected disabled>Select Country</option>
                  <option value="Bahrain" <?=($country=='Bahrain')?'selected':'';?>>Bahrain</option>
                  <option value="Iran" <?=($country=='Iran')?'selected':'';?>>Iran</option>
                  <option value="Iraq" <?=($country=='Iraq')?'selected':'';?>>Iraq</option>
                  <option value="Kuwait" <?=($country=='Kuwait')?'selected':'';?>>Kuwait</option>
                  <option value="Oman" <?=($country=='Oman')?'selected':'';?>>Oman</option>
                  <option value="Qatar" <?=($country=='Qatar')?'selected':'';?>>Qatar</option>
                  <option value="Saudi Arabia" <?=($country=='Saudi Arabia')?'selected':'';?>>Saudi Arabia</option>
                  <option value="UAE" <?=($country=='UAE')?'selected':'';?>>UAE</option>
                  <option value="Yemen" <?=($country=='Yemen')?'selected':'';?>>Yemen</option>
               </select>

</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Mobile Number *</label>
<input type="number" class="form-control"   name="mobile_number" value="<?=$mobile_number?>" >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Phone Number *</label>
<input type="number" class="form-control"   name="phone_number" value="<?=$phone_number?>" >
</div>


<div class="form-group">
<label for="inputName" class="col-form-label">Fax Number</label>
<input type="text" class="form-control"   name="fax_number" value="<?=$fax_number?>" >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Website Address</label>
<input type="text" class="form-control"   name="website_address" value="<?=$website_address?>" >
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
<input type="text" class="form-control"   name="cr_number" value="<?=$cr_number?>" >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Legal Type *</label>
<select name="cr_legal_type" class="form-control" required>
<option disabled selected>Select Type</option>
<option value="General Partnership" <?=($cr_legal_type=='General Partnership')?'selected':'';?>>General Partnership</option>
<option value="Limited Partnership" <?=($cr_legal_type=='Limited Partnership')?'selected':'';?>>Limited Partnership</option>
<option value="Joint Venture" <?=($cr_legal_type=='Joint Venture')?'selected':'';?>>Joint Venture</option>
<option value="Joint Stock Company - closed SAOC" <?=($cr_legal_type=='Joint Stock Company - closed SAOC')?'selected':'';?>>Joint Stock Company - closed SAOC</option>
<option value="Joint Stock Company - public SAOG" <?=($cr_legal_type=='Joint Stock Company - public SAOG')?'selected':'';?>>Joint Stock Company - public SAOG </option>
<option value="Holding Company" <?=($cr_legal_type=='Holding Company')?'selected':'';?>>Holding Company</option>
<option value="Limited Liability Company - LLC" <?=($cr_legal_type=='Limited Liability Company - LLC')?'selected':'';?>>Limited Liability Company - LLC</option>
<option value="One-Person Company - Sole Proprietor Company" <?=($cr_legal_type=='One-Person Company - Sole Proprietor Company')?'selected':'';?>>One-Person Company - Sole Proprietor Company </option>
               </select>

</div>

<div class="form-group">
<label for="inputName" class="col-form-label">CR Registration Date</label>
<input type="date" class="form-control" name="cr_registration_date" value="<?=$cr_registration_date?>" >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">CR Expiry Date</label>
<input type="date" class="form-control" name="cr_expiry_date" value="<?=$cr_expiry_date?>" >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Tax Registration text</label>
<input type="text" class="form-control" name="cr_tax_registration_number" value="<?=$cr_tax_registration_number?>" >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">2nd Document</label><a href="<?=$upload_document2?>" download><span class="badge badge-success">Download</span></a>
<input type="file" class="form-control" name="upload_document2" value="<?=$upload_document2?>">
</div>

</div>

<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">                                   

<div class="form-group">
<label for="inputName" class="col-form-label">User Name *</label>
<input type="text" class="form-control"   name="user_email" value="<?=$user_email?>" >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Password *</label>
<input type="password" class="form-control"   name="password" value="<?=$cpassword?>" >
</div>


 <div class="form-group">
 <label for="inputName" class="col-form-label">Main Product Category *</label>

<select name="business_type_product_category" class="form-control" required>
<option disabled selected>Select Category</option>
<option value="Agriculture">Agriculture</option>
<option value="Agro machinery" <?=($business_type_product_category=='Agro machinery')?'selected':'';?>>Agro machinery</option>
<option value="Babyfood" <?=($business_type_product_category=='Babyfood')?'selected':'';?>>Babyfood</option>
<option value="Bakery Products" <?=($business_type_product_category=='Bakery Products')?'selected':'';?>>Bakery Products</option>
<option value="Bed Linen" <?=($business_type_product_category=='Bed Linen')?'selected':'';?>>Bed Linen</option>
<option value="Beverages" <?=($business_type_product_category=='Beverages')?'selected':'';?>>Beverages</option>
<option value="Biscuits" <?=($business_type_product_category=='Biscuits')?'selected':'';?>>Biscuits</option>
<option value="Bottled water" <?=($business_type_product_category=='Bottled water')?'selected':'';?>>Bottled water</option>
<option value="Bottles and Containers" <?=($business_type_product_category=='Bottles and Containers')?'selected':'';?>>Bottles and Containers</option>
<option value="Bread" <?=($business_type_product_category=='Bread')?'selected':'';?>>Bread</option>
<option value="Building Materials" <?=($business_type_product_category=='Building Materials')?'selected':'';?>>Building Materials</option>
<option value="Car care Accessories" <?=($business_type_product_category=='Car care Accessories')?'selected':'';?>>Car care Accessories</option>
<option value="Celular Phones" <?=($business_type_product_category=='Celular Phones')?'selected':'';?>>Celular Phones</option>
<option value="Chemicals" <?=($business_type_product_category=='Chemicals')?'selected':'';?>>Chemicals</option>
<option value="Chocolate" <?=($business_type_product_category=='Chocolate')?'selected':'';?>>Chocolate</option>
<option value="Cigarettes" <?=($business_type_product_category=='Cigarettes')?'selected':'';?>>Cigarettes</option>
<option value="Cleaning products" <?=($business_type_product_category=='Cleaning products')?'selected':'';?>>Cleaning products</option>
<option value="Clothing" <?=($business_type_product_category=='Clothing')?'selected':'';?>>Clothing</option>
<option value="Coffee" <?=($business_type_product_category=='Coffee')?'selected':'';?>>Coffee</option>
<option value="Computer software" <?=($business_type_product_category=='Computer software')?'selected':'';?>>Computer software</option>
<option value="Confectionery Products" <?=($business_type_product_category=='Confectionery Products')?'selected':'';?>>Confectionery Products</option>
<option value="Cosmetics" <?=($business_type_product_category=='Cosmetics')?'selected':'';?>>Cosmetics</option>
<option value="Crisps" <?=($business_type_product_category=='Crisps')?'selected':'';?>>Crisps</option>
<option value="Dairy Products" <?=($business_type_product_category=='Dairy Products')?'selected':'';?>>Dairy Products</option>
<option value="Dental Instruments" <?=($business_type_product_category=='Dental Instruments')?'selected':'';?>>Dental Instruments</option>
<option value="Detergents" <?=($business_type_product_category=='Detergents')?'selected':'';?> >Detergents</option>
<option value="Disinfectant" <?=($business_type_product_category=='Disinfectant')?'selected':'';?>>Disinfectant</option>
<option value="Disposable Polystrene Items" <?=($business_type_product_category=='Disinfectant')?'selected':'';?>>Disposable Polystrene Items</option>
<option value="Drinks" <?=($business_type_product_category=='Drinks')?'selected':'';?>>Drinks</option>
<option value="Eggs" <?=($business_type_product_category=='Eggs')?'selected':'';?>>Eggs</option>
<option value="Electric heaters" <?=($business_type_product_category=='Electric heaters')?'selected':'';?>>Electric heaters</option>
<option value="Fabrics" <?=($business_type_product_category=='Fabrics')?'selected':'';?>>Fabrics</option>
<option value="Fashion accessories" <?=($business_type_product_category=='Fashion accessories')?'selected':'';?>>Fashion accessories</option>
<option value="Food" <?=($business_type_product_category=='Food')?'selected':'';?>>Food</option>
<option value="Food Fish" <?=($business_type_product_category=='Food Fish')?'selected':'';?>>Food (Fish)</option>
<option value="Food and Drink" <?=($business_type_product_category=='Food Fish')?'selected':'';?>>Food and Drink</option>
<option value="Food Manufacturing" <?=($business_type_product_category=='Food Fish')?'selected':'';?>>Food Manufacturing</option>
<option value="Fresh Fruit" <?=($business_type_product_category=='Fresh Fruit')?'selected':'';?>>Fresh Fruit</option>
<option value="Fresh Produce" <?=($business_type_product_category=='Fresh Produce')?'selected':'';?>>Fresh Produce</option>
<option value="Fresh Vegetables" <?=($business_type_product_category=='Fresh Vegetables')?'selected':'';?>>Fresh Vegetables</option>
<option value="Frozen Fish" <?=($business_type_product_category=='Frozen Fish')?'selected':'';?>>Frozen Fish</option>
<option value="Fruit" <?=($business_type_product_category=='Fruit')?'selected':'';?>>Fruit</option>
<option value="Fruit drinks" <?=($business_type_product_category=='Fruit drinks')?'selected':'';?>>Fruit drinks</option>
<option value="Fruit Juice" <?=($business_type_product_category=='Fruit Juice')?'selected':'';?>>Fruit Juice</option>
<option value="Fruit vegetables" <?=($business_type_product_category=='Fruit vegetables')?'selected':'';?>>Fruit vegetables</option>
<option value="Hardware" <?=($business_type_product_category=='Hardware')?'selected':'';?>>Hardware</option>
<option value="Health and beauty" <?=($business_type_product_category=='Health and beauty')?'selected':'';?>>Health and beauty</option>
<option value="Healthcare equipment" <?=($business_type_product_category=='Healthcare equipment')?'selected':'';?>>Healthcare equipment</option>
<option value="Home Textiles" <?=($business_type_product_category=='Home Textiles')?'selected':'';?>>Home Textiles</option>
<option value="Household" <?=($business_type_product_category=='Household')?'selected':'';?>>Household </option>
<option value="Hygene Products" <?=($business_type_product_category=='Hygene Products')?'selected':'';?>>Hygene Products</option>
<option value="Ice-Cream" <?=($business_type_product_category=='Ice-Cream')?'selected':'';?>>Ice-Cream</option>
<option value="Industrial goods" <?=($business_type_product_category=='Industrial goods')?'selected':'';?>>Industrial goods</option>
<option value="IT" <?=($business_type_product_category=='IT')?'selected':'';?>>IT </option>
<option value="Jam" <?=($business_type_product_category=='Jam')?'selected':'';?>>Jam</option>
<option value="Macaroni" <?=($business_type_product_category=='Macaroni')?'selected':'';?>>Macaroni</option>
<option value="Mineral Water" <?=($business_type_product_category=='Mineral Water')?'selected':'';?>>Mineral Water</option>
<option value="Musical Record Production" <?=($business_type_product_category=='Musical Record Production')?'selected':'';?>>Musical Record Production</option>
<option value="Not Specified" <?=($business_type_product_category=='Not Specified')?'selected':'';?>>Not Specified</option>
<option value="Oil" <?=($business_type_product_category=='Oil')?'selected':'';?>>Oil</option>
<option value="Optical Industry" <?=($business_type_product_category=='Optical Industry')?'selected':'';?>>Optical Industry</option>
<option value="Others" <?=($business_type_product_category=='Others')?'selected':'';?>>Others</option>
<option value="Paper" <?=($business_type_product_category=='Paper')?'selected':'';?>>Paper</option>
<option value="Paper Products" <?=($business_type_product_category=='Paper Products')?'selected':'';?>>Paper Products</option>
<option value="Pasta" <?=($business_type_product_category=='Pasta')?'selected':'';?>>Pasta</option>
<option value="Pastry" <?=($business_type_product_category=='Pastry')?'selected':'';?>>Pastry</option>
<option value="Perfumes" <?=($business_type_product_category=='Perfumes')?'selected':'';?>>Perfumes</option>
<option value="Pharmaceutical" <?=($business_type_product_category=='Pharmaceutical')?'selected':'';?>>Pharmaceutical</option>
<option value="Postal Products" <?=($business_type_product_category=='Postal Products')?'selected':'';?>>Postal Products</option>
<option value="Powdered Milk" <?=($business_type_product_category=='Powdered Milk')?'selected':'';?>>Powdered Milk</option>
<option value="Pullover" <?=($business_type_product_category=='Pullover')?'selected':'';?>>Pullover</option>
<option value="Readymade garments" <?=($business_type_product_category=='Readymade garments')?'selected':'';?>>Readymade garments</option>
<option value="Rice" <?=($business_type_product_category=='Rice')?'selected':'';?> >Rice</option>
<option value="Sea Food" <?=($business_type_product_category=='Sea Food')?'selected':'';?>>Sea Food</option>
<option value="Snack Food" <?=($business_type_product_category=='Snack Food')?'selected':'';?>>Snack Food</option>
<option value="Soap" <?=($business_type_product_category=='Soap')?'selected':'';?>>Soap</option>
<option value="Soft drinks" <?=($business_type_product_category=='Soft drinks')?'selected':'';?>>Soft drinks</option>
<option value="Sports Balls <?=($business_type_product_category=='Sports Balls')?'selected':'';?>">Sports Balls (equipment)</option>
<option value="Sports equipment" <?=($business_type_product_category=='Sports equipment')?'selected':'';?>>Sports equipment</option>
<option value="Sports goods" <?=($business_type_product_category=='Sports goods')?'selected':'';?>>Sports goods</option>
<option value="Stationary" <?=($business_type_product_category=='Stationary')?'selected':'';?>>Stationary</option>
<option value="Sugar" <?=($business_type_product_category=='Sugar')?'selected':'';?>>Sugar</option>
<option value="Surgical Equipment" <?=($business_type_product_category=='Sugar')?'selected':'';?>>Surgical Equipment</option>
<option value="Sweets" <?=($business_type_product_category=='Sweets')?'selected':'';?>>Sweets</option>
<option value="Tea" <?=($business_type_product_category=='Tea')?'selected':'';?>>Tea</option>
<option value="Telecomm" <?=($business_type_product_category=='Telecomm')?'selected':'';?>>Telecomm</option>
<option value="Textile" <?=($business_type_product_category=='Textile')?'selected':'';?>>Textile</option>
<option value="Tissue Paper" <?=($business_type_product_category=='Tissue Paper')?'selected':'';?>>Tissue Paper</option>
<option value="Tobacco" <?=($business_type_product_category=='Tobacco')?'selected':'';?>>Tobacco</option>
<option value="Toiletries" <?=($business_type_product_category=='Toiletries')?'selected':'';?>>Toiletries</option>
<option value="Toothbrushes" <?=($business_type_product_category=='Toothbrushes')?'selected':'';?>>Toothbrushes</option>
<option value="Toys" <?=($business_type_product_category=='Toys')?'selected':'';?>>Toys</option>
<option value="Vegetable" <?=($business_type_product_category=='Vegetable')?'selected':'';?>>Vegetable </option>
<option value="vegetables conservation" <?=($business_type_product_category=='vegetables conservation')?'selected':'';?>>vegetables conservation</option>
<option value="Water" <?=($business_type_product_category=='Water')?'selected':'';?>>Water</option>
               </select>
 </div> 

 <div class="form-group">
 <label for="inputName" class="col-form-label">text of Employees</label>
 <input type="text" class="form-control"   name="number_of_employee" value="<?=$number_of_employee?>" >
 </div>

<div class="form-group">
<label for="inputName" class="col-form-label">1st Document</label><a href="<?=$upload_document1?>" download><span class="badge badge-success">Download</span></a>
<input type="file" class="form-control" name="upload_document1" value="<?=$upload_document1?>">
</div>


<div class="form-group">
<label for="inputName" class="col-form-label">3rd Document</label><a href="<?=$upload_document3?>" download><span class="badge badge-success">Download</span></a>
<input type="file" class="form-control" name="upload_document3" value="<?=$upload_document3?>">
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
<select class="form-control" name="title[]">
<option value="Mr." <?=($cumpany_contact_fire['title']=='Mr.')?'selected':'';?>>Mr.</option>
<option value="Mrs." <?=($cumpany_contact_fire['title']=='Mrs.')?'selected':'';?>>Mrs.</option>
<option value="Miss" <?=($cumpany_contact_fire['title']=='Miss')?'selected':'';?>>Miss</option>
<option value="Dr" <?=($cumpany_contact_fire['title']=='Dr')?'selected':'';?>>Dr.</option>
</select>
</div>
<input type="hidden" class="form-control"  name="id[]"  value="<?=$cumpany_contact_fire['id']?>" >
<div class="form-group">
<label for="inputName" class="col-form-label">First Name</label>
<input type="text" class="form-control"   name="first_name[]"  value="<?=$cumpany_contact_fire['first_name']?>" >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Last Name</label>
<input type="text" class="form-control"   name="last_name[]" value="<?=$cumpany_contact_fire['last_name']?>" >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Job Title</label>
<select class="form-control" name="job_title[]">
<option value="CEO." <?=($cumpany_contact_fire['job_title']=='CEO.')?'selected':'';?>>CEO.</option>
<option value="Staff." <?=($cumpany_contact_fire['job_title']=='Staff.')?'selected':'';?>>Staff.</option>
<option value="Accounts." <?=($cumpany_contact_fire['job_title']=='Accounts.')?'selected':'';?>>Accounts.</option>
</select>

</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Email Id</label>
<input type="email" class="form-control"   name="email_id[]" value="<?=$cumpany_contact_fire['email_id']?>" >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Phone Number</label>
<input type="text" class="form-control" name="phone_number1[]"   value="<?=$cumpany_contact_fire['phone_number1']?>" >
</div>


</div>
<?php } ?>
<div class="form-group">
<label for="inputName" class="col-form-label">Is this main contact?</label>
<div class="col-md-12">
<input type="radio" name="main_contact_status" value="Yes"<?=($main_contact_status=='Yes')?'checked':'';?> class="tick"> &nbsp; Yes 
<input type="radio" name="main_contact_status" value="No" <?=($main_contact_status=='No')?'checked':'';?> class="tick"> &nbsp; No
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
<div class="card-body">
<div class="row gutters">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">



<div class="form-group">
<label for="inputName" class="col-form-label">ARE YOU IN HEALTHCARE?</label>
<div class="col-md-12">
<input type="radio" name="healthcare_status" value="Yes"<?=($healthcare_status=='Yes')?'checked':'';?> class="tick"> &nbsp; Yes 
<input type="radio" name="healthcare_status" value="No" <?=($healthcare_status=='No')?'checked':'';?> class="tick"> &nbsp; No
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