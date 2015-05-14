var gaTags = [];

gaTags['global_1'] = ['engagement', 'click', 'menu'];


var TAG = {

	event : function(gaIndex) {
		ga('send', 'event', gaTags[gaIndex][0], gaTags[gaIndex][1], gaTags[gaIndex][2]);
	}

	,pageview : function(gaIndex) {
		ga('send', 'pageview', {'title': gaTags[gaIndex]});
	}

};