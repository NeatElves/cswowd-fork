<?php
include_once("conf.php");
include_once("include/player_data.php");
include_once("include/functions.php");
include_once("include/map_data.php");
include_once("include/report_generator.php");

function onlineMapRenderCallback($data, $x, $y)
{
   $imgX   = 16;
   $imgY   = 16;
   $x = round($x-$imgX/2, 0);
   $y = round($y-$imgY/2, 0);

   $gender    = $data['gender'];
   $class     = $data['class'];
   $race      = $data['race'];
   $level     = $data['level'];
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

function onoff_realm()
{
	global $config;
	$s = @fsockopen($config['host'], $config['port'], $errno, $errstr, (float)0.5);
	if($s){@fclose($s);return true;} else return false;
}

$online = @$_REQUEST['online'];
$width  = isset($_REQUEST['width']) ? $_REQUEST['width'] : 700;

if ($online == "gps")
{
  $rows = $cDB->selectPage($number, "SELECT * FROM `characters` WHERE `online` <> '0' AND NOT `extra_flags`&".PLAYER_EXTRA_GM_INVISIBLE);
  renderGPSMap("$number $lang[online_players]", $width, $rows, 'onlineMapRenderCallback');
}
else
{
 $baseLink = '?online';
 $show_fields= array('PL_REPORT_LEVEL', 'PL_REPORT_FACTION', 'PL_REPORT_NAME', 'PL_REPORT_RACE', 'PL_REPORT_CLASS', 'PL_REPORT_POS');

  $list =& new PlayerReportGenerator();
  $list->disableMark();
  $list->Init($show_fields, $baseLink, 'onlineLIST', $config['online_limit'], 'name');
  $list->online();
  $number = $list->getTotalDataCount();

 $ap_dateSql = $cDB->selectCell("-- CACHE: 1h
  SELECT `NextArenaPointDistributionTime` FROM `saved_variables`"); 
 $daily_quest_dateSql = $cDB->selectCell("-- CACHE: 1h
  SELECT `NextDailyQuestResetTime` FROM `saved_variables`"); 
 $weekly_quest_dateSql = $cDB->selectCell("-- CACHE: 1h
  SELECT `NextWeeklyQuestResetTime` FROM `saved_variables`"); 
 $monthly_quest_dateSql = $cDB->selectCell("-- CACHE: 1h
  SELECT `NextMonthlyQuestResetTime` FROM `saved_variables`"); 

 $ap_date = date("H:i:s d.m.Y", $ap_dateSql);  
 $daily_quest_date = date("H:i:s d.m.Y", $daily_quest_dateSql); 
 $weekly_quest_date = date("H:i:s d.m.Y", $weekly_quest_dateSql);  
 $monthly_quest_date = date("H:i:s d.m.Y", $monthly_quest_dateSql);  

 echo "<table class=report width=100%>";
 echo "<tr><td colspan=2 class=head>".$lang['stat_timers']."</td></tr>";
 echo "<tr><td>".$lang['ap_date']."</td><td>".$ap_date."</td></tr>";
 echo "<tr><td>".$lang['daily_quest_date']."</td><td>".$daily_quest_date."</td></tr>";
 echo "<tr><td>".$lang['weekly_quest_date']."</td><td>".$weekly_quest_date."</td></tr>"; 
 echo "<tr><td>".$lang['monthly_quest_date']."</td><td>".$monthly_quest_date."</td></tr>"; 
 if ($ae = getGameEventActive())
{
 echo "<tr><td colspan=2 class=head>".$lang['active_event']."</td></tr>"; 
   foreach ($ae as $ae1)
   {
   if (getGameEventActiveName($ae1['event']))
     echo "<tr><td colspan=2>".getGameEventName($ae1['event'])."</td></tr>"; 
   }
 }
 echo "</table>";
if (onoff_realm())
{
  if ($number <= 0)
    echo $lang['online_no_players'];
  else
    $list->createReport($number.' '.$lang['online_players']);
}
else 
  echo $lang['offline'];
}
?>