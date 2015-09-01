$(document).ready(function() {
	window.APP = {

		global : {
			init : function() {
				if($('body').hasClass('home'))
					APP.home.init();
			}
			,sendToApi : function(action, data, callback) {
				$.ajax({
					method: "POST"
					,url: "/api"
					,dataType: "json"
					,data: { key: '1', action: action, data: data }
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

	};
	APP.global.init();
});