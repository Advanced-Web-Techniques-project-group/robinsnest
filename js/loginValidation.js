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

$("#login-form").validate({

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