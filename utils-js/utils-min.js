var UTILS={cookie:{set:function(e,o,i){var n="";if(i){var t=new Date;t.setTime(t.getTime()+24*i*60*60*1e3),n="; expires="+t.toGMTString()}else n="";document.cookie=e+"="+o+n+"; path=/"},get:function(e){for(var o=e+"=",i=document.cookie.split(";"),n=0;n<i.length;n++){for(var t=i[n];" "===t.charAt(0);)t=t.substring(1,t.length);if(0===t.indexOf(o))return t.substring(o.length,t.length)}return null},remove:function(e){UTILS.cookie.set(e,"",-1)}},popupWindow:function(e,o,i,n){var t=screen.width/2-i/2,r=screen.height/2-n/2;return window.open(e,o,"toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width="+i+", height="+n+", top="+r+", left="+t)},windowWidth:function(){return window.innerWidth},windowHeight:function(){return window.innerHeight},urlSegment:function(e){let o=window.location.pathname.split("/");return void 0!==o[e]&&o[e]},urlParam:function(e){let o={};window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,(function(e,i,n){o[i]=n}));return void 0!==o[e]?o[e]:o},scrollTo:function(e,o){let i=$(e).offset();$("html, body").animate({scrollTop:i.top},o)},isScrolled:{init:function(e){UTILS.isScrolled.check(e),$(window).scroll((function(){UTILS.isScrolled.check(e)}))},check:function(e){let o=20;e&&(o=e),$(window).scrollTop()>o?$(".is-scrolled").addClass("scroll-active"):$(".is-scrolled").removeClass("scroll-active")}},isVisible:function(e){$(window).scroll((function(){var o=$(e).offset().top,i=$(e).offset().top+$(e).outerHeight(),n=$(window).scrollTop()+$(window).innerHeight(),t=$(window).scrollTop();return n>o&&t<i}))},resize:{init:function(e){"function"==typeof e&&(UTILS.resize.resizeTimeout="",UTILS.resize.set(e),e())},set:function(e){$(window).on("resize",(function(){clearTimeout(UTILS.resize.resizeTimeout),UTILS.resize.resizeTimeout=setTimeout(e,100)}))}}};