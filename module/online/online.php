<?php
include_once("conf.php");
include_once("include/player_data.php");
include_once("include/functions.php");
include_once("include/map_data.php");
include_once("include/info_table_generator.php");

function onlineMapRenderCallback($data, $x, $y)
{
   $imgX   = 16;
   $imgY   = 16;
   $x = round($x-$imgX/2, 0);
   $y = round($y-$imgY/2, 0);

   $char_data = explode(' ',$data['data']);
   $powerType =($char_data[UNIT_FIELD_BYTES_0]>>24)&255;
   $gender    =($char_data[UNIT_FIELD_BYTES_0]>>16)&255;
   $class     =($char_data[UNIT_FIELD_BYTES_0]>> 8)&255;
   $race      =($char_data[UNIT_FIELD_BYTES_0]>> 0)&255;
   $level     = $char_data[UNIT_FIELD_LEVEL];
   $faction   = getPlayerFaction($race);
   $map_name  = getMapName($data['map']);
   $area_name = getAreaNameFromPoint($data['map'], $data['position_x'], $data['position_y'], $data['position_z']);

   $img  = $faction==0 ? "gps_icon1.png" : "gps_icon.png";

   $text ="<table class=online_map>";
   $text.="<tr><td class=".($faction==0?"aname":"hname").">".$data['name']."</td></<tr>";
   if ($area_name)
       $text.="<tr><td align=center>$area_name<br>";
   $text.="<tr><td align=center>";
   $text.="<img width=20 src=".getRaceImage($race,$gender)."> <img width=20 src=".getClassImage($class)."><br>";
   $text.=getRace($race)."<br>";
   $text.=getClass($class)."<br>";
   $text.="Level - $level<br>";
   $text.="</td></tr>";
   $text.="</table>";
   return '<img src="images/map_points/'.$img.'" class=point style="left: '.$x.'; top: '.$y.';" '.addTooltip($text).'>'."\n";
}

$online = @$_REQUEST['online'];

if ($online == "gps")
{
  $rows = $cDB->selectPage($number, "SELECT * FROM `characters` WHERE `online` <> '0' AND NOT `extra_flags`&".PLAYER_EXTRA_GM_INVISIBLE);
  renderGPSMap("$number $lang[online_players]",700, $rows, 'onlineMapRenderCallback');
}
else
{
 $page = intval(@$_REQUEST['page']);
 $sort = @$_REQUEST['sort'];

 $FindRefrence = "?online";

 $sort_str = "";
 if      ($sort == "name")  $sort_str = " order by `name`";
 else if ($sort == "level") $sort_str = " order by SUBSTRING_INDEX( SUBSTRING_INDEX( `data` , ' ' , ".(UNIT_FIELD_LEVEL+1).") , ' ' , -1 ) + 0 DESC";
 else if ($sort == "class") $sort_str = " order by `class`, `race`";
 else if ($sort == "race")  $sort_str = " order by `race`, `class`";
 else                       $sort_str = " order by `name`";

 $page_seek = getLPageOffset($page, $config['online_limit']);
 $rows = $cDB->selectPage($totalRecords,
 "SELECT *
  FROM `characters`
  WHERE `online` <> '0' AND NOT `extra_flags`&".PLAYER_EXTRA_GM_INVISIBLE."
  $sort_str
  LIMIT ?d,?d", $page_seek, $config['online_limit']);

 echo "<TABLE class=report width=500>";
 echo "<TBODY>";
 echo "<tr><td colspan=6 class=head>$totalRecords $lang[online_players]</td></tr>";
 if($rows)
 {
  $SortRefrence = $FindRefrence;
  if ($page>1) $SortRefrence.="&page=$page";
  echo "<tr>";
  echo "<th><a href=\"$SortRefrence&sort=level\">$lang[player_level]</a></th>";
  echo "<th width=1%></TH>";
  echo "<th width=100%><a href=\"$SortRefrence\">$lang[player_name]</a></th>";
  echo "<th><a href=\"$SortRefrence&sort=race\">$lang[player_race]</a></th>";
  echo "<th><a href=\"$SortRefrence&sort=class\">$lang[player_class]</a></th>";
  echo "<th>$lang[player_zone]</TH>";
  echo "</tr>\n";
  foreach ($rows as $player)
  {
   $imgsize=32;
   $char_data = explode(' ',$player['data']);
   $powerType =($char_data[UNIT_FIELD_BYTES_0]>>24)&255;
   $gender    =($char_data[UNIT_FIELD_BYTES_0]>>16)&255;
   $class     =($char_data[UNIT_FIELD_BYTES_0]>> 8)&255;
   $race      =($char_data[UNIT_FIELD_BYTES_0]>> 0)&255;
   $level     = $char_data[UNIT_FIELD_LEVEL];

   $map_name = getMapNameFromPoint($player['map'], $player['position_x'], $player['position_y'], $player['position_z']);
   $area_name = getAreaNameFromPoint($player['map'], $player['position_x'], $player['position_y'], $player['position_z']);
   $extra_name = "";
   if ($area_name)
   {
     $extra_name = "<br><font size=-2>".$map_name."</font>";
     $map_name = "&bdquo;".str_replace(' ','&nbsp;', $area_name)."&ldquo;";
   }
   else
     $map_name = "&bdquo;".str_replace(' ','&nbsp;',$map_name)."&ldquo;";

   if ($config['show_map_ptr'])
      $map_name = "<a href=\"?map&point=$player[map]:$player[position_x]:$player[position_y]:$player[position_z]\">".$map_name."</a>";
   $map_name.= $extra_name;

   echo "<TR>";
   echo "<TD align=center>$level</TD>";
   echo "<TD class=pfaction><img width=$imgsize src=\"".getFactionImage($race)."\"></TD>";
   echo "<TD class=player><A href=?player=$player[guid]>$player[name]</a></TD>";
   echo "<TD class=prace><img width=$imgsize src=\"".getRaceImage($race,$gender)."\"></TD>";
   echo "<TD class=pclass><img width=$imgsize src=\"".getClassImage($class)."\"></TD>";
   echo "<TD class=zone>$map_name</TD>";
   echo "</TR>\n";
  }
  $pageRefrence = $FindRefrence;
  if ($sort) $pageRefrence.="&sort=$sort";
  generateLPage($totalRecords, $page, "<a href=\"$pageRefrence&page=%d\">%d </a>", $config['online_limit'], 6);
 }
 else
  echo "<tr><td colSpan=6 align=center>".$lang['online_no_players']."</td></tr>";
 echo "</TBODY></TABLE>";
}

?>
