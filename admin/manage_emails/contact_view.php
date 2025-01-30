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
		<title><?php title(); ?> -Enquiry View</title>


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
						<li class="breadcrumb-item">Enquiry </li>
						<li class="breadcrumb-item">View</li>
					</ol>

					
				</div>
				<!-- Page header end -->


				<!-- Content wrapper start -->
				<div class="content-wrapper">


					<div class="row justify-content-center gutters">
						<div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12">
						<?php
						$id=$_GET['id'];
						$sql="SELECT * FROM `enquiry` WHERE id='$id'";
						$query=mysqli_query($conn,$sql);
						$row=mysqli_fetch_array($query);
						$etyp=$row['etype'];
						?>
							<form method="post" enctype="multipart/form-data">
								<div class="card m-0">
									<div class="card-header">
										<div class="card-title">Enquiry View</div>
										
									</div>
									<div class="card-body">
											<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
											    
                                    <?php
                                    if($etyp==1)
                                    {
                                    ?>
												<div class="form-group">
													<b>Name:</b><?php echo $row['name'];?><br>
													<b>Email:</b><?php echo $row['email'];?><br>
													<b>Subject:</b><?php echo $row['subject'];?><br>
													
													
												</div>
												
												<div class="form-group">
													<label for="inputEmail" class="col-form-label">Message</label>
													<textarea class="form-control" id="message" placeholder="Meta Keyword"name="meta_keywords" rows="6" readonly><?php echo $row['message']; ?></textarea>
												</div>
												<?php
                                    }
                                    else
                                    {
												?>
									  <div class="form-group">
													<b>Name: </b><?php echo $row['name'];?><br>
													<b>Email: </b><?php echo $row['email'];?><br>
													<b>Phone: </b><?php echo $row['contact_number'];?><br>
													<b>Gender: </b><?php echo $row['gander'];?><br>
													<b>Treatment: </b><?php echo $row['treatment'];?><br>
													<b>Appoinment Date: </b><?php echo $row['appoinment_date'];?><br>
													
													
												</div>
									 <?php } ?>
												
												<div class="row gutters">
											<div class="col-xl-12">
												
												<a href="manage_enquiry.php?page=ENQ"><input type="button" name="cancel" class="btn btn-warning" value="Back"></a>
											</div>
											
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