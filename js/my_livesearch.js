/*
 * Live search script
 */
var ls_delay = 500;      // Search delay after key up
var ls_hidedelay = 500;  // Hide delay after lose focus (must be > 0)

var ls_mainDiv = 0,      // Main div
ls_begin_timer = new Number(0);

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
	ls_body = document.body || document.documentElement;
	ls_mainDiv = insertElement(ls_body, 'DIV', 'ls_my_livesearch');
	ls_mainDiv.style.position = "absolute";
	ls_mainDiv.style.zIndex = 10;
	addLoadEvent(ls_postLoad);
}
function ls_dosearch(parent)
{
	my_AJAX.GETupload('ajax.php?ls=' + parent.alt + '&name=' + parent.value, function (text){ls_show(parent, text);});
}
function liveSearch()
{
	var name = this.value, input = this;
	if (name.length < 2)
	{
		ls_hide();
		return;
	}
	if (ls_delay)
		ls_begin_timer.Timer(function (){ls_dosearch(input)}, ls_delay, true);
	else
		ls_dosearch(input);
}
function ls_show(parent, text)
{
	ls_mainDiv.innerHTML = text;
	parseHref(ls_mainDiv);
	var bounds = getBounds(parent);
	p = getPageRect(),
	x = bounds.left,
	y = bounds.top + bounds.height+1,
	max_x = p.width - ls_mainDiv.offsetWidth,
	max_y = p.height - ls_mainDiv.offsetHeight,
	x = x > max_x ? max_x : x;
	y = y > max_y ? max_y : y;
	var css = ls_mainDiv.style;
	css.left = (x < p.left ? p.left : x) + 'px';
	css.top  = (y < p.top ? p.top : y) + 'px';
	css.display = "block";
}
function ls_doHide()
{
	ls_mainDiv.style.display = "none";
}
function ls_hide()
{
	ls_begin_timer.Timer('ls_doHide()', ls_hidedelay, true);
}
ls_Init();