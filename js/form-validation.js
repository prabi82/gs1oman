$(document).ready(function() {
    // Form validation
    $('#regform').validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            name_ar: {
                required: true,
                minlength: 3
            },
            cr_number: {
                required: true,
                digits: true,
                maxlength: 12,
                minlength: 12
            },
            cr_legal_type: {
                required: true
            },
            user_email: {
                required: true,
                email: true
            },
            business_type_product_category: {
                required: true
            },
            vat_number: {
                pattern: /^[0-9]{15}$/
            }
        },
        messages: {
            name: {
                required: "Please enter company name in English",
                minlength: "Company name must be at least 3 characters"
            },
            name_ar: {
                required: "Please enter company name in Arabic",
                minlength: "Company name must be at least 3 characters"
            },
            cr_number: {
                required: "Please enter CR number",
                digits: "Please enter only digits",
                maxlength: "CR number must be exactly 12 digits",
                minlength: "CR number must be exactly 12 digits"
            },
            cr_legal_type: {
                required: "Please select legal type"
            },
            user_email: {
                required: "Please enter email address",
                email: "Please enter a valid email address"
            },
            business_type_product_category: {
                required: "Please select business type"
            },
            vat_number: {
                pattern: "VAT number must be 15 digits"
            }
        },
        errorPlacement: function(error, element) {
            error.addClass('error-text');
            error.insertAfter(element);
        },
        highlight: function(element) {
            $(element).addClass('error');
        },
        unhighlight: function(element) {
            $(element).removeClass('error');
        }
    });

    // Date validation
    function validateDates() {
        var regDate = $('#cr_registration_date').val();
        var expDate = $('#cr_expiry_date').val();
        
        if(regDate && expDate) {
            if(new Date(regDate) >= new Date(expDate)) {
                $('#date_error').text('Expiry date must be after registration date');
                return false;
            }
            $('#date_error').text('');
        }
        return true;
    }

    // Riyada certificate handling
    $('#riyada_certificate').change(function() {
        if($(this).val() == 'Yes') {
            $('#expiry_date_container').show();
            $('#documents_container').show();
            $('#exp_date').prop('required', true);
            $('#documents_req').prop('required', true);
        } else {
            $('#expiry_date_container').hide();
            $('#documents_container').hide();
            $('#exp_date').prop('required', false);
            $('#documents_req').prop('required', false);
        }
    });

    // Form submission
    $('#regform').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        
        // Log form data for debugging
        console.log('Business Type Product Category:', $('select[name="business_type_product_category"]').val());
        
        // Validate form
        if(!validateDates()) {
            return false;
        }

        // Show loading indicator
        $('#submitButton').prop('disabled', true);
        $('#loadingIndicator').show();

        // Create FormData object
        var formData = new FormData(this);
        
        // Submit form via AJAX
        $.ajax({
            url: window.location.href,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                console.log('Response:', response);
                if(response && response.success) {
                    // Show success message
                    $('#successMessage').html(response.message).show();
                    $('#errorMessage').hide();
                    
                    // Redirect if specified
                    if(response.redirect) {
                        setTimeout(function() {
                            window.location.href = response.redirect;
                        }, 2000);
                    }
                } else {
                    // Show error message
                    $('#errorMessage').html(response.message || 'An error occurred. Please try again.').show();
                    $('#successMessage').hide();
                }
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error('Form submission error:', error);
                console.log('XHR:', xhr.responseText);
                $('#errorMessage').html('An error occurred. Please try again.').show();
                $('#successMessage').hide();
            },
            complete: function() {
                // Re-enable submit button and hide loading indicator
                $('#submitButton').prop('disabled', false);
                $('#loadingIndicator').hide();
            }
        });
        
        return false; // Prevent form submission
    });
}); 