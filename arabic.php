	<style>
		label.error {
			color: red;
		}
	</style>
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
		$captcha = $_POST['captcha'];
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
		$offline_payment=$_POST['offline_payment'];
		//Package wrap WRAP

		//OTHER Details
		$tax_reg_no=$_POST['tax_reg_no'];

		$riyada_certificate=$_POST['riyada_certificate'];
		$issue_date=$_POST['issue_date'];
		$exp_date=$_POST['exp_date'];
		$documents_req=$_POST['documents_req'];


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



		$email_temp='
		<html xmlns="http://www.w3.org/1999/xhtml">

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


	$documents_req = $_FILES['documents_req']['name'];
	$documents_tmp_name = $_FILES['documents_req']['tmp_name'];
	$ext = pathinfo($documents_req, PATHINFO_EXTENSION);
	$documents_path = 'images/Upload/' . $documents_req; // Use a relative path

	// Check if the file has been uploaded successfully
	if (move_uploaded_file($documents_tmp_name, $documents_path)) {
		// File has been successfully uploaded and moved to the desired folder
		// Now, you can save $doc_path1 in your database
		// Perform your database insertion here
		//echo 'File uploaded successfully.';
	} else {
		// Something went wrong with the file upload
		//echo 'Error uploading the file.';
	}

	// Uploda Document Start 
	//1st Document
	/* $doc_name1=$_FILES['upload_document1']['name'];
	$doc_tmp_name1=$_FILES['upload_document1']['tmp_name'];
	$ext=pathinfo($_FILES['upload_document1']['name'],PATHINFO_EXTENSION);
	$doc_path1=$base_url.'images/Upload/'.$doc_name1; */
	
	$doc_name1 = $_FILES['upload_document1']['name'];
	$doc_tmp_name1 = $_FILES['upload_document1']['tmp_name'];
	$ext = pathinfo($doc_name1, PATHINFO_EXTENSION);
	$doc_path1 = 'images/Upload/' . $doc_name1; // Use a relative path

	// Check if the file has been uploaded successfully
	if (move_uploaded_file($doc_tmp_name1, $doc_path1)) {
		// File has been successfully uploaded and moved to the desired folder
		// Now, you can save $doc_path1 in your database
		// Perform your database insertion here
		//echo 'File uploaded successfully.';
	} else {
		// Something went wrong with the file upload
		//echo 'Error uploading the file.';
	}
	

	//2nd Document
	/* $doc_name2=$_FILES['upload_document2']['name'];
	$doc_tmp_name2=$_FILES['upload_document2']['tmp_name'];
	$ext1=pathinfo($_FILES['upload_document2']['name'],PATHINFO_EXTENSION);
	$doc_path2=$base_url.'images/Upload/'.$doc_name2; */
	
	$doc_name2 = $_FILES['upload_document2']['name'];
	$doc_tmp_name2 = $_FILES['upload_document2']['tmp_name'];
	$ext2 = pathinfo($doc_name2, PATHINFO_EXTENSION);
	$doc_path2 = 'images/Upload/' . $doc_name2; // Use a relative path

	// Check if the file has been uploaded successfully
	if (move_uploaded_file($doc_tmp_name2, $doc_path2)) {
		// File has been successfully uploaded and moved to the desired folder
		// Now, you can save $doc_path1 in your database
		// Perform your database insertion here
		//echo 'File uploaded successfully.';
	} else {
		// Something went wrong with the file upload
		//echo 'Error uploading the file.';
	}
	
	
	//3rd Document
	/* $doc_name3=$_FILES['upload_document3']['name'];
	$doc_tmp_name3=$_FILES['upload_document3']['tmp_name'];
	$ext2=pathinfo($_FILES['upload_document3']['name'],PATHINFO_EXTENSION);
	$doc_path3=$base_url.'images/Upload/'.$doc_name3; */
	
	$doc_name3 = $_FILES['upload_document3']['name'];
	$doc_tmp_name3 = $_FILES['upload_document3']['tmp_name'];
	$ext3 = pathinfo($doc_name3, PATHINFO_EXTENSION);
	$doc_path3 = 'images/Upload/' . $doc_name3; // Use a relative path

	// Check if the file has been uploaded successfully
	if (move_uploaded_file($doc_tmp_name3, $doc_path3)) {
		// File has been successfully uploaded and moved to the desired folder
		// Now, you can save $doc_path1 in your database
		// Perform your database insertion here
		//echo 'File uploaded successfully.';
	} else {
		// Something went wrong with the file upload
		//echo 'Error uploading the file.';
	}
	
	

	if(empty($doc_tmp_name1) || empty($doc_tmp_name2) || empty($doc_tmp_name3) )
	{
		$doc_path11="images/Upload/no-image.png";
		$doc_path22="images/Upload/no-image.png";
		$doc_path33="images/Upload/no-image.png";
	}
	$record_date=date("Y-m-d");
		//echo $record_date;
	//Upload Documnet Wrap 


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
		$city 			= 	mysqli_real_escape_string($city);
		$sql="INSERT INTO `company_tbl`(product_id, product_name, registration_fee, gtins_annual_fee, gln_price, sscc_price,  annual_subscription_fee, 	annual_total_price,  name, name_ar, pobox, zipcode, address, address_ar, country, city, mobile_number, phone_number, fax_number, website_address, cr_number, cr_legal_type, cr_registration_date, cr_expiry_date, cr_tax_registration_number, user_email, password, cpassword, business_type_product_category, number_of_employee, upload_document1 , upload_document2, upload_document3, healthcare_status,main_contact_status,tnc,captcha_code,record_date,tax_reg_no,riyada_certificate,issue_date,exp_date,documents_req,status) VALUES ('$product_id','$product_name', '$registration_fee', '$gtins_annual_fee', '$gln_price', '$sscc_price', '$annual_subscription_fee', '$annual_total_price',  '$name', '$name_ar', '$pobox', '$zipcode','$address', '$address_ar', '$country', '$city','$mobile_number', '$phone_number', '$fax_number', '$website_address','$cr_number','$cr_legal_type', '$cr_registration_date','$cr_expiry_date','$cr_tax_registration_number', '$user_email', '$password','$cpassword','$business_type_product_category','$number_of_employee', '$doc_path1','$doc_path2','$doc_path3','$healthcare_status','$main_contact_status','$tnc', '$captcha_code','$record_date','$tax_reg_no','$riyada_certificate','$issue_date','$exp_date','$documents_req','0' )";
		
		$query=mysqli_query($conn,$sql)or die(mysqli_error($conn));
		if($query) {
			echo "<script>alert('أوافق/نوافق على الالتزام بترخيص بادئة شركة GS1 وقبول شروط وأحكام GS1 عمان وسياسة الخصوصية.')</script>";

		}
		if($query)
		{

			$company_id=mysqli_insert_id($conn);
			$_SESSION['company_id']=$company_id;

			if($count > 1)
			{
					// for($i=0; $i<$count; $i++) {
					// 	if(trim($_POST["title"][$i] != '')) {
					// 		$sql1 =mysqli_query($conn,"INSERT INTO `company_contacts_tbl`(product_id ,company_id ,title, first_name ,last_name, job_title ,email_id, phone_number1 ,status) VALUES('$product_id','$company_id','$title[$i]','$first_name[$i]' ,'$last_name[$i]' ,'$job_title[$i]' ,'$email_id[$i]' ,'$phone_number1[$i]','0')");
					// 	}
					// }
				for($i = 0; $i < $count; $i++) {
					    if(trim($_POST["title"][$i]) != '') {  // Correct condition
					        // Sanitizing user input to avoid SQL injection
					    	$title 			= 	mysqli_real_escape_string($conn, $_POST["title"][$i]);
					    	$first_name 	= 	mysqli_real_escape_string($conn, $_POST["first_name"][$i]);
					    	$last_name 		= 	mysqli_real_escape_string($conn, $_POST["last_name"][$i]);
					    	$job_title 		= 	mysqli_real_escape_string($conn, $_POST["job_title"][$i]);
					    	$email_id 		= 	mysqli_real_escape_string($conn, $_POST["email_id"][$i]);
					    	$phone_number1 	= 	mysqli_real_escape_string($conn, $_POST["phone_number1"][$i]);

					        // Insert query
					    	$sql1 = mysqli_query($conn, "INSERT INTO `company_contacts_tbl` (product_id, company_id, title, first_name, last_name, job_title, email_id, phone_number1, status)
					    		VALUES ('$product_id', '$company_id', '$title', '$first_name', '$last_name', '$job_title', '$email_id', '$phone_number1', '0')");

					        // Optional error handling for query
					    	if (!$sql1) {
					    		die("Error inserting data: " . mysqli_error($conn));
					    	}
					    }
					}

					$order_id = 'Barcode';
					$order_id .= 1000+$company_id;
					$order_date=date('Y-m-d');
					$expiry_date=date('Y/12/31');
			//$sql2 =mysqli_query($conn,"INSERT INTO `order_tbl`(company_id ,order_id,  product_id ,user_email, registration_fee ,gtins_annual_fee, gln_price ,sscc_price,annual_subscription_fee,annual_total_price,order_date,	expiry_date,promo_code,status) VALUES('$company_id','$order_id','$product_id' ,'$user_email' ,'$registration_fee' ,'$gtins_annual_fee' ,'$gln_price','$sscc_price','$annual_subscription_fee','$annual_total_price','$order_date','$expiry_date','$promo_code','0')");
					$sql2 =mysqli_query($conn,"INSERT INTO `order_tbl`(company_id ,order_id,  product_id ,user_email, registration_fee ,gtins_annual_fee, gln_price ,sscc_price,annual_subscription_fee,annual_total_price,order_date,	expiry_date,promo_code,offline_payment,status) VALUES('$company_id','$order_id','$product_id' ,'$user_email' ,'$registration_fee' ,'$gtins_annual_fee' ,'$gln_price','$sscc_price','$annual_subscription_fee','$annual_total_price','$order_date','$expiry_date','$promo_code','$offline_payment','0')");

					if($sql2)
					{ 
						echo "<script>window.location='user/package/registrationpaymnt.php?_token=".base64_encode($order_id)."';</script>";

					} 
					echo "<script>window.location='thanks.php';</script>";

				}
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



				 //$sql="INSERT INTO `company_tbl`(product_id, product_name, registration_fee, gtins_annual_fee, gln_price, sscc_price,  annual_subscription_fee, 	annual_total_price,  name, name_ar, pobox, zipcode, address, address_ar, country, city, mobile_number, phone_number, fax_number, website_address, cr_number, cr_legal_type, cr_registration_date, cr_expiry_date, cr_tax_registration_number, user_email, password, cpassword, business_type_product_category, number_of_employee, upload_document1 , upload_document2, upload_document3, healthcare_status,main_contact_status,tnc,captcha_code, status) VALUES ('$product_id','$product_name', '$registration_fee', '$gtins_annual_fee', '$gln_price', '$sscc_price', '$annual_subscription_fee', '$annual_total_price',  '$name', '$name_ar', '$pobox', '$zipcode','$address', '$address_ar', '$country', '$city','$mobile_number', '$phone_number', '$fax_number', '$website_address','$cr_number','$cr_legal_type', '$cr_registration_date','$cr_expiry_date','$cr_tax_registration_number', '$user_email', '$password','$cpassword','$business_type_product_category','$number_of_employee', '$doc_path1','$doc_path2','$doc_path3','$healthcare_status','$main_contact_status','$tnc', '$captcha_code','0' )";

				 //$query=mysqli_query($conn,$sql)or die(mysqli_error($conn));





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

						  		<!--<tr>

						  			<td class="fw-bold">  المنتج / الخدمات   </td>

						  			<td class="fw-bold"> رسوم التسجيل   <span class="fo-12">  مره واحده  </span></td>

						  			<td class="fw-bold">  التجديد السنوي   </td>

						  		</tr>-->

						  		<!--<tr>

						  			<input type="hidden" name="product_name" value="<?=$productData['product_name']?>">

						  			<input type="hidden" name="registration_fee" value="<?=$productData['registration_fee']?>">

						  			<input type="hidden" name="gtins_annual_fee" value="<?=$productData['gtins_annual_fee']?>">

						  			<td><?=$productData['product_name']?> </td>

						  			<td><?=$productData['registration_fee']?> </td>

						  			<td><?=$productData['gtins_annual_fee']?> </td>

						  		</tr>-->

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

						  							<td>هل تحتاج إلى رقم GTIN: أرقام الأصناف التجارية العالمية؟<span class="text-danger" data-toggle="tooltip" title="GTIN: Definition">!</span></td>
						  							<input type="hidden" name="registration_fee" value="<?=$productData['registration_fee']?>">
						  							<input type="hidden" name="product_name" value="<?=$productData['product_name']?>">
						  							<td><span id="gtins_annual_fee"><?=$productData['gtins_annual_fee']?></span> </td>
						  						</tr>
						  						<tr>
						  							<td><input onclick="add()" type="checkbox"  name="gln_price" id="gln_price" value="<?=$productData['gln_annual_fee']?>"> </td>
						  							<td>هل تحتاج GLN؟ <span class="text-danger" data-toggle="tooltip" title="GTIN: Definition">!</span></td>
						  							<td><span id="gln_price_span"><?=$productData['gln_annual_fee']?></span></td>
						  						</tr>

						  						<?php
						  							if($productData['sscc_annual_fee']==0){}
						  							else{

						  								echo"
						  								<tr>
						  								<td>
						  								<input onclick='add()' type='checkbox' name='sscc_price' id='sscc_price' value='".$productData['sscc_annual_fee']."'> 
						  								</td>
						  								<td>Do you require SSCC? <span class='text-danger' data-toggle='tooltip' title='SSCC: Definition'>!</span></td>
						  								<td>
						  								<span id='sscc_price_span'>".$productData['sscc_annual_fee']."</span>
						  								</td>
						  								</tr>
						  								";
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

						  			<span class="fw-bold text-danger"> <?php echo date("Y"); ?>31 ديسمبر 2022 </span>

						  		</div>



						  		<div class="col-md-4">

						  			<label class="fw-bold">رسوم الاشتراك السنوي  </label>

						  			<div class="input-group mb-3">

						  				<span class="input-group-text" id="basic-addon1">يال عماني</span>

										<!--<input type="number" id="total" class="form-control mb-0" >

										  	<div id="total" class="form-control">500</div>-->



									  	<input type="hidden" name="annual_subscription_fee" id="annual_subscription_fee" value="<?=$productData['gtins_annual_fee']?>">

									  	<input type="text" class="form-control mb-0" size="2" name="annual_total_price" id="annual_total_price" value="0" disabled/>

									</div>

									<span class="fw-bold text-danger">التجديد القادم يناير<?php echo date('Y', strtotime('+1 year'));?> </span>
								</div>
								<div class="col-md-4">
									<label class="fw-bold">مجموع الرسوم </label>
									<div class="input-group mb-3">
										<span class="input-group-text" id="basic-addon1">OMR</span>
										<input name="total_price" id="total_price" type="text" class="form-control mb-0"  value="<?=$productData['registration_fee']?>" disabled>
										<input class="form-control mb-0" disabled id="demo">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-4 mb-2">
								</div>
								<div class="form-group col-4 mb-2">
								</div>
								<div class="form-group col-4 mb-2">
									<p id="vat"></p>
									<p id="discount"></p>

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

						<form name="listForm" action="" method="post" id="regform" enctype="multipart/form-data">

							<input type="hidden" name="annual_total_price" value="<?=$annual_total_price?>">

							<h4>تفاصيل عن الشركة</h4>

							<div class="row">



								<div class="col-md-6">

									<label>اسم الشركة  (انجليزي)	*</label>

									<input type="text" class="form-control" maxlength="100" name="name" placeholder="اسم الشركة  (انجليزي)" title="هذه الخانة مطلوبه" required>

								</div>

								<div class="col-md-6">

									<label>اسم الشركة  (عربي)	*</label>

									<input type="text" class="form-control alpha_char" maxlength="100" name="name_ar" placeholder="اسم الشركة  (عربي)" title="هذه الخانة مطلوبه" required>

								</div>

								<div class="col-md-6">

									<label>صندوق بريد	*</label>

									<input type="text" class="form-control number" maxlength="6" name="pobox"  placeholder="صندوق بريد 000" pattern="[0-9]+" title="من فضلك أدخل أرقام فقط" required>

								</div>

								<div class="col-md-6">

									<label>الرمز البريدي	*</label>

									<input type="number" class="form-control number" maxlength="3" name="zipcode" placeholder="مائة وثلاثة وعشرون" pattern="[0-9]+" title="من فضلك أدخل أرقام فقط" required>

								</div>

								<div class="col-md-6">

									<label>العنوان (انجليزي)	*</label>

									<input type="text" class="form-control" name="address" placeholder="ررقم المكتب ، رقم المبنى ، الطريق رقم ، المدينة" title="هذه الخانة مطلوبه" required>

								</div>

								<div class="col-md-6">

									<label>العنوان (عربي)	*</label>

									<input type="text" class="form-control" name="address_ar" placeholder="رقم المكتب ، رقم المبنى ، الطريق رقم ، المدينة" title="هذه الخانة مطلوبه" required>

								</div>



								<div class="col-md-6">

									<label>  دالدوله    </label>

									<select class="form-control" name="country"  title="هذه الخانة مطلوبه" required>

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

									<input type="text" class="form-control number" name="mobile_number" placeholder="0000 0000 968" pattern="\d{11}" title="الرجاء إدخال رقم الهاتف المحمول المكون من 11 رقمًا" maxlength="11" minlength="11" required>

								</div>

								<div class="col-md-6">

									<label>رقم الهاتف *</label>

									<input type="text" class="form-control number" name="phone_number" placeholder="0000 0000 968" pattern="\d{11}" title="الرجاء إدخال رقم الهاتف المحمول المكون من 11 رقمًا" maxlength="11" minlength="11" required>

								</div>

								<div class="col-md-6">

									<label>رقم الفاكس</label>

									<input type="text" class="form-control number" name="fax_number" placeholder="0000 0000 968"     pattern="\d{11}" title="الرجاء إدخال رقم الفاكس المكون من 11 رقمًا" maxlength="11" minlength="11">

								</div>

								<div class="col-md-6">

									<label>  الالموقع الالكتروني     </label>						

									<input type="text" class="form-control" name="website_address" placeholder="www.gs1oman.org" pattern="https?://(www\.)?.+(\..+)" title="الرجاء إدخال عنوان URL صالح لموقع الويب يبدأ بـ http:// أو https://">

								</div>

							</div>



							<hr>
							<h4>تفاصيل أخرى *</h4>
							<div class="row">
								<div class="col-md-12">
									<label>هل لديك شهادة ريادة*</label><br>
									<select class="form-control" name="riyada_certificate" id="riyada_certificate" title="هذه الخانة مطلوبه"  required>
										<option value="">Select</option>
										<option value="Yes">نعم</option>
										<option value="No">لا</option>
									</select>
								</div>
								<div class="col-md-6" id="expiry_date_container" style="display: none;">
									<label>تاريخ الانتهاء*</label>
									<input type="date" class="form-control" placeholder="" name="exp_date" min="<?php echo date('Y-m-d'); ?>">
								</div>
								<div class="col-md-6" id="documents_container" style="display: none;">
									<label>وثائق*</label><br>
									<input type="file" class="form-control-file" id="documents_req" name="documents_req">
								</div>
							</div>

							<hr>
							<h4>تفاصيل السجل التجاري</h4>

							<div class="row">

								<div class="col-md-6">

									<label>رقم السجل التجاري *</label>

									<input type="number" class="form-control number" name="cr_number" maxlength="12" placeholder="رقم السجل التجاري" title="هذه الخانة مطلوبه"  required>

								</div>

								<div class="col-md-4">

									<label> تاريخ التسجيل    </label>

									<input type="text" placeholder="dd-mm-yyyy" onfocus="(this.type='date')"   class="form-control" name="cr_registration_date" max="<?php echo date('Y-m-d'); ?>">

								</div>

								<div class="col-md-4">

									<label>  تاريتاريخ الانتهاء    </label>

									<input type="text" placeholder="dd-mm-yyyy" onfocus="(this.type='date')"  class="form-control"  name="cr_expiry_date" min="<?php echo date('Y-m-d'); ?>" onfocus="(this.type='date')">

								</div>



								<div class="col-md-6">

									<label>الشكل القانوني:*</label>

									<div style="clear: both;"></div>

									<select name="cr_legal_type" title="هذه الخانة مطلوبه"  required>

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

									<label> رقم التسجيل الضريبي </label>

									<input type="number" class="form-control number" maxlength="12" name="cr_tax_registration_number" placeholder="رقم التسجيل الضريبي" pattern="[0-9]+">

								</div>

							</div>

							<hr>

							<div class="row">

								<div class="col-md-12">

									<label><b>عنوان البريد الإلكتروني الرئيسي *</b></label>

									<input type="email" class="form-control" placeholder="user@email.com" name="user_email" title="هذه الخانة مطلوبه"  required>

								</div>





							</div>



							<hr>

							<h4> نوع النشاط </h4>

							<div class="row">

								<div class="col-md-6">

									<label>فئة المنتج الرئيسية *</label>

									<select name="business_type_product_category" title="هذه الخانة مطلوبه"  required>

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

									<input type="number" class="form-control number" name="number_of_employee">

								</div>

							</div>



							<hr>



							<h4>هل انت في الرعاية الصحية؟</h4>

							<div class="row">

								<div class="col-md-12">

									<label>هل أنت بصدد تحديد الأجهزة الطبية التي تندرج تحت إدارة الغذاء والدواء الأمريكية (FDA) أو نظام تحديد الأجهزة الفريد (UDI)؟ <span class="text-danger" data-toggle="tooltip" title="The U.S. FDA considers a product to be a device if it meets the definition of a medical device per Section 201(h) of the Food, Drug, and Cosmetic Act.">!</span></label>

								</div>

								<div class="col-md-12">

									<input type="radio" name="healthcare_status" value="نعم" class="tick" title="هذه الخانة مطلوبه"  required> &nbsp; نعم 

									<input type="radio" name="healthcare_status" value="لا" class="tick" title="هذه الخانة مطلوبه"  required> &nbsp; لا

								</div>



							</div>



							<hr>

							<h4> جهات التواصل بالشركه بحد أدنى شخصين </h4>

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

									<input type="text" name="first_name[] alpha_char" class="form-control " placeholder="الاسم الاول:" pattern="[A-Za-z]+" required>

								</div>

								<div class="col-md-5">

									<label>القبيلة</label>

									<input type="text" name="last_name[] alpha_char" class="form-control" placeholder="القبيلة" pattern="[A-Za-z]+">

								</div>



								<div class="col-md-2">

									<label>المسمى الوظيفي:</label>

									<select class="form-control" name="job_title[]">

										<option value="CEO">المدير التنفيذي.</option>CEO.

										<option value="Staff">العاملين.</option>

										<option value="Accounts">	حسابات.</option>

									</select>

								</div>

								<div class="col-md-5">

									<label>البريد الإلكتروني:</label>

									<input type="email" name="email_id[]" class="form-control unique-email" placeholder="user@gs1.org" required>

								</div>

								<div class="col-md-5">

									<label>رقم الهاتف:</label>

									<input type="text" name="phone_number1[]" class="form-control number unique-phone" placeholder="0000 0000 968" pattern="\d{11}"  maxlength="11" minlength="11" title="الرجاء إدخال رقم الهاتف المحمول المكون من 11 رقمًا" required>

								</div>

								<div class="col-md-12">

									<span> “هل هذا هو جهة الاتصال الرئيسية؟ سيقوم هؤلاء المستخدمون بإدارة GTINS في حساب تنشيط GS1 الخاص بك وسيتم استخدام تفاصيلهم في GEPIR كجهة الاتصال الأساسية الرئيسية لشركتك " </span><br>

						<!--<input type="radio" name="main_contact_status" value="نعم" class="tick"> &nbsp; نعم

							<input type="radio" name="main_contact_status" value="قم" class="tick"> &nbsp; قم-->



						</div>

					</div>



					<hr>



					<div id="dynamic-field-1" class="dynamic-field">

						<h5 class="fw-bold">جهة أتصال 2</h5>

						<div class="row">

							<div class="col-md-2">

								<label> السيده </label>

								<select class="form-control validate" name="title[]">

									<option value="لسيدة.">لسيدة.</option>

									<option value="لسّيدة.">لسّيدة.</option>

									<option value="الآنسة">الآنسة</option>

									<option value="Dr.">كتور </option>

								</select>
								<span class="text-danger"></span>

							</div>

							<div class="col-md-5">

								<label>الاسم الاول:</label>

								<input type="text" name="first_name[]" class="form-control validate" placeholder="الاسم الاول:">
								<span class="text-danger"></span>

							</div>

							<div class="col-md-5">

								<label>القبيلة</label>

								<input type="text" name="last_name[]" class="form-control validate" placeholder="القبيلة">
								<span class="text-danger"></span>

							</div>



							<div class="col-md-2">

								<label>المسمى الوظيفي:</label>

								<select class="form-control validate" name="job_title[]">

									<option value="CEO">المدير التنفيذي.</option>CEO.

									<option value="Staff">العاملين.</option>

									<option value="Accounts">	حسابات.</option>

								</select>
								<span class="text-danger"></span>

							</div>

							<div class="col-md-5">

								<label>البريد الإلكتروني:</label>

								<input type="email" name="email_id[]" class="form-control validate unique-email" placeholder="user@gs1.org">
								<span class="text-danger"></span>

							</div>

							<div class="col-md-5">

								<label>رقم الهاتف:</label>

								<input type="text" name="phone_number1[]" class="form-control validate unique-phone"  id="phone_number1" placeholder="0000 0000 968" pattern="\d{11}"  maxlength="11" minlength="11"  title="الرجاء إدخال رقم الهاتف المحمول المكون من 11 رقمًا">
								<span class="text-danger"></span>

							</div>



						</div>

					</div>
					<div id="errorDiv" class="alert alert-danger" role="alert" style="display: none;">
						<!-- Error message will go here -->
						
					</div>

					<div style="clear: both;"></div>

					<h5 class="fw-bold">إضافة جهة اتصال أخرى</h5>



					<button type="button" id="add-button" class="btn btn-primary float-left text-uppercase shadow-sm"><i class="fas fa-plus fa-fw"></i> اضافة </button>

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

							<label>شمسموح انتساب الغرفة *</label>

							<input type="file" class="form-control mb-0" name="upload_document2">

							<span class="fo-12">سمسموحبتنسيق JPG و PDF و PNG </span>

						</div>

						<div class="col-md-4">

							<label>مسمسموحت أخرى  *</label>

							<input type="file" class="form-control mb-0" name="upload_document3">

							<span class="fo-12">سمسموحبتنسيق JPG و PDF و PNG </span>

						</div>

					</div>



					<hr>

					<h4>اختر الباقة</h4>



					<div class="row">

						<div class="col-md-12">

							<label>كم عدد GTINS التي تحتاجها؟ <span class="text-danger" data-toggle="tooltip" title="GTIN: Definition">!</span></label>

							<div class="button dropdown"> 

								<select name="product_id" id="product_id" onchange="show_package_details();"  title="هذه الخانة مطلوبه" required>

									<option selected disabled>اختر الباقة</option>

									<?php 

									$query = "SELECT * FROM product_tbl ORDER BY gtins_name ASC ";     

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
	    	<h5>عند التقديم لبرنامج التحقق الشامل من GCP، تشمل الخدمات التالية::</h5>
	    	<div class="full-width-content">
	    		<ol>
	    			<li>لقد تم منحك ترخيص "GS1 Company Prefix" الذي يتيح لك الوصول إلى GS1 واستخدامه
	    				معايير تعريف النظام. يتيح برنامج Google Cloud Platform للشركة إنشاء أي من مفاتيح تعريف GS1،
	    				بما في ذلك، على سبيل المثال لا الحصر، رقم السلعة التجارية العالمية ("GTIN") ورقم الموقع العالمي ("GLN")
	    			ورمز حاوية الشحن التسلسلي ("SSCC") ("مفاتيح تعريف GS1").</li>
	    			<li>يتم منحك حق الوصول إلى أداة "GS1 Activate" الخاصة بنا، والتي تتيح لك الإنشاء والإدارة
	    				أرقام الباركود الخاصة بك وإنشاء صور الباركود المقابلة تلقائيًا.
	    				سياسة الاسترجاع
	    				بمجرد تقديمها، تكون رسوم الطلب غير قابلة للاسترداد. لا يجوز استرداد المبالغ بعد 24 ساعة من
	    				تقديم نموذج طلب لأي سبب كان (بما في ذلك على سبيل المثال لا الحصر الطلبات
	    				تم تقديمه بالخطأ). كرسوم إدارية، يمكن اعتبار جميع الطلبات قد تم استلامها و
	    				تتم معالجتها خلال 24 ساعة من التقديم. طلب إلغاء الطلب أو استرداد الطلب
	    				يجب أن يتم استلام الرسوم من قبل GS1 عمان خلال 24 ساعة من تقديم نموذج الطلب عبر
	    				helpdesk@gs1oman.org بعد هذه المدة، لن يتم استرداد أي مبالغ.
	    				لقد فهمت أنه سيتم فرض رسوم (رسوم) سنوية على شركتي وفقًا لترخيص (تراخيص) شركتي
	    			يتم تطبيقه سنويًا ورسوم الاشتراك السنوية قابلة للتجديد في الأول من يناير من كل عام تقويمي.</li>

	    		</ol>
	    	</div>
	    	<div class="col-md-12">
	    		<div id="offline_payment_group">
	    			<label class="fw-bold">Payment Method</label><br>
	    			<!-- Change the value of the button dynamically to ensure that it displays the correct Arabic text and its values, with the text direction set to right-to-left.  -->
	    			<input type="radio" name="offline_payment" value="1" class="tick" required>&nbsp; Pay By Card &nbsp; 
	    			<input type="radio" name="offline_payment" value="0" class="tick" required> &nbsp; Cash
	    		</div>
	    		<div id="offline_payment_error" style="color: red;"></div>
	    	</div>
	    	<input type="hidden" id="param1" value="<?php echo $productData['registration_fee']+$productData['gtins_annual_fee']+$productData['gln_price']+$productData['sscc_price'] ?>">


	    	<div id="offline_payment_instructions" style="display: none;">
	    		<h3><u>Offline Payment Instructions:</u></h3>
	    		<p>Thank you for choosing our products! To proceed with offline payment, please follow the instructions below:</p>
	    		<h4>Payment Method Description:</h4>
	    		<p>Offline payment allows you to pay for your order outside of our website. You can choose from the following methods:</p>
	    		<ol>
	    			<li><b>Bank Transfer:</b> Make a direct bank transfer to the account provided below.</li>
	    			<li><b>Cash on Delivery (COD):</b> Pay the delivery agent with cash when your order is delivered.</li>
	    		</ol>
	    		<h4>Payment Instructions:</h4>
	    		<h6>Bank Transfer:</h6>
	    		<p>Bank Name: Dummy Bank Account Name: Sample Company Account Number: 1234567890 Routing Number: 987654321 SWIFT/BIC: DUMMYBANKCODE Reference: [Your Order Number]</p>
	    		<h6>Cash on Delivery (COD):</h6>
	    		<p>Please prepare the exact amount in cash to be paid to the delivery agent upon receiving your order.</p>
	    		<h6>Payment Deadline:</h6>
	    		<p>Please complete the offline payment within 3 business days from the date of order placement. Failure to do so may result in order cancellation</p>
	    		<h6>Contact Information:</h6>
	    		<p>If you have any questions or need assistance with the offline payment process, feel free to contact our customer support team:</p>
	    		<ol style="list-style-type: circle">
	    			<li>Email:<a href="#">support@samplecompany.com</a></li>
	    			<li>Phone: +1 (800) 123-4567</li>
	    		</ol>

	    		<h6>Order Confirmation:</h6>
	    		<p>Once we receive and verify your payment, we will process your order and send you an order confirmation via email.</p>
	    		<h6>Cancellation Policy:</h6>
	    		<p>You can cancel your order before making the payment. If you've already made the payment and wish to cancel, please contact our customer support team for assistance with the refund process.</p>
	    		<h6>Security Precautions:</h6>
	    		<p>Your payment security is essential to us. We do not store any sensitive payment information on our website. All online transactions are encrypted and secured using industry-standard SSL technology.</p>
	    	</div>
	    	<div class="row">

	    		<div class="col-md-12">

	    			<input type="checkbox" id="finalpay1" class="tick" required name="tnc" value=" نعم "> &nbsp; <span>قبول <a id="finalpay" href="#" class="text-orange" data-bs-toggle="modal" data-bs-target="#terms"> الأحكام والشروط </a>/ <a href="#" class="text-orange" data-bs-toggle="modal" data-bs-target="#privacy"> سياسة الخصوصية </a> </span>

	    		</div>

	    	</div>
					<!--<div class="col-md-12">
						<input type="radio" name="offline_payment" value="0" class="tick"> &nbsp; Pay By Card
						<input type="radio" name="offline_payment" value="1" class="tick"> &nbsp; Cash
					</div>-->


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


						<b><u><center>أ‌.	رخصة بادئة شركة جي اس 1</center></u></b>

						<p>تم إبرام "رخصة بادئة شركة جي اس 1" ("الترخيص") بين جي اس 1 عمان التي تأسست تحت اسم مركز عمان للترقيم، وهي منظمة غير ربحية، برقم تسجيل 1360120، ومقر عملها الرئيسي في شارع المركز التجاري الطابق الأول (غرفة تجارة وصناعة عمان) OCCI، روي، مسقط في سلطنة عمان، (يشار إليها فيما يلي بإسم " جي اس 1 عمان"؛ والكيان الذي تم تحديده على أنه "شركة" بموجب هذه الاتفاقية، والذي يقدم قبوله بموجب هذه الاتفاقية.</p>

						<p><b>1.	منح الترخيص. م</b>ع مراعاة شروط هذا الترخيص ولفترة الترخيص، تمنح جي اس 1 عمان بموجب هذا الشركة ترخيصًا عالميًا غير حصري وغير قابل للتحويل وقابل للإلغاء لاستخدام بادئة شركة جي اس 1 عمان ("GCP") الصادرة لها فيما يتعلق ببيع وتوريد منتجاتها. لا يجوز ترخيص الترخيص الممنوح هنا من الباطن كليًا أو جزئيًا، وستكون أي محاولة للحصول على ترخيص من الباطن باطلة من أساسها.</p>

						<p><b>2.	الاستخدام. يتيح</b> " GCP" الوصول إلى معايير تعريف نظام جي اس 1 واستخدامها. يسمح "GCP" للشركة بإنشاء أي من مفاتيح تعريف جي اس 1، بما في ذلك على سبيل المثال لا الحصر، أرقام السلع التجارية العالمية ("GTIN") ورقم الموقع العالمي ("GLN") ورمز حاوية الشحنة المتسلسل ("SSCC") ("مفاتيح تعريف جي اس 1"). لمساعدة الشركة في إنشاء وإدارة أرقام السلع التجارية العالمية، يوفر جي اس 1 عمان للشركة خدمة محددة تسمى "تفعيل" والتي تحكمها شروط استخدام منفصلة (انظر القسم ب أدناه).</p>

						<p><b>3.	المدة. </b>يدخل الترخيص حيز التنفيذ بالنسبة للشركة في التاريخ الذي يخطر فيه جي اس 1 عمان الشركة بقبولها لطلبه ويستمر حتى يتم إنهاؤه كما هو منصوص عليه في القسم 9.</p>

						<p><b>4.	الرسوم.</b></p>
						<p>أ‌.	يتعين على الشركة دفع رسوم الترخيص السنوية لبرنامج " GCP" ("رسوم الترخيص") إلى جي اس 1 عمان سنويًا في غضون 30 يومًا من تاريخ فاتورة جي اس 1 عمان.</p>
						<p>ب‌.	قد تزيد جي اس 1 عمان رسوم الترخيص  من وقت لآخر.</p>
						<p>ت‌.	تحتفظ جي اس 1 عمان لنفسها بالحق في فرض فائدة بنسبة 12 ٪ سنويا في حالة التخلف عن السداد في تاريخ الاستحقاق.</p>
						<p>ث‌.	تقر الشركة وتوافق على أن جي اس 1 عمان قد تسترد أي تكلفة تتكبدها فيما يتعلق باسترداد أي رسوم متأخرة أو غير مدفوعة إلى جي اس 1 عمان بما في ذلك على سبيل المثال لا الحصر الفوائد ورسوم تحصيل الديون والمصروفات والرسوم القانونية المعقولة.</p>
						<p>ج‌.	عندما تكون المنتجات التي تحمل أرقام تعريف جي اس 1 عمان الصادرة إلى الشركة موجودة بالفعل في السوق في وقت إنهاء الترخيص، على الرغم من هذا الإنهاء، ستظل الشركة مسؤولة عن رسوم تعادل رسوم الترخيص الحالية في ذلك الوقت للفترة التي تواصل الشركة توزيعها تلك المنتجات التي تحمل أرقام تعريف جي اس 1 عمان.</p>

						<p><b>5.	التزامات الشركة والاستخدام المسموح به.</b> يجب على الشركة:</p>
						<p>أ‌.	عدم فعل أو اللجوء إلى فعل أي شيء في أي وقت قد يكون من خلاله الشهرة التجارية أو سمعة جي اس 1 عمان معرضه للاسقاط أو سوء السمعة؛</p>
						<p>ب‌.	عدم استخدام برنامج "GCP" الذي تم إصداره لها إلا فيما يتعلق بتصنيع منتجاتها وبيعها وتحديدها؛</p>
						<p>ت‌.	استخدم مفاتيح تعريف جي اس 1 الصادرة لها من جي اس 1 عمان أو منظمة عضو جي اس 1 فقط؛</p>
						<p>ث‌.	عدم محاولة تغيير أو نقل أو مشاركة أو بيع أو تأجير أو الترخيص من الباطن أو تقسيم مفاتيح تعريف GCP و / أو جي اس 1 الصادرة عن جي اس 1 عمان ولا يجوز السماح باستخدامها من قبل أي طرف آخر؛</p>
						<p>ج‌.	عدم استخدام أي أرقام تماثل نظام الترقيم جي اس 1 عمان ومفاتيح تعريف جي اس 1؛</p>
						<p>ح‌.	الاعتراف بحق جي اس 1 عمان وملكيتها ومصلحتها في برنامج "GCP" وجميع حقوق الملكية الفكرية ذات الصلة، بما في ذلك على سبيل المثال لا الحصر، العلامات التجارية وحقوق التأليف والنشر، ولا يجوز للشركة في أي وقت القيام أو السماح بالقيام بأي عمل أو أي شيء قد يكون في أي وقت تضعف حق جي اس 1 عمان أو حق ملكيتها أو مصالحها في برنامج "GCP" أو حقوق الملكية الفكرية ذات الصلة؛</p>
						<p>خ‌.	التأكد من أن منتجاتها تحمل جميع إشعارات الملكية التي قد تطلب جي اس 1 عمان من الشركة عرضها من وقت لآخر؛</p>
						<p>د‌.	الامتثال للمواصفات العامة جي اس 1، المتاحة عبر
						https://www.gs1.org/standards/barcodes-epcrfid-id-keys/gs1-general-specifications ، وأي مواصفات فنية أخرى يمكن تنفيذها و / أو تعديلها من وقت إلى زمن؛</p>
						<p>ذ‌.	يجب أن تخطر جي اس 1 عمان على الفور بأي تغيير في تفاصيل الاتصال الخاصة بها (بما في ذلك اسم (أسماء) الاتصال ورقم الهاتف وعنوان البريد الإلكتروني وصفحة الويب) وتضمن أن تكون تفاصيلها محدثة وصحيحة في جميع الأوقات؛</p>
						<p>ر‌.	إخطار جي اس 1 عمان بأي تغيير في هيكل الشركة بما في ذلك على سبيل المثال لا الحصر الاندماج أو الاستحواذ أو الشراء الجزئي أو التقسيم أو "الانقسام"؛</p>
						<p>ز‌.	عند الإنهاء، مساعدة جي اس 1 عمان على تحديد مفاتيح تعريف جي اس 1 التي قد تكون متداولة والتأكد من أن تجار التجزئة والموزعين، عند الطلب، مطالبون بتزويد جي اس 1 عمان بتفاصيل جميع مفاتيح تعريف جي اس 1 المتعلقة بالشركة والتي تمت معالجتها في الاثني عشر شهر السابقين؛</p>
						<p>س‌.	التأكد من حصولها على جميع الموافقات والتصاريح والتراخيص اللازمة والحفاظ عليها لتشغيل أنشطتها التجارية وأن تصنيع منتجاتها وتوزيعها وتعبئتها و / أو بيعها يتوافق مع جميع القوانين السارية.</p>

						<p><b>6.	المسؤولية والتعويض.</b></p>
						<p>أ‌.	إخلاء المسؤولية عن الضمانات: تقر الشركة وتوافق على أن جي اس 1 عمان لا تقدم أي تعهدات أو ضمانات، صريحة أو ضمنية بخصوص نظام جي اس 1، يتم التنصل صراحةً من مفاتيح تعريف GCP و جي اس 1 وأي تمثيل أو ضمان من هذا القبيل، بما في ذلك على سبيل المثال لا الحصر القابلية للتسويق أو الملاءمة لغرض معين.</p>
						<p>ب‌.	حدود المسؤولية: إلى أقصى حد يسمح به القانون، فإن المسؤولية الإجمالية لشركة جي اس 1 عمان تجاه الشركة عن الخسائر أو الأضرار من أي نوع والناشئة عن هذا الترخيص لأي وجميع المطالبات تقتصر على إجمالي رسوم الترخيص المدفوعة للشركة خلال فترة الـاثني عشر شهرًا التي تسبق نشوء المسؤولية ذات الصلة. جي اس 1 عمان لن تكون مسؤولة عن أي أضرار تبعية أو غير مباشرة أو عرضية أو عقابية، بما في ذلك على سبيل المثال لا الحصر خسارة الإيرادات أو الأرباح أو الأعمال التي قد تنشأ عن استخدام الشركة لبرنامج GCP ، مفتاح تعريف جي اس 1 و/ أو نظام جي اس 1.</p>
						<p>ت‌.	التعويض: توافق الشركة على ابراء ذمة جي اس 1 عمان والشركات التابعة لها، وكل من مديريها ومسؤوليها ووكلائها وموظفيها وممثليها من وضد أي مطالبات، وإجراءات، وأضرار، وتكاليف، ونفقات (بما في ذلك أتعاب المحاماة المعقولة)، والمسؤوليات الناشئة عن أو المتعلقة بعدم التزام الشركة (بما في ذلك مسؤوليها وموظفيها ووكلائها) أو خرقها لهذا الترخيص (باستثناء الحد الناجم عن إهمال جي اس 1 عمان أو سوء السلوك المتعمد).</p>
						<p><b>7.	</b>التعليق. يجوز لشركة جي اس 1 عمان تعليق ترخيص برنامج "GCP" الخاص بالشركة بأثر فوري من خلال إشعار كتابي للشركة إذا ارتكبت الشركة خرقًا جوهريًا لأي شرط من شروط هذا الترخيص وإلى أن يتم علاج هذا الخرق.</p>
						<p><b>8.</b>	الإنهاء. يجوز لشركة جي اس 1 عمان إنهاء الترخيص: (1) على الفور من خلال تقديم إشعار كتابي إذا لم تتمكن الشركة من دفع رسوم الترخيص بحلول تاريخ استحقاقها أو إذا ارتكبت الشركة خرقًا لالتزاماتها بموجب هذا الترخيص ولم تتمكن من علاجه في غضون 15 يومًا من إصدار كتابي إشعار، أو (2) إلى أقصى حد يسمح به القانون العماني، بأثر فوري في حالة دخول الشركة في ترتيب أو التصفية أو الإفلاس أو تم حلها بطريقة أخرى. يجوز لأي من جي اس 1 عمان أو الشركة إنهاء هذا الترخيص في أي ظروف أخرى من خلال تقديم إشعار خطي مدته ستة أشهر للطرف الآخر. يجوز للشركة إنهاء هذا الترخيص عن طريق إرسال إخطار كتابي مدته ثلاثين (30) يومًا من إلى جي اس 1 عمان في حالة قيام جي اس 1 عمان بتعديل شروط الترخيص وفقًا للقسم 14 أدناه. لا يعفي إنهاء هذا الترخيص شركة جي اس 1 عمان أو الشركة من المسؤولية الناشئة عن أي خرق سابق لشروط هذا الترخيص.</p>
						<p><b>9.عواقب الإنهاء. </b>في حالة إنهاء الترخيص، تلتزم الشركة بما يلي</p>
						<p>أ‌.	التوقف فورًا عن تطبيق مفاتيح تعريف جي اس 1 الصادرة عن جي اس 1 عمان على أي من المنتجات المصنعة و / أو الموزعة و / أو المعبأة و / أو المباعة من قبل الشركة بعد تاريخ الإنهاء؛</p>
						<p>ب‌.	سحب المنتجات التي تستخدم أو تعرض أي مفتاح تعريف لجي اس 1 صادر عن جي اس 1 عمان على الفور من السوق أو إعادة تسمية المنتجات للتأكد من أن مفاتيح تعريف جي اس 1 غير قابلة للقراءة؛</p>
						<p>ت‌.	عندما تظل المنتجات التي تحمل مفاتيح تعريف جي اس 1 الصادرة عن جي اس 1 عمان إلى الشركة في السوق في وقت الإنهاء، فبالرغم من هذا الإنهاء، تظل الشركة مسؤولة عن رسوم تعادل رسوم الترخيص عن الفترة التي يبقى فيها توزيع منتجات الشركة أو خلاف ذلك في السوق؛</p>
						<p>ث‌.	مساعدة جي اس 1 عمان في الاتصال والتحقق من الموزعين وتجار التجزئة الخارجيين الذين باعت الشركة من خلالهم منتجاتها فيما إذا كانت الشركة قد امتثلت لالتزامات ما بعد الإنهاء الموضحة هنا؛ </p>
						<p>ج‌.	وتكون مسؤولة على الفور عن جميع الرسوم المستحقة الدفع إلى جي اس 1 عمان، وتخضع هذه الرسوم المستحقة لمعدل فائدة جزائي قدره 12 ٪ سنويًا، أو أي معدل آخر يحدده جي اس 1 عمان من تاريخ الاستحقاق الأصلي للدفع.</p>
						<p><b>10.	الخصوصية. س</b>تتعامل جي اس 1 عمان مع أي بيانات شخصية تقدمها الشركة والمستخدمون المعتمدون لها وفقًا لسياسة الخصوصية المتاحة على موقع جي اس 1 عمان (بصيغتها المعدلة من وقت لآخر).</p>
						<p><b>11.	الإحالة</b>. لا يجوز للشركة إحالة حقوقها والتزاماتها بموجب هذا الترخيص إلى أي طرف آخر (سواء إلى كيان ذي صلة أو طرف ثالث) دون الحصول على موافقة خطية صريحة مسبقة من جي اس 1 عمان، يتم منح هذه الموافقة وفقًا لتقدير جي اس 1 عمان المطلق. يعتبر أي إحالة مزعومة لهذا الترخيص من قبل الشركة، دون موافقة خطية صريحة مسبقة من جي اس 1 عمان، باطلاً من حيث المبدأ.</p>
						<p>12.	<b>الاشعارات. يجب</b> أن تكون جميع الإشعارات المطلوبة بموجب هذه الاتفاقية مكتوبة (بما في ذلك البريد الإلكتروني) إلى عنوان العمل التجاري المسجل للطرف الآخر أو مكان العمل الرئيسي أو عنوان (البريد الإلكتروني) المحدد عند التسجيل لاستخدام التفعيل أو التحديث بطريقة أخرى من قبل الشركة أو المستخدمين المصرح لهم في التفعيل من وقت لآخر.</p>
						<p>
							<b>13.	سلطة التعا</b>قد. تقر الشركة وتضمن أنها تمتلك السلطة اللازمة ومصرح لها بالدخول في هذه الاتفاقية الملزمة والوفاء بالتزاماتها بموجب هذه الاتفاقية.
						</p>
						<p><b>14.	التعديل. تح</b>تفظ جي اس 1 عمان بالحق في تعديل هذا الترخيص من وقت لآخر، ويجب أن يتم توفير هذا التعديل بشكل عام للشركة عبر تفاصيل الاتصال المقدمة إلى جي اس 1 عمان وستصبح هذه التغييرات سارية المفعول بعد ستين (60) يومًا من إبلاغ الشركة بالتعديل، ما لم تقرر الشركة إنهاء الترخيص وفقًا للقسم 8 أعلاه.</p>
						<p><b>15.	الاتفاقية الكاملة. </b>يحدد هذا الترخيص، بما في ذلك جميع الملحقات، التفاهم الكامل بين الطرفين فيما يتعلق بالموضوع الوارد بها، ويبطل جميع الاتفاقات والتفاهمات أو الشروط المكتوبة السابقة، سواء صريحة أو ضمنية، شفهية ومكتوبة، باستثناء ما هو وارد في هذا الترخيص.</p>
						<p><b>16.	عدم الشراكة. يقر الطرفا</b>ن ويوافقان على أن هذا الترخيص لا يشكل أي ائتلاف شركات أو شراكة أو عقد عمل بينهما. لا يوجد في هذا الترخيص ما يجب أن يُبنى على أنه ائتلاف شركات أو وكالة أو اتفاقية شراكة بين الطرفين.</p>
						<p><b>17.	عدم التنازل.</b> لا يعتبر اخفاق أو تأخير أحد الطرفين في ممارسة أي حق أو تعويض أو سلطة أو امتياز كليًا أو جزئيًا بموجب هذا الترخيص بمثابة تنازل عنه. لن يكون أي تنازل ساريًا ما لم يكن كتابيًا وموقعًا من قبل الطرف الذي أكد على منح هذا التنازل.</p>
						<p><b>18.	قابلية الفصل. </b>إذا أصبح أي حكم من أحكام هذا الترخيص غير صالح أو غير قانوني أو غير قابل للتنفيذ أو أصبح غير صالح، فسيتم فصل هذا الحكم وستظل بقية الأحكام سارية المفعول والتأثير الكامل.</p>
						<p><b>19.	القانون المعمول به والاختصاص القضائ</b>ي. يخضع هذا الترخيص ويفسر وفقًا لقوانين سلطنة عمان، بغض النظر عن مبادئ تنازع القوانين. بالإضافة إلى ذلك، توافق وتقبل الشركة الخضوع للاختصاص القضائي الحصري لأي محكمة تقع في مسقط، سلطنة عمان لأي إجراءات أو دعاوى تنشأ عن أو تتعلق بهذا الترخيص. على الرغم مما سبق ذكره، تقبل الشركة أن جي اس 1 عمان سيسمح لها مع ذلك بالتقدم بطلب للحصول على تعويضات بأمر زجري (أو أنواع أخرى مكافئة من سبل الانتصاف القانونية العاجلة) في أي ولاية قضائية.</p>
						<p><b>20.	الترجمات. تم</b>ت صياغة شروط الاستخدام هذه في الأصل باللغتين الإنجليزية والعربية. في حالة وجود تعارض بين اللغتين، تسود النسخة الإنجليزية.</p>
						<p><b>الملحق 1 للترخيص المسبق لشركة جي اس 1<br>
						الشروط والأحكام الخاصة بمعرف الجهاز</b></p>
						يحدد هذا الملحق 1 (شروط وأحكام معرف الجهاز الفريد) لترخيص بادئة شركة جي اس 1 الشروط والأحكام الإضافية التي تنطبق على الشركة عند استخدام معايير جي اس 1 ومفاتيح التعريف على الأجهزة الطبية لأغراض معرف الجهاز الفريد.

						<p><b>1.</b>	يُستخدم معرّف الجهاز الفريد ("UDI") لتحديد المنتج المصنف على أنه جهاز طبي بموجب قوانين أو لوائح الولاية القضائية حيث يتم وضع المنتج في السوق ("الجهاز (الأجهزة الطبية)"). تقع على عاتق الشركة مسؤولية تقييم وتحديد ما إذا كان منتجها مصنفًا كجهاز طبي في الولاية القضائية ذات الصلة والامتثال لجميع متطلبات معرف الجهاز الفريد والمتطلبات الأخرى.<p>

							<p><b>2.</b>	تم اعتماد جي اس 1 أو ترخيصه من قبل بعض الوكالات الحكومية والهيئات التنظيمية ("الجهة (الجهات) الرقابية") كمصدر لمعرف الجهاز الفريد، وإحدى هذه الهيئات هي إدارة الغذاء والدواء الأمريكية ("FDA"). حيثما تسمح الجهات الرقابية، يجوز للشركة استخدام معايير جي اس 1 ومفاتيح التعريف ("مفتاح (مفاتيح) جي اس 1 ") لأغراض معرف الجهاز الفريد، بشرط أن يكون هذا الاستخدام متوافقًا مع قوانين ولوائح وقواعد الاختصاص القضائي السارية.</p>

							<p><b>3.</b>عندما تكون جي اس 1 وكالة مُصدرة مُعتمدة أو مُرخصة لـمعرف الجهاز الفريد، يُطلب من جي اس 1 الامتثال لبعض الالتزامات التنظيمية، والتي تشمل تقديم معلومات (تقارير) عن جميع الشركات ضمن عضوية جي اس 1 التي تستخدم مفاتيح جي اس 1 لتحديد الأجهزة الطبية لأغراض معرف الجهاز الفريد.</p>

							<p><b>4.</b>	حيث تستخدم الشركة مفاتيح جي اس 1 لتحديد جهاز طبي لأغراض معرف الجهاز الفريد، بما في ذلك مكان استخدام الشركة لمفاتيح جي اس 1 للامتثال لقواعد إدارة الغذاء والدواء الأمريكية، وتوافق الشركة على ما يلي:</p>

							<p>أ‌.	بناءً على طلب خطي من جي اس 1، توافق الشركة على إكمال وتقديم أقرار جي اس 1 إلى جي اس 1 ("الاقرار") على الفور، والذي يتطلب معلومات تتعلق بالشركة واستخدام الشركة لبادئة شركة جي اس 1 (((GCP) وغيرها من المعلومات المطلوبة. في حالة عدم تقديم نموذج الإقرار إلى الشركة بواسطة جي اس 1 ، يجوز للشركة طلب نموذج الاقرار عن طريق الاتصال بخدمة عملاء جي اس 1 على helpdesk@gs1oman.org . توافق الشركة كذلك على إبلاغ جي اس 1 بأي تغييرات أو تحديثات لاحقة على اقرار الشركة.</p>

							<p>ب‌.	يجب على الشركة إبلاغ جي اس 1 إذا كان سيتم استخدام مفتاح جي اس 1 لتحديد جهاز طبي وفي أي دولة سيتم وضع المنتج ذي الصلة في السوق وأي تغييرات أو تحديثات لاحقة له.</p>

							<p> ت‌.	تتحمل الشركة، وستظل في جميع الأوقات، مسؤولة عن المعلومات التي تقدمها إلى جي اس 1 فيما يتعلق بالجهاز الطبي والامتثال لأية قوانين والتزامات تنظيمية سارية ويجب أن تضمن أن أي معلومات مقدمة إلى جي اس 1 دقيقة ومحدثة في جميع الأوقات.</p>

							<p> ث‌.	قد تراقب جي اس 1 التنفيذ الصحيح لمفاتيح جي اس 1 لاستخدام معرف الجهاز الفريد من قبل الشركة.</p>

							<p> ج‌.	في حالة تحديد جي اس 1 لقصور، يجوز لـجي اس 1 إبلاغ الشركة كتابيًا (موجهًا إلى جهة اتصال الشركة في الملف) بهذا القصور، واقتراح طريقة لتصحيح القصور، ومطالبة الشركة بتصحيح هذا القصور في غضون 90 يومًا تقويميًا من تاريخ الإخطار ("فترة التصحيح"). لأغراض هذا الملحق 1، يعني " القصور" أيًا مما يلي: (1) سوء تفسير المعرّف؛ (2) عدم تطابق بين اسم الشركة التي تحمل ترخيص مفتاح جي اس 1 والشركة التي تستخدم مفتاح جي اس 1؛ أو (3) أي معلومات أخرى غير دقيقة أو غير كاملة أو قديمة.</p>

							<p> ح‌.	قد يقوم جي اس 1 بمراقبة ما إذا كانت الشركة قد قامت بتصحيح القصور خلال فترة التصحيح. في حالة عدم حدوث مثل هذا التصحيح، بعد ثمانية (8) أيام تقويمية بعد انتهاء فترة التصحيح، يجوز لـجي اس 1 الاتصال بالشركة مرة أخرى والسعي لحل القصور وديا.</p>

							<p> خ‌.	إذا لم يتم تصحيح القصور خلال فترة إضافية مدتها تسعون (90) يومًا من انتهاء فترة التصحيح وحيث يتعلق القصور بتكرار و / أوسوء الاستخدام المتعمد لمفاتيح جي اس 1 المتعلقة بـمعرّف الجهاز الفريد، وتحتفظ جي اس 1 بالحق في إبلاغ الجهة الرقابية وتعليق أو إلغاء أو تعديل استخدام الشركة لمفاتيح جي اس 1 لتنفيذ معرّف الجهاز الفريد في الولاية القضائية ذات الصلة وبالتعاون مع الجهة الرقابية.</p>

							<p> د‌.	تقر الشركة وتوافق على أنه يُطلب جي اس 1، في سياق التزاماتها التنظيمية، لمشاركة معلومات معينة مع الجهات الرقابية ذات الصلة، بما في ذلك على سبيل المثال لا الحصر، حقيقة أن الشركة تستخدم مفاتيح جي اس 1 لتحديد الأجهزة الطبية المطروحة في السوق في بلد الجهة الرقابية، ومفتاح جي اس  ، واسم الشركة، وكذلك أي أوجه قصور محددة وغير مصححة. توافق الشركة على ابراء ذمة جي اس 1 المسؤولية، وتستثني جي اس 1 بموجب هذا وتخلي مسؤوليتها عن أي أضرار أو خسائر أو تكاليف أو مصروفات مهما كانت طبيعتها تتكبدها الشركة كنتيجة مباشرة أو غير مباشرة لتقديم جي اس 1 هذه المعلومات إلى الجهة (الجهات) الرقابية.</p>

							<p><b>5.	يجوز لـجي اس 1 ت</b>عديل أو استكمال شروط هذا الملحق 1، بما في ذلك نموذج الاقرار، من وقت لآخر، ويجب أن يتم توفير هذا التعديل بشكل عام للشركة عبر تفاصيل الاتصال المقدمة إلى جي اس 1 وستكون هذه التغييرات سارية المفعول بعد ستين (60)  أيام من إبلاغ الشركة بالتعديل.</p>

							<p><b>6.	لمزيد من ا</b>لمعلومات حول استخدام مفاتيح جي اس 1 لأغراض معرّف الجهاز الفريد، يرجى الرجوع إلى https://www.gs1.org/industries/healthcare/udi
							</p> 
							<p><center><b>ب. تفعيل شروط الاستخدام<br>
							(الإصدار 20 يوليو 2020)</b></center></p>
							تم ابرام شروط الاستخدام النشطة هذه ("شروط الاستخدام") بين جي اس 1 عمان وبين الكيان الذي تم تحديده على أنه شركة بموجب هذه الاتفاقية ("الشركة") ، والذي يقدم قبولها لشروط الاستخدام هذه عن طريق النقر على- قبول. تسري شروط الاستخدام هذه اعتبارًا من التاريخ الذي تم فيه قبولها لأول مرة من قبل الشركة وفقًا لما ورد أعلاه.

							<p>1.	تعاريف. في شروط الاستخدام هذه، سيكون للمصطلحات المكتوبة بحروف كبيرة المعاني التالية:</p>
							<p>أ‌.	يُقصد بمصطلح "تفعيل" خدمة إصدار مفتاح مستضافة على الويب مقدمة من جي اس 1 عمان ويمكن الوصول إليها عبر الموقع الإلكتروني.</p>
							<p>ب‌.	يُقصد بمصطلح "الشركة التابعة" فيما يتعلق بشخص معين، أي كيان يتحكم بشكل مباشر أو غير مباشر في هذا الشخص أو يتحكم فيه أو يخضع لسيطرة مشتركة مع هذا الشخص.</p>
							<p>ت‌.	يُقصد بمصطلح "المستخدمون المعتمدون" أي شخص أو كيان يصل إلى أو يستخدم التفعيل من خلال حساب الشركة.</p>
							<p>ث‌.	يُقصد بمصطلح "مالك العلامة التجارية" يعني الشركة المصنعة أو بائع التجزئة الذي يمتلك منتجات ذات علامة تجارية خاصة.</p>
							<p>ج‌.	يُقصد بمصطلح "بيانات مالك العلامة التجارية" بيانات المنتج المعبر عنها كسمات بيانات (سواء في شكل نص أو صور أو غير ذلك) والمملوكة أو</p> <p>المرخصة للشركة والمقدمة إلى جي اس 1 عمان للنشر والتوزيع من خلال منصة سجل جي اس 1.</p>        
							<p>ح‌.	يُقصد بمصطلح  "مستلم البيانات" أي طرف يشاهد و / أو يستخدم بيانات مالك العلامة التجارية، في أو من خلال الخدمات والحلول المتاحة عبر منصة سجل جي اس 1، رهناً بقبول شروط الاستخدام المعمول بها لهذه الخدمة أو الحل.</p>
							<p>خ‌.	يُقصد بمصطلح "مصدر البيانات" الطرف (منظمة عضو جي اس 1 ، مجموعة البيانات، إلخ) الذي أبرم اتفاقية مع جي اس 1 عمان أو شركة تابعة لـجي اس 1 عمان، والتي بموجبها يقدم هذا الطرف بيانات مالك العلامة التجارية التي تم جمعها في خدمة أخرى أو قاعدة بيانات تديرها إلى الخدمة من وقت لآخر.</p>
							<p>د‌.	يُقصد بالمصطلح "المُعين" طرفًا مخولًا من قبل مالك العلامة التجارية لإنشاء بيانات مالك العلامة التجارية الخاصة بأصحابها وصيانتها وإدارتها و / أو تسليمها (بما في ذلك، على سبيل المثال لا الحصر، الموزع أو موفر المحتوى)، على أن يكون مفهوماً أن هذا الطرف يجب أن يكون قادرة على إثبات سلطته في توفير بيانات مالك العلامة التجارية وترخيصها إلى جي اس 1 عمان لغرض منصة سجل جي اس 1 ومنح الترخيص المنصوص عليه في القسم 6 في جميع الأوقات وبناءً على طلب جي اس 1 عمان.</p>
							<p>ذ‌.	يُقصد بـ<b> "GDSN" </b>الشبكة العالمية لمزامنة البيانات، وهي شبكة من تجمعات البيانات القابلة للتشغيل البيني والسجل العالمي جي اس 1™ التي تتيح مزامنة البيانات وفقًا لمعايير نظام جي اس 1.</p>
							<p>ر‌.	"جي اس 1" تعني <b>GS1 AISBL ، وهي مؤسسة دولية </b>غير ربحية تأسست بموجب القانون البلجيكي ولها مكتب مسجل في أفينيو لويز 326 ،1050 بروكسل، بلجيكا ، ( <b>RPM  بروكسل:  419.6</b>40.608</p>
							<p>ز‌.	"جي اس 1 عمان" منظمة غير ربحية، برقم التسجيل 1360120 ، ومقر عملها الرئيسي في شارع المركز التجاري، الطابق الأول، غرفة تجارة وصناعة عمان، روي ، مسقط في سلطنة عمان؛</p>
							<p>س‌.	"منظمة عضو جي اس 1" تعني منظمة عضو في جي اس 1 حيث أن هذا المصطلح يفهم عادة فيما يتعلق جي اس 1 عمان.</p>
							<p>ش‌.	"منصة سجل جي اس 1" تعني منصة التسجيل، بما في ذلك جميع المعدات والأنظمة والبرامج والعمليات اللازمة لتشغيلها، والتي يتم تشغيلها بواسطة جي اس 1  عمان أو أي من الشركات التابعة لها من وقت لآخر لتقديم الخدمة.</p>
							<p>ص‌.	"نظام جي اس 1" يعني المواصفات والمقاييس والمبادئ التوجيهية التي تديرها جي اس 1 عمان.</p>
							<p>ض‌.	"الطرف" يعني الشركة أو جي اس 1 عمان.</p>
							<p>ط‌.	"السياسات" تعني سياسة الخصوصية وأي سياسات معتمدة و / أو منفذة و / أو معدلة من قبل جي اس 1 من وقت لآخر ، والتي تحكم الجوانب التشغيلية للخدمة والمتاحة على الموقع.</p>
							<p>ظ‌.	"البيانات الشخصية" تعني المعلومات أو الرأي حول فرد محدد، أو فرد يمكن التعرف عليه بشكل معقول: سواء كانت المعلومات أو الرأي صحيحًا أم لا ؛ وسواء تم تسجيل المعلومات أو الرأي في شكل مادي أم لا.</p>
							<p>ع‌.	"سياسة الخصوصية" تعني "سياسة الخصوصية الخاصة بجي اس 1 عمان " ، كما يتم نشرها على الموقع وتعديلها من وقت لآخر.</p>
							<p>غ‌.	"الخدمة" لها المعنى الوارد في القسم 3 أدناه.</p>
							<p>ف‌.	"موثوق" وتعني فيما يتعلق ببيانات مالك العلامة التجارية، إذا نشأت هذه البيانات من مالك العلامة التجارية أو تم التصريح بها أو التحقق من صحتها.</p>
							<p>ق‌.	"موقع الويب" يعني https://www.gs1oman.org   (أو أي موقع ويب لاحق).</p>

							<p><b>2.	</b>أحكام عامة. تقر الشركة بأنها قد قرأت شروط الاستخدام هذه وقبلتها. إذا لم توافق الشركة على جميع البنود والشروط الواردة في شروط الاستخدام هذه، فلا يجوز لها الوصول إلى التفعيل أو استخدامه. يجوز لشركة جي اس 1 عمان تعديل شروط الاستخدام هذه في أي وقت وفقًا للقسم 18.</p>

							<p><b>3.</b>	الخدمة. لغرض شروط الاستخدام هذه، تتكون الخدمة من:<p>
								<p>أ‌.	التفعيل، الذي يسمح للمستخدمين بإنشاء وإدارة أرقام السلع التجارية العالمية ("أرقام GTIN") لتحديد منتجات الشركة، التي تم إنشاؤها على أساس بادئة شركة جي اس 1 (GCP") المرخصة من جي اس 1 عمان بموجب "ترخيص بادئة شركة جي اس 1 " ( "الترخيص")، وإنشاء صور الباركود المقابلة؛</p>

								<p>ب‌.	منصة سجل جي اس 1، وهي عبارة عن منصة تسجيل لمفاتيح جي اس 1 ، بما في ذلك القواعد المتعلقة بالبيانات المرتبطة بمفاتيح جي اس 1 (عبر قاموس البيانات العالمي) المبنية على بنية أساسية تدعم واجهات برمجة التطبيقات (API) والتحليلات والأمان. منصة سجل جي اس 1 هي عبارة عن سجل تقدم من خلاله المنظمات الأعضاء في جي اس 1 و جي اس 1 خدمات عالمية متنوعة وحلول الأعمال التي تمكن مالكي العلامات التجارية (بشكل مباشر أو عبر شخص معين) من تخزين ومشاركة البيانات الموثوقة حول منتجاتهم مع مستلمي البيانات وتمكين مستلمي البيانات من الاستعلام و / أو استخدام مثل هذه البيانات الموثوقة.</p>

								<p>لأغراض شروط الاستخدام هذه، يشكل "التفعيل" و "منصة سجل جي اس 1 " الموضحة في هذا القسم 3 معًا "الخدمة". ستوفر جي اس 1 عمان الخدمة برعاية ومهارة معقولة ووفقًا للقوانين واللوائح المعمول بها. جي اس 1 عمان لا تقر أو تضمن أن الخدمة ستكون آمنة أو خالية من الخطأ أو الانقطاع. قد تقوم جي اس 1 عمان من وقت لآخر بإجراء تعديلات على الخدمة، بما في ذلك تصميمها ووظائفها ومظهرها، أو إيقاف تشغيلها.</p>

								<p><b>4.</b>	إمكانية الوصول. يتوقف حق الشركة في الوصول إلى التفعيل على الترخيص الممنوح لها مع جي اس 1 عمان. إذا، في أي وقت،</p>

								لم تعد الشركة في وضعية جيدة بموجب الترخيص (أي لم تتمكن من الوفاء بجميع التزاماتها بموجب الترخيص)، وسيتم تعليق حقها في الوصول إلى التفعيل وإنهائه على النحو المنصوص عليه في القسم 16 هنا وسيتم رفض الوصول الإضافي. تكون الشركة مسؤولة عن كل وصول إلى التفعيل والموقع الإلكتروني واستخدامهما بواسطة المستخدمين المصرح لهم أو بخلاف ذلك من خلال حساب الشركة وعن امتثال المستخدمين المصرح لهم لشروط الاستخدام هذه. عند التسجيل، ستتلقى الشركة تفاصيل تسجيل الدخول لاستخدامها من قبل المستخدمين المصرح لهم فقط. يجب على الشركة الحفاظ على سرية تفاصيل تسجيل الدخول هذه وإخطار جي اس 1 عمان على الفور بأي استخدام غير مصرح به أو استخدام مهدد به.

								<p><b>5.</b>	الاستخدام المسموح به. يجوز للشركة الوصول إلى التفعيل للأعمال الداخلية أو للأغراض التعليمية فقط. أي استخدام آخر للتفعيل ممنوع منعا باتا. يجوز لشركة جي اس 1 عمان، من أجل ضمان الجودة و / أو لأغراض التحليل، مراقبة استخدام الشركة للتفعيل.</p>

								<p><b>6.	</b>منح الترخيص. الشركة مالكة لعلامة تجارية أو من ينوب عنها وترغب في مشاركة بيانات مالك العلامة التجارية عبر الخدمة.</p>
								<p>تخضع لشروط الاستخدام هذه:</p>
								<p>أ‌.	تمنح الشركة بموجبه جي اس 1 عمان، وتقبل جي اس 1 بموجب هذا المنحة، وهي غير حصرية، على مستوى العالم، وغير قابلة للتحويل (باستثناء ما هو منصوص عليه صراحةً هنا)، والحق الخالي من حقوق الملكية والترخيص (بما في ذلك الحق في الترخيص من الباطن إلى مستلمو البيانات) لاستخدام بيانات مالك العلامة التجارية لأي غرض متعلق بالخدمة. تدرك الشركة أن بيانات مالك علامتها التجارية ستشاركها وتوافق عليها من قبل جي اس 1 عمان مع مستلمي البيانات من خلال خدمات وحلول جي اس 1 المحلية والعالمية المتاحة عبر منصة تسجيل جي اس 1 ، و</p>
								<p>ب‌.	تمنح جي اس 1 عمان بموجب هذا للشركة (تعمل من خلال مستخدميها المعتمدين) ، وتقبل الشركة بموجبه هذا المنح ، حق الوصول إلى التفعيل لأغراض تجارية خاصة بها (بما في ذلك إدارة المستخدمين المصرح لهم).</p>

								<p><b>7.	التزامات الشركة.</b></p>
								<p>أ‌.	تتعهد الشركة وتقر وتضمن أنها لن تقوم بتحميل أي بيانات لمالك العلامة التجارية من أجل التفعيل، وبالتالي إتاحتها عبر الخدمة، والتي:</p>
								<p><b>i.</b>	تكون غير موثوقة؛</p>
								<p><b>ii.</b>	تنتهك أي حقوق خصوصية أو حقوق نشر أو علامات تجارية أو براءات اختراع أو حقوق ملكية فكرية أخرى لأي طرف ثالث أو تنتهك أي قوانين أو لوائح معمول بها؛</p>
								<p><b>iii.	</b>لا تمتثل لنظام جي اس 1 أو تنتهك السياسات المعمول بها؛</p>
								<p><b>iv.</b>	تحتوي أو تقدم فيروسات مثل تروجان أو دودة أو لوجيك بومب أو أي مواد أخرى ضارة من الناحية التكنولوجية؛ أو</p>
								<p><b>v.</b>	تقيد أو تمنع أو تتدخل في استخدام أي طرف آخر للتفعيل أو منصة سجل جي اس 1.</p>

								<p>ب‌.	لا يجوز للشركة تفكيك أو إجراء هندسة عكسية أو تغيير أو التلاعب بأي شكل من الأشكال بالخدمة أو أي موقع على الإنترنت أو أي برنامج متضمن فيه، أو التسبب في أو السماح أو مساعدة أي شخص آخر بشكل مباشر أو غير مباشر للقيام بأي ما سبق.</p>

								<p>ت‌.	تكون الشركة مسؤولة عن كل وصول إلى التفعيل والموقع الإلكتروني والخدمة واستخدامهما من قبل المستخدمين المعتمدين أو بطريقة أخرى من خلال حساب الشركة.</p>

								<p><b>8.</b>	جودة بيانات مالك العلامة التجارية. تدرك الشركة أنها:</p>

								<p>أ‌.	ستكون مسؤولة عن جودة ودقة بيانات مالك علامتها التجارية؛ و</p>
								<p>ب‌.	سيتم التحقق من صحة بيانات مالك العلامة التجارية الخاصة بها ويجب أن تتوافق مع قواعد التحقق من صحة البيانات المنصوص عليها في المواصفات العامة جي اس 1 (متوفرة عبر</p>
								<p><b>https://www.gs1.org/standards/barcodes-epcrfid-id-keys/gs1-general-specifications )</b> ، وقاموس البيانات العالمي وأي مواصفات فنية أخرى قد يتم تنفيذها و / أو تعديلها من وقت لآخر؛ و</p>
								<p>ت‌.	إذا كانت جي اس 1 عمان، وفقًا لتقديرها الخاص، تشك أو تعتقد أن بيانات مالك العلامة التجارية قد تم تقديمها أو نشرها للتفعيل، وبالتالي ، فإن منصة سجل جي اس 1 تنتهك شروط الاستخدام هذه (على سبيل المثال ، تنتهك حقوق الملكية الفكرية لطرف ثالث ) ، قد تتخذ جي اس 1 عمان الإجراءات العلاجية المناسبة (بما في ذلك، على سبيل المثال لا الحصر)، عن طريق التعليق المؤقت لتوافر بيانات مالك العلامة التجارية المذكورة أو إزالتها نهائيًا من منصة سجل جي اس 1، وبالتالي، أي خدمات و / أو حلول متعلقة بها.</p>

								<p><b>9.</b>	الإقرارات والضمانات. تمثل الشركة وتضمن وتتعهد بما يلي:</p>
								<p>أ‌.	تنشأ بيانات مالك العلامة التجارية الخاصة بها من الشركة، و / أو مصرح بها و / أو معتمدة (على سبيل المثال تم التحقق من صحتها) من قبل الشركة؛</p>
								<p>ب‌.	لا يجوز لها تحميل، أو نشر، أو نقل، أو توزيع، أو نشر أي اتصال، أو أي جزء منه، من خلال التفعيل، أو موقع الويب أو الخدمة، والذي:
									<p><b>i.</b>	يقيد أو يمنع أي مستخدم آخر من استخدام والتمتع بالتفعيل أو موقع الويب أو الخدمة؛</p>
									<p><b>ii.</b>	يكون غير قانوني، أو مسيء، أو تشهيري،</p>
									<p><b>iii.</b>	يشكل أو يشجع على سلوك من شأنه أن يشكل جريمة جنائية أو يؤدي إلى مسؤولية مدنية أو ينتهك القانون بأي شكل آخر؛
										<p><b>iv.</b>	ينتهك أو ينتحل أو حقوق جي اس 1 عمان أو أي طرف ثالث بما في ذلك، على سبيل المثال لا الحصر، حقوق النشر أو العلامات التجارية أو براءات الاختراع أو حقوق الخصوصية أو الدعاية أو أي حق ملكية آخر أو ينتهك أي قوانين أو لوائح معمول بها؛</p>
										<p><b>v.	</b>لا يمتثل لنظام جي اس 1؛</p>
										<p><b>vi.</b>	يحتوي على فيروس أو أحصنة طروادة أو ديدان أو لوجيك بومب أو أي مواد أخرى ضارة من الناحية التكنولوجية؛ أو</p>
										<p><b>vii.	</b>يشكل أو يحتوي على بيانات كاذبة أو مضللة عن الوقائع أو إشارات عن المنشأ؛</p>

										ت‌.	فيما يتعلق بشروط الاستخدام هذه:
										<p><b>i.	</b>تمثل شروط الاستخدام هذه التزاما صالحا وملزما قانونا عليها وهي قابلة للتنفيذ ضد الشركة (بما في ذلك مستخدميها المصرح لهم) وفقا لشروط هذه الاتفاقية ؛</p>
										<p><b>ii.</b>	 تتمتع بالسلطة والصلاحية الكاملة لمنح الترخيص على النحو المشار إليه في القسم 6 وتنفيذ التزاماتها بموجب هذه الاتفاقية؛ و</p>
										<p><b>iii.</b>	يجب ألا ينتهك استخدام بيانات مالك العلامة التجارية من قبل جي اس 1 عمان و / أو متلقي البيانات (بالنسبة للأخير، وفقًا لشروط استخدام الخدمة أو الحل المعمول به) أي حقوق نشر أو علامات تجارية أو براءات اختراع أو حقوق قاعدة بيانات أو حقوق ملكية فكرية أخرى لأي طرف ثالث ولا تنتهك أي قوانين أو لوائح معمول بها.</p>

										<p><b>10.</b>	إخلاء المسؤولية عن الضمانات. تفعيل ومنصة التسجيل جي اس 1، بما في ذلك جميع المحتويات والبرامج والوظائف والمواد والمعلومات المتوفرة هنا أو التي يمكن الوصول إليها من خلالها، يتم توفيرها "كما هي". إلى أقصى حد يسمح به القانون، لا تقدم جي اس 1 عمان أي تعهد أو ضمانات من أي نوع مهما كان أو فيما يتعلق بالتفعيل كما هو الحال مع أي من المواد، أو فيما يتعلق بأي روابط إلى مواقع أخرى أو فيما يتعلق بأي انتهاك للمعلومات الحساسة إلى أو من خلال التفعيل و / أو موقع الويب أو أي موقع مرتبط. علاوة على ذلك، تتنصل جي اس 1 عمان من أي ضمانات صريحة أو ضمنية، بما في ذلك، على سبيل المثال لا الحصر، عدم الانتهاك وقابلية التسويق والملاءمة لغرض معين. لا تضمن جي اس 1 أن الموقع الإلكتروني أو العملية التي تجري فيه ستكون بلا انقطاع، أو أن المواد ستكون خالية من الأخطاء، أو أنه سيتم تصحيح العيوب، أو أن موقع الويب أو الخادم الذي يوفرها خالٍ من الفيروسات أو غيرها.</p>

										<p><b>11.</b>	حدود المسؤولية. إلى أقصى حد يسمح به القانون، توافق الشركة على عدم تحمل جي اس 1 عمان ولا أي من موظفيها أو مسؤوليها أو مديريها أو وكلائها أو ممثليها أو أي منظمة (شركات) عضو في جي اس 1 المسؤولية عن أي أضرار ناتجة عن فقدان الأرباح والناتجة من استخدام أو عدم القدرة على استخدام التفعيل أو الموقع الإلكتروني أو الخدمة (سواء كان عدم القدرة على استخدام هذا الموقع أم لا ينشأ عن أي عمل أو إهمال من جي اس 1 عمان)، أو من أي أخطاء واردة في المواد التي تم تبادلها أو نقلها فعليًا أو منصة التسجيل جي اس 1، أو عن أي معاملة تتم على الموقع الإلكتروني، أو تنشأ عن أي مسألة أخرى تتعلق بالتفعيل أو الموقع الإلكتروني. تكون الشركة مسؤولة عن بيانات مالك العلامة التجارية التي يشاركها في الخدمة. إلى أقصى حد يسمح به القانون، لا تتحمل جي اس 1 عمان ولا أي منظمة عضو في جي اس 1 المسؤولية تجاه الشركة أو الطرف الثالث عن أي ضرر أو آثار أو أضرار تحدث، بما في ذلك على سبيل المثال لا الحصر، الأضرار المباشرة أو الفعلية أو العرضية أو الغير مباشرة أو التأديبية، حتى لو تم إخطارها بإمكانية حدوث مثل هذه الأضرار، والناشئة عن أو فيما يتعلق باستخدام الشركة أو الطرف الثالث لبيانات مالك العلامة التجارية الخاصة بالشركة.</p>

										<p><b>12.</b>	معدات الطرف الثالث واستخدام شبكة الويب العالمية. إذا نشرت جي اس 1 عمان قائمة بمتطلبات النظام و / أو المعدات المتوافقة للاستخدام مع التفعيل، فإن هذه القائمة لا تشكل مصادقة على هذه المعدات، ولا أي ضمان أو إقرار بأن المعدات ستعمل بما يرضي الشركة. نظرًا لأن جي اس 1 عمان لا تتحكم في المعدات التي يتم تصنيعها و / أو توزيعها من قبل أطراف ثالثة، فإن استخدام الشركة لأي من هذه المعدات يكون وفقًا لتقديرها الخاص وهي مسؤولة بمفردها عن هذا الاستخدام ولن تكون جي اس 1 عمان مسؤولة عن أي عيوب أو أعطال أو أي مشاكل أخرى قد تنشأ عند استخدامها للمعدات. قد يحتوي التفعيل على روابط لمواقع إنترنت أخرى على شبكة الإنترنت العالمية. لا تشكل الروابط من وإلى التفعيل وأي موقع (مواقع) أخرى مصادقة من قبل جي اس 1 أو جي اس 1 عمان على هذا الموقع (المواقع)، أو لمالكه أو مزوده، أو أي منتجات أو خدمات معروضة للبيع أو المعلومات الواردة فيه.</p>

										<p><b>13.</b>	التعويض. توافق الشركة على تعويض جي اس 1 عمان، والمنظمات الأعضاء في جي اس 1 وجميع مسؤوليها ومديريها ووكلائها وموظفيها والشركات والشركات التابعة (المشار إليها فيما يلي إجمالاً باسم "الأطراف المعوضة") وابراء ذمتهم من وضد أي وجميع المسؤوليات والتكاليف التي تكبدتها الأطراف المعوضة فيما يتعلق بأي مطالبة تنشأ عن أي خرق من قبل الشركة لشروط الاستخدام هذه أو أي من الإقرارات والضمانات والعهود السابقة، أو فيما يتعلق بأي مطالبة تنشأ عن أي معاملة معروضة أو تمت عبر التفعيل أو الخدمة، بما في ذلك ، على سبيل المثال لا الحصر، الرسوم والتكاليف القانونية. 

										علاوة على ذلك، تعفي الشركة الأطراف المعوَّضة من أي مطالبات و / أو مطالب و / أو أضرار، فعلية أو تبعية، من كل نوع وطبيعة معروفة أو غير معروفة، مشتبه بها وغير متوقعة، معلنه أو غير معلنة، ناشئة عن أو تتعلق بأي معاملة تم إجراؤها أو عبر "التفعيل". يجب على الشركة أن تتعاون بشكل كامل كما هو مطلوب بشكل معقول في الدفاع عن أي مطالبة. وتحتفظ جي اس 1 عمان بالحق في تولي الدفاع الحصري والتحكم في أي مسألة خاضعة للتعويض من قبل الشركة.</p>

										<p><b>14.</b>	الملكية الفكرية. جميع حقوق (الملكية الفكرية) والملكية والمصلحة في الموقع والتفعيل ومنصة التسجيل جي اس 1 مملوكة لشركة جي اس 1 عمان أو المرخصين التابعين لها. لا يجوز للشركة تفكيك أو إجراء هندسة عكسية أو تغيير أو التلاعب بأي شكل من الأشكال بالخدمة و / أو الموقع الإلكتروني أو أي برنامج متضمن فيها، أو التسبب في أو السماح أو مساعدة أي شخص آخر بشكل مباشر أو غير مباشر للقيام بأي من ما سبق. قد تضع جي اس 1 عمان بعض المواد على موقع الويب المتعلقة بـجي اس 1 عمان وأعمالها و / أو المتعلقة بالتفعيل ("المواد"). جميع هذه المواد محمية أيضًا بموجب قوانين حقوق النشر والاتفاقيات والمعاهدات الدولية، وهي مملوكة أو يتم التحكم بها من قبل جي اس 1 عمان أو الطرف المعتمد كمالك أو مزود لها. توافق الشركة على احترام أي وجميع إخطارات حقوق النشر وأي قيود أخرى واردة في المواد. يجوز لـجي اس 1 عمان تغيير أو تعليق أو إيقاف أي جانب أو ميزة أو قاعدة بيانات التفعيل في أي وقت، دون إشعار مسبق. قد تفرض جي اس 1 عمان أيضًا قيودًا على خدمات أو ميزات معينة أو تقيد وصول الشركة إلى أي من المواد دون تقديم إشعار مسبق أو تحمل أي مسؤولية.</p>

										<p><b>15.</b>	حماية البيانات. يقر الطرفان ويوافقان على أنه لأغراض الاتفاقية، يعمل كل طرف كحامي في حد ذاته ويكون مسؤولاً عن الامتثال لجميع الالتزامات والواجبات بموجب قوانين حماية البيانات المعمول بها في سلطنة عمان فيما يتعلق بأي بيانات شخصية والتي يجوز لهم معالجتها تنفيذاً للاتفاق الوارد في هذا الترخيص.</p>

										<p><b>16.</b>	السرية. تقر الشركة بأن الاتصالات من وإلى الموقع ليست سرية. علاوة على ذلك، تقر الشركة أنه من خلال إرسال اتصال إلى الموقع الإلكتروني، لا يتم إنشاء أي علاقة سرية أو ائتمانية أو ضمنية أو أي علاقة أخرى بين الشركة و جي اس 1 عمان، بخلاف ما هو منصوص عليه في شروط الاستخدام هذه.</p>
										<p><b>17.	</b>التعليق والإنهاء.</p>
										أ‌.	بصرف النظر عن أي ترتيبات أخرى بين الشركة ومصدر البيانات، يجوز لأي من الطرفين تعليق أو إنهاء مشاركة الشركة في الخدمة:
										<p><b>i.</b>	بأثر فوري إذا انتهك الطرف الآخر أي بند مادي من شروط الاستخدام هذه ولم يتمكن من معالجة هذا الانتهاك في غضون 15 يومًا من استلام إشعار خطي بهذا الانتهاك من الطرف الآخر،</p>
										<p><b>ii.</b>	إذا بدأ أي من الطرفين أي إجراءات إفلاس أو تصفية (في هذه الحالة لا يلزم الإخطار)،.</p>
										<p><b>iii.	</b>وفي أي وقت ولأي سبب من خلال تقديم إشعار كتابي قبل ثلاثين (30) يومًا للطرف الآخر.</p>
										تحتفظ جي اس 1 عمان أيضًا بالحق في الحد من رؤية بيانات مالك العلامة التجارية للشركة و / أو المشاركة في منصة تسجيل جي اس 1 إذا كانت تنتهك اتفاقية مع منظمة عضو جي اس 1 (على سبيل المثال، لم تعد سارية في التزامات الدفع تجاه منظمة عضو في جي اس 1). ستقوم جي اس 1 عمان بإخطار الشركة بأي إنهاء من هذا القبيل وفقًا للقسم 15 أدناه.<p>

											لتجنب أي شك، لن يؤثر إنهاء مشاركة للشركة في منصة تسجيل جي اس 1 على أي اتفاقية أخرى قد تعقدها الشركة مع جي اس 1 عمان أو أي من الشركات التابعة لها فيما يتعلق بالشبكة العالمية لمزامنة البيانات.

											ب‌.	عند تعليق أو إنهاء مشاركة الشركة في الخدمة:
											<p><b>i.</b>	تتوقف حقوق الشركة في الوصول إلى الخدمة واستخدامها بموجب شروط الاستخدام هذه؛</p>
											<p><b>ii.	</b>على الرغم من إنهاء أي اتفاقيات بين الشركة ومصدر البيانات أو جي اس 1، ستحتفظ جي اس 1 عمان ومصدر البيانات ببيانات مالك العلامة التجارية للأغراض الداخلية ويكون لها الحق في إعلام الأطراف الثالثة بانتهاء صلاحية حقوق الشركة في أرقام السلع التجارية العالمية، إن وجد. </p>
											<p><b>iii.	</b>في مثل هذه الحالة، قد يتم عرض بيانات مالك العلامة التجارية في الخدمة وتمييزها على أنها لم تعد محدثة (أو ما شابه ذلك)، ويجوز للشركة أن تطلب من جي اس 1 عدم عرض بيانات مالك العلامة التجارية هذه؛ و</p>
											<p><b>iv.	</b>أي بيانات لمالك العلامة التجارية التي تمت مشاركتها مع أي مستلم بيانات قبل هذا الإنهاء قد يستمر استخدامها من قبل مستلم البيانات هذا وفقًا لشروط الاستخدام المعمول بها، ولن تتحمل جي اس 1 عمان تحت أي ظرف من الظروف المسؤولية عن أي إجراء أو تقاعس مستلم البيانات هذا.</p>
											ت‌.	تظل أحكام الأقسا<b>م 1 و 4 ب) و 8 ج) و 10 و 11 و 13 و 14 و 15 و 21 و 22 و  25و 26</b> سارية بعد الإنهاء.

											<p><b>18.</b>	ضمانات جي اس 1. تضمن جي اس 1 عمان وتتعهد وتضمن أن (i) شروط الاستخدام هذه قابلة للتنفيذ ضد جي اس 1 عمان وفقًا لشروطها و (ii) لن تستخدم جي اس 1 عمان بيانات مالك العلامة التجارية لأي أغراض بخلاف ما يتعلق بالخدمة.</p>

											<p><b>19.	</b>التعديلات. تقر الشركة بأن جي اس 1 عمان تحتفظ بالحق في تعديل شروط الاستخدام هذه من وقت لآخر. توافق جي اس 1 عمان على أن تكون شروط الاستخدام المعدلة متاحة للشركة (إما مباشرة لمستخدميها المعتمدين أو عبر مصدر البيانات المختار) قبل ثلاثين (30) يومًا على الأقل من تاريخ السريان وتصبح سارية تجاه الشركة في تاريخ نفاذ ذلك، ما لم تنهي الشركة مشاركتها وفقًا للقسم 16.أ) (iii). يعتبر استمرار استخدام الخدمة من قبل الشركة بعد فترة الثلاثين (30) يومًا المذكورة أعلاه بمثابة موافقة الشركة على شروط الاستخدام المعدلة.</p>

											<p><b>20.</b>	الخصوصية. ستتعامل جي اس 1 عمان مع أي بيانات شخصية (بما في ذلك أي بيانات شخصية لمستخدم معتمد) وفقًا لسياسة الخصوصية على الموقع الإلكتروني.</p>

											<p><b>21.	</b>الإخطارات. يجب أن تكون جميع الإشعارات المطلوبة بموجب هذه الاتفاقية مكتوبة (بما في ذلك البريد الإلكتروني) إلى عنوان العمل التجاري المسجل للطرف الآخر أو مكان العمل الرئيسي أو العنوان المحدد على صفحة الويب الخاصة به أو عنوان (البريد الإلكتروني) المحدد عند التسجيل لاستخدام الخدمة أو تحديثه بطريقة أخرى بواسطة المستخدم المرخص له من وقت لآخر.</p>

											<p><b>22.</b>	قابلية الفصل. إذا تم اعتبار أي بند من شروط الاستخدام هذه باطلاً أو غير صالح أو غير قابل للتنفيذ أو غير قانوني، فستظل الأحكام الأخرى سارية المفعول والتأثير إلى أقصى حد يسمح به القانون.</p>

											<p><b>23.	</b>عدم التنازل. لا يعتبر اخفاق جي اس 1 عمان في تأكيد حق بموجب شروط الاستخدام هذه بمثابة تنازل عن ممارسة هذا الحق. ولا يعتبر أي تنازل عن أي حق منصوص عليه في هذا الترخيص ساريًا ما لم يتم تقديمه كتابيًا ويكون موقعًا من جي اس 1 عمان.</p>

											<p><b>24.	</b>الإحالة. لا يجوز للشركة إحالة حقوقها أو التزاماتها بموجب شروط الاستخدام هذه كليًا أو جزئيًا دون موافقة خطية مسبقة من جي اس 1 عمان. قد تتنازل جي اس 1 عمان عن حقوقها أو التزاماتها بموجب شروط الاستخدام هذه إلى شركة تابعة دون موافقة الشركة. ستقدم جي اس 1 عمان إخطارًا كتابيًا إلى الشركة بأي إحالة من هذا القبيل.</p>

											<p><b>25.</b>	القانون. تخضع شروط الاستخدام هذه وتفسر وفقًا لقوانين سلطنة عمان، بغض النظر عن مبادئ تنازع القوانين. بالإضافة إلى ذلك، يوافق كل طرف على الخضوع للاختصاص القضائي الحصري لأي محكمة تقع في سلطنة عمان لأي إجراءات أو دعاوى أو إجراءات ناجمة عن شروط الاستخدام هذه أو تتعلق بها. على الرغم مما سبق، توافق الشركة على أنه مع ذلك يُسمح لجي اس 1 عمان بالتقدم بطلب للحصول على تعويضات أو أمر زجري (أو أنواع أخرى معادلة من التعويض القانوني العاجل) في أي ولاية قضائية.</p>

											<p><b>26.	</b>الترجمات. تمت صياغة شروط الاستخدام هذه في الأصل باللغة الإنجليزية. يتم توفير أي ترجمة على سبيل المجاملة فقط، وفي حالة وجود تناقض بين النسخة الإنجليزية الأصلية والترجمة، تسود النسخة الإنجليزية.</p>



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

											<p><b><center>سياسة الخصوصية</center></b></p>


											<p>تحدد سياسة الخصوصية هذه كيف ولماذا يقوم مكتب GS1 عمان ( "GS1 عمان”) بجمع بياناتك الشخصية وتخزينها ومعالجتها عند استخدام مواقع الويب والخدمات - بالإضافة إلى حقوقك فيما يتعلق ببياناتك الشخصية.</p>

											<p><b>إشعار الخصوصية</b></p>


											<p>نحن GS1 عمان. نحن مؤسسة مسجلة في سلطنة عمان برقم الشركة 1360120، وعنوانها المسجل هو [شارع المركز التجاري ، مسقط ، مبنى غرفة التجارة والصناعة الطابق الأول. 112 روي]. في إشعار الخصوصية هذا، سنشير إلى أنفسنا بضمير "نحن" أو  "خاصتنا".</p>

											<p>يمكنك التواصل معنا بأي من الطرق التالية:</p>

											<p><b>I.</b>	عن طريق الاتصال بنا على : +968 72226166</p>
											<p><b>II.</b>	عن طريق مراسلتنا عبر البريد الإلكتروني على : <b>info@gs1oman.org</b></p>
											<p><b>III.</b>	أو عن طريق الكتابة إلينا على : شارع المركز التجاري ، مسقط ، مبنى غرفة التجارة والصناعة الطابق الأول. 112 روي</p>

											<p>نحن نتعامل بجدية مع خصوصية المعلومات الشخصية التي نحتفظ بها عنك، بما في ذلك أمنها. تم تصميم إشعار الخصوصية هذا لإعلامك بكيفية جمعنا للمعلومات الشخصية عنك وكيفية استخدامنا لتلك المعلومات الشخصية. يجب عليك قراءة إشعار الخصوصية هذا بعناية حتى تعرف وتتمكن من فهم سبب وكيفية استخدامنا للمعلومات الشخصية التي نجمعها ونحتفظ بها عنك.</p>

											<p>قد نصدر لك سياسات خصوصية أخرى من وقت لآخر، بما في ذلك عندما نجمع معلومات شخصية منك. يهدف إشعار الخصوصية هذا إلى استكمال هذه الشروط ولا يتجاوزها</p>

											<p><b>المتحكم</b></p>

											<p>المتحكم المسؤول عن جمع ومعالجة بياناتك الشخصية عند استخدامك للمواقع الإلكترونية هو:</p>
											<p>مكتب <b>GS1 </b>عمان</p>
											<p><b>رقم السج</b>ل التجاري 1360120</p>
											<p>العنوان</p>
											<p>مسقط، عمان</p>
											<p>البريد الإلكتروني:<b> info@gs1oman.org</b></p>
											<p>موقع الويب: <b>gs1oman.org. </b></p>

											<p><b>1.	</b>التعاريف الرئيسية</p>

											<p>"المتحكم" يعني GS1 عمان، والمشار إليه أيضًا بضمير "نحن" و "لنا" و "خاصتنا".</p>

											<p>"المعالج" يعني الشخص الطبيعي أو الاعتباري الذي يعالج البيانات الشخصية نيابة عن أو وفقًا لتعليمات GS1 عمان.</p>

											<p>"المعالجة" تعني طرق جمع بياناتك الشخصية (من بين أشياء أخرى) وتخزينها واستخدامها والإفصاح عنها ومحوها.</p>

											<p>"البيانات الشخصية" تعني أي معلومات تتعلق بشخص طبيعي محدد الهوية أو يمكن التعرف عليه ("موضوع البيانات"). تتضمن أمثلة هذه البيانات الشخصية اسمك وعنوان بريدك الإلكتروني وصورتك والمسمى الوظيفي ورقم هاتف العمل وأي معلومات شخصية أخرى تقدمها لنا وقادرة على التعرف عليك.</p>

											<p>تشمل "الخدمات" خدمات GS1 مثل: GS1 مو زون ، و GS1 كلاود ، وتفعيل GS1 ، و منطقة تعلم GS1 ، و GS1 اكستشانج ، و جيبر بريميوم وخدمات GS1 الأخرى التي يتم إنشاؤها وإتاحتها من وقت لآخر.</p>

											<p>تتضمن "مواقع الويب" (gs1oman.org) للخدمات، بالإضافة إلى صفحات الويب الخاصة بأحداث GS1 كما تم إنشاؤها من وقت لآخر.</p>


											<p><b>2.	</b>جمع البيانات الشخصية</p>

											<p>تقوم مواقع ويب GS1، بما في ذلك الخدمات المتاحة عليها، بجمع البيانات الشخصية التي تمكننا من توفير وصول آمن إلى موقع الويب وخدماتنا لك. عندما تتفاعل مع مواقع الويب (أي لتسجيل بياناتك و / أو تسجيل الدخول)، يتم جمع بياناتك الشخصية لأغراض التسجيل والأمان. يتم جمع البيانات الشخصية كمدخلات بواسطتك ومن خدمات المعالجة التابعة لجهات خارجية والتي تجمع البيانات الشخصية عبر مواقعنا الإلكترونية (مثل تسجيلات الأحداث).</p>

											<p>يتم جمع البيانات الشخصية فقط عند الضرورة لتوفير وصول آمن إلى موقع الويب و / أو الخدمات لك، وتقتصر على الأنواع ذات الصلة من البيانات الشخصية المطلوبة بالفعل.</p>

											<p><b>3.</b>	أغراض المعالجة والأساس القانوني</p>

											<p><b>استخدام الموقع</b></p>
											<p>تتيح لنا البيانات الشخصية التي يجمعها GS1 عمان عبر مواقعه الإلكترونية توفير وصول آمن إلى مواقعنا الإلكترونية والرد على أسئلتك.</p>

											<p>يتم إجراء هذا النوع من المعالجة بموافقتك، والتي يمكنك تقديمها عند إرسال التفاصيل الخاصة بك عبر نموذج الاتصال الإلكتروني، وغير ذلك من أجل مصلحة GS1 عمان المشروعة في تحسين المواقع الإلكترونية وخدماتنا والرد على استفساراتك.</p>

											<p><b>التسجيل</b></p>

											<p>قد تتطلب مواقعنا الإلكترونية والخدمات التي تقدمها من المستخدمين تسجيل بياناتهم الشخصية (على سبيل المثال الاسم وعنوان البريد الإلكتروني وكلمة المرور) ويتم طلب موافقة المستخدم في وقت التسجيل.</p>

											<p>يتم إجراء هذا النوع من المعالجة على أساس قانوني لموافقتك وبخلاف ذلك، عندما لا تكون الموافقة مطلوبة قانونًا، وهذا لمصلحة GS1 عمان المشروعة المتمثلة في ضمان أمن خدماتنا والأشخاص الذين يصلون إليها ويستخدمونها. عندما يبرم المستخدم عقدًا مع GS1 عمان (على سبيل المثال يتعلق بخدمة ما)، فقد يكون من الضروري بالنسبة لنا معالجة البيانات الشخصية من أجل الوفاء بالتزاماتنا لتنفيذ العقد.</p>

											<p><b>التسويق والاتصال التنظيمي</b></p>

											<p>قد تتم معالجة البيانات الشخصية لغرض إرسال رسائل البريد الإلكتروني حول أخبار وأحداث GS1 عمان. تتم أيضًا معالجة البيانات الشخصية وفقًا لما تتطلبه خدماتنا بشكل معقول، لتوصيل التحديثات، واستكشاف مشكلات الخدمة وإصلاحها، والرد على استفسارات المستخدمين حول الخدمة وحلها. فيما يتعلق بالاتصالات التنظيمية، تتم معالجتها على أساس البيانات الشخصية المقدمة من مستخدمي موقع الويب MO Zone <b>(http://mozone.gs1.org).</b></p>

											<p>تتم معالجة البيانات الشخصية لأغراض التسويق والاتصالات التنظيمية على أساس قانوني بموافقة المستخدم وبخلاف ذلك، من أجل مصالح GS1 عمان المشروعة لتسويق أخبارها وفعالياتها للأعضاء والمستخدمين المهتمين. تتم معالجة البيانات الشخصية للتواصل مع المستخدمين حول الخدمات التي يستخدمونها وفقًا لمصالح GS1 عمان المشروعة المتمثلة في تقديم الخدمات المستمرة ودعم الخدمة ذات الصلة لمستخدميها.</p>

											<p><b>الخدمات</b></p>

											<p>تتم معالجة البيانات الشخصية لتوفير خدماتنا عمليًا للمستخدمين والتأكد من حماية الخدمات، إلى أقصى حد ممكن، من الوصول والاستخدام غير المصرح بهما. تتضمن هذه المعالجة أيضًا ما يلي: معالجة المعاملات التجارية؛ إنشاء حسابات العملاء والاحتفاظ بها؛ التواصل معكم بشأن التحديثات أو الصيانة أو الانقطاعات أو الأمور الفنية الأخرى المتعلقة بالخدمات؛ تقديم التدريب؛ إخطاركم بالتغييرات التي تطرأ على سياساتنا وإجراءاتنا؛ التحقق من دقة الحساب ومعلومات الاتصال الفنية؛ والرد على استفسارات المستخدم.</p>

											<p>الأساس القانوني لهذه المعالجة هو المصلحة المشروعة لGS1 عمان في توفير الخدمات والحفاظ عليها، وضمان أمن هذه الأنظمة.</p>

											<p><b>تكامل الوسائط الاجتماعية والمكونات الإضافية</b></p>

											<p>تدمج GS1 عمان المحتوى من منصات التواصل الاجتماعي الخاصة بها إلى مواقعها الإلكترونية. يمكن لمنصات الوسائط الاجتماعية هذه، إذا تم تضمين أزرار على مواقع الويب الخاصة بنا، تنزيل محتوى تكنولوجيا المعلومات تلقائيًا. يمكن للصفحات التي يشاهدها المستخدم إرسال البيانات تلقائيًا إلى منصات الوسائط الاجتماعية هذه. من خلال هذه العملية التقنية، قد تتلقى منصة الوسائط الاجتماعية معلومات تعريف شخصية، مثل عنوان IP وعادات التصفح، لتحسين الإعلان الموجه للمستخدم. ويتم تخزين هذه المعلومات بواسطة منصات وسائل التواصل الاجتماعي في الولايات المتحدة الأمريكية ويمكن مشاركتها مع أطراف ثالثة عند الاقتضاء. إذا قام المستخدم بتسجيل الدخول إلى نظام أساسي لوسائل التواصل الاجتماعي باستخدام ملفه الشخصي، فإن منصة الوسائط الاجتماعية تتعرف على المستخدم في كل نشاط. يتم إرسال البيانات الشخصية مثل عنوان IP للشخص المعني، والنقرات على الصفحات، ووقت الدخول، وموقع الدخول، وتكرار الزيارات، وروابط المنشأ، وروابط المتابعة والبيانات المتعلقة بطول الإقامة على الموقع. ويجوز لمنصات التواصل الاجتماعي مراقبة نشاط المستخدم إذا تم تضمين أزرار على مواقعنا الإلكترونية.</p>

											<p>تقوم مواقع GS1 بتضمين المحتوى واستخدام المكونات الإضافية الاجتماعية ("المكونات الإضافية") من منصات الوسائط الاجتماعية. إذا قمت بزيارة صفحة من مواقع الويب الخاصة بنا تحتوي على مثل هذا المكون الإضافي، فيتصل متصفحك مباشرة بخوادم منصة التواصل الاجتماعي. يتم نقل محتوى المكون الإضافي من خلال منصة الوسائط الاجتماعية مباشرة إلى متصفحك ودمجها في صفحة الويب. من خلال دمج المكون الإضافي، يتلقى مزود الوسائط الاجتماعية المعلومات التي تفيد بأن متصفحك قد وصل إلى الصفحة المقابلة على موقعنا. ينطبق هذا أيضًا إذا لم يكن لديك ملف تعريف أو لم تقم بتسجيل الدخول حاليًا إلى منصة الوسائط الاجتماعية المعنية. يتم إرسال هذه المعلومات (بما في ذلك عنوان IP الخاص بك) عن طريق متصفحك مباشرة إلى خادم منصة الوسائط الاجتماعية (ربما في الولايات المتحدة) وتخزينها في هذا الموقع. إذا قمت بتسجيل الدخول إلى إحدى منصات وسائل التواصل الاجتماعي، يمكن للمزود تخصيص الزيارة مباشرة إلى موقعنا الإلكتروني إلى ملفك الشخصي في منصة التواصل الاجتماعي المعنية. إذا كنت تتفاعل مع المكونات الإضافية 
											(على سبيل المثال من خلال النقر على زر "أعجبني" أو "مشاركة")، يتم أيضًا نقل المعلومات المقابلة مباشرة إلى خادم منصة وسائط اجتماعية وتخزينها في ذلك الموقع. يمكن أيضًا نشر المعلومات على منصة التواصل الاجتماعي وعرضها على جهات الاتصال الخاصة بك. هذا النوع من المعالجة ضروري للتسويق الأمثل لخدماتنا، وهو مصلحة مشروعة لشركة GS1 عمان.</p>

											<p>إذا كنت لا تريد أن تقوم منصات الوسائط الاجتماعية بتعيين البيانات التي يتم جمعها عبر مواقعنا الإلكترونية مباشرة إلى ملفك الشخصي في منصة التواصل الاجتماعي المقابلة، فيجب عليك تسجيل الخروج من الخدمة المقابلة قبل زيارة مواقعنا الإلكترونية. يمكنك منع تحميل المكونات الإضافية، حتى مع الوظائف الإضافية لمتصفحك، باستخدام أداة حظر البرامج النصية "نو سكريبت ("" <b>(http://noscript.net.</b></p>

											<p><b>الامتثال القانوني</b></p>

											<p>يجب أن تمتثل GS1 عمان لالتزاماتها القانونية (على سبيل المثال وفقًا لتوجيهات السلطات التنظيمية أو بموجب أمر من المحكمة) وفي مثل هذه الظروف، قد يكون من الضروري بالنسبة لنا معالجة البيانات الشخصية لهذه الأسباب.</p>

											<p><b>ملفات الارتباط</b></p>

											<p>ملفات الارتباط هي ملفات صغيرة يتم تخزينها على جهاز الكمبيوتر الخاص بك عند دخولك إلى موقعنا الإلكتروني. لديها وظائف مختلفة بما في ذلك: السماح لك بالتنقل بسلاسة بين الصفحات على موقع الويب، وتذكر تفضيلاتك وتحسين التجربة العامة للموقع.<p>

												<p>يستخدم GS1 عمان ملفات الارتباط التالية على هذا الموقع:</p>

												<p>•	ملفات الارتباط الدائمة: تسمح لنا بتحسين كيفية قيام موقع الويب بجمع المعلومات، وتعزيز تجربتك مع الموقع بمرور الوقت.</p>
												<p>•	ملفات الارتباط المؤقتة: ويتم من خلالها تخزين معلومات حول جلسة التصفح الحالية، مما يساعدك على التنقل بين الصفحات.</p>

												<p>يمكنك تمكين أو تعطيل ملفات الارتباط عن طريق تعديل الإعدادات في متصفحك. يمكنك معرفة كيفية القيام بذلك والحصول على مزيد من المعلومات حول ملفات تعريف الارتباط على: <b>www.allaboutcookies.org .</b></p>

												<p><b>4.	تخزين البيانات</b></p>

												<p>ستقوم GS1 عمان بتخزين ومعالجة بياناتك الشخصية للأغراض المنصوص عليها في سياسة الخصوصية هذه. تحتفظ GS1 ببياناتك الشخصية للفترة الزمنية اللازمة لتحقيق الأغراض الموضحة في سياسة الخصوصية هذه، مع مراعاة التمديد وفقًا لما يسمح به القانون، وستحذف بياناتك الشخصية بعد هذا الوقت الذي لم تعد مطلوبة بعده.</p>

												<p><b>5.	عمليات نقل البيانات والمستلمين</b></p>

												<p><b>الإفصاح للغير</b></p>

												<p>قد تفصح GS1 عمان عن بياناتك الشخصية، حسب الضرورة، إلى معالجات الطرف الثالث بغرض تطوير المواقع والخدمات، والتسويق والاتصالات التنظيمية نيابة عن GS1 عمان. عند مشاركة البيانات الشخصية مع مستلمين من الأطراف الثالثة لهذه الأغراض، يتم مشاركتها وفقًا لسياسة الخصوصية هذه ووفقًا لما هو مصرح به وتعليمات من GS1 عمان.
												إذا كان ذلك مطلوبًا بموجب القانون، يجوز لشركة GS1 عمان الكشف عن البيانات الشخصية بناءً على طلب من سلطة عامة وعند استلام أمر من المحكمة، أو ما شابه، للكشف عن البيانات الشخصية.</p>

												<p><b>التحويلات عبر الحدود</b></p>

												<p>في بعض الحالات، قد يكون من الضروري نقل البيانات الشخصية إلى الشركات و / أو المنظمات الدولية. في مثل هذه الحالات ، سيتم نقل البيانات الشخصية وفقًا للضمانات اللازمة بين GS1 عمان والمعالج الدولي.</p>

												<p><b>6.	حماية البيانات الشخصية</b></p>

												يتم حفظ جميع المعلومات التي يتم جمعها عبر مواقع الويب والخدمات وتخزينها في بيئات تشغيل آمنة ولا يمكن الوصول إليها إلا من قبل الموظفين المعتمدين. تتم مراقبة موقع الويب بانتظام للتأكد من أنه آمن وأن البيانات لا يتم الوصول إليها أو استخدامها بشكل غير صحيح. الموقع محمي من خلال اجراءات أمنية مناسبة للحماية ومنع الخسارة والاستخدام غير القانوني والوصول غير المصرح به إلى البيانات الشخصية إلى أقصى حد معقول.

												<p><b>7.	حقوقك</b></p>

												<p><b>الوصول إلى بياناتك الشخصية</b></p>

												<p>عندما تطلب الوصول إلى بياناتك الشخصية، ويكون هذا الطلب معقولًا ومتناسبًا، فستقدم GS1 عمان هذه الخدمة مجانًا، ولكن إذا كان طلبك يتطلب جهدًا تقنيًا أو إداريًا غير متناسب، فقد تفرض GS1 عمان رسومًا.
													إذا طلبت الوصول إلى بياناتك الشخصية، فقد تطلب GS1 عمان التحقق من هويتك للتأكد إلى أقصى حد ممكن من عدم الكشف عن البيانات الشخصية بشكل غير قانوني
												- قد يؤدي عدم التحقق من هويتك بشكل كافٍ إلى رفض GS1 عمان السماح بالوصول إلى البيانات الشخصية المطلوبة.</p>

												<p><b>دقة البيانات</b></p>

												<p>أنت مسؤول عن الحفاظ على دقة بياناتك الشخصية عن طريق الاتصال بـGS1 عمان لإبلاغنا بأي تغييرات أو أخطاء في بياناتك الشخصية. لديك الحق في الوصول إلى بياناتك الشخصية المخزنة بواسطة المواقع والخدمات لتحديث وتعديل وتصحيح سجل بياناتك الشخصية.</p>

												<p><b>المحو</b></p>

												<p>يحق لك مسح بياناتك الشخصية، مع ملاحظة أنه بدون الاحتفاظ ببياناتك الشخصية، قد يكون الوصول إلى المواقع والخدمات محدودًا.</p>

												<p><b>سحب الموافقة</b></p>

												<p>لديك أيضًا الحق في سحب موافقتك على معالجة بياناتك في أي وقت، دون التأثير على المعالجة القانونية لبياناتك الشخصية قبل هذا السحب.</p>

												<p><b>الاعتراض</b></p>

												<p>يحق لك الاعتراض، كليًا أو جزئيًا، على بياناتك الشخصية التي يتم جمعها ومعالجتها وفقًا للمصالح المشروعة لشركة GS1 عمان. في مثل هذه الحالة، لن نعالج البيانات الشخصية بعد الآن - باستثناء الحالات التي تتجاوز فيها الأسباب المشروعة المقنعة لمواصلة المعالجة مصالح المستخدم وحقوقه وحرياته، أو لإنشاء مطالبات قانونية أو ممارستها أو الدفاع عنها.</p>
												<p>إذا كنت ترغب في ممارسة أي من الحقوق المذكورة أعلاه فيما يتعلق بمعلوماتك الشخصية، فيرجى الاتصال بنا عن طريق استخدام التفاصيل الموضحة في بداية هذا الإشعار. إذا قمت بتقديم طلب، فيرجى ملاحظة ما يلي:</p>

												<p><b>(أ)</b> قد نحتاج إلى معلومات معينة منك حتى نتمكن من التحقق من هويتك.</p>
												<p><b>(ب)</b> نحن لا نفرض رسومًا على ممارسة حقوقك ما لم يكن طلبك لا أساس له أو مبالغ فيه.</p>
												<p><b>(ج)</b> إذا كان طلبك لا أساس له أو مبالغ فيه، فقد نرفض التعامل مع طلبك.</p>


												<p><b>المعاجلة المقيدة</b></p>
												<p>يحق للمستخدمين تقييد معالجة بياناتهم الشخصية إذا (1) تم الطعن في دقة البيانات الشخصية للفترة الزمنية التي يمكن خلالها لـGS1 عمان التحقق من دقة البيانات الشخصية، (2) كانت المعالجة غير قانونية وكان موضوع البيانات يعارض محو البيانات الشخصية ويطلب المعالجة المقيدة بدلاً من ذلك، (3) لم تعد GS1 عمان بحاجة إلى البيانات الشخصية لغرض المعالجة ولكنها مطلوبة من قبل البيانات الخاضعة لإنشاء الدعاوى القانونية أو ممارستها أو الدفاع عنها، و (4) اعترض المستخدم على معالجة التحقق المعلق ما إذا كانت الأسس المشروعة لـGS1 عمان تسود على تلك الخاصة بالمستخدم. في حالة تقييد المعالجة بموجب القواعد المذكورة أعلاه، لن تتم معالجة هذه البيانات الشخصية (باستثناء التخزين) إلا بموافقة المستخدم أو لإنشاء مطالبات قانونية أو ممارستها أو الدفاع عنها أو لحماية حقوق أو مصالح فرد آخر في المصلحة العامة.</p>

												<p><b>قابلية نقل البيانات الشخصية</b></p>

												<p>يحق للمستخدمين طلب واستلام بياناتهم الشخصية بطريقة منظمة بالإضافة إلى الحق في نقل بياناتهم الشخصية إلى معالج آخر، حيثما يكون ذلك ممكنًا من الناحية الفنية ولا يؤثر سلبًا على حقوق الآخرين وحرياتهم.</p>

												<p><b>8.</b>	الشكاوى</p>

												<p>إذا كانت لديك شكوى بشأن الطريقة التي تتعامل بها GS1 عمان مع بياناتك الشخصية أو تعالجها، فيمكنك تقديم شكوى إلى السلطة الإشرافية ذات الصلة، والتي تعتبر بالنسبة إلى GS1 عمان إدارة الامتثال وحماية البيانات في وزارة النقل والاتصالات. في المقام الأول، نوصيك بتوجيه أي تساؤلات أو شكاوى إلى ((info@gs1oman.org.</p>


												<p><b>9.</b>	التغييرات في سياسة الخصوصية </p>

												<p>قد تتغير سياسة الخصوصية هذه من وقت لآخر عند مراجعتها وبما يتفق مع القوانين واللوائح المعمول بها. لن يتم تقليل حقوقك بموجب سياسة الخصوصية هذه دون موافقتك الصريحة. عندما تكون التغييرات مهمة، سيتم إخطارك عبر البريد الإلكتروني و / أو عن طريق إشعار عبر موقع الويب.
													إذا كنت ترغب في الحصول على مزيد من المعلومات حول سياسة الخصوصية هذه أو حقوق الخصوصية الخاصة بك فيما يتعلق بالموقع، فيرجى التواصل <b>(info@gs1oman.org)</b>.<p>



													</div>



												</div>

											</div>

										</div>



										<?php include('footer-ar.php'); ?>



										<!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->
										<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
										<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
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

      // Add event listener for change event on finalpay1 checkbox
												$("#finalpay1").change(function() {
													if ($(this).is(":checked")) {
                // Display the popup with the desired text
														alert("بمجرد تقديمها، تكون رسوم الطلب غير قابلة للاسترداد. لا يجوز استرداد المبالغ بعد 24 ساعة من تقديم نموذج الطلب لأي سبب كان (بما في ذلك على سبيل المثال لا الحصر الطلبات المقدمة عن طريق الخطأ). كرسوم إدارية، يمكن اعتبار جميع الطلبات قد تم استلامها ومعالجتها خلال 24 ساعة من تقديمها. يجب أن يتم استلام طلب إلغاء الطلب أو استرداد رسوم الطلب من قبل GS1 خلال 24 ساعة من تقديم نموذج الطلب عبر helpdesk@gs1oman.org. وبعد هذه المدة، لن يتم رد أي مبالغ.\nلقد فهمت أنه سيتم فرض رسوم (رسوم) سنوية على شركتي وفقًا للترخيص (التراخيص) التي تقدمت شركتي بطلب للحصول عليها.");
													}
												});
											});

										</script>

										<script>

											$(document).ready(function() {
												$('input[name="offline_payment"]').change(function() {
													if ($(this).val() == '1') {
														$('#offline_payment_instructions').show();
														$('#offline_payment_error').html('');
													} else {
														$('#offline_payment_instructions').hide();
													}
												});

												$('#regform').submit(function(event) {
													if ($('input[name="offline_payment"]:checked').length === 0) {
														$('#offline_payment_error').html('Please select a payment method.');
														event.preventDefault();
													}
												});
											});

											$(document).ready(function() {
												$('#regform').submit(function(event) {
													if ($('input[name="healthcare_status"]:checked').length === 0) {
														$('#healthcare_status_error').html('Please select an option.');
														event.preventDefault();
													} else {
														$('#healthcare_status_error').html('');
													}
												});
											});

										</script>






