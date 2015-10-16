$(document).ready(function() {
	var APP = {

		global : {
			init : function() {
				if($('body').hasClass('home')){APP.home.init();}
				if($('body').hasClass('email-builder')){APP.emailBuilder.init();}
				if($('body').hasClass('email-manage')){APP.emailManage.init();}
				if($('body').hasClass('banner-tester')){APP.bannerTester.init();}
				if($('body').hasClass('social-ranking')){APP.socialRanking.init();}
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

			}
		},

		emailBuilder : {
			init : function() {

			}
		},

		emailManage : {
			init : function() {
				APP.emailManage.setListeners();
				APP.emailManage.buildCategoryList();
			},
			setListeners : function() {
				$(document).on('click', '#manage-tabs a', function(e) {
					e.preventDefault();
					$(this).tab('show');
				});
				$(document).on('submit', '#new-category', function(e) {
					e.preventDefault();
					if($('[name=cat_name]').val().trim()!=='') {
						var data = $(this).serializeArray();
						APP.global.sendToApi('new-category', data, APP.emailManage.newCategoryCallback);
					}
				});
			},
			newCategoryCallback : function(res) {
				if(res.success) {
					$('[name=cat_name]').val('');
					APP.emailManage.buildCategoryList();
				}
			},
			buildCategoryList : function() {
				var data = '';
				APP.global.sendToApi('get-categories', data, APP.emailManage.buildCategoryListCallback);
			},
			buildCategoryListCallback : function(res) {
				if(res.success && res.categories.length>0) {
					$.each(res.categories, function(index, value) {
						var html = '<div>'+value.name+'</div>';
						$('#insert-categories').append(html);
					});
				}
			}
		},

		bannerTester : {
			init : function() {
				APP.bannerTester.setListeners();
			},
			setListeners : function() {
	            $(document).on('click', '#settings', function() {
	                $('#settings-overlay').fadeIn();
	            });
	            $(document).on('click', '#close-settings', function() {
	                APP.bannerTester.buildIframes();
	                $('#settings-overlay').fadeOut();
	            });
				$(document).on('click', '#shuffle', function() {
	                APP.bannerTester.buildIframes();
	            });
	            $(document).on('click', '#refresh', function() {
	                $('iframe').each(function(idx, el) {
	                    $(el).attr('src', function(i, val) {return val;});
	                });
	            });
	            $(document).on('change', '.size-selection', function() {
	                $(this).parents('.form-group').find('input').attr('name', this.value);
	            });
	            $(document).on('click', '#add-field', function() {
	                APP.bannerTester.addField();
	            });
	            $(document).on('click', '#remove-field', function() {
	                $(this).parents('.form-group').remove();
	            });
	        },
	        addField : function() {
	            var html = '';
	            html += '<div class="form-group">';
	            html += '<div class="col-sm-2">';
	                html += '<select class="form-control size-selection">';
	                    html += '<option value="">Select Size...</option>';
	                    html += '<option value="160x600">160 x 600</option>';
	                    html += '<option value="180x150">180 x 150</option>';
	                    html += '<option value="300x250">300 x 250</option>';
	                    html += '<option value="300x600">300 x 600</option>';
	                    html += '<option value="640x480">640 x 480</option>';
	                    html += '<option value="728x90">728 x 90</option>';
	                    html += '<option value="970x90">970 x 90</option>';
	                html += '</select>';
	            html += '</div>';
	            html += '<div class="col-sm-8">';
	                html += '<input class="form-control iframe-input" type="text" name=""/>';
	            html += '</div>';
	            html += '<div class="col-sm-2">';
	                html += '<button id="remove-field" class="btn btn-danger btn-block pull-right"><i class="fa fa-close"></i> Remove</button>';
	            html += '</div>';
	            html += '</div>';
	            $('#banner-form').append(html);
	        },
			buildIframes : function() {
			    $('#insert-iframes').html('');
			    $("#banner-form input[type=text]").each(function() {
			        if(this.value!=='') {
			            var dims = this.name.split('x');
			            var w = dims[0];
			            var h = dims[1];
			            var url = this.value;
			            APP.global.sendToApi('get-lorem', {w:w, h:h, url:url}, APP.bannerTester.getLoremCallback);
			        }
			    });
			},
			getLoremCallback : function(res) {
			    var html = '';
			    html += '<div class="row">';
			    html += '<div class="col-sm-12">';
					var float = 'pull-left';
					if(Math.random() >= 0.5){float = 'pull-right';}
			        html += '<iframe class="'+float+'" width="'+res.w+'" height="'+res.h+'" src="'+res.url+'"></iframe>';
			        html += res.lorem;
			    html += '</div>';
			    html += '</div>';
			    $('#insert-iframes').append(html);
			}
		},

		socialRanking : {
			init : function() {
				$('#search-form').on('submit', function(e) {
					e.preventDefault();
					var data = $('#search-form').serializeArray();
					APP.global.sendToApi('search-twitter', data, APP.socialRanking.searchTwitterCallback);
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
