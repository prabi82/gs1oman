<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script type="text/javascript" src="js/addmore.js?time=<?php echo time(); ?>"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
	function show_package_details(){
		var product_id = $("#product_id").val(); 
		
		if (!product_id) {
			$(".product_result_data").html('<div class="alert alert-warning">Please select a package</div>');
			return;
		}
		
		// Show loading message
		$(".product_result_data").html('<div class="alert alert-info">Loading package details...</div>');
		
		$.ajax({
			url: 'get_package_details.php',  // Use relative path
			type: 'POST',
			data: {
				product_id: product_id
			},
			dataType: 'html',
			success: function(response) {
				if (response) {
					$(".product_result_data").html(response);
					if(typeof add === 'function') {
						add();
					}
				} else {
					$(".product_result_data").html('<div class="alert alert-danger">Failed to load package details</div>');
				}
			},
			error: function(xhr, status, error) {
				console.error('Error details:', {
					status: status,
					error: error,
					response: xhr.responseText
				});
				$(".product_result_data").html('<div class="alert alert-danger">Error loading package details. Please try again.</div>');
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
    // only Promo code 
    $(document).ready(function() {
    	$('#dis_fee_table').hide();
        var initialTotalPrice = parseFloat($('#total_price_dis').val());
        $('#apply_button').click(function() {
            var promoCode = $('#promo_code').val();
    		$('#actual_package_price').hide();
    		if(promoCode!=''){
    			$('#dis_fee_table').show();
    		}else{
    			$('#dis_fee_table').hide();
    		}
            
            // Get registration fee
            var registration_fee = $("#registration_fee").val() || 0;
            var param1 = parseFloat(registration_fee);
            
            // Get annual fees
            var annual_subscription_fee = $("#annual_subscription_fee").val() || 0;
            var gtins_annual_fee = $("#gtins_annual_fee").is(':checked') ? ($("#gtins_annual_fee").val() || 0) : 0;
            var gln_price = $("#gln_price").is(':checked') ? ($("#gln_price").val() || 0) : 0;
            var sscc_price = $("#sscc_price").is(':checked') ? ($("#sscc_price").val() || 0) : 0;
            
            // Calculate total annual fee
            var param2 = parseFloat(annual_subscription_fee) + parseFloat(gtins_annual_fee) + 
                        parseFloat(gln_price) + parseFloat(sscc_price);
            
            var grandTotal = parseFloat($('#grand_total').text().replace('OMR: ', '')) || 0;
          
            $.ajax({
                type: 'POST',
                url: 'promocheck.php',
                data: { promo_code: promoCode, param1: param1, param2: param2, grand_total: grandTotal },
                dataType: 'json', 
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        
                        // Update total price with the amount returned by the AJAX call
                        var new_reg_Price = parseFloat(response.after_dis_amt);
                        var newTotalPrice = parseFloat(response.amount);
                        //var new_annual_Price = parseFloat(response.discount2);
                        var new_annual_Price = parseFloat(response.after_dis_annual);
    					
                        $("#total_price_dis").val(newTotalPrice);
                        $("#registration_fee_dis").val(new_reg_Price);
                        $("#annual_total_price_dis").val(new_annual_Price);
                        $("#discount_amount_input").val(response.discountamount);
                        $("#regvalue").val(response.reg_perscentage_discount + '%');
                        $("#annualvalue").val(response.annual_perscentage_discount + '%');
                        
                        
                        // Recalculate and display VAT and discount with the new total price
                        calculateAndDisplayVatAndDiscount(newTotalPrice);

                        // Update promo message
                        $('#promo_message').html('<p style="color: green;">' + response.message + '</p>');
                    } else {
    					 var new_total =$("#actual_total_price").val();
    						onlyVat(new_total);
                        // Error message
                        $('#promo_message').html('<p style="color: red;">' + response.message + '</p>');
                        $('#actual_package_price').show();
                        $('#dis_fee_table').hide();
                        $('#discount_amount_input').val('0');
                        $('#regvalue').val('0');
                        $('#annualvalue').val('0');

                        // Reset to the original values
                        var registration_fee = $("#registration_fee_dis").val();
                        var annual_total_price = $("#annual_total_price").val();
                        var num_registration_fee = parseFloat(registration_fee);
                        var num_annual_total_price = parseFloat(annual_total_price);
                        var total = num_registration_fee + num_annual_total_price;
                        $("#total_price_dis").val('0');
                    }
                    if (response.additional_message) {
                        alert(response.additional_message);
                    }
                },
                error: function() {
                    // Error occurred
                    $('#promo_message').html('<p style="color: red;">There was an error processing your request. Please try again.</p>');
                }
            }); 
        }); 
    });


    function add() {
        // Get initial values
        var registration_fee = parseFloat($("#registration_fee").val()) || 0;
        var gtins_annual_fee = parseFloat($("#gtins_annual_fee").val()) || 0;
        var gln_price = parseFloat($("#gln_price").val()) || 0;
        var sscc_price = parseFloat($("#sscc_price").val()) || 0;
        
        // Initialize totals
        var annual_total_price = 0;
        var total_price = registration_fee;
        
        // Calculate GTINS annual fee if checked
        if($("#gtins_annual_fee").is(":checked")) {
            annual_total_price += gtins_annual_fee;
            total_price += gtins_annual_fee;
            $('input[name="gtins_annual_fee"]').val(gtins_annual_fee);
        } else {
            $('input[name="gtins_annual_fee"]').val(0);
        }
        
        // Calculate GLN price if checked
        if($("#gln_price").is(":checked")) {
            annual_total_price += gln_price;
            total_price += gln_price;
            $('input[name="gln_price"]').val(gln_price);
        } else {
            $('input[name="gln_price"]').val(0);
        }
        
        // Calculate SSCC price if checked
        if($("#sscc_price").is(":checked")) {
            annual_total_price += sscc_price;
            total_price += sscc_price;
            $('input[name="sscc_price"]').val(sscc_price);
        } else {
            $('input[name="sscc_price"]').val(0);
        }
        
        // Set the annual subscription fee
        $("#annual_subscription_fee").val(annual_total_price);
        $('input[name="annual_subscription_fee"]').val(annual_total_price);
        
        // Set the annual total price
        $("#annual_total_price").val(annual_total_price);
        $('input[name="annual_total_price"]').val(annual_total_price);
        
        // Set the total price
        $("#total_price").val(total_price);
        $('input[name="total_price"]').val(total_price);
        
        // Calculate VAT
        var vat = total_price * 0.05;
        var totalWithVAT = total_price + vat;
        
        // Display VAT and total with VAT
        $('#vat').text("OMR " + vat.toFixed(2));
        $('#grand_total').text("OMR: " + totalWithVAT.toFixed(2));
    }
    function calculateAndDisplayVatAndDiscount(vat) {
        // Calculate VAT including 5% tax
        var totalVAT = vat + (vat * 0.05);
        var vat_amount = vat * 0.05;

        // Format the result
        //var vatResult = vat + ' + (' + vat + ' * 0.05) = ' + totalVAT.toFixed(2);
    	//show only value the 
        var vatResult = + vat_amount.toFixed(2);


        // Display the VAT result
        $('#vat').text("OMR " + vatResult);

        // Calculate discount
        var discount = totalVAT - (totalVAT * 0.05);
        discount = discount.toFixed(2); // Round off the discount value to 2 decimal places

        // Display the discount result
        var discountText = "DISCOUNT (5%) = " + totalVAT.toFixed(2) + ' - (' + totalVAT.toFixed(2) + ' * 0.05) = ' + discount;
        $('#discount').text(discountText);

        // Update the content inside the div with id="grand_total"

        $('#grand_total').html('OMR ' + totalVAT);
    }
    // Function to calculate and display VAT
	function onlyVat(vat) {
		// Convert vat to a floating-point number and validate it
		vat = parseFloat(vat);
		if (isNaN(vat)) {
			alert("Invalid VAT amount.");
			return;
		}

		// Calculate VAT amount and total VAT including 5% tax
		var vat_amount = vat * 0.05;
		var totalVAT = vat + vat_amount;

		// Format the VAT amount and total VAT
		var vatResult = vat_amount.toFixed(2);
		var totalVATFormatted = totalVAT.toFixed(2);

		// Display the VAT result
		$('#vat').text("VAT: " + vatResult);

		// Update the content inside the div with id="grand_total"
		$('#grand_total').html('OMR ' + totalVATFormatted);
	}

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

    function ajaxCheck(callback) {

        const emailArray = $('input[name="email_id[]"]').map(function() {
            return $(this).val();  // Get the value of each input
        }).get().filter(function(value) {
            return value.trim() !== "";  // Filter out empty values (removes spaces as well)
        });

        const phoneArray = $('input[name="phone_number1[]"]').map(function() {
            return $(this).val();
        }).get().filter(function(value) {
            return value.trim() !== "";  // Filter out empty values (removes spaces as well)
        });
        
        $.LoadingOverlay("show");

        $.ajax({
            type: 'POST',
            url: 'check_duplicate.php',
            timeout: 300000,  // Timeout in milliseconds (5 minutes)
            data: {
                    email_id: emailArray,
                    phone_number1: phoneArray
                },
            success: function(response) {
                callback(response); // Pass the response to the callback
            },
            error: function(xhr, status, error) {
    			console.error("Status:", status);
                console.error("XHR:", xhr);
                console.error("Error:", error);
               

                // alert("Something went wrong while checking for duplicate data.");
                callback(null)
            }
        });
        $.LoadingOverlay("hide");

    }

    $(document).on('blur', '.unique-email, .unique-phone', function() {
        $.LoadingOverlay("show");
        ajaxCheck(function(response) {
             $.LoadingOverlay("hide");
            if (response != '') {
                $('#errorDiv').show();
                $('#errorDiv').html(response);
            } else {
                $('#errorDiv').html('');
                $('#errorDiv').hide();
            }
        });
        
    });


    // check Validation as per conditions
    function checkOtherDetails(){
        var riyada_certificate = parseInt($("#riyada_certificate").val());
        if(riyada_certificate == 1){
            return true;
        }
        return false;
    }

    $(window).on('load', function() {
        $('#reg_form_button').click(function(event) {
           
            let isValid = true;

            $('.validate').each(function() {
                let errorSpan = $(this).next('.text-danger');
                if ($(this).val().trim() === "") {
                    isValid = false;
                    $(this).addClass('error');
                    errorSpan.text("This field is required.");
                } else {
                    errorSpan.text('');
                }
            });

            if (!isValid) {
                $("#regform").valid();
                alert("Fill all required fields");
                return;
            }

            let captchaErrorDiv = $('#captcha_error');
            if (response.length === 0) {
                captchaErrorDiv.addClass('error-text'); // Apply red color style
                captchaErrorDiv.text('Please complete the reCAPTCHA.');
               
                return;
            } else {
                captchaErrorDiv.removeClass('error-text'); // Remove red color style
                captchaErrorDiv.text('');
            }
            $.LoadingOverlay("show");
            ajaxCheck(function(response) {
                if (response != '') {
                    $(this).removeAttr('disabled')
                    $.LoadingOverlay("hide");
                    $('#errorDiv').show();
                    $('#errorDiv').html(response);
                } else {
                    $('#errorDiv').html('');
                    $('#errorDiv').hide();
                    
                    if ($("#regform").valid()) {
                        $('#reg_form_button_sub').click();
                        $(this).attr('disabled','disabled')
                    }else{
                        $.LoadingOverlay("hide");
                    }
                }
            });
            $.LoadingOverlay("hide");

        });

    })


    // function ValidateNumberLength(field) {
    //     var $field = $(field); // Wrap field in jQuery object
    //     $field.val($field.val().replace(/[^0-9\.]/g, '')); // Remove non-numeric characters including dot
    //     if ($field.val().length > 1) {
    //         $field.val($field.val().replace(/^0+/, '')); // Remove leading zeros if length > 1
    //     }
    // }
    function ValidateNumberClass(field,addmore) {
        var $field = $(field); // Wrap field in jQuery object
        $field.val($field.val().replace(/[^0-9\.]/g, '')); // Remove non-numeric characters including dot
        if ($field.val().length > 1) {
            $field.val($field.val().replace(/^0+/, '')); // Remove leading zeros if length > 1
        }

        if(addmore==1){
            rel = $field.attr('rel');
            $("#phone_number1_error_"+rel).html("Please enter an 11-digit mobile number")
            if ($field.val().length == 11) {
                $("#phone_number1_error_"+rel).html("")
            }
        }
    }

    $('.number').keyup(function() {
        ValidateNumberClass(this,0);
    });

    function ValidateAlphaCharClass(field) {
        var $field = $(field); // Wrap field in jQuery object
        $field.val($field.val().replace(/[^A-Z a-z_@./#&+%-]/g, "")); // Remove all other Char Except that regex
    }

    $(".alpha_char").keyup(function() {
        ValidateAlphaCharClass(this);
    });

    function ValidateAlphaNumClass(field) {
        var $field = $(field); // Wrap field in jQuery object
        $field.val($field.val().replace(/[^a-zA-Z0-9 ]/g,"")); // Remove all other Char Except that regex
    }
    
    $(".alpha_num").keyup(function(){
        ValidateAlphaNumClass(this);
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
                },
                'cr_number': {
                    required: true,
                    digits: true
                },
                'cr_tax_registration_number': {
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
                },
    			'vat_number': {
                    alphanumeric: true
                },
    			'healthcare_status': {
    				required: true,
    			},
    			'upload_document1':{
    				required: true,
    			},
    			'upload_document2':{
    				required: true,
    			},
    			'upload_document3':{
    				required: true,
    			},
    			'cr_legal_type':{
    				required: true,
    			},
    			'g-recaptcha': {
    				required: true,
    			},
            },
          
    		errorPlacement: function(error, element) {
    		  if (element.hasClass('g-recaptcha')) { // check if the element has the class "g-recaptcha"
    			error.appendTo($("#captcha_error")); // append the error to a specific element with id "captcha_error"
    		  } else {
    			var name = $(element).attr("name").replace(/\[.*?\]/, ''); // remove [] characters
    			error.appendTo($("#" + name + "_error"));
    		  }
    		}
        });

        

        

        // $("#email_id").rules("add", {
        //     required: true,
        //     email: true,
        //     messages: {
        //         required: "Please enter your email",
        //         email: "Please enter a valid email address"
        //     }
        // });

        $("#phone_number1").rules("add", {
            required: true,
            digits: true,
            messages: {
                required: "Please enter your phone number",
                digits: "Please enter numbers only"
            }
    		
        });

        $('#riyada_certificate').change(function() {
            $("#exp_date, #documents_req").removeClass('validate').removeAttr('required'); 
            // $("#documents_req").removeClass('validate').removeAttr('required');

            if ($(this).val() == 'Yes') {
                $("#exp_date, #documents_req").addClass('validate').attr('required', true);

                $('#expiry_date_container, #documents_container').show();
            } else {
                $('#expiry_date_container, #documents_container').hide();
            }
        });

    });
</script>