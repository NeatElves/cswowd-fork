<?php
include_once("include/functions.php");
include_once("quest_zone_sort.php");
include_once("include/report_generator.php");

// Определяем режим поиска
$allmode = @$_REQUEST['s']=='all';

// Создаём ссылку на страницу, игнорируем дефолтные значения
$FindRefrence = "?s=q";

$show_fields = array('QUEST_REPORT_LEVEL', 'QUEST_REPORT_NAME', 'QUEST_REPORT_GIVER', 'QUEST_REPORT_GIVER_END', 'QUEST_REPORT_REWARD');
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
// Фильтр по зоне
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
// Фильтр по профе
if ($SkillID = intval(@$_REQUEST['SkillID']))
{
  $filter.= " AND `RequiredSkill` = '$SkillID'";
  $FindRefrence.="&SkillID=$SkillID";
}
// Фильтр по класу
if ($RedClass = intval(@$_REQUEST['RedClass']))
{
 switch ($RedClass):
  case 1:  $RedClass1 = 1;   break;
  case 2:  $RedClass1 = 2;   break;
  case 3:  $RedClass1 = 4;   break;
  case 4:  $RedClass1 = 8;  break;
  case 5:  $RedClass1 = 16;  break;
  case 6:  $RedClass1 = 32;  break;
  case 7:  $RedClass1 = 64;  break;
  case 8:  $RedClass1 = 128; break;
  case 9:  $RedClass1 = 256;    break;
  case 11:  $RedClass1 = 1024;    break;
  default: $RedClass1 = 0;
 endswitch;
  $filter.= " AND `RequiredClasses` & '$RedClass1'";
  $FindRefrence.="&RedClass=$RedClass";
}
// Фильтр по повтору
if ($Sfr = intval(@$_REQUEST['Sfr']))
{
  $filter.= " AND `SpecialFlags` & 1 AND (`SpecialFlags` & 4 = 0 AND `QuestFlags` & 36864  = 0)";
  $FindRefrence.="&Sfr=$Sfr";
}
// Фильтр по ежеднев
if ($Sfd = intval(@$_REQUEST['Sfd']))
{
  $filter.= " AND `QuestFlags` & 4096";
  $FindRefrence.="&Sfd=$Sfd";
}
// Фильтр по еженед
if ($Sfw = intval(@$_REQUEST['Sfw']))
{
  $filter.= " AND `QuestFlags` & 32768";
  $FindRefrence.="&Sfw=$Sfw";
}
// Фильтр по ежемес
if ($Sfm = intval(@$_REQUEST['Sfm']))
{
  $filter.= " AND `SpecialFlags` = '$Sfm'";
  $FindRefrence.="&Sfm=$Sfm";
}
// Фильтр c
if ($side = @$_REQUEST['side'])
{
  $races = 0;
  if ($side=='allianceonly') $filter.= " AND `RequiredRaces` = 1101";
  else if ($side=='alliance') $filter.= ' AND ((`RequiredRaces`&'.(1 + 4 + 8 + 64 + 1024).') OR `RequiredRaces`=0)';
  else if ($side=='hordeonly') $filter.= " AND `RequiredRaces` = 690";
  else if ($side=='horde') $filter.= ' AND ((`RequiredRaces`&'.(2 + 16 + 32 + 128 + 512).') OR `RequiredRaces`=0)';
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
    echo '<option value="both">'.$lang['Both'].'</option>';
    echo '<option value="alliance">'.$lang['Alliance'].'</option>';
    echo '<option value="horde">'.$lang['Horde'].'</option>';
    echo '<option value="allianceonly">'.$lang['Allianceonly'].'</option>';
    echo '<option value="hordeonly">'.$lang['Hordeonly'].'</option>';
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
 if (!$allmode)
   $quest_search->disableMark();
 //==============================================================================
 // Локализация запроса
 //==============================================================================
 if ($config['locales_lang'] > 0 && $name)
// {
//    if (preg_match($config['locales_charset'], $name))
       $filter = str_replace('`Title`', '`Title_loc'.$config['locales_lang'].'`', $filter);
    else
       $quest_search->disableNameLocalisation();
// }
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
