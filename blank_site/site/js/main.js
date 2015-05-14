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

	var tag = document.createElement('script');
	tag.src = "https://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	window.youtubeLoaded = false;
	window.onYouTubeIframeAPIReady = function() {
		window.youtubeLoaded = true;
		if ($('body').hasClass('band'))
			app.band.init();
		else if ($('body').hasClass('about'))
			app.about.init();
	}

	$(document).ready(function() {
		resize();

	    jQuery.validator.addMethod("accept", function(value, element, param) {
	      return value.match(new RegExp(param));
	    });

	    //IMPROVED EMAIL VALIDATION JQUERY
	    //http://stackoverflow.com/questions/23368961/jquery-validation-plugin-not-working-with-email-type-right
	    jQuery.validator.addMethod("validEmailPhone", function(value, element){
	        if(value == '') 
	            return true;
	        var temp1;
	        temp1 = true;
	        var ind = value.indexOf('@');
	        if (ind > -1) {
		        var str2=value.substr(ind+1);
		        var str3=str2.substr(0,str2.indexOf('.'));
		        if(str3.lastIndexOf('-')==(str3.length-1)||(str3.indexOf('-')!=str3.lastIndexOf('-')))
		            return false;
		        var str1=value.substr(0,ind);
		        if((str1.lastIndexOf('_')==(str1.length-1))||(str1.lastIndexOf('.')==(str1.length-1))||(str1.lastIndexOf('-')==(str1.length-1)))
		            return false;
		    }
	        str = /((^[a-zA-Z0-9]+[\._-]{0,1})+([a-zA-Z0-9]+[_]{0,1})*@([a-zA-Z0-9]+[-]{0,1})+(\.[a-zA-Z0-9]+)*(\.[a-zA-Z]{2,3})$)|(^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$)/;
	        temp1 = str.test(value);
	        return temp1;
	    }, 'error');
	    
		jQuery.validator.addMethod("zipcode", function(value, element) {
		  return this.optional(element) || /^\d{5}(?:-\d{4})?$/.test(value);
		}, "Please provide a valid zipcode.");

		jQuery.validator.addMethod("isUSA", function(value, element) {
		  return this.optional(element) || /US/.test(value);
		}, "Registration outside the US is not permitted");

		jQuery.validator.addMethod("country", function(value, element) {
		  var accepted = ["usa", "us", "united states of america", "united states"];
		  if($.inArray(value.toLowerCase(), accepted) == -1) {
		    return false;
		  }
		  return true;
		}, "Sounds lovely, but you must be a legal US resident to enter.");

		jQuery.validator.addMethod("is21", function(value, element) {
		  	var form = $(element).parents('form'),
				month = $('#month', form).val(),
				day = $('#day', form).val(),
				year = $('#year', form).val();

			if(!isNaN(parseInt(month)) && !isNaN(parseInt(day)) && !isNaN(parseInt(year))) {
				var now = !!Date.now? Date.now() : new Date().getTime(),
					bday = new Date(year, month, day),
					diff = now - bday.getTime(),
					date = new Date(diff),
					age = Math.abs(date.getUTCFullYear() - 1970);
		        return age > 21;
		    } else {
		      return false;
		    }
		}, "You are not over 21.");
		//END JQUERY VALIDATOR
      
      

		window.app = {
			global: {
				init: function() {
					if ($('body').hasClass('age-gate'))
						app.ageGate.init();
					else if ($('body').hasClass('home'))
						app.home.init();

					imagesLoaded('img', function() { app.global.imgsLoaded(); });
					app.global.initMobiscroll($('#mobiledate'));
				},

				imgsLoaded : function() {
				},

	            isTouchDevice : function() {
	              return true == ("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch);
	            },

				initMenu: function() {
	        		$('#hamburger').on('click', function() {
	        			$('#navigation-ol').fadeIn();
	        		});
	        		$('#navigation-ol .close span').on('click', function() {
	        			$('#navigation-ol').fadeOut();
	        		});
	        		
	        		app.global.styleSelect($('#create_form select'));
				},

				styleSelect: function(el) {
					$(document).off('click touchstart');
					$(document).on('click touchstart', function(e) {
						$('.mod-select').addClass('collapsed');
					});
					$(el).each(function(i) {
						$(this).css('display', 'none');

						var select = $('<div></div>')
							.addClass('mod-select collapsed')
							.addClass($(this).attr('class'));

						select
							.append($('<div></div>')
							.addClass('selected')
							.text($('option:selected', this).text()))
							.append($('<ul></ul>').addClass('dropdown'));

						var moving = false;

						$(this).find('option').each(function(j) {
							$('.dropdown', select).off('mousewheel DOMMouseScroll touchmove touchstart click touchend');
							$('.dropdown', select)
								.on('mousewheel DOMMouseScroll', function(e) {
									var delta = e.wheelDelta || (e.originalEvent && e.originalEvent.wheelDelta) || -e.detail,
									bottomOverflow = this.scrollTop + $(this).outerHeight() - this.scrollHeight >= 0,
									topOverflow = this.scrollTop <= 0;

									if ((delta < 0 && bottomOverflow) || (delta > 0 && topOverflow))
									e.preventDefault();
								})
								.on('touchmove', function(e) {
									moving = true;
								})
								.append($('<li></li>')
								.data('value', $(this).val())
								.data('days', $(this).data('days'))
								.text($(this).text()))
								.on('click touchstart touchend', function(e) {
									e.stopPropagation();
								});
						});
						$('.selected', select).off('click.orig');
						$('.selected', select).on('click.orig', function(e) {
							e.preventDefault();
							e.stopPropagation();

							var isClosed = $(this).parents('.mod-select').hasClass('collapsed');

							$('.mod-select').addClass('collapsed');
							if (isClosed)
								$(this).parents('.mod-select').toggleClass('collapsed');
						});

						$('.dropdown li', select).off('click touchstart touchend');
						$('.dropdown li', select).on('click touchstart touchend', function(e) {
							if (e.type === 'touchstart')
								moving = false;
							if (e.type === 'touchstart' || (e.type === 'touchend' && moving))
								return true;

							$(select).next().val($(this).data('value')).trigger('change');
							$('.selected', select).text($(this).text());
							$('.mod-select').addClass('collapsed');

							//hide days
							if(typeof $(this).data('days') != 'undefined') {
								$('.dropdown li').removeClass('hide_day');
								var month_days = $(this).data('days');
								$('.dropdown li').each(function(i, el) {
									if($(el).html() > month_days && $(el).html() <= 31)
										$(el).addClass('hide_day');
								});
							};
						});

						$(this).before(select);
					});
				},

				validateDOB: function(parent, age) {
					var month = $('#month', parent),
						day = $('#day', parent),
						year = $('#year', parent);

					month.off('change');
					day.off('change');
					year.off('change');
					month.on('change', age, app.global.dobCheck);
					day.on('change', age, app.global.dobCheck);
					year.on('change', age, app.global.dobCheck);

					month.trigger('change');
				},

				dobCheck: function(e) {
					var form = $(this).parents('form'),
						month = $('#month', form).val(),
						day = $('#day', form).val(),
						year = $('#year', form).val();


					if (!isNaN(parseInt(month)) && !isNaN(parseInt(day)) && !isNaN(parseInt(year))) {
						var now = !!Date.now? Date.now() : new Date().getTime(),
							bday = new Date(year, month, day),
							diff = now - bday.getTime(),
							date = new Date(diff),
							age = Math.abs(date.getUTCFullYear() - 1970);

						if (age >= e.data) {
							$(this).parents('.validation-wrap').removeClass('error').addClass('validated');

	                		if ($('.validation-wrap:not(.validated)').length == 0)
								$('button[type="submit"]', form).addClass('validated');
	                		else
								$('button[type="submit"]', form).removeClass('validated');
						} else  {
							$(this).parents('.validation-wrap').removeClass('validated').addClass('error');
						}
					} else
						$('button[type="submit"]', form).removeClass('validated');
				},

				dobVal: function(selector) {
					var form = $(selector),
						month = $('#month', form).val(),
						day = $('#day', form).val(),
						result = false;
						year = $('#year', form).val();

					if(!isNaN(parseInt(month)) && !isNaN(parseInt(day)) && !isNaN(parseInt(year))) {
						var now = !!Date.now? Date.now() : new Date().getTime(),
							bday = new Date(year, month, day),
							diff = now - bday.getTime(),
							date = new Date(diff),
							age = Math.abs(date.getUTCFullYear() - 1970);

						if(age >= 21) {
							result = true;
						}
					}
					if(result) {
						$('.birthday-group').removeClass('error');
						$('#dob').next('.error-inline').remove();
					} else {
						$("#form-errors").html("OOPS! GIVE EVERYTHING A SECOND LOOK");
						$('.birthday-group').addClass('error');
						$('#dob').next('.error-inline').remove();
						$('#dob').after('<div class="error-inline">Doesn’t add up to the legal drinking age. Did you enter date as month/date/year?</div>');
					}
					return result;
				},

				initMobiscroll: function(el) {

					$(el).off('change');
					$(el).mobiscroll().date({
						display: 'bottom',
						minDate: new Date(1920, 1, 1),
						maxDate: new Date(),
						theme: 'sense-ui',
						buttons: [ {
							text: 'OK',
							handler: 'set'
						}, 'cancel' ]
		            }).on('change', function(e) {
		            	var form = $(this).parents('form'),
		            		val = $(this).val().split('/'),
		            		month = val[0],
		            		day = val[1],
		            		year = val[2];

		            	$('#month', form).prev().find('.dropdown li').eq(month).trigger('click');
		            	$('#day', form).prev().find('.dropdown li').eq(day).trigger('click');
		            	$('#year', form).prev().find('.dropdown li').eq(2016-year).trigger('click');
		            });
					$('.mod-select .selected').off('click.mobi');
					$('.mod-select .selected').on('click.mobi', function(e) {
						if ($('html').hasClass('mobile')) {
							$(this).parents('.mod-select').addClass('collapsed');
							$(el).mobiscroll('show');
						}
					});
				},

				checkboxInit: function(el) {
					el.next().off('click');
					el.next().on('click', function(e) {
						$(this).toggleClass('checked');
						$(this).prev().prop('checked');
					});
				},

			},

			router: {
				init: function() {
					NProgress.configure({
						trickleRate: 0.1,
						trickleSpeed: 600,
						showSpinner: false
					});

					preventLoad = true;
					History.replaceState({url:window.location.pathname}, document.title, window.location.pathname);

					window.preventLoad = false;
					History.Adapter.bind(window,'statechange',function() {
						var state = History.getState();

						if (typeof state.data.url !== 'undefined' && !preventLoad) {
							NProgress.start();
							$.ajax(state.data.url, {
								data: 'ajax',
								dataType: 'json',
								success: function(data){
									if (state.title == '') {
										preventLoad = true;
										History.replaceState({url:state.data.url}, data.title, state.data.url);
									}

									NProgress.done();

									if (typeof data.scripts !== 'undefined') {
										for (var i in data.scripts)
											window[i] = data.scripts[i];
									}
									app.router.handleNewPage(data.page, data.classes);
								}
							});
						}
						if (preventLoad)
							preventLoad = false;
					});

					$('body').off('click', 'a[href^="/"]');
					$('body').on('click', 'a[href^="/"]', function(e) {
						if ($(this).hasClass('switchvid') || $('body').hasClass('age-gate'))
							return;

						e.preventDefault();

						if (window.location.pathname == $(this).attr('href'))
							return;

						$('header .menu').addClass('collapsed');
						var newUrl = $(this).attr('href');

						History.pushState({url:newUrl}, '', newUrl);
					});
				},

				handleNewPage: function(html, classes) {
					var oldPage = $('.outer-wrapper');

					if ($('body').hasClass('band-prerelease'))
						$('.countdown').jCounter('stop');

					oldPage.fadeOut(500, function() {
						$('body').removeClass($('body').attr('class'));
						$('body').addClass(classes);

						oldPage.after(html);
						var newPage = oldPage.next();
						oldPage.remove();
						newPage.css('display', 'none');
						app.global.init();
						newPage.fadeIn(500);
						resize();
					});

					resize();

					$('html,body').animate({
						scrollTop: 0
					}, 500);
				},
			},

			overlay: {
				content: $('#overlay .content'),
				stage: 'upload',
				init: function(){
          //this.content.html('');
	        		$('#main-ol .close').on('click', function() {
	        			$('#main-ol').fadeOut();
	        			app.overlay.stage = 'upload';
	        		});
	        		$('#main-ol').fadeIn();
					//app.overlay.get(app.overlay.stage);
				},
				get: function(stage) {
					$.ajax({
						method: "GET"
						,url: "/"+stage+".php"
					})
					.done(function(res) {
						//console.log(res);
						app.overlay.content.html(res);
					});
				},
			},

			ageGate: {
				init: function() {
					app.global.styleSelect($('form select'));
					app.global.checkboxInit($('form input[type="checkbox"]'));
					app.global.validateDOB($('.dob'), 0);
					$('button[type="submit"]').off('click');
					$('button[type="submit"]').on('click', function(e) {
						if(!$(this).hasClass('validated')) {
							e.preventDefault();
						} else {
							TAG.event('agegate_2');
						}
					});
					app.global.initMobiscroll($('#mobiledate'));

		            if ($('html').hasClass('mobile'))
		            	$('#mobiledate').mobiscroll('show');
				},
	        },

	        home: {
	        	init: function() {
	        		$('#uploadnow .aoverlay').on('click', function(e) {
	        			e.preventDefault();
	        			app.overlay.init();
	        		});
	        	},
	        },

		};

		if(!$('body').hasClass('age-gate')) {
			app.global.initMenu();
		}
		app.global.init();
		//app.router.init();
	});
})(jQuery);

(function($,doc){
  
  'use strict';
  
  function SwarmAPI(){
    var data = null,
        callback = null,
        albumLink = $('li [href="/my-album"]'),
        login_out = $('[data-action^=log]'),
        dynamicMenu = $('#welcome .wb'),
        _user = user,
        results = null,
        challenge,
        photos=_photos;
    
    var template_parts=[];
    
    $('<div />').html( $('#template_parts').html() ).children().each(function(ind,el){
      template_parts[el.id] = $(el).html();
    });
    
    $.get('/includes/challenge-data.json', function(data){
      challenge = data;
    });
    
    function get_challenge(ind) {
      $('#upload_container .head h1').text( challenge[ind].title );
      $('#upload_container .head p').text( challenge[ind].desc );
      
      $('#upload_container .do').attr('src', challenge[ind].img[0] );
      $('#upload_container .dont').attr('src', challenge[ind].img[1] );
      
      $('#album_id').val( ind );
      return challenge[ind];
    }
    
    function setMenu(user,html,action){
      action = user? 'logout':'login';
      html = template_parts[(user?'menu-logged-in':'menu-logged-out')];
      
      if(user)
        html = html.replace(/\{\{([^}]+)\}\}/g, function(a,b,c,d){
          console.log(user,user[b],a,b,c,d);
          return user[b];
        });
      
      albumLink.toggle(!!user);
      login_out.attr('data-action', action).text(action);
      dynamicMenu.html(html);
      
    }
    
    //template_parts.find('#menu-logged-in').html().replace(/\{\{([^}]+)\}\}/g, function(a,b,c,d){
    //  switch(b){
    //    case 'USERNAME':
    //      return 'MrDevinB';
    //    break;
    //    case 'PHOTOS':
    //      return 69;
    //    break;
    //    case 'VOTES':
    //      return 101;
    //    break;
    //  }
    //})
    
    function api(method){
      method = method.replace(/_/g,'-');
      
      //console.log(method,data,callback);
      
      return $.ajax({
        method: "POST"
        ,url: "/api"
        ,data: { action: method, data: data }
      }).done(function(res) {
        results = res;
        typeof callback==='function'?
          callback(res):
          res;
          reset();
      });
    }
    
    function reset(){
      data=null;
      callback = function(res){
        console.log(res);
      };
    } 
    
    function login(d,form) {
      data = d;
      var _this = this;
      callback = function(res){
        if(res.success) {
          setMenu(res.user);
          if( _this.photoUpload ) {
            $('#review-submit .uploader-name a').text(res.user.firstName + ' ' + res.user.lastName.substr(0,1) + '.');
            swarm.user = res.user;
            showOverlay('uploadnow');
          } else {
            $('#overlay').fadeOut(function(){
              window.location.href = '/my-album';
            });
          }
          $(form)[0].reset();
        } else if(!res.success && res.message) {
        	console.log(res.message);
        	$("#login-form-errors").html(res.message);
        }
      }
      return api('login');
    }

    function logout(ele) {
      callback = function(res) {
        if(res.success) {
          setMenu();
          window.location.href = '/';
        }
      };
      return api('logout');
    }
    
    
    function add_user(d,form){
      data = d;
      
      callback = function(res){
        if(res.success) {
          $('[data-action^=log]').attr('data-action', 'logout').text('logout');
          $('#overlay').fadeOut();
          $(form)[0].reset();
        } else if(!res.success && res.message) {
        	$("#form-errors").html(res.message);
        }
      }
      return api('add_user');
    }
  
    function is_logged_in(func) {
      !!func && (callback=func);
      return api('is_logged_in');
    }
  
    function forgot_password(func) {
      !!func && (callback=func);
      return api('forgot_password');
    }
  
    function reset_password(func) {
      !!func && (callback=func);
      return api('reset_password');
    }
  
    function get_popular(offset,func) {
      callback = addPhoto;
      data = {"offset":(offset||0)};
      return api('get_popular');
    }
  
    function get_choice(offset,func) {
      callback = addPhoto;
      data = {"offset":(offset||0)};
      return api('get_choice');
    }
  
    function get_recent(offset,func) {
      callback = addPhoto;
      data = {"offset":(offset||0)};
      return api('get_recent');
    }
    
    function addPhoto(resp){
      if(!data.offset) $('#pics').html(''), photos=[];
      for(var i=0,img=resp.images;i<img.length;i++){
        var photo = swarm.template_parts['photo'].replace(/\{\{([^}]+)\}\}/g, function(a,b,c,d){
          var out = img[i][b.replace('_Class','')] || 0;
          console.log(a,b,c,d);
          switch(b) {
            case 'owned':
              out = out?'owner':'';
              break;
            case 'votingLocked_Class':
              out = out?'icon-heart':'icon-heart-ol';
              break;
          }
          return out;
        });
        photos.push(img[i]);
        $(photo).css('opacity',0).appendTo('#pics').end()
          .delay(i*50).animate({opacity:1});
      }
      $('#pics').data('offset',data.offset+img.length);
    };
    
    function get_theme_album(id,offset,func) {
      !!func && (callback=func);
      data = {"albumId":id,"offset":(offset||0)};
      return api('get_theme_album');
    }
  
    function get_user_ablum(id,func) {
      data = {userId:id};
      !!func && (callback=func);
      return api('get_user_ablum');
    }
  
    function get_user_info(id,func) {
      data = {userId:id};
      !!func && (callback=func);
      return api('get_user_info');
    }
  
    function get_my_votes(func) {
      !!func && (callback=func);
      return api('get_my_votes');
    }
  
    function send_vote(pid,func) {
      !!func && (callback=func);
      data = {photoId: pid};
      return api('send_vote');
    }
  
    function upload_image(func) {
      !!func && (callback=func);
      return api('upload_image');
    }
    
    function showOverlay(overlay){
      $('#overlay.overlay .'+overlay).fadeIn().siblings('.overlay_content').hide().parent().fadeIn();
    }
    
    return {
      login: login,
      logout: logout,
      add_user: add_user,
      is_logged_in: is_logged_in,
      forgot_password: forgot_password,
      reset_password: reset_password,
      get_popular: get_popular,
      get_choice: get_choice,
      get_recent: get_recent,
      get_theme_album: get_theme_album,
      get_user_ablum: get_user_ablum,
      get_my_votes: get_my_votes,
      send_vote: send_vote,
      upload_image: upload_image,
      _results: function(){ return results; },
      template_parts: template_parts,
      dynamicMenu: dynamicMenu,
      setMenu: setMenu,
      showOverlay: showOverlay,
      challenge: get_challenge,
      photos: function(){ return photos; },
      user: _user
  	}
  };
  
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
      ,country: {required : true, country : true}
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
      ,country : {required : "Sounds lovely, but you must be a legal US resident to enter."}
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
  
  function showOverlay(overlay){
    $('#overlay.overlay').fadeIn().children('.'+overlay).fadeIn().siblings('.overlay_content').fadeOut();
  }
  
  $(function(){
    window.swarm = SwarmAPI();
    $(doc).on('click','[data-filter]', function(e,filter){
      e.preventDefault();
      if($(this).hasClass('active')) return;
      filter = $(this).data('filter');
      $(this).addClass('active').siblings().removeClass('active');
      swarm['get_'+filter]();
    });

    $(document).on('change', '[name^="age"]', function(){
    	app.global.dobVal('#create_form');
	});
    $(document).on('click', '#create_btn', function(){
    	app.global.dobVal('#create_form');
	});
	$('#share-link input').on('click touchstart', function() {
		$(this).select();
	});

    $(doc).on('click', '#navigation a', function(e){
      //e.preventDefault();
      $('#hamburger').click();
    });
    
  	$(doc).on('click', "[data-overlay]", function( e ) {
  		e.preventDefault();
  		var data_overlay=$(this).attr('data-overlay');
		
  	});
  
    $(doc).on('click','[data-action]', function(e,action){
      e.preventDefault();
      action = $(this).attr('data-action');
    
      if(action=='login')
        return showOverlay('set-up-profile');
    
      swarm[action] && swarm[action].apply(this);
    
    });
    
    $(doc).on('click', '[data-challenge]', function(e){
      e.preventDefault();
    
      var ind = $(this).attr('data-challenge');
      
      swarm.challenge(ind);
    
      showOverlay('uploadnow');
    
    });
    
    // Update challenge attr when changing slides on homepage...
    $(doc).on('cycle-before', '#slides', function(event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag){
      $('[data-challenge]').attr('data-challenge',optionHash.nextSlide);
    });
    
    // Click Listener for individual images
    $(doc).on('click', '[data-pid]', function(e){
      e.preventDefault();
      
      if( !!$(e.target).parents('.count').length || $(e.target).hasClass('count') ) return;
      
      var ind=0,
          pid = $(this).data('pid'),
          count = swarm.photos().length,
          photo = $.grep(swarm.photos(),function(o,i){ if(o.id==pid) return (ind=i) || true;});
      
      $('#photo-container .aro').toggle(count>1);
      
      buildSlide(ind,photo[0]);
      
      showOverlay('slideshow',true);
      
    });
    
    $(doc).on('click', '#photo-container .aro', function(e){
      e.preventDefault();
      
      var photo = swarm.photos(),
          num=photo.length,
          last = $('#photo-container .photoslides').data('ind'),
          next = ($(this).hasClass('cycle-next')? last+1:last-1)%num;
      
      next<0 && (next=num-1);
      
      buildSlide(next,photo[next]);
    
    });
    
  });
  
  function buildSlide(ind,photo){
    
    var challenge = swarm.challenge(photo.albumId);
    
    var $slide = $('<div />', {
      'class': 'photoslide',
      'data-ind': ind
    });
    
    if(photo.editorChoice)
      $('<h6 class="yellowbg"><span>Editor\'s Choice</span></h6>').appendTo($slide);
    
    var $image = $('<div />', {
      'class': 'slideshow-slide',
      'html': photo.image
    }).appendTo( $slide );
    
    var $captionContainer = $('<div />', {
      'class': 'caption-container'
    }).appendTo( $slide );
    
    var $userInfo = $('<div />', {
      'class': 'uploader-info',
      'html': '<div class="margin"><div class="my-album-pic"><img src="img/my-album.png"></div></div>'
    }).appendTo( $captionContainer ).end().find('.margin');
    
    $('<div />', {
      'class': 'uploader-name',
      'html': '<a href="/my-album/'+photo.userId+'">'+photo.shortname+'</a>'
    }).appendTo( $userInfo );
    
    $('<div />', {
      'class': 'photo-votes',
      'data-pid': photo.id,
      'data-vote': photo.votingLocked,
      'html': '<a href="#" class="count"><span class="total">'+photo.votes+'</span> <span class="'+(photo.votingLocked?'icon-heart':'icon-heart-ol')+'"></span></a>'
    }).appendTo( $userInfo );
    
    var $caption = $('<div />', {
      'class': 'uploader-info',
      'html': '<div class="margin" />'
    }).appendTo( $captionContainer ).end().find('.margin');
    
    $('<h3><a href="'+challenge.slug+'">'+challenge.title+'</a></h3>').appendTo( $caption );
    $('<p class="jdexb">'+photo.caption+'</p>').appendTo( $caption );
    
    $('#photo-container .photoslides').data('ind',ind).html( $slide );
    
  }
  
})(jQuery,document);