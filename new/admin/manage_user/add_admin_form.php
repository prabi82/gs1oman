<?php
include("../include/function.php");
if($_SESSION['email']=="")
{
	header('location:../login.php');
}
?>

<!doctype html>
<html lang="en">

<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Meta -->
		<meta name="description" content="Responsive Bootstrap4">
		<meta name="author" content="">
		<link rel="shortcut icon" href="../../images/Upload/logo/logo.png" />

		<!-- Title -->
		<title><?php title(); ?> - Admin Form</title>


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
		<!-- Quick settings end -->

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
						<li class="breadcrumb-item">Admin</li>
						<li class="breadcrumb-item active">Add Admin</li>
					</ol>

					<ul class="app-actions">
						<li>
							<a href="#" >
								<span class="range-text"></span>
								<i class="icon-chevron-down"></i>	
							</a>
						</li>
						<li>
							<a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print">
								<i class="icon-print"></i>
							</a>
						</li>
						<li>
							<a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download CSV">
								<i class="icon-cloud_download"></i>
							</a>
						</li>
					</ul>
				</div>
				<!-- Page header end -->


				<!-- Content wrapper start -->
				<div class="content-wrapper">

					<!-- Row start -->
					<div class="row gutters">
						
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="card h-100">
								<div class="card-header">
									<div class="card-title">Add Admin</div>
								</div>
								<div class="card-body">
								<form method="post" enctype="multipart/form-data">
									<div class="row gutters">
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
											<div class="form-group">
												<label for="fullName">Full Name</label>
												<input type="text" class="form-control" id="fullName" placeholder="Full Name"  name="name">
											</div>
											<div class="form-group">
												<label for="eMail">Email</label>
												<input type="email" class="form-control" id="eMail" placeholder="Enter ID" name="email">
											</div>
											<div class="form-group">
												<label for="addRess">Admin Roles</label>
												<select name="role" id="order_status_id" class="form-control">
											<option>Admin</option>
											<option>Super Admin</option>
											</select>
												
											</div>
											<div class="form-group">
												<label for="addRess">Make Password</label>
												<input type="text" class="form-control" id="addRess" placeholder="Make Password" name="password">
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
											
											<div class="form-group">
												<label for="ciTy">User Name</label>
												<input type="name" class="form-control" id="ciTy" placeholder="User Name"  name="user_name">
											</div>
											<div class="form-group">
												<label for="sTate">Status</label>
													<select name="status" class="form-control">
													<?php
													if($prow['status']==1)
													{
														echo "<option value='1' selected>Active</option>
															<option value='0'>Inactive</option>";
													}
													else{
														echo "<option value='1' >Active</option>
															<option value='0' Inactive>Inactive</option>";
													}
													?>
													</select>
											</div>
											<div class="form-group">
												<label for="ciTy">Profile Image</label>
												<input type="file" class="form-control" id="ciTy" placeholder="Image" name="profile_image">
											</div>
										
										</div>
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
											<div class="text-right">
											<input type="submit" name="submit" class="btn btn-success"></button>
												<button type="button" id="submit" name="submit" class="btn btn-dark" onclick="window.location.href='manage_admin.php';">Cancel</button>
												
											</div>
										</div>
									</div>
								</form>
								<?php
						if(isset($_POST['submit']))
						{
						$name=$_POST['name'];
						$email=$_POST['email'];
						$role=$_POST['role'];
						$password2=$_POST['password'];
						$password=sha1($password2);
						$user_name=$_POST['user_name'];
						$status=$_POST['status'];
						
						$img_name=$_FILES['profile_image']['name'];
						$img_tmp_name=$_FILES['profile_image']['tmp_name'];
						$img_path2="../images/Upload/admin/".$img_name;
						if(empty($img_tmp_name))
						{	
						    $img_path="images/Upload/admin.png";
						    }
						    else{
						        $img_path=substr($img_path2,0,3);
						        }
												
						move_uploaded_file($img_tmp_name,$img_path);
						$sql="INSERT INTO `admin_tbl`(`username`, `name`, `image`, `email_id`, `password`, `password2`, `roles`, `status`) VALUES ('$user_name','$name','$img_path','$email','$password','$password2','$role','$status')";
						
						$query=mysqli_query($conn,$sql)or die(mysqli_error($conn));
						if($query)
						{							$_SESSION['message']="Admin is Added Successfully";
							echo "<script>window.location.href='manage_admin.php';</script>";
						}
						else{
							echo "<script>alert('Something is Wrong');</script>";
						}
						}
						?>
								</div>
							</div>
						</div>
					</div>
					<!-- Row end -->

				</div>
				<!-- Content wrapper end -->


			</div>
			<!-- *************
				************ Main container end *************
			************* -->


			<!-- Footer start -->
			<?php include("../include/footer.php"); ?>
			<!-- Footer end -->


		</div>

		<!-- *************
			************ Required JavaScript Files *************
		************* -->
		<!-- Required jQuery first, then Bootstrap Bundle JS -->
		<?php include ("../include/main_js.php"); ?>

	</body>

</html>