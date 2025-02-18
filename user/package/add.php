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


	// At the start of the file, after session checks
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	if(isset($_POST['submit'])) {
		// Log the entire POST data
		error_log("Form submitted. POST data: " . print_r($_POST, true));
		
		// Package Start
		$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
		$product_name = isset($_POST['product_name']) ? $_POST['product_name'] : null;
		$gtins_annual_fee = isset($_POST['gtins_annual_fee']) ? floatval($_POST['gtins_annual_fee']) : 0;
		$gln_price = isset($_POST['gln_price']) ? floatval($_POST['gln_price']) : 0;
		$sscc_price = isset($_POST['sscc_price']) ? floatval($_POST['sscc_price']) : 0;
		
		// Log captured values
		error_log("Captured values:");
		error_log("Product ID: " . $product_id);
		error_log("GTINS Annual Fee: " . $gtins_annual_fee);
		error_log("GLN Price: " . $gln_price);
		error_log("SSCC Price: " . $sscc_price);

		// Validate user session and get user data
		if(!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])) {
			error_log("User session not found");
			header('location:../login.php');
			exit;
		}

		// Get user details
		$user_sql = "SELECT * FROM company_tbl WHERE user_email = '" . mysqli_real_escape_string($conn, $_SESSION['user_email']) . "'";
		$res = mysqli_query($conn, $user_sql);
		
		if(!$res) {
			error_log("Database error in user query: " . mysqli_error($conn));
			die("Database error occurred");
		}
		
		$fetch_row = mysqli_fetch_array($res);
		if(!$fetch_row) {
			error_log("User not found in database");
			die("User not found");
		}

		$user_email = $fetch_row['user_email'];
		$user_id = $fetch_row['id'];
		
		// Generate order details
		$order_id = 'Barcode' . (rand(1,10000));
		$order_date = date('Y-m-d');
		
		// Prepare SQL with proper escaping
		$sql2 = sprintf(
			"INSERT INTO `order_tbl` (
				company_id, order_id, product_id, user_email,
				registration_fee, gtins_annual_fee, gln_price, sscc_price,
				annual_subscription_fee, annual_total_price, order_date,
				offline_payment, status
			) VALUES (
				'%s', '%s', '%s', '%s',
				0, %.2f, %.2f, %.2f,
				%.2f, %.2f, '%s',
				'%s', '0'
			)",
			mysqli_real_escape_string($conn, $user_id),
			mysqli_real_escape_string($conn, $order_id),
			mysqli_real_escape_string($conn, $product_id),
			mysqli_real_escape_string($conn, $user_email),
			$gtins_annual_fee,
			$gln_price,
			$sscc_price,
			($gtins_annual_fee + $gln_price + $sscc_price),
			($gtins_annual_fee + $gln_price + $sscc_price),
			mysqli_real_escape_string($conn, $order_date),
			mysqli_real_escape_string($conn, $_POST['offline_payment'])
		);
		
		error_log("SQL Query: " . $sql2);
		
		$result = mysqli_query($conn, $sql2);
		if(!$result) {
			error_log("Database Error: " . mysqli_error($conn));
			die("Failed to insert order: " . mysqli_error($conn));
		} else {
			error_log("Order inserted successfully. Order ID: " . $order_id);
			echo "<script>window.location='payment.php?_token=" . base64_encode($order_id) . "';</script>";
			$_SESSION['message'] = "New Event Added Successfully";
		}
	}

	

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
<td></td>
            <td class="fw-bold">Product / Services</td>
<td class="fw-bold">Annual Renewal</td>
</tr>
<tr>
            <td>
                <input type="checkbox" name="gtins_annual_fee_checkbox" id="gtins_annual_fee" class="product-checkbox" value="<?=$productData['gtins_annual_fee']?>" data-target="gtins_annual_fee_input">
                <input type="hidden" name="gtins_annual_fee" id="gtins_annual_fee_input" value="0">
            </td>
            <td>
                GTIN: Global Trade Item Numbers ? 
                <span class="text-danger" data-toggle="tooltip" title="GTIN: Definition">!</span>
            </td>
            <td>
                <span id="gtins_annual_fee_display"><?=$productData['gtins_annual_fee']?></span>
            </td>
</tr>
<tr>
<td>
                <input type="checkbox" name="gln_price_checkbox" id="gln_price" class="product-checkbox" value="<?=$productData['gln_annual_fee']?>" data-target="gln_price_input">
                <input type="hidden" name="gln_price" id="gln_price_input" value="0">
            </td>
            <td>
                Do you require GLN? 
                <span class="text-danger" data-toggle="tooltip" title="GLN: Definition">!</span>
            </td>
            <td>
                <span id="gln_price_display"><?=$productData['gln_annual_fee']?></span>
            </td>
</tr>
        <?php if($productData['sscc_annual_fee'] > 0): ?>
        <tr>
            <td>
                <input type="checkbox" name="sscc_price_checkbox" id="sscc_price" class="product-checkbox" value="<?=$productData['sscc_annual_fee']?>" data-target="sscc_price_input">
                <input type="hidden" name="sscc_price" id="sscc_price_input" value="0">
            </td>
            <td>
                Do you require SSCC?
                <span class="text-danger" data-toggle="tooltip" title="SSCC: Definition">!</span>
            </td>
            <td>
                <span id="sscc_price_display"><?=$productData['sscc_annual_fee']?></span>
</td>
        </tr>
        <?php endif; ?>
</table>
                 </div>
                 
                  <div class="row fee_table mt-3">
            <div class="col-md-4">
        <label class="fw-bold">Registration Fee</label>
               <div class="input-group mb-3">
            <span class="input-group-text">OMR</span>
            <input type="text" id="registration_fee" name="registration_fee" class="form-control mb-0" value="0" readonly>
               </div>
        <span class="fw-bold text-danger">Valid till <?php echo date('d M Y', strtotime('last day of december')); ?></span>
            </div>

            <div class="col-md-4">
        <label class="fw-bold">Annual Subscription Fee</label>
               <div class="input-group mb-3">
            <span class="input-group-text">OMR</span>
            <input type="text" class="form-control mb-0" name="annual_total_price" id="annual_total_price" value="0" readonly>
                 <input type="hidden" name="annual_subscription_fee" id="annual_subscription_fee" value="0">
               </div>
        <span class="fw-bold text-danger">Next renewal <?php echo date('d M Y', strtotime('first day of january next year')); ?></span>
            </div>

            <div class="col-md-4">
        <label class="fw-bold">Total Fee</label>
               <div class="input-group mb-3">
            <span class="input-group-text">OMR</span>
            <input type="text" name="total_price" id="total_price" class="form-control mb-0" value="0" readonly>
               </div>
            </div>
         </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to update prices
    function updatePrices() {
        console.log('Updating prices...');
        
        let total = 0;
        let annual = 0;
        
        // Get all product checkboxes
        document.querySelectorAll('.product-checkbox').forEach(checkbox => {
            const value = parseFloat(checkbox.value) || 0;
            const targetInput = document.getElementById(checkbox.dataset.target);
            
            console.log('Processing checkbox:', {
                id: checkbox.id,
                checked: checkbox.checked,
                value: value
            });
            
            if (checkbox.checked) {
                total += value;
                annual += value;
                if (targetInput) targetInput.value = value;
            } else {
                if (targetInput) targetInput.value = 0;
            }
        });
        
        console.log('Calculated values:', {
            total: total,
            annual: annual
        });
        
        // Update display fields
        document.getElementById('total_price').value = total.toFixed(2);
        document.getElementById('annual_total_price').value = annual.toFixed(2);
        document.getElementById('annual_subscription_fee').value = annual.toFixed(2);
    }
    
    // Add event listeners to checkboxes
    document.querySelectorAll('.product-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updatePrices);
    });
    
    // Form validation
    document.querySelector('form[name="listForm"]').addEventListener('submit', function(e) {
        console.log('Form submission started');
        
        // Check if at least one product is selected
        const hasProduct = Array.from(document.querySelectorAll('.product-checkbox'))
            .some(checkbox => checkbox.checked);
            
        if (!hasProduct) {
            e.preventDefault();
            alert('Please select at least one product');
            return false;
        }
        
        // Verify payment method is selected
        const paymentMethod = document.querySelector('input[name="offline_payment"]:checked');
        if (!paymentMethod) {
            e.preventDefault();
            alert('Please select a payment method');
            return false;
        }
        
        console.log('Form validation passed');
        return true;
    });
});
</script>

            <div class="row d-none">
				<div class="col-md-12 text-center mt-3">
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
	

