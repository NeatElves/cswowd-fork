<?php
include_once("include/map_data.php");

$text='';
$ajaxptr = '';

$map    = @$_REQUEST['map']=='' ? -1 : intval(@$_REQUEST['map']);
$area   = intval(@$_REQUEST['area']);
$width  = intval(@$_REQUEST['width']) ? intval(@$_REQUEST['width']) : 900;

if ($area) {$a=getRenderAreaData($area); $map = $a[0];}

//*****************************************************************************
// Create points list
//*****************************************************************************
$pointsList = new mapPoints();
if ($npc_id = intval(@$_REQUEST['npc']))
{
  $ajaxptr.="&npc=$npc_id";
  $pointsList->addNpc($npc_id, $map);
  $text = '<center>'.getCreatureName($npc_id).'</center>';
}
if ($obj_id = intval(@$_REQUEST['obj']))
{
  $ajaxptr.="&obj=$obj_id";
  $pointsList->addGo($obj_id, $map);
  $text = '<center>'.getGameobjectName($obj_id).'</center>';
}
if ($point = @$_REQUEST['point'])
{
  $ajaxptr.='&point='.$point;
  $p = explode(':', $point);
  $pointsList->addPoint(@$p[0], @$p[1], @$p[2], @$p[3]);
  $text = '<br>';//'<center>Point: map='.@$p[0].' x='.@$p[1].' y='.@$p[2].' z='.@$p[3].'</center>';
}
if ($waypoint = @$_REQUEST['waypoint'])
{
  $ajaxptr.='&waypoint='.$waypoint;
  $pointsList->addWaypoint($waypoint, $dDB->selectCell('SELECT `map` FROM `creature` WHERE `guid` = ?d', $waypoint));
}

if ($width) $ajaxptr.="&width=$width";

$ajaxmode = !(!$ajaxmode || (@$_REQUEST['map']=='' && $area==0 && !isset($_REQUEST['gps'])));

if (!$ajaxmode)
{
 echo "<script type=\"text/javascript\" src=\"js/mapper.js\"></script>";
 echo $text;

 if($pointsList->getCount())
 {
   // Create maps and area list
   $list = $pointsList->getMapsList();

   if (count(@$list['area']) + count(@$list['map']) > 1)
   {
    echo "<select onchange=\"areaSelect(this)\" style=\"WIDTH: ".($width+8)."px\">";
    if (isset($list['area']))
    {
        echo '<optgroup label="'.$lang['map_areas'].'">';
        foreach($list['area'] as $a)
          echo "<option value='?area=".$a['id'].$ajaxptr."'>".$a['text']."</option>";
        echo '</optgroup>';
    }
    if (isset($list['gps']))
    {
        foreach($list['gps'] as $g)
          echo "<option value='?map=".$map.$ajaxptr."&gps'>".$lang['map_gps'].' - '.$g['text']."</option>";
    }
    if (isset($list['map']))
    {
        echo '<optgroup label="'.$lang['map_maps'].'">';
        foreach($list['map'] as $m)
          echo "<option value='?map=".$m['id'].$ajaxptr."'>".$m['text']."</option>";
        echo '</optgroup>';
    }
    echo "</select>";
   }
   $area = $area==0 ? @$list['area'][0]['id'] : $area;
   $map  = $map==-1 ? @$list['map'][0]['id'] : $map;
 }
 echo "<script type=\"text/javascript\" src=\"js/mapper.js\"></script>";
 echo "<div id=mapper>";
}

//==============================================================================
if (isset($_REQUEST['gps']))
{
    renderGPSMap("GPS", $width, $pointsList->points);
//    echo "<script type=\"text/javascript\">cacheMap('?map=".$map.$ajaxptr."gps')</script>";
}
else if ($area>0)
{
    renderArea($area, $width, $pointsList->points);
//    echo "<script type=\"text/javascript\">cacheMap('?area=".$area.$ajaxptr."')</script>";
}
else if ($map>=0)
{
    renderMap($map, $width, $pointsList->points);
//    echo "<script type=\"text/javascript\">cacheMap('?map=".$map.$ajaxptr."')</script>";
}
else
   echo $lang['map_no_found'];
//==============================================================================

if (!$ajaxmode)
   echo "</div>";
?>