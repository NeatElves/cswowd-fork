/*
 My tooltip lib
*/
var config = new Object();

config. width       =   0   // Tooltip width, 0 for auto
config. OffsetX     =  40   // Horizontal offset of left-top corner from mousepointer
config. OffsetY     = -30   // Vertical offset
config. Sticky      = true  // Move or not while shown
config. Border      = true  // Show border
config. step        = 100   // Opacity step time
config. timeUp      = 0     // Show opacity time
config. timeDown    = 1500  // Hide opacity time
tt_aV = new Array();        // Caches and enumerates config data for currently active tooltip

// Mouse data
var tt_musX = 0, tt_musY = 0, tt_scrlX = 0, tt_scrlY = 0;
// Broser depend data
var tt_db = document.body ||
    document.documentElement ||
    (document.getElementsByTagName ? document.getElementsByTagName("body")[0] : null);
var tt_flagOpa = 0;
var tt_u = "undefined";
// tip data
var tt_opaTimer = new Number(0),
tt_mainDiv = 0,     // Main div
tt_subDiv = 0,      // Main sub div - for opacity
tt_status  = 0,     // Status & 1 - tip shown/hide
tt_element = 0,     // onmouseover element for hide tooltip
tt_opacity = 0,     // Current sub div opacity
tt_Cache = new Array(),
tt_ajaxObjects = new Array(),
tt_currentTip,
tt_loading_text = '<div class=loading> </div>';

function ajax_AddContent(ajaxIndex, url)
{
    tt_Cache[url] = tt_ajaxObjects[ajaxIndex].response;
    tt_ajaxObjects[ajaxIndex] = false;
    if (tt_currentTip != url)
        return;
    if ((tt_status & 1) == 0)
        return;
    tt_UpdateTip(tt_Cache[url]);
    if (tt_flagOpa)
        tt_SetOpa(tt_subDiv.style, tt_opacity);
    tt_updatePosition();
}
function ajaxTip()
{
    tt_currentTip = arguments[0];
    if(tt_Cache[tt_currentTip])
    {
        arguments[0] = tt_Cache[tt_currentTip];
        tt_Tip(arguments);
    }
    else
    {
        arguments[0] = tt_loading_text;
        tt_Tip(arguments);
        var ajaxIndex = tt_ajaxObjects.length;
        var i = tt_currentTip;
        tt_ajaxObjects[ajaxIndex] = new sack("ajax.php?tip=" + i);
        tt_ajaxObjects[ajaxIndex].mode = true;
        tt_ajaxObjects[ajaxIndex].onCompletion = function(){ ajax_AddContent(ajaxIndex, i); };
        tt_ajaxObjects[ajaxIndex].runAJAX();
    }
}
function tt_hrefTip(e)
{
    e = window.event || e;
    var ref = e.target || e.srcElement;
    var img = false;
    while (ref.tagName!='A')
    {
        if (ref.parentNode == null)
            return;
        if (ref.tagName=='IMG')
            img = true;
        ref = ref.parentNode;
    }
    if (img)
        ajaxTip(ref.id);
    else
        ajaxTip(ref.id, STICKY, false);
}
function enableHrefTip(element)
{
    var r={'item':'i', 'spell':'s', 'enchant':'e', 'npc':'c', 'faction':'f'};
    var c = element.getElementsByTagName("a");
    for (var i = 0; i < c.length; i++)
    {
        var a = c[i];
        var reg = a.href.match('(.+\\?)(.+?)=(\\d+$)');
        if (reg && a.id!='no_tip' && r[reg[2]])
        {
            a.id = r[reg[2]] + reg[3];
            tt_AddEvtFnc(a, "mouseover", tt_hrefTip, true);
        }
    }
}
function Tip()
{
    tt_currentTip = -1;
    tt_Tip(arguments);
}
function tt_Tip(arg)
{
    tt_ReadCmds(arg);
    tt_UpdateTip(arg[0]);
    tt_updatePosition();
    tt_startShowTip();
}
function tt_opaStepUp(step)
{
    tt_opacity+=(100*step/tt_aV[TIMEUP]);
    var time = Math.floor(tt_aV[TIMEUP]/step);
    if (tt_opacity < 100)
        tt_opaTimer.Timer("tt_opaStepUp(" + step + ")", time, true);
    else
        {tt_opaTimer.EndTimer();tt_opacity = 100;}
    tt_SetOpa(tt_subDiv.style, tt_opacity);
}
function tt_opaStepDown(step)
{
    tt_opacity-=(100*step/tt_aV[TIMEDOWN]);
    var time = Math.floor(tt_aV[TIMEDOWN]/step);
    if (tt_opacity > 0)
        tt_opaTimer.Timer("tt_opaStepDown(" + step + ")", time, true);
    else
        {tt_opaTimer.EndTimer();tt_finishHideTip();}
    tt_SetOpa(tt_subDiv.style, tt_opacity);
}
function tt_startShowTip()
{
    tt_opaTimer.EndTimer();
    if (tt_element)
    {
        tt_RemEvtFnc(tt_element, "mouseout", tt_Hide);
        tt_element = 0;
    }

    tt_status|=1;
    tt_mainDiv.style.visibility = "visible";
    if (tt_flagOpa && tt_aV[TIMEUP])
    {
        tt_opacity = 0;
        tt_opaStepUp(tt_aV[STEP]);
    }
    else
    {
        tt_opacity = 100;
        tt_SetOpa(tt_subDiv.style, tt_opacity);
    }
}
function tt_startHideTip()
{
    tt_opaTimer.EndTimer();
    tt_status&=~1;
    if (tt_flagOpa && tt_aV[TIMEDOWN])
        tt_opaStepDown(tt_aV[STEP]);
    else
        tt_finishHideTip();
}
function tt_finishHideTip()
{
    tt_mainDiv.style.visibility = "hidden";
    tt_opacity = 0;
}
function tt_updatePosition()
{
    var win_width  = tt_GetClientW();
    var win_height = tt_GetClientH();
    var div_width  = tt_mainDiv.offsetWidth  || tt_mainDiv.style.pixelWidth || 0;
    var div_height = tt_mainDiv.offsetHeight || tt_mainDiv.style.pixelHeight || 0;
    var x = tt_musX - tt_scrlX + tt_aV[OFFSETX];
    var y = tt_musY - tt_scrlY + tt_aV[OFFSETY];
    if (x + div_width >= win_width ) x = win_width  - div_width;
    if (y + div_height>= win_height) y = win_height - div_height;

    var inX_ByX = (tt_musX - tt_scrlX > x && tt_musX - tt_scrlX < x + div_width );
    var inY_ByY = (tt_musY - tt_scrlY > y && tt_musY - tt_scrlY < y + div_height);
    if (inX_ByX && inY_ByY)
    {
        if (inX_ByX)
            x = tt_musX - tt_scrlX - div_width  - tt_aV[OFFSETX];
        else if (inX_ByY)
            y = tt_musY - tt_scrlY - div_height - tt_aV[OFFSETY];
    }
    if (x < 0) x = 0;
    if (y < 0) y = 0;

    var css = tt_mainDiv.style;
    css.left = x + tt_scrlX;
    css.top  = y + tt_scrlY;
}
function tt_AlignToScreen(element, x, y)
{
    var win_width  = tt_GetClientW();
    var win_height = tt_GetClientH();
    var div_width  = element.offsetWidth  || element.style.pixelWidth || 0;
    var div_height = element.offsetHeight || element.style.pixelHeight || 0;
    x-=tt_scrlX;
    y-=tt_scrlY;
    if (x + div_width >= win_width ) x = win_width  - div_width;
    if (x < 0) x = 0;
    if (y + div_height>= win_height) y = win_height - div_height;
    if (y < 0) y = 0;
    var css = element.style;
    css.left = x + tt_scrlX;
    css.top  = y + tt_scrlY;
}
function tt_UpdateTip(text)
{
    var width = tt_aV[WIDTH]==0 ? '' : (' style="width:' + tt_aV[WIDTH] + 'px;"');
    if (tt_aV[BORDER])
    {
        var tt_tipBody = document.getElementById('tt_tip_body');
        if (tt_tipBody)
        {
            tt_tipBody.innerHTML = text;
            if (tt_aV[WIDTH]) tt_tipBody.style.width = tt_aV[WIDTH];
            return;
        }
        tt_mainDiv.innerHTML = ''
        + '<div id=tt_tooltip>'
        + '<table class=tooltip cellSpacing=0 cellPadding=0><tbody>'
        + '<tr><td class=tiptopl></td><td class=tiptop></td><td class=tiptopr></td></tr>'
        + '<tr><td class=tipl>&nbsp;</td><td class=tipbody' + width + ' id=tt_tip_body>'
    	+ text
        + '</td><td class=tipr>&nbsp;</td></tr>'
        + '<tr><td class=tipbottoml></td><td class=tipbottom></td><td class=tipbottomr></td></tr>'
        + '</tbody></table></div>';
    }
    else
        tt_mainDiv.innerHTML = ''
        + '<div id=tt_tooltip ' + width + '>'
    	+ text
        + '</div>';
    tt_subDiv = document.getElementById('tt_tooltip');
}
function tt_GetClientW()
{
	return(document.body && (typeof(document.body.clientWidth) != tt_u) ? document.body.clientWidth
			: (typeof(window.innerWidth) != tt_u) ? window.innerWidth
			: tt_db ? (tt_db.clientWidth || 0)
			: 0);
}
function tt_GetClientH()
{
	return(document.body && (typeof(document.body.clientHeight) != tt_u) ? document.body.clientHeight
			: (typeof(window.innerHeight) != tt_u) ? window.innerHeight
			: tt_db ? (tt_db.clientHeight || 0)
			: 0);
}
function tt_Hide(e)
{
	e = window.event || e;
    if (e)
    {
        var target = e.target || e.srcElement;
        if (tt_element == target)
        {
            tt_RemEvtFnc(tt_element, "mouseout", tt_Hide);
            tt_element = 0;
            tt_startHideTip();
        }
    }
}
function tt_Scroll(e)
{
	e = window.event || e;
	if(e)
	{
		tt_scrlX = window.pageXOffset || (tt_db ? (tt_db.scrollLeft || 0) : 0);
		tt_scrlY = window.pageYOffset || (tt_db ? (tt_db.scrollTop || 0) : 0);
        if (tt_aV[STICKY])
           tt_updatePosition();
	}
}
function tt_Move(e)
{
	e = window.event || e;
	if(e)
	{
        tt_musX = (typeof(e.pageX) != tt_u) ? e.pageX : (e.clientX + tt_scrlX);
        tt_musY = (typeof(e.pageY) != tt_u) ? e.pageY : (e.clientY + tt_scrlY);
        if (tt_element == 0 && tt_status & 1)
        {
            tt_element = e.target || e.srcElement;
            tt_AddEvtFnc(tt_element, "mouseout", tt_Hide);
        }
        if (!tt_aV[STICKY] && tt_status&1)
           tt_updatePosition();
	}
}
function Init()
{
    // Create the tooltip DIV
    if(tt_db.insertAdjacentHTML)
        tt_db.insertAdjacentHTML("afterBegin", tt_MkMainDivHtm());
    else if(typeof tt_db.innerHTML != tt_u && document.createElement && tt_db.appendChild)
        tt_db.appendChild(tt_MkMainDivDom());
    tt_mainDiv = document.getElementById('tt_mytooltip');
    tt_mainDiv.style.position = "absolute";
    tt_mainDiv.style.zIndex   = 1000;
    tt_MkCmdEnum();
    tt_OpaSupport();
    tt_AddEvtFnc(window, "scroll", tt_Scroll);
    tt_AddEvtFnc(document, "mousemove", tt_Move);
    tt_AddEvtFnc(window, "unload", tt_finishHideTip);
    tt_finishHideTip();
}
function tt_MkMainDivHtm()
{
	return('<div id=tt_mytooltip></div>');
}
function tt_MkMainDivDom()
{
	var el = document.createElement("div");
	if(el)
	  el.id = "tt_mytooltip";
	return el;
}
function tt_AddEvtFnc(el, sEvt, PFnc)
{
	if(el)
	{
		if(el.addEventListener)
			el.addEventListener(sEvt, PFnc, false);
		else
			el.attachEvent("on" + sEvt, PFnc);
	}
}
function tt_RemEvtFnc(el, sEvt, PFnc)
{
	if(el)
	{
		if(el.removeEventListener)
			el.removeEventListener(sEvt, PFnc, false);
		else
			el.detachEvent("on" + sEvt, PFnc);
	}
}
function tt_OpaSupport()
{
	var css = tt_db.style;

	tt_flagOpa = (typeof(css.opacity) != tt_u) ? 1
				: (typeof(css.KhtmlOpacity) != tt_u) ? 2
				: (typeof(css.KHTMLOpacity) != tt_u) ? 3
				: (typeof(css.MozOpacity) != tt_u) ? 4
				: (typeof(css.filter) != tt_u) ? 5
				: 0;
}
function tt_SetOpa(css, opa)
{
	if(tt_flagOpa == 5)
	{
		if(opa < 100)
		{
			var bVis = css.visibility != "hidden";
			css.zoom = "100%";
			if(!bVis)
				css.visibility = "visible";
			css.filter = "alpha(opacity=" + opa + ")";
			if(!bVis)
				css.visibility = "hidden";
		}
		else
			css.filter = "";
	}
	else
	{
		opa /= 100.0;
		switch(tt_flagOpa)
		{
		case 1:
			css.opacity = opa; break;
		case 2:
			css.KhtmlOpacity = opa; break;
		case 3:
			css.KHTMLOpacity = opa; break;
		case 4:
			css.MozOpacity = opa; break;
		}
	}
}
Number.prototype.Timer = function(s, iT, bUrge)
{
	if(!this.value || bUrge)
		this.value = window.setTimeout(s, iT);
}
Number.prototype.EndTimer = function()
{
	if(this.value)
	{
		window.clearTimeout(this.value);
		this.value = 0;
	}
}
// Creates command names by translating config variable names to upper case
function tt_MkCmdEnum()
{
	var n = 0;
	for(var i in config)
		eval("window." + i.toString().toUpperCase() + " = " + n++);
}
function tt_ReadCmds(a)
{
	var i;
	// First load the global config values, to initialize also values
	// for which no command has been passed
	i = 0;
	for(var j in config)
		tt_aV[i++] = config[j];
	// Then replace each cached config value for which a command has been
	// passed (ensure the # of command args plus value args be even)
	if(a.length & 1)
	{
		for(i = a.length - 1; i > 0; i -= 2)
			tt_aV[a[i - 1]] = a[i];
		return true;
	}
	tt_Err("Incorrect call of Tip() or ajaxTip().\n"
			+ "Each command must be followed by a value.");
	return false;
}
Init();
