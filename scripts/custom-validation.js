// Get the modal

var modal = document.getElementById("myModal");

// Get the button that opens the modal

var btn = document.getElementById("myBtn");

// Get the span element that closes the modal

var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 

btn.onclick = function () {

	modal.style.display = "block";

	var unitPrice = $("#unitPrice").val();

	var quantity = $("#quantity").val();

	document.getElementById('total_amount_display').innerHTML = '$' + (unitPrice * quantity).toFixed(2);

}

// When the user clicks on span (x), close the modal

span.onclick = function () {

	modal.style.display = "none";

}



$.validator.setDefaults({

    submitHandler: function() {

        alert("submitted!");

    }

});



$().ready(function() {

    // validate the comment form when it is submitted

    // validate signup form on keyup and submit

    var validator = $("#addressForm").validate({

        rules: {

            card_holder_name: "required",

            lastname: "required",

            username: {

                required: true,

                minlength: 2

            },

            password: {

                required: true,

                minlength: 5

            },

            confirm_password: {

                required: true,

                minlength: 5,

                equalTo: "#password"

            },

            email: {

                required: true,

                email: true

            },

            topic: {

                required: "#newsletter:checked",

                minlength: 2

            },

            agree: "required"

        },

        messages: {

            card_holder_name: "Please enter your firstname",

            lastname: "Please enter your lastname",

            username: {

                required: "Please enter a username",

                minlength: "Your username must consist of at least 2 characters"

            },

            password: {

                required: "Please provide a password",

                minlength: "Your password must be at least 5 characters long"

            },

            confirm_password: {

                required: "Please provide a password",

                minlength: "Your password must be at least 5 characters long",

                equalTo: "Please enter the same password as above"

            },

            email: "Please enter a valid email address",

            agree: "Please accept our policy",

            topic: "Please select at least 2 topics"

        },

        // the errorPlacement has to take the table layout into account

        /**errorPlacement: function(error, element) {

            if (element.is(":radio"))

                error.appendTo(element.parent().next().next());

            else if (element.is(":checkbox"))

                error.appendTo(element.next());

            else

                error.appendTo(element.parent().next());

        }, */

        // set this class to error-labels to indicate valid fields

        success: function(label) {

            // set &nbsp; as text for IE

            label.html("&nbsp;").addClass("checked");

        },

        highlight: function(element, errorClass) {

            $(element).parent().next().find("." + errorClass).removeClass("checked");

        },

        invalidHandler: function(e, validator) {

			var errors = validator.numberOfInvalids();

			if (errors) {

				var message = errors == 1

					? 'You missed 1 field. It has been highlighted below'

					: 'You missed ' + errors + ' fields.  They have been highlighted below';

				$("div.error span").html(message);

				$("div.error").show();

			} else {

				$("div.error").hide();

			}

		},

		onkeyup: false,

		submitHandler: function() {

			$("div.error").hide();

			alert("submit! use link below to go to the other step");

		},

        debug:true



    });



    // propose username by combining first- and lastname

    $("#card_holder_name").focus(function() {

        var card_holder_name = $("#card_holder_name").val();

        if (card_holder_name && !this.value) {

            this.value = card_holder_name ;

        }

    });





    $("input.phone").mask("(999) 999-9999");

    $("input.zipcode").mask("99999");

    var creditcard = $("#creditcard").mask("9999 9999 9999 9999");



    $("#cc_type").change(

        function() {

        switch ($(this).val()){

            case 'amex':

            creditcard.unmask().mask("9999 999999 99999");

            break;

            default:

            creditcard.unmask().mask("9999 9999 9999 9999");

            break;

        }

        }

    );



    // toggle optional billing address

    var subTableDiv = $("div.subTableDiv");

    var toggleCheck = $("input.toggleCheck");

    toggleCheck.is(":checked")

        ? subTableDiv.hide()

        : subTableDiv.show();

    $("input.toggleCheck").click(function() {

        if (this.checked == true) {

            subTableDiv.slideUp("medium");

            $("form").valid();

        } else {

            subTableDiv.slideDown("medium");

        }

    });















});