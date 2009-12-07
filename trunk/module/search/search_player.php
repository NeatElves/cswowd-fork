<?php
include_once("conf.php");
include_once("include/player_data.php");
include_once("include/functions.php");
##########
/*
 * Скрипт для поиска игроков по имени
 */

$page = intval(@$_REQUEST['page']);

// Создаём SQL запрос исходя из заданых пользователем параметров
$filter = "";
// Создаём ссылку на страницу, игнорируем дефолтные значения
$FindRefrence = "?s=p";

// Name filter
if ($name = mysql_real_escape_string(@$_REQUEST['name']))
{
  $filter.= " AND `name` like '%$name%'";
  $FindRefrence.="&name=$name";
}

// Убираем ненужный AND в начале строки
$filter = substr($filter, 5);

// Sort method
$sort = @$_REQUEST['sort'];
$sort_str = "";
if      ($sort == "name")  $sort_str = " order by `name`";
else if ($sort == "level") $sort_str = " order by SUBSTRING_INDEX( SUBSTRING_INDEX( `data` , ' ' , ".(UNIT_FIELD_LEVEL+1).") , ' ' , -1 ) + 0 DESC";
else if ($sort == "class") $sort_str = " order by `class`";
else if ($sort == "race")  $sort_str = " order by `race`";
else                       $sort_str = " order by `name`";

{
    echo'<form>';
    echo'<input name="s" type="hidden" value="p">';
    echo'<table class=find>';
    echo'<tr><td class=top colspan=2>';
    echo'<table class=findtop><tr><td class=topleft>&nbsp;</td><td class=top>'.$lang['player_lookup'].'</td><td class=topright>&nbsp;</td></tr></table>';
    echo'</td></tr>';
    echo'<tr><td align="center">'.$lang['player_name'].'</td><td><input name="name" value="'.$name.'" size="35"></td></tr>';
    echo'<tr><td class=bottom colspan=2><input type=submit value="'.$lang['search'].'"></td></tr>';
    echo'</table>';
    echo'</form>';
}

if ($filter!="")
{
 $rows = $cDB->selectPage($number, "SELECT * FROM `characters` WHERE
 $filter
 $sort_str LIMIT ?d, ?d", getPageOffset($page), $config['fade_limit']);
 if ($number == 0  OR $rows == NULL)
    echo $lang['not_found'];
 else
 {
  echo "<TABLE class=report width=500>";
  echo "<TBODY>";
  echo '<TR><TD colspan=5 class=head>'.$lang['search_results'].' - '.$lang['found'].' '.$number.' </TD></TR>';
  // Делаем ссылку для сортировки
  $SortRefrence = $FindRefrence;
  if ($page>1) $SortRefrence.="&page=$page";
  echo "<TR>";
  echo "<th><a href=\"$SortRefrence&sort=level\">$lang[player_level]</a></th>";
  echo "<th><a href=\"$SortRefrence&sort=race\">$lang[player_race]</a></th>";
  echo "<th><a href=\"$SortRefrence&sort=class\">$lang[player_class]</a></th>";
  echo "<th width=100%><A href=\"$SortRefrence\">$lang[player_name]</A></TH>";
  echo "<th></th>";
  echo "</TR>";

  foreach ($rows as $player)
  {
   $imgsize=32;
   $char_data = explode(' ',$player['data']);
   $char_info = str_pad(dechex($char_data[UNIT_FIELD_BYTES_0]), 8, 0, STR_PAD_LEFT);
   $gender    = hexdec($char_info[3]);
   $class     = hexdec($char_info[5]);
   $race      = hexdec($char_info[7]);
   $level     = $char_data[UNIT_FIELD_LEVEL];
   echo "<TR>";
   echo "<TD align = center>$level</TD>";
   echo "<TD class=prace><img width=$imgsize height=$imgsize src=\"".getRaceImage($race,$gender)."\"></TD>";
   echo "<TD class=pclass><img width=$imgsize height=$imgsize src=\"".getClassImage($class)."\"></TD>";
   echo "<TD class=player><A href=\"?player=$player[guid]\">$player[name]</a></TD>";
   echo "<TD class=pfaction><img width=$imgsize height=$imgsize src=\"".getFactionImage($race)."\"></TD>";
   echo "</TR>";
  }

  $pageRefrence = $FindRefrence;
  if ($sort) $pageRefrence.="&sort=$sort";
  generatePage($number, $page, "<a href=\"$pageRefrence&page=%d\">%d </a>", 5);
  echo "</TBODY></TABLE>";
 }
}
?>

