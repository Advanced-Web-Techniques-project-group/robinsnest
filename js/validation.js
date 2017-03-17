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

	//Targets the form with the ID register-form
	$("#register-form").validate(
	{
		//Sets rules so that the data is of a valid format for each indivdual piece of data entered.
		rules:{
			email:{
				required: true,
				email: true
			},

			password:{
				required: true,
				strongPassword: true
			},

			Username:{
				required:true

			},
			
			confirm: {
				required: true,
				equalTo: "#password"
			},

			firstName:{
				required: true,
				nowhitespace: true,
				lettersonly: true
			},

			lastName:{
				required: true,
				nowhitespace: true,
				lettersonly: true
			}

		},

		//Messages for the relevant validation are displayed if an error occurs.
		messages: {

			email:{
				required: 'Please enter an email address.',
				email: 'Please enter a <em>valid</em> email address.'
			}
		}

	});
});