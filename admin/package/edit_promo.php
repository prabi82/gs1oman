<?php
include("../include/function.php");
if (isset($_GET['id'])&& ($_GET['page']='EP')) {
    $id = intval($_GET['id']);

    // Fetch the existing data
    $sql = "SELECT * FROM promo_codes WHERE id ='$id'";
    $stmt = mysqli_query($conn,$sql);
    if ($stmt && mysqli_num_rows($stmt) > 0) {
		$row = mysqli_fetch_assoc($stmt);
    }
	if (!$row) {
        echo "Promo code not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>
<?php 

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $promo_code = $_POST['promo_code'];
	$promoregistration_fee = $_POST['promoregistration_fee'];
    $promoannual_fee = $_POST['promoannual_fee'];
    $expiry_date = $_POST['expiry_date'];
  

	$stmt="UPDATE `promo_codes` SET `promo_code`='$promo_code',`promoregistration_fee`='$promoregistration_fee',`promoannual_fee`='$promoannual_fee',`expiry_date`='$expiry_date' WHERE id=$id";
	
	$query=mysqli_query($conn,$stmt);
	if($query){
	   //echo "<script>alert('Promo Code Updated.')</script>";
	   echo "<script>window.location='https://gs1oman.com/admin/package/promocode.php?page=PD';</script>";
	   
		$_SESSION['message']="Promo Update Successfully";
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
<meta name="description" content="Responsive Bootstrap4 Dashboard Template">
<meta name="author" content="ParkerThemes">
<link rel="shortcut icon" href="../../images/Upload/logo/logo.png" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Title -->
<title><?php title(); ?>-Product</title>


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
<li class="breadcrumb-item">Home
</li>
<li class="breadcrumb-item active">Product</li>
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


<div class="row justify-content-center gutters">
<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">

<form method="post" enctype="multipart/form-data">
<div class="card m-0">
<div class="card-header">
</div>
<div class="card-body">

<div class="container col-md-6">
    <h2 class="text-center mt-5">Edit Promo Code</h2>
    <form action="edit_promo.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="form-group">
            <label for="promo_code">Promo Code</label>
            <input type="text" class="form-control" id="promo_code" name="promo_code" value="<?php echo htmlspecialchars($row['promo_code']); ?>" required>
        </div>
        <div class="form-group">
            <label for="promoregistration_fee">Registration Fee (%)</label>
            <input type="number" class="form-control" id="promoregistration_fee" name="promoregistration_fee" value="<?php echo htmlspecialchars($row['promoregistration_fee']); ?>" required>
        </div>
        <div class="form-group">
            <label for="promoannual_fee">Annual Fee (%)</label>
            <input type="number" class="form-control" id="promoannual_fee" name="promoannual_fee" value="<?php echo htmlspecialchars($row['promoannual_fee']); ?>" required>
        </div>
        <div class="form-group">
            <label for="expiry_date">Expiry Date</label>
            <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="<?php echo htmlspecialchars($row['expiry_date']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Promo Code</button>
    </form>
</div>

</div>
</div>
</form>

</div>
</div>




</div>
<!-- *************
************ Main container end *************
************* -->


<!-- Footer start -->
<?php include("../include/footer.php"); ?>
<!-- Footer end -->


</div>


<!-- Required jQuery first, then Bootstrap Bundle JS -->
<?php include ("../include/main_js.php"); ?>

</body>

</html>