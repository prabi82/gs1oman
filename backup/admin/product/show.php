<?php
include("../include/function.php");
if($_SESSION['email']=="")
{
header('location:../login.php');
}
#$useremail = $_GET['useremail'];
#$username = $_GET['username'];
 
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
<link rel="shortcut icon" href="<?=$base_url?><?=$rows_website['favicon']?>" />

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
<li class="breadcrumb-item"><a href="#">Registration</a></li>
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
<a href="#" >
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


<!-------------------------------------- Revenue Filter Start----------------------------- --->
<div class="row gutters">
<!-- Start  col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 Start --->
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">

<!-- Form Start  --->
<form method="POST" enctype="multipart/form-data" action="">

<!-- Card Start -->
<div class="card m-0">
 
<!-- Start Card Body ---->
<div class="card-body">

<!-- Start gutters ---->
<div class="row gutters" >
 

<!-- 2nd Col-4 Start ---->
<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3" >

<!-- Form Group Start -->     
<div class="form-group">
<label for="inputName" class="col-form-label">Status</label>
<select name="stype" class="form-control" required="">
<option disabled selected>Please Select </option>
<option value="">All</option>
<option value="0">Pending Approval</option>
<option value="1">Approved</option>
<option value="2">Rejected</option>
<option value="3">Disabled</option>
</select>



</div>
<!-- Form Group Wrap --> 


</div>
<!-- 2nd Col-4 Wrap ---->


<!-- last Col-2 Start ---->
<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 mt-4">

<!-- Form Group Start -->     
<div class="form-group">

<input type="submit" name="search" class="btn btn-success" value="Filter">
<a href="show.php?page=REV"><input type="button" name="Reset" class="btn btn-warning" value="Reset"></a>
<br>

</div>
<!-- Form Group Wrap --> 


</div>
<!-- last Col-2 Wrap ---->

 
</div>
<!-- Wrap gutters ---->
 
</div>
<!--  Card Body Wrap ---->


</div>
<!-- Card Wrap -->



</form>
<!-- Form Wrap Close  --->


</div>
</div>
<!-- Wrap / Close col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  --->

<!-- ---------------Revenuue Filter Wrap / Close-------------------------- --->
 
<!-- Row start -->
<div class="row gutters">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

<div class="table-container">
<form method="post">

<div class="row t-header">
<div class="col-md-2">
<div class="t-header">Manage Product</div>
</div>

<div class="col-md-7">

</div>

</div>

</form>

<div class="table-responsive">
<table id="basicExample" class="table custom-table">
<thead>
<tr> 
<th>Sno</th>
<th>Company Name</th>
<th>Email</th>
<th>Phone Number</th>
<th>Registration Date</th>
<th>Status</th>
<th>Action</th> 
</tr>
</thead>
<tbody>

<?php
if(isset($_POST['search'])){

$stype=$_POST['stype'];

if($stype!=''){
$query=mysqli_query($conn, "SELECT  * FROM `order_tbl` WHERE `status`='$stype'") or die(mysqli_error());
}
else{
$query=mysqli_query($conn, "SELECT  * FROM `order_tbl`") or die(mysqli_error());
}
$row=mysqli_num_rows($query);
if($row>0){
$n=1;
while($fetch=mysqli_fetch_array($query)){
$category_name=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `company_tbl` WHERE id='".$fetch['company_id']."'"));
$status=$fetch['status'];
$bid=$fetch['id'];
$year=date("Y", strtotime($fetch['order_date']));
$month=date("M", strtotime($fetch['order_date']));
$date=date("d", strtotime($fetch['order_date']));

?>

<tr> 
		<td><?php echo $n; $n++;?></td>
		<td><?php echo $category_name['name']?></td>
		<td><?php echo $category_name['user_email']?></td>
		<td><?php echo $category_name['mobile_number']?></td>
		<td><?=$date?>/<?=$month?>/<?=$year?></td>
		
 	<td>
<?php
if($status==0){
echo"<span class='badge badge-warning'>Pending</span>";
}
elseif($status==1){
echo"<span class='badge badge-success'>Approved</span>";
}
elseif($status==2){
echo"<span class='badge badge-danger'>Rejected</span>";
}
elseif($status==3){
echo"<span class='badge badge-light'>Disabled</span>";
}
?>	

</td>


	<td><a href="edit.php?view_id=<?=$fetch['company_id']?>&&id=<?=$fetch['id']?>&&page=PROT"><span class='badge badge-warning'>Edit</span>|<a href="view.php?view_id=<?=$fetch['company_id']?>&&page=PROT"><span class='badge badge-info'>View</span>|<a href="show?image_id=<?php echo $bid; ?>&&page=REV"><span class='badge badge-danger'>Delete</span></a></td>
 
</tr>
<?php
			}
		}else{
			echo'
			<tr>
				<td colspan = "4"><center>Record Not Found</center></td>
			</tr>';
		}
	}else{
		$query=mysqli_query($conn, "SELECT * FROM `order_tbl`") or die(mysqli_error());
		$n=1;
		while($fetch=mysqli_fetch_array($query)){
			$category_name=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `company_tbl` WHERE id='".$fetch['company_id']."'"));
			$status=$fetch['status'];
			$bid=$fetch['id'];
			$year=date("Y", strtotime($fetch['order_date']));
$month=date("M", strtotime($fetch['order_date']));
$date=date("d", strtotime($fetch['order_date']));
?>
	<tr>
		<td><?php echo $n; $n++;?></td>
	 
		<td><?php echo $category_name['name']?></td>
		<td><?php echo $category_name['user_email']?></td>
		<td><?php echo $category_name['mobile_number']?></td>
		<td><?=$date?>/<?=$month?>/<?=$year?></td>
		

<td>
<?php
if($status==0){
echo"<span class='badge badge-warning'>Pending</span>";
}
elseif($status==1){
echo"<span class='badge badge-success'>Approved</span>";
}
elseif($status==2){
echo"<span class='badge badge-danger'>Rejected</span>";
}
elseif($status==3){
echo"<span class='badge badge-light'>Disabled</span>";
}
?>	

</td>


<td><a href="edit.php?view_id=<?=$fetch['company_id']?>&&id=<?=$fetch['id']?>&&page=PROT"><span class='badge badge-warning'>Edit</span>|<a href="view.php?view_id=<?=$fetch['company_id']?>&&page=PROT"><span class='badge badge-info'>View</span></a>|<a href="show?image_id=<?php echo $bid; ?>&&page=REV"><span class='badge badge-danger'>Delete</span></a></td>
		 
		  
	</tr>
<?php
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
</div>
<!-- Content wrapper end -->


</div>
<!-- *************
************ Main container end *************
************* -->
<?php
if(!empty($_GET['image_id']))
{
$id=$_GET['image_id'];
$sql_f="SELECT c.* , o.*,cc.* FROM company_tbl c,order_tbl o, company_contacts_tbl cc WHERE c.id=o.company_id AND c.id=cc.company_id";

#$sql_f="SELECT * FROM `product_tbl` WHERE  id ='$id'";// use for delete image from folder 
$query_f=mysqli_query($conn,$sql_f);
while($wo=mysqli_fetch_array($query_f))
{
#$image_name=$wo['image'];
}
$s="DELETE c.* , o.*,cc.* FROM company_tbl c,order_tbl o, company_contacts_tbl cc WHERE c.id=o.company_id AND c.id=cc.company_id";
$q=mysqli_query($conn,$s);
$query=mysqli_query($conn,$s) or die(mysqli_error($conn));
if($query)
{
	
echo
"<script>window.location='show.php?page=REV'</script>";
$_SESSION['message']="Record Deleted Successfully";
}
}

?>

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