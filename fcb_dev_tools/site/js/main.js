var APP;
$(document).ready(function() {
	APP = {

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
				APP.emailManage.buildBlockList();
				APP.emailManage.buildCategoryList();
				APP.emailManage.buildClientList();
				APP.emailManage.loadAce();
			},
			setListeners : function() {
				$(document).on('click', '#manage-tabs a', function(e) {
					e.preventDefault();
					$(this).tab('show');
				});
				$(document).on('click', '#new-block', function() {
					$('#manage-overlay').fadeIn();
				});
				$(document).on('click', '#close-overlay', function() {
					$('#manage-overlay').fadeOut();
				});
				$(document).on('submit', '#edit-block-form', function(e) {
					e.preventDefault();
					if($('#block-name').val().trim()!=='') {
						var data = $(this).serializeArray();
						APP.global.sendToApi('edit-block', data);
						$('#manage-overlay').fadeOut();
					}
				});
				$(document).on('submit', '#new-category', function(e) {
					e.preventDefault();
					if($('[name=cat_name]').val().trim()!=='') {
						var data = $(this).serializeArray();
						APP.global.sendToApi('new-category', data, APP.emailManage.newCategoryCallback);
					}
				});
				$(document).on('submit', '.edit-category-form', function(e) {
					e.preventDefault();
					if($('[name=edit_cat_name]').val().trim()!=='') {
						var data = $(this).serializeArray();
						APP.global.sendToApi('edit-category', data, APP.emailManage.editCategoryCallback);
					}
				});
				$(document).on('submit', '#new-client', function(e) {
					e.preventDefault();
					if($('[name=client_name]').val().trim()!=='') {
						var data = $(this).serializeArray();
						APP.global.sendToApi('new-client', data, APP.emailManage.newClientCallback);
					}
				});
				$(document).on('submit', '.edit-client-form', function(e) {
					e.preventDefault();
					if($('[name=edit_client_name]').val().trim()!=='') {
						var data = $(this).serializeArray();
						APP.global.sendToApi('edit-client', data, APP.emailManage.editClientCallback);
					}
				});
			},
			loadAce : function() {
				APP.cssAce = ace.edit("css_ace");
				APP.cssAce.getSession().setMode("ace/mode/css");
				APP.cssAce.session.setUseWorker(false);
				APP.cssAce.setValue($('#css').val(), 1);

				APP.htmlAce = ace.edit("html_ace");
				APP.htmlAce.getSession().setMode("ace/mode/html");
				APP.htmlAce.session.setUseWorker(false);
				APP.htmlAce.setValue($('#html').val(), 1);
			},
			buildBlockList : function() {

			},
			newCategoryCallback : function(res) {
				if(res.success) {
					$('[name=cat_name]').val('');
					APP.emailManage.buildCategoryList();
				}
			},
			editCategoryCallback : function(res) {
				if(res.success) {
					APP.emailManage.buildCategoryList();
				}
			},
			deleteCategory : function(categoryId) {
				if(confirm('Are you sure you want to delete this category?')) {
					APP.global.sendToApi('delete-category', categoryId, APP.emailManage.deleteCategoryCallback);
				}
			},
			deleteCategoryCallback : function(res) {
				if(res.success) {
					APP.emailManage.buildCategoryList();
				}
			},
			newClientCallback : function(res) {
				if(res.success) {
					$('[name=client_name]').val('');
					APP.emailManage.buildClientList();
				}
			},
			editClientCallback : function(res) {
				if(res.success) {
					APP.emailManage.buildClientList();
				}
			},
			deleteClient : function(clientId) {
				if(confirm('Are you sure you want to delete this client?')) {
					APP.global.sendToApi('delete-client', clientId, APP.emailManage.deleteClientCallback);
				}
			},
			deleteClientCallback : function(res) {
				if(res.success) {
					APP.emailManage.buildClientList();
				}
			},
			buildCategoryList : function() {
				APP.global.sendToApi('get-categories', '', APP.emailManage.buildCategoryListCallback);
			},
			buildCategoryListCallback : function(res) {
				if(res.success && res.categories.length>0) {
					$('#insert-categories').html('');
					$.each(res.categories, function(index, value) {
						var html = '';
						html +=	'<div class="category_box">';
							html +=	'<div id="category_'+value.id+'">';
								html += '<span>'+value.name+'</span>';
								html += '<div class="category_controls">';
									html += '<button class="btn btn-danger btn-sm" onclick="APP.emailManage.deleteCategory('+value.id+');"><i class="fa fa-trash"></i></button>';
									html += '<button class="btn btn-primary btn-sm" onclick="APP.emailManage.editCategory('+value.id+');"><i class="fa fa-pencil"></i> Edit</button>';
								html += '</div>';
								html += '<div class="clearfix"></div>';
							html += '</div>';
							html += '<div id="category_form_'+value.id+'" style="display:none;">';
								html += '<form class="form-inline pull-left edit-category-form" method="post" action="#">';
									html += '<input type="hidden" name="category_id" value="'+value.id+'">';
									html += '<div class="form-group">';
										html += '<input class="form-control input-sm" type="text" name="edit_cat_name" value="'+value.name+'">';
									html += '</div>';
									html += '<div class="form-group">';
										html += '<button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-check"></i> Save Category</button>';
									html += '</div>';
								html += '</form>';
								html += '<div class="category_controls">';
									html += '<button class="btn btn-default btn-sm" onclick="APP.emailManage.closeEditCategory('+value.id+');"><i class="fa fa-close"></i> Cancel</button>';
								html += '</div>';
								html += '<div class="clearfix"></div>';
							html += '</div>';
						html += '</div>';
						$('#insert-categories').append(html);
					});
				} else {
					$('#insert-categories').html('No results found');
				}
				APP.emailManage.loadCategoryDropdowns(res);
			},
			loadCategoryDropdowns : function(res) {
				var html = '<option value="">Category...</option>';
				if(res.success && res.categories.length>0) {
					$.each(res.categories, function(index, value) {
						html += '<option value="'+value.id+'">'+value.name+'</option>';
					});
				}
				$('#filter-category').html(html);
				$('#edit-category').html(html);
			},
			buildClientList : function() {
				APP.global.sendToApi('get-clients', '', APP.emailManage.buildClientListCallback);
			},
			buildClientListCallback : function(res) {
				if(res.success && res.clients.length>0) {
					$('#insert-clients').html('');
					$.each(res.clients, function(index, value) {
						var html = '';
						html +=	'<div class="client_box">';
							html +=	'<div id="client_'+value.id+'">';
								html += '<span>'+value.name+'</span>';
								html += '<div class="client_controls">';
									html += '<button class="btn btn-danger btn-sm" onclick="APP.emailManage.deleteClient('+value.id+');"><i class="fa fa-trash"></i></button>';
									html += '<button class="btn btn-primary btn-sm" onclick="APP.emailManage.editClient('+value.id+');"><i class="fa fa-pencil"></i> Edit</button>';
								html += '</div>';
								html += '<div class="clearfix"></div>';
							html += '</div>';
							html += '<div id="client_form_'+value.id+'" style="display:none;">';
								html += '<form class="form-inline pull-left edit-client-form" method="post" action="#">';
									html += '<input type="hidden" name="client_id" value="'+value.id+'">';
									html += '<div class="form-group">';
										html += '<input class="form-control input-sm" type="text" name="edit_client_name" value="'+value.name+'">';
									html += '</div>';
									html += '<div class="form-group">';
										html += '<button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-check"></i> Save Client</button>';
									html += '</div>';
								html += '</form>';
								html += '<div class="client_controls">';
									html += '<button class="btn btn-default btn-sm" onclick="APP.emailManage.closeEditClient('+value.id+');"><i class="fa fa-close"></i> Cancel</button>';
								html += '</div>';
								html += '<div class="clearfix"></div>';
							html += '</div>';
						html += '</div>';
						$('#insert-clients').append(html);
					});
				} else {
					$('#insert-clients').html('No results found');
				}
				APP.emailManage.loadClientDropdowns(res);
			},
			loadClientDropdowns : function(res) {
				var html = '<option value="">Client...</option>';
				if(res.success && res.clients.length>0) {
					$.each(res.clients, function(index, value) {
						html += '<option value="'+value.id+'">'+value.name+'</option>';
					});
				}
				$('#filter-client').html(html);
				$('#edit-client').html(html);
			},
			editCategory : function(categoryId) {
				$('#category_'+categoryId).hide();
				$('#category_form_'+categoryId).fadeIn();
			},
			closeEditCategory : function(categoryId) {
				$('#category_form_'+categoryId).hide();
				$('#category_'+categoryId).fadeIn();
			},
			editClient : function(clientId) {
				$('#client_'+clientId).hide();
				$('#client_form_'+clientId).fadeIn();
			},
			closeEditClient : function(clientId) {
				$('#client_form_'+clientId).hide();
				$('#client_'+clientId).fadeIn();
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
