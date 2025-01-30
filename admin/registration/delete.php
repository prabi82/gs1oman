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

//echo $id."<br>";

//$sql_f="SELECT c.* , o.*,cc.* FROM company_tbl c,order_tbl o, company_contacts_tbl cc WHERE c.id=o.company_id AND c.id=cc.company_id";

#$sql_f="SELECT * FROM `product_tbl` WHERE  id ='$id'";// use for delete image from folder 
//$query_f=mysqli_query($conn,$sql_f);
/* while($wo=mysqli_fetch_array($query_f))
{
#$image_name=$wo['image'];
} */
//$s="DELETE c.* , o.*,cc.* FROM company_tbl c,order_tbl o, company_contacts_tbl cc WHERE c.id=o.company_id AND c.id=cc.company_id";

		$s="DELETE FROM company_tbl WHERE id='".$id."'";
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
