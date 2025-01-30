<?php

include("../include/function.php");

if (isset($_GET['id'])&& ($_GET['page']='DP')) {
    $id = intval($_GET['id']);
	
}
?>
<?php 

// Delete Promo Code

  $stmt="DELETE FROM `promo_codes` WHERE id=$id";
	$query=mysqli_query($conn,$stmt);
	if($query){
	   //echo "<script>alert('Promo Code Updated.')</script>";
	   echo "<script>window.location='https://gs1oman.com/admin/package/promocode.php?page=PD';</script>";
	   
		$_SESSION['message']="Promo Code Deleted Successfully";
   }


?>