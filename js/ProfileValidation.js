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

	// Declares a custom methos which checks that the password is at least 6 characters
	// long and includes at least one number and one character
	$.validator.addMethod('strongPassword', function(value, element){

		return this.optional(element)
		|| value.length >=6
		&& /\d/.test(value)
		&& /[a-z]/i.test(value);

	}, 'Your Password must be at least 6 characters long and contain at least one number and one char\'.' 
	)

	//Declares a new method for a valid phone number 
	$.validator.addMethod('customphone', function (value, element) {
		return this.optional(element) || /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(value);
	}, "Please enter a valid phone number")

	//Targets the form with the ID editProfile-form
	$("#editProfile-form").validate(
	{
		//Sets rules so that the data is of a valid format for each indivdual piece of data entered.
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

		//Messages for the relevant validation are displayed if an error occurs.
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