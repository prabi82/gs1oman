<?php 
if(isset($_SESSION['message1']))
{
echo "
<div class='alert alert-danger text-center' role='alert'>".$_SESSION['message1']." <br><strong><a href='login.php'>Login here</a></strong></div>
";
}
unset($_SESSION['message1']);
?>

<?php 
include("admin/include/function.php");

error_reporting(0);
// Form Submit Start 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if(isset($_POST['submit']))
{
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
$tn=$_POST['tn'];
//COMPANY DETAILS WRAP

//Package Start
$product_id=$_POST['product_id'];
$product_name=$_POST['product_name'];
$registration_fee=$_POST['registration_fee'];
$gtins_annual_fee=$_POST['gtins_annual_fee'];
$gln_price=$_POST['gln_price'];
$sscc_price=$_POST['sscc_price'];
$annual_subscription_fee=$gtins_annual_fee+$gln_price+$sscc_price;
$annual_total_price=$registration_fee+$gtins_annual_fee+$gln_price+$sscc_price;
//Package wrap WRAP



//CR DETAILS START 
$cr_number=$_POST['cr_number'];
$cr_legal_type=$_POST['cr_legal_type'];
$cr_registration_date=$_POST['cr_registration_date'];
$cr_expiry_date=$_POST['cr_expiry_date'];
$cr_tax_registration_number=$_POST['cr_tax_registration_number'];
// CR DETAILS WRAP


//LOGIN DETAILS START 
$user_email=$_POST['user_email'];
$rand_pass = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$rand_shfl = str_shuffle($rand_pass);
$pwd = substr($rand_shfl,0,8);
$cpassword=$pwd;
$password=sha1($cpassword);

$business_type_product_category=$_POST['business_type_product_category'];
$number_of_employee=$_POST['number_of_employee'];
//LOGIN DETAILS WRAP

//Add More Persion 
$count = count($_POST["title"]);
$title=$_POST['title'];
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$job_title=$_POST['job_title'];
$email_id=$_POST['email_id'];
$phone_number1	=$_POST['phone_number1'];

//Add More More WRAP

//email Message start 
$variable = "<br>";
$message= "Once your application is approved, you will get  an activation email with the login details.";

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
<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%;  font-size: 20px; font-weight:bold; padding-top:25px;font-family: sans-serif;" class="header">

Thanks you for joining with us!

</td>
</tr>
	
<tr>
<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%; padding-top: 25px; color: #000000;font-family: sans-serif;" class="paragraph">

Once It will be approved by admin then you can login successfully.
</td>
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
						
						
				</td>

			</tr>

			<!-- LIST ITEM -->
			<tr>

				<!-- LIST ITEM IMAGE -->
				<!-- Image text color should be opposite to background color. Set your url, image src, alt and title. Alt text should fit the image size. Real image size should be x2 -->
				<td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0;
					padding-top: 30px;
					padding-right: 20px;"><img
				border="0" vspace="0" hspace="0" style="padding: 0; margin: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block;
					color: #000000;"
					src="https://raw.githubusercontent.com/konsav/email-templates/master/images/list-item.png"
					alt="D" title="Designer friendly"
					width="50" height="50"></td>

				<!-- LIST ITEM TEXT -->
				<!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->
				<td align="left" valign="top" style="font-size: 17px; font-weight: 400; line-height: 160%; border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;
					padding-top: 25px;
					color: #000000;
					font-family: sans-serif;" class="paragraph">
						<b style="color: #333333;">Product Package Purchase</b><br/>
						<li>Product Name: &nbsp; '.$product_name.'</li>
						<li>Registration_fee: &nbsp; '.$registration_fee.'</li>
						<li>Gtins Annual Fee: &nbsp; '.$gtins_annual_fee.'</li>
						<li>Annual Subscription Fee: &nbsp; '.$annual_subscription_fee.'</li>
						<li>Annual Total Fee: &nbsp; '.$annual_total_price.'</li>
				</td>

			</tr>

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
						GS1 Oman
					</a>
			</td>
			</tr>
			</table>
			</a>
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


// email Message Wrap



// Uploda Document Start 
//1st Document
$doc_name1=$_FILES['upload_document1']['name'];
$doc_tmp_name1=$_FILES['upload_document1']['tmp_name'];
$ext=pathinfo($_FILES['upload_document1']['name'],PATHINFO_EXTENSION);
$doc_path1=$base_url.'images/Upload/'.$doc_name1;




//2nd Document
$doc_name2=$_FILES['upload_document2']['name'];
$doc_tmp_name2=$_FILES['upload_document2']['tmp_name'];
$ext1=pathinfo($_FILES['upload_document2']['name'],PATHINFO_EXTENSION);
$doc_path2=$base_url.'images/Upload/'.$doc_name2;


//3rd Document
$doc_name3=$_FILES['upload_document3']['name'];
$doc_tmp_name3=$_FILES['upload_document3']['tmp_name'];
$ext2=pathinfo($_FILES['upload_document3']['name'],PATHINFO_EXTENSION);
$doc_path3=$base_url.'images/Upload/'.$doc_name3;

if(empty($doc_tmp_name1) || empty($doc_tmp_name2) || empty($doc_tmp_name3) )
{
$doc_path11="images/Upload/no-image.png";
$doc_path22="images/Upload/no-image.png";
$doc_path33="images/Upload/no-image.png";
}

//Upload Documnet Wrap 

//validation
$user_sql = "SELECT * FROM  company_tbl WHERE user_email='$user_email'";
$res=mysqli_query($conn, $user_sql);

if(mysqli_num_rows($res) > 0){
    /*$_SESSION['message1']="User Already exits";
    $message1=$_SESSION['message1'];*/ 

    echo "<script>alert('User Already exits')</script>";
  }

  else{
if(in_array($ext, ['pdf', 'jpeg', 'jpg','png']) || in_array($ext1, ['pdf', 'jpeg', 'jpg','png']) || in_array($ext2, ['pdf', 'jpeg', 'jpg','png'])){
move_uploaded_file($doc_tmp_name1,$doc_path1);
move_uploaded_file($doc_tmp_name2,$doc_path2);
move_uploaded_file($doc_tmp_name3,$doc_path3);
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
    $mail->Subject = 'Barcode:New Registration';
    $mail->Body    = $email_temp;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if($mail->send()){

 $sql="INSERT INTO `company_tbl`(product_id, product_name, registration_fee, gtins_annual_fee, gln_price, sscc_price,  annual_subscription_fee, 	annual_total_price,  name, name_ar, pobox, zipcode, address, address_ar, country, city, mobile_number, phone_number, fax_number, website_address, cr_number, cr_legal_type, cr_registration_date, cr_expiry_date, cr_tax_registration_number, user_email, password, cpassword, business_type_product_category, number_of_employee, upload_document1 , upload_document2, upload_document3, healthcare_status,main_contact_status,tnc, status) VALUES ('$product_id','$product_name', '$registration_fee', '$gtins_annual_fee', '$gln_price', '$sscc_price', '$annual_subscription_fee', '$annual_total_price',  '$name', '$name_ar', '$pobox', '$zipcode','$address', '$address_ar', '$country', '$city','$mobile_number', '$phone_number', '$fax_number', '$website_address','$cr_number','$cr_legal_type', '$cr_registration_date','$cr_expiry_date','$cr_tax_registration_number', '$user_email', '$password','$cpassword','$business_type_product_category','$number_of_employee', '$doc_path1','$doc_path2','$doc_path3','$healthcare_status','$main_contact_status','$tnc','0' )";
 $query=mysqli_query($conn,$sql)or die(mysqli_error($conn));

 
 if($query)
{

$company_id=mysqli_insert_id($conn);
$_SESSION['company_id']=$company_id;

if($count > 1)
{
for($i=0; $i<$count; $i++)
{
if(trim($_POST["title"][$i] != ''))
{
/*echo "INSERT INTO `company_contacts_tbl`(product_id ,company_id ,title, first_name ,last_name, job_title ,email_id, phone_number1 ,status) VALUES('$product_id','$company_id','$title[$i]','$first_name[$i]' ,'$last_name[$i]' ,'$job_title[$i]' ,'$email_id[$i]' ,'$phone_number1[$i]','$status[$i]')";*/

$sql1 =mysqli_query($conn,"INSERT INTO `company_contacts_tbl`(product_id ,company_id ,title, first_name ,last_name, job_title ,email_id, phone_number1 ,status) VALUES('$product_id','$company_id','$title[$i]','$first_name[$i]' ,'$last_name[$i]' ,'$job_title[$i]' ,'$email_id[$i]' ,'$phone_number1[$i]','0')");
		}
	}



$order_id = 'Barcode';
$order_id .= 1000+$company_id;
$order_date=date('Y-m-d');

 /*"INSERT INTO `order_tbl`(company_id ,order_id, product_id ,user_email, registration_fee ,gtins_annual_fee, gln_price ,sscc_price,annual_subscription_fee,annual_total_price,order_date,promo_code,status) VALUES('$company_id','$order_id','$product_id' ,'$user_email' ,'$registration_fee' ,'$gtins_annual_fee' ,'$gln_price','$sscc_price','$annual_subscription_fee','$annual_total_price','$order_date','$promo_code','1')";*/

$sql2 =mysqli_query($conn,"INSERT INTO `order_tbl`(company_id ,order_id,  product_id ,user_email, registration_fee ,gtins_annual_fee, gln_price ,sscc_price,annual_subscription_fee,annual_total_price,order_date,promo_code,status) VALUES('$company_id','$order_id','$product_id' ,'$user_email' ,'$registration_fee' ,'$gtins_annual_fee' ,'$gln_price','$sscc_price','$annual_subscription_fee','$annual_total_price','$order_date','$promo_code','0')");


echo "<script>window.location='thanks.php';</script>";

}




}



}


else {
echo $mail->Errorinfo; 
echo "<script>alert('Enter valid email.')</script>";

 }

}


  }

//else statement end....








}
// Form Submit Wrap








if(isset($_POST['action']) && $_POST['action']=='get_product_data'){
$product_id = $_POST['product_id'];
 $query = "SELECT * FROM product_tbl where id='".$product_id."' ORDER BY id ASC ";     
$rs_result = mysqli_query ($conn, $query);
$productData=mysqli_fetch_array($rs_result);
$annual_total_price=$productData['gtins_annual_fee'];
  
  ?>
      <div id="one" class="table table-responsive">
					  	<table class="table table-bordered table-striped">
					  		<tr>
					  			<td class="fw-bold">Product / Services </td>
					  			<td class="fw-bold">Registration Fee <span class="fo-12">One time</span></td>
					  			<td class="fw-bold">Annual Renewal</td>
					  		</tr>
					  		<tr>
					  			<input type="hidden" name="product_name" value="<?=$productData['product_name']?>">
					  			<input type="hidden" name="registration_fee" value="<?=$productData['registration_fee']?>">
					  			<input type="hidden" name="gtins_annual_fee" value="<?=$productData['gtins_annual_fee']?>">
					  			<td><?=$productData['product_name']?> </td>
					  			<td><?=$productData['registration_fee']?> </td>
					  			<td><?=$productData['gtins_annual_fee']?> </td>
					  		</tr>
					  	</table>
					  	
					  	<div style="clear: both;"></div>
            			<div class="row">
            			<h4 class="mt-3">DO YOU REQUIRED ADDITIONAL PRODUCTS</h4>
            				<div class="col-md-12">
            				    <div class="output">
            					  <div id="one" class="table table-responsive">
            					  	<table class="table table-bordered table-striped">
            					  		<tr>
            					  		    <td></td>
            					  			<td class="fw-bold">Product / Services </td>
            					  			<td class="fw-bold">Annual Renewal</td>
            					  		</tr>
<tr>
<td><input onclick="add()" type="checkbox"  name="gln_price" id="gln_price" value="<?=$productData['gln_annual_fee']?>"> </td>
<td>Do you require GLN? <span class="text-danger" data-toggle="tooltip" title="GTIN: Definition">!</span></td>
<td><span id="gln_price_span"><?=$productData['gln_annual_fee']?></span></td>
</tr>

<?php
if($productData['sscc_annual_fee']==0){

}
else{
	echo"<tr><td><input onclick='add()' type='checkbox' name='sscc_price' id='sscc_price' value='".$productData['sscc_annual_fee']."'> 
</td>
<td>Do you require SSCC? <span class='text-danger' data-toggle='tooltip' title='SSCC: Definition'>!</span></td>
<td><span id='sscc_price_span'>".$productData['sscc_annual_fee']."</span></td>
</tr>";
}


?>

</table>
            					  </div>
            					</div>
            				   
            				</div>
            			</div>
					  	
					  </div>
					  
					   <div class="row fee_table mt-3">
				<div class="col-md-4">
				    <label class="fw-bold">Registration Fee </label>
					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1">OMR</span>
					  
					    
					  <input type="text" id="registration_fee" name="registration_fee" class="form-control mb-0"  value="<?=$productData['registration_fee']?>" disabled>
					</div>
					<span class="fw-bold text-danger">Valid till 31st Dec 2022 </span>
				</div>

				<div class="col-md-4">
				    <label class="fw-bold">Annual Subscription Fee  </label>
					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1">OMR</span>
					  <!--<input type="number" id="total" class="form-control mb-0" >
					  <div id="total" class="form-control">500</div>-->
					 
					  <input type="hidden" name="annual_subscription_fee" id="annual_subscription_fee" value="<?=$productData['gtins_annual_fee']?>">
					  <input type="text" class="form-control mb-0" size="2" name="annual_total_price" id="annual_total_price" value="<?=$productData['gtins_annual_fee']?>" disabled/>
					</div>
					<span class="fw-bold text-danger">Next renewal Jan 2023 </span>
				</div>
				<div class="col-md-4">
				    <label class="fw-bold">Total Fee  </label>
					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1">OMR</span>
					 <input name="total_price" id="total_price" type="text" class="form-control mb-0"  value="<?=$productData['registration_fee']+$productData['gtins_annual_fee']?>" disabled>
					  <input class="form-control mb-0" disabled id="demo">
					</div>
				</div>
			</div>


            <div class="row d-none">
				<div class="col-md-12 text-center mt-3">
					<!--<a id="calculate_fee" class="btn btn-success">Calculate Membership Fee</a>-->
					<a id="calculate_fee" class="btn btn-success" onclick="add()">Calculate Membership Fee</a>
				</div>

				
			</div>
 <?php   
 exit;
}


include('header.php');
 ?>

<section class="user_registration">
	<div class="container">
		<form name="listForm" action="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="annual_total_price" value="<?=$annual_total_price?>">
			<h4>company details</h4>
			<div class="row">
				
				<div class="col-md-6">
					<label>Company Name English	*</label>
					<input type="text" class="form-control" name="name" placeholder="Company Name English" required>
				</div>
				<div class="col-md-6">
					<label>Company Name Arabic	*</label>
					<input type="text" class="form-control" name="name_ar" placeholder="Company Name Arabic" required>
				</div>
				<div class="col-md-6">
					<label>PO Box	*</label>
					<input type="text" class="form-control" name="pobox" placeholder="P.O. Box 000" required>
				</div>
				<div class="col-md-6">
					<label>Zip/Postal Code	*</label>
					<input type="number" class="form-control" name="zipcode" placeholder="123" required>
				</div>
				<div class="col-md-6">
					<label>Address English	*</label>
					<input type="text" class="form-control" name="address" placeholder="Office Number, Bld No, Way No, Town" required>
				</div>
				<div class="col-md-6">
					<label>Address Arabic	*</label>
					<input type="text" class="form-control" name="address_ar" placeholder="Office Number, Bld No, Way No, Town" required>
				</div>

       <div class="col-md-6">
					<label>Country *</label>
					<select class="form-control" name="country" required>
						<option selected disabled>Select Country</option>
						<option value="Bahrain">Bahrain</option>
						<option value="Iran">Iran</option>
						<option value="Iraq">Iraq</option>
						<option value="Kuwait">Kuwait</option>
						<option value="Oman">Oman</option>
						<option value="Qatar">Qatar</option>
						<option value="Saudi Arabia">Saudi Arabia</option>
						<option value="UAE">UAE</option>
						<option value="Yemen">Yemen</option>
					</select>
				</div>


				<div class="col-md-6">
					<label>City	*</label>
					<select class="form-control" name="city">
						<option selected disabled>Select City</option>
					  <option value="Adam">Adam	آدم</option>
						<option value="Al Ashkharah">Al Ashkharah	الأشخرة</option>
						<option value="Al Buraimi">Al Buraimi	البريمي</option>
						<option value="Al Hamra">Al Hamra	الحمراء</option>
						<option value="Al Jazer">Al Jazer	الجزر</option>
						<option value="Al Madina A'Zarqa">Al Madina A'Zarqa	المدينة الزرقاء</option>
						<option value="Al Suwaiq">Al Suwaiq	السويق</option>
						<option value="As Sib">As Sib	السيب</option>
						<option value="Bahla">Bahla	بهلا</option>
						<option value="Barka">Barka	ولاية بركاء</option>
						<option value="Bidbid">Bidbid	ولاية بدبد</option>
						<option value="Bidiya">Bidiya	ولاية بدية</option>
						<option value="Duqm">Duqm	الدقم</option>
						<option value="Haima">Haima	ولاية هيما</option>
						<option value="Ibra">Ibra	ولاية إبراء</option>
						<option value="Ibri">Ibri	عبري</option>
						<option value="Izki">Izki	ولاية إزكي</option>
						<option value="Jabrin">Jabrin	جبرين</option>
						<option value="Jalan Bani Bu Hassan">Jalan Bani Bu Hassan	ولاية جعلان بني بو حسن</option>
						<option value="Khasab">Khasab	ولاية خصب</option>
						<option value="Mahooth">Mahooth	ولاية محوت</option>
						<option value="Manah">Manah	ولاية منح</option>
						<option value="Masirah">Masirah	جزيرة مصيرة</option>
						<option value="Matrah">Matrah	ولاية مطرح</option>
						<option value="Mudhaireb">Mudhaireb	المضيرب</option>
						<option value="Mudhaybi">Mudhaybi	ولاية المضيبي</option>
						<option value="Muscat">Muscat	مسقط</option>
						<option value="Nizwa">Nizwa	ولاية نزوي</option>
						<option value="Quriyat">Quriyat	ولاية قريات</option>
						<option value="Raysut">Raysut	ريسوت</option>
						<option value="Rustaq">Rustaq	ولاية الرستاق</option>
						<option value="Ruwi">Ruwi	روي</option>
						<option value="Saham">Saham	ولاية صحم</option>
						<option value="Saiq	Saiq">Saiq	Saiq</option>
						<option value="Salalah">Salalah	صلالة</option>
						<option value="Samail">Samail	ولاية سمائل</option>
						<option value="Shinas">Shinas	ولاية شناص</option>
						<option value="Sohar">Sohar	صحار</option>
						<option value="Sur">Sur	ولاية صور</option>
						<option value="Tan`am">Tan`am	ولاية تنعم</option>
						<option value="Thumrait">Thumrait	ثمريت</option>
						<option value="Other">Other	آخر</option>

					</select>
				</div>
				
				<div class="col-md-6">
					<label>Mobile Number *</label>
					<input type="number" class="form-control" name="mobile_number" placeholder="+968 0000 0000" required>
				</div>
				<div class="col-md-6">
					<label>Phone Number *</label>
					<input type="number" class="form-control" name="phone_number" placeholder="+968 0000 0000" required>
				</div>
				<div class="col-md-6">
					<label>Fax Number</label>
					<input type="number" class="form-control" name="fax_number" placeholder="+968 0000 0000">
				</div>
				<div class="col-md-6">
					<label>Website Address</label>
					<input type="text" class="form-control" name="website_address" placeholder="www.gs1oman.org">
				</div>
			</div>

			<hr>

			<h4>cr details</h4>
			<div class="row">
				<div class="col-md-6">
					<label>Company Registration Number (CR No.): *</label>
					<input type="number" class="form-control" name="cr_number" placeholder="CR Number" required>
				</div>
				<div class="col-md-6">
					<label>Legal Type *</label>
					<div style="clear: both;"></div>
					<select name="cr_legal_type" required>
						<option disabled selected>Select Type</option>
						<option value="General Partnership">General Partnership</option>
						<option value="Limited Partnership">Limited Partnership</option>
						<option value="Joint Venture">Joint Venture</option>
						<option value="Joint Stock Company - closed SAOC">Joint Stock Company - closed SAOC</option>
						<option value="Joint Stock Company - public SAOG">Joint Stock Company - public SAOG </option>
						<option value="Holding Company">Holding Company</option>
						<option value="Limited Liability Company - LLC">Limited Liability Company - LLC</option>
						<option value="One-Person Company - Sole Proprietor Company">One-Person Company - Sole Proprietor Company </option>
					</select>
				</div>
				<div class="col-md-4">
					<label>CR Registration Date</label>
					<input type="date" class="form-control" name="cr_registration_date">
				</div>
				<div class="col-md-4">
					<label>CR Expiry Date</label>
					<input type="date" id="date_picker" class="form-control" name="cr_expiry_date">
				</div>
				<div class="col-md-4">
					<label>Tax Registration Number</label>
					<input type="number" class="form-control" name="cr_tax_registration_number" placeholder="Tax Registration Number">
				</div>
			</div>
			<hr>

			<h4>login details</h4>
			<div class="row">
				<div class="col-md-6">
					<label>User Name *</label>
					<input type="text" class="form-control" placeholder="user@email.com" name="user_email" required>
				</div>
				<div class="col-md-6">
					<label>Password *</label>
					<input type="password" class="form-control" placeholder="Password" name="password" required>
				</div>
				
			</div>

			<hr>

			<h4>business type</h4>
			<div class="row">
				<div class="col-md-6">
					<label>Main Product Category *</label>
					<select name="business_type_product_category" required>
						<option disabled selected>Select Category</option>
							<option value="Agriculture" >Agriculture</option>
							<option value="Agro machinery">Agro machinery</option>
							<option value="Babyfood">Babyfood</option>
							<option value="Bakery Products">Bakery Products</option>
							<option value="Bed Linen">Bed Linen</option>
							<option value="Beverages">Beverages</option>
							<option value="Biscuits">Biscuits</option>
							<option value="Bottled water">Bottled water</option>
							<option value="Bottles and Containers">Bottles and Containers</option>
							<option value="Bread">Bread</option>
							<option value="Building Materials">Building Materials</option>
							<option value="Car care Accessories">Car care Accessories</option>
							<option value="Celular Phones">Celular Phones</option>
							<option value="Chemicals">Chemicals</option>
							<option value="Chocolate">Chocolate</option>
							<option value="Cigarettes">Cigarettes</option>
							<option value="Cleaning products">Cleaning products</option>
							<option value="Clothing">Clothing</option>
							<option value="Coffee">Coffee</option>
							<option value="Computer software">Computer software</option>
							<option value="Confectionery Products">Confectionery Products</option>
							<option value="Cosmetics">Cosmetics</option>
							<option value="Crisps">Crisps</option>
							<option value="Dairy Products">Dairy Products</option>
							<option value="Dental Instruments">Dental Instruments</option>
							<option value="Detergents">Detergents</option>
							<option value="Disinfectant">Disinfectant</option>
							<option value="Disposable Polystrene Items">Disposable Polystrene Items</option>
							<option value="Drinks">Drinks</option>
							<option value="Eggs">Eggs</option>
							<option value="Electric heaters">Electric heaters</option>
							<option value="Fabrics">Fabrics</option>
							<option value="Fashion accessories">Fashion accessories</option>
							<option value="Food">Food</option>
							<option value="Food (Fish">Food (Fish)</option>
							<option value="Food and Drink">Food and Drink</option>
							<option value="Food Manufacturing">Food Manufacturing</option>
							<option value="Fresh Fruit">Fresh Fruit</option>
							<option value="Fresh Produce">Fresh Produce</option>
							<option value="Fresh Vegetables">Fresh Vegetables</option>
							<option value="Frozen Fish">Frozen Fish</option>
							<option value="Fruit">Fruit</option>
							<option value="Fruit drinks">Fruit drinks</option>
							<option value="Fruit Juice">Fruit Juice</option>
							<option value="Fruit vegetables">Fruit vegetables</option>
							<option value="Hardware">Hardware</option>
							<option value="Health and beauty">Health and beauty</option>
							<option value="Healthcare equipment">Healthcare equipment</option>
							<option value="Home Textiles">Home Textiles</option>
							<option value="Household">Household </option>
							<option value="Hygene Products">Hygene Products</option>
							<option value="Ice-Cream">Ice-Cream</option>
							<option value="Industrial goods">Industrial goods</option>
							<option value="IT">IT </option>
							<option value="Jam">Jam</option>
							<option value="Macaroni">Macaroni</option>
							<option value="Mineral Water">Mineral Water</option>
							<option value="Musical Record Production">Musical Record Production</option>
							<option value="Not Specified">Not Specified</option>
							<option value="Oil">Oil</option>
							<option value="Optical Industry">Optical Industry</option>
							<option value="Others">Others</option>
							<option value="Paper">Paper</option>
							<option value="Paper Products">Paper Products</option>
							<option value="Pasta">Pasta</option>
							<option value="Pastry">Pastry</option>
							<option value="Perfumes">Perfumes</option>
							<option value="Pharmaceutical">Pharmaceutical</option>
							<option value="Postal Products">Postal Products</option>
							<option value="Powdered Milk">Powdered Milk</option>
							<option value="Pullover">Pullover</option>
							<option value="Readymade garments">Readymade garments</option>
							<option value="Rice">Rice</option>
							<option value="Sea Food">Sea Food</option>
							<option value="Snack Food">Snack Food</option>
							<option value="Soap">Soap</option>
							<option value="Soft drinks">Soft drinks</option>
							<option value="Sports Balls (equipment)">Sports Balls (equipment)</option>
							<option value="Sports equipment">Sports equipment</option>
							<option value="Sports goods">Sports goods</option>
							<option value="Stationary">Stationary</option>
							<option value="Sugar">Sugar</option>
							<option value="Surgical Equipment">Surgical Equipment</option>
							<option value="Sweets">Sweets</option>
							<option value="Tea">Tea</option>
							<option value="Telecomm">Telecomm</option>
							<option value="Textile">Textile</option>
							<option value="Tissue Paper">Tissue Paper</option>
							<option value="Tobacco">Tobacco</option>
							<option value="Toiletries">Toiletries</option>
							<option value="Toothbrushes">Toothbrushes</option>
							<option value="Toys">Toys</option>
							<option value="Vegetable">Vegetable </option>
							<option value="vegetables conservation">vegetables conservation</option>
						<option value="Water">Water</option>
					</select>
				</div>
				<div class="col-md-6">
					<label>Number of Employees</label>
					<input type="number" class="form-control" name="number_of_employee">
				</div>
			</div>
			
			<hr>
			
			<h4>Are you in Healthcare?</h4>
			<div class="row">
			    <div class="col-md-12">
			        <label>Are you in identifying medical devices, which fall under the U.S. Food and Drug Administration (FDA) or Unique Device Identification System (UDI)? <span class="text-danger" data-toggle="tooltip" title="The U.S. FDA considers a product to be a device if it meets the definition of a medical device per Section 201(h) of the Food, Drug, and Cosmetic Act.">!</span></label>
			    </div>
			    <div class="col-md-12">
			        <input type="radio" name="healthcare_status" value="Yes" class="tick"> &nbsp; Yes 
			        <input type="radio" name="healthcare_status" value="NO" class="tick"> &nbsp; No
			    </div>
			    
			</div>

			<hr>
			<h4>COMPANY CONTACTS MINIMUM 2 PERSONS</h4>
			<hr>
			<h5 class="fw-bold">Contact Person 1</h5>
			<div class="row">
				<div class="col-md-2">
					<label>Title</label>
					<select class="form-control" name="title[]">
						<option value="Mr.">Mr.</option>
						<option value="Mrs.">Mrs.</option>
						<option value="Miss">Miss</option>
						<option value="Dr">Dr.</option>
					</select>
				</div>
				<div class="col-md-5">
					<label>First Name</label>
					<input type="text" name="first_name[]" class="form-control" placeholder="First Name">
				</div>
				<div class="col-md-5">
					<label>Last Name</label>
					<input type="text" name="last_name[]" class="form-control" placeholder="Last Name">
				</div>

				<div class="col-md-2">
					<label>Job Title</label>
					<select class="form-control" name="job_title[]">
						<option value="CEO.">CEO.</option>
						<option value="Staff.">Staff.</option>
						<option value="Accounts.">Accounts.</option>
					</select>
				</div>
				<div class="col-md-5">
					<label>Email</label>
					<input type="email" name="email_id[]" class="form-control" placeholder="user@gs1.org">
				</div>
				<div class="col-md-5">
					<label>Phone Number</label>
					<input type="number" name="phone_number1[]" class="form-control" placeholder="+968 000 000">
				</div>
				<div class="col-md-12">
					<span> Is this main contact? </span><br>
					<input type="radio" name="main_contact_status" value="Yes" class="tick"> &nbsp; Yes 
			     <input type="radio" name="main_contact_status" value="NO" class="tick"> &nbsp; No
					 
				</div>
			</div>

			<hr>

			<div id="dynamic-field-1" class="dynamic-field">
				<h5 class="fw-bold">Contact Person 2</h5>
				<div class="row">
					<div class="col-md-2">
						<label>Title</label>
						<select class="form-control" name="title[]">
							<option value="Mr.">Mr.</option>
							<option value="Mrs.">Mrs.</option>
							<option value="Miss">Miss</option>
							<option value="Dr.">Dr.</option>
						</select>
					</div>
					<div class="col-md-5">
						<label>First Name</label>
						<input type="text" name="first_name[]" class="form-control" placeholder="First Name">
					</div>
					<div class="col-md-5">
						<label>Last Name</label>
						<input type="text" name="last_name[]" class="form-control" placeholder="Last Name">
					</div>

					<div class="col-md-2">
						<label>Job Title</label>
						<select class="form-control" name="job_title[]" >
							<option value="CEO.">CEO.</option>
							<option value="Staff">Staff.</option>
							<option value="Accounts.">Accounts.</option>
						</select>
					</div>
					<div class="col-md-5">
						<label>Email</label>
						<input type="text" name="email_id[]" class="form-control" placeholder="user@gs1.org">
					</div>
					<div class="col-md-5">
						<label>Phone Number</label>
						<input type="number" name="phone_number1[]" class="form-control" placeholder="+968 000 000">
					</div>
					
				</div>
			</div>
			<div style="clear: both;"></div>
			<h5 class="fw-bold">Add another contact person</h5>
			
			<button type="button" id="add-button" class="btn btn-primary float-left text-uppercase shadow-sm"><i class="fas fa-plus fa-fw"></i> Add</button>
              <button type="button" id="remove-button" class="btn btn-warning float-left text-uppercase ml-1" disabled="disabled"><i class="fas fa-minus fa-fw"></i> Remove</button>

			<hr>
			<h4>UPLOAD DOCUMENTS</h4>

			<div class="row">
				<div class="col-md-4">
					<label>Commercial Registration (All pages) *</label>
					<input type="file" class="form-control mb-0" name="upload_document1">
					<span class="fo-12">JPG, PDF, PNG Allowed </span>
				</div>
				<div class="col-md-4">
					<label>Chamber of Commerce Certificate *</label>
					<input type="file" class="form-control mb-0" name="upload_document2">
					<span class="fo-12">JPG, PDF, PNG Allowed </span>
				</div>
				<div class="col-md-4">
					<label>Other Documents  *</label>
					<input type="file" class="form-control mb-0" name="upload_document3">
					<span class="fo-12">JPG, PDF, PNG Allowed </span>
				</div>
			</div>

			<hr>
			<h4>Select Package</h4>

			<div class="row">
				<div class="col-md-12">
					<label>How many GTINS do you require? <span class="text-danger" data-toggle="tooltip" title="GTIN: Definition">!</span></label>
					<div class="button dropdown"> 
		<select name="product_id" id="product_id" onchange="show_package_details();">
					  	<option selected disabled>Select Package</option>
    <?php 
    $query = "SELECT * FROM product_tbl ORDER BY id ASC ";     
    $rs_result = mysqli_query ($conn, $query);
    while($row=mysqli_fetch_array($rs_result)){
    ?>
    
    <option value="<?=$row['id']?>"><?=$row['gtins_name']?></option>
    <?php } ?>
					  </select>
					</div>


					<div class="output product_result_data">
					
					  
					</div>

				</div>
				
			</div>	
			
           


			<div style="clear: both;"></div>
		

			<div class="row">
				<div class="col-md-4">
					<label>I have a promo code</label>
					<input type="text" class="form-control" placeholder="Please enter promo code" name="promo_code">
				</div>
			</div>

            <div class="row">
                <div class="col-md-12">
					<input type="checkbox" class="tick" required name="tnc" value="Yes"> &nbsp; <span>Accept <a href="#"> Terms and conditions </a>/ <a href="#"> Privacy policy </a> </span>
				</div>
            </div>

			<hr>

			<div class="col-md-12 text-center">
				<button  type="submit" name="submit" class="btn btn-success">Sign Up</button>
			</div>
			


		</form>
	</div>
</section>

<?php include('footer.php'); ?>