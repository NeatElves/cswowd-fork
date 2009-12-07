var a_lastShow = 0;

function changeFaction(href)
{
  uploadFromHref(href, 'a_data');
  return false;
}

function cacheCat(url)
{
    ajaxCacheHtmlId('a_data', url);
}

function selectCat(id)
{
    var node = document.getElementById('a_category');
    if (!node)
        return;
    a_lastShow = 0;
    var selected = 0;
    var els = node.getElementsByTagName('a');
    for (i = 0; i < els.length; i++)
    {
        var parent = els[i].parentNode;
        if (els[i].id == 'ach_' + id)
        {
            parent.className = 'a_bodycat_sel';
            if (els[i].className=='sub')
                els[i].className = 'sel';
            selected = parent;
            uploadFromHref(els[i], 'a_data');
        }
        else
        {
            if (selected!=parent)
                parent.className = 'a_bodycat';
            if (els[i].className=='sel')
                els[i].className = 'sub';
        }
    }
    return false;
}

function changeSelection(element, sel)
{
  var name = element.className;
  if (sel)
  {
      element.className = (name=='ach_show' || name=='ach_show select') ? 'ach_show select' : 'ach_show select locked';
      element.id = 'selected';
  }
  else
  {
      element.className = (name=='ach_show' || name=='ach_show select') ? 'ach_show' : 'ach_show locked';
      element.id = 'not_select';
  }
}

function showAchReq(element)
{
    if (a_lastShow && a_lastShow != element)
        changeSelection(a_lastShow, false);
    a_lastShow = element;
    changeSelection(element, element.id != 'selected');
}