<?php

include("../include/function.php");

if($_SESSION['email']=="")

{

header('location:../login.php');

}

error_reporting(0);

$_SESSION['filter_status']=$_GET['stype'];

$_SESSION['filter_sdate1']=$_GET['sdate1'];

$_SESSION['filter_sdate2']=$_GET['sdate2'];

$_SESSION['filter_rfilter']=$_GET['rfilter'];

?>

<?php 

	
	include ("../include/config.php");
	//echo "test";
	
	
	$records="SELECT * from `company_tbl`";
		$result = mysqli_query($conn, $records);
		 $num = mysqli_num_rows($result);
		//echo $num;
		
	
		?>
<!DOCTYPE html>
<html>
<head>
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
	<!--<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> -->

	<!--<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>-->


	<script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">

	<!-- Bootstrap css -->
	<!-- Title -->

<title><?php title(); ?></title>



<?php include("../include/table_css.php"); ?>

</head>	
<body>
<?php include("../include/top_header.php"); ?>
<?php  include("../include/quick_link.php"); ?>
<?php include ("../include/quick_setting.php"); ?>

	<div class="container-fluid">
		<?php include("../include/menu_navbar.php"); ?>
		<div class="main-container">
			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Home</li>
					<li class="breadcrumb-item"><a href="#">Registration</a></li>
					<li class="breadcrumb-item active"></li>
				</ol>
				<ul class="app-actions">
					<li>
						<a href="#"><?php echo date("d/m/Y"); ?></a>
					</li>
					<li>
						<a href="#" onclick="history.go(-1);">Back</a>
					</li>
				</ul>
			</div>
			<div class="col-md-12" style="height:40px;"></div>
				<div class="content-wrapper">
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="table-container">
				<form method="post">
					<div class="row t-header">
						<div class="col-md-2">
							<div class="t-header">All Registration</div>
						</div>
					</div>
				</form>
				<?php echo $deleteMsg??''; ?>
    <div class="table-responsive">
      <table id="test" class="table   custom-table" >
       <thead class="text-white">
		<tr>
			<th>Serial No.</th>
			<th>Product id</th>
			 <th>Prefix Type</th>
			 <th>Registration</th>
			 <th>gtins annual fee</th>
			<th>gln price	</th>
			<th>sscc price	</th>
			<th>Annual Subscription Fee	</th>
			<th>Annual Total Price	</th>
			<th>Details	</th>
			<th>name	</th>
			<th>name ar</th>
			<th>pobox</th>
			<th>zipcode</th>
			<th>address</th>
			<th>address ar</th>
			<th>Country</th>
			<th>City</th>
			<th>Mobile number</th>
			<th>Phone_number</th>
			<th>Fax_number</th>
			<th>Website_address</th>
			<th>Cr number</th>
			<th>Cr legal type</th>
			<th>Cr registration date</th>
			<th>Cr expiry date</th>
			<th>Cr tax registration number</th>
			<th>user email</th>
			<th>password</th>
			<th>cpassword</th>
			<th>business type product category</th>
			<th>number of employee</th>
			<th>upload document 1<th></th>
			<th>upload document 2</th></th>
			<th>upload document 3</th>
			<th>Healthcare status</th>
			<th>Main contact status</th>
			<th>tnc</th>
			<th>Record date</th>
			<th>captcha code</th>
			<th>reset link token</th>
			<th>up month</th>
			<th>status</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if($num > 0){
					 $sn=1;
							while($row = mysqli_fetch_assoc($result)){?>
						 <tr>
						 <td><?php echo $sn; ?> </td>
							<td> <?php echo $row['product_id'] ;?></td>
							<td> <?php echo $row['product_name'] ;?></td>
							<td> <?php echo $row['registration_fee']? : '--';?></td>
							<td> <?php echo $row['gtins_annual_fee']? : '--';?></td>
							<td> <?php echo $row['gln_price']? : '--';?></td>
							<td> <?php echo $row['sscc_price']? : '--';?></td>
							<td> <?php echo $row['annual_subscription_fee']? : '--';?></td>
							<td> <?php echo $row['annual_total_price']? : '--';?></td>
							<td> <?php echo $row['details']? : '--';?></td>
							<td> <?php echo $row['name']? : '--';?></td>
							<td> <?php echo $row['name_ar']? : '--';?></td>
							<td> <?php echo $row['zipcode']? : '--';?></td>
							<td> <?php echo $row['address']? : '--';?></td>
							<td> <?php echo $row['pobox']? : '--';?></td>
							<td> <?php echo $row['address_ar']? : '--';?></td>
							<td> <?php echo $row['country']? : '--';?></td>
							<td> <?php echo $row['city']? : '--';?></td>
							<td> <?php echo $row['mobile_number']? : '--';?></td>
							<td> <?php echo $row['phone_number']? : '--';?></td>
							<td> <?php echo $row['fax_number']? : '--';?></td>
							<td> <?php echo $row['website_address']? : '--';?></td>
							<td> <?php echo $row['cr_number']? : '--';?></td>
							<td> <?php echo $row['cr_legal_type']? : '--';?></td>
							<td> <?php echo $row['cr_registration_date']? : '--';?></td>
							<td> <?php echo $row['cr_expiry_date']? : '--';?></td>
							<td> <?php echo $row['cr_tax_registration_number']? : '--';?></td>
							<td> <?php echo $row['user_email']? : '--';?></td>
							<td> <?php echo $row['password']? : '--';?></td>
							<td> <?php echo $row['cpassword']? : '--';?></td>
							<td> <?php echo $row['business_type_product_category']? : '--';?></td>
							<td> <?php echo $row['number_of_employee']? : '--';?></td>
							<td> <?php echo $row['upload_document1']? : '--';?></td>
							<td> <?php echo $row['upload_document2']? : '--';?></td>
							<td> <?php echo $row['upload_document3']? : '--';?></td>
							<td> <?php echo $row['healthcare_status']? : '--';?></td>
							<td> <?php echo $row['main_contact_status']? : '--';?></td>
							<td> <?php echo $row['tnc']? : '--';?></td>
							<td> <?php echo $row['captcha_code']? : '--';?></td>
							<td> <?php echo $row['record_date']? : '--';?></td>
							<td> <?php echo $row['reset_link_token']? : '--';?></td>
							<td> <?php echo $row['up_month']? : '--';?></td>
							<td> <?php echo $row['status']? : '--';?></td>
							<td>&nbsp;</td>
						<?php

						  $sn++;}} else { ?>
							<tr>
							 
							 <td>No data found</td>
							</tr>
						 <?php } ?>
						 </table>						
					</tr>
				</tbody>
			 </table>
		   </div>
			</div>
		</div>
	</div>
</div>
		</div>
	</div>

<script>
    $(document).ready(function () {
		// let table = new DataTable('#test');
        $('#test').DataTable();
    });
</script>
</body>
</html>
	
	
	
	
