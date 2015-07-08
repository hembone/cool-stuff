var UTILS = {

	cookie : {
		set : function(name, value, days) {
			if (days) {
				var date = new Date();
				date.setTime(date.getTime()+(days*24*60*60*1000));
				var expires = "; expires="+date.toGMTString();
			} else var expires = "";
			document.cookie = name+"="+value+expires+"; path=/";
		}
		,get : function(name) {
			var nameEQ = name + "=";
			var ca = document.cookie.split(';');
			for (var i=0;i < ca.length;i++) {
				var c = ca[i];
				while (c.charAt(0)==' ') c = c.substring(1,c.length);
				if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
			}
			return null;
		}
		,remove : function(name) {
			UTILS.cookie.set(name,"",-1);
		}
	}

	,popupWindow : function(url, title, w, h) {
		var left = (screen.width/2)-(w/2);
		var top = (screen.height/2)-(h/2);
		return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	}

	// requires jQuery
	,animateScrollTo : function(offset, speed) {
		$('html, body').animate({ 
			scrollTop: offset
		}, speed);
	}

}