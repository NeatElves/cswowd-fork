<?php
include_once("include/functions.php");
include_once("quest_zone_sort.php");
include_once("include/report_generator.php");

// Определяем режим поиска
$allmode = @$_REQUEST['s']=='all';

// Создаём ссылку на страницу, игнорируем дефолтные значения
$FindRefrence = "?s=q";

$show_fields = array('QUEST_REPORT_LEVEL', 'QUEST_REPORT_NAME', 'QUEST_REPORT_GIVER', 'QUEST_REPORT_REWARD');
//==============================================================================
// Создаём SQL запрос исходя из заданых пользователем параметров
//==============================================================================
$filter = "";
// Фильтр имени
if ($name = mysql_real_escape_string(@$_REQUEST['name']))
{
  $filter.= " AND `Title` like '%$name%'";
  $FindRefrence.="&name=$name";
}
// Level filter
if ($level_min = intval(@$_REQUEST['level_min']))
{
  $filter." AND `MinLevel` >= '$level_min'";
  $FindRefrence.="&level_min=$level_min";
}
if ($level_max = intval(@$_REQUEST['level_max']))
{
  $filter." AND `MinLevel` <= '$level_max'";
  $FindRefrence.="&level_max=$level_max";
}
// Фмльтр по зоне
if ($ZoneID = intval(@$_REQUEST['ZoneID']))
{
  $filter.= " AND `ZoneOrSort` = '$ZoneID'";
  $FindRefrence.="&ZoneID=$ZoneID";
}
// Фильтр по типу
if ($SortID = intval(@$_REQUEST['SortID']))
{
  $filter.= " AND `ZoneOrSort` = '-$SortID'";
  $FindRefrence.="&SortID=$SortID";
}
// Фильтр c
if ($side = @$_REQUEST['side'])
{
  $races = 0;
       if ($side=='alliance') $filter.= ' AND ((`RequiredRaces`&'.(1 + 4 + 8 + 64 + 1024).') OR `RequiredRaces`=0)';
  else if ($side=='horde'   ) $filter.= ' AND ((`RequiredRaces`&'.(2 + 16 + 32 + 128 + 512).') OR `RequiredRaces`=0)';
  $FindRefrence.='&side='.$side;
}
// Убираем ненужный AND в начале строки
$filter = substr($filter, 5);


// Вывод диалога поиска
if ($allmode==0 and $ajaxmode==0)
{
    if ($level_min == 0) $level_min = "";
    if ($level_max == 0) $level_max = "";
    echo '<form>';
    echo '<input name="s" type="hidden" value="q">';
    echo '<table class=find>';
    echo '<tr><td class=top colspan=2>';
    echo '<table class=findtop><tr><td class=topleft>&nbsp;</td><td class=top>'.$lang['find_quest'].'</td><td class=topright>&nbsp;</td></tr></table>';
    echo '</td></tr>';
    echo '<tr><td>'.$lang['quest_name'].':</td><td><input class=ls_search alt="q" name="name" value="'.$name.'" size="39">';
    echo '<select name="side">';
    echo '<option value="both">Both</option>';
    echo '<option value="alliance">Allince</option>';
    echo '<option value="horde">Horde</option>';
    echo '</select>';
    echo '</td></tr>';
    echo '<tr><td>'.$lang['level'].':</td><td><input name="level_min" value="'.$level_min.'" size="21"> - <input name="level_max" value="'.$level_max.'" size="21"></td></tr>';
    echo '<tr><td colspan=2>';zoneSortSelect();echo '</td></tr>';
    echo '<tr><td class=bottom colspan=2><input type=submit value="'.$lang['search'].'"></td></tr>';
    echo '</table>';
    echo '</form>';
}

// Ищем если имеется хоть чтото в запросе
if ($filter!="")
{
 $quest_search =& new QuestReportGenerator();
 $quest_search->disableMark();
 //==============================================================================
 // Локализация запроса
 //==============================================================================
 if ($config['locales_lang'] > 0 && $name)
 {
    if (preg_match($config['locales_charset'], $name))
       $filter = str_replace("`Title`", "`Title_loc".$config['locales_lang']."`",$filter);
    else
       $quest_search->disableNameLocalisation();
 }
 $quest_search->Init($show_fields, $FindRefrence, 'searchQuest', $config['fade_limit'], 'name');
 $quest_search->doRequirest($filter);
 $number = $quest_search->getTotalDataCount();
 if ($number <= 0)
    echo $lang['not_found'];
 else if ($number == 1 && $allmode == 0)    // Перенаправляем
    echo '<meta http-equiv="refresh" content=1;URL=?quest='.$quest_search->data_array[0]['entry'].'>';
 else
    $quest_search->createReport($lang['search_results'].' - '.$lang['found'].' '.$number);
}
?>
