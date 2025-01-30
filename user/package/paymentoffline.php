<?php 

if(isset($_POST['submitt']))
	{


	//Package Start
	$product_id=$_POST['product_id'];
	$product_name=$_POST['product_name'];
	$registration_fee=$_POST['registration_fee'];
	$gtins_annual_fee=$_POST['gtins_annual_fee'];
	$gln_price=$_POST['gln_price'];
	$sscc_price=$_POST['sscc_price'];
	$annual_subscription_fee=$gtins_annual_fee+$gln_price+$sscc_price;
	$offline_payment=$_POST['offline_payment'];
	//$annual_total_price=$registration_fee+$gtins_annual_fee+$gln_price+$sscc_price;
	$annual_total_price=$gtins_annual_fee+$gln_price+$sscc_price;    //remove registration fee in user
	$renewal_date=$_POST['renewal_date'];
	//Package wrap WRAP


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



 

//validation
$user_sql = "SELECT * FROM  company_tbl WHERE user_email='".$_SESSION['user_email']."'";
$res=mysqli_query($conn, $user_sql);
$fetch_row=mysqli_fetch_array($res);
$user_email=$fetch_row['user_email'];
$user_id=$fetch_row['id'];
 
// If Statement Start
if($user_email!=''){

    $mail = new PHPMailer(true);
             
    $mail->isSMTP(); 
       #$mail->SMTPDebug = 2;
       $mail->Host       = 'host33.theukhost.net';                     
	    $mail->SMTPAuth   = true;                                   
	    $mail->Username   = 'info@gs1oman.com';                    
	    $mail->Password   = 'd4.rX%J6H55{';                             
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
	    $mail->Port       = 465;                                    

	  
	    $mail->setFrom('info@gs1oman.com', 'Barcode');
	    $mail->addAddress($user_email);
	    $mail->addAddress('info@gs1oman.com');
                 


    $mail->isHTML(true);                                 
    $mail->Subject = 'Barcode:New Order';
    $mail->Body    = $email_temp;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if($mail->send())
	{
		$order_id = 'Barcode'.(rand(1,10000));
		$order_date=date('Y-m-d');
		  $last_id = $conn->insert_id;

		$renewalDateDb=date('Y-m-d', strtotime('+1 year'));
		$validTillDateDb= date('Y-m-d', strtotime('-1 day', strtotime($renewalDateDb)));
		

		//$sql2 =mysqli_query($conn,"INSERT INTO `order_tbl`(company_id ,order_id,  product_id ,user_email, registration_fee ,gtins_annual_fee, gln_price ,sscc_price,annual_subscription_fee,annual_total_price,order_date,offline_payment,status) VALUES('$user_id','$order_id','$product_id' ,'$user_email' ,'$registration_fee' ,'$gtins_annual_fee' ,'$gln_price','$sscc_price','$annual_subscription_fee','$annual_total_price','$order_date','1','0')");
		$sql2 =mysqli_query($conn,"INSERT INTO `order_tbl`(company_id ,order_id,  product_id ,user_email, registration_fee ,gtins_annual_fee, gln_price ,sscc_price,annual_subscription_fee,annual_total_price,order_date,offline_payment,renewal_date,status) VALUES('$user_id','$order_id','$product_id' ,'$user_email' ,'$registration_fee' ,'$gtins_annual_fee' ,'$gln_price','$sscc_price','$annual_subscription_fee','$annual_total_price','$order_date','1','$renewal_date','0')");

		if($sql2)
		{ 
			echo "<script>window.location='payment.php?_token=".base64_encode($order_id)."';</script>";

			$_SESSION['message']="New Event Added Successfully";

		}
		
	}


	else {
 
			echo "<script>alert('Enter valid email.')</script>";

		}

			echo "<script>window.location='show.php?page=Pack';</script>";

  }
//if statement end....

}
// Form Submit Wrap

		if(isset($_POST['action']) && $_POST['action']=='get_product_data'){
		$product_id = $_POST['product_id'];
		 $query = "SELECT * FROM product_tbl where id='".$product_id."' ORDER BY id ASC ";     
		$rs_result = mysqli_query ($conn, $query);
		$productData=mysqli_fetch_array($rs_result);
		$annual_total_price=$productData['gtins_annual_fee'];
		  
  ?>