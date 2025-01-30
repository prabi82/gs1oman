<?php
error_reporting(0);
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
		<title><?php title(); ?> - Manage Admin</title>


		<!-- *************
			************ Common Css Files *************
		************ -->
		<!-- Bootstrap css -->
		<?php include("../include/table_css.php");include("../include/checkbox.php");?>


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
						<li class="breadcrumb-item">Manage User</li>
						<li class="breadcrumb-item active">User</li>
					</ol>
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
							<form method="post" >
							<?php  
							if($_SESSION['roles']=='Super Admin')
							{
								echo "
							<div class='row t-header'>
								<div class='col-md-2'>
									<div class='t-header'>Manage Admin</div>
								</div>

								<div class='col-md-1'>
								<a href='add_admin_form.php'><input type='button' name='submit' class='btn btn-success' value='Add Admin'></a>
								</div>
								<div class='col-md-1'>
								<input type='submit' name='delete' class='btn btn-danger' value='Delete'>
								</div>
							
							</div>
							";
							}
							?>
							
							<?php  

			if($_SESSION['roles']=='Super Admin')
			{
				$query = "SELECT * FROM admin_tbl ORDER BY admin_id DESC ";
			}
			else{
				$query = "SELECT * FROM admin_tbl WHERE roles='Admin' ORDER BY admin_id DESC ";     
			}
    
        
        $rs_result = mysqli_query ($conn, $query);    
    ?> 
								
								<div class="table-responsive">
									<table id="basicExample" class="table custom-table">
										<thead>
											<tr>
												<th><input type="checkbox" name="check[]" id="select_all" /></th>
												<th>Name</th>
												<th>User Name</th>
												<th>Email</th>
												<th>Status</th>
												<th>Type</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
										
										$n=1;
										while($row=mysqli_fetch_array($rs_result))
										{
											$username=$row['username'];
											$email_id=$row['email_id'];
											$status=$row['status'];
											$roles=$row['roles'];
											$admin_id=$row['admin_id'];
											$admin_name=$row['name'];
											
											
										?>
											<tr>
										
												<td><input type="checkbox" name="check[]" class="checkbox" value="<?php echo $admin_id;?>"/></td>
												<td><?php echo $admin_name;?></td>
												<td><?php echo $username;?></td>
												<td><?php echo $email_id;?></td>
												<td><?php
												 if($status==1)
												{ echo "Active"; }
												else { echo "Inactive" ;}
												?></td>
												<td><?php echo $roles;?></td>
												<td><a href="account-settings.php?id=<?php echo $admin_id;?>"><span class="badge badge-success">Edit</span></a>
												
											</tr>
										<?php } ?>
										
										<?php /*
										if(!empty($_GET['image_id']))
										{
											$id=$_GET['image_id'];
											
										$s="DELETE FROM `admin_tbl` WHERE admin_id ='$id'";
										$q=mysqli_query($conn,$s);
										$query=mysqli_query($conn,$s) or die(mysqli_error($conn));
										if($query)
										{
											$_SESSION['message']="Record Deleted";
										echo "<script>window.location='manage_admin.php';</script> ";
										}
										}
										
										*/?>
											
											
										</tbody>
									</table>
								</div>
							</form>
							
								<?php
							// Multiple Delete Function 
                                        if(isset($_POST['delete']))
                                        {
                                           $check= $_POST['check'];
										   if(empty($check))
										   {
											  echo"<script>alert('Please tick  the checkbox ');window.location='manage_admin.php';</script>"; 
										   }
										   else{
                                            for($i=0;$i<count($check);$i++)
                                            {
                                                $id=$check[$i];
												$sql_f="DELETE FROM `admin_tbl` WHERE admin_id ='$id'";// use for delete image from folder 
												$query_f=mysqli_query($conn,$sql_f);
												while($wo=mysqli_fetch_array($query_f))
												{
													$image_name=$wo['image'];
													
												
												unlink("../../$image_name");// use for delete image from folder 
												}
                                                $s="DELETE FROM `admin_tbl` WHERE `admin_id`='$id'";
                                                $q=mysqli_query($conn,$s);
												if($q)
												{
													echo"<script>alert('Records Deleted');window.location='manage_admin.php';</script>";
												}

                                            }
                                        }
										}
										?>

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