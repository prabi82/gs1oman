<?php
include("../include/function.php");
if($_SESSION['email']=="")
{
header('location:../login.php');
}

#$_SESSION['name']=$_GET['id'];
?>
<!doctype html>
<html lang="en">

<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Meta -->
<meta name="description" content="Responsive Bootstrap4 Dashboard Template">
<meta name="author" content="ParkerThemes">
<link rel="shortcut icon" href="../../images/Upload/logo/logo.png" />

<!-- Title -->
<title><?php title(); ?></title>


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
<li class="breadcrumb-item">Home</li>
<li class="breadcrumb-item"><a href="show.php?page=Pack">Product</a></li>

<li class="breadcrumb-item active">
</li>
</ol>

<ul class="app-actions">
<li>
<a href="#" >
<?php echo date("d/m/Y"); ?>
</a>
</li>
<li>
<a href="manage_event.php?page=HM" >
Back
</a>
</li>

</ul>
</div>
<!-- Page header end -->
<div class="col-md-12" style="height:40px;">
<?php if(isset($_SESSION['message']))
{
echo "
<div id='alert' class='col-md-12 alert alert-success alert-dismissible fade show' role='alert' style='background:#51a362;'>
<p style='color:#e9f1eb; text-align:center; !important;'>".$_SESSION['message']."</p>
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
</div>";
}
unset($_SESSION['message']); ?>
</div>

<!-- Content wrapper start -->
<div class="content-wrapper">

<!-- Row start -->
<div class="row gutters">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

<div class="table-container">
<form method="post">

<div class="row t-header">

<div class="col-md-6">
<div class="t-header">Manage Product</div>
</div>

<div class="col-md-6" style="display:flex; flex-direction: row-reverse;" >
<a href="add.php?page=PD"><input type="button" name="submit" class="btn btn-success" value="Add" ></a>
</div>



</div>

</form>

<div class="table-responsive">
<table id="basicExample" class="table custom-table">
<thead>
	<tr> 
		<th>Sno</th>
		<th>Gtins Product Name</th>
		<th>Gtins Name</th>
		<th>Gtins Registration Fee</th>
		<th>Gtins Annual Fee</th>
		<th>Gln Annual Fee</th>
		<th>Sscc Annual Fee</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
</thead>
<tbody>
<?php
$sql="SELECT * FROM `product_tbl`  ORDER BY id ASC";
$query=mysqli_query($conn,$sql)or die(mysqli_error($conn));
$n=1;
while($row=mysqli_fetch_array($query))
{
	$product_name=$row['product_name'];
	$gtins_name=$row['gtins_name'];
	$registration_fee=$row['registration_fee'];
	$gtins_annual_fee=$row['gtins_annual_fee'];
	$gln_annual_fee=$row['gln_annual_fee'];
	$sscc_annual_fee=$row['sscc_annual_fee'];
	$status=$row['status'];
	$bid=$row['id'];
?>
<tr>
<td><?php echo $n; $n++;?></td>
<td><?php echo $product_name ;?></td>
<td><?=$gtins_name;?></td>
<td><?=$registration_fee;?></td>
<td><?=$gtins_annual_fee;?></td>
<td><?=$gln_annual_fee;?></td>
<td>
<?php 
if($sscc_annual_fee==0)
{
echo "-";
}
else
{
echo $sscc_annual_fee;
}
?>
</td>

	


<td>
<?php 
if($status==0)
{
echo "<span class='badge badge-danger'>Hide</span>";
}
else
{
echo "<span class='badge badge-success'>Show</span>";
}
?>
</td>
		
		
		
<td>
<a href="edit.php?id=<?php echo $bid;?>&&page=PD"><span class='badge badge-success'>Edit</span></a>|

<a href="show.php?image_id=<?php echo $bid; ?>&&page=PD"><span class='badge badge-danger'>Delete</span></a>


</td>
		
	</tr>
<?php  } ; ?>


<?php
if(!empty($_GET['image_id']))
{
$id=$_GET['image_id'];
$sql_f="SELECT * FROM `product_tbl` WHERE  id ='$id'";// use for delete image from folder 
$query_f=mysqli_query($conn,$sql_f);
while($wo=mysqli_fetch_array($query_f))
{
$image_name=$wo['image'];
unlink("../$image_name");// use for delete image from folder 
}
$s="DELETE FROM `product_tbl` WHERE id='$id'  ";
$q=mysqli_query($conn,$s);
$query=mysqli_query($conn,$s) or die(mysqli_error($conn));
if($query)
{
	
echo
"<script>window.location='show.php?page=PD'</script>";
$_SESSION['message']="Product Deleted Successfully";
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
<script type="text/javascript">
        setTimeout(function () {
  
            // Closing the alert
            $('#alert').alert('close');
        }, 2000);
    </script>


<!-- Required jQuery first, then Bootstrap Bundle JS -->
<?php include("../include/table_js.php"); ?>

</body>

</html>