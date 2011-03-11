<?php
include_once("conf.php");
include_once("include/enchant_table.php");
include_once("include/report_generator.php");
##########
/*
 Скрипт показывает энчант по его $entry
 Показывает:
  - Делается спеллом
  - Камни дающие этот энчант
  - Вещи с бонусами камней, дающие этот энчант
  - Выбрать рандом энчанты список
  - Рандом суффиксы
*/

$entry = intval(@$_REQUEST['enchant']);
$page  = intval(@$_REQUEST['page']);
$mark  = @$_REQUEST['mark'];
$enc=getEnchantment($entry);
if (!$enc)
{
  RenderError($lang['enchant_not_found']);
}
else
{
  $baseLink = '?enchant='.$entry;
  if ($ajaxmode==0)
  {
   echo "<table cellspacing=0 cellpadding=0 width=500>";
   echo "<tbody>";
   echo "<tr>";
   echo "<td align=center>";generateEnchantTable($enc);echo "</td>";
   echo "</tr>";
   echo "</tbody></table>";
  }
  createReportTab();
  //********************************************************************************
  // Делается спеллом
  //********************************************************************************
  $spell_list =& new SpellReportGenerator;
  $fields = array('SPELL_REPORT_LEVEL','SPELL_REPORT_ICON','SPELL_REPORT_NAME');
  if ($spell_list->Init($fields, $baseLink, 'spellLIST', $config['fade_limit'], 'name'))
  {
    $spell_list->enchantFromSpells($entry);
    $spell_list->createReport($lang['enchant_by_spell']);
  }
  //**************************************************
  // Камни дающие этот энчант
  //**************************************************
  $sitem_req =& new ItemReportGenerator();
  $fields = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME');
  if ($sitem_req->Init($fields, $baseLink, 'itemreqLIST', $config['fade_limit'], 'rep_rank'))
  {
    $sitem_req->enchantByGems($entry);
    $sitem_req->createReport($lang['enchant_by_gems']);
  }
  //**************************************************
  // Вещи с бонусами камней, дающие этот энчант
  //**************************************************
  $item_req =& new ItemReportGenerator();
  $fields = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME');
  if ($item_req->Init($fields, $baseLink, 'itemreqLIST', $config['fade_limit'], 'rep_rank'))
  {
    $item_req->socketBonus($entry);
    $item_req->createReport($lang['enchant_by_socket']);
  }
  //**************************************************
  // Выбрать рандом энчанты список
  //**************************************************
  $rnd_propety =& new RandomPropetyReportGenerator();
  $fields = array('RPROP_REPORT_ID','RPROP_REPORT_NAME','RPROP_REPORT_ENCHANTS');
  if ($rnd_propety->Init($fields, $baseLink, 'randPropLIST', $config['fade_limit'], 'name'))
  {
    $rnd_propety->enchantFrom($entry);
    $rnd_propety->createReport($lang['enchant_by_rand_prop']);
  }
  //**************************************************
  // Рандом суффиксы
  //**************************************************
  $rnd_suffix =& new RandomSuffixReportGenerator();
  $fields = array('RSUFF_REPORT_ID','RSUFF_REPORT_NAME','RSUFF_REPORT_ENCHANTS');
  if ($rnd_suffix->Init($fields, $baseLink, 'randSuffLIST', $config['fade_limit'], 'name'))
  {
    $rnd_suffix->enchantFrom($entry);
    $rnd_suffix->createReport($lang['enchant_by_rand_suff']);
  }
}
?>