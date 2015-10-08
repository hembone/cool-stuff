$(document).ready(function() {
	window.APP = {

		init : function() {
            APP.setListeners();
		},

        setListeners : function() {
            $(document).on('click', '#settings', function() {
                $('#settings-overlay').fadeIn();
            });
            $(document).on('click', '#close-settings', function() {
                $('#settings-overlay').fadeOut();
            });
            $(document).on('click', '#refresh', function() {
                $('iframe').each(function(idx, el) {
                    $(el).attr('src', function(i, val) {return val;});
                });
            });
            $(document).on('keyup change', '.iframe-input', function() {
                APP.inputEvent(this);
            });
        },

        inputEvent : function(el) {
            var name = $(el).attr('name');
            var url = $(el).val();
            $('#'+name).attr('src', url);
        }

	};
	APP.init();
});
