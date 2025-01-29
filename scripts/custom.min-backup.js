var validator = new FormValidator({

	// shows alert tooltip

	alerts: true,

	// custom trigger events

	// e.g. ['blur', 'input', 'change']

	events: false,

	// predefined validators

	regex: {

		url: /^(https?:\/\/)?([\w\d\-_]+\.+[A-Za-z]{2,})+\/?/,

		phone: /^\+?([0-9]|[-|' '])+$/i,

		numeric: /^[0-9]+$/i,

		alphanumeric: /^[a-zA-Z0-9]+$/i,

		email: {

			illegalChars: /[\(\)\<\>\,\;\:\\\/\"\[\]]/,

			filter: /^.+@.+\..{2,6}$/ // exmaple email "steve@s-i.photo"

		}

	},

	// default CSS classes

	classes: {

		item: 'field',

		alert: 'alert',

		bad: 'bad'

	},



});



/**

document.forms[0].onsubmit = function (e) {

	console.log("====================")

	var submit = true,

	validatorResult = validator.checkAll(this);

	console.log(validatorResult);

	return !!validatorResult.valid;

};





// on form "reset" event

document.forms[0].onreset = function (e) {

	validator.reset();

};

 */

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



function validateEmail(email) {

	const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

	return re.test(email);

  }



/*window.onload = function () {

  //Reference the DropDownList.

  var ddlYears = document.getElementById("expiryYear");

  //Determine the Current Year.

  var currentYear = (new Date()).getFullYear();

  //Loop and add the Year values to DropDownList.

  for (var i = currentYear; i <= currentYear + 20; i++) {

      var option = document.createElement("OPTION");

      option.innerHTML = i;

      option.value = i;

      ddlYears.appendChild(option);

  }

};*/



function resetData(mastercard, visa, disc, amrican){

	document.getElementById("#addressForm").reset();

	$('#addressForm').trigger("reset");

	$("#addressForm")[0].reset();

	document.getElementById('errorAlert').innerHTML = "";

	document.getElementById("errorAlert").style.display = 'none';

	document.getElementById("validCard").style.display = 'none';

	document.getElementById("notvalidCard").style.display = 'none';

	document.getElementById('shipping-address').style.display = "none";

	amrican.removeClass('transparent');

	visa.removeClass('transparent');

	disc.removeClass('transparent');

	mastercard.removeClass('transparent');

	document.getElementById("creditCardServiceMessage").style.display = 'none';

	$('#addressForm')[0].reset();

}



function checkCardNumberValidate(card1, card2, card3, card4){

	if(card1 == "" && card2 == "" && card3 == "" && card4 == ""){

		resetData();

	}

}



$(document).ready(function () {



	var mastercard = $("#mastercard");

	var visa = $("#visa");

	var disc = $("#disc");

	var amrican = $("#amrican");



	$("#allclear").click(function() {

		console.log("form clearning...");

		$('#addressForm').trigger("reset");

		document.getElementById('errorAlert').innerHTML = "";

		document.getElementById("errorAlert").style.display = 'none';

		document.getElementById("validCard").style.display = 'none';

		document.getElementById("notvalidCard").style.display = 'none';

		document.getElementById('shipping-address').style.display = "none";

		amrican.removeClass('transparent');

		visa.removeClass('transparent');

		disc.removeClass('transparent');

		mastercard.removeClass('transparent');

		document.getElementById("creditCardServiceMessage").style.display = 'none';

		location.reload();

	});



	$("#reset").click(function() {

		$('#addressForm').trigger("reset");

		document.getElementById('errorAlert').innerHTML = "";

		document.getElementById("errorAlert").style.display = 'none';

		document.getElementById("validCard").style.display = 'none';

		document.getElementById("notvalidCard").style.display = 'none';

		document.getElementById('shipping-address').style.display = "none";

		amrican.removeClass('transparent');

		visa.removeClass('transparent');

		disc.removeClass('transparent');

		mastercard.removeClass('transparent');

		$('#buttonAddress').prop('disabled', true);

		$('#buttonAddress').css('background-color', '#6c757d');

	});



	$('#buttonAddress').prop('disabled', true);

	$('#buttonAddress').css('background-color', '#6c757d');



	$('.optradio').click(function () {

		var radioValue = $("input[name='optradio']:checked").val();

		if (radioValue == 'Same') {

			//window.location.href = "<?php echo base_url("shopping/make_payment"); ?>";

			document.getElementById('shipping-address').style.display = "none";

		} else {

			document.getElementById('shipping-address').style.display = "block";

			//$('#serviceMessage').modal();

		}



	});



	$('.inputs').bind('keyup paste', function () {

		this.value = this.value.replace(/[^0-9]/g, '');

	});





	$("#cardNumber1").keyup(function () {

		var maxlimit = 4;

		var cardNumber1 = 0;

		console.log("Input value: " + this.value.length);

		if (this.value.length == maxlimit) {

			console.log("Input value reach max limit: " + this.value.length);

			$(this).next(':input').focus()

			$("#cardNumber2").focus();



			amrican.removeClass('transparent');

			visa.removeClass('transparent');

			disc.removeClass('transparent');

			mastercard.removeClass('transparent');



			cardNumber1 = $("#cardNumber1").val();

			var firstTwo = cardNumber1.substring(0, 1);

			var numberCard = firstTwo.trim()

			console.log(numberCard);



			if (numberCard == 4) {

				mastercard.addClass('transparent');

				disc.addClass('transparent');

				amrican.addClass('transparent');

				document.getElementById("errorAmericanCard").style.display = 'none';

			} else if (numberCard == 5) {

				visa.addClass('transparent');

				disc.addClass('transparent');

				amrican.addClass('transparent');

				document.getElementById("errorAmericanCard").style.display = 'none';

			} else if (numberCard == 6) {

				mastercard.addClass('transparent');

				visa.addClass('transparent');

				amrican.addClass('transparent');

				document.getElementById("errorAmericanCard").style.display = 'none';

			} else if (numberCard == 3) {

				disc.addClass('transparent');

				visa.addClass('transparent');

				mastercard.addClass('transparent');

				document.getElementById("errorAmericanCard").style.display = 'block';



			}else{

				disc.addClass('transparent');

				visa.addClass('transparent');

				mastercard.addClass('transparent');

				amrican.addClass('transparent');

				document.getElementById("errorAmericanCard").style.display = 'none';



			}





			return false;

		}

	});



	$("#cardNumber2").keyup(function () {

		var maxlimit = 4;

		console.log("Input value: " + this.value.length);

		if (this.value.length == maxlimit) {

			console.log("Input value reach max limit: " + this.value.length);

			$(this).next(':input').focus()

			$("#cardNumber3").focus();

			return false;

		}

	});



	$("#cardNumber3").keyup(function () {

		var maxlimit = 4;

		console.log("Input value: " + this.value.length);

		if (this.value.length == maxlimit) {

			console.log("Input value reach max limit: " + this.value.length);

			$(this).next(':input').focus()

			$("#cardNumber4").focus();

			return false;

		}

	});



	$("#cardNumber4").keyup(function () {

		var maxlimit = 4;

		console.log("Input value: " + this.value.length);

		if (this.value.length == maxlimit) {

			console.log("Input value reach max limit: " + this.value.length);

			$('#buttonAddress').prop('disabled', false);

			$('#buttonAddress').css('background-color', '#9E005D');



			$(this).next(':input').focus()

			$("#cvv").focus();

			return false;

		}

	});



	$("#cvv").keyup(function () {

		var maxlimit = 3;

		console.log("Input value: " + this.value.length);

		if (this.value.length == maxlimit) {

			console.log("Input value reach max limit: " + this.value.length);

			$(this).next(':input').focus()

			$("#inputExpDate").focus();

			return false;

		}

	});





	$('#buttonAddress').click(function () {

		var cardNumber1 = $("#cardNumber1").val();

		var cardNumber2 = $("#cardNumber2").val();

		var cardNumber3 = $("#cardNumber3").val();

		var cardNumber4 = $("#cardNumber4").val();

		var card_holder_name = $("#card_holder_name").val();

		var cvv = $("#cvv").val();

		var type = $("#type").val();

		var inputExpDate = $("#inputExpDate").val();

		//var expiryYear = $("#expiryYear").val();

		var email = $("#email").val();

		var confirm_email = $("#confirm_email").val();



		var address_1 = $("#address_1").val();

		var address_2 = $("#address_2").val();

		var city = $("#city").val();

		var state = $("#state").val();

		var zip = $("#zip").val();





		var radioValue = $("input[name='optradio']:checked").val();

		if (radioValue == 'Same') {



			//shipping-address

			var shipping_address_1 = $("#address_1").val();

			var shipping_address_2 = $("#address_2").val();

			var shipping_city = $("#city").val();

			var shipping_state = $("#state").val();

			var shipping_zip = $("#zip").val();





		} else {



			//shipping-address

			var shipping_address_1 = $("#shipping_address_1").val();

			var shipping_address_2 = $("#shipping_address_2").val();

			var shipping_city = $("#shipping_city").val();

			var shipping_state = $("#shipping_state").val();

			var shipping_zip = $("#shipping_zip").val();



		}





		const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

		var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;





		if (cardNumber1 == '' || cardNumber2 == '' || cardNumber3 == '' || cardNumber4 == '') {

			//alert('Please enter your Full Name');

			document.getElementById('errorAlert').innerHTML = 'Please enter credit card number';

			document.getElementById("errorAlert").style.display = 'block';

			$('#cardNumber').focus(); //The focus function will move the cursor to "fullname" field

		} else if (cvv == '') {

			document.getElementById('errorAlert').innerHTML = 'Please enter CVV';

			document.getElementById("errorAlert").style.display = 'none';

			document.getElementById("errorAlert").style.display = 'block';

			$('#cvv').focus();

		} else if (inputExpDate == '') {

			document.getElementById('errorAlert').innerHTML = 'Please enter vaild expiry month and year';

			document.getElementById("errorAlert").style.display = 'none';

			document.getElementById("errorAlert").style.display = 'block';

			$('#expiryDate').focus();

		} else if (card_holder_name == '') {

			document.getElementById('errorAlert').innerHTML = 'Please enter card holder name';

			document.getElementById("errorAlert").style.display = 'none';

			document.getElementById("errorAlert").style.display = 'block';

			$('#card_holder_name').focus();

		} else if (email == '' || !validateEmail(email)) {

			document.getElementById('errorAlert').innerHTML = 'Please enter valid email';

			document.getElementById("errorAlert").style.display = 'none';

			document.getElementById("errorAlert").style.display = 'block';

			$('#email').focus();

		} else if (email != confirm_email) {

			document.getElementById('errorAlert').innerHTML = "Email and confirm email should be same";

			document.getElementById("errorAlert").style.display = 'none';

			document.getElementById("errorAlert").style.display = 'block';

			$('#confirm_email').focus();

		} else if (city == '') {

			document.getElementById('errorAlert').innerHTML = 'Please enter city name';

			document.getElementById("errorAlert").style.display = 'none';

			document.getElementById("errorAlert").style.display = 'block';

			$('#city').focus();

		} else if (state == 'null') {

			document.getElementById('errorAlert').innerHTML = 'Please select state';

			document.getElementById("errorAlert").style.display = 'block';

			$('#state').focus();

		} else if (zip == '') {

			document.getElementById('errorAlert').innerHTML = 'Please enter zip code';

			document.getElementById("errorAlert").style.display = 'none';

			document.getElementById("errorAlert").style.display = 'block';

			$('#zip').focus();

		} else if (shipping_city == '') {

			document.getElementById('errorAlert').innerHTML = 'Please enter city name';

			document.getElementById("errorAlert").style.display = 'none';

			document.getElementById("errorAlert").style.display = 'block';

			$('#shipping_city').focus();

		} else if (shipping_state == 'null') {

			document.getElementById('errorAlert').innerHTML = 'Please select state';

			document.getElementById("errorAlert").style.display = 'block';

			$('#shipping_state').focus();

		} else if (shipping_zip == '' || shipping_zip.length != 5) {

			document.getElementById('errorAlert').innerHTML = 'Please enter valid zip code';

			document.getElementById("errorAlert").style.display = 'none';

			document.getElementById("errorAlert").style.display = 'block';

			$('#shipping_zip').focus();



			var cardNumber1 = $("#cardNumber1").val();

			var cardNumber2 = $("#cardNumber2").val();

			var cardNumber3 = $("#cardNumber3").val();

			var cardNumber4 = $("#cardNumber4").val();

			var card_holder_name = $("#card_holder_name").val();



			var cvv = $("#cvv").val();

			var type = $("#type").val();

			var card_holder_name = $("#card_holder_name").val();

			var inputExpDate = $("#inputExpDate").val();



		} else {



			

			var unitPrice = $("#unitPrice").val();

			var quantity = $("#quantity").val();



			var postData = {

				quantity: quantity,

				unitPrice: unitPrice,

				cardNumber1: cardNumber1,

				cardNumber2: cardNumber2,

				cardNumber3: cardNumber3,

				cardNumber4: cardNumber4,

				card_holder_name: card_holder_name,

				cvv: cvv,

				type: type,

				expiryDate: inputExpDate,

				email: email,

				address_1: address_1,

				address_2: address_2,

				city: city,

				state: state,

				zip: zip,

				shipping_address_1: shipping_address_1,

				shipping_address_2: shipping_address_2,

				shipping_city: shipping_city,

				shipping_state: shipping_state,

				shipping_zip: shipping_zip,

				optradio: radioValue

			}

			/**$.ajax({

				url: "/product",

				method: "POST",

				data: JSON.stringify(postData),

				dataType: 'json', // data type

				contentType: 'application/json',

				beforeSend: function () {

					// Show image container

					$("#loader").show();

				},

				success: function (data) {

					//var JSONResponse = JSON.parse(data);

					console.log(data);

					console.log("StatuCode: " + data.status);

					console.log("ResponseMessage: " + data.messages.success);

					$('#addressForm').trigger("reset");



					$('#addressForm').each(function () {

						document.getElementById('errorAlert').innerHTML = "";

						document.getElementById("errorAlert").style.display = 'none';

						document.getElementById("validCard").style.display = 'none';

						document.getElementById("notvalidCard").style.display = 'none';

					});



					if (data.status == '201') {

						$('#addressForm').trigger("reset");

						$('#creditCardStatus').text('Success');

						$('#creditCardResponse').text(data.messages.success);

						document.getElementById("myModal").style.display = 'none';

						$('#creditCardServiceMessage').modal("show");

					} else {

						$('#addressForm').trigger("reset");

						document.getElementById("myModal").style.display = 'none';

						$('#creditCardStatus').text('Failed');

						$('#creditCardResponse').text(data.messages.success);

						$('#creditCardServiceMessage').modal("show");

					}



				},

				complete: function (data) {

					// Hide image container

					$("#loader").hide();

					$('#addressForm').trigger("reset");

					$('#addressForm').each(function () {

						document.getElementById('errorAlert').innerHTML = "";

						document.getElementById("errorAlert").style.display = 'none';

						document.getElementById("validCard").style.display = 'none';

						document.getElementById("notvalidCard").style.display = 'none';

					});



				}

			}); */

			$("#loader").show();

			axios.post('/product', JSON.stringify(postData))

			  .then((response) => {

				console.log(response);

				$('#addressForm').trigger("reset");

				$('#addressForm').each(function () {

					document.getElementById('errorAlert').innerHTML = "";

					document.getElementById("errorAlert").style.display = 'none';

					document.getElementById("validCard").style.display = 'none';

					document.getElementById("notvalidCard").style.display = 'none';

				});



				if (data.status == '201') {

					$('#addressForm').trigger("reset");

					$('#creditCardStatus').text('Success');

					$('#creditCardResponse').text(response.data.messages.success);

					document.getElementById("myModal").style.display = 'none';

					$('#creditCardServiceMessage').modal("show");

				} else {

					$('#addressForm').trigger("reset");

					document.getElementById("myModal").style.display = 'none';

					$('#creditCardStatus').text('Failed');

					$('#creditCardResponse').text(response.data.messages.success);

					$('#creditCardServiceMessage').modal("show");

				}



				$("#loader").hide();

					$('#addressForm').trigger("reset");

					$('#addressForm').each(function () {

						document.getElementById('errorAlert').innerHTML = "";

						document.getElementById("errorAlert").style.display = 'none';

						document.getElementById("validCard").style.display = 'none';

						document.getElementById("notvalidCard").style.display = 'none';

					});







			  }, (error) => {

				console.log(error);



				$("#loader").hide();

					$('#addressForm').trigger("reset");

					$('#addressForm').each(function () {

						document.getElementById('errorAlert').innerHTML = "";

						document.getElementById("errorAlert").style.display = 'none';

						document.getElementById("validCard").style.display = 'none';

						document.getElementById("notvalidCard").style.display = 'none';

					});





			  });

			  



		}





	});





	$('.cardNumber').keyup(function () {



		var cardNumber1 = $("#cardNumber1").val();

		var cardNumber2 = $("#cardNumber2").val();

		var cardNumber3 = $("#cardNumber3").val();

		var cardNumber4 = $("#cardNumber4").val();



		var cardNumber = cardNumber1 + cardNumber2 + cardNumber3 + cardNumber4;



		console.log('Enter CardNumber: ' + cardNumber);

		var card = {

			cardNumber: cardNumber

		};

		$.ajax({

			url: "/validateCard/" + cardNumber,

			success: function (data) {

				var data = JSON.parse(data);

				console.log(data);

				console.log(data.status);

				if (data.status == 'VALID') {

					document.getElementById("validCard").style.display = 'block';

					document.getElementById("notvalidCard").style.display = 'none';

					$('#buttonAddress').prop('disabled', false);

					$('#buttonAddress').css('background-color', '#9E005D');

				} else {

					$('#buttonAddress').prop('disabled', true);

					$('#buttonAddress').css('background-color', '#6c757d');

					document.getElementById("validCard").style.display = 'none';

					document.getElementById("notvalidCard").style.display = 'block';

				}





			},

			error: function (xhr, status, error) {

				console.log(error);



			}

		});



	});







});



		