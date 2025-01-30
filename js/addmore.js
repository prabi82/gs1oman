function CheckEmail(val,rel){

    const emailPattern  =   /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    var Res             =   emailPattern.test(val);

    error = 0;
    if (Res) {
        $("#email_id_error_"+rel).html("");
    }else{
        $("#email_id_error_"+rel).html("Please enter a valid email");
        error = 1
    }
    return error
}

// function CheckPhoneNo(val,rel){
//     // alert("test");
//     const mobilePattern =   /^[6-9]\d{9}$/; // Adjust this pattern if needed
//      var Res             =   mobilePattern.test(val);

//     if (Res) {
//     }else{
//         $("#phone_number1_error_"+rel).html("Please enter a valid Phone Number");
//     }
// }

$(document).ready(function() {

     var buttonAdd = $("#add-button");

     var buttonRemove = $("#remove-button");

     var className = ".dynamic-field";

     var maxFields = 5;



     // Function to count total fields

     function totalFields() {

         return $(className).length;

     }



     // Function to add new input field

     // function addNewField() {

     //     var count = totalFields() + 1; // Increment count by 1

     //     var field = $("#dynamic-field-1").clone(); // Clone the existing field

     

     //     field.attr("id", "dynamic-field-" + count); // Change id

     //     field.find("h5").text("Additional Contact " + count); // Update heading

     //     field.find("input").val(""); // Clear input values

     //     field.find("select").prop("selectedIndex", 0); // Reset select field

     //     field.find(".text-danger").text(""); // Clear error messages

     

     //     $("#dynamic-field-" + (count - 1)).after(field); // Add the new field after the last field

     // }

     





    function addNewField() {

        var count = totalFields() + 1; // Increment count by 1

        var field = $("#dynamic-field-1").clone(); // Clone the existing field

        field.attr("id", "dynamic-field-" + count); // Change ID

        field.find("h5").text("Additional Contact " + count); // Update heading

        field.find("input").val(""); // Clear input values

        // Update the email input
            field.find("input[name='email_id[]']").attr("rel",count).attr("onchange","CheckEmail($(this).val(),"+count+")");
            field.find(".email_error").attr("id", "email_id_error_" + count);

        // Update the Mobile input
            field.find("input[name='phone_number1[]']")
                .attr("rel",count)
                .attr("onkeyup","ValidateNumberClass($(this),1)")
            ;
            // .attr("onchange","CheckPhoneNo($(this).val(),"+count+")")




        // Update the First/Last Name input
            field.find("input[name='first_name[]'], input[name='last_name[]']")
                .attr("onkeyup","ValidateAlphaCharClass($(this))")
            ;
      



        field.find(".phone_number_error").attr("id", "phone_number1_error_" + count);

        field.find("select").prop("selectedIndex", 0); // Reset select field
        field.find("span").text(""); // Clear error messages

        $("#dynamic-field-" + (count - 1)).after(field); // Add the new field after the last field

    }



     // Function to remove the last input field

     function removeLastField() {

         if (totalFields() > 1) {

             $(className + ":last").remove();

         }

     }



     // Enable remove button if more than one field

     function enableButtonRemove() {

         if (totalFields() === 2) {

             buttonRemove.removeAttr("disabled");

             buttonRemove.addClass("shadow-sm");

         }

     }



     // Disable remove button if only one field

     function disableButtonRemove() {

         if (totalFields() === 1) {

             buttonRemove.attr("disabled", "disabled");

             buttonRemove.removeClass("shadow-sm");

         }

     }



     // Disable add button if max fields reached

     function disableButtonAdd() {

         if (totalFields() === maxFields) {

             buttonAdd.attr("disabled", "disabled");

             buttonAdd.removeClass("shadow-sm");

         }

     }



     // Enable add button if below max fields

     function enableButtonAdd() {

         if (totalFields() === (maxFields - 1)) {

             buttonAdd.removeAttr("disabled");

             buttonAdd.addClass("shadow-sm");

         }

     }



     // Add button click event

     buttonAdd.click(function () {

         addNewField();

         enableButtonRemove();

         disableButtonAdd();

     });

     // Remove button click event

     buttonRemove.click(function () {

         removeLastField();

         disableButtonRemove();

         enableButtonAdd();

     });

});