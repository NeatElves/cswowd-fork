<?php
include_once("include/functions.php");
include_once("include/report_generator.php");

// Определяем режим поиска
$allmode = @$_REQUEST['s']=='all';

// Создаём ссылку на страницу, игнорируем дефолтные значения
$FindRefrence = "?s=n";

$show_fields = array('NPC_REPORT_LEVEL', 'NPC_REPORT_NAME', 'NPC_REPORT_REACTION', 'NPC_REPORT_MAP');

//==============================================================================
// Создаём SQL запрос исходя из заданых пользователем параметров
//==============================================================================
$filter = "";
// Фильтр имени
if ($name = mysql_real_escape_string(@$_REQUEST['name']))
{
  $filter.= " AND `Name` like '%$name%'";
  $FindRefrence.="&name=$name";
}
// Фильтр дополнительного имени
if ($subname = mysql_real_escape_string(@$_REQUEST['subname']))
{
  $filter.= " AND `SubName` like '%$subname%'";
  $FindRefrence.="&subname=$subname";
}
// Level filter
if ($level_min = intval(@$_REQUEST['level_min']))
{
  $filter.= " AND `MinLevel` >= '$level_min'";
  $FindRefrence.="&level_min=$level_min";
}
if ($level_max = intval(@$_REQUEST['level_max']))
{
  $filter.= " AND `MaxLevel` <= '$level_max'";
  $FindRefrence.="&level_max=$level_max";
}
// Фильтр по типу
if ($type = intval(@$_REQUEST['type']))
{
  $filter.= " AND `CreatureType` = '$type'";
  $FindRefrence.="&type=$type";
}
// Фильтр по family
if ($family = intval(@$_REQUEST['family']))
{
  $filter.= " AND `Family` = '$family'";
  $FindRefrence.="&family=$family";
}
// Фильтр по рангу
if (isset($_REQUEST['rank']))
{
  $rank = intval($_REQUEST['rank']);
  $filter.= " AND `Rank` = '$rank'";
  $FindRefrence.="&rank=$rank";
}
// Фильтр по флагу
if (isset($_REQUEST['flag']))
{
  $npc_flag = intval($_REQUEST['flag']);
  $filter.= " AND (`NpcFlags`&".(1<<$npc_flag).")";
  $FindRefrence.="&flag=$npc_flag";
}
// Убираем ненужный AND в начале строки
$filter = substr($filter, 5);

// Вывод диалога поиска
if ($allmode==0 and $ajaxmode==0)
{
    if ($level_min == 0) $level_min = "";
    if ($level_max == 0) $level_max = "";
    echo '<form>';
    echo '<input name="s" type="hidden" value="n">';
    echo '<table class=find>';
    echo '<tr><td class=top colspan=4>';
    echo '<table class=findtop><tr><td class=topleft>&nbsp;</td><td class=top>'.$lang['find_mob'].'</td><td class=topright>&nbsp;</td></tr></table>';
    echo '</td></tr>';
    echo '<tr><td>'.$lang['mob_name'].':</td><td colspan=3><input class=ls_search alt="n" name="name" value="'.@$_REQUEST['name'].'" size="30"></td></tr>';
    echo '<tr><td>'.$lang['mob_subname'].':</td><td colspan=3><input name="subname" value="'.@$_REQUEST['subname'].'" size="30"></td></tr>';
    echo '<tr><td>'.$lang['level'].':</td><td><input name="level_min" value="'.$level_min.'" size="11"></td><td>-</td><td><input name="level_max" value="'.$level_max.'" size="11"></td></tr>';
    echo '<tr><td class=bottom colspan=4><input type=submit value="'.$lang['search'].'"></td></tr>';
    echo '</table>';
    echo '</form>';
}

if ($filter!="")
{
 $npc_search =& new CreatureReportGenerator();
 if (!$allmode)
   $npc_search->disableMark();
 //==============================================================================
 // Локализация запроса
 //==============================================================================
 if ($config['locales_lang'] > 0)
 {
   if ($name)
   {
    if (preg_match($config['locales_charset'], $name) || ctype_digit($name))
       $filter = str_replace('`Name`', '`name_loc'.$config['locales_lang'].'`', $filter);
    else
       $npc_search->disableNameLocalisation();
   }
   if ($subname)
   {
    if (preg_match($config['locales_charset'], $subname) || ctype_digit($subname))
       $filter = str_replace('`SubName`', '`subname_loc'.$config['locales_lang'].'`' ,$filter);
    else
       $npc_search->disableSubnameLocalisation();
   }
 }
 $npc_search->Init($show_fields, $FindRefrence, 'searchNpc', $config['fade_limit'], 'name');
 $npc_search->doRequirest($filter);
 $number = $npc_search->getTotalDataCount();
 if ($number <= 0)
    echo $lang['not_found'];
 else if ($number == 1 && $allmode == 0)      // Перенаправляем
    echo '<meta http-equiv="refresh" content=1;URL=?npc='.$npc_search->data_array[0]['Entry'].'>';
 else
    $npc_search->createReport($lang['search_results'].' - '.$lang['found'].' '.$number);
}
?>
