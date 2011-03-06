<?php
include_once("include/functions.php");
include_once("include/gameobject_table.php");
include_once("include/report_generator.php");

// То что будет выводится в запросе поиска типа го (поля одинаковые)
$goType_list = array(
'0'=>&$show_fields,
'1'=>&$show_fields,
'2'=>&$show_fields,
'3'=>&$show_fields,
'4'=>&$show_fields,
'5'=>&$show_fields,
'6'=>&$show_fields,
'7'=>&$show_fields,
'8'=>&$show_fields,
'9'=>&$show_fields,
'10'=>&$show_fields,
'11'=>&$show_fields,
'12'=>&$show_fields,
'13'=>&$show_fields,
'14'=>&$show_fields,
'15'=>&$show_fields,
'16'=>&$show_fields,
'17'=>&$show_fields,
'18'=>&$show_fields,
'19'=>&$show_fields,
'20'=>&$show_fields,
'21'=>&$show_fields,
'22'=>&$show_fields,
'23'=>&$show_fields,
'24'=>&$show_fields,
'25'=>&$show_fields,
'26'=>&$show_fields,
'27'=>&$show_fields,
'28'=>&$show_fields,
'29'=>&$show_fields,
'30'=>&$show_fields,
'31'=>&$show_fields,
'32'=>&$show_fields,
'33'=>&$show_fields,
'34'=>&$show_fields,
);

// Определяем режим поиска
$allmode = @$_REQUEST['s']=='all';

// Создаём ссылку на страницу, игнорируем дефолтные значения
$FindRefrence = "?s=o";

$show_fields = array('GO_REPORT_NAME','GO_REPORT_TYPE','GO_REPORT_MAP');
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
// Spell focus фильтр
if ($spellFocus = intval(@$_REQUEST['focus']))
{
  $filter.= " AND (`type` = ".GAMEOBJECT_TYPE_SPELL_FOCUS." AND `data0` = $spellFocus)";
  $FindRefrence.="&focus=$spellFocus";
}

// Lock фильтр
$locks = intval(@$_REQUEST['lockSkill']);
$locki = intval(@$_REQUEST['lockItem']);
if ($locks OR $locki)
{
  if ($locki) $key = 1;
  if ($locks) $key = 2;
  $lock = $wDB->selectCol(
   "SELECT `id` FROM `wowd_lock`
   WHERE
    (`keytype_0` = ?d AND `key_0` = ?d) OR
    (`keytype_1` = ?d AND `key_1` = ?d) OR
    (`keytype_2` = ?d AND `key_2` = ?d) OR
    (`keytype_3` = ?d AND `key_3` = ?d) OR
    (`keytype_4` = ?d AND `key_4` = ?d)",
    $key, $locks, $key, $locks, $key, $locks, $key, $locks, $key, $locks);
  if ($lock)
  {
   $data0 = GAMEOBJECT_TYPE_QUESTGIVER.",".GAMEOBJECT_TYPE_CHEST.",".GAMEOBJECT_TYPE_TRAP.",".GAMEOBJECT_TYPE_GOOBER.",".GAMEOBJECT_TYPE_CAMERA;
   $data1 = GAMEOBJECT_TYPE_DOOR.",".GAMEOBJECT_TYPE_BUTTON;
   $llist=join(", ", $lock);
   $filter.= " AND ((`type` IN ($data0) AND `data0` IN ($llist)) OR (`type` IN ($data1) AND `data1` IN ($llist)))";
  }
  if ($locki) $FindRefrence.='&lockItem='.$locki;
  if ($locks) $FindRefrence.='&lockSkill='.$locks;
}

// Object type filter
if ($type = intval(@$_REQUEST['type']))
{
  $filter.= " AND `type` = $type";
  $FindRefrence.="&type=$type";
}

// Убираем ненужный AND в начале строки
$filter = substr($filter, 5);
// Вывод диалога поиска
if ($allmode==0 and $ajaxmode==0)
{
    echo '<form>';
    echo '<input name="s" type="hidden" value="o">';
    echo '<table class=find>';
    echo '<tr><td class=top colspan=2>';
    echo '<table class=findtop><tr><td class=topleft>&nbsp;</td><td class=top>'.$lang['go_find'].'</td><td class=topright>&nbsp;</td></tr></table>';
    echo '</td></tr>';
    echo '<tr><td align="center">'.$lang['go_name'].':</td><td><input class=ls_search alt=g name="name" value="'.$name.'" size=35></td></tr>';
    echo '<td>'.$lang['go_type'].':</td><td><select name="type">\n';
    echo "\n<option value=''>".getGameobjectType(-1)."</option>\n";
    $key = array_keys($goType_list);
    for($i=0; $i<count($goType_list); $i++)
    {
        $value = $key[$i];
        $text = getGameobjectType($value);
        if ($type==$value) echo "<option \"selected\" value=$value>$text</option>\n";
	        else           echo "<option value=$value>$text</option>\n";
	}
    echo '</select></td></tr>';
    echo '<tr><td class=bottom colspan=2><input type=submit value="'.$lang['search'].'"></td></tr>';
    echo '</table>';
    echo '</form>';
}

if ($filter)
{
 $go_search =& new GameobjectReportGenerator();
 if (!$allmode)
   $go_search->disableMark();
 //==============================================================================
 // Локализация запроса
 //==============================================================================
 if ($config['locales_lang'] > 0 && $name)
 {
    if (preg_match($config['locales_charset'], $name))
       $filter = str_replace('`name`', '`name_loc'.$config['locales_lang'].'`', $filter);
    else
       $go_search->disableNameLocalisation();
 }
 $go_search->Init($show_fields, $FindRefrence, 'searchGo', $config['fade_limit'], 'name');
 $go_search->doRequirest($filter);
 $number = $go_search->getTotalDataCount();
 if ($number <= 0)
    echo $lang['not_found'];
 else if ($number == 1 && $allmode == 0)    // Перенаправляем
    echo '<meta http-equiv="refresh" content=1;URL=?object='.$go_search->data_array[0]['entry'].'>';
 else
    $go_search->createReport($lang['search_results'].' - '.$lang['found'].' '.$number);
}
?>

