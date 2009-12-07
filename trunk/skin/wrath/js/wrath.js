/*
 * Left menu create and options
 */
dd_options['leftmenu'] = {
 min:'1',
 arrow:'skin_pop_arrow',
 arrowtext:'',
 row:'skin_pop_row',
 selrow:'skin_pop_mrow',
 defpos:{m:'tr', x:-15, y:0}
};

dd_options['langmenu'] = {
 min:'0',
 arrow:'skin_pop_arrow',
 arrowtext:'',
 row:'skin_pop_row',
 selrow:'skin_pop_mrow',
 defpos:{m:'tr', x:0, y:0},
 mpos1:{m:'bl', x:0, y:0}
};

var langmenu = [{
    sub:[
     {link:'?lang=ru',text:'Русский'},
     {link:'?lang=en',text:'English'}
    ]
}];

dd_options['skinmenu'] = {min:'0',arrow:'skin_pop_arrow',arrowtext:'',row:'skin_pop_row',selrow:'skin_pop_mrow',defpos:{m:'tr', x:0, y:0},mpos1:{m:'bl', x:0, y:0}};
var skinmenu = [{
    sub:[
     {link:'?skin=default',text:'Default'},
     {link:'?skin=modern',text:'Modern'},
     {link:'?skin=lofk_skin',text:'Lofk'},
     {link:'?skin=dark',text:'Dark'}
    ]
}];
//=========================
function generateLeftMenu()
{
    prepareCookies();
    var menu = leftmenu;
    var l = menu.length;
    for (var i = 0; i < l; i++)
        document.write(generateLeftSub(menu[i], i));
}
function generateLeftSub(menu, id)
{
   var show = menuCookie[id] == 0 ? false : true;
   var text = ''
   + '<div class=' + (show ? 'skin_lm_sub_on':'skin_lm_sub_off') + ' onClick = "toggleMenu(this, ' + id + ')">'
   +  '<div class="skin_lm_ico" style="background: url(skin/wrath/img/menu/' + menu.ico  + '-on.gif) no-repeat;"></div>'
   +  '<div class="skin_lm_name">'
   +   '<div style="position: absolute; left:-1; top: -1; color: black;">' + menu.name + '</div>'
   +   '<div style="position: absolute; left:-1; top:  1; color: black;">' + menu.name + '</div>'
   +   '<div style="position: absolute; left: 1; top: -1; color: black;">' + menu.name + '</div>'
   +   '<div style="position: absolute; left: 1; top:  1; color: black;">' + menu.name + '</div>'
   +   '<div style="position: absolute; left: 0; top:  0;">' + menu.name + '</div>'
   +  '</div>'
   +  '<div class="skin_lm_add"></div>'
   + '</div>\n'
   + '<div class=skin_lm_sub_top id=left_sub_'+ id + (show ? '' : ' style="display: none;"') + '>'
   +  '<div class=skin_lm_sub_body>'
   +   '<div class=skin_lm_sub_left>'
   +    '<div class=skin_lm_sub_right>'
   +     getSubMenuText(menu.sub, 'leftmenu_' + id)
   +    '</div>'
   +   '</div>'
   +  '</div>'
   +     '<div class=skin_lm_sub_bottom></div>'
   + '</div>\n';
   return text;
}

function changeSearch(element)
{
   var a = {'site':'all', 'item':'i', 'itemset':'set', 'quest':'q', 'spell':'s', 'npc':'n', 'object':'g', 'faction':'f', 'player':'p', 'area':'a'}
   var s  = document.getElementById('topsearch');
   var s1 = document.getElementById('_topsearch');
   var v  = a[element.value];
   s.alt = v;
   s1.value = v;
}
function searchClick(link)
{
   var s  = document.getElementById('topsearch');
   var s1 = document.getElementById('_topsearch');
   link.href = "?s=" + s1.value + "&name=" + s.value;
}

function toggleMenu(menu, id)
{
  v = document.getElementById('left_sub_' + id);
  if (v.style.display == "none")
  {
   menu.className = 'skin_lm_sub_on';
   v.style.display = "block";
   menuCookie[id] = 1;
  }
  else
  {
   menu.className = 'skin_lm_sub_off';
   v.style.display = "none";
   menuCookie[id] = 0;
  }
  setcookie('menuCookie', menuCookie.join(' '));
  // disable select
  if (typeof menu.onselectstart!="undefined") //IE route
	menu.onselectstart=function(){return false}
  else if (typeof menu.style.MozUserSelect!="undefined") //Firefox route
	menu.style.MozUserSelect="none"
  else //All other route (ie: Opera)
	menu.onmousedown=function(){return false}
}

// Cookies
var menuCookie;
function getexpirydate(nodays){
	var UTCstring;
	Today = new Date();
	nomilli=Date.parse(Today);
	Today.setTime(nomilli+nodays*24*60*60*1000);
	UTCstring = Today.toUTCString();
	return UTCstring;
}
function getcookie(cookiename) {
	 var cookiestring=""+document.cookie;
	 var index1=cookiestring.indexOf(cookiename);
	 if (index1==-1 || cookiename=="") return "";
	 var index2=cookiestring.indexOf(';',index1);
	 if (index2==-1) index2=cookiestring.length;
	 return unescape(cookiestring.substring(index1+cookiename.length+1,index2));
}
function setcookie(name,value){
	cookiestring=name+"="+escape(value)+";EXPIRES="+ getexpirydate(365)+";PATH=/";
	document.cookie=cookiestring;
}
function prepareCookies()
{
    var tempString = getcookie("menuCookie");
    if(!tempString)
    {
        tempString = '';
        var l = leftmenu.length;
        for (var i = 0; i < l; i++)
            tempString+=(leftmenu[i].show ? 1 : 0) + ' ';
        setcookie('menuCookie', tempString);
    }
    menuCookie = tempString.split(" ");
}