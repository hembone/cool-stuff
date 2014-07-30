var translations = {

/////////////////////////
// GLOBALS
/////////////////////////

'January' : {
	'en' : "January"
	,'fr' : "janvier"
	,'mx-es' : "enero"
	,'la-es' : "enero"
}
,'February' : {
	'en' : "February"
	,'fr' : "février"
	,'mx-es' : "febrero"
	,'la-es' : "febrero"
}
,'March' : {
	'en' : "March"
	,'fr' : "mars"
	,'mx-es' : "marzo"
	,'la-es' : "marzo"
}
,'April' : {
	'en' : "April"
	,'fr' : "avril"
	,'mx-es' : "abril"
	,'la-es' : "abril"
}
,'May' : {
	'en' : "May"
	,'fr' : "mai"
	,'mx-es' : "mayo"
	,'la-es' : "mayo"
}
,'June' : {
	'en' : "June"
	,'fr' : "juin"
	,'mx-es' : "junio"
	,'la-es' : "junio"
}
,'July' : {
	'en' : "July"
	,'fr' : "juillet"
	,'mx-es' : "julio"
	,'la-es' : "julio"
}
,'August' : {
	'en' : "August"
	,'fr' : "août"
	,'mx-es' : "agosto"
	,'la-es' : "agosto"
}
,'September' : {
	'en' : "September"
	,'fr' : "septembre"
	,'mx-es' : "septiembre"
	,'la-es' : "septiembre"
}
,'October' : {
	'en' : "October"
	,'fr' : "octobre"
	,'mx-es' : "octubre"
	,'la-es' : "octubre"
}
,'November' : {
	'en' : "November"
	,'fr' : "novembre"
	,'mx-es' : "noviembre"
	,'la-es' : "noviembre"
}
,'December' : {
	'en' : "December"
	,'fr' : "décembre"
	,'mx-es' : "diciembre"
	,'la-es' : "diciembre"
}

};

function translate(text, lang) {
	var translated = text;
	if(typeof translations[text] !== 'undefined') {
		translated = translations[text][lang];
	}
	return translated;
}
