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


	$("#register-form").validate(
	{

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

		messages: {

			email:{
				required: 'Please enter an email address.',
				email: 'Please enter a <em>valid</em> email address.'
			}
		}


		});


});