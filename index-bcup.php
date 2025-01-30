<?php 
include("admin/include/function.php");
include('header.php');
 ?>

<section class="user_registration">
	<div class="container">
		<form name="listForm">
			<h4>company details</h4>
			<div class="row">
				<div class="col-md-12">
					<label>Details:</label>
					<input type="text" class="form-control" name="details" placeholder="Enter Details">
				</div>
				<div class="col-md-6">
					<label>Company Name English	*</label>
					<input type="text" class="form-control" name="englishname" placeholder="Company Name English" required>
				</div>
				<div class="col-md-6">
					<label>Company Name Arabic	*</label>
					<input type="text" class="form-control" name="englishname" placeholder="Company Name Arabic" required>
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
					<input type="text" class="form-control" name="addressenglish" placeholder="Office Number, Bld No, Way No, Town" required>
				</div>
				<div class="col-md-6">
					<label>Address Arabic	*</label>
					<input type="text" class="form-control" name="addressarabic" placeholder="Office Number, Bld No, Way No, Town" required>
				</div>
				<div class="col-md-6">
					<label>City	*</label>
					<select class="form-control">
						<option>Select City</option>
					    <option>Adam	آدم</option>
						<option>Al Ashkharah	الأشخرة</option>
						<option>Al Buraimi	البريمي</option>
						<option>Al Hamra	الحمراء</option>
						<option>Al Jazer	الجزر</option>
						<option>Al Madina A'Zarqa	المدينة الزرقاء</option>
						<option>Al Suwaiq	السويق</option>
						<option>As Sib	السيب</option>
						<option>Bahla	بهلا</option>
						<option>Barka	ولاية بركاء</option>
						<option>Bidbid	ولاية بدبد</option>
						<option>Bidiya	ولاية بدية</option>
						<option>Duqm	الدقم</option>
						<option>Haima	ولاية هيما</option>
						<option>Ibra	ولاية إبراء</option>
						<option>Ibri	عبري</option>
						<option>Izki	ولاية إزكي</option>
						<option>Jabrin	جبرين</option>
						<option>Jalan Bani Bu Hassan	ولاية جعلان بني بو حسن</option>
						<option>Khasab	ولاية خصب</option>
						<option>Mahooth	ولاية محوت</option>
						<option>Manah	ولاية منح</option>
						<option>Masirah	جزيرة مصيرة</option>
						<option>Matrah	ولاية مطرح</option>
						<option>Mudhaireb	المضيرب</option>
						<option>Mudhaybi	ولاية المضيبي</option>
						<option>Muscat	مسقط</option>
						<option>Nizwa	ولاية نزوي</option>
						<option>Quriyat	ولاية قريات</option>
						<option>Raysut	ريسوت</option>
						<option>Rustaq	ولاية الرستاق</option>
						<option>Ruwi	روي</option>
						<option>Saham	ولاية صحم</option>
						<option>Saiq	Saiq</option>
						<option>Salalah	صلالة</option>
						<option>Samail	ولاية سمائل</option>
						<option>Shinas	ولاية شناص</option>
						<option>Sohar	صحار</option>
						<option>Sur	ولاية صور</option>
						<option>Tan`am	ولاية تنعم</option>
						<option>Thumrait	ثمريت</option>
						<option>Other	آخر</option>

					</select>
				</div>
				<div class="col-md-6">
					<label>Country *</label>
					<select class="form-control">
						<option>Bahrain</option>
						<option>Iran</option>
						<option>Iraq</option>
						<option>Kuwait</option>
						<option selected>Oman</option>
						<option>Qatar</option>
						<option>Saudi Arabia</option>
						<option>UAE</option>
						<option>Yemen</option>
					</select>
				</div>
				<div class="col-md-6">
					<label>Mobile Number *</label>
					<input type="number" class="form-control" name="mobile" placeholder="+968 0000 0000" required>
				</div>
				<div class="col-md-6">
					<label>Phone Number *</label>
					<input type="number" class="form-control" name="phone" placeholder="+968 0000 0000" required>
				</div>
				<div class="col-md-6">
					<label>Fax Number</label>
					<input type="number" class="form-control" name="mobile" placeholder="+968 0000 0000">
				</div>
				<div class="col-md-6">
					<label>Website Address</label>
					<input type="text" class="form-control" name="mobile" placeholder="www.gs1oman.org">
				</div>
			</div>

			<hr>

			<h4>cr details</h4>
			<div class="row">
				<div class="col-md-6">
					<label>Company Registration Number (CR No.): *</label>
					<input type="number" class="form-control" name="crnumber" placeholder="CR Number" required>
				</div>
				<div class="col-md-6">
					<label>Legal Type *</label>
					<div style="clear: both;"></div>
					<select>
						<option value="">Select Type</option>
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
					<input type="date" class="form-control">
				</div>
				<div class="col-md-4">
					<label>CR Expiry Date</label>
					<input type="date" id="date_picker" class="form-control">
				</div>
				<div class="col-md-4">
					<label>Tax Registration Number</label>
					<input type="number" class="form-control" name="crdate" placeholder="Tax Registration Number">
				</div>
			</div>
			<hr>

			<h4>login details</h4>
			<div class="row">
				<div class="col-md-6">
					<label>User Name *</label>
					<input type="text" class="form-control" placeholder="user@email.com" name="user" required>
				</div>
				<div class="col-md-6">
					<label>Password *</label>
					<input type="password" class="form-control" placeholder="Password" name="user" required>
				</div>
				
			</div>

			<hr>

			<h4>business type</h4>
			<div class="row">
				<div class="col-md-6">
					<label>Main Product Category *</label>
					<select>
						<option>Select Category</option>
						<option>Agriculture</option>
						<option>Agro machinery</option>
						<option>Babyfood</option>
						<option>Bakery Products</option>
						<option>Bed Linen</option>
						<option>Beverages</option>
						<option>Biscuits</option>
						<option>Bottled water</option>
						<option>Bottles and Containers</option>
						<option>Bread</option>
						<option>Building Materials</option>
						<option>Car care Accessories</option>
						<option>Celular Phones</option>
						<option>Chemicals</option>
						<option>Chocolate</option>
						<option>Cigarettes</option>
						<option>Cleaning products</option>
						<option>Clothing</option>
						<option>Coffee</option>
						<option>Computer software</option>
						<option>Confectionery Products</option>
						<option>Cosmetics</option>
						<option>Crisps</option>
						<option>Dairy Products</option>
						<option>Dental Instruments</option>
						<option>Detergents</option>
						<option>Disinfectant</option>
						<option>Disposable Polystrene Items</option>
						<option>Drinks</option>
						<option>Eggs</option>
						<option>Electric heaters</option>
						<option>Fabrics</option>
						<option>Fashion accessories</option>
						<option>Food</option>
						<option>Food (Fish)</option>
						<option>Food and Drink</option>
						<option>Food Manufacturing</option>
						<option>Fresh Fruit</option>
						<option>Fresh Produce</option>
						<option>Fresh Vegetables</option>
						<option>Frozen Fish</option>
						<option>Fruit</option>
						<option>Fruit drinks</option>
						<option>Fruit Juice</option>
						<option>Fruit vegetables</option>
						<option>Hardware</option>
						<option>Health and beauty</option>
						<option>Healthcare equipment</option>
						<option>Home Textiles</option>
						<option>Household </option>
						<option>Hygene Products</option>
						<option>Ice-Cream</option>
						<option>Industrial goods</option>
						<option>IT </option>
						<option>Jam</option>
						<option>Macaroni</option>
						<option>Mineral Water</option>
						<option>Musical Record Production</option>
						<option>Not Specified</option>
						<option>Oil</option>
						<option>Optical Industry</option>
						<option>Others</option>
						<option>Paper</option>
						<option>Paper Products</option>
						<option>Pasta</option>
						<option>Pastry</option>
						<option>Perfumes</option>
						<option>Pharmaceutical</option>
						<option>Postal Products</option>
						<option>Powdered Milk</option>
						<option>Pullover</option>
						<option>Readymade garments</option>
						<option>Rice</option>
						<option>Sea Food</option>
						<option>Snack Food</option>
						<option>Soap</option>
						<option>Soft drinks</option>
						<option>Sports Balls (equipment)</option>
						<option>Sports equipment</option>
						<option>Sports goods</option>
						<option>Stationary</option>
						<option>Sugar</option>
						<option>Surgical Equipment</option>
						<option>Sweets</option>
						<option>Tea</option>
						<option>Telecomm</option>
						<option>Textile</option>
						<option>Tissue Paper</option>
						<option>Tobacco</option>
						<option>Toiletries</option>
						<option>Toothbrushes</option>
						<option>Toys</option>
						<option>Vegetable </option>
						<option>vegetables conservation</option>
						<option>Water</option>
					</select>
				</div>
				<div class="col-md-6">
					<label>Number of Employees</label>
					<input type="number" class="form-control">
				</div>
			</div>
			
			<hr>
			
			<h4>Are you in Healthcare?</h4>
			<div class="row">
			    <div class="col-md-12">
			        <label>Are you in identifying medical devices, which fall under the U.S. Food and Drug Administration (FDA) or Unique Device Identification System (UDI)? <span class="text-danger" data-toggle="tooltip" title="The U.S. FDA considers a product to be a device if it meets the definition of a medical device per Section 201(h) of the Food, Drug, and Cosmetic Act.">!</span></label>
			    </div>
			    <div class="col-md-12">
			        <input type="radio" name="main" class="tick"> &nbsp; Yes 
			        <input type="radio" name="main" class="tick"> &nbsp; No
			    </div>
			    
			</div>

			<hr>
			<h4>COMPANY CONTACTS MINIMUM 2 PERSONS</h4>
			<hr>
			<h5 class="fw-bold">Contact Person 1</h5>
			<div class="row">
				<div class="col-md-2">
					<label>Title</label>
					<select class="form-control">
						<option>Mr.</option>
						<option>Mrs.</option>
						<option>Miss</option>
						<option>Dr.</option>
					</select>
				</div>
				<div class="col-md-5">
					<label>First Name</label>
					<input type="text" name="" class="form-control" placeholder="First Name">
				</div>
				<div class="col-md-5">
					<label>Last Name</label>
					<input type="text" name="" class="form-control" placeholder="Last Name">
				</div>

				<div class="col-md-2">
					<label>Job Title</label>
					<select class="form-control">
						<option>CEO.</option>
						<option>Staff.</option>
						<option>Accounts.</option>
					</select>
				</div>
				<div class="col-md-5">
					<label>Email</label>
					<input type="text" name="" class="form-control" placeholder="user@gs1.org">
				</div>
				<div class="col-md-5">
					<label>Phone Number</label>
					<input type="number" name="" class="form-control" placeholder="+968 000 000">
				</div>
				<div class="col-md-12">
					<input type="radio" name="main" class="tick"> &nbsp; Is this main contact? </span>
				</div>
			</div>

			<hr>

			<div id="dynamic-field-1" class="dynamic-field">
				<h5 class="fw-bold">Contact Person 2</h5>
				<div class="row">
					<div class="col-md-2">
						<label>Title</label>
						<select class="form-control">
							<option>Mr.</option>
							<option>Mrs.</option>
							<option>Miss</option>
							<option>Dr.</option>
						</select>
					</div>
					<div class="col-md-5">
						<label>First Name</label>
						<input type="text" name="" class="form-control" placeholder="First Name">
					</div>
					<div class="col-md-5">
						<label>Last Name</label>
						<input type="text" name="" class="form-control" placeholder="Last Name">
					</div>

					<div class="col-md-2">
						<label>Job Title</label>
						<select class="form-control">
							<option>CEO.</option>
							<option>Staff.</option>
							<option>Accounts.</option>
						</select>
					</div>
					<div class="col-md-5">
						<label>Email</label>
						<input type="text" name="" class="form-control" placeholder="user@gs1.org">
					</div>
					<div class="col-md-5">
						<label>Phone Number</label>
						<input type="number" name="" class="form-control" placeholder="+968 000 000">
					</div>
					<div class="col-md-12">
						<input type="radio" name="main" class="tick"> &nbsp; Is this main contact? </span>
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
					<input type="file" class="form-control mb-0" name="">
					<span class="fo-12">JPG, PDF, PNG Allowed </span>
				</div>
				<div class="col-md-4">
					<label>Chamber of Commerce Certificate *</label>
					<input type="file" class="form-control mb-0" name="">
					<span class="fo-12">JPG, PDF, PNG Allowed </span>
				</div>
				<div class="col-md-4">
					<label>Other Documents  *</label>
					<input type="file" class="form-control mb-0" name="">
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