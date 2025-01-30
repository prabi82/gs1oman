<?php
include("../include/function.php");
if($_SESSION['user_email']=="")
{
header('location:../login.php');
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='downloadcsv'){
    if($_REQUEST['date1']!="" &&  $_REQUEST['date2']!=""){
    $date1 = date("Y-m-d", strtotime($_REQUEST['date1']));
$date2 = date("Y-m-d", strtotime($_REQUEST['date2']));
}
$ptype = $_REQUEST['ptype'];
 $sql_query = 'SELECT * FROM `order_tbl` WHERE 1=1';
if($date1!='' AND $date2!='' ){
   $sql_query .= " and date(`order_date`) BETWEEN '$date1' AND '$date2'";
}

if($ptype!='' ){
   $sql_query .= " and status= '".$ptype."'";
}

$query2 = $query= mysqli_query($conn, $sql_query) or die(mysqli_error());






$head = array();
while ($header=mysqli_fetch_field($query)){
    $head[] = $header->name;
}
 
 
 $table_name = 'revenue_report-'.date("d-m-Y-his");
$fp = fopen('php://output', 'w');
if ($fp ) {
    
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="'.$table_name.'.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, array_values($head)); 
    $i=1;
    while ($row2=mysqli_fetch_assoc($query2)) {
        fputcsv($fp, array_values($row2));
    }
   
}
exit;
}



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
<link rel="shortcut icon" href="<?=$base_url;?>images/Upload/logo/footer-logo.png" />

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
<li class="breadcrumb-item"><a href="#">Revenue</a></li>

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
<div class="row gutters">


<!--  Col-3 Start ---->
<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">

<!-- Form Group Start -->     
<div class="form-group">
<label for="inputName" class="col-form-label">Select</label>
<select name="ptype" class="form-control" required="">
	<option disabled selected>Please Select </option>
	<option value="">All</option>
	<option value="1">Knet</option>
	<option value="2">Cash</option>
</select>

</div>
<!-- Form Group Wrap --> 


</div>
<!-- Col-3 Wrap ---->




<!-- 1st Col-4 Start ---->
<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">

<!-- Form Group Start -->     
<div class="form-group">
<label for="inputName" class="col-form-label">Start Date</label>
<input class="form-control" type="date" name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" required="" >

</div>
<!-- Form Group Wrap --> 


</div>
<!-- 1st Col-4 Wrap ---->


<!-- 2nd Col-4 Start ---->
<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">

<!-- Form Group Start -->     
<div class="form-group">
<label for="inputName" class="col-form-label">End Date</label>
<input class="form-control" type="date" name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>" required="" >

</div>
<!-- Form Group Wrap --> 


</div>
<!-- 2nd Col-4 Wrap ---->


<!-- last Col-2 Start ---->
<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 mt-4">

<!-- Form Group Start -->     
<div class="form-group">

<input type="submit" name="search" class="btn btn-success" value="Filter">
<a href="revenue.php?page=REV"><input type="button" name="Reset" class="btn btn-warning" value="Reset"></a>
<br>

<a href="revenue.php?page=REV&action=downloadcsv&date1=<?=$_POST['date1']?>&date2=<?=$_POST['date2']?>&ptype=<?=$_POST['ptype']?>"><input type="button" name="Reset" class="btn btn-warning" value="Download CSV"></a>

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
<div class="t-header">Manage Revenue</div>
</div>

<div class="col-md-7">
<?php if(isset($_SESSION['message']))
{
echo "
<div class='col-md-12' 
style='background: #90eb90';>
<p style='color: #0b840b;text-align: center;'>".$_SESSION['message']."</p>
</div>";
}
unset($_SESSION['message']); ?>
</div>

</div>

</form>

<div class="table-responsive">
<table id="basicExample" class="table custom-table">
<thead>
<tr> 
<th>Sno</th>
<th>Order Id</th>
<th>Order Date</th>
<th>Player Name</th>
<th>Contact Number</th>
<th>Amount</th>
<th>Payment Mode</th>

</tr>
</thead>
<tbody>

<?php
if(isset($_POST['search'])){
$date1 = date("Y-m-d", strtotime($_POST['date1']));
$date2 = date("Y-m-d", strtotime($_POST['date2']));
$ptype = $_POST['ptype'];

  if($_REQUEST['date1']!="" &&  $_REQUEST['date2']!=""){
    $date1 = date("Y-m-d", strtotime($_REQUEST['date1']));
$date2 = date("Y-m-d", strtotime($_REQUEST['date2']));
}
$ptype = $_REQUEST['ptype'];
 $sql_query = 'SELECT * FROM `order_tbl` WHERE 1=1';
if($date1!='' AND $date2!='' ){
   $sql_query .= " and date(`order_date`) BETWEEN '$date1' AND '$date2'";
}

if($ptype!='' ){
   $sql_query .= " and status= '".$ptype."'";
}

$query=mysqli_query($conn, $sql_query) or die(mysqli_error());


$row=mysqli_num_rows($query);
if($row>0){
$n=1;
while($fetch=mysqli_fetch_array($query)){
$status=$fetch['status'];


?>

<tr> 
		<td><?php echo $n; $n++;?></td>
		<td><?php echo $fetch['order_id']?></td>
		<td><?php echo $fetch['order_date']?></td>
		<td><?php echo $fetch['player_name']?></td>
		<td><?php echo $fetch['player_number']?></td>
		<td><?php echo $fetch['total_price']?></td>
		
		<td>
<?php 
if($status==1)
{
echo "<span class='badge badge-info'>Knet</span>";
}
else
{
echo "<span class='badge badge-success'>Cash</span>";
}
?>			
</td>
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
			$status=$fetch['status'];
?>
	<tr>
		<td><?php echo $n; $n++;?></td>
		<td><?php echo $fetch['order_id']?></td>
		<td><?php echo $fetch['order_date']?></td>
		<td><?php echo $fetch['player_name']?></td>
		<td><?php echo $fetch['player_number']?></td>
		<td><?php echo $fetch['total_price']?></td>
		<td>
<?php 
if($status==1)
{
echo "<span class='badge badge-info'>Knet</span>";
}
else
{
echo "<span class='badge badge-success'>Cash</span>";
}
?>
			
				
			</td>
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