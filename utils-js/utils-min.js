var UTILS={cookie:{set:function(e,t,n){var o="";if(n){var i=new Date;i.setTime(i.getTime()+24*n*60*60*1e3),o="; expires="+i.toGMTString()}else o="";document.cookie=e+"="+t+o+"; path=/"},get:function(e){for(var t=e+"=",n=document.cookie.split(";"),o=0;o<n.length;o++){for(var i=n[o];" "===i.charAt(0);)i=i.substring(1,i.length);if(0===i.indexOf(t))return i.substring(t.length,i.length)}return null},remove:function(e){UTILS.cookie.set(e,"",-1)}},popupWindow:function(e,t,n,o){var i=screen.width/2-n/2,r=screen.height/2-o/2;return window.open(e,t,"toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width="+n+", height="+o+", top="+r+", left="+i)},windowWidth:function(){return window.innerWidth},windowHeight:function(){return window.innerHeight},urlSegment(e){let t=window.location.pathname.split("/");return void 0!==t[e]&&t[e]},scrollTo:function(e,t){let n=$(e).offset();$("html, body").animate({scrollTop:n.top},t)},resize:{init:function(e){"function"==typeof e&&(UTILS.resize.resizeTimeout="",UTILS.resize.set(e),e())},set:function(e){$(window).on("resize",(function(){clearTimeout(UTILS.resize.resizeTimeout),UTILS.resize.resizeTimeout=setTimeout(e,100)}))}}};