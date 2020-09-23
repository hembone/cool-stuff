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

	// UTILS.hasUrlSegment('segment-name');
	hasUrlSegment : function(segment) {
		let res = false;
		let segments = window.location.pathname.split('/');
		jQuery.each(segments, function(idx, val) {
			if (val === segment) {
				res = true;
			}
		});
		return res;
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
		let offset = jQuery(selector).offset();
		jQuery('html, body').animate({
			scrollTop: offset.top
		}, speed);
	},

	isScrolled : {
		init : function(offset) {
			UTILS.isScrolled.check(offset);
			jQuery(window).scroll(function() {
				UTILS.isScrolled.check(offset);
			});
		},
		check : function(offset) {
			let os = 20;
			if (offset) {
				os = offset;
			}
			if (jQuery(window).scrollTop() > os) {
				jQuery('.is-scrolled').addClass('scroll-active');
			} else {
				jQuery('.is-scrolled').removeClass('scroll-active');
			}
		}
	},

	// Is the element visible in the viewport
	isVisible : function(selector) {
		jQuery(window).scroll(function() {
			var top_of_element    = jQuery(selector).offset().top;
			var bottom_of_element = jQuery(selector).offset().top + jQuery(selector).outerHeight();
			var bottom_of_screen  = jQuery(window).scrollTop() + jQuery(window).innerHeight();
			var top_of_screen     = jQuery(window).scrollTop();
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
			jQuery(window).on('resize', function() {
				clearTimeout(UTILS.resize.resizeTimeout);
				UTILS.resize.resizeTimeout = setTimeout(callback, 100);
			});
		}
	},

	matchHeight : function(fromSelector, toSelector) {
		let selHeight = jQuery(this).height();
		jQuery(toSelector).height(selHeight);
	},

	//  Find all selected and match heights with the tallest one.
	evenHeight : function(selector) {
		let maxH = 0;
		let test = 0;
		jQuery(selector).each(function(idx) {
			test = jQuery(this).innerHeight();
			if (maxH < test) {
				maxH = test;
			}
		});
		jQuery(selector).css('min-height', maxH);
	}

};