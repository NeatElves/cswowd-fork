<?php
include_once("conf.php");
include_once("include/player_data.php");
include_once("include/functions.php");
include_once("include/report_generator.php");
##########
/*
 * Скрипт для поиска игроков по имени
 */

$page = intval(@$_REQUEST['page']);

// Определяем режим поиска
$allmode = @$_REQUEST['s']=='all';

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

// Вывод диалога поиска
if ($ajaxmode==0)
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

if ($filter)
{
 $show_fields= array('PL_REPORT_LEVEL', 'PL_REPORT_RACE', 'PL_REPORT_CLASS', 'PL_REPORT_NAME', 'PL_REPORT_FACTION');

 $p_search = new PlayerReportGenerator();
 if (!$allmode)
   $p_search->disableMark();
 $p_search->Init($show_fields, $FindRefrence, 'searchPlayer', $config['fade_limit'], 'name');
 $p_search->doRequirest($filter);
 $number = $p_search->getTotalDataCount();
 if ($number <= 0)
    echo $lang['not_found'];
 else if ($number == 1)    // Перенаправляем
    echo '<meta http-equiv="refresh" content=1;URL=?player='.$p_search->data_array[0]['guid'].'>';
 else
    $p_search->createReport($lang['search_results'].' - '.$lang['found'].' '.$number);
}
?>