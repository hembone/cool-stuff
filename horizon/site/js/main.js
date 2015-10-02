$(document).ready(function() {
	window.APP = {

		global : {
			init : function() {
				if($('body').hasClass('home'))
					APP.home.init();
			},
			sendToApi : function(action, data, callback) {
				$.ajax({
					method: "POST",
					url: "/api",
					dataType: "json",
					data: { key: '1', action: action, data: data }
				})
				.success(function(res) {
					if(typeof callback==='function') {
						callback(res);
					}
				});
			}
		},

		home : {
			init : function() {
				$('#search-form').on('submit', function(e) {
					e.preventDefault();
					var data = $('#search-form').serializeArray();
					APP.global.sendToApi('search-twitter', data, APP.home.searchTwitterCallback);
				});
			},
			searchTwitterCallback : function(res) {
				//console.log(res.result);
				var html = '';
				$.each(res.result.data, function(index, value) {
					//console.log(value.text);
					html += '<p>'+value.text+'</p>';
				});
				$('#tweets').html(html);
				$('#hits').html(res.result.total);
			}
		}

	};
	APP.global.init();
});
