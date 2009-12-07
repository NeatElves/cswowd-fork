function getElementsByClass(searchClass,node,tag)
{
    var classElements = new Array();
    if ( node == null )
        node = document;
    if ( tag == null )
        tag = '*';
    var els = node.getElementsByTagName(tag);
    var pattern = new RegExp("(^|\\s)" + searchClass + "(\\s|$)");
    for (i = 0, j = 0; i < els.length; i++)
        if ( pattern.test(els[i].className) )
            classElements[classElements.length] = els[i];
    return classElements;
}
function getBounds(element)
{
    var left = element.offsetLeft;
    var top = element.offsetTop;
    for (var parent = element.offsetParent; parent; parent = parent.offsetParent)
    {
        left += parent.offsetLeft;
        top += parent.offsetTop;
    }
    return {left: left, top: top, width: element.offsetWidth, height: element.offsetHeight};
}
function insertElement(parent, tag, id)
{
    if(parent.insertAdjacentHTML)
    {
        parent.insertAdjacentHTML("afterBegin", '<'+tag+ ' id="'+id+'"></'+tag+'>');
        return document.getElementById(id);
    }
    else if(document.createElement && parent.appendChild)
    {
        var el = document.createElement("div");
        el.id = id;
        parent.appendChild(el);
        return el;
    }
    return 0;
}
function addEvent(el, sEvt, PFnc)
{
    if(el)
    {
		if(el.addEventListener)
			el.addEventListener(sEvt, PFnc, false);
		else
			el.attachEvent("on" + sEvt, PFnc);
	}
}
function addLoadEvent(func)
{
    var oldonload = window.onload;
    if (typeof window.onload != 'function')
        window.onload = func;
    else
        window.onload = function(){oldonload();func();}
}
function removeEvent(el, sEvt, PFnc)
{
	if(el)
	{
		if(el.removeEventListener)
			el.removeEventListener(sEvt, PFnc, false);
		else
			el.detachEvent("on" + sEvt, PFnc);
	}
}
function ChangeCssProperty(myclass, element, value)
{
    var CSSRules = document.styleSheets[0].rules || document.styleSheets[0].cssRules;
    for (var i = 0; i < CSSRules.length; i++)
        if (CSSRules[i].selectorText.toLowerCase() == myclass.toLowerCase())
            CSSRules[i].style[element] = value;
}

function report_setSelect(tab, selected)
{
      var l = tab.id.split(':');
      var element = document.getElementById(l[1]);
      if (!element) return;
      if (selected)
      {
          element.style.display = "block";
          tab.className = 'selected';
      }
      else
      {
          element.style.display = "none";
          tab.className = '';
      }
}

function report_selectTab(page)
{
    var tab = document.getElementById('report_tabs');
    if (!tab) return;

    var els = tab.getElementsByTagName('li');
    for (i = 0; i < els.length; i++)
        report_setSelect(els[i], els[i].id == page.id)
}
function report_hideHeaders()
{
    ChangeCssProperty('TABLE.report TR.head', 'display', 'none');
}
function report_addTab(name, elementId, selected)
{
    var tab     = document.getElementById('report_tabs');
    if (!tab) return;
    tab.innerHTML = tab.innerHTML + '<li id="t:' + elementId + '" onClick="report_selectTab(this);"><a>' + name + '</a></li>';
    report_setSelect(document.getElementById('t:' + elementId), selected);
}