/*
 * Drop down menu script
 */
var dd_hide_delay = 500;        // Hide menu delay
var dd_show_delay = 200;        // Show menu delay
var dd_options = new Array();   // Menu settings

var dd_timer = new Number(0);

function dd_getSubMenu(depth)
{
	var id = 'dd_sub_menu_' + depth;
	var s = $(id);
	if (s == null)
	{
		s = insertElement(getBody(), 'DIV', id);
		s.className = 'skin_pop_sub';
		s.style.zIndex = 100 + depth;
		s.style.visibility = "hidden";
		s.style.position = 'absolute';
	}
	return s;
}
function dd_showSub(id, x, y)
{
	var l = id.split('_');
	var ls = eval(l[0]);
	for (var i=1;i<l.length;i++)
		ls = ls[l[i]].sub;
	i-=2;
	dd_hideSub(i);
	if (ls)
		dd_drawSubMenu(ls, id, dd_getSubMenu(i), x, y);
}
function dd_hideSub(j)
{
	while(s = $('dd_sub_menu_' + j)){
		s.style.visibility = "hidden"; j++;
	}
}
function getSubMenuText(sub, pid)
{
	var l = pid.split('_'), o = dd_options[l[0]], text = '';
	for (var i in sub)
	{
		var r = sub[i];
		text += ''
		+ '<div class="' + o.row + '" id=' + pid + '_' + i + ' style="position: relative;" onmouseover="dd_Select(this);" onmouseout="dd_Unselect(this);">'
		+ (r.link ? '<a href="' + r.link + '" ' + (r.target ? 'target="' + r.target + '"' : '') + '>' + r.text + '</a>' : r.text)
		+ (r.sub ? '<div class="'+ o.arrow + '" style="position: absolute;">' + o.arrowtext + '</div>' : '')
		+ '</div>';
	}
	return text;
}

function dd_drawSubMenu(sub, name, s, x, y)
{
	s.innerHTML = getSubMenuText(sub, name);
	var p= getPageRect(),
	right = p.left + p.width - (s.offsetWidth  || s.style.pixelWidth),
	bottom = p.height + p.top - (s.offsetHeight || s.style.pixelHeight);
	if (x >= right) x = right;
	if (y >= bottom) y = bottom;
	var css = s.style;
	css.left = (x < p.left ? p.left : x) + 'px';
	css.top  = (y < p.top ? p.top : y) + 'px';
	css.visibility = "visible";
}
function dd_markRow(row, cname)
{
	var id = row.id;
	while (s = $(id))
	{
		s.className = cname;
		var p = id.lastIndexOf('_');
		id = id.substring(0, p);
	}
}
function dd_Select(row)
{
	var l = row.id.split('_');
	var o = dd_options[l[0]];
	dd_markRow(row, o.selrow);
	var b = getBounds(row);
	var d = l.length-1;
	var p = o['mpos'+d] ? o['mpos'+d] : o.defpos;
	switch (p.m)
	{
		case 'tr': x=b.left+b.width+p.x; y=b.top+p.y;break;
		case 'bl': x=b.left+p.x; y=b.top+b.height+p.y;break;
	}
	dd_timer.Timer('dd_showSub("'+row.id+'",'+x+','+y+')', dd_show_delay, true);
}
function dd_Unselect(row)
{
	var l = row.id.split('_');
	var o = dd_options[l[0]];
	dd_markRow(row, o.row);
	dd_timer.Timer('dd_hideSub('+o.min+')', dd_hide_delay, true);
}