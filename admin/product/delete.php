<?php
include("../include/function.php");
if($_SESSION['email']=="")
{
header('location:../login.php');
}
error_reporting(0);
$_SESSION['filter_status']=$_GET['stype'];
$_SESSION['filter_sdate1']=$_GET['sdate1'];
$_SESSION['filter_sdate2']=$_GET['sdate2'];
$_SESSION['filter_rfilter']=$_GET['rfilter'];
?>

<?php $id=$_GET['image_id'];

		$s="DELETE FROM order_tbl WHERE id='".$id."'";
		$query=mysqli_query($conn,$s) or die(mysqli_error($conn));
		if($query)
		{
		echo
		"<script>
		window.location='show.php?page=REV'</script>";
		$_SESSION['message']="Record Deleted Successfully";
		}

		else{
			echo 'Record not deleted';
		}
		
 ?>
