(function(d){var h=[];d.loadImages=function(a,e){"string"==typeof a&&(a=[a]);for(var f=a.length,g=0,b=0;b<f;b++){var c=document.createElement("img");c.onload=function(){g++;g==f&&d.isFunction(e)&&e()};c.src=a[b];h.push(c)}}})(window.jQuery);
var wl;

ldsrcset=function(t){var e,r=document.querySelectorAll(t);for(e=0;e<r.length;e++){var c=r[e].getAttribute("data-srcset");r[e].setAttribute("srcset",c)}},ldsrc=function(t){var e=document.querySelector(t);if(e){var r=e.getAttribute("data-src");e.setAttribute("src",r)}};ldv=function(t){var e=document.querySelector(t);if(e){var r=document.querySelector(t+" source"),c=r.getAttribute("data-src");r.setAttribute("src",c),e.load()}};!function(){if("Promise"in window&&void 0!==window.performance){var e,t,r=document,n=function(){return r.createElement("link")},o=new Set,a=n(),i=a.relList&&a.relList.supports&&a.relList.supports("prefetch"),s=location.href.replace(/#[^#]+$/,"");o.add(s);var c=function(e){var t=location,r="http:",n="https:";if(e&&e.href&&e.origin==t.origin&&[r,n].includes(e.protocol)&&(e.protocol!=r||t.protocol!=n)){var o=e.pathname;if(!(e.hash&&o+e.search==t.pathname+t.search||"?preload=no"==e.search.substr(-11)||".html"!=o.substr(-5)&&".html"!=o.substr(-5)&&"/"!=o.substr(-1)))return!0}},u=function(e){var t=e.replace(/#[^#]+$/,"");if(!o.has(t)){if(i){var a=n();a.rel="prefetch",a.href=t,r.head.appendChild(a)}else{var s=new XMLHttpRequest;s.open("GET",t,s.withCredentials=!0),s.send()}o.add(t)}},p=function(e){return e.target.closest("a")},f=function(t){var r=t.relatedTarget;r&&p(t)==r.closest("a")||e&&(clearTimeout(e),e=void 0)},d={capture:!0,passive:!0};r.addEventListener("touchstart",function(e){t=performance.now();var r=p(e);c(r)&&u(r.href)},d),r.addEventListener("mouseover",function(r){if(!(performance.now()-t<1200)){var n=p(r);c(n)&&(n.addEventListener("mouseout",f,{passive:!0}),e=setTimeout(function(){u(n.href),e=void 0},80))}},d)}}();

$(function(){
r=function(){dpi=window.devicePixelRatio;var a='data-src';var e=document.querySelector('.un69');if(e.hasAttribute('src')){a='src';}e.setAttribute(a,(dpi>1)?((dpi>2)?'images/img_6906-1032.jpg':'images/img_6906-688.jpg'):'images/img_6906-344.jpg');
var a='data-src';var e=document.querySelector('.un70');if(e.hasAttribute('src')){a='src';}e.setAttribute(a,(dpi>1)?((dpi>2)?'images/img_6981-972.jpg':'images/img_6981-648.jpg'):'images/img_6981-324.jpg');
var a='data-src';var e=document.querySelector('.un71');if(e.hasAttribute('src')){a='src';}e.setAttribute(a,(dpi>1)?((dpi>2)?'images/8c3af846-3afc-4e4e-931b-001a6e24532e-1095.png':'images/8c3af846-3afc-4e4e-931b-001a6e24532e-730.png'):'images/8c3af846-3afc-4e4e-931b-001a6e24532e-365.png');
var a='data-src';var e=document.querySelector('.un72');if(e.hasAttribute('src')){a='src';}e.setAttribute(a,(dpi>1)?((dpi>2)?'images/d6b71bed-f7a0-473a-adff-584d6025dd8f-1059.png':'images/d6b71bed-f7a0-473a-adff-584d6025dd8f-706.png'):'images/d6b71bed-f7a0-473a-adff-584d6025dd8f-353.png');
var a='data-src';var e=document.querySelector('.un73');if(e.hasAttribute('src')){a='src';}e.setAttribute(a,(dpi>1)?((dpi>2)?'images/img_6918-621.jpg':'images/img_6918-414.jpg'):'images/img_6918-207.jpg');
var a='data-src';var e=document.querySelector('.un74');if(e.hasAttribute('src')){a='src';}e.setAttribute(a,(dpi>1)?((dpi>2)?'images/img_6991-765-1.jpg':'images/img_6991-510-1.jpg'):'images/img_6991-255-1.jpg');
var a='data-src';var e=document.querySelector('.un75');if(e.hasAttribute('src')){a='src';}e.setAttribute(a,(dpi>1)?((dpi>2)?'images/img_6994-846.png':'images/img_6994-564.png'):'images/img_6994-282.png');
var a='data-src';var e=document.querySelector('.un76');if(e.hasAttribute('src')){a='src';}e.setAttribute(a,(dpi>1)?((dpi>2)?'images/img_1467-516.png':'images/img_1467-344.png'):'images/img_1467-172.png');
var e=document.querySelector('.un67');e.setAttribute('src',(dpi>1)?((dpi>2)?'images/30665de7-3283-40ca-a9ed-b3591476a9aa-615.jpeg':'images/30665de7-3283-40ca-a9ed-b3591476a9aa-410.jpeg'):'images/30665de7-3283-40ca-a9ed-b3591476a9aa-205.jpeg');
var e=document.querySelector('.un68');e.setAttribute('src',(dpi>1)?((dpi>2)?'images/jcm2000-1011.png':'images/jcm2000-674.png'):'images/jcm2000-337.png');};
if(!window.HTMLPictureElement){r();}
!function(){var e=document.querySelectorAll('a[href^="#"]');[].forEach.call(e,function(e){e.addEventListener("click",function(t){var o=0;if(e.hash.length>1){var n=parseFloat(getComputedStyle(document.body).getPropertyValue("zoom"));n||(n=1);var r=document.querySelectorAll('[name="'+e.hash.slice(1)+'"]')[0];if(!r)return;var l=/chrome/i.test(navigator.userAgent);o=l?r.getBoundingClientRect().top*n+pageYOffset:(r.getBoundingClientRect().top+pageYOffset)*n}if("scrollBehavior"in document.documentElement.style)scroll({top:o,left:0,behavior:"smooth"});else if("requestAnimationFrame"in window){var a=pageYOffset,i=null;requestAnimationFrame(function e(t){i||(i=t);var n=t-i;scrollTo(0,a<o?(o-a)*n/400+a:a-(a-o)*n/400),n<400?requestAnimationFrame(e):scrollTo(0,o)})}else scrollTo(0,o);t.preventDefault()},!1)})}();
initMenu($('#m1')[0]);
if(location.hash){var e=location.hash.replace("#",""),o=function(){var t=document.querySelectorAll('[name="'+e+'"]')[0];t&&t.scrollIntoView(),"0px"===window.getComputedStyle(document.body).getPropertyValue("min-width")&&setTimeout(o,100)};o()}

});lfn=function(){ldsrcset('.un77 source');ldsrcset('.un78 source');ldsrcset('.un79 source');ldsrcset('.un80 source');ldsrcset('.un81 source');ldsrcset('.un82 source');ldsrcset('.un83 source');ldsrcset('.un84 source');};if(document.readyState=="complete"){lfn();}else{$(window).on("load",lfn);}