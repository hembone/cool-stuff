var gaTags = [];
// gaTags['ga_example'] = ['category', 'action', 'label'];

var flTags = [];
// flTags['fl_example'] = ['src', 'type', 'cat'];

var TAG = {

	gaEvent : function(gaIndex) {
		ga('send', 'event', gaTags[gaIndex][0], gaTags[gaIndex][1], gaTags[gaIndex][2]);
	}

	,gaPage : function(gaIndex) {
		ga('send', 'pageview', {'title': gaTags[gaIndex]});
	}

	,fl : function (flIndex) {
		var axel = Math.random() + "";
		var a = axel * 10000000000000;
		var floodlight = $('<iframe src="https://' + flTags[flIndex][0] + '.fls.doubleclick.net/activityi;src=' + flTags[flIndex][0] + ';type=' + flTags[flIndex][1] + ';cat=' + flTags[flIndex][2] + ';ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
		$('body').append(floodlight);
	}

};