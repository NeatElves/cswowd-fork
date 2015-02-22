<?php
include_once("conf.php");
include_once("item_class.php");
include_once("include/functions.php");
include_once("include/report_generator.php");

// Определяем режим поиска
$allmode = @$_REQUEST['s']=='all';

// Создаём ссылку на страницу, игнорируем дефолтные значения
$FindRefrence = "?s=i";

// Выбор какие поля будем выводить - основываемся на данных о типе и классе
$show_fields = 0;   // По дефолту

//==============================================================================
// По каким полям ищем
//==============================================================================
$filter = "";
// Name filter
if ($name = mysql_real_escape_string(@$_REQUEST['name']))
{
  $filter = " AND `name` like '%$name%'";
  $FindRefrence.="&name=$name";
}
// Item Type filter
if ($type = intval(@$_REQUEST['type']))
{
  $show_fields = @$itemType_list[$type];
  $filter.= " AND InventoryType=$type";
  $FindRefrence.="&type=$type";
}
// Class and subclass filter(stored in class.subclass format)
mergeStrByPoint(@$_REQUEST['class'], $class, $subclass);
if ($class>=0 OR $subclass>=0)
{
  $show_fields = @$ItemClass_list[@$_REQUEST['class']];
  $filter.=" AND `class` = $class";
  $FindRefrence.="&class=$class";
  if ($subclass >=0)
  {
    $filter.=" AND `subclass` = $subclass";
    $FindRefrence.=".$subclass";
  }
}

// Level Filter
if ($level_min = intval(@$_REQUEST['level_min']))
{
  $filter.= " AND RequiredLevel >= $level_min";
  $FindRefrence.="&level_min=$level_min";
}
if ($level_max = intval(@$_REQUEST['level_max']))
{
  $filter.= " AND RequiredLevel <= $level_max";
  $FindRefrence.="&level_max=$level_max";
}
// Тотем категория
if ($totemCat = intval(@$_REQUEST['totem']))
{
  $filter.= " AND TotemCategory=$totemCat";
  $FindRefrence.='&totem='.$totemCat;
}
// Тип камня
if ($gemProp = intval(@$_REQUEST['gem']))
{
  $show_fields = &$item_jevelry;
  if ($gem = $wDB->selectCol("SELECT `id` FROM `wowd_gemproperties` WHERE `color` & ?d", $gemProp))
  {
    $filter.= ' AND GemProperties IN ('.join(',', $gem).')';
    $FindRefrence.='&gem='.$gemProp;
  }
  else
    $filter.=' AND `item_template`.`entry`=-1';
}
// Flags
if ($flags = intval(@$_REQUEST['flags']))
{
  $filter.= ' AND (`Flags`&'.(1<<$flags).')';
  $FindRefrence.='&flags='.$flags;
}

// Убираем ненужный AND в начале строки
$filter = substr($filter, 5);

// Назначаем выводимые столбцы если не назначены
if ($show_fields==0)
   $show_fields = &$item_all;
// Disable some columns output if need
if ($type)
  if ($id = array_search('ITEM_REPORT_SLOTTYPE', $show_fields))
    unset($show_fields[$id]);
if ($subclass >=0)
  if ($id = array_search('ITEM_REPORT_SUBCLASS', $show_fields))
       unset($show_fields[$id]);
       
//==============================================================================
// Search dialog
//==============================================================================
if ($allmode==0 and $ajaxmode==0)
{
    if ($level_min == 0) $level_min = "";
    if ($level_max == 0) $level_max = "";
    // Вывод диалога
    echo '<form>';
    echo '<input name="s" type="hidden" value="i">';
    echo '<table class=find>';
    echo '<tr><td colspan=6 class=top>';
    echo '<table class=findtop><tr><td class=topleft>&nbsp;</td><td class=top>'.$lang['find_item'].'</td><td class=topright>&nbsp;</td></tr></table>';
    echo '</td></tr>';

    echo '<tr><td>'.$lang['item_name'].':</td>';
    echo '<td colSpan=5><input class=ls_search alt=i name="name" style="width: 100%;" value="'.$name.'"></td></tr>';
    echo '<tr><td>'.$lang['item_class'].':</td><td colspan=5>';
    echo '<select name="class" style="width: 100%;">\n';
    echo "\n<option value=''>".getClassName(-1)."</option>\n";
    $key = array_keys($ItemClass_list);
    for($i=0; $i<count($ItemClass_list); $i++)
    {
        $text = "";
        $value = $key[$i];
        mergeStrByPoint($value, $s_class, $s_subclass);
        $style = "";
        if ($s_subclass < 0)
        {
           $text = getClassName($s_class);
           $style = 'style = "FONT-WEIGHT: 800;"';
        }
        else
           $text = "&nbsp;&nbsp;* ".getSubclassName($s_class, $s_subclass);
        if ($s_class == $class AND $s_subclass == $subclass)
           echo $style.=' selected = "selected"';
        echo "<option $style value='$value'>$text</option>\n";
    }
    echo '</select></td></tr>';
    echo '<tr><td>'.$lang['item_min_level'].':</td>';
    echo '<td><input name="level_min" value="'.$level_min.'" style="WIDTH: 30px"></td>';
    echo '<td width=90>'.$lang['item_max_level'].':</td>';
    echo '<td><input name="level_max" value="'.$level_max.'" style="WIDTH: 30px"></td>';
    echo '<td>'.$lang['item_type'].':</td><td><select name="type">\n';
    echo "\n<option value=''>".getInventoryType(0)."</option>\n";
    $key = array_keys($itemType_list);
    for($i=0; $i<count($itemType_list); $i++)
    {
        $value = $key[$i];
        $text = getInventoryType($value);
		if ($type==$value) echo "<option \"selected\" value=$value>$text</option>\n";
		else               echo "<option value=$value>$text</option>\n";
	}
    echo '</select></td></tr><tr>';
    echo '<tr><td colspan=6 class=bottom><input type=submit value="'.$lang['search'].'">&nbsp;<input type=RESET value="'.$lang['reset'].'"></td></tr>';
    echo '</table>';
    echo '</form>';
}

if ($filter!='')
{
 $isearch =& new ItemReportGenerator;
 if (!$allmode)
   $isearch->disableMark();

 //==============================================================================
 // Локализация запроса
 //==============================================================================
 if ($config['locales_lang'] > 0 && $name)
// {
//    if (preg_match($config['locales_charset'], $name))
       $filter = str_replace('`name`', '`name_loc'.$config['locales_lang'].'`', $filter);
    else
       $isearch->disableNameLocalisation();
// }

 $isearch->Init($show_fields, $FindRefrence, 'searchItem', $config['fade_limit'], 'name');
 $isearch->doRequirest($filter);
 $number = $isearch->getTotalDataCount();
 if ($number <= 0)
    echo $lang['not_found'];
 else if ($number == 1 && $allmode == 0)
 {
    // Перенаправляем
    echo '<meta http-equiv="refresh" content=1;URL=?item='.$isearch->data_array[0]['entry'].'>';
 }
 else
 {
    $isearch->removeIfAllZero('RequiredLevel', 'ITEM_REPORT_REQLEVEL');
    $isearch->removeIfAllZero('armor', 'ITEM_REPORT_ARMOR');
    $isearch->removeIfAllZero('dps',   'ITEM_REPORT_DPS');
    $isearch->removeIfAllZero('delay', 'ITEM_REPORT_SPEED');
    $isearch->createReport($lang['search_results'].' - '.$lang['found'].' '.$number);
 }
}
?>

