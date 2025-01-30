<?php
include("../include/function.php");
if($_SESSION['email']=="")
{
header('location:../login.php');
}

if(isset($_POST['submit']))
{
$from_name=$_POST['from_name'];
$email=$_POST['email'];
$admin_email=$_POST['admin_email'];
$cc_email=$_POST['cc_email'];
$bcc_email=$_POST['bcc_email'];
$common_message=$_POST['common_message'];
$website_email_title=$_POST['website_email_title'];
$website_signature=$_POST['website_signature'];

$sql="UPDATE `email_setting` SET `from_name`='$from_name',`from_email`='$email',`admin_email_id`='$admin_email',`cc_email_id`='$cc_email',`bcc_email_id`='$bcc_email',`website_email_title`='$website_email_title',`website_signature`='$website_signature',`common_message`='$common_message' WHERE `id`=1";

$query=mysqli_query($conn,$sql)or die(mysqli_error($conn));
if($query)
{

$_SESSION['message']="Email Configuration is Updated";


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
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="../../images/Upload/logo/logo.png" />

	<!-- Title -->
	<title><?php title(); ?> -Email Config</title>


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
					<li class="breadcrumb-item">Other Setting</li>
					<li class="breadcrumb-item active">Email Configration</li>
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

				<div class="row justify-content-center gutters">
					<div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12">
					<?php
					$sql="SELECT * FROM `email_setting`";
					$query=mysqli_query($conn,$sql);
					$row=mysqli_fetch_array($query);
					?>
						<form method="post">
							<div class="card m-0">
								<div class="card-header">
									<div class="card-title">Email Configration</div>
									

									<ul class="text-muted custom">
										<li><span style="color:red;">*</span> Set Email Configration As per your requirement </li>
									</ul>
								</div>
								<?php if(isset($_SESSION['message']))
							{
							echo "
							<div class='col-md-12' 
							style='background: #90eb90';>
							<p style='color: #0b840b;text-align: center;'>".$_SESSION['message']."</p>
							</div>";
							}
							unset($_SESSION['message']); ?>
								<div class="card-body">
									
									<div class="row gutters">
										<div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
											<div class="form-group">
												<label for="inputName" class="col-form-label">From Name</label>
												<input type="text" class="form-control" id="inputName" placeholder="From Name" name="from_name" value="<?php echo $row['from_name']; ?>">
											</div>
											<div class="form-group">
												<label for="inputEmail" class="col-form-label">From E-mail</label>
												<input type="email" class="form-control" id="inputEmail" placeholder="Your E-mail" name="email" value="<?php echo $row['from_email']; ?>">
											</div>
											<div class="form-group">
												<label for="inputMobNumber" class="col-form-label">Admin Email Id</label>
												<input type="text" class="form-control" id="inputMobNumber" placeholder="Admin Email" name="admin_email" value="<?php echo $row['admin_email_id']; ?>">
											</div>
												
										
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group">
												<label for="inputMobNumber" class="col-form-label">CC Email Id</label>
												<input type="text" class="form-control" id="inputMobNumber" placeholder="CC Email" name="cc_email" value="<?php echo $row['cc_email_id']; ?>">
											</div>
											<div class="form-group">
												<label for="inputSubject" class="col-form-label">BCC Email Id</label>
												<input type="text" class="form-control" id="inputSubject" placeholder="BCC Email" name="bcc_email" value="<?php echo $row['bcc_email_id']; ?>">
											</div>
										
												<div class="form-group" style="display:none">
												<label for="inputSubject" class="col-form-label">Email Title</label>
												<input type="text" class="form-control" id="inputSubject" placeholder="Email Title" name="website_email_title" value="<?php echo $row['website_email_title']; ?>">
											</div>
												
											<div class="form-group" style="display:none">
												<label for="inputMessage" class="col-form-label">Common Message</label>
												<textarea class="form-control"  placeholder="Common Message"  rows="6" name="common_message"><?php echo $row['common_message']; ?></textarea>
												
											</div> 
											
											<div class="form-group" style="display:none">
												<label for="inputMessage" class="col-form-label">Website Email Signature</label>
												<textarea class="form-control" placeholder="Email Signature"  rows="4" name="website_signature"><?php echo $row['website_signature']; ?></textarea>
											
											</div>
										</div>
									</div>
									
									<div class="row gutters">
										<div class="col-xl-12">
											<input type="submit" id="submit" name="submit" class="btn btn-primary" value="Submit">
											
										</div>
										
									</div>

								</div>
							</div>
						</form>
						
					</div>
				</div>


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