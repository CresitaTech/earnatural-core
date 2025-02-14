$(document).ready(function() {
	var values = ["1", "2", "3","4","5","6","7","8","9","10"];
	const makeQuantityOption = function(values){
		$("#qty").empty();
		var select = $('<select>').prop('id', 'quantity').prop('name', 'quantity').prop('class', 'form-control form-control-sm');
		$(values).each(function() {
			select.append($("<option>")
			.prop('value', this)
			.text(this.charAt(0).toUpperCase() + this.slice(1)));
		});
		$('#qty').append(select);
	}
	makeQuantityOption(values);

	const makeButtonDisabled = function(){
		console.log('Button making disabled')
		$('#buttonAddress').prop('disabled', true);
		$('#buttonAddress').css('background-color', '#6c757d');
	}
	const makeButtonEnabled = function(){
		console.log('Button making enabled')
		$('#buttonAddress').prop('disabled', false);
		$('#buttonAddress').css('background-color', '#9E005D');
	}

	$("#promocode").change(function () {
        var end = this.value;
		console.log("==========: " + end);
		var $option = $(this).find('option:selected');
		//Added with the EDIT
		var value = $option.val();//to get content of "value" attrib
		var text = $option.text();//to get <option>Text</option> content
		console.log("Get prmocode name: " + text );
		if(text=='Reseller-Pharmacy'){
			var values = ["5","6","7","8","9","10"];
			makeQuantityOption(values);
		}else{
			var values = ["1", "2", "3","4","5","6","7","8","9","10"];
			makeQuantityOption(values);
		}
		
    });

	var modal = document.getElementById("myModal");
	var btn = document.getElementById("myBtn");
	var span = document.getElementsByClassName("close")[0];
	btn.onclick = function() {
			$("#addressForm").parsley().reset();
			document.getElementById('shipping-address').style.display = "none";
			modal.style.display = "block";
			var unitPrice = $("#unitPrice").val();
			var quantity = $("#quantity").val();
			var promocode = $("#promocode").val();
			console.log(promocode)
			if(promocode != 'null') {
				axios.get('/api/promocodes/' + promocode).then(function(response) {
					var res = JSON.parse(JSON.stringify(response.data));
					if(res.data.promocode_type == 'Percentage') {
						$('#total_amount_display').html('$' + (unitPrice * quantity - Math.round(parseFloat(unitPrice * quantity * (res.data.promocode_discount / 100)))).toFixed(2));
					} else {
						$('#total_amount_display').html('$' + (unitPrice * quantity - Math.round(parseFloat(res.data.promocode_discount))).toFixed(2));
					}
				}).catch(function(error) {
					if(error.response) { 
						console.log(error.response.data);
					} else if(error.request) {
						console.log(error.request);
					} else { 
						console.log('Error', error.message);
					}
				});
			} else {
				document.getElementById('total_amount_display').innerHTML = '$' + (unitPrice * quantity).toFixed(2);
			}
		}
	span.onclick = function() {
		modal.style.display = "none";
	}
	makeButtonDisabled()
	//$('#buttonAddress').prop('disabled', true);
	//$('#buttonAddress').css('background-color', '#6c757d');
	var mastercard = $("#mastercard");
	var visa = $("#visa");
	var discover = $("#discover");
	var amex = $("#amex");
	var cleaveDate = new Cleave('#inputExpDate', {
		date: true,
		datePattern: ['m', 'y'],
		onValueChanged: function(e) {
			var currentMon = new Date().getMonth().toString()
			var currentYear = new Date().getFullYear().toString().substr(-2)
			if(currentMon < 10) {
				currentMon = '0' + currentMon;
			}
		}
	});
	$('#inputExpDate').on('blur', function(e) {
		var monYr = $('#inputExpDate').val().split("/");
		var currentMon = new Date().getMonth().toString()
		var currentYear = new Date().getFullYear().toString().substr(-2)
		if(currentMon < 10) {
			currentMon = '0' + currentMon;
		}
		var selectedMonth = monYr[0];
		var selectedYear = monYr[1];
		if(selectedYear < 10) {
			selectedYear = '0' + selectedYear;
		}
		document.getElementById("errorAmericanCard").style.display = 'none';
		if(selectedMonth < currentMon && selectedYear <= currentYear) {
			document.getElementById("errorAmericanCard").style.display = 'block';
			document.getElementById("errorAmericanCard").innerHTML = 'Enter month not valid. Please enter valid month in Expire Date.';
		}
		if(selectedYear < currentYear) {
			document.getElementById("errorAmericanCard").style.display = 'block';
			document.getElementById("errorAmericanCard").innerHTML = 'Enter year not valid. Please enter valid year in Expire Date.';
		}
	});
	var cleaveCC = new Cleave('#cardNumber', {
		creditCard: true,
		delimiter: '-',
		onCreditCardTypeChanged: function(type) {
			$.fn.clearCardIcon();
			if(type == 'mastercard' || type == 'visa' || type == 'discover') {
				$(`#${type}`).removeClass('transparent');
				console.log('Card type ' + type + ' found')
			} else if(type == 'amex') {
				document.getElementById("errorAmericanCard").style.display = 'block';
				document.getElementById("errorAmericanCard").innerHTML = 'We do not accept American Express, please enter any visa, dicover and master card number.';
			} else {
				document.getElementById("errorAmericanCard").style.display = 'block';
				document.getElementById("errorAmericanCard").innerHTML = 'We accpet master, visa and dicover card only.';
			}
			makeButtonEnabled()
			//$('#buttonAddress').prop('disabled', false);
			//$('#buttonAddress').css('background-color', '#9E005D');
		}
	});
	var cleaveCvv = new Cleave('#cvv', {
		numeral: true,
	});
	console.log(cleaveCvv);
	$.fn.extend({
		clearForm: function(instance) {
			instance.reset();
			instance.refresh();
			console.log(instance.$element)
			document.getElementById("validCard").style.display = 'none';
			document.getElementById("notvalidCard").style.display = 'none';
			document.getElementById('shipping-address').style.display = "none";
			document.getElementById("errorAmericanCard").style.display = 'none';

			//$('#buttonAddress').prop('disabled', true);
			//$('#buttonAddress').css('background-color', '#6c757d');
			makeButtonDisabled();

			$('#addressForm').find('input:text, input:password, select, textarea')
			.each(function () {
				console.log('Field ID: ' + $(this).attr('id'));
				$(this).val('');
            });
			$("#email").val("");
			$("#confirm_email").val("");

			$('input[name="optradio"]').prop('checked', false);
			var $radios = $('input:radio[name=optradio]');
			if($radios.is(':checked') === false) {
				$radios.filter('[value=Same]').prop('checked', true);
			}
		},
		clearCardIcon: function() {
			console.log('Card Icon clearing....')
			amex.addClass('transparent');
			visa.addClass('transparent');
			discover.addClass('transparent');
			mastercard.addClass('transparent');
			document.getElementById("errorAmericanCard").style.display = 'none';
		}
	});

	$("#reset").click(function() {
		var instance = $('#addressForm').parsley(parsleyConfig);
		$.fn.clearForm(instance);
	});
	$("#allclear").click(function() {
		var instance = $('#addressForm').parsley(parsleyConfig);
		$.fn.clearForm(instance);
	});
	$("#cardNumber").keyup(function() {
		var maxlimit = 19;
		console.log("Input value: " + this.value.length);
		if(this.value.length == maxlimit) {
			console.log("Input value reach max limit: " + this.value.length);
			$(this).next(':input').focus()
			$("#cvv").focus();
			return false;
		}
		if(this.value.length == 0) {
			document.getElementById("validCard").style.display = 'none';
			document.getElementById("notvalidCard").style.display = 'none';
			document.getElementById("errorAmericanCard").style.display = 'none';
			return false;
		}
	});
	$("#cvv").keyup(function() {
		var maxlimit = 3;
		console.log("Input value: " + this.value.length);
		if(this.value.length == maxlimit) {
			console.log("Input value reach max limit: " + this.value.length);
			$(this).next(':input').focus()
			$("#inputExpDate").focus();
			return false;
		}
	});
	$('.optradio').click(function() {
		var radioValue = $("input[name='optradio']:checked").val();
		if(radioValue == 'Same') {
			document.getElementById('shipping-address').style.display = "none";
			$("input[name='shipping_city']").val("");
			$("#shipping_state").val("");
			$("input[name='shipping_zip']").val("");
			$("#shipping_address_1").val("");
			$("#shipping_address_2").val("");
		} else {
			document.getElementById('shipping-address').style.display = "block";
		}
	});
	var parsleyConfig = {
		errorsContainer: function(parsleyField) {
			var fieldSet = parsleyField.$element.closest('fieldset');
			if(fieldSet.length > 0) {
				return fieldSet.find('#checkbox-errors');
			}
			return parsleyField;
		}
	};
	$('#buttonAddress').click(function() {
		var formInstance = $('#addressForm').parsley(parsleyConfig).validate();
		var instance = $('#addressForm').parsley(parsleyConfig);
		var radioValue = $("input[name='optradio']:checked").val();
		if(radioValue != 'Same') {
			$("input[name='shipping_city']").attr('data-parsley-required', 'true');
			$("#shipping_state").attr('required', 'true');
			$("input[name='shipping_zip']").attr('data-parsley-required', 'true');
		} else {
			$("input[name='shipping_city']").removeAttr('data-parsley-required', 'true');
			$("#shipping_state").removeAttr('required', 'true');
			$("input[name='shipping_zip']").removeAttr('data-parsley-required', 'true');
		}
		if(instance.isValid()) {
			var cardNumber = $("#cardNumber").val();
			cardNumber = cardNumber.replace(/[^0-9]/g, '');
			var card_holder_name = $("#card_holder_name").val();
			var cvv = $("#cvv").val();
			var type = $("#type").val();
			var inputExpDate = $("#inputExpDate").val();
			var email = $("#email").val();
			var address_1 = $("#address_1").val();
			var address_2 = $("#address_2").val();
			var city = $("#city").val();
			var state = $("#state").val();
			var zip = $("#zip").val();
			var radioValue = $("input[name='optradio']:checked").val();
			if(radioValue == 'Same') {
				var shipping_address_1 = $("#address_1").val();
				var shipping_address_2 = $("#address_2").val();
				var shipping_city = $("#city").val();
				var shipping_state = $("#state").val();
				var shipping_zip = $("#zip").val();
			} else {
				var shipping_address_1 = $("#shipping_address_1").val();
				var shipping_address_2 = $("#shipping_address_2").val();
				var shipping_city = $("#shipping_city").val();
				var shipping_state = $("#shipping_state").val();
				var shipping_zip = $("#shipping_zip").val();
			}
			var unitPrice = $("#unitPrice").val();
			var quantity = $("#quantity").val();
			var promocode = $("#promocode").val();
			var product_name = $("#productName").val();
			var product_desc = $("#productDesc").val();
			var shipping_charge = $("#shippingCharge").val();
			var postData = {
				quantity: quantity,
				unit_price: unitPrice,
				card_number: cardNumber,
				card_holder_name: card_holder_name,
				cvv: cvv,
				type: type,
				expiry_date: inputExpDate,
				email: email,
				address_1: address_1,
				address_2: address_2,
				city: city,
				state: state,
				zip: zip,
				promocode: promocode,
				product_name: product_name,
				product_desc: product_desc,
				shipping_charge: shipping_charge,
				shipping_address_1: shipping_address_1,
				shipping_address_2: shipping_address_2,
				shipping_city: shipping_city,
				shipping_state: shipping_state,
				shipping_zip: shipping_zip,
				optradio: radioValue
			}
			$("#loader").show();
			axios.post('/api/makepayment', JSON.stringify(postData)).then((response) => {
				if(response.data.status == '201') {
					instance.reset();
					$.fn.clearForm(instance);
					$.fn.clearCardIcon();
					$('#creditCardStatus').text('Success');
					$('#creditCardResponse').text(response.data.messages.success);
					document.getElementById("myModal").style.display = 'none';
					$('#creditCardServiceMessage').modal("show");
				} else {
					$('#creditCardErrorStatus').text('Failed');
					$('#creditCardErrorResponse').text(response.data.messages.success);
					$('#creditCardServiceErrorMessage').modal("show");
				}
				$("#loader").hide();
			}, (error) => {
				console.log(error);
				$("#loader").hide();
				$('#creditCardStatus').text('Failed');
				$('#creditCardResponse').text('Cannot connect to the server. please try again after some time.');
				$('#creditCardServiceMessage').modal("show");
				instance.reset();
				$.fn.clearForm(instance);
				$.fn.clearCardIcon();
			});
		}
	});
	$('.cardNumber').keyup(function() {
		var cardNumber = $("#cardNumber").val();
		cardNumber = cardNumber.replace(/[^0-9]/g, '');
		axios.get('/api/validateCard/' + cardNumber).then((response) => {
			console.log(response.data.data);
			if(response.data.data == 'VALID') {
				document.getElementById("validCard").style.display = 'block';
				document.getElementById("notvalidCard").style.display = 'none';
				//$('#buttonAddress').prop('disabled', false);
				//$('#buttonAddress').css('background-color', '#9E005D');
				makeButtonEnabled();
			} else {
				makeButtonDisabled();
				//$('#buttonAddress').prop('disabled', true);
				//$('#buttonAddress').css('background-color', '#6c757d');
				document.getElementById("validCard").style.display = 'none';
				document.getElementById("notvalidCard").style.display = 'block';
			}
		}, (error) => {
			console.log(error);
		});
	});
});