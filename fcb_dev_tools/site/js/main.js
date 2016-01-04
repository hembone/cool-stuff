$(document).ready(function() {
	APP = {

		global : {
			init : function() {
				if($('body').hasClass('create-profile')){APP.createProfile.init();}
                if($('body').hasClass('login')){APP.login.init();}
				if($('body').hasClass('home')){APP.home.init();}
				if($('body').hasClass('email-builder')){APP.emailBuilder.init();}
				if($('body').hasClass('email-manage')){APP.emailManage.init();}
				if($('body').hasClass('banner-tester')){APP.bannerTester.init();}
				if($('body').hasClass('social-ranking')){APP.socialRanking.init();}
				APP.global.globalListeners();
			},
			globalListeners : function() {
				$(document).on('click', '#logout', function(e) {
					e.preventDefault();
					APP.global.sendToApi('logout', '', APP.global.logoutCallback);
				});
			},
			sendToApi : function(action, data, callback) {
				$.ajax({
					method: "POST",
					url: "/api",
					dataType: "json",
					data: { key: API_KEY, action: action, data: data }
				})
				.success(function(res) {
					if(typeof callback==='function') {
						callback(res);
					}
				});
			},
			logoutCallback : function(res) {
				if(res.success) {
					window.location.href = '/';
				}
			}
		},

		createProfile : {
			init : function() {
                APP.createProfile.setListeners();
			},
            setListeners : function() {
                $(document).on('submit', '#create-form', function(e) {
					e.preventDefault();
					var data = $(this).serializeArray();
					APP.global.sendToApi('add-user', data, APP.createProfile.newUserCallback);
				});
            },
            newUserCallback : function(res) {
                if(res.success) {
                    window.location = "/";
                } else {
                    console.log('Error');
                }
            }
		},

        login : {
			init : function() {
                APP.login.setListeners();
			},
            setListeners : function() {
                $(document).on('submit', '#login-form', function(e) {
					e.preventDefault();
					var data = $(this).serializeArray();
					APP.global.sendToApi('login', data, APP.login.loginCallback);
				});
            },
            loginCallback : function(res) {
                if(res.success) {
                    window.location = "/";
                } else {
                    console.log('Error');
                }
            }
		},

		home : {
			init : function() {

			}
		},

		emailBuilder : {
			init : function() {
				APP.emailBuilder.setListeners();
				APP.emailBuilder.buildBlockList();
				APP.emailBuilder.loadCategoryDropdown();
				APP.emailBuilder.loadClientDropdown();
			},
			setListeners : function() {
				$(document).on('keyup keypress', '#block-filters', function(e) {
					var code = e.keyCode || e.which;
					if(code == 13) {
						e.preventDefault();
						return false;
					}
				});
				$(document).on('keyup blur', '#filter-name', function() {
					APP.emailBuilder.buildBlockList();
				});
				$(document).on('change', '#filter-category', function() {
					APP.emailBuilder.buildBlockList();
				});
				$(document).on('change', '#filter-client', function() {
					APP.emailBuilder.buildBlockList();
				});
				$(document).on('click', '.block-wrap', function() {
					APP.emailBuilder.addBlock(this);
				});
				$(document).on('click', '#download-zip', function() {
					APP.emailBuilder.download();
				});
				$(document).on('click', '.delete-insert', function() {
					$(this).parents('.insert-wrap').remove();
				});
			},
			buildBlockList : function() {
				var data = $('#block-filters').serializeArray();
				APP.global.sendToApi('get-blocks', data, APP.emailBuilder.buildBlockListListCallback);
			},
			buildBlockListListCallback : function(res) {
				if(res.success && res.blocks.length>0) {
					$('#insert-blocks').html('');
					$.each(res.blocks, function(index, block) {
						var html = '';
						html += '<div id="'+block.id+'" class="block-wrap" data-container="body" data-toggle="popover">'+block.name+'</div>';
						$('#insert-blocks').append(html);
						$('#'+block.id).data('block', block);
						APP.emailBuilder.loadPreview(block);
					});
					$('#insert-blocks').fadeIn();
				} else {
					$('#insert-blocks').html('No results found');
				}
			},
			loadCategoryDropdown : function() {
				APP.global.sendToApi('get-categories', '', APP.emailBuilder.loadCategoryDropdownCallback);
			},
			loadCategoryDropdownCallback : function(res) {
				var html = '<option value="">All Categories</option>';
				if(res.success && res.categories.length>0) {
					$.each(res.categories, function(index, value) {
						html += '<option value="'+value.id+'">'+value.name+'</option>';
					});
				}
				$('#filter-category').html(html);
			},
			loadClientDropdown : function() {
				APP.global.sendToApi('get-clients', '', APP.emailBuilder.loadClientDropdownCallback);
			},
			loadClientDropdownCallback : function(res) {
				var html = '<option value="">All Clients</option>';
				if(res.success && res.clients.length>0) {
					$.each(res.clients, function(index, value) {
						html += '<option value="'+value.id+'">'+value.name+'</option>';
					});
				}
				$('#filter-client').html(html);
			},
			loadPreview : function(block) {
				var rand = Math.random().toString(36).substr(2, 10);
				var html = '<iframe id="popiframe-'+rand+'" scrolling="no" seamless="seamless" onload="APP.emailBuilder.setIframeHeight(this);">'+block.html+'</iframe>';
				$('body').append(html);
				var doc = document.getElementById('popiframe-'+rand).contentWindow.document;
				doc.open();
				doc.write('<style>'+block.css+'</style>');
				doc.write(block.html);
				doc.close();
				$('#'+block.id).popover({
					trigger : 'hover',
					placement : 'right',
					html : true,
					content : function() {
						return $('#popiframe-'+rand);
					}
				});
			},
			addBlock : function(obj) {
				var block = $(obj).data('block');
				var rand = Math.random().toString(36).substr(2, 10);
				var html = '';
				html += '<div id="wrap-'+rand+'" class="insert-wrap">';
					html += '<div class="insert-controls">';
						html += '<button class="btn btn-danger btn-xs delete-insert"><i class="fa fa-trash"></i></button>'
					html += '</div>';
					html += '<iframe id="iframe-'+rand+'" scrolling="no" seamless="seamless" onload="APP.emailBuilder.setIframeHeight(this);"></iframe>';
				html += '</div>';
				$('#insert-email').append(html);
				$('#wrap-'+rand).data('block', block);
				var doc = document.getElementById('iframe-'+rand).contentWindow.document;
				doc.open();
				doc.write('<style>'+block.css+'</style>');
				doc.write(block.html);
				doc.close();
			},
			setIframeHeight : function(iframe) {
				$(iframe).height(0);
				var h = $(iframe).contents().find('html').height();
				$(iframe).height(h);
			},
			download : function() {
				var globalCSS = $('#global-css').val();
				var blocks = [];
				$('#insert-email .insert-wrap').each(function(index, el) {
					var block = $(el).data('block');
					blocks.push(block.id);
				});
				if(blocks.length>0) {
					var data = {'globalCSS':globalCSS, 'blocks':blocks};
					APP.global.sendToApi('download', data, APP.emailBuilder.downloadCallback);
				}
			},
			downloadCallback : function(res) {
				var path = '/email-download.php?key=mACRQX6bPvw26xqm&file='+res.filename;
				$('#download-me').attr('src', path);
			}
		},

		emailManage : {
			init : function() {
				APP.emailManage.setListeners();
				APP.emailManage.buildBlockList();
				APP.emailManage.buildCategoryList();
				APP.emailManage.buildClientList();
				APP.emailManage.loadGlobalCss();
			},
			setListeners : function() {
				$(document).on('click', '#manage-tabs a', function(e) {
					e.preventDefault();
					$(this).tab('show');
				});
				$(document).on('click', '#new-block', function() {
					APP.emailManage.loadAce();
					$('#manage-overlay').fadeIn();
				});
				$(document).on('click', '#close-overlay', function() {
					$('#manage-overlay').fadeOut();
					APP.emailManage.clearBlockForm();
				});
				$(document).on('keyup keypress', '#block-filters', function(e) {
					var code = e.keyCode || e.which;
					if(code == 13) {
						e.preventDefault();
						return false;
					}
				});
				$(document).on('keyup blur', '#filter-name', function() {
					APP.emailManage.buildBlockList();
				});
				$(document).on('change', '#filter-category', function() {
					APP.emailManage.buildBlockList();
				});
				$(document).on('change', '#filter-client', function() {
					APP.emailManage.buildBlockList();
				});
				$(document).on('click', '.delete-block', function() {
					if(confirm('Are you sure you want to delete this block?')) {
						var blockId = $(this).data('id');
						APP.global.sendToApi('delete-block', blockId);
						APP.emailManage.buildBlockList();
					}
				});
				$(document).on('click', '.edit-block', function() {
					var blockId = $(this).data('id');
					APP.global.sendToApi('get-block', blockId, APP.emailManage.loadEditBlockCallback);
				});
				$(document).on('submit', '#edit-block-form', function(e) {
					e.preventDefault();
					if($('#block-name').val().trim()!=='') {
						var css = APP.cssAce.getValue();
			            $('#css').val(css);
			            var html = APP.htmlAce.getValue();
			            $('#html').val(html);
						var data = $(this).serializeArray();
						APP.global.sendToApi('edit-block', data);
						APP.emailManage.buildBlockList();
						$('#manage-overlay').fadeOut();
						APP.emailManage.clearBlockForm();
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
				$(document).on('submit', '#global-css-form', function(e) {
					e.preventDefault();
					var globalCss = APP.globalCssAce.getValue();
					$('#global_css').val(globalCss);
					var data = $(this).serializeArray();
					APP.global.sendToApi('edit-global-css', data);
					$('#save-global-css').fadeOut();
				});
			},
			loadAce : function() {
				APP.cssAce = ace.edit("css_ace");
				APP.cssAce.getSession().setMode("ace/mode/css");
				APP.cssAce.setTheme("ace/theme/monokai");
				APP.cssAce.session.setUseWorker(false);
				APP.cssAce.setValue('', -1);
				APP.htmlAce = ace.edit("html_ace");
				APP.htmlAce.getSession().setMode("ace/mode/html");
				APP.htmlAce.setTheme("ace/theme/monokai");
				APP.htmlAce.session.setUseWorker(false);
				APP.htmlAce.setValue('', -1);
			},
			clearBlockForm : function() {
				document.getElementById("edit-block-form").reset();
				APP.cssAce.destroy();
				APP.htmlAce.destroy();
			},
			buildBlockList : function() {
				var data = $('#block-filters').serializeArray();
				APP.global.sendToApi('get-blocks', data, APP.emailManage.buildBlockListListCallback);
			},
			buildBlockListListCallback : function(res) {
				if(res.success && res.blocks.length>0) {
					$('#insert-blocks').html('');
					$.each(res.blocks, function(index, block) {
						var html = '';
						html += '<div class="row">';
							html += '<div class="col-md-10">';
								html += '<div class="block-title">'+block.name+'</div>';
								html += '<div class="block-wrap">';
									html += '<iframe id="iframe-'+block.id+'" scrolling="no" seamless="seamless" onload="APP.emailManage.setIframeHeight(this);"></iframe>';
								html += '</div>';
							html += '</div>';
							html += '<div class="col-md-2">';
								html += '<button class="btn btn-danger btn-block btn-xs delete-block" data-id="'+block.id+'"><i class="fa fa-trash"></i> Delete</button>';
								html += '<button class="btn btn-info btn-block btn-sm edit-block" data-id="'+block.id+'"><i class="fa fa-pencil"></i> Edit</button>';
							html += '</div>';
						html += '</div>';
						$('#insert-blocks').append(html);
					});
					$.each(res.blocks, function(index, block) {
						var doc = document.getElementById('iframe-'+block.id).contentWindow.document;
						doc.open();
						doc.write('<style>'+res.globalCss.css+block.css+'</style>');
						doc.write(block.html);
						doc.close();
					});
					$('#insert-blocks').fadeIn();
				} else {
					$('#insert-blocks').html('No results found');
				}
			},
			setIframeHeight : function(iframe) {
				$(iframe).height(0);
				var h = $(iframe).contents().find('html').height();
				$(iframe).height(h);
			},
			loadEditBlockCallback : function(res) {
				if(res.success) {
					$('#block-id').val(res.block.id);
					$('#block-name').val(res.block.name);
					$('#edit-category option[value='+res.block.category_id+']').prop('selected', true);
					$('#edit-client option[value='+res.block.client_id+']').prop('selected', true);
					APP.emailManage.loadAce();
					APP.cssAce.setValue(res.block.css, -1);
					APP.htmlAce.setValue(res.block.html, -1);
					$('#manage-overlay').fadeIn();
				}
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
				var html = '<option value="">All Categories</option>';
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
				var html = '<option value="">All Clients</option>';
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
			},
			loadGlobalCss : function() {
				APP.globalCssAce = ace.edit("global_css_ace");
				APP.globalCssAce.getSession().setMode("ace/mode/css");
				APP.globalCssAce.setTheme("ace/theme/monokai");
				APP.globalCssAce.session.setUseWorker(false);
				APP.globalCssAce.setValue('', -1);
				APP.globalCssAce.getSession().on('change', function() {
					$('#save-global-css').fadeIn();
				});
				APP.global.sendToApi('get-global-css', '', APP.emailManage.loadGlobalCssCallback);
			},
			loadGlobalCssCallback : function(res) {
				APP.globalCssAce.setValue(res.result.css, -1);
				$('#save-global-css').hide();
			}
		},

		bannerTester : {
			init : function() {
				APP.bannerTester.setListeners();
			},
			setListeners : function() {
				$(document).on('click', '#get-started', function() {
	                $('#settings-overlay').fadeIn();
	            });
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
						html += '<option value="300x50">300 x 50</option>';
	                    html += '<option value="300x250">300 x 250</option>';
	                    html += '<option value="300x600">300 x 600</option>';
						html += '<option value="320x50">320 x 50</option>';
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
