
function cacheMap(url)
{
   var mapper = document.getElementById('mapper');
   ajaxCacheHtml(mapper,url);
}

function uploadData(url)
{
 var mapper = document.getElementById('mapper');
 if (!uploadHtml(url, mapper))
    outLoadingText('mapperarea');
}

function areaSelect(element)
{
   uploadData(element.value);
}

// Объявим функцию для определения координат мыши
function defPosition(event) {
    var x = y = 0;
    if (document.attachEvent != null) { // Internet Explorer & Opera
        x = window.event.clientX + document.documentElement.scrollLeft + document.body.scrollLeft;
        y = window.event.clientY + document.documentElement.scrollTop + document.body.scrollTop;
    }
    if (!document.attachEvent && document.addEventListener) { // Gecko
        x = event.clientX + window.scrollX;
        y = event.clientY + window.scrollY;
    }
    return {x:x, y:y};
}

function outText(out)
{
 return '<div style=\"position: absolute; left: -1px; top: -1px; white-space: nowrap; color: black;">' + out + '</div>' +
        '<div style=\"position: absolute; left: -1px; top:  0px; white-space: nowrap; color: black;">' + out + '</div>' +
        '<div style=\"position: absolute; left: -1px; top:  1px; white-space: nowrap; color: black;">' + out + '</div>' +
        '<div style=\"position: absolute; left:  0px; top: -1px; white-space: nowrap; color: black;">' + out + '</div>' +
        '<div style=\"position: absolute; left:  0px; top:  1px; white-space: nowrap; color: black;">' + out + '</div>' +
        '<div style=\"position: absolute; left:  1px; top: -1px; white-space: nowrap; color: black;">' + out + '</div>' +
        '<div style=\"position: absolute; left:  1px; top:  0px; white-space: nowrap; color: black;">' + out + '</div>' +
        '<div style=\"position: absolute; left:  1px; top:  1px; white-space: nowrap; color: black;">' + out + '</div>' +
        '<div style=\"position: absolute; left:  0px; top:  0px; white-space: nowrap; color: white;">' + out + '</div>';
}

function outLoadingText(div_id)
{
    var txt = document.getElementById(div_id);
    if (txt)
    {
        txt.innerHTML = txt.innerHTML + '<div style=\"position: absolute; left: ' +
                        (txt.offsetWidth/2 - 30) + 'px; top: 10px;">' +
                        outText('Loading...') + '</div>';
    }

}

function outMouseCoords(div, event, field)
{
    var mpos = defPosition(event || window.event);
    var vbound = getBounds(div);
    var x = 100 * (mpos.x - vbound.left) / vbound.width;
    var y = 100 * (mpos.y - vbound.top) / vbound.height;

    var txt = document.getElementById(field);
    if (txt)
      txt.innerHTML = outText("(" + x.toFixed(1) + ", " + y.toFixed(1) + ")");
}

function cleanMouseCoords(field)
{
    document.getElementById(field).innerHTML = "";
}

/*
 * New mapper functions
 */

var mapData=0;
var scale = 1;
var lastsel = 0;
var lastId  = 0;

function setMapData(newData)
{
  mapData = newData;
}

function setScale(newscale)
{
  scale = newscale;
}

function changeSelect(newsel)
{
  if (newsel == lastsel)
      return false;
  renderInstance(lastId, newsel);
  return false;
}

function changeScale(newscale)
{
  if (scale == newscale)
      return false;
  scale = newscale;
  renderInstance(lastId, lastsel);
  return false;
}
function setBestScale(width)
{
    var bestScale = 640 / width;
    if      (bestScale > 0.00 && bestScale < 0.40) scale = 0.25;
    else if (bestScale > 0.40 && bestScale < 0.62) scale = 0.50;
    else if (bestScale > 0.62 && bestScale < 0.87) scale = 0.75;
    else if (bestScale > 0.87 && bestScale < 1.5)  scale = 1.00;
    else scale = 2.00;
}
function renderInstance(elementid, selected)
{
    lastId  = elementid;
    lastsel = selected;

    var mapper = document.getElementById(elementid);
    if (mapper == 0)
        return;
    var text;
    var map = eval(mapData);

    map.width  = map.imageX*scale;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     var rect = getBounds(mapper.offsetParent);
    map.height = map.imageY*scale;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     var rect = getBounds(mapper.offsetParent);
    text =
    '<table class="map" border=1 width=' + (map.width + 10) + 'px>' +
    '<tbody><tr><td class=mapname id=mappername>' + map.header +'</td></tr>' +
    '<tr><td width=' + map.width + 'px height=' + (map.height + 4) + ' align=left valign=top>' +
    '<div id=mapperarea style="font-size: 10px; position: relative; left: 0; top: 0;">' +
    '<img src=' + map.image + ' width=' + map.width + ' height=' + map.height + '>\n';

    var count = 0;
    if (map.points)
        count = map.points.length;
    for (var i = 0; i < count; i++)
    {
        var img  = map.points[i].image;
        var imgX = map.points[i].icenterx;
        var imgY = map.points[i].icentery;
        if (map.points[i].id == selected)
        {
          img  = map.selImg;
          imgX = map.selImgX;
          imgY = map.selImgY;
        }
        else if (img == 0)
        {
          img  = map.defImg;
          imgX = map.defImgX;
          imgY = map.defImgY;
        }
        var x = map.points[i].x * map.width / 100 - imgX;
        var y = map.points[i].y * map.height / 100 - imgY;
        var tip = '';
        if (map.points[i].tooltip!=0)
            tip = 'onmouseover = "Tip(\'' + map.points[i].tooltip + '\')"';
        if (map.points[i].href!=0)
            text +='<a href=' + map.points[i].href + '>';
        text +='<img src="' + img + '" style="position: absolute; border: 0px; left: ' + x.toFixed(0) + '; top: ' + y.toFixed(0) + ';" ' + tip + '>\n';
        if (map.points[i].href)
            text +='</a>';
    }
    text+=
    '<div class=m_scale>' +
    outText('25%<br>50%<br>75%<br>100%<br>200%') +
    '<div style=\"position: absolute; left:  0px; top:  0px; white-space: nowrap;">' +
    '<a href=# onclick="return changeScale(0.25);">25%</a><br>' +
    '<a href=# onclick="return changeScale(0.50);">50%</a><br>' +
    '<a href=# onclick="return changeScale(0.75);">75%</a><br>' +
    '<a href=# onclick="return changeScale(1.00);">100%</a><br>' +
    '<a href=# onclick="return changeScale(2.00);">200%</a></div>' +
    '</div>' +
    '</div>' +
    '</td></tr></tbody>' +
    '</table>';
    mapper.innerHTML = text;
}
