<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

 



<script type="text/javascript" src="js/addmore.js"></script>



<script type="text/javascript">



	$(function () {

	  $('[data-toggle="tooltip"]').tooltip()

	})

	

	

	function show_package_details(){

            var product_id = $("#product_id").val(); 

            $.ajax({

            url : "https://gs1oman.com/arabic.php",
            
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
    gtins_annual_fee = $("#gtins_annual_fee").val();
   
    gln_price = $("#gln_price").val();	
    sscc_price = $("#sscc_price").val();	    		
    promoregistration_fee = $("#promoregistration_fee").val();	    		
    promoannual_fee = $("#promoannual_fee").val();	    		
    vat = 0;    		
   



    
    // Check if the element is selected/checked
    if($('#gln_price').is(':checked')) {
    total_price = parseInt(total_price) + parseInt(gln_price);
    annual_total_price = parseInt(annual_total_price) + parseInt(gln_price);
	
    
    }
    if($('#sscc_price').is(':checked')) {
    total_price = parseInt(total_price) + parseInt(sscc_price);
    annual_total_price = parseInt(annual_total_price) + parseInt(sscc_price);
	
    
    }	
	if($('#gtins_annual_fee').is(':checked')) {   
	total_price = parseInt(total_price) + parseInt(gtins_annual_fee); 
	annual_total_price = parseInt(annual_total_price) + parseInt(gtins_annual_fee);  
	//alert(annual_total_price);
	
	}	
			
    
    $("#annual_total_price").val(annual_total_price); 
    $("#total_price").val(total_price);
  	
	
	//var vat = total_price;
//console.log(vat);

// Set the value of 'vat' in the <p> tag with id 'vat'


//var vatresult=vat+'+'+(vat+'*'+0.05+'=');
//var vatresult=vat+'+'+((vat+'*'+0.05))+'=;
//var vatvalue=$('#vat').text("VAT: "+vatresult);

// Assuming vat is the initial VAT amount
var vat = total_price; // Replace this with your actual VAT amount

// Calculate VAT including 5% tax
var totalVAT = vat + (vat * 0.05);

// Format the result
var vatResult = vat + ' + (' + vat + ' * 0.05) = ' + totalVAT;

// Display the result
//console.log(vatResult); // Output: 1700 + (1700 * 0.05) = 1785
var vatvalue=$('#vat').text("VAT: "+vatResult);
var discount=totalVAT -(totalVAT*0.05);
console.log(discount);
//var discountresult=totalVAT+ ' - ('+totalVAT+'* 0.05)=';

var discountvalue=$('#discount').text("DISCOUNT(5%)="+totalVAT+'-('+totalVAT+'* 0.05 )='+discount);

 //var ttotalbal=$("#total_price").val(discount);

 
document.getElementById("grand_total").textContent = "OMR: " + discount;


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
<script>
function ajaxCheck(callback) {
    $.ajax({
        type: 'POST',
        url: 'check_duplicate.php', // URL of your backend script to check for duplicate data
        data: $('#regform').serialize(),
        success: function(response) {
            callback(response); // Pass the response to the callback
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
            alert("An error occurred while checking for duplicate data.");
            callback(null); // Pass null in case of error
        }
    });
}

$(document).on('blur', '.unique-email, .unique-phone', function() {
    ajaxCheck(function(response) {
        if (response != '') {
            $('#errorDiv').show();
            $('#errorDiv').html(response);
        } else {
            $('#errorDiv').html('');
            $('#errorDiv').hide();
        }
    });
});

$(document).ready(function() {
    $("#regform").validate({
        ignore: ".ignore",
        rules: {
            'pobox': {
                required: true,
                digits: true
            },
            'zipcode': {
                required: true,
                digits: true
            },
            'mobile_number': {
                required: true,
                digits: true
            },
            'phone_number': {
                required: true,
                digits: true
            },
            'fax_number': {
                digits: true
            },
            'website_address': {
                //url: true
            },
            'cr_number': {
                required: true,
                digits: true
            },
            'cr_tax_registration_number': {
                required: true,
                digits: true
            },
            'number_of_employee': {
                required: true,
                digits: true
            },
            'first_name[]': {
                required: true
            },
            'last_name': {
                required: true
            }
        },
        messages: {
            'pobox': {
                required: "Please enter a PO Box number",
                digits: "Please enter numbers only"
            },
            'zipcode': {
                required: "Please enter a Zip/Postal Code",
                digits: "Please enter numbers only"
            },
            'mobile_number': {
                required: "Please enter a mobile number",
                digits: "Please enter numbers only"
            },
            'phone_number': {
                required: "Please enter a phone number",
                digits: "Please enter numbers only"
            },
            'fax_number': {
                digits: "Please enter numbers only"
            },
            'website_address': {
                url: "Please enter a valid website URL"
            },
            'cr_number': {
                required: "Please enter a CR number",
                digits: "Please enter numbers only"
            },
            'cr_tax_registration_number': {
                required: "Please enter a CR tax registration number",
                digits: "Please enter numbers only"
            },
            'number_of_employee': {
                required: "Please enter the number of employees",
                digits: "Please enter numbers only"
            },
            'first_name[]': {
                required: "Please enter your first name"
            },
            'last_name': {
                required: "Please enter your last name"
            }
        }
    });

    $('.number').keyup(function() {
        this.value = this.value.replace(/[^0-9\.]/g, '');
        if ($(this).val().length > 1) {
            this.value = this.value.replace(/^0+/, '');
        }
    });

    $(".alpha_char").keyup(function() {
        this.value = this.value.replace(/[^A-Z a-z_@./#&+%-]/g, "");
    });

    $('#regform').submit(function(event) {
        event.preventDefault();

        let isValid = true;

        // Check validation for required fields
        $('.validate').each(function() {
            let errorSpan = $(this).next('.text-danger');
            if ($(this).val().trim() === "") {
                isValid = false;
                $(this).addClass('error');
                errorSpan.text("This field is required.");
            } else {
				//isValid = true;
                $(this).removeClass('error');
                errorSpan.text('');
            }
        });

        if (!isValid) {
            alert("Fill all required fields");
            return;
        }

        ajaxCheck(function(response) {
            if (response != '') {
                $('#errorDiv').show();
                $('#errorDiv').html(response);
            } else {
                $('#errorDiv').html('');
                $('#errorDiv').hide();
                
                if ($("#regform").valid()) {
                    $('#regform').unbind('submit').submit();
                }
            }
        });
    });
});


</script>
<script>
$(document).ready(function(){
    $("#email_id").rules("add", {
        required: true,
        email: true,
        messages: {
            required: "Please enter your email",
            email: "Please enter a valid email address"
        }
    });

    $("#phone_number1").rules("add", {
        required: true,
        digits: true,
        messages: {
            required: "Please enter your phone number",
            digits: "Please enter numbers only"
        }
		
    });
});

</script>

<script>
$(document).ready(function() {
    $('#riyada_certificate').change(function() {
        if ($(this).val() == 'Yes') {
            $('#expiry_date_container').show();
            $('#documents_container').show();
        } else {
            $('#expiry_date_container').hide();
            $('#documents_container').hide();
        }
    });
});
</script>