<?php 
include("admin/include/function.php");
include('header.php');

// Form Submit Start 


if(isset($_POST['submit']))
{
//COMPANY DETAILS START
$details=$_POST['details'];
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
//COMPANY DETAILS WRAP

//CR DETAILS START 
$cr_number=$_POST['cr_number'];
$cr_legal_type=$_POST['cr_legal_type'];
$cr_registration_date=$_POST['cr_registration_date'];
$cr_expiry_date=$_POST['cr_expiry_date'];
$cr_tax_registration_number=$_POST['cr_tax_registration_number'];
// CR DETAILS WRAP


//LOGIN DETAILS START 
$user_email=$_POST['user_email'];
$cpassword=$_POST['password'];
$password=sha1($cpassword);
$business_type_product_category=$_POST['business_type_product_category'];
$number_of_employee=$_POST['number_of_employee'];
//LOGIN DETAILS WRAP

// Uploda Document Start 
//1st Document
$doc_name1=$_FILES['upload_document1']['name'];
$doc_tmp_name1=$_FILES['upload_document1']['tmp_name'];
$doc_path1="../../images/Upload/".$doc_name1;

//2nd Document
$doc_name2=$_FILES['upload_document2']['name'];
$doc_tmp_name2=$_FILES['upload_document2']['tmp_name'];
$doc_path2="../../images/Upload/".$doc_name2;

//3rd Document
$doc_name3=$_FILES['upload_document3']['name'];
$doc_tmp_name3=$_FILES['upload_document3']['tmp_name'];
$doc_path3="../../images/Upload/".$doc_name3;

if(empty($doc_tmp_name1) || empty($doc_tmp_name2) || empty($doc_tmp_name3) )
{
$doc_path11="images/Upload/no-image.png";
$doc_path22="images/Upload/no-image.png";
$doc_path33="images/Upload/no-image.png";
}
else {
$doc_path11=substr($doc_path1,6);
$doc_path22=substr($doc_path2,6);
$doc_path33=substr($doc_path3,6); 
}
move_uploaded_file($doc_tmp_name1,$doc_path1);
move_uploaded_file($doc_tmp_name2,$doc_path2);
move_uploaded_file($doc_tmp_name3,$doc_path3);
//Upload Documnet Wrap 


$sql="INSERT INTO `company_tbl`(heading, hm_desc,  status) VALUES ('$heading','$hm_desc','$status' )";
$query=mysqli_query($conn,$sql)or die(mysqli_error($conn));  
if($query)
{
$user_id=mysqli_insert_id($conn);
$_SESSION['guest']=$user_id;

}


}
// Form Submit Wrap


?>

<section class="user_registration">
	<div class="container">
		<form method="POST" action ="" enctype="multipart/form-data">
			<h4>company details</h4>
			<!-- company details Start  --->
			<div class="row">
				<div class="col-md-12">
					<label>Details:</label>
					<input type="text" class="form-control" name="details" placeholder="Enter Details">
				</div>
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
					<label>City	*</label>
					<select class="form-control" name="city">
						<option disabled selected>Select City</option>
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
						<option value="">Jabrin	جبرين</option>
						<option value="">Jalan Bani Bu Hassan	ولاية جعلان بني بو حسن</option>
						<option value="">Khasab	ولاية خصب</option>
						<option value="">Mahooth	ولاية محوت</option>
						<option value="">Manah	ولاية منح</option>
						<option value="">Masirah	جزيرة مصيرة</option>
						<option value="">Matrah	ولاية مطرح</option>
						<option value="">Mudhaireb	المضيرب</option>
						<option value="">Mudhaybi	ولاية المضيبي</option>
						<option value="">Muscat	مسقط</option>
						<option value="">Nizwa	ولاية نزوي</option>
						<option value="">Quriyat	ولاية قريات</option>
						<option value="">Raysut	ريسوت</option>
						<option value="">Rustaq	ولاية الرستاق</option>
						<option value="">Ruwi	روي</option>
						<option value="">Saham	ولاية صحم</option>
						<option value="">Saiq	Saiq</option>
						<option value="">Salalah	صلالة</option>
						<option value="">Samail	ولاية سمائل</option>
						<option value="">Shinas	ولاية شناص</option>
						<option value="">Sohar	صحار</option>
						<option value="">Sur	ولاية صور</option>
						<option value="">Tan`am	ولاية تنعم</option>
						<option value="">Thumrait	ثمريت</option>
						<option value="">Other	آخر</option>

					</select>
				</div>
				<div class="col-md-6">
					<label>Country *</label>
					<select class="form-control" name="country">
						<option disabled selected > Select Country</option>
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
					<label>Mobile Number *</label>
					<input type="number" class="form-control" name="mobile_number"  required>
				</div>
				<div class="col-md-6">
					<label>Phone Number *</label>
					<input type="number" class="form-control" name="phone_number"  required>
				</div>
				<div class="col-md-6">
					<label>Fax Number</label>
					<input type="number" class="form-control" name="fax_number">
				</div>
				<div class="col-md-6">
					<label>Website Address</label>
					<input type="url" class="form-control" name="website_address" placeholder="www.gs1oman.org">
				</div>
			</div>
<!-- company details Wrap  --->
			<hr>
<!-- CR DETAILS START -->
			<h4>cr details</h4>
			<div class="row">
				<div class="col-md-6">
					<label>Company Registration Number (CR No.): *</label>
					<input type="number" class="form-control" name="cr_number" placeholder="CR Number" required>
				</div>
				<div class="col-md-6">
					<label>Legal Type *</label>
					<div style="clear: both;"></div>
					<select name="cr_legal_type">
						<option selected disabled>Select Type</option>
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
					<input type="date" name="cr_registration_date" class="form-control">
				</div>
				<div class="col-md-4">
					<label>CR Expiry Date</label>
					<input type="date" id="date_picker" name="cr_expiry_date" class="form-control">
				</div>
				<div class="col-md-4">
					<label>Tax Registration Number</label>
					<input type="number" class="form-control" name="cr_tax_registration_number" placeholder="Tax Registration Number">
				</div>
			</div>
<!-- CR DETAILS WRAP -->

			<hr>
<!-- LOGIN DETAILS START -->
			<h4>login details</h4>
			<div class="row">
				<div class="col-md-6">
					<label>User Name *</label>
					<input type="email" class="form-control" placeholder="user@email.com" name="user_email" required>
				</div>
				<div class="col-md-6">
					<label>Password *</label>
					<input type="password" class="form-control" placeholder="Password" name="password" required>
				</div>
				
			</div>

			<hr>

			<h4>	</h4>
			<div class="row">
				<div class="col-md-6">
					<label>Main Product Category *</label>
					<select name="business_type_product_category">
						<option disabled selected>Select Category</option>
						<option value="Agriculture">Agriculture</option>
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
						<option value="Clothing">Clothing</option>
						<option value="Computer software">Computer software</option>
						<option value="Confectionery Products">Confectionery Products</option>
						<option value="Cosmetics">Cosmetics</option>
						<option value="Crisps">Crisps</option>
						<option value="">Dairy Products</option>
						<option value="">Dental Instruments</option>
						<option value="">Detergents</option>
						<option value="">Disinfectant</option>
						<option value="">Disposable Polystrene Items</option>
						<option value="">Drinks</option>
						<option value="">Eggs</option>
						<option value="">Electric heaters</option>
						<option value="">Fabrics</option>
						<option value="">Fashion accessories</option>
						<option value="">Food</option>
						<option value="">Food (Fish)</option>
						<option value="">Food and Drink</option>
						<option value="">Food Manufacturing</option>
						<option value="">Fresh Fruit</option>
						<option value="">Fresh Produce</option>
						<option value="">Fresh Vegetables</option>
						<option value="">Frozen Fish</option>
						<option value="">Fruit</option>
						<option value="">Fruit drinks</option>
						<option value="">Fruit Juice</option>
						<option value="">Fruit vegetables</option>
						<option value="">Hardware</option>
						<option value="">Health and beauty</option>
						<option value="">Healthcare equipment</option>
						<option value="">Home Textiles</option>
						<option value="">Household </option>
						<option value="">Hygene Products</option>
						<option value="">Ice-Cream</option>
						<option value="">Industrial goods</option>
						<option value="">IT </option>
						<option value="">Jam</option>
						<option value="">Macaroni</option>
						<option value="">Mineral Water</option>
						<option value="">Musical Record Production</option>
						<option value="">Not Specified</option>
						<option value="">Oil</option>
						<option value="">Optical Industry</option>
						<option value="">Others</option>
						<option value="">Paper</option>
						<option value="">Paper Products</option>
						<option value="">Pasta</option>
						<option value="">Pastry</option>
						<option value="">Perfumes</option>
						<option value="">Pharmaceutical</option>
						<option value="">Postal Products</option>
						<option value="">Powdered Milk</option>
						<option value="">Pullover</option>
						<option value="">Readymade garments</option>
						<option value="">Rice</option>
						<option value="">Sea Food</option>
						<option value="">Snack Food</option>
						<option value="">Soap</option>
						<option value="">Soft drinks</option>
						<option value="">Sports Balls (equipment)</option>
						<option value="">Sports equipment</option>
						<option value="">Sports goods</option>
						<option value="">Stationary</option>
						<option value="">Sugar</option>
						<option value="">Surgical Equipment</option>
						<option value="">Sweets</option>
						<option value="">Tea</option>
						<option value="">Telecomm</option>
						<option value="">Textile</option>
						<option value="">Tissue Paper</option>
						<option value="">Tobacco</option>
						<option value="">Toiletries</option>
						<option value="">Toothbrushes</option>
						<option value="">Toys</option>
						<option value="">Vegetable </option>
						<option value="">vegetables conservation</option>
						<option value="">Water</option>
					</select>
				</div>
				<div class="col-md-6">
					<label>Number of Employees</label>
					<input type="number" class="form-control" name="number_of_employee">
				</div>
			</div>
<!-- LOGIN DETAILS WRAP -->

<!----- COMPANY CONTACTS MINIMUM 2 PERSONS START --->
			<hr>
			<h4>COMPANY CONTACTS MINIMUM 2 PERSONS</h4>
			<hr>
			<h5 class="fw-bold">Contact Person 1</h5>
			<div class="row">
				<div class="col-md-2">
					<label>Title</label>
					<select class="form-control" name="title">
						<option disabled selected>Select Title</option>
						<option value="Mr.">Mr.</option>
						<option value="Mrs.">Mrs.</option>
						<option value="Miss">Miss</option>
						<option value="Dr.">Dr.</option>
					</select>
				</div>
				<div class="col-md-5">
					<label>First Name</label>
					<input type="text" name="first_name" class="form-control" placeholder="First Name">
				</div>
				<div class="col-md-5">
					<label>Last Name</label>
					<input type="text" name="last_name" class="form-control" placeholder="Last Name">
				</div>

				<div class="col-md-2">
					<label>Job Title</label>
					<select class="form-control" name="job_title">
						<option disabled selected>Select Job Title</option>
						<option value="CEO.">CEO.</option>
						<option value="Staff.">Staff.</option>
						<option value="Accounts.">Accounts.</option>
					</select>
				</div>
				<div class="col-md-5">
					<label>Email</label>
					<input type="text" name="email_id" class="form-control" placeholder="">
				</div>
				<div class="col-md-5">
					<label>Phone Number</label>
					<input type="number" name="phone" class="form-control" placeholder="">
				</div>
				<div class="col-md-12">
					<input type="radio" name="conatct_type" class="tick"> &nbsp; Is this main contact? </span>
				</div>
			</div>

			<hr>

			<div id="dynamic-field-1" class="dynamic-field">
				<h5 class="fw-bold">Contact Person 2</h5>
				<div class="row">
					<div class="col-md-2">
						<label>Title</label>
						<select class="form-control" name="title">
							<option disabled selected>Select Title</option>
							<option value="Mr.">Mr.</option>
						<option value="Mrs.">Mrs.</option>
						<option value="Miss">Miss</option>
						<option value="Dr.">Dr.</option>
						</select>
					</div>
					<div class="col-md-5">
						<label>First Name</label>
						<input type="text" name="first_name" class="form-control" placeholder="First Name">
					</div>
					<div class="col-md-5">
						<label>Last Name</label>
						<input type="text" name="last_name" class="form-control" placeholder="Last Name">
					</div>

					<div class="col-md-2">
						<label>Job Title</label>
						<select class="form-control" name="job_title">
						<option disabled selected>Select Job Title</option>
						<option value="CEO.">CEO.</option>
						<option value="Staff.">Staff.</option>
						<option value="Accounts.">Accounts.</option>
					</select>
					</div>
					<div class="col-md-5">
					<label>Email</label>
					<input type="text" name="email_id" class="form-control" placeholder="">
				</div>
				<div class="col-md-5">
					<label>Phone Number</label>
					<input type="number" name="phone" class="form-control" placeholder="">
				</div>
					<div class="col-md-12">
						<input type="radio" name="conatct_type" class="tick"> &nbsp; Is this main contact? </span>
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
					  <select id="colorselector">
					  	<option value="">Select Package</option>
					    <option value="one">100</option>
						<option value="two">200</option>
						<option value="three">300</option>
						<option value="four">400</option>
						<option value="five">500</option>
					  </select>
					</div>


					<div class="output">
					  <div id="one" class="colors table table-responsive">
					  	<table class="table table-bordered table-striped">
					  		<tr>
					  			<td class="fw-bold">Product / Services </td>
					  			<td class="fw-bold">Registration Fee <span class="fo-12">One time</span></td>
					  			<td class="fw-bold">Annual Renewal</td>
					  		</tr>
					  		<tr>
					  			<td>GTIN: Global Trade Item Numbers </td>
					  			<td>100</td>
					  			<td>100</td>
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
            					  		    <td><input type="checkbox" id="selectall" name="five"> </td>
            					  			<td>Do you require GLN? <span class="text-danger" data-toggle="tooltip" title="GTIN: Definition">!</span></td>
            					  			<td>100</td>
            					  		</tr>
            					  		<tr>
            					  		    <td><input type="checkbox" id="selectall" name="five"> </td>
            					  			<td>Do you require SSCC? <span class="text-danger" data-toggle="tooltip" title="SSCC: Definition">!</span></td>
            					  			<td>100</td>
            					  		</tr>
            					  	</table>
            					  </div>
            					</div>
            				   
            				</div>
            			</div>
					  	
					  </div>
					  <div id="two" class="colors table-bordered table-striped"> 
					  	<table class="table table-bordered table-striped">
					  		<tr>
					  			<td class="fw-bold">Product / Services </td>
					  			<td class="fw-bold">Registration Fee <span class="fo-12">One time</span></td>
					  			<td class="fw-bold">Annual Renewal</td>
					  		</tr>
					  			<td>GTIN: Global Trade Item Numbers </td>
					  			<td>200</td>
					  			<td>200</td>
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
            					  		    <td><input type="checkbox" id="selectall" name="five"> </td>
            					  			<td>Do you require GLN? <span class="text-danger" data-toggle="tooltip" title="GTIN: Definition">!</span></td>
            					  			<td>200</td>
            					  		</tr>
            					  		<tr>
            					  		    <td><input type="checkbox" id="selectall" name="five"> </td>
            					  			<td>Do you require SSCC? <span class="text-danger" data-toggle="tooltip" title="SSCC: Definition">!</span></td>
            					  			<td>200</td>
            					  		</tr>
            					  	</table>
            					  </div>
            					</div>
            				   
            				</div>
            			</div>
					  	
					  </div>
					  <div id="three" class="colors table-bordered table-striped"> 
					  	<table class="table table-bordered table-striped">
					  		<tr>
					  			<td class="fw-bold">Product / Services </td>
					  			<td class="fw-bold">Registration Fee <span class="fo-12">One time</span></td>
					  			<td class="fw-bold">Annual Renewal</td>
					  		</tr>
					  			<td>GTIN: Global Trade Item Numbers </td>
					  			<td>300</td>
					  			<td>300</td>
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
            					  		    <td><input type="checkbox" id="selectall" name="five"> </td>
            					  			<td>Do you require GLN? <span class="text-danger" data-toggle="tooltip" title="GTIN: Definition">!</span></td>
            					  			<td>300</td>
            					  		</tr>
            					  		<tr>
            					  		    <td><input type="checkbox" id="selectall" name="five"> </td>
            					  			<td>Do you require SSCC? <span class="text-danger" data-toggle="tooltip" title="SSCC: Definition">!</span></td>
            					  			<td>300</td>
            					  		</tr>
            					  	</table>
            					  </div>
            					</div>
            				   
            				</div>
            			</div>
					  	
					  </div>
					  <div id="four" class="colors table-bordered table-striped"> 
					  	<table class="table table-bordered table-striped">
					  		<tr>
					  			<td class="fw-bold">Product / Services </td>
					  			<td class="fw-bold">Registration Fee </td>
					  			<td class="fw-bold">Annual Renewal</td>
					  		</tr>
					  			<td>GTIN: Global Trade Item Numbers </td>
					  			<td>400</td>
					  			<td>400</td>
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
            					  		    <td><input type="checkbox" id="selectall" name="five"> </td>
            					  			<td>Do you require GLN? <span class="text-danger" data-toggle="tooltip" title="GTIN: Definition">!</span></td>
            					  			<td>400</td>
            					  		</tr>
            					  		<tr>
            					  		    <td><input type="checkbox" id="selectall" name="five"> </td>
            					  			<td>Do you require SSCC? <span class="text-danger" data-toggle="tooltip" title="SSCC: Definition">!</span></td>
            					  			<td>400</td>
            					  		</tr>
            					  	</table>
            					  </div>
            					</div>
            				   
            				</div>
            			</div>
					  	
					  </div>
					  <div id="five" class="colors table-bordered table-striped"> 
					  	<table class="table table-bordered table-striped">
					  		<tr>
					  			<td class="fw-bold">Product / Services </td>
					  			<td class="fw-bold">Registration Fee <span class="fo-12">One time</span></td>
					  			<td class="fw-bold">Annual Renewal</td>
					  		</tr>
					  		<tr>
					  			<td>GTIN: Global Trade Item Numbers </td>
					  			<td><input type="number" id="txt1" class="form-control mb-0" value="500" disabled></input></td>
					  			<td><input type="number" id="txt2" class="form-control mb-0" value="500" disabled></input></td>
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
            					  		    <td><input type="checkbox" id="selectall" name="choice" value="1000" onchange="checkTotal()"></td>
            					  		    <!--<input type="checkbox" name="item-1" id="item-1" value="500">-->
            					  			<td>Do you require GLN? <span class="text-danger" data-toggle="tooltip" title="GTIN: Definition">!</span></td>
            					  			<td>500</td>
            					  		</tr>
            					  		<tr>
            					  		    <td><input type="checkbox" id="selectall" name="choice" value="1500" onchange="checkTotal()"></td>
            					  			<td>Do you require SSCC? <span class="text-danger" data-toggle="tooltip" title="SSCC: Definition">!</span></td>
            					  			<td>500</td>
            					  		</tr>
            					  	</table>
            					  </div>
            					</div>
            				   
            				</div>
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
					  <input type="text" class="form-control mb-0" placeholder="500" value="500" disabled>
					</div>
					<span class="fw-bold text-danger">Valid till 31st Dec 2022 </span>
				</div>

				<div class="col-md-4">
				    <label class="fw-bold">Annual Subscription Fee  </label>
					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1">OMR</span>
					  <!--<input type="number" id="total" class="form-control mb-0" >
					  <div id="total" class="form-control">500</div>-->
					  <input type="text" class="form-control mb-0" size="2" name="total" value="500" disabled/>
					</div>
					<span class="fw-bold text-danger">Next renewal Jan 2023 </span>
				</div>
				<div class="col-md-4">
				    <label class="fw-bold">Total Fee  </label>
					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1">OMR</span>
					  <!--<input id="demo" type="text" class="form-control mb-0" placeholder="500" value="500" disabled>-->
					  <input class="form-control mb-0" disabled id="demo">
					</div>
				</div>
			</div>


            <div class="row">
				<div class="col-md-12 text-center mt-3">
					<!--<a id="calculate_fee" class="btn btn-success">Calculate Membership Fee</a>-->
					<a id="calculate_fee" class="btn btn-success" onclick="add()">Calculate Membership Fee</a>
				</div>

				
			</div>


			<div style="clear: both;"></div>






			<div style="clear: both;"></div>
		
			<!-- <div class="row">
				<div class="col-md-4">
					<label>Registration Fee</label>
					<input type="number" class="form-control" placeholder="$154" disabled >
				</div>
				<div class="col-md-4">
					<label>Annual Subscription Fee </label>
					<input type="number" class="form-control" placeholder="$154" disabled >
				</div>
				<div class="col-md-4">
					<label>Total Fee </label>
					<input type="number" class="form-control" placeholder="$154" disabled >
				</div>
			</div> -->

			<div class="row">
				<div class="col-md-4">
					<label>I have a promo code</label>
					<input type="text" class="form-control" placeholder="Please enter promo code" name="">
				</div>
			</div>
             
             <div class="row">
			<div class="col-md-12">
					<input type="checkbox" class="tick"> &nbsp; <span>Accept <a href="#"> Terms and conditions </a>/ <a href="#"> Privacy policy </a> </span>
				</div>
			</div>


			<hr>

			<div class="col-md-12 text-center">
				<button id="calculate_fee" type="submit" class="btn btn-success">Sign Up</button>
			</div>
			


		</form>
	</div>
</section>

<?php include('footer.php'); ?>