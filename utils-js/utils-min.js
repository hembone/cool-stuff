var UTILS={cookie:{set:function(e,o,t){var i="";if(t){var n=new Date;n.setTime(n.getTime()+24*t*60*60*1e3),i="; expires="+n.toGMTString()}else i="";document.cookie=e+"="+o+i+"; path=/"},get:function(e){for(var o=e+"=",t=document.cookie.split(";"),i=0;i<t.length;i++){for(var n=t[i];" "===n.charAt(0);)n=n.substring(1,n.length);if(0===n.indexOf(o))return n.substring(o.length,n.length)}return null},remove:function(e){UTILS.cookie.set(e,"",-1)}},popupWindow:function(e,o,t,i){var n=screen.width/2-t/2,r=screen.height/2-i/2;return window.open(e,o,"toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width="+t+", height="+i+", top="+r+", left="+n)},animateScrollTo:function(e,o){$("html, body").animate({scrollTop:e},o)},resize:{init:function(e){"function"==typeof e&&(UTILS.resize.resizeTimeout="",UTILS.resize.set(e),e())},set:function(e){$(window).on("resize",function(){clearTimeout(UTILS.resize.resizeTimeout),UTILS.resize.resizeTimeout=setTimeout(e,100)})}}};