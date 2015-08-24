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