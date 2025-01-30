<?php
include("../include/function.php");
if ($_SESSION['email'] == "") {
    header('location:../login.php');
}

// $_SESSION['name']=$_GET['id'];


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
<li class="breadcrumb-item active">Promo Code</li>
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
            <!-- Page header end -->
            <div class="col-md-12" style="height:40px;">
                <?php if (isset($_SESSION['message'])): ?>
                    <div id='alert' class='col-md-12 alert alert-success alert-dismissible fade show' role='alert' style='background:#51a362;'>
                        <p style='color:#e9f1eb; text-align:center;'><?php echo $_SESSION['message']; ?></p>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                <?php endif; unset($_SESSION['message']); ?>
            </div>
            <div class="container col-md-6">
                <div class="center-form">
                    <h2 class="text-center mb-4">Add Promo Code</h2>
                    <form action="add_promo_code.php" method="POST">
                        <div class="card m-0">
                            <div class="card-header">
                                <div class="card-title">Add Promo Codes</div>
                            </div>
                            <div class="card-body">
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="promo_name">Promo Name</label>
                                            <input type="text" class="form-control" id="promo_name" name="promo_code" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="registration_fee">Registration Fee</label>
                                            <input type="number" step="0.01" class="form-control" id="registration_fee" name="promoregistration_fee" required>
                                        </div>
										
                                        <div class="form-group">
                                            <label for="annual_fee">Annual Fee</label>
                                            <input type="number" step="0.01" class="form-control" id="annual_fee" name="promoannual_fee" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="expiry_date">Expiry Date</label>
                                            <input type="date" class="form-control" id="expiry_date" name="expiry_date" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">Add Promo Code</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            // Assuming you have a database connection established already
            // Retrieve promo codes from the database
            $query = "SELECT * FROM promo_codes";
            $result = mysqli_query($conn, $query);
			

            // Check if there are any promo codes
            if (mysqli_num_rows($result) > 0) {
                echo '<div class="container col-md-8">';
                echo '<h2 class="text-center mt-5">Promo Code Listings</h2>';
                echo '<table class="table table-striped mt-3 table-bordered">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Promo Code</th>';
                echo '<th>Registration Fee</th>';
                echo '<th>Annual Fee</th>';
                echo '<th>Expiry Date</th>';
                echo '<th>Action</th>';
				echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                // Output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
					
                    echo '<tr>';
						echo '<td>' . $row["promo_code"] . '</td>';
						echo '<td>' . $row["promoregistration_fee"] . '%' . '</td>';

						echo '<td>' .$row["promoannual_fee"] . '%' . '</td>';
						echo '<td>' . date("d-m-Y", strtotime($row["expiry_date"])) . '</td>';
						echo '<td>';
						echo '<a href="edit_promo.php?page=EP&id=' . $row["id"] . '" class="btn btn-primary btn-block">Edit</a> ';
						echo '<a href="delete_promo.php?page=DP&id=' . $row["id"] . '" class="btn btn-primary btn-block" onclick="return confirm(\'Are you sure you want to delete this promo code?\')">Delete</a>';
						echo '</td>';
					echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo '<p class="text-center mt-5">No promo codes available</p>';
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </div>
    </div>
</div>
<!-- Footer start -->
<?php include("../include/footer.php"); ?>
<!-- Footer end -->


</div>


<!-- Required jQuery first, then Bootstrap Bundle JS -->
<?php include ("../include/main_js.php"); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</html>
