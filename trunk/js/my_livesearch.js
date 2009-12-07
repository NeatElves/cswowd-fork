/*
 * Live search script
 */
var ls_delay = 500;      // Search delay after key up
var ls_hidedelay = 500;  // Hide delay after lose focus (must be > 0)

var ls_mainDiv = 0,      // Main div
ls_Cache = new Array(),
ls_ajax  = new Array(),
ls_begin_timer = new Number(0),
ls_parent = 0,
ls_u = "undefined";

function ls_postLoad()
{
    var ls_input = getElementsByClass('ls_search', null, 'input');
    if (ls_input == null)
        return;
    for (i=0;i<ls_input.length; i++)
    {
        var input = ls_input[i];
        input.setAttribute("autocomplete", "off");
        addEvent(input, 'keyup', liveSearch);
        addEvent(input, 'focus', liveSearch);
        addEvent(input, 'input', liveSearch);
        addEvent(input, 'blur', ls_hide);
    }
}
function ls_Init()
{
    ls_body = (document.getElementsByTagName ? document.getElementsByTagName("body")[0]: (document.body || null));
    // Create the tooltip DIV
    if(ls_body.insertAdjacentHTML)
        ls_body.insertAdjacentHTML("afterBegin", '<div id=ls_my_livesearch></div>');
    else if(typeof ls_body.innerHTML != ls_u && document.createElement && ls_body.appendChild)
        ls_body.appendChild(ls_MkMainDivDom());
    ls_mainDiv = document.getElementById('ls_my_livesearch');
    ls_mainDiv.style.position = "absolute";
    ls_mainDiv.style.zIndex = 10;
    addLoadEvent(ls_postLoad);
}
function ls_MkMainDivDom()
{
	var el = document.createElement("div");
	if(el)
        el.id = "ls_my_livesearch";
	return el;
}
function ls_onloaded(ajaxIndex, i, element)
{
    ls_Cache[i] = ls_ajax[ajaxIndex].response;
    ls_ajax[ajaxIndex] = false;
    ls_show(element, ls_Cache[i]);
}
function ls_dosearch(id)
{
    var element = ls_parent;
    var name = element.value;
    if (name.length < 2)
    {
        ls_hide();
        return;
    }
    var i = id + '_' + name;
    if(ls_Cache[i])
        ls_show(element, ls_Cache[i]);
    else
    {
        var ajaxIndex = ls_ajax.length;
        ls_ajax[ajaxIndex] = new sack('ajax.php?ls=' + id + '&name=' + name);
        ls_ajax[ajaxIndex].mode = true;
        ls_ajax[ajaxIndex].onCompletion = function(){ ls_onloaded(ajaxIndex, i, element); };
        ls_ajax[ajaxIndex].runAJAX();
    }
}
function liveSearch(e)
{
    e = window.event || e;
    var name = e.target || e.srcElement;
    if (name.length < 2)
    {
        ls_hide();
        return;
    }
    var id   = name.alt;
    ls_parent = e.target;
    if (ls_delay)
    {
        ls_begin_timer.EndTimer();
        ls_begin_timer.Timer('ls_dosearch(\'' + id + '\')', ls_delay, true);
    }
    else
        ls_dosearch(id);
}
function ls_show(parent, text)
{
    ls_mainDiv.innerHTML = text;
    enableHrefTip(ls_mainDiv);
    var bounds = getBounds(parent);
    tt_AlignToScreen(ls_mainDiv, bounds.left, bounds.top + bounds.height+1);
    ls_mainDiv.style.visibility = "visible";
}
function ls_doHide()
{
    ls_mainDiv.style.visibility = "hidden";
}
function ls_hide()
{
    ls_begin_timer.EndTimer();
    ls_begin_timer.Timer('ls_doHide()', ls_hidedelay, true);
}
ls_Init();