var translate = {

	translations : {
		'January' : {
			'en' : "January"
			,'fr' : "janvier"
			,'es' : "enero"
		}
		,'February' : {
			'en' : "February"
			,'fr' : "février"
			,'es' : "febrero"
		}
	}

	,get : function(text, lang) {
		var translated = text;
		if(typeof translate.translations[text] !== 'undefined') {
			translated = translate.translations[text][lang];
		}
		return translated;
	}
	
};