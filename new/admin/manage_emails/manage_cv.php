<?php
include("../include/function.php"); 
if($_SESSION['Vstore_email']=="")
{
	header('location:../login.php');
}
?>

<?php
if(!empty($_GET['image_id']))
{
$id=$_GET['image_id'];										
$s="DELETE FROM `career` WHERE id='$id'";
$q=mysqli_query($conn,$s);
$query=mysqli_query($conn,$s) or die(mysqli_error($conn));
if($query)
{
echo "<script>window.location='manage_cv.php?page=ENQ';</script> ";
$_SESSION['message']="Record Deleted Successfully";
}
}
?>

<!doctype html>
<html lang="en">

<head>
		
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Meta -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="../images/Upload/logo/logo.png" />

<!-- Title -->
<title><?php title(); ?> - Manage Resume</title>
<?php include("../include/table_css.php"); ?>
</head>
<body>
<!-- Loading ends -->


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

		
<div class="container-fluid">

<!-- Navigation start -->
<?php include("../include/menu_navbar.php"); ?>
<!-- Navigation end -->

<div class="main-container">

<!-- Page header start -->
<div class="page-header">
<ol class="breadcrumb">
<li class="breadcrumb-item">Career</li>
<li class="breadcrumb-item active"> Manage Career</li>
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

								
<div class="table-responsive">
<table id="basicExample" class="table custom-table">
<thead>
<tr>
<th>S.No.</th>
<th>Name</th>
<th>Email</th>
<th>Contact Number</th>
<th>Position</th>
<th>Size</th>

<th>Downlod</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php 
$sql=mysqli_query($conn,"SELECT * FROM career ");
while($file=mysqli_fetch_array($sql)){
?>
    <tr>
      <td><?php echo $file['id']; ?></td>
      <td><?php echo $file['fname']; ?></td>
      <td><?php echo $file['email']; ?></td>
      <td><?php echo $file['phone']; ?></td>
       <td><?php echo $file['position']; ?></td>
      <td><?php echo floor($file['size'] / 1000) . ' KB'; ?></td>
      <td><a href="../uploads/<?php echo $file['name']; ?>" download>Download</a></td>
      <td><a href="manage_cv.php?image_id=<?php echo $file['id']; ?>&&page=ENQ"><span class="badge badge-danger">Delete</span></a></td>
    </tr>
  <?php } ?>

<tr>


</tr>

										
										
											
											
</tbody>

</table>

</div>

</div>

</div>

</div>
					 
					

</div>



</div>
			
<!-- Footer start -->
<?php include("../include/footer.php"); ?>
<!-- Footer end -->
			

</div>

		
<?php include("../include/table_js.php"); ?>

</body>

</html>