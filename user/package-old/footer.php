<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
 

<script type="text/javascript" src="js/addmore.js"></script>

<script type="text/javascript">

	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
	
	
	function show_package_details(){
            var product_id = $("#product_id").val(); 
            $.ajax({
            url : "https://gs1oman.com/user/package/add.php?page=Pack",
            type: "POST",
            data: {'product_id':product_id,'action':'get_product_data' },
            dataType: 'html',
            success: function(data){
            $(".product_result_data").html(data);
            }, 
            error: function(){
            
            }
            });
	    
	}


</script>

<script language="javascript">
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    $('#date_picker').attr('min',today);
</script>

<script>
    function add()
    {
    total_price = 0;
    annual_total_price = 0;
    registration_fee = $("#registration_fee").val();
    annual_subscription_fee =  $("#annual_subscription_fee").val();
    annual_total_price = annual_subscription_fee;
    
    total_price = parseInt(registration_fee) + parseInt(annual_subscription_fee);
    
    gln_price = $("#gln_price").val();
    
    sscc_price = $("#sscc_price").val();
    
    // Check if the element is selected/checked
    if($('#gln_price').is(':checked')) {
    total_price = parseInt(total_price) + parseInt(gln_price);
    annual_total_price = parseInt(annual_total_price) + parseInt(gln_price);
    
    }
    if($('#sscc_price').is(':checked')) {
    total_price = parseInt(total_price) + parseInt(sscc_price);
    annual_total_price = parseInt(annual_total_price) + parseInt(sscc_price);
    
    }
    
    $("#annual_total_price").val(annual_total_price); 
    $("#total_price").val(total_price);  
    }
</script>
			
    
<script>
    function checkTotal() {
		document.listForm.total.value = '';
		var sum = 0;
		for (i=0;i<document.listForm.choice.length;i++) {
		  if (document.listForm.choice[i].checked) {
		  	sum = sum + parseInt(document.listForm.choice[i].value);
		  }
		}
		document.listForm.total.value = sum;
	}
</script>

</body>
</html>