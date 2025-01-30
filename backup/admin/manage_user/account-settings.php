<?php
include("../include/function.php");
if($_SESSION['email']=="")
{
	header('location:../login.php');
}

	if(isset($_POST['submit']))
	{
	$id=$_GET['id'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$role=$_POST['role'];
	$password2=$_POST['password'];
	$password=sha1($password2);
	$user_name=$_POST['user_name'];
	$status=$_POST['status'];
	
	$img_name=$_FILES['profile_image']['name'];
	$img_tmp_name=$_FILES['profile_image']['tmp_name'];
	$img_path="../../images/Upload/admin/".$img_name; 
	$img_path2=substr($img_path,6);
	
	if(!empty($img_name))
	{
		move_uploaded_file($img_tmp_name,$img_path);
		$sql="UPDATE `admin_tbl` SET `image`='$img_path2' WHERE admin_id='$id'";
		$query=mysqli_query($conn,$sql)or die(mysqli_error($conn));
	}
	if(!empty($password))
	{
		$sql="UPDATE `admin_tbl` SET `password`='$password',`password2`='$password2' WHERE admin_id='$id'";
		$query=mysqli_query($conn,$sql)or die(mysqli_error($conn));
	}

	$sql="UPDATE `admin_tbl` SET `username`='$user_name',`name`='$name',`email_id`='$email',`roles`='$role',`status`='$status' WHERE admin_id='$id'";	
	
	$query=mysqli_query($conn,$sql)or die(mysqli_error($conn));
	if($query)
	{
		$_SESSION['message']="Account Setting is Updated Successfully";
		echo"<script>window.location='manage_admin.php?page=OS';</script>";
	}
	else{
		
		echo"<script>alert('Something Wrong');</script>";
		

	}
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
		<title><?php title(); ?> - Account Settings</title>


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
						<li class="breadcrumb-item active">Account Settings</li>
					</ol>

					<ul class="app-actions">
						<li>
							<a href="#" >
								<?php date_time(); ?>
							</a>
						</li>
						
					</ul>
				</div>
				<!-- Page header end -->


				<!-- Content wrapper start -->
				<div class="content-wrapper">
			<?php
			$id=$_GET['id'];
			$sql="SELECT * FROM `admin_tbl` WHERE admin_id ='$id'";
			$query=mysqli_query($conn,$sql)or die(mysqli_error($conn));
			$n=1;
			$row=mysqli_fetch_array($query)

				?>
					<!-- Row start -->
					<div class="row gutters">
						<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
							<div class="card h-100">
								<div class="card-body">
									<div class="account-settings">
										<div class="user-profile">
											<div class="user-avatar">
												<img src="<?php echo $base_url.$row['image'];?>" alt="" style="height:90px; width:90px;" />
											</div>
											<h5 class="user-name"><?php echo $row['username'];?></h5>
											<h6 class="user-email"><?php echo $row['email_id'];?></h6>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12">
							<div class="card h-100">
								<div class="card-header">
									<div class="card-title">Update Profile</div>
								</div>
								<div class="card-body">
								<form method="post" enctype="multipart/form-data">
									<div class="row gutters">
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
											<div class="form-group">
												<label for="fullName">Full Name</label>
												<input type="text" class="form-control" id="fullName" placeholder="Enter full name" value="<?php echo $row['name'];?>" name="name">
											</div>
											<div class="form-group">
												<label for="eMail">Email</label>
												<input type="email" class="form-control" id="eMail" placeholder="Enter email ID" value="<?php echo $row['email_id'];?>" name="email">
											</div>
											<div class="form-group">
												<label for="addRess">Admin Roles</label>
												<select name="role" class="form-control" >
												<?php
													
													if($row['role']=='Admin')
													{
														echo "<option selected value='Admin'>Admin</option>
															<option>Super Admin</option>";
													}
													else{
														echo "<option>Admin</option>
															<option selected value='Super Admin'>Super Admin</option>";
													}
													?>
												</select>
											</div>
											<div class="form-group">
												<label for="addRess">Change Password</label>
												<input type="password" class="form-control" id="addRess" placeholder="Change Password" name="password" value="<?php echo $row['password2'];?>">
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
											
											<div class="form-group">
												<label for="ciTy">User Name</label>
												<input type="name" class="form-control" id="ciTy" placeholder="Enter City" value="<?php echo $row['username'];?>" name="user_name">
											</div>
											<div class="form-group">
												<label for="sTate">Status</label>
													<select name="status" class="form-control">
													<?php
													
													if($row['status']==1)
													{
														echo "<option value='1' selected>Active</option>
															<option value='0'>Inactive</option>";
													}
													else{
														echo "<option value='1' >Active</option>
															<option value='0' Inactive selected>Inactive</option>";
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