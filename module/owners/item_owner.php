<?php
include_once("include/functions.php");
##########
/*
 * Скрипт показывает список владельцев вещи по ее id
 */

$itemid = intval(@$_REQUEST['itemOwner']);
$page   = intval(@$_REQUEST['page']);

// Sort method
$sort = @$_REQUEST['sort'];
$sort_str = "";
if      ($sort == "name")  $sort_str = "`name`";
else if ($sort == "level") $sort_str = " SUBSTRING_INDEX( SUBSTRING_INDEX(`characters`.`data` , ' ' , ".(UNIT_FIELD_LEVEL+1).") , ' ' , -1 ) + 0 DESC";
else if ($sort == "class") $sort_str = "`class`, `race`";
else if ($sort == "race")  $sort_str = "`race`, `class`";
else                       $sort_str = "`name`";

$item=getItem($itemid);
if (!$item)
{
   RenderError("$lang[item_not_found]");
}
else
{
 echo "<table cellSpacing=0 cellPadding=0 width=500><tbody><tr>";
 echo "<td vAlign=top align=right width=20%>";
 $icon = getItemIcon($item['displayid']);
 echo "<br><img height=64 width=64 border=0 src='$icon'></td>";
 echo "<td>";generateItemTable($item,0,0);echo "</td>";
 echo "</tr></tbody></table>";

 $rows = $cDB->selectPage($number,
 "SELECT
   `characters`.`guid`,
   `characters`.`name`,
   `characters`.`data`,
   `item_instance`.`data` AS `item_data`
  FROM
   `characters`
     left join
   `item_instance`
  ON
   `item_instance`.`owner_guid` = `characters`.`guid`
  WHERE
   (SUBSTRING_INDEX( SUBSTRING_INDEX(`item_instance`.`data` , ' ' , ?d) , ' ' , -1 )+0) = ?d
  ORDER BY $sort_str
  LIMIT ?d, ?d", ITEM_FIELD_ENTRY + 1, $itemid, getPageOffset($page), $config['fade_limit']);

 echo "<table class=report width=500>";
 echo "<tbody>";
 if ($number == 0  OR $rows == NULL)
  echo '<tr><td colspan=5 class=head>'.$lang['owner_no_found'].' </td></tr>';
 else
 {
  $FindRefrence="?itemOwner=$itemid";
  echo '<tr><td colspan=6 class=head>'.sprintf($lang['owner_list'], $number).' </td></tr>';
  // Делаем ссылку для сортировки
  $SortRefrence = $FindRefrence;
  if ($page>1) $SortRefrence.="&page=$page";
  echo "<tr>";
  echo "<th><a href=\"$SortRefrence&sort=level\">$lang[player_level]</a></th>";
  echo "<th><a href=\"$SortRefrence&sort=race\">$lang[player_race]</a></th>";
  echo "<th><a href=\"$SortRefrence&sort=class\">$lang[player_class]</a></th>";
  echo "<th width=100%><A href=\"$SortRefrence\">$lang[player_name]</A></TH>";
  echo "<th></th>";
  echo "<th></th>";
  echo "</tr>";

  foreach ($rows as $owner)
  {
   $char_data = explode(' ',$owner['data']);
   $item_data = explode(' ',$owner['item_data']);
   $char_info = str_pad(dechex($char_data[UNIT_FIELD_BYTES_0]), 8, 0, STR_PAD_LEFT);
   $gender    = hexdec($char_info[3]);
   $class     = hexdec($char_info[5]);
   $race      = hexdec($char_info[7]);
   $level     = $char_data[UNIT_FIELD_LEVEL];
   echo "<tr>";
   echo "<td align = center>$level</td>";
   echo "<td class=prace><img class=auction src=\"".getRaceImage($race,$gender)."\"></td>";
   echo "<td class=pclass><img class=auction src=\"".getClassImage($class)."\"></td>";
   echo "<td class=player><A href=\"?player=$owner[guid]\">$owner[name]</a></td>";
   echo "<td class=pfaction><img class=auction src=\"".getFactionImage($race)."\"></td>";
   echo "<td>";show_item_by_data($item_data, 'auction');echo "</td>";
   echo "</tr>";
  }

  $pageRefrence = $FindRefrence;
  if (@$sort) $pageRefrence.="&sort=$sort";
  generatePage($number, $page, "<a href=\"$pageRefrence&page=%d\">%d </a>", 6);
 }
 echo "</tbody></table>";
}
?>
