var allTemplates;
var templateData;

$(function() {
	var nav = $('.navbar').innerHeight(),
		win = $(window).innerHeight();

	$('#template-preview').css('height', win-nav);

	$.ajax('ajax.php?a=templates').done(function(data) {
		allTemplates = data;

		for (var tkey in data) {
			var template = data[tkey];

			$('#template-dropdown').append('<li' + (tkey == 0 ? ' class="active"' : '') + '><a href="#" class="template" data-key="' + tkey + '" data-template="' + template.name + '">' + template.name + '</a></li>');
			if (tkey == 0) {
				$('.template-text').text(template.name);
				templateData = template;

				for (var gkey in template.modules) {
					if (template.modules[gkey].modules.length > 0) {
						$('#group-list').append('<li><a class="collapsed" data-toggle="collapse" data-parent="#group-list" href="#module-list-' + gkey + '"><span class="caret"></span> ' + template.modules[gkey].name + '</a><ul class="nav nav-sidebar collapse panel-collapse out module-list" id="module-list-' + gkey + '" data-group="' + gkey + '"></ul></li>');
						for (var mkey in template.modules[gkey].modules) {
							var module = template.modules[gkey].modules[mkey];

							$('.module-list[data-group="' + gkey + '"]').append('<li><a href="#" class="module" data-group="' + gkey + '" data-key="' + mkey + '" data-module="' + module.name + '">' + module.name + '</a></li>');
						}
					}
				}
				$('#template-preview').prop('srcdoc', template.base.html);
			}
		}
	});

	$('body').on('click', '#template-dropdown a', function(e) {
		$('#template-dropdown li').removeClass('active');
		$(this).parent().addClass('active');
		$('.template-text').text($(this).text());

		templateData = allTemplates[$(this).data('key')];
		$('#group-list').html('');
		$('#selected-modules').html('');

		for (var gkey in templateData.modules) {
			if (templateData.modules[gkey].modules.length > 0) {
				$('#group-list').append('<li><a class="collapsed" data-toggle="collapse" data-parent="#group-list" href="#module-list-' + gkey + '"><span class="caret"></span> ' + templateData.modules[gkey].name + '</a><ul class="nav nav-sidebar collapse panel-collapse out module-list" id="module-list-' + gkey + '" data-group="' + gkey + '"></ul></li>');
				for (var mkey in templateData.modules[gkey].modules) {
					var module = templateData.modules[gkey].modules[mkey];

					$('.module-list[data-group="' + gkey + '"]').append('<li><a href="#" class="module" data-group="' + gkey + '" data-key="' + mkey + '" data-module="' + module.name + '">' + module.name + '</a></li>');
				}
			}
		}

		createPreview();
	});

	$('.template-reset').on('click', function(e) {
		e.preventDefault();
		$('#selected-modules').html('');
		$('#template-preview').prop('srcdoc', templateData.base.html);
	});

	$('body').on('click', '.module', function(e) {
		e.preventDefault();
		$('#selected-modules').append('<li><a href="#" data-group="' + $(this).data('group') + '" data-key="' + $(this).data('key') + '" data-module="' + $(this).data('module') + '">' + $(this).text() + ' <span class="left-controls"><span class="move-down"></span><span class="move-up"></span></span><span class="controls"><span class="remove">&times;</span></span></a></li>');
		createPreview();
	});

	$('body').on('click', '.controls .remove', function(e) {
		e.preventDefault();
		$(this).parent().parent().parent().remove();
		createPreview();
	});

	$('body').on('mouseenter mouseleave', '.module-list a', function(e) {
		if ($('#preview-trigger').is(':checked')) {
			if (e.type == 'mouseenter') {
				var base = templateData.base.html;
				var mod = templateData.modules[$(this).data('group')].modules[$(this).data('key')].html;
				base = base.replace('<!--[MODULE_LOCATION]-->', mod);
				while (base.indexOf('<!--[IMG_LOCATION]-->') !== -1)
					base = base.replace('<!--[IMG_LOCATION]-->', templateData.imgLocation);
				$('#module-preview').prop('srcdoc', base);
				$('#module-preview').css({
					display: 'block'
				});
				setTimeout(function() {
					$('#module-preview').height($('#module-preview').contents().find('body').height());
					$('#module-preview').css('top', ($('.main').innerHeight() / 2) - ($('#module-preview').contents().find('body').height() / 2));
					$('#module-preview').css('left', ($('.main').innerWidth() / 2) - ($('#module-preview').width() / 2));
				}, 100);
				$('.overlay').css('display', 'block');
			} else {
				$('#module-preview').css('display', 'none');
				$('.overlay').css('display', 'none');
			}
		}
	});

	$('.preview-anchor').on('mousedown', function(e) {
		e.preventDefault();
		console.log($('#preview-trigger').is(':checked'));
		$('#preview-trigger').trigger('click');
	});

	$('.template-export').on('click', function(e) {
		e.preventDefault();
		var template = new Object();
		template.name = templateData.name;
		template.modules = new Array();
		$('#selected-modules a').each(function(el) {
			template.modules.push($(this).data('module'));
		});
		var json = JSON.stringify(template);
		window.open('ajax.php?a=download&d=' + json, '_blank');
	});

	$('#view-dropdown a').on('click', function(e) {
		$('#view-dropdown li').removeClass("active");
		$(this).parent().addClass('active');
		$('.view-text').text($(this).text());

		$('#template-preview').width($(this).data('size'));
	});

	$('body').on('click', '.left-controls .move-up', function(e) {
		var el = $(this).parent().parent().parent();
		el.prev().before('<li>' + el.html() + '</li>');
		el.remove();

		createPreview();
	});

	$('body').on('click', '.left-controls .move-down', function(e) {
		var el = $(this).parent().parent().parent();
		el.next().after('<li>' + el.html() + '</li>');
		el.remove();

		createPreview();
	});

	function createPreview() {
		var base = templateData.base.html;
		var modules = '';

		$('#selected-modules a').each(function(el) {
			for (var gkey in templateData.modules) {
				for (var mkey in templateData.modules[gkey].modules) {
					var module = templateData.modules[gkey].modules[mkey];

					if (module.name == $(this).data('module'))
						modules += module.html;
				}
			}
		});

		base = base.replace('<!--[MODULE_LOCATION]-->', modules);
		while (base.indexOf('<!--[IMG_LOCATION]-->') !== -1)
			base = base.replace('<!--[IMG_LOCATION]-->', templateData.imgLocation);

		$('#template-preview').prop('srcdoc', base);
	}
});