$(function() {

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



	$.validator.addMethod('strongPassword', function(value, element){

		return this.optional(element)
		|| value.length >=6
		&& /\d/.test(value)
		&& /[a-z]/i.test(value);

	}, 'Your Password must be at least 6 characters long and contain at least one number and one char\'.' 
		)

	$.validator.addMethod('customphone', function (value, element) {
		return this.optional(element) || /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(value);
	}, "Please enter a valid phone number")

	$.validator.addMethod("DOB", function (value, element) {
        var year = value.split('/');
        if ( value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/) && parseInt(year[2]) )
            return true;
        else
            return false;
    });


	$("#editProfile-form").validate(
	{

		rules:{
			email:{
				email: true
			},

			pass:{
				strongPassword: true

			},


			confirm: {
				equalTo: "#password"
			},

			phone: {
				customphone: true
				
			},

			postcode: {
				postcodeUK: true
				
			},



		},

		messages: {

			email:{
				email: 'Please enter a <em>valid</em> email address.'
			},

			confirm:{
				equalTo: 'Both passwords must match'
			},

			postcode:{
				postcodeUK: 'Please enter a <em>valid</em> UK postcode'
			}

		}


		});


});