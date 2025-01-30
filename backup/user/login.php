<?php
include ("include/config.php");
	
			if(isset($_POST['submit']))
			{
				
				
				$email=$_POST['email'];
				$password=sha1($_POST['password']);
		
				$sql="SELECT * FROM `company_tbl` WHERE  user_email='$email' && password='$password' AND status=1";
				$query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
				$row_user=mysqli_fetch_array($query);

				if(mysqli_num_rows($query)>0)
				{
					$_SESSION['user_email']=$row_user['user_email'];
					echo"<script> window.location='index.php';</script>";
				}
			else
				{
				echo "<span style='color:red;'>Check User Email and Password</span>";
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
		<?php
		$sq="SELECT * FROM `system_settings` WHERE id = 1";
		$q=mysqli_query($conn,$sq);
		$r=mysqli_fetch_array($q)
		?>
		<title><?php echo $r['website_name']; ?> -  Login</title>
		
		<!-- *************
			************ Common Css Files *************
		************ -->
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />

		<!-- Master CSS -->
		<link rel="stylesheet" href="css/main.css" />

	</head>

	<body class="authentication">

		<!-- Container start -->
		<div class="container">

			<form method="post">
				<div class="row justify-content-md-center">
					<div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
						<div class="login-screen">
							<div class="login-box text-center">
							<?php
								$sql="SELECT * FROM `system_settings` WHERE id=1";
								$query=mysqli_query($conn,$sql);
								$adminrow=mysqli_fetch_array($query);
								?>
								
									<img src="../<?php echo $adminrow['logo'];?>" alt="" class="img-fluid"/>
								
								
								<div class="form-group">
								    <h3 style="text-align:center;font-weight: 700;margin-bottom:25px; margin-top:25px;">User Login</h3>
									<input type="text" class="form-control" placeholder="Email Address" name="email">
								</div>
								<div class="form-group">
									<input type="password" class="form-control" placeholder="Password"  name="password">
								</div>
								<div style="text-align:center">

									<input type="submit" name="submit"class="btn btn-primary" value="Login">
									
								</div>
								
								<div style="text-align:center" class="mt-2">
                                   <a href="<?=$adminrow['website_url']?>"><span class="text-danger h6">New User</span></a>&nbsp; | &nbsp; <a href="#" class="text-danger h6"><span>Forgot Password</span></a>
									
									
								</div>
							
								<hr>
								
							</div>
						</div>
					</div>
				</div>
			</form>
		

		</div>
		<!-- Container end -->

	</body>

</html>