<?php

error_reporting(0);
include("../include/function.php");
if($_SESSION['email']=="")
{
header('../location:login.php');
}
$view_id=$_GET['view_id'];
$id=$_GET['id'];


//Update Data ....wrap



$cumpany_sql=mysqli_query($conn,"SELECT * FROM order_tbl WHERE company_id='".$view_id."' AND id='".$id."'");
$company_row=mysqli_fetch_assoc($cumpany_sql);
$expirydate=$company_row['expiry_date'];//expiry date
$currdate=date('Y-m-d');//current date
// Convert dates to timestamps
$expirydate_timestamp = strtotime($expirydate);
$currdate_timestamp = strtotime($currdate);
@extract($company_row);

//// company Contact data /////
$product_sql=mysqli_query($conn,"SELECT * FROM product_tbl WHERE id='".$product_id."'");
$product_row=mysqli_fetch_assoc($product_sql);
$multiplerecord = "SELECT * FROM multiple_order WHERE order_id = '" . $id . "' ORDER BY id DESC";

 $mrecordqueryresult = mysqli_query($conn, $multiplerecord);
$mrecorddata=mysqli_fetch_assoc($mrecordqueryresult);


if (isset($_POST['submit'])) {
	
    $trans_number = $_POST['trans_number'];
	$renewal_date=$_POST['renewal_date'];
	
	
    // Handle payment receipt upload
    $base_url = 'barcode29/';
    $upload_directory = 'images/Upload/';
    $doc_name1 = $_FILES['payment_receipt']['name'];
    $doc_tmp_name1 = $_FILES['payment_receipt']['tmp_name'];
    $relname = $upload_directory . $doc_name1;
    $doc_path1 = $_SERVER['DOCUMENT_ROOT'] . '/' . $base_url . $upload_directory . $doc_name1;
	
   if (!empty($doc_name1)&& !empty($trans_number)) {
		
        if ($id) {
			
            // Retrieve trans_number, order_id, and company_id from order_tbl
            $sql_select = "SELECT id AS order_id, company_id FROM order_tbl WHERE id = $id";
            $query_select = mysqli_query($conn, $sql_select);
            // Check if a record exists
            if (mysqli_num_rows($query_select) > 0) {
                // Fetch the result
                $row = mysqli_fetch_assoc($query_select);
                //$trans_number = $row['trans_number'];
                $order_id = $row['order_id'];
                $company_id = $row['company_id'];
                // Move uploaded file
                move_uploaded_file($doc_tmp_name1, $doc_path1);
                // Insert new record for payment receipt
     $sql3 = "INSERT INTO multiple_order (trans_number, order_id, compay_id, receipt_img,renewal_date, created_at, updated_at) 
                         VALUES ('$trans_number', '$order_id', '$company_id', '$relname','$renewal_date', NOW(), NOW())";
		
						
                $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
            } else {
                echo 'No record exists';
            }
        } else {
            echo 'No record exist';
        }
  }
	
	$_SESSION['message'] = "Record Inserted Successfully";

    echo "<script>window.location.href='show.php?page=REV';</script>";
} 





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
<div class="col-xl-10 col-lg-10 col-md-10 col-sm-10">



<div class="form-group">
<label for="inputName" class="col-form-label">Product Name</label>
<input type="text" class="form-control"  name="name" value="<?=$product_row['product_name'];?>" readonly>
</div> 

<div class="form-group">
<label for="inputName" class="col-form-label">Gtins Name</label>
<input type="text" class="form-control"   value="<?=$product_row['gtins_name'];?>" readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Registration Fees</label>
<input type="text" class="form-control"   name="name_ar" value="<?=$product_row['registration_fee'];?>" readonly>
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Gln Annual Fee</label>
<?php
if($gln_price!=''){
echo'<input type="text" class="form-control"   name="pobox" value="'.$gln_price.'"readonly >';
}
else{
   echo'<input type="text" class="form-control"  value="Not Selected" readonly >';
}
?>
</div>



<div class="form-group">
<label for="inputName" class="col-form-label">Gtins Annual Fee</label>
<input type="text" class="form-control"  name="country"  value="<?=$product_row['gtins_annual_fee'];?>" readonly >
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">SSCC Annual Fee</label>
<?php
if($sscc_price!=''){
echo'<input type="text" class="form-control"    value="'.$sscc_price.'"readonly>';
}
else{
   echo'<input type="text" class="form-control"  value="Not Selected" readonly>';
}
?>
</div>

<div class="form-group">
<label for="inputName" class="col-form-label">Annual Subscription Fee</label>
<input type="text" class="form-control"    value="<?=$annual_subscription_fee;?>" readonly >
</div>
<div class="row">
<div class="form-group col-md-6">
<label for="trans_number" class="col-form-label">Transaction Number</label>
<?php if(isset($mrecorddata['trans_number']) && !empty($mrecorddata['trans_number'])){?>
	<input type="text" class="form-control" name="trans_number" value="<?php echo $mrecorddata['trans_number'];?>" disabled>
<?php }
else{?>
	<input type="text" class="form-control" name="trans_number"   value="<?php echo $trans_number;?>" disabled>
<?php }?>
</div>


    <div class="form-group col-md-6">
        <label for="payment_receipt">Upload Payment Receipts:</label>
		<?php if($mrecorddata['receipt_img']==''){ ?>
		<a href="/barcode29/<?php echo $company_row['payment_receipt'];?>">
                    <?php echo $company_row['payment_receipt'];?>
                </a>
            <?php } else { ?>
                <a href="/barcode29/<?php echo $mrecorddata['receipt_img'];?>">
                    <?php echo $mrecorddata['receipt_img'];?>
                </a> <?php }?>
		   
    </div>
	<div class="form-group col-md-6">
	 <label for="renewal_date">Renewal Date</label>
		<?php if($mrecorddata['renewal_date']==''){ ?>
			
			<input type="text" class="form-control" id="inputRenewalDate1" name="renewal_date" value="<?php echo $company_row['renewal_date'];?>" disabled>
		<?php }else{?>
		
			<input type="text" class="form-control" id="inputRenewalDate1" name="renewal_date" value="<?php echo $mrecorddata['renewal_date']; ?>" disabled>
		<?php } ?>
    </div>

<?php  if($expirydate_timestamp < $currdate_timestamp) {?>
<button type="button" class="btn btn-sm btn-primary mt-3" data-toggle="modal" data-target="#editReceiptModal" style="width:50px;height:30px">
    Edit
</button>
<?php } ?>
    
<!-- Edit Receipt Modal -->
<div class="modal fade" id="editReceiptModal" tabindex="-1" role="dialog" aria-labelledby="editReceiptModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editReceiptModalLabel">Edit Payment Receipt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
					<label for="payment_receipt">Upload Payment Receipt:</label>
					<?php if($mrecorddata['receipt_img']==''){ ?>
					<input type="file" class="form-control-file" id="payment_receipt" name="payment_receipt" value="<?php echo $company_row['payment_receipt']; ?>" Required>
					<?php }else{?>
					<input type="file" class="form-control-file" id="payment_receipt" name="payment_receipt" value="<?php echo $mrecorddata['receipt_img']; ?>"Required>
					<?php }?>
					
				</div>
				<div class="form-group">
					<label for="payment_receipt">Transaction Numbers:</label>
					<input type="text" class="form-control" id="" name="trans_number" value="<?php  if($mrecorddata['trans_number']==''){
					echo $company_row['trans_number'];
					} else{
						echo $mrecorddata['trans_number'];
					}?>" Required>
					
				</div>
				<div class="form-group col-md-6">
        <label for="inputRenewalDate" class="col-form-label">Renewal Date</label> 
        <input type="text" class="form-control" id="inputRenewalDate" name="renewal_date" value="<?php echo $mrecorddata['renewal_date'];?>" Required>
		
               <input type="submit" name="submit" value="Update" class="btn btn-primary mt-5">
           
    </div>

                </form>
            </div>
        </div>
    </div>
</div>


</div>
<?php
/* if ((!isset($company_row['payment_receipt']) || empty($company_row['payment_receipt'])) || (!isset($trans_number) || empty($trans_number))) {
    //echo '<input type="submit" name="submit" value="Submit" class="btn btn-primary">';
    echo ' <input type="submit" name="submit" value="Update" class="btn btn-primary mt-5">';
	
}
 else {
    echo '<input type="submit" name="submit" value="Submit" style="display:none">';
} */
 
// Assuming $id contains the specific order ID you want to display the history for
if ($id) {
    // Select payment receipt history based on the specific order ID
    $sql_select_history = "SELECT * FROM multiple_order WHERE order_id = $id";
    $query_select_history = mysqli_query($conn, $sql_select_history);

    // Check if any records exist
    if (mysqli_num_rows($query_select_history) > 0) {
        // Start displaying the history
        //echo "<h2>Payment Receipt History for Order ID $id</h2>";
        echo "<h2>Payment Receipt History </h2>";
        echo "<table border='1' style='border-collapse: collapse; width: 100%; border: 1px solid #ddd;'>";
        echo "<tr><th style='padding: 8px; text-align: left; background-color: #f2f2f2;'>Transaction ID</th><th style='padding: 8px; text-align: left; background-color: #f2f2f2;'>Date</th></tr>";

        // Loop through each record and display its information
        while ($row = mysqli_fetch_assoc($query_select_history)) {
            echo "<tr>";
            echo "<td style='padding: 8px; border: 1px solid #ddd;'>" . $row['trans_number'] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #ddd;'>" . $row['created_at'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        //echo "No payment receipt history available for Order ID $id.";
        echo "No payment receipt history available.";
    }
}
?>



</div>
</div>
</div>


</div>
<!--col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6-->










</div>
</div>

</form>
<!-- Content wrapper end -->
          
</div>
        
<!-- Footer start -->

<!-- Footer end -->
</div>
<!-- Required jQuery first, then Bootstrap Bundle JS -->
<?php include ("../include/main_js.php"); ?>
<?php include("../include/footer.php"); ?>
<!-- Ensure jQuery and Bootstrap are included before this -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
    $(document).ready(function(){
        $('#inputRenewalDate').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });
</script>

</body>
</html>