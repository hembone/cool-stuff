var AGEGATE = {

	configs : {
		'home' : '/'
		,'cookieId' : 'pra2Mk3EGHddM3pVMKAXvnRyapZB7HCQ'
	}

	,init : function() {
		AGEGATE.buildOverlay();
		AGEGATE.check();
	}

	,check : function() {
		var cookie = AGEGATE.cookie.get(AGEGATE.configs.cookieId);
		if(cookie) {
			AGEGATE.cookie.set(AGEGATE.configs.cookieId, 1, 365);
		} else {
			$('#agegate-overlay').show();
		}
	}

	,checkAge : function() {
		var month = $('[name=month]').val();
		var day = $('[name=day]').val();
		var year = $('[name=year]').val();

		if(!isNaN(parseInt(month)) && !isNaN(parseInt(day)) && !isNaN(parseInt(year))) {
			var tdate = new Date(),
				tyear = tdate.getFullYear(),
				tmonth = tdate.getMonth(),
				tday = tdate.getDate(),
				age = tyear - parseInt(year);
			if(tmonth < (parseInt(month) - 1))
				age--;
			if(((parseInt(month) - 1) == tmonth) && (tday < parseInt(day)))
				age--;
			if(age >= 21) {
				AGEGATE.cookie.set(AGEGATE.configs.cookieId, 1, 365);
				$('#agegate-overlay').fadeOut();
			} else  {
				$('#ag-error-text').html('You must be 21 to enter this site').show();
			}
		}
	}

	,buildOverlay : function() {
		var html = '';

		html += '<div id="agegate-overlay">';
		html += '<div class="ag-modal">';

		html += '<h1>When were you born?</h1>';

		html += '<select name="month">';
		for(i=1; i<=12; i++) { 
			html += '<option value="'+i+'">'+i+'</option>';
		}
		html += '</select>';

		html += '<select name="day">';
		for(i=1; i<=31; i++) { 
			html += '<option value="'+i+'">'+i+'</option>';
		}
		html += '</select>';

		html += '<select name="year">';
		for(i=2015; i>=1920; i--) { 
			html += '<option value="'+i+'">'+i+'</option>';
		}
		html += '</select>';

		html += '<button id="submit-age">Go</button>';
		html += '<div id="ag-error-text"></div>';

		html += '</div>';
		html += '</div>';

		$('body').prepend(html);

		$(document).on('click', '#submit-age', function(e) {
			AGEGATE.checkAge();
		});
	}

	,cookie : {
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
			AGEGATE.cookie.set(name,"",-1);
		}
	}

}
AGEGATE.init();