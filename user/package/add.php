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
	include("../include/function.php");
	if($_SESSION['user_email']=="")
	{
	header('location:../login.php');
	}
 
	#error_reporting(0);
	// Form Submit Start 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;


	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';


	if(isset($_POST['submit']))
	{


	//Package Start
	$product_id=$_POST['product_id'];

	$product_name=$_POST['product_name'];
	//$registration_fee=$_POST['registration_fee'];
	$gtins_annual_fee=$_POST['gtins_annual_fee'];
	$gln_price=$_POST['gln_price'];
	$sscc_price=$_POST['sscc_price'];
	$annual_subscription_fee=$gtins_annual_fee+$gln_price+$sscc_price;
	$offline_payment=$_POST['offline_payment'];
	
	//$annual_total_price=$registration_fee+$gtins_annual_fee+$gln_price+$sscc_price;
	$annual_total_price=$gtins_annual_fee+$gln_price+$sscc_price;    //remove registration fee in user
	
	
	
	
	
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

	/* if($mail->send())
	{
		
		$order_id = 'Barcode'.(rand(1,10000));
		$order_date=date('Y-m-d');
		  $last_id = $conn->insert_id;

		$renewalDateDb=date('Y-m-d', strtotime('+1 year'));
		$validTillDateDb= date('Y-m-d', strtotime('-1 day', strtotime($renewalDateDb)));
		$offline_payment=$_POST['offline_payment'];
		//echo $offline_payment;
		//die();

		//$sql2 =mysqli_query($conn,"INSERT INTO `order_tbl`(company_id ,order_id,  product_id ,user_email, registration_fee ,gtins_annual_fee, gln_price ,sscc_price,annual_subscription_fee,annual_total_price,order_date,offline_payment,status) VALUES('$user_id','$order_id','$product_id' ,'$user_email' ,'$registration_fee' ,'$gtins_annual_fee' ,'$gln_price','$sscc_price','$annual_subscription_fee','$annual_total_price','$order_date','$offline_payment','0')");
		$sql2 =mysqli_query($conn,"INSERT INTO `order_tbl`(company_id ,order_id,  product_id ,user_email, registration_fee ,gtins_annual_fee, gln_price ,sscc_price,annual_subscription_fee,annual_total_price,order_date,offline_payment,status) VALUES('$user_id','$order_id','$product_id' ,'$user_email' ,'0' ,'$gtins_annual_fee' ,'$gln_price','$sscc_price','$annual_subscription_fee','$annual_total_price','$order_date','$offline_payment','0')");

		if($sql2)
		{ 
			echo "<script>window.location='payment.php?_token=".base64_encode($order_id)."';</script>";

			$_SESSION['message']="New Event Added Successfully";

		}
		
	}

 

	else {
 
			echo "<script>alert('Enter valid email.')</script>";

		} */
	
	
		$order_id = 'Barcode'.(rand(1,10000));
		$order_date=date('Y-m-d');
		  $last_id = $conn->insert_id;

		$renewalDateDb=date('Y-m-d', strtotime('+1 year'));
		$validTillDateDb= date('Y-m-d', strtotime('-1 day', strtotime($renewalDateDb)));
		$offline_payment=$_POST['offline_payment'];
		
		$renewal_date=$_POST['renewal_date'];
		$renewal_datenew=date('Y-m-d', strtotime($renewal_date));
		
		
		
	//Reciept upload
		$pay_rec = $_FILES['payment_receipt']['name'];
		$pay_rec_tmp_name3 = $_FILES['payment_receipt']['tmp_name'];
		$ext = pathinfo($pay_rec, PATHINFO_EXTENSION);
		$pay_rec_path = 'images/pay-receipts/' . $pay_rec; // Use a relative path
		$absolute_path = $_SERVER['DOCUMENT_ROOT'] . '/' . $pay_rec_path;
		// Check if the file has been uploaded successfully
		if (move_uploaded_file($pay_rec_tmp_name3, $absolute_path)) {
			// File has been successfully uploaded and moved to the desired folder
			// Now, you can save $doc_path1 in your database
			// Perform your database insertion here
			//echo 'File uploaded successfully.';
		} else {
			// Something went wrong with the file upload
			//echo 'Error uploading the file.';
		}
		 
		

	
		$sql2 =mysqli_query($conn,"INSERT INTO `order_tbl`(company_id ,order_id,  product_id ,user_email, registration_fee ,gtins_annual_fee, gln_price ,sscc_price,annual_subscription_fee,annual_total_price,order_date,offline_payment,status,payment_receipt,renewal_date) VALUES('$user_id','$order_id','$product_id' ,'$user_email' ,'0' ,'$gtins_annual_fee' ,'$gln_price','$sscc_price','$annual_subscription_fee','$annual_total_price','$order_date','$offline_payment','0','$pay_rec_path','$renewal_datenew')");
		//$sql2 =mysqli_query($conn,"INSERT INTO `order_tbl`(company_id ,order_id,  product_id ,user_email, registration_fee ,gtins_annual_fee, gln_price ,sscc_price,annual_subscription_fee,annual_total_price,order_date,offline_payment,status,payment_receipt) VALUES('$user_id','$order_id','$product_id' ,'$user_email' ,'0' ,'$gtins_annual_fee' ,'$gln_price','$sscc_price','$annual_subscription_fee','$annual_total_price','$order_date','$offline_payment','0','$pay_rec_path')");
	
		
	if($sql2)
		{ 
			echo "<script>window.location='payment.php?_token=".base64_encode($order_id)."';</script>";

			$_SESSION['message']="New Event Added Successfully";

		}
		


			echo "<script>window.location='show.php?page=Pack';</script>";

  }
  if('radio'=='1'){
	  
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
  
<div id="one" class="table table-responsive">
<table class="table table-bordered table-striped">
<!--<tr>
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
<td><?=$productData['gtins_annual_fee']?> </td>-->
</tr>
<div style="clear: both;"></div>
<div class="row">
<h4 class="mt-3"> DDO YOU REQUIRED ADDITIONAL PRODUCTS?</h4>
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
										
<td><input onclick="add()" type="checkbox"  name="gtins_annual_fee" id="gtins_annual_fee" class="test" value="<?=$productData['gtins_annual_fee']?>"> </td>
	<td>GTIN: Global Trade Item Numbers ? <span class="text-danger" data-toggle="tooltip" title="GTIN: Definition">!</span></td>
	<input type="hidden" name="registration_fee" value="<?=$productData['registration_fee']?>">
	<!--<input type="hidden" name="gtins_annual_fee" value="<?=$productData['gtins_annual_fee']?>">
	<td><?=$productData['product_name']?> </td>
	<!--<td><?=$productData['registration_fee']?> </td>-->
	<input type="hidden" name="product_name" value="<?=$productData['product_name']?>">
	<td><span id="gtins_annual_fee"><?=$productData['gtins_annual_fee']?></span> </td>
</tr>
<tr>
<td>
<input onclick="add()" type="checkbox"  name="gln_price" id="gln_price" value="<?=$productData['gln_annual_fee']?>"> </td>
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
                 
                  <!--registration fee set to 0  --> 
				  
                 <!--<input type="text" id="registration_fee" name="registration_fee" class="form-control mb-0"  value="<?=$productData['registration_fee']?>" disabled>-->
                 <input type="text" id="registration_fee" name="registration_fee" class="form-control mb-0"  value="0" disabled>
				 
               </div>
			   <?php 
			   $nextYear =  date('Y');
			   $addTwoYears =  date('Y', strtotime('+1 year'));
			   $renewalDate='01 Jan '.$addTwoYears;
			   $validTillDate= '31 Dec '.$nextYear;
			   
			   ?>
               <span class="fw-bold text-danger">Valid till <?php echo $validTillDate ?> </span>
            </div>

            <div class="col-md-4">
                <label class="fw-bold">Annual Subscription Fee  </label>
               <div class="input-group mb-3">
                 <span class="input-group-text" id="basic-addon1">OMR</span>
                 <!--<input type="number" id="total" class="form-control mb-0" >
                 <div id="total" class="form-control">500</div>-->
                
                 <input type="hidden" name="annual_subscription_fee" id="annual_subscription_fee" value="0">
                 <!--<input type="hidden" name="annual_subscription_fee" id="annual_subscription_fee" value="0" />-->
				<input type="text" class="form-control mb-0" size="2" name="annual_total_price" id="annual_total_price" value="0" disabled>
               </div>
               <span class="fw-bold text-danger">Next renewal <?php echo $renewalDate ?> </span>
            </div>
            <div class="col-md-4">
                <label class="fw-bold">Total Fee  </label>
               <div class="input-group mb-3">
                 <span class="input-group-text" id="basic-addon1">OMR</span>
				 
				 <!--- Total fee amount set to 0--> 
				 
                <!--<input name="total_price" id="total_price" type="text" class="form-control mb-0"  value="<?=$productData['registration_fee']+$productData['gtins_annual_fee']?>" disabled>-->
		
				<input name="total_price" id="total_price" type="text" class="form-control mb-0"  value="0" disabled>
                 <!--<input class="form-control mb-0" disabled id="demo">-->
               </div>
            </div>
         </div>


            <div class="row d-none">
				<div class="col-md-12 text-center mt-3">
               <!--<a id="calculate_fee" class="btn btn-success">Calculate Membership Fee</a>-->
               <a id="calculate_fee" class="btn btn-success" onclick="add()">Calculate Membership Fee</a>
				</div>
			</div>
			<div onclick="offline()">
                <label class="fw-bold"><h4>Payment Method</h4> </label>
               
				<div class="form-check">
					  <input class="form-check-input" type="radio" name="offline_payment" id="flexRadioDefault2" value="0" >
					  <label class="form-check-label" for="flexRadioDefault2">
						Pay By Card
					  </label>
				</div>
				<div class="form-check">
					  <input class="form-check-input" type="radio" name="offline_payment" id="flexRadioDefault1" value="1">
					  <label class="form-check-label" for="flexRadioDefault1">
						Cash
					  </label>
				</div>
				
			</div>
			
			
			<div class="mt-3"  id="offlineinstruction" style="display:none">
			<!-- New section for uploading payment receipt -->
				<div class="row">
					<div class="form-group col-md-4">
						<label for="payment_receipt">Upload Payment Receipt:</label>
						<input type="file" class="form-control-file" id="payment_receipt" name="payment_receipt">
					</div>
					<div class="form-group col-md-4">
						<label for="renewal_date" class="col-form-label">Renewal Date</label> 
						<input type="text" autocomplete="false" class="form-control datepickerDefect" id="inputRenewalDate" name="renewal_date" value="">
					</div>

				</div>
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
			<div> 
			</div>
			
                
		 
 <?php   
 exit;
}



 ?>
<!DOCTYPE html>
<html lang="en">

<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Meta -->
<meta name="description" content="Responsive Bootstrap4 Dashboard Template">
<meta name="author" content="ParkerThemes">
<link rel="shortcut icon" href="<?=$base_url?><?=$rows_website['favicon']?>" />

<!-- Title -->
<title><?php title(); ?></title>
<!-- *************
************ Common Css Files *************
************ -->
<!-- Bootstrap css -->
<?php include("../include/table_css.php"); ?>
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
<div class="container-fluid">
<?php include("../include/menu_navbar.php"); ?>
<div class="main-container">
<!-- Page header start -->
<div class="page-header">
<ol class="breadcrumb">
<li class="breadcrumb-item">Add
</li>
<li class="breadcrumb-item active">New Product</li>
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

<form name="listForm" action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="annual_total_price" value="<?=$annual_total_price?>">
<div class="card m-0">
<div class="card-header">
<div class="card-title">How many GTINS do you require?</div>

</div>
<div class="card-body">

<div class="row gutters">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
       
<div class="form-group">
<label for="inputSubject" class="col-form-label">Add New Product</label>
<select name="product_id" id="product_id" class="form-control" onchange="show_package_details();">
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

<div  class="output product_result_data form-group">

</div>
   
   
   
</div>

</div>
<div class="row gutters">
<div class="col-xl-12" id="submitonline">
   <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Submit">
   <a href="show.php?page=PACK"><input type="button" name="cancel" class="btn btn-warning" value="Back"></a>
</div>
<!--<div class="col-xl-12" style="display:none" id="submitoffline">
<a class="btn btn-primary" target="_blank" href="paymentoffline.php">Submit</a>
   <a href=""><input type="button" name="cancel" class="btn btn-warning" value="Backoff"></a>
</div>-->
</div>

</div>
</div>
</form>

</div>
</div>


</div>
<!-- Content wrapper end -->



</div>

</div>


<?php include('footer.php'); ?>

	<script>
	
	 function offline(){
		if (document.getElementById('flexRadioDefault1').checked) {
			offlineinstruction.style.display = 'block';
			$('.datepickerDefect').datepicker({
            //format: 'yyyy-mm-dd',
            format: 'dd-mm-yyyy',
            autoclose: true
        });
			
		}else {
			offlineinstruction.style.display = 'none';
		}
	}
		  

	

    $(document).ready(function(){
        $('#inputRenewalDate1').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
		
    });
</script>
	
	</body>
	

