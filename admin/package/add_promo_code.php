<?php

include("../include/function.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $promo_code = $_POST['promo_code'];
	$promoregistration_fee = $_POST['promoregistration_fee'];
    $promoannual_fee = $_POST['promoannual_fee'];
    $expiry_date = $_POST['expiry_date'];
   // $number_of_uses = $_POST['number_of_uses'];



    // Execute the query
	$stmt = "INSERT INTO promo_codes (id,promo_code, promoregistration_fee, promoannual_fee, expiry_date) VALUES ('','$promo_code', '$promoregistration_fee', '$promoannual_fee','$expiry_date')";
	$query=mysqli_query($conn,$stmt);
	
   if($query){
	   echo "<script>alert('Promo Code Added.')</script>";
	   echo "<script>window.location='https://gs1oman.com/admin/package/promocode.php?page=PD';</script>";
   }
   
}



