<?php

include("../include/function.php");
if($_SESSION['email']=="")
{
header('location:../login.php');
}
#$useremail = $_GET['useremail'];
#$username = $_GET['username'];
 error_reporting(0);

$_SESSION['filter_status']=$_GET['stype'];
$_SESSION['filter_sdate1']=$_GET['sdate1'];
$_SESSION['filter_sdate2']=$_GET['sdate2'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

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
<li class="breadcrumb-item"><a href="#">Financial Reports</a></li>
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
 

<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4" >  
<div class="form-group">
<label for="inputName" class="col-form-label">Status</label>
<select name="stype" id="mySelect" class="form-control" required="" onchange="getOption()">
<option value="" <?php if(isset($_GET['stype']) && $_GET['stype'] === '') echo 'selected'; ?>>Please Select </option>
<option value="" <?php if(isset($_GET['stype']) && $_GET['stype'] === '') echo 'selected'; ?>>All</option>
<option value="0" <?php if(isset($_GET['stype']) && $_GET['stype'] === '0') echo 'selected'; ?>>This Month</option>
<option value="1" <?php if(isset($_GET['stype']) && $_GET['stype'] === '1') echo 'selected'; ?>>This Year</option>
<option value="2" <?php if(isset($_GET['stype']) && $_GET['stype'] === '2') echo 'selected'; ?>>Previous Year</option>
<option value="sdate" <?php if(isset($_GET['stype']) && $_GET['stype'] === 'sdate') echo 'selected'; ?>>Custom(Select from and To Dates)</option>
</select>
<input type="hidden" name="selectedOption" id="selectedOption" value="">

</div>
</div>

<div class="col-auto" id="custom" style="margin-top:32px;"></div>
<div class="col" style="margin-top:34px;" > 
<div class="form-group">
<input type="submit" name="search" class="btn btn-success" value="Filter">
<a href="/financialreports.php?page=finreport"><input type="button" name="Reset" class="btn btn-warning" value="Reset"></a>
<br>
</div>

</div>



<div class="col-auto fileexport" style="display: flex;flex-direction: row-reverse; margin-top:34px;" > 
<div class="form-group">

<a href="exportDatafinc.php" class="btn btn-success" name="exl"><i class="dwn"></i>Download Excel</a>
<a href="exportDatafincPdf.php" class="btn btn-danger"  download><i class="dwn"></i>Download Pdf</a>



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
<form method="post">

<div class="row t-header">
<div class="col-md-2">
<div class="t-header">Financial Report</div>
</div>

<div class="col-md-7">

</div>

</div>

</form>

<div class="table-responsive">
<table id="basicExample" class="table custom-table">
	<thead>
		<tr> 
			<th>Id</th>
			<th>Type</th>
			<th>Company</th>
			<th>Product</th>
			<th>Date of Purchase</th>
			<th>Subscription Fees</th>
			<!--<th>Annual Fees</th>-->
			<th>Total</th>
		</tr>
	</thead>
<tbody>

<?php

if(isset($_GET['search'])){
	$stype=$_GET['stype'];
	$sdate1=$_GET['sdate1'];
	$sdate2=$_GET['sdate2'];
	
	if(($stype!='') && ($stype == '0')){	
	$query=mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE `order_date`>= DATE_FORMAT(CURRENT_DATE(), '%Y-%m-01')") or die(mysqli_error());
	}
	elseif(($stype!='') && ($stype == '1')){
	$current_year = date("Y");
	$query = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE YEAR(`order_date`) = '$current_year'") or die(mysqli_error());
	
	}
	elseif(($stype!='') && ($stype == '2')){
		
	$previous_year = date("Y") - 1;
	$query = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE YEAR(`order_date`) = '$previous_year'") or die(mysqli_error());
	}
	elseif(($sdate1!='') && ($sdate2!='') &&($stype=='sdate')){
		echo'<span class="badge" style="width:200px; margin-top:10px; margin-bottom:10px; font-size: 12px; background:#80bfff">'.$sdate1.' AND '.$sdate2.'</span>';
	$query = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE  `order_date` BETWEEN '$sdate1' AND '$sdate2'") or die(mysqli_error());
	}
	else{
		$query=mysqli_query($conn, "SELECT  * FROM `order_tbl`") or die(mysqli_error());
	 }
	$row=mysqli_num_rows($query);
if($row>0){
	
$n=1;
while($fetch=mysqli_fetch_array($query)){
$category_name=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `company_tbl` WHERE id='".$fetch['company_id']."'"));
$query1=mysqli_query($conn, "SELECT * FROM `product_tbl`") or die(mysqli_error());
		$fetch1=mysqli_fetch_array($query1);
$status=$fetch['status'];
$renew_status=$fetch['renew_status'];
$bid=$fetch['id'];
$year=date("Y", strtotime($fetch['order_date']));
$month=date("M", strtotime($fetch['order_date']));
$date=date("d", strtotime($fetch['order_date']));
$user_mail=$category_name['name'];
//Expiry Data
$date1=$fetch['order_date'];

$date2=$fetch['expiry_date'];
$date3=date('Y-m-d');

$purchased_date=strtotime($date1);
$exp_date=strtotime($date2);

$today_date=strtotime($date3);

$diff = $exp_date - $today_date;
$num=round($diff / 86400);


?>
<tr> 
		<td><?php echo $n; $n++;?></td>
	 
		<td><?php if(isset($fetch['payment_data']) && !empty($fetch['payment_data']) &&  !($fetch['payment_data']=='offline')){
						echo "CASH";
					 }else{
						 echo "CARD";
						}?>
		</td>
						
		<td><?php if(isset($category_name['name']) && !empty($category_name['name'])){
					echo $category_name['name'];
					}else{?>---<?php }?>
		</td>
		<td>
		
	
		<?php if(isset($fetch['gtins_annual_fee']) && !empty($fetch['gtins_annual_fee'])){ ?>
	   GTIN:<?php echo $fetch['gtins_annual_fee'];
	   }else{ 
	  
	   } ?>
	   <?php if(isset($fetch['gln_price']) && !empty($fetch['gln_price'])){ ?>
	   GLN:<?php echo $fetch['gln_price'];
	   }else{ 
	   
	   } ?>
	  <?php if(isset($fetch['sscc_price']) && !empty($fetch['sscc_price'])){ ?>
	    SSCC:<?php echo $fetch['sscc_price'];
	   }else{ 
	 
	   } 
	   if(empty($fetch['gtins_annual_fee']) && empty($fetch['gln_price']) && empty($fetch['sscc_price'])){
		   echo 'No Product Selected';
	   }
	   
	   
	   ?>
	   
	</td>

		<td><?=$date?>/<?=$month?>/<?=$year?></td>
		

		<td><?php if(($fetch['annual_subscription_fee']=="0")){
         	echo "----";
         }
         else{
         	echo $fetch['annual_subscription_fee'];
         }
		
		?></td>
		
	
		<!--<td>
			<?php // if(($category_name['registration_fee']=="0")){
         	// echo "----";
         // }
         // else{
         	// echo $category_name['registration_fee'];
         // }
		
		?>
        </td>-->

        <td>
			<?php if(($fetch['annual_total_price']=="0")){
         	echo "----";
         }
         else{
         	echo $fetch['annual_total_price'];
         }
		
		?>
        </td>

 </tr>       

<tr>
 
<!-- Modal -->

<div class="modal fade" id="exampleModal<?=$fetch['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="min-width:300px; ;max-width:1100px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Renew Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
<form method="post" action="">

      <div class="modal-body">

<?php echo $id=$fetch['id'];
 ?>
    <div class="form-group">
    <label for="exampleInputEmail1">Product Name</label>
    <input type="text" class="form-control" value="<?=$fetch1['product_name'];?>" disabled readonly>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Gln Numbere</label>
    <input type="text" class="form-control" value="<?=$fetch['gln_number'];?>" disabled readonly>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Prefix Nume</label>
    <input type="text" class="form-control" value="<?=$fetch['prefix_num'];?>" disabled readonly>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">New Expiry Date</label>
    <?php 
      $rdate=date('Y/12/31');
      echo $rdate;
    ?>
    <input type="hidden" class="form-control" name="renew_date1" value="<?=$rdate;?>" disabled readonly>
    <input type="text" class="form-control" name="" value="<?=$rdate;?>" disabled readonly>
    <input type="hidden" class="form-control" name="renew_status1" value="0">
    <input type="hidden" class="form-control" name="renew_id1" value="<?=$fetch['id'];?>">
  </div>

   <div class="form-group">
    <label for="exampleInputEmail1">Renewal Price</label>
    <input type="text" class="form-control"  value="850" disabled readonly>
  </div>

  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input"  required>
    <label class="form-check-label"><a href="" data-toggle="modal" data-target="#myModal2" id="finalpay">Accept Terms and conditions</a></label>
  </div>


      </div>


      <div class="modal-footer">
        <button type="submit" name="renew" class="btn btn-primary">Renew</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>

      </form>


    </div>
  </div>
</div>

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
		$query1=mysqli_query($conn, "SELECT * FROM `product_tbl`") or die(mysqli_error());
		$fetch1=mysqli_fetch_array($query1);
		$status=$fetch['status'];
		$renew_status=$fetch['renew_status'];
		$bid=$fetch['id'];
		$year=date("Y", strtotime($fetch['order_date']));
        $month=date("M", strtotime($fetch['order_date']));
        $date=date("d", strtotime($fetch['order_date']));

$user_mail=$category_name['name'];
//Expiry Data
$date1=$fetch['order_date'];
$date2=$fetch['expiry_date'];

$date3=date('Y-m-d');

$purchased_date=strtotime($date1);
$exp_date=strtotime($date2);
$today_date=strtotime($date3);


$diff = $exp_date - $today_date;
$num=round($diff / 86400);


        ?>
<tr> 
		<td><?php echo $n; $n++;?></td>
	 
		<td><?php if(isset($fetch['payment_data']) && !empty($fetch['payment_data']) &&  !($fetch['payment_data']=='offline')){
						echo "CASH";
					 }else{
						 echo "CARD";
						}?>
		</td>
						
		<td><?php if(isset($category_name['name']) && !empty($category_name['name'])){
					echo $category_name['name'];
					}else{?>---<?php }?>
		</td>
		<td>
		
	
		<?php if(isset($fetch['gtins_annual_fee']) && !empty($fetch['gtins_annual_fee'])){ ?>
	   GTIN:<?php echo $fetch['gtins_annual_fee'];
	   }else{ 
	  
	   } ?>
	   <?php if(isset($fetch['gln_price']) && !empty($fetch['gln_price'])){ ?>
	   GLN:<?php echo $fetch['gln_price'];
	   }else{ 
	   
	   } ?>
	  <?php if(isset($fetch['sscc_price']) && !empty($fetch['sscc_price'])){ ?>
	    SSCC:<?php echo $fetch['sscc_price'];
	   }else{ 
	 
	   } 
	   if(empty($fetch['gtins_annual_fee']) && empty($fetch['gln_price']) && empty($fetch['sscc_price'])){
		   echo 'No Product Selected';
	   }
	   
	   
	   ?>
	   
	</td>

		<td><?=$date?>/<?=$month?>/<?=$year?></td>
		

		<td><?php if(($fetch['annual_subscription_fee']=="0")){
         	echo "----";
         }
         else{
         	echo $fetch['annual_subscription_fee'];
         }
		
		?></td>
		
	
		<!--<td>
			 <?php //if(($category_name['registration_fee']=="0")){
         	// echo "----";
         // }
         // else{
         	// echo $category_name['registration_fee'];
         // }
		
		?>
        </td>-->

        <td><?php echo $fetch['annual_subscription_fee'];?>
			
        </td>

       




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

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="min-width:200px; ;max-width:500px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Terms & Conditions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form>
      <div class="modal-body">
       
      <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..</p>
  



      </div>


   

      </form>
	  

    </div>
  </div>
</div>

<script>
    	$('#mySelect').on('change', function() {
  var result = $(this).val();
  
 
  if (result=='sdate')
     $("#custom").html('<div class="form-group" style="display:flex;"><label class="my-2 mx-2">From </label><input class="form-control" type="date" name="sdate1"><label class="my-2 mx-2">To</label><input class="form-control" type="date" name="sdate2"></div>');
    else
		$("#custom").html('<div class="form-group" style="display:none;"><label class="my-2 mx-2">From </label><input class="form-control" type="date" name="sdate1"><label class="my-2 mx-2">To</label><input class="form-control" type="date" name="sdate2"></div>');
});

  </script>