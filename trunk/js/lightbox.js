/*
	Lightbox
*/
//
// Configuration
//
var loadingImage = 'images/loading.gif';
var closeButton = 'images/close.gif';

//
// Init script
//
document.write('<LINK rel="stylesheet" href="js/lightbox.css" type="text/css" />');
addLoadEvent(lb_Init);

// Variables
var lb_Overlay, lb_Lightbox, lb_LoadingImage;

//
// Init lightbox
//
function lb_Init(){
	var body = document.body || document.documentElement;
	// Create loading image
	lb_LoadingImage = insertElement(body,'IMG','loadingImage');
	lb_LoadingImage.src = loadingImage;
	// Create lightbox container
	lb_Lightbox = insertElement(body,'DIV','lightbox');
	// Create shaded overlay
	lb_Overlay = insertElement(body,'DIV','overlay');
	setOpacity(lb_Overlay, 0);
	lb_Overlay.onclick = hideLightbox;
}

//
// Do Animation func
//
function linear(t){return t;}
function giperbolic(t){return 1 + Math.pow(t - 1, 3);}
function backout(g){return function(t){return (-1 * t * (t + g - 2)) / (1 - g);};};

function lb_animate(el, p, to, d, ease, cb){
	var op = p == 'opacity', v;
	var from = op ? getOpacity(el):parseFloat(el[p]?el[p]:el.style[p]);
	if(isNaN(from)) from = 0;
	var delta = to - from;
	if(delta == 0){if (cb) cb(); return;} // nothing to animate
	if(!d){fn(1); if (cb) cb(); return;}  // cancel the animation
	// Animation func
	function fn(e){
		v = from + e * delta;
		if(op) setOpacity(el, v);
		else if (el[p]) el[p] = v + 'px';
		else el.style[p] = v + 'px';
	}
	var begin = new Date().getTime(),
		end = begin + d,
		time,
		timer = setInterval(function(){time = new Date().getTime();if(time >= end){clearInterval(timer);fn(1); if (cb) cb();}else fn(ease((time - begin) / d));}, 10); // 10 ms interval is minimum on webkit
}

//
// Show object in center of window
//
function lb_showAndAlign(obj){
	var page = getPageRect();
	var s = obj.style;
	s.display = 'block';
	var top = (page.height - obj.offsetHeight) / 2 + page.top;
	s.top  = (top < 0 ? 0 : top) + 'px';
	s.left = ((page.width - obj.offsetWidth) / 2) + 'px';
}

//
// Hide Select boxes as they will 'peek' through the image in IE
//
function lb_selectBoxVisibility(state){
	selects = document.getElementsByTagName("select");
		for (i = 0; i != selects.length; i++)
			selects[i].style.visibility = state;
}
//
// Show full screen overlay
//
function lb_drawOverlay(){
	// make select boxes hidden
	lb_selectBoxVisibility("hidden");
	// set height of Overlay to take up whole page and show
	var page= getPageRect();
	lb_Overlay.style.width  = (page.width > page.scrollX ? page.width : page.scrollX)+ 'px';
	lb_Overlay.style.height = (page.height> page.scrollY ? page.height: page.scrollY)+ 'px';
	lb_Overlay.style.display = 'block';
	lb_animate(lb_Overlay, 'opacity', 80, 400, giperbolic);
	// Center and show loadingImage if it need and exists
	lb_showAndAlign(document.getElementById('loadingImage'));
}
//
// Hide
//
function hideLightbox(){
	// hide lightbox and overlay
	lb_LoadingImage.style.display = 'none';
	lb_Lightbox.style.display = 'none';
	lb_Lightbox.innerHTML = '';
	lb_animate(lb_Overlay, 'opacity', 0, 400, giperbolic, function (){lb_Overlay.style.display = 'none';});
	// make select boxes visible
	lb_selectBoxVisibility("visible");
	return false;
}
//
// Preloads images. Pleace new image in lightbox then centers and display.
//
function showLightbox(){
	var objLink = this;
	lb_drawOverlay();
	setOpacity(lb_Lightbox, 0);
	// Prepare load inner data
	var imgPreload = new Image();
	imgPreload.onload=function(){
		// Hide loadingImage if exists
		lb_LoadingImage.style.display = 'none';
		lb_Lightbox.onclick = hideLightbox;
		var title = objLink.getAttribute('title');
		var page = getPageRect();
		var height = page.height > 25 + imgPreload.height ? imgPreload.height : page.height - 25;
		lb_Lightbox.innerHTML =
		'<a href="#" title="Click to close">' +
		'	<img id="lightboxImage"/ src="' + objLink.href + '" height=' + height + 'px>' +
		'	<img id="closeButton" src="' + closeButton + '" onclick="return hideLightbox();"/>' +
		'</a>' +
		(title ? '<div id="lightboxCaption">' + title + '</div>':'');
		// Show popup
		lb_showAndAlign(lb_Lightbox);
		lb_animate(lb_Lightbox, 'opacity', 100, 900, giperbolic);
	}
	imgPreload.src = objLink.href;
	return false;
}
//
// Preloads html.
//
function showAjaxBox(){
	lb_drawOverlay();
	function showHtmlBox(html)
	{
		if (lb_LoadingImage.style.display == 'none')
			return;
		// Hide loadingImage if exists
		lb_LoadingImage.style.display = 'none';
		lb_Lightbox.innerHTML = html+'<img id="closeButton" src="' + closeButton + '" onclick="return hideLightbox();"/>';
		execHTMLScripts(lb_Lightbox);
		parseHref(lb_Lightbox);
		lb_showAndAlign(lb_Lightbox);
		//setOpacity(lb_Lightbox, 0);
		//lb_animate(lb_Lightbox, 'opacity', 100, 800, giperbolic);
	}
	my_AJAX.GETupload('ajax.php?'+this.href.split('?')[1], showHtmlBox);
	return false;
}