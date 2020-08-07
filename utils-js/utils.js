var UTILS = {

	cookie : {
		set : function(name, value, days) {
			var expires = '';
			if(days) {
				var date = new Date();
				date.setTime(date.getTime()+(days*24*60*60*1000));
				expires = "; expires="+date.toGMTString();
			} else {
				expires = '';
			}
			document.cookie = name+"="+value+expires+"; path=/";
		},
		get : function(name) {
			var nameEQ = name + "=";
			var ca = document.cookie.split(';');
			for(var i=0;i < ca.length;i++) {
				var c = ca[i];
				while(c.charAt(0)===' ') {
					c = c.substring(1,c.length);
				}
				if(c.indexOf(nameEQ) === 0) {
					return c.substring(nameEQ.length,c.length);
				}
			}
			return null;
		},
		remove : function(name) {
			UTILS.cookie.set(name,"",-1);
		}
	},

	popupWindow : function(url, title, w, h) {
		var left = (screen.width/2)-(w/2);
		var top = (screen.height/2)-(h/2);
		return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	},

	windowWidth : function() {
		return window.innerWidth;
	},

	windowHeight : function() {
		return window.innerHeight;
	},

	// var seg = UTILS.urlSegment('name');
	urlSegment : function(e) {
		let n = window.location.pathname.split('/');
		return void 0 !== n[e] && n[e];
	},

	// var requestedParam = UTILS.urlParam('name');
	// var allParams = UTILS.urlParam();
	urlParam : function(param) {
		let vars = {};
		let parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,
			function(m,key,value) {
				vars[key] = value;
			});
		return (typeof vars[param] !== 'undefined') ? vars[param] : vars;
	},

	// UTILS.scrollTo('.contact-form', 200);
	scrollTo : function(selector, speed) {
		let offset = $(selector).offset();
		$('html, body').animate({
			scrollTop: offset.top
		}, speed);
	},

	isScrolled : {
		init : function(offset) {
			UTILS.isScrolled.check(offset);
			$(window).scroll(function() {
				UTILS.isScrolled.check(offset);
			});
		},
		check : function(offset) {
			let os = 20;
			if (offset) {
				os = offset;
			}
			if ($(window).scrollTop() > os) {
				$('.is-scrolled').addClass('scroll-active');
			} else {
				$('.is-scrolled').removeClass('scroll-active');
			}
		}
	},

	// Is the element visible in the viewport
	isVisible : function(selector) {
		$(window).scroll(function() {
			var top_of_element    = $(selector).offset().top;
			var bottom_of_element = $(selector).offset().top + $(selector).outerHeight();
			var bottom_of_screen  = $(window).scrollTop() + $(window).innerHeight();
			var top_of_screen     = $(window).scrollTop();
			if ((bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element)){
				return true;
			} else {
				return false;
			}
		});
	},

	resize : {
		init : function(callback) {
			if(typeof callback === 'function') {
				UTILS.resize.resizeTimeout='';
				UTILS.resize.set(callback);
				callback();
			}
		},
		set : function(callback) {
			$(window).on('resize', function() {
				clearTimeout(UTILS.resize.resizeTimeout);
				UTILS.resize.resizeTimeout = setTimeout(callback, 100);
			});
		}
	},

	matchHeight : function(fromSelector, toSelector) {
		let selHeight = $(this).height();
		$(toSelector).height(selHeight);
	}

};