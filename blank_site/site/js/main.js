$(document).ready(function() {

	window.app = {

		global : {
			init : function() {
				if($('body').hasClass('home'))
					app.home.init();
				if($('body').hasClass('create-profile'))
					app.createProfile.init();
				if($('body').hasClass('login'))
					app.login.init();
			}
			,sendToApi : function(action, data, callback) {
				$.ajax({
					method: "POST"
					,url: "/api"
					,data: { action: action, data: data }
				})
				.success(function(res) {
					if(typeof callback==='function') {
						callback(res);
					}
				});
			}
		}

		,home : {
			init : function() {

			}
		}

		,createProfile : {
			init : function() {
				$('#create_form').validate({
					//debug: true,
					errorClass : "error",
					onkeyup: false,
					onclick: false,
					onfocusout: function (e) {
					    $(e).removeClass('error');
					    $(e).next('.error-inline').remove();
						$(e).valid();
					},
					rules: {
					  fname: {required : true, accept: "^[A-Za-z`-]+$"}
					  ,lname: {required : true, accept: "^[A-Za-z`-]+$"}
					  ,email: {required : true, email : true}
					  ,password: {required : true, minlength : 4}
					  ,password2: {required : true, equalTo : "input[name=password]"}
					},
					messages : {
					  fname : {
					  	required : "Looks like you forgot to add letters."
					  	,accept : "Letters only. We’re real sticklers."
					  }
					  ,lname : {
					  	required : "Looks like you forgot to add letters."
					  	,accept : "Letters only. We’re real sticklers."
					  }
					  ,email : "Hey! That’s no email address."
					  ,password : "Password doesn’t pass the test. Use 4-12 characters."
					  ,password2 : "You forgot already."
					},
					showErrors: function(errorMap, errorList) {
						//console.log(errorList);
						$("#form-errors").html('');
						if(!$.isEmptyObject(errorList)) {
							$("#form-errors").html("OOPS! GIVE EVERYTHING A SECOND LOOK");
						}
					    $.each(errorList, function(index, value) {
							$(value.element).addClass('error');
							$(value.element).next('.error-inline').remove();
							$(value.element).after('<div class="error-inline">'+value.message+'</div>');
					    });
					},
					submitHandler : function(form) {
						var data = $(form).serializeArray();
						app.global.sendToApi('add-user', data, app.createProfile.callback);
						return false;
					}
				});
			}
			,callback: function(res) {
				if(res.success) {
					window.location.href = '/';
				} else {
					if(res.message) {
						$('.error-message').html(res.message);
					}
				}
			}
		}

		,login : {
			init : function() {
				$('#login_form').validate({
					//debug: true,
					errorClass : "error",
					onkeyup: false,
					onclick: false,
					onfocusout: false,
					focusInvalid: false,
					rules: {
					  password : {required : true}
					  ,email : {required : true, email : true}
					},
					messages: {
					  email : "Please enter your email"
					  ,password : "Please enter a password"
					},
					showErrors: function(errorMap, errorList) {
					    $('.error').removeClass('error');
					    $('.error-inline').remove();
					    $.each(errorList, function (index, value) {
							$(value.element).addClass('error');
							$(value.element).after('<div class="error-inline">'+value.message+'</div>');
					    });
					},
					submitHandler : function (form) {
						var data = $(form).serializeArray();
						app.global.sendToApi('login', data, app.login.callback);
						return false;
					}
				});
			}
			,callback: function(res) {
				if(res.success) {
					window.location.href = '/';
				} else {
					if(res.message) {
						$('.error-message').html(res.message);
					}
				}
			}
		}

		,logoutCallback : function(res) {
			if(res.success) {
				window.location.href = '/';
			}
		}

	};
	app.global.init();
});