<?php
include_once("include/functions.php");
include_once("include/report_generator.php");

// Определяем режим поиска
$allmode = @$_REQUEST['s']=='all';

// Создаём ссылку на страницу, игнорируем дефолтные значения
$FindRefrence = "?s=f";

$show_fields = array('FACTION_REPORT_ID', 'FACTION_REPORT_NAME');
//==============================================================================
// Создаём SQL запрос исходя из заданых пользователем параметров
//==============================================================================
$filter = "";
// Name filter
if ($name = mysql_real_escape_string(@$_REQUEST['name']))
{
  $filter.= " AND `name` like '%$name%'";
  $FindRefrence.="&name=$name";
}

// Убираем ненужный AND в начале строки
$filter = substr($filter, 5);

// Вывод диалога поиска
if ($allmode==0 and $ajaxmode==0)
{
    echo '<form>';
    echo '<input name="s" type="hidden" value="f">';
    echo '<table class=find>';
    echo '<tr><td class=top colspan=4>';
    echo '<table class=findtop><tr><td class=topleft>&nbsp;</td><td class=top>'.$lang['find_faction'].'</td><td class=topright>&nbsp;</td></tr></table>';
    echo '</td></tr>';
    echo '<tr><td>'.$lang['faction_name'].':</td><td colspan=3><input class=ls_search alt="f" name="name" value="'.$name.'" size="30"></td></tr>';
    echo '<tr><td class=bottom colspan=4><input type=submit value="'.$lang['search'].'"></td></tr>';
    echo '</table>';
    echo '</form>';
}

if ($filter)
{
 $faction_search =& new FactionReportGenerator();
 $faction_search->disableMark();
 $faction_search->Init($show_fields, $FindRefrence, 'searchFaction', $config['fade_limit'], 'name');
 $faction_search->doRequirest($filter);
 $number = $faction_search->getTotalDataCount();
 if ($number <= 0)
    echo $lang['not_found'];
 else if ($number == 1 && $allmode == 0)   // Перенаправляем
    echo '<meta http-equiv="refresh" content=1;URL=?faction='.$faction_search->data_array[0]['entry'].'>';
 else
    $faction_search->createReport($lang['search_results'].' - '.$lang['found'].' '.$number);
}
?>
