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
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="../images/Upload/logo/logo.png" />

		<!-- Title -->
		<title><?php title(); ?> - Manage Enquiry</title>


		<!-- *************
			************ Common Css Files *************
		************ -->
		<!-- Bootstrap css -->
		<?php include("../include/table_css.php"); ?>


	</head>
	<body>

		
		<!-- Loading ends -->
		

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
						<li class="breadcrumb-item">ENQUIRY</li>
						<li class="breadcrumb-item active"> Manage Enquiry</li>
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
<?php if(isset($_SESSION['message']))
{
echo "
<div class='col-md-12' 
style='background: #90eb90';>
<p style='color: #0b840b;text-align: center;'>".$_SESSION['message']."</p>
</div>";
}
unset($_SESSION['message']); ?>
					<!-- Row start -->
					<div class="row gutters">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							
							<div class="table-container">
							
							<?php  
        
        $query = "SELECT * FROM enquiry ORDER BY id DESC";     
        $rs_result = mysqli_query ($conn, $query);    
    ?> 
								
								<div class="table-responsive">
									<table id="basicExample" class="table custom-table">
										<thead>
											<tr>
												<th>S.No.</th>
												<th>E.Type</th>
												<th>Name</th>
												<th>Email</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										
										$n=1;
										while($row=mysqli_fetch_array($rs_result))
										{
											$name=$row['name'];
											$email=$row['email'];
											#$contact_number=$row['contact_number'];
											$etype=$row['etype'];
											$id=$row['id'];
										?>
											<tr>
												<td><?php echo $n; $n++;?></td>
												<td><?php if($etype==1) { echo "Contact Us"; }
												
												 
												 else if($etype==2) { echo "Appointment"; } ?>
													
												</td>

												<td><?php echo $name;?></td>
												<td><?php echo $email;?></td>
												
												<td><a href="contact_view.php?id=<?php echo $id;?>&&page=ENQ"><span class="badge badge-primary">View</span></a>|<a href="manage_enquiry.php?image_id=<?php echo $id; ?>&&page=ENQ"><span class="badge badge-danger">Delete</span></a><!--|<a href=""><span class="badge badge-success">Reply</span></a>--></td>
											</tr>
										<?php } ?>
										
										<?php
										if(!empty($_GET['image_id']))
										{
											$id=$_GET['image_id'];
											
										$s="DELETE FROM `enquiry` WHERE id='$id'";
										$q=mysqli_query($conn,$s);
										$query=mysqli_query($conn,$s) or die(mysqli_error($conn));
										if($query)
										{
										echo "<script>window.location='manage_enquiry.php?page=ENQ';</script> ";
										$_SESSION['message']="Data Is Deleted Successfully";
										}
										}
										
										?>
											
											
										</tbody>
									</table>
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
		<?php include("../include/table_js.php"); ?>

	</body>

</html>