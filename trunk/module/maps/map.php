<?php
/*
include_once('include/map_data.php');

function get_phpRenderArea($map, $s)
{
    $width  = 1002;//$map['width'] * $s;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     var rect = getBounds(mapper.offsetParent);
    $height = 668;//$map['height']* $s;
    echo
    '<div id=mapper>
    <table class="map" border=1 width='.($width + 10).'px>
    <tbody><tr><td class=mapname id=mappername>'.$map['header'].'</td></tr>
    <tr><td width='.$width.'px height='.($height + 4).' align=left valign=top>
    <div id=mapperarea style="font-size: 10px; position: relative; left: 0; top: 0;" onmousemove=map_coords(this,event,"mappercoord") onmouseout=map_clean_coords("mappercoord")>
    <img src='.$map['image'].' width='.$width.' height='.$height.'>';
    if ($map['coord'])
        echo '<div id=mappercoord style="position: absolute; left: 10; bottom: 25;"></div>';
    $count = 0;
    if ($map['points'])
    foreach ($map['points'] as &$p)
    {
        $x = round($p['x'] * $width - $p['imgX']/2, 0);
        $y = round($p['y'] * $height- $p['imgY']/2, 0);
        $tip = '';
        if ($p['tooltip'])
            $tip = 'onmouseover = "Tip(\''.$p['tooltip'].'\')"';
        if ($p['href'])
            echo '<a href='.$p['href'].'>';
        echo '<img src="'.$p['image'].'" style="position: absolute; border: 0px; left: '.$x.'; top: '.$y.';" '.$tip.'>';
        if ($p['href'])
            echo '</a>';
    }
    echo
    '<div class=m_scale>'.
    getborderText('25%<br>50%<br>75%<br>100%<br>200%').
    '<div style="position: absolute; left:  0px; top:  0px; white-space: nowrap;">
    <a href=# onclick="return map_changeScale(0.25);">25%</a><br>
    <a href=# onclick="return map_changeScale(0.50);">50%</a><br>
    <a href=# onclick="return map_changeScale(0.75);">75%</a><br>
    <a href=# onclick="return map_changeScale(1.00);">100%</a><br>
    <a href=# onclick="return map_changeScale(2.00);">200%</a></div>
    </div>
    </div>
    </td></tr></tbody>
    </table></div>';
    echo '<script type="text/javascript">';
    echo 'var data='.php2js($map).';';
    echo 'map_setSet("?jsarea=19");';
    echo 'map_addDataToSet("?jsarea=19", data);';
    echo '</script>';
}


echo '<script type="text/javascript" src="js/map.js"></script>';

$map    = intval(@$_REQUEST['map']);
$area   = intval(@$_REQUEST['area']);
$npc_id = intval(@$_REQUEST['npc']);
$obj_id = intval(@$_REQUEST['obj']);
$width  = intval(@$_REQUEST['width']) ? intval(@$_REQUEST['width']) : 500;


$area_data = getRenderAreaData($area);

$list = createPointsList($npc_id, $obj_id);
$maps = getMapsListFromPoints($list);
$data = get_mapAreaData($areaId, $list);
foreach($maps as $m)
     echo $m['type'].$m['id'].' - '.$m['text']."<br />";
get_phpRenderArea($data, 1);
echo '<a onClick=map_changeSet("?jsarea=19")>link</a>&nbsp;';
echo '<a onClick=map_changeSet("?jsarea=34")>link</a>'; /**/
?>
<?php
include_once("include/map_data.php");

$map    = @$_REQUEST['map']=='' ? -1 : intval(@$_REQUEST['map']);
$area   = intval(@$_REQUEST['area']);
$npc_id = intval(@$_REQUEST['npc']);
if (!@$_REQUEST['object'])
	$obj_id = intval(@$_REQUEST['obj']);
else
	$obj_id = intval(@$_REQUEST['object']);
$width  = intval(@$_REQUEST['width']) ? intval(@$_REQUEST['width']) : 900;

$ajaxptr = "";
if ($width)  $ajaxptr.="&width=$width";
if ($npc_id) $ajaxptr.="&npc=$npc_id";
if ($obj_id) $ajaxptr.="&obj=$obj_id";

$pointsList = createPointsList($npc_id, $obj_id);

if (!$ajaxmode)
{
 if ($npc_id)
   echo getCreatureName($npc_id).'<br>';
 else if ($obj_id)
   echo getGameobjectName($obj_id).'<br>';

 if($pointsList)
 {
   // Build list
   $areaList= array();
   $mapsList= array();
   foreach ($pointsList as $point)
   {
      $a = getAreaImageIdFromPoint($point['map'], $point['position_x'], $point['position_y'], $point['position_z']);
      if ($a>0) @$areaList[$a]++;
      @$mapsList[$point['map']]++;
   }
   $area_keys = array_keys($areaList);
   $maps_keys = array_keys($mapsList);
   // Autoselect map or area if not set
   if ($area == 0) $area = @$area_keys[0];
   if ($map   < 0) $map  = @$maps_keys[0];

   // Out select show list
   if (count($areaList) + count($mapsList) > 1)
   {
      echo "<select onchange=\"areaSelect(this)\" style=\"WIDTH: ".($width+8)."\">";
      if (count($areaList))
      {
        echo '<optgroup label="Areas">';
        foreach($areaList as $id=>$count)
          echo "<option value='?area=$id$ajaxptr'>".getAreaNameFromId($id)." - (".$count.")</option>";
        echo '</optgroup>';
        echo "<option value='?map&gps$ajaxptr'>GPS</option>";
      }
      if (count($mapsList))
      {
        echo '<optgroup label="Maps">';
        foreach($mapsList as $id=>$count)
          echo "<option value='?map=$id$ajaxptr'>".getMapName($id)." - (".$count.")</option>";
        echo "</select>";
        echo '</optgroup>';
      }
   }
 }
 echo "<script type=\"text/javascript\" src=\"js/mapper.js\"></script>";
 echo "<div id=mapper>";
}

//==============================================================================
if (isset($_REQUEST['gps']))
{
    renderGPSMap("GPS", $width, $pointsList);
}
else if ($area>0)
{
    renderArea($area, $width, $pointsList);
    echo "<script type=\"text/javascript\">cacheMap('"."?area=".$area.$ajaxptr."')</script>";
}
else if ($map>=0)
{
    renderMap($map, $width, $pointsList);
    echo "<script type=\"text/javascript\">cacheMap('"."?map=".$map.$ajaxptr."')</script>";
}
else
   echo "No found on map";
//==============================================================================

if (!$ajaxmode)
   echo "</div>";
/**/
?>