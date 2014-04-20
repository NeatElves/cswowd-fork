<?php
if (@$config == NULL) die ("");

include_once("include/player_data.php");
include_once("include/functions.php");
include_once("include/map_data.php");
include_once("include/info_table_generator.php");

if (isset($_SESSION['account_id']))
{
 echo '
 <table class="report" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
 <tr>
 <td class="alt2" valign="top" nowrap="nowrap">
 <div class="smallfont"><a href="#"><strong>Добро пожаловать, '.$_SESSION['username'].'</strong><br></a>
 <a href="?user">Мой кабинет</a> | <a href="?user=logout">Выход</a>
 </div>
 </td>
 </tr>
 </table>';
 $id = $_SESSION['account_id'];
 $rows = $cDB->select("SELECT * FROM `characters` WHERE `account` = ?d", $id);

 echo "<table class=report width=500>";
 echo "<tbody>";
 if($rows)
 {
  echo "<tr>";
  echo "<th>$lang[player_level]</th>";
  echo "<th width=1%></th>";
  echo "<th width=100%>$lang[player_name]</th>";
  echo "<th>$lang[player_race]</th>";
  echo "<th>$lang[player_class]</th>";
  echo "<th>$lang[player_zone]</th>";
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

   $map_name = "<a href=\"map/map.php?x=$player[position_x]&y=$player[position_y]&map=$player[map]\">".$map_name."</a>".$extra_name;
   echo "<tr>";
   echo "<td align=center>$level</td>";
   echo "<td class=pfaction><img width=$imgsize src=\"".getFactionImage($race)."\"></td>";
   echo "<td class=player><A href=?player=$player[guid]>$player[name]</a></td>";
   echo "<td class=prace><img width=$imgsize src=\"".getRaceImage($race,$gender)."\"></td>";
   echo "<td class=pclass><img width=$imgsize src=\"".getClassImage($class)."\"></td>";
   echo "<td class=zone>$map_name</td>";
   echo "</tr>\n";
  }
 }
 else
  echo "<tr><td colSpan=6 align=center>".$lang['user_no_char_present']."</td></tr>";
 echo "</tbody></table>";
}
?>
