<?php
include_once("include/functions.php");
include_once("include/report_generator.php");

// Определяем режим поиска
$allmode = @$_REQUEST['s']=='all';

// Создаём ссылку на страницу, игнорируем дефолтные значения
$FindRefrence = "?s=a";

$show_fields = array('ZONE_REPORT_ID', 'ZONE_REPORT_NAME');
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
    echo '<input name="s" type="hidden" value="a">';
    echo '<table class=find>';
    echo '<tr><td class=top colspan=4>';
    echo '<table class=findtop><tr><td class=topleft>&nbsp;</td><td class=top>'.$lang['area_find'].'</td><td class=topright>&nbsp;</td></tr></table>';
    echo '</td></tr>';
    echo '<tr><td>'.$lang['area_name'].':</td><td colspan=3><input class=ls_search alt="a" name="name" value="'.$name.'" size="30"></td></tr>';
    echo '<tr><td class=bottom colspan=4><input type=submit value="'.$lang['search'].'"></td></tr>';
    echo '</table>';
    echo '</form>';
}

if ($filter)
{
 $area_search =& new ZoneReportGenerator();
 if (!$allmode)
   $area_search->disableMark();
 $area_search->Init($show_fields, $FindRefrence, 'searchArea', $config['fade_limit'], 'name');
 $area_search->doRequirest($filter);
 $number = $area_search->getTotalDataCount();
 if ($number <= 0)
    echo $lang['area_not_found'];
 else if ($number == 1 && $allmode == 0)   // Перенаправляем
    echo '<meta http-equiv="refresh" content=1;URL=?zone='.$area_search->data_array[0]['id'].'>';
 else
    $area_search->createReport($lang['search_results'].' - '.$lang['found'].' '.$number);
}
?>
