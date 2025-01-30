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
    $captcha = $_POST["captcha"];
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

//captach 
$captchaUser = filter_var($_POST["captcha"], FILTER_SANITIZE_STRING);



	//validation
	$user_sql = "SELECT * FROM  company_tbl WHERE user_email='$user_email'";
	$res=mysqli_query($conn, $user_sql);

	if(mysqli_num_rows($res) > 0){
	    /*$_SESSION['message1']="User Already exits";
	    $message1=$_SESSION['message1'];*/ 

	    echo "<script>alert('User Already exits')</script>";
	  }

	 else{

      if(empty($captcha)) {
      	echo "<script>alert('Please enter the captcha')</script>";
      
      }



      else if($captcha == $captchaUser){
       //image validation if condition wrap here	
	if(in_array($ext, ['pdf', 'jpeg', 'jpg','png']) || in_array($ext1, ['pdf', 'jpeg', 'jpg','png']) || in_array($ext2, ['pdf', 'jpeg', 'jpg','png']))
	{
	move_uploaded_file($doc_tmp_name1,$doc_path1);
	move_uploaded_file($doc_tmp_name2,$doc_path2);
	move_uploaded_file($doc_tmp_name3,$doc_path3);
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
	    $mail->Subject = 'Barcode:New Registration';
	    $mail->Body    = $email_temp;
	    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//male if start here
	if($mail->send()){

	 $sql="INSERT INTO `company_tbl`(product_id, product_name, registration_fee, gtins_annual_fee, gln_price, sscc_price,  annual_subscription_fee, 	annual_total_price,  name, name_ar, pobox, zipcode, address, address_ar, country, city, mobile_number, phone_number, fax_number, website_address, cr_number, cr_legal_type, cr_registration_date, cr_expiry_date, cr_tax_registration_number, user_email, password, cpassword, business_type_product_category, number_of_employee, upload_document1 , upload_document2, upload_document3, healthcare_status,main_contact_status,tnc,captcha_code, status) VALUES ('$product_id','$product_name', '$registration_fee', '$gtins_annual_fee', '$gln_price', '$sscc_price', '$annual_subscription_fee', '$annual_total_price',  '$name', '$name_ar', '$pobox', '$zipcode','$address', '$address_ar', '$country', '$city','$mobile_number', '$phone_number', '$fax_number', '$website_address','$cr_number','$cr_legal_type', '$cr_registration_date','$cr_expiry_date','$cr_tax_registration_number', '$user_email', '$password','$cpassword','$business_type_product_category','$number_of_employee', '$doc_path1','$doc_path2','$doc_path3','$healthcare_status','$main_contact_status','$tnc', '$captcha_code','0' )";
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
    $expiry_date=date('Y/12/31');
	 /*"INSERT INTO `order_tbl`(company_id ,order_id, product_id ,user_email, registration_fee ,gtins_annual_fee, gln_price ,sscc_price,annual_subscription_fee,annual_total_price,order_date,promo_code,status) VALUES('$company_id','$order_id','$product_id' ,'$user_email' ,'$registration_fee' ,'$gtins_annual_fee' ,'$gln_price','$sscc_price','$annual_subscription_fee','$annual_total_price','$order_date','$promo_code','1')";*/

	$sql2 =mysqli_query($conn,"INSERT INTO `order_tbl`(company_id ,order_id,  product_id ,user_email, registration_fee ,gtins_annual_fee, gln_price ,sscc_price,annual_subscription_fee,annual_total_price,order_date,	expiry_date,promo_code,status) VALUES('$company_id','$order_id','$product_id' ,'$user_email' ,'$registration_fee' ,'$gtins_annual_fee' ,'$gln_price','$sscc_price','$annual_subscription_fee','$annual_total_price','$order_date','$expiry_date','$promo_code','0')");


	echo "<script>window.location='thanks.php';</script>";

	}




	}



	}
//male if wrap here

	else {
	echo $mail->Errorinfo; 
	echo "<script>alert('Enter valid email.')</script>";

	 }

	}

//image validation if condition wrap here
      }





      else {
      	echo "<script>alert('Captcha is invalid ,enter the valid captcha')</script>";
       
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
						  			<td class="fw-bold">  المنتج / الخدمات   </td>
						  			<td class="fw-bold"> رسوم التسجيل   <span class="fo-12">  مره واحده  </span></td>
						  			<td class="fw-bold">  التجديد السنوي   </td>
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
	            			<h4 class="mt-3">هل تحتاج إلى منتجات إضافية   </h4>
	            				<div class="col-md-12">
	            				    <div class="output">
	            					  <div id="one" class="table table-responsive">
	            					  	<table class="table table-bordered table-striped">
	            					  		<tr>
	            					  		    <td></td>
	            					  			<td class="fw-bold">ملمنتج / الخدمات   </td>
	            					  			<td class="fw-bold">لتجديد السنوي   </td>
	            					  		</tr>
	<tr>
	<td><input onclick="add()" type="checkbox"  name="gln_price" id="gln_price" value="<?=$productData['gln_annual_fee']?>"> </td>
	<td>هل تحتاج GLN؟ <span class="text-danger" data-toggle="tooltip" title="GTIN: Definition">!</span></td>
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
					    <label class="fw-bold">رسوم التسجيل </label>
						<div class="input-group mb-3">
						  <span class="input-group-text" id="basic-addon1">ريال عماني</span>
						  
						    
						  <input type="text" id="registration_fee" name="registration_fee" class="form-control mb-0"  value="<?=$productData['registration_fee']?>" disabled>
						</div>
						<span class="fw-bold text-danger">صالح حتى 31 ديسمبر 2022 </span>
					</div>

					<div class="col-md-4">
					    <label class="fw-bold">رسوم الاشتراك السنوي  </label>
						<div class="input-group mb-3">
						  <span class="input-group-text" id="basic-addon1">يال عماني</span>
						  <!--<input type="number" id="total" class="form-control mb-0" >
						  <div id="total" class="form-control">500</div>-->
						 
						  <input type="hidden" name="annual_subscription_fee" id="annual_subscription_fee" value="<?=$productData['gtins_annual_fee']?>">
						  <input type="text" class="form-control mb-0" size="2" name="annual_total_price" id="annual_total_price" value="<?=$productData['gtins_annual_fee']?>" disabled/>
						</div>
						<span class="fw-bold text-danger">التجديد القادم في ١ يناير ٢٠٢٣ </span>
					</div>
					<div class="col-md-4">
					    <label class="fw-bold">إجمالي الرسوم  </label>
						<div class="input-group mb-3">
						  <span class="input-group-text" id="basic-addon1">ريال عماني</span>
						 <input name="total_price" id="total_price" type="text" class="form-control mb-0"  value="<?=$productData['registration_fee']+$productData['gtins_annual_fee']?>" disabled>
						  <input class="form-control mb-0" disabled id="demo">
						</div>
					</div>
				</div>


	            <div class="row d-none">
					<div class="col-md-12 text-center mt-3">
						<!--<a id="calculate_fee" class="btn btn-success">Calculate Membership Fee</a>-->
						<a id="calculate_fee" class="btn btn-success" onclick="add()">حساب رسوم العضوية</a>
					</div>

					
				</div>
	 <?php   
	 exit;
	}


	include('header-ar.php');
	 ?>

	<section class="user_registration">
		<div class="container">
			<form name="listForm" action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="annual_total_price" value="<?=$annual_total_price?>">
				<h4>تفاصيل عن الشركة</h4>
				<div class="row">
					
					<div class="col-md-6">
						<label>اسم الشركة  (انجليزي)	*</label>
						<input type="text" class="form-control" name="name" placeholder="اسم الشركة  (انجليزي)" required>
					</div>
					<div class="col-md-6">
						<label>اسم الشركة  (عربي)	*</label>
						<input type="text" class="form-control" name="name_ar" placeholder="اسم الشركة  (عربي)" required>
					</div>
					<div class="col-md-6">
						<label>صندوق بريد	*</label>
						<input type="text" class="form-control" name="pobox" placeholder="صندوق بريد 000" required>
					</div>
					<div class="col-md-6">
						<label>الرمز البريدي	*</label>
						<input type="number" class="form-control" name="zipcode" placeholder="مائة وثلاثة وعشرون" required>
					</div>
					<div class="col-md-6">
						<label>العنوان (انجليزي)	*</label>
						<input type="text" class="form-control" name="address" placeholder="ررقم المكتب ، رقم المبنى ، الطريق رقم ، المدينة" required>
					</div>
					<div class="col-md-6">
						<label>العنوان (عربي)	*</label>
						<input type="text" class="form-control" name="address_ar" placeholder="رقم المكتب ، رقم المبنى ، الطريق رقم ، المدينة" required>
					</div>

	        <div class="col-md-6">
						<label>  دولة     </label>
						<select class="form-control" name="country" required>
							<option selected disabled>  حدد الدولة     </option>
							<option value="Oman">  عمان    </option>
							<option disabled>---  آحرون    ---</option>

							<?php 
                            $country=mysqli_query($conn,"SELECT * FROM countries WHERE country_enName!='OMAN'");
                            while($c=mysqli_fetch_array($country)){

                            	?>
                              <option value="<?=$c['country_arName']?>"><?=$c['country_arName']?></option>



							<?php }?>
							
							
						</select>
					</div>


					<div class="col-md-6">
						<label>المدينه	*</label>
						<select class="form-control" name="city">
							<option selected disabled>اختر المدينة</option>
						  <option value=" آدم ">آدم</option>
							<option value=" الأشخرة ">	الأشخرة</option>
							<option value=" البريمي ">	البريمي</option>
							<option value=" الحمراء ">	الحمراء</option>
							<option value=" ولاية الجازر ">	الجزر</option>
							<option value=" المدينة الزرقاء ">	المدينة الزرقاء</option>
							<option value=" السويق ">	السويق</option>
							<option value=" السيب ">السيب</option>
							<option value=" بهلا ">	بهلا</option>
							<option value=" ولاية بركاء ">ولاية بركاء</option>
							<option value=" ولاية بدبد ">	ولاية بدبد</option>
							<option value=" ولاية بدية ">لاية بدية</option>
							<option value=" الدقم ">	الدقم</option>
							<option value=" ولاية هيما ">	ولاية هيما</option>
							<option value=" ولاية إبراء ">	ولاية إبراء</option>
							<option value=" عبري ">عبري</option>
							<option value=" ولاية إزكي ">	ولاية إزكي</option>
							<option value=" جبرين ">	جبرين</option>
							<option value=" ولاية جعلان بني بو حسن ">لاية جعلان بني بو حسن</option>
							<option value=" ولاية خصب ">	ولاية خصب</option>
							<option value=" ولاية محوت ">	ولاية محوت</option>
							<option value=" ولاية منح ">	ولاية منح</option>
							<option value=" جزيرة مصيرة ">	جزيرة مصيرة</option>
							<option value=" ولاية مطرح ">ولاية مطرح</option>
							<option value=" المضيرب ">	المضيرب</option>
							<option value=" ولاية المضيبي ">	ولاية المضيبي</option>
							<option value=" مسقط ">	مسقط</option>
							<option value=" ولاية نزوي ">	ولاية نزوي</option>
							<option value=" ولاية قريات ">	ولاية قريات</option>
							<option value=" ريسوت ">ريسوت</option>
							<option value=" ولاية الرستاق ">ولاية الرستاق</option>
							<option value=" روي ">	روي</option>
							<option value=" ولاية صحم ">	ولاية صحم</option>
							<option value=" اسيق">سيق</option>
							<option value=" صلالة ">	صلالة</option>
							<option value=" ولاية سمائل ">	ولاية سمائل</option>
							<option value=" ولاية شناص ">	ولاية شناص</option>
							<option value="  صحار ">	صحار</option>
							<option value="  ولاية صور ">	ولاية صور</option>
							<option value="  تنعم ">	ولاية تنعم</option>
							<option value="  ثمريت ">	ثمريت</option>
							<option value="  آخر   ">	آخر</option>

						</select>
					</div>
					
					<div class="col-md-6">
						<label>رقم الهاتف المحمول *</label>
						<input type="text" class="form-control" name="mobile_number" placeholder="+968 0000 0000" required>
					</div>
					<div class="col-md-6">
						<label>رقم الهاتف *</label>
						<input type="text" class="form-control" name="phone_number" placeholder="+968 0000 0000" required>
					</div>
					<div class="col-md-6">
						<label>رقم الفاكس</label>
						<input type="text" class="form-control" name="fax_number" placeholder="+968 0000 0000">
					</div>
					<div class="col-md-6">
						<label>عنوان الموقع الالكتروني</label>
						<input type="text" class="form-control" name="website_address" placeholder="www.gs1oman.org">
					</div>
				</div>

				<hr>

				<h4>تفاصيل السجل التجاري</h4>
				<div class="row">
					<div class="col-md-6">
						<label>رقم السجل التجاري *</label>
						<input type="number" class="form-control" name="cr_number" placeholder="رقم السجل التجاري" required>
					</div>
					<div class="col-md-6">
						<label>الشكل القانوني:*</label>
						<div style="clear: both;"></div>
						<select name="cr_legal_type" required>
							<option disabled selected>حدد النوع</option>
							<option value="شركة التضامن.">شركة التضامن.</option>
							<option value=" شركة التوصية."> شركة التوصية.</option>
							<option value="شركة المحاصة.">شركة المحاصة.</option>
							<option value="شركة المساهمة (عامة / مقفلة).">شركة المساهمة (عامة / مقفلة).</option>
							<option value="الشركة القابضة">الشركة القابضة </option>
							<option value="لشركة محدودة المسؤولية.">لشركة محدودة المسؤولية.</option>
							<option value="شركة الشخص الواحد">شركة الشخص الواحد</option>
							<option value="شركة الشخص الواحد - شركة ذات ملكية فردية">شركة الشخص الواحد - شركة ذات ملكية فردية </option>
						</select>
					</div>
					<div class="col-md-4">
						<label>تاريخ تسجيل السجل التجاري</label>
						<input type="text" placeholder="dd-mm-yyyy" onfocus="(this.type='date')"   class="form-control" name="cr_registration_date">
					</div>
					<div class="col-md-4">
						<label>تاريخ انتهاء السجل التجاري</label>
						<input type="text" placeholder="dd-mm-yyyy" onfocus="(this.type='date')"  class="form-control"  name="cr_expiry_date">
					</div>
					<div class="col-md-4">
						<label>رقم تسجيل الضريبة</label>
						<input type="number" class="form-control" name="cr_tax_registration_number" placeholder="Tax Registration Number">
					</div>
				</div>
				<hr>

				<h4>تفاصيل تسجيل الدخول</h4>
				<div class="row">
					<div class="col-md-12">
						<label>عنوان البريد الإلكتروني الرئيسي *</label>
						<input type="text" class="form-control" placeholder="user@email.com" name="user_email" required>
					</div>
					<div class="col-md-6" style="display:none;">
						<label>كلمة المرور *</label>
						<input type="password" class="form-control" placeholder="لمة المرور " name="password" required>
					</div>
					
				</div>

				<hr>

				<h4>نوع العمل</h4>
				<div class="row">
					<div class="col-md-6">
						<label>فئة المنتج الرئيسية *</label>
						<select name="business_type_product_category" required>
							<option disabled selected>  اختر الفئة       </option>
								<option value=" زراعة   " >  زراعة     </option>
								<option value=" الآلات الزراعية   ">  الآلات الزراعية   </option>
								<option value="  طعام للاطفال    ">  طعام للاطفال    </option>
								<option value=" منتجات المخبز   ">  منتجات المخبز    </option>
								<option value=" أغطية السرير    "> أغطية السرير    </option>
								<option value=" المشروبات     ">  المشروبات   </option>
								<option value=" بسكويت   ">  بسكويت   </option>
								<option value=" مياه معبأة   ">   مياه معبأة   </option>
								<option value="  الزجاجات والحاويات    ">  الزجاجات والحاويات    </option>
								<option value="  رغيف الخبز    ">  رغيف الخبز     </option>
								<option value="  مواد بناء    ">  مواد بناء    </option>
								<option value="  اكسسوارات العناية بالسيارات    ">  اكسسوارات العناية بالسيارات   </option>
								<option value="  الهواتف الخلوية    ">  الهواتف الخلوية      </option>
								<option value="  مواد كيميائية     ">  مواد كيميائية    </option>
								<option value="  شوكولاتة   "> شوكولاتة     </option>
								<option value=" السجائر   ">  السجائر   </option>
								<option value="  منتجات التنظيف   "> منتجات التنظيف    </option>
								<option value="  ملابس   "> ملابس   </option>
								<option value=" قهوة   "> قهوة  </option>
								<option value="  برامج الكمبيوتر  ">  برامج الكمبيوتر  </option>
								<option value=" المعجنات   "> المعجنات  </option>
								<option value=" مستحضرات التجميل    ">  مستحضرات التجميل  </option>
								<option value="  يجعد    ">  يجعد   </option>
								<option value=" منتجات الألبان     ">  منتجات الألبان   </option>
								<option value="  أدوات طب الأسنان  ">  أدوات طب الأسنان   </option>
								<option value=" منظفات    ">  منظفات  </option>
								<option value=" مطهر   "> مطهر  </option>
								<option value=" عناصر البوليسترين المتاح    ">  عناصر البوليسترين المتاح   </option>
								<option value=" مشروبات   "> مشروبات  </option>
								<option value=" بيض   "> بيض  </option>
								<option value=" سخانات كهربائية   ">  سخانات كهربائية     </option>
								<option value="  الأقمشة    ">  الأقمشة   </option>
								<option value="  اكسسوارات الموضة    ">  اكسسوارات الموضة    </option>
								<option value=" غذاء    "> غذاء    </option>
								<option value="  طعام (سمك)     ">  طعام (سمك)    </option>
								<option value="  طعام و شراب    ">  طعام و شراب    </option>
								<option value="  التصنيع الغذائي   "> التصنيع الغذائي  </option>
								<option value="  فاكهة طازجة   ">  فاكهة طازجة    </option>
								<option value="  المنتجات الطازجة   ">  المنتجات الطازجة    </option>
								<option value="  الخضروات الطازجة   ">  الخضروات الطازجة    </option>
								<option value="  سمك مجمد   ">   سمك مجمد    </option>
								<option value="  فاكهة   ">  فاكهة    </option>
								<option value="  مشروبات الفاكهة   ">  مشروبات الفاكهة    </option>
								<option value="   عصير فواكه   ">  عصير فواكه    </option>
								<option value="  فواكه خضر    ">  فواكه خضر    </option>
								<option value="  المعدات   ">   المعدات    </option>
								<option value="  الصحة والجمال   ">  الصحة والجمال    </option>
								<option value="  معدات الرعاية الصحية   ">  معدات الرعاية الصحية    </option>
								<option value="  المنسوجات المنزلية  ">   المنسوجات المنزلية    </option>
								<option value="  أُسرَة    ">  أُسرَة    </option>
								<option value="  منتجات النظافة    ">  منتجات النظافة    </option>
								<option value="  بوظة   ">  بوظة    </option>
								<option value="  السلع الصناعية   ">  السلع الصناعية    </option>
								<option value=" هو - هي  "> هو - هي     </option>
								<option value="  مربى  ">  مربى    </option>
								<option value="  معكرونة   ">  معكرونة   </option>
								<option value="   مياه معدنية  ">  مياه معدنية     </option>
								<option value="  إنتاج التسجيلات الموسيقية   "> إنتاج التسجيلات الموسيقية    </option>
								<option value="  غير محدد   ">  	غير محدد    </option>
								<option value="  بترول    ">  بترول    </option>
								<option value="   الصناعة البصرية   ">   الصناعة البصرية    </option>
								<option value="  آحرون   ">  آحرون    </option>
								<option value="   ورق    ">  ورق    </option>
								<option value="  منتجات ورقية  ">  منتجات ورقية    </option>
								<option value="  معكرونة    ">  معكرونة   </option>
								<option value="  معجنات ">  معجنات    </option>
								<option value="  عطور  ">  عطور    </option>
								<option value=" الأدوية  ">  الأدوية    </option>
								<option value="  المنتجات البريدية  ">   المنتجات البريدية    </option>
								<option value="  حليب مجفف   ">   حليب مجفف    </option>
								<option value="   قف بجانب الطريق   ">  قف بجانب الطريق     </option>
								<option value="   الملابس الجاهزة  ">   الملابس الجاهزة    </option>
								<option value="  أرز   ">  أرز    </option>
								<option value="   مأكولات بحرية    ">   مأكولات بحرية   </option>
								<option value="  طعام خفيف   ">   طعام خفيف    </option>
								<option value="  صابون    ">  صابون    </option>
								<option value="  المشروبات الغازية   ">  المشروبات الغازية   </option>
								<option value="  كرات رياضية (معدات)   ">  كرات رياضية (معدات)    </option>
								<option value="  ادوات رياضية  ">   ادوات رياضية    </option>
								<option value="  والسلع الرياضية  ">  والسلع الرياضية    </option>
								<option value=" ثابت   ">  ثابت    </option>
								<option value="  سكر   ">   سكر    </option>
								<option value="  المعدات الجراحية   ">   المعدات الجراحية    </option>
								<option value="  حلويات    ">   حلويات    </option>
								<option value="   شاي   "> شاي       </option>
								<option value=" الاتصالات   ">  الاتصالات    </option>
								<option value=" الغزل والنسيج   ">  الغزل والنسيج  </option>
								<option value="  ورقة منديل   "> ورقة منديل    </option>
								<option value="  تبغ     ">  تبغ    </option>
								<option value="  مستلزمات المرحاض   ">  مستلزمات المرحاض     </option>
								<option value="  فرش الاسنان   ">  فرش الاسنان    </option>
								<option value="  ألعاب الأطفال     ">  ألعاب الأطفال    </option>
								<option value=" الخضروات     ">  الخضروات     </option>
								<option value=" حفظ الخضروات   ">  حفظ الخضروات     </option>
							<option value=" ماء    "> ماء </option>
						</select>
					</div>
					<div class="col-md-6">
						<label>عدد الموظفين</label>
						<input type="number" class="form-control" name="number_of_employee">
					</div>
				</div>
				
				<hr>
				
				<h4>هل انت في الرعاية الصحية؟</h4>
				<div class="row">
				    <div class="col-md-12">
				        <label>هل أنت بصدد تحديد الأجهزة الطبية التي تندرج تحت إدارة الغذاء والدواء الأمريكية (FDA) أو نظام تحديد الأجهزة الفريد (UDI)؟ <span class="text-danger" data-toggle="tooltip" title="The U.S. FDA considers a product to be a device if it meets the definition of a medical device per Section 201(h) of the Food, Drug, and Cosmetic Act.">!</span></label>
				    </div>
				    <div class="col-md-12">
				        <input type="radio" name="healthcare_status" value="نعم" class="tick"> &nbsp; نعم 
				        <input type="radio" name="healthcare_status" value="قم" class="tick"> &nbsp; رقم
				    </div>
				    
				</div>

				<hr>
				<h4>جهات التواصل لشركة بحد أدنى  شخصين</h4>
				<hr>
				<h5 class="fw-bold">جهة أتصال 1</h5>
				<div class="row">
					<div class="col-md-2">
						<label>لقب:</label>
						<select class="form-control" name="title[]">
							<option value="السيدة.">السيدة.</option>
							<option value="السّيدة.">السّيدة.</option>
							<option value="الآنسة">الآنسة</option>
							<option value="دكتور ">دكتور </option>
						</select>
					</div>
					<div class="col-md-5">
						<label>الاسم الاول:</label>
						<input type="text" name="first_name[]" class="form-control" placeholder="الاسم الاول:">
					</div>
					<div class="col-md-5">
						<label>القبيلة</label>
						<input type="text" name="last_name[]" class="form-control" placeholder="القبيلة">
					</div>

					<div class="col-md-2">
						<label>المسمى الوظيفي:</label>
						<select class="form-control" name="job_title[]">
							<option value="المدير التنفيذي.">المدير التنفيذي.</option>
							<option value="العاملين.">العاملين.</option>
							<option value="حسابات.">	حسابات.</option>
						</select>
					</div>
					<div class="col-md-5">
						<label>البريد الإلكتروني:</label>
						<input type="email" name="email_id[]" class="form-control" placeholder="user@gs1.org">
					</div>
					<div class="col-md-5">
						<label>رقم الهاتف:</label>
						<input type="text" name="phone_number1[]" class="form-control" placeholder="+968 000 000">
					</div>
					<div class="col-md-12">
						<span> “هل هذا هو جهة الاتصال الرئيسية؟ سيقوم هؤلاء المستخدمون بإدارة GTINS في حساب تنشيط GS1 الخاص بك وسيتم استخدام تفاصيلهم في GEPIR كجهة الاتصال الأساسية الرئيسية لشركتك " </span><br>
						<input type="radio" name="main_contact_status" value="Yes" class="tick"> &nbsp; Yes 
				     <input type="radio" name="main_contact_status" value="NO" class="tick"> &nbsp; رقم
						 
					</div>
				</div>

				<hr>

				<div id="dynamic-field-1" class="dynamic-field">
					<h5 class="fw-bold">جهة أتصال 2</h5>
					<div class="row">
						<div class="col-md-2">
							<label>لقب:</label>
							<select class="form-control" name="title[]">
								<option value="لسيدة.">لسيدة.</option>
								<option value="لسّيدة.">لسّيدة.</option>
								<option value="الآنسة">الآنسة</option>
								<option value="Dr.">كتور </option>
							</select>
						</div>
						<div class="col-md-5">
							<label>الاسم الاول:</label>
							<input type="text" name="first_name[]" class="form-control" placeholder="First Name">
						</div>
						<div class="col-md-5">
							<label>القبيلة</label>
							<input type="text" name="last_name[]" class="form-control" placeholder="Last Name">
						</div>

						<div class="col-md-2">
							<label>المسمى الوظيفي:</label>
							<select class="form-control" name="job_title[]" >
								<option value="المدير التنفيذي.">	المدير التنفيذي.</option>
								<option value="العاملين.">	العاملين.</option>
								<option value="حسابات.">حسابات.</option>
							</select>
						</div>
						<div class="col-md-5">
							<label>البريد الإلكتروني:</label>
							<input type="text" name="email_id[]" class="form-control" placeholder="user@gs1.org">
						</div>
						<div class="col-md-5">
							<label>رقم الهاتف:</label>
							<input type="text" name="phone_number1[]" class="form-control" placeholder="+968 000 000">
						</div>
						
					</div>
				</div>
				<div style="clear: both;"></div>
				<h5 class="fw-bold">إضافة جهة اتصال أخرى</h5>
				
				<button type="button" id="add-button" class="btn btn-primary float-left text-uppercase shadow-sm"><i class="fas fa-plus fa-fw"></i>  يضيف </button>
	              <button type="button" id="remove-button" class="btn btn-warning float-left text-uppercase ml-1" disabled="disabled" style="color: #ffffff; background-color: #f34006; border-color: #f34006;"><i class="fas fa-minus fa-fw"></i> إزالة</button>

				<hr>
				<h4>تحميل المستندات</h4>

				<div class="row">
					<div class="col-md-4">
						<label>السجل التجاري (جميع الصفحات) *</label>
						<input type="file" class="form-control mb-0" name="upload_document1">
						<span class="fo-12">مسموح بتنسيق JPG و PDF و PNG </span>
					</div>
					<div class="col-md-4">
						<label>شهادة انتساب الغرفة *</label>
						<input type="file" class="form-control mb-0" name="upload_document2">
						<span class="fo-12">سموح بتنسيق JPG و PDF و PNG </span>
					</div>
					<div class="col-md-4">
						<label>مستندات أخرى  *</label>
						<input type="file" class="form-control mb-0" name="upload_document3">
						<span class="fo-12">سموح بتنسيق JPG و PDF و PNG </span>
					</div>
				</div>

				<hr>
				<h4>اختر الباقة</h4>

				<div class="row">
					<div class="col-md-12">
						<label>كم عدد GTINS التي تحتاجها؟ <span class="text-danger" data-toggle="tooltip" title="GTIN: Definition">!</span></label>
						<div class="button dropdown"> 
			<select name="product_id" id="product_id" onchange="show_package_details();">
						  	<option selected disabled>اختر الباقة</option>
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
			

	      <!--<div class="row">
			<div class="form-group col-12">
	          <label>Enter Captcha</label>
	          <input type="text" class="form-control" name="captcha" id="captcha">
	        </div>
				</div>

				  <div class="row">
			<div class="form-group col-4 mb-2">
	          <img src="captcha.php" alt="PHP Captcha">
	        </div>
				</div>--->

				<div class="row d-none">
					<div class="col-md-12">
						<label>لدي كود ترويجي</label>
						<input type="text" class="form-control" placeholder="الرجاء إدخال الرمز الترويجي" name="promo_code">
					</div>
				</div>

			<div class="row">
			<div class="form-group col-12 mb-2">
	          <div class="g-recaptcha" data-sitekey="6LeD_OQhAAAAALV9zeyjeh822UKGL4MTFIw8d4hu"></div>
	        </div>
			</div>

	            <div class="row">
	                <div class="col-md-12">
						<input type="checkbox" id="finalpay1" class="tick" required name="tnc" value="Yes"> &nbsp; <span>قبول <a id="finalpay" href="#" class="text-orange" data-bs-toggle="modal" data-bs-target="#terms"> الأحكام والشروط </a>/ <a href="#" class="text-orange" data-bs-toggle="modal" data-bs-target="#privacy"> سياسة الخصوصية </a> </span>
					</div>
	            </div>

				<hr>

				<div class="col-md-12 text-center">
					<button  type="submit" name="submit" class="btn btn-success"style="color: #ffffff;
    background-color: #f34006;
    border-color: #f34006;">اشتراك  </button>
				</div>
				


			</form>
		</div>
	</section>

<div class="modal" id="terms">
  <div class="modal-dialog" style="max-width:1100px;">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">البنود و الظروف  </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p>  خلافا للاعتقاد الشائع ، ليس مجرد نص عشوائي. لها جذور في قطعة من الأدب اللاتيني الكلاسيكي منذ أن تجاوزت السنوات. قام ريتشارد مكلينتوك ، الأستاذ اللاتيني في كلية هامبدن سيدني في فرجينيا ، بالبحث عن واحدة من أكثر الكلمات اللاتينية غموضًا ، من مقطع لوريم إيبسوم ، وتصفح اقتباسات الكلمة في الأدب الكلاسيكي ، واكتشف المصدر الذي لا شك فيه. يأتي لوريم إيبسوم من أقسام (أقصى الخير والشر) بقلم شيشرون ، وكتبت في هذا الكتاب عبارة عن أطروحة حول نظرية الأخلاق ، وقد حظيت بشعبية كبيرة خلال عصر النهضة. السطر الأول من   </p>
        <p>  خلافا للاعتقاد الشائع ، ليس مجرد نص عشوائي. لها جذور في قطعة من الأدب اللاتيني الكلاسيكي منذ أن تجاوزت السنوات. قام ريتشارد مكلينتوك ، الأستاذ اللاتيني في كلية هامبدن سيدني في فرجينيا ، بالبحث عن واحدة من أكثر الكلمات اللاتينية غموضًا ، من مقطع لوريم إيبسوم ، وتصفح اقتباسات الكلمة في الأدب الكلاسيكي ، واكتشف المصدر الذي لا شك فيه. يأتي لوريم إيبسوم من أقسام (أقصى الخير والشر) بقلم شيشرون ، وكتبت في هذا الكتاب عبارة عن أطروحة حول نظرية الأخلاق ، وقد حظيت بشعبية كبيرة خلال عصر النهضة. السطر الأول من   </p>
        <p>خلافا للاعتقاد الشائع ، ليس مجرد نص عشوائي. لها جذور في قطعة من الأدب اللاتيني الكلاسيكي منذ أن تجاوزت السنوات. قام ريتشارد مكلينتوك ، الأستاذ اللاتيني في كلية هامبدن سيدني في فرجينيا ، بالبحث عن واحدة من أكثر الكلمات اللاتينية غموضًا ، من مقطع لوريم إيبسوم ، وتصفح اقتباسات الكلمة في الأدب الكلاسيكي ، واكتشف المصدر الذي لا شك فيه. يأتي لوريم إيبسوم من أقسام (أقصى الخير والشر) بقلم شيشرون ، وكتبت في هذا الكتاب عبارة عن أطروحة حول نظرية الأخلاق ، وقد حظيت بشعبية كبيرة خلال عصر النهضة. السطر الأول من</p>
        
      </div>
      
      <div class="modal-footer">
        <button type="button" id="agree" class="btn btn-success" data-bs-dismiss="modal">متفق</button>
        <button type="button" id="dontagree" class="btn btn-danger" data-bs-dismiss="modal" style="color: #ffffff;background-color: #f34006;border-color: #f34006;">لا توافق</button>
      </div>

    </div>
  </div>
</div>

<div class="modal" id="privacy">
  <div class="modal-dialog" style="max-width:1100px;">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">سياسة الخصوصية </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <p>  خلافا للاعتقاد الشائع ، ليس مجرد نص عشوائي. لها جذور في قطعة من الأدب اللاتيني الكلاسيكي منذ أن تجاوزت السنوات. قام ريتشارد مكلينتوك ، الأستاذ اللاتيني في كلية هامبدن سيدني في فرجينيا ، بالبحث عن واحدة من أكثر الكلمات اللاتينية غموضًا ، من مقطع لوريم إيبسوم ، وتصفح اقتباسات الكلمة في الأدب الكلاسيكي ، واكتشف المصدر الذي لا شك فيه. يأتي لوريم إيبسوم من أقسام (أقصى الخير والشر) بقلم شيشرون ، وكتبت في هذا الكتاب عبارة عن أطروحة حول نظرية الأخلاق ، وقد حظيت بشعبية كبيرة خلال عصر النهضة. السطر الأول من   </p>
        <p>  خلافا للاعتقاد الشائع ، ليس مجرد نص عشوائي. لها جذور في قطعة من الأدب اللاتيني الكلاسيكي منذ أن تجاوزت السنوات. قام ريتشارد مكلينتوك ، الأستاذ اللاتيني في كلية هامبدن سيدني في فرجينيا ، بالبحث عن واحدة من أكثر الكلمات اللاتينية غموضًا ، من مقطع لوريم إيبسوم ، وتصفح اقتباسات الكلمة في الأدب الكلاسيكي ، واكتشف المصدر الذي لا شك فيه. يأتي لوريم إيبسوم من أقسام (أقصى الخير والشر) بقلم شيشرون ، وكتبت في هذا الكتاب عبارة عن أطروحة حول نظرية الأخلاق ، وقد حظيت بشعبية كبيرة خلال عصر النهضة. السطر الأول من   </p>
        <p>خلافا للاعتقاد الشائع ، ليس مجرد نص عشوائي. لها جذور في قطعة من الأدب اللاتيني الكلاسيكي منذ أن تجاوزت السنوات. قام ريتشارد مكلينتوك ، الأستاذ اللاتيني في كلية هامبدن سيدني في فرجينيا ، بالبحث عن واحدة من أكثر الكلمات اللاتينية غموضًا ، من مقطع لوريم إيبسوم ، وتصفح اقتباسات الكلمة في الأدب الكلاسيكي ، واكتشف المصدر الذي لا شك فيه. يأتي لوريم إيبسوم من أقسام (أقصى الخير والشر) بقلم شيشرون ، وكتبت في هذا الكتاب عبارة عن أطروحة حول نظرية الأخلاق ، وقد حظيت بشعبية كبيرة خلال عصر النهضة. السطر الأول من</p>
            
      </div>

    </div>
  </div>
</div>

	<?php include('footer-ar.php'); ?>
	
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script>
        $(document).ready(function(){
            $("#agree").click(function(){
                $("#finalpay1").prop("checked", true);
                $("#finalpay1").prop("disabled", true);
            });
            $("#dontagree").click(function(){
                $("#finalpay1").prop("checked", false);
                $("#finalpay1").prop("disabled", false);
            });
        });





    </script>

    


