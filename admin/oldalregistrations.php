<?php 

	
	include ("include/config.php");
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
<!-- Bootstrap css -->

<?php include("include/table_css.php"); ?>
  
</head>	
<body>
<?php include("include/top_header.php"); ?>
<?php  include("include/quick_link.php"); ?>
<?php include ("include/quick_setting.php"); ?>

	<div class="container-fluid">
		<?php include("/include/menu_navbar.php"); ?>
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
						<a href="#">Back</a>
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
							<div class="t-header">Manage Registration</div>
						</div>
					</div>
				</form>
				<?php echo $deleteMsg??''; ?>
    <div class="table-responsive">
      <table class="table table-bordered">
       <thead>
			<th>Serial No.</th>
			<th>Product id</th>
			 <th>Product Name</th>
			 <th>Registration Fee</th>
			 <th>gtins_annual_fee</th>
			<th>gln_price	</th>
			<th>sscc_price	</th>
			<th>annual_subscription_fee	</th>
			<th>annual_total_price	</th>
			<th>details	</th>
			<th>name	</th>
			<th>name_ar</th>
			<th>pobox</th>
			<th>zipcode</th>
			<th>address</th>
			<th>address_ar</th>
			<th>country</th>
			<th>city</th>
			<th>mobile_number</th>
			<th>phone_number</th>
			<th>fax_number</th>
			<th>website_address</th>
			<th>cr_number</th>
			<th>cr_legal_type</th>
			<th>cr_registration_date</th>
			<th>cr_expiry_date</th>
			<th>cr_tax_registration_number</th>
			<th>user_email</th>
			<th>password</th>
			<th>cpassword</th>
			<th>business_type_product_category</th>
			<th>number_of_employee</th>
			<th>upload_document 1<th></th>
			<th>upload_document 2</th></th>
			<th>upload_document 3</th>
			<th>healthcare_status</th>
			<th>main_contact_status</th>
			<th>tnc</th>
			<th>captcha_code</th>
			<th>record_date</th>
			<th>reset_link_token</th>
			<th>up_month</th>
			<th>status</th>
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
							<td> <?php echo $row['registration_fee'];?></td>
							<td> <?php echo $row['gtins_annual_fee'];?></td>
							<td> <?php echo $row['gln_price'];?></td>
							<td> <?php echo $row['sscc_price'];?></td>
							<td> <?php echo $row['annual_subscription_fee'];?></td>
							<td> <?php echo $row['annual_total_price'];?></td>
							<td> <?php echo $row['details'];?></td>
							<td> <?php echo $row['name'];?></td>
							<td> <?php echo $row['name_ar'];?></td>
							<td> <?php echo $row['zipcode'];?></td>
							<td> <?php echo $row['address'];?></td>
							<td> <?php echo $row['pobox'];?></td>
							<td> <?php echo $row['address_ar'];?></td>
							<td> <?php echo $row['country'];?></td>
							<td> <?php echo $row['city'];?></td>
							<td> <?php echo $row['mobile_number'];?></td>
							<td> <?php echo $row['phone_number'];?></td>
							<td> <?php echo $row['fax_number'];?></td>
							<td> <?php echo $row['website_address'];?></td>
							<td> <?php echo $row['cr_number'];?></td>
							<td> <?php echo $row['cr_legal_type'];?></td>
							<td> <?php echo $row['cr_registration_date'];?></td>
							<td> <?php echo $row['cr_expiry_date'];?></td>
							<td> <?php echo $row['cr_tax_registration_number'];?></td>
							<td> <?php echo $row['user_email'];?></td>
							<td> <?php echo $row['password'];?></td>
							<td> <?php echo $row['cpassword'];?></td>
							<td> <?php echo $row['business_type_product_category'];?></td>
							<td> <?php echo $row['number_of_employee'];?></td>
							<td> <?php echo $row['upload_document1'];?></td>
							<td> <?php echo $row['upload_document2'];?></td>
							<td> <?php echo $row['upload_document3'];?></td>
							<td> <?php echo $row['healthcare_status'];?></td>
							<td> <?php echo $row['main_contact_status'];?></td>
							<td> <?php echo $row['tnc'];?></td>
							<td> <?php echo $row['captcha_code'];?></td>
							<td> <?php echo $row['record_date'];?></td>
							<td> <?php echo $row['reset_link_token'];?></td>
							<td> <?php echo $row['up_month'];?></td>
							<td> <?php echo $row['status'];?></td>
							
						<?php

						  $sn++;}} else { ?>
							<tr>
							 
							 <td colspan="12">No data found</td>
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


</body>
</html>
	
	
	
	
