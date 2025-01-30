<style>
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	  -webkit-appearance: none;
	  margin: 0;
	}

	/* Firefox */
	input[type=number] {
	  -moz-appearance: textfield;
	}
	.full-width-content {
	    width: 100%;
	    text-align: justify;
	}
	.full-width-content ol li {
	    text-align: justify;
	}

    label.error {
        color: red;
    }

    .error-text {
    	color: red;
    	font-size: 14px;
    	margin-top: 5px;
    }
</style>	
<?php 
	if(isset($_SESSION['message1'])){
		echo "<div class='alert alert-danger text-center' role='alert'>".$_SESSION['message1']." <br><strong><a href='login.php'>Login here</a></strong></div>";
		unset($_SESSION['message1']);
	}
	
	include("admin/include/function.php");
	error_reporting(0);

	// Form Submit Start 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	if(isset($_POST['submit'])){
		// Enable error reporting for debugging
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		
		// Log the incoming request
		error_log("Form submission received: " . print_r($_POST, true));
		error_log("Files received: " . print_r($_FILES, true));
		
		// Clear any existing output
		ob_clean();
		
		// Set headers
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-Type: application/json');
		
		try {
			// Log validation start
			error_log("Starting form validation");
			
			// Validate required fields
			$required_fields = ['name', 'name_ar', 'pobox', 'zipcode', 'address', 'address_ar', 'country', 'city', 'mobile_number', 'phone_number', 'cr_number', 'cr_legal_type', 'user_email'];
			foreach($required_fields as $field) {
				if(empty($_POST[$field])) {
					error_log("Missing required field: " . $field);
					throw new Exception("Please fill in all required fields: " . $field . " is missing");
				}
			}
			
			error_log("Required fields validation passed");

			// Validate email format
			if(!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
				error_log("Invalid email format: " . $_POST['user_email']);
				throw new Exception("Invalid email format");
			}
			
			error_log("Email validation passed");
			
			// Log database operations
			error_log("Starting database operations");
			
			// Get form data
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$name_ar = mysqli_real_escape_string($conn, $_POST['name_ar']);
			$pobox = mysqli_real_escape_string($conn, $_POST['pobox']);
			$zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);
			$address = mysqli_real_escape_string($conn, $_POST['address']);
			$address_ar = mysqli_real_escape_string($conn, $_POST['address_ar']);
			$country = mysqli_real_escape_string($conn, $_POST['country']);
			$city = mysqli_real_escape_string($conn, $_POST['city']);
			$mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
			$phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
			$fax_number = mysqli_real_escape_string($conn, isset($_POST['fax_number']) ? $_POST['fax_number'] : '');
			$website_address = mysqli_real_escape_string($conn, isset($_POST['website_address']) ? $_POST['website_address'] : '');
			$cr_number = mysqli_real_escape_string($conn, $_POST['cr_number']);
			$cr_legal_type = mysqli_real_escape_string($conn, $_POST['cr_legal_type']);
			$cr_registration_date = mysqli_real_escape_string($conn, $_POST['cr_registration_date']);
			$cr_expiry_date = mysqli_real_escape_string($conn, $_POST['cr_expiry_date']);
			$user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
			$product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
			$business_type = mysqli_real_escape_string($conn, isset($_POST['business_type_product_category']) ? $_POST['business_type_product_category'] : '');
			$number_of_employee = mysqli_real_escape_string($conn, $_POST['number_of_employee']);
			$healthcare_status = mysqli_real_escape_string($conn, isset($_POST['healthcare_status']) ? $_POST['healthcare_status'] : 'No');
			
			// Handle file uploads
			$upload_path = 'uploads/';
			
			// Commercial Registration
			$cr_doc = '';
			if(isset($_FILES['upload_document1']) && $_FILES['upload_document1']['error'] == 0) {
				$cr_doc = $upload_path . time() . '_' . $_FILES['upload_document1']['name'];
				move_uploaded_file($_FILES['upload_document1']['tmp_name'], $cr_doc);
			}
			
			// Chamber of Commerce
			$chamber_doc = '';
			if(isset($_FILES['upload_document2']) && $_FILES['upload_document2']['error'] == 0) {
				$chamber_doc = $upload_path . time() . '_' . $_FILES['upload_document2']['name'];
				move_uploaded_file($_FILES['upload_document2']['tmp_name'], $chamber_doc);
			}
			
			// Other Documents
			$other_doc = '';
			if(isset($_FILES['upload_document3']) && $_FILES['upload_document3']['error'] == 0) {
				$other_doc = $upload_path . time() . '_' . $_FILES['upload_document3']['name'];
				move_uploaded_file($_FILES['upload_document3']['tmp_name'], $other_doc);
			}
			
			// Insert company data with additional fields
			$sql = "INSERT INTO `company_tbl` (
				name, name_ar, pobox, zipcode, address, address_ar, country, city, 
				mobile_number, phone_number, fax_number, website_address, cr_number, 
				cr_legal_type, cr_registration_date, cr_expiry_date, user_email, 
				product_id, business_type_product_category, number_of_employee,
				healthcare_status, upload_document1, upload_document2, upload_document3,
				status, record_date
			) VALUES (
				?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', CURDATE()
			)";
			
			$stmt = mysqli_prepare($conn, $sql);
			mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssss", 
				$name, $name_ar, $pobox, $zipcode, $address, $address_ar, $country, $city,
				$mobile_number, $phone_number, $fax_number, $website_address, $cr_number, 
				$cr_legal_type, $cr_registration_date, $cr_expiry_date, $user_email, 
				$product_id, $business_type, $number_of_employee, $healthcare_status,
				$cr_doc, $chamber_doc, $other_doc
			);
			
			if (!mysqli_stmt_execute($stmt)) {
				throw new Exception("Error inserting company data: " . mysqli_error($conn));
			}
			
			$company_id = mysqli_insert_id($conn);
			$_SESSION['company_id'] = $company_id;

			// Insert contact persons
			if (isset($_POST['title']) && is_array($_POST['title'])) {
				foreach ($_POST['title'] as $i => $title) {
					if (!empty($title)) {
						$sql = "INSERT INTO `company_contacts_tbl` (company_id, title, first_name, last_name, 
								job_title, email_id, phone_number1, status) 
								VALUES (?, ?, ?, ?, ?, ?, ?, '0')";
								
						$stmt = mysqli_prepare($conn, $sql);
						mysqli_stmt_bind_param($stmt, "sssssss",
							$company_id, $_POST['title'][$i], $_POST['first_name'][$i],
							$_POST['last_name'][$i], $_POST['job_title'][$i],
							$_POST['email_id'][$i], $_POST['phone_number1'][$i]);
							
						if (!mysqli_stmt_execute($stmt)) {
							throw new Exception("Error inserting contact data: " . mysqli_error($conn));
						}
					}
				}
			}

			// Create order
			$order_id = 'Barcode' . (1000 + $company_id);
			$order_date = date('Y-m-d');
			
			$sql = "INSERT INTO `order_tbl` (company_id, order_id, product_id, user_email, status, order_date) 
					VALUES (?, ?, ?, ?, '0', ?)";
					
			$stmt = mysqli_prepare($conn, $sql);
			mysqli_stmt_bind_param($stmt, "sssss", 
				$company_id, $order_id, $product_id, $user_email, $order_date);
				
			if (!mysqli_stmt_execute($stmt)) {
				throw new Exception("Error creating order: " . mysqli_error($conn));
			}

			// Before sending response
			error_log("Sending success response");
			
			// Send JSON response
			$response = [
				'success' => true,
				'message' => 'Registration successful',
				'redirect' => 'thanks.php'
			];
			error_log("Response: " . print_r($response, true));
			echo json_encode($response);
			exit;
			
		} catch (Exception $e) {
			error_log("Error in form processing: " . $e->getMessage());
			error_log("Stack trace: " . $e->getTraceAsString());
			
			// Send error response
			$response = [
				'success' => false,
				'message' => $e->getMessage()
			];
			error_log("Error response: " . print_r($response, true));
			echo json_encode($response);
			exit;
		}
	}
	// Form Submit Wrap


	if(isset($_POST['action']) && $_POST['action']=='get_product_data'){
		$product_id 	= 	$_POST['product_id'];
	 	$query 			= 	"SELECT * FROM product_tbl where id='".$product_id."' ORDER BY id ASC ";     
		$rs_result 		= 	mysqli_query ($conn, $query);
		$productData	=	mysqli_fetch_array($rs_result);
		$annual_total_price = $productData['gtins_annual_fee'];
	?>
	  	<div id="one" class="table table-responsive">
			<div style="clear: both;"></div>
			<div class="row">
				<!--<h4 class="mt-3">DO YOU REQUIRED ADDITIONAL PRODUCTS</h4>-->
				<h4 class="mt-3">Select Your Products/Service</h4>
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
									<td>
										<input onclick="add()" type="checkbox"  name="gtins_annual_fee" id="gtins_annual_fee" class="test" value="<?=$productData['gtins_annual_fee']?>"> 
									</td>
									<td>
										Do you require GTIN: Global Trade Item Numbers ? 
										<span class="text-danger" data-toggle="tooltip" title="GTIN: Definition">!</span>
										<br />
										<em class="text-danger small">Global Trade Item Number (GTIN) can be used by a company to uniquely identify all of its trade items. GS1 defines trade items as products or services that are priced, ordered or invoiced at any point in the supply chain.</em>
									</td>
									
									<input type="hidden" name="registration_fee" id="reg" value="<?=$productData['registration_fee']?>">
									
									<!--<input type="hidden" name="gtins_annual_fee" value="<?=$productData['gtins_annual_fee']?>"-->

									<td><?=$productData['product_name']?> </td>
									
									<!--<td><?=$productData['registration_fee']?> </td>-->
									
									<input type="hidden" name="product_name" value="<?=$productData['product_name']?>">
									<td>
										<span id="gtins_annual_fee">
											<?=$productData['gtins_annual_fee']?>
										</span>
									</td>
								</tr>
									
								<tr>
									<td>
										<input onclick="add()" type="checkbox"  name="gln_price" id="gln_price" value="<?=$productData['gln_annual_fee']?>"> 
									</td>
									<td>
										Do you require GLN ? 
										<span class="text-danger" data-toggle="tooltip" title="GTIN: Definition">!</span>
										<br />
										<em class="text-danger small">The Global Location Number can be used by companies to identify their locations, giving them complete flexibility to identify any type or level of location required.</em>
									</td>
									<td>
										<span id="gln_price_span"><?=$productData['gln_annual_fee']?></span>
									</td>
								</tr>
								<?php
									if($productData['sscc_annual_fee']==0){}
									else{ ?>
											<tr>
												<td>
													<input onclick='add()' type='checkbox' name='sscc_price' id='sscc_price' value=" <?php echo $productData['sscc_annual_fee'];?>">
												</td>
												<td>
													Do you require SSCC? <span class='text-danger' data-toggle='tooltip' title='SSCC: Definition'>!</span><br />
													<em class='text-danger small'>The Serial Shipping Container Code can be used by companies to identify a logistic unit, which can be any combination of trade items packaged together for storage and/or transport purposes; for example a case, pallet or parcel.</em>
												</td>
												<td>
													<span id='sscc_price_span'><?php echo $productData['sscc_annual_fee'];?>"</span>
												</td>
											</tr>
								<?php }	?>
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
				<span class="fw-bold text-danger">Valid till 31st Dec <?php echo date("Y"); ?> </span>
			</div>

			<div class="col-md-4">
				<label class="fw-bold">Annual Subscription Fee  </label>
				<div class="input-group mb-3">
					<span class="input-group-text" id="basic-addon1">OMR</span>
				  	<!--<input type="number" id="total" class="form-control mb-0" >
				  	<div id="total" class="form-control">500</div>-->

				  	<!--<input type="hidden" name="annual_subscription_fee" id="annual_subscription_fee" value="<?=$productData['gtins_annual_fee']?>"/>-->
				  	<input type="hidden" name="annual_subscription_fee" id="annual_subscription_fee" value="0" />
				  	<input type="hidden" id="annual" value="<?=$productData['gtins_annual_fee']+$productData['gln_annual_fee']+$productData['sscc_annual_fee'];?>" />
				  	<input type="text" class="form-control mb-0" size="2" name="annual_total_price" id="annual_total_price" value="0" disabled/>
				</div>
				<span class="fw-bold text-danger">Next renewal Jan <?php echo date('Y', strtotime('+1 year'));?> </span>
			</div>
			<div class="col-md-4">
				<label class="fw-bold">Total Fee  </label>
				<div class="input-group mb-3">
					<span class="input-group-text" id="basic-addon1">OMR</span>

					<input name="total_pricee" id="total_price" type="text" class="form-control mb-0" value="<?php echo $granddiscount5;?>" disabled>

					<input class="form-control mb-0" disabled id="demo">
				</div>
			</div>

			<div class="col-md-2 d-none">
				<label class="fw-bold">Discount Amount</label>
				<div class="input-group mb-3">
					<span class="input-group-text" id="basic-addon1">OMR</span>

					<input name="discount_amount" id="discount_amount_input" type="text" class="form-control mb-0" value="<?php echo $total_amount_discount;?>" disabled>
				</div>
			</div>

			<input type="hidden" id="regdiscount" name="promoregistration_fee" class="form-control mb-0"  value="$promoregistration_fee" disabled>
			<input type="hidden" id="annualdiscount" name="annual_fee" class="form-control mb-0"  value="$annual_fee" disabled>
			<div class="col-md-2 d-none">
				<label class="fw-bold">Registration Discount</label>
				<input name="" id="regvalue" type="text" class="input-group-text" value="" disabled>
				<label class="fw-bold">Annual Discount</label>
				<input name="" id="annualvalue" type="text" class="input-group-text" value="" disabled>
			</div>
		</div>
						
		<!--<div>
			<label class="fw-bold">Payment Method</label><br>
				<input type="radio" name="offline_payment" value="0" class="tick" required>&nbsp;Pay By Card&nbsp;
				<input type="radio" name="offline_payment" value="1" class="tick" required>&nbsp;Cash
			<div class="error-message" style="color: red; display: none;">This field is required.</div>
		</div>-->

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

		// Register a shutdown function to catch any timeout errors
	    register_shutdown_function(function() {
	        $error = error_get_last();
	        if ($error && $error['type'] === E_ERROR) {
	            echo "A fatal error occurred: " . $error['message'];
	        }
	    });
	?>

	<section class="user_registration">
		<div class="container">
			<form name="listForm" action="" method="post" enctype="multipart/form-data" id="regform">
				<!-- Add message containers -->
				<div id="successMessage" class="alert alert-success" style="display: none;"></div>
				<div id="errorMessage" class="alert alert-danger" style="display: none;"></div>
				<div id="loadingIndicator" style="display: none;">
					<div class="text-center">
						<div class="spinner-border text-primary" role="status">
							<span class="sr-only">Loading...</span>
						</div>
						<p>Processing your registration...</p>
					</div>
				</div>
				<input type="hidden" name="annual_total_price" value="<?=$annual_total_price?>">
				<h4>companies details</h4>
				<div class="row">
					
					<div class="col-md-6">
						<label>Company Name English	*</label>
						<input type="text" class="form-control" maxlength="100" name="name" placeholder="Company Name English" required>
						<span id="name_error"></span>
					</div>
					<div class="col-md-6">
						<label>Company Name Arabic	*</label>
						<input type="text" class="form-control" maxlength="100" name="name_ar" placeholder="Company Name Arabic" required>
						<span id="name_ar_error"></span>
					</div>
					<div class="col-md-6">
						<label>PO Box *</label>
						<input type="text" class="form-control number" maxlength="5" name="pobox" placeholder="PO Box" pattern="[0-9]{3,5}" required>
						<span id="pobox_error"></span>
					</div>

					<div class="col-md-6">
						<label>Postal Code *</label>
						<input type="text" class="form-control number" maxlength="3" name="zipcode" placeholder="Postal Code" pattern="[0-9]{3}" required>
						<span id="zipcode_error"></span>
					</div>
					<div class="col-md-6">
						<label>Address English	*</label>
						<input type="text" class="form-control" name="address" placeholder="Office Number, Bld No, Way No, Town" required>
						<span id="address_error"></span>
					</div>
					<div class="col-md-6">
						<label>Address Arabic	*</label>
						<input type="text" class="form-control" name="address_ar" placeholder="Office Number, Bld No, Way No, Town" required>
						<span id="address_ar_error"></span>
					</div>

					<div class="col-md-6">
						<label>Country *</label>
						<select class="form-control" name="country" required>
							<option selected disabled>Select Country</option>
							<option value="Oman">Oman</option>
							<option disabled>---Others---</option>

							<?php 
								$country=mysqli_query($conn,"SELECT * FROM countries WHERE country_enName!='Oman'");
								while($c=mysqli_fetch_array($country)){?>
								
								<option value="<?=$c['country_enName']?>"><?=$c['country_enName']?></option>
							<?php }?>
						</select>
						<span id="country_error"></span>
					</div>


					<div class="col-md-6">
						<label>City	*</label>
						<select class="form-control" name="city" required>
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
						<span id="city_error"></span>
					</div>
					
					
					<div class="col-md-6">
						<label>Mobile Number *</label>
						<input type="text" class="form-control number" name="mobile_number" placeholder="968 0000 0000" pattern="\d{11}" title="Please enter a valid mobile number" maxlength="11" minlength="11" required>
						<span id="mobile_number_error"></span>
					</div>
					<div class="col-md-6">
						<label>Phone Number *</label>
						<input type="text" class="form-control number" name="phone_number" placeholder="968 0000 0000" pattern="\d{11}" minlength="11" maxlength="11" title="Please enter a valid phone number with the correct country code.<br> Use numbers only example: 96871777467" required>
						<span id="phone_number_error"></span>
					</div>
					<div class="col-md-6">
						<label>Fax Number</label>
						<input type="text" class="form-control number" name="fax_number" placeholder="968 0000 0000" pattern="\d{11}" minlength="11" maxlength="11"title="Please enter correct fax number">
						<span id="fax_number_error"></span>
					</div>

					<div class="col-md-6">
						<label>Website Address</label>
						<input type="text" class="form-control" name="website_address" placeholder="www.gs1oman.org" title="Please enter a valid website URL">
					</div>
				</div>


				<hr>
				<h4>OTHER DETAILS *</h4>
				<div class="row">
					<!--<div class="col-md-12">
						<label>Tax Registration Number *</label>
						<input type="text" class="form-control" placeholder="" name="tax_reg_no">
					</div>-->
					<div class="col-md-12">
					<label>Do you have Riyada certificate*</label><br>
					<select class="form-control validate" name="riyada_certificate" id="riyada_certificate" required>
						<option value="">Select</option>
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
					<span id="riyada_certificate_error"></span>
					</div>
					<div class="col-md-6" id="expiry_date_container" style="display: none;">
						<label>Expiry Date*</label>
						<input type="date" class="form-control" placeholder="" name="exp_date" id="exp_date" min="<?php echo date('Y-m-d'); ?>" >
						<span id="exp_date_error"></span>
					</div>
					<div class="col-md-6" id="documents_container" style="display: none;">
						<label>Documents*</label><br>
						<input type="file" class="form-control-file" id="documents_req" name="documents_req" id="documents_req"><br>
						<span id="documents_req_error"></span>

					</div>
				</div>
				<hr>

				<h4>Cr details</h4>
				<div class="row">
					<div class="col-md-6">
						<label>Company Registration Number (CR No.): *</label>
						<input type="text" class="form-control number" maxlength="12" name="cr_number" placeholder="CR Number" pattern="[0-9]{12}" required>
						<span id="cr_number_error"></span>
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
						<span id="cr_legal_type_error"></span>
					</div>
					<div class="col-md-3">
						<label>CR Registration Date</label>
						<input type="date" class="form-control" name="cr_registration_date" max="<?php echo date('Y-m-d'); ?>" required>
						<span id="cr_registration_date_error"></span>
					</div>
					<div class="col-md-3">
						<label>CR Expiry Date</label>
						<input type="date" class="form-control" name="cr_expiry_date" min="<?php echo date('Y-m-d'); ?>" required>
						<span id="cr_expiry_date_error"></span>
					</div>
					<div class="col-md-3">
						<label>Tax Registration Number</label>
						<input type="text" class="form-control number" maxlength="12" name="cr_tax_registration_number" placeholder="Tax Registration Number" pattern="[0-9]{12}">
						<span id="cr_tax_registration_number_error"></span>
					</div>
					<div class="col-md-3">
						<label>VAT</label>
						<input type="text" class="form-control alpha_num" maxlength="15" id="vat_registration_number" name="vat_number" placeholder="VAT Registration Number" pattern="[A-Za-z0-9]{15}">
						<span id="vat_number_error"></span>
					</div>
				</div>
				<hr>
					<!--<label>OTHER DETAILS *</label>
					<label>Tax Registration Number *</label>
						<input type="text" class="form-control" placeholder="" name="tax_reg_no" required>
						<label>Do you have Riyada certificate*</label>
						<input type="radio" class="form-control" placeholder="" name="riyada_certificate" required>
						<label>Issue Date*</label>
						<input type="Date" class="form-control" placeholder="" name="issue_date" required>
						<label>Expiry Date*</label>
						<input type="Date" class="form-control" placeholder="" name="exp_date" required>
						<label>Support documents required*</label>
				<hr>-->
				<h4>login details</h4>
				<div class="row">
					<div class="col-md-12">
						<label>Primary email address *</label>
						<input type="text" class="form-control" placeholder="user@email.com" name="user_email" required>
						<span id="user_email_error"></span>
					</div>
					<div class="col-md-6" style="display:none;">
						<label>Password *</label>
						<input type="password" class="form-control" placeholder="Password" name="password" >
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
						<span id="business_type_product_category_error"></span>
					</div>
					<div class="col-md-6">
						<label>Number of Employees</label>
						<input type="text" class="form-control number" maxlength="7" name="number_of_employee" pattern="[0-9]{1,7}">
						<span id="number_of_employee_error"></span>
					</div>
				</div>
				
				<hr>
				
				<h4>Are you in Healthcare?</h4>
				<div class="row">
					<div class="col-md-12">
						<label>Are you in identifying medical devices, which fall under the U.S. Food and Drug Administration (FDA) or Unique Device Identification System (UDI)? <span class="text-danger" data-toggle="tooltip" title="The U.S. FDA considers a product to be a device if it meets the definition of a medical device per Section 201(h) of the Food, Drug, and Cosmetic Act.">!</span> *</label>
					</div>
					<div class="col-md-12">
					<input type="radio" name="healthcare_status" value="Yes" class="tick" required> &nbsp; Yes 
					<input type="radio" name="healthcare_status" value="No" class="tick" required> &nbsp; No
					</div>
					<span id="healthcare_status_error"></span>
					
				</div>

				<hr>
				<h4>COMPANY CONTACTS MINIMUM 2 PERSONS</h4>
				<hr>
				<h5 class="fw-bold">Main Contact</h5>
				<div class="row">
					<div class="col-md-2">
						<label>Title *</label>
						<select class="form-control" name="title[]">
							<option value="Mr.">Mr.</option>
							<option value="Mrs.">Mrs.</option>
							<option value="Miss">Miss</option>
							<option value="Dr">Dr.</option>
						</select>
					</div>
					<div class="col-md-5">
						<label>First Name *</label>
					<input type="text" name="first_name[]" class="form-control alpha_char" placeholder="First Name" pattern="[A-Za-z]+" required>
					<span id="first_name_error"></span>
					</div>
					<div class="col-md-5">
						<label>Last Name *</label>
						<input type="text" name="last_name[]" class="form-control alpha_char" placeholder="Last Name" pattern="[A-Za-z]+" required>
						<span id="last_name_error"></span>
					</div>

					<div class="col-md-2">
						<label>Job Title *</label>
						<input type="text" class="form-control validate" name="job_title[]" placeholder="Enter Job Title" pattern="[A-Za-z\s]+" title="Please enter text characters only" required>
						<span id="job_title_error"></span>
					</div>
					<div class="col-md-5">
					<label>Email *</label>
						<input type="email" name="email_id[]" class="form-control unique-email" placeholder="user@gs1.org" required rel="0" onChange="CheckEmail($(this).val(),0)">
						<span class="email_error"  id="email_id_error_0" style="color:red"></span>
					</div>
					<div class="col-md-5">
						<label>Phone Number *</label>
						<input type="text" name="phone_number1[]" class="form-control number unique-phone" placeholder="968 000 000" pattern="\d{11}" title="Please enter an 11-digit mobile number" maxlength="11" minlength="11" required>
						<span id="phone_number1_error"></span>
						<span class="phone_number_error" id="phone_number1_error_0" style="color:red"></span>
					</div>
					<div class="col-md-12">
						<span> "Is this the main contact? This users will manage the GTINS in your GS1 Activate Account and their details will be used in GEPIR as the main primary contact of your company" </span><br>
						<!--<input type="radio" name="main_contact_status" value="Yes" class="tick"> &nbsp; Yes 
					 <input type="radio" name="main_contact_status" value="NO" class="tick"> &nbsp; No-->
						 
					</div>
				</div>

				<hr>

				<div id="dynamic-field-1" class="dynamic-field">
                    <h5 class="fw-bold">Additional Contact</h5>

					<div class="row">
						<div class="col-md-2">
							<label>Title *</label>
							<select class="form-control validate" name="title[]">
								<option value="Mr.">Mr.</option>
								<option value="Mrs.">Mrs.</option>
								<option value="Miss">Miss</option>
								<option value="Dr.">Dr.</option>
							</select>
							<span class="text-danger"></span>
						</div>
						<div class="col-md-5">
							<label>First Name *</label>
							<input type="text" name="first_name[]" class="form-control alpha_char validate" placeholder="First Name" pattern="[A-Za-z]+" title="Please enter text characters only">
							<span class="text-danger"></span>
						</div>
						<div class="col-md-5">
							<label>Last Name *</label>
							<input type="text" name="last_name[]" class="form-control alpha_char validate" placeholder="Last Name" pattern="[A-Za-z]+" title="Please enter text characters only">
							<span class="text-danger"></span>
						</div>

						<div class="col-md-2">
							<label>Job Title *</label>
							<input type="text" class="form-control validate" name="job_title[]" placeholder="Enter Job Title" pattern="[A-Za-z\s]+" title="Please enter text characters only" required>
							<span class="text-danger"></span>
						</div>
						<div class="col-md-5">
							<label>Email *</label>
							<input type="email" name="email_id[]" class="form-control validate unique-email" placeholder="user@gs1.org" rel="1" onChange="CheckEmail($(this).val(),1)">
							<span class="email_error" id="email_id_error_1" style="color:red"></span>
						</div>
						<div class="col-md-5">
							<label>Phone Number *</label>
							<input type="text" name="phone_number1[]" class="form-control validate unique-phone" placeholder="968 000 000" maxlength="11" rel="1" onkeyup="ValidateNumberClass(this,1)">
							<span class="phone_number_error" id="phone_number1_error_1" style="color:red"></span>
						</div>
						
					</div>
				</div>
				<div id="errorDiv" class="alert alert-danger" role="alert" style="display: none;">
                    <!-- Error message will go here -->
                    Something went wrong! Please try again.
                </div>
				<div style="clear: both;"></div>
				<div id="error-message" class="text-danger"></div>
				<h5 class="fw-bold">Add another contact person</h5>
				
				<button type="button" id="add-button" class="btn btn-primary float-left text-uppercase shadow-sm"><i class="fas fa-plus fa-fw"></i> Add </button>
				<button type="button" id="remove-button" class="btn btn-warning float-left text-uppercase ml-1" disabled="disabled" style="color: #ffffff; background-color: #f34006; border-color: #f34006;"><i class="fas fa-minus fa-fw"></i> Remove </button>

				<hr>
				
				<h4>UPLOAD DOCUMENTS</h4>

				<div class="row">
					<div class="col-md-4">
						<label>Commercial Registration (All pages) *</label>
						<input type="file" class="form-control mb-0 validate" name="upload_document1" required >
						<span class="fo-12">JPG, PDF, PNG Allowed </span>
						<span id="upload_document1_error"></span>
					</div>
					<div class="col-md-4">
						<label>Chamber of Commerce Certificate *</label>
						<input type="file" class="form-control mb-0 validate" name="upload_document2" required>
						<span class="fo-12">JPG, PDF, PNG Allowed </span>
						<span id="upload_document2_error"></span>
					</div>
					<div class="col-md-4">
						<label>Other Documents  *</label>
						<input type="file" class="form-control mb-0 validate" name="upload_document3" required>
						<span class="fo-12">JPG, PDF, PNG Allowed </span>
						<span id="upload_document3_error"></span>
					</div>
				</div>

				<hr>
				<h4>Select Package</h4>
					
				<div class="row">
					<div class="col-md-12">
						<!--<label>How many GTINS do you require? <span class="text-danger" data-toggle="tooltip" title="GTIN: Definition">!</span>* </label>-->
						<label>Select your package carefully, as upgrading a GS1 Company Prefix (GCP) is not possible later. To ensure you choose the right package for your future needs, use our tool: <a href="https://gs1oman.org/en/calculate.html" class="text-decoration-none" target="_blank">GS1 Capacity Calculator </a>or consult our team for assistance.  <span class="text-danger" data-toggle="tooltip" title="GTIN: Definition">!</span>* </label>
						
						<div class="button dropdown"> 
							<select name="product_id" id="product_id" onchange="show_package_details();" required>
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
				<span id="product_id_error"></span>
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

				



				<div class="row promodaata mt-4">
					<div class="col-md-6">
						<label>I have a promo code</label>
						<input type="text" class="form-control" placeholder="Please enter promo code" name="promo_code" id="promo_code">
					</div>
					<div class="col-md-6" style="margin-top:30px">
					
						<input type="button" class="btn btn-success" name="apply" value="Apply" id="apply_button">
					</div>
				</div>
				<div id="promo_message"></div>
				<!--- without discount -->
				 <div class="row fee_table mt-3" id="actual_package_price">
								<div class="col-md-4">
									<label class="fw-bold">Registration Fee </label>
									<div class="input-group mb-3">
									  <span class="input-group-text" id="basic-addon1">OMR</span>
									  
										
										<input type="text" id="actual_registration_fee" name="registration_fee" class="form-control mb-0"  value="<?=$productData['registration_fee'];?>" disabled>
										
									</div>
									
								</div>

								<div class="col-md-4">
									<label class="fw-bold">Annual Subscription Fee  </label>
									<div class="input-group mb-3">
									  <span class="input-group-text" id="basic-addon1">OMR</span>
									 <input type="hidden" name="annual_subscription_fee" id="actual_annual_subscription_fee" value="0" />
									  <input type="hidden" id="actual_annual" value="<?=$productData['gtins_annual_fee']+$productData['gln_annual_fee']+$productData['sscc_annual_fee'];?>" />
									  <input type="text" class="form-control mb-0" size="2" name="annual_total_price" id="actual_annual_total_price" value="0" disabled/>
									</div>
									
								</div>
								

								<div class="col-md-4">
									<label class="fw-bold">Total Fee  </label>
									<div class="input-group mb-3">
									  <span class="input-group-text" id="basic-addon1">OMR</span>
									 <input name="total_pricee" id="actual_total_price" type="text" class="form-control mb-0"  value="<?php echo $granddiscount5;?>" disabled>
									
									  <input class="form-control mb-0" disabled id="demo">
									  
									</div>
								</div>
								
							</div>
							<!----end of without discount  -->
				<!--- new for display discount -->
						<div class="row fee_table" id="dis_fee_table">
								<div class="col-md-4">
									<label class="fw-bold">Registration Fee after Discount</label>
									<div class="input-group mb-3">
									  <span class="input-group-text" id="basic-addon1">OMR</span>
									  
										
										<input type="text" id="registration_fee_dis" name="registration_fee" class="form-control mb-0"  value="0" disabled>
										
									</div>
									
								</div>

								<div class="col-md-4">
									<label class="fw-bold">Annual Fee after Discount </label>
									<div class="input-group mb-3">
									  <span class="input-group-text" id="basic-addon1">OMR</span>
									 
									  
									  <input type="hidden" name="annual_subscription_fee" id="annual_subscription_fee" value="0" />
									  <input type="hidden" id="annual" value="<?=$productData['gtins_annual_fee']+$productData['gln_annual_fee']+$productData['sscc_annual_fee'];?>" />
									  <input type="text" class="form-control mb-0" size="2" name="annual_total_price" id="annual_total_price_dis" value="0" disabled/>
									</div>
									
								</div>
								

								<div class="col-md-4">
									<label class="fw-bold">Total Fee After Discount</label>
									<div class="input-group mb-3">
									  <span class="input-group-text" id="basic-addon1">OMR</span>
									 <input name="total_pricee" id="total_price_dis" type="text" class="form-control mb-0"  value="<?php echo $granddiscount5;?>" disabled>
									
									  <input class="form-control mb-0" disabled id="demo">
									  
									</div>
								</div>
								
								
								<input type="hidden" id="regdiscount" name="promoregistration_fee" class="form-control mb-0"  value="$promoregistration_fee" disabled>
								<input type="hidden" id="annualdiscount" name="annual_fee" class="form-control mb-0"  value="$annual_fee" disabled>
								<div class="col-md-2 d-none">
									<label class="fw-bold">Registration Discount</label>
									<input name="" id="regvalue" type="text" class="input-group-text" value="" disabled>
									<label class="fw-bold">Annual Discount</label>
									<input name="" id="annualvalue" type="text" class="input-group-text" value="" disabled>
								</div>
						</div>
						<!--- End of code for display discount -->
						<!-- vat showing with or without discount-->
						<div class="row">
							<div class="form-group col-4 mb-2">
							</div>
							<div class="form-group col-4 mb-2">
							</div>
							<div class="form-group col-4 mb-2">
							
								<div class="col-md-12">
									<label class="fw-bold">VAT</label>
									<div class="input-group mb-3" >
									  <p class="input-group-text w-100" id="vat">OMR</p>
									
									</div>
								</div>
								<p id="discountt"></p>
								<div class="col-md-12">
									<label class="fw-bold">Grand Total</label>
									<div class="input-group mb-3" >
									  <p class="input-group-text w-100" id="grand_total">OMR </p>
									
									</div>
								</div>
								</div>
						</div>	
						<!-- End of code for vat showing with or without discount-->
						
				<h5>When you apply for a GCP, the following services are included:</h5></br>
				<div class="full-width-content">
					<ol>
						<li> You are given a license "GS1 Company Prefix" which gives you access to, and use of, the GS1
						system identification standards. A GCP allows Company to create any of the GS1 identification keys,including but not limited to Global Trade Item Number ("GTIN"), Global Location Number ("GLN") and Serial Shipping Container Code ("SSCC")("GS1 Identification Keys").</li>
						<li> You are given access to our "GS1 Activate" tool, which allows you to create and manage
						your barcode numbers and to generate corresponding barcode images automatically.</li>
						<li><b>REFUND POLICY:</b>Once submitted, the Application Fee is non-refundable. Refunds shall not be given after 24 hours of submitting an application form for any reason whatsoever (including but not limited to applications submitted in error). As an administration fee, all applications may be taken as having been received and processed within 24 hours of submission. A request to cancel an application or refund of the Application Fee, must be received by GS1 Oman within 24 hours of the application form being submitted, via helpdesk@gs1oman.org After such time, no refund shall be given. I have understood my company will be charged annual fee(s) according to the licence(s) my company applied for annually and Annual subscription fee is renewable on 1st of January every calendar year.
						</li>
					</ol>
				</div>
				<div class="col-md-12">
				  <div id="offline_payment_group">
				  <label class="fw-bold">Payment Method *</label><br>
					<input type="radio" name="offline_payment" value="0" class="tick" required> &nbsp; Pay By Card
					<input type="radio" name="offline_payment" value="1" class="tick" required> &nbsp; Cash
				  </div>
				  <span id="offline_payment_error"></span>
				</div>
				<input type="hidden" id="param1" value="<?php echo $productData['registration_fee']; ?>">
			<hr>
			<div id="offline_payment_instructions" style="display: none;">
				<h3><u>Offline Payment Instructions:</u></h3>
				<p>Thank you for choosing our products! To proceed with offline payment, please follow the instructions below:</p>
				<h4>Payment Method Description:</h4>
				<p>Offline payment allows you to pay for your order outside of our website. You can choose from the following methods:</p>
				
				<ol>
					<li><b>Bank Transfer:</b> Make a direct bank transfer to the account provided below.</li>
					<li><b>POS:</b> Pay at our offices with your card.</li>
				</ol>
				<h4>Payment Instructions:</h4>
				<p>Payments to be made to the National Bank of Oman (NBO)</p>
				<p>Account Name: Oman Barcoding Center</p>
				<p>Account Number: 1049-0397900-001</p>
				<p>Contact Information:</p>

				<p>If you have any questions or need assistance with the offline payment process, feel free to contact our customer support team:</p>
				<ol style="list-style-type: circle">
					<li>Email:<a href="#">helpdesk@gs1oman.org</a></li>
					<li>Phone: +968 7222 6166</li>
				</ol>
				
				<h6>Order Confirmation:</h6>
				<p>Once we receive and verify your payment, we will process your application and send you an order confirmation via email for GS1 Activate where you will be able to manage your GTINs. The assignment of barcodes to your products is the sole responsibility of the member company. Should you require more information feel free to contact us at any time.</p>
				
			</div>
			
			
				<div class="row">
					<div class="col-md-12">
						<input type="checkbox" id="finalpay1" class="tick" required name="tnc" value="Yes"> &nbsp; <span>Accept <a id="finalpay" href="#" class="text-orange" data-bs-toggle="modal" data-bs-target="#terms"> Terms and conditions </a>/ <a href="#" class="text-orange" data-bs-toggle="modal" data-bs-target="#privacy"> Privacy policy </a> </span>
					</div>
					<span id="tnc_error"></span>
				</div>
				<div class="row">
					<div class="form-group col-12 mb-2">
					  <div class="g-recaptcha" data-sitekey="6LeD_OQhAAAAALV9zeyjeh822UKGL4MTFIw8d4hu" data-validate="captcha"></div>
					  <div id="captcha_error"></div>
					  </div>
				</div>

				<div class="col-md-12 text-center">
					<button type="submit" name="submit" value="1" id="reg_form_button" class="btn btn-success" style="color: #ffffff;background-color: #f34006;border-color: #f34006;">
						Sign Up
					</button>
				</div>
				<div id="response"></div>


			</form>
		</div>
	</section>

	<div class="modal" id="terms">
	  	<div class="modal-dialog" style="max-width:1100px;">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Terms & Conditions</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body terms-conditions">
					<b><u><center>A. GS1 Company Prefix License</center></u></b>
					<p>This "GS1 Company Prefix License" (the "License") is entered into by and between GS1 Oman incorporated under the name Oman Barcoding Center, a nonprofit organization, under Registration number 1360120, having its principal place of business at Markaz Al Tijari Street First-floor OCCI, Ruwi, Muscat in the Sultanate of Oman, (hereinafter "GS1 Oman"); and the entity which is identified as "Company" hereunder, and which provides its acceptance hereto), and which provides its acceptance of by click-to-accept.</p>
					<ol>
						<li><b>Grant of License.</b> Subject to the terms of this License and for the Term of the License, GS1 Oman hereby grants Company a non-exclusive, non-transferable, worldwide, revocable license to use the GS1 Oman Company Prefix ("GCP") issued to. The license granted herein shall not be sublicensed in whole or in part, and any attempted sublicense shall be void ab initio.</li>

						<li><b>Use.</b> A GCP gives access to, and use of, the GS1 system identification standards. A GCP allows Company to create any of the GS1 identification keys, including but not limited to Global Trade Item Number ("GTIN"), Global Location Number ("GLN") and Serial Shipping Container Code ("SSCC")("GS1 Identification Keys"). To assist Company in creating and managing certain GS1 Identification Keys, GS1 Oman makes available to Company a specific service which is governed by separate Terms of Use (see section B below).</li>
						
						<li><b>Term.</b> The License comes into effect for Company on the date on which GS1 Oman notifies Company of its acceptance of its application and continues until terminated as provided in section 9.</li>
						
						<li><b>Fees.</b></li>
						
						<ol class="alpha-list">
							<li>	Company shall pay license fee for the GCP ("License Fee") to GS1 Oman annually within 30 days of the date of GS1 Oman's invoice.</li>
							<li>	GS1 Oman may, from time to time, increase the License Fee.</li>
							<li>	GS1 Oman reserves the right to charge interest at 12% per annum in case of default to pay at the due date.</li>
							<li>	Company acknowledges and agrees that GS1 Oman may recover any cost it incurs related to recovering any late or unpaid fees to GS1 Oman including but not limited to interest, debt collection fees, expenses, and reasonable legal fees.</li>
							<li>	Where items bearing the GS1 Oman identification numbers issued to Company are already in the marketplace at the time the License is terminated, notwithstanding such termination, Company will remain liable for a fee equivalent to the then current License Fee for the period that Company continues to distribute/use/identify those items bearing the GS1 Oman identification numbers.</li>
						</ol>
						
						<li><b>	Company Obligations and Permitted Use. Company shall:</b></li>
						
						<ol class="alpha-list">
							<li>	not at any time do or commit to do anything whereby the goodwill or reputation of GS1 Oman may be prejudices or brought into disrepute;</li>
							<li>		only use the GCP that is issued to it in connec</li>tion with the manufacture, sale and identification of, but not limited to, its products, locations and containers;
							<li>		only use GS1 Identification Keys issued to it by GS1 Oman or a GS1 Member Organization;</li>
							<li>		not, and not attempt to, alter, transfer, share, sell, lease, sub-license, or subdivide the GCP and/or GS1 Identification Keys issued by GS1 Oman and may not permit identification of the items by any other party;</li>
							<li>	not use any GS1 Identification Keys for a purpose other than the one stated in the GS1 Standards' documentation;</li>
							<li>	recognize GS1 Oman's right, title and interest in and to the GCP and all related intellectual property rights, including but not limited to trademarks and copyrights, and Company shall not at any time do or allow to be done any act or thing which may in any way impair GS1 Oman's right, title or interest in the GCP or related intellectual property rights;</li>
							<li>		ensure that its products bear all proprietary notices that GS1 Oman may require Company to display from time to time;</li>
							<li>		comply with the GS1 General Specifications, available via https://www.gs1.org/barcodes-epcrfid-id-keys/gs1-general-specifications, and any other technical specifications that may be implemented and/or as amended from time to time;</li>
							<li>		shall forthwith notify GS1 Oman of any change to its contact details (including contact name(s), telephone number, email address, webpage) and shall ensure that its details are up-to-date and correct at all times;</li>
							<li>		notify GS1 Oman of any change in corporate structure including but not limited to merger, acquisition, partial purchase, split or "spin off";</li>
							<li>		upon termination, assist GS1 Oman to identify GS1 Identification Keys that may be in circulation and ensure that retailers, distributors or any relevant third parties are, upon request, required to provide to GS1 Oman details of all GS1 Identification Keys relating to Company that have been processed in the preceding 12 months; </li>
							<li>	ensure that it has and maintains all necessary approvals, permits and licenses to operate its business activities and that the identification, manufacture, distribution, packaging and/or sale of identified items comply with all applicable laws.</li>
						</ol>
						<li>	<b>Liability and Indemnity.</b></li>
						
						<ol class="alpha-list">
							<li>	DISCLAIMER OF WARRANTIES: COMPANY ACKNOWLEDGES AND AGREES THAT GS1 OMAN MAKES NO REPRESENTATIONS OR WARRANTIES, EXPRESS OR IMPLIED, REGARDING THE GS1 SYSTEM, THE GCP AND THE GS1 IDENTIFICATION KEYS, AND ANY SUCH REPRESENTATION OR WARRANTY IS EXPRESSLY DISCLAIMED, INCLUDING BUT NOT LIMITED TO MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE.</li>
							<li>	LIMITATION OF LIABILITY: TO THE FULLEST EXTENT PERMITTED BY LAW, GS1 OMAN'S TOTAL LIABILITY TO COMPANY FOR LOSS OR DAMAGE OF ANY KIND ARISING OUT OF THIS LICENSE FOR ANY AND ALL CLAIMS IS LIMITED TO THE TOTAL LICENSE FEE COMPANY PAID DURING THE 12 MONTH PERIOD PRIOR TO THE RELEVANT LIABILITY ARISING. GS1 OMAN SHALL NOT BE LIABLE FOR ANY CONSEQUENTIAL, INDIRECT, INCIDENTAL, OR PUNITIVE DAMAGES, INCLUDING WITHOUT LIMITATION LOSS OF REVENUE, PROFITS, OR BUSINESS, THAT MAY ARISE FROM COMPANY'S USE OF A GCP, THE GS1 IDENTIFICATION KEYS, AND/OR THE GS1 SYSTEM.</li>
							<li>	INDEMNITY: Company agrees to hold GS1 Oman and its affiliates, and each of its respective directors, officers, agents, employees, and representatives harmless from and against any claims, actions, proceedings, damages, costs, expenses (including reasonable attorney's fees), and liabilities arising out of or in connection to Company's (including its officers, employees and agents) non¬observance or breach of this License (except to the extent caused by GS1 Oman's negligence or willful misconduct).</li>
						</ol>

						<li><b>	Suspension.</b> GS1 Oman may suspend Company's GCP license with immediate effect by a written notice to Company if Company commits a material breach of any provision of this License and until such time that such breach is cured.</li>
						
						<li><b>Termination.</b> GS1 Oman may terminate the License: (i) immediately by giving written notice if Company fails to pay the License Fee by its due date or if Company commits a breach of its obligations under this License which it fails to cure within 15 days of a written notice, or (ii) to the fullest extent permitted by the Omani law, with immediate effect in the event that Company goes into administration, liquidation or bankruptcy or is otherwise dissolved. Either GS1 Oman or Company may terminate this License in any other circumstances by giving six months' written notice to the other party. Company may terminate this License by thirty (30) days advance written notice sent to GS1 Oman in case GS1 Oman amends the terms of the License in accordance with section 14 below. Termination of this License does not relieve either GS1 Oman or Company from liability arising from any prior breach of the terms of this License.</li>
						

						<li><b>	Consequences of Termination. </b>In the event that the License is terminated, Company shall:</li>
						a.	immediately cease applying the GS1 Identification Keys issued by GS1 Oman to any item identified, manufactured, distributed, packaged and/or sold by Company after the termination date;
						b.	immediately withdraw the products that use or display any GS1 Identification Key issued by GS1 Oman created under this License from the market or re-label the products to ensure that the GS1 Identification Keys are unreadable;
						c.	where item bearing GS1 Identification Keys issued by GS1 Oman to Company remain in the marketplace at the time of termination then, notwithstanding such termination, Company remains liable for a fee equivalent to the License Fee for the period that Company's item continue to be identified/used/distributed or otherwise remain in the marketplace;
						d.	assist GS1 Oman in contacting and verifying with third party distributors and retailers through which Company has sold its products whether Company has complied with its post-termination obligations described herein; and
						e.	be immediately liable for all outstanding fees due and payable to GS1 Oman, such outstanding fees to be subject to a penalty interest rate of 12% per annum, or other such rate determined by GS1 Oman from the original due date for payment.
						
						<li><b>	Privacy. </b>GS1 Oman will handle any personal data provided by Company and its Authorized Users in accordance with the Privacy Policy available on the GS1 Website (as amended from time to time).</li>
						
						<li><b>	Assignment.</b> Company shall not assign its rights and obligations under this License to any other party (whether to a related entity or third party) without the prior express written consent of GS1 Oman, such consent to be given in GS1 Oman's absolute discretion. Any purported assignment of this License by Company, without GS1 Oman's prior express written consent, shall be void ab initio.</li>
						
						<li><b>	Notices.</b> All notices required to be given hereunder shall be in writing (email included) to the other party's registered business address, principal place of business or the (email) address identified when registering to use Activate or otherwise updated by Company or its Authorized Users in Activate from time to time.</li>
						
						<li><b>	Authority to Contract.</b> Company represents and warrants that it holds the necessary authority and is authorized to enter into this binding agreement and fulfil its obligations hereunder.</li>
						
						<li><b>	Amendment.</b> GS1 Oman reserves the right to amend this License from time to time, unilaterally and without prior notice, and such amendment shall generally be made available online and/or via the contact details given to GS1 by the Company. When substantial amendments are made, Company will be informed to Company via the contact details given to GS1 Oman and such changes shall take effect sixty (60) days after the amendment has been communicated to Company, unless Company decides to terminate the License in accordance with section 8 above.</li>
						
						<li><b>	Entire Agreement.</b> This License, including all annexes, set forth the entire understanding between the parties hereto with respect to the subject matter herein, and supersedes all prior written agreements and understandings, inducements or conditions, express or implied, oral and written, except as contained herein.</li>
						
						<li><b>	No Partnership.</b> The parties acknowledge and agree that this License does not constitute any joint venture, partnership or contract of employment between them. Nothing in this License is to be constructed to imply a joint venture, agency, or partnership agreement between the parties.</li>
						
						<li><b>	No Waiver.</b> Neither the failure nor delay on the part of a party to exercise any right, remedy, power or privilege in whole or in part under this License shall operate as or be construed as a waiver thereof. No waiver shall be effective unless it is in writing and signed by the party asserted to grant such waiver.</li>
						
						<li><b>	Severability.</b> If any provision of this License is or becomes invalid, illegal or unenforceable, such provision shall be severed and the remainder of the provisions shall continue in full force and effect.</li>
						
						<li><b>	Applicable law and jurisdiction.</b> This License shall be governed by and construed in accordance with the laws of the Sultanate of Oman, without regard to principles of conflict of laws. In addition, Company consents and agrees to submit to the exclusive jurisdiction of any court located in Muscat, The Sultanate of Oman for any actions, suits or proceedings arising out of or relating to this License. Notwithstanding the aforementioned, Company accepts that GS1 Oman shall nevertheless be allowed to apply for injunctive remedies or relief (or other equivalent types of urgent legal remedy) in any jurisdiction.</li>
						
						<li><b>	Translations.</b> These Terms of Use are originally drafted in English and Arabic language.  In case of discrepancy between both languages, the English version shall prevail.</li>
					</ol>
					<b><center>ANNEX 1 TO GS1 COMPANY PREFIX LICENSE<br> UNIQUE DEVICE IDENTIFIER TERMS AND CONDITIONS</center></b>
					<p>This Annex 1 (Unique Device Identifier Terms and Conditions) to the GS1 Company Prefix License sets forth additional terms and conditions that apply to Company when using GS1 standards and identification keys on medical devices for Unique Device Identifier purposes.</p>
					
					<ol>
						
						<li>The Unique Device Identifier ("UDI") is used to identify a product that is classified as a medical device under the laws or regulations of the jurisdiction where the product is placed on the market ("Medical Device(s)"). It is Company's responsibility to assess and determine whether its product is classified as a Medical Device in the relevant jurisdiction and to comply with all UDI and other requirements.</li>
						
						<li>GS1 is accredited or authorized by certain governmental agencies and regulatory bodies ("Regulator(s)") as an issuer of the UDI, one of which is the U.S. Food and Drug Administration ("FDA"). Where permitted by Regulators, Company may use GS1 standards and identification keys ("GS1 Key(s)") for UDI purposes, provided such use is in accordance with the applicable jurisdiction's laws, regulations, and rules.</li>
						
						<li>Where GS1 is an accredited or authorized issuing agency of the UDI, GS1 is required to comply with certain regulatory obligations, which include submitting information (reports) on all companies within GS1's membership that are using GS1 Keys to identify Medical Devices for UDI purposes</li>
						
						<li>Where GS1 is an accredited or authorized issuing agency of the UDI, GS1 is required to comply with certain regulatory obligations, which include submitting information (reports) on all companies within GS1's membership that are using GS1 Keys to identify Medical Devices for UDI purposes Where Company uses GS1 Keys to identify a Medical Device for UDI purposes, including where Company uses GS1 Keys to comply with the U.S. FDA Rule, Company agrees to the following:</li>
						<ol type="a">
							
							<li>Upon GS1's written request, Company agrees to promptly complete, and provide to GS1, a GS1 declaration ("Declaration"), which requires information concerning Company, Company's use of its GS1 Company Prefix (GCP), and other requested information. Where the Declaration form has not been provided to Company by GS1, Company may request the Declaration form by contacting GS1's Customer Service at helpdesk@gs1oman.org. Company further agrees to inform GS1 of any subsequent changes or updates to Company's Declaration.</li>
							
							<li>Company must inform GS1 if a GS1 Key will be used to identify a Medical Device and in which country the related product will be placed on the market and any subsequent changes or updates thereof.</li>
							
							<li>Company is, and shall at all times remain, responsible for the information it provides to GS1 regarding the Medical Device and for compliance with any applicable laws and regulatory obligations and shall ensure any information provided to GS1 is accurate and up to date at all times.</li>
							
							<li>GS1 may monitor the correct implementation of the GS1 Keys for UDI use by Company.</li>
							
							<li>In the event GS1 identifies a Deficiency, GS1 may inform Company in writing (addressed to Company's contact on file) of such Deficiency, suggest a way to correct the Deficiency, and require Company to correct such Deficiency within 90 calendar days from the date of the notification ("Correction Period"). For purposes of this Annex 1, a "Deficiency" means any of the following: (i) a misconstruction of the identifier; (ii) a mismatch between the name of the company holding the license for the GS1 Key and the Company using the GS1 Key; or (iii) any other inaccurate, incomplete or outdated information.</li>
							
							<li>GS1 may monitor whether Company has corrected a Deficiency within the Correction Period. Failing such correction, upon eight (8) calendar days after expiry of the Correction Period, GS1 may contact Company again and seek to amicably resolve the Deficiency.</li>
							
							<li>If the Deficiency is not corrected within an additional period of ninety (90) days from the expiry of the Correction Period and where the Deficiency pertains to a repeated and/or deliberate misuse of the GS1 Keys related to the UDI, GS1 reserves the right to inform the Regulator and suspend, revoke, or otherwise modify Company's use of the GS1 Keys for UDI implementation in the relevant jurisdiction and in cooperation with the Regulator.</li>
							
							<li>Company acknowledges and agrees that GS1 is required, in the context of its regulatory obligations, to share certain information with the relevant Regulators, including without limitation, the fact that Company uses the GS1 Keys to identify Medical Devices placed on the market in the Regulator's country, the GS1 Key, the name of Company, as well as any identified and uncorrected Deficiencies. Company agrees not to hold GS1 liable, and GS1 hereby excludes and disclaims liability, for any damages, losses, costs, or expenses of whatever nature incurred or suffered by Company as a direct or indirect consequence of GS1 providing such information to the Regulator(s).</li>
						</ol>

						<li>GS1 may amend or supplement the terms of this Annex 1, including the Declaration form, from time to time, and such amendment shall generally be made available to Company via the contact details given to GS1 and such changes shall take effect sixty (60) days after the amendment has been communicated to Company.</li>
						<li>For more information concerning the use of GS1 Keys for UDI purposes, please consult https://www.gs1.org/industries/healthcare/udi</li>
					</ol>
					<b><center>ACTIVATE TERMS OF USE</center></b>
					(version 20 July 2020)
					<p>These Activate Terms of Use<b> ("Terms of Use") </b>are entered into by and between GS1 Oman and the entity which is identified as Company hereunder<b> ("Company"), </b>and which provides its acceptance of these Terms of Use by click- to-accept. These Terms of Use are effective as of the date on which they were first accepted by Company in accordance with the above.</p>
					
					<ol>
					
						<li><b>Definitions.</b> In these Terms of Use, capitalized terms shall have the following meaning:</li>
						
						<ol type="a">
							
							<li>	"Activate" is a web-hosted key issuance service provided by GS1 Oman and is accessible via the Website.</li>
							
							<li>"Affiliate" means, with respect to a particular person, any entity that directly or indirectly controls, is controlled by, or is under common control with such person.</li>
							
							<li>"Authorized Users" means any person or entity accessing or using Activate through Company's account.</li>
							
							<li>"Data Provider" means a brand owner, distributor, product importer, or other legal entity that (i) provides Data and/or (ii) has contractually designated and authorised a third party company (e.g., content provider) to create, manage, and provide such Data.</li>
							
							<li>"Data Provider Data" GS1 Identification Keys data expressed as data attributes (whether in the form of text, images or otherwise) owned by or licensed to Company and provided to GS1 Oman for publication in and distribution through the GS1 Registry Platform.</li>
							
							<li>"Data Recipient" means a party viewing and/or using the Data Provider Data, in or through the services and solutions made available via the GS1 Registry Platform, subject to the acceptance of applicable terms of use for such service or solution.</li>
							
							<li>"Data Source" means the party (GS1 Member Organization, data pool, etc) that has executed an agreement with GS1 Oman or an Affiliate of GS1 Oman pursuant to which such party provides Data Provider Data collected in another service or database operated by it to the Service from time to time.</li>
							
							<li>"Designee" means a party authorized by a Data Provider to create, maintain, manage and/or provide data (including, without limitation, a distributor or a content provider), it being understood that such party must be able to demonstrate its authority to provide and license Data Provider Data to GS1 Oman for the purpose of the GS1 Registry Platform and grant the license set out in Section 6 at all times and at GS1 Oman's first request.</li>
							
							<li>"GDSN" means the Global Data Synchronization Network, a network of interoperable data pools and the GS1 Global RegistryTM that enables data synchronization per the GS1 System standards.</li>
							
							<li>"GS1" means GS1 AISBL, an international not for profit association incorporated under Belgian law with registered office at Avenue Louise 326, 1050 Brussels, Belgium, (RPM Brussels: 419.640.608;</li>
							
							<li>"GS1 Oman" means a nonprofit organization, under Registration number 1360120, having its principal place of business at Markaz Al Tijari Street First-floor OCCI, Ruwi, Muscat in the Sultanate of Oman;</li>
							
							<li>"GS1 Member Organization" means a member organization of GS1 as such term is normally understood with respect to GS1 Oman.</li> 
							
							<li>"GS1 Registry Platform" means the registry platform, including all equipment, systems, software and processes necessary to operate it, operated by GS1 Oman or any of its Affiliates from time to time to provide the Service.</li>
							
							<li>"GS1 system" means the specifications, standards, and guidelines administered by GS1 Oman.</li>
							
							<li>"Party" means Company or GS1 Oman.</li>
							
							<li>"Policies" means the Privacy Policy and any policies adopted, implemented, and/or modified by GS1 from time to time, governing operational aspects of the Service and made available on the Website.</li>
							
							<li>"Personal Data" means Information or an opinion about an identified individual, or an individual who is reasonably identifiable: whether the information or opinion is true or not; and. whether the information or opinion is recorded in a material form or not.</li>
							
							<li>"Privacy Policy" means the "GS1 Oman Privacy Policy", as published on the Website and as amended from time to time.</li>
							
							<li>"Service" has the meaning given in Section 3 below.</li>
							
							<li>"trusted" means, in relation to Data Provider Data, if such data originates from, is authorized or validated by a Data Provider.
								
							<li>"Website" means https://www.gs1oman.org (or any successor website).</li>
						</ol>

						<li><b>General Provisions.</b> Company acknowledges that it has read and accepts these Terms of Use. If Company does not agree to all of the terms and conditions of these Terms of Use, it may not access or otherwise use Activate. GS1 Oman may amend these Terms of Use at any time in accordance with section 18 herein.</li>
						
						<li><b>Service.</b> For the purpose of these Terms of Use, the Service is comprised of:</li>
						
						<ol type ="a">
							<li>	Activate, which allows users to create and manage certain GS1 Identification Keys created on the basis of a GS1 Company Prefix ("GCP") licensed from GS1 Oman under the "GS1 Company Prefix License" (the "License"), and to generate, if relevant, corresponding barcode images; and</li>
							<li>GS1 Registry Platform, which is a registry platform of GS1 Identification Keys, including the rules about data associated with the GS1 Identification Keys (via the Global Data Dictionary) which is built on an infrastructure that supports API interfaces, analytics and security. The GS1 Registry Platform is a registry through which GS1 and the GS1 Member Organizations provide various global services and business solutions which enable Data Providers (directly or via a Designee) to store and share trusted data with Data Recipients and enables Data Recipients to query and/or use such trusted data.</li>
						</ol>

						<li><b>Access.</b> Company's right to access Activate is contingent upon its License with GS1 Oman being current. If, at any time,</li>
						<p>Company ceases to be in good standing under the License (i.e., it fails to meet all its obligations under the License), its right to access Activate will be suspended and terminated as set forth in section 16 herein and further access will be denied. Company shall be responsible and liable for all access to and use of Activate and the Website by Authorized Users or otherwise through Company's account and for the Authorized Users' compliance with these Terms of Use. Upon registration, Company will receive login details for use by Authorized Users only. Company shall maintain the confidentiality of such login details and notify GS1 Oman immediately of any unauthorized use or threatened use thereof.</p>
						<li><b>Permitted Use.</b> Company may access Activate for internal business or educational purposes only. Any other use of Activate is strictly prohibited. GS1 Oman may, for quality assurance and/or analytics purposes, monitor Company's use of Activate.</li>
						<li><b>License Grant.</b> Company is a Data Provider or a Designee and wishes to share Data Provider Data via the Service.</li><p>Subject to these Terms of Use:</p>
						
						<ol type="a">
							<li>Company hereby grants to GS1 Oman, and GS1 hereby accepts such grant, a non-exclusive, world-wide, non¬transferable (except as expressly set out herein), royalty-free right and license (including the right to sub¬license to Data Recipients) to use the Data Provider Data for any purpose related to the Service. Company understands that and agrees to its Data Provider Data will be shared by GS1 Oman with Data Recipients through both local and global GS1 services and solutions made available via the GS1 Registry Platform, and</li>
							<li>GS1 Oman hereby grants to Company (acting through its Authorized Users), and Company hereby accepts such grant, a right of access to Activate for its own business purposes (including administration of its Authorized Users).</li>
						</ol>
						
						<li><b>Company Obligations.</b></li>
						
						<ol type="a">
							<li>Company covenants, represents and warrants that it shall not upload to Activate, and consequently make available via the Service, any Data Provider Data, which:</li>
							<ol type="i">
								<li>is not trusted;</li>
								<li>	violates any privacy rights, copyrights, trademarks, patents, or other intellectual property rights of any third party or violates any applicable laws or regulations;</li>
								<li>	does not comply with the GS1 system or violates applicable Policies;</li>
								<li>	contains or introduces a virus, Trojans, worm, logic bomb or any other materials which are malicious or technologically harmful; or</li>
								<li>	restricts, inhibits or interferes with any other party's use of Activate or the GS1 Registry Platform.</li>
							</ol>
							<li>Company shall not decompile, reverse-engineer, alter, or in any way tamper with all or part of the Service or any internet site or any software comprised therein, nor cause, permit or assist any other person directly or indirectly to do any of the above.</li>
							<li>Company shall be responsible and liable for all access to and use of Activate, the Website and the Service by Authorized Users or otherwise through Company's account.</li>
						</ol>

						<li><b>Quality of Data Provider Data. Company understands that:</b></li>
						
						<ol type="a">
							<li>it shall be responsible for the quality and accuracy of its Data Provider Data; and</li>
							<li>its Data Provider Data will be validated against and shall comply with the data validation rules set out in the GS1 General Specifications (available via https://www.gs1.org/standards/barcodes-epcrfid-id-keys/gs1-general-specifications ), the Global Data Dictionary and any other technical specifications that may be implemented and/or as amended from time to time; and</li>
							<li>if GS1 Oman, in its sole discretion, suspects or believes that the Data Provider Data is submitted or published to Activate, and consequently, the GS1 Registry Platform in violation of these Terms of Use (e.g. it violates a third party's intellectual property rights), GS1 Oman may take appropriate remedial action (including, without limitation), by temporarily suspending the availability of or definitively removing the said Data Provider Data from the GS1 Registry Platform and, consequently, any services and/or solutions related thereto.</li>
						</ol>
						
						<li><b>Representations & Warranties. </b>Company represents, warrants and covenants that:</li>
						
						<ol type="a">
							
							<li>its Data Provider Data originates from, is authorized and/or approved (e.g., validated) by Company;</li>
							
							<li>it shall not upload, post, transmit to, distribute or otherwise publish through Activate, the Website or the Service any communication, or any part thereof, which:</li>
							
							<ol type="i">
								
								<li>	restricts or inhibits any other user from using and enjoying Activate, the Website or the Service;</li>
								
								<li>	is unlawful, abusive, libelous, defamatory;</li>
								
								<li>	constitutes or encourages conduct that would constitute a criminal offense, give rise to civil liability or otherwise violate law;</li>
								
								<li>	violates, plagiarizes or infringes the rights of GS1 Oman or any other third party including, without limitation, copyright, trademark, patent, rights of privacy or publicity or any other proprietary right or violates any applicable laws or regulations;</li>
								
								<li>	does not comply with the GS1 system;</li>
								
								<li>	contains a virus, Trojans, worms, logic bombs or any other materials which are malicious or technologically harmful; or
								
								<li>constitutes or contains false or misleading statements of fact or indications of origin;</li>
							</ol>
							
							<li>with respect to these Terms of Use:</li>
							
							<ol type="i">
								
								<li>	these Terms of Use represent a valid and legally binding obligation on it and is enforceable against Company (including its Authorized Users) in accordance with the terms hereof;</li>
								
								<li>it  has full power and authority to grant the license as referred to in section 6 and to perform its obligations herein; and</li>
								
								<li>the use of Data Provider Data by GS1 Oman and/or Data Recipients (for the latter, in compliance with the applicable service or solution terms of use) shall not infringe any copyrights, trademarks, patents, database rights or other intellectual property rights of any third party nor violate any applicable laws or regulations.</li>
							</ol>
						</ol>
							
						<li><b>DISCLAIMER OF WARRANTIES</b>ACTIVATE AND THE GS1 REGISTRY PLATFORM, INCLUDING ALL CONTENT, SOFTWARE, FUNCTIONS, MATERIALS AND INFORMATION MADE AVAILABLE THEREON OR ACCESSIBLE THERE THROUGH, IS PROVIDED "AS IS". TO THE FULLEST EXTENT PERMISSIBLE BY LAW, GS1 OMAN MAKES NO REPRESENTATION OR WARRANTIES OF ANY KIND WHATSOEVER FOR OR RELATING TO ACTIVATE AS WELL ANY OF THE MATERIALS, OR RELATING TO ANY LINKS TO OTHER SITES OR FOR ANY BREACH OF SECURITY ASSOCIATED WITH THE TRANSMISSION OF SENSITIVE INFORMATION TO OR THROUGH ACTIVATE AND/OR THE WEBSITE OR ANY LINKED SITE. FURTHERMORE, GS1 OMAN DISCLAIMS ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, WITHOUT LIMITATION, NON-INFRINGEMENT, MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. GS1 OMAN DOES NOT WARRANT THAT THE WEBSITE OR THE OPERATION THEREOF WILL BE UNINTERRUPTED, OR THAT THE MATERIALS WILL BE ERROR FREE, OR THAT DEFECTS WILL BE CORRECTED, OR THAT THE WEBSITE OR THE SERVER THAT MAKES IT AVAILABLE IS FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS.</li>
						
						<li><b>LIMITATION OF LIABILITY.</b>TO THE FULLEST EXTENT PERMITTED BY LAW, COMPANY AGREES THAT NEITHER GS1 OMAN NOR ANY OF ITS EMPLOYEES, OFFICERS, DIRECTORS, AGENTS OR REPRESENTATIVES NOR ANY GS1 MEMBER ORGANISATION(S) SHALL BE LIABLE FOR ANY DAMAGES FOR LOSS OF PROFITS, RESULTING FROM THE USE OR THE INABILITY TO USE ACTIVATE, THE WEBSITE OR THE SERVICE (WHETHER OR NOT ANY SUCH INABILITY TO USE THE WEBSITE ARISES FROM ANY ACTION OR NEGLIGENCE OF GS1 OMAN), OR FROM ANY ERRORS CONTAINED IN THE MATERIALS EXCHANGED OR OTHERWISE TRANSFERRED ON OR THROUGH ACTIVATE OR THE GS1 REGISTRY PLATFORM, OR FOR ANY TRANSACTION MADE ON THE WEBSITE, OR ARISING FROM ANY OTHER MATTER RELATING TO ACTIVATE OR THE WEBSITE. COMPANY SHALL BE LIABLE FOR THE DATA PROVIDER DATA IT SHARES TO THE SERVICE. TO THE FULLEST EXTENT PERMITTED BY LAW, NEITHER GS1 OMAN NOR ANY GS1 MEMBER ORGANISATION SHALL BE LIABLE TO COMPANY OR A THIRD PARTY FOR ANY HARM, EFFECTS OR DAMAGES WHATSOEVER, INCLUDING BUT NOT LIMITED TO ACTUAL, DIRECT, CONSEQUENTIAL, INDIRECT, INCIDENTAL OR PUNITIVE DAMAGES, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGES, ARISING OUT OF OR IN RELATION TO THE COMPANY'S OR THIRD PARTY'S USE OF COMPANY'S DATA PROVIDER DATA.</li>
						
						<li><b>Third Party Equipment and use of the World Wide Web</b>If GS1 Oman publishes a list of system requirements and/or compatible equipment for use in conjunction with Activate, such list neither constitutes an endorsement of such equipment, nor any warranty or representation that the equipment will function to Company's satisfaction. Because GS1 Oman has no control over equipment that is manufactured and/or distributed by third parties, Company's use of any such equipment is in its sole discretion and it is solely responsible for such use and GS1 Oman shall not be responsible for any defects, malfunctions or any other problems that may arise in its use of equipment. Activate may contain links to other World Wide Web Internet sites. Links to and from Activate and any other site(s) do not constitute an endorsement by GS1 nor GS1 Oman of such site(s), or of its owner or provider, or of any products or services offered for sale thereby or information contained thereon.</li>
						
						<li><b>Indemnification. </b>Company agrees to indemnify, defend and hold GS1 Oman, GS1 Member Organizations and all their respective officers, directors, agents, employees and affiliates (hereinafter referred to collectively as the <b>"Indemnified Parties")</b> harmless from and against any and all liability and costs incurred by the Indemnified Parties in connection with any claim arising out of any breach by Company of these Terms of Use or any of the foregoing representations, warranties and covenants, or in connection with any claim arising out of any transaction offered or made via Activate or the Service, including, without limitation, legal fees and costs. Furthermore, Company releases the Indemnified Parties from any claims, demands and/or damages, actual or consequential, of every kind and nature known or unknown, suspected and unsuspected, disclosed or undisclosed, arising out of or in any way related to any transaction instituted or made via Activate. Company shall cooperate as fully as reasonably required in the defense of any claim. GS1 Oman reserves the right to assume the exclusive defense and control of any matter subject to indemnification by Company.</li>
						
						<li><b>Intellectual Property. </b>All (intellectual property) rights, title and interest in and to the Website, Activate and the GS1 Registry Platform are owned by GS1 Oman or its licensors. Company shall not decompile, reverse-engineer, alter, or in any way tamper with all or part of the Service and/or the Website or any software comprised therein, nor cause, permit or assist any other person directly or indirectly to do any of the above. GS1 Oman may place certain materials on the Website relating to GS1 Oman and its business and/or relating to Activate (the "Materials"). All such Materials are also protected by copyright laws and international conventions and treaties, and are owned or controlled by GS1 Oman or by the party credited as the owner or provider thereof. Company agrees to honor any and all copyright notices and any other restrictions contained in the Materials. GS1 Oman may change, suspend or discontinue any aspect, feature or database of Activate at any time, without prior notice. GS1 Oman may also impose limits on certain services or features or restrict Company's access to any of the Materials without providing prior notice or incurring any liability.</li>
						
						<li><b>Data Protection.  </b>The Parties acknowledge and agree that for the purposes of the Agreement, each Party acts as a date protector in their own right and is responsible for compliance with all obligations and duties under applicable Data Protection Laws in the Sultanate of Oman in respect of any Personal Data which they may process in execution of the Agreement herein.</li>
						
						<li><b>Confidentiality </b>Company acknowledges that communications to and from the Website are not confidential. Company furthermore acknowledges that by submitting a communication to the Website, no confidential, fiduciary, contractually implied or other relationship is created between Company and GS1 Oman, other than as set forth in these Terms of Use.</li>
						
						<li><b>Suspension and Termination. </b></li>
						
						<li><b>Warranties of GS1.  </b>GS1 Oman covenants, represents and warrants that (i) these Terms of Use are enforceable against GS1 Oman in accordance with its terms and (ii) GS1 Oman shall not use the Data Provider Data for any purposes other than in connection with the Service.</li>
						
						<li><b>Amendments </b>Company acknowledges that GS1 Oman reserves the right to amend these Terms of Use from time to time, unilaterally and without prior notice and such amendment shall generally be made available only and/or via the contact details (e-mail) given to GS1 by the Company).When substantial amendments are made, Company will be informed via the contact details given to GS1 at least thirty (30) days prior to the effective date and shall become effective as against Company on the effective date thereof, unless Company terminates its participation in accordance with section 16.a)iii. The continued use of the Service by Company after the aforementioned period of thirty (30) days shall be deemed to constitute Company's consent to the amended Terms of Use.</li>
						
						<li><b>Privacy. </b>GS1 Oman will handle any personal data (including any personal data of an Authorized User) in accordance with the Privacy Policy on the Website.</li>
						
						<li><b>Notices.  </b>All notices required to be given hereunder shall be in writing (email included) to the other Party's registered business address, principal place of business or address identified on its webpage or the (email) address identified when registering to use the Service or otherwise updated by the Authorized User from time to time.</li>
						
						<li><b>Severability.  </b>Failure by GS1 Oman to assert a right under these Terms of Use shall not be deemed as a waiver to exercise such right. No waiver of any right set forth herein shall be deemed effective unless given in writing and signed by the GS1 Oman.</li>
						
						<li><b>No Waiver.   </b>Failure by GS1 Oman to assert a right under these Terms of Use shall not be deemed as a waiver to exercise such right. No waiver of any right set forth herein shall be deemed effective unless given in writing and signed by the GS1 Oman.</li>
						
						<li><b>Assignment.   </b>Company shall not assign its rights or obligations under these Terms of Use in whole or in part without the prior written consent of GS1 Oman. GS1 Oman may assign its rights or obligations under these Terms of Use to an Affiliate without Company's consent. GS1 Oman shall provide written notice to Company of any such assignment.</li>
						
						<li><b>Law.  </b>These Terms of Use shall be governed by and construed in accordance with the laws of The Sultanate of Oman, without regard to principles of conflict of laws. In addition, each of the Parties consents and agrees to submit itself to the exclusive jurisdiction of any court located in The Sultanate of Oman, for any actions, suits or proceedings arising out of or relating to these Terms of Use. Notwithstanding the above, Company agrees that GS1 Oman shall nevertheless be allowed to apply for injunctive remedies or relief (or other equivalent types of urgent legal remedy) in any jurisdiction.</li>
						
						<li><b>Translations.  </b>These Terms of Use are originally drafted in English. Any translation is made available as a courtesy only and, in case of discrepancy between the original English version and the translation, the English version shall prevail.</li>
					</ol>
				</div>

				<div class="modal-footer">
					<button type="button" id="agree" class="btn btn-success" data-bs-dismiss="modal">Agreed</button>
					<button type="button" id="dontagree" class="btn btn-danger" data-bs-dismiss="modal" style="color: #ffffff;background-color: #f34006;border-color: #f34006;">Don't Agreed</button>
				</div>

			</div>
		</div>
	</div>

	<div class="modal" id="privacy">
	  	<div class="modal-dialog" style="max-width:1100px;">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Privacy Policy</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<!-- Modal body -->
				<div class="modal-body" style="font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 0;">
					<div style="width: 90%; margin: auto; overflow: hidden;">
						<h1 style="color: #333;"></h1>
						<p>This Privacy Policy sets out how and why GS1 Oman Office ("GS1 Oman") collects, stores, and processes your personal data when you use its websites and services - as well as your rights with respect to your personal data.</p>

						<h4 style="color: #333;">PRIVACY NOTICE</h4>
						<p>We are GS1 Oman. We're an organization registered in the Sultanate of Oman with company number 1360120, whose registered address is at [Markaz Al Tijari Street, Muscat First-floor OCCI. 112 Ruwi]. In this privacy notice we will refer to ourselves as 'we', 'us' or 'our'.</p>
						<p>You can get hold of us in any of the following ways:</p>
						<ol type="I" style="margin-left:20px;">

							<li>By phoning us on +968 72226166</li>
							<li>By e-mailing us at <a href="mailto:info@gs1oman.org" style="color: #007BFF;">info@gs1oman.org</a></li>
							<li>By writing to us at Markaz Al Tijari Street, Muscat - First-floor OCCI.112 Ruwi</li>
						</ol>
						<p>We take the privacy, including the security, of personal information we hold about you seriously. This privacy notice is designed to inform you about how we collect personal information about you and how we use that personal information. You should read this privacy notice carefully so that you know and can understand why and how we use the personal information we collect and hold about you.</p>
						<p>We may issue you with other privacy policies from time to time, including when we collect personal information from you. This privacy notice is intended to supplement these and does not override them.</p>

						<h5 style="color: #333;"><u>THE CONTROLLER</u></h5>
						<p>The Controller that is responsible for collecting and processing your personal data when you use the Websites is:</p>
						<p>
							GS1 Oman Office<br>
							Commercial Registry number 1360120<br>
							Address: Muscat- Oman<br>
							Email: <a href="mailto:info@gs1oman.org" style="color: #007BFF;">info@gs1oman.org</a><br>
							Website: <a href="http://www.gs1oman.org" style="color: #007BFF;">www.gs1oman.org</a>
						</p>

						<h4 style="color: #333;">1. Key Definitions</h4>
						<ul style="margin-left: 20px;">
							<li><strong>"Controller"</strong> means GS1 Oman, also referred to as "we", "us", and "our".</li>
							<li><strong>"Processor"</strong> means a natural or legal person that processes personal data on behalf of or pursuant to GS1 Oman's instructions.</li>
							<li><strong>"Processing"</strong> refers to the ways your personal data is (among other things) collected, stored, used, disclosed, and erased.</li>
							<li><strong>"Personal Data"</strong> means any information relating to an identified or identifiable natural person ("Data Subject"). Examples of such personal data include your name, email address, photograph, professional title, business phone number, and any other personal information you provide to us that is capable of identifying you.</li>
							<li><strong>"Services"</strong> includes GS1 services such as the GS1 MO Zone, GS1 Cloud, GS1 Activate, GS1 Learning Zone, GS1 Xchange, GEPIR Premium, and other GS1 services that are created and made available from time to time.</li>
							<li><strong>"Website(s)"</strong> include (gs1oman.org), for services, as well as the GS1 events webpages as created from time to time.</li>
						</ul>

						<h4 style="color: #333;">2. Collecting Personal Data</h4>
						<p>The GS1 Websites, including the services available on them, collect personal data that enables us to provide secure Website access and our services to you. When you interact with the Websites (i.e. to register your details and/or login), your personal data is collected for registration and security purposes. Personal data is collected as input by you and from third party processing services that collect personal data via our Websites (such as event registrations).</p>
						<p>Personal Data is only collected when necessary to provide secure Website access and/or services to you, and is limited to the relevant types of personal data actually required.</p>

						<h4 style="color: #333;">3. Purposes of Processing & Legal Basis</h4>
						<h4 style="color: #333;">Website Use</h4>
						<p>The personal data GS1 Oman collects via its Websites allow us to provide secure access to our Websites and to respond to your questions.</p>
						<p>This type of processing is done with your consent, which you may give when submitting your details via the electronic contact form, and otherwise for GS1 Oman's legitimate interest of improving the Websites, our services and responding to your queries.</p>

						<h4 style="color: #333;">Registration</h4>
						<p>Our Websites, and the services they provide, may require users to register their personal data (for example name, email address, and password) and user consent is requested at the time of registration.</p>
						<p >This type of processing is done on the legal basis of your consent and otherwise, where consent is not legally required, for GS1 Oman's legitimate interest of ensuring the security of our services and the people that access and use them. Where a user has entered into a contract with GS1 Oman (for example that relates to a service), then it may be necessary for us to process personal data in order to fulfil our obligations to perform the contract.</p>

						<h4 style="color: #333;">Marketing & Organizational Communication</h4>
						<p>Personal data may be processed for the purpose of sending email communications about GS1 Oman news and events. Personal data is also processed as our services reasonably require, to communicate updates, troubleshoot issues with the service, and to respond to and resolve user queries about the service. Regarding organizational communications, these are processed on the basis of personal data provided by users of the MO Zone website (<a href="http://mozone.gs1.org" style="color: #007BFF;">http://mozone.gs1.org</a>).</p>
						<p>Processing personal data for marketing and organizational communication purposes is done on the legal basis of user consent and otherwise, for GS1 Oman's legitimate interests of marketing its news and events to interested members and users. Processing personal data to communicate with users about services they use is done pursuant to GS1 Oman's legitimate interest of providing ongoing services and related service support to its users.</p>

						<h4 style="color: #333;">Services</h4>
						<p>Personal data is processed to operationally provide our services to users and ensure that the services are protected, to the extent possible, from unauthorized access and use. Such processing also includes to: process business transactions; establish and maintain customer accounts; communicate with you about updates, maintenance, outages or other technical matters relating to the services; provide training; notify you about changes to our policies and procedures; verify the accuracy of account and technical contact information; and respond to user inquiries.</p>
						<p>The legal basis for such processing is GS1 Oman's legitimate interest of providing and maintaining the services, and ensuring security of these systems.</p>

						<h4 style="color: #333;">Social Media Integration & Plugins</h4>
						<p>GS1 Oman integrates content from its social media platforms to its Websites. These social media platforms can, if buttons are included on our Websites, automatically download information technology content. The pages viewed by a user can then automatically send data to these social media platforms. Through this technical process, the social media platform may receive personally identifiable information, such as an IP address and browsing habits, to optimize user-directed advertising. This information is stored by the social media platforms in the United States of America and may be shared with third parties where appropriate. If the user is logged in to a social media platform and interacts with social media plugins integrated into our Websites, information may be published to a user's social media account. In such case, the respective social media platform may assign the visit to the Website of a user account. Social media plugins provide user benefits through sharing content of interest via social media. Social media plugins are used to optimize and market our services, which is a legitimate interest of GS1 Oman.</p>
						<p>The legal basis for this processing is your consent where you are logged into a social media platform, otherwise our legitimate interest of marketing GS1 Oman.</p>

						<h4 style="color: #333;">Legal Compliance</h4>
						<p>GS1 Oman must comply with its legal obligations (for example as directed by regulatory authorities or under a Court order) and in such circumstances, it may be necessary for us to process personal data for these reasons.</p>

						<h4 style="color: #333;">Cookies</h4>
						<p>Cookies are small files stored on your computer when you access our Website. They have various functions including: allowing you to navigate smoothly between pages on the Website, remembering your preferences and improving the overall experience of the Website.</p>
						<p>GS1 Oman uses the following cookies on this Website:</p>
						<ul style="margin-left: 20px;">
							<li>Persistent cookies: These allow us to improve how the website collects information, enhancing your experience of the site over time;</li>
							<li>Session cookies: This store information about your current browsing session, helping you to navigate between pages.</li>
						</ul>
						<p>You can enable or disable cookies by modifying the settings in your browser. You can find out how to do this and obtain more information on cookies at: <a href="http://www.allaboutcookies.org" style="color: #007BFF;">www.allaboutcookies.org</a>.</p>

						<h4 style="color: #333;">4. Data Storage</h4>
						<p>GS1 Oman will store and process your personal data for the purposes stated in this Privacy Policy. GS1 retains your personal data for the period of time necessary to achieve the purposes described in this Privacy Policy, subject to extension as permitted by law, and will delete your personal data after such time that it is no longer required.</p>

						<h4 style="color: #333;">5. Data Transfers & Recipients</h4>
						<h5 style="color: #333;">Disclosure to Third Parties</h5>
						<p>GS1 Oman may disclose your personal data, as necessary, to third party processors for the purpose of developing the Websites and services, and marketing and organizational communications on behalf of GS1 Oman. When personal data is shared with third party recipients for such purposes, it is shared subject in accordance with this Privacy Policy and as authorized and instructed by GS1 Oman.</p>
						<p>If required by law, GS1 Oman may disclose personal data upon request of a public authority and upon receipt of a Court order, or similar, to disclose personal data.</p>

						<h5 style="color: #333;">Cross-Border Transfers</h5>
						<p>In some cases, it may be necessary to transfer personal data to international businesses and/or organizations. In such instances, personal data will be transferred subject to necessary safeguards between GS1 Oman and the international processor.</p>

						<h4 style="color: #333;">6. Protection of Personal Data</h4>
						<p>All information collected via the Websites and services are saved and stored in secure operating environments and is only accessible by authorized personnel. The Website is monitored regularly to ensure that it is secure and data is not being accessed or used improperly. The Website is protected by appropriate security measures to safeguard, prevent loss, unlawful use and unauthorized access to personal data to the maximum reasonable extent.</p>

						<h4 style="color: #333;">7. Your Rights</h4>
						<h5 style="color: #333;">Accessing your Personal Data</h5>
						<p>When you request access to your personal data, and such request is reasonable and proportionate, GS1 Oman will provide such service free of charge, however if your request requires disproportionate technical or administrative effort GS1 Oman may charge a fee.</p>
						<p>If you request access to your personal data, GS1 Oman may request verification of your identity to ensure to the fullest extent possible that personal data is not unlawfully disclosed <br>– failure to adequately validate your identity may result in GS1 Oman's refusal to allow access to requested personal data.</p>

						<h5 style="color: #333;">Data Accuracy</h5>
						<p>You are responsible for maintaining the accuracy of your personal data by contacting GS1 Oman to notify us of any changes to or errors in your personal data. You have the right to access your personal data stored by the Websites and services to update, amend and rectify your personal data record.</p>

						<h5 style="color: #333;">Erasure</h5>
						<p>You have the right to have your personal data erased, noting that without the retention of your personal data, access to the Websites and services may be limited.</p>

						<h5 style="color: #333;">Withdrawing Consent</h5>
						<p>You also have the right to withdraw your consent to your data being processed at any time, without affecting the lawful processing of your personal data before such withdrawal.</p>

						<h4 style="color: #333;">Objection</h4>
						<p>You have the right to object, in whole or in part, to your personal data being collected and processed pursuant to GS1 Oman's legitimate interests. In such case, we will no longer process personal data - except where the compelling legitimate grounds to continue the processing override the interests, rights and freedoms of the user, or to establish, exercise or defend legal claims.</p>
						<p>If you want to exercise any of the above rights in relation to your personal information, please contact us using the details set out at the beginning of this notice. If you do make a request, then please note:</p>
						<ul style="margin-left: 20px;">
							<li>we may need certain information from you so that we can verify your identity;</li>
							<li>we do not charge a fee for exercising your rights unless your request is unfounded or excessive; and</li>
							<li>if your request is unfounded or excessive then we may refuse to deal with your request.</li>
						</ul>

						<h4 style="color: #333;">Restricted Processing</h4>
						<p>Users have the right to restrict processing of their personal data if (i) accuracy of the personal data is contested for the period of time in which GS1 Oman can verify the accuracy of the personal data, (ii) processing is unlawful and the data subject opposes erasure of the personal data and requests restricted processing instead, (iii) GS1 Oman no longer needs the personal data for the purpose of processing but is required by the data subject to establish, exercise or defend legal claims, and (iv) the user objects to processing pending verification whether GS1 Oman's legitimate grounds prevail over those of the user. Where processing has been restricted under the above bases, such personal data (save for storage) will only be processed with a user's consent or to establish, exercise or defend legal claims or to protect the rights or interests of another individual in the public interest.</p>

						<h4 style="color: #333;">Personal Data Portability</h4>
						<p>Users have the right to request and receive their personal data in a structured way as well as the right to have their personal data transmitted to another processor, where technically feasible and not adversely affecting the rights and freedoms of others.</p>

						<h4 style="color: #333;">8. Complaints</h4>
						<p>Complaint about the way GS1 Oman handles or processes your personal data, you may lodge a complaint with the relevant supervisory authority, which for GS1 Oman is the Compliance and Data Protection Department of the Ministry of Transport and Communications. At first instance, we recommend that you direct any concerns or complaints to <a href="mailto:info@gs1oman.org" style="color: #007BFF;">info@gs1oman.org</a>.</p>

						<h4 style="color: #333;">9. Changes to this Privacy Policy</h4>
						<p>This Privacy Policy may change from time to time when reviewed and in compliance with applicable laws and regulations. Your rights under this Privacy Policy will not be reduced without your explicit consent. Where changes are significant, you will be notified by email and/or by notice via the Website.</p>
						<p>If you would like further information about this Privacy Policy or your privacy rights in relation to the Website, please contact <a href="mailto:info@gs1oman.org" style="color: #007BFF;">info@gs1oman.org</a>.</p>

						<p>Thank you for your trust in GS1 Oman.</p>
					</div>
				</div>

			</div>
	  	</div>
	</div>

	<?php include('footer.php'); ?>
		
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<!-- Loader Overlay -->
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
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
					alert("Once submitted, the Application Fee is non-refundable. Refunds shall not be given after 24 hours of submitting an application form for any reason whatsoever (including but not limited to applications submitted in error). As an administration fee, all applications may be taken as having been received and processed within 24 hours of submission. A request to cancel an application or refund of the Application Fee, must be received by GS1 Oman within 24 hours of the application form being submitted, via helpdesk@gs1oman.org. After such time, no refund shall be given.\nI have understood my company will be charged annual fee(s) according to the licence(s) my company applied for.");
				}
			});
		});
		
		function validateRegistrationDate() {
			var registrationDate = new Date(document.getElementsByName("cr_registration_date")[0].value);
			var currentDate = new Date();
			if (registrationDate > currentDate) {
				alert("CR Registration Date cannot be a future date.");
				document.getElementsByName("cr_registration_date")[0].value = "";
			}
		}

		function validateExpiryDate() {
			var expiryDate = new Date(document.getElementsByName("cr_expiry_date")[0].value);
			var currentDate = new Date();
			if (expiryDate < currentDate) {
				alert("CR Expiry Date cannot be a past date.");
				document.getElementsByName("cr_expiry_date")[0].value = "";
			}
		}



		$(document).ready(function() {
		  	$('input[name="offline_payment"]').change(function() {
		    	if ($(this).val() == '1') {
		    		$('#offline_payment_instructions').show();
		    		$('#offline_payment_error').html('');
		    	} else {
		    		$('#offline_payment_instructions').hide();
		    	}
		    });
		  
			  //  $('#regform').submit(function(event) {
			  //   if ($('input[name="offline_payment"]:checked').length === 0) {
			  //     $('#offline_payment_error').html('Please select a payment method.');
			  //     event.preventDefault();
			  //   }
			  // }); 

		});

			//  $(document).ready(function() {
			//   $('#regform').submit(function(event) {
			//     if ($('input[name="healthcare_status"]:checked').length === 0) {
			//       $('#healthcare_status_error').html('Please select an option.');
			//       event.preventDefault();
			//     } else {
			//       $('#healthcare_status_error').html('');
			//     }
			//   });
			// }); 

		// Add custom alphanumeric method
		jQuery.validator.addMethod("alphanumeric", function(value, element) {
		    return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
		}, "Please enter only letters and numbers.");

		$(document).ready(function() {
			// Custom validation methods
			$.validator.addMethod("poboxFormat", function(value, element) {
				return this.optional(element) || /^[0-9]{3,5}$/.test(value);
			}, "Please enter a valid PO Box number (3-5 digits)");

			$.validator.addMethod("postalCodeFormat", function(value, element) {
				return this.optional(element) || /^[0-9]{3}$/.test(value);
			}, "Please enter a valid postal code (3 digits)");

			$.validator.addMethod("crNumberFormat", function(value, element) {
				return this.optional(element) || /^[0-9]{12}$/.test(value);
			}, "Please enter a valid 12-digit CR number");

			$.validator.addMethod("taxRegFormat", function(value, element) {
				return this.optional(element) || /^[0-9]{12}$/.test(value);
			}, "Please enter a valid 12-digit tax registration number");

			$.validator.addMethod("vatFormat", function(value, element) {
				return this.optional(element) || /^[A-Za-z0-9]{15}$/.test(value);
			}, "Please enter a valid 15-character VAT number");

			$.validator.addMethod("employeeCountFormat", function(value, element) {
				return this.optional(element) || /^[0-9]{1,7}$/.test(value);
			}, "Please enter a valid number of employees (up to 7 digits)");

			// Form validation rules
			$("form").validate({
				rules: {
					pobox: {
						required: true,
						poboxFormat: true
					},
					zipcode: {
						required: true,
						postalCodeFormat: true
					},
					cr_number: {
						required: true,
						crNumberFormat: true
					},
					cr_tax_registration_number: {
						taxRegFormat: true
					},
					vat_number: {
						vatFormat: true
					},
					number_of_employee: {
						employeeCountFormat: true
					},
					"job_title[]": {
						required: true,
						pattern: /^[A-Za-z\s]+$/
					}
				},
				messages: {
					pobox: {
						required: "PO Box is required",
						poboxFormat: "Please enter a valid PO Box number (3-5 digits)"
					},
					zipcode: {
						required: "Postal code is required",
						postalCodeFormat: "Please enter a valid postal code (3 digits)"
					},
					cr_number: {
						required: "CR number is required",
						crNumberFormat: "Please enter a valid 12-digit CR number"
					},
					cr_tax_registration_number: {
						taxRegFormat: "Please enter a valid 12-digit tax registration number"
					},
					vat_number: {
						vatFormat: "Please enter a valid 15-character VAT number"
					},
					number_of_employee: {
						employeeCountFormat: "Please enter a valid number of employees (up to 7 digits)"
					},
					"job_title[]": {
						required: "Job title is required",
						pattern: "Please enter only letters and spaces"
					}
				},
				errorPlacement: function(error, element) {
					error.appendTo(element.next("span"));
				},
				highlight: function(element) {
					$(element).addClass("error");
				},
				unhighlight: function(element) {
					$(element).removeClass("error");
				}
			});
		});

		$(document).ready(function() {
			// Form submission handler
			$('#regform').on('submit', function(e) {
				e.preventDefault();
				console.log('Form submission started');
				
				// Validate required fields
				if (!$(this).valid()) {
					console.log('Form validation failed');
					return false;
				}
				
				// Add submit value to form data
				var formData = new FormData(this);
				formData.append('submit', '1');
				
				// Log form data
				for (var pair of formData.entries()) {
					console.log(pair[0] + ': ' + pair[1]);
				}
				
				// Show loading indicator
				$('#loadingIndicator').show();
				$('#successMessage, #errorMessage').hide();
				
				$.ajax({
					url: window.location.href,
					type: 'POST',
					data: formData,
					processData: false,
					contentType: false,
					success: function(response) {
						console.log('Server response received:', response);
						$('#loadingIndicator').hide();
						
						try {
							if (typeof response === 'string') {
								console.log('Parsing string response:', response);
								response = JSON.parse(response);
							}
							
							if (response.success) {
								console.log('Success response:', response);
								$('#successMessage').html(response.message).show();
								console.log('Will redirect to:', response.redirect);
								setTimeout(function() {
									window.location.href = response.redirect;
								}, 2000);
							} else {
								console.log('Error response:', response);
								$('#errorMessage').html(response.message || 'An error occurred').show();
							}
						} catch (e) {
							console.error('Error parsing response:', e);
							$('#errorMessage').html('An unexpected error occurred').show();
						}
					},
					error: function(xhr, status, error) {
						console.error('AJAX error:', {xhr: xhr, status: status, error: error});
						$('#loadingIndicator').hide();
						$('#errorMessage').html('An error occurred. Please try again.').show();
					}
				});
			});
		});
</script>
		


