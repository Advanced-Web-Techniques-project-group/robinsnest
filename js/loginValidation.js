$(function() {

	//Sets the colour of the HTML elements to red if an error and back to normal if there is no error
	$.validator.setDefaults({

		errorClass: 'help-block',

		highlight: function(element){

			$(element)
			.closest('.form-group')
			.addClass('has-error');
		},

		unhighlight: function(element){

			$(element)
			.closest('.form-group')
			.removeClass('has-error');
		}

	});

	//Targets the form with the ID of login-form
	$("#login-form").validate({

		//Sets rules for the username and password to both be required
		rules:{

			user:{

				required: true

			},

			pass:{
				required: true

			}
		}

	});
});