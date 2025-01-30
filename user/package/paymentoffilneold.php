<?php echo 'test'; ?>
<?php 
include("../include/function.php");
if(isset($_REQUEST['_token']) && !empty($_REQUEST['_token'])) {
	$_token = base64_decode($_REQUEST['_token']);
	$query = "SELECT * FROM order_tbl  where order_id='".$_token."' ORDER BY id ASC ";     
	$rs_result = mysqli_query ($conn, $query);
	$orderData=mysqli_fetch_array($rs_result);
	//$pId = $orderData['product_id'];
	
	
	$ProductQuery = "SELECT * FROM product_tbl where id='".$pId."' ORDER BY id DESC ";     
	$ProductResult = mysqli_query ($conn, $ProductQuery);
	$ProductData=mysqli_fetch_array($ProductResult);
	$productName = $ProductData['product_name'];
	$annual_total_price=$orderData['annual_total_price'];

	$array = [];
	$amount = $annual_total_price;
	$currency = 'OMR';
	$merchantID = 'TEST407399002';
	$apiUsername = 'merchant.TEST407399002';
	$apiPassword = '38571245bf1662cacd49bb73b6c27d69';
	$curl = curl_init();
	$uid = $orderData['id'];
	$RuRL = 'https://gs1oman.com/user/package/success.php';
	$CuRL = 'https://gs1oman.com/user/package/cancel.php';
	$operation = "INITIATE_CHECKOUT";
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://nbo.gateway.mastercard.com/api/nvp/version/71',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0, 
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>"apiOperation=".$operation."&apiPassword=".$apiPassword."&apiUsername=merchant.".$merchantID."&merchant=".$merchantID."&interaction.cancelUrl=".$CuRL."&interaction.returnUrl=".$RuRL."&interaction.operation=PURCHASE&interaction.merchant.name=".$merchantID."&order.id=".$uid."&order.amount=".$amount."&order.currency=".$currency."&order.description=".$productName."",
	));	
	$response = curl_exec($curl);
	
	parse_str($response,$array);
	if($array['result']=='SUCCESS') {
		$encoded = json_encode($array);
		  $session_id = $array['session_id'];
		
	$sql2 =mysqli_query($conn,"update `order_tbl` set payment_data='".$encoded."' where id ='".$uid."'");
		 ?>
		 <script src="https://nbo.gateway.mastercard.com/static/checkout/checkout.min.js" data-error="errorCallback" data-cancel="cancelCallback"></script>
        <script type="text/javascript">
            function errorCallback(error) {
                  console.log(JSON.stringify(error));
            }
            function cancelCallback() {
                  console.log('Payment cancelled');
            }
            Checkout.configure({
              session: { 
            	id: '<?php echo $session_id ?>'
       			}
            });
			Checkout.showPaymentPage();
        </script>
		 <?php
	}
} else {
	$_SESSION['message']="Not a valid request.";
	echo '<script>window.location="payment.php?page=Pack";</script>';
	
}
?>