(function($) {
	var resizeTimeout;
	var e=window.navigator.userAgent==""?"Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20120101 Firefox/29.0":window.navigator.userAgent,t=!!(num=e.match(/((?=.*Trident)(?=.*(msie|rv).([\d]{1,2})))/i))?"ie"+num[3]:false,n=t||e.match(/Safari|Firefox|Chrome/i)[0].toLowerCase()||"",r=/ipad|tablet|xoom|kindle|android(?!.*mobile)/i.test(e),i=/^(?=.*mobi|mini|phone|port|x320)(?:(?!ipad).)+$/i.test(e);n+=i?" mobile-landed mobile":r?" desktop-landed desktop tablet":" desktop-landed desktop";n+=(a=e.match(/(ipad|ipod|iphone|android|kindle|xoom)/i))?" "+a[0].toLowerCase():"";document.getElementsByTagName("html")[0].className=n;

	function resize() {
		$('.outer-wrapper').css('width', '');
		$('.outer-wrapper').css('width', $(window).innerWidth());
		if($("html.desktop-landed").length>0){$("html").removeClass("mobile").removeClass("desktop");if($(window).innerWidth()<768)$("html").addClass("mobile");else $("html").addClass("desktop")}
	}

	$(window).on('resize', function() {
		clearTimeout(resizeTimeout);
		resizeTimeout = setTimeout(resize, 100);
	});

	$(document).ready(function() {
		resize();

		window.app = {

			global: {
				init: function() {
					if($('body').hasClass('age-gate'))
						app.ageGate.init();
					if($('body').hasClass('home'))
						app.home.init();
				},
			},

			ageGate: {
				init: function() {

				},
	        },

	        home: {
	        	init: function() {

	        	},
	        },

		};
		app.global.init();
	});
})(jQuery);

$('#create_form').validate({
	errorClass : "error",
	//debug: true,
	onkeyup: false,
	onclick: false,
	onfocusout: function (element) {
	    $(element).removeClass('error');
	    $(element).next('.error-inline').remove();
	$(element).valid();
	},
	rules: {
	  fname: {required : true, accept: "^[A-Za-z`-]+$"}
	  ,lname: {required : true, accept: "^[A-Za-z`-]+$"}
	  ,email: {required : true, email : true}
	  ,phone: {required : true, phoneUS : true}
	  ,zip: {required : true, zipcode : true}
	  ,password: {required : true, minlength : 4}
	  ,password2: {required : true, equalTo : "input[name=password]"}
	  ,"age[month]" : {required : true}
	  ,"age[day]" : {required : true}
	  ,"age[year]" : {required : true}
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
	  ,phone : "Looks like someone fudged the numbers.<br/>(XXX-XXX-XXXX)"
	  ,zip : "Five digits or the deal’s off."
	  ,password : "Password doesn’t pass the test. Use 4-12 characters."
	  ,password2 : "You forgot already."
	},
	showErrors: function(errorMap, errorList) {
		//console.log(errorList);
		$("#form-errors").html("");

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
		if(app.global.dobVal('#create_form')) {
		var DOB=[];
		for(var i=0,a=form.querySelectorAll('[name^=age]');i<a.length;i++){
		  DOB.push(a[i].value);
		}
		if( $('[name=dob]').is('*') ) {
		  $('[name=dob]').val( Date.parse( DOB.join('/') )/1000 );
		} else {
		  $('<input />', {
		    type: 'hidden',
		    name: 'dob',
		    value: Date.parse( DOB.join('/') )/1000
		  }).appendTo(form);
		}
		var data = $(form).serializeArray();
		swarm.add_user(data,form);
		return false;
		}
	}
});
  
$('#login_form').validate({
	errorClass : "error",
	//debug: true,
	onkeyup: false,
	onclick: false,
	onfocusout: false,
	focusInvalid: false,
	rules: {
	  password : {required : true},
	  email : {required : true, email : true},
	},
	messages: {
	  email : "Please enter your email",
	  password : "Please enter a password",
	},
	showErrors: function(errorMap, errorList) {
		$("#login-form-errors").html("");
	    $('.error').removeClass('error');
	    $('.error-inline').remove();
	    $.each(errorList, function (index, value) {
		$(value.element).addClass('error');
		$(value.element).after('<div class="error-inline">'+value.message+'</div>');
	    });
	},
	submitHandler : function (form) {
	  var data = $(form).serializeArray();
	  swarm.login(data,form);
	  return false;
	}
});