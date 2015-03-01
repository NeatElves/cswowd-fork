<?php
include_once("include/functions.php");
include_once("include/report_generator.php");

// Определяем режим поиска
$allmode = @$_REQUEST['s']=='all';

// Создаём ссылку на страницу, игнорируем дефолтные значения
$FindRefrence = "?s=s";

$show_fields = array('SPELL_REPORT_ICON','SPELL_REPORT_NAME','SPELL_REPORT_SCHOOL');
//==============================================================================
// Создаём SQL запрос исходя из заданых пользователем параметров
//==============================================================================
$filter = "";
// Name filter
if ($name = mysql_real_escape_string(@$_REQUEST['name']))
{
  $filter.= " AND `SpellName` LIKE '%$name%'";
  $FindRefrence.="&name=$name";
}

// Description filter
if ($desc = mysql_real_escape_string(@$_REQUEST['desc']))
{
  $filter.= " AND `Description` LIKE '%$desc%'";
  $FindRefrence.="&desc=$desc";
}

// Mechanic filter
if ($mech = intval(@$_REQUEST['mech']))
{
  $filter.= " AND (`Mechanic` = $mech OR `EffectMechanic_1` = $mech OR `EffectMechanic_2` = $mech OR `EffectMechanic_3` = $mech)";
  $FindRefrence.="&mech=$mech";
}

// Dispel filter
if ($dispel = intval(@$_REQUEST['dispel']))
{
  $filter.= " AND `Dispel` = $dispel";
  $FindRefrence.="&dispel=$dispel";
}

// Category filter
if ($cat = intval(@$_REQUEST['cat']))
{
  $filter.= " AND `Category` = $cat";
  $FindRefrence.="&cat=$cat";
}

// Focus filter
if ($focus = intval(@$_REQUEST['focus']))
{
  $filter.= " AND `RequiresSpellFocus` = $focus";
  $FindRefrence.="&focus=$focus";
}

// Spell apply form (aura == 36 - form == misc)
if ($form = intval(@$_REQUEST['form']))
{
  $filter.= " AND ((`EffectApplyAuraName_1` = 36 AND `EffectMiscValue_1` = $form) OR (`EffectApplyAuraName_2` = 36 AND `EffectMiscValue_2` = $form) OR (`EffectApplyAuraName_3` = 36 AND `EffectMiscValue_3` = $form))";
  $FindRefrence.="&form=$form";
}

// Spell apply form (aura == 36 - form == misc)
if ($lock = intval(@$_REQUEST['lock']))
{
  $filter.= " AND (
  (`Effect_1` = 33 AND `EffectMiscValue_1` = $lock) OR
  (`Effect_2` = 33 AND `EffectMiscValue_2` = $lock) OR
  (`Effect_3` = 33 AND `EffectMiscValue_3` = $lock))";
  $FindRefrence.="&lock=$lock";
}

// Убираем ненужный AND в начале строки
$filter = substr($filter, 5);

// Вывод диалога поиска
if ($allmode==0 and $ajaxmode==0)
{
    echo'<form>';
    echo'<input name="s" type="hidden" value="s">';
    echo'<table class=find>';
    echo'<tr><td class=top colspan=2>';
    echo'<table class=findtop><tr><td class=topleft>&nbsp;</td><td class=top>'.$lang['find_spell'].'</td><td class=topright>&nbsp;</td></tr></table>';
    echo'</td></tr>';
    echo'<tr><td align="center">'.$lang['spell_name'].':</td><td><input class=ls_search alt="s" name="name" value="'.$name.'" size="35"></td></tr>';
    echo'<tr><td align="center">'.$lang['spell_desc'].':</td><td><input name="desc" value="'.$desc.'" size="35"></td></tr>';
    echo'<tr><td class=bottom colspan=2><input type=submit value="'.$lang['search'].'"></td></tr>';
    echo'</table>';
    echo'</form>';
}

if ($filter)
{
 $spell_search = new SpellReportGenerator;
 if (!$allmode)
   $spell_search->disableMark();
 $spell_search->Init($show_fields, $FindRefrence, 'searchSpell', $config['fade_limit'], 'name');
 $spell_search->doRequirest($filter);
 $number = $spell_search->getTotalDataCount();
 if ($number <= 0)
    echo $lang['not_found'];
 else if ($number == 1 && $allmode == 0)   // Перенаправляем
    echo '<meta http-equiv="refresh" content=1;URL=?spell='.$spell_search->data_array[0]['id'].'>';
 else
    $spell_search->createReport($lang['search_results'].' - '.$lang['found'].' '.$number);
}
?>