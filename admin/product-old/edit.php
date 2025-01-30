<?php

include("../include/function.php");
if($_SESSION['email']=="")
{
header('../location:login.php');
}
$view_id=$_GET['view_id'];
$id=$_GET['id'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['submit']))
{
$product_name=$_POST['product_name'];
$prefix_num=$_POST['prefix_num'];
$gln_number=$_POST['gln_number'];
$gtins_name=$_POST['gtins_name'];
$annual_subscription_fee=$_POST['annual_subscription_fee'];
$annual_total_price=$_POST['annual_total_price'];
$status=$_POST['status'];

// Form Submit Start 
$cumpany_sql1=mysqli_query($conn,"SELECT * FROM order_tbl WHERE company_id='".$view_id."' AND id='".$id."'");
$company_row1=mysqli_fetch_assoc($cumpany_sql1);
$order_date=$company_row1['order_date'];
$expired_date="31-12-2022";

$user_sql=mysqli_query($conn,"SELECT * FROM company_tbl WHERE id='".$view_id."'");
$user_row=mysqli_fetch_assoc($user_sql);
$company_name=$user_row['name'];
$company_address=$user_row['address'];
$pobox=$user_row['pobox'];
$zipcode=$user_row['zipcode'];
$city=$user_row['city'];
$country=$user_row['country'];

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
<a target="_blank" style="text-decoration: none;"href=""><img border="0" vspace="0" hspace="0" src="'.$base_url.'images/logo.png"  style="width:100%; max-width: 200px;"/></a>
</td>
</tr>


   
<tr>
<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%;  font-size: 20px; font-weight:bold; padding-top:25px;font-family: sans-serif;" class="header">';


if($status==0){
  $email_temp.='<span style="color:#ff9900">Once your order is approved, you can use this project.</span>'; 
}
elseif($status==1){
$email_temp.='<span style="color:#009900">Your Order is Approved successfully</span>'; 
}
elseif($status==2){
$email_temp.='<span style="color:#cc0000">Your Order request is Rejected !</span>'; 
}
elseif($status==3){
$email_temp.='<span style="color:#ff0000">Your Order is disabled or block for the short the period</span>'; 
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
                  <b style="color: #333333;">Order Details</b><br/>
                  <li>Product Name: &nbsp; '.$product_name.'</li>
                  <li>Gtins Name: &nbsp; '.$gtins_name.'</li>
                  <li>Annual Subscription Fee: &nbsp; '.$annual_subscription_fee.'</li>
                  <li>Annual Total Fee: &nbsp; '.$annual_total_price.'</li>
                  
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
               href="'.$base_url.'user">
                  Login to GS1 Oman
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

$font="Lato-Bold.ttf";
$font1="Lato-Regular.ttf";
   $image=imagecreatefromjpeg("ct.jpeg");
   $color=imagecolorallocate($image,242,98,52);
  
   imagettftext($image,14,0,595,380,$color,$font,$prefix_num);

   imagettftext($image,14,0,835,462,$color,$font,$gln_number);

   imagettftext($image,12,0,450,500,$color,$font,$order_date);

   imagettftext($image,12,0,775,500,$color,$font,$expired_date);

   imagettftext($image,12,0,363,285,$color,$font1,$company_name);

   imagettftext($image,12,0,363,305,$color,$font1,$pobox);

   imagettftext($image,12,0,418,305,$color,$font1,$zipcode);

   imagettftext($image,12,0,363,325,$color,$font1,$company_address);

   imagettftext($image,12,0,363,345,$color,$font1,$city);

   imagettftext($image,12,0,430,345,$color,$font1,$country);


   $file=time();
   $file_path="../../certificate/".$file.".jpg";
   $file_path_pdf="../../certificate/".$file.".pdf";
   $c_img_path=substr($file_path,6);
   $c_pdf_path=substr($file_path_pdf,6);
   imagejpeg($image,$file_path);
   imagedestroy($image);

   require('fpdf.php');
   $pdf=new FPDF();
   $pdf->AddPage();
   $pdf->Image($file_path,0,0,210,150);
   $pdf->Output($file_path_pdf,"F");

   

 
if(isset($_GET['view_id']))
{
  


 $sql4="UPDATE `order_tbl` SET `prefix_num`='$prefix_num', `gln_number`='$gln_number', `certificate_img`='$c_img_path', `certificate_pdf`='$c_pdf_path', `status`='$status' WHERE company_id='".$view_id."' && id='".$id."' ";
$query4=mysqli_query($conn,$sql4)or die(mysqli_error($conn));
 
if($query4){
$sql6=mysqli_query($conn,"SELECT * FROM order_tbl WHERE company_id='$view_id'");
$fetched_records=mysqli_fetch_assoc($sql6);
$user_email=$fetched_records['user_email'];


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
    $mail->Subject = 'New Order';
    $mail->Body    = $email_temp;
    $mail->addAttachment($file_path_pdf);
    $mail->addAttachment($file_path);
    $mail->SMTPOptions=array("ssl"=>array(
      "verify_peer"=>false,
      "verify_peer_name"=>false,
      "allow_self_signed"=>false,
   ));
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
if($mail->send()){


}

else {
echo $mail->Errorinfo; 
echo "<script>alert('Enter valid email.')</script>";

 }



echo "<script>window.location='show.php?page=PROT';</script>";
$_SESSION['message']="Record Updated Successfully";

 echo "<script>window.location='show.php?page=PROT';</script>";
 
}

}
 


 
}

//Update Data ....wrap





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
<?php 
$cumpany_sql=mysqli_query($conn,"SELECT * FROM order_tbl WHERE company_id='".$view_id."' AND id='".$id."'");
$company_row=mysqli_fetch_assoc($cumpany_sql);
@extract($company_row);

//// company Contact data /////
$product_sql=mysqli_query($conn,"SELECT * FROM product_tbl WHERE id='".$product_id."'");
$product_row=mysqli_fetch_assoc($product_sql);
?>


<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">


<div class="form-group">
<label for="inputName" class="col-form-label">Product Name</label>
<input type="text" class="form-control" name="product_name" value="<?=$product_row['product_name'];?>" readonly>
</div> 

<div class="form-group">
<label for="inputName" class="col-form-label">Registration Fees</label>
<input type="text" class="form-control"   name="name_ar" value="<?=$company_row['registration_fee'];?>" readonly>
</div>


<div class="form-group">
<label for="inputName" class="col-form-label">Gln Annual Fee</label>
<?php
if($company_row['gln_price']!=''){
echo'<input type="text" class="form-control"   value="'.$company_row['gln_price'].'"readonly >';
}
else{
   echo'<input type="text" class="form-control"  value="Not Selected" readonly >';
}
?>
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Annual Subscription Fee</label>
<input type="text" class="form-control"  name="annual_subscription_fee"  value="<?=$annual_subscription_fee;?>" readonly >
</div>



</div>




<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">

<div class="form-group">
<label for="inputName" class="col-form-label">Gtins Name</label>
<input type="text" class="form-control" name="gtins_name"  value="<?=$product_row['gtins_name'];?>" readonly >
</div>



<div class="form-group">
<label for="inputName" class="col-form-label">Gtins Annual Fee</label>
<input type="text" class="form-control"   value="<?=$company_row['gtins_annual_fee'];?>" readonly >
</div>


<div class="form-group">
<label for="inputName" class="col-form-label">SSCC Annual Fee</label>
<?php
if($company_row['sscc_price']!=''){
echo'<input type="text" class="form-control"    value="'.$company_row['sscc_price'].'"readonly >';
}
else{
   echo'<input type="text" class="form-control"  value="Not Selected" readonly >';
}
?>
</div>



<div class="form-group">
<label for="inputName" class="col-form-label">Annual Total Price</label>
<input type="text" class="form-control"  name="annual_total_price"  value="<?=$annual_total_price;?>" readonly >
</div>




</div>

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
<h3>Required Order Details<span style="color:red; ">*</span></h3>

<div class="form-group">
<label for="inputName" class="col-form-label">Prefix Number<span style="color:red; ">*</span></label>
<input type="text" class="form-control" name="prefix_num" value="<?=$company_row['prefix_num'];?>" placeholder="Enter Prefix Number" required="" >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Gln Number<span style="color:red; ">*</span></label>
<input type="text" class="form-control" name="gln_number" value="<?=$company_row['gln_number'];?>"  placeholder="Enter Gln Number" required="" >
</div>

<div class="form-group">
<label for="inputSubject" class="col-form-label">Status</label>
<select name="status" class="form-control">
<option value="0"<?=($status=='0')?'selected':'';?>>Pending Approval</option>
<option value="1"<?=($status=='1')?'selected':'';?>>Approved</option>
<option value="2"<?=($status=='2')?'selected':'';?>>Rejected</option>
<option value="3"<?=($status=='3')?'selected':'';?>>Disabled</option>
</select>
</div>

</div>

<div class="row gutters">
<div class="col-xl-12">
<input type="submit" id="submit" name="submit" class="btn btn-primary" value="Update">
<a href="show.php?page=PROT"><input type="button" name="cancel" class="btn btn-warning" value="Back"></a>
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