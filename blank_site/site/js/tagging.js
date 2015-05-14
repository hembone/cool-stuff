var gaTags = [];

//gaTags['example'] = ['category', 'action', 'label'];


var TAG = {

	event : function(gaIndex) {
		ga('send', 'event', gaTags[gaIndex][0], gaTags[gaIndex][1], gaTags[gaIndex][2]);
	}

};