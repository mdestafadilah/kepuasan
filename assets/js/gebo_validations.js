$(document).ready(function(){
	gebo_validation.reg();
	gebo_validation.login();
});

//* validation
gebo_validation = {
    reg: function() {
        reg_validator = $('.form_validation_reg').validate({
			onkeyup: false,
			errorClass: 'error',
			validClass: 'valid',
			highlight: function(element) {
				$(element).closest('div').addClass("f_error");
			},
			unhighlight: function(element) {
				$(element).closest('div').removeClass("f_error");
			},
            errorPlacement: function(error, element) {
                $(element).closest('div').append(error);
            },
            rules: {
				reg_first_name: { required: true, minlength: 3 },
				reg_last_name: { required: true, minlength: 3 },
				reg_your_message: { required: true, minlength: 20 },
				reg_days: { required: true, minlength: 2 },
				reg_gender: { required: true },
				reg_address2: { required: true, minlength: 5 },
				reg_city: { required: true, minlength: 2 },
				reg_state: { required: true, minlength: 3 }
			},
            invalidHandler: function(form, validator) {
				$.sticky("There are some errors. Please corect them and submit again.", {autoclose : 5000, position: "top-right", type: "st-error" });
			}
        })
    }
};

// login
gebo_validation = {
	login:function(){
		
	}
}

