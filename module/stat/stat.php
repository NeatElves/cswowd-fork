<?php
include_once("include/functions.php");
include_once("include/simple_cacher.php");
// Путь к модулю, для картинок
$module_path = "module/stat";
function days($time)
{
    $d = floor( $time / (3600*24) );
    $time = $time - $d*3600*24;
    $h = floor( $time / 3600 );
    $time = $time - $h*3600;
    $m = floor( $time / 60 );
    return sprintf("%d дней. %02d ч. %02d м.", $d, $h, $m);
}

function renderClassStat($list, $data, $total)
{
  global $module_path;
  echo "<table class=stat cellSpacing=0 cellPadding=0><tbody><tr class=stat_top>";
  foreach ($list as $c)
  {
    $pct = $total ? $data[$c]/$total * 100 :0;
    $height = $pct * 4;
    $pct = sprintf("%0.2f%%", $pct);
    echo "<td class=st_data>{$pct}<br><img src=\"{$module_path}/img/column.gif\" width=\"44\" height=\"$height\" alt=\"{$pct}\"/></td>";
  }
  echo "</tr><tr class=stat_bot>";
  foreach ($list as $c)
    echo "<td class=st_data><img src=".getClassImage($c)." width=32px><br>".$data[$c]."</td>";
  echo "</tr></table>";
}

function renderRaceStat($list, $data, $total)
{
  global $module_path;
  echo "<table class=stat cellSpacing=0 cellPadding=0><tbody><tr class=stat_top>";
  foreach ($list as $r)
  {
    $pct = $total ? $data[$r]/$total * 100 :0;
    $height = $pct * 4;
    $pct    = sprintf("%0.2f%%", $pct);
    echo "<td class=st_data>{$pct}<br><img src=\"{$module_path}/img/column.gif\" width=\"79\" height=\"$height\" alt=\"{$pct}\"/></td>";
  }
  echo "</tr><tr class=stat_bot>";
  foreach ($list as $r)
    echo "<td class=st_data><img src=".getRaceImage($r, rand()%2)." width=32px><br>".$data[$r]."</td>";
  echo "</tr>";
  echo "</tbody></table>";
}

$cacheFilename = 'statistic_'.$config['lang'].'.html';
if (checkUseCacheHtml($cacheFilename, 60*60*24))
{
 //******************************************************************************
 // Основные настройки статистики
 //******************************************************************************
 $alliance_race = array(1, 3, 4, 7, 11);  // Список рас альянса
 $horde_race    = array(2, 5, 6, 8, 10);  // Список рас орды
 $class = array(11,5,4,1,8,9,2,3,7,6);    // Классы по которым собираем статистику

 // Статистика аккаунтов
 $accs = $rDB->selectcell("SELECT count(`id`) FROM `account`;");

 // Статистика онлайн
 $onlineal = $cDB->selectcell("SELECT count(`guid`) FROM `characters` WHERE (`online` > '0' AND `race` IN (?a))", $alliance_race);
 $onlinehr = $cDB->selectcell("SELECT count(`guid`) FROM `characters` WHERE (`online` > '0' AND `race` IN (?a))", $horde_race);
 $onlinePl = $onlineal + $onlinehr;

 // Получаем статистику по клаасам из базы
 $calliance = array();  // Количество игроков альянса по классам
 $chorde    = array();  // Количество игроков орды по классам
 $allside   = array();  // Количество игроков (орды и альянса) по классам
 $craces    = array();  // Данные распределения по расам
 $alliance  = 0;        // Всего игроков из альянса
 $horde     = 0;        // Всего игроков из орды
 $chrs      = 0;        // Всего игроков
 foreach ($class as $c)
 {
  $calliance[$c] = $cDB->selectcell("SELECT count(`guid`) FROM `characters` WHERE (`race` IN (?a) AND `class`=?d)", $alliance_race, $c);
  $chorde[$c]    = $cDB->selectcell("SELECT count(`guid`) FROM `characters` WHERE (`race` IN (?a) AND `class`=?d)", $horde_race,    $c);
  $alliance += $calliance[$c];
  $horde    += $chorde[$c];
  $allside[$c] = $calliance[$c] + $chorde[$c];
 }
 $chrs = $alliance + $horde;

 // Получаем статистику по расам из базы
 $race = array_merge($alliance_race, $horde_race);
 foreach ($race as $r)
 {
  $craces[$r] = $cDB->selectcell("SELECT count(`guid`) FROM `characters` WHERE `race`=?d", $r);
 }

 // Получаем данные из uptime
 $uptime = $rDB->selectRow(
 "SELECT
  AVG(uptime) AS `avg`,
  MAX(uptime) AS `max_uptime`,
  MAX(maxplayers) AS `max_online`,
  (100*SUM(uptime)/(UNIX_TIMESTAMP()-MIN(starttime))) AS `total`
  FROM uptime");
  $cur_uptame = $rDB->selectRow(
  "SELECT
  uptime AS 'cur_uptame'
  FROM uptime ORDER BY starttime DESC");

 //******************************************************************************
 // Вывод общей статистики
 //******************************************************************************
 echo "<table class=report width=100%>";
 echo "<tr><td colspan=2 class=head>".$lang['stat_total']."</td></tr>";
 echo "<tr><td>".$lang['stat_online']."</td><td>".$onlinePl."</td></tr>";
 echo "<tr><td>".$lang['stat_maxonline']."</td><td>".$uptime['max_online']."</td></tr>";
 echo "<tr><td>".$lang['stat_uptime']."</td><td>".days($cur_uptame['cur_uptame'])."</td></tr>";
 echo "<tr><td>".$lang['stat_maxuptime']."</td><td>".days($uptime['max_uptime'])."</td></tr>";
 echo "<tr><td>".$lang['stat_total_acc']."</td><td>".$accs."</td></tr>";
 echo "<tr><td>".$lang['stat_total_chr']."</td><td>".$chrs."</td></tr>";
 echo "</table>";

 //******************************************************************************
 // Вывод статистики альянса и орды
 //******************************************************************************
 echo "<br><table class=report width=100%><tbody>";
 echo "<tr><td class=head colSpan=3>".$lang['stat_sides']."</td></tr>";
 echo "<tr>";
 echo "<td align=center><br><img src=\"module/stat/img/alliance.gif\"><br>".$lang['stat_total_pl']." $alliance<br>".$lang['stat_online']." $onlineal</td>";
 echo "<td width=6px></td>";
 echo "<td align=center><br><img src=\"module/stat/img/horde.gif\"><br>".$lang['stat_total_pl']." $horde<br>".$lang['stat_online']." $onlinehr</td>";
 echo "</tr>";

 // Распределение по классам
 echo "<tr><td class=head colspan=3>".$lang['stat_classes']."</td></tr>";
 echo "<tr>";
 echo "<td class=stat_data align=center>";renderClassStat($class, $calliance, $alliance);echo "</td>";
 echo "<td></td>";
 echo "<td class=stat_data align=center>";renderClassStat($class, $chorde, $horde);echo "</td>";
 echo "</tr>";

 // распределение по расам
 echo "<tr><td class=head colspan=3>".$lang['stat_races']."</td></tr>";
 echo "<tr>";
 echo "<td class=stat_data align=center>";renderRaceStat($alliance_race, $craces, $chrs);echo "</td>";
 echo "<td></td>";
 echo "<td class=stat_data align=center>";renderRaceStat($horde_race, $craces, $chrs);echo "</td>";
 echo "</tr>";

 echo "</tbody></table>";
 flushHtmlCache($cacheFilename);
}

?>
