<?php
include("../include/function.php");
if($_SESSION['email']=="")
{
header('location:../login.php');
}
error_reporting(0);

// Process bulk delete
if(isset($_POST['bulk_delete'])) {
    if(!empty($_POST['delete_ids'])) {
        $ids = implode(',', array_map('intval', $_POST['delete_ids']));
        
        // Start transaction
        mysqli_begin_transaction($conn);
        
        try {
            // First check if records exist
            $check_query = "SELECT COUNT(*) as count FROM company_tbl WHERE id IN ($ids)";
            $result = mysqli_query($conn, $check_query);
            $row = mysqli_fetch_assoc($result);
            
            if($row['count'] > 0) {
                // Delete from company_contacts_tbl first (child table)
                $delete_contacts = "DELETE FROM company_contacts_tbl WHERE company_id IN ($ids)";
                if(!mysqli_query($conn, $delete_contacts)) {
                    throw new Exception("Error deleting contact records");
                }
                
                // Delete from company_tbl (parent table)
                $delete_companies = "DELETE FROM company_tbl WHERE id IN ($ids)";
                if(!mysqli_query($conn, $delete_companies)) {
                    throw new Exception("Error deleting company records");
                }
                
                // If we get here, commit the changes
                mysqli_commit($conn);
                $_SESSION['message'] = "Selected records deleted successfully";
            } else {
                throw new Exception("No records found to delete");
            }
            
        } catch (Exception $e) {
            // An error occurred, rollback changes
            mysqli_rollback($conn);
            $_SESSION['message'] = "Error: " . $e->getMessage();
        }
        
        // Redirect to refresh the page
        echo "<script>window.location='show.php?page=REV';</script>";
        exit();
    } else {
        $_SESSION['message'] = "No records selected for deletion";
        echo "<script>window.location='show.php?page=REV';</script>";
        exit();
    }
}

$_SESSION['filter_status']=$_GET['stype'];
$_SESSION['filter_sdate1']=$_GET['sdate1'];
$_SESSION['filter_sdate2']=$_GET['sdate2'];
$_SESSION['filter_rfilter']=$_GET['rfilter'];
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
<!-- Update jQuery to latest version -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<!-- Title -->
<title><?php title(); ?></title>

<style>
/* Checkbox styling */
.checkbox-column {
    width: 50px !important;
    text-align: center !important;
}

.checkbox-column input[type="checkbox"] {
    width: 18px;
    height: 18px;
    margin: 0;
    padding: 0;
    cursor: pointer;
    opacity: 1;
    visibility: visible;
}

table.custom-table td input[type="checkbox"],
table.custom-table th input[type="checkbox"] {
    display: inline-block !important;
    width: 18px;
    height: 18px;
    margin: 0;
    padding: 0;
    cursor: pointer;
    opacity: 1;
    visibility: visible;
}

/* Delete button styling */
.bulk-delete-btn {
    margin-bottom: 15px;
    padding: 8px 15px;
}

/* Ensure table cells with checkboxes have proper padding */
table.custom-table td:first-child,
table.custom-table th:first-child {
    padding: 12px 8px !important;
    text-align: center !important;
    vertical-align: middle !important;
}

.bulk-action-btn {
    margin-bottom: 20px;
}
.select-all-checkbox {
    margin: 0;
    padding: 0;
}

.select-checkbox {
    width: 20px;
    height: 20px;
    cursor: pointer;
}
.delete-selected-btn {
    margin-bottom: 15px;
}

/* Ensure checkboxes are visible */
input[type="checkbox"] {
    display: inline-block !important;
    opacity: 1 !important;
    position: static !important;
    margin: 0 !important;
    width: 16px !important;
    height: 16px !important;
}

/* Style the checkbox column */
.table td:first-child,
.table th:first-child {
    width: 30px;
    text-align: center;
    vertical-align: middle;
}

/* Style the delete button */
.btn-danger {
    margin-bottom: 15px;
}

/* Add hover effect to rows */
.table tbody tr:hover {
    background-color: #f5f5f5;
}
</style>

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
<form method="GET" enctype="multipart/form-data" action="" name="upload_excel">

<!-- Card Start -->
<div class="card m-0">
 
<!-- Start Card Body ---->
<div class="card-body">

<!-- Start gutters ---->
<div class="row gutters" >
 


<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3" >
<!-- Form Group Start -->     
<div class="form-group">
<label for="inputName" class="col-form-label">Status</label>
<select name="stype" id="mySelect1" class="form-control">
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


<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3" >
<div class="form-group">
<label for="inputName" class="col-form-label">Date Range</label>
<select class="form-control" id="mySelect" name="rfilter">
	<option selected disabled>Please Select </option>
    <option value="All" >All</option>
	<option value="<?=date('M-Y')?>">This Month</option>
	<option value="6months" >6 Months</option>
	<option value="1year" >One Year</option>
	<option value="sdate">Custom</option>
</select>
</div>
</div>

<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3" id="custom" style="margin-top:32px;">
<div class="form-group" style="display:flex;"><input type="submit" name="search" class="btn btn-success mx-2" value="Filter">&nbsp;<a href="show.php?page=VS"><input type="button" name="Reset" class="btn btn-warning" value="Reset"></a></div>
</div>


<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3" style="display: flex;flex-direction: row-reverse; margin-top:34px;" > 
<div class="form-group">

<a href="exportData.php" class="btn btn-success"><i class="dwn"></i>Download Excel</a>
<a href="exportPdf.php" class="btn btn-danger"  download><i class="dwn"></i>Download Pdf</a>



</div>
</div>



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
<form method="post" action="bulk_delete.php" id="bulk_delete_form">
<div class="delete-selected-btn text-right">
    <button type="submit" name="bulk_delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete selected records?');">
        <i class="fa fa-trash"></i> Delete Selected
    </button>
</div>

<div class="table-responsive">
<table id="basicExample" class="table custom-table">
<thead>
<tr>
<th style="width: 30px; text-align: center;"><input type="checkbox" id="select_all"></th>
<th>SNO</th>
<th>NAME</th>
<th>COUNTRY</th>
<th>CR NUMBER</th>
<th>REGISTRATION DATE</th>
<th>FIRST USER</th>
<th>STATUS</th>
<th>ACTION</th>
</tr>
</thead>
<tbody>

<?php

if(isset($_GET['search'])){

$stype=$_GET['stype'];
$sdate1=$_GET['sdate1'];
$sdate2=$_GET['sdate2'];
$rfilter=$_GET['rfilter'];

//1st Condiotion
if(($stype!='') && ($sdate1=='') && ($sdate2=='')){
if($stype==0){
  echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#FFCC00">All Pending Records</span>';
}
elseif($stype==1){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#42ba96">All Approved Records</span>';
}
elseif($stype==2){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#E85454">All Rejected Records</span>';
}
elseif($stype==3){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#808080">All Disabled Records</span>'; 
}


$query=mysqli_query($conn, "SELECT  * FROM `company_tbl` WHERE `status`='$stype'") or die(mysqli_error());
}

//2nd Condiotion

elseif(($sdate1!='') && ($sdate2!='') &&($stype=='')){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#80bfff">'.$sdate1.' AND '.$sdate2.'</span>';

$query=mysqli_query($conn, "SELECT  * FROM `company_tbl` WHERE `record_date` BETWEEN '$sdate1' AND '$sdate2'") or die(mysqli_error());
}


//3rd Condiotion
elseif(($rfilter=="All")){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#80bfff">All Record</span>';

$query=mysqli_query($conn, "SELECT  * FROM `company_tbl`") or die(mysqli_error());
}

//4th Condiotion
elseif(($rfilter==date('M-Y'))){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#80bfff"> '.$rfilter.'</span>';

$query=mysqli_query($conn, "SELECT  * FROM `company_tbl` WHERE `up_month`= '".$rfilter."'") or die(mysqli_error());
}

//5th Condiotion
elseif(($rfilter=="6months")){

echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#80bfff">Last 6 Months Records</span>';
#echo "SELECT * FROM visa_data WHERE `upload_date` >= CURDATE() - INTERVAL 6 MONTH AND upload_type=1";
 $query=mysqli_query($conn, "SELECT * FROM company_tbl WHERE `record_date` >= CURDATE() - INTERVAL 6 MONTH ") or die(mysqli_error());
 
}

//6th Condiotion
elseif(($rfilter=="1year")){

echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#80bfff">'.$rfilter.'</span>';
#echo "SELECT * FROM visa_data WHERE `upload_date` >= CURDATE() - INTERVAL 6 MONTH AND upload_type=1";
 $query=mysqli_query($conn, "SELECT * FROM company_tbl WHERE `record_date` >= CURDATE() - INTERVAL 1 YEAR ") or die(mysqli_error());
 
}

//7th Condiotion
elseif( ($stype!='') && ($sdate1!='') && ($sdate2!='') ){
if($stype==0){
  echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#FFCC00">All Pending Records</span>';
}
elseif($stype==1){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#42ba96">All Approved Records</span>';
}
elseif($stype==2){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#E85454">All Rejected Records</span>';
}
elseif($stype==3){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#808080">All Disabled Records</span>'; 
}

$query=mysqli_query($conn, "SELECT  * FROM `company_tbl` WHERE `record_date` BETWEEN '$sdate1' AND '$sdate2' AND status='$stype'") or die(mysqli_error());
}


//8th Condiotion
elseif( ($stype!='') && ($rfilter==date('M-Y')) ){
if($stype==0){
  echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#FFCC00">All Pending Records &nbsp; '.$rfilter.'</span>';
}
elseif($stype==1){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#42ba96">All Approved Records &nbsp; '.$rfilter.'</span>';
}
elseif($stype==2){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#E85454">All Rejected Records &nbsp; '.$rfilter.'</span>';
}
elseif($stype==3){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#808080">All Disabled Records &nbsp; '.$rfilter.'</span>'; 
}
$query=mysqli_query($conn, "SELECT  * FROM `company_tbl` WHERE `up_month`= '".$rfilter."'  AND status='$stype'") or die(mysqli_error());

}

//9th Condiotion
elseif( ($stype!='') && ($rfilter=='6months') ){
if($stype==0){
  echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#FFCC00">All Pending Records &nbsp; '.$rfilter.'</span>';
}
elseif($stype==1){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#42ba96">All Approved Records &nbsp; '.$rfilter.'</span>';
}
elseif($stype==2){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#E85454">All Rejected Records &nbsp; '.$rfilter.'</span>';
}
elseif($stype==3){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#808080">All Disabled Records &nbsp; '.$rfilter.'</span>'; 
}

$query=mysqli_query($conn, "SELECT * FROM company_tbl WHERE `record_date` >= CURDATE() - INTERVAL 6 MONTH AND status='$stype'") or die(mysqli_error());
}

//10th Condiotion
elseif( ($stype!='') && ($rfilter=='1year') ){
if($stype==0){
  echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#FFCC00">All Pending Records &nbsp; '.$rfilter.'</span>';
}
elseif($stype==1){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#42ba96">All Approved Records &nbsp; '.$rfilter.'</span>';
}
elseif($stype==2){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#E85454">All Rejected Records &nbsp; '.$rfilter.'</span>';
}
elseif($stype==3){
echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#808080">All Disabled Records &nbsp; '.$rfilter.'</span>'; 
}
$query=mysqli_query($conn, "SELECT * FROM company_tbl WHERE `record_date` >= CURDATE() - INTERVAL 1 YEAR AND status='$stype'") or die(mysqli_error());

}









else{
$query=mysqli_query($conn, "SELECT  * FROM `company_tbl`") or die(mysqli_error());
}
$row=mysqli_num_rows($query);
if($row>0){
$n=1;
while($fetch=mysqli_fetch_array($query)){
$query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$fetch['id']."'") or die(mysqli_error());
			$fetch1=mysqli_fetch_array($query1);
$status=$fetch['status'];
$bid=$fetch['id'];
?>

<tr> 
		<td style="text-align: center;"><input type="checkbox" name="delete_ids[]" value="<?php echo $fetch['id']; ?>" class="delete_checkbox"></td>
		<td><?php echo $n; $n++;?></td>
	 
		<td><?=$fetch['name']?></td>
		<td><?=$fetch['country']?></td>
		<td><?=$fetch['cr_number']?></td>
		<td><?=$fetch['record_date']?></td>
		<td><?=$fetch1['first_name']?> &nbsp; <?=$fetch1['last_name']?></td>
	  <!--<td style="text-align:center ;"><a href="user_view.php?view_id=<?=$fetch['id']?>&page=REV"><span class='badge badge-info' style="font-size:12px;"><?=$user_count?></span></a> </td>-->
		
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

<td><a href="edit.php?view_id=<?=$fetch['id']?>"><i class='fa fa-edit' style='font-size:13px; color:#ea490b; ' ></i></a>

<a href="view.php?view_id=<?=$fetch['id']?>"><i class='fa fa-eye' style='font-size:13px; color:#008dbd;'></i></a>

 <a href="show?image_id=<?php echo $bid; ?>&&page=REV"><i class='fa fa-trash' style='font-size:13px; color:#ff0000;'></i> </a>

</a></td>



	
 
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
		$query=mysqli_query($conn, "SELECT * FROM `company_tbl`") or die(mysqli_error());
		$n=1;
		while($fetch=mysqli_fetch_array($query)){


		$query1=mysqli_query($conn, "SELECT * FROM `company_contacts_tbl` WHERE company_id='".$fetch['id']."'") or die(mysqli_error());
		$user_count=mysqli_num_rows($query1);
			$fetch1=mysqli_fetch_assoc($query1);
			$status=$fetch['status'];
			$bid=$fetch['id'];
			$recdate=$fetch['record_date'];
			//echo $recdate;
?>
	<tr>
		<td style="text-align: center;"><input type="checkbox" name="delete_ids[]" value="<?php echo $fetch['id']; ?>" class="delete_checkbox"></td>
		<td><?php echo $n; $n++;?></td>
	 
		<td><?=$fetch['name']?></td>
		<td><?=$fetch['country']?></td>
		<td><?=$fetch['cr_number']?></td>
		<td><?=$fetch['record_date']?></td>
		<!--<td><?php echo $fetch['record_date']?></td>-->
		<!--<td><?php $time_sting = strtotime($fetch['record_date']);
					$date = date("d-M-Y", $time_sting);
					echo $date;?>
		</td>-->
		<!--<td>test</td>-->
		<td><?=$fetch1['first_name']?> &nbsp; <?=$fetch1['last_name']?></td>
    <!--<td style="text-align:center ;"><a href="user_view.php?view_id=<?=$fetch['id']?>&page=REV"><span class='badge badge-info' style="font-size:12px;"><?=$user_count?></span></a> </td>-->

		
		
		

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


<td><a href="edit.php?view_id=<?=$fetch['id']?>"><i class='fa fa-edit' style='font-size:13px; color:#ea490b; ' ></i></a>

<a href="view.php?view_id=<?=$fetch['id']?>"><i class='fa fa-eye' style='font-size:13px; color:#008dbd;'></i></a>

 <!--<a href="show.php?image_id=<?php echo $bid; ?>&&page=REV"><i class='fa fa-trash' style='font-size:13px; color:#ff0000;'></i> </a>-->
 <!--<a href="show.php?image_id=<?php echo $bid; ?>&&page=REV"><i class='fa fa-trash' style='font-size:13px; color:#ff0000;' onclick="dlt()" ></i> </a>-->
<a href="delete.php?image_id=<?php echo $bid;?>&&page=REV" onclick="return confirm('Are you sure want to delete?')"><i class='fa fa-trash' style='font-size:13px; color:#ff0000;' onclick="dlt1()" ></i> </a>
 
 
</td>
		 
		  
	</tr>
<?php
		}
	}
?>
 	
</tbody>

</table>
</div>
</form>
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

//echo $s="DELETE c.* , o.*,cc.* FROM company_tbl c,order_tbl o, company_contacts_tbl cc WHERE c.id=o.company_id AND c.id=cc.company_id";
/* $q=mysqli_query($conn,$s);
$query=mysqli_query($conn,$s) or die(mysqli_error($conn));
if($query)
{
	
echo
"<script>window.location='show.php?page=REV'</script>";
$_SESSION['message']="Record Deleted Successfully";
} */
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
<script type="text/javascript">
        setTimeout(function () {
  
            // Closing the alert
            $('#alert').alert('close');
        }, 2000);
    </script>
  <script>
    	$('#mySelect').on('change', function() {
  var result = $(this).val();
 
  if (result=='sdate')
     $("#custom").html('<div class="form-group" style="display:flex;"><label class="my-2 mx-2">From </label><input class="form-control" type="date" name="sdate1"><label class="my-2 mx-2">To</label><input class="form-control" type="date" name="sdate2"><input type="submit" name="search" class="btn btn-success ml-2 " value="Filter"></div>');


     


     if(result!='sdate')
     	
      
         $("#custom").html('<div class="form-group" style="display:flex;"><input type="submit" name="search" class="btn btn-success mx-2" value="Filter">&nbsp;<a href="show.php?page=VS"><input type="button" name="Reset" class="btn btn-warning" value="Reset"></a></div>');
});
    
  
  </script>


    <script>
    	$('#mySelect1').on('change', function() {
  var result = $(this).val();
     if(result!='sdate')
         $("#custom").html('<div class="form-group" style="display:flex;"><input type="submit" name="search" class="btn btn-success mx-2" value="Filter">&nbsp;<a href="show.php?page=VS"><input type="button" name="Reset" class="btn btn-warning" value="Reset"></a></div>');
});
    
  
  </script>
  
<script type="text/javascript">
$(document).ready(function(){
    // Handle select all checkbox
    $('#select_all').change(function(){
        $('.delete_checkbox').prop('checked', $(this).prop('checked'));
    });
    
    // Handle individual checkboxes
    $(document).on('change', '.delete_checkbox', function(){
        if($('.delete_checkbox:checked').length == $('.delete_checkbox').length){
            $('#select_all').prop('checked', true);
        } else {
            $('#select_all').prop('checked', false);
        }
    });

    // Add visual feedback when hovering over checkboxes
    $('.select-checkbox').hover(
        function(){ $(this).parent().css('background-color', '#f5f5f5'); },
        function(){ $(this).parent().css('background-color', ''); }
    );
});
</script>
  