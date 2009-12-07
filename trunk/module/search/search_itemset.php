<?php
include_once("include/functions.php");
include_once("include/report_generator.php");

// Определяем режим поиска
$allmode = @$_REQUEST['s']=='all';

// Создаём ссылку на страницу, игнорируем дефолтные значения
$FindRefrence = "?s=set";

$show_fields = array('SET_REPORT_ID', 'SET_REPORT_NAME', 'SET_REPORT_ITEM');
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

$filter.=" AND 1=1";

// Убираем ненужный AND в начале строки
$filter = substr($filter, 5);

// Вывод диалога поиска
if ($allmode==0 and $ajaxmode==0)
{
    echo '<form>';
    echo '<input name="s" type="hidden" value="set">';
    echo '<table class=find>';
    echo '<tr><td class=top colspan=4>';
    echo '<table class=findtop><tr><td class=topleft>&nbsp;</td><td class=top>'.$lang['set_find'].'</td><td class=topright>&nbsp;</td></tr></table>';
    echo '</td></tr>';
    echo '<tr><td>'.$lang['set_name'].'</td><td colspan=3><input class=ls_search alt="set" name="name" value="'.$name.'" size="30"></td></tr>';
    echo '<tr><td class=bottom colspan=4><input type=submit value="'.$lang['search'].'"></td></tr>';
    echo '</table>';
    echo '</form>';
}

if ($filter)
{
 $set_search =& new ItemSetReportGenerator();
 if (!$allmode) $set_search->disableMark();
 $set_search->Init($show_fields, $FindRefrence, 'searchSet', $config['fade_limit'], 'name');
 $set_search->doRequirest($filter);
 $number = $set_search->getTotalDataCount();
 if ($number <= 0)
    echo $lang['set_not_found'];
 else if ($number == 1 && $allmode == 0)   // Перенаправляем
    echo '<meta http-equiv="refresh" content=1;URL=?itemset='.$set_search->data_array[0]['entry'].'>';
 else
    $set_search->createReport($lang['search_results'].' - '.$lang['found'].' '.$number);
}
?>
