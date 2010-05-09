<?php
include_once("conf.php");
include_once("include/player_data.php");
include_once("include/functions.php");

$type = @$_REQUEST['top'];

$output_mode = "TOP_MONEY";
if ($type == "money")  $output_mode = "TOP_MONEY";
if ($type == "honor")  $output_mode = "TOP_HONOR";
if ($type == "arena2") $output_mode = "TOP_ARENA";
if ($type == "arena3") $output_mode = "TOP_ARENA";
if ($type == "arena5") $output_mode = "TOP_ARENA";


if ($output_mode == "TOP_MONEY")
{
 $gm_accs = $rDB->selectCol("SELECT `id` FROM `account` WHERE `gmlevel`<>'0'");
 $rows = $cDB->select(
 "SELECT `guid`, `name` , `race` , `class`, `gender`, `level` , `money` FROM `characters`  WHERE `money`>'0' ORDER BY `money` DESC LIMIT ?d",$config['top_money_limit']);
 if ($rows)
 {
  echo "<TABLE class=report width=500>";
  echo "<TBODY>";
  echo "<TR><TD colspan=7 class=head>$lang[top_money_header]</TD></TR>";
  echo "<TR>";
  echo "<TH></TH>";
  echo "<TH width=1px></TH>";
  echo "<TH>$lang[player_level]</TH>";
  echo "<TH width=50%>$lang[player_name]</TH>";
  echo "<TH width=50%>$lang[player_money]</TH>";
  echo "<TH width=1px>$lang[player_race]</TH>";
  echo "<TH width=1px>$lang[player_class]</TH>";
  echo "</TR>\n";
  $count=1;
  foreach ($rows as $player)
  {
   $imgsize=24;
   $char_data = explode(' ',$player['data']);
   $char_info = str_pad(dechex($char_data[UNIT_FIELD_BYTES_0]), 8, 0, STR_PAD_LEFT);
   $gender    = $player['gender'];
   $class     = $player['class'];
   $race      = $player['race'];
   $level     = $player['level'];
   $money     = $player['money'];
//   if (sizeof($char_data)!=PLAYER_FIELD_PADDING+2)
//    continue;
   echo "<TR>";
   echo "<TD align = center>$count</TD>";
   echo "<TD><img width=$imgsize height=$imgsize src=\"".getFactionImage($race)."\"></TD>";
   echo "<TD align=center>$level</TD>";
   echo "<TD><A href=?player=$player[guid]>$player[name]</a></TD>";
   echo "<TD align=center>".money($money)."</TD>";
   echo "<TD align=center><img width=$imgsize height=$imgsize src=\"".getRaceImage($race,$gender)."\"></TD>";
   echo "<TD align=center><img width=$imgsize height=$imgsize src=\"".getClassImage($class)."\"></TD>";
   echo "</TR>\n";
   $count++;
  }
  echo "</TBODY></TABLE>";
 }
}
else if ($output_mode == "TOP_HONOR")
{
 $sort = @$_REQUEST['sort'];
 if ($sort == 'kills') $sort_str = 'totalKills';
 else                  $sort_str = 'totalHonorPoints';
 $gm_accs = $rDB->selectCol("SELECT `id` FROM `account` WHERE `gmlevel`<>'0'");
 $rows = $cDB->select("SELECT `guid`, `name` , `race` , `class`, `gender`, `level` , `totalHonorPoints`, `totalKills` FROM `characters`  WHERE `totalHonorPoints`>'0'  ORDER BY `$sort_str` DESC LIMIT ?d",$config['top_honor_limit']);
 if ($rows)
 {
  echo "<TABLE class=report width=500>";
  echo "<TBODY>";
  echo "<TR><TD colspan=8 class=head>$lang[top_honor_header]</TD></TR>";
  echo "<TR>";
  echo "<TH></TH>";
  echo "<TH width=1px></TH>";
  echo "<TH>$lang[player_level]</TH>";
  echo "<TH width=50%>$lang[player_name]</TH>";
  echo "<TH width=50%><a href=\"?top=honor\">$lang[player_honor]</a></TH>";
  echo "<TH><a href=\"?top=honor&sort=kills\">$lang[player_kills]</a></TH>";
  echo "<TH width=1px>$lang[player_race]</TH>";
  echo "<TH width=1px>$lang[player_class]</TH>";
  echo "</TR>\n";
  $count = 1;
  foreach ($rows as $player)
  {
   $imgsize=24;
   $char_data = explode(' ',$player['data']);
   $char_info = str_pad(dechex($char_data[UNIT_FIELD_BYTES_0]), 8, 0, STR_PAD_LEFT);
   $gender    = $player['gender'];
   $class     = $player['class'];
   $race      = $player['race'];
   $level     = $player['level'];
   $honor     = $player['totalHonorPoints'];
   $kills     = $player['totalKills'];
//   if (sizeof($char_data)!=PLAYER_FIELD_PADDING+2)
//    continue;
   echo "<TR>";
   echo "<TD align = center>$count</TD>";
   echo "<TD><img width=$imgsize height=$imgsize src=\"".getFactionImage($race)."\"></TD>";
   echo "<TD align=center>$level</TD>";
   echo "<TD><A href=?player=$player[guid]>$player[name]</a></TD>";
   echo "<TD>".$honor."</TD>";
   echo "<TD>".$kills."</TD>";
   echo "<TD align=center><img width=$imgsize height=$imgsize src=\"".getRaceImage($race,$gender)."\"></TD>";
   echo "<TD align=center><img width=$imgsize height=$imgsize src=\"".getClassImage($class)."\"></TD>";
   echo "</TR>\n";
   $count++;
  }
  echo "</TBODY></TABLE>";
 }
}
else if ($output_mode == "TOP_ARENA")
{
   $arena_type = 0;
   if ($type == "arena2") $arena_type = 2;
   if ($type == "arena3") $arena_type = 3;
   if ($type == "arena5") $arena_type = 5;

   $rows = $cDB->select("SELECT
                         `arena_team`.`arenateamid`,
                         `arena_team`.`name`,
                         `arena_team`.`type`,
                         `arena_team`.`BackgroundColor`,
                         `arena_team`.`EmblemStyle`,
                         `arena_team`.`EmblemColor`,
                         `arena_team`.`BorderStyle`,
                         `arena_team`.`BorderColor`,
                         `arena_team_stats`.`rating`
                        FROM
                         `arena_team`,
                         `arena_team_stats`
                        WHERE
                         `arena_team`.`type`=?d AND
                         `arena_team`.`arenateamid`=`arena_team_stats`.`arenateamid`
                        ORDER BY `arena_team_stats`.`rating` DESC
                        LIMIT ?d", $arena_type, $config['top_arena_limit']);
   echo "<table class=report width=500><tbody>";
   echo "<tr><td colspan=4 class=head>".sprintf($lang['top_arena_header'], $arena_type)."</tr>";
   echo "<tr><th width=1></th><th>$lang[arena_team_name]</th><th>$lang[arena_rating]</th><th>$lang[arena_team]</th></tr>";
   if ($rows)
   foreach ($rows as $arena_team_info)
   {
       $type   = $arena_team_info['type'];
       $back   = ($arena_team_info['BackgroundColor']+0)&0xFFFFFF;
       $emblem = $arena_team_info['EmblemStyle'];
       $ecolor = ($arena_team_info['EmblemColor']+0)&0xFFFFFF;
       $border = $arena_team_info['BorderStyle'];
       $bcolor = ($arena_team_info['BorderColor']+0)&0xFFFFFF;
       $emblem_image = "images/player_info/arena_small_ico.php?type=$type&back=$back&emblem=$emblem&ecolor=$ecolor&border=$border&bcolor=$bcolor";

   	   echo "<tr>";
       echo "<td><img src=$emblem_image width=64></td>";
       echo "<td align = center><a href=\"?arenateam=".$arena_team_info['arenateamid']."\">".$arena_team_info['name']."</a></td>";
	   echo "<td align = center>".$arena_team_info['rating']."</td>";
	   echo "<td align = center>";
	   $team = $cDB->select("SELECT * FROM `arena_team_member` WHERE `arenateamid`=?d", $arena_team_info['arenateamid']);
	   foreach ($team as $team_member)
	       echo "<a href=?player=$team_member[guid]>".getCharacterName($team_member['guid'])."</a><br>";
	   echo "</td>";
       echo "</tr>\n";
	}
    else
       echo "<tr><td colspan=4 align=center>Empty</td></tr>";
	echo "</tbody></table>";
}
?>
